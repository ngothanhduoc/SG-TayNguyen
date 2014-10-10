<?php
foreach ($product as $key => $value) {
    ?>
    <a href="san-pham/<?php echo $value['id_product'].'-' .utf8_to_ascii($value['name'])?>.html">
        <div class="product">
            <img src="<?php echo $value['image_small'] ?>">
            <span><?php echo $value['name'] ?></span>
        </div>
    </a>
    <?php
}
?>