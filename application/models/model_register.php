<?php
/**
* 
*/
require_once('phpmailer/PHPMailerAutoload.php');
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
		// $row = $this->sql->row();
		// $email = $row->email;
		if(isset($sql))
		{
			$this->set_session($name, $username, $email);
			$this->send_validation_email($email);
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
		$sql = "SELECT user_id,reg_time FROM users WHERE email = '".$email."' LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->row();
		$sess_data = array(
			'id' => $row->user_id,
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
	public function	send_validation_email($email)
	{
		// $this->load->library('email');
		$mail = new phpmailer();
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		// $mail->SMTPDebug = 2;

		$mail->Host = 'smtp.gmail.com';
		$mail->Username = 'habib.rehman@jotixtech.com';
		$mail->Password = 'cheerUPlife2';
		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465;

		$mail->From = 'habib.rehman@jotixtech.com';
		$mail->FromName = 'Admin';

		// $email = $this->session->userdata('email');

		$mail->addAddress($email,'Sender email');
		$mail->isHTML(true);
		// $mail->addCC('habib.rehman@jotixtech.com','Sender email');
		// $mail->addBCC('habib.rehman@jotixtech.com','Sender email');
		$mail->Subject='Activate Account';
		$mail->Body='text body of an email id';


		$email_code = $this->email_code;
		// $this->email->set_mailtype('html');
		// $this->email->from($this->config->item('bot_email'),'authentication email');
		// $this->email->to($email);
		// $this->email->subject('Please activate your account');
		$mail->Body= '<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>Document</title>
		</head>
		<body>';
		$mail->Body.='<p>thanks for registering on test site, please <strong><a href="' .base_url(). 'register/validate_email/'.$email.'/'.$email_code.'" >click here</a></strong> to activate your account. After you have activated your account, you will be avaliable to log in to your account</p>';
		$mail->Body .='<p>Thank Your </p>';
		$mail->Body .='</body></html>';
		// $this->email->message($message);
		// $this->email->send();

		$mail->send();

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