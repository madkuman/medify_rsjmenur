<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url()->current()}}/create" method="POST">
			{{csrf_field()}}
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Lembar Observasi</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-12">
							<table class="table table-striped table-bordered table-vcenter">
								<thead>
									<tr>
										<th>Parameter</th>
										<th>Mulai</th>
										<th>1/2 Jam</th>
										<th>1 Jam</th>
										<th>2 Jam</th>
										<th>3 Jam</th>
										<th>4 Jam</th>
										<th>5 Jam</th>
										<th>Keterangan</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Waktu</td>
										<td>
											<input type="text" class="form-control" name="waktu_mulai" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="waktu_12_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="waktu_1_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="waktu_2_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="waktu_3_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="waktu_4_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="waktu_5_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="waktu_keterangan" autocomplete="off">
										</td>
									</tr>
									<tr>
										<td>Tekanan Darah</td>
										<td>
											<input type="text" class="form-control" name="tekanan_mulai" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="tekanan_12_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="tekanan_1_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="tekanan_2_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="tekanan_3_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="tekanan_4_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="tekanan_5_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="tekanan_keterangan" autocomplete="off">
										</td>
									</tr>
									<tr>
										<td>Suhu / Nadi</td>
										<td>
											<input type="text" class="form-control" name="suhu_mulai" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="suhu_12_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="suhu_1_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="suhu_2_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="suhu_3_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="suhu_4_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="suhu_5_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="suhu_keterangan" autocomplete="off">
										</td>
									</tr>
									<tr>
										<td>RR</td>
										<td>
											<input type="text" class="form-control" name="rr_mulai" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="rr_12_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="rr_1_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="rr_2_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="rr_3_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="rr_4_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="rr_5_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="rr_keterangan" autocomplete="off">
										</td>
									</tr>
									<tr>
										<td>GCS</td>
										<td>
											<input type="text" class="form-control" name="gcs_mulai" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="gcs_12_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="gcs_1_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="gcs_2_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="gcs_3_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="gcs_4_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="gcs_5_jam" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control" name="gcs_keterangan" autocomplete="off">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-12">
							<hr>
						</div>
						<div class="col-md-5 col-12">
							<h5>Asesmen Observasi</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Obat yang masuk</label>
								<div class="col-12">
									<input type="text" class="form-control" name="obat" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keluhan Lain</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keluhan" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Makan/Minum</label>
								<div class="col-12">
									<input type="text" class="form-control" name="makan_minum" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Vomiting</label>
								<div class="col-12">
									<input type="text" class="form-control" name="vomiting" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Urine</label>
								<div class="col-12">
									<input type="text" class="form-control" name="urine" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Laborat</label>
								<div class="col-12">
									<input type="text" class="form-control" name="laborat" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="form-group">
							<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
						</div>
					</div>
				</div>
			</div>
			
		</div><!-- /.modal-dialog -->
	</form>
</div><!-- /.modal -->
</div>