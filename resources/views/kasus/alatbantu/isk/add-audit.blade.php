<div class="modal" id="addModalAudit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-lg">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Form ISK</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content row">
					<div class="col-md-12">
						<form action="{{url()->current()}}/create-audit" method="POST">
							{{csrf_field()}}
							<input type="hidden" name="lokasi_id" value="{{$kasus->lokasi->lokasi->id}}">
							<table class="mews table table-vcenter table-striped" width="100%">
								<tr>
									<td width="70%" class="text-left">Pemasangan sesuai indikasi</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="pemasangan" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="pemasangan" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">APD Tepat</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="apd" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="apd" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Pemasangan menggunakan alat steril</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="alat_steril" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="alat_steril" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Hand Hygiene</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="hand_hygiene" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="hand_hygiene" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>

								<tr>
									<td width="70%" class="text-left">Segera dilepas jika tidak indikasi</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="lepas_indikasi" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="lepas_indikasi" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Pengisian balon sesuai 30 ml</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="pengisian_balon" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="pengisian_balon" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Fiksasi kateter dengan plester</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="fiksasi_kateter" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="fiksasi_kateter" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Urine bag menggantung</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="urine_bag_menggantung" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="urine_bag_menggantung" value="1"/>
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