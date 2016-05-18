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
			
// echo $image;
// die();
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
			$this->session->set_userdata($data);

			$id = $session_data['id'];
			$image['img'] = $this->model_edit->fetch_image($id);
			
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