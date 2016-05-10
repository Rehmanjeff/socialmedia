<?php
require_once('phpmailer/PHPMailerAutoload.php');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('layouts/header');
		$this->load->view('login_form');		
		$this->load->view('layouts/footer');
	}

	public function login_user()
	{
		$this->form_validation->set_rules('username', 'User Name', 'trim|required|xxs-clean');
		$this->form_validation->set_rules('password', 'Password ','trim|required|xxs-clean');

		if($this->form_validation->run() === FALSE)
		{
			echo "Validations doesn't run correctly!<br>";
			$this->load->view('layouts/header');
			$this->load->view('login_form');
			$this->load->view('layouts/footer');       
		}
		else
		{
			$result = $this->model_login->login_user();

			switch ($result) {
				case 'logged_in':
					// redirect('account');
				
			$this->load->view('layouts/header');
			$this->load->view('home_page'); #,array('logged_in' => $this->logged_in)
			$this->load->view('layouts/footer');
					// $this->load->view('admin_page');


					break;
				case 'incorrect_password':
					echo "Error loging in, password not correct...!";
					$this->load->view('layouts/header');
					$this->load->view('login_form');
					$this->load->view('layouts/footer'); 

					break;

				case 'not_activated':
					echo "Please activate your account before logging in...!";
					$this->load->view('layouts/header');
					$this->load->view('login_form');
					$this->load->view('layouts/footer'); 

					break;

				case 'incorrect_username':
					echo "Error loging in, password/username not correct...!";
					$this->load->view('layouts/header');
					$this->load->view('login_form');
					$this->load->view('layouts/footer'); 

					break;
				
				default:
					# code...
					break;
			}
		}
	}


	public function reset_password()
	{
		if (isset($_POST['email'])) 
		{
			# code...
			$this->form_validation->set_rules('email','Email Address','trim|required|valid_email');

			if ($this->form_validation->run() === FALSE) {
				# code...
				$this->load->view('layouts/header');
				$this->load->view('login/view_reset_password', array('error' => 'Please provide a valid email address'));
				$this->load->view('layouts/footer');
			}
			else
			{
				$email = trim($this->input->post('email'));
				$result = $this->model_login->email_exists($email);

				if ($result) 
				{
					$this->send_reset_password_email($email, $result);
					$this->load->view('layouts/header');
					$this->load->view('login/view_reset_password_sent', array('email' => $email));
					$this->load->view('layouts/footer');

				}
				else
				{

					$this->load->view('layouts/header');
					$this->load->view('login/view_login_reset_password_sent', array('error' => 'Email not registerd here'));
					$this->load->view('layouts/footer');
				}
			}
		}
		else
		{

			$this->load->view('layouts/header');
			$this->load->view('login/view_reset_password');
			$this->load->view('layouts/footer');
		}

	}

	public function reset_password_form($email, $email_code)
	{
		if (isset($email) && isset($email_code)) 
		{
			#$email = trim($email);
			$email_hash = sha1($email.$email_code);
			$verified = $this->model_login->verify_reset_password_code($email, $email_code);

			if ($verified) 
			{
				$this->load->view('layouts/header');
				$this->load->view('login/view_update_password', 
					array(
					'email_hash'=>$email_hash,
					'email_code'=>$email_code,
					'email' => $email
					));
				$this->load->view('layouts/footer');
			}
			else
			{
				echo "Can't get verified";
			}
		}
	}

	public function send_reset_password_email($email, $name)
	{
		// $this->load->library('email');
		
		$email_code = md5($this->config->item('salt').$name);



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
		$mail->Subject='Please Reset Your Password';
		$mail->Body='text body of an email id';


		// $email_code = $this->email_code;
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
		$mail->Body.='<p> we want to help you reset your password! please <strong> <a href="'.base_url().'index.php/login/reset_password_form/'.$email.'/'.$email_code.'">Click here </a> </strong> to reset your password</p>';
		$mail->Body .='<p>Thank Your </p>';
		$mail->Body .='</body></html>';
		// $this->email->message($message);
		// $this->email->send();

		$mail->send();


		// $this->email->set_mailtype('html');
		// $this->email->from($this->config->item('bot_email'),'reset password email');
		// $this->email->to($email);
		// $this->email->subject('Please reset your password');

		// $message = "<!DOCTYPE html><html>
		// <head>
		// 	<title>Reset Password</title>
		// </head>
		// <body>";
		// $message .= "<p> Dear '{$name}'</p>";
		// $message .='<p> we want to help you reset your password! please <strong> <a href="'.base_url().'index.php/login/reset_password_form/'.$email.'/'.$email_code.'">Click here </a> </strong> to reset your password</p>';
		// $message .="<p>Thank you</p>";
		// $message .="</body></html>";

		// $this->email->message($message);
		// $this->email->send();
	}

	public function update_password()
	{
		$email = $this->input->post('email');
		$email_hash = $this->input->post('email_hash');
		$email_code = sha1($this->input->post('email').$this->input->post('email_code'));



		if (!isset($email,$email_hash) || ($email_hash != $email_code)) 
		{
			# code...
			die("Error updating password, unauthorize access");
		}

		$this->form_validation->set_rules('email_hash', 'Email Hash', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('new-password', 'password', 'trim|required|matches[new-password-again]');
		$this->form_validation->set_rules('new-password-again', 'password', 'trim|required');

		if ($this->form_validation->run() === FALSE) 
		{
			$this->load->view('layouts/header');
			$this->load->view('login/view_update_password');
			$this->load->view('layouts/footer');
		}
		else
		{
			$result = $this->model_login->update_password();

			if ($result) 
			{
				$this->load->view('layouts/header');
				$this->load->view('login/view_update_password_success');
				$this->load->view('layouts/footer');
			}

			else
			{
				$this->load->view('layouts/header');
				$this->load->view('login/view_update_password',array(
					'error' => 'problem updating your password please contact site admin xyz@abc.com' ));
				$this->load->view('layouts/footer');
			}
		}


	}
}
?>