var FORM = null;
var statecreate = true;
$(document).ready(function() {
	FORM = $('form');
    CKEDITOR.replace('content');
	 //-- init textbox nha phat hanh --------------------------------------------
    BACKEND.init();
	/*
	FORM = $('form');
    CKEDITOR.replace('txt-content');
    $('body').tooltip('disable');
    setDefaultValueSelectBox();
   
	*/
});

var BACKEND = {
    AJAX_URL_COMMIT: '/backend/ajax/addgame',
    AJAX_URL_COMMIT_IMAGE: '/backend/ajax/addgameimage',
    AJAX_URL_COMMIT_IMAGE_WAP: '/backend/ajax/addgameimagewap',
    commit: function() {
		   $('#frm-add-game').submit(function(e) {
			e.preventDefault();
			
			$('button:submit').attr("disabled", true);
			var form = new FormData ($('#frm-add-game')[0]);
			console.log(form);
                        if($('#jqxDropdownlistCate').val() != ''){
                            form.append("id_game_category", arrCateName[$('#jqxDropdownlistCate').val()]);
                        }
                        if($('#jqxDropdownlistPub').val() != ''){
                            form.append("id_publisher", arrPublisherName[$('#jqxDropdownlistPub').val()]);
                        }
			form.append("content", CKEDITOR.instances['content'].getData());
			
			$.ajax({
				url: BACKEND.AJAX_URL_COMMIT,
				type: "POST",
				processData: false, // Don't process the files
				contentType: false, 
				data: form,
				
				beforeSend: BACKEND.startLoading,
				complete: BACKEND.topLoading,
				
				dataType: "JSON"
			}).done(function(data) {
					
				if (data.code == 0) {
                                        var m = data.message;
					//window.location.href = data.redirect;
                                        $('ul.hornav li').removeClass('current');
                                        //$('ul.hornav li:last-child').addClass('current');
                                        $('ul.hornav li:nth-child(2)').addClass('current');
                                        
                                        $('#info-game').hide();
                                        $('#image-wap').hide();
                                        $('#image-game').show();
                                        $('#id_game').val(m.id_game);
                                        $('#id_game_wap').val(m.id_game);
				} else {
					$('#platform').html('');
                                        $('#id_publisher').html('');
                                        $('#id_game_category').html('');
                                        var m = data.message;
					                                  
					
                                        if (m.description!= "") {
						$('#description').val('');
						$('#description').attr('placeholder', m.description);
						var c = $("#description").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
                                        
                                        if (m.full_name!= "") {
						$('#full_name').val('');
						$('#full_name').attr('placeholder', m.full_name);
						var c = $("#full_name").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
                                        if (m.platform!= "") {
						$('#platform').html(m.platform);
						var c = $("#platform").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
                                        if (m.id_publisher!= "") {
						$('#id_publisher').html(m.id_publisher);
						var c = $("#id_publisher").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
                                        if (m.id_game_category!= "") {
						$('#id_game_category').html(m.id_game_category);
						var c = $("#id_game_category").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
					
				}
				$('button:submit').attr("disabled", false);
			});
			
		});
                
                
                $('#frm-add-gameimage').submit(function(e) {
			e.preventDefault();
			
			$('button:submit').attr("disabled", true);
			var form = new FormData ($('#frm-add-gameimage')[0]);
			console.log(form);
                       
			
			$.ajax({
				url: BACKEND.AJAX_URL_COMMIT_IMAGE,
				type: "POST",
				processData: false, // Don't process the files
				contentType: false, 
				data: form,
				
				beforeSend: BACKEND.startLoadingg,
				complete: BACKEND.topLoadingg,
				
				dataType: "JSON"
			}).done(function(data) {
					
				if (data.code == 0) {
					//window.location.href = data.redirect;
                                        var m = data.message;
					$('ul.hornav li').removeClass('current');
                                        $('ul.hornav li:last-child').addClass('current');
                                        
                                        $('#info-game').hide();
                                        $('#image-game').hide();
                                        $('#image-wap').show();                                        
                                        
				} else {
					
                                        var m = data.message;
							
                                        if (m.image_slide_game!= "") {
						$('#image_slide_game').val('');
						$('#image_slide_game').attr('placeholder', m.image_slide_game);
						var c = $("#image_slide_game").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}1
                                        if (m.background_game!= "") {
						$('#background_game').val('');
						$('#background_game').attr('placeholder', m.background_game);
						var c = $("#background_game").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
                                        if (m.sub_image!= "") {
						$('#sub_image').val('');
						$('#sub_image').attr('placeholder', m.sub_image);
						var c = $("#sub_image").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
                                        if (m.home_image!= "") {
						$('#home_image').val('');
						$('#home_image').attr('placeholder', m.home_image);
						var c = $("#home_image").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
                                        if (m.logo_game!= "") {
						$('#logo_game').val('');
						$('#logo_game').attr('placeholder', m.logo_game);
						var c = $("#logo_game").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
                                                                 
					
				}
				$('button:submit').attr("disabled", false);
			});
			
		});
                
                $('#frm-add-wapimage').submit(function(e) {
			e.preventDefault();
			
			$('button:submit').attr("disabled", true);
			var form = new FormData ($('#frm-add-wapimage')[0]);
			console.log(form);
                       
			
			$.ajax({
				url: BACKEND.AJAX_URL_COMMIT_IMAGE_WAP,
				type: "POST",
				processData: false, // Don't process the files
				contentType: false, 
				data: form,
				
				beforeSend: BACKEND.startLoadingg,
				complete: BACKEND.topLoadingg,
				
				dataType: "JSON"
			}).done(function(data) {
					
				if (data.code == 0) {
					window.location.href = data.redirect;
				} else {
					
                                        var m = data.message;
						
                                        if (m.menu_bg!= "") {
						$('#menu_bg').val('');
						$('#menu_bg').attr('placeholder', m.menu_bg);
						var c = $("#menu_bg").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
                                        if (m.background_game_wap != "") {
						$('#background_game_wap').val('');
						$('#background_game_wap').attr('placeholder', m.background_game_wap);
						var c = $("#background_game_wap").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
                                        if (m.home_image_wap!= "") {
						$('#home_image_wap').val('');
						$('#home_image_wap').attr('placeholder', m.home_image_wap);
						var c = $("#home_image_wap").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
                                                                 
					
				}
				$('button:submit').attr("disabled", false);
			});
			
		});
                
                
       
    },
    init: function() {
       
        //BACKEND.initDropdownlistType(TYPE);
        //BACKEND.initDropdownlist(PLATFORM);
        //BACKEND.initJqxInput(LIST_NPH);//autocomplet
		//BACKEND.initDropdownlistSmsCard(SMSCARD);
		BACKEND.initDropdownlistCate(CAT_NAME);
		BACKEND.initDropdownlistPub(PUB_NAME);
                BACKEND.initDropdownlist(PLAT);
		BACKEND.commit();
        
    },
    initJqxInput: function(arr) {
        $("#txt_nph").jqxInput({source: arr, theme: THEME});
    },
    initDropdownlist: function(platform) {
        //var source = ["Android", "IOS", "Java"];
        var source = arrPlat;
        
        $("#jqxDropdownlist").jqxDropDownList({checkboxes: true, source: source, selectedIndex: 1, width: '50%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});

        var arrPlatform = platform.split(',');
        for (var i = 0; i < arrPlatform.length; i++) {
            $("#jqxDropdownlist").jqxDropDownList('checkItem', arrPlatform[i]);
        }
    },
    initDropdownlistType: function(data) {
        var source = ["Game mới", "Game Hot", "Nạp nhiều"];
        $("#jqxDropdownlistType").jqxDropDownList({checkboxes: true, source: source, selectedIndex: 1, width: '100%', height: '25', theme: THEME, placeHolder: "Vui lòng chọn"});

        var arr = data.split(',');
        for (var i = 0; i < arr.length; i++) {
            $("#jqxDropdownlistType").jqxDropDownList('checkItem', arr[i]);
        }
    },
    initDropdownlistSmsCard: function(data) {
        var source = ["sms", "card"];
        $("#jqxDropdownlistSmsCard").jqxDropDownList({checkboxes: true, source: source, selectedIndex: 1, width: '100%', height: '25', theme: THEME, placeHolder: "Vui lòng chọn"});

        var arr = data.split(',');
        for (var i = 0; i < arr.length; i++) {
            $("#jqxDropdownlistSmsCard").jqxDropDownList('checkItem', arr[i]);
        }
    },
    
    startLoadingg: function(){
            $('#loading-input').css({display: 'inline'});
    },
    topLoadingg: function(){
            $('#loading-input').hide();
    },
    
    startLoading: function(){
        $('#loading').show();
        $('#loading').css({display: 'inline'});
    },
    topLoading: function(){
            $('#loading').hide();
            $('button:submit').attr("disabled", false);
    },
	initDropdownlistCate: function(data) {
        var source = arrCate;
		
		$("#jqxDropdownlistCate").jqxDropDownList({source: source, /*selectedIndex: 0,*/ width: '50%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});
		
		if(data != ''){
			$("#jqxDropdownlistCate").jqxDropDownList('selectItem',data);
		}
		
    },
	initDropdownlistPub: function(data) {
        var source = arrPublisher;
		
		$("#jqxDropdownlistPub").jqxDropDownList({source: source, /*selectedIndex: 0,*/ width: '50%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});
		
		if(data != ''){
			$("#jqxDropdownlistPub").jqxDropDownList('selectItem',data);
		}
		
    },
	
}


$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

 