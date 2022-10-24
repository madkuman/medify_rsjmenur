<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-lg">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Form BSI</h3>
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
									<td width="70%" class="text-left">Kuman pada kultur darah</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="kuman" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="kuman" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								@if($kasus->identitas->usia_masuk > 365)
								<tr>
									<td width="70%" class="text-left">Demam >= 38 C</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="demam" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="demam" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Hipotensi</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="hipotensi" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="hipotensi" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Menggigil</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="menggigil" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="menggigil" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								@else
								<tr>
									<td width="70%" class="text-left">Demam >= 38 C / Rectal</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="demam" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="demam" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Hipothermi <= 37 C / Rectal</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="hipothermi" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="hipothermi" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Apneu</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="apneu" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="apneu" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Brakikardia</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="brakikardia" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="brakikardia" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								@endif

								
								<tr>
									<td width="70%" class="text-left">Kultur CVC</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="kultur_cvc" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="kultur_cvc" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr id="kultur_cvc_keterangan" style="display: none">
									<td width="70%" class="text-left">Kultur CVC Keterangan</td>
									<td width="30%" colspan="2">
										<input type="text" class="form-control" name="kultur_cvc_keterangan">
									</td>
								</tr>
								
								<tr>
									<td width="70%" class="text-left">Diagnosis Dokter BSI</td>
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