$(document).ready(function() {
    //-- init element ----------------------------------------------------------
    //BACKEND.loadCat();
    BACKEND.init();
});

var arrCat = [];
var BACKEND = {
    API_URL_LIST: '/backend/listgame',
    AJAX_URL_UPDATE: '/backend/ajax/updatestatusgame/admin_game/index/game/id_game',
    
    AJAX_URL_DELETE: '/backend/ajax/deletegame/admin_game/index/game/id_game',
    
    API_URL_BC: '/inside/ajax/updatebc/game',
    API_URL_CAT: '/inside/ajax/get_list_cat/game_category',
    API_URL_SORT: '/inside/ajax/updatesort/game',
    OBJ_GRID: null,
    dataAdapter: function() {
        //-- init grid view --------------------------------------------------------
        var source = {
            datatype: "jsonp",
            datafields: [
                {name: 'id_game', type: 'int'},
                {name: 'full_name', type: 'string'},
                {name: 'platform', type: 'string'},
                {name: 'website', type: 'string'},
                {name: 'status', type: 'int'},
                {name: 'active_slide', type: 'int'},
                {name: 'active_slide_game', type: 'int'},
                {name: 'forum', type: 'string'},
				
            ],
            url: BACKEND.API_URL_LIST,
            sort: function() {
                BACKEND.OBJ_GRID.jqxGrid('updatebounddata', 'sort');
            },
            filter: function() {
                BACKEND.OBJ_GRID.jqxGrid('updatebounddata', 'filter');
            },
        };

        var dataAdapter = new $.jqx.dataAdapter(source, {
           
            beforeLoadComplete: function (records) {
                var p = dataAdapter.pagenum;
                var s = dataAdapter.pagesize;
                var j = p*s;

                for (var i = j; i < records.length; i++) {
                    records[i].idCoppy = records[i].id_game;
                    records[i].catName = arrCat[records[i].cat_id];
					
                    records[i].isSlidehome = records[i].id_game + ',' + records[i].active_slide;
                    records[i].isSlidelist = records[i].id_game + ',' + records[i].active_slide_game;
                    records[i].idStatus = records[i].id_game + ',' + records[i].status;
					
					
                };
				
                return records;
            }
        });

        return dataAdapter;
    },
    sttcolumnrender: function(row, datafield, value) {
        var index = row + 1;
        return '<div style="overflow: hidden; text-overflow: ellipsis; padding-bottom: 2px; text-align: left; margin:4px 2px 0px 4px;">' + index + '</div>';
    },
    toolscolumnrender: function(row, datafield, value) {
        return '<div class="grid-tools"><a href="#" onclick="BACKEND.gridEdit(' + value + ');return false;" class="grid-tools"><span class="ui-icon ui-icon-pencil"></span></a><a href="#" onclick="BACKEND.gridDelete(' + value + ');return false;"><span class="ui-icon ui-icon-trash"></span></a></div>';
    },
    rankingcolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        var str= '<a href="javascript:void(0)" onclick="BACKEND.setBc(' + res[0] + ');"><span class="block-span member">Set Doanh thu cao</span></a>';
        if (res[1] == 1) {
            str = '<a href="javascript:void(0)" onclick="BACKEND.unsetBc(' + res[0] + ');"><span class="block-span admin">Doanh thu cao</span></a>';
        }
        return str;
    },
	sortcolumnrender: function(row, datafield, value){
		var res = value.split(",");
		return '<div class="grid-tools"><input name="n_'+res[0]+'" id="n_'+res[0]+'" value="'+res[1]+'" size="5"><a href="javascript:void(0)" onclick=BACKEND.setSort("n_' + res[0] + '",'+res[0]+')>&nbsp;Set&nbsp;</a></div>';
	},
	sharemorecolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        var str= '<a href="javascript:void(0)" onclick="BACKEND.setShare(' + res[0] + ');"><span class="block-span member">Set Chia sẻ cao</span></a>';
        if (res[1] == 1) {
            str = '<a href="javascript:void(0)" onclick="BACKEND.unsetShare(' + res[0] + ');"><span class="block-span admin">Chia sẻ cao</span></a>';
        }
        return str;
    },
     statuscolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        var str= '<a href="javascript:void(0)" onclick="BACKEND.desable(' + res[0] + ');"><span class="data-status enable" title="Đã kích hoạt">&nbsp;</span></a>';
        if (res[1] == 0) {
            str = '<a href="javascript:void(0)" onclick="BACKEND.enable(' + res[0] + ');"><span class="data-status disable" title="Chưa kích hoạt">&nbsp;</span></a>';
        }
        return str;
    },
            
    isSlidehomecolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        var str= '<a href="javascript:void(0)" onclick="BACKEND.enableSlidehome(' + res[0] + ');"><span class="data-status disable" title="Chưa kích hoạt">&nbsp;</span></a>';
        if (res[1] == 1) {
            str = '<a href="javascript:void(0)" onclick="BACKEND.desableSlidehome(' + res[0] + ');"><span class="data-status enable" title="Đã kích hoạt">&nbsp;</span></a>';
        }
        return str;
    },
    isSlidelistcolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        var str= '<a href="javascript:void(0)" onclick="BACKEND.desableSlidelist(' + res[0] + ');"><span class="data-status enable" title="Đã kích hoạt">&nbsp;</span></a>';
        if (res[1] == 0) {
            str = '<a href="javascript:void(0)" onclick="BACKEND.enableSlidelist(' + res[0] + ');"><span class="data-status disable" title="Chưa kích hoạt">&nbsp;</span></a>';
        }
        return str;
    },
	
    init: function() {
        BACKEND.OBJ_GRID = $("#jqxgrid");
        var dataAdapter = BACKEND.dataAdapter();
        BACKEND.OBJ_GRID.jqxGrid({
            width: '100%',
            source: dataAdapter,
            columnsresize: true,
            sortable: true,
            theme: 'office',
            	columns: [
                {text: 'Stt', cellsrenderer: BACKEND.sttcolumnrender, width: 40, filterable: false},
                {text: 'NAME', datafield: 'full_name'},
		{text: 'PLATFORM', datafield: 'platform', width: 110},
		{text: 'WEBSITE', datafield: 'website'},
                {text: 'FORUM', datafield: 'forum'},
                {text: 'SLIDE HOME', datafield: 'isSlidehome', cellsrenderer: BACKEND.isSlidehomecolumnrender, width: 90,filterable: false, sortable: false},
                {text: 'SLIDE GAME', datafield: 'isSlidelist', cellsrenderer: BACKEND.isSlidelistcolumnrender, width: 90,filterable: false, sortable: false},
                {text: 'STATUS', datafield: 'idStatus', cellsrenderer: BACKEND.statuscolumnrender, width: 50,filterable: false, sortable: false},
                {text: 'Công cụ', datafield: 'id_game', cellsalign: 'center', align: 'center', cellsrenderer: BACKEND.toolscolumnrender, width: 80, sortable: false, filterable: false},
            ],
            virtualmode: true,
            rendergridrows: function() {
                return dataAdapter.records;
            },
            pageable: true,
            pagesize: 20,
            pagesizeoptions: ['20', '50', '100'],
            //--> Filter ---------------------------------------------------
            showfilterrow: true,
            filterable: true,
            localization: CUSTOMLANGUAGEVN
        });
    },
    resetGrid: function() {
        BACKEND.OBJ_GRID.jqxGrid('updatebounddata');
    },
    gridDelete: function(id) {
        if (confirm('Bạn có chắc muốn xóa ?')) {
            $.ajax({
                url: BACKEND.AJAX_URL_DELETE + '?id=' + id,
                type: 'GET',
                dataType: 'JSON',
                data: {}
            }).done(function(response) {
                console.log(response);
                if (response.code != 0) {
                    alert(response.message);
                } else {
                    BACKEND.resetGrid();
                }
            }).fail(function() {
                alert('Có lỗi ! Không kết nối đến dữ liệu được.');
            });
        }
    },
    gridEdit: function(id) {
        //loadPopup(id, false);
        window.location.href = '/backend/game/add?id=' + id;
    },
    setBc: function(id){
        $.ajax({
                url: BACKEND.API_URL_BC + '?id=' + id + '&st=1&field=sellmore',
                type: 'GET',
                dataType: 'JSON',
                data: {}
            }).done(function(response) {
                console.log(response);
                if (response.code != 0) {
                    alert(response.message);
                } else {
                    BACKEND.resetGrid();
                }
            }).fail(function() {
                alert('Có lỗi ! Không kết nối đến dữ liệu được.');
            });
    },
    unsetBc: function(id){
        $.ajax({
                url: BACKEND.API_URL_BC + '?id=' + id + '&st=0&field=sellmore',
                type: 'GET',
                dataType: 'JSON',
                data: {}
            }).done(function(response) {
                console.log(response);
                if (response.code != 0) {
                    alert(response.message);
                } else {
                    BACKEND.resetGrid();
                }
            }).fail(function() {
                alert('Có lỗi ! Không kết nối đến dữ liệu được.');
            });
    },
	 setShare: function(id){
        $.ajax({
                url: BACKEND.API_URL_BC + '?id=' + id + '&st=1&field=sharemore',
                type: 'GET',
                dataType: 'JSON',
                data: {}
            }).done(function(response) {
                console.log(response);
                if (response.code != 0) {
                    alert(response.message);
                } else {
                    BACKEND.resetGrid();
                }
            }).fail(function() {
                alert('Có lỗi ! Không kết nối đến dữ liệu được.');
            });
    },
    unsetShare: function(id){
        $.ajax({
                url: BACKEND.API_URL_BC + '?id=' + id + '&st=0&field=sharemore',
                type: 'GET',
                dataType: 'JSON',
                data: {}
            }).done(function(response) {
                console.log(response);
                if (response.code != 0) {
                    alert(response.message);
                } else {
                    BACKEND.resetGrid();
                }
            }).fail(function() {
                alert('Có lỗi ! Không kết nối đến dữ liệu được.');
            });
    },
	setSort: function(obj,id){
		var s = $("#"+obj).val();
		$.ajax({
                url: BACKEND.API_URL_SORT + '?id=' + id + '&st='+s,
                type: 'GET',
                dataType: 'JSON',
                data: {}
            }).done(function(response) {
                console.log(response);
                if (response.code != 0) {
                    alert(response.message);
                } else {
                    BACKEND.resetGrid();
                }
            }).fail(function() {
                alert('Có lỗi ! Không kết nối đến dữ liệu được.');
            });
	},
    loadCat: function(){
        $.ajax({
                url: BACKEND.API_URL_CAT,
                type: 'GET',
                dataType: 'JSON',
                data: {}
            }).done(function(response) {
                arrCat = response;                
            })
    },
    desable: function(id){
        $.ajax({
                url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=0&field=status',
                type: 'GET',
                dataType: 'JSON',
                data: {}
            }).done(function(response) {
                console.log(response);
                if (response.code != 0) {
                    alert(response.message);
                } else {
                    BACKEND.resetGrid();
                }
            }).fail(function() {
                alert('Có lỗi ! Không kết nối đến dữ liệu được.');
            });
    },
	enable: function(id){
        $.ajax({
                url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=1&field=status',
                type: 'GET',
                dataType: 'JSON',
                data: {}
            }).done(function(response) {
                console.log(response);
                if (response.code != 0) {
                    alert(response.message);
                } else {
                    BACKEND.resetGrid();
                }
            }).fail(function() {
                alert('Có lỗi ! Không kết nối đến dữ liệu được.');
            });
    },
    desableSlidehome: function(id){
        $.ajax({
                url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=0&field=active_slide',
                type: 'GET',
                dataType: 'JSON',
                data: {}
            }).done(function(response) {
                console.log(response);
                if (response.code != 0) {
                    alert(response.message);
                } else {
                    BACKEND.resetGrid();
                }
            }).fail(function() {
                alert('Có lỗi ! Không kết nối đến dữ liệu được.');
            });
    },
    enableSlidehome: function(id){
        $.ajax({
                url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=1&field=active_slide',
                type: 'GET',
                dataType: 'JSON',
                data: {}
            }).done(function(response) {
                console.log(response);
                if (response.code != 0) {
                    alert(response.message);
                } else {
                    BACKEND.resetGrid();
                }
            }).fail(function() {
                alert('Có lỗi ! Không kết nối đến dữ liệu được.');
            });
    },
    
    desableSlidelist: function(id){
        $.ajax({
                url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=0&field=active_slide_game',
                type: 'GET',
                dataType: 'JSON',
                data: {}
            }).done(function(response) {
                console.log(response);
                if (response.code != 0) {
                    alert(response.message);
                } else {
                    BACKEND.resetGrid();
                }
            }).fail(function() {
                alert('Có lỗi ! Không kết nối đến dữ liệu được.');
            });
    },
    enableSlidelist: function(id){
        $.ajax({
                url: BACKEND.AJAX_URL_UPDATE + '?id=' + id + '&st=1&field=active_slide_game',
                type: 'GET',
                dataType: 'JSON',
                data: {}
            }).done(function(response) {
                console.log(response);
                if (response.code != 0) {
                    alert(response.message);
                } else {
                    BACKEND.resetGrid();
                }
            }).fail(function() {
                alert('Có lỗi ! Không kết nối đến dữ liệu được.');
            });
    },
    
}