<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-lg">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Form VAP</h3>
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
									<td width="70%" class="text-left">Demam >= 38C</td>
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
									<td width="70%" class="text-left">Leukopenia < 4000 WBC/mm3 atau Leukositosis >= 12.000 SDP/mm3</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="leukositosis" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="leukositosis" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Timbul Sputum Purulen</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="sputum" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="sputum" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Peningkatan FiO2 >= 0.2</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="fio2" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="fio2" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Peningkatan PEEP setiap hari sebesar >= 3cm H20 dari PEEP sebelumnya selama 2 hari berturut turut</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="peep" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="peep" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Kultur Sputum</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="kultur_sputum" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="kultur_sputum" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr id="kultur_sputum_keterangan" style="display: none">
									<td width="70%" class="text-left">Kultur Sputum Keterangan</td>
									<td width="30%" colspan="2">
										<input type="text" class="form-control" name="kultur_sputum_keterangan">
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Thorax foto gambaran pneumonia yang sebelumya tidak ada</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="thorax_foto" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="thorax_foto" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Diagnosa Dokter VAP</td>
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