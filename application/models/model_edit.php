<?php

/**
* This model class simply checks if user exists to update
*/
class Model_edit extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function record_exist($id)
	{

		$sql = "SELECT * FROM users WHERE user_id = '{$id}'  LIMIT 1";
		$result = $this->db->query($sql);
		$rows = $result->num_rows();

		if ($rows == 1) {
			return TRUE;
		}
		else
		return FALSE;
	}
	
	public function update_record($username,$name,$email,$id)
	{
		$sql = "UPDATE users SET username = '{$username}', name = '{$name}', email = '{$email}' WHERE user_id = '{$id}' LIMIT 1";
					
		$result = $this->db->query($sql);;

		if ($result) 
		{
			$sql = "SELECT * FROM users WHERE user_id = '{$id}'  LIMIT 1";
			$result = $this->db->query($sql);
			$rows = $result->row();

			$sess_data = array(
					'id' => $rows->user_id,
					'username' => $rows->username,
					'name' => $rows->name,
					'image' => $rows->images,
					'email' => $rows->email
					);

			$this->session->set_userdata('logged_in', $sess_data);
			return TRUE;
		}
		else
		return FALSE;
	}

/*	public function check_image($id)
	{
		$sql = "SELECT images FROM users WHERE id = '{$id}'  LIMIT 1";
		$result = $this->db->query($sql);
		$rows = $result->row();

		if ($rows == 1) {
			return TRUE;
		}
		else
			return FALSE;
	}*/

	/*public function insert_dp($id,$data)
	{
		$sql = " INSERT INTO users (images) VALUES ('{$data}') SELECT images FROM users WHERE id ='{$id}' ";
		$result = $this->db->query($sql);
		$rows = $result->row();

		if ($rows == 1) {
			return TRUE;
		}
		else
			return FALSE;
	}*/

	public function update_dp($id, $image_name) 
	{
  
    	$this->db->set("images", $image_name);
	    $this->db->where("user_id", $id);
	    $this->db->update("users");
	    $row = $this->db->affected_rows();

		if ($row == 1) {
			return $image_name;
		}
		else
		return FALSE;
		
   } 
}
?>