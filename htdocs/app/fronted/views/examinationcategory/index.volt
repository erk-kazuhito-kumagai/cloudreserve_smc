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
                        <h4 class="modal-title"><strong>検査項目カテゴリー編集</small></h4>
                    </div>
                    <div class="modal-body">
                    <form id="categoryEditForm" name="categoryEditForm" class="form-wizard" action="{{ url('examinationcategory/save/') }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">カテゴリー名</label>
                                    <input type="text" class="form-control required" name="name" id="name" placeholder="カテゴリー名">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="menu" class="control-label">表示名</label>
                                    <input type="text" class="form-control" id="menu" name="menu" placeholder="表示名">
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
                    <input type='hidden' id='categoryEditFormExaminationCategoryId' name='examinationCategoryId'>
                    {{ hidden_field(securityPlugin.getTokenKey(), 'value':securityPlugin.getToken()) }}
                    </form>
                </div>
            </div>
        </div>
        </div>

        
        <div class="row">
        <form id="getCategoryForm" action="{{ url('examinationcategory/list/') }}" method="post">
        {{ hidden_field(securityPlugin.getTokenKey(), 'value':securityPlugin.getToken()) }}
        </form>
        <form id="getCategoryDetailForm" action="{{ url('examinationcategory/detail/') }}" method="post">
        <input type='hidden' id='getCategoryDetailFormExaminationCategoryId' name='examinationCategoryId'>
        {{ hidden_field(securityPlugin.getTokenKey(), 'value':securityPlugin.getToken()) }}
        </form>
        
            <div/>
<!-- END ROW -->