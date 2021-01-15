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
      <h2> Notions</h2>
    </a>
    <form action="<?php echo base_url(); ?>index.php/Notions/serach" method="get">
      <select name="notionTypeId">
        <?php foreach ($notionTypes as $notionType) {
          echo "<option value=\"" . $notionType->notion_type_id . "\">" . stripslashes($notionType->notionTypeName) . "</option>";
        }?>
      </select>
      <input type="submit" name="submit" value="Search" alt="submit" id="submit_btn" />
    </form>
    <a href="<?php echo base_url(); ?>index.php/Notions">All Images</a>
    <!-- <div class="product_box margin_r35"> -->
    <?php echo $imageTable ?>
    <!-- </div> -->
    <?php echo $this->pagination->create_links(); ?>

  </div>
</div>
</div>