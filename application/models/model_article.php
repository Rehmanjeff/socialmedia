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
		$query = $this->db->get_where('catagory', array('user_id_fk' => $user_id ));

		$data = $query->row();
		
		if ($data) 
		{
			return $data;
		}

			return FALSE;
	}

	public function add_article()
	{
			$id = $this->input->post('hiddenValue');
			$title = $this->input->post('title');
			$catagory = $this->input->post('catagory');
			$articletext = $this->input->post('articletext',true);
			// $data = array(
			// 	'id' => 'hiddenValue',
			// 	'title' => 'title',
			// 	'catagory' => 'catagory',
			// 	'articletext' => 'articletext');
/*
			$sql = "INSERT INTO user_articles (`user_id_fk`, `title`, `catagory`, `article`) VALUES ('$data['id']', '{$data['title']', '$data['catagory']', '$data['articletext']');"*/
			

			$sql = "INSERT INTO user_articles (`user_id_fk`, `title`, `catagory`, `article`) VALUES ('{$id}', '{$title}', '{$catagory}', '{$articletext}')";

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