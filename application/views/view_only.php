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
		 	 	<?php 
		 	 	if (!empty($data)) {
		 	 		foreach ($data->result() as $key): ?>
		 	 		<label for="">Title: </label><?php echo $key->title; ?>
		 	 		<br>
		 	 		<label for="">Article: </label>
		 	 		<p>
		 	 			<?php echo $key->article; ?>
		 	 		</p>
		 	 		<br>
		 	 		<hr>
		 	 		<?php endforeach; } else{ echo "Nothing to display";}?>
		 	 </div>
		</div>
	</div>
</div>