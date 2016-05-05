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

	public function articles_view()
	{
		$session_data = $this->session->userdata('logged_in');
// print_r($session_data);
// die();
		if ($session_data) 
		{
			$catagory['query'] = $this->model_article->fetch_catagory($session_data['id']);

			$this->load->view('layouts/header');
			$this->load->view('view_articles',$catagory);
			$this->load->view('layouts/footer');
		}
		else
		{
			$this->load->view('layouts/header');
			$this->load->view('login_form');
			$this->load->view('layouts/footer');
		}
	}

	public function display_articles()
	{
		$catagory_id = $this->input->post('catagory_select');
		$display['data'] = $this->model_article->display($catagory_id);
		
		/*foreach ($display as $key) {
			print_r($key);
		}
		die();*/
		// print_r($display);
		// echo $catagory_id;
		// die();

		if ($display) 
		{
			$this->load->view('layouts/header');
			$this->load->view('view_only', $display);
			$this->load->view('layouts/footer');
		}
		else
		{
			return FALSE;
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