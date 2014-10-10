<script type="text/javascript">
    setActiveMenu('game');
    setActiveSubMenu('backend-game-add');
</script>

<script type="text/javascript" src="/admin/editor/ckeditor/ckeditor.js"></script>

<script type="text/javascript" src="/admin/assets/js/backend/backend.game.input.js"></script>
<script type="text/javascript" src="/admin/assets/js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="/admin/assets/js/custom/forms.js"></script>


<script type="text/javascript" src="/admin/assets/js/plugins/colorpicker.js"></script>
<script type="text/javascript" src="/admin/assets/js/plugins/jquery.jgrowl.js"></script>
<script type="text/javascript" src="/admin/assets/js/plugins/jquery.alerts.js"></script>

<script type="text/javascript" src="/admin/assets/js/custom/elements.js"></script>



<style type="text/css">
.csButton {
	/*background-color:#fe1a00;*/
	background-color:#ccc;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ddd), color-stop(1, #ccc));
	background:-moz-linear-gradient(center top, #ddd 5%, #ccc 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fe1a00', endColorstr='#ce0100');
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
	border-radius:5px;
	text-indent:0;
	border:1px solid #c6c6c6;
	display:inline-block;
	color:#555;
	font-family:Arial;
	font-size:14px;
	font-weight:normal;
	height:32px;
	line-height:32px;
	padding: 0px 10px;
	/*width:130px;*/
	text-decoration:none;
	text-align:center;
	text-shadow:1px 1px 0px #eee;
	
	-moz-box-shadow:inset 0px 1px 0px 0px #eee;
	-webkit-box-shadow:inset 0px 1px 0px 0px #eee;
	box-shadow:inset 0px 1px 0px 0px #eee;
}
.csButton:hover {
	/*color: #8fc800;*/
	background-color:#ce0100;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ccc), color-stop(1, #ddd) );
	background:-moz-linear-gradient( center top, #ccc 5%, #ddd 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ccc', endColorstr='#ddd');
}
.csButton:active {
	position:relative;
	top:1px;
}

#image-list > div{
    margin: 20px 0px;
}
#image-list-wap > div{
    margin: 20px 0px;
}
</style>
<?php
    if($data['hot_game'] == 0){
        $hotCheck = '';
    }else{
        $hotCheck = 'checked';
    }
    if($data['new_game'] == 0){
        $newCheck = '';
    }else{
        $newCheck = 'checked';
    }
?>

<div class="pageheader notab" style="border-bottom: none">
    <h1 class="pagetitle">Add game</h1>
    <span class="pagedesc"></span>
    
    <ul class="hornav">
        <li class="current"><a href="#info-game">Thông tin Game</a></li>
        <li class=""><a href="#image-game">Hình ảnh cho Web</a></li>
        <li class=""><a href="#image-wap">Hình ảnh cho Wap</a></li>
    </ul>
    
