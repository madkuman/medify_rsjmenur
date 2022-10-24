<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-lg">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Form Plebitis</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content row">
					<div class="col-md-12">
						<form action="{{url()->current()}}/create" method="POST">
							<input type="hidden" name="lokasi_id" value="{{$kasus->lokasi->lokasi->id}}">
							<input type="hidden" class="input-parent-id" name="parent_id" value="">
							{{csrf_field()}}
							<table class="mews table table-vcenter table-striped" width="100%">
								<tr>
									<td width="70%" class="text-left">Merah</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="merah" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="merah" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Rasa Terbakar</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="rasa_terbakar" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="rasa_terbakar" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Bengkak</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="bengkak" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="bengkak" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Sakit jika ditekan</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="sakit_tekan" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="sakit_tekan" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Ulkus</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="ulkus" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="ulkus" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Eksudat purulen / cairan jika ditekan</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="purulen" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="purulen" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Diagnosa Dokter Plebitis</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="dx_dokter" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="dx_dokter" value="1"/>
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