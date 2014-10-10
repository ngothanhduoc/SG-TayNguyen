<!--<script src="/layout/backend/assets/js/fileinput.js" id="script-resource-18"></script>-->

<script type="text/javascript" src="/admin/editor/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/admin/assets/js/backend/backend.newsevent.input.js"></script>

<div class="pageheader notab">
	<h1 class="pagetitle">Thêm bài viết</h1>
	<span class="pagedesc"></span>
	
        <ul class="hornav">
            <li class="current"><a href="#info-news">Thông tin Tin tức</a></li>
            <li class=""><a href="#image-news">Hình ảnh Tin</a></li>
        </ul>
</div><!--pageheader-->

<div id="contentwrapper" class="contentwrapper lineheight21">
    <div id="info-news" class="subcontent" style="display: block">
        <form class="stdform stdform2" id="frm-add-newsevent" role="form" action="" method="POST" enctype="multipart/form-data">
                <p>
                    <label for="title">Tiêu đề <span style="color:red">*</span></label>
                    <span class="field">
                        <input type="text" placeholder="" id="title" name="title" class="mediuminput" value="<?php echo @$data['title']?>">
                    </span>
		</p>
                <div style="border: #ddd solid 1px">
                    <label>Game <span style="color:red">*</span></label>
                    <span class="field">
                            <div id="jqxDropdownlistGame" name="game_name"></div>
                            <div id="game_name" style="color: #ff0000"></div>
                    </span>
		</div>
                <div style="border: #ddd solid 1px">
                    <label>Danh mục bài viết <span style="color:red">*</span></label>
                    <span class="field">
                            <div id="jqxDropdownlistCat" name="cat_name"></div>
                            <div id="cat_name" style="color: #ff0000"></div>
                    </span>
		</div>
                <div style="border: #ddd solid 1px">
                    <label>Type</label>
                    <span class="field">
                            <div id="jqxDropdownlistType" name="type_name"></div>
                            <div id="type_name" style="color: #ff0000"></div>
                    </span>
		</div>
                <p>
                    <label>Url</label>
                    <span class="field">
			<input type="text" placeholder="" id="url_news" name="url_news" class="mediuminput" value="<?php echo @$data['url_news']?>">
                    </span>
		</p>
                <p>
                    <label>Mô tả <span style="color:red">*</span></label>
                    <span class="field">
                        <textarea placeholder="" id="description" name="description" class="mediuminput"><?php echo @$data['description']?></textarea>
                    </span>
                </p>
                <p>
                    <label>Nội dung</label>
                    <span class="field">
                        <textarea placeholder="" id="content" name="content" class="mediuminput"><?php echo @$data['content']?></textarea>
                    </span>
                </p>
                <div style="border: #ddd solid 1px">
                    <label>Featured Home</label>
                    <span class="field">
                            <div id="jqxDropdownlistFeatured" name="featured_home"></div>
                            <div id="featured_home" style="color: #ff0000"></div>
                    </span>
		</div>
                <div style="border: #ddd solid 1px">
                    <label>Order Home</label>
                    <span class="field">
                            <div id="jqxDropdownlistOrder" name="order_home"></div>
                            <div id="order_home" style="color: #ff0000"></div>
                    </span>
		</div>
                <p>
                    <label>Status</label>
                    <span class="field">
                        <input type="checkbox" placeholder="" id="status" name="status" class="mediuminput" <?php if(@$data['status']==1) echo "checked='checked'"?>> Active
                    </span>
		</p>
                <p class="stdformbutton">
			<input id="txt_id" type="hidden" value="<?php echo @$data['id_news']?>" name="id">
			<button class="submit radius2" type="submit">Add News</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/layout/backend/assets/images/loaders/loader10.gif"/></span>
		</p>
        </form>
    </div>
    <div id="image-news" class="subcontent" style="display: none">
        <form class="stdform stdform2" id="frm-add-newseventimage" role="form" action="" method="POST" enctype="multipart/form-data">
            <p>
                <label for="image_banner">Hình ảnh banner (640x320) <span style="color:red">*</span></label>
                <span class="field">
                     <input type="text" placeholder="Click vào để chọn hình" id="image_banner" name="image_banner" class="mediuminput" value="<?php echo @$data['image_banner']?>" onclick="openKCFinderByPath('#image_banner', 'images')" readonly>
                </span>
            </p>
            <p>
                <label id="checkClick" for="image_slide">Hình ảnh slide (520x385)</label>
                <span class="field">
                     <input type="text" placeholder="Click vào để chọn hình" id="image_slide" name="image_slide" class="mediuminput" value="<?php echo @$data['image_slide']?>" onclick="openKCFinderByPath('#image_slide', 'images')" readonly>
                </span>
            </p>
            <p>
                <label for="order_slide">Order Slide</label>
                <span class="field">
                    <input type="text" placeholder="" id="order_slide" name="order_slide" class="mediuminput" value="<?php echo @$data['order_slide']?>">
                </span>
            </p>
            <p>
                <label for="active_slide">Active Slide</label>
                <span class="field">
                    <input type="checkbox" placeholder="" id="active_slide" name="active_slide" class="mediuminput" <?php if(@$data['active_slide']==1) echo "checked='checked'"?>> Active
                </span>
            </p>
            <p class="stdformbutton">
			<input id="id_news" type="hidden" value="<?php echo @$data['id_news']?>" name="id_news">
			<button class="submit radius2" type="submit">Add Image</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/layout/backend/assets/images/loaders/loader10.gif"/></span>
            </p>
        </form>
    </div>
</div>

<script type="text/javascript">
        $(function(){
            $("#active_slide").click(function(){
                if($(this).is(":checked")){
                    $("#checkClick").html("Hình ảnh slide (520x385) <span style='color:red'>*</span>");
                }else{
                    $("#checkClick").html("Hình ảnh slide (520x385)");
                }
            });
        });
	setActiveMenu('newsevent');
        setActiveSubMenu('backend-newsevent-add');
        
	var GAME = <?php echo json_encode(@$game)?>;
	//var GAME_NAME = <?php //echo json_encode(@$gameName)?>;
	var GAME_INDEX = '<?php echo @$gameIndex?>';
        var CAT = <?php echo json_encode(@$cat)?>;
        var CAT_INDEX = '<?php echo @$catIndex?>';
	var FEATURED = '<?php echo @$featured?>';
        var ORDER = '<?php echo @$order?>';
        var TYPE = '<?php echo @$type?>';
</script>
