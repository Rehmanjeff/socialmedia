<?php
/**
* 
*/
class Logout extends CI_Controller
{
	
	public function __construct()
	{
		# code...
		parent::__construct();
	
	}

	public function index()
	{
		$user_data = $this->session->all_userdata();
        foreach ($user_data as $key) {
                $this->session->unset_userdata($key);
        
        }
    	$this->session->sess_destroy();
    	redirect('/','location');
	}

}
?>