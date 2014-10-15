var FORM = null;
var statecreate = true;
$(document).ready(function() {
    FORM = $('form');
    CKEDITOR.replace('content');
	 //-- init textbox nha phat hanh --------------------------------------------
    
});

var BACKEND = {
    AJAX_URL_COMMIT: '/backend/ajax/addnewsevent',

    commit: function() {
		   $('#frm-add-newsevent').submit(function(e) {
			e.preventDefault();
			$('button:submit').attr("disabled", true);	
			var form = new FormData ($('#frm-add-newsevent')[0]);
			console.log(form);
                        var status = 0;
                        if($('#status').is(':checked'))
                            status=1;
                        
                        //form.append("id_game", 1);
                        form.append("status", status);
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
				
                                var m = data.message;
				if (data.code == 0) {
					//window.location.href = data.redirect;
                                        
				} else {
						
					
					if (m.description != "") {
						$('#description').val('');
						$('#description').attr('placeholder', m.description);
						var c = $("#description").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
					if (m.title != "") {
						$('#title').val('');
						$('#title').attr('placeholder', m.title);
						var c = $("#title").position().top;
						$('body,html').animate({scrollTop: c}, 800);
					}
                                       
                                        $('#game_name').html('');
                                        if (m.game_name != ""){
                                            $('#game_name').html('Vui lòng chọn!');
                                            var c = $("#jqxDropdownlistGame").position().top;
						$('body,html').animate({scrollTop: c}, 800);
                                        }
                                        $('#cat_name').html('');
                                        if (m.cat_name != ""){
                                            $('#cat_name').html('Vui lòng chọn!');
                                            var c = $("#jqxDropdownlistCat").position().top;
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
		BACKEND.initDropdownlistType(TYPE);
		BACKEND.initDropdownlistGame(GAME_INDEX);
                BACKEND.initDropdownlistCat(CAT_INDEX);
                BACKEND.initDropdownlistFeatured(FEATURED);
                BACKEND.initDropdownlistOrder(ORDER);
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
        var source = ["news", "event"];
        $("#jqxDropdownlistType").jqxDropDownList({source: source, selectedIndex: 1, width: '25%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});

        //var arr = data.split(',');
        if(data != ''){
            $("#jqxDropdownlistType").jqxDropDownList('selectItem', data);
        }
        
    },
    initDropdownlistFeatured: function(data) {
        var source = ["Active", "Block"];
        $("#jqxDropdownlistFeatured").jqxDropDownList({source: source, selectedIndex: 1, width: '25%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});

        //var arr = data.split(',');
        if(data != ''){
            $("#jqxDropdownlistFeatured").jqxDropDownList('selectItem', data);
        }
        
    },
    initDropdownlistOrder: function(data) {
        var source = ["Active", "Block"];
        $("#jqxDropdownlistOrder").jqxDropDownList({source: source, selectedIndex: 1, width: '25%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});

        //var arr = data.split(',');
        if(data != ''){
            $("#jqxDropdownlistOrder").jqxDropDownList('selectItem', data);
        }
        
    },
	initDropdownlistCat: function(data) {
        var source=CAT;
        $("#jqxDropdownlistCat").jqxDropDownList({ source: source, width: '50%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});
        
        if(data != ''){
            $("#jqxDropdownlistCat").jqxDropDownList('selectItem', data);
        }
    },
	startLoading: function(){
		$('#loading-input').css({display: 'inline'});
	},
	topLoading: function(){
		$('#loading-input').hide();
	},
	initDropdownlistGame: function(data) {
        //var source = ["","New", "Hot"];
		var source = GAME;
		//alert(arrGroup);
		//source[0] = 'New';
		//source[1] = 'Hot';
		
        $("#jqxDropdownlistGame").jqxDropDownList({source: source, /*selectedIndex: 0,*/ width: '50%', height: '25', theme: 'office', placeHolder: "Vui lòng chọn"});
			
	if(data != ''){
		$("#jqxDropdownlistGame").jqxDropDownList('selectItem',data);
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

 