<?php
class Register extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view('layouts/header');
		$this->load->view('register_view');
		$this->load->view('layouts/footer');
	}

	public function register_user()
	{
		$this->form_validation->set_rules('user-name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('user-password', 'Password', 'required|matches[passwordconf]'); #
        $this->form_validation->set_rules('passwordconf', 'confirm Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

                
        if ($this->form_validation->run() === FALSE)
        {
        	$this->load->view('layouts/header');
            $this->load->view('register_view');
            $this->load->view('layouts/footer');
        }
          
        else
        {
        	$result = $this->model_register->insert_user();

            if(!$result)
            {
                echo "Coulnd't register, contact site admin help@xyz.com";
            }

            else
            {
            	$this->load->view('layouts/header');
                $this->load->view('register_success', array('username' => $result ));
                $this->load->view('layouts/footer');
            }

           }
	}

	public function validate_email($email_address, $email_code)
	{
		$email_code = trim($email_code);
		$validated = $this->model_register->validate_email($email_address, $email_code);

		if($validated === TRUE)
		{
			$this->load->view("layouts/header");
			$this->load->view('view_registeration_complete'); #/view_email_validated',array('email_address' => $email_address
			$this->load->view('layouts/footer');
		}
		
		else
		{
			echo "Error couldn't activate email";
		}
	}
}
?>