<div class="modal" id="modal-kegiatan" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" >
			<form action="{{url()->current()}}/create" method="POST">
				{{csrf_field()}}
				<input type='hidden' value="0" name="id">
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Form Evaluasi Kegiatan Pengendalian</h3>
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
								<h4>SKALA</h4>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label>Skala Kemungkinan</label>
									<input type="number" name="skala_kemungkinan" class="form-control" autocomplete="off">
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label>Skala Dampak</label>
									<input type="number" name="skala_dampak" class="form-control" autocomplete="off">
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label>Skala Status Resiko</label>
									<input type="number" name="skala_status_resiko" class="form-control" autocomplete="off">
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Kreteria Resiko</label>
									<select name="kreteria_resiko" class="form-control js-select2" style="width: 100%">
										<option value="Rendah" selected>Rendah</option>
										<option value="Moderate">Moderate</option>
										<option value="Tinggi">Tinggi</option>
									</select>
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