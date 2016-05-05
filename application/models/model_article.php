<?php
class Model_article extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$session_data = $this->session->userdata('logged_in');
	}

	public function fetch_catagory($user_id)
	{
		$query = "SELECT * FROM catagory WHERE user_id_fk = {$user_id} "; 
		// echo $query;
		// die();
		#$this->db->get_where('catagory', array('user_id_fk' => $user_id ));
		$query = $this->db->query($query);
		// $array = array('user_id_fk =' => $user_id );
		// $query = $this->db->get_where('catagory',$array);
		// $data = $query->row();
		// $data = $this->db->affected_rows();

		/*		$arrayName = array();
		foreach ($data as $key) {
			$arrayName[] = $key;
		}*/
// print_r($data);
// die();
		if ($query) 
		{
			return $query;
		}

			return FALSE;
	}

	public function display($catagory_id)
	{
		$sql = "SELECT * FROM user_articles WHERE cat_id_fk = '{$catagory_id}' ";
		$result = $this->db->query($sql);
		return $result;
	}

	public function add_article()
	{
			$id = $this->input->post('hiddenValue');
			$title = $this->input->post('title');
			$catagory_id = $this->input->post('catagory_select');

			$cat = $this->input->post('cat');

			if (!isset($cat))
			{

				$cat_input = $this->input->post('cat');

				$add_catagory = "INSERT INTO catagory (`user_id_fk`,`cat_name`) VALUES ( '{$id}' ,'{$cat_input}' ) ";
				$result_catagory = $this->db->query($add_catagory);

				$retrive_catagory = "SELECT cat_id FROM catagory WHERE cat_name = '{$cat_input}' ";
				
				$result = $this->db->query($retrive_catagory)->row();
				
				$catagory_id = $result->cat_id; 

			}

			$articletext = $this->input->post('articletext',true);
			// $data = array(
			// 	'id' => 'hiddenValue',
			// 	'title' => 'title',
			// 	'catagory' => 'catagory',
			// 	'articletext' => 'articletext');
/*
			$sql = "INSERT INTO user_articles (`user_id_fk`, `title`, `catagory`, `article`) VALUES ('$data['id']', '{$data['title']', '$data['catagory']', '$data['articletext']');"*/
			
			// echo $catagory_id; 
			// die();
			$sql = " INSERT INTO user_articles (`cat_id_fk`, `title`, `article`) VALUES ( '$catagory_id', '{$title}', '{$articletext}'); ";

/*			$sql = "INSERT INTO user_articles (`cat_id_fk`, `title`, `article`) VALUES ('{$catagory_id}', '{$title}', '{$articletext}') ";
*/
			$result = $this->db->query($sql);
			$row = $this->db->affected_rows();

			if ($row) {
				return true;
			}
			else
			{
				echo "Couldn't perform query";
				die(mysqli_error($sql));
				return false;
			}
	}
}
?>