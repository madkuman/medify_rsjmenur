<div class="modal" id="asesmenAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/asuhan-gizi/create" method="POST">
			{{csrf_field()}}
			<input type="hidden" name="id" value="" id="id">
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Asesmen Awal Lanjutan</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-md-5 col-12">
							<h5>Daignosis Medis</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Resiko malnutrisi berdasarkan hasil skrining gizi oleh perawat</label>
								<div class="col-12">
									<select class="form-control" id="resiko_malnutrisi" name="resiko_malnutrisi">
										<option value="Tidak Beresiko">Tidak Beresiko</option>
										<option value="Beresiko">Beresiko</option>
									</select>
								</div>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="kondisi_khusus">
									<span class="css-control-indicator"></span> Pasien memiliki kondisi khusus (penyakit kronis dengan komplikasi, anak, lansia, infeksi/trauma berat, sakit kritis)
								</label>
							</div>
							<div class="form-group mb-5">
								<label>
									Histori Alergi Pasien
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="alergi_telur">
									<span class="css-control-indicator"></span> Alergi : Telur
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="alergi_susu">
									<span class="css-control-indicator"></span> Alergi : Susu Sapi &amp; Olahannya
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="alergi_kacang">
									<span class="css-control-indicator"></span> Alergi : Kacang-kacangan
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="alergi_ikan">
									<span class="css-control-indicator"></span> Alergi : Ikan/Udang
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="alergi_gluten">
									<span class="css-control-indicator"></span> Alergi : Gluten/Gandum
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Alergi Lain (yang tidak tercantum diatas)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alergi_lain">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Preskripsi Diet</label>
								<div class="col-12">
									<select class="form-control" id="preskripsi_diet" name="preskripsi_diet">
										<option value="Makanan Biasa">Makanan Biasa</option>
										<option value="Makanan Khusus">Makanan Khusus</option>
									</select>
									<label>Keterangan Preskripsi Diet</label>
									<textarea name="preskripsi_diet_isi" class="form-control"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Tindak Lanjut</label>
								<div class="col-12">
									<select class="form-control" id="asesmen_tindak_lanjut" name="tindak_lanjut">
										<option value="Belum Perlu Asuhan Gizi">Belum Perlu Asuhan Gizi</option>
										<option value="Perlu Asuhan Gizi">Perlu Asuhan Gizi</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-1 full-only"></div>
						<div class="col-md-5 col-12 asesmen_tindak_lanjut_true" id="asesmen_tindak_lanjut_true" style="display: none">
							<h5>Asuhan Gizi</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Riwayat Terkait Gizi Dan Makanan</label>
								<div class="col-12">
									<textarea class="form-control" name="riwayat_gizi"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Data Antropometri</label>
								<div class="col-12">
									<textarea class="form-control" name="data_antropometri"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Data Biokimia dan Penunjang Terkait Gizi</label>
								<div class="col-12">
									<textarea class="form-control" name="data_biokimia"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Data Fisik - Klinis Terkait Gizi</label>
								<div class="col-12">
									<textarea class="form-control" name="data_fisik"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Riwayat Personal</label>
								<div class="col-12">
									<textarea class="form-control" name="riwayat_personal"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Diagnosis Gizi</label>
								<div class="col-12">
									<textarea class="form-control" name="diagnosis_gizi"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Intervensi Gizi</label>
								<div class="col-12">
									<textarea class="form-control" rows="6" name="intervensi">
Tujuan :
Target Intervensi :
Preskripsi Diet :
Edukasi / Konseling Gizi :
Kolaborasi Pelayanan :</textarea>
								</div>
							</div>
							{{--
							<div class="form-group row mb-5">
								<label class="col-12">Intervensi Gizi : Tujuan</label>
								<div class="col-12">
									<textarea class="form-control" name="tujuan"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Intervensi Gizi : Preskripsi Diet</label>
								<div class="col-12">
									<textarea class="form-control" name="preskripsi_diet"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Intervensi Gizi : Pemesanan Diet</label>
								<div class="col-12">
									<textarea class="form-control" name="pemesanan_diet"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Intervensi Gizi : Edukasi / Konseling Gizi</label>
								<div class="col-12">
									<textarea class="form-control" name="edukasi_konseling"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Intervensi Gizi : Kolaborasi Pelayanan</label>
								<div class="col-12">
									<textarea class="form-control" name="kolaborasi_pelayanan"></textarea>
								</div>
							</div> --}}
							<div class="form-group row mb-5">
								<label class="col-12">Rencana Monitoring & Evaluasi</label>
								<div class="col-12">
									<textarea class="form-control" name="monitoring"></textarea>
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
				</div>
			</div>
			
		</div><!-- /.modal-dialog -->
	</form>
</div><!-- /.modal -->
</div>