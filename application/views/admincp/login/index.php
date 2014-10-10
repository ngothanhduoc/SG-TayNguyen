<div class="loginbox">
    	<div class="loginboxinner">
        	
            <div class="logo">
            	<h1><span>ADMIN.</span>CP</h1>
            </div><!--logo-->
                      
            <div class="nousername">
				<div class="loginmsg" id="error-msg">Phải nhập đủ thông tin!</div>
            </div><!--nousername-->
           		   
            <form id="login" action="" method="post">
            	
                <div class="username">
                	<div class="usernameinner">
                    	<input type="text" name="username" id="username" placeholder="Username" autocomplete="on" />
                    </div>
                </div>
                
                <div class="password">
                	<div class="passwordinner">
                    	<input type="password" name="password" id="password" placeholder="Password" autocomplete="off" />
                    </div>
                </div>
				
				<div class="password">
                	<div class="passwordinner">
                    	<input type="text" name="txt_captcha" id="txt_captcha" placeholder="Captcha" autocomplete="off" />
                    </div>
                </div>
                
				<div class="password">
                	<div style="text-align: center; padding: 10px 0px 0px 0px; background: #f8f8f8; position: relative">
						<img class="captcha-img" alt="" id="siimage" src="/public/captcha/index.php">
						<a tabindex="-1" style="border-style: none; display: inline-flex" id="refresh-captcha" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '/captcha/index.php?sid=' + Math.random();
						this.blur();
						return false"><i class="entypo-cw"></i></a>
					</div>
                </div>
				
				
                <button>Sign In</button>
                
                <!--<div class="keep"><input type="checkbox" /> Keep me logged in</div>-->
            
            </form>
            
        </div><!--loginboxinner-->
    </div><!--loginbox-->