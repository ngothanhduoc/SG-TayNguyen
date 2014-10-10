<div class="row">
    <div class="col-xs-12">
        <div class="title-header"><h2>Lời Giới Thiệu</h2></div>
        <div class="description-introduction">
            <p>
                <?php echo $gioi_thieu['introtext'] ?>
            </p>
            <a href="/gioi-thieu.html"><div style="float: right; margin-top: 10px;">Xem Thêm</div></a>
        </div>
    </div>
</div>
<hr>      
<div class="row">
    <div class="col-xs-12">
        <div class="title-header"><h2>Sản Phẩm Tiêu Biểu</h2></div>
        <div class="list-product">
            <?php
            foreach ($product as $key => $value) {
                ?>
                <a href="">
                    <div class="product">
                        <img src="<?php echo $value['image_small'] ?>">
                        <span><?php echo $value['name'] ?></span>
                    </div>
                </a>
                <?php
            }
            ?>
            <a href="/san-pham.html"><div style="float: right; margin-top: 10px;">Xem Thêm</div></a>
        </div>
    </div>
</div>
<hr>