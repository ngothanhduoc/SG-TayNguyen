$(document).ready(function() {
    //-- init element ----------------------------------------------------------
    //BACKEND.loadCat();
    BACKEND.init();
});

var arrCat = [];
var BACKEND = {
    API_URL_LIST: '/backend/list/publisher',
    AJAX_URL_DELETE: '/backend/ajax/delete/admin_game/publisher/publisher/id_publisher',
   
    OBJ_GRID: null,
    dataAdapter: function() {
		
        //-- init grid view --------------------------------------------------------
        var source = {
            datatype: "jsonp",
            datafields: [
                {name: 'id_publisher', type: 'int'},
                {name: 'full_name', type: 'string'},
                {name: 'create_time', type: 'string'},
				{name: 'address', type: 'string'},
				{name: 'phone', type: 'string'},
				{name: 'website', type: 'string'},
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
					
                    records[i].idCoppy = records[i].id_publisher;
                    
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
        return '<div class="grid-tools"><a href="javascript:void(0)" onclick="BACKEND.gridEdit(' + value + ');return false;" class="grid-tools"><span class="ui-icon ui-icon-pencil"></span></a><a href="javascript:void(0)" onclick="BACKEND.gridDelete(' + value + ');return false;"><span class="ui-icon ui-icon-trash"></span></a></div>';
    },

	sortcolumnrender: function(row, datafield, value){
		var res = value.split(",");
		return '<div class="grid-tools"><input name="n_'+res[0]+'" id="n_'+res[0]+'" value="'+res[1]+'" size="5"><a href="javascript:void(0)" onclick=BACKEND.setSort("n_' + res[0] + '",'+res[0]+')>&nbsp;Set&nbsp;</a></div>';
	},
	
	statuscolumnrender: function(row, datafield, value) {
        var res = value.split(",");
        var str= '<a href="javascript:void(0)" onclick="BACKEND.desable(' + res[0] + ');"><span class="data-status enable" title="Đã kích hoạt">&nbsp;</span></a>';
        if (res[1] == 0) {
            str = '<a href="javascript:void(0)" onclick="BACKEND.enable(' + res[0] + ');"><span class="data-status disable" title="Chưa kích hoạt">&nbsp;</span></a>';
        }
        return str;
    },
	iconcolumnrender: function(row, datafield, value) {
        var img = '<img src="/uploads/image/fix/'+value+'" width="20" />';
        return '<div style="text-align:center; overflow: hidden; text-overflow: ellipsis; padding-bottom: 2px; margin:4px 2px 0px 4px;">' + img + '</div>';
    },
    init: function() {
        BACKEND.OBJ_GRID = $("#jqxgrid");
        var dataAdapter = BACKEND.dataAdapter();
        BACKEND.OBJ_GRID.jqxGrid({
            width: '100%',
            source: dataAdapter,
            columnsresize: true,
            sortable: true,
            //theme: 'energyblue',
			theme: 'office',
            //theme: 'summer',
			columns: [
                {text: 'STT', cellsrenderer: BACKEND.sttcolumnrender, width: 40, filterable: false},
                {text: 'FULL NAME', datafield: 'full_name'},
				{text: 'ADDRESS', datafield: 'address'},
				{text: 'PHONE', datafield: 'phone'},
				{text: 'WEBSITE', datafield: 'website'},
				{text: 'CREATE TIME', datafield: 'create_time'},
				{text: 'CÔNG CỤ', datafield: 'id_publisher', cellsalign: 'center', align: 'center', cellsrenderer: BACKEND.toolscolumnrender, width: 80, sortable: false, filterable: false},
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
        window.location.href = '/backend/game/addpublisher?id=' + id;
    },
    
    
}