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
					<div class = "upload-image-messages"></div>

					<div class = "col-md-6">
				        <!-- Generate the form using form helper function: form_open_multipart(); -->
				        <?php echo form_open_multipart('upload/do_upload', array('class' => 'upload-image-form'));?>
				            <input type="file" multiple = "multiple" accept = "image/*" class = "form-control" name="uploadfile[]" size="20" /><br />
				            <input type="submit" name = "submit" value="Upload" class = "btn btn-primary" />
				        </form>

				        <script>                   
				        jQuery(document).ready(function($) {

				            var options = {
				                beforeSend: function(){
				                    // Replace this with your loading gif image
				                    $(".upload-image-messages").html('<p><img src = "<?php echo base_url() ?>images/loading.gif" class = "loader" /></p>');
				                },
				                complete: function(response){
				                    // Output AJAX response to the div container
				                    $(".upload-image-messages").html(response.responseText);
				                    $('html, body').animate({scrollTop: $(".upload-image-messages").offset().top-100}, 150);
				                   
				                }
				            }; 
				            // Submit the form
				            $(".upload-image-form").ajaxForm(options); 

				            return false;
				           
				        });
				        </script>
				    </div>
					
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