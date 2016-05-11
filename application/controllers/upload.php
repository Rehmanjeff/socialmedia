<?php

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                // $this->load->helper(array('form', 'url'));
                $this->load->library('upload');
                $session_data = $this->session->userdata('logged_in');
        }

        public function index()
        {
                $this->load->view('layouts/header');
                $this->load->view('home_page', array('error' => ' ' ));
                $this->load->view('layouts/footer');
        }

        public function do_upload()
        {
                $session_data = $this->session->userdata('logged_in');
                        $id =  $session_data['id'];
                        // print_r($formData);
                        // die();
                 $data['results'] = $this->model_edit->update_dp();
    $this->output->set_output(json_encode($data));
        }
}
?>