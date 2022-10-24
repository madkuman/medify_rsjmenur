
<div class="page_num">
	<p>5</p>
</div>
<b><h3 style="color: white">DUMMY</h3></b>
<table width="100%" border="1" style="margin-left: 10px;">
	<tr>
		<td class="table-header">PEMERIKSAAN</td>
		<td class="table-header">HASIL</td>
		<td class="table-header">NILAI NORMAL</td>
	</tr>
	<tr>
		<td style="padding-left: 5px;"><b>2. URINE LENGKAP</b></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Warna</td>
		<td style="padding-left: 5px;">{{$urine->warna or '-'}}</td>
		<td style="padding-left: 5px;"></td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Berat Jenis</td>
		<td style="padding-left: 5px;">{{$urine->berat_jenis or '-'}}</td>
		<td style="padding-left: 5px;">1,0 - 1,025</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">pH</td>
		<td style="padding-left: 5px;">{{$urine->ph or '-'}}</td>
		<td style="padding-left: 5px;">5,0 - 7,5</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Protein</td>
		<td style="padding-left: 5px;">{{$urine->protein or '-'}}</td>
		<td style="padding-left: 5px;">Negative</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Reduksi</td>
		<td style="padding-left: 5px;">{{$urine->reduksi or '-'}}</td>
		<td style="padding-left: 5px;"></td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Reduksi 2 Jpp</td>
		<td style="padding-left: 5px;">{{$urine->reduksi_2_jpp or '-'}}</td>
		<td style="padding-left: 5px;">Negative</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Urobilinogen</td>
		<td style="padding-left: 5px;">{{$urine->urobilinogen or '-'}}</td>
		<td style="padding-left: 5px;">Negative</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Bilirubin</td>
		<td style="padding-left: 5px;">{{$urine->bilirubin or '-'}}</td>
		<td style="padding-left: 5px;">Negative</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Keton</td>
		<td style="padding-left: 5px;">{{$urine->keton or '-'}}</td>
		<td style="padding-left: 5px;">Negative</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Nitrit</td>
		<td style="padding-left: 5px;">{{$urine->nitrit or '-'}}</td>
		<td style="padding-left: 5px;">Negative</td>
	</tr>
	<tr>
		<td style="padding-left: 10px;"><b>Test Kehamilan</b></td>
		<td style="padding-left: 5px;">{{$urine->tes_kehamilan or '-'}}</td>
		<td style="padding-left: 5px;">Negative</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;"><b style="text-decoration: underline;">SEDIMEN</b></td>
		<td style="padding-left: 5px;"></td>
		<td style="padding-left: 5px;"></td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Lekosit</td>
		<td style="padding-left: 5px;">{{$urine->leuko or '-'}}</td>
		<td style="padding-left: 5px;">0 - 1</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Epitel</td>
		<td style="padding-left: 5px;">{{$urine->epitel or '-'}}</td>
		<td style="padding-left: 5px;">0 - 1</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Bakteri</td>
		<td style="padding-left: 5px;">{{$urine->bakteri or '-'}}</td>
		<td style="padding-left: 5px;">Negative</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Silinder</td>
		<td style="padding-left: 5px;">{{$urine->cylinder or '-'}}</td>
		<td style="padding-left: 5px;">Negative</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Kristal</td>
		<td style="padding-left: 5px;">{{$urine->kristal or '-'}}</td>
		<td style="padding-left: 5px;">Negative</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Candida</td>
		<td style="padding-left: 5px;">{{$urine->candida or '-'}}</td>
		<td style="padding-left: 5px;"></td>
	</tr>
	<tr>
		<td style="padding-left: 10px;"><b>Test Narkoba</b></td>
		<td style="padding-left: 5px;"></td>
		<td style="padding-left: 5px;"></td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Morfin</td>
		<td style="padding-left: 5px;">{{$urine->morphin or '-'}}</td>
		<td style="padding-left: 5px;">Negative</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Metamphetamine</td>
		<td style="padding-left: 5px;">{{$urine->metamphetamine or '-'}}</td>
		<td style="padding-left: 5px;">Negative</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Amphetamin</td>
		<td style="padding-left: 5px;">{{$urine->amphetamine or '-'}}</td>
		<td style="padding-left: 5px;">Negative</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Diazepam</td>
		<td style="padding-left: 5px;">{{$urine->diazepam or '-'}}</td>
		<td style="padding-left: 5px;">Negative</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Ganja</td>
		<td style="padding-left: 5px;">{{$urine->ganja or '-'}}</td>
		<td style="padding-left: 5px;">Negative</td>
	</tr>
</table>        