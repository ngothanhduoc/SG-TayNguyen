<script type="text/javascript">
    setActiveMenu('account');
    setActiveSubMenu('backend-account-add');
	
	var arrGroup = <?php echo json_encode($groupmenu)?>; 
</script>
<script type="text/javascript" src="/public/admin/assets/js/backend/backend.account.input.js"></script>
<script type="text/javascript" src="/public/admin/assets/js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="/public/admin/assets/js/custom/forms.js"></script>
<?php 
if(isset($_GET['id'])){
    $t = '';
}else{
    $t = '<span style="color:#ff0000">(*)</span>';
}
?>
<div class="pageheader notab">
	<h1 class="pagetitle">Add/Edit Account</h1>
	<span class="pagedesc"></span>
	
</div><!--pageheader-->

<div id="contentwrapper" class="contentwrapper lineheight21">

		<form class="stdform" id="frm-add-account" role="form" action="" method="POST" enctype="multipart/form-data">
		
		
		<div class="stepContainer" style="height: 237px;">
			<div class="formwiz content" id="wiz1step1" style="display: block;">
				<h4>Thông tin User</h4>
				
					<p>
						<label for="username">User Name <span style="color:#ff0000">(*)</span></label>
						<span class="field">
							<input type="text" placeholder="" id="username" name="username" class="mediuminput" value="<?php echo @$data['username']?>">
						</span>
					</p>
					
					<p>
						<label for="full_name">Full Name <span style="color:#ff0000">(*)</span></label>
						<span class="field">
							<input type="text" placeholder="" id="full_name" name="full_name" class="mediuminput" value="<?php echo @$data['full_name']?>">
						</span>
					</p>
													
					<p>
						<label for="password">Password <?php echo $t?></label>
						<span class="field">
							<input type="text" placeholder="" id="password" name="password" class="mediuminput" value="">
						</span>
					</p>
											
										
										
				</div>
			</div>
			<div class="stepContainer" style="height: 237px;" id="menup">
				<div class="formwiz content" id="wiz1step1" style="display: block;">
					<h4>Phân quyền Menu</h4>
					<p>
                                            <label><strong>Check All</strong></label>
                                            <span class="formwrapper"><input type="checkbox" id="checkAll"></span>
                                            <br>
					<?php
                                        foreach($menu as $key => $val){
					?>
					
						<?php
						if($val['level'] == 0){
						?>
						<label><strong><?php echo $val['display_name']?></strong></label>
						<?php
						}else{
						?>
						<span class="formwrapper">
						<?php
						if($val['checked'] == 0){
						?>
						<input type="checkbox" name="mid[]" class="selectedId" value="<?php echo $val['id_function']?>" id="<?php echo $val['id_function']?>">&nbsp;<label for="<?php echo $val['id_function']?>" style="float: none!important"><?php echo $val['name_display']?></label>
						<?php
						}else{
						?>
						<input type="checkbox" checked name="mid[]" class="selectedId" value="<?php echo $val['id_function']?>" id="<?php echo $val['id_function']?>">&nbsp;<label for="<?php echo $val['id_function']?>" style="float: none!important"><?php echo $val['name_display']?></label>
						<?php
						}
						?>
						
						</span>
						<?php
						}
						?>
								
					<?php
					}
					?>
					</p>
				</div>
			</div>
                        
                        
                    
			<div class="actionBar">
				<input id="txt_id" type="hidden" value="<?php echo @$data['id_admin']?>" name="id">
				<button class="submit radius2" type="submit">Add Account</button>			
			</div>
				
		</form>
</div>				

<script>
    
$('#checkAll').on('click', function() {
       
    $('.selectedId').attr('checked', $(this).is(":checked"));
    if($(this).is(":checked")){
    $('.selectedId').parent().addClass('checked');
    }else{
    $('.selectedId').parent().removeClass('checked');
    }
});
    
$('#checkA').on('click', function() {
       
    $('.selectedI').attr('checked', $(this).is(":checked"));
    if($(this).is(":checked")){
    $('.selectedI').parent().addClass('checked');
    }else{
    $('.selectedI').parent().removeClass('checked');
    }
});
</script>