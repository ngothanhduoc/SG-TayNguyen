
<!--
<script type="text/javascript" src="/layout/backend/assets/libraries/ckeditor/ckeditor.js"></script>
<script src="/layout/backend/assets/js/fileinput.js" id="script-resource-18"></script>
-->
<script type="text/javascript" src="/public/admin/editor/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/public/admin/assets/js/backend/backend.menu.input.js"></script>

<div class="pageheader notab">
	<h1 class="pagetitle">Add menu</h1>
	<span class="pagedesc"></span>
	
</div><!--pageheader-->

<div id="contentwrapper" class="contentwrapper lineheight21">
	<form class="stdform stdform2" id="frm-add-menu" role="form" action="" method="POST" enctype="multipart/form-data">
		
		<div style="border: #ddd solid 1px">
			<label>Group Menu <span style="color:#ff0000">(*)</span></label>
			<span class="field">
				<div id="jqxDropdownlistGroup" name="group_name"></div>
				<div id="group_name" style="color: #ff0000"></div>
			</span>
		</div>
			
		<p>
			<label for="name">Function Name (Action) <span style="color:#ff0000">(*)</span></label>
			<span class="field">
				<input type="text" placeholder="" id="name" name="name" class="mediuminput" value="<?php echo @$data['name']?>">
			</span>
		</p>
		
		<p>
			<label for="name">Display Name <span style="color:#ff0000">(*)</span></label>
			<span class="field">
				<input type="text" placeholder="" id="name_display" name="name_display" class="mediuminput" value="<?php echo @$data['name_display']?>">
			</span>
		</p>
		
		<p>
			<label for="url">Url <span style="color:#ff0000">(*)</span></label>
			<span class="field">
				<input type="text" placeholder="" id="url" name="url" class="mediuminput" value="<?php echo @$data['url']?>">
			</span>
		</p>
				
		<p class="stdformbutton">
			<input id="txt_id" type="hidden" value="<?php echo @$data['id_function']?>" name="id">
			<button class="submit radius2" type="submit">Add Menu</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/public/admin/assets/images/loaders/loader10.gif"/></span>
		</p>
		
	</form>				
</div><!--contentwrapper-->

<script type="text/javascript">
    setActiveMenu('menu');
    setActiveSubMenu('backend-menu-add');
    
    var arrGroup = <?php echo @json_encode($groupmenu)?>;
    var arrName = <?php echo @json_encode($arrgroupname)?>;
    var groupName = '<?php echo @$groupName?>';
</script>

