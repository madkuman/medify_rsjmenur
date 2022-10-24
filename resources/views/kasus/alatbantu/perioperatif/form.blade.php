<input type="hidden" name="id" value="" class="id-asesmen">
<input type="hidden" name="jenis" value="perioperatif">
<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	{{csrf_field()}}
	<h4 class="text-center mb-0">PRA OPERASI</h4>
	<div class="row mr-0">
		<div class="col-12">
			<h5 class="mb-5 mt-10">Pengkajian</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Pasien datang dari ruang</label>
				<div class="col-12">
					<input type="text" class="form-control" name="pasien_datang_dari_ruang">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Jam</label>
				<div class="col-12">
					<input type="text" class="form-control time" name="jam">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Keluhan Utama</label>
				<div class="col-12">
					<input type="text" class="form-control" name="keluhan_utama">
				</div>
			</div>
		</div>
		<div class="col-12 full-only"></div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Keadaan Umum</label>
				<div class="col-12">
					<select class="form-control" name="keadaan_umum">
						<option value="Composmentis">Composmentis</option>
						<option value="Somnolent">Somnolent</option>
						<option value="Apatis">Apatis</option>
						<option value="Stupor">Stupor</option>
						<option value="Coma">Coma</option>
						<option value="Lain-lain">Lain-lain</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Tekanan Darah</label>
				<div class="col-12">
					<input type="number" class="form-control" name="tekanan_darah">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">N</label>
				<div class="col-12">
					<input type="number" class="form-control" name="n">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">S</label>
				<div class="col-12">
					<input type="number" class="form-control" name="s">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">RR</label>
				<div class="col-12">
					<input type="number" class="form-control" name="rr">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">TB</label>
				<div class="col-12">
					<input type="number" class="form-control" name="tb">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">BB</label>
				<div class="col-12">
					<input type="number" class="form-control" name="bb">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Pernapasan</label>
				<div class="col-12">
					<select class="form-control" name="pernapasan">
						<option value="Spontan">Spontan</option>
						<option value="Canula">Canula</option>
						<option value="02">02</option>
						<option value="Tenang">Tenang</option>
						<option value="Cemas">Cemas</option>
						<option value="Tidak ada respon">Tidak ada respon</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-12 full-only"></div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="surat_ijin_operasi">
					<span class="css-control-indicator"></span> Surat Ijin Operasi
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="surat_ijin_pembiusan">
					<span class="css-control-indicator"></span> Surat Ijin Pembiusan
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="perhiasan">
					<span class="css-control-indicator"></span> Perhiasan
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="folley_catether">
					<span class="css-control-indicator"></span> Folley Catether
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="persiapan_kulit_cukur">
					<span class="css-control-indicator"></span> Persiapan kulit cukur
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="huknah">
					<span class="css-control-indicator"></span> Huknah, gliserin, yalt (jelly)
				</label>
			</div>
		</div>
		<div class="col-12 full-only"></div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Persediaan Darah</label>
				<div class="col-12">
					<input type="text" class="form-control" name="persediaan_darah">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Hasil Laboratorium</label>
				<div class="col-12">
					<input type="text" class="form-control" name="hasil_laboratorium">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Hasil Rontgen, USG, CT Scan, MRI, dll</label>
				<div class="col-12">
					<input type="text" class="form-control" name="rontgen">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Infus</label>
				<div class="col-12">
					<input type="text" class="form-control" name="infus">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Obat yang diberikan</label>
				<div class="col-12">
					<input type="text" class="form-control" name="obat_yang_diberikan">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Alergi</label>
				<div class="col-12">
					<input type="text" class="form-control" name="alergi">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Obat Premedikasi</label>
				<div class="col-12">
					<input type="text" class="form-control" name="obat_premedikasi">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Riwayat Operasi</label>
				<div class="col-12">
					<select class="form-control" name="riwayat_operasi">
						<option value="Belum pernah operasi">Belum pernah operasi</option>
						<option value="Pernah, < 6 Bulan">Pernah, < 6 Bulan</option>
						<option value="Pernah, > 6 Bulan">Pernah, > 6 Bulan</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Pendidikan kesehatan yang diberikan</label>
				<div class="col-12">
					<select class="form-control" name="pendidikan_kesehatan">
						<option value="Nafas Dalam">Nafas Dalam</option>
						<option value="Batuk">Batuk</option>
						<option value="Latihan Miring">Latihan Miring</option>
						<option value="Lain-lain">Lain-lain</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">OK Pasien masuk kamar Operasi</label>
				<div class="col-12">
					<input type="text" class="form-control" name="ok_pasien_masuk_kamar_operasi">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Jam Pasien masuk kamar Operasi</label>
				<div class="col-12">
					<input type="text" class="form-control" name="jam_pasien_masuk_kamar_operasi">
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row mr-0">
		<div class="col-12">
			<h5 class="mb-5 mt-10">Masalah Keperawatan</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Cemas</label>
				<div class="col-12">
					<textarea class="form-control" name="cemas"></textarea>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Nyeri</label>
				<div class="col-12">
					<textarea class="form-control" name="nyeri"></textarea>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Resiko Jatuh</label>
				<div class="col-12">
					<textarea class="form-control" name="resiko_jatuh"></textarea>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Resiko Hypovolemik</label>
				<div class="col-12">
					<textarea class="form-control" name="resiko_hypovolemik"></textarea>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row mr-0">
		<div class="col-12">
			<h5 class="mb-5 mt-10">Intervensi Implementasi (Jam Dilakukan)</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">KIE</label>
				<div class="col-12">
					<input type="text" class="form-control" name="kie">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Distraksi/Relaksasi</label>
				<div class="col-12">
					<input type="text" class="form-control" name="distraksi_relaksasi">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Kolaborasi pemberian terapi</label>
				<div class="col-12">
					<input type="text" class="form-control" name="kolaborasi_pemberian_terapi">
				</div>
			</div>
		</div>
		<div class="col-12 full-only"></div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Kaji tingkat nyeri</label>
				<div class="col-12">
					<input type="text" class="form-control" name="kaji_tingkat_nyeri">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Distraksi/Relaksasi</label>
				<div class="col-12">
					<input type="text" class="form-control" name="distraksi_relaksasi2">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Kolaborasi pemberian terapi</label>
				<div class="col-12">
					<input type="text" class="form-control" name="kolaborasi_pemberian_terapi2">
				</div>
			</div>
		</div>
		<div class="col-12 full-only"></div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Observasi tingkat kesadaran</label>
				<div class="col-12">
					<input type="text" class="form-control" name="observasi_tingkat_kesadaran">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Pasang pengaman pasien</label>
				<div class="col-12">
					<input type="text" class="form-control" name="pasang_pengaman_pasien">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Pantau keadaan umum pasien</label>
				<div class="col-12">
					<input type="text" class="form-control" name="pantau_keadaan_umum_pasien">
				</div>
			</div>
		</div>
		<div class="col-12 full-only"></div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Pantau Intake Output</label>
				<div class="col-12">
					<input type="text" class="form-control" name="pantau_intake_output">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Kolaborasi pemberian cairan</label>
				<div class="col-12">
					<input type="text" class="form-control" name="kolaborasi_pemberian_cairan">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Kolaborasi pemberian terapi</label>
				<div class="col-12">
					<input type="text" class="form-control" name="kolaborasi_pemberian_terapi3">
				</div>
			</div>
		</div>
	</div>
	<hr>
	<h4 class="text-center mb-0">INTRA OPERASI</h4>
	<div class="row mr-0">
		<div class="col-12">
			<h5 class="mb-5 mt-10">Pengkajian</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Mulai Anestesi</label>
				<div class="col-12">
					<input type="text" class="form-control time" name="mulai_anestesi">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Selesai Anestesi</label>
				<div class="col-12">
					<input type="text" class="form-control time" name="selesai_anestesi">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Jenis Pembiusan</label>
				<div class="col-12">
					<select class="form-control" name="jenis_pembiusan">
						<option value="Spinal">Spinal</option>
						<option value="General">General</option>
						<option value="Lokal">Lokal</option>
						<option value="Regional">Regional</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Posisi Infus</label>
				<div class="col-12">
					<select class="form-control" name="posisi_infus">
						<option value="Tangan Kanan/Kiri">Tangan Kanan/Kiri</option>
						<option value="Arteri Line">Arteri Line</option>
						<option value="CVP">CVP</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Posisi Pembedahan</label>
				<div class="col-12">
					<select class="form-control" name="posisi_pembedahan">
						<option value="Supine">Supine</option>
						<option value="Prone">Prone</option>
						<option value="Lateral">Lateral</option>
						<option value="Lithotomi">Lithotomi</option>
						<option value="Lain-lain">Lain-lain</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Jenis Operasi</label>
				<div class="col-12">
					<select class="form-control" name="jenis_operasi">
						<option value="Bersih">Bersih</option>
						<option value="Bersih Kontaminasi">Bersih Kontaminasi</option>
						<option value="Kontaminasi">Kontaminasi</option>
						<option value="Kotor">Kotor</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Golongan Operasi</label>
				<div class="col-12">
					<select class="form-control" name="golongan_operasi">
						<option value="Khusus">Khusus</option>
						<option value="Besar">Besar</option>
						<option value="Sedang">Sedang</option>
						<option value="Kecil">Kecil</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Posisi Tangan</label>
				<div class="col-12">
					<select class="form-control" name="posisi_tangan">
						<option value="Terlentang">Terlentang</option>
						<option value="Terlipat">Terlipat</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Chateter Urine</label>
				<div class="col-12">
					<select class="form-control" name="chateter_urine">
						<option value="Ya">Ya</option>
						<option value="Tidak">Tidak</option>
						<option value="Dalam OK">Dalam OK</option>
						<option value="Ruangan">Ruangan</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Dipasang Oleh</label>
				<div class="col-12">
					<input type="text" class="form-control" name="chateter_dipasang_oleh">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Disinfektisasi Kulit</label>
				<div class="col-12">
					<select class="form-control" name="disinfektisasi_kulit">
						<option value="Providone Iodine">Providone Iodine</option>
						<option value="Yodium">Yodium</option>
						<option value="Alkohol">Alkohol</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Incisie Kulit</label>
				<div class="col-12">
					<input type="text" class="form-control" name="incisie_kulit">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Diatermi</label>
				<div class="col-12">
					<select class="form-control" name="diatermi">
						<option value="Ya">Ya</option>
						<option value="Tidak">Tidak</option>
						<option value="Monopolar">Monopolar</option>
						<option value="Bipolar">Bipolar</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Code Diatermi</label>
				<div class="col-12">
					<select class="form-control" name="code_diatermi">
						<option value="Valley Lap">Valley Lap</option>
						<option value="Aesculap">Aesculap</option>
						<option value="Bertold">Bertold</option>
						<option value="Lain-lain">Lain-lain</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Dipasang Oleh</label>
				<div class="col-12">
					<input type="text" class="form-control" name="diatermi_dipasang_oleh">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Lokasi Plat Diatermi</label>
				<div class="col-12">
					<select class="form-control" name="lokasi_plat_diatermi">
						<option value="Bokong">Bokong</option>
						<option value="Tungkai Kaki">Tungkai Kaki</option>
						<option value="Tangan">Tangan</option>
						<option value="Paha">Paha</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Kondisi kulit sebelum</label>
				<div class="col-12">
					<select class="form-control" name="kondisi_kulit_sebelum">
						<option value="Utuh">Utuh</option>
						<option value="Menggelembung">Menggelembung</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Kondisi kulit sesudah</label>
				<div class="col-12">
					<select class="form-control" name="kondisi_kulit_sesudah">
						<option value="Utuh">Utuh</option>
						<option value="Benturan">Benturan</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Monitor Anestesi</label>
				<div class="col-12">
					<select class="form-control" name="monitor_anestesi">
						<option value="Ya">Ya</option>
						<option value="Tidak">Tidak</option>
						<option value="Standby">Standby</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Mesin Anestesi</label>
				<div class="col-12">
					<select class="form-control" name="mesin_anestesi">
						<option value="Ya">Ya</option>
						<option value="Tidak">Tidak</option>
						<option value="Standby">Standby</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Lokasi Thorniquet</label>
				<div class="col-12">
					<select class="form-control" name="lokasi_thorniquet">
						<option value="Lengan Kanan">Lengan Kanan</option>
						<option value="Lengan Kiri">Lengan Kiri</option>
						<option value="Kaki Kanan">Kaki Kanan</option>
						<option value="Kaki Kiri">Kaki Kiri</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Thorniquet Dimulai</label>
				<div class="col-12">
					<input type="text" class="form-control" name="thorniquet_dimulai">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Thorniquet Selesai</label>
				<div class="col-12">
					<input type="text" class="form-control" name="thorniquet_selesai">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Unit Pemanas Dimulai</label>
				<div class="col-12">
					<input type="text" class="form-control" name="unit_pemanas_dimulai">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Unit Pemanas Selesai</label>
				<div class="col-12">
					<input type="text" class="form-control" name="unit_pemanas_selesai">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Lokasi Pemakaian Imaging</label>
				<div class="col-12">
					<input type="text" class="form-control" name="lokasi_pemakaian_imaging">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Jenis Pemakaian Imaging</label>
				<div class="col-12">
					<input type="text" class="form-control" name="jenis_pemakaian_imaging">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Tampon</label>
				<div class="col-12">
					<select class="form-control" name="tampon">
						<option value="Ya">Ya</option>
						<option value="Tidak">Tidak</option>
						<option value="Dalam OK">Dalam OK</option>
						<option value="Ruangan">Ruangan</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Jumlah Kassa yang dipakai operasi</label>
				<div class="col-12">
					<input type="text" class="form-control" name="jumlah_kassa_yang_dipakai_operasi">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Jumlah Kassa besar yang dipakai operasi</label>
				<div class="col-12">
					<input type="text" class="form-control" name="jumlah_kassa_besar_yang_dipakai_operasi">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12"> Jumlah Deppres yang dipakai operasi</label>
				<div class="col-12">
					<input type="text" class="form-control" name="jumlah_deppres_yang_dipakai_operasi">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Jumlah Pisau yang dipakai operasi</label>
				<div class="col-12">
					<input type="text" class="form-control" name="jumlah_pisau_yang_dipakai_operasi">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Ukuran Pisau yang dipakai operasi</label>
				<div class="col-12">
					<input type="text" class="form-control" name="ukuran_pisau_yang_dipakai_operasi">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Jumlah Jarum yang dipakai operasi</label>
				<div class="col-12">
					<input type="text" class="form-control" name="jumlah_jarum_yang_dipakai_operasi">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Ukuran Jarum yang dipakai operasi</label>
				<div class="col-12">
					<input type="text" class="form-control" name="ukuran_jarum_yang_dipakai_operasi">
				</div>
			</div>
		</div>
		<div class="col-12 full-only"></div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="instrumen_lengkap">
					<span class="css-control-indicator"></span> Instrumen Lengkap
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="jaringan_pa">
					<span class="css-control-indicator"></span> Jaringan PA/Kultur/Sitologi
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="formulin">
					<span class="css-control-indicator"></span> Formulin
				</label>
			</div>
		</div>
	</div>
	<hr>
	<div class="row mr-0">
		<div class="col-12">
			<h5 class="mb-5 mt-10">Masalah Keperawatan</h5>
		</div>
		<div class="col-12">
			<div class="form-group row mb-5 mt-20">
				<label class="col-12">Resiko Tinggi Infeksi berhubungan dengan</label>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="proses_penyakit">
					<span class="css-control-indicator"></span> Proses penyakit
				</label>
			</div>
		</div>
		<div class="col-12">
			<div class="form-group row mb-5 mt-20">
				<label class="col-12">Resiko Cedera</label>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="posisi_yang_tidak_tepat_selama_pembedahan">
					<span class="css-control-indicator"></span> Posisi yang tidak tepat selama pembedahan
				</label>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="benda_asing_tertinggal">
					<span class="css-control-indicator"></span> Benda asing tertinggal
				</label>
			</div>
		</div>
	</div>
	<hr>
	<div class="row mr-0">
		<div class="col-12">
			<h5 class="mb-5 mt-10">Intervensi / Implementasi</h5>
		</div>
		<div class="col-md-4">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="bersihkan_daerah_yang_akan_dioperasi_dengan_alkohol">
					<span class="css-control-indicator"></span> Bersihkan daerah yang akan dioperasi dengan alkohol
				</label>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="cek_kadaluarsa_alat_yang_akan_dipakai">
					<span class="css-control-indicator"></span> Cek kadaluarsa alat yang akan dipakai
				</label>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="pertahankan_sterilitas_selama_pembedahan">
					<span class="css-control-indicator"></span> Pertahankan sterilitas selama pembedahan
				</label>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="cuci_tangan_secara_steril">
					<span class="css-control-indicator"></span> Cuci tangan secara steril
				</label>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="tutup_luka_operasi_dengan_kassa_steril">
					<span class="css-control-indicator"></span> Tutup luka operasi dengan kassa steril
				</label>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="pastikan_posisi_pasien_sesuai_tindakan_operasi">
					<span class="css-control-indicator"></span> Pastikan posisi pasien sesuai tindakan operasi
				</label>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="cek_daerah_penekanan_selama_operasi">
					<span class="css-control-indicator"></span> Cek daerah penekanan selama operasi
				</label>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="pasang_sabuk_atau_tali_pengaman">
					<span class="css-control-indicator"></span> Pasang sabuk atau tali pengaman
				</label>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="hitung_jumlah_kassa_kassa_besar_deppers_pisau_alat_instrumen_sebelum_dan_setelah_operasi">
					<span class="css-control-indicator"></span> Hitung jumlah kassa, kassa besar, deppers, pisau, alat instrumen, sebelum dan setelah operasi
				</label>
			</div>
		</div>
	</div>
	<hr>
	<div class="row mr-0">
		<div class="col-12">
			<h5 class="mb-5 mt-10">Evaluasi</h5>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="jumlah_kassa_kassa_besar_deppers_pisau_alat_instrumen_sebelum_dan_setelah_operasi_lengkap">
					<span class="css-control-indicator"></span> Jumlah kassa, kassa besar, deppers, pisau, alat instrumen, sebelum dan setelah operasi lengkap
				</label>
			</div>
		</div>
	</div>
</div>