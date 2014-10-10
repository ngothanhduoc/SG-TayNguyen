<!--<script src="/layout/backend/assets/js/fileinput.js" id="script-resource-18"></script>-->

<script type="text/javascript" src="/admin/editor/ckeditor/ckeditor.js"></script>
<!--<script type="text/javascript" src="/admin/assets/js/backend/backend.newsevent.input.js"></script>-->
<script type="text/javascript">
	setActiveMenu('game');
        setActiveSubMenu('backend-game-add_platform');
	
</script>
<div class="pageheader notab">
	<h1 class="pagetitle">Thêm Platform</h1>
	<span class="pagedesc"></span>
	
</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
    <form class="stdform stdform2" id="frm-add-newsevent" role="form" action="" method="POST" enctype="multipart/form-data">
                <p>
                    <label for="title">Tiêu đề <span style="color:#ff0000">(*)</span></label>
                    <span class="field">
                        <input required="required" type="text" placeholder="" id="title" name="full_name" class="mediuminput" value="<?php echo @$data['full_name']?>">
                    </span>
		</p>
                <p>
                    <label>Alias</label>
                    <span class="field">
			<input type="text" required="required"  placeholder="" id="order_home" name="alias" class="mediuminput" value="<?php echo @$data['alias']?>">
                    </span>
		</p>
                
                <p class="stdformbutton">
			<input id="txt_id" type="hidden" value="<?php echo @$data['id_platform']?>" name="id_platform">
                        <button class="submit radius2" type="submit"><?php  if(!empty($data['id_platform'])) echo "Đồng Ý"; else echo "Thêm Mới" ?> </button>
		</p>
    </form>
</div>

