<div class="modal" id="modal-create-ido" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form action="{{url()->current()}}/create" method="POST">
		<div class="modal-dialog modal-lg">
			{{csrf_field()}}
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Audit IDO Bundle Checklist Baru</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-md-5 col-12">
							<div class="form-group mb-5">
								<label class=" mb-5">Tanggal</label>
								<input type="text" class="js-datepicker form-control datepicker" class="form-control" name="tanggal" placeholder="Tanggal " data-autoclose="true" autocomplete="off">
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Nama</label>
								<div class="col-12">
									<select class="js-select2 form-control" name="nama" style="width: 100%">
										<option value="Hari S" selected>Hari S</option>
										<option value="Aldi F">Aldi F</option>
										<option value="Farhan M">Farhan M</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-1 full-only"></div>
						<div class="col-md-6 col-12 pt-20">
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="cukur_dengan_e_clipper">
									<span class="css-control-indicator"></span>Cukur dengan E_clipper
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="waktu_cukur_2_jam_sebelum_operasi">
									<span class="css-control-indicator"></span>Waktu cukur 2 jam sebelum operasi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="mandi_cholrhexidine">
									<span class="css-control-indicator"></span>Mandi cholrhexidine
								</label>
							</div>	
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="antibiotic_1_jam_sebelum_insisi">
									<span class="css-control-indicator"></span>Antibiotic 1 jam sebelum insisi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="pasien_tidak_sedang_infeksi">
									<span class="css-control-indicator"></span>Pasien tidak sedang infeksi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="gula_darah_terkontrol">
									<span class="css-control-indicator"></span>Gula darah Terkontrol
								</label>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="form-group">
							<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.modal-dialog -->
	</form>
</div><!-- /.modal -->