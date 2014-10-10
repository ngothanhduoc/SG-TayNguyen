
<div class="row">
    <div class="col-xs-12">
        <div class="title-header"><h2>Sản Phẩm</h2></div>
        <div class="list-product">
            <?php
            foreach ($product as $key => $value) {
                ?>
                <a href="/san-pham/<?php echo $value['id_product'].'-' .utf8_to_ascii($value['name'])?>.html">
                    <div class="product">
                        <img src="<?php echo $value['image_small'] ?>">
                        <span><?php echo $value['name'] ?></span>
                    </div>
                </a>
                <?php
            }
            ?>
        </div>
        <div class="show-more" id="12" style="float: right; margin-top: 10px; cursor: pointer; margin-bottom: 10px">Xem Thêm</div>
    </div>
</div>