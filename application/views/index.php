<?php

$this->load->view('header'); 
$this->load->view('sidebar'); 

$this->load->helper('url'); 

$img_base = base_url();
$base = base_url() .  "/"; 
$controller_base = base_url() . index_page();
?>




    <link href="<?php echo $base . "CI/assets/css/imgslider/js-image-slider.css"?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo $base . "CI/assets/js/imgslider/js-image-slider.js"?>" type="text/javascript"></script>
    <link href="<?php echo $base . "CI/assets/css/imgslider/generic.css"?>" rel="stylesheet" type="text/css" />
</head>
<body>
   
   
    <div id="sliderFrame"> 
        <div id="slider">
            <a href="<?php echo $controller_base . "/ProductController/getDrillDownProduct/$productCode1" ?>">
                <img src="<?php echo $img_base . "CI/assets/images/products/$displayImage1"?>" alt="<?php echo $displayVendor1?>" />
            </a>
            
            <a href="<?php echo $controller_base . "/ProductController/getDrillDownProduct/$productCode2" ?>">
            	<img src="<?php echo $img_base . "CI/assets/images/products/$displayImage2"?>" alt="<?php echo $displayVendor2?>" />
            </a>
             <a href="<?php echo $controller_base . "/ProductController/getDrillDownProduct/$productCode3" ?>">
            	<img src="<?php echo $img_base . "CI/assets/images/products/$displayImage3"?>" alt="<?php echo $displayVendor3?>" />
            </a>
             <a href="<?php echo $controller_base . "/ProductController/getDrillDownProduct/$productCode4" ?>">
            	<img src="<?php echo $img_base . "CI/assets/images/products/$displayImage4"?>" alt="<?php echo $displayVendor4?>" />
            </a>
        </div>
        <!--thumbnails-->
        <div id="thumbs"> 
            <div class="thumb">
                <div class="frame"><img src="<?php echo $img_base . "CI/assets/images/thumbs/$displayImage1"?>" /></div>
                <div class="thumb-content"><p>&euro;<?php echo $displayPrice1; ?></p><?php echo $displayName1; ?></div>
                <div style="clear:both;"></div>
            </div>
            <div class="thumb">
                <div class="frame"><img src="<?php echo $img_base . "CI/assets/images/thumbs/$displayImage2"?>" /></div>
                <div class="thumb-content"><p>&euro;<?php echo $displayPrice2; ?></p><?php echo $displayName2; ?></div>
                <div style="clear:both;"></div>
            </div>
            <div class="thumb">
                <div class="frame"><img src="<?php echo $img_base . "CI/assets/images/thumbs/$displayImage3"?>" /></div>
                <div class="thumb-content"><p>&euro;<?php echo $displayPrice3; ?></p><?php echo $displayName3; ?></div>
                <div style="clear:both;"></div>
            </div>
            <div class="thumb">
                <div class="frame"><img src="<?php echo $img_base . "CI/assets/images/thumbs/$displayImage4"?>" /></div>
                <div class="thumb-content"><p>&euro;<?php echo $displayPrice4; ?></p><?php echo $displayName1; ?></div>
                <div style="clear:both;"></div>
            </div>
        </div>

        <!--clear above float:left elements. It is required if above #slider is styled as float:left. -->
        <div style="clear:both;height:0;"></div>
    </div>

<?php
$this->load->view('footer'); 

?>