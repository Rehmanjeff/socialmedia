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
<script type="text/javascript">

	/*		// Ajax post
			$(document).ready(function()
			{
				window.alert("Entered into the function ");

				$("#submit").click(function(event)
				{
					event.preventDefault();
					var hiddenValue = $("#hiddenValue").val();
                	alert(hiddenValue);
                	var title = $("input#title").val();
					var select = $("input#catagory").val();
					var article = $("input#articletext").val();
					jQuery.ajax(
					{
						type: "POST",
						url: "<?php echo base_url(); ?>" + "index.php/add_post/submit_post",
						dataType: 'json',
						data: {hiddenValue : hiddenValue, catagory: catagory, title: title, articletext : articletext},

						success: function(res)
						{
							// console.log(res);
							// window.alert("i got some data ");
							if (res)
							{
								// window.alert("Read and sent successfully ");
								// Show Entered Value
								jQuery("div#result").show();
								// jQuery("div#hiddenValue").show();
								// jQuery("div#display_name").html(res.display_name);
								// jQuery("div#username").html(res.username);
								// jQuery("div#email").html(res.email);
							}
						}
					});
				});
			});*/
		</script>
<div class="container">
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
					function CheckColors(val){
					 var element=document.getElementById('color');
					 if(id=='others')
					   element.style.display='block';
					 else  
					   element.style.display='none';
					}

				</script> 
			       <select name="catagory_select" class="selectpicker form-control" style=" width: 150px;" onchange='CheckColors(this.value);'> 
				    <option>Select Catagory</option>  
				    <?php
						foreach ($query->result() as $key):
				    ?>
				    <option value="<?php echo $key->cat_id; ?>"><?php echo $key->cat_name; ?></option>
				    <?php endforeach; ?>
				    <option id="others">others</option>
				  </select>
				  <br>
				<input type="text" placeholder="Enter Catagory Name" class="form-control"  name="cat" id="color" style='/*display:none;*/ width: 170px;'/>

			     <br>
				<label for="sel1">Article:</label>
				<textarea class="form-control" name="articletext" id="" cols="80" rows="10"></textarea>
				<br>
				<input class="btn btn-primary "  value="Submit Article" id="submit" type="submit" style="float:right;" />
				</div>
			</form>
		</div>
	</div>
</div>