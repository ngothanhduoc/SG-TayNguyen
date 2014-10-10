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
    AJAX_URL_COMMIT: '/backend/ajax/addmenu',
    commit: function() {
        $('#frm-add-menu').submit(function(e) {
			e.preventDefault();
			$('#loading').show();
			$('button:submit').attr("disabled", true);			
			var form = new FormData ($('#frm-add-menu')[0]);
                        if($('#jqxDropdownlistGroup').val() != ''){
                            form.append("group_name", arrName[$('#jqxDropdownlistGroup').val()]);
                        }
			console.log(form);
			$.ajax({
				url: BACKEND.AJAX_URL_COMMIT,
				type: "POST",
				processData: false, // Don't process the files
				contentType: false, 
				data: form,
				dataType: "JSON"
			}).done(function(data) {
				$('#group_name').html('');
				
				if (data.code == 0) {
					setTimeout(function(){
					window.location.href = data.redirect,1000});
				} else {
					var m = data.message;
										
					if (m.url!= "") {
						$('#url').val('');
						$('#url').attr('placeholder', m.url);
						var c = $("#url").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
					if (m.name_display!= "") {
						$('#name_display').val('');
						$('#name_display').attr('placeholder', m.name_display);
						var c = $("#name_display").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
					if (m.name != "") {
						$('#name').val('');
						$('#name').attr('placeholder', m.name);
						var c = $("#name").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
					if (m.group_name!= "") {
						$('#group_name').html('');
						$('#group_name').html(m.group_name);
						var c = $("#group_name").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
					
				}
				$('#loading').hide();
				$('button:submit').attr("disabled", false);				
			});
			
			
			
			
			
		});
    },
    init: function() {
		BACKEND.commit();
		BACKEND.initDropdownlistGroup(groupName);
        //BACKEND.initDropdownlistType(TYPE);
        //BACKEND.initDropdownlist('IOS');
        //BACKEND.initJqxInput(LIST_NPH);//autocomplet
		//BACKEND.initDropdownlistSmsCard(SMSCARD);
    },
    initJqxInput: function(arr) {
        $("#txt_nph").jqxInput({source: arr, theme: THEME});
    },
    initDropdownlist: function(platform) {
        var source = ["Android", "IOS", "Java"];
		
        $("#jqxDropdownlist").jqxDropDownList({checkboxes: true, source: source, selectedIndex: 1, width: '100%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});

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

 