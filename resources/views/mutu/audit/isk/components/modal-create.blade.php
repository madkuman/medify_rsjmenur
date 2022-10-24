<div class="modal" id="modal-create-isk" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form action="{{url()->current()}}/create" method="POST">
		<div class="modal-dialog modal-lg">
			{{csrf_field()}}
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Audit ISK Bundle Checklist Baru</h3>
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
									<input type="checkbox" class="css-control-input" name="pemasangan_sesuai_indikasi">
									<span class="css-control-indicator"></span>Pemasangan sesuai indikasi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="apd_tepat">
									<span class="css-control-indicator"></span>APD Tepat
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="pemasangan_menggunakan_alat_steril">
									<span class="css-control-indicator"></span>Pemasangan menggunakan alat steril
								</label>
							</div>	
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="hand_hygiene">
									<span class="css-control-indicator"></span>Hand Hygiene
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="segera_dilepas_jika_tidak_indikasi">
									<span class="css-control-indicator"></span>Segera dilepas jika tidak indikasi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="pengisian_balon_sesuai_30_ml">
									<span class="css-control-indicator"></span>Pengisian balon sesuai 30 ml
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="fiksasi_kateter_dengan_plester">
									<span class="css-control-indicator"></span>Fiksasi kateter dengan plester
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="urine_bag_menggantung">
									<span class="css-control-indicator"></span>Urine bag menggantung
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