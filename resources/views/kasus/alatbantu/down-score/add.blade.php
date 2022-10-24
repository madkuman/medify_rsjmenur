<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<form action="{{url()->current()}}/create" method="POST">
					{{csrf_field()}}
					<div class="block-header ">
						<h3 class="block-title">Down Score</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-md-12">
							<table class="triage table table-vcenter">
								<tr>
									<th width="25%">Parameters</th>
									<th width="25%">0</th>
									<th width="25%">1</th>
									<th width="25%">2</th>
								</tr>
								<tr>
									<th>Frekuensi Nafas</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="frekuensi_nafas" value="0" checked="checked"/>
											<div>< 60x/mnt</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="frekuensi_nafas" value="1"/>
											<div>60-80x/mnt</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="frekuensi_nafas" value="2"/>
											<div>> 80x/mnt</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Retraksi</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="retraksi" value="0" checked="checked"/>
											<div>Tidak ada retraksi</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="retraksi" value="1"/>
											<div>Retraksi ringan</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="retraksi" value="2"/>
											<div>Retraksi berat</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Sianosis</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="sianosis" value="0" checked="checked"/>
											<div>Tidak sianosis</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="sianosis" value="1"/>
											<div>Sianosis hilang dengan O<small>2</small></div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="sianosis" value="2"/>
											<div>Sianosis menetap walaupun dengan O<small>2</small></div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Air Entry</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="air_entry" value="0" checked="checked"/>
											<div>Udara masuk bilateral baik</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="air_entry" value="1"/>
											<div>Penurunan ringan udara masuk</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="air_entry" value="2"/>
											<div>Tidak ada udara masuk</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Merintih</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="merintih" value="0" checked="checked"/>
											<div>Tidak merintih</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="merintih" value="1"/>
											<div>Dapat didengar dengan stetoskop</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="merintih" value="2"/>
											<div>Dapat didengar tanpa alat bantu</div>
										</label>
									</td>
								</tr>
							</table>
						</div>
						<hr class="col-md-12">
						<div class="col-md-12">
							<h5>Keterangan</h5>
							<h6 class="pl-20 mb-5">Score 0-4 = Distres Nafas Ringan</h6>
							<h6 class="pl-20 mb-5">Score 4-7 = Distres Nafas Sedang</h6>
							<h6 class="pl-20 mb-5">Score > 7 = Distres Nafas Berat</h6>
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
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>