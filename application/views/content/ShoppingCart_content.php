<?php
$this->load->helper('url');
$base_url = base_url(); ?>
<div id="content">
  <div id="latest_product_gallery">
    <h2>Cart</h2>

  </div>
  <!-- end of latest_content_gallery -->
  <div class="content_section">
    <h2>Our contact</h2>
    <form action="<?php echo base_url(); ?>index.php/ShoppingCart/handleCheckOut" method="get">
    <table>

      <?php foreach ($carts as $cart) { ?>
        <tr>
          <td><?php echo  $cart->product_name ?></td>
          <td><?php echo $cart->product_desc ?></td>
          <td><?php echo $cart->quantity ?></td>
          <td><?php echo $cart->price ?></td>
          <td><?php echo $cart->date_added ?></td>
          <!-- <td><?php //echo $cart->image_path ?></td> -->
         <td><?php echo  '<img width="50" src="' . base_url() . $cart->image_path . '" />'; ?></td> 
        </tr>
       
      <?php } ?>
    </table>
    <input type="submit" name="submit" value="Check Out" alt="submit" />
        </form>

  </div>
</div>