$(document).ready(function(){
	
	///// LOGIN FORM SUBMIT /////
	$('#login').submit(function(e){
		e.preventDefault();	
		if(jQuery('#username').val() == '' || jQuery('#password').val() == '' || jQuery('#txt_captcha').val() == '') {
			jQuery('.nousername').fadeIn();
			return false;	
		}else{
			var form = jQuery('#login').serialize();
			//console.log(form);
			$.ajax({
				url: '/login',
				type: "POST",
				data: form,
				dataType: "JSON"
			}).done(function(data) {
				if (data.code == 0) {
                                    
                                    window.location.href = '/backend/welcome';
				} else {
					if(data.message == 'captcha'){
						$('#error-msg').html('Captcha không đúng!');
						jQuery('.nousername').fadeIn();					
					}else{
						$('#error-msg').html('Username hoặc Password không đúng!');
						jQuery('.nousername').fadeIn();
					}					
				}
			});
		}
			
	});
});
