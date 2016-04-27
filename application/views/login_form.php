<?php
if (isset($logout_message)) {
echo "<div class='message'>";
echo $logout_message;
echo "</div>";
}
?>
<?php
if (isset($message_display)) {
echo "<div class='message'>";
echo $message_display;
echo "</div>";
}
?>
<div id="main">
<div id="login">
<h2>Welcome to Login system</h2>
<?php echo form_open('user_authentication/user_login_process'); ?>
<?php
echo "<div class='error_msg'>";
if (isset($error_message)) {
echo $error_message;
}
echo validation_errors();
echo "</div>";
?>
<div class="form-group">
<div class="col-xs-3">
<label>UserName :</label>
<input type="text" name="username" id="name" placeholder="username" class="form-control " /><br>
<label>Password :</label>
<input type="password" name="password" id="password" placeholder="**********" class="form-control" /><br>
<input type="checkbox" name="remember_me"/> Remember Me<br>
<input type="submit" value=" Login " name="submit" class="btn btn-primary" /><br>

	<a href="<?php echo base_url();?>index.php/register">Not Registerd yet?</a><br>
		<a href="<?php echo base_url();?>index.php/login/reset_password">Forgot Password?</a>
</div>
</div>
<?php echo form_close(); ?>

</div>
</div>