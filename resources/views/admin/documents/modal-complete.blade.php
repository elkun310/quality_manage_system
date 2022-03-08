<div class="modal fade" id="modal-complete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="" class="form-complete-document">
                <div class="modal-header">
                    <h4 class="modal-title">Hoàn thành hồ sơ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="complete_file" name="complete_file"
                                   data-error="complete_file" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf">
                            <label class="custom-file-label" for="complete_file">Chọn tài liệu</label>
                        </div>
                    </div>
                    <p class="text-danger no-padding error" data-error="complete_file"></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary btn-submit">Lưu</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>