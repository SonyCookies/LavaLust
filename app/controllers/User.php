<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class User extends Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->call->helper('url');
    $this->call->library('session');
    $this->call->library('email');
    $this->call->library('form_validation');
    $this->call->model('User_model');
    $this->call->database();
  }

  public function login()
  {
    $this->call->view('login');
  }

  public function register()
  {
    $this->call->view('register');
  }
  public function register_post()
  {
    $this->form_validation
      ->name('name')
      ->required()
      ->min_length(3)
      ->name('password')
      ->required()
      ->min_length(8)
      ->name('confpassword')
      ->matches('password')
      ->required()
      ->min_length(8)
      ->name('email')
      ->valid_email();

    if ($this->form_validation->run() == FALSE) {
      die('TODO | Please ensure your password is at least 8 characters long.');
      $this->call->view('register', ['error_message' => 'Please ensure your password is at least 8 characters long.']);
    } else {
      $existingEmail = $this->User_model->get_user_by_email($this->io->post('email'));

      if ($existingEmail) {
        die('TODO | Email already exists.');
        $this->call->view('register', ['error_message' => 'Email already registered']);
      } else {
        $verificationCode = substr(md5(rand()), 0, 6);
        $hashedPassword = password_hash($this->io->post('password'), PASSWORD_BCRYPT);
        $is_verified = 0;
        $email = $this->io->post('email');

        $this->User_model->insert(
          $this->io->post('name'),
          $hashedPassword,
          $email,
          $is_verified,
          $verificationCode
        );

        $data['email'] = $email;

        $this->call->view('verify', $data);

        $this->session->set_userdata('registered_email', $email);

        $subject = "Account Verification";
        // $content = "Hello,<br><br>This is a LAVLAUST4 email.<br>Proceed to this <a href='" . site_url("pendingVerification") . "/" . $user['id'] . "'>Link</a> to verify your account.<br><br>Best regards,<br>Your Name";

        $content = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                body {
                    background-color: #f4f4f7;
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    -webkit-font-smoothing: antialiased;
                }
                .email-container {
                    max-width: 600px;
                    margin: 20px auto;
                    background-color: #ffffff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    border: 1px solid #ddd;
                }
                .header {
                    text-align: center;
                    background-color: #4CAF50;
                    padding: 10px;
                    border-top-left-radius: 8px;
                    border-top-right-radius: 8px;
                    color: #fff;
                }
                .header h1 {
                    margin: 0;
                    font-size: 24px;
                }
                .content {
                    padding: 20px;
                    font-size: 16px;
                    color: #333;
                    line-height: 1.6;
                }
                .content p {
                    margin-bottom: 20px;
                }
                .verification-code {
                    display: inline-block;
                    background-color: #f4f4f7;
                    color: #4CAF50;
                    font-weight: bold;
                    font-size: 24px;
                    padding: 10px 20px;
                    border-radius: 8px;
                    margin: 20px 0;
                    letter-spacing: 2px;
                    text-align: center;
                }
                .footer {
                    text-align: center;
                    padding: 20px;
                    font-size: 14px;
                    color: #888;
                }
                .footer p {
                    margin: 0;
                }
            </style>
        </head>
        <body>
            <div class="email-container">
                <div class="header">
                    <h1>Email Verification</h1>
                </div>
                <div class="content">
                    <p>Hello,</p>
                    <p>Thank you for registering with us. To complete the registration process, please verify your email address by using the code below:</p>
                    <div class="verification-code">' . $verificationCode . '</div>
                    <p>If you did not sign up for this account, please ignore this email.</p>
                    <p>Best regards,<br>Support Team</p>
                </div>
                <div class="footer">
                    <p>© 2024. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>';
        $this->sendEmailVerification($email, $subject, $content);
      }
    }
  }

  public function sendEmailVerification($recepient_email, $subject, $content)
  {
    $this->email->sender('sonnypsarcia@gmail.com', 'LavalustActivity2');
    $this->email->recipient($recepient_email);
    $this->email->subject($subject);
    $this->email->email_content($content, "html");
    $this->email->send();
  }

  public function checkCode()
  {
    $code = $this->io->post('verify');
    $email = $this->io->post('email');

    $user = $this->User_model->get_user_by_email($email);

    if ($user) {
      if ($user['verification_code'] === $code) {
        $updateData = [
          'is_verified' => 1,
          'verification_code' => NULL
        ];
        $this->User_model->update_user_by_email($email, $updateData);
        $this->call->view('success_verification', ['email' => $email]);
      } else {
        die('TODO | Invalid verification code: ' . $code . ':' . $user['verification_code']);
        $this->call->view('verify', ['error_message' => 'Invalid verification code', 'email' => $email]);
      }
    } else {
      die('TODO | Email not found');
      $this->call->view('verify', ['error_message' => 'Email not found', 'email' => $email]);
    }
  }

  public function authenticate()
  {
    // Get email and password from form input
    $email = $this->io->post('email');
    $password = $this->io->post('password');

    $user = $this->User_model->get_user_by_email($email);

    if ($user) {
      if ($user['is_verified'] == 0 || $user['verification_code'] != null) {

        $verificationCode = substr(md5(rand()), 0, 6);
        $this->User_model->update_verification_code_by_email($email, $verificationCode);
        $data['email'] = $email;

        $this->call->view('verify', $data);

        $this->session->set_userdata('registered_email', $email);

        $subject = "Account Verification";
        $content = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                body {
                    background-color: #f4f4f7;
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    -webkit-font-smoothing: antialiased;
                }
                .email-container {
                    max-width: 600px;
                    margin: 20px auto;
                    background-color: #ffffff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    border: 1px solid #ddd;
                }
                .header {
                    text-align: center;
                    background-color: #4CAF50;
                    padding: 10px;
                    border-top-left-radius: 8px;
                    border-top-right-radius: 8px;
                    color: #fff;
                }
                .header h1 {
                    margin: 0;
                    font-size: 24px;
                }
                .content {
                    padding: 20px;
                    font-size: 16px;
                    color: #333;
                    line-height: 1.6;
                }
                .content p {
                    margin-bottom: 20px;
                }
                .verification-code {
                    display: inline-block;
                    background-color: #f4f4f7;
                    color: #4CAF50;
                    font-weight: bold;
                    font-size: 24px;
                    padding: 10px 20px;
                    border-radius: 8px;
                    margin: 20px 0;
                    letter-spacing: 2px;
                    text-align: center;
                }
                .footer {
                    text-align: center;
                    padding: 20px;
                    font-size: 14px;
                    color: #888;
                }
                .footer p {
                    margin: 0;
                }
            </style>
        </head>
        <body>
            <div class="email-container">
                <div class="header">
                    <h1>Email Verification</h1>
                </div>
                <div class="content">
                    <p>Hello,</p>
                    <p>Thank you for registering with us. To complete the registration process, please verify your email address by using the code below:</p>
                    <div class="verification-code">' . $verificationCode . '</div>
                    <p>If you did not sign up for this account, please ignore this email.</p>
                    <p>Best regards,<br>Support Team</p>
                </div>
                <div class="footer">
                    <p>© 2024. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>';
        $this->sendEmailVerification($email, $subject, $content);
      } else {
        if (password_verify($password, $user['password'])) {
          $this->session->set_userdata('user_id', $user['id']);
          $this->session->set_userdata('email', $user['email']);
          $this->session->set_userdata('name', $user['name']);



          header('Location: /');
          exit;
        } else {
          die('Invalid password.');
          $this->call->view('login', ['error_message' => 'Invalid password.']);
        }
      }
    } else {
      die('No account found with that email');
      $this->call->view('login', ['error_message' => 'No account found with that email.']);
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('/login');
  }


}
