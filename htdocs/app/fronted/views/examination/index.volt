<!-- START ROW -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-red">
                            <h3 class="panel-title"><strong>リスト </strong> 一覧</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 m-b-20">
                                    <div class="btn-group">
                                        <button id="table-edit_new" class="btn btn-danger">
                                            追加 <i class="fa fa-plus">ｄｄ</i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive table-red">
                                    <table class="table table-striped table-hover dataTable" id="table-editable">
                                        <thead>
                                            <tr>
                                                <th>表示名</th>
                                                <th visibility='collapse'></th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         
         
        <div class="row">
        <!-- MODAL WINDOW -->
        <div class="modal fade" id="modal-responsive" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title"><strong>検査項目編集</small></h4>
                    </div>
                    <div class="modal-body">
                    <form id="editForm" name="editForm" class="form-wizard" action="{{ url('examination/save/') }}">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">検査項目名</label>
                                    <input type="text" class="form-control required" name="name" id="name" placeholder="カテゴリー名">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="detail" class="control-label">詳細</label>
                                    <input type="text" class="form-control" id="detail" name="detail"  placeholder="詳細">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
<?php
for($i=1;$i<6;$i++) {
?>
                                <div class="form-group">
                                    <label for="item{{i}}" class="control-label">項目{{i}}</label><br>
                                    <select id='item{{i}}' name='item{{i}}'>
                                    <option value='0'>値を設定する場合は</option>
                                    <option value='1'>テキスト</option>
                                    <option value='2'>テキストエリア</option>
                                    <option value='3'>セレクト</option>
                                    <option value='4'>チェックボックス</option>
                                    <option value='5'>ラジオボタン</option>
                                    <option value='6'>画像</option>
                                    <option value='7'>日付（YYMMDD）</option>
                                    <option value='8'>日付（YYMM）</option>
                                    <option value='9'>日付（YYMMDD HH:MM）</option>
                                    <option value='10'>時間（YY:MM）</option>
                                    </select><br>
                                    <label for="item{{i}}Disp" class="control-label">カテゴリー名</label>
                                    <input type="text" class="form-control required" name="item{{i}}Disp" id="item{{i}}Disp" placeholder="表示名">
                                    <label for="item{{i}}Class" class="control-label">スタイル</label>
                                    <input type="text" class="form-control" name="item{{i}}Class" id="item{{i}}Class">
                                    <label for="item{{i}}Valid" class="control-label">バリデーション</label>
                                    <input type='button' value="バリデーション登録" class='selectValidation' itemNum={{i}} id="editValidation{{i}}"><br>
                                    <label for="item{{i}}Default" class="control-label">デフォルト値</label>
                                    <input type="text" class="form-control" name="item{{i}}Default" id="item{{i}}Default"  placeholder="デフォルト値">
                                    <input type='button' value="選択項目登録" class='selectItem' itemNum={{i}} id="editSelect{{i}}"><br>
                                    <input type='button' value="画像登録" class='selectImage' imageNum={{i}} id="editImage{{i}}">
                                </div>
<?php
}
?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="categoryFromDate" class="control-label">表示期間From</label>
                                    <input type="text" class="form-control" id="categoryFromDate" name="from" placeholder="2017/01/01">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="categoryToDate" class="control-label">To</label>
                                    <input type="text" class="form-control" id="categoryToDate" name="to" placeholder="2018/12/31">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-primary"><i class="fa fa-check"></i> 保存</button>
                    </div>
                    <input type="reset" style="display:none;">
                    <input type='hidden' id='editFormExaminationId' name='examinationId'>
                    {{ hidden_field(securityPlugin.getTokenKey(), 'value':securityPlugin.getToken()) }}
                    </form>
                </div>
            </div>
        </div>
        </div>
        
        
        <div class="modal" id="item-modal-responsive" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" id="item-modal-close" data-dismiss="modal" aria-hidden="false">×</button>
                        <h4 class="modal-title">項目追加</h4>
                    </div>
                    <div class="col-md-12 m-b-20">
                        <div class="btn-group">
                            <button id="item-table-edit-new" class="btn btn-danger">
                                追加 <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                    <table class="table table-striped table-hover dataTable" id="item-table-editable">
                        <thead>
                            <tr>
                                <th>表示名</th>
                                <th visibility='collapse'></th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal " id="item-edit-modal-responsive" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"  id="item-edit-modal-close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title"><strong>選択項目</strong></small></h4>
                    </div>
                    <div class="modal-body">
                    <form id="itemFrm" name="itemFrm" class="form-wizard" action="{{ url('examinationitem/save/') }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">選択項目</label>
                                    <input type="text" class="form-control required" id="itemEditFormName" name="name" placeholder="選択項目">
                                </div>
                                <div class="form-group">
                                    <label for="val" class="control-label">値</label>
                                    <input type="text" class="form-control required" id="itemEditFormVal" name="val" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="seq" class="control-label">シーケンス</label>
                                    <input type="text" class="form-control" id="itemEditFormSeq" name="seq" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-primary"><i class="fa fa-check"></i> Validate</button>
                    </div>
                    <input type="hidden" id="itemEditFormExaminationId" name="examinationId" value="">
                    <input type="hidden" id="itemEditFormExaminationItemId" name="examinationItemId" value="">
                    <input type="hidden" id="itemEditFormItemNum" name="itemNum" value="">
                    <input type="hidden" name="{{securityPlugin.getTokenKey()}}" value="{{securityPlugin.getToken()}}">
                    </form>
                </div>
            </div>
        </div>
        
        <div class="modal " id="image-modal-responsive" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"  id="image-modal-close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title"><strong>イメージ</strong></small></h4>
                    </div>
                    <div class="modal-body">
                    <form id="getImageForm" name="getImageForm" class="form-wizard" action="{{ url('examinationitem/saveimage/') }}">
                    	<div id="dragandrophandler">ここにドロップしてください。</div>
                    	<br><br>
						<div id="status1"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src="" id="dropImage" alt="avatar 4">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-primary"><i class="fa fa-check"></i> Validate</button>
                    </div>
                    <input type="hidden" id="getImageFormExaminationId" name="examinationId" value="">
                    <input type="hidden" id="getImageFormExaminationItemId" name="examinationItemId" value="">
                    <input type="hidden" id="getImageFormImageNum" name="imageNum" value="">
                    <input type="hidden" name="{{securityPlugin.getTokenKey()}}" value="{{securityPlugin.getToken()}}">
                    </form>
                </div>
            </div>
        </div>

        
        <div class="row">
        <form id="getForm" action="{{ url('examination/list/') }}" method="post">
        {{ hidden_field(securityPlugin.getTokenKey(), 'value':securityPlugin.getToken()) }}
        </form>
        <form id="getDetailForm" action="{{ url('examination/detail/') }}" method="post">
        <input type='hidden' id='getDetailFormExaminationId' name='examinationId'>
        {{ hidden_field(securityPlugin.getTokenKey(), 'value':securityPlugin.getToken()) }}
        </form>
        <form id="getItemForm" name="getItemForm" class="form-wizard" action="{{ url('examinationitem/list/') }}">
	    <input type="hidden" id="getItemFormExaminationId" name="examinationId" value="">
	    <input type="hidden" id="getItemFormItemNum" name="itemNum" value="">
	    <input type="hidden" name="{{securityPlugin.getTokenKey()}}" value="{{securityPlugin.getToken()}}">
	    </form>
	    <form id="getItemDetailForm" name="getItemDetailForm" class="form-wizard" action="{{ url('examinationitem/detail/') }}">
	    <input type="hidden" id="getItemDetailFormExaminationItemId" name="examinationItemId" value="">
	    <input type="hidden" id="getItemDetailFormItemNum" name="itemNum" value="">
	    <input type="hidden" name="{{securityPlugin.getTokenKey()}}" value="{{securityPlugin.getToken()}}">
	    </form>
        
        
            <div/>
