<?php
/**
* 
*/
class Home extends CI_Controller
{
	private $logged_in;
	
	public function __construct()
	{
		# code...'
		parent::__construct();

		if($logged_in)
		{
			$this->logged_in = TRUE;
		}
		else
		{
			$this->logged_in = FALSE;
		}
	}

	public function index()
	{
		if ($logged_in) 
		{		
			$this->load->view('layouts/header');
			$this->load->view('home_page'); #,array('logged_in' => $this->logged_in)
			$this->load->view('layouts/footer');
		}
		else
		{
			$this->load->view('layouts/header');
			$this->load->view('login/view_login'); #,array('logged_in' => $this->logged_in)
			$this->load->view('layouts/footer');
		}
	}
}
?>