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
					// $this->output->enable_profiler(TRUE);    	
?>
<div class="container">
<div class="row">
	<?php include('navbar.php'); 
	?>
</div>

<div class="container">
	<div class="row">

		<div class="col-md-2">
			<!-- <?php form_open('display_articles', array('id' => 'recommendForm'));?> -->
			 	
			 	<form action="display_articles" method="post">
			 	<select name="catagory_select" class="selectpicker form-control" style=" width: 150px;"> 
				    <option>Select Catagory</option>  
				    <?php
						foreach ($query->result() as $key):
				    ?>
				    <option value="<?php echo $key->cat_id; ?>"> <?php echo $key->cat_name; ?></option>
				    <?php endforeach; ?>
				</select>
				
				<br>
				<input class="btn btn-primary" type="submit" value="Submit">
			</form>
		</div>

		 	 <div class="col-md-2 col-md-offset-5">
		 	 	<?php 
		 	 	if(isset($data)) 
		 	 	{
		 	 		foreach ($data->result() as $key): ?>
		 	 		<label for="">Title: </label><?php echo $key->title; ?>
		 	 		<br>
		 	 		<label for="">Article: </label>
		 	 		<p>
		 	 			<?php echo $key->article; ?>
		 	 		</p>
		 	 		<br>
		 	 		<hr>
		 	 		<?php endforeach; 
		 	 	 } else echo "No cat selected yet"; ?>
		 	 </div>
		</div>
	</div>
</div>