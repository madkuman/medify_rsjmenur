<!-- MODAL TAMBAH PELATIHAN -->
<div class="modal fade" id="add-mappretiation" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header mt-20">
				<div class="col-8">
					<h4 class="modal-title">Tambah Tanda Jasa</h4>
					<p>Lengkapi Data Master Tanda Jasa</p>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form method="POST" action="{{ route('add-mappretiation') }}" enctype="multipart/form-data" id="form-add-mappretiation">
				{{csrf_field()}}
				<div class="modal-body mx-20">
					<div class="form-group">
						<label class="col-form-label">Nama Tanda Jasa</label>
						<input type="text" name="name" placeholder="Masukkan nama master tanda jasa" class="form-control"
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
<div class="modal fade" id="edit-mappretiation" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header mt-20">
				<div class="col-8">
					<h4 class="modal-title">Ubah Data Tanda Jasa</h4>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form method="POST" action="" id="form-edit-mappretiation" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="modal-body mx-20">
					<div class="form-group">
						<label class="col-form-label">Nama Tanda Jasa</label>
						<input type="text" name="name" placeholder="Masukkan nama master tanda jasa" class="form-control" 
						id="nama-mappretiation" autocomplete="off" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary save-button">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>