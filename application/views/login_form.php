<style>

body {
    margin: 0;
    display: block;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #eee;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    background-color: #fff;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css"/>
	<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>‌​
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
<?php
	if (isset($logout_message)) 
	{
		echo '<div class="alert alert-info" role="alert">';
		echo $logout_message;
		echo "</div>";
	}
?>

<div class="container">
	<div class="row">
	<?php 

		
		if (isset($error_message)) 
		{
			
		echo "<div class='alert alert-danger' role='alert'>";
			echo $error_message;
	echo "</div>";
			
		}
		
		echo validation_errors();
	
	?>
	<?php
$message = $this->session->flashdata('message');
if (isset($message)) {
	echo "<div class='alert alert-danger' role='alert'>";
	echo $message;
	echo "</div>";
}
	if (isset($message_display)) 
	{
		echo "<div class='alert alert-danger' role='alert'>";
		echo $message_display;
		echo "</div>";
	}
?>
		<h2 style="margin-left: 12px;">Please Signin</h2>
		<?php echo form_open('user_authentication/user_login_process', array('class' => 'form-signin' ));?>
		<div class="form-group">
			<div class="col-xs-3">
				<label>UserName :</label>
					<input type="text" name="username" id="name" placeholder="username" class="form-control " /><br>
				
				<label>Password :</label>
					<input type="password" name="password" id="password" placeholder="**********" class="form-control" /><br>
					<input type="checkbox" name="remember_me"/> Remember Me<br>
					<input type="submit" value=" Login " name="submit" class="btn btn-primary" /><br>

				<a href="<?php echo base_url();?>register">Not Registerd yet?</a><br>
				<a href="<?php echo base_url();?>login/reset_password">Forgot Password?</a>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
</body>
</html>