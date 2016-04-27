<?php

class Account extends CI_Controller
{
	public function __construct()
	{
		# code...'
		parent::__construct();

	}

	public function index()
	{

		if ($this->session->userdata('logged_in')) 
		{		
			$this->load->view('layouts/header');
			$this->load->view('home_page'); #,array('logged_in' => $this->logged_in)
			$this->load->view('layouts/footer');
		}
		else
		{
			$this->load->view('layouts/header');
			$this->load->view('login_form'); #,array('logged_in' => $this->logged_in)
			$this->load->view('layouts/footer');
		}
	}
		
}
?>