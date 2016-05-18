<?php
	$session_data = $this->session->userdata('logged_in');
	$check = $this->session->userdata('remember_me');

?>
<div class="container">
<div class="row">

		<div class="bs-example">
    <nav role="navigation" class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="<?php echo base_url();?>account" class="navbar-brand">Login System</a> <!--<?php echo base_url();?>index.php/ -->
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo base_url();?>account">Home</a></li> <!-- <?php echo base_url();?>index.php/-->
                <li><a href="<?php echo base_url();?>article/articles_view">Articles</a></li> <!-- <?php echo base_url();?>index.php/-->
                <!-- <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Messages <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="#">Inbox</a></li>
                        <li><a href="#">Drafts</a></li>
                        <li><a href="#">Sent Items</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Trash</a></li>
                    </ul>
                </li> -->
                
                    <?php
                        foreach ($query->result() as $key):
                    ?>
                    <li><a href="<?php echo 'display_articles/'.$key->cat_name; ?>"><?php echo $key->cat_name; ?></a></li> <!-- value="<?php echo $key->cat_id; ?>"> <?php echo $key->cat_name; ?></option> -->
                    <?php endforeach; ?>
                
            </ul>
            <form role="search" class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" placeholder="Search" class="form-control">
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url();?>logout">Logout</a></li> <!-- <?php echo base_url();?>index.php/ -->
            </ul>
        </div>
    </nav>
</div>

	
<script type="text/javascript">
    $(document).ready(function() {
    	// alert('first function');
			$('#pfile').change(function() {
				$("form#frm1").submit();
			});
			
	        $("form#frm1").submit(function() {
				//alert('Done');
			$('.img_pre').attr('src','<?php echo base_url(); ?>uploads/ProgressBar.gif');
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url(); ?>ajax',
                type: 'POST',
                data: formData,
                async: false,
                success: function(data) {
                    // alert(data);
					//$('.img_pre').attr('src', '<?php echo base_url(); ?>uploads/'+data);
					setTimeout(function () { 

					$('.img_pre').attr('src', data);
						$('.dltbtn').show();
						}, 3000);
					//$('.img_pre').attr('src',data);
                },
				error: function(data)
				{
					// console.log(data);
                	console.log("error");
                	// console.log(data);
				    alert("Error :"+data);
                },
                cache: false,
                contentType: false,
                processData: false
            });

            return false;
        });

    });
	</script>
	
	<script type="text/javascript">
	</script>
	
	<script type="text/javascript">
	</script>
<!-- 
	After user press submit button this function will send data to store in db
-->

</div>
	<div class="row">
		<div class="col-xs-10">
			<?php

				// if ($check) 
				// {?>
				<div class="row">
				  <div class="col-xs-4">
					  <form name="frm1" id="frm1" action="#" method="post" enctype="multipart/form-data">
					    <div>
							<table>
							<?php //echo $img;
									//	die(); ?>
								<tr>
									<th colspan="2">
										<img class="img_pre" src="<?php
										$no_img = "upload_profile.png";
										
										if(isset($img))
											{
												echo base_url(); ?>uploads/<?php echo $img; 
											}
										else
											{ 
												echo base_url(); ?>uploads/<?php echo $no_img; 
											} 
										if(!$img){echo $no_img;}

										?>" 
										width="170" height="150"/>
										<!-- <img src="<?php echo base_url();?>uploads/Delete_image.png" class="dltbtn" style="display:none" /> -->
									</th>
								</tr>
								<tr>
									<th colspan="2">
									<br>
									<input type="file" name="userfile" id="pfile" required="required" />
									</th>
								</tr>	
									</table>
						    </div>
						   <!--  -->
						</form>
					<?php if(isset($error))echo $error;
					// echo form_open_multipart('upload/do_upload');?>
					<!-- <form enctype="multipart/form-data" accept-charset="utf-8" name="formname" id="formname"  method="post" action="">
					
					<input type="file" name="userfile"/>
					<br />
					<input type="submit" name="submit" id="upload_file"; value="upload" />

					</form> -->
				  <hr>
				  </div>
				  <div class="col-xs-6">


				  </div>
				</div>

				<div class="row">  
				  <div class="col-xs-4 col-xs-3">
				  <label class="text-center"> User Information </label><a href="edit"><span class="glyphicon glyphicon-pencil pull-right"></span></a>
				  <br><br>
				  	<label>Email: </label>
				  	<br>
				  	<?php echo $session_data['email'];?>
				  	<br><br>
				  	<label>Display Name: </label>
				  	<br>
				  	<?php echo $session_data['name'];?>
				  	<br><br>
				  	<label>Username: </label>
				  	<br>
				  	<?php echo $session_data['username'];?>
				  	<br><br>
				  	<a href="logout">Logout</a>
				  </div>
				 </div>

				<?php
					  
				// }
				// else
				// {
				// 	// session_set_cookie_params(0);
				// 	 // include('browser_triger.php');
				// 	 $session_data['username'];
				// 	 $session_data['name'];
				// 	 $session_data['email'];
				// }
			?>
		</div>
	</div>
</div>
<b id="logout"></b>