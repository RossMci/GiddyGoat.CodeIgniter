<?php
$this->load->helper('url'); 
$base_url = base_url();?>
<!-- contact page view  -->
<div id="content">
    <div id="latest_product_gallery">
      <h2>our contact</h2>

    </div>
    <!-- end of latest_content_gallery -->
    <div class="content_section">
      <h2>Our contact</h2>
      <div id="map" style="width:100%;height:400px;"></div>
      <h2>tel: 087 123 456</h2>
      <h2>GiddyGoat@gmail.com</h2>

  </div>
</div>


<script>
function initMap() {
var locaton={lat: 52.84361, lng: -8.98639};
var map = new google.maps.Map(document.getElementById("map"),{
  zoom:15,
  center: locaton
});
var marker= new google.maps.Marker({
  position:locaton,
  map: map
});
}
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLxTDkGptsgOxzjwmXvGnoNPW9_V4JpVk&callback=initMap"
  type="text/javascript"></script>