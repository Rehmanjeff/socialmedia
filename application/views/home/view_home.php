<?php
if($logged_in)
{
	$name = $this->session->userdata('name');
	echo "<h2>Welcome to the homepage , {$name} </h2>";
	echo "We have nothing else right now, so ";
	echo form_open('logout');
	?>
	<input class="btn btn-danger" value="Logout"  type="submit"/></form>
	
<?php
}
else
{
	$this->load->view("layouts/header");
	$this->load->view("login/view_login");
	$this->load->view("layouts/footer");
}

?>