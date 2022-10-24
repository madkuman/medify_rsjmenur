
		
<table width="100%">
	<tr>
		<td width="25%"></td>
		<td width="2%"></td>
		<td width="73%"></td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Riwayat pemakaian zat</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ riwayat_pemakaian_zat + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Jenis zat yang dipakai</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`

			jenis_zat_yang_dipakai.forEach(function(item, index){
				if(index > 0){
					addJenis();		
				}

				var jenis = '-';
				if(item.jenis_zat_yang_dipakai != null) {
					jenis = item.jenis_zat_yang_dipakai
				}

				var sejak = '-';
				if(item.tanggal_sejak != null) {
					sejak = formatDate(item.tanggal_sejak.date);
				}

				var sampai = '-';
				if(item.tanggal_sampai_dengan != null) {
					sampai = formatDate(item.tanggal_sampai_dengan.date);
				}

				hasil += `<p>`+ jenis +` sejak `+ sejak +` s/d `+ sampai +`</p>`;
			});	

		hasil += `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom" colspan="3"><h6 class="mb-0 mt-20">Etiologi penggunaan zat</h6></td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Diajak teman</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ etiologi_penggunaan_zat_diajak_teman + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Dipaksa teman</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ etiologi_penggunaan_zat_dipaksa_teman + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Coba coba keinginan sendiri</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ etiologi_penggunaan_zat_coba_coba_keinginan_sendiri + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Pelarian dari masalah</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ etiologi_penggunaan_zat_pelarian_dari_masalah + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Komplikasi medik jiwa</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ komplikasi_medik_jiwa + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Perilaku kriminal didalam rumah</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ perilaku_kriminal_didalam_rumah + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Perilaku kriminal diluar rumah</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ perilaku_kriminal_diluar_rumah + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Problem masyarakat</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ problem_masyarakat + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Riwayat perawatan dirumah sakit</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ riwayat_perawatan_dirumah_sakit + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Riwayat rehabilitasi napza</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ riwayat_rehabilitasi_napza + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tanggal pengkajian</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ tanggal_pengkajian + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Jam pengkajian</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ jam_pengkajian + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tanggal selesai pengkajian</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ tanggal_selesai_pengkajian + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Jam selesai pengkajian</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ jam_selesai_pengkajian + `</td>
	</tr>
</table>