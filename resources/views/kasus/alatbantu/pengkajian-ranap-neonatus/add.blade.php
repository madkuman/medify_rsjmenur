<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url()->current()}}/create" method="POST">
			{{csrf_field()}}
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Pengkajian Awal Rawat Inap Neonatus Anak</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<input type="hidden" name="neonatus_id" id="id">
						<div class="col-md-5 col-12">
							<h5>Informasi Umum</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="tgl_kedatangan">Tanggal Datang ke RS</label>
								<div class="col-12">
									<input type="text" class="js-datepicker form-control" autocomplete="off" name="tgl_kedatangan" data-week-start="1" data-autoclose="true" data-date-format="dd/mm/yy" value="">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="jam_kedatangan">Jam</label>
								<div class="col-12">
									<input type="text" name="jam_kedatangan" class="form-control time" placeholder="hh:mm">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="ruangan">Ruangan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="ruangan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="agama">Agama</label>
								<div class="col-12">
									<input type="text" class="form-control" name="agama">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alamat">Alamat</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alamat">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tgl_pengkajian">Tanggal Pengkajian</label>
								<div class="col-12">
									<input type="text" class="js-datepicker form-control" autocomplete="off" name="tgl_pengkajian" data-week-start="1" data-autoclose="true" data-date-format="dd/mm/yy" value="">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="jam_pengkajian">Jam</label>
								<div class="col-12">
									<input type="text" name="jam_pengkajian" class="form-control time" placeholder="hh:mm">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Alergi / Reaksi</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="alergi_obat">Alergi Obat</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alergi_obat">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="reaksi_obat">Reaksi Alergi Obat</label>
								<div class="col-12">
									<input type="text" class="form-control" name="reaksi_obat">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alergi_makanan">Alergi Makanan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alergi_makanan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="reaksi_makanan">Reaksi Alergi Makanan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="reaksi_makanan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alergi_lain">Alergi Lain</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alergi_lain">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alamat">Reaksi Terhadap Alergi Diatas</label>
								<div class="col-12">
									<input type="text" class="form-control" name="reaksi_terhadap_alergi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="gelang_tanda_alergi">Gelang Tanda Alergi</label>
								<div class="col-12">
									<select class="form-control" id="gelang_tanda_alergi" name="gelang_tanda_alergi">
										<option value="Terpasang">Terpasang</option>
										<option value="Tidak Terpasang">Tidak Terpasang</option>
									</select>
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Keluhan</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="keluhan">Keluhan Utama Masuk Rumah Sakit</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keluhan">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Riwayat Kesehatan</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="diagnosis_perawatan">Diagnosis Perawatan Sebelumnya (Bila pernah)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="diagnosis_perawatan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tempat_perawatan">Tempat Perawatan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tempat_perawatan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="waktu_perawatan">Waktu Perawatan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="waktu_perawatan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="riwayat_keluarga">Riwayat Penyakit Mayor Keluarga</label>
								<div class="col-12">
									<select class="form-control" id="riwayat_keluarga" name="riwayat_keluarga">
										<option value="Tidak Ada">Tidak Ada</option>
										<option value="Asma">Asma</option>
										<option value="DM">DM</option>
										<option value="Kardiovaskular">Kardiovaskular</option>
										<option value="Kanker">Kanker</option>
										<option value="Talasemia">Talasemia</option>
										<option value="Lain-lain">Lain-lain</option>
									</select>
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Riwayat Kehamilan</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="pemeriksaan_kehamilan">Pemeriksaan Kehamilan (ANC)</label>
								<div class="col-12">
									<select class="form-control" id="pemeriksaan_kehamilan" name="pemeriksaan_kehamilan">
										<option value="Tidak Pernah">Tidak Pernah</option>
										<option value="Ke Bidan">Ke Bidan</option>
										<option value="Ke Dokter">Ke Dokter</option>
										<option value="Ke Rumah Sakit">Ke Rumah Sakit</option>
										<option value="Ke Dukun">Ke Dukun</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penggunaan_obat">Penggunaan Obat-obatan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="penggunaan_obat">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="konsumsi_tablet_fe">Konsumsi Tablet Fe</label>
								<div class="col-12">
									<select class="form-control" id="konsumsi_tablet_fe" name="konsumsi_tablet_fe">
										<option value="Mengkonsumsi Rutin">Mengkonsumsi Rutin</option>
										<option value="Mengkonsumsi Tidak Rutin">Mengkonsumsi Tidak Rutin</option>
										<option value="Tidak Mengkonsumsi">Tidak Mengkonsumsi</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="gangguan_kehamilan">Gangguan Kehamilan</label>
								<div class="col-12">
									<select class="form-control" id="gangguan_kehamilan" name="gangguan_kehamilan">
										<option value="Tidak Ada">Tidak Ada</option>
										<option value="Hiperemis">Hiperemis</option>
										<option value="Preeklampsi">Preeklampsi</option>
										<option value="Eklampsi">Eklampsi</option>
										<option value="DM">DM</option>
										<option value="Perdarahan">Perdarahan</option>
										<option value="Lain-lain">Lain-lain</option>
									</select>
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Riwayat Kelahiran</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="cara_lahir">Cara Lahir</label>
								<div class="col-12">
									<select class="form-control" id="cara_lahir" name="cara_lahir">
										<option value="Spontan/Normal">Spontan/Normal</option>
										<option value="SC">SC</option>
										<option value="VE">VE</option>
										<option value="Forcep">Forcep</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pb">PB (cm)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="pb">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="BBL">BBL (gr)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="BBL">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lk">LK (cm)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="lk">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="ld">LD (cm)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="ld">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="ll">LL (cm)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="ll">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="as">AS</label>
								<div class="col-12">
									<input type="text" class="form-control" name="as">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="ketuban">Ketuban</label>
								<div class="col-12">
									<select class="form-control" id="ketuban" name="ketuban">
										<option value="Jernih">Jernih</option>
										<option value="Keruh">Keruh</option>
										<option value="Kehijauan">Kehijauan</option>
										<option value="Meconeal">Meconeal</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="keadaan_tali_pusat">Keadaan Tali Pusat</label>
								<div class="col-12">
									<select class="form-control" id="keadaan_tali_pusat" name="keadaan_tali_pusat">
										<option value="Basah">Basah</option>
										<option value="Baik">Baik</option>
										<option value="Layu">Layu</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penyulit_persalinan">Penyulit Persalinan</label>
								<div class="col-12">
									<select class="form-control" id="penyulit_persalinan" name="penyulit_persalinan">
										<option value="Partus Lama">Partus Lama</option>
										<option value="Letak Bayi">Letak Bayi</option>
										<option value="KPP">KPP</option>
										<option value="Perdarahan">Perdarahan</option>
										<option value="Penyakit Ibu">Penyakit Ibu</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="obat_selama_persalinan">Obat-obatan yang digunakan selama persalinan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="obat_selama_persalinan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="reflek">Reflek</label>
								<div class="col-12">
									<select class="form-control" id="reflek" name="reflek">
										<option value="Moro">Moro</option>
										<option value="Menghisap">Menghisap</option>
										<option value="Sucking Reflek">Sucking Reflek</option>
									</select>
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Riwayat Perawatan Post Natal</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="asi_hingga_usia">Pemberian ASI (bila diberikan) hingga usia</label>
								<div class="col-12">
									<input type="text" class="form-control" name="asi_hingga_usia">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alasan_tidak_asi">Alasan apabila tidak diberikan ASI</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alasan_tidak_asi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penyakit_neonatal">Penyakit Saat Neonatal (Kejang, Tetanus, Asfiksia, Ikterus, dll)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="penyakit_neonatal" name="penyakit_neonatal">
								</div>
								<!-- <div class="col-12">
									<select class="form-control" id="penyakit_neonatal" name="penyakit_neonatal">
										<option value="Kejang">Kejang</option>
										<option value="Tetanus Neonartum">Tetanus Neonartum</option>
										<option value="Asfiksia">Asfiksia</option>
										<option value="Ikterus">Ikterus</option>
										<option value="Lain-lain">Lain-lain</option>
									</select>
								</div> -->
							</div>
							<hr class="mt-20 mb-20">
							<h5>Riwayat Imunisasi</h5>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input"  name="bcg">
									<span class="css-control-indicator"></span> BCG
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input"  name="dpt">
									<span class="css-control-indicator"></span> DPT
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input"  name="hepatitis_b">
									<span class="css-control-indicator"></span> Hepatitis B
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input"  name="polio">
									<span class="css-control-indicator"></span> Polio
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input"  name="campak">
									<span class="css-control-indicator"></span> Campak
								</label>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Riwayat Psikososial</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="masalah_perilaku">Masalah Perilaku (bila ada)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="masalah_perilaku">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="perilaku_kekerasan">Perilaku Kekerasan yang dialami Pasien sebelumnya (bila ada)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="perilaku_kekerasan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="hubungan_keluarga">Hubungan Pasien dengan Anggota Keluarga</label>
								<div class="col-12">
									<select class="form-control" id="hubungan_keluarga" name="hubungan_keluarga">
										<option value="Baik">Baik</option>
										<option value="Tidak Baik">Tidak Baik</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tempat_tinggal">Tempat Tinggal</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tempat_tinggal">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="nama_kerabat">Nama kerabat terdekat yang dapat dihubungi</label>
								<div class="col-12">
									<input type="text" class="form-control" name="nama_kerabat">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="hubungan_kerabat">Hubungan dengan kerabat tersebut</label>
								<div class="col-12">
									<input type="text" class="form-control" name="hubungan_kerabat">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="telepon_kerabat">Nomor telepon kerabat</label>
								<div class="col-12">
									<input type="text" class="form-control" name="telepon_kerabat">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pekerjaan_ortu">Pekerjaan Orang Tua / Wali</label>
								<div class="col-12">
									<select class="form-control" id="pekerjaan_ortu" name="pekerjaan_ortu">
										<option value="TNI/POLRI">TNI/POLRI</option>
										<option value="PNS">PNS</option>
										<option value="Swasta">Swasta</option>
										<option value="Lain-lain">Lain-lain</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penghasilan_ortu">Penghasilan Orang Tua / Wali</label>
								<div class="col-12">
									<select class="form-control" id="penghasilan_ortu" name="penghasilan_ortu">
										<option value="< 1 Juta">< 1 Juta</option>
										<option value="1 - 2,9 Juta">1 - 2,9 Juta</option>
										<option value="3 - 4,9 Juta">3 - 4,9 Juta</option>
										<option value="5 - 9,9 Juta">5 - 9,9 Juta</option>
										<option value="10 - 14,9 Juta">10 - 14,9 Juta</option>
										<option value="15 - 19,9 Juta">15 - 19,9 Juta</option>
										<option value="> 20 Juta">> 20 Juta</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pendidikan">Pendidikan</label>
								<div class="col-12">
									<select class="form-control" id="pendidikan" name="pendidikan">
										<option value="SD">SD</option>
										<option value="SMP">SMP</option>
										<option value="SMA">SMA</option>
										<option value="Akademi">Akademi</option>
										<option value="Sarjana">Sarjana</option>
										<option value="Lain-lain">Lain-lain</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="budaya">Budaya / Nilai Kepercayaan yang perlu diperhatikan (bila ada)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="budaya">
								</div>
							</div>
						</div>
						<div class="col-1 full-only"></div>
						<div class="col-md-5 col-12">
							<h5>Pemeriksaan Fisik</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="td">TD</label>
								<div class="col-12">
									<input type="text" class="form-control" name="td">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="nadi">Nadi per menit</label>
								<div class="col-12">
									<input type="text" class="form-control" name="nadi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="p">P per menit</label>
								<div class="col-12">
									<input type="text" class="form-control" name="p">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="suhu">Suhu (dalam celcius)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="suhu">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="spo2">SPO2</label>
								<div class="col-12">
									<input type="text" class="form-control" name="spo2">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pews">PEWS</label>
								<div class="col-12">
									<input type="text" class="form-control" name="pews">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lingkar_kepala">Lingkar Kepala</label>
								<div class="col-12">
									<input type="text" class="form-control" name="lingkar_kepala">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="bb_sekarang">Berat Badan Sekarang</label>
								<div class="col-12">
									<input type="text" class="form-control" name="bb_sekarang">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="bb_sebelum">Berat Badan Sebelum Masuk RS</label>
								<div class="col-12">
									<input type="text" class="form-control" name="bb_sebelum">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="antropometri_tb">Antropometri TB</label>
								<div class="col-12">
									<input type="text" class="form-control" name="antropometri_tb">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="antropometri_lla">Antropometri LLA</label>
								<div class="col-12">
									<input type="text" class="form-control" name="antropometri_lla">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="nafsu_makan">Nafsu Makan</label>
								<div class="col-12">
									<input type="text" class="form-control" id="nafsu_makan" name="nafsu_makan">
								</div>
								<!-- <div class="col-12">
									<select class="form-control" id="nafsu_makan" name="nafsu_makan">
										<option value="Normal">Normal</option>
										<option value="Menurun">Menurun</option>
										<option value="Meningkat">Meningkat</option>
									</select>
								</div> -->
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pola_makan">Pola Makan</label>
								<div class="col-12">
									<input type="text" class="form-control" id="pola_makan" name="pola_makan">
								</div>
								<!-- <div class="col-12">
									<select class="form-control" id="pola_makan" name="pola_makan">
										<option value="2x / hari">2x / hari</option>
										<option value="3x / hari">3x / hari</option>
										<option value="Tidak Menentu">Tidak Menentu</option>
									</select>
								</div> -->
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="mual">Mual</label>
								<div class="col-12">
									<select class="form-control" id="mual" name="mual">
										<option value="Ya">Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="frekuensi_muntah">Frekuensi muntah (bila muntah)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="frekuensi_muntah">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="makanan_pantangan">Makanan Pantangan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="makanan_pantangan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="jumlah_minum_susu_formula">Jumlah Minum Susu Formula</label>
								<div class="col-12">
									<input type="text" class="form-control" name="jumlah_minum_susu_formula">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="ngt">NGT</label>
								<div class="col-12">
									<input type="text" class="form-control" name="ngt">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="dot">Dot</label>
								<div class="col-12">
									<input type="text" class="form-control" name="dot">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="sendok">Sendok</label>
								<div class="col-12">
									<input type="text" class="form-control" name="sendok">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Aktivitas Sehari-hari</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="tidur_siang">Durasi Tidur Siang</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tidur_siang">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tidur_malam">Durasi Tidur Malam</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tidur_malam">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="aktivitas_lain">Durasi Aktivitas Lainnya</label>
								<div class="col-12">
									<input type="text" class="form-control" name="aktivitas_lain">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kebiasaan_tidur">Kebiasaan Saat/Akan Tidur</label>
								<div class="col-12">
									<input type="text" class="form-control" name="kebiasaan_tidur">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="frekuensi mandi">Frekuensi Mandi</label>
								<div class="col-12">
									<input type="text" class="form-control" name="frekuensi mandi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="frekuensi_menyikat_gigi">Frekuensi Menyikat Gigi</label>
								<div class="col-12">
									<input type="text" class="form-control" name="frekuensi_menyikat_gigi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="frekuensi_mencuci_rambut">Frekuensi Mencuci Rambut</label>
								<div class="col-12">
									<input type="text" class="form-control" name="frekuensi_mencuci_rambut">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="frekuensi_ganti_pakaian">Frekuensi Ganti Pakaian</label>
								<div class="col-12">
									<input type="text" class="form-control" name="frekuensi_ganti_pakaian">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="bermain">Bermain</label>
								<div class="col-12">
									<select class="form-control" id="bermain" name="bermain">
										<option value="Dengan Teman Sebaya">Dengan Teman Sebaya</option>
										<option value="Dengan Keluarga">Dengan Keluarga</option>
										<option value="Lain-lain">Lain-lain</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pola_asuh">Pola Asuh</label>
								<div class="col-12">
									<select class="form-control" id="pola_asuh" name="pola_asuh">
										<option value="Ayah/Ibu">Ayah/Ibu</option>
										<option value="Kakek/Nenek">Kakek/Nenek</option>
										<option value="Anggota Keluarga Lain">Anggota Keluarga Lain</option>
										<option value="Pembantu / Pengasuh">Pembantu / Pengasuh</option>
										<option value="TPA">TPA</option>
									</select>
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Fisiologi Pernafasan</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="bentuk_dada">Bentuk Dada</label>
								<div class="col-12">
									<input type="text" class="form-control" name="bentuk_dada">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="frekuensi_nafas">Frekuensi Nafas</label>
								<div class="col-12">
									<input type="text" class="form-control" name="frekuensi_nafas">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="irama">Irama</label>
								<div class="col-12">
									<select class="form-control" id="irama" name="irama">
										<option value="Teratur">Teratur</option>
										<option value="Tidak Teratur">Tidak Teratur</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="retraksi_dada">Retraksi Dada</label>
								<div class="col-12">
									<select class="form-control" id="retraksi_dada" name="retraksi_dada">
										<option value="Ada">Ada</option>
										<option value="Tidak Ada">Tidak Ada</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="otot_bantu_pernafasan">Otot Bantu Pernafasan</label>
								<div class="col-12">
									<select class="form-control" id="otot_bantu_pernafasan" name="otot_bantu_pernafasan">
										<option value="Ya">Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="bunyi_nafas">Bunyi Nafas</label>
								<div class="col-12">
									<select class="form-control" id="bunyi_nafas" name="bunyi_nafas">
										<option value="Vesikuler">Vesikuler</option>
										<option value="Wheezing">Wheezing</option>
										<option value="Ronchi">Ronchi</option>
										<option value="Frition Rub">Frition Rub</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pernafasan_cuping_hidung">Pernafasan Cuping Hidung</label>
								<div class="col-12">
									<select class="form-control" id="pernafasan_cuping_hidung" name="pernafasan_cuping_hidung">
										<option value="Ya">Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="cyanosis_pernafasan">Letak Cyanosis (bila ada)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="cyanosis_pernafasan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="perkusi">Perkusi</label>
								<div class="col-12">
									<select class="form-control" id="perkusi" name="perkusi">
										<option value="Sonor">Sonor</option>
										<option value="Hipersonor">Hipersonor</option>
										<option value="Redup">Redup</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="batuk_sputum">Batuk Sputum</label>
								<div class="col-12">
									<input type="text" class="form-control" name="batuk_sputum">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alat_bantu_pernafasan">Alat Bantu Pernafasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alat_bantu_pernafasan">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Fisiologi Sirkulasi</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="bunyi_jantung">Bunyi Jantung</label>
								<div class="col-12">
									<select class="form-control" id="bunyi_jantung" name="bunyi_jantung">
										<option value="S1 S2 Tunggal">S1 S2 Tunggal</option>
										<option value="Murmur">Murmur</option>
										<option value="Gallop">Gallop</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="crt">CRT</label>
								<div class="col-12">
									<select class="form-control" id="crt" name="crt">
										<option value="< 2 detik">< 2 detik</option>
										<option value="> 2 detik">> 2 detik</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="cyanosis_sirkulasi">Letak Cyanosis (bila ada)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="cyanosis_sirkulasi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="clubbing_finger">Clubbing Finger</label>
								<div class="col-12">
									<select class="form-control" id="clubbing_finger" name="clubbing_finger">
										<option value="Ya">Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Neurologi</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="kesadaran">Kesadaran</label>
								<div class="col-12">
									<select class="form-control" id="kesadaran" name="kesadaran">
										<option value="Compos Mentis">Compos Mentis</option>
										<option value="Apatis">Apatis</option>
										<option value="Somnolen">Somnolen</option>
										<option value="Sopor">Sopor</option>
										<option value="Koma">Koma</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kejang">Kejang</label>
								<div class="col-12">
									<select class="form-control" id="kejang" name="kejang">
										<option value="Ya">Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tremor">Tremor</label>
								<div class="col-12">
									<select class="form-control" id="tremor" name="tremor">
										<option value="Ya">Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kaku_kuduk">Kaku Kuduk</label>
								<div class="col-12">
									<select class="form-control" id="kaku_kuduk" name="kaku_kuduk">
										<option value="Ya">Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Eliminasi</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="bentuk_kelamin">Bentuk Kelamin</label>
								<div class="col-12">
									<select class="form-control" id="bentuk_kelamin" name="bentuk_kelamin">
										<option value="Normal">Normal</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div><div class="form-group row mb-5">
								<label class="col-12" for="uretra">Uretra</label>
								<div class="col-12">
									<select class="form-control" id="uretra" name="uretra">
										<option value="Normal">Normal</option>
										<option value="Hipospadia">Hipospadia</option>
									</select>
								</div>
							</div><div class="form-group row mb-5">
								<label class="col-12" for="scrotum">Scrotum</label>
								<div class="col-12">
									<select class="form-control" id="scrotum" name="scrotum">
										<option value="Tidak Ada">Tidak Ada</option>
										<option value="Normal">Normal</option>
										<option value="Oedema">Oedema</option>
										<option value="Hiperemia">Hiperemia</option>
										<option value="Lain-lain">Lain-lain</option>
									</select>
								</div>
							</div><div class="form-group row mb-5">
								<label class="col-12" for="vagina">Vagina</label>
								<div class="col-12">
									<select class="form-control" id="vagina" name="vagina">
										<option value="Normal">Normal</option>
										<option value="Oedema">Oedema</option>
										<option value="Lain-lain">Lain-lain</option>
									</select>
								</div>
							</div><div class="form-group row mb-5">
								<label class="col-12" for="bak">BAK</label>
								<div class="col-12">
									<select class="form-control" id="bak" name="bak">
										<option value="Lancar">Lancar</option>
										<option value="Terhambat">Terhambat</option>
										<option value="Darah">Darah</option>
										<option value="Nyeri">Nyeri</option>
										<option value="Sekret">Sekret</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="frekuensi_bak">Frekuensi BAK</label>
								<div class="col-12">
									<input type="text" class="form-control" name="frekuensi_bak">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="jumlah_bak">Jumlah</label>
								<div class="col-12">
									<input type="text" class="form-control" name="jumlah_bak">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="warna_bak">Warna BAK</label>
								<div class="col-12">
									<input type="text" class="form-control" name="warna_bak">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="masalah_bak">Masalah BAK</label>
								<div class="col-12">
									<select class="form-control" id="masalah_bak" name="masalah_bak">
										<option value="Tidak Ada Masalah">Tidak Ada Masalah</option>
										<option value="Disuria">Disuria</option>
										<option value="Oliguria">Oliguria</option>
										<option value="Poliuri">Poliuri</option>
										<option value="Inkontinensia">Inkontinensia</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penggunaan_alat_bantu">Penggunaan Alat Bantu</label>
								<div class="col-12">
									<select class="form-control" id="penggunaan_alat_bantu" name="penggunaan_alat_bantu">
										<option value="Tidak Menggunakan Alat Bantu">Tidak Menggunakan Alat Bantu</option>
										<option value="Alat Bantu Permanen">Alat Bantu Permanen</option>
										<option value="Alat Bantu Tidak Permanen">Alat Bantu Tidak Permanen</option>
									</select>
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Gastro Intestinal</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="mulut">Mulut</label>
								<div class="col-12">
									<select class="form-control" id="mulut" name="mulut">
										<option value="Simetris">Simetris</option>
										<option value="Asimetris">Asimetris</option>
										<option value="Monoalisis">Monoalisis</option>
										<option value="Patastoschizis">Patastoschizis</option>
										<option value="Stomatis">Stomatis</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="bibir">Bibir</label>
								<div class="col-12">
									<select class="form-control" id="bibir" name="bibir">
										<option value="Normal">Normal</option>
										<option value="Kering">Kering</option>
										<option value="Labioschizis">Labioschizis</option>
										<option value="Pucat">Pucat</option>
										<option value="Cyanosis">Cyanosis</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lidah">Lidah</label>
								<div class="col-12">
									<select class="form-control" id="lidah" name="lidah">
										<option value="Kemerahan">Kemerahan</option>
										<option value="Pucat">Pucat</option>
										<option value="Kotor">Kotor</option>
										<option value="Bersih">Bersih</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="rongga_mulut">Rongga Mulut</label>
								<div class="col-12">
									<select class="form-control" id="rongga_mulut" name="rongga_mulut">
										<option value="Rudadada">Rudadada</option>
										<option value="Benturan">Benturan</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="nyeri_telan">Nyeri Telan</label>
								<div class="col-12">
									<select class="form-control" id="nyeri_telan" name="nyeri_telan">
										<option value="Ya">Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kembung">Kembung</label>
								<div class="col-12">
									<select class="form-control" id="kembung" name="kembung">
										<option value="Ya">Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="luka">Luka</label>
								<div class="col-12">
									<select class="form-control" id="luka" name="luka">
										<option value="Ya">Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="bising_usus">Bising Usus</label>
								<div class="col-12">
									<select class="form-control" id="bising_usus" name="bising_usus">
										<option value="Normal (+- 12-14/menit)">Normal (+- 12-14/menit)</option>
										<option value="Meningkat">Meningkat</option>
										<option value="Menurun">Menurun</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="anus_hemmoroid">Anus Hemmoroid</label>
								<div class="col-12">
									<select class="form-control" id="anus_hemmoroid" name="anus_hemmoroid">
										<option value="Ada">Ada</option>
										<option value="Tidak Ada">Tidak Ada</option>
									</select>
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Integumen</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="kulit">Kulit</label>
								<div class="col-12">
									<select class="form-control" id="kulit" name="kulit">
										<option value="Ikterus">Ikterus</option>
										<option value="Petekie">Petekie</option>
										<option value="Cyanosis">Cyanosis</option>
										<option value="Anemis">Anemis</option>
										<option value="Hyperemia">Hyperemia</option>
										<option value="Merah">Merah</option>
										<option value="Normal">Normal</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="turgor_kulit">Turgor Kulit</label>
								<div class="col-12">
									<select class="form-control" id="turgor_kulit" name="turgor_kulit">
										<option value="Normal">Normal</option>
										<option value="Menurun">Menurun</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="akral">Akral</label>
								<div class="col-12">
									<select class="form-control" id="akral" name="akral">
										<option value="Hangat">Hangat</option>
										<option value="Dingin">Dingin</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kebersihan">Kebersihan</label>
								<div class="col-12">
									<select class="form-control" id="kebersihan" name="kebersihan">
										<option value="Bersih">Bersih</option>
										<option value="Kotor">Kotor</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="punggung">Punggung</label>
								<div class="col-12">
									<select class="form-control" id="punggung" name="punggung">
										<option value="Spina Bifida">Spina Bifida</option>
										<option value="Lanugo">Lanugo</option>
										<option value="Lordosis">Lordosis</option>
										<option value="Kifosis">Kifosis</option>
										<option value="Skoliosis">Skoliosis</option>
										<option value="Normal">Normal</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="area_luka">Area Luka/Lesi (bila ada)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="area_luka">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Kelainan Bawaan</h5>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input"  name="tidak_ada">
									<span class="css-control-indicator"></span> Tidak Ada
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input"  name="omphalocel">
									<span class="css-control-indicator"></span> Omphalocel
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input"  name="gastroschizis">
									<span class="css-control-indicator"></span> Gastroschizis
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input"  name="hisprung_disease">
									<span class="css-control-indicator"></span> Hisprung Disease
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input"  name="atresia_ani">
									<span class="css-control-indicator"></span> Atresia Ani
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input"  name="polidaktili">
									<span class="css-control-indicator"></span> Polidaktili
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input"  name="sindaktili">
									<span class="css-control-indicator"></span> Sindaktili
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input"  name="ctev">
									<span class="css-control-indicator"></span> CTEV
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input"  name="down_syndrome">
									<span class="css-control-indicator"></span> Down Syndrome
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input"  name="caput_succedaneum">
									<span class="css-control-indicator"></span> Caput Succedaneum
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input"  name="cephal_hematoma">
									<span class="css-control-indicator"></span> Cephal Hematoma
								</label>
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
			</div><!-- /.modal-dialog -->
		</form>
	</div><!-- /.modal -->
</div>