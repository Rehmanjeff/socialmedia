<?php
	$session_data = $this->session->userdata('logged_in');
	$check = $this->session->userdata('remember_me');

?>
<div class="container">
<div class="row">
	<?php include('navbar.php'); ?>
	<script>
			// Ajax post
			$(function() {
				$('#upload_file').submit(function(e) {
					e.preventDefault();
					$.ajaxFileUpload({
						url 			:'upload/do_upload', 
						secureuri		:false,
						fileElementId	:'userfile',
						dataType		: 'json',
						data			: {
							'title'				: $('#title').val()
						},
						success	: function (data, status)
						{
							if(data.status != 'error')
							{
								$('#files').html('<p>Reloading files...</p>');
								refresh_files();
								$('#title').val('');
							}
							alert(data.msg);
						}
					});
					return false;
				});
			});
	</script>
</div>
	<div class="row">
		<div class="col-xs-10">
			<?php

				// if ($check) 
				// {?>
				<div class="row">
				  <div class="col-xs-4">
					
					<?php 
					// print_r($session_data);
					if (isset($session_data['image'])) 
					{
						// echo "Successfully Uploaded DP";
						// echo $_SESSION['image'];
					?>
					 
					<img src="<?php echo base_url().'/../uploads/'.$session_data['image']; ?>" width = "170" height="170"/>
					  	</br>
					  	<?php
					  } 
					  else
					  	{
					  		echo "Can't find requested picture from upload controller";
					  		}?>				

					<?php if(isset($error))echo $error;
					// echo form_open_multipart('upload/do_upload');?>
					<form enctype="multipart/form-data" accept-charset="utf-8" name="formname" id="formname"  method="post" action="">
					
					<input type="file" name="userfile"/>
					<br />
					<input type="submit" name="submit" value="upload" />

					</form>
				  <hr>
				  </div>
				  <div class="col-xs-6">


				  </div>
				</div>

				<div class="row">  
				  <div class="col-xs-4 col-xs-3">
				  <label class="text-center"> User Information </label><a href="edit"><span class="glyphicon glyphicon-pencil pull-right"></span></a>
				  <br><br>
				  	<label>Email: </label>
				  	<br>
				  	<?php echo $session_data['email'];?>
				  	<br><br>
				  	<label>Display Name: </label>
				  	<br>
				  	<?php echo $session_data['name'];?>
				  	<br><br>
				  	<label>Username: </label>
				  	<br>
				  	<?php echo $session_data['username'];?>
				  	<br><br>
				  	<a href="logout">Logout</a>
				  </div>
				 </div>

				<?php
					  
				// }
				// else
				// {
				// 	// session_set_cookie_params(0);
				// 	 // include('browser_triger.php');
				// 	 $session_data['username'];
				// 	 $session_data['name'];
				// 	 $session_data['email'];
				// }
			?>
		</div>
	</div>
</div>
<b id="logout"></b>