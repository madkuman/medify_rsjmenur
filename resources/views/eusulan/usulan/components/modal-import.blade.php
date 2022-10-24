<div class="modal fade" id="modal-import" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url()->current()}}/import" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title" id="title-modal">Import</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>File</label>
                                    <input type="file" class="form-control" id="example-file-input" name="import" required="required">
                                    <a href="{{route('download-contoh-file-e-usulan')}}">Download Contoh Format File</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary btn-submit btn-click-animate" type="submit" id="btnSubmit">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>