<div id="edit_modal" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Jabatan Intern </h4>
            </div>
            <form action=""  id="form-edit" method="POST">
                {{csrf_field()}}

                <div class="d-none text-center" id="loading">
                    <i class="fa fa-spin fa-spinner fa-7x"></i>
                </div>

                <div class="d-none" id="edit-content">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama Kualifikasi</label>
                            <input class="form-control" type="text" placeholder="Masukkan Nama Kualifikasi" name="nama" autocomplete="off" id="nama" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <a id="del-btn">
                        <button type="submit" class="btn btn-primary pull-right" style="margin-left: 4px ;">Simpan</button>
                    </a>
                </div>
			</form>
        </div>
    </div>
</div>