</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
        <div id="info-game" class="subcontent" style="display: block">
            <form class="stdform stdform2" id="frm-add-game" role="form" action="" method="POST" enctype="multipart/form-data">
        
                <div style="border: #ddd solid 1px; border-bottom: none">
                    <label>Category <span style="color:#ff0000">(*)</span></label>
                    <span class="field">
                            <div id="jqxDropdownlistCate" name="id_game_category"></div>
                            <div id="id_game_category" style="color: #ff0000"></div>
                    </span>
		</div>	

		<div style="border: #ddd solid 1px">
                    <label>Publisher <span style="color:#ff0000">(*)</span></label>
                    <span class="field">
                            <div id="jqxDropdownlistPub" name="id_publisher"></div>
                            <div id="id_publisher" style="color: #ff0000"></div>
                    </span>
		</div>	
		
		<p>
                    <label for="full_name">Full name <span style="color:#ff0000">(*)</span></label>
                    <span class="field">
                            <input type="text" placeholder="" id="full_name" name="full_name" class="mediuminput" value="<?php echo @$data['full_name']?>">
                    </span>
		</p>
                <p>
                    <label for="code_game">Code</label>
                    <span class="field">
                            <input type="text" placeholder="" id="code_game" name="code_game" class="mediuminput" value="<?php echo @$data['code_game']?>">
                    </span>
		</p>
                
                <div style="border: #ddd solid 1px; border-bottom: none">
                    <label>Platform <span style="color:#ff0000">(*)</span></label>
                    <span class="field">
                            <div id="jqxDropdownlist" name="platform"></div>
                            <div id="platform" style="color: #ff0000"></div>
                    </span>
		</div>	
                <p>
                    <label for="code_game">Url download</label>
                    <span class="field">
                            <input type="text" placeholder="" id="url_download" name="url_download" class="mediuminput" value="<?php echo @$data['url_download']?>">
                    </span>
		</p>
                <p>
                    <label for="code_game">Website</label>
                    <span class="field">
                            <input type="text" placeholder="" id="website" name="website" class="mediuminput" value="<?php echo @$data['website']?>">
                    </span>
		</p>
                <p>
                    <label for="code_game">Forum</label>
                    <span class="field">
                            <input type="text" placeholder="" id="forum" name="forum" class="mediuminput" value="<?php echo @$data['forum']?>">
                    </span>
		</p>
                <p>
                    <label for="code_game">Fanpage</label>
                    <span class="field">
                            <input type="text" placeholder="" id="fanpage" name="fanpage" class="mediuminput" value="<?php echo @$data['fanpage']?>">
                    </span>
		</p>
                
                <p>
                    <label>Hot / New</label>
                    <span class="field">
                            <input type="checkbox" id="hot_game" value="1" name="hot_game" <?php echo $hotCheck?>>
                            <label style="float: none!important; height: 25px; padding: 0px; line-height: 25px" for="hot_game">Hot</label>
                            
                            <input type="checkbox" id="new_game" value="1" name="new_game" <?php echo $newCheck?>>
                            <label style="float: none!important; height: 25px; padding: 0px; line-height: 25px" for="new_game">New</label>
                    </span>
		</p>
                
                <p>
                    <label for="color">Color background (detail)</label>
                    <span class="field">
                            <input type="text" placeholder="" id="colorpicker2" name="color" class="smallinput" value="<?php echo @$data['color']?>">
                            <span class="colorselector" id="colorSelector">
                                	<span style="background-color: rgb(110, 75, 101);"></span>
                             </span>
                    </span>
		</p>
                
                
                <p>
			<label for="description">Description</label>
			<span class="field">
				<textarea class="mediuminput" name="description" id="description" placeholder=""><?php echo @$data['description']?></textarea>
			</span>
		</p>
                <p>
			<label for="content" style="float: none">Content</label>
		</p>
		<p>
			<textarea placeholder="" id="content" name="content" class="mediuminput"><?php echo @$data['content']?></textarea>
		</p>
                
                <p class="stdformbutton">
                    <input id="txt_id" type="hidden" value="<?php echo @$data['id_game']?>" name="id">
                    <button class="submit radius2" type="submit">Add Game</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/admin/assets/images/loaders/loader10.gif"/></span>
                                       
                </p>
            </form>
        </div>
            
        <div id="image-game" class="subcontent" style="display: none">
            <form class="stdform stdform2" id="frm-add-gameimage" role="form" action="" method="POST" enctype="multipart/form-data">
                <p>
                    <label for="logo_game">Logo game (72x72) <span style="color:#ff0000">(*)</span></label>
                    <span class="field">
                            <input type="text" placeholder="Click vào để chọn hình" id="logo_game" name="logo_game" class="mediuminput" value="<?php echo @$data['logo_game']?>" onclick="openKCFinderByPath('#logo_game', 'images')" readonly>
                    </span>
		</p>
                <p>
                    <label for="home_image">Slide trang chủ (1600x385)</label>
                    <span class="field">
                            <input type="text" placeholder="Click vào để chọn hình" id="home_image" name="home_image" class="mediuminput" value="<?php echo @$data['home_image']?>" onclick="openKCFinderByPath('#home_image', 'images')" readonly>
                    </span>
		</p>
                <p>
                    <label for="sub_image">Game hot trang chủ (248x180)</label>
                    <span class="field">
                            <input type="text" placeholder="Click vào để chọn hình" id="sub_image" name="sub_image" class="mediuminput" value="<?php echo @$data['sub_image']?>" onclick="openKCFinderByPath('#sub_image', 'images')">
                    </span>
		</p>
                <p>
                    <label for="background_game">Background detail (1600x832) <span style="color:#ff0000">(*)</span></label>
                    <span class="field">
                            <input type="text" placeholder="Click vào để chọn hình" id="background_game" name="background_game" class="mediuminput" value="<?php echo @$data['background_game']?>" onclick="openKCFinderByPath('#background_game', 'images')" readonly>
                    </span>
		</p>
                <p>
                    <label for="image_slide_game">Slide trang list game (790x385)</label>
                    <span class="field">
                            <input type="text" placeholder="Click vào để chọn hình" id="image_slide_game" name="image_slide_game" class="mediuminput" value="<?php echo @$data['image_slide_game']?>" onclick="openKCFinderByPath('#image_slide_game', 'images')" readonly>
                    </span>
		</p>
                <div style="border: #ddd solid 1px; border-top: none">
                    <label for="code_game">Trong tab giới thiệu detail (234x400)</label>
                    <span class="field">
                        <button class="btn btn-default" type="button" onclick="openImage()"> + </button>
                        <div id="image-list">
                           <?php echo @$slide_image?>
                        </div>
                    </span>                       
		</div>
                <p class="stdformbutton">
                    <input id="id_game" type="hidden" value="<?php echo @$data['id_game']?>" name="id_game">
                    <button class="submit radius2" type="submit">Add Image</button>&nbsp;&nbsp;<span id="loading-input" style="position: absolute; display: none"><img src="/admin/assets/images/loaders/loader10.gif"/></span>
                                       
                </p>
            </form>
        </div>
    
        <div id="image-wap" class="subcontent" style="display: none">
            <form class="stdform stdform2" id="frm-add-wapimage" role="form" action="" method="POST" enctype="multipart/form-data">
                <p>
                    <label for="home_image_wap">Slide trang chủ (640x320)</label>
                    <span class="field">
                        <input type="text" placeholder="Click vào để chọn hình" id="home_image_wap" name="home_image_wap" class="mediuminput" value="<?php echo @$data['home_image_wap']?>" onclick="openKCFinderByPath('#home_image_wap', 'images')" readonly>
                    </span>
		</p>
                
                <p>
                    <label for="menu_bg">Background menu detail (640x84)</label>
                    <span class="field">
                        <input type="text" placeholder="Click vào để chọn hình" id="menu_bg" name="menu_bg" class="mediuminput" value="<?php echo @$data['menu_bg']?>" onclick="openKCFinderByPath('#menu_bg', 'images')">
                    </span>
		</p>
                
                <p>
                    <label for="background_game_wap">Banner trang detail (640x220) <span style="color:#ff0000">(*)</span></label>
                    <span class="field">
                        <input type="text" placeholder="Click vào để chọn hình" id="background_game_wap" name="background_game_wap" class="mediuminput" value="<?php echo @$data['background_game_wap']?>" onclick="openKCFinderByPath('#background_game_wap', 'images')" readonly>
                    </span>
		</p>
                <!--
                <div style="border: #ddd solid 1px; border-top: none">
                    <label for="">Slide image</label>
                    <span class="field">
                        <button class="btn btn-default" type="button" onclick="openImageWap()"> + </button>
                        <div id="image-list-wap">
                           <?php //echo @$slide_image_wap?>
                        </div>
                    </span>                       
		</div>
                -->
                <p class="stdformbutton">
                    <input id="id_game_wap" type="hidden" value="<?php echo @$data['id_game']?>" name="id_game_wap">
                    <button class="submit radius2" type="submit">Add Image</button>&nbsp;&nbsp;<span id="loading-input" style="position: absolute; display: none"><img src="/admin/assets/images/loaders/loader10.gif"/></span>
                                       
                </p>
            </form>
        </div>
	
