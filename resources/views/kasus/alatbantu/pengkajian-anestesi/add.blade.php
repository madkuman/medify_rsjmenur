<div class="modal fade" id="addModal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
	<div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
		<div class="modal-content">
			<form method="POST" action="{{url()->current()}}/create">
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header">
						<h3 class="block-title">Asesmen Pengkajian Sedasi - Anestesi</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<input type="hidden" name="id" value="" class="id-asesmen">
					<input type="hidden" name="jenis" value="Hemodialisis">
					<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
						{{csrf_field()}}
						<div class="row mr-0">
							<div class="col-12">
								<h5 class="mb-5 mt-10">Masuk RS</h5>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Diagnosa Pre Ops</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Rencana Operasi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Diagnosa Post Ops</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Operasi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Berat Badan</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Tinggi Badan</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Riwayat Alergi Obat</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Lokasi Gigi Palsu (bila ada)</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Riwayat Asma (kambuh terakhir)</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Obat Asma (bila ada)</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row mr-0">
							<div class="col-12">
								<h5 class="mb-5 mt-10">Pemeriksaan Fisik</h5>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Keadaan Umum</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Tensi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Nadi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">RR</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Suhu</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">GCS</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Kepala/Leher</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Dada</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Abdomen</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Ekstremitas</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Obat yang sedang dipakai</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row mr-0">
							<div class="col-12">
								<h5 class="mb-5 mt-10">Pemeriksaan Penunjang</h5>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Hb</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">GDA/GDP</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">2JPP</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Bun</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">BT</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">CT</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Lekosit</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Na</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">K</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">CL</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">BUN</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Creatin</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Albumin</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Trombosit</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">SGOT/SGPT</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">PT/APT</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Lab Lain</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Foto Thorak</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">EKG</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-12 full-only"></div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Ringkasan masalah dan penyakit lain</label>
									<div class="col-12">
										<textarea class="form-control" name="home_care"></textarea>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row mr-0">
							<div class="col-12">
								<h5 class="mb-5 mt-10">Rencana Anestesi</h5>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Jenis Anestesi</label>
									<div class="col-12">
										<select class="form-control" name="umum">
											<option value="Sedasi Ringan / Sedang / Dalam">Sedasi Ringan / Sedang / Dalam</option>
											<option value="TIVA">TIVA</option>
											<option value="Anestesi umum / GA">Anestesi umum / GA</option>
											<option value="Peridural">Peridural</option>
											<option value="SAB">SAB</option>
											<option value="Blok Syaraf Perifer">Blok Syaraf Perifer</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-12 full-only"></div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Obat Premedikasi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Nama Dokter Anestesi yang mengkaji awal</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row mr-0">
							<div class="col-12">
								<h5 class="mb-5 mt-10">Pre Sedasi</h5>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Diagnosa</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Tanggal Operasi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Jenis Anestesi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Makan/Minum Terakhir Jam</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">GCS</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Tensi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Nadi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">RR</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Cairan Infus</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Obat lain yang diberikan</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Nama petugas premedikasi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row mr-0">
							<div class="col-12">
								<h5 class="mb-5 mt-10">Pra Induksi</h5>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Nama Dokter Anestesi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Diagnosa</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Jenis Anestesi</label>
									<div class="col-12">
										<select class="form-control" name="umum">
											<option value="Sedasi Ringan / Sedang / Dalam">Sedasi Ringan / Sedang / Dalam</option>
											<option value="TIVA">TIVA</option>
											<option value="Anestesi umum / GA">Anestesi umum / GA</option>
											<option value="Peridural">Peridural</option>
											<option value="SAB">SAB</option>
											<option value="Blok Syaraf Perifer">Blok Syaraf Perifer</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Keadaan Umum</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Tensi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Nadi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">RR</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Cairan Infus</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Obat lain yang diberikan</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row mr-0">
							<div class="col-12">
								<h5 class="mb-5 mt-10">Induksi</h5>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Nama Dokter Anestesi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Nama Dokter Bedah</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Perawat/Penata Anestesi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Diagnosa</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Tindakan Operasi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Jenis Anestesi</label>
									<div class="col-12">
										<select class="form-control" name="umum">
											<option value="Sedasi Ringan / Sedang / Dalam">Sedasi Ringan / Sedang / Dalam</option>
											<option value="TIVA">TIVA</option>
											<option value="Anestesi umum / GA">Anestesi umum / GA</option>
											<option value="Peridural">Peridural</option>
											<option value="SAB">SAB</option>
											<option value="Blok Syaraf Perifer">Blok Syaraf Perifer</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Keadaan Umum</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Tensi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Nadi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">RR</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Cairan Infus</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Obat lain yang diberikan</label>
									<div class="col-12">
										<input type="text" class="form-control" name="umum">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
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