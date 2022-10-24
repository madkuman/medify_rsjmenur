<div class="modal fade" id="lembarKomunikasiModal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
	<div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document" style="margin-bottom: 170px;">
		<div class="modal-content">
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header">
					<h3 class="block-title">Lembar Komunikasi - Informasi - Edukasi Pasien dan Keluarga</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
					<div class="row">
						<div class="col-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Tangal</th>
										<th>Jam</th>
										<th>Durasi</th>
										<th>Kebutuhan dan Materi Edukasi/ Informasi</th>
										<th>Metode</th>
										<th>Nama Pemberi Informasi</th>
										<th>Verifikasi</th>
										<th>Nama Penerima Informasi</th>
										<th>Hubungan dengan Pasien</th>
										<th></th>
									</tr>
								</thead>
								<tbody id="tableGrafik">
									<form method="POST" action="{{url()->current()}}/lembar/save">
										<tr class="item-row item-wrapper">
											{{csrf_field()}}
											<input type="hidden" name="asesmen_id" class="form-control" readonly>
											<td>
												<input type="text" class="form-control js-datepicker" name="tanggal_edukasi" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
											</td>
											<td>
												<input type="text" class="form-control blank-form time" name="jam_edukasi">
											</td>
											<td>
												<input type="text" class="form-control blank-form" name="durasi_edukasi">
											</td>
											<td>
												<input type="text" class="form-control blank-form" name="kebutuhan_materi_edukasi_informasi">
											</td>
											<td width="12%">
												<select class="form-control js-select2" name="metode" style="width: 100%">
													<option value="Diskusi">Diskusi</option>
													<option value="Demonstrasi">Demonstrasi</option>
													<option value="Ceramah">Ceramah</option>
													<option value="Simulasi">Simulasi</option>
													<option value="Observasi">Observasi</option>
													<option value="Praktek langsung">Praktek langsung</option>
												</select>
											</td>
											<td>
												<input type="text" class="form-control blank-form" name="nama_edukator_pemberi_informasi">
											</td>
											<td>
												<input type="text" class="form-control blank-form" name="verifikasi_verfikasi">
											</td>
											<td>
												<input type="text" class="form-control blank-form" name="nama_penerima_informasi">
											</td>
											<td>
												<input type="text" class="form-control blank-form" name="hubungan_terhadap_pasien">
											</td>
											<td>
												<button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
											</td>
										</tr>
									</form>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>