<!-- END ROW -->
    <script>
    function sendFileToServer(formData,status)
{
    var uploadURL ="{{ url('examination/saveimage/') }}"; //Upload URL
    var extraData ={}; //Extra Data.
    var jqXHR=$.ajax({
            xhr: function() {
            var xhrobj = $.ajaxSettings.xhr();
            if (xhrobj.upload) {
                    xhrobj.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }
                        //Set progress
                        status.setProgress(percent);
                    }, false);
                }
            return xhrobj;
        },
    url: uploadURL,
    type: "POST",
    contentType:false,
    processData: false,
        cache: false,
        data: formData,
        success: function(data){
            status.setProgress(100);
  alert(data);
            $("#status1").append("File upload Done<br>");
        }
    });
  
    status.setAbort(jqXHR);
}
  
var rowCount=0;
function createStatusbar(obj)
{
     rowCount++;
     var row="odd";
     if(rowCount %2 ==0) row ="even";
     this.statusbar = $("<div class='statusbar "+row+"'></div>");
     this.filename = $("<div class='filename'></div>").appendTo(this.statusbar);
     this.size = $("<div class='filesize'></div>").appendTo(this.statusbar);
     this.progressBar = $("<div class='progressBar'><div></div></div>").appendTo(this.statusbar);
     this.abort = $("<div class='abort'>Abort</div>").appendTo(this.statusbar);
     obj.after(this.statusbar);
  
    this.setFileNameSize = function(name,size)
    {
        var sizeStr="";
        var sizeKB = size/1024;
        if(parseInt(sizeKB) > 1024)
        {
            var sizeMB = sizeKB/1024;
            sizeStr = sizeMB.toFixed(2)+" MB";
        }
        else
        {
            sizeStr = sizeKB.toFixed(2)+" KB";
        }
  
        this.filename.html(name);
        this.size.html(sizeStr);
    }
    this.setProgress = function(progress)
    {      
        var progressBarWidth =progress*this.progressBar.width()/ 100; 
        this.progressBar.find('div').animate({ width: progressBarWidth }, 10).html(progress + "% ");
        if(parseInt(progress) >= 100)
        {
            this.abort.hide();
        }
    }
    this.setAbort = function(jqxhr)
    {
        var sb = this.statusbar;
        this.abort.click(function()
        {
            jqxhr.abort();
            sb.hide();
        });
    }
}
function handleFileUpload(files,obj)
{
   for (var i = 0; i < files.length; i++)
   {
        var fd = new FormData($('#getImageForm').get(0));
        //var fd = new FormData();
        fd.append('file', files[i]);
        var status = new createStatusbar(obj); //Using this we can set progress.
        status.setFileNameSize(files[i].name,files[i].size);
        sendFileToServer(fd,status);
  
   }
}
$(document).ready(function()
{
var obj = $("#dragandrophandler");
obj.on('dragenter', function (e)
{
    e.stopPropagation();
    e.preventDefault();
    $(this).css('border', '2px solid #0B85A1');
});
obj.on('dragover', function (e)
{
     e.stopPropagation();
     e.preventDefault();
});
obj.on('drop', function (e)
{
  
     $(this).css('border', '2px dotted #0B85A1');
     e.preventDefault();
     var files = e.originalEvent.dataTransfer.files;
  
     //We need to send dropped files to Server
     handleFileUpload(files,obj);
});
$(document).on('dragenter', function (e)
{
    e.stopPropagation();
    e.preventDefault();
});
$(document).on('dragover', function (e)
{
  e.stopPropagation();
  e.preventDefault();
  obj.css('border', '2px dotted #0B85A1');
});
$(document).on('drop', function (e)
{
    e.stopPropagation();
    e.preventDefault();
});
  
});
    </script>
    <style>
