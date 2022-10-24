<div id="editmodal" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Status Pegawai</h4>
            </div>
            <form action="" id="form-edit" autocomplete="off" method="POST">
                {{csrf_field()}}

                <div class="d-none text-center" id="loading">
                    <i class="fa fa-spin fa-spinner fa-7x"></i>
                </div>

                <div class="d-none" id="edit-content">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Status Pegawai</label>
                            <input class="form-control" id="status_edit" type="text" placeholder="Masukkan Status Pegawai" name="status">
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <a id="del-btn">
                        <button type="submit" class="btn btn-primary pull-right btn-submit" style="margin-left: 4px ;"> <i class="fa fa-spin fa-spinner fa-1x btn-spin"></i> Simpan</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>