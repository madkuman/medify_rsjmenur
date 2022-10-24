<div class="modal" id="addAnak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" >
			<form action="{{url()->current()}}/asesmen-awal/create" method="POST">
				{{csrf_field()}}
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Skrining Gizi Anak</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-12">
							<div class="form-group row mb-20">
								<label class="col-12">Pasien Tampak Kurus</label>
								<div class="col-12">
									<select class="form-control" id="kurus" name="kurus">
										<option value="0">Tidak</option>
										<option value="1">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-20">
								<label class="col-12">Terdapat Penurunan Berat Badan 1 Bulan Terakhir</label>
								<div class="col-12">
									<select class="form-control" id="turun_bb" name="turun_bb_anak">
										<option value="0">Tidak</option>
										<option value="1">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-20">
								<label class="col-12">Diarhea > 5 kali/hari dan muntah > 3 kali/hari dalam seminggu terakhir dan asupan makanan berkurang selama 1 minggu terakhir</label>
								<div class="col-12">
									<select class="form-control" id="kondisi_lain" name="kondisi_lain">
										<option value="0">Tidak</option>
										<option value="1">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-20">
								<label class="col-12">Terdapat kondisi atau penyakit yang memungkinkan malnutrisi</label>
								<div class="col-12">
									<select class="form-control" id="malnutrisi" name="malnutrisi">
										<option value="0">Tidak</option>
										<option value="1">Ya</option>
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
			</form>
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>