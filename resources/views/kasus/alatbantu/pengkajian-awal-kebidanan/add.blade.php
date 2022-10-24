<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url()->current()}}/create" method="POST">
			{{csrf_field()}}
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Pengkajian Awal Kebidanan dan Kandungan</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<input type="hidden" name="kebidanan_id" id="id">
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
								<label class="col-12" for="reaksi_alergi">Reaksi Terhadap Alergi Diatas</label>
								<div class="col-12">
									<input type="text" class="form-control" name="reaksi_alergi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Gelang Tanda Alergi Dipasang (Warna Merah)</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="gelang_alergi" id="gelang_alergi1" value="Ya">
										<label class="custom-control-label" for="gelang_alergi1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="gelang_alergi" id="gelang_alergi2" value="Tidak" checked="">
										<label class="custom-control-label" for="gelang_alergi2">Tidak</label>
									</div>
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Riwayat / Pola Hidup</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="keluhan">Keluhan Utama</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keluhan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="riwayat_sekarang">Riwayat Penyakit Sekarang</label>
								<div class="col-12">
									<input type="text" class="form-control" name="riwayat_sekarang">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Riwayat Kesehatan Masa Lalu : Kardiovaskuler</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="kardiovaskuler" id="kardiovaskuler1" value="Ya">
										<label class="custom-control-label" for="kardiovaskuler1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="kardiovaskuler" id="kardiovaskuler2" value="Tidak" checked="">
										<label class="custom-control-label" for="kardiovaskuler2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Riwayat Kesehatan Masa Lalu : Hipertensi</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="hipertensi" id="hipertensi1" value="Ya">
										<label class="custom-control-label" for="hipertensi1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="hipertensi" id="hipertensi2" value="Tidak" checked="">
										<label class="custom-control-label" for="hipertensi2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Riwayat Kesehatan Masa Lalu : Diabetes</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="diabetes" id="diabetes1" value="Ya">
										<label class="custom-control-label" for="diabetes1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="diabetes" id="diabetes2" value="Tidak" checked="">
										<label class="custom-control-label" for="diabetes2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Riwayat Kesehatan Masa Lalu : Malaria</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="malaria" id="malaria1" value="Ya">
										<label class="custom-control-label" for="malaria1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="malaria" id="malaria2" value="Tidak" checked="">
										<label class="custom-control-label" for="malaria2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Riwayat Kesehatan Masa Lalu : Penyakit Kelamin / HIV / AIDS</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="kelamin" id="kelamin1" value="Ya">
										<label class="custom-control-label" for="kelamin1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="kelamin" id="kelamin2" value="Tidak" checked="">
										<label class="custom-control-label" for="kelamin2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pernah Dirawat</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="pernah_dirawat" id="pernah_dirawat1" value="Ya">
										<label class="custom-control-label" for="pernah_dirawat1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="pernah_dirawat" id="pernah_dirawat2" value="Tidak" checked="">
										<label class="custom-control-label" for="pernah_dirawat2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="sebab_dirawat">Sebab Dirawat</label>
								<div class="col-12">
									<input type="text" class="form-control" name="sebab_dirawat">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tempat_dirawat">Tempat Dirawat</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tempat_dirawat">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="bulan_tahun_dirawat">Bulan / Tahun Dirawat</label>
								<div class="col-12">
									<input type="text" class="form-control" name="bulan_tahun_dirawat">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="riwayat_keluarga">Riwayat Kesehatan Keluarga</label>
								<div class="col-12">
									<textarea class="form-control" rows="6" name="riwayat_keluarga">Kanker :
