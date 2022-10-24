<div class="modal fade" id="addModal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
	<div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form method="POST" action="{{url()->current()}}/create">
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header">
						<h3 class="block-title">Sepsis Baru</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
						{{csrf_field()}}

						<input type="hidden" name="lokasi_id" value="{{$kasus->lokasi->lokasi->id}}">
						<div class="row">
							<div class="col-12">
								<h6 class="pt-15">Tanda Sepsis</h6>
							</div>
							<div class="col-12">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="hipotermia" value="1">
										<span class="css-control-indicator"></span> Hipotermia dan/atau Hipertermia
									</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="hipotensi" value="1">
										<span class="css-control-indicator"></span> Hipotensi
									</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="menggigil" value="1">
										<span class="css-control-indicator"></span> Menggigil
									</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="hipoxia" value="1">
										<span class="css-control-indicator"></span> Hipoxia
									</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="anuria" value="1">
										<span class="css-control-indicator"></span> Anuria
									</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="leukositosis" value="1">
										<span class="css-control-indicator"></span> Leukositosis
									</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="shock" value="1">
										<span class="css-control-indicator"></span> Shock
									</label>
								</div>
							</div>

							<div class="col-12">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="kultur_darah" value="1">
										<span class="css-control-indicator"></span> Kultur Darah
									</label>
								</div>
							</div>
							<div class="col-12" id="kultur_darah_keterangan" style="display: none">
								<div class="form-group mb-5">
									<label>Kultur Darah Keterangan</label>
									<input type="text" class="form-control" name="kultur_darah_keterangan" id="kultur_darah_keterangan_text">
								</div>
							</div>

							<div class="col-12">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="kultur_urine" value="1">
										<span class="css-control-indicator"></span> Kultur Urine
									</label>
								</div>
							</div>
							<div class="col-12" id="kultur_urine_keterangan" style="display: none">
								<div class="form-group mb-5">
									<label>Kultur Urine Keterangan</label>
									<input type="text" class="form-control" name="kultur_urine_keterangan" id="kultur_urine_keterangan_text">
								</div>
							</div>

							<div class="col-12">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="hidden" class="css-control-input" name="terjadi_di_luar_rs" value="0">
										<input type="checkbox" class="css-control-input" name="terjadi_di_luar_rs" value="1">
										<span class="css-control-indicator"></span> Terjadi di Luar Rumah Sakit
									</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="hidden" class="css-control-input" name="dx_dokter" value="0">
										<input type="checkbox" class="css-control-input" name="dx_dokter" value="1">
										<span class="css-control-indicator"></span> Diagnosis Dokter
									</label>
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
		</div>
	</div>
</div>