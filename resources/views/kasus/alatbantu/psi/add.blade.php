<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" >
			<form action="{{url()->current()}}/create" method="POST">
				{{csrf_field()}}
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Asesmen PSI</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-md-12">
							<div class="form-group row mb-5">
								<label class="col-12">Nursing home resident</label>
								<div class="col-12">
									<select class="form-control" name="nursing_home_res">
										<option value="0">Tidak</option>
										<option value="10">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Neoplastic disease</label>
								<div class="col-12">
									<select class="form-control" name="comorbid[0]">
										<option value="0">Tidak</option>
										<option value="30">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Liver disease history</label>
								<div class="col-12">
									<select class="form-control" name="comorbid[1]">
										<option value="0">Tidak</option>
										<option value="20">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">CHF history</label>
								<div class="col-12">
									<select class="form-control" name="comorbid[2]">
										<option value="0">Tidak</option>
										<option value="10">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Cerebrovascular disease history</label>
								<div class="col-12">
									<select class="form-control" name="comorbid[3]">
										<option value="0">Tidak</option>
										<option value="10">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Renal disease history</label>
								<div class="col-12">
									<select class="form-control" name="comorbid[4]">
										<option value="0">Tidak</option>
										<option value="10">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Altered mental status</label>
								<div class="col-12">
									<select class="form-control" name="pe[0]">
										<option value="0">Tidak</option>
										<option value="20">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Respiratory rate ≥30 breaths/min</label>
								<div class="col-12">
									<select class="form-control" name="pe[1]">
										<option value="0">Tidak</option>
										<option value="20">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Systolic blood pressure < 90 mmHg</label>
								<div class="col-12">
									<select class="form-control" name="pe[2]">
										<option value="0">Tidak</option>
										<option value="20">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Temp < 35°C or >39.9°C</label>
								<div class="col-12">
									<select class="form-control" name="pe[3]">
										<option value="0">Tidak</option>
										<option value="15">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pulse ≥125 beats/min</label>
								<div class="col-12">
									<select class="form-control" name="pe[4]">
										<option value="0">Tidak</option>
										<option value="10">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">pH < 7.35</label>
								<div class="col-12">
									<select class="form-control" name="lab[0]">
										<option value="0">Tidak</option>
										<option value="30">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">BUN ≥30 mg/dL or ≥11 mmol/L</label>
								<div class="col-12">
									<select class="form-control" name="lab[1]">
										<option value="0">Tidak</option>
										<option value="20">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Sodium < 130 mmol/L</label>
								<div class="col-12">
									<select class="form-control" name="lab[2]">
										<option value="0">Tidak</option>
										<option value="20">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Glucose ≥250 mg/dL or ≥14 mmol/L</label>
								<div class="col-12">
									<select class="form-control" name="lab[3]">
										<option value="0">Tidak</option>
										<option value="10">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Hematocrit < 30%</label>
								<div class="col-12">
									<select class="form-control" name="lab[4]">
										<option value="0">Tidak</option>
										<option value="10">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">PaO2 < 60 mmHg or < 8 kPa</label>
								<div class="col-12">
									<select class="form-control" name="lab[5]">
										<option value="0">Tidak</option>
										<option value="10">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pleural effusion on x-ray</label>
								<div class="col-12">
									<select class="form-control" name="lab[6]">
										<option value="0">Tidak</option>
										<option value="10">Ya</option>
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