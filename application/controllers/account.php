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
		$session_data = $this->session->userdata('logged_in');

		if ($this->session->userdata('logged_in')) 
		{
			$id = $session_data['id'];
			$image['img'] = $this->model_edit->fetch_image($id);
// echo $image;
// die();
			$this->load->view('layouts/header');
			$this->load->view('home_page', $image); #,array('logged_in' => $this->logged_in)
			$this->load->view('layouts/footer');
		}
		else
		{
			// $this->load->view('layouts/header');
			$this->load->view('login_form'); #,array('logged_in' => $this->logged_in)
			// $this->load->view('layouts/footer');
		}
	}
		
}
?>