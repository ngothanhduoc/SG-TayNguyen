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
        <h3>Tên chủ đề: <?php echo @$data['title'] ?></h3><br/>
        <h4>Nội Dung:</h4><br/>
         <p><?php echo @$data['content'] ?></p>
        
        <form class="stdform stdform2" id="frm-add-newsevent" role="form" action="" method="POST" enctype="multipart/form-data">
                
                <p>
                    <label>Nội dung Trả Lời</label>
                    <span class="field">
                        <textarea placeholder="" id="content" name="content_admin" class="mediuminput"><?php echo @$data['content_admin']?></textarea>
                    </span>
                </p>
               
                <p class="stdformbutton">
			<input id="txt_id" type="hidden" value="<?php echo @$data['id_anwser']?>" name="id">
			<button class="submit radius2" type="submit">Đồng Ý</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/layout/backend/assets/images/loaders/loader10.gif"/></span>
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
	setActiveMenu('anw');
        setActiveSubMenu('backend-anw-edit');
        
	var GAME = <?php echo json_encode(@$game)?>;
	//var GAME_NAME = <?php //echo json_encode(@$gameName)?>;
	var GAME_INDEX = '<?php echo @$gameIndex?>';
        var CAT = <?php echo json_encode(@$cat)?>;
        var CAT_INDEX = '<?php echo @$catIndex?>';
	var FEATURED = '<?php echo @$featured?>';
        var ORDER = '<?php echo @$order?>';
        var TYPE = '<?php echo @$type?>';
</script>
