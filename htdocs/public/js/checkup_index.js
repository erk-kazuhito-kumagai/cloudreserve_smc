$('#navbar-menu li').eq(0).addClass('active');
loadJs('js/ext/jquery.dataTables.min.js');

$(function () {
    
    var nRowPre;
	var oTable = $('#table-editable').dataTable({
            sDom : "<'row'<'col-md-6 filter-left'f><'col-md-6'T>r>t<'row'<'col-md-6'i><'col-md-6'p>>"
            ,displayLength: 10
            ,searching: false
            ,columnDefs: [
                { targets: 0, visible: false },
                { targets: 1, width: 100 }
            ]

	});
	
	function editableTable() {
	    var nEditing = null;
	    
	    $('#table-edit_new').click(function (e) {
            e.preventDefault();
            
            $("form")[0].reset();
            $("#checkupEditFormCheckupId").val('');
            var aiNew = oTable.fnAddData(['', '',
                    '<p class="text-center"><a class="edit btn btn-dark" href=""><i class="fa fa-pencil-square-o"></i>Edit</a> <a class="delete btn btn-danger" href=""><i class="fa fa-times-circle"></i> Remove</a></p>'
            ]);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
        });
        
        function editRow(oTable, nRow) {
            var frm = $("#getCheckupDetailForm");
            nRowPre = nRow;
            if($('#getCheckupDetailFormCheckupId').val()) {
                ajaxPostForm(event, frm, frm.attr('action'), getDetail);
            }
            var aData = oTable.fnGetData(nRow);
            $('#modal-responsive').modal('show');
            return;
        }
        
        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }
        
        $('#table-editable').on('click','a.edit' ,function (e) {
            e.preventDefault();
            
            $("form")[0].reset();
            var nRow = $(this).parents('tr')[0];
            var aData = oTable.fnGetData(nRow);
            $("#checkupEditFormCheckupId").val(aData[0]);
            $("#getCheckupDetailFormCheckupId").val(aData[0]);
                
            editRow(oTable, nRow);
            nEditing = nRow;
        });
        
        $('#modal-responsive button.close').on('click', function (e) {
            e.preventDefault();
            if($('#checkupEditFormCheckupId').val()) {
                
                restoreRow(oTable, nEditing);
                nEditing = null;
            } else {
                //var nRow = $(this).parents('tr')[0];
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
            }
        });
        
        $('#table-editable').on('click', 'a.delete', function (e) {
            e.preventDefault();

            if (confirm("Are you sure to delete this row ?") == false) {
                return;
            }

            var nRow = $(this).parents('tr')[0];
            oTable.fnDeleteRow(nRow);
        });
	}
	
	$('#modal-responsive').on('click', '.modal-footer .btn-primary', function(event) {
          
		var frm = $("#checkupEditForm");
        
        $('#modal-responsive-loading').modal('show');
		frm.validate().settings.ignore = ":disabled,:hidden";
		if(frm.valid()) {
			ajaxPostForm(event, frm, frm.attr('action'), save);
			
		}
	});
	
	
	var loadList = function(response, dataType){

        if(checkError(response)==0) {
			$.each(response.responseBody, function() {
			
				oTable.fnAddData([this.checkupId, this.name,
	            '<p class="text-center"><a class="edit btn btn-dark" href=""><i class="fa fa-pencil-square-o"></i>Edit</a> <a class="delete btn btn-danger" href=""><i class="fa fa-times-circle"></i> Remove</a></p>'
			    ]);
				

			});
			if(response.responseBody.length) {
			
			}
			
	    } else {
	    alert(response);
	        alert('error');
	    }
	}
	
	var getDetail = function(response, dataType){
        if(checkError(response)==0) {
			$("#name").val(response.responseBody[0].name);
			$("#menu").val(response.responseBody[0].menu);
			$("#detail").val(response.responseBody[0].detail);
	    } else {
	    alert(response);
	        alert('error');
	    }
	}
	
	var save = function(response, dataType){
        if(checkError(response)==0) {
            oTable.fnUpdate(response.responseBody[0].checkupId, nRowPre, 0, false);
            oTable.fnUpdate(response.responseBody[0].name, nRowPre, 1, false);
            oTable.fnDraw();
            $('#modal-responsive-loading').modal('hide');
            $('#modal-responsive').modal('hide');
	    } else {
	    $('#modal-responsive-loading').modal('hide');
	    alert(response);
	        alert('error');
	    }
	    
	}
	
	editableTable();
	
	var frm = $("#getCheckupForm");
	ajaxPostForm(null, frm, frm.attr('action'), loadList);
	

});
