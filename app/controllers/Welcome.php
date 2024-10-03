<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class Welcome extends Controller
{

	public function __construct()
	{
		parent::__construct();
		// Uploaded file
		$this->call->helper('url');
		$this->call->library('session');
		$this->call->library('email');
		$this->call->library('form_validation');
		$this->call->model('User_model');
		$this->call->database();
	}

	public function index()
	{

		$email = $this->session->userdata('email');
		$id = $this->session->userdata('user_id');
		$name = $this->session->userdata('name');

		if (!$email || !$id || !$name) {
			return redirect('/login');
		}

		$user = $this->User_model->get_user_by_email($email);

		if ($user && $user['is_verified'] == 1) {
			$this->call->view('welcome_page');
		} else {
			return redirect('/verify');
		}
	}

	public function report()
	{
		$this->call->view('report');
	}

	public function sendAttachedEmail($name, $recipient_email, $subject, $content, $path)
	{
		$fullContent = "Hello,<br><br>This is your report.<br><br>" . $content;
		$this->email->sender($this->session->userdata('email'), $name);
		$this->email->recipient($recipient_email);
		$this->email->subject($subject);
		$this->email->email_content($fullContent, 'html');
		$this->email->attachment($path);
		$this->email->send();
	}

	public function upload()
	{
		$name = $this->io->post('name');
		$recipient_email = $this->io->post('recipient_email');
		$subject = $this->io->post('subject');
		$content = $this->io->post('content');

		$this->call->library('upload', $_FILES["userfile"]);
		$this->upload
			->set_dir('public')
			->allowed_extensions(array('jpg'))
			->allowed_mimes(array('image/jpeg'))
			->is_image()
			->encrypt_name();
		if ($this->upload->do_upload()) {
			$data['filename'] = $this->upload->get_filename();
			$path = "public/" . $this->upload->get_filename();
			$this->sendAttachedEmail($name, $recipient_email, $subject, $content, $path);
			$this->call->view('success_report', data: $data);
		} else {
			$data['errors'] = $this->upload->get_errors();
			$this->call->view('report', $data);
		}
	}
}
