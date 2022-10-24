<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">GCS</h3>
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
									<th width="11.4285%">0</th>
									<th width="11.4285%">1</th>
									<th width="11.4285%">2</th>
									<th width="11.4285%">3</th>
									<th width="11.4285%">4</th>
									<th width="11.4285%">5</th>
									<th width="11.4285%">6</th>
								</tr>
								<tr>
									<th>Membuka Mata</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="membuka_mata" value="0" />
											<div>Tidak dapat dinilai</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="membuka_mata" value="1"/>
											<div>Tidak ada</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="membuka_mata" value="2" />
											<div>Rangsangan terhadap tekanan</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="membuka_mata" value="3" checked=""/>
											<div>Respon terhadap suara</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="membuka_mata" value="4"/>
											<div>Spontan</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="membuka_mata" value="5" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="membuka_mata" value="6" disabled />
											<div>-</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Respon Verbal</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="respon_verbal" value="0" />
											<div>Tidak dapat dinilai</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="respon_verbal" value="1"/>
											<div>Tidak ada</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="respon_verbal" value="2" />
											<div>Suara</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="respon_verbal" value="3" checked=""/>
											<div>Kalimat</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="respon_verbal" value="4" />
											<div>Bingung</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="respon_verbal" value="5" />
											<div>Orientasi baik</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="respon_verbal" value="6" disabled="" />
											<div>-</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Respon Motorik</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="respon_motorik" value="0" />
											<div>Tidak dapat dinilai</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="respon_motorik" value="1"/>
											<div>Tidak ada</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="respon_motorik" value="2"  />
											<div>Ekstensi</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="respon_motorik" value="3" checked="checked"/>
											<div>Fleksi tidak normal</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="respon_motorik" value="4"  />
											<div>Fleksi normal</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="respon_motorik" value="5"  />
											<div>Melokalisir</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="respon_motorik" value="6"  />
											<div>Menuruti perintah</div>
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