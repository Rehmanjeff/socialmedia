<?php

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                // $this->load->helper(array('form', 'url'));
                $this->load->library('upload');
        }

        public function index()
        {
                $this->load->view('layouts/header');
                $this->load->view('home_page', array('error' => ' ' ));
                $this->load->view('layouts/footer');
        }

        public function do_upload()
        {
                
                $config['upload_path']          = './uploads/'; #$this->config->item('base_url').
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                // $config['max_size']             = 100;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                // $this->load->library('upload', $config);

                $this->upload->initialize($config);
                
                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('layouts/header');
                        $this->load->view('home_page', $error);
                        $this->load->view('layouts/footer');
                }
                else
                {
                        $session_data = $this->session->userdata('logged_in');
                        $id =  $session_data['id'];

                        $image_name = $this->upload->data('file_name');
                        $this->model_edit->update_dp($id, $image_name);

                        // $img_name = array('image' => $image_name );
                        // $this->session->set_userdata('img_name');

                        $this->session->set_userdata('image', $image_name);

                        // $data['img'] = base_url().'upload/'.
                        /*if ($image_name) 
                        {
                                $data['img'] = $image_name;
                                $this->load->view('layouts/header');
                                $this->load->view('home_page',$data);
                                $this->load->view('layouts/footer');
                        }
                        else
                        {
                                $error = "Couldn't fetch image";
                                $this->load->view('layouts/header');
                                $this->load->view('home_page',$error);
                                $this->load->view('layouts/footer');
                        }*/
                        redirect("account");
                }
        }
}
?>