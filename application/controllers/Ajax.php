<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
	public function index()
	{
	    $target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["userfile"]["name"]);
		$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
		$imagename = $_FILES['userfile']['name'];
		$size = $_FILES['userfile']['size'];
		$ext = strtolower($this->getExtension($imagename));
		if(in_array($ext,$valid_formats))
		{
			if($size<(1024*1024)) // Image size max 1 MB
			{
				$actual_image_name = time().".".$ext;
				$uploades_img_temp_name = $_FILES["userfile"]["tmp_name"];
				//$widthArray = array(200,100,50); //You can change dimension here.
				//foreach($widthArray as $newwidth)
				//{
				$newwidth = 200;
				
					$filename=$this->compressImage($ext,$uploades_img_temp_name,$target_dir,$actual_image_name,$newwidth);
					$this->session->set_userdata('img_temp', $filename);
					//echo "<img src='".$filename."' class='img'/>";
				//}
				if (move_uploaded_file($uploades_img_temp_name, $target_dir.$actual_image_name)) {
					//echo $_FILES["profile_img"]["name"];
					$this->session->set_userdata('main_temp', $target_dir.$actual_image_name);


                        $session_data = $this->session->userdata('logged_in');
                        $id =  $session_data['id'];
                        // $imagename = $filename;
                        // after insertion in DB it doesn't come back
                        $result = $this->model_edit->update_dp($id, $actual_image_name);
                        echo $filename;


				}else{
					echo "Sorry, there was an error uploading your file.";
				}
			}else{
				echo "Image file size max 1 MB"; 
			}
		}else{
			echo "Invalid file format.."; 
		}
	}
	public function set_upload_options() {
        $config = array();
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['overwrite'] = FALSE;
        return $config;
    }

	public function getExtension($str)
	{
		$i = strrpos($str,".");
		if (!$i)
		{
		return "";
		}	
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}
	public function compressImage($ext,$uploadedfile,$target_dir,$actual_image_name,$newwidth)
	{
		if($ext=="jpg" || $ext=="jpeg" )
		{
		$src = imagecreatefromjpeg($uploadedfile);
		}
		else if($ext=="png")
		{
		$src = imagecreatefrompng($uploadedfile);
		}
		else if($ext=="gif")
		{
		$src = imagecreatefromgif($uploadedfile);
		}
		else
		{
		$src = imagecreatefrombmp($uploadedfile);
		}
        $thumbs_dir = $target_dir."thumbs/";	
		list($width,$height)=getimagesize($uploadedfile);
		$newheight=($height/$width)*$newwidth;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		$filename = $thumbs_dir.$newwidth.'_'.$actual_image_name; //PixelSize_TimeStamp.jpg
		imagejpeg($tmp,$filename,100);
		imagedestroy($tmp);
		return $filename;
	}
	public function deleteimg(){
		
		unlink($this->session->userdata('img_temp'));
		unlink($this->session->userdata('main_temp'));
		$this->session->sess_destroy();
		}
	
}