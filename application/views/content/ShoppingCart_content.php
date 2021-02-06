<?php
$this->load->helper('url');
$base_url = base_url(); ?>
<div id="content">
<!-- displays the contents of the shopping cart  -->
  <div id="latest_product_gallery">
    <h2>Cart</h2>

  </div>
  <div class="content_section">
    <h2>Shopping Cart</h2>
    <!-- <input onClick="window.location.href='<?php //echo base_url(); 
                                                ?>index.php/GGHome/index'" name="Continue_shopping" type="submit" value="Continue shopping" alt="Continue shopping"> -->
    <input onClick="window.history.back();" name="Continue_shopping" type="button" value="Continue shopping" alt="Continue shopping">
    <form action="<?php echo base_url(); ?>index.php/ShoppingCart/handleCheckOut" method="get">
      <table>
        <tr>
          <th></th>
          <td>Name</th>
          <th>Description</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>total price</th>
          <th>date_added</th>
          <th>action </th>
        </tr>

        <?php foreach ($carts as $cart) { ?>
          <tr>
            <td><?php echo  '<img width="50" src="' . base_url() . $cart->image_path . '" />'; ?></td>
            <td><?php echo  $cart->product_name ?></td>
            <td><?php echo $cart->product_desc ?></td>
            <td><?php echo $cart->quantity ?></td>
            <td><?php echo $cart->price ?></td>
            <td><?php echo $cart->price * $cart->quantity ?></td>
            <td><?php echo $cart->date_added ?></td>
            <td><input onClick="window.location.href='<?php echo base_url(); ?>index.php/ShoppingCart/RemoveCartItem/<?php echo  $cart->id; ?>'" name="Remove" type="button" value="Remove" alt="Remove"></td>
            <!-- <td><?php //echo $cart->image_path 
                      ?></td> -->
          </tr>

        <?php } ?>
      </table>
      <?php if ($carts == null) {
        echo '
        </br>
        </br>
        <h2>Thanks for shopping with us checkout successful</h2>
        </br></br>
        ';
      }
      ?>
      <?php if ($this->session->userdata('UserId') == null) {
        echo '<input type="submit" name="submit" value="Check Out" alt="submit" />';
      } else {
        echo '<p>you must be logged in too check out</p>';
      }
      ?>
    </form>

  </div>
</div>