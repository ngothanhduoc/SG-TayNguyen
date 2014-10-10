/* 
 Project     : 48c6c450f1a4a0cc53d9585dc0fee742
 Created on  : Mar 16, 2013, 11:29:15 PM
 Author      : Truong Khuong - khuongxuantruong@gmail.com
 Description :
 Purpose of the stylesheet follows.
 */
/*
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
*/
function backendloading() {
    //$('#backendload').show();
    //ShowLoadding();
}
function backendloaded() {
    //$('#backendload').hide();
    HideLoadding();

}
function ShowLoadding() {
    $("#loaddingbar").show();
    $("#loaddingbar div").stop(true).width(0).css({
        bottom: 1
    })
            .animate({
        width: '30%'
    }, 300)
            .animate({
        width: '50%'
    }, 600)
            .animate({
        width: '75%'
    }, 1200)
            .animate({
        width: '95%'
    }, 3000);
}
function HideLoadding() {
    $("#loaddingbar div").stop(true)
            .animate({
        width: '100%'
    }, 500, function() {
        $("#loaddingbar").hide();
    });

}
function ErrorMsg(message) {
    //Msg(message,'Error !','0x08')
    Msg('<p style="color:red;border-bottom: 1px dotted #ccc;padding-bottom: 6px;">Error Message !!!</p><p>' + message + '</p>');
}
function WarningMsg(message) {
    //Msg(message,'Warning !','0x12')
    Msg('<p style="color:orangered;border-bottom: 1px dotted #ccc;padding-bottom: 6px;">Warning Message !!</p><p>' + message + '</p>');
}
function NoticeMsg(message) {
    //Msg(message)
    Msg(
            '<p style="border-bottom: 1px dotted #ccc;padding-bottom: 6px;">Notice Message !!</p><p>' + message + '</p>',
            'Notice Message !', '0x00', 2000
            );
}
function Msg(message, title, type, timeout) {
    var msg, titcolor = 'border-bottom:1px solid #ccc;background-color:#efefef';
    if ($("#notications").length === 0)
        $('body').append('<div id="notications"></div>');
    if (title === undefined)
        title = 'Message';
    if (type === undefined)
        type = '0x00';
    if (type !== '0x00') {
        titcolor = 'color:#fff;';
        msg = $('<div class="centerscreen grid_8 d-p-b m-t-4 d-' + type + '"><div class="p-r l-h-20 p-l-8 b-' + type + '" style="' + titcolor + '">' + title + '<span class="msgclose p-a t-2 r-2 w-16 h-16 l-h-16 c-s-p t-a-c  t-d-n c-0xff h-c-0xff">×</span></div><div class="b-0xff t-a-j p-4 c-' + type + '">' + message + '</div></div>');
    } else
        msg = $('<div class="notice-box m-t-4"><div>' + message + '</div><div onclick="destroy_parent(this)" class="c-s-p notice-box-close-btn"></div></div>')
    msg.appendTo("#notications").delay(1000)
            .animate({bottom: '0%', right: '0%', marginRight: 0}, 2000, function() {
        $(this).removeClass('centerscreen');
    });
    $('.msgclose', msg).click(function() {
        msg.remove();
    });
    if (timeout !== undefined) {
        msg.delay(timeout)
                .animate({opacity: 0}, 2000, function() {
            $(this).remove();
        });
    }
}
function ConfirmMsg(_callback, _title, _btntitle) {
    if ($("#bckconfirmdialog").length === 0) {
        $('body').append('<div id="bckconfirmdialog"></div>');
    }
    $("#bckconfirmdialog").html('<p class="p-12">' + _title + '</p>').dialog({
        modal: true,
        //autoOpen        : option.autoOpen,
        width: 280,
        dialogClass: 'b-s-d-32 pie ',
        resizable: false,
        //width           :'auto',
        title: '<img class="p-a t-7 l-8" src="' + base_url + 'admincp/assets/libraries/images/16/keyamoon/spam.png"/><span class="p-l-20"> Xác nhận ?</span>',
        closeOnEscape: true,
        //hide                : "explode",
        buttons: {
            'Confirm': function() {
                _callback();
                $(this).dialog("close");
            },
            Cancel: function() {
                $(this).dialog("close");
            }
        }
    });
}
function uiMessage(msg, title, type) {
    //NoticeMsg(msg);return;
    if ($("#uiMessage").length === 0) {
        $('body').append('\
            <div id="uiMessage" onmouseover="stoptipui()" class="tranf-b-20 b-r-5 ui-corner-all d-p-n" style="position: fixed; left: 50%; top: 36px; padding: 8px;z-index: 99999;margin-left:-360px;">\
                <div class="ui-dialog-content ui-widget-content p-8 o-v-f-h o-v-f-x-a f-z-11" style="min-width: 720px;" > \
                </div>\
                <div class="p-a t-8 r-8 w-16 h-16 c-s-p t-a-c a t-d-n" onclick="untipui()" style="">×</div>\
            </div>\
        ');
    }
    if ($("#notications").length === 0) {
        $('body').append('<div id="notications"></div>');
    }
    if (title === undefined) {
        title = 'Message';
    }
    $('<div class="centerscreen m-t-4 b-d-c-ccc b-g-c-w grid_8"><h4 class="p-4 b-d-b-c-ddd">' + title + '</h4><p class="p-4">' + msg + '</p></div>')
            .appendTo("#notications").delay(1000)
            .animate({bottom: '0%', right: '0%', marginRight: 0}, 2000, function() {
        $(this).removeClass('centerscreen');
    }).delay(8000)
            .animate({opacity: 0}, 2000, function() {
        $(this).remove();
    });

}
function untipui() {
    $("#uiMessage").stop().hide();
}
function stoptipui() {
    $("#uiMessage").stop().css({display: "block", opacity: 1});
}
function bckdialog(_option) {
    var me = this;
    this.option = {
        type: "notice", //notice,error,question,custom
        title: null,
        message: null,
        uidialog: $("#dialog-message"),
        icon: null,
        hideclose: false,
        autoOpen: false,
        minwidth: '320px',
        height: 'auto',
        dialogClass: '',
        proc_start: null,
        proc_end: null,
        onload: null,
        onclose: null,
        onopen: null,
        callback: null,
        buttons: null
    };
    var option = this.option;
    if (_option) {
        //$.map(_option,function(value,key){
        //	option[key]=value;
        //});
        $.each(_option, function(index, value) {
            option[index] = value;
        });
        this.option = option;
    }
    if ($("#bckdialog").length === 0) {
        $('body').append('\
        <span class="d-p-n">\
            <div id="uiMessage" onmouseover="stoptipui()" class="tranf-b-20 b-r-5 ui-corner-all d-p-n" style="position: fixed; left: 50%; top: 36px; padding: 8px;z-index: 99999;margin-left:-360px;">\
                <div class="ui-dialog-content ui-widget-content p-8 o-v-f-h o-v-f-x-a f-z-11" style="min-width: 720px;" > \
                </div>\
                <div class="p-a t-8 r-8 w-16 h-16 c-s-p t-a-c a t-d-n" onclick="untipui()" style="">×</div>\
            </div>\
            <div id="loadding-dialog" class="uidialog" title="Loadding...">Processing. Please, wait...</div>\
            <div id="bckdialog" class="p-20" title="Notice Message !"></div>\
        </span>\
        ');
    }
    if (option.type === "notice") {
        if (option.icon === null)
            option.icon = "<img class='p-a t-7 l-8' src='" + base_url + "admincp/assets/libraries/ui/themes/base/images/dialog_warning.png'/>";
        option.title = "<font class='p-l-20'>" + (option.title === null ? "Notice Message !" : option.title) + "</font>";
    } else if (option.type === "error") {
        if (option.icon === null)
            option.icon = "<img class='p-a t-7 l-8' src='" + base_url + "admincp/assets/libraries/ui/themes/base/images/dialog_error.png'/>";
        option.title = "<font class='p-l-20 erc'>" + (option.title === null ? "Error Exception !" : option.title) + "</font>";
    }

    if (option.message === null || option.message === undefined) {
        //$("#dialog-message").html("Message type must be String or HTML DOM Element !");
        option.uidialog = $("#bckdialog");
    } else if (typeof(option.message) === "object") {
        option.uidialog = option.message;
    } else if (typeof(option.message) === "string") {
        $("#bckdialog").html('<div class="p-20">' + option.message + '</div>');
        option.buttons = {
            Close: function() {
                $(this).dialog("close");
            }
        };
        option.uidialog = $("#bckdialog");
    } else {
        $("#bckdialog").html("Message type must be String or HTML DOM element !");
        option.uidialog = $("#bckdialog");
    }

    return {
        open: function(str) {
            if (str) {
                $("#bckdialog").html('<div class="p-20">' + str + '</div>');
                option.buttons = {
                    Close: function() {
                        $(this).dialog("close");
                    }
                };
            }
            option.uidialog.dialog({
                modal: true,
                //autoOpen        : option.autoOpen,
                minwidth: option.minwidth,
                dialogClass: 'b-s-d-32 pie ' + option.dialogClass,
                resizable: false,
                width: 'auto',
                title: option.icon + option.title,
                closeOnEscape: true,
                //hide                : "explode",
                buttons: option.buttons,
                open: function(event, ui) {
                    if (option.onopen && typeof(option.onopen) === "function") {
                        try {
                            option.onopen();
                        } catch (e) {
                        }
                    }
                    $(event.target).dialog('widget')
                            .css({position: 'fixed'})
                            .position({my: 'center', at: 'center', of: window});
                },
                close: function(event, ui) {
                    if (option.onclose && typeof(option.onclose) === "function") {
                        try {
                            option.onclose();
                        } catch (e) {
                        }
                    }
                },
                create: function() {
                    if (option.hideclose === true) {
                        $(this).closest(".ui-dialog")
                                .find(".ui-dialog-titlebar-close")
                                .hide();
                    }
                }
            });
        },
        close: function() {
            option.uidialog.dialog('close');
        }
    };
}
function backend(_option) {
    var option = {
        url: null,
        data: null,
        datatype: "json",
        proc_start: null,
        proc_end: null,
        callback: null
    };
    if (_option)
        $.each(_option, function(index, value) {
            option[index] = value;
        });
    if (option.datatype.toUpperCase() === 'JSON') {
        option.data.ajaxtype = 'json';
    }
    return {
        call: function(_url, _data, _callback) {
            if (isrunning === true)
                return;
            if (PENDING === true)
                return;
            if (_url)
                option.url = _url;
            if (_data)
                option.data = _data;
            if (_callback)
                option.callback = _callback;
            if (typeof(option.proc_start) === 'function')
                option.proc_start();
            else {
                backendloading();
            }
            PENDING = true;
            jQuery.ajax({
                type: "POST",
                //cache:false,
                //timeout:10000,
                data: option.data,
                dataType: option.datatype,
                url: option.url,
                success: function(data_result) {
                    isrunning = false;
                    PENDING = false;
                    if (typeof(option.callback) === 'function')
                        option.callback(data_result);
                    if (typeof(option.proc_end) === 'function')
                        option.proc_end();
                    else {
                        backendloaded();
                    }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    isrunning = false;
                    PENDING = false;
                    if (typeof(option.proc_end) === 'function')
                        option.proc_end();
                    else {
                        backendloaded();
                    }
                    if (typeof($.jGrowl) == 'function') {
                        $.jGrowl("Sorry. Your request could not be completed.<br/> Please check your input data and try again.", {sticky: true, theme: 'growl-error', header: 'Error!'});
                    } else if (typeof(ErrorMsg) != 'function') {
                        bootbox.dialog({
                            message: "Sorry. Your request could not be completed.<br/> Please check your input data and try again.",
                            title: '<img class="p-a t-8 l-8 w-16 h-16" src="' + base_url + 'libraries/images/16/denied.png"> <font color="red">Error Message !</font>',
                        });
                    } else {
                        //ErrorMsg("Sorry. Your request could not be completed.<br/> Please check your input data and try again.");
                        bckdialog({
                            message: "Sorry. Your request could not be completed.<br/> Please check your input data and try again.",
                            type: 'error'
                        }).open();
                    }
                }
            });
        }
    };
}
function BrowseServer(elementid)
{
    if ($(elementid).length === 0)
        uiMessage("Input element is not exist.");
    try {
        window.KCFinder = {};
        window.KCFinder.callBack = function(url) {
            window.KCFinder = null;
            $(elementid).val(url);
        };
        window.open('/layout/inside/assets/libraries/kcfinder/browse.php?lang=vi', 'kcfinder_textbox',
                'status=0, toolbar=0, location=0, menubar=0, directories=0, resizable=1, scrollbars=0, width=700, height=500'
                );
    } catch (e) {
        ErrorMsg(e.message);
    }
}
function addRedactorEditor(Element) {
    Element.redactor({
        //air: true,
        //wym: true,
        buttons: ['html', 'formatting', '|', 'bold', 'italic', 'deleted', '|', 'unorderedlist', 'orderedlist', 'outdent', 'indent', 'alignment', '|', 'video', 'link', '|', 'fontcolor', 'backcolor']
                ,
        plugins: ['advanced']
    });
}
function addEditorContent(ElementID, height) {
    try {
        tinyMCE.init({// <![CDATA[
            // General options
//            document_base_url : "/",
//            relative_urls : true,
//            remove_script_host : true,
            language: 'en',
            mode: "exact",
            elements: ElementID,
            body_class: 'my-content',
            theme: "advanced",
            //skin : "o2k7",
            //skin_variant : "silver",
            //plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
            plugins: "backend,safari,pagebreak,autolink,lists,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,media,paste,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras",
            noneditable_regexp: /\[\[[^\]]+\]\]/g,
            height: height ? height : 500,
            width: "100%",
            extended_valid_elements: '*[*]',
            relative_urls: false, inline_styles: true,
            // Theme options
            theme_advanced_buttons1: "newdocument,undo,redo,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,outdent,indent,|,formatselect,fontselect,fontsizeselect",
            theme_advanced_buttons2: "forecolor,backcolor,styleprops,|,blockquote,link,unlink,|,hr,sub,sup,charmap,emotions,iespell,image,media,|,template,|,removeformat,visualaid,cleanup,help,code,fullscreen",
            theme_advanced_buttons3: "tablecontrols,|,mysplitbutton",
            theme_advanced_buttons4: "",
            theme_advanced_toolbar_location: "top",
            theme_advanced_toolbar_align: "left",
            theme_advanced_statusbar_location: "bottom",
            theme_advanced_resizing: true,
            jquery_url: '/layout/inside/assets/libraries/script/jquery-1.9.0.js',
            // Example content CSS (should be your site CSS)
            content_css: "/layout/inside/assets/libraries/typography/typography.css",
//            template_templates:[
//                {
//                        title       : "Backend Tabs Editor",
//                        src         : base_url+"backend/template/tab.html",
//                        description : "Backend Tabs Editor"
//                },
//                {
//                        title       : "Win Tabs Editor",
//                        src         : base_url+"backend/template/wintab.html",
//                        description : "Win Tabs Editor"
//                }
//            ],
            // Drop lists for link/image/media/template dialogs
            //template_external_list_url : "js/template_list.js",
            //external_link_list_url : "js/link_list.js",
            //external_image_list_url : "js/image_list.js",
            //media_external_list_url : "js/media_list.js",

            file_browser_callback: 'openKCFinder',
            setup: function(ed) {
                //ed.onInit.add(function(ed, evt) {
                //    tinymce.ScriptLoader.add(tinyMCE.baseURL+"/../script/mcontent.jquery.js");
                //    tinymce.ScriptLoader.loadQueue();
                //});
            }// ]]>
        });
    } catch (e) {
        ErrorMsg(e.message);
    }

}
function openKCFinder(field_name, url, type, win) {
    try {
        tinyMCE.activeEditor.windowManager.open({
            file: '/layout/inside/assets/libraries/kcfinder/browse.php?opener=tinymce&type=' + type,
            title: 'KCFinder',
            width: 700,
            height: 500,
            resizable: "yes",
            inline: true,
            close_previous: "no",
            popup_css: false
        }, {
            window: win,
            input: field_name
        });
    } catch (e) {
        ErrorMsg(e.message);
    }
    return false;
}

