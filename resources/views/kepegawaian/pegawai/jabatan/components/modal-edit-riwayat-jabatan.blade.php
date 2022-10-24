<div class="modal fade" id="modal-edit-department" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header mt-20">
				<div class="col-8">
					<h4 class="modal-title">Ubah Data Jabatan</h4>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-edit-department" method="POST" action="" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="modal-body mx-20">
					<div class="form-group">
						<label for="nama_jabatan_edit" class="col-form-label">Jabatan</label>
						<input type="text" class="form-control" id="nama_jabatan_edit"  placeholder="Masukkan deskripsi Jabatan" name="nama" required>
					</div>
					<div class="form-group">
						<label for="tmtPendMiliter" class="col-form-label">TMT</label>
						<div class="input-group">
							<input type="text" class="form-control" id="tmt-edit" data-format="YYYY-MM-DD" data-template="D MMMM YYYY" name="tmt" required="required">  
						</div>
					</div>
					<div class="form-group">
						<label for="pendMiliter" class="col-form-label">No. ST</label>
						<input type="text" class="form-control" id="st_number" placeholder="" name="st_number">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-alt-default btn-close" data-dismiss="modal">
						Tutup
					  </button>
					  <button class="btn btn-alt-primary btn-submit-edit" type="submit" id="buttonSubmitEdit"><i class="fa fa-check"></i> Simpan</button>
					  <button class="btn btn-alt-primary" style="display: none" type="button"  id="buttonLoadingEdit" disabled>
						  <i class="fa fa-asterisk fa-spin"></i> Loading
					  </button>
				</div>
			</form>
		</div>
	</div>
</div>