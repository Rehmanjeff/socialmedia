<div class="container">
	<div class="row">
		<h2>Password Reset</h2>
	</div>
	<div class="col-xs">

	<div class="form-group">
	<div class="col-xs-3">
	<?php echo form_open('login/reset_password');?>
			<div >
				<label for="">Email</label>
				<input class="form-control" type="email" value="<?php echo set_value('email'); ?>" name="email" />
				<br>
			</div>
			<div>
				<input type="submit" value="submit" name="submit" class="btn btn-primary" />
			</div>
		</form>
			</div>
	</div>
		<?php 
		echo validation_errors();
		if(isset($error))
			echo $error;
		?>
	</div>
</div>
