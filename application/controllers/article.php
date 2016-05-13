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

		if (!empty($display)) 
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
		$this->form_validation->set_rules('title', 'Title', 'min_length[5]|max_length[100]|required');
        $this->form_validation->set_rules('articletext', 'Article Text', 'min_length[5]|max_length[1000]|required');
    

        if ($this->form_validation->run() === FALSE)
		{

			$this->load->view('layouts/header');
			$this->load->view('view_addarticle');
			$this->load->view('layouts/footer');
			// redirect('article');
		}
		else
		{
			$title = $this->input->post('title');
			$input_cat = $this->input->post('cat');
			
			//If input field has some value then add that value first then show it over view page
			if (!empty($input_cat)) 
			{
				$result = $this->model_article->add_cat($input_cat);
				if ($result) {
					// print_r($result);
					// die();
					// $result = $result->db->row();
					$cat_id = $result;
					$result = $this->model_article->add_cat_art($cat_id);
				}
			}
			
			else
			{
				$result = $this->model_article->add_article();
			}
			
			if(!$result)
            {
                echo "Coulnd't add your article, contact site admin help@xyz.com";
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