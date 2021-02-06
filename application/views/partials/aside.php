<div class="cleaner"></div>
<div id="sidebar">
	<div class="sidebar_top"></div>
	<div class="sidebar_bottom"></div>
	<div class="sidebar_section">
		<h2>Members</h2>

		<!--		<form action="<?php // echo base_url(); 
									?>index.php/GGLogin/index" method="post">-->
		<?php
		// checks if the user is logged in and changes the button to show the log out in function if the user is logged in 
		if ($this->session->userdata('UserId') != null) {
			echo '<form action="' . site_url("GGLogin/logout") . '" method="post">
			          <h3> Hi your logined in</h3>
				     <input type="submit" name="logout" value="logout" alt="submit" id="submit_btn" />
				      </form>';
		} else {
			$usernameValue = isset($emailAddress) ? 'value="' . $emailAddress . '"' : "";
			echo
			'<form action="' . site_url("GGLogin/index") . '" method="post">
				<label>Username</label>
				 <input type="text" name="emailAddress" size="10" class="input_field" ' . $usernameValue . '/>';
				 echo form_error('emailAddress');
				 echo '<label>Password</label>
				 <input type="password" value="" name="password" class="input_field" />	';
				 echo form_error('password');
				 echo'
			       <input type="submit" name="Login" value="Login" alt="submit" id="submit_btn" />
				   	<a href="' . site_url('GGHome/Register') . '">Register</a> 
						</form>';
		}
		?>
		<?php if (isset($error)) { ?>
			<p class="error"><?php echo $error ?></p>
		<?php } ?>

		<!--		</form>-->
		<div class="cleaner"></div>
	</div>
	<div class="sidebar_section">
		<h2>Categories</h2>
		<ul class="categories_list">
			<li><a href="#">Adult and Children Classes</a></li>
			<li><a href="#">Fabrics</a></li>
			<li><a href="#">Notions</a></li>
			<li><a href="#">Gallery</a></li>
			<li><a href="#">Contact</a></li>
		</ul>
	</div>
	<div class="sidebar_section">
		<h2>Special Offers</h2>
		<div class="image_wrapper"><a href="#"><img src="<?php echo $base_url . "assets/images/image_01.jpg" ?>" alt="" /></a></div>
		<div class="discount"><span>25% off</span> | <a href="#">Read more</a></div>
	</div>
</div>