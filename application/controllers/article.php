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
			
			$catagory = $this->model_article->fetch_catagory($session_data['id']);
			$cat = $catagory->row();
			$cat = $cat->cat_id;
			// print_r($cat);
			// die();
			// it should take cat_id, and cat_id should be extracted from users table
			$image = $this->model_article->fetch_article($cat);
			$image = $image->row();
			$image = $image->article_image;
			// echo $cat."<br>";
			// echo $image;
			// die();

			$data = array(
				'query' => $catagory,
				'img' => $image );

			$this->load->view('layouts/header');
			$this->load->view('view_addarticle',$data);
			$this->load->view('layouts/footer');
		}
		else
		{
			$this->load->view('layouts/header');
			$this->load->view('login_form');
			$this->load->view('layouts/footer');
		}
	}

	public function add_article_image()
	{
		

        if ( ! $this->upload->do_upload('userfile'))
        {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('upload_form', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $cat_id = $this->input->post('catagory_select');

		    $result = $this->model_article->add_article_img($cat_id, $actual_image_name);
		    if ($result) {
		    	redirect('account');
		    }
		    else
		    {
		    	echo "Error, can't add picture please try again";
		    }
        }

		
	}

	public function articles_view()
	{
		$session_data = $this->session->userdata('logged_in');
// print_r($session_data);
// die();
		if ($session_data) 
		{
			$catagory = $this->model_article->fetch_catagory($session_data['id']);
			$cat = $catagory->row();
			$cat = $cat->cat_id;
			// print_r($cat);
			// die();
			// it should take cat_id, and cat_id should be extracted from users table
			$image = $this->model_article->fetch_article($cat);
			$image = $image->row();
			$image = $image->article_image;
			// echo $cat."<br>";
			// echo $image;
			// die();

			$data = array(
				'query' => $catagory,
				'img' => $image );

			// print_r($data);
			// die();

			$this->load->view('layouts/header');
			$this->load->view('view_articles',$data);
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
		$catagory_id;
		// = $this->input->post('catagory_select');


		if ($this->uri->segment(3) === FALSE)
		{
		        $catagory_id = 0;
		}
		else
		{
		        $catagory_id = $this->uri->segment(3);
		        // echo $catagory_id;
		        // die();
		}

		$catagory_id = $this->model_article->get_catagory_id($catagory_id);
		$catagory_id = $catagory_id->row();
		$catagory_id = $catagory_id->cat_id;

		$display['data'] = $this->model_article->display($catagory_id);
	

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
			$this->session->set_flashdata('message', 'Form validation Failed: Minimum character should be 5 per field (all required)');
			redirect('article');
		}

		else
		{
			 	$config['upload_path']          = './uploads/article_img';
                $config['allowed_types']        = 'gif|jpg|png';
                $data;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        // $this->load->view('upload_form', $error);

            // print_r($error);
            // die();
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                        // $this->load->view('upload_success', $data);

            // print_r($data);
            // die();
                }
            $image_path = $this->upload->data('file_name');    
			$title = $this->input->post('title');
			$input_cat = $this->input->post('cat');			
			$cat_id = $this->input->post('catagory_select');

			//If input field has some value then add that value first then show it over view page
			if (!empty($input_cat)) 
			{
				$result = $this->model_article->add_cat($input_cat);
				if ($result) {
					// print_r($result);
					// die();
					// $result = $result->db->row();
					$cat_id = $result;
					$result = $this->model_article->add_cat_art($cat_id,$image_path);
				}
			}
			
			else
			{
				$result = $this->model_article->add_article($image_path);
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