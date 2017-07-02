$('#navbar-menu li').eq(2).addClass('active');
loadJs('js/ext/jquery.dataTables.min.js');

$(function () {
    
    var nRowPre;
    var nRowItemPre;
    
	var oTable = $('#table-editable').dataTable({
            sDom : "<'row'<'col-md-6 filter-left'f><'col-md-6'T>r>t<'row'<'col-md-6'i><'col-md-6'p>>"
            ,displayLength: 10
            ,searching: false
            ,columnDefs: [
                { targets: 0, visible: false },
                { targets: 1, width: 100 }
            ]

	});
	
	var oItemTable = $('#item-table-editable').dataTable({
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
            $("#editFormExaminationId").val('');
            var aiNew = oTable.fnAddData(['', '',
                    '<p class="text-center"><a class="edit btn btn-dark" href=""><i class="fa fa-pencil-square-o"></i>Edit</a> <a class="delete btn btn-danger" href=""><i class="fa fa-times-circle"></i> Remove</a></p>'
            ]);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
        });
        
        function editRow(oTable, nRow) {
            var frm = $("#getDetailForm");
            nRowPre = nRow;
            if($('#getDetailFormExaminationId').val()) {
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
            $("#editFormExaminationId").val(aData[0]);
            $("#getDetailFormExaminationId").val(aData[0]);
                
            editRow(oTable, nRow);
            nEditing = nRow;
        });
        
        $('#modal-responsive button.close').on('click', function (e) {
            e.preventDefault();
            if($('#editFormExaminationId').val()) {
                
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
	
	function editableItemTable() {
	    var nEditing = null;
	    
	    $('#item-table-edit-new').click(function (e) {
            e.preventDefault();
            
            $("form")[0].reset();
            $("#itemEditFormExaminationItemId").val('');
            var aiNew = oItemTable.fnAddData(['', '',
                    '<p class="text-center"><a class="edit btn btn-dark" href=""><i class="fa fa-pencil-square-o"></i>Edit</a> <a class="delete btn btn-danger" href=""><i class="fa fa-times-circle"></i> Remove</a></p>'
            ]);
            var nRow = oItemTable.fnGetNodes(aiNew[0]);
            editRow(oItemTable, nRow);
            nEditing = nRow;
        });
        
        function editRow(oItemTable, nRow) {
            var frm = $("#getItemDetailForm");
            nRowPre = nRow;
            if($('#getItemDetailFormExaminationItemId').val()) {
            alert( frm.attr('action'));
                ajaxPostForm(event, frm, frm.attr('action'), getItemDetail);
            }
            var aData = oItemTable.fnGetData(nRow);
            $('#item-edit-modal-responsive').modal('show');
            return;
        }
        
        function restoreRow(oItemTable, nRow) {
            var aData = oItemTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oItemTable.fnUpdate(aData[i], nRow, i, false);
            }

            oItemTable.fnDraw();
        }
        
        $('#item-table-editable').on('click','a.edit' ,function (e) {
            e.preventDefault();
            
            $("form")[0].reset();
            var nRow = $(this).parents('tr')[0];
            var aData = oItemTable.fnGetData(nRow);
            $("#itemEditFormExaminationItemId").val(aData[0]);
            $("#getItemDetailFormExaminationItemId").val(aData[0]);
                
            editRow(oItemTable, nRow);
            nEditing = nRow;
        });
        
        $('#item-edit-modal-responsive button.close').on('click', function (e) {
            e.preventDefault();
            if($('#itemEditFormExaminationItemId').val()) {
                
                restoreRow(oItemTable, nEditing);
                nEditing = null;
            } else {
                //var nRow = $(this).parents('tr')[0];
                oItemTable.fnDeleteRow(nEditing);
                nEditing = null;
            }
        });
        
        $('#item-table-editable').on('click', 'a.delete', function (e) {
            e.preventDefault();

            if (confirm("Are you sure to delete this row ?") == false) {
                return;
            }

            var nRow = $(this).parents('tr')[0];
            oItemTable.fnDeleteRow(nRow);
        });
	}
	
	$('#modal-responsive').on('click', '.modal-footer .btn-primary', function(event) {
          
		var frm = $("#editForm");
        
        $('#modal-responsive-loading').modal('show');
		frm.validate().settings.ignore = ":disabled,:hidden";
		if(frm.valid()) {
			ajaxPostForm(event, frm, frm.attr('action'), save);
			
		}
	});
	
	
	var loadList = function(response, dataType){

        if(checkError(response)==0) {
			$.each(response.responseBody, function() {
			
				oTable.fnAddData([this.examinationId, this.name,
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
	
	var loadItemList = function(response, dataType){
        if(checkError(response)==0) {
			//
			$.each(response.responseBody, function() {
			oItemTable.fnAddData([this.examinationItemId, this.name,
            '<p class="text-center"><a class="edit btn btn-dark" href=""><i class="fa fa-pencil-square-o"></i>Edit</a> <a class="delete btn btn-danger" href=""><i class="fa fa-times-circle"></i> Remove</a></p>'
		    ]);
				

			});
	    } else {
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
	
	var getItemDetail = function(response, dataType){
	        alert(1);
        if(checkError(response)==0) {

            alert(response.responseBody[0].name);
			$("#itemEditFormName").val(response.responseBody[0].name);
			$("#itemEditFormVal").val(response.responseBody[0].val);
			$("#itemEditFormSeq").val(response.responseBody[0].seq);
	    } else {
	    alert(response);
	        alert('error');
	    }
	}
	
	var save = function(response, dataType){
        if(checkError(response)==0) {
            oTable.fnUpdate(response.responseBody[0].examinationId, nRowPre, 0, false);
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
	
	
	$('.selectImage').click(function (e) {
        var imageNum = $(this).attr('imageNum');
        var examinationId = $('#editFormExaminationId').val();
        var form = $("#getImageForm");
    	$("#getImageFormImageNum").val(imageNum);
    	$("#getImageFormExaminationId").val(examinationId);
		//ajaxPostForm(null, form, form.attr('action'), loadImage);
		
		$("#dropImage").attr('src', form.attr('action') + examinationId + "/" + imageNum);
		$('#image-modal-responsive').show('fast');

    });
    
    $('#image-modal-close').click(function(e) {
    	$('#image-modal-responsive').hide();
    });
    
    $('.selectItem').click(function (e) {
        var itemNum = $(this).attr('itemNum');
        var examinationId = $('#editFormExaminationId').val();
    	var form = $("#getItemForm");
    	$("#getItemFormItemNum").val(itemNum);
    	$("#getItemFormExaminationId").val(examinationId);
    	oItemTable.fnClearTable();
		ajaxPostForm(null, form, form.attr('action'), loadItemList);
    	$('#item-modal-responsive').show('fast');

    });
    
    $('#item-modal-close').click(function(e) {
    	$('#item-modal-responsive').hide();
    });
    
    
	
	editableTable();
	editableItemTable();
	
	var frm = $("#getForm");
	ajaxPostForm(null, frm, frm.attr('action'), loadList);
	

});
