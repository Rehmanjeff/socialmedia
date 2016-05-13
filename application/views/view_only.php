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
		 	 		<label for="">Title: &nbsp;</label><b><?php echo $key->title; ?></b>
		 	 		<br>
		 	 		<label for="">Article: </label>
		 	 		<pre>
		 	 			<?php echo $key->article; ?>
		 	 		</pre>
		 	 		<br>
		 	 		<hr>
		 	 		<?php endforeach; } else{ echo "Nothing to display";}?>
		 	 </div>
		</div>
	</div>
</div>