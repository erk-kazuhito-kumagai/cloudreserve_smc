loadJs('js/ext/jquery.dataTables.min.js');
loadJs('js/ext/dataTables.bootstrap.js');
loadJs('js/ext/dataTables.tableTools.js');
loadJs('js/ext/classie.js');
loadJs('js/ext/modalEffects.js');


$(function () {
    var nRow2;
    var nRow3;
    var oTable = $('#table-editable').dataTable({
        "aLengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "All"] // change per page values here
        ],
        "sDom" : "<'row'<'col-md-6 filter-left'f><'col-md-6'T>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
        "oTableTools" : {
            "sSwfPath": "assets/plugins/datatables/swf/copy_csv_xls_pdf.swf",
            "aButtons":[
                {
                    "sExtends":"pdf",
                    "mColumns":[0, 1, 2, 3],
                    "sPdfOrientation":"landscape"
                },
                {
                    "sExtends":"print",
                    "mColumns":[0, 1, 2, 3],
                    "sPdfOrientation":"landscape"
                },{
                    "sExtends":"xls",
                    "mColumns":[0, 1, 2, 3],
                    "sPdfOrientation":"landscape"
                },{
                    "sExtends":"csv",
                    "mColumns":[0, 1, 2, 3],
                    "sPdfOrientation":"landscape"
                }
            ]
        },
        // set the initial value
        "iDisplayLength": 10,
        "bPaginate": false,
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page",
            "oPaginate": {
                "sPrevious": "Prev",
                "sNext": "Next"
            },
            "sSearch": "" 
        },
        "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0],
                visible: false
            }
        ]
    });
    
    
    var oTable2 = $('#table-editable2').dataTable({
        "aLengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "All"] // change per page values here
        ],
        "sDom" : "<'row'<'col-md-6 filter-left'f><'col-md-6'T>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
        "oTableTools" : {
            "sSwfPath": "assets/plugins/datatables/swf/copy_csv_xls_pdf.swf",
            "aButtons":[
            ]
        },
        // set the initial value
        "iDisplayLength": 10,
        "bPaginate": false,
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page",
            "oPaginate": {
                "sPrevious": "Prev",
                "sNext": "Next"
            },
            "sSearch": "" 
        },
        "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0],
                visible: false
            }
        ]
    });

	function editableTable() {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            
            var form = $("#frm3");
            $("#frm3examinationId").val(aData[0]);
            // $("#nRow").val(nRow);
            // alert(nRow);
            nRow2 = nRow;
			ajaxPostForm(event, form, form.attr('action'), getDetail);
			
            $('#modal-responsive').modal('show');
            return;
            
            var jqTds = $('>td', nRow);
            //jqTds[0].innerHTML = '<input type="hidden" class="form-control small" value="' + aData[0] + '">';
            jqTds[0].innerHTML = '<input type="text" class="form-control small" value="' + aData[1] + '">';
            jqTds[1].innerHTML = '<div class="text-center"><a class="edit btn btn-success" href="">Save</a> <a class="delete btn btn-danger" href=""><i class="fa fa-times-circle"></i> Remove</a></div>';
        }

        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            //oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            //oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[0].value, nRow, 1, false);
            oTable.fnUpdate('<div class="text-center"><a class="edit btn btn-dark" href=""><i class="fa fa-pencil-square-o"></i>Edit</a> <a class="delete btn btn-danger" href=""><i class="fa fa-times-circle"></i> Remove</a></div>', nRow, 2, false);
            oTable.fnDraw();
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            //oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            //oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            //oTable.fnUpdate('<a class="edit btn btn-dark" href=""><i class="fa fa-pencil-square-o"></i>Edit</a>', nRow, 2, false);
            oTable.fnUpdate(jqInputs[0].value, nRow, 1, false);
            oTable.fnUpdate('<a class="edit btn btn-dark" href=""><i class="fa fa-pencil-square-o"></i>Edit</a>', nRow, 2, false);
            oTable.fnDraw();
        }



        jQuery('#table-edit_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
        jQuery('#table-edit_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown

        var nEditing = null;

        $('#table-edit_new').click(function (e) {
            e.preventDefault();
            var aiNew = oTable.fnAddData(['', '',
                    '<p class="text-center"><a class="edit btn btn-dark" href=""><i class="fa fa-pencil-square-o"></i>Edit</a> <a class="delete btn btn-danger" href=""><i class="fa fa-times-circle"></i> Remove</a></p>'
            ]);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
        });

        $('#table-editable a.delete').live('click', function (e) {
            e.preventDefault();

            if (confirm("Are you sure to delete this row ?") == false) {
                return;
            }

            var nRow = $(this).parents('tr')[0];
            oTable.fnDeleteRow(nRow);

            // alert("Deleted! Do not forget to do some ajax to sync with backend :)");
        });

        $('#table-editable a.cancel').live('click', function (e) {
            e.preventDefault();
            if ($(this).attr("data-mode") == "new") {
                var nRow = $(this).parents('tr')[0];
                oTable.fnDeleteRow(nRow);
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        $('#table-editable a.edit').live('click', function (e) {
            e.preventDefault();
            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Save") {
                 /* This row is being edited and should be saved */
                 alert(1);
                saveRow(oTable, nEditing);
                nEditing = null;
                // alert("Updated! Do not forget to do some ajax to sync with backend :)");
            } else {
                 /* No row currently being edited */
                editRow(oTable, nRow);
                nEditing = nRow;
            }
        });

        $('.dataTables_filter input').attr("placeholder", "Search a user...");

    };
    
    function editableTable2() {
    	var nEditing = null;
    	$('#table-editable2 a.edit').live('click', function (e) {
            e.preventDefault();
            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                restoreRow(oTable2, nEditing);
                editRow(oTable2, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Save") {
                 /* This row is being edited and should be saved */
                saveRow(oTable2, nEditing);
                nEditing = null;
                // alert("Updated! Do not forget to do some ajax to sync with backend :)");
            } else {
                 /* No row currently being edited */
                editRow(oTable2, nRow);
                nEditing = nRow;
            }
        });
        
        
        function restoreRow(oTable2, nRow) {
            var aData = oTable2.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable2.fnUpdate(aData[i], nRow, i, false);
            }

            oTable2.fnDraw();
        }
        
        
        function saveRow(oTable2, nRow) {
            var jqInputs = $('input', nRow);
            //oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            //oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable2.fnUpdate(jqInputs[0].value, nRow, 1, false);
            oTable2.fnUpdate('<div class="text-center"><a class="edit btn btn-dark" href=""><i class="fa fa-pencil-square-o"></i>Edit</a> <a class="delete btn btn-danger" href=""><i class="fa fa-times-circle"></i> Remove</a></div>', nRow, 2, false);
            oTable2.fnDraw();
        }
        
        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            
            var form = $("#frm5");
            $("#frm5examinationItemId").val(aData[0]);
            nRow3 = nRow;
			ajaxPostForm(event, form, form.attr('action'), getDetailItem);
            $('#modal-responsive3').modal('show');
            return;
        }

    };

    editableTable();
    editableTable2();
    
	var callBack = function(response, dataType){
        if(checkError(response)==0) {
			//var jqInputs = $('input', nRow);
            oTable.fnUpdate(response.responseBody[0].examinationId, nRow2, 0, false);
            oTable.fnUpdate(response.responseBody[0].name, nRow2, 1, false);
            //oTable.fnUpdate('<div class="text-center"><a class="edit btn btn-dark" href=""><i class="fa fa-pencil-square-o"></i>Edit</a> <a class="delete btn btn-danger" href=""><i class="fa fa-times-circle"></i> Remove</a></div>', nRow, 2, false);
            oTable.fnDraw();
            $('#modal-responsive').modal('hide');
	    } else {
	    alert(response);
	        alert('error');
	    }
	}
	
	var callBack6 = function(response, dataType){
        if(checkError(response)==0) {
			//var jqInputs = $('input', nRow);
            oTable2.fnUpdate(response.responseBody[0].examinationItemId, nRow3, 0, false);
            oTable2.fnUpdate(response.responseBody[0].name, nRow3, 1, false);
            //oTable.fnUpdate('<div class="text-center"><a class="edit btn btn-dark" href=""><i class="fa fa-pencil-square-o"></i>Edit</a> <a class="delete btn btn-danger" href=""><i class="fa fa-times-circle"></i> Remove</a></div>', nRow, 2, false);
            oTable2.fnDraw();

            $('#modal-responsive3').modal('hide');
	    } else {
	    alert(response);
	        alert('error');
	    }
	}
	
    $('#modal-responsive').on('click', '.modal-footer .btn-primary', function(event) {
          
		var form = $("#frm");

		form.validate().settings.ignore = ":disabled,:hidden";
		if(form.valid()) {
			ajaxPostForm(event, form, form.attr('action'), callBack);
		}
	});
	
	$('#modal-responsive3').on('click', '.modal-footer .btn-primary', function(event) {
          
		var form = $("#frm6");

		form.validate().settings.ignore = ":disabled,:hidden";
		if(form.valid()) {
			ajaxPostForm(event, form, form.attr('action'), callBack6);
		}
	});
	
	
	var loadList = function(response, dataType){
        if(checkError(response)==0) {
			$.each(response.responseBody, function() {
			oTable.fnAddData([this.examinationId, this.name,
            '<p class="text-center"><a class="edit btn btn-dark" href=""><i class="fa fa-pencil-square-o"></i>Edit</a> <a class="delete btn btn-danger" href=""><i class="fa fa-times-circle"></i> Remove</a></p>'
		    ]);
				

			});
	    } else {
	    alert(response);
	        alert('error');
	    }
	}
	
	var loadItem = function(response, dataType){
        if(checkError(response)==0) {
        	oTable2.fnClearTable();
			$.each(response.responseBody, function() {
			oTable2.fnAddData([this.examinationItemId, this.name,
            '<p class="text-center"><a class="edit btn btn-dark" href=""><i class="fa fa-pencil-square-o"></i>Edit</a> <a class="delete btn btn-danger" href=""><i class="fa fa-times-circle"></i> Remove</a></p>'
		    ]);
				

			});
			$('#modal-responsive2').modal('show');
	    } else {
	    alert(response);
	        alert('error');
	    }
	}
	
	var getDetail = function(response, dataType){
        if(checkError(response)==0) {
        
            $("#examinationId").val(response.responseBody[0].examinationId);
			$("#name").val(response.responseBody[0].name);
			//$("#menu").val(response.responseBody[0].menu);
			$("#detail").val(response.responseBody[0].detail);
			$("#item1").val(response.responseBody[0].item1);
			
			$("#item1Class").val(response.responseBody[0].item1Class);
			$("#item1Valid").val(response.responseBody[0].item1Valid);
			$("#item1Default").val(response.responseBody[0].item1Default);
			$("#item1Disp").val(response.responseBody[0].item1Disp);
	    } else {
	    alert(response);
	        alert('error');
	    }
	}
	
	var getDetailItem = function(response, dataType){
        if(checkError(response)==0) {
        alert(response.responseBody[0].examinationItemId);
            $("#frm6examinationItemId").val(response.responseBody[0].examinationItemId);
			$("#frm6name").val(response.responseBody[0].name);
			$("#frm6val").val(response.responseBody[0].val);
			$("#frm6seq").val(response.responseBody[0].seq);
	    } else {
	    alert(response);
	        alert('error');
	    }
	}
	
	var form2 = $("#frm2");
	ajaxPostForm(null, form2, form2.attr('action'), loadList);
	
	
	$('.select-item').on('click', function(event) {
		var form4 = $("#frm4");
		$("#frm4examinationId").val($("#frm3examinationId").val());
		if($(this).hasClass('select-item1')) {
			$("#itemlineId").val(1);
		}
		ajaxPostForm(null, form4, form4.attr('action'), loadItem);
          
	});

});