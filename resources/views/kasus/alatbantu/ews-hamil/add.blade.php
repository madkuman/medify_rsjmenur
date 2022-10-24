<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Skor EWS Ibu Hamil</h3>
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
								<th width="22%">Paremeters</th>
								<th width="26%">Normal Value</th>
								<th width="26%">Yellow Zone</th>
								<th width="26%">Pink Zone</th>
							</tr>
							<tr>
								<th>Respiratory (bpm)</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="respiratory" value="Normal" checked="true" />
										<div>11 - 19</div>
									</label>
								</td>
								<td class="bg-warning">
									<label class="mews-item">
										<input type="radio" name="respiratory" value="Yellow" />
										<div>20 - 24</div>
									</label>
								</td>
								<td style="background-color: #ff69b4;">
									<label class="mews-item">
										<input type="radio" name="respiratory" value="Pink" />
										<div>{{'< 10 or ≥ 25'}}</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>SPO2 (%)</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="spo2" value="Normal" checked="true" />
										<div>96 - 100</div>
									</label>
								</td>
								<td class="bg-warning">
									<label class="">
										<div>-</div>
									</label>
								</td>
								<td style="background-color: #ff69b4;">
									<label class="mews-item">
										<input type="radio" name="spo2" value="Pink" />
										<div>{{'< 95'}}</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>Temperature (Celcius)</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="temp" value="Normal" checked="true" />
										<div>36.0 - 37.4</div>
									</label>
								</td>
								<td class="bg-warning">
									<label class="mews-item">
										<input type="radio" name="temp" value="Yellow" />
										<div>35.1 - 35.9 or 37.5 - 37.9</div>
									</label>
								</td>
								<td style="background-color: #ff69b4;">
									<label class="mews-item">
										<input type="radio" name="temp" value="Pink" />
										<div>{{'< 35 or ≥ 38'}}</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>Maternal HR (bpm)</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="maternal" value="Normal" checked="true" />
										<div>60 - 99</div>
									</label>
								</td>
								<td class="bg-warning">
									<label class="mews-item">
										<input type="radio" name="maternal" value="Yellow" />
										<div>50 - 59 or 100 - 119</div>
									</label>
								</td>
								<td style="background-color: #ff69b4;">
									<label class="mews-item">
										<input type="radio" name="maternal" value="Pink" />
										<div>{{'< 50 or ≥ 120'}}</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>Systole (mmHg)</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="systol" value="Normal" checked="true" />
										<div>100 - 139</div>
									</label>
								</td>
								<td class="bg-warning">
									<label class="mews-item">
										<input type="radio" name="systol" value="Yellow" />
										<div>90 - 99 or 140 - 159</div>
									</label>
								</td>
								<td style="background-color: #ff69b4;">
									<label class="mews-item">
										<input type="radio" name="systol" value="Pink" />
										<div>{{'< 90 or ≥ 160'}}</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>Diastole (mmHg)</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="diastol" value="Normal" checked="true" />
										<div>50 - 89</div>
									</label>
								</td>
								<td class="bg-warning">
									<label class="mews-item">
										<input type="radio" name="diastol" value="Yellow" />
										<div>40 - 49 or 90 - 99</div>
									</label>
								</td>
								<td style="background-color: #ff69b4;">
									<label class="mews-item">
										<input type="radio" name="diastol" value="Pink" />
										<div>< 40 or ≥ 110</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>AVPU</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="avpu" value="Normal" checked="true" />
										<div>Alert</div>
									</label>
								</td>
								<td class="bg-warning">
									<label class="">
										<div>-</div>
									</label>
								</td>
								<td style="background-color: #ff69b4;">
									<label class="mews-item">
										<input type="radio" name="avpu" value="Pink" />
										<div>Voice Pain or Unresponsive</div>
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