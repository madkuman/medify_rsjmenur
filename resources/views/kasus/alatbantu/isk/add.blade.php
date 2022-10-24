<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
						<form action="{{url()->current()}}/create" method="POST">
							<input type="hidden" name="lokasi_id" value="{{$kasus->lokasi->lokasi->id}}">
							<input type="hidden" class="input-parent-id" name="parent_id" value="">
							{{csrf_field()}}
							<table class="mews table table-vcenter table-striped" width="100%">
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
									<td width="70%" class="text-left">Urgency</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="urgency" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="urgency" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Frequency</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="frequency" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="frequency" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Dysuria</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="dysuria" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="dysuria" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>

								<tr>
									<td width="70%" class="text-left">Nyeri supra-pubic</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="suprapubic" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="suprapubic" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								@else

								<tr>
									<td width="70%" class="text-left">Demam >= 38 C rektal</td>
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
									<td width="70%" class="text-left">Hipothermi < 37 C rektal</td>
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

								<tr>
									<td width="70%" class="text-left">Lekargia</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="lekargia" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="lekargia" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Muntah muntah</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="muntah" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="muntah" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								@endif
								<tr>
									<td width="70%" class="text-left">Tes Carik Celup Positif</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="tes_carik_celup" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="tes_carik_celup" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Pyuria (>= 10 leukosit urin)</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="pyuria" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="pyuria" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Ditemukan kuman dengan pewarnaan gram dari urin yang tidak disentrifugasi</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="ditemukan_kuman" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="ditemukan_kuman" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">
										Paling sedikit 2 kultur urin ulangan didapatkan urapatogen yang sama.
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="urapatogen" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="urapatogen" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Kuman biakan urine >= 10^5 / ml</td>
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
								<tr>
									<td width="70%" class="text-left">Kultur Urine</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="kultur_urine" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="kultur_urine" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr id="kultur_urine_keterangan" style="display: none">
									<td width="70%" class="text-left">Kultur Urine Keterangan</td>
									<td width="30%" colspan="2">
										<input type="text" class="form-control" name="kultur_urine_keterangan">
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Diagnosa Dokter ISK</td>
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