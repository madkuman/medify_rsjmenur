<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">APGAR</h3>
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
								<th width="26%">1</th>
								<th width="26%">2</th>
							</tr>
							<tr>
								<th>Appearance</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="app" value="0" checked="" />
										<div>Blue/Pale</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="app" value="1"/>
										<div>Blue Extremities, Pink Body</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="app" value="2" />
										<div>All Pink</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>Pulse</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="pulse" value="0" checked="" />
										<div>Absent</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="pulse" value="1"/>
										<div>< 100 BPM</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="pulse" value="2" />
										<div>&ge; 100 BPM</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>Grimace</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="grim" value="0"  checked="" />
										<div>None</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="grim" value="1"/>
										<div>Grimace</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="grim" value="2"  />
										<div>Sneeze/Cough</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>Activity</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="act" value="0" checked="" />
										<div>Limp</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="act" value="1"/>
										<div>Some Extremity Flexion</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="act" value="2" />
										<div>Active</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>Respiration</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="resp" value="0" checked="" />
										<div>Absent</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="resp" value="1"/>
										<div>Irregular/Slow</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="resp" value="2" />
										<div>Good/Crying</div>
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