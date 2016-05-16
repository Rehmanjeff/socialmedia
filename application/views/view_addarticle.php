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
<?php 
if(isset($error))
{
	echo $error;
}
?>
	<div class="row">
		<div class="col-xs-6">
			<?php
				// Display Result Using Ajax
				echo "<div id='result' style='display: none'>";

				echo "<div class='alert alert-success' role='alert'>Well done! You successfully read this important alert message....</div>";
				echo "</div>";
				echo "</div>";
			?>
		</div>
		<div class="col-xs-6">
			<?php		
				echo validation_errors(); 
				echo form_open('article/submit_article'); #'add_post/submit_post'
			?>

			<div class="form-group">
			<input type="hidden" name="hiddenValue" id="hiddenValue" value="<?php echo $session_data['id']; ?>">
				<label for="sel1">Title:</label>
					<input type="text" name="title" class="form-control" placeholder="Title of Article">
				<br>
				<!-- <label for="sel1">Select Catagory:</label> -->
		
			  <script type="text/javascript">
				     function admSelectCheck(nameSelect)
				{
				     console.log(nameSelect);
				    if(nameSelect){
				        admOptionValue = document.getElementById("admOption").value;
				        if(admOptionValue == nameSelect.value){
				            document.getElementById("admDivCheck").style.display = "block";
				        }
				        else{
				            document.getElementById("admDivCheck").style.display = "none";
				        }
				    }
				    else{
				        document.getElementById("admDivCheck").style.display = "none";
				    }
				}
			</script> 


			       <select name="catagory_select" class="selectpicker form-control" style=" width: 150px;" onchange='admSelectCheck(this);' required> 
				    <option>Select Catagory</option>  
				    <?php
				    if (isset($query)) {
				    
						foreach ($query->result() as $key):
				    ?>
				    <option value="<?php echo $key->cat_id; ?>"><?php echo $key->cat_name; ?></option>
				    <?php endforeach; } ?>
				    <option id="admOption">others</option>
				  </select>

				  <br>

				  <script type="text/javascript">
				    $(document).ready(function() {
				    	alert('first function');
							$('#pfile').change(function() {
								$("form#frm1").submit();
								alert('yaba daba do');
							});
							
							$('form#form1').trigger('submit');

					        $("form#frm1").submit(function() {
								alert(' form submitted');
							$('.img_pre').attr('src','<?php echo base_url(); ?>uploads/ProgressBar.gif');
				            var formData = new FormData($(this)[0]);
				            $.ajax({
				                url: '<?php echo base_url(); ?>ajax/article_image',
				                type: 'POST',
				                data: formData,
				                async: false,
				                success: function(data) {
				                    // alert(data);
									//$('.img_pre').attr('src', '<?php echo base_url(); ?>uploads/'+data);
									setTimeout(function () { 

									$('.img_pre').attr('src', data);
										// $('.dltbtn').show();
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
				    
				    <label for="">Select Image:</label><br>
				    <div class="col-xs-4">
				  		<form name="frm1" id="frm1" action="#" method="post" enctype="multipart/form-data">
						    <div>
								<table>
								<?php //echo $img;
										//	die(); ?>
									<tr>
										<th colspan="2">
											<img class="img_pre img-responsive" src="<?php
											$no_img = "upload_article_image.png";
											
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
								<br>
						    </div>
						   <!--  -->
						</form>
						<label for="sel1">Article:</label>
				  </div>
					
				  <div id="admDivCheck" style="display: none;">
					<input type="text" placeholder="Enter Catagory Name" class="form-control"  name="cat" id="color" style='width: 170px;'/>
					</div>
			     <br>
			     <br>
				
				<br>
				<textarea class="form-control" name="articletext" id="" cols="80" rows="10"></textarea>
				<br>
				<input class="btn btn-primary "  value="Submit Article" id="submit" type="submit" style="float:right;" />
				</div>
			</form>
		</div>
	</div>
</div>