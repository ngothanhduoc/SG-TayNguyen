<!--<script src="/layout/backend/assets/js/fileinput.js" id="script-resource-18"></script>-->

<script type="text/javascript" src="/public/admin/editor/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/public/admin/assets/js/backend/backend.newsevent.input.js"></script>

<div class="pageheader notab">
	<h1 class="pagetitle">Thêm bài viết</h1>
	<span class="pagedesc"></span>
	
        <ul class="hornav">
            <li class="current"><a href="#info-news">Thông tin Tin tức</a></li>
            
        </ul>
</div><!--pageheader-->

<div id="contentwrapper" class="contentwrapper lineheight21">
    <div id="info-news" class="subcontent" style="display: block">
        <form class="stdform stdform2" id="frm-add-newsevent" role="form" action="" method="POST" enctype="multipart/form-data">
                <p>
                    <label for="title">Tiêu đề <span style="color:red">*</span></label>
                    <span class="field">
                        <input type="text" placeholder="" id="title" name="name" class="mediuminput" value="<?php echo @$data['name']?>">
                    </span>
		</p>
               <p>
                <label for="image_banner">Hình ảnh banner (100x100) <span style="color:red">*</span></label>
                <span class="field">
                     <input type="text" placeholder="Click vào để chọn hình" id="image_banner" name="image" class="mediuminput" value="<?php echo @$data['image']?>" onclick="openKCFinderByPath('#image_banner', 'images')" readonly>
                </span>
            </p>
                
                <p>
                    <label>Nội dung</label>
                    <span class="field">
                        <textarea placeholder="" id="content" name="content" class="mediuminput"><?php echo @$data['content']?></textarea>
                    </span>
                </p>
               
                <p class="stdformbutton">
			<input id="txt_id" type="hidden" value="<?php echo @$data['id_news']?>" name="id">
			<button class="submit radius2" type="submit">Add News</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/layout/backend/assets/images/loaders/loader10.gif"/></span>
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
