
		
<table width="100%">
	<tr>
		<td width="25%"></td>
		<td width="2%"></td>
		<td width="73%"></td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tanggal Tes</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ tanggal_tes + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Nomor</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ nomor + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tujuan Tes</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ tujuan_tes + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Kemampuan Intelegensi</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kemampuan_intelegensi + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Kategori</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kategori + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Dokter Pemeriksa</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ dokter + `</td>
	</tr>

	<tr>
		<td class="align-top border-bottom">Penalaran Kongkrit</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ penalaran_kongkrit + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Penalaran Abstrak</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ penalaran_abstrak + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Pemahaman Verbal</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ pemahaman_verbal + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Kemampuan Numerik</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kemampuan_numerik + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Daya Analisis Sintesa</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ daya_analisis_sintesa + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Daya Bayang Ruang</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ daya_bayang_ruang + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Konsentrasi & Daya Ingat</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ konsentrasi_daya_ingat + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Kemampuan Skolastik</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kemampuan_skolastik + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Kematangan Emosi</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kematangan_emosi + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Kemasakan Sosial</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kemasakan_sosial + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Kemampuan Adaptasi</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kemampuan_adaptasi + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Motivasi Berprestasi</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ motivasi_berprestasi + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Kecepatan Kerja</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kecepatan_kerja + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Ketelitian</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ ketelitian + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Ketekunan atau Keuletan</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ ketekunan_keuletan + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Daya Tahan Terhadap Stres</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ daya_tahan_terhadap_stress + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Overall</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ overall + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Minat</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`
			if(minat != '-') {
				minat.forEach(function(item, index){
					var judul_minat = '-';
					if(item.judul_minat != null) {
						judul_minat = item.judul_minat;
					}

					var minat_saya = '-';
					if(item.minat != null) {
						minat_saya = item.minat;
					}

					hasil += `<p>`+ judul_minat +` <br> `+ minat_saya +`</p>`;
				});
			} else {
				hasil += `-`;
			}

		hasil += `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Saran Pemilihan Penjurusan</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ saran_pemilihan_penjurusan + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Deskripsi</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ deskripsi + `</td>
	</tr>
</table>