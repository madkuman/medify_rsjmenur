<div class="modal" id="modal-kegiatan" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" >
			<form action="{{url()->current()}}/create" method="POST">
				{{csrf_field()}}
				<input type='hidden' value="0" name="id">
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Form Kegiatan Pengendalian</h3>
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
									<label>Uraian Resiko</label>
									<textarea name="uraian_resiko" class="form-control" rows="5"></textarea>
								</div>
							</div>
						</div>
						<hr class="my-5">
						<div class="row">
							<div class="col-12">
								<h4>KEGIATAN PENGENDALIAN</h4>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Standart / Yang Harus Ada</label>
									<input type="text" name="kegiatan_standart" class="form-control">
								</div>
							</div>
							<div class="col-12">
								<h5>YANG TERPASANG / SUDAH ADA</h5>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Uraian</label>
									<textarea name="kegiatan_terpasang_uraian" class="form-control" rows="5"></textarea>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Efektif / Tidak</label>
									<select name="kegiatan_terpasang_efektifitas" class="form-control js-select2" style="width: 100%">
										<option value="Efektif" selected>Efektif</option>
										<option value="Tidak Efektif">Tidak Efektif</option>
									</select>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Celah</label>
									<textarea name="kegiatan_terpasang_celah" class="form-control" rows="5"></textarea>
								</div>
							</div>
						</div>
						<hr class="my-5">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Rencana Tindak Lanjut</label>
									<textarea name="rencana" class="form-control" rows="5"></textarea>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Target Waktu</label>
									<input type="text" name="target_waktu" class="form-control">
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