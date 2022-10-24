
		
<table width="100%">
	<tr>
		<td width="25%"></td>
		<td width="2%"></td>
		<td width="73%"></td>
	</tr>
	<tr>
		<td class="align-top border-bottom">No BPJS</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ no_bpjs + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">No SEP</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ no_sep + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Terapi</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">
			<ol>`
			terapi.forEach(function(item, index){
				if (item != null)
					var row = `<li>`+ item +`</li>`;
				else
					var row = '-'
				hasil += row;
			});	

		hasil += `</ol></td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tanggal Surat Rujukan</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ tanggal_surat_rujukan + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">No Rujukan</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ no_rujukan + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Alasan</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">
			<ol>`
			alasan.forEach(function(item, index){
				if (item != null)
					var row = `<li>`+ item +`</li>`;
				else
					var row = '-'
				hasil += row;
			});	

		hasil += `</ol></td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Rencana Kunjungan</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">
			<ol>`
			rencana_kunjungan.forEach(function(item, index){
				if (item != null)
					var row = `<li>`+ item +`</li>`;
				else
					var row = '-'
				hasil += row;
			});	

		hasil += `</ol></td>
	</tr>
	<tr>
		<td class="align-top border-bottom">Tanggal Surat Keterangan</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ tanggal_surat_keterangan + `</td>
	</tr>
	<tr>
		<td class="align-top border-bottom">No Antrian</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ no_antrian + `</td>
	</tr>
</table>