<?php
$this->load->helper('url');
$base_url = base_url();
?>
<div id="content">
    <div id="latest_product_gallery">
		<h2>our Gallery </h2>

    </div>
    <!-- end of latest_content_gallery -->
    <div class="content_section">
		<div class="sidebar_section">
			<h2>Register</h2>
			<form action="<?php echo base_url(); ?>index.php/GGHome/Addmember" method="post">
				<label>f Name</label>
				<input type="text" value="" name="fName" class="input_field" />
				<?php echo form_error('fName'); ?>
				<label>l Name</label>
				<input type="text" value="" name="lName" class="input_field" />
				<?php echo form_error('lName'); ?>
				<label>password</label>
				<input type="password" value="" name="password"  class="input_field" /> 
				<?php echo form_error('password'); ?>
				<label>phone</label>
				<input type="number" value="" name="phone" class="input_field" />
				<?php echo form_error('phone'); ?>
				<label>email Address</label>
				<input type="text" value="" name="emailAddress"  class="input_field" />
				<?php echo form_error('emailAddress'); ?>
				<label>address Line 1</label>
				<input type="text" value="" name="addressLine1" class="input_field" />
				<?php echo form_error('addressLine1'); ?>
				<label>address Line 2</label>
				<input type="text" value="" name="addressLine2" class="input_field" />
				<?php echo form_error('addressLine2'); ?>
				<label>address Line 3</label>
				<input type="text" value="" name="addressLine3" class="input_field" />
				<?php echo form_error('addressLine3'); ?>
				<label>city</label>
				<input type="text" value="" name="city" class="input_field" />
				<?php echo form_error('city'); ?>
				<label>county</label>
				<input type="text" value="" name="county" class="input_field" />
				<?php echo form_error('county'); ?>
				<label>country</label>
				<input type="text" value="" name="country"  class="input_field" />
				<?php echo form_error('country'); ?>
				<label>subscribe</label>
				<input type="text" value="" name="subscribe" class="input_field" />
				<?php echo form_error('subscribe'); ?>
				<input type="submit" name="submit" value="submit" alt="submit" id="submit_btn" />
			</form>
			<div class="cleaner"></div>
		</div>
	</div>
</div>