var FORM = null;
var statecreate = true;
//var arrGroup = [];
$(document).ready(function() {
	
	FORM = $('form');
    //CKEDITOR.replace('txt-content');
    //$('body').tooltip('disable');
    //setDefaultValueSelectBox();
    //-- init textbox nha phat hanh --------------------------------------------
	//BACKEND.loadGroup();
    BACKEND.init();
		
	
});

var BACKEND = {
    AJAX_URL_GROUP: '/backend/ajax/groupmenu/menu_group',
    AJAX_URL_COMMIT: '/backend/ajax/addmenugroup',
    commit: function() {
        
           $('#frm-add-groupmenu').submit(function(e) {
			e.preventDefault();
			//$('#loading').removeClass('load70');
			//$('#loading').removeClass('load30');
					
			//var form = $(this).serializeObject();
			//var form = $('#frm-add-game').serialize();
			var is_display = 0;
                        if($('#is_display').is(':checked'))
                            is_display=1;	
			var form = new FormData ($('#frm-add-groupmenu')[0]);
			console.log(form);
                        form.append("is_display", is_display);
			$.ajax({
				url: BACKEND.AJAX_URL_COMMIT,
				type: "POST",
				processData: false, // Don't process the files
				contentType: false, 
				data: form,
				dataType: "JSON"
			}).done(function(data) {
				//$('#group_name').html('');
				
				if (data.code == 0) {
					window.location.href = data.redirect;
				} else {
					var m = data.message;
						
					if (m.alias!= "") {
						$('#alias').val('');
						$('#alias').attr('placeholder', m.alias);
						var c = $("#alias").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
					
					if (m.display_name!= "") {
						$('#display_name').val('');
						$('#display_name').attr('placeholder', m.display_name);
						var c = $("#display_name").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
										
				}
				
			});
			
			
			
			
			
		});
    },
    init: function() {
		BACKEND.commit();
		//BACKEND.initDropdownlistGroup(groupName);
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
	initDropdownlistSmsCard: function(data) {
        var source = ["sms", "card"];
        $("#jqxDropdownlistSmsCard").jqxDropDownList({checkboxes: true, source: source, selectedIndex: 1, width: '100%', height: '25', theme: THEME, placeHolder: "Vui lòng chọn"});

        var arr = data.split(',');
        for (var i = 0; i < arr.length; i++) {
            $("#jqxDropdownlistSmsCard").jqxDropDownList('checkItem', arr[i]);
        }
    },
	loadGroup: function(){
        $.ajax({
                url: BACKEND.AJAX_URL_GROUP,
                type: 'GET',
                dataType: 'JSON',
                data: {}
            }).done(function(response) {
                //arrGroup = JSON.parse(response);
				arrGroupp = response;
				
            })
    },
	initDropdownlistGroup: function(data) {
        //var source = ["","New", "Hot"];
		var source = arrGroup;
		//alert(arrGroup);
		//source[0] = 'New';
		//source[1] = 'Hot';
		
        $("#jqxDropdownlistGroup").jqxDropDownList({source: source, /*selectedIndex: 0,*/ width: '50%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});
			
		if(data != ''){
			$("#jqxDropdownlistGroup").jqxDropDownList('selectItem',data);
		}
		
    }
	
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

 