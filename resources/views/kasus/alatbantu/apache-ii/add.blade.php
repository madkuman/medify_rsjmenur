

<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" >
			<form action="{{url()->current()}}/create" method="POST">
				{{csrf_field()}}
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Asesmen Apache II</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-md-12">
							<div class="form-group row mb-5">
								<label class="col-12">Memiliki histori insufisiensi organ berat atau gangguan imun</label>
								<div class="col-12">
									<select class="form-control" id="history" name="history" style="width: 100%;" required>
										<option value="0" selected>Tidak</option>
										<option value="2">Ya (Elective Post-Op Patient)</option>
										<option value="5">Ya (Non-Operative/Emergency Post-Op Patient)</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">GCS-Mata</label>
								<div class="col-12">
									<select class="form-control" id="gcs_eye" name="gcs_eye" style="width: 100%;" required>
										<option value="1" selected>Tidak membuka</option>
										<option value="2">Membuka terhadap respon sakit</option>
										<option value="3">Membuka terhadap perintah verbal</option>
										<option value="4">Membuka spontan</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">GCS-Verbal</label>
								<div class="col-12">
									<select class="form-control" id="gcs_verbal" name="gcs_verbal" style="width: 100%;" required>
										<option value="1" selected>Tidak ada respon</option>
										<option value="2">Suara tidak jelas</option>
										<option value="3">Kata-kata tidak sopan</option>
										<option value="4">Kebingungan</option>
										<option value="5">Respon baik</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">GCS-Motor</label>
								<div class="col-12">
									<select class="form-control" id="gcs_motor" name="gcs_motor" style="width: 100%;" required>
										<option value="1" selected>Tidak ada respon</option>
										<option value="2">Extension to pain</option>
										<option value="3">Flexion to pain</option>
										<option value="4">Withdrawal from pain</option>
										<option value="5">Localizes pain</option>
										<option value="6">Mematuhi perintah</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">FiO₂</label>
								<div class="col-12">
									<select class="form-control" id="fio2" name="fio2" style="width: 100%;" required>
										<option value="0" selected>&lt;50% (or non-intubated)</option>
										<option value="1">&ge;50%</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5" id="pao2_tr">
								<label class="col-12">PaO₂, mmHg</label>
								<div class="col-12">
									<select class="form-control" id="pao2" name="pao2" style="width: 100%;" required>
										<option value="0" selected>&gt;70</option>
										<option value="1">61-70</option>
										<option value="3">55-60</option>
										<option value="4">&lt;55</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5" id="aa_grad_tr" style="display: none;">
								<label class="col-12">A-a gradient</label>
								<div class="col-12">
									<select class="form-control" id="aa_grad" name="aa_grad" style="width: 100%;">
										<option value="0" selected>&lt;200</option>
										<option value="2">200-349</option>
										<option value="3">350-499</option>
										<option value="4">&gt;499</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Gagal ginjal akut</label>
								<div class="col-12">
									<select class="form-control" id="renal" name="renal" style="width: 100%;" required>
										<option value="0" selected>Tidak</option>
										<option value="1">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="temp">Temperatur</label>
								<div class="input-group col-12">
									<input class="form-control" type="text" autocomplete="off" id="temp" name="temp" placeholder="Normal: 37.8-39.1">
									<span class="input-group-append input-group-text">°C</span>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="map">Mean Arterial Pressure</label>
								<div class="input-group col-12">
									<input class="form-control" type="text" autocomplete="off" id="map" name="map" placeholder="Normal: 70-100">
									<span class="input-group-append input-group-text">mmHg</span>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="ph">pH</label>
								<div class="input-group col-12">
									<input class="form-control" type="text" autocomplete="off" id="ph" name="ph" placeholder="Normal: 7.38-7.44">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="heartrate">Heartrate</label>
								<div class="input-group col-12">
									<input class="form-control" type="text" autocomplete="off" id="heartrate" name="heartrate" placeholder="Normal: 60-100">
									<span class="input-group-append input-group-text">beats/min</span>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="resp_rate">Respiratory Rate</label>
								<div class="input-group col-12">
									<input class="form-control" type="text" autocomplete="off" id="resp_rate" name="resp_rate" placeholder="Normal: 12-20">
									<span class="input-group-append input-group-text">breaths/min</span>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="sodium">Sodium</label>
								<div class="input-group col-12">
									<input class="form-control" type="text" autocomplete="off" id="sodium" name="sodium" placeholder="Normal: 136-145">
									<span class="input-group-append input-group-text">mmol/L</span>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="potassium">Potassium</label>
								<div class="input-group col-12">
									<input class="form-control" type="text" autocomplete="off" id="potassium" name="potassium" placeholder="Normal: 3.5-5">
									<span class="input-group-append input-group-text">mmol/L</span>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="creatinine">Creatinine</label>
								<div class="input-group col-12">
									<input class="form-control" type="text" autocomplete="off" id="creatinine" name="creatinine" placeholder="Normal: 0.7-1.3">
									<span class="input-group-append input-group-text">mg/100mL</span>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="hematocrit">Hematocrit</label>
								<div class="input-group col-12">
									<input class="form-control" type="text" autocomplete="off" id="hematocrit" name="hematocrit" placeholder="Normal: 36-51">
									<span class="input-group-append input-group-text">%</span>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="white_blood">White blood cell count</label>
								<div class="input-group col-12">
									<input class="form-control" type="text" autocomplete="off" id="white_blood" name="white_blood" placeholder="Normal: 3.7-10.7">
									<span class="input-group-append input-group-text">× 10³ cells/µL</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group">
						<button  type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
					</div>
				</div>
			</form>
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>

