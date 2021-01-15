<?php
$this->load->helper('url'); 
$base_url = base_url();?>
<div id="content">
    <div id="latest_product_gallery">
      <h2 style="color: white">our classes</h2>
  <section style="color: white">    
  Definition of class (Entry 1 of 2)
1a: a body of students meeting regularly to study the same subject
Several students in the class are absent today.
b: the period during which such a body meets
c: a course of instruction
is doing well in her algebra class
d: a body of students or alumni whose year of graduation is the same
donated by the class of 1995
2a: a group sharing the same economic or social status
the working class
b: social rank
especially : high social rank
the classes as opposed to the masses
c: high quality : ELEGANCE
a hotel with class
  </section>

    </div>
    <!-- end of latest_content_gallery -->
    <div class="content_section">
      <h1>Our Classes</h1>
      <a href="<?php echo base_url(); ?>index.php/Classes">
      <h2> Back to calendar</h2>
      </a>
    
      <?php $content ?>
      <?php echo '<img  src="' . base_url() .'assets/images/classes/classes.jpg" />';?>
      <?php foreach($classes as $class){
         echo '<h2>'.$class->name.'</h2>';
         echo 'Description: '.$class->description;
         echo '</br>';
         echo 'DateOfClass: '.$class->dateOfClass;
         echo '</br>';
         echo 'TimeOfClass: '.$class->timeOfClass;
         echo '</br>';
         echo 'Price: '.$class->price;
         echo '</br>';
         echo 'MaxAttendees: '.$class->maxAttendees;
         echo '</br>';
         echo anchor('cart/viewcart/'.$class->class_id,'<h3>Add To Cart</h3>');
      } ?>
  </div>
</div>