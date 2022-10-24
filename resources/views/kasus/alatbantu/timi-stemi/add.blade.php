<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Asesmen TIMI Risk STEMI</h3>
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
									<th>Parameter</th>
									<th colspan="2">Kondisi</th>
								</tr>
								<tr>
									<td width="50%">Diabetes, Hypertension or Angina</td>
									<td width="25%">
										<label class="mews-item">
											<input type="radio" name="dha_prob" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="25%">
										<label class="mews-item">
											<input type="radio" name="dha_prob" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="50%">Systolic BP < 100 mmHg</td>
									<td width="25%">
										<label class="mews-item">
											<input type="radio" name="systol_bp_prob" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="25%">
										<label class="mews-item">
											<input type="radio" name="systol_bp_prob" value="3"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="50%">Heart rate > 100</td>
									<td width="25%">
										<label class="mews-item">
											<input type="radio" name="heartrate_prob" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="25%">
										<label class="mews-item">
											<input type="radio" name="heartrate_prob" value="2"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="50%">Killip Class II-IV</td>
									<td width="25%">
										<label class="mews-item">
											<input type="radio" name="killip_prob" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="25%">
										<label class="mews-item">
											<input type="radio" name="killip_prob" value="2"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="50%">Weight < 67kg</td>
									<td width="25%">
										<label class="mews-item">
											<input type="radio" name="weight_prob" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="25%">
										<label class="mews-item">
											<input type="radio" name="weight_prob" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="50%">Anterior ST Elevation or LBBB</td>
									<td width="25%">
										<label class="mews-item">
											<input type="radio" name="aste_prob" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="25%">
										<label class="mews-item">
											<input type="radio" name="aste_prob" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="50%">Waktu pengobatan > 4 jam</td>
									<td width="25%">
										<label class="mews-item">
											<input type="radio" name="treat_time_prob" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="25%">
										<label class="mews-item">
											<input type="radio" name="treat_time_prob" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
							</table>
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