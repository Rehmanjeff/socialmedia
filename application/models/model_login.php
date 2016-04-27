<?php
/**
* 
*/
class Model_login extends CI_Model
{
	
	public function __construct()
	{
		# code...
		parent::__construct();
	}

	public function login_user()
	{
		$username = $this->input->post('username');

		$remember = $this->input->post('remember_me');

		$userpass = sha1($this->config->item('salt').$this->input->post('password'));

		$sql = "SELECT * FROM users WHERE username = '{$username}'  LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->row();

		if($result->num_rows() == 1)
		{
			if($row->activated)
			{

				if ($row->password == $userpass) 
				{
					$rem = FALSE;
					if ($remember) 
					{
						$this->session->set_userdata('remember_me', TRUE);
						// $this->config->set_item('sess_expire_on_close', FALSE);

					}

					$sess_data = array(
					'id' => $row->id,
					'username' => $username,
					'name' => $row->name,
					'password' => $userpass,
					'email' => $row->email,
					'image' => $row->images
					);
					$this->session->set_userdata('logged_in', $sess_data);

					return 'authenticated';
				}
				else
				{
					return 'incorrect_password';
				}
			}
			else
			{
				return 'not_activated';
			}
		}
		else
		{
			return 'incorrect_username';
		}
	}

	public function email_exists($email)
	{
		$sql = "SELECT name , email FROM users WHERE email = '{$email}' LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->row();

		return ($result->num_rows() === 1 && $row->email) ? $row->name : false;
	}

	public function verify_reset_password_code($email, $code)
	{
		$sql = "SELECT name, email FROM users WHERE email = '{$email}' LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->row();

		if ($result->num_rows() === 1) 
		{
			return ($code == md5($this->config->item('salt').$row->name)) ? true : false;
		}
		else
			return false;
	}


	public function update_password()
	{
		$email = $this->input->post('email');
		echo $this->input->post('password')."<br>";
		$password = sha1($this->config->item('salt').$this->input->post('new-password'));

		echo $this->input->post('password')." hashed password <br>";

		$sql = "UPDATE users SET password = '{$password}' WHERE email = '{$email}' LIMIT 1";
		$this->db->query($sql);

		if (isset($sql)) {
				return true;
			}	
			else
			{
				return false;
			}
	}

	private function set_session($session_data)
	{
		$sess_data = array(
			'id' => $session_data['id'],
			'name' => $session_data['name'],
			'username' => $session_data['username'],
			'email' => $session_data['email'],
			'logged_in' => 1 );

		$this->session->set_userdata($sess_data);
	}



}
?>