<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
	<h1>Welcome to Login System</h1>
	
	
	<div class="col-xs-4">
	<div class="form-group">
	<?php echo form_open('form');
		echo validation_errors(); 
		
		echo form_label('username:'); 
		$data = array(
			'type' => 'text',
			'name' => 'username',
			'class' => 'form-control',
		);

		echo form_input($data);
		
		echo form_label('password:');
		$data = array(
			'type' => 'password',
			'name' => 'password',
			'class' => 'form-control'
			 );
		echo form_input($data);
	?>

		<br><input type="submit" value="Submit" name="submit" class="btn btn-primary" />
		
	</form>
	<a href="<?php echo base_url();?>index.php/register">Not Registerd yet?</a>
	</div>
	</div>
</div>
