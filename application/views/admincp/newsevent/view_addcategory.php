<!--<script src="/layout/backend/assets/js/fileinput.js" id="script-resource-18"></script>-->

<script type="text/javascript" src="/admin/editor/ckeditor/ckeditor.js"></script>
<!--<script type="text/javascript" src="/admin/assets/js/backend/backend.newsevent.input.js"></script>-->
<script type="text/javascript">
	setActiveMenu('newsevent');
        setActiveSubMenu('backend-newsevent-addcategory');
	
</script>
<div class="pageheader notab">
	<h1 class="pagetitle">Thêm Danh Mục Tin Tức</h1>
	<span class="pagedesc"></span>
	
</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
    <form class="stdform stdform2" id="frm-add-newsevent" role="form" action="" method="POST" enctype="multipart/form-data">
                <p>
                    <label for="title">Tiêu đề <span style="color:red">*</span></label>
                    <span class="field">
                        <input required="required" type="text" placeholder="" id="title" name="title" class="mediuminput" value="<?php echo @$data['title']?>">
                    </span>
		</p>
                
                <p>
                    <label>Mô tả</label>
                    <span class="field">
                        <textarea placeholder="" id="description" name="description" class="mediuminput"><?php echo @$data['description']?></textarea>
                    </span>
                </p>
                
                <p>
                    <label>Order</label>
                    <span class="field">
			<input type="text" placeholder="" id="order_home" name="order" class="mediuminput" value="<?php echo @$data['order']?>">
                    </span>
		</p>
                <p>
                    <label>Status</label>
                    <span class="field">
                        <input type="checkbox" placeholder="" id="status" name="status" class="mediuminput" <?php if(@$data['status']=='active') echo "checked='checked'"?>> Active
                    </span>
		</p>
                <p class="stdformbutton">
			<input id="txt_id" type="hidden" value="<?php echo @$data['id_category']?>" name="id_category">
                        <button class="submit radius2" type="submit"><?php  if(!empty($data['id_category'])) echo "Đồng Ý"; else echo "Thêm Mới" ?> </button>
		</p>
    </form>
</div>

