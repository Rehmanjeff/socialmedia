<?php
	$session_data = $this->session->userdata('logged_in');
			
			/*$data = array();
			foreach ($query->result() as $key) 
			{
			print_r($key);
			// echo "<br>";
				$data[] = $key;
			}
			// print_r($data);
			die();*/
					    	
?>
<div class="container">
<div class="row">
	<?php include('navbar.php'); 
	?>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-8">
		 	<?php //echo $img;
				//	die(); 
		 	 
		 	 	foreach ($data->result() as $key):  ?>
					<div class="col-xs-9">
						<img id="article_image" class="img_pre img-responsive" src="<?php

						$no_img = "upload_article_image.png";
						
						if($key->article_image)
							{
								echo base_url(); ?>uploads/article_img/<?php echo $key->article_image; 
							}
						else
							{ 
								echo base_url(); ?>uploads/<?php echo $no_img; 
							} 
						// if(empty($key->article_image)){
						// 	echo $no_img;
						// }
						?>" 

						width="170" height="150"/>
					</div>
					<div class="text_article col-xs-8">
				 	 	<?php 
				 	 	if (!empty($data)) { ?>
				 	 		<div class="td-module-data" style=" ">
				 	 		<h3><?php echo $key->title; ?></h3>
				 	 		<br>
				 	 			<?php echo $key->article; ?>
				 	 		</div>
				 	 		<br>
				 	 		<hr>
				 	 		<?php  } else{ echo "Nothing to display";} ?>
				 	</div> 
		 	 	<?php endforeach; ?>
		 	 </div>
		</div>
	</div>
</div>