<?php
	$session_data = $this->session->userdata('logged_in');
	$check = $this->session->userdata('remember_me');

?>
<div class="container">
<div class="row">
	<?php include('navbar.php'); ?>
	
<script type="text/javascript">
    $(document).ready(function() {
    	// alert('first function');
			$('#pfile').change(function() {
				$("form#frm1").submit();
			});
			
	        $("form#frm1").submit(function() {
				//alert('Done');
			$('.img_pre').attr('src','<?php echo base_url(); ?>uploads/ProgressBar.gif');
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url(); ?>ajax',
                type: 'POST',
                data: formData,
                async: false,
                success: function(data) {
                    // alert(data);
					//$('.img_pre').attr('src', '<?php echo base_url(); ?>uploads/'+data);
					setTimeout(function () { 

					$('.img_pre').attr('src', data);
						$('.dltbtn').show();
						}, 3000);
					//$('.img_pre').attr('src',data);
                },
				error: function(data)
				{
					// console.log(data);
                	console.log("error");
                	// console.log(data);
				    alert("Error :"+data);
                },
                cache: false,
                contentType: false,
                processData: false
            });

            return false;
        });

    });
	</script>
	
	<script type="text/javascript">
	</script>
	
	<script type="text/javascript">
	</script>
<!-- 
	After user press submit button this function will send data to store in db
-->

</div>
	<div class="row">
		<div class="col-xs-10">
			<?php

				// if ($check) 
				// {?>
				<div class="row">
				  <div class="col-xs-4">
					  <form name="frm1" id="frm1" action="#" method="post" enctype="multipart/form-data">
					    <div>
							<table>
							<?php //echo $img;
									//	die(); ?>
								<tr>
									<th colspan="2">
										<img class="img_pre" src="<?php
										$no_img = "upload_profile.png";
										
										if(isset($img))
											{
												echo base_url(); ?>uploads/<?php echo $img; 
											}
										else
											{ 
												echo base_url(); ?>uploads/<?php echo $no_img; 
											} 
										if(!$img){echo $no_img;}

										?>" 
										width="170" height="150"/>
										<!-- <img src="<?php echo base_url();?>uploads/Delete_image.png" class="dltbtn" style="display:none" /> -->
									</th>
								</tr>
								<tr>
									<th colspan="2">
									<br>
									<input type="file" name="userfile" id="pfile" required="required" />
									</th>
								</tr>	
									</table>
						    </div>
						   <!--  -->
						</form>
					<?php if(isset($error))echo $error;
					// echo form_open_multipart('upload/do_upload');?>
					<!-- <form enctype="multipart/form-data" accept-charset="utf-8" name="formname" id="formname"  method="post" action="">
					
					<input type="file" name="userfile"/>
					<br />
					<input type="submit" name="submit" id="upload_file"; value="upload" />

					</form> -->
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