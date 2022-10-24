<!-- MODAL TAMBAH DEPARTEMEN -->
<div class="modal fade" id="add-mdepartment" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header mt-20">
				<div class="col-8">
					<h4 class="modal-title">Tambah Departemen</h4>
					<p>Lengkapi Data Master Departemen</p>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form method="POST" action="{{ route('add-mdepartment') }}" enctype="multipart/form-data" id="form-add-mdepartment">
				{{csrf_field()}}
				<div class="modal-body mx-20">
					<div class="form-group">
						<label class="col-form-label">Nama Departemen</label>
						<input type="text" name="name" placeholder="Masukkan nama master pangkat" class="form-control"
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

<!-- MODAL EDIT DEPARTEMEN -->
<div class="modal fade" id="edit-mdepartment" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header mt-20">
				<div class="col-8">
					<h4 class="modal-title">Ubah Data Departemen</h4>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form method="POST" id="form-edit-mdepartment" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="modal-body mx-20">
					<div class="form-group">
						<label class="col-form-label">Nama Departemen</label>
						<input type="text" name="name" placeholder="Masukkan nama master pangkat" class="form-control" 
						id="nama-mdepartment" autocomplete="off" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary save-button">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>