Penyakit Hati :
Diabetes :
Penyakit Ginjal :
Kelainan Bawaan :
Hipertensi :
Epilepsi :
Alergi :
Hamil Kembar :</textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="hpht">HPHT</label>
								<div class="col-12">
									<input type="text" class="js-datepicker form-control" autocomplete="off" name="hpht" data-week-start="1" data-autoclose="true" data-date-format="dd/mm/yy" value="" id="hpht">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tp">TP</label>
								<div class="col-12">
									<input type="text" class="js-datepicker form-control" autocomplete="off" name="tp" data-week-start="1" data-autoclose="true" data-date-format="dd/mm/yy" value="" id="tp">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="gerakan_janin">Gerakan Janin</label>
								<div class="col-12">
									<input type="text" class="form-control" name="gerakan_janin">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penyulit">Tanda Bahaya / Penyulit</label>
								<div class="col-12">
									<input type="text" class="form-control" name="penyulit">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="obat_dikonsumsi">Obat-obatan yang dikonsumsi (termasuk jamu)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="obat_dikonsumsi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="riwayat_kb_lalu">Riwayat KB yang lalu</label>
								<div class="col-12">
									<select class="form-control js-select2" id="riwayat_kb_lalu" name="riwayat_kb_lalu[]" multiple="" style="width: 100%">
										<option value="Tidak Ada">Tidak Ada</option>
										<option value="AKDR">AKDR</option>
										<option value="Implan">Implan</option>
										<option value="Pil">Pil</option>
										<option value="Suntik 1 Bulan">Suntik 1 Bulan</option>
										<option value="Suntik 3 Bulan">Suntik 3 Bulan</option>
										<option value="Kondom">Kondom</option>
										<option value="Kalender">Kalender</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lama_kb">Lama Pemakaian KB</label>
								<div class="col-12">
									<input type="text" class="form-control" name="lama_kb">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="keluhan_pemakaian">Keluhan Pemakaian</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keluhan_pemakaian">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="rencana_kb">Rencana KB Selanjutnya</label>
								<div class="col-12">
									<input type="text" class="form-control" name="rencana_kb">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pola Sehari-hari : Merokok</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="merokok" id="merokok1" value="Ya">
										<label class="custom-control-label" for="merokok1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="merokok" id="merokok2" value="Tidak" checked="">
										<label class="custom-control-label" for="merokok2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pola Sehari-hari : Alkohol</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="alkohol" id="alkohol1" value="Ya">
										<label class="custom-control-label" for="alkohol1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="alkohol" id="alkohol2" value="Tidak" checked="">
										<label class="custom-control-label" for="alkohol2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alergi_sehari_hari">Alergi sehari-hari</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alergi_sehari_hari">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="nafsu_makan">Pola Nutrisi / Cairan : Nafsu Makan</label>
								<div class="col-12">
									<select class="form-control" id="nafsu_makan" name="nafsu_makan">
										<option value="Normal">Normal</option>
										<option value="Meningkat">Meningkat</option>
										<option value="Mual">Mual</option>
										<option value="Muntah">Muntah</option>
										<option value="Stomatitis">Stomatitis</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Perubahan Berat Badan</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="perubahan_bb" id="perubahan_bb1" value="Naik">
										<label class="custom-control-label" for="perubahan_bb1">Naik</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="perubahan_bb" id="perubahan_bb2" value="Turun" checked="">
										<label class="custom-control-label" for="perubahan_bb2">Turun</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="perubahan_bb" id="perubahan_bb3" value="Tetap" checked="">
										<label class="custom-control-label" for="perubahan_bb3">Tetap</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="perubahan_bb_kg">Perubahan Berat Badan (kg)</label>
								<div class="col-12">
									<input type="number" class="form-control" name="perubahan_bb_kg">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pola_nutrisi_keterangan">Pola Nutrisi / Cairan : Keterangan</label>
								<div class="col-12">
									<select class="form-control js-select2" id="pola_nutrisi_keterangan" name="pola_nutrisi_keterangan[]" multiple="" style="width: 100%">
										<option value="Infus">Infus</option>
										<option value="NGT">NGT</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="frekuensi_bab">Frekuensi BAB dalam 1 hari</label>
								<div class="col-12">
									<input type="text" class="form-control" name="frekuensi_bab">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kondisi_bab">Kondisi BAB</label>
								<div class="col-12">
									<select class="form-control" id="kondisi_bab" name="kondisi_bab">
										<option value="Normal">Normal</option>
										<option value="Konstipati">Konstipati</option>
										<option value="Diare">Diare</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="frekuensi_bak">Frekuensi BAK dalam 1 hari</label>
								<div class="col-12">
									<input type="text" class="form-control" name="frekuensi_bak">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kondisi_bak">Kondisi BAK</label>
								<div class="col-12">
									<select class="form-control" id="kondisi_bak" name="kondisi_bak">
										<option value="Normal">Normal</option>
										<option value="Disuri, Nokturi">Disuri, Nokturi</option>
										<option value="Tidak Bisa Ditahan">Tidak Bisa Ditahan</option>
										<option value="Hematuri">Hematuri</option>
										<option value="Retensi">Retensi</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="durasi_tidur_siang">Pola Tidur : Durasi Tidur Siang</label>
								<div class="col-12">
									<input type="text" class="form-control" name="durasi_tidur_siang">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="durasi_tidur_malam">Pola Tidur : Durasi Tidur Malam</label>
								<div class="col-12">
									<input type="text" class="form-control" name="durasi_tidur_malam">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pola Tidur Insomnia</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="pola_tidur_insomnia" id="pola_tidur_insomnia1" value="Ya">
										<label class="custom-control-label" for="pola_tidur_insomnia1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="pola_tidur_insomnia" id="pola_tidur_insomnia2" value="Tidak" checked="">
										<label class="custom-control-label" for="pola_tidur_insomnia2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="gambaran_diri_terganggu">Pola Konsep Diri : Gambaran Diri Terganggu</label>
								<div class="col-12">
									<input type="text" class="form-control" name="gambaran_diri_terganggu">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="peran_terganggu">Pola Konsep Diri : Peran Terganggu</label>
								<div class="col-12">
									<input type="text" class="form-control" name="peran_terganggu">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="emosi">Pola Konsep Diri : Emosi</label>
								<div class="col-12">
									<input type="text" class="form-control" name="emosi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="frekuensi_seksual">Pola Reproduksi : Frekuensi Seksual</label>
								<div class="col-12">
									<input type="text" class="form-control" name="frekuensi_seksual">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pola_spritual">Pola Spiritual / Budaya / Nilai Kepercayaan yang dilakukan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="pola_spritual">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pola_hubungan">Pola Hubungan Peran Sosial - Ekonomi</label>
								<div class="col-12">
									<input type="text" class="form-control" name="pola_hubungan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Resiko Cedera / Jatuh</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="resiko_cedera" id="resiko_cedera1" value="Ya">
										<label class="custom-control-label" for="resiko_cedera1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="resiko_cedera" id="resiko_cedera2" value="Tidak" checked="">
										<label class="custom-control-label" for="resiko_cedera2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="status_fungsional">Status Fungsional</label>
								<div class="col-12">
									<select class="form-control" id="status_fungsional" name="status_fungsional">
										<option value="Mandiri">Mandiri</option>
										<option value="Perlu Bantuan">Perlu Bantuan</option>
										<option value="Ketergantungan Total">Ketergantungan Total</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="ketergantungan">Ketergantungan yang Dibutuhkan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="ketergantungan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Skrining Gizi : Asupan Makan Berkurang Karena Tidak Nafsu Makan</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="asupan_makan_berkurang" id="asupan_makan_berkurang1" value="Ya">
										<label class="custom-control-label" for="asupan_makan_berkurang1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="asupan_makan_berkurang" id="asupan_makan_berkurang2" value="Tidak" checked="">
										<label class="custom-control-label" for="asupan_makan_berkurang2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="gangguan_metabolisme">Gangguan Metabolisme yang Dialami</label>
								<div class="col-12">
									<input type="text" class="form-control" name="gangguan_metabolisme">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Skrining Gizi : Perubahan Berat Badan Lebih / Kurang dari Anjuran Selama Kehamilan</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="bb_lebih_kurang" id="bb_lebih_kurang1" value="Ya">
										<label class="custom-control-label" for="bb_lebih_kurang1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="bb_lebih_kurang" id="bb_lebih_kurang2" value="Tidak" checked="">
										<label class="custom-control-label" for="bb_lebih_kurang2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Skrining Gizi : Nilai Hb < 10 g/l atau HCT < 30%</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="hb_hct" id="hb_hct1" value="Ya">
										<label class="custom-control-label" for="hb_hct1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="hb_hct" id="hb_hct2" value="Tidak" checked="">
										<label class="custom-control-label" for="hb_hct2">Tidak</label>
									</div>
								</div>
							</div>
						</div>
						<div class="col-1 full-only"></div>
						<div class="col-md-5 col-12">
							<h5>Pemeriksaan Fisik</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="tinggi_badan">Tinggi Badan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tinggi_badan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="berat_badan_sebelum">Berat Badan Sebelum Hamil / Sakit</label>
								<div class="col-12">
									<input type="text" class="form-control" name="berat_badan_sebelum">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="berat_badan_sekarang">Berat Badan Sekarang</label>
								<div class="col-12">
									<input type="text" class="form-control" name="berat_badan_sekarang">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="gcs">GCS</label>
								<div class="col-12">
									<input type="text" class="form-control" name="gcs">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="imews">IMEWS</label>
								<div class="col-12">
									<input type="text" class="form-control" name="imews">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="temperatur">Temperatur</label>
								<div class="col-12">
									<input type="text" class="form-control" name="temperatur">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="nadi">Nadi</label>
								<div class="col-12">
									<input type="text" class="form-control" name="nadi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="rr">RR</label>
								<div class="col-12">
									<input type="text" class="form-control" name="rr">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="spo2">SPO2</label>
								<div class="col-12">
									<input type="text" class="form-control" name="spo2">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tekanan_darah">Tekanan Darah</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tekanan_darah">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="provokatif">Penilaian Nyeri : Provokatif</label>
								<div class="col-12">
									<input type="text" class="form-control" name="provokatif">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="quality">Penilaian Nyeri : Quality</label>
								<div class="col-12">
									<input type="text" class="form-control" name="quality">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="region">Penilaian Nyeri : Region</label>
								<div class="col-12">
									<input type="text" class="form-control" name="region">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="scala">Penilaian Nyeri : Scala</label>
								<div class="col-12">
									<input type="text" class="form-control" name="scala">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="time">Penilaian Nyeri : Time</label>
								<div class="col-12">
									<input type="text" class="form-control" name="time">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="nyeri_hilang">Penilaian Nyeri : Nyeri Hilang Apabila</label>
								<div class="col-12">
									<input type="text" class="form-control" name="nyeri_hilang">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kondisi_kepala">Kondisi Kepala</label>
								<div class="col-12">
									<input type="text" class="form-control" name="kondisi_kepala">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Rambut Rontok</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="rambut_rontok" id="rambut_rontok1" value="Ya">
										<label class="custom-control-label" for="rambut_rontok1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="rambut_rontok" id="rambut_rontok2" value="Tidak" checked="">
										<label class="custom-control-label" for="rambut_rontok2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Mata Icterus</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="mata_icterus" id="mata_icterus1" value="Ya">
										<label class="custom-control-label" for="mata_icterus1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="mata_icterus" id="mata_icterus2" value="Tidak" checked="">
										<label class="custom-control-label" for="mata_icterus2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Mata Cekung</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="mata_cekung" id="mata_cekung1" value="Ya">
										<label class="custom-control-label" for="mata_cekung1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="mata_cekung" id="mata_cekung2" value="Tidak" checked="">
										<label class="custom-control-label" for="mata_cekung2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Mata Anemis</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="mata_anemis" id="mata_anemis1" value="Ya">
										<label class="custom-control-label" for="mata_anemis1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="mata_anemis" id="mata_anemis2" value="Tidak" checked="">
										<label class="custom-control-label" for="rambut_rontok2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Mata Oedem</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="mata_oedem" id="mata_oedem1" value="Ya">
										<label class="custom-control-label" for="mata_oedem1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="mata_oedem" id="mata_oedem2" value="Tidak" checked="">
										<label class="custom-control-label" for="mata_oedem2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kondisi_leher">Kondisi Leher</label>
								<div class="col-12">
									<input type="text" class="form-control" name="kondisi_leher">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pembesaran Kelenjar Getah Bening</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="pembesaran_kelenjar_getah_bening" id="pembesaran_kelenjar_getah_bening1" value="Ya">
										<label class="custom-control-label" for="pembesaran_kelenjar_getah_bening1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="pembesaran_kelenjar_getah_bening" id="pembesaran_kelenjar_getah_bening2" value="Tidak" checked="">
										<label class="custom-control-label" for="pembesaran_kelenjar_getah_bening2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pembendungan Vena Julgularis</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="pembendungan_vena_julgularis" id="pembendungan_vena_julgularis1" value="Ya">
										<label class="custom-control-label" for="pembendungan_vena_julgularis1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="pembendungan_vena_julgularis" id="pembendungan_vena_julgularis2" value="Tidak" checked="">
										<label class="custom-control-label" for="pembendungan_vena_julgularis2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Mammae Simetris</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="mammae_simetris" id="mammae_simetris1" value="Ya">
										<label class="custom-control-label" for="mammae_simetris1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="mammae_simetris" id="mammae_simetris2" value="Tidak" checked="">
										<label class="custom-control-label" for="mammae_simetris2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Asi Keluar</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="asi_keluar" id="asi_keluar1" value="Ya">
										<label class="custom-control-label" for="asi_keluar1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="asi_keluar" id="asi_keluar2" value="Tidak" checked="">
										<label class="custom-control-label" for="asi_keluar2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Benjolan</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="benjolan" id="benjolan1" value="Ya">
										<label class="custom-control-label" for="benjolan1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="benjolan" id="benjolan2" value="Tidak" checked="">
										<label class="custom-control-label" for="benjolan2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Hyperpigmentasi Areola</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="hyperpigmentasi_areola" id="hyperpigmentasi_areola1" value="Ya">
										<label class="custom-control-label" for="hyperpigmentasi_areola1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="hyperpigmentasi_areola" id="hyperpigmentasi_areola2" value="Tidak" checked="">
										<label class="custom-control-label" for="hyperpigmentasi_areola2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="puting_susu">Puting Susu</label>
								<div class="col-12">
									<select class="form-control" id="puting_susu" name="puting_susu">
										<option value="Menonjol">Menonjol</option>
										<option value="Rata">Rata</option>
										<option value="Masuk Ke Dalam">Masuk Ke Dalam</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="suara_nafas">Suara Nafas</label>
								<div class="col-12">
									<select class="form-control" id="suara_nafas" name="suara_nafas">
										<option value="Vesikuler">Vesikuler</option>
										<option value="Broncho Vesikuler">Broncho Vesikuler</option>
										<option value="Whezzing">Whezzing</option>
										<option value="Ronchi">Ronchi</option>
										<option value="Sonor">Sonor</option>
										<option value="Hipersonor">Hipersonor</option>
										<option value="Redup">Redup</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="suara_jantung">Suara Jantung</label>
								<div class="col-12">
									<select class="form-control" id="suara_jantung" name="suara_jantung">
										<option value="Mur-Mur">Mur-Mur</option>
										<option value="S1 S2 Tunggal">S1 S2 Tunggal</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Abdomen : Acites</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="abdomen_acites" id="abdomen_acites1" value="Ya">
										<label class="custom-control-label" for="abdomen_acites1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="abdomen_acites" id="abdomen_acites2" value="Tidak" checked="">
										<label class="custom-control-label" for="benjolan2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Abdomen : Bising Usus</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="abdomen_bising_usus" id="abdomen_bising_usus1" value="Ya">
										<label class="custom-control-label" for="abdomen_bising_usus1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="abdomen_bising_usus" id="abdomen_bising_usus2" value="Tidak" checked="">
										<label class="custom-control-label" for="abdomen_bising_usus2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Abdomen : Nyeri Ulu Hati</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="abdomen_nyeri_ulu" id="abdomen_nyeri_ulu1" value="Ya">
										<label class="custom-control-label" for="abdomen_nyeri_ulu1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="abdomen_nyeri_ulu" id="abdomen_nyeri_ulu2" value="Tidak" checked="">
										<label class="custom-control-label" for="benjolan2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Abdomen : Linea Alba</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="abdomen_linea" id="abdomen_linea1" value="Ya">
										<label class="custom-control-label" for="abdomen_linea1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="abdomen_linea" id="abdomen_linea2" value="Tidak" checked="">
										<label class="custom-control-label" for="benjolan2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Abdomen : Inea Nigra</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="abdomen_inea" id="abdomen_inea1" value="Ya">
										<label class="custom-control-label" for="abdomen_inea1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="abdomen_inea" id="abdomen_inea2" value="Tidak" checked="">
										<label class="custom-control-label" for="benjolan2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Abdomen : Striae Livide</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="abdomen_striae_livide" id="abdomen_striae_livide1" value="Ya">
										<label class="custom-control-label" for="abdomen_striae_livide1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="abdomen_striae_livide" id="abdomen_striae_livide2" value="Tidak" checked="">
										<label class="custom-control-label" for="benjolan2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Abdomen : Striae Albican</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="abdomen_striae_albican" id="abdomen_striae_albican1" value="Ya">
										<label class="custom-control-label" for="abdomen_striae_albican1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="abdomen_striae_albican" id="abdomen_striae_albican2" value="Tidak" checked="">
										<label class="custom-control-label" for="abdomen_striae_albican2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Abdomen : Luka Bekas Operasi</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="abdomen_luka" id="abdomen_luka1" value="Ya">
										<label class="custom-control-label" for="abdomen_luka1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="abdomen_luka" id="abdomen_luka2" value="Tidak" checked="">
										<label class="custom-control-label" for="abdomen_luka2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="abdomen_leopold_i">Abdomen : Leopold I</label>
								<div class="col-12">
									<input type="text" class="form-control" name="abdomen_leopold_i">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="abdomen_bagian_fundus">Abdomen : Bagian Fundus Teraba</label>
								<div class="col-12">
									<input type="text" class="form-control" name="abdomen_bagian_fundus">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="abdomen_leopold_ii">Abdomen : Leopold II</label>
								<div class="col-12">
									<input type="text" class="form-control" name="abdomen_leopold_ii">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="abdomen_leopold_iii">Abdomen : Leopold III (bagian terendah janin)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="abdomen_leopold_iii">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="abdomen_leopold_iv">Abdomen : Leopold IV</label>
								<div class="col-12">
									<input type="text" class="form-control" name="abdomen_leopold_iv">
								</div>
							</div><div class="form-group row mb-5">
								<label class="col-12" for="abdomen_tfu">Abdomen : TFU (cm)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="abdomen_tfu">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="abdomen_tbj">Abdomen : TBJ (gr)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="abdomen_tbj">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="abdomen_djj">Abdomen : DJJ</label>
								<div class="col-12">
									<input type="text" class="form-control" name="abdomen_djj">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="abdomen_his">Abdomen : HIS</label>
								<div class="col-12">
									<input type="text" class="form-control" name="abdomen_his">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Labia Mayora dan Minora : Varises</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="labia_varises" id="labia_varises1" value="Ya">
										<label class="custom-control-label" for="labia_varises1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="labia_varises" id="labia_varises2" value="Tidak" checked="">
										<label class="custom-control-label" for="mata_icterus2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="labia_warna">Labia Mayora dan Minora : Warna Cairan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="labia_warna">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="labia_jumlah">Labia Mayora dan Minora : Jumlah Cairan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="labia_jumlah">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="labia_konsistensi">Labia Mayora dan Minora : Konsistensi Cairan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="labia_konsistensi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="labia_bau">Labia Mayora dan Minora : Bau Cairan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="labia_bau">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Erineum (Bekas Jahitan)</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="erineum" id="erineum1" value="Ya">
										<label class="custom-control-label" for="erineum1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="erineum" id="erineum2" value="Tidak" checked="">
										<label class="custom-control-label" for="erineum2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Hemoroid</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="hemoroid" id="hemoroid1" value="Ya">
										<label class="custom-control-label" for="hemoroid1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="hemoroid" id="hemoroid2" value="Tidak" checked="">
										<label class="custom-control-label" for="hemoroid2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Vulva Vagina : Pendarahan</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="vulva_pendarahan" id="vulva_pendarahan1" value="Ya">
										<label class="custom-control-label" for="vulva_pendarahan1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="vulva_pendarahan" id="vulva_pendarahan2" value="Tidak" checked="">
										<label class="custom-control-label" for="vulva_pendarahan2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Vulva Vagina : Fluor Albus</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="vulva_fluor_albus" id="vulva_fluor_albus1" value="Ya">
										<label class="custom-control-label" for="vulva_fluor_albus1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="vulva_fluor_albus" id="vulva_fluor_albus2" value="Tidak" checked="">
										<label class="custom-control-label" for="vulva_fluor_albus2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Vulva Vagina : Gatal</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="vulva_gatal" id="vulva_gatal1" value="Ya">
										<label class="custom-control-label" for="vulva_gatal1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="vulva_gatal" id="vulva_gatal2" value="Tidak" checked="">
										<label class="custom-control-label" for="vulva_gatal2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Vulva Vagina : Berwarna</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="vulva_berwarna" id="vulva_berwarna1" value="Ya">
										<label class="custom-control-label" for="vulva_berwarna1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="vulva_berwarna" id="vulva_berwarna2" value="Tidak" checked="">
										<label class="custom-control-label" for="vulva_berwarna2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Vulva Vagina : Berbau</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="vulva_berbau" id="vulva_berbau1" value="Ya">
										<label class="custom-control-label" for="vulva_berbau1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="vulva_berbau" id="vulva_berbau2" value="Tidak" checked="">
										<label class="custom-control-label" for="vulva_berbau2">Tidak</label>
									</div>
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Kebutuhan Edukasi</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="hambatan_belajar">Hambatan dalam Pembelajaran</label>
								<div class="col-12">
									<input type="text" class="form-control" name="hambatan_belajar">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penerjemah">Membutuhkan Penerjemah</label>
								<div class="col-12">
									<input type="text" class="form-control" name="penerjemah">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kebutuhan_pembelajaran">Kebutuhan Pembelajaran Pasien</label>
								<div class="col-12">
									<select class="form-control" id="kebutuhan_pembelajaran" name="kebutuhan_pembelajaran">
										<option value="Diagnosa dan Manajemen">Diagnosa dan Manajemen</option>
										<option value="Obat-obatan">Obat-obatan</option>
										<option value="Perawatan Luka">Perawatan Luka</option>
										<option value="Rehabilitasi">Rehabilitasi</option>
										<option value="Manajemen Nyeri">Manajemen Nyeri</option>
										<option value="Diet Nutrisi">Diet Nutrisi</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tanggal_pemeriksaan_penunjang">Tanggal Pemeriksaan Penunjang</label>
								<div class="col-12">
									<input type="text" class="js-datepicker form-control" autocomplete="off" name="tanggal_pemeriksaan_penunjang" data-week-start="1" data-autoclose="true" data-date-format="dd/mm/yy" value="">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Perencanaan Pulang</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Kriteria Discharge Planning : Umur > 65 Tahun</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="umur_65" id="umur_651" value="Ya">
										<label class="custom-control-label" for="umur_651">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="umur_65" id="umur_652" value="Tidak" checked="">
										<label class="custom-control-label" for="umur_652">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Kriteria Discharge Planning : Keterbatasan Mobilitas</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="keterbatasan_mobilitas" id="keterbatasan_mobilitas1" value="Ya">
										<label class="custom-control-label" for="keterbatasan_mobilitas1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="keterbatasan_mobilitas" id="keterbatasan_mobilitas2" value="Tidak" checked="">
										<label class="custom-control-label" for="keterbatasan_mobilitas2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Kriteria Discharge Planning : Perawatan / Pengobatan Lanjutan</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="perawatan_pengobatan_lanjutan" id="perawatan_pengobatan_lanjutan1" value="Ya">
										<label class="custom-control-label" for="perawatan_pengobatan_lanjutan1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="perawatan_pengobatan_lanjutan" id="perawatan_pengobatan_lanjutan2" value="Tidak" checked="">
										<label class="custom-control-label" for="perawatan_pengobatan_lanjutan2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Kriteria Discharge Planning : Bantuan Beraktivitas Sehari-hari</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="bantuan_beraktivitas" id="bantuan_beraktivitas1" value="Ya">
										<label class="custom-control-label" for="bantuan_beraktivitas1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="bantuan_beraktivitas" id="bantuan_beraktivitas2" value="Tidak" checked="">
										<label class="custom-control-label" for="bantuan_beraktivitas2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="perencanaan_pulang">Perencanaan Pulang</label>
								<div class="col-12">
									<select class="form-control js-select2" id="perencanaan_pulang" name="perencanaan_pulang[]" multiple="multiple" style="width: 100%">
										<option value="Perawatan Diri (Mandi, BAK, BAB)">Perawatan Diri (Mandi, BAK, BAB)</option>
										<option value="Pemantauan Pemberian Obat">Pemantauan Pemberian Obat</option>
										<option value="Pemantauan Diet">Pemantauan Diet</option>
										<option value="Perawatan Luka">Perawatan Luka</option>
										<option value="Latihan Fisik Lanjutan">Latihan Fisik Lanjutan</option>
										<option value="Pendampingan Tenaga Khusus di rumah">Pendampingan Tenaga Khusus di rumah</option>
										<option value="Bantuan Medis / Perawatan di rumah (home care)">Bantuan Medis / Perawatan di rumah (home care)</option>
										<option value="Bantuan untuk melakukan aktivitas fisik (kursi rida, alat bantu jalan)">Bantuan untuk melakukan aktivitas fisik (kursi rida, alat bantu jalan)</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="diagnosa_kebidanan">Diagnosa Kebidanan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="diagnosa_kebidanan">
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
			</div><!-- /.modal-dialog -->
		</form>
	</div><!-- /.modal -->
</div>