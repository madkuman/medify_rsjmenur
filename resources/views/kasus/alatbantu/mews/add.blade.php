<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">MEWS</h3>
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
									<th width="20%">Paremeters</th>
									<th width="11.4285%">3</th>
									<th width="11.4285%">2</th>
									<th width="11.4285%">1</th>
									<th width="11.4285%">0</th>
									<th width="11.4285%">1</th>
									<th width="11.4285%">2</th>
									<th width="11.4285%">3</th>
								</tr>
								<tr>
									<th>Resp Rate</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="resp" value="-3" />
											<div><=8</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="resp" value="-2" disabled/>
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="resp" value="-1" />
											<div>9-11</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="resp" value="0" checked="checked"/>
											<div>12-20</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="resp" value="1" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="resp" value="2"/>
											<div>21-24</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="resp" value="3"/>
											<div>>=25</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>O2 Sat %</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="o2" value="-3" />
											<div><91</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="o2" value="-2"/>
											<div>92-93</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="o2" value="-1" />
											<div>94-95</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="o2" value="0" checked="checked"/>
											<div>>96</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="o2" value="1" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="o2" value="2" disabled="" />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="o2" value="3" disabled="" />
											<div>-</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Any Supl 02</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="suplo2" value="-3" disabled="" />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="suplo2" value="-2"/>
											<div>Yes</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="suplo2" value="-1" disabled="" />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="suplo2" value="0" checked="checked"/>
											<div>No</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="suplo2" value="1" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="suplo2" value="2" disabled="" />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="suplo2" value="3" disabled="" />
											<div>-</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Sys BPmmHg</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="sys" value="-3" />
											<div><90</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="sys" value="-2"/>
											<div>91-100</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="sys" value="-1" />
											<div>101-110</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="sys" value="0" checked="checked"/>
											<div>111-219</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="sys" value="1" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="sys" value="2" disabled="" />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="sys" value="3"/>
											<div>>=220</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Pulse BPM</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="pulse" value="-3" />
											<div><=40</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="pulse" value="-2" disabled/>
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="pulse" value="-1" />
											<div>41-50</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="pulse" value="0" checked="checked"/>
											<div>51-90</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="pulse" value="1" />
											<div>91-110</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="pulse" value="2"/>
											<div>111-130</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="pulse" value="3"/>
											<div>>=131</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>AVPU Score</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="avpu" value="-3" disabled="" />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="avpu" value="-2" disabled/>
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="avpu" value="-1" disabled/>
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="avpu" value="0" checked="checked"/>
											<div>Alert</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="avpu" value="1" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="avpu" value="2" disabled/>
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="avpu" value="3"/>
											<div>VPU</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Temp Degree Celcius</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="temp" value="-3" />
											<div><=35</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="temp" value="-2" disabled/>
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="temp" value="-1" />
											<div>35.1-36</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="temp" value="0" checked="checked"/>
											<div>36.1-38</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="temp" value="1" />
											<div>38.1-39</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="temp" value="2"/>
											<div>>=39.1</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="temp" value="3" disabled="" />
											<div>-</div>
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