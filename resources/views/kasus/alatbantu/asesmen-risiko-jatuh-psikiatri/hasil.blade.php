
		
<table width="100%">
	<tr>
		<td width="25%"></td>
		<td width="2%"></td>
		<td width="73%"></td>
	</tr>
	<tr>
		<td class="align-top border-bottom" colspan="3"><h5 class="mb-0 mt-20">Skor Risiko Jatuh</h5></td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tanggal</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ tanggal_risiko_jatuh + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Jam</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ jam_risiko_jatuh + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Usia</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ usia + ` ( Skor : `+ usia_skor +`)</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Status Mental</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ status_mental + ` ( Skor : `+ status_mental_skor +`)</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Eliminasi</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ eliminasi + ` ( Skor : `+ eliminasi_skor +`)</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Pengobatan</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom"></td>
	</tr>
	<tr class="`+ pengobatan_tanpa + `">
		<td colspan="3" class="align-top border-bottom">&nbsp;&nbsp;&nbsp;&nbsp;✔ Tanpa obat-obatan (Skor : 10)</td>
	</tr>
	<tr class="`+ pengobatan_jantung + `">
		<td colspan="3" class="align-top border-bottom">&nbsp;&nbsp;&nbsp;&nbsp;✔ Obat-obatan jantung (Skor : 10)</td>
	</tr>
	<tr class="`+ pengobatan_psikotoprik + `">
		<td colspan="3" class="align-top border-bottom">&nbsp;&nbsp;&nbsp;&nbsp;✔ Obat-obatan psikotropik (termasuk benzodiazepin dan antidepresan) (Skor : 8)</td>
	</tr>
	<tr class="`+ pengobatan_tambahan + `">
		<td colspan="3" class="align-top border-bottom">&nbsp;&nbsp;&nbsp;&nbsp;✔ Mendapat tambahan obat-obatan dan/atau obat-obatan PRN (psikiatri, anti nyeri) yang diberikan dalam 24 jam terakhir (Skor : 12)</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Diagnosa</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom"></td>
	</tr>
	<tr class="`+ diagnosa_bipolar + `">
		<td colspan="3" class="align-top border-bottom">&nbsp;&nbsp;&nbsp;&nbsp;✔ Bipolar / Gangguan schizoaffective (F 31 / F25) (Skor : 10)</td>
	</tr>
	<tr class="`+ diagnosa_obat + `">
		<td colspan="3" class="align-top border-bottom">&nbsp;&nbsp;&nbsp;&nbsp;✔ Penggunaan obat-obatan terlarang / ketergantungan alkohol (F 10 - F 19) (Skor : 8)</td>
	</tr>
	<tr class="`+ diagnosa_gangguan + `">
		<td colspan="3" class="align-top border-bottom">&nbsp;&nbsp;&nbsp;&nbsp;✔ Gangguan depresi mayor (F 32.2; F32.3) (Skor : 10)</td>
	</tr>
	<tr class="`+ diagnosa_demensia + `">
		<td colspan="3" class="align-top border-bottom">&nbsp;&nbsp;&nbsp;&nbsp;✔ Demensia / delirium ( F 00 - F 03; F 05) (Skor : 12)</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Ambulasi</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ ambulasi + ` ( Skor : `+ ambulasi_skor +`)</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Nutrisi</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ nutrisi + ` ( Skor : `+ nutrisi_skor +`)</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Gangguan Pola Tidur</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ gangguan_pola_tidur + ` ( Skor : `+ gangguan_pola_tidur_skor +`)</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Riwayat Jatuh</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ riwayat_jatuh + ` ( Skor : `+ riwayat_jatuh_skor +`)</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Total Skor</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ total_skor +`</td>
	</tr>
	<tr>
		<td class="align-top border-bottom" colspan="3"><h6 class="mb-0 mt-20">Tindakan Resiko Jatuh</h6></td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tanggal</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ tanggal_pasien + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Jam</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ jam_pasien + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Pasang stiker warna kuning di gelang identitas</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ pasien_skor_lebih_dari_90_pasang_stiker_warna_kuning + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tempelkan stiker warna kuning di RM pasien</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ pasien_skor_lebih_dari_90_tempelkan_stiker_warna_kuning + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Pakaikan baju dengan penanda "fall risk"</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ pasien_skor_lebih_dari_90_pakaikan_baju_dengan_penanda + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Pakaikan sprei dengan penanda "fall risk"</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ pasien_skor_lebih_dari_90_pakaikan_sprei_dengan_penanda + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Motivasi keluarga untuk menunggu pasien</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ pasien_skor_lebih_dari_90_motivasi_keluarga + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tempatkan pasien dekat nurse station atau ditempatkan pada tempat yang mudah untuk diawasi</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ pasien_skor_lebih_dari_90_tempatkan_pasien_dekat_nurse_station + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Lakukan pemasangan fiksasi fisik apabila diperlukan dengan persetujuan keluarga</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ pasien_skor_lebih_dari_90_lakukan_pemasangan_fiksasi_fisil + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Orientasikan pasien / penunggu tentang lingkungan / ruangan</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ pasien_skor_lebih_dari_90_orientasikan_pasien + `</td>
	</tr>
</table>