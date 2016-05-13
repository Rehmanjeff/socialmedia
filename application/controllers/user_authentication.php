<?php

Class User_Authentication extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
	}

	// Show login page
	public function index() 
	{
		// $this->load->view('layouts/header');
		$this->load->view('login_form');
		// $this->load->view('layouts/footer');
	}

	public function user_login_process() 
	{	

		$session_set_value = $this->session->all_userdata();

		// Check for remember_me data in retrieved session data
		if (isset($session_set_value['remember_me']) && $session_set_value['remember_me'] == "1") 
		{
			redirect('account');
		}		// Check for validation
		
		else{

			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

			if ($this->form_validation->run() == FALSE) 
			{
				$this->session->set_flashdata('message', 'Authentication failed');

				redirect(site_url('User_authentication'), 'refresh'); 


				// $this->load->view('layouts/header');
				// $this->load->view('login_form');
				// $this->load->view('layouts/footer');
			} 
			
			else 
			{
					$result = $this->model_login->login_user();

					switch ($result) 
					{
						case 'authenticated':
						redirect('account');

							break;
						case 'incorrect_password':
							// echo "Error loging in, password not correct...!";
							$this->session->set_flashdata('message', 'Error loging in, password not correct...!');
							redirect(site_url('User_authentication'), 'refresh'); 

							break;

						case 'not_activated':
							// echo "Please activate your account before logging in...!";
							$this->session->set_flashdata('message', 'Please activate your account before logging in...!');
							redirect(site_url('User_authentication'), 'refresh'); 

							break;

						case 'incorrect_username':
							// echo "Error loging in, password/username not correct...!";
							$this->session->set_flashdata('message', 'Error loging in, password/username not correct...!');
							redirect(site_url('User_authentication'), 'refresh'); 

							break;
						
						default:
							echo "Enter correct value, press backspace";
							break;
					}
				}
			}
	}

	// Logout from admin page
	public function logout() 
	{

	// Destroy session data
		$this->session->sess_destroy();
		$data['message_display'] = 'Successfully Logout';
		redirect('account');		
	}

}
?>