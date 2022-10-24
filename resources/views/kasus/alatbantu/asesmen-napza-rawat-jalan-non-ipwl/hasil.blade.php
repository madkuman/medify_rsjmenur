
		
<table width="100%">
	<tr>
		<td width="25%"></td>
		<td width="2%"></td>
		<td width="73%"></td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Alergi</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ alergi + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Risiko</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ risiko + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tanggal Pengkajian</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ tanggal_pengkajian + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Jam Pengkajian</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ jam_pengkajian + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Riwayat Pemakaian Napza</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ riwayat_pemakaian_napza + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Jenis Napza yang dipakai</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`
			jenis_napza_yang_dipakai.forEach(function(item, index){
				if(index > 0){
					addJenis();		
				}

				var jenis = '-';
				if(item.jenis_napza_yang_dipakai != null) {
					jenis = item.jenis_napza_yang_dipakai
				}

				var sejak = '-';
				if(item.tanggal_sejak != null) {
					sejak = formatDate(item.tanggal_sejak.date);
				}

				var sampai = '-';
				if(item.tanggal_sampai_dengan != null) {
					sampai = formatDate(item.tanggal_sampai_dengan.date);
				}

				var cara_pakai = '-';
				if(item.cara_pakai != null) {
					cara_pakai = item.cara_pakai
				}

				hasil += `<p>`+ jenis +` sejak `+ sejak +` s/d `+ sampai + cara_pakai +`</p>`;
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
		<td class="align-top border-bottom">Perilaku kriminal di dalam rumah sendiri</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ perilaku_kriminal_di_dalam_rumah_sendiri + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Perilaku kriminal di luar rumah</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ perilaku_kriminal_di_luar_rumah + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Problem masyarakat</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ problem_masyarakat + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Riwayat perawatan di rumah sakit terkait napza</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ riwayat_perawatan_di_rumah_sakit_terkait_napza + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Riwayat rehabilitasi napza sebelumnya</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ riwayat_rehabilitasi_napza_sebelumnya + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tempat rehabilitasi</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ tempat_rehabilitasi + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Riwayat relaps dengan tanpa rehabilitasi napza</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ riwayat_relaps_dengan_tanpa_rehabilitasi_napza + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom" colspan="3"><h6 class="mb-0 mt-20">Faktor penyebab relaps</h6></td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Diajak teman</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ faktor_penyebab_relaps_diajak_teman + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Dipaksa teman</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ faktor_penyebab_relaps_dipaksa_teman + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tidak memiliki aktivitas berarti</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ faktor_penyebab_relaps_tidak_memiliki_aktivitas_berarti + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Dendam setelah masa pemulihan</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ faktor_penyebab_relaps_dendam_setelah_masa_pemulihan + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Konflik dengan orang tua</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ faktor_penyebab_relaps_konflik_dengan_orang_tua + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Bergabung dengan pengguna zat</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ faktor_penyebab_relaps_bergabung_dengan_pengguna_zat + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tidak mampu menahan suggest</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ faktor_penyebab_relaps_tidak_mampu_menahan_suggest + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Keinginan untuk menggunakan</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ faktor_penyebab_relaps_keinginan_untuk_menggunakan + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Riwayat seks bebas</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ riwayat_seks_bebas + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Anggota keluarga yang menggunakan napza</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ anggota_keluarga_yang_menggunakan_napza + `</td>
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