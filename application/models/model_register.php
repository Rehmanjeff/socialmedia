<?php
/**
* 
*/
class Model_register extends CI_Model
{
	private $email_code;
	function __construct()
	{
		parent::__construct();
	}
	public function insert_user()
	{
		$name = $this->input->post('user-name');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('user-password');
		
		// echo $password."before hashing <br>";
		$password = sha1($this->config->item('salt').$password);
		// echo $password." after hashing <br>";
		$data = array(
			'name' => $name,
			'username' => $username,
			'password' => $password,
			'email' => $email
			);
        $this->db->set('reg_time', 'NOW()', FALSE);
		
		// echo $username."<br>";
		// echo $name."<br>";
		// echo $password."<br>";
		$sql = $this->db->insert('users',$data);
		
		if(isset($sql))
		{
			$this->set_session($name, $username, $email);
			$this->send_validation_email();
			return $username;
		}
		else
		{
			echo "Coudn't signup, error occured";
			$this->load->view('layouts/header');
			$this->load->view('register_success');
			$this->load->view('layouts/footer');
		}
	}
	
	public function set_session($name, $username, $email)
	{
		#$row = $this->db->insert_id();
		#$sql = $this->db->get('users',array('row'=>$row),1,$email); #, 'reg_time'=>$reg
		$sql = "SELECT id,reg_time FROM users WHERE email = '".$email."' LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->row();
		$sess_data = array(
			'id' => $row,
			'name' => $name,
			'username' => $username,
			'email' => $email,
			'logged_in' => 0
			);
		$this->email_code = md5($row->reg_time);
		$this->session->set_userdata($sess_data);
	}
	public function validate_email($email_address, $email_code)
	{
		$sql = "SELECT email,reg_time FROM users WHERE email = '{$email_address}' LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->row();
		if(isset($row))
		{
			if(md5($row->reg_time) == $email_code)
				$result = $this->activate_account($email_address);
			if($result == TRUE)
				return true;
			else{
				echo "There is an error in activating your account.";
				return false;
			}
		}
		else
		{
			echo "there was an error in validating your email.";
		}
	}
	public function	send_validation_email()
	{
		$this->load->library('email');
		$email = $this->session->userdata('email');
		$email_code = $this->email_code;
		$this->email->set_mailtype('html');
		$this->email->from($this->config->item('bot_email'),'authentication email');
		$this->email->to('rehmank360@gmail.com');
		$this->email->subject('Please activate your account');
		$message = '<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>Document</title>
		</head>
		<body>';
		$message .='<p>thanks for registering on test site, please <strong><a href="' .base_url(). 'index.php/register/validate_email/'.$email.'/'.$email_code.'" >click here</a></strong> to activate your account. After you have activated your account, you will be avaliable to log in to your account</p>';
		$message .='<p>Thank Your </p>';
		$message .='</body></html>';
		$this->email->message($message);
		$this->email->send();
	}
	private function activate_account($email_address)
	{
		$sql = "UPDATE users SET activated = 1 WHERE email = '".$email_address."'LIMIT 1";
		$result = $this->db->query($sql);
		#$row = $result->row();
		if(isset($result))
		{
			return TRUE;
		}
		else
			return FALSE;
	}
}
?>