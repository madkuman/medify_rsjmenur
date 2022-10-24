
		
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
		<td class="align-top border-bottom" colspan="3"><h6 class="mb-0 mt-20">Alasan penggunaan zat</h6></td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Diajak teman</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ alasan_penggunaan_zat_diajak_teman + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Dipaksa teman</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ alasan_penggunaan_zat_dipaksa_teman + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Coba coba keinginan sendiri</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ alasan_penggunaan_zat_coba_coba_keinginan_sendiri + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Pelarian dari masalah</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ alasan_penggunaan_zat_pelarian_dari_masalah + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Komplikasi medik jiwa</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ komplikasi_medik_jiwa + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom" colspan="3"><h6 class="mb-0 mt-20">Kriminal dirumah</h6></td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tidak ada Masalah</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kriminal_dirumah_tidak_ada_masalah + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Mencuri</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kriminal_dirumah_mencuri + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Mengancam</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kriminal_dirumah_mengancam + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Menggadai</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kriminal_dirumah_menggadai + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Mengambil barang dengan paksaan</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kriminal_dirumah_mengambil_barang_dengan_paksaan + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Menjual barang sendiri</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kriminal_dirumah_menjual_barang_sendiri + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Mengambil barang</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kriminal_dirumah_mengambil_barang + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Merusak</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kriminal_dirumah_merusak + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom" colspan="3"><h6 class="mb-0 mt-20">Kriminal diluar rumah</h6></td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tidak ada masalah</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kriminal_diluar_rumah_tidak_ada_masalah + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Mencuri</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kriminal_diluar_rumah_mencuri + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Merampas barang</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kriminal_diluar_rumah_merampas_barang + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Membunuh</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kriminal_diluar_rumah_membunuh + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Merampok</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kriminal_diluar_rumah_merampok + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Mengancam</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kriminal_diluar_rumah_mengancam + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Merusak</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kriminal_diluar_rumah_merusak + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom" colspan="3"><h6 class="mb-0 mt-20">Catatan polisi</h6></td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tidak Ada</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ catatan_polisi_tidak_ada + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Ditahan diproses pengadilan</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ catatan_polisi_ditahan_diproses_pengadilan + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Ditahan kemudian langsung dipulangkan</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ catatan_polisi_ditahan_kemudian_langsung_dipulangkan + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Lain lain Catatan Polisi</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ lain_lain_catatan_polisi + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom" colspan="3"><h6 class="mb-0 mt-20">Problem sekolah</h6></td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tidak ada masalah</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ problem_sekolah_tidak_ada_masalah + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tidak naik kelas</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ problem_sekolah_tidak_naik_kelas + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Berhenti sekolah</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ problem_sekolah_berhenti_sekolah + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Susah konsentrasi belajar</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ problem_sekolah_susah_konsentrasi_belajar + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Dikeluarkan dari sekolah</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ problem_sekolah_dikeluarkan_dari_sekolah + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tidak Disiplin</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ problem_sekolah_tidak_disiplin + `</td>
	</tr>
</table>