<div class="modal fade" id="modal-edit" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-edit" enctype="multipart/form-data">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title" id="title-modal-edit"></h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        {{csrf_field()}}
                        <input type="hidden" name="id" id="edit-id" value="">
                        <div class="row">
                            <div class="col-12">
                                <label for="example-datepicker1">Tahun </label> : <h7><span id="edit-tahun"></span></h7><br>
                                <label for="example-datepicker1">Kategori </label> : <h7><span id="edit-kategori"></span></h7><br>
                                <label for="example-datepicker1">Pegawai  </label> : <h7><span id="edit-pegawai"></span></h7>
                            </div>
                            <div class="col-12">
                                <label>Input File</label>
                                <input type="file" class="form-control" id="example-file-input-edit" name="file" required="required">
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary btn-submit" type="submit" id="btnSubmitEdit"><i class="fa fa-plus"></i> Simpan</button>
                        <button class="btn btn-alt-primary btn-simple" style="display: none" type="button"  id="btnLoadingEdit">
                            <i class="fa fa-asterisk fa-spin"></i> Loading
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>