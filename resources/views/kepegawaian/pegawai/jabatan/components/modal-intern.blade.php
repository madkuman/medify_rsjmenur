<div class="modal fade" id="modal-edit-intern" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header mt-20">
				<div class="col-8">
					<h4 class="modal-title">Ubah Data Jabatan Intern</h4>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-edit-intern" method="POST" action="{{url()->current()}}/edit-intern" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="modal-body mx-20">
					<div class="form-group">
						<label for="dep-bag-intern" class="col-form-label">Dep/Bagian</label>
						<input type="text" class="form-control" id="dep-bag-intern" name="intern_dep" value="{{$pegawai->intern_dep}}">
					</div>
					<!--
					<div class="form-group">
						<label for="jabatan-intern" class="col-form-label">Jabatan</label>
						<input type="text" class="form-control" id="jabatan-intern" name="intern_jabatan" value="{{$pegawai->intern_jabatan}}">
					</div>-->

					<div class="form-group">
						<label for="jabatan-intern" class="col-form-label">Jabatan</label>
						<select class="form-control js-select2-dynamic" name="intern_jabatan" style="width: 100%">
							<option value="" selected disabled>Pilih Jabatan</option>
							@foreach($master_jabatan_intern as $jab)
							<option value="{{$jab->nama}}" @if($pegawai->intern_jabatan == $jab->nama) selected @endif>{{$jab->nama}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="no-sp-intern" class="col-form-label">No. SP</label>
						<input type="text" class="form-control" id="no-sp-intern" name="intern_no_sp" value="{{$pegawai->intern_no_sp}}">
					</div>
					<div class="form-group">
						<label for="tgl-sp-intern" class="col-form-label">Tanggal SP </label>
						<div class="input-group">
							<input type="text" class="form-control combodate" id="sp-date-intern-edit" data-format="YYYY-MM-DD" data-template="D MMMM YYYY" name="intern_tgl_sp" required="required" value="{{$pegawai->intern_tanggal_sp_edit}}">  
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>