<?php

class Article extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$session_data = $this->session->userdata('logged_in');
// print_r($session_data);
// die();
		if ($session_data) 
		{
			$catagory['query'] = $this->model_article->fetch_catagory($session_data['id']);

			$this->load->view('layouts/header');
			$this->load->view('view_addarticle',$catagory);
			$this->load->view('layouts/footer');
		}
		else
		{
			$this->load->view('layouts/header');
			$this->load->view('login_form');
			$this->load->view('layouts/footer');
		}
	}

	public function submit_article()
	{
		$this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('articletext', 'Article Text', 'required');
        if ($this->form_validation->run() === FALSE)
		{

			$this->load->view('layouts/header');
			$this->load->view('view_addarticle');
			$this->load->view('layouts/footer');
		}
		else
		{
			$title = $this->input->post('title');

			$result = $this->model_article->add_article();
			
			if(!$result)
            {
                echo "Coulnd't register, contact site admin help@xyz.com";
            }

            else
            {
            	// echo json_encode($result);
            	redirect('account');
            }
		}
        
	}
}
?>