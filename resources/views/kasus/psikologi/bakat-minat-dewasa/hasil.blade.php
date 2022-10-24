
		
<table width="100%">
	<tr>
		<td width="25%"></td>
		<td width="2%"></td>
		<td width="73%"></td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tanggal Pemeriksaan</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ tanggal_pemeriksaan + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tujuan Tes</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ tujuan_tes + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Intelegensi Umum</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ intelegensi_umum + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Daya Nalar</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ daya_nalar + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Daya Analisa Sintesa</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ daya_analisa_sintesa + `</td>
	</tr>

	<tr>
		<td class="align-top border-bottom">Fleksibilitas Berpikir</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ fleksibilitas_berpikir + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Daya Ingat</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ daya_ingat + `</td>
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
		<td class="align-top border-bottom">Daya Tahan Kerja</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ daya_tahan_kerja + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Stabilitas Emosi</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ stabilitas_emosi + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Penyesuaian Diri</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ penyesuaian_diri + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Motivasi Dorongan Ambisi</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ motivasi_dorongan_ambisi + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Kerja Sama</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kerja_sama + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Kemampuan Verbal</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kemampuan_verbal + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Kemampuan Numerik</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kemampuan_numerik + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Minat</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`
		console.log(minat);
		minat.forEach(function(item, index){
			console.log(item);
			if (item != null) hasil += `<p>`+ item +`</p>`;
			else hasil += ``;
		});

		hasil += `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Kesimpulan</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ kesimpulan + `</td>
	</tr>
</table>