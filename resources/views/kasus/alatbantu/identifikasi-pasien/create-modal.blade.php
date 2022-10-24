<div class="modal" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-lg">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Form Identifikasi Pasien</h3>
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
							{{csrf_field()}}
							<table class="mews table table-vcenter table-striped" width="100%">
								<tr>
									<td class="text-left" colspan="3">
										<label>Jenis Tindakan</label><br>
										<select class="form-control js-select2" required multiple name="jenis_tindakan[]" style="width: 100%">
											<option value="obat">Pemberian Obat</option>
											<option value="nutrisi">Pemberian Pengobatan Nutrisi untuk Diet Khusus</option>
											<option value="darah">Pemberian Darah dan Produk Darah</option>
											<option value="spesimen">Pengambilan Spesimen</option>
											<option value="terapi">Sebelum tindakan diagnostic atau therapeutic</option>
										</select>
									</td>
									
								</tr>
								<tr>
									<td width="70%" class="text-left">Memakai Gelang</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="gelang" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="gelang" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Pemakaian Gelang Sesuai</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="gelang_sesuai" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="gelang_sesuai" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Identitas Pasien Berupa Photo Diri *jiwa dan radioterapi</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="photo" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="photo" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Identifikasi 2 dari 3 (Nama, No RM, Tanggal Lahir)</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="identifikasi_px" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="identifikasi_px" value="1"/>
											<div>Yes</div>
										</label>
									</td>
								</tr>
								<tr>
									<td width="70%" class="text-left">Pertanyaan dengan kalimat terbuka</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="pertanyaan_terbuka" value="0" checked="checked" />
											<div>No</div>
										</label>
									</td>
									<td width="15%">
										<label class="mews-item">
											<input type="radio" name="pertanyaan_terbuka" value="1"/>
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