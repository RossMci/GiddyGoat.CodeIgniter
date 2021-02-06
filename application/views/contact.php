<?php
$this->load->helper('url'); 
$base_url = base_url();
$local_style = base_url()."assets/";
$image_url = base_url()."assets/images/";
$css_url = $base_url."assets/stylesheet/";
$script_url = base_url()."assets/scripts/";
?>

<?php include('partials/header_view.php'); ?>

<?php //include('partials/aside.php'); ?>
<div id="wrapper">
<?php echo $content ?>
</div>
<?php include('partials/footer_view.php'); ?> 