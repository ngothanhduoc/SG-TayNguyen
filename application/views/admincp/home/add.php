<script type="text/javascript">
    setActiveMenu('slide');
    setActiveSubMenu('backend-slide-add');
</script>
<script type="text/javascript" src="/public/admin/editor/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/public/admin/assets/js/backend/backend.home.input.js"></script>
<style>
.fileinput .thumbnail > img {
    display: block;
}
.thumbnail > img {
    display: block;
    height: auto;
    margin-left: auto;
    margin-right: auto;
    max-width: 100%;
}
div.uploader {
    cursor: default;
    left: 260px;
    overflow: hidden;
    position: absolute;
    top: -50px;
}
</style>
<div class="pageheader notab">
	<h1 class="pagetitle">Add Slide at Home</h1>
	<span class="pagedesc"></span>
	
</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
	<form class="stdform stdform2" id="frm-add-article" role="form" action="" method="POST" enctype="multipart/form-data">
				
		<p>
			<label for="title">Title <span style="color:#ff0000">(*)</span></label>
			<span class="field">
                            <input type="text" placeholder="" id="title" required="" name="name" class="mediuminput" value="<?php echo @$data['name']?>">
			</span>
		</p>
				
		<p>
                    <label for="home_image">Phân Loại</label>
                    <span class="field">
                        <?php 
                            if(@$data['name'] == 'company')
                                $check_1 = 'checked="checked"';
                            if(@$data['name'] == 'partner')
                                $check_2 = 'checked="checked"';
                        ?>
                        <input type="radio" checked="" <?php echo @$check_1 ?> name="type"value="company" /> Hình ảnh của Công Ty <br/>
                        <input type="radio" <?php echo @$check_2 ?> name="type" value="partner" /> Hình ảnh của Đối Tác
                    </span>
		</p>
                
                <p>
                    <label for="home_image">Slide Image (200px x 200px)</label>
                    <span class="field">
                        <input type="text" required="" placeholder="Click vào để chọn hình" id="home_image" name="image" class="mediuminput" value="<?php echo @$data['image']?>" onclick="openKCFinderByPath('#home_image', 'images')" readonly>
                        <br/>
                        <br/>
                        <?php 
                            if(!empty($data['image']))
                                echo '<img src="'.@$data['image'].'" width="200px" />';
                            
                        ?>
                    </span> 
		</p>
				
		<p class="stdformbutton">
			<input id="txt_id" type="hidden" value="<?php echo @$data['id_slide']?>" name="id">
			<button class="submit radius2" type="submit">Add</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/public/admin/assets/images/loaders/loader10.gif"/></span>
		</p>
		
	</form>				
</div><!--contentwrapper-->

