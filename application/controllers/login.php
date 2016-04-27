<?php
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
		$this->load->library('email');
		$email_code = md5($this->config->item('salt').$name);

		$this->email->set_mailtype('html');
		$this->email->from($this->config->item('bot_email'),'reset password email');
		$this->email->to($email);
		$this->email->subject('Please reset your password');

		$message = "<!DOCTYPE html><html>
		<head>
			<title>Reset Password</title>
		</head>
		<body>";
		$message .= "<p> Dear '{$name}'</p>";
		$message .='<p> we want to help you reset your password! please <strong> <a href="'.base_url().'index.php/login/reset_password_form/'.$email.'/'.$email_code.'">Click here </a> </strong> to reset your password</p>';
		$message .="<p>Thank you</p>";
		$message .="</body></html>";

		$this->email->message($message);
		$this->email->send();
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