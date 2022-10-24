<div class="modal" id="addModalAudit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-lg">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Form Audit BSI</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content row">
					<div class="col-md-12">
						<form action="{{url()->current()}}/create-audit" method="POST">
							<input type="hidden" name="lokasi_id" value="{{$kasus->lokasi->lokasi->id}}">
							{{csrf_field()}}
							<table class="mews table table-vcenter table-striped" width="100%">
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
									<td width="70%" class="text-left">Pembersihan kulit dengan chlorhexidine</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="pembersihan_chlorhexidine" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="pembersihan_chlorhexidine" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Lokasi pemasangan sesuai</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="lokasi_sesuai" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="lokasi_sesuai" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Selang infuse diganti sesuai standar</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="selang_standard" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="selang_standard" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Swab alcohol setiap injeksi</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="swab_alkohol_injeksi" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="swab_alkohol_injeksi" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left"> Spuit yang digunakan disposable</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="spuit_disposable" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="spuit_disposable" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Penutup insersi dengan transparan dressing</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="penutup_insersi" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="penutup_insersi" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Perawatan lokasi insersi setiap 4 hari dan jika kotor</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="perawatan_lokasi_insersi" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="perawatan_lokasi_insersi" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Menggunakan stopper needles</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="stopper_needles" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="stopper_needles" value="1"/>
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