function BrowseServerCallBack(callback)
{
    try {
        window.KCFinder = {};
        window.KCFinder.callBack = function(url) {
            //url=url.replace(base_url+'0x4D/','');
            window.KCFinder = null;
            callback(url);
        };
        window.open('/layout/inside/assets/libraries/kcfinder/browse.php?lang=en', 'kcfinder_textbox',
                'status=0, toolbar=0, location=0, menubar=0, directories=0, resizable=1, scrollbars=0, width=700, height=500'
                );
    } catch (e) {
        ErrorMsg(e.message);
    }
}
function openKCFinderByPath(element, type)
{
    type = '&type=' + type;
    if ($(element).length === 0) {
        alert("Input element is not exist.");
        return;
    }
    try {
        window.KCFinder = {};
        window.KCFinder.callBack = function(url) {
            window.KCFinder = null;
            $(element).val(url);
        };
        window.open('/public/admin/editor/kcfinder/browse.php?lang=en' + type, 'kcfinder_textbox',
                'status=0, toolbar=0, location=0, menubar=0, directories=0, resizable=1, scrollbars=0, width=700, height=500'
                );
    } catch (e) {
        alert(e.message);
    }

}
function openKCFinderMulti(callback) {
    window.KCFinder = {
        callBackMultiple: function(files) {
            window.KCFinder = null;
            callback(files);
        }
    };
    window.open('/layout/inside/assets/libraries/kcfinder/browse.php?lang=en',
            'kcfinder_multiple', 'status=0, toolbar=0, location=0, menubar=0, ' +
            'directories=0, resizable=1, scrollbars=0, width=800, height=600'
            );
}
function openKCFinderMultiByPath(path, callback) {
    window.KCFinder = {
        callBackMultiple: function(files) {
            window.KCFinder = null;
            callback(files);
        }
    };
    window.open(base_url + path,
            'kcfinder_multiple', 'status=0, toolbar=0, location=0, menubar=0, ' +
            'directories=0, resizable=1, scrollbars=0, width=800, height=600'
            );
}

function setActiveMenu(page){
	$(document).ready(function(){
		var li = $('#main-menu li[page="'+page+'"]');
        li.addClass('current');		
    });
	
}
function setActiveSubMenu(page){
    page = page.toLowerCase();
    
    $(document).ready(function(){
        var lia = $('#main-menu li ul li[sub-page="'+page+'"]');
        lia.addClass('current');
    });
}


function setDefaultValueSelectBox(){
    $('select').each(function(){
        var val = $(this).attr('default-value');
        if(val != undefined){
            $(this).val(val);
        }
    });
}
function resetForm(){
    $('form').find("input[type=text],input[type=password],input[type=hidden],select, textarea").val("");
}
var localizationobj = {};
