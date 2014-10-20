var FORM = null;
var statecreate = true;
$(document).ready(function() {
    FORM = $('form');
	
    CKEDITOR.replace('fulltext');
	 //-- init textbox nha phat hanh --------------------------------------------
//    BACKEND.init();
	
});

var BACKEND = {
    AJAX_URL_COMMIT: '/backend/ajax/addproduct',
    commit: function() {
		   $('#frm-add-article').submit(function(e) {
			e.preventDefault();
			
			$('button:submit').attr("disabled", true);
			
			var form = new FormData ($('#frm-add-article')[0]);
                       form.append("description", CKEDITOR.instances['fulltext'].getData());
                       
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
					setTimeout(function(){
					window.location.href = data.redirect,1000});
				} else {
					var m = data.message;
						
					if (m.name!= "") {
						$('#title').val('');
						$('#title').attr('placeholder', m.title);
						var c = $("#title").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
					
				}
				$('button:submit').attr("disabled", false);
			});
			
		});
       
    },
    init: function() {
       	BACKEND.commit();        
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
	startLoading: function(){
		$('#loading').show();
	},
	topLoading: function(){
		$('#loading').hide();
		$('button:submit').attr("disabled", false);
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

 