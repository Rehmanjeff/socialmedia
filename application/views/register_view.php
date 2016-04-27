<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
		<div class="row">
		<div class="col-xs-5">
<?php		
	echo validation_errors(); 
	echo form_open('register/register_user');?>
	
			<h2>Registeration</h2>
		<br>
		<div class="form-group">
	
		<?php 
		
		echo form_label('name:');	
		$data = array(
			'type' => 'text',
			'name' => 'user-name',
			'class' => 'form-control'
			);		
		echo form_input($data)."<br>";


		echo form_label('username:');	
		$data = array(
			'type' => 'text',
			'name' => 'username',
			'class' => 'form-control'
			);		
		echo form_input($data)."<br>";


		echo form_label('password:');	
		$data = array(
			'type' => 'password',
			'name' => 'user-password',
			'class' => 'form-control'
			);
		
		echo form_input($data)."<br>";
		

		echo form_label('confirm password:');	
		$data = array(
			'type' => 'password',
			'name' => 'passwordconf',
			'class' => 'form-control'
			);
		echo form_input($data)."<br>";


		echo form_label('email:');	
		$data = array(
			'type' => 'email',
			'name' => 'email',
			'class' => 'form-control'
			);
		echo form_input($data);
?>
		<br><input type="submit" value="Register" name="register" class="btn btn-primary" />
		<br><br><a href="<?php echo base_url();?>index.php/login">Already have Account?</a>

		</div>
	</div>