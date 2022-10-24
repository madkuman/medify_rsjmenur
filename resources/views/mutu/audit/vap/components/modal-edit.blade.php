<div class="modal" id="modal-edit-vap" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form action="{{url()->current()}}/create" method="POST">
		<div class="modal-dialog modal-lg">
			{{csrf_field()}}
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Edit Audit Ventilator Bundle Checklist</h3>
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
								<input type="text" class="js-datepicker form-control datepicker" class="form-control" name="tanggal" placeholder="Tanggal Kelahiran" data-autoclose="true" autocomplete="off">
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
							<div class="form-group row mb-5">
								<label class="col-12">No. Bed</label>
								<div class="col-12">
									<select class="js-select2 form-control" name="bed" style="width: 100%">
										<option value="1" selected>1</option>
										<option value="2">2</option>
										<option value="3">3</option>
									</select>
								</div>
							</div>	
						</div>
						<div class="col-1 full-only"></div>
						<div class="col-md-6 col-12 pt-20">
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="hob_30_45">
									<span class="css-control-indicator"></span>HOB >30-45
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="pengkajian_setiap_hari_terhadap_sedasi_dan_extubasi">
									<span class="css-control-indicator"></span>Pengkajian setiap hari terhadap sedasi dan extubasi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="hand_hygiene">
									<span class="css-control-indicator"></span>Hand hygiene
								</label>
							</div>	
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="oral_hygiene_4_6_jam_">
									<span class="css-control-indicator"></span>Oral Hygiene 4 – 6 jam 
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="penyikatan_gigi_setiap_12_jam">
									<span class="css-control-indicator"></span>Penyikatan gigi setiap 12 jam
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="suction_manajemen_sekresi">
									<span class="css-control-indicator"></span>Suction / manajemen sekresi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="profilaksis_peptic_ulcer">
									<span class="css-control-indicator"></span>Profilaksis peptic ulcer
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="dvt_profilaksis">
									<span class="css-control-indicator"></span>DVT Profilaksis
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