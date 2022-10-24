<!-- MODAL TAMBAH PELATIHAN -->
<div class="modal fade" id="add-mposition" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header mt-20">
				<div class="col-8">
					<h4 class="modal-title">Tambah Pangkat</h4>
					<p>Lengkapi Data Master Pangkat</p>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form method="POST" action="{{url()->current()}}/add" enctype="multipart/form-data" id="form-add-mposition">
				{{csrf_field()}}
				<div class="modal-body mx-20">
					<div class="form-group">
						<label class="col-form-label">Nama Pangkat</label>
						<input type="text" name="nama" placeholder="Masukkan nama master pangkat" class="form-control" 
						required autocomplete="off">
					</div>
					<div class="form-group">
						<label class="col-form-label">Nama Pendek 1</label>
						<input type="text" name="nama_pendek_1" placeholder="Masukkan nama mendek" class="form-control" 
						required autocomplete="off">
					</div>
					<div class="form-group">
						<label class="col-form-label">Nama Pendek 2</label>
						<input type="text" name="nama_pendek_2" placeholder="Masukkan nama pendek" class="form-control" 
						required autocomplete="off">
					</div>
					<div class="form-group">
						<label class="col-form-label">Usia Pensiun</label>
						<input type="number" name="usia" placeholder="Masukkan usia pensiun" class="form-control" 
						required autocomplete="off">
					</div>
					<div class="form-group">
						<label class="col-form-label">Strata</label>
						<input type="text" name="strata" placeholder="Masukkan strata pangkat" class="form-control" 
						required autocomplete="off">
					</div>
					<div class="form-group">
						<label class="col-form-label">Urutan Strata</label>
						<input type="number" name="urutan_strata" placeholder="Masukkan urutan strata" class="form-control" 
						required autocomplete="off">
					</div>
					<div class="form-group">
						<label class="col-form-label">Kenkatba</label>
						<input type="text" name="kenkatba" placeholder="Masukkan kenkatba" class="form-control" 
						required autocomplete="off">
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
<div class="modal fade" id="edit-mposition" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header mt-20">
				<div class="col-8">
					<h4 class="modal-title">Ubah Data Pangkat</h4>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form method="POST" action="" id="form-edit-mposition" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="modal-body mx-20">
					<div class="form-group">
						<label class="col-form-label">Nama Pangkat</label>
						<input type="text" name="nama" placeholder="Masukkan nama master pangkat" class="form-control" 
						id="nama-mposition" required autocomplete="off">
					</div>
					<div class="form-group">
						<label class="col-form-label">Nama Pendek 1</label>
						<input type="text" name="nama_pendek_1" placeholder="Masukkan nama mendek" class="form-control" 
						required autocomplete="off" id="nama-pendek1">
					</div>
					<div class="form-group">
						<label class="col-form-label">Nama Pendek 2</label>
						<input type="text" name="nama_pendek_2" placeholder="Masukkan nama pendek" class="form-control" 
						required autocomplete="off" id="nama-pendek2">
					</div>
					<div class="form-group">
						<label class="col-form-label">Usia Pensiun</label>
						<input type="number" name="usia" placeholder="Masukkan usia pensiun" class="form-control" 
						required autocomplete="off" id="usia-pensiun">
					</div>
					<div class="form-group">
						<label class="col-form-label">Strata</label>
						<input type="text" name="strata" placeholder="Masukkan strata pangkat" class="form-control" 
						required autocomplete="off" id="strata">
					</div>
					<div class="form-group">
						<label class="col-form-label">Urutan Strata</label>
						<input type="number" name="urutan_strata" placeholder="Masukkan urutan strata" class="form-control" 
						required autocomplete="off" id="urutan-strata">
					</div>
					<div class="form-group">
						<label class="col-form-label">Kenkatba</label>
						<input type="text" name="kenkatba" placeholder="Masukkan kenkatba" class="form-control" 
						required autocomplete="off" id="kenkatba">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary save-button">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>