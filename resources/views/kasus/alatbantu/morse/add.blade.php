<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Morse Fall</h3>
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
								<th width="26%">0</th>
								<th width="26%">10</th>
								<th width="26%">15</th>
								<th width="26%">20</th>
								<th width="26%">25</th>
								<th width="26%">30</th>
							</tr>
							<tr>
								<th>History of falling ( &lt;3 months)</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="jatuh" value="0" checked="" />
										<div>No</div>
									</label>
								</td>
								<td></td>
								<td></td>
								<td></td>
								<td>
									<label class="mews-item">
										<input type="radio" name="jatuh" value="25"/>
										<div>Yes</div>
									</label>
								</td>
								<td></td>
							</tr>
							<tr>
								<th>Secondary Diagnosis</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="diagnosis" value="0" checked="" />
										<div>No</div>
									</label>
								</td>
								<td></td>
								<td>
									<label class="mews-item">
										<input type="radio" name="diagnosis" value="15"/>
										<div>Yes</div>
									</label>
								</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th>Ambulatory Aid</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="ambulatory" value="0" checked="" />
										<div>Bed rest/nurse assist</div>
									</label>
								</td>
								<td></td>
								<td>
									<label class="mews-item">
										<input type="radio" name="ambulatory" value="15"/>
										<div>Crutches/cane/walker</div>
									</label>
								</td>
								<td></td>
								<td></td>
								<td>
									<label class="mews-item">
										<input type="radio" name="ambulatory" value="30"/>
										<div>Furniture</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>IV/Heparin Lock</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="iv" value="0" checked="" />
										<div>No</div>
									</label>
								</td>
								<td></td>
								<td></td>
								<td>
									<label class="mews-item">
										<input type="radio" name="iv" value="20" />
										<div>Yes</div>
									</label>
								</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th>Gait/Transfering</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="gait" value="0" checked="" />
										<div>Normal/bedrest/immobile</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="gait" value="10"/>
										<div>Weak</div>
									</label>
								</td>
								<td></td>
								<td>
									<label class="mews-item">
										<input type="radio" name="gait" value="20" />
										<div>Impaired</div>
									</label>
								</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th>Mental Status</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="mental" value="0" checked="" />
										<div>Oriented to own ability</div>
									</label>
								</td>
								<td></td>
								<td>
									<label class="mews-item">
										<input type="radio" name="mental" value="15"/>
										<div>Forgets Limitation</div>
									</label>
								</td>
								<td></td>
								<td></td>
								<td></td>
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