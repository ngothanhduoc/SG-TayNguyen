<?php 
$user = $this->session->userdata['user_info'];

$CI =& get_instance();
$CI->load->library('session');
$user = $CI->session->userdata('user_info');
?>

<div class="left">
	<h1 class="logo">ADMIN.<span>CP</span></h1>
	<span class="slogan">CMS</span>
	<!--
	<div class="search">
		<form action="" method="post">
			<input type="text" name="keyword" id="keyword" value="Enter keyword(s)" />
			<button class="submitbutton"></button>
		</form>
	</div>
	-->
	<br clear="all" />
	
</div><!--left-->

<div class="right">
	<div class="userinfo">
		<img src="/public/admin/assets/images/thumbs/avatar.png" alt="" />
		<span><?php echo ucfirst($user['username']);?></span>
	</div><!--userinfo-->
	
	<div class="userinfodrop">            	
		<div class="avatar">
			<a href=""><img src="/public/admin/assets/images/thumbs/avatarbig.png" alt="" /></a>
		</div><!--avatar-->
		<div class="userdata">
			<h4><?php echo ucfirst($user['username']);?></h4>
			<ul>
				<li><a id="edituser" href="">Change password</a></li>
				<!--<li><a href="accountsettings.html">Account Settings</a></li>
				<li><a href="help.html">Help</a></li>-->
				<li><a href="/logout">Sign Out</a></li>
			</ul>
		</div><!--userdata-->
	</div><!--userinfodrop-->
</div><!--right-->
<script type="text/javascript">
    $(function(){
        $('#window').jqxWindow({
                autoOpen:false,
                rtl: true,
                resizable: false,
                minWidth: 800,
                minHeight: 400
            });
        $('#edituser').on('click',function(e){
            e.preventDefault();
            $('#window').jqxWindow('open');
        });
        
        $("#frm-change-pass").submit(function(e){
            e.preventDefault();
            $('button:submit').attr("disabled", true);
            var form = new FormData ($('#frm-change-pass')[0]);
            console.log(form);
			$.ajax({
				url: "/backend/ajax/changepass",
				type: "POST",
				processData: false, // Don't process the files
				contentType: false, 
				data: form,
				dataType: "JSON"
			}).done(function(data) {
				if (data.code == 0) {
					$('#window').jqxWindow('close');
				} else {
					var m = data.message;
										
					if (m.oldpass!= "") {
						$('#oldpass').val('');
						$('#oldpass').attr('placeholder', m.oldpass);
					}
                                        if (m.password!= "") {
						$('#password').val('');
						$('#password').attr('placeholder', m.password);
					}
                                        if (m.repassword!= "") {
						$('#repassword').val('');
						$('#repassword').attr('placeholder', m.repassword);
					}
				}
				//$('#loading').hide();
				$('button:submit').attr("disabled", false);				
			});
        });
    });
</script>
<div id="window">
            <div>
                Đổi mật khẩu
            </div>
            <div>
                <div class="pageheader notab">
                    <h1 class="pagetitle">Đổi mật khẩu</h1>
                    <span class="pagedesc"></span>

                </div><!--pageheader-->
                <div id="contentwrapper" class="contentwrapper lineheight21">
                    <form class="stdform stdform2" id="frm-change-pass" role="form" action="" method="POST" enctype="multipart/form-data">
                        
                        <p>
                            <label for="old_pass">Mật khẩu cũ</label>
                            <span class="field">
                                  <input type="password" placeholder="" id="oldpass" name="oldpass" class="mediuminput" value="">
                            </span>
                        </p>
                        <p>
                            <label for="password">Mật khẩu mới</label>
                            <span class="field">
                                  <input type="password" placeholder="" id="password" name="password" class="mediuminput" value="">
                            </span>
                        </p>
                        <p>
                            <label for="repassword">Nhập lại mật khẩu mới</label>
                            <span class="field">
                                  <input type="password" placeholder="" id="repassword" name="repassword" class="mediuminput" value="">
                            </span>
                        </p>
                        <p class="stdformbutton">
                             <button class="submit radius2" type="submit">Change</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/public/admin/assets/images/loaders/loader10.gif"/></span>
                        </p>
                    </form>
                </div>
            </div>
        </div>
