<?php
class Form extends CI_Controller {

        public function index()
        {

                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required',
                        array('required' => 'You must provide a %s.')
                );

                
                if ($this->form_validation->run() === FALSE)
                {
                        $this->load->view('layouts/header');
                        $this->load->view('welcome_message');
                        $this->load->view('layouts/footer');
                }
                else
                {

                        $this->load->view('layouts/header');
                        $this->load->view('account/user');
                        $this->load->view('layouts/footer');
                }
        }
}
?>