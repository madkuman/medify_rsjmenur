<input type="hidden" name="id" value="" id="id">
<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	{{csrf_field()}}
	<div class="row">
		<div class="form-group col-md-3 col-sm-12">
			<label>Tanggal Risiko Jatuh</label>
			<input type="text" class="form-control js-datepicker" name="tanggal_risiko_jatuh" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Jam Risiko Jatuh</label>
			<input type="text" class="form-control time" name="jam_risiko_jatuh" autocomplete="off">
		</div>
		<div class="col-12">
			<h4 class="pt-15">Skor Risiko Jatuh</h4>
		</div>
		<div class="col-12">
			<h5 class="pt-15 mb-5">Usia</h5>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio default" name="usia" value="-" data-skor="0">
					<span class="css-control-indicator"></span> -
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="usia" value="Kurang dari 50 Tahun" data-skor="8">
					<span class="css-control-indicator"></span> Kurang dari 50 Tahun
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="usia" value="50 sampai 79 Tahun" data-skor="10">
					<span class="css-control-indicator"></span> 50 sampai 79 Tahun
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="usia" value="Lebih dari 80 Tahun" data-skor="26">
					<span class="css-control-indicator"></span> Lebih dari 80 Tahun
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			<h5 class="pt-15 mb-5">Status Mental</h5>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio default" name="status_mental" value="-" data-skor="0">
					<span class="css-control-indicator"></span> -
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="status_mental" value="Kesadaran baik / orientasi baik setiap saat" data-skor="-4">
					<span class="css-control-indicator"></span> Kesadaran baik / orientasi baik setiap saat
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="status_mental" value="Agitasi / ansietas" data-skor="12">
					<span class="css-control-indicator"></span> Agitasi / ansietas
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="status_mental" value="Kadang-kadang bingung" data-skor="13">
					<span class="css-control-indicator"></span> Kadang-kadang bingung
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="status_mental" value="Bingung / disorientasi" data-skor="14">
					<span class="css-control-indicator"></span> Bingung / disorientasi
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			<h5 class="pt-15 mb-5">Eliminasi</h5>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio default" name="eliminasi" value="-" data-skor="0">
					<span class="css-control-indicator"></span> -
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="eliminasi" value="Mandiri dan mampu mengontrol BAB atau BAK" data-skor="8">
					<span class="css-control-indicator"></span> Mandiri dan mampu mengontrol BAB / BAK
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="eliminasi" value="Dower catheter atau colostomy" data-skor="12">
					<span class="css-control-indicator"></span> Dower catheter / colostomy
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="eliminasi" value="Eliminasi dengan bantuan" data-skor="10">
					<span class="css-control-indicator"></span> Eliminasi dengan bantuan
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="eliminasi" value="Gangguan eliminasi inkontinensia nokturia frekwensi" data-skor="12">
					<span class="css-control-indicator"></span> Gangguan eliminasi (inkontinensia / nokturia / frekwensi)
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="eliminasi" value="Inkontinensia tetapi mampu untuk mobilisasi" data-skor="12">
					<span class="css-control-indicator"></span> Inkontinensia tetapi mampu untuk mobilisasi
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			<h5 class="pt-15 mb-5">Pengobatan</h5>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input opsi-checkbox" name="pengobatan_tanpa" data-skor="10">
					<span class="css-control-indicator"></span> Tanpa obat-obatan
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input opsi-checkbox" name="pengobatan_jantung" data-skor="10">
					<span class="css-control-indicator"></span> Obat-obatan jantung
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input opsi-checkbox" name="pengobatan_psikotoprik" data-skor="8">
					<span class="css-control-indicator"></span> Obat-obatan psikotropik (termasuk benzodiazepin dan antidepresan)
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input opsi-checkbox" name="pengobatan_tambahan" data-skor="12">
					<span class="css-control-indicator"></span> Mendapat tambahan obat-obatan dan/atau obat-obatan PRN (psikiatri, anti nyeri) yang diberikan dalam 24 jam terakhir
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			<h5 class="pt-15 mb-5">Diagnosa</h5>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input opsi-checkbox" name="diagnosa_bipolar" data-skor="10">
					<span class="css-control-indicator"></span> Bipolar / Gangguan schizoaffective (F 31 / F25)
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input opsi-checkbox" name="diagnosa_obat" data-skor="8">
					<span class="css-control-indicator"></span> Penggunaan obat-obatan terlarang / ketergantungan alkohol (F 10 - F 19)
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input opsi-checkbox" name="diagnosa_gangguan" data-skor="10">
					<span class="css-control-indicator"></span> Gangguan depresi mayor (F 32.2; F32.3)
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input opsi-checkbox" name="diagnosa_demensia" data-skor="12">
					<span class="css-control-indicator"></span> Demensia / delirium ( F 00 - F 03; F 05)
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			<h5 class="pt-15 mb-5">Ambulasi / Keseimbangan</h5>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio default" name="ambulasi" value="-" data-skor="0">
					<span class="css-control-indicator"></span> -
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="ambulasi" value="Mandiri / Keseimbangan baik / Immobilisasi" data-skor="7">
					<span class="css-control-indicator"></span> Mandiri / Keseimbangan baik / Immobilisasi
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="ambulasi" value="Dengan alat bantu (kursi roda, walker, dll)" data-skor="8">
					<span class="css-control-indicator"></span> Dengan alat bantu (kursi roda, walker, dll)
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="ambulasi" value="Vertigo / Kelemahan" data-skor="10">
					<span class="css-control-indicator"></span> Vertigo / Kelemahan
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="ambulasi" value="Goyah / Membutuhkan bantuan dan menyadari kemampuan" data-skor="8">
					<span class="css-control-indicator"></span> Goyah / Membutuhkan bantuan dan menyadari kemampuan
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="ambulasi" value="Goyah tapi lupa keterbatasan" data-skor="15">
					<span class="css-control-indicator"></span> Goyah tapi lupa keterbatasan
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			<h5 class="pt-15 mb-5">Nutrisi</h5>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio default" name="nutrisi" value="-" data-skor="0">
					<span class="css-control-indicator"></span> -
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="nutrisi" value="Mengkonsumsi sedikit makanan atau minuman dalam 24 jam terakhir" data-skor="12">
					<span class="css-control-indicator"></span> Mengkonsumsi sedikit makanan atau minuman dalam 24 jam terakhir
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="nutrisi" value="Tidak ada kelainan nafsu makan" data-skor="0">
					<span class="css-control-indicator"></span> Tidak ada kelainan nafsu makan
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			<h5 class="pt-15 mb-5">Gangguan Pola Tidur</h5>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio default" name="gangguan_pola_tidur" value="-" data-skor="0">
					<span class="css-control-indicator"></span> -
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="gangguan_pola_tidur" value="Tidak ada gangguan tidur" data-skor="8">
					<span class="css-control-indicator"></span> Tidak ada gangguan tidur
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="gangguan_pola_tidur" value="Ada keluhan gangguan tidur yang dilaporkan oleh pasien" data-skor="12">
					<span class="css-control-indicator"></span> Ada keluhan gangguan tidur yang dilaporkan oleh pasien
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			<h5 class="pt-15 mb-5">Riwayat Jatuh</h5>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio default" name="riwayat_jatuh" value="-" data-skor="0">
					<span class="css-control-indicator"></span> -
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="riwayat_jatuh" value="Tidak ada riwayat jatuh" data-skor="8">
					<span class="css-control-indicator"></span> Tidak ada riwayat jatuh
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input opsi-radio" name="riwayat_jatuh" value="Ada riwayat jatuh dalam 3 bulan terakhir" data-skor="12">
					<span class="css-control-indicator"></span> Ada riwayat jatuh dalam 3 bulan terakhir
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			<h5 class="pt-15 mb-5" id="total_skor">Total Skor : </h5>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			<h4 class="pt-15 mb-5">Tindakan Resiko Jatuh</h4>
			<h6>Diisi apabila skor pasien &gt;= 90</h6>
		</div>
		<div class="col-md-6">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="pasien_skor_lebih_dari_90_pasang_stiker_warna_kuning">
					<span class="css-control-indicator"></span> Pasang stiker warna kuning di gelang
				</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="pasien_skor_lebih_dari_90_tempelkan_stiker_warna_kuning">
					<span class="css-control-indicator"></span> Tempelkan stiker warna kuning di RM pasien
				</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="pasien_skor_lebih_dari_90_pakaikan_baju_dengan_penanda">
					<span class="css-control-indicator"></span> Pakaikan baju dengan penanda "fall risk"
				</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="pasien_skor_lebih_dari_90_pakaikan_sprei_dengan_penanda">
					<span class="css-control-indicator"></span> Pakaikan sprei dengan penanda "fall risk"
				</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="pasien_skor_lebih_dari_90_motivasi_keluarga">
					<span class="css-control-indicator"></span> Motivasi keluarga untuk menunggu pasien
				</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="pasien_skor_lebih_dari_90_tempatkan_pasien_dekat_nurse_station">
					<span class="css-control-indicator"></span> Tempatkan pasien dekat nurse station atau tempat yang mudah diawasi
				</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="pasien_skor_lebih_dari_90_lakukan_pemasangan_fiksasi_fisil">
					<span class="css-control-indicator"></span> Lakukan pemasangan fiksasi fisik apabila diperlukan dengan persetujuan keluarga
				</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="pasien_skor_lebih_dari_90_orientasikan_pasien">
					<span class="css-control-indicator"></span> Orientasikan pasien/penunggu tentang lingkungan ruangan
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>	
		<div class="form-group col-md-3 col-sm-12">
			<label>Tanggal Pengecekan Tindakan</label>
			<input type="text" class="form-control js-datepicker" name="tanggal_pasien" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Jam Pengecekan Tindakan</label>
			<input type="text" class="form-control time" name="jam_pasien" autocomplete="off">
		</div>
	</div>

	<div class="block-skor-radio">
		<input type="hidden" name="usia_skor" value="" id="usia_skor">
		<input type="hidden" name="status_mental_skor" value="" id="status_mental_skor">
		<input type="hidden" name="eliminasi_skor" value="" id="eliminasi_skor">
		<input type="hidden" name="ambulasi_skor" value="" id="ambulasi_skor">
		<input type="hidden" name="nutrisi_skor" value="" id="nutrisi_skor">
		<input type="hidden" name="gangguan_pola_tidur_skor" value="" id="gangguan_pola_tidur_skor">
		<input type="hidden" name="riwayat_jatuh_skor" value="" id="riwayat_jatuh_skor">
	</div>

	<div class="block-skor-checkbox">
		<input type="hidden" name="pengobatan_tanpa_skor" value="" id="pengobatan_tanpa_skor">
		<input type="hidden" name="pengobatan_jantung_skor" value="" id="pengobatan_jantung_skor">
		<input type="hidden" name="pengobatan_psikotoprik_skor" value="" id="pengobatan_psikotoprik_skor">
		<input type="hidden" name="pengobatan_tambahan_skor" value="" id="pengobatan_tambahan_skor">
		<input type="hidden" name="diagnosa_bipolar_skor" value="" id="diagnosa_bipolar_skor">
		<input type="hidden" name="diagnosa_obat_skor" value="" id="diagnosa_obat_skor">
		<input type="hidden" name="diagnosa_gangguan_skor" value="" id="diagnosa_gangguan_skor">
		<input type="hidden" name="diagnosa_demensia_skor" value="" id="diagnosa_demensia_skor">
	</div>
</div>