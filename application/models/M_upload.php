<?php

class M_upload extends CI_Model {

    public function set_upload_options() {
        $config = array();
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'docx';
        //$config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
    }

   

    public function do_upload($files, $input) {
        $images[] = '';
        $files = $files[$input];
        $cpt = count($files['name']);
        for ($i = 0; $i < $cpt; $i++) {
            $name = date('dmyhis').'.docx';
            $type = $files['type'][$i];
            $tmp_name = $files['tmp_name'][$i];
            $error = $files['error'][$i];
            $size = $files['size'][$i];

            $_FILES[$input]['name'] = $name;
            $_FILES[$input]['type'] = $type;
            $_FILES[$input]['tmp_name'] = $tmp_name;
            $_FILES[$input]['error'] = $error;
            $_FILES[$input]['size'] = $size;


            //upload and thumb
            $this->upload->initialize($this->set_upload_options());
            $this->upload->do_upload();
           // $this->resize_image($name, '250', '250');
            $images[$i] = $name;
        }
        return  $images;
    }

    
}

?>