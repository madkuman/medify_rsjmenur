<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url()->current()}}/create" method="POST">
			{{csrf_field()}}
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Patograf</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<input type="hidden" name="patograf_id" id="id">
						<div class="col-md-5 col-12">
							<h5>Kondisi Pasien</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="ketuban_pecah_jam">Ketuban pecah sejak jam</label>
								<div class="col-12">
									<input type="text" class="form-control" name="ketuban_pecah_jam">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="mules_jam">Mules sejak jam</label>
								<div class="col-12">
									<input type="text" class="form-control" name="mules_jam">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="denyut_jantung_janin">Denyut Jantung Janin</label>
								<div class="col-12">
									<input type="text" class="form-control" name="denyut_jantung_janin">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="air_ketuban_penyusupan">Air Ketuban Penyusupan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="air_ketuban_penyusupan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pembukaan_serviks">Pembukaan Serviks</label>
								<div class="col-12">
									<input type="text" class="form-control" name="pembukaan_serviks">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="turunnya_kepala">Turunnya Kepala</label>
								<div class="col-12">
									<input type="text" class="form-control" name="turunnya_kepala">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="waktu">Waktu (jam)</label>
								<div class="col-12">
									<input type="text" class="form-control time" name="waktu" placeholder="hh:mm">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kontraksi_tiap_10">Kontraksi Tiap 10 Menit</label>
								<div class="col-12">
									<input type="text" class="form-control" name="kontraksi_tiap_10">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="oksitosin_ui">Oksitoksin U/I tetes/menit</label>
								<div class="col-12">
									<input type="text" class="form-control" name="oksitosin_ui">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="obat_dan_cairan_iv">Obat dan Cairan IV / Oral</label>
								<div class="col-12">
									<input type="text" class="form-control" name="obat_dan_cairan_iv">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="nadi">Nadi</label>
								<div class="col-12">
									<input type="text" class="form-control" name="nadi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tekanan_darah">Tekanan Darah</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tekanan_darah">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="suhu">Suhu</label>
								<div class="col-12">
									<input type="text" class="form-control" name="suhu">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="suhu_urin">Suhu Urin</label>
								<div class="col-12">
									<input type="text" class="form-control" name="suhu_urin">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="aseton_urin">Aseton Urin</label>
								<div class="col-12">
									<input type="text" class="form-control" name="aseton_urin">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="volume_urin">Volume Urin</label>
								<div class="col-12">
									<input type="text" class="form-control" name="volume_urin">
								</div>
							</div>
						</div>
						<div class="col-1 full-only"></div>
						<div class="col-md-5 col-12">
							<h5>Catatan Persalinan</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="tanggal">Tanggal</label>
								<div class="col-12">
									<input type="text" class="js-datepicker form-control" autocomplete="off" id="tanggal" name="tanggal" data-week-start="1" data-autoclose="true" data-date-format="dd/mm/yy" value="">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="nama_bidan">Nama Bidan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="nama_bidan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tempat_persalinan">Tempat Persalinan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tempat_persalinan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alamat_tempat_persalinan">Alamat Tempat Persalinan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alamat_tempat_persalinan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="catatan">Catatan Rujuk</label>
								<div class="col-12">
									<select class="form-control" id="catatan" name="catatan">
										<option value="Tidak Ada Rujukan">Tidak Ada Rujukan</option>
										<option value="Rujuk Kala I">Rujuk Kala I</option>
										<option value="Rujuk Kala II">Rujuk Kala II</option>
										<option value="Rujuk Kala III">Rujuk Kala III</option>
										<option value="Rujuk Kala IV">Rujuk Kala IV</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alasan_merujuk">Alasan Merujuk</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alasan_merujuk">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tempat_rujukan">Tempat Rujukan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tempat_rujukan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pendamping_rujuk">Pendamping pada saat merujuk</label>
								<div class="col-12">
									<select class="form-control" id="pendamping_rujuk" name="pendamping_rujuk">
										<option value="Bidan">Bidan</option>
										<option value="Suami">Suami</option>
										<option value="Keluarga">Keluarga</option>
										<option value="Teman">Teman</option>
										<option value="Dukun">Dukun</option>
										<option value="Tidak Ada">Tidak Ada</option>
									</select>
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Kala I</h5>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="normal">
									<span class="css-control-indicator"></span> Patograf Melewati Garis Waspada
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="masalah_kala_i">Masalah yang terjadi Kala I</label>
								<div class="col-12">
									<input type="text" class="form-control" name="masalah_kala_i">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penatalaksanaan_kala_i">Penatalaksanaan masalah tersebut</label>
								<div class="col-12">
									<input type="text" class="form-control" name="penatalaksanaan_kala_i">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="hasilnya_kala_i">Hasilnya</label>
								<div class="col-12">
									<input type="text" class="form-control" name="hasilnya_kala_i">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Kala II</h5>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="episotomi">
									<span class="css-control-indicator"></span> Episotomi
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="indikasi_episotomi">Indikasi Episotomi</label>
								<div class="col-12">
									<input type="text" class="form-control" name="indikasi_episotomi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pendamping_persalinan">Pendamping pada saat persalinan</label>
								<div class="col-12">
									<select class="form-control" id="pendamping_persalinan" name="pendamping_persalinan">
										<option value="Suami">Suami</option>
										<option value="Keluarga">Keluarga</option>
										<option value="Teman">Teman</option>
										<option value="Dukun">Dukun</option>
										<option value="Tidak Ada">Tidak Ada</option>
									</select>
								</div>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="gawat_janin">
									<span class="css-control-indicator"></span> Gawat Janin
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tindakan_gawat_janin">Tindakan ketika gawat janin</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tindakan_gawat_janin">
								</div>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="distosia_bahu">
									<span class="css-control-indicator"></span> Distosia Bahu
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tindakan_distosia_bahu">Tindakan ketika Distosia bahu</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tindakan_distosia_bahu">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="masalah_kala_ii">Masalah yang terjadi Kala II</label>
								<div class="col-12">
									<input type="text" class="form-control" name="masalah_kala_ii">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penatalaksanaan_kala_ii">Penatalaksanaan masalah tersebut</label>
								<div class="col-12">
									<input type="text" class="form-control" name="penatalaksanaan_kala_ii">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="hasilnya_kala_ii">Hasilnya</label>
								<div class="col-12">
									<input type="text" class="form-control" name="hasilnya_kala_ii">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Kala III</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="lama_kala_iii">Lama Kala III</label>
								<div class="col-12">
									<input type="text" class="form-control" name="lama_kala_iii">
								</div>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="pemberian_oksitosin">
									<span class="css-control-indicator"></span> Pemberian Oksitosion 10 U IM
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="waktu_pemberian_oksitosion">Waktu pemberian Oksitosion (apabila diberikan)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="waktu_pemberian_oksitosion">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alasan_tidak_oksitosion">Alasan tidak diberikan Oksitosion (apabila tidak diberikan)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alasan_tidak_oksitosion">
								</div>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="penegangan_tali">
									<span class="css-control-indicator"></span> Penegangan Tali Pusat Terkendali
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alasan_tidak_penegangan_tali">Alasan tidak melakukan penegangan tali pusat terkendali</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alasan_tidak_penegangan_tali">
								</div>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="masase">
									<span class="css-control-indicator"></span> Masase Fundus Uteri
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alasan_tidak_masase">Alasan tidak melakukan Masase Fundus Uteri</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alasan_tidak_masase">
								</div>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="plasenta_lengkap">
									<span class="css-control-indicator"></span> Plasenta lahir lengkap
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tindakan_plasenta_tidak_lengkap">Tindakan yang dilakukan (apabila plasenta tidak lengkap)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tindakan_plasenta_tidak_lengkap">
								</div>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="plasenta_30">
									<span class="css-control-indicator"></span> Plasenta tidak lahir > 30 menit
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tindakan_plasenta_tidak_30">Tindakan yang dilakukan (apabila plasenta tidak lahir > 30 menit)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tindakan_plasenta_tidak_30">
								</div>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="laserasi">
									<span class="css-control-indicator"></span> Laserasi
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tempat_laserasi">Tempat Laserasi (bila ada)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tempat_laserasi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="derajat_laserasi_perineum">Derajat Laserasi Perineum</label>
								<div class="col-12">
									<select class="form-control" id="derajat_laserasi_perineum" name="derajat_laserasi_perineum">
										<option value="Tidak Terjadi Laserasi">Tidak Terjadi Laserasi</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tindakan_laserasi_perineum">Tindakan yang dilakukan (apabila terdapat laserasi)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tindakan_laserasi_perineum">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penjahitan">Penjahitan</label>
								<div class="col-12">
									<select class="form-control" id="penjahitan" name="penjahitan">
										<option value="Tidak Dijahit">Tidak Dijahit</option>
										<option value="Jahit dengan Anestesi">Jahit dengan Anestesi</option>
										<option value="Jahit Tanpa Anestesi">Jahit Tanpa Anestesi</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alasan_tidak_dijahit">Alasan (apabila tidak dijahit)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alasan_tidak_dijahit">
								</div>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="atoni_uteri">
									<span class="css-control-indicator"></span> Atoni Uteri
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tindakan_atoni_uteri">Tindakan yang dilakukan (apabila terjadi Atoni uteri)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tindakan_atoni_uteri">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="jumlah_perdarahan">Jumlah Perdarahan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="jumlah_perdarahan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="masalah_kala_iii">Masalah yang terjadi Kala III</label>
								<div class="col-12">
									<input type="text" class="form-control" name="masalah_kala_iii">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penatalaksanaan_kala_iii">Penatalaksanaan masalah tersebut</label>
								<div class="col-12">
									<input type="text" class="form-control" name="penatalaksanaan_kala_iii">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="hasilnya_kala_iii">Hasilnya</label>
								<div class="col-12">
									<input type="text" class="form-control" name="hasilnya_kala_iii">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Bayi Baru Lahir</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="berat_badan">Berat Badan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="berat_badan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="panjang_badan">Panjang Badan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="panjang_badan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="jenis_kelamin">Jenis Kelamin</label>
								<div class="col-12">
									<select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
										<option value="Laki-laki">Laki-laki</option>
										<option value="Perempuan">Perempuan</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penilaian_bayi_lahir">Penilaian Bayi Baru Lahir</label>
								<div class="col-12">
									<select class="form-control" id="penilaian_bayi_lahir" name="penilaian_bayi_lahir">
										<option value="Baik">Baik</option>
										<option value="Ada Penyulit">Ada Penyulit</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tindakan_bayi_lahir">Tindakan Bayi Lahir</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="mengeringkan">
									<span class="css-control-indicator"></span> Mengeringkan
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="menghangatkan">
									<span class="css-control-indicator"></span> Menghangatkan
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="rangsangan_taktil">
									<span class="css-control-indicator"></span> Rangsangan Taktil
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="bungkus">
									<span class="css-control-indicator"></span> Bungkus bayi dan letakkan di sisi ibu
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="pencegahan_infeksi_mata">
									<span class="css-control-indicator"></span> Tindakan pencegahan infeksi mata
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="aspiksia">Aspiksia</label>
								<div class="col-12">
									<select class="form-control" id="aspiksia" name="aspiksia">
										<option value="Tidak terjadi Aspiksia">Tidak terjadi Aspiksia</option>
										<option value="Aspiksia Ringan">Aspiksia Ringan</option>
										<option value="Aspiksia Pucat">Aspiksia Pucat</option>
										<option value="Aspiksia Biru">Aspiksia Biru</option>
										<option value="Aspiksia Lemas">Aspiksia Lemas</option>

									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tindakan_aspiksia">Tindakan bila terjadi aspiksia</label>
								<div class="col-12">
									<select class="form-control" id="tindakan_aspiksia" name="tindakan_aspiksia">
										<option value="Tidak terjadi Aspiksia">Tidak terjadi Aspiksia</option>
										<option value="Mengeringkan">Mengeringkan</option>
										<option value="Menghangatkan">Menghangatkan</option>
										<option value="Rangsangan Taktil">Rangsangan Taktil</option>
										<option value="Bebaskan jalan nafas">Bebaskan jalan nafas</option>
										<option value="Lain-lain">Lain-lain</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="cacat_bawaan">Cacat bawaan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="cacat_bawaan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tindakan_hipotermi">Tindakan apabila terjadi hipotermia</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tindakan_hipotermi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="waktu_pemberian_asi">Waktu Pemberian ASI</label>
								<div class="col-12">
									<input type="text" class="form-control" name="waktu_pemberian_asi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="masalah_bayi_lahir">Masalah yang terjadi ketika bayi lahir</label>
								<div class="col-12">
									<input type="text" class="form-control" name="masalah_bayi_lahir">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penatalaksanaan_bayi_lahir">Penatalaksanaan masalah tersebut</label>
								<div class="col-12">
									<input type="text" class="form-control" name="penatalaksanaan_bayi_lahir">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="hasilnya_bayi_lahir">Hasilnya</label>
								<div class="col-12">
									<input type="text" class="form-control" name="hasilnya_bayi_lahir">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Pemantauan Persalinan Kala IV</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="jam_ke">Jam ke</label>
								<div class="col-12">
									<input type="text" class="form-control" name="jam_ke">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="waktu_pemantauan">Waktu</label>
								<div class="col-12">
									<input type="text" class="form-control" name="waktu_pemantauan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tekanan_darah_pemantauan">Tekanan darah</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tekanan_darah_pemantauan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="nadi_pemantauan">Nadi</label>
								<div class="col-12">
									<input type="text" class="form-control" name="nadi_pemantauan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="suhu_pemantauan">Suhu</label>
								<div class="col-12">
									<input type="text" class="form-control" name="suhu_pemantauan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tinggi_fundus_uteri">Tinggi Fundus Uteri</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tinggi_fundus_uteri">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kontraksi_uterus">Kontraksi Uterus</label>
								<div class="col-12">
									<input type="text" class="form-control" name="kontraksi_uterus">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kandung_kemih">Kandung Kemih</label>
								<div class="col-12">
									<input type="text" class="form-control" name="kandung_kemih">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="perdarahan">Perdarahan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="perdarahan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="masalah_kala_iv">Masalah yang terjadi Kala IV</label>
								<div class="col-12">
									<input type="text" class="form-control" name="masalah_kala_iv">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penatalaksanaan_kala_iv">Penatalaksanaan masalah tersebut</label>
								<div class="col-12">
									<input type="text" class="form-control" name="penatalaksanaan_kala_iv">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="hasilnya_kala_iv">Hasilnya</label>
								<div class="col-12">
									<input type="text" class="form-control" name="hasilnya_kala_iv">
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