<!--
<script type="text/javascript" src="/layout/backend/assets/libraries/ckeditor/ckeditor.js"></script>
<script src="/layout/backend/assets/js/fileinput.js" id="script-resource-18"></script>
-->
<script type="text/javascript" src="/public/admin/assets/js/backend/backend.menu.group.input.js"></script>

<style>
/*
p {
    border: 1px solid red;
    text-align: center;
    width: 100px;
    position: relative;
    animation: myAnimation 5s infinite;
    animation-direction: alternate;
    -moz-animation: myAnimation 5s infinite;
    -moz-animation-direction: alternate;
    -webkit-animation: myAnimation 5s infinite;
    -webkit-animation-direction: alternate;
    -o-animation: myAnimation 5s infinite;
    -o-animation-direction: alternate;
}
*/

@keyframes myAnimation {
    from {left: 0px;}
    to {left: 400px;}
}

/* Hien thi cho Firefox */
@-moz-keyframes myAnimation {
    from {left: 0px;}
    to {left: 400px;}
}

/* Hien thi cho Safari and Chrome */
@-webkit-keyframes myAnimation {
    from {left: 0px;}
    to {left: 400px;}
}

/* Hien thi cho Opera */
@-o-keyframes myAnimation {
    from {left: 0px;}
    to {left: 400px;}
}


#test {
    border: 0px solid red;
    text-align: center;
    width: 100%;
	height: 5px;
	background:#0000ff;
    position: relative;
    animation: divAnimation 5s infinite;
    animation-direction: alternate;
    -moz-animation: divAnimation 5s infinite;
    -moz-animation-direction: alternate;
    -webkit-animation: divAnimation 5s infinite;
    -webkit-animation-direction: alternate;
    -o-animation: divAnimation 5s infinite;
    -o-animation-direction: alternate;
}


.load70 {
    border: 0px solid red;
    text-align: center;
    width: 70%;
	height: 5px;
	background:#0000ff;
    position: relative;
    animation: divAnimation70 5s ease;
    animation-direction: alternate;
    -moz-animation: divAnimation70 5s ease;
    -moz-animation-direction: alternate;
    -webkit-animation: divAnimation70 5s ease;
    -webkit-animation-direction: alternate;
    -o-animation: divAnimation70 5s ease;
    -o-animation-direction: alternate;
}
.load30 {
    border: 0px solid red;
    text-align: center;
    width: 100%;
	height: 5px;
	background:#0000ff;
    position: relative;
    animation: divAnimation 5s ease;
    animation-direction: alternate;
    -moz-animation: divAnimation 5s ease;
    -moz-animation-direction: alternate;
    -webkit-animation: divAnimation 5s ease;
    -webkit-animation-direction: alternate;
    -o-animation: divAnimation 5s ease;
    -o-animation-direction: alternate;
}

@keyframes divAnimation70 {
    from {width: 0%;}
    to {width: 70%;}
}

/* Hien thi cho Firefox */
@-moz-keyframes divAnimation70 {
    from {width: 0%;}
    to {width: 70%;}
}

/* Hien thi cho Safari and Chrome */
@-webkit-keyframes divAnimation70 {
    from {width: 0%;}
    to {width: 70%;}
}

/* Hien thi cho Opera */
@-o-keyframes divAnimation70 {
    from {width: 0%;}
    to {width: 70%;}
}




@keyframes divAnimation {
    from {width: 0%;}
    to {width: 100%;}
}

/* Hien thi cho Firefox */
@-moz-keyframes divAnimation {
    from {width: 0%;}
    to {width: 100%;}
}

/* Hien thi cho Safari and Chrome */
@-webkit-keyframes divAnimation {
    from {width: 0%;}
    to {width: 100%;}
}

/* Hien thi cho Opera */
@-o-keyframes divAnimation {
    from {width: 0%;}
    to {width: 100%;}
}
</style>



<div class="pageheader notab">
	<h1 class="pagetitle">Thêm nhóm menu</h1>
	<span class="pagedesc"></span>
	
</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
    <form class="stdform stdform2" id="frm-add-groupmenu" role="form" action="" method="POST" enctype="multipart/form-data">
        <p>
            <label for="display_name">Tên nhóm <span style="color:#ff0000">(*)</span></label>
            <span class="field">
                <input type="text" placeholder="" id="display_name" name="display_name" class="smallinput" value="<?php echo @$data['display_name']?>">
            </span>
	</p>
        <p>
            <label for="order">Order</label>
            <span class="field">
                <input type="text" placeholder="" id="order" name="order" class="smallinput" value="<?php echo @$data['order']?>">
            </span>
	</p>
        <p>
            <label for="class">Class</label>
            <span class="field">
                <input type="text" placeholder="" id="class" name="class" class="smallinput" value="<?php echo @$data['class']?>">
            </span>
	</p>
        <p>
            <label for="alias">Alias (controller) <span style="color:#ff0000">(*)</span></label>
            <span class="field">
                <input type="text" placeholder="" id="alias" name="alias" class="smallinput" value="<?php echo @$data['alias']?>">
            </span>
	</p>
        <p>
            <label for="is_display">Is Display</label>
            <span class="field">
                <input type="checkbox" placeholder="" id="is_display" name="is_display" class="mediuminput" <?php if(@$data['is_display']==1) echo "checked='checked'"?>>
            </span>
	</p>
        <p class="stdformbutton">
		<input id="txt_id" type="hidden" value="<?php echo @$data['id']?>" name="id">
		<button class="submit radius2" type="submit">Add News</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/layout/backend/assets/images/loaders/loader10.gif"/></span>
	</p>
    </form>
</div>
<script type="text/javascript">
	setActiveMenu('menu');
    setActiveSubMenu('backend-menu-addgroup');
</script>