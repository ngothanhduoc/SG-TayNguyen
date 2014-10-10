var FORM = null;
var statecreate = true;
//var arrGroup = [];
$(document).ready(function() {
	
	FORM = $('form');
    //CKEDITOR.replace('txt-content');
    //$('body').tooltip('disable');
    //setDefaultValueSelectBox();
    //-- init textbox nha phat hanh --------------------------------------------

    BACKEND.init();
		
	
});

var BACKEND = {
    AJAX_URL_GROUP: '/backend/ajax/groupmenu/menu_group',
    AJAX_URL_COMMIT: '/backend/ajax/addaccount',
    commit: function() {
        
           $('#frm-add-account').submit(function(e) {
			e.preventDefault();							
			var form = new FormData ($('#frm-add-account')[0]);
			console.log(form);
			$.ajax({
				url: BACKEND.AJAX_URL_COMMIT,
				type: "POST",
				processData: false, // Don't process the files
				contentType: false, 
				data: form,
				dataType: "JSON"
			}).done(function(data) {
				
				if (data.code == 0) {
					window.location.href = data.redirect;
				} else {
					var m = data.message;
					
					if (m.password!= "") {
						$('#password').val('');
						$('#password').attr('placeholder', m.password);
						var c = $("#password").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
					if (m.full_name!= "") {
						$('#full_name').val('');
						$('#full_name').attr('placeholder', m.full_name);
						var c = $("#full_name").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
					
					if (m.username!= "") {
						$('#username').val('');
						$('#username').attr('placeholder', m.username);
						var c = $("#username").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
				}
				
			});
			
			
			
			
			
		});
    },
    init: function() {
        BACKEND.commit();
        //BACKEND.initDropdownlistGroup();
        //BACKEND.initDropdownlistType(TYPE);
        //BACKEND.initDropdownlist(PLATFORM);
        //BACKEND.initJqxInput(LIST_NPH);//autocomplet
	//BACKEND.initDropdownlistSmsCard(SMSCARD);
    },
    initJqxInput: function(arr) {
        $("#txt_nph").jqxInput({source: arr, theme: THEME});
    },
    initDropdownlist: function(platform) {
        var source = ["Android", "IOS", "Java"];
        $("#jqxDropdownlist").jqxDropDownList({checkboxes: true, source: source, selectedIndex: 1, width: '100%', height: '25', theme: THEME, placeHolder: "Vui lòng chọn"});

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

 