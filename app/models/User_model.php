<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class User_model extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->call->database();
    }

    public function get_user_by_email($email)
    {
        return $this->db->table('users')->where('email', $email)->get();
    }

    public function update_user_by_email($email, $data)
    {
        $this->db->table('users')
            ->where('email', $email)
            ->update($data);
    }

    public function update_verification_code_by_email($email, $verificationCode)
    {
        $this->db->table('users')
            ->where('email', $email)
            ->update(['verification_code' => $verificationCode]);
    }


    public function insert($name, $password, $email, $is_verify, $verification)
    {
        $data = array(
            'name' => $name,
            'password' => $password,
            'email' => $email,
            'is_verified' => $is_verify,
            'verification_code' => $verification,
        );
        $result = $this->db->table('users')->insert($data);
    }

    public function updateVerificationCode($email, $verificationCode)
    {
        $data = array(
            'verification_code' => $verificationCode,
        );

        return  $this->db->table('users')->where('email', $email)->update($data);
    }

    public function verifyUser($email, $verificationCode)
    {
        $user = $this->db->table('users')->where('email', $email)->get();

        if ($user && $user['verification_code'] === $verificationCode) {

            $data = array('is_verified' => true);
            $this->db->table('users')->where('email', $email)->update($data);

            return true;
        } else {
            return false;
        }
    }
}
