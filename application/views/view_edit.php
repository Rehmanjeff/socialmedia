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
		<?php
		echo validation_errors(); 
		echo form_open('edit/update_user');?>
			<div class="form-group">
			<?php
			if (isset($message)) {
			 	echo $msg;
			 } 
			?>
				<label>Display Name: </label>
				<input type="hidden" name="user_id" value="<?php echo $session_data['id']; ?>">
				<br>
				<input type="text" class="form-control" name="user-name" value="<?php echo $session_data['name'];?>"><br>
				<label>Username: </label>
				<br>
				<input type="text" class="form-control" name="username" value="<?php echo $session_data['username'];?>"><br>
				<label>Email: </label>
				<br>
				<input type="email" class="form-control" name="email" value="<?php echo $session_data['email'];?>">
				<br>
				<input type="submit" value="Update" class="btn btn-primary">
			</div>
		</div>
	</div>
</div>