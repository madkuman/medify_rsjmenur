<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url()->current()}}/create" method="POST">
			{{csrf_field()}}
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Riwayat Kehamilan</h3>
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
										<th>Nama Suami</th>
										<th>Lama Kawin</th>
										<th>Umur Kehamilan</th>
										<th>Tahun Persalinan</th>
										<th>Tempat Persalinan</th>
										<th>Jenis Persalinan</th>
										<th>Penolong</th>
										<th>Penyulit Kehamilan</th>
										<th>JK Anak</th>
										<th>BB Anak</th>
										<th>PB Anak</th>
										<th>Keadaan Anak</th>
									</tr>
								</thead>
								<tbody id="table_append">
									<tr class="item-baru">
										<td>
											<input type="text" class="form-control" id="suami_1" name="suami[]">
										</td>
										<td>
											<input type="text" class="form-control" id="lama_1" name="lama[]">
										</td>
										<td>
											<input type="text" class="form-control" id="umur_1" name="umur[]">
										</td>
										<td>
											<input type="text" class="form-control" id="tahun_1" name="tahun[]">
										</td>
										<td>
											<input type="text" class="form-control" id="tempat_1" name="tempat[]">
										</td>
										<td>
											<input type="text" class="form-control" id="jenis_1" name="jenis[]">
										</td>
										<td>
											<input type="text" class="form-control" id="penolong_1" name="penolong[]">
										</td>
										<td>
											<input type="text" class="form-control" id="penyulit_1" name="penyulit[]">
										</td>
										<td>
											<input type="text" class="form-control" id="jenis_anak_1" name="jenis_anak[]">
										</td>
										<td>
											<input type="text" class="form-control" id="bb_anak_1" name="bb_anak[]">
										</td>
										<td>
											<input type="text" class="form-control" id="pb_anak_1" name="pb_anak[]">
										</td>
										<td>
											<input type="text" class="form-control" id="keadaan_anak_1" name="keadaan_anak[]">
										</td>
									</tr>
								</tbody>
							</table>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group">
						<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
					</div>
				</div>
			</div><!-- /.modal-dialog -->
		</form>
	</div><!-- /.modal -->
</div>