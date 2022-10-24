<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">SOFA</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content row">
					<div class="col-md-12">
						<form action="{{url()->current()}}/create" method="POST">
							{{csrf_field()}}
							<table class="mews table table-vcenter">
								<tr>
									<th width="20%">Parameters</th>
									<th width="11.4285%">0</th>
									<th width="11.4285%">1</th>
									<th width="11.4285%">2</th>
									<th width="11.4285%">3</th>
									<th width="11.4285%">4</th>
									<th width="11.4285%">5</th>
									<th width="11.4285%">6</th>
								</tr>
								<tr>
									<th>Platelets, ×10³/µL</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="platelets" value="0" checked="checked"/>
											<div>>=150</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="platelets" value="1"/>
											<div>100-149</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="platelets" value="2"/>
											<div>50-99</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="platelets" value="3"/>
											<div>20-49</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="platelets" value="4"/>
											<div><20</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="platelets" value="5" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="platelets" value="6" disabled />
											<div>-</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Bilirubin, mg/dL (μmol/L)</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="bilirubin" value="0" checked="checked"/>
											<div><1.2 (<20)</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="bilirubin" value="1"/>
											<div>1.2-1.9 (20-32)</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="bilirubin" value="2"/>
											<div>2.0–5.9 (33-101)</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="bilirubin" value="3"/>
											<div>6.0–11.9 (102-204)</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="bilirubin" value="4"/>
											<div>≥12.0 (>204)</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="bilirubin" value="5" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="bilirubin" value="6" disabled />
											<div>-</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Mean arterial pressure (MAP) OR administration of vasoactive agents required</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="cardiovascular" value="0" checked="checked"/>
											<div>No hypotension</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="cardiovascular" value="1"/>
											<div>MAP <70 mmHg</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="cardiovascular" value="2"/>
											<div>Dopamine ≤5 or dobutamine (any dose)</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="cardiovascular" value="3"/>
											<div>Dopamine >5, epinephrine ≤0.1, or norepinephrine ≤0.1</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="cardiovascular" value="4"/>
											<div>Dopamine >15, epinephrine >0.1, or norepinephrine >0.1</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="cardiovascular" value="5" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="cardiovascular" value="6" disabled />
											<div>-</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Creatinine, mg/dL (μmol/L) (or urine output)</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="creatinine" value="0" checked="checked"/>
											<div><1.2 (<110)</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="creatinine" value="1"/>
											<div>1.2–1.9 (110-170)</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="creatinine" value="2"/>
											<div>2.0–3.4 (171-299)</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="creatinine" value="3"/>
											<div>3.5–4.9 (300-440) or UOP <500 mL/day</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="creatinine" value="4"/>
											<div>≥5.0 (>440) or UOP <200 mL/day</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="creatinine" value="5" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="creatinine" value="6" disabled />
											<div>-</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>GCS-Mata</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_eye" value="0" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_eye" value="1" checked="checked"/>
											<div>Tidak membuka</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_eye" value="2"/>
											<div>Membuka terhadap respon sakit</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_eye" value="3"/>
											<div>Membuka terhadap perintah verbal</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_eye" value="4"/>
											<div>Membuka spontan</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_eye" value="5" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_eye" value="6" disabled />
											<div>-</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>GCS-Verbal</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_verbal" value="0" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_verbal" value="1" checked="checked"/>
											<div>Tidak ada respon</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_verbal" value="2"/>
											<div>Suara tidak jelas</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_verbal" value="3"/>
											<div>Kata-kata tidak sopan</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_verbal" value="4"/>
											<div>Kebingungan</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_verbal" value="5"/>
											<div>Respon baik</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_verbal" value="6" disabled />
											<div>-</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>GCS-Motor</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_motor" value="0" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_motor" value="1" checked="checked"/>
											<div>Tidak ada respon</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_motor" value="2"/>
											<div>Extension to pain</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_motor" value="3"/>
											<div>Flexion to pain</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_motor" value="4"/>
											<div>Withdrawal from pain</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_motor" value="5"/>
											<div>Localizes pain</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="gcs_motor" value="6"/>
											<div>Mematuhi perintah</div>
										</label>
									</td>
								</tr>
							</table>
							<hr>
							<div class="row">
								<div class="form-group col-md-4 col-sm-12">
			                        <label for="pao2">PaO₂</label>
			                        <div class="input-group">
			                        	<input class="form-control" type="text" autocomplete="off" id="pao2" name="pao2" placeholder="Normal: 75-100" required>
									    <span class="input-group-append input-group-text">mm Hg</span>
			                        </div>
			                    </div>
			                    <div class="form-group col-md-4 col-sm-12">
			                        <label for="fio2">FiO₂</label>
			                        <div class="input-group">
			                        	<input class="form-control" type="text" autocomplete="off" id="fio2" name="fio2" required>
									    <span class="input-group-append input-group-text">%</span>
			                        </div>
			                    </div>
			                    <div class="form-group col-md-4 col-sm-12">
			                        <div class="custom-control custom-checkbox custom-control-inline mb-5 mt-20">
			                            <input class="custom-control-input" type="checkbox" name="mech_vent" id="mech_vent" value="1">
			                            <label class="custom-control-label" for="mech_vent">On mechanical ventilation</label>
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
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>