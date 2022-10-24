<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">TRISS</h3>
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
							<table class="triage table table-vcenter">
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
									<th>Kepala & Leher</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="headneck" value="0" checked="checked"/>
											<div>None</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="headneck" value="1"/>
											<div>Minor</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="headneck" value="2"/>
											<div>Moderate</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="headneck" value="3"/>
											<div>Serious</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="headneck" value="4"/>
											<div>Severe</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="headneck" value="5"/>
											<div>Critical</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="headneck" value="6"/>
											<div>Unsurvivable</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Wajah</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="face" value="0" checked="checked"/>
											<div>None</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="face" value="1"/>
											<div>Minor</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="face" value="2"/>
											<div>Moderate</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="face" value="3"/>
											<div>Serious</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="face" value="4"/>
											<div>Severe</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="face" value="5"/>
											<div>Critical</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="face" value="6"/>
											<div>Unsurvivable</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Dada</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="chest" value="0" checked="checked"/>
											<div>None</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="chest" value="1"/>
											<div>Minor</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="chest" value="2"/>
											<div>Moderate</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="chest" value="3"/>
											<div>Serious</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="chest" value="4"/>
											<div>Severe</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="chest" value="5"/>
											<div>Critical</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="chest" value="6"/>
											<div>Unsurvivable</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Abdomen</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="abdomen" value="0" checked="checked"/>
											<div>None</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="abdomen" value="1"/>
											<div>Minor</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="abdomen" value="2"/>
											<div>Moderate</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="abdomen" value="3"/>
											<div>Serious</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="abdomen" value="4"/>
											<div>Severe</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="abdomen" value="5"/>
											<div>Critical</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="abdomen" value="6"/>
											<div>Unsurvivable</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Extremity</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="extremity" value="0" checked="checked"/>
											<div>None</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="extremity" value="1"/>
											<div>Minor</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="extremity" value="2"/>
											<div>Moderate</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="extremity" value="3"/>
											<div>Serious</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="extremity" value="4"/>
											<div>Severe</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="extremity" value="5"/>
											<div>Critical</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="extremity" value="6"/>
											<div>Unsurvivable</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Eksternal</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="external" value="0" checked="checked"/>
											<div>None</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="external" value="1"/>
											<div>Minor</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="external" value="2"/>
											<div>Moderate</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="external" value="3"/>
											<div>Serious</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="external" value="4"/>
											<div>Severe</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="external" value="5"/>
											<div>Critical</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="external" value="6"/>
											<div>Unsurvivable</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>GCS-Mata</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_eye" value="0" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_eye" value="1" checked="checked"/>
											<div>Tidak membuka</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_eye" value="2"/>
											<div>Membuka terhadap respon sakit</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_eye" value="3"/>
											<div>Membuka terhadap perintah verbal</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_eye" value="4"/>
											<div>Membuka spontan</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_eye" value="5" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_eye" value="6" disabled />
											<div>-</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>GCS-Verbal</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_verbal" value="0" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_verbal" value="1" checked="checked"/>
											<div>Tidak ada respon</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_verbal" value="2"/>
											<div>Suara tidak jelas</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_verbal" value="3"/>
											<div>Kata-kata tidak sopan</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_verbal" value="4"/>
											<div>Kebingungan</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_verbal" value="5"/>
											<div>Respon baik</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_verbal" value="6" disabled />
											<div>-</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>GCS-Motor</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_motor" value="0" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_motor" value="1" checked="checked"/>
											<div>Tidak ada respon</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_motor" value="2"/>
											<div>Extension to pain</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_motor" value="3"/>
											<div>Flexion to pain</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_motor" value="4"/>
											<div>Withdrawal from pain</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_motor" value="5"/>
											<div>Localizes pain</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="gcs_motor" value="6"/>
											<div>Mematuhi perintah</div>
										</label>
									</td>
								</tr>
							</table>
							<hr>
							<div class="row">
								<div class="form-group col-md-6 col-sm-12">
			                        <label for="systol_bp">Tekanan Darah Sistolik</label>
			                        <div class="input-group">
			                        	<input class="form-control" type="text" autocomplete="off" id="systol_bp" name="systol_bp" placeholder="Normal: 100-120">
									    <span class="input-group-append input-group-text">mm Hg</span>
			                        </div>
			                    </div>
			                    <div class="form-group col-md-6 col-sm-12">
			                        <label for="resp_rate">Laju Pernafasan</label>
			                        <div class="input-group">
			                        	<input class="form-control" type="text" autocomplete="off" id="resp_rate" name="resp_rate" placeholder="Normal: 12-20">
									    <span class="input-group-append input-group-text">nafas/menit</span>
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