#dragandrophandler
{
border:2px dotted #0B85A1;
width:500px;
color:#92AAB0;
text-align:left;vertical-align:middle;
padding:10px 10px 10 10px;
margin-bottom:10px;
font-size:200%;
}
.progressBar {
    width: 200px;
    height: 22px;
    border: 1px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
    display:inline-block;
    margin:0px 10px 5px 5px;
    vertical-align:top;
}
  
.progressBar div {
    height: 100%;
    color: #fff;
    text-align: right;
    line-height: 22px; /* same as #progressBar height if we want text middle aligned */
    width: 0;
    background-color: #0ba1b5; border-radius: 3px;
}
.statusbar
{
    border-top:1px solid #A9CCD1;
    min-height:25px;
    width:700px;
    padding:10px 10px 0px 10px;
    vertical-align:top;
}
.statusbar:nth-child(odd){
    background:#EBEFF0;
}
.filename
{
display:inline-block;
vertical-align:top;
width:250px;
}
.filesize
{
display:inline-block;
vertical-align:top;
color:#30693D;
width:100px;
margin-left:10px;
margin-right:5px;
}
.abort{
    background-color:#A8352F;
    -moz-border-radius:4px;
    -webkit-border-radius:4px;
    border-radius:4px;display:inline-block;
    color:#fff;
    font-family:arial;font-size:13px;font-weight:normal;
    padding:4px 15px;
    cursor:pointer;
    vertical-align:top
    }
</style>