<div class="modal" id="modal-identifikasi" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" >
			<form action="{{url()->current()}}/create" method="POST">
				{{csrf_field()}}
				<input type='hidden' value="0" name="id">
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Form Identifikasi Resiko</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content">
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label>Penanggung Jawab</label>
									<select name="penanggung_jawab" class="form-control js-select2" style="width: 100%" data-tags="true">
										<option value="" selected disabled>Belum Ada Penanggung Jawab</option>
										@foreach ($penanggung_jawab as $item)
											<option value="{{ $item }}">{{ $item }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label>Tanggal Dibuat</label>
									<input type="text" name="created_at" class="form-control js-datepicker" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{date('d/m/Y')}}" autocomplete="off">
								</div>
							</div>
						</div>
						<hr class="my-5">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Pilih Indikator</label>
									<select name="indikator_id" class="form-control js-select2" style="width: 100%" data-tags="true">
										<option value="" selected>Indikator Baru</option>
										@foreach ($indikator_mutu as $item)
											<option value="{{ $item->id }}">{{ $item->judul }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Indikator Mutu</label>
									<textarea name="indikator_judul" class="form-control" rows="5"></textarea>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Kegiatan / Fungsi / Proses Bisnis</label>
									<textarea name="indikator_kegiatan" class="form-control" rows="5"></textarea>
								</div>
							</div>
						</div>
						<hr class="my-5">
						<div class="row">
							<div class="col-12">
								<h4>URAIAN RESIKO</h4>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Sasaran</label>
									<input type="text" name="resiko_sasaran" class="form-control">
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Uraian</label>
									<textarea name="resiko_uraian" class="form-control" rows="5"></textarea>
								</div>
							</div>
						</div>
						<hr class="my-5">
						<div class="row">
							<div class="col-12">
								<h4>PENYEBAB</h4>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Uraian</label>
									<textarea name="penyebab_uraian" class="form-control" rows="5"></textarea>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Internal / Eksternal</label>
									<select name="penyebab_intern_ekstern" class="form-control js-select2" style="width: 100%">
										<option value="Internal" selected>Internal</option>
										<option value="Eksternal">Eksternal</option>
									</select>
								</div>
							</div>
						</div>
						<hr class="my-5">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Dapat Diterima / Tidak</label>
									<select name="penerimaan" class="form-control js-select2" style="width: 100%">
										<option value="Dapat Diterima" selected>Dapat Diterima</option>
										<option value="Tidak Dapat Diterima">Tidak Dapat Diterima</option>
									</select>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Dampak</label>
									<textarea name="dampak" class="form-control" rows="5"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="pull-right">
									<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-click-animate btn-primary btn-simple">Simpan</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>