
<script type="text/javascript" src="/admin/editor/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/admin/assets/js/backend/backend.game.publisher.input.js"></script>

<div class="pageheader notab">
	<h1 class="pagetitle">Add Publisher</h1>
	<span class="pagedesc"></span>
	
</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
	<form class="stdform stdform2" id="frm-add-game-publisher" role="form" action="" method="POST" enctype="multipart/form-data">
				
		<p>
			<label for="full_name">Full name <span style="color:#ff0000">(*)</span></label>
			<span class="field">
				<input type="text" placeholder="" id="full_name" name="full_name" class="mediuminput" value="<?php echo @$data['full_name']?>">
			</span>
		</p>
		
		<p>
			<label for="address">Address <span style="color:#ff0000">(*)</span></label>
			<span class="field">
				<input type="text" placeholder="" id="address" name="address" class="mediuminput" value="<?php echo @$data['address']?>">
			</span>
		</p>
		<p>
			<label for="phone">Phone <span style="color:#ff0000">(*)</span></label>
			<span class="field">
				<input type="text" placeholder="" id="phone" name="phone" class="mediuminput" value="<?php echo @$data['phone']?>">
			</span>
		</p>
		
		<p>
			<label for="website">Website</label>
			<span class="field">
				<input type="text" placeholder="" id="website" name="website" class="mediuminput" value="<?php echo @$data['website']?>">
			</span>
		</p>
		
				
		
		<p>
			<label for="note" style="float: none">Note</label>
		</p>
		<p>
			<textarea placeholder="" id="note" name="note" class="mediuminput"><?php echo @$data['note']?></textarea>
		</p>
			
		<p class="stdformbutton">
			<input id="txt_id" type="hidden" value="<?php echo @$data['id_publisher']?>" name="id">
			<button class="submit radius2" type="submit">Add Publisher</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/admin/assets/images/loaders/loader10.gif"/></span>
		</p>
		
	</form>				
</div><!--contentwrapper-->

<script type="text/javascript">
    setActiveMenu('game');
    setActiveSubMenu('backend-game-addpublisher');
</script>
