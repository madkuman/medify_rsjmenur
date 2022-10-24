<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<form action="{{url()->current()}}/create" method="POST">
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Pengkajian Umum Fungsional</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						{{csrf_field()}}
						<div class="col-12">
							<h5>Pengkajian Fungsi Sensorik</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="penglihatan">Penglihatan</label>
								<div class="col-12">
									<select class="form-control" id="penglihatan" name="penglihatan">
										<option value="Normal">Normal</option>
										<option value="Kabur">Kabur</option>
										<option value="Kaca Mata">Kaca Mata</option>
										<option value="Lensa Mata">Lensa Mata</option>
										<option value="Lensa Kontak">Lensa Kontak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penciuman">Penciuman</label>
								<div class="col-12">
									<select class="form-control" id="penciuman" name="penciuman">
										<option value="Normal">Normal</option>
										<option value="Tidak Normal">Tidak Normal</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pendengaran">Pendengaran</label>
								<div class="col-12">
									<select class="form-control" id="pendengaran" name="pendengaran">
										<option value="Normal">Normal</option>
										<option value="Tuli Kanan/Kiri">Tuli Kanan/Kiri</option>
										<option value="Alat bantu dengar kanan/kiri">Alat bantu dengar kanan/kiri</option>
									</select>
								</div>
							</div>
							<h5>Pengkajian Fungsi Kognitif</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="kognitif">Kognitif</label>
								<div class="col-12">
									<select class="form-control" id="kognitif" name="kognitif">
										<option value="Orientasi Penuh">Orientasi Penuh</option>
										<option value="Pelupa">Pelupa</option>
										<option value="Bingung">Bingung</option>
										<option value="Tidak dapat dimengerti">Tidak dapat dimengerti</option>
									</select>
								</div>
							</div>
							<h5>Pengkajian Fungsi Motorik</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="aktivitas">Aktivitas Sehari-hari</label>
								<div class="col-12">
									<select class="form-control" id="aktivitas" name="aktivitas">
										<option value="Mandiri">Mandiri</option>
										<option value="Bantuan Minimal">Bantuan Minimal</option>
										<option value="Bantuan Sebagian">Bantuan Sebagian</option>
										<option value="Bantuan Total">Bantuan Total</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="berjalan">Berjalan</label>
								<div class="col-12">
									<select class="form-control" id="berjalan" name="berjalan">
										<option value="Tidak ada kesulitan">Tidak ada kesulitan</option>
										<option value="Perlu bantuan">Perlu bantuan</option>
										<option value="Sering jatuh">Sering jatuh</option>
										<option value="Kelumpuhan">Kelumpuhan</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group">
						<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
					</div>
				</div>
			</div><!-- /.modal-dialog -->
		</form>
	</div><!-- /.modal -->
</div>