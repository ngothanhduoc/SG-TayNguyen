var FORM = null;
var statecreate = true;
$(document).ready(function() {
	FORM = $('form');
    //CKEDITOR.replace('desc');
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
    AJAX_URL_COMMIT: '/backend/ajax/accountedit/admin',
    commit: function() {
		   $('#frm-add-game').submit(function(e) {
			e.preventDefault();
			$('#loading').removeClass('load70');
			$('#loading').removeClass('load30');


			//setTimeout(function(){
			//$('#loading').addClass('load70');

			//var form = $(this).serializeObject();
			//var form = $('#frm-add-game').serialize();

			//setTimeout(function(){
			$('button:submit').attr("disabled", true);
			
			var form = new FormData ($('#frm-add-game')[0]);
			console.log(form);
			
			//form.append("desc", CKEDITOR.instances['desc'].getData());
			
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
				//$('#loading').addClass('load30');
				
				if (data.code == 0) {
					//window.location.href = data.redirect;
					location.reload();
				} else {
					var m = data.message;
					
					//$('.login-message').text(data.message);
				}
				$('button:submit').attr("disabled", false);
			});
			//$('#loading').addClass('load30');

			//},820);


			//},650);




			});
       
    },
    init: function() {
        //BACKEND.initDropdownlistType(TYPE);
        //BACKEND.initDropdownlist(PLATFORM);
        //BACKEND.initJqxInput(LIST_NPH);//autocomplet
		//BACKEND.initDropdownlistSmsCard(SMSCARD);
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
		$('#loading-input').css({display: 'inline'});
	},
	topLoading: function(){
		$('#loading-input').hide();
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

 