</div>

<script type="text/javascript">
   
	
	var CAT_NAME = '<?php echo @$catName?>';
	var arrCate = <?php echo @json_encode($arrCate)?>;
	var arrCateName = <?php echo @json_encode($arrCateName)?>;
	
	var PUB_NAME = '<?php echo @$pubName?>';
	var arrPublisher = <?php echo @json_encode($arrPublisher)?>;
	var arrPublisherName = <?php echo @json_encode($arrPublisherName)?>;
        
        var arrPlat = <?php echo @json_encode($arrPlatform)?>;
        var PLAT = '<?php echo @$platform?>';
        
          function openImage(){
            if($('#image-list div:last-child').width() > 0){
                var rel = parseInt($('#image-list div:last-child input').attr('rel'));
                if($('#image-list div:last-child input').val() != ''){
                    rel = rel + 1;
                    $('#image-list').append('<div><input type="text" value="" name="slide_image[]" rel="'+rel+'" id="thumb_'+rel+'" class="form-control" style="width: 60%; float: left" readonly>&nbsp;<button class="btn btn-default rem" type="button" onclick=removeImage("#thumb_'+rel+'") style="float: left">-</button></div>');
                    openKCFinderByPath('#thumb_'+rel, 'images');
                }else{
                    openKCFinderByPath('#thumb_'+rel, 'images');
                }
               
            }else{
                $('#image-list').append('<div><input type="text" value="" name="slide_image[]" rel="1" id="thumb_1" class="form-control" style="width: 60%; float: left" readonly>&nbsp;<button class="btn btn-default rem" type="button" onclick=removeImage("#thumb_1") style="float: left">-</button></div>');
                openKCFinderByPath('#thumb_1', 'images');
            }
            
        }
        function removeImage(obj){
            $(obj).parent('div').remove();
        }
        
        function openImageWap(){
            if($('#image-list-wap div:last-child').width() > 0){
                var rel = parseInt($('#image-list-wap div:last-child input').attr('rel'));
                if($('#image-list-wap div:last-child input').val() != ''){
                    rel = rel + 1;
                    $('#image-list-wap').append('<div><input type="text" value="" name="slide_image_wap[]" rel="'+rel+'" id="thum_'+rel+'" class="form-control" style="width: 60%; float: left" readonly>&nbsp;<button class="btn btn-default rem" type="button" onclick=removeImage("#thum_'+rel+'") style="float: left">-</button></div>');
                    openKCFinderByPath('#thum_'+rel, 'images');
                }else{
                    openKCFinderByPath('#thum_'+rel, 'images');
                }
               
            }else{
                $('#image-list-wap').append('<div><input type="text" value="" name="slide_image_wap[]" rel="1" id="thum_1" class="form-control" style="width: 60%; float: left" readonly>&nbsp;<button class="btn btn-default rem" type="button" onclick=removeImage("#thum_1") style="float: left">-</button></div>');
                openKCFinderByPath('#thum_1', 'images');
            }
            
        }
</script>
