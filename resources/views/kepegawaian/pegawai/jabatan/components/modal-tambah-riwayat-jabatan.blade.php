<div class="modal fade" id="modal-jabatan" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content"> 
			<form id="form-jabatan" method="POST" action="{{url()->current()}}" enctype="multipart/form-data">
			<div class="modal-header mt-20">
				<div class="col-8">
					<h4 class="modal-title"><span id="modal-option">Tambah</span> Jabatan</h4>
					<p>Lengkapi Data-Data Jabatan</p>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
				{{csrf_field()}}
				<div class="modal-body mx-20 pt-0">
					<input type="hidden" name="id" id="form-id" value="0">
					{{-- <div class="form-group">
						<label class="col-form-label">Departemen</label>
						<select class="form-control js-select2"  id="form-departemen" style="width: 100%" name="departemen" >
							<option value="" selected>— Pilih Departemen —</option> 
							@foreach ($master_departemen as $depart)
							  <option value="{{$depart->id}}"> {{$depart->nama}} </option>
							@endforeach
						</select>
					</div> --}}
					<div class="form-group">
						<label class="col-form-label">Jabatan</label>
						<select class="form-control js-select2"  id="form-select-jabatan" style="width: 100%" name="jabatan_id" required>
							<option value="" selected>— Pilih Jabatan —</option> 
							@foreach ($master_jabatan as $jabatan)
							  <option value="{{$jabatan->id}}"> {{$jabatan->nama}} </option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="col-form-label">Tanggal Surat</label>
						<div class="input-group">
							<input type="text" placeholder="Masukan tanggal surat" class="form-control datepicker" id="form-letter-date" name="tgl_surat" autocomplete="off" required>  
						</div>
					</div>
					<div class="form-group">
						<label class="col-form-label">No.Surat</label>
						<input type="text" class="form-control" id="form-letter-number" placeholder="Masukkan nomor surat" name="no_surat" autocomplete="off" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-alt-default btn-close" data-dismiss="modal">
						Tutup
					  </button>
					  <button class="btn btn-alt-primary btn-submit-create" type="submit" id="buttonSubmitCreate"><i class="fa fa-check"></i> Simpan</button>
					  <button class="btn btn-alt-primary" style="display: none" type="button"  id="buttonLoadingCreate" disabled>
						  <i class="fa fa-asterisk fa-spin"></i> Loading
					  </button>
				</div>
			</form>
		</div>
	</div>
</div>