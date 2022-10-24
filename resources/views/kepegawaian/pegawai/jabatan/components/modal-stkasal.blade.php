<div class="modal fade" id="modal-edit-kasal" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header mt-20">
				<div class="col-8">
					<h4 class="modal-title">Ubah Data Jabatan Sesuai ST Kasal</h4>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-edit-kasal" method="POST" action="{{url()->current()}}/edit-stkasal" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="modal-body mx-20">
					<div class="form-group">
						<label for="dep-bag-kasal" class="col-form-label">Dep/Bagian</label>
						<input type="text" class="form-control" id="dep-bag-kasal" placeholder="Masukkan nama departemen atau bagian" name="departemen" value="{{$pegawai->departemen}}">
					</div>
					<!-- 
					<div class="form-group">
						<label for="jabatan-kasal" class="col-form-label">Jabatan</label>
						<input type="text" class="form-control" id="jabatan-kasal" placeholder="Masukkan jabatan" name="jabatan" value="{{$pegawai->jabatan}}">
					</div> -->


					<div class="form-group">
						<label for="jabatan-intern" class="col-form-label">Jabatan</label>
						<select class="form-control js-select2-dynamic" name="jabatan"  style="width: 100%">
							<option value="" selected disabled>Pilih Jabatan</option>
							@foreach($master_jabatan_kasal as $jab)
							<option value="{{$jab->nama}}" @if($pegawai->jabatan == $jab->nama) selected @endif>{{$jab->nama}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="no-st-kasal" class="col-form-label">No. ST</label>
						<input type="text" class="form-control" id="no-st-kasal" placeholder="Masukkan nomor surat tugas" name="st_kasal_no_st" value="{{$pegawai->st_kasal_no_st}}">
					</div>
					<div class="form-group">
						<label for="no-sp-kasal" class="col-form-label">No. SP</label>
						<input type="text" class="form-control" id="no-sp-kasal" placeholder="Masukkan nomor surat perintah" name="st_kasal_no_sp" value="{{$pegawai->st_kasal_no_sp}}">
					</div>
					<div class="form-group">
						<label for="tgl-sp-kasal" class="col-form-label">Tanggal SP</label>
						<div class="input-group">
							<input type="text" class="form-control combodate" id="sp-date-kasal-edit" data-format="YYYY-MM-DD" data-template="D MMMM YYYY" name="sp_date" required="required" value="{{$pegawai->st_kasal_tanggal_sp_edit}}">  
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