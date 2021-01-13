<?php
$this->load->helper('url');
$base_url = base_url();
?>
<div id="content">
    <div class="content_section">
        <h2 style="color: white">our Gallery </h2>
        <section style="color: white">
            A textile[1] is a flexible material made by creating an interlocking network of yarns or threads, which are produced by spinning raw fibres (from either natural or synthetic sources) into long and twisted lengths.
            [2] Textiles are then formed by weaving,
            knitting, crocheting, knotting,
            tatting, felting, bonding or braiding these yarns together.
            The related words "fabric"[3] and "cloth"[4] and "material" are often used in textile assembly trades (such as tailoring and dressmaking)
            as synonyms for textile. However, there are subtle differences in these terms in specialized usage. A textile is any material made of the interlacing fibres,
            including carpeting and geotextiles, which may not necessarily be used in the production of further goods, such as clothing and upholstery.
            A fabric is a material made through weaving, knitting, spreading, felting, stitching, crocheting or bonding that may be used in the production of further products,


        </section>
    </div>
    <div class="content_section">
        <a href="<?php echo base_url(); ?>index.php/Fabrics">
            <h2> Fabrics</h2>
        </a>
        <form action="<?php echo base_url(); ?>index.php/Fabrics/serach" method="get">
            <select name="fabricTypeId">
                <?php foreach ($fabricTypes as $fabricType) {
                    echo "<option value=\"" . $fabricType->fabric_type_id . "\">" . stripslashes($fabricType->fabricTypeName) . "</option>";
                } ?>
            </select>
            <input type="submit" name="submit" value="Search" alt="submit" id="submit_btn" />
        </form>
        <?php echo $imageTable ?>
        <?php echo $this->pagination->create_links(); ?>
    </div>
</div>