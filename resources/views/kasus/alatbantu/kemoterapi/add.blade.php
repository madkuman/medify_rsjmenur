<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url()->current()}}/create" method="POST">
			{{csrf_field()}}
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Asesmen Kemoterapi</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-md-5 col-12">
							<h5>Keadaan</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Keadaan Umum</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keadaan_umum" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pemeriksaan Fisik : GCS</label>
								<div class="col-12">
									<input type="text" class="form-control" name="gcs" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pemeriksaan Fisik : TD</label>
								<div class="col-12">
									<input type="text" class="form-control" name="td" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pemeriksaan Fisik : N</label>
								<div class="col-12">
									<input type="text" class="form-control" name="n" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pemeriksaan Fisik : RR</label>
								<div class="col-12">
									<input type="text" class="form-control" name="rr" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pemeriksaan Fisik : Suhu</label>
								<div class="col-12">
									<input type="text" class="form-control" name="suhu" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pemeriksaan Regional</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="sull">
									<span class="css-control-indicator"></span> Sull
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="cervical">
									<span class="css-control-indicator"></span> Cervical
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="thorax">
									<span class="css-control-indicator"></span> Thorax
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="abdomen">
									<span class="css-control-indicator"></span> Abdomen
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="ekstremitas">
									<span class="css-control-indicator"></span> Ekstremitas
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pemeriksaan Penunjang</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="ecg">
									<span class="css-control-indicator"></span> ECG
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="lab">
									<span class="css-control-indicator"></span> Lab
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="ro">
									<span class="css-control-indicator"></span> Ro
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="ct_scan">
									<span class="css-control-indicator"></span> CT Scan
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="mri">
									<span class="css-control-indicator"></span> MRI
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pemeriksaan Penunjang Lainnya (yang tidak tercantum diatas)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="penunjang_lainnya" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-1 full-only"></div>
						<div class="col-md-5 col-12">
							<h5>Asesmen</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Nilai Kriteria Karnovsky</label>
								<div class="col-12">
									<textarea class="form-control" name="karnovsky"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Nilai Kriteria ECOG</label>
								<div class="col-12">
									<textarea class="form-control" name="ecog"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Diagnosa Medis</label>
								<div class="col-12">
									<textarea class="form-control" name="diagnosa_medis"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Terapi (Kemoterapi)</label>
								<div class="col-12">
									<textarea class="form-control" name="terapi"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Penjelasan pada penderita dan keluarga (Informed Consent)</label>
								<div class="col-12">
									<select class="form-control" name="penjelasan">
										<option value="Ya" selected>Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
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
				</div>
			</div>
			
		</div><!-- /.modal-dialog -->
	</form>
</div><!-- /.modal -->
</div>