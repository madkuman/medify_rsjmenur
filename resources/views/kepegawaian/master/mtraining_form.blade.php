<!--  MODAL TAMBAH MASTER PELATIHAN -->
<div class="modal fade" id="add-mtraining" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header mt-20">
				<div class="col-8">
					<h4 class="modal-title">Tambah Pelatihan</h4>
					<p>Lengkapi Data Master Pelatihan</p>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form method="POST" action="{{ route('add-mtraining') }}" enctype="multipart/form-data" id="form-add-mtraining">
				{{csrf_field()}}
				<div class="modal-body mx-20">
					<div class="form-group">
						<label class="col-form-label">Nama Pelatihan</label>
						<input type="text" name="name" placeholder="Masukkan nama master pelatihan" class="form-control"
						autocomplete="off" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary save-button">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL EDIT PELATIHAN -->
<div class="modal fade" id="edit-mtraining" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header mt-20">
				<div class="col-8">
					<h4 class="modal-title">Ubah Data Pelatihan</h4>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form method="POST" action="" enctype="multipart/form-data" id="form-edit-mtraining">
				{{csrf_field()}}
				<div class="modal-body mx-20">
					<div class="form-group">
						<label class="col-form-label">Nama Pelatihan</label>
						<input type="text" name="name" placeholder="Masukkan nama master pelatihan" class="form-control" 
						id="nama-mtraining" autocomplete="off" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary save-button">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>