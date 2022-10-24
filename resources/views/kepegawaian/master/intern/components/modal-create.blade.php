<div id="modal_tambah_intern" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Jabatan Intern </h4>
            </div>
            <form action="" id="form_tambah" method="POST">
				{{csrf_field()}}
				<div class="col-md-12">
					<div class="form-group">
						<label>Nama Kualifikasi</label>
						<input class="form-control" type="text" placeholder="Masukkan Nama Kualifikasi" name="nama" autocomplete="off" required>
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