<?php
$this->load->helper('url');
$base_url = base_url(); ?>
<div id="content">
    <div id="latest_product_gallery" style="color: white">
        <h2>our notions</h2>
        1a(1): an individual's conception or impression of something known, experienced, or imagined
        They had different notions of right and wrong.
        (2): an inclusive general concept
        arriving at the notion of law
        — Irving Babbitt
        (3): a theory or belief held by a person or group
        the notion of original sin
        b: a personal inclination : WHIM
        He had a notion to try skydiving.
        2obsolete : MIND, INTELLECT
        3notions plural : small useful items : SUNDRIES
        found the thread she wanted among the shop's notions
    </div>
    <!-- end of latest_content_gallery -->
    <div class="content_section">
        <a href="<?php echo base_url(); ?>index.php/Notions">
            <h2> Notions details</h2>
        </a>
        <a href="<?php echo base_url(); ?>index.php/Notions">
            <h2> Back to Notions </h2>
        </a>
        <form action="<?php echo base_url(); ?>index.php/Notions/editNotions" method="get">
            <?php
            echo '<img  src="' . base_url() . $notion->image . '" /></br>';
            echo 'Name:</br>' . $notion->name . '</br>';
            echo 'description:</br>' . $notion->description . '</br>';
            echo 'cost:</br>' . $notion->cost . '</br>';
            ?>
            </br>


            <input type="submit" name="submit" value="Add to cart" alt="submit" />
        </form>

    </div>
</div>