<?php
$this->load->helper('url'); 
$base_url = base_url();
$local_style = base_url()."assets/";
$image_url = base_url()."assets/images/";
$css_url = $base_url."assets/stylesheet/";
$script_url = base_url()."assets/scripts/";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Giddy Goat Patchwork</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo $local_style."style.css"?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $css_url."styles.css"?>" />
<script language="javascript" type="text/javascript">
function clearText(field) {
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>
<script language="javascript" type="text/javascript" src="<?php echo $script_url."mootools-1.2.1-core.js"?>"></script>
<script language="javascript" type="text/javascript" src="<?php echo $script_url."mootools-1.2-more.js"?>"></script>
<script language="javascript" type="text/javascript" src="<?php echo $script_url."slideitmoo-1.1.js"?>"></script>
<script language="javascript" type="text/javascript">
window.addEvents({
    'domready': function () { /* thumbnails example , div containers */
        new SlideItMoo({
            overallContainer: 'SlideItMoo_outer',
            elementScrolled: 'SlideItMoo_inner',
            thumbsContainer: 'SlideItMoo_items',
            itemsVisible: 5,
            elemsSlide: 3,
            duration: 200,
            itemsSelector: '.SlideItMoo_element',
            itemWidth: 140,
            showControls: 1
        });
    },

});
</script>
</head>
<body>
<div id="wrapper">
  <div id="menu">
    <ul>
      <li><a href="#" class="current"><span></span>Home</a></li>
      <li><a href="#"><span></span>Classes</a></li>
      <li><a href="#"><span></span>Fabrics</a></li>
      <li><a href="#"><span></span>Notions</a></li>
      <li><a href="#"><span></span>Gallery</a></li>
      <li><a href="#"><span></span>Contact</a></li>
    </ul>
  </div>
  <!-- end of menu -->
  <div id="header_bar">
    <div id="header">
      <div class="right"></div>
      <h1><a href="#"> <img src="<?php echo $base_url."assets/images/logo.png"?>" alt="" /> <span>Giddy Goat Patchwork</span> </a></h1>
    </div>
    <div id="search_box">
      <form action="#" method="get">
        <input type="text" value="Enter keyword here..." name="q" size="10" id="searchfield" onfocus="clearText(this)" onblur="clearText(this)" />
        <input type="submit" name="Search" value="" alt="Search" id="searchbutton" />
      </form>
    </div>
  </div>
  <!-- end of header_bar -->
  <div class="cleaner"></div>
  <div id="sidebar">
    <div class="sidebar_top"></div>
    <div class="sidebar_bottom"></div>
    <div class="sidebar_section">
      <h2>Members</h2>
      <form action="#" method="get">
        <label>Username</label>
        <input type="text" value="" name="username" size="10" class="input_field" />
        <label>Password</label>
        <input type="password" value="" name="password" class="input_field" />
        <a href="#">Register</a>
        <input type="submit" name="login" value="Login" alt="Login" id="submit_btn" />
      </form>
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
      <div class="image_wrapper"><a href="#"><img src="<?php echo $base_url."assets/images/image_01.jpg"?>" alt="" /></a></div>
      <div class="discount"><span>25% off</span> | <a href="#">Read more</a></div>
    </div>
  </div>
  <!-- end of sidebar -->
  <div id="content">
    <div id="latest_product_gallery">
      <h2>Featured Products</h2>
      <div id="SlideItMoo_outer">
        <div id="SlideItMoo_inner">
          <div id="SlideItMoo_items">
            <div class="SlideItMoo_element"> <a href="#"> <img src="<?php echo $base_url."assets/images/product_01.png"?>" alt="" /></a> </div>
            <div class="SlideItMoo_element"> <a href="#"> <img src="<?php echo $base_url."assets/images/product_02.png"?>" alt="" /></a> </div>
            <div class="SlideItMoo_element"> <a href="#"> <img src="<?php echo $base_url."assets/images/product_03.png"?>" alt="" /></a> </div>
            <div class="SlideItMoo_element"> <a href="#"> <img src="<?php echo $base_url."assets/images/product_04.png"?>" alt="" /></a> </div>
            <div class="SlideItMoo_element"> <a href="#"> <img src="<?php echo $base_url."assets/images/product_05.png"?>" alt="" /></a> </div>
            <div class="SlideItMoo_element"> <a href="#"> <img src="<?php echo $base_url."assets/images/product_06.png"?>" alt="" /></a> </div>
            <div class="SlideItMoo_element"> <a href="#"> <img src="<?php echo $base_url."assets/images/product_07.png"?>" alt="" /></a> </div>
            <div class="SlideItMoo_element"> <a href="#"> <img src="<?php echo $base_url."assets/images/product_08.png"?>" alt="" /></a> </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end of latest_content_gallery -->
    <div class="content_section">
      <h2>Welcome to Giddy Goat Patchwork</h2>
      <p>Fun adults & children's weekly sewing / patchwork/quilting classes! We stock beautiful fabric and other sewing needs. Suitable for all levels of ability.</p>
    </div>
    <div class="content_section">
      <h2>Our Products</h2>
      <div class="product_box margin_r35">
        <h3>Classes</h3>
        <div class="image_wrapper"> <a href="#"><img src="<?php echo $base_url."assets/images/image_02.jpg"?>" alt="" /></a> </div>
        <p class="price">Price: $350</p>
        <a href="#">Detail</a> | <a href="#">Buy Now</a> </div>
      <div class="product_box margin_r35">
        <h3>Fabrics</h3>
        <div class="image_wrapper"> <a href="#"><img src="<?php echo $base_url."assets/images/image_03.jpg"?>" alt="" /></a> </div>
        <p class="price">Price: $550</p>
        <a href="#">Detail</a> | <a href="#">Buy Now</a> </div>
      <div class="product_box">
        <h3>Notions</h3>
        <div class="image_wrapper"> <a href="#"><img src="<?php echo $base_url."assets/images/image_04.jpg"?>" alt="" /></a> </div>
        <p class="price">Price: $250</p>
        <a href="#">Detail</a> | <a href="#">Buy Now</a> </div>
      <div class="cleaner"></div>
      <div class="product_box margin_r35">
        <h3>Workshops</h3>
        <div class="image_wrapper"> <a href="#"><img src="<?php echo $base_url."assets/images/image_05.jpg"?>" alt="" /></a> </div>
        <p class="price">Price: $850</p>
        <a href="#">Detail</a> | <a href="#">Buy Now</a> </div>
      <div class="product_box margin_r35">
        <h3> Gallery</h3>
        <div class="image_wrapper"> <a href="#"><img src="<?php echo $base_url."assets/images/image_06.jpg"?>" alt="" /></a> </div>
        <p class="price">Price: $450</p>
        <a href="#">Detail</a> | <a href="#">Buy Now</a> </div>
      <div class="product_box">
        <h3> Vivamus at justo</h3>
        <div class="image_wrapper"> <a href="#"><img src="<?php echo $base_url."assets/images/image_07.jpg"?>" alt="" /></a> </div>
        <p class="price">Price: $350</p>
        <a href="#">Detail</a> | <a href="#">Buy Now</a> </div>
      <div class="cleaner"></div>
      <div class="button_01"><a href="#">View All</a></div>
    </div>
  </div>
  <!-- end of content -->
</div>
<!-- end of wrapper -->
<div id="footer_wrapper">
  <div id="footer">
    <ul class="footer_menu">
      <li><a href="#">Home</a></li>
      <li><a href="#">CSS Templates</a></li>
      <li><a href="#">Flash Resources</a></li>
      <li><a href="#">Gallery</a></li>
      <li><a href="#">Company</a></li>
      <li class="last_menu"><a href="#">Contact</a></li>
    </ul>
    Copyright &copy; 2048 <a href="#">Giddy Goat Patchwork</a> | Designed by <a target="_blank" rel="nofollow" href="http://www.templatemo.com">templatemo</a></div>
  <!-- end of footer -->
</div>
<!-- end of footer_wrapper -->
</body>
</html>
