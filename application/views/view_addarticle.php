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
				  <div id="admDivCheck" style="display: none;">
					<input type="text" placeholder="Enter Catagory Name" class="form-control"  name="cat" id="color" style='width: 170px;'/>
					</div>
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