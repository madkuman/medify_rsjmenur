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
									<td width="70%" class="text-left">HOB >30-45</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="hob" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="hob" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Pengkajian setiap hari terhadap sedasi dan extubasi</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="pengkajian_tiap_hari" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="pengkajian_tiap_hari" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Hand hygiene</td>
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
									<td width="70%" class="text-left">Oral Hygiene 4 – 6 jam</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="oral_hygiene" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="oral_hygiene" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Penyikatan gigi setiap 12 jam</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="sikat_gigi_12_jam" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="sikat_gigi_12_jam" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Suction / manajemen sekresi</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="suction" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="suction" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left"> Profilaksis peptic ulcer</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="profilaksis" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="profilaksis" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">DVT Profilaksis</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="profilaksis_dvt" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="profilaksis_dvt" value="1"/>
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