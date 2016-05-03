<?php
	$session_data = $this->session->userdata('logged_in');
?>
<div class="container">
	<div class="row">
		<?php include('navbar.php'); ?>
	</div>
	<div class="row">
	<h3 class=" text-center"> Update User Information</h3>
	<br>
		<div class="col-xs-5">
		<script type="text/javascript">

			// Ajax post
			$(document).ready(function()
			{
				// window.alert("Entered into the function ");

				$("#submit").click(function(event)
				{
					event.preventDefault();
					var hiddenValue = $("#hiddenValue").val();
                	// alert(hiddenValue);
                	var display_name = $("input#user-name").val();
					var username = $("input#username").val();
					var email = $("input#email").val();
					jQuery.ajax(
					{
						type: "POST",
						url: "<?php echo base_url(); ?>" + "index.php/edit/update_user",
						dataType: 'json',
						data: {hiddenValue : hiddenValue,'user-name': display_name, username: username, email : email},

						success: function(res)
						{
							// console.log(res);
							// window.alert("i got some data ");
							if (res)
							{
								// window.alert("Read and sent successfully ");
								// Show Entered Value
								jQuery("div#result").show();
								jQuery("div#hiddenValue").show();
								jQuery("div#display_name").html(res.display_name);
								jQuery("div#username").html(res.username);
								jQuery("div#email").html(res.email);
							}
						}
					});
				});
			});
		</script>
		<?php
		echo validation_errors();
		echo form_open();?>
			<div class="form-group">
			<?php
			if (isset($message)) {
			 	echo $msg;
			 }
			?>
				<label>Display Name: </label>
				<input type="hidden" name="hiddenValue" id="hiddenValue" value="<?php echo $session_data['id']; ?>">
				<br>
				<input type="text" class="form-control" id="user-name" name="user-name" value="<?php echo $session_data['name'];?>"><br>
				<label>Username: </label>
				<br>
				<input type="text" class="form-control" id="username" name="username" value="<?php echo $session_data['username']; ?>"><br>
				<label>Email: </label>
				<br>
				<input type="email" class="form-control" id="email" name="email" value="<?php echo $session_data['email'];?>">
				<br>
				<input type="submit" id="submit" for="submit" value="Update" class="btn btn-primary">
			</div>

		</div>
		<div class="col-xs-5">
			<?php

				// Display Result Using Ajax
				echo "<div id='result' style='display: none'>";

				echo "<div class='alert alert-success' role='alert'>Well done! You successfully read this important alert message....</div>";
				echo "<div id='content_result'>";
				echo "<h3 id='result_id'>You have submitted these values</h3><br/><hr>";
				echo "<div id='result_show'>";
				echo "<label class='label_output'>User ID :<div id='hiddenValue'> </div></label>";
				echo "<br>";
				echo "<br>";
				echo "<label class='label_output'>Display Name :<div id='display_name'> </div></label>";
				echo "<br>";
				echo "<br>";
				echo "<label class='label_output'>User Name :<div id='username'> </div></label>";
				echo "<br>";
				echo "<br>";
				echo "<label class='label_output'>Email :<div id='email'> </div></label>";
				echo "<div>";
				echo "</div>";
				echo "</div>";
				?>
		</div>
	</div>
</div>
