<?php
class Model_article extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$session_data = $this->session->userdata('logged_in');
	}
public function fetch_article($cat)
{
	$query = "SELECT * FROM user_articles WHERE cat_id_fk = {$cat}";
	$query = $this->db->query($query);

	if ($query) {
		return $query;
	}
	else
	{
		return FALSE;
	}
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
	
	public function add_article_img($cat_id, $image_name) 
	{
  
    	$this->db->set("article_images", $image_name);
	    $this->db->where("cat_id_fk", $cat_id);
	    $row = $this->db->update("user_articles");

	    // $row = $row->row();
		// print_r($row);
		// die();
		if ($row == 1) 
		{
			return TRUE; #$row
		}
		else
		return FALSE;
		
   } 
	public function display($catagory_id)
	{
		$sql = "SELECT * FROM user_articles WHERE cat_id_fk = '{$catagory_id}' ";
		$result = $this->db->query($sql);
		return $result;
	}

	public function add_cat($input_cat)
	{
		$id = $this->input->post('hiddenValue');
		$query = "INSERT INTO catagory(`user_id_fk`,`cat_name`) VALUES ( '{$id}' ,'{$input_cat}' )";
		// echo $query;
		// die();
		$sql = $this->db->query($query);

		// $result = $this->db->query($sql);
		// print_r($sql);
		// die();
		$row = $this->db->insert_id();
		return $row;
	}

	public function add_cat_art($cat_id,$image_path)
	{

		$catagory_id = $cat_id;

			$title = $this->input->post('title');
			$articletext = $this->input->post('articletext',true);
			
			$sql = " INSERT INTO user_articles (`cat_id_fk`, `title`, `article`, `article_image`) VALUES ( '$catagory_id', '{$title}', '{$articletext}', '{$image_path}'); ";

			$result = $this->db->query($sql);
			// $row = $result->row();

			if ($result) {
				return true;
			}
			else
			{
				echo "Couldn't perform query";
				die(mysqli_error($sql));
				return false;
			}

		return $result;
	}

	public function add_article($image_path)
	{
			$id = $this->input->post('hiddenValue');
			$title = $this->input->post('title');
			$catagory_id = $this->input->post('catagory_select');

			$cat = $this->input->post('cat');

			$articletext = $this->input->post('articletext',true);
		
			$sql = " INSERT INTO user_articles (`cat_id_fk`, `title`, `article`, `article_image`) VALUES ( '$catagory_id', '{$title}', '{$articletext}', '{$image_path}'); ";

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