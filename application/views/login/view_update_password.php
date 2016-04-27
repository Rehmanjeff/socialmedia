<div class="container">
	<div class="row">
		<h2>Update Password Form</h2>
	</div>
	<div class="col-xs">

	<?php echo form_open('login/update_password');?>
		<div class="form-group col-xs-3">
			<div >
				<label for="">Email</label>
				<?php if(isset($email_hash,$email_code)) {?>
				
				<input type="hidden" value="<?php echo $email_hash; ?>" name="email_hash" />

				<input type="hidden" value="<?php echo $email_code; ?>" name="email_code" />
				<?php } ?>
				<input class="form-control" type="email" value="<?php echo (isset($email)) ? $email : ''; ?>" name="email" />
				<br>
			</div>

			<div>
				<label for="">New Password</label>
				<input  class="form-control" type="password" value="" name="new-password" placeholder="Enter New Password" />
				<br>
			</div>
			
			<div>
				<label for="">New Password again</label>
				<input  class="form-control" type="password" value="" name="new-password-again" placeholder="Confirm New Password" /> <br>
			</div>
			
			<div>
				<input class="btn btn-primary" type="submit" value="Update Password" name="submit"/>
			</div>
		</div>
		</form>
		<?php 
		echo validation_errors();
		if(isset($error))
			echo $error;
		?>
	</div>
</div>
