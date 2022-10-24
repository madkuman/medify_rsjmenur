<div class="text-center" style="font-size: 16px;">1.</div>
<div style="padding-right: 17px">
	<table class="noBorder" style="font-size: 15px; font-weight: bold; margin-top: 5px;">
		<tr>
			<th width="35%" style="text-align: left;">N A M A</th>
			<th width="2%">:</th>
			<th width="65%" style="text-align: left;">{{$identitas->nama}}</th>
		</tr>
		<tr>
			<td style="vertical-align: top">TMP/TGL. LHR</td>
			<td style="vertical-align: top">:</td>
			<td style="vertical-align: top"><span style="font-size: 14px;"> {{$identitas->tempat_lahir}}, {{$tgl_lahir_short}} ({{$identitas->age_year}}Th)</span> </td>
		</tr>
		<tr>
			<td>PANGKAT</td>
			<td>:</td>
			<td>@if(!empty($pasien->tni_pangkat_singkat)) {{$pasien->tni_pangkat_singkat}} @else - @endif &nbsp;&nbsp;&nbsp; NRP. {{$pasien->tni_nrp}}</td>
		</tr>
		<tr>
			<td>JABATAN</td>
			<td>:</td>
			<td>@if(!empty($pasien->tni_jabatan)) {{$pasien->tni_jabatan}} @else - @endif</td>
		</tr>
		<tr>
			<td>KESATUAN</td>
			<td>:</td>
			<td>@if(!empty($pasien->tni_kotama->nama)) {{$pasien->tni_kotama->nama}} @else - @endif</td>
		</tr>
		<tr>
			<td>SATKER</td>
			<td>:</td>
			<td>@if(!empty($pasien->tni_satker)) {{$pasien->tni_satker->nama}} @else - @endif</td>
		</tr>
		<tr>
			<td>MASA KERJA</td>
			<td>:</td>
			<td>@if(!empty($masa_kerja)) {{$masa_kerja}} @else - @endif</td>
		</tr>
		<tr>
			<td>GOL. DARAH</td>
			<td>:</td>
			<td>{{$identitas->golongan_darah}}</td>
		</tr>
		<tr>
			<td>TGL. URIKKES</td>
			<td>:</td>
			<td>{{$tgl_periksa}}</td>
		</tr>
	</table>
	<hr>
</div>
<u><b style="font-size: 15px;">PEMERIKSAAN FISIK</b></u>
<table style="font-size: 15px; margin-top: 7px;">
	<tr>
		<th width="38%"><b>Tinggi Badan</b> </th>
		<th width="2%">:</th>
		<th width="25%">{{$identitas->tinggi_badan or ''}}</th>
		<th width="35%"> cm </th>
	</tr>
	<tr>
		<td><b>Berat Badan</b></td>
		<td>:</td>
		<td>{{$identitas->berat_badan or ''}}</td>
		<td> Kg</td>
	</tr>
	<tr>
		<td><b>Lingkar Perut</b></td>
		<td>:</td>
		<td>{{$identitas->lingkar_perut or ''}}</td>
		<td> cm</td>
	</tr>
	<tr>
		<td><b>Tekanan darah</b></td>
		<td>:</td>
		<td>{{$identitas->tekanan_darah_tensi or ''}}</td>
		<td> mmHg</td>
	</tr>
	<tr>
		<td><b>Nadi</b></td>
		<td>:</td>
		<td>{{$identitas->nadi or ''}}</td>
		<td> x/menit, Reguler</td>
	</tr>
	<tr>
		<td><b>Kepala</b></td>
		<td>:</td>
		<td colspan="2">@if(isset($klinis)) @if($klinis->kepala == 1) Normal @else {{$klinis->ket_kepala}} @endif @endif</td>
		<td></td>
	</tr>
	<tr>
		<td><b>Telinga</b></td>
		<td>:</td>
		<td colspan="2">@if(isset($klinis)) @if($klinis->telinga == 1) Normal @else {{$klinis->ket_telinga}} @endif @endif </td>
		<td></td>
	</tr>
	<tr>
		<td><b>Membran Tympani</b></td>
		<td>:</td>
		<td colspan="2">@if(isset($klinis)) @if($klinis->membran_tympani == 1) Normal @else {{$klinis->ket_membran_tympani}} @endif  @endif</td>
		<td></td>
	</tr>
	<tr>
		<td><b>Hidung</b></td>
		<td>:</td>
		<td colspan="2">@if(isset($klinis)) @if($klinis->hidung == 1) Normal @else {{$klinis->ket_hidung}} @endif @endif</td>
		<td></td>
	</tr>
	<tr>
		<td><b>Tenggorokan</b></td>
		<td>:</td>
		<td colspan="2">@if(isset($klinis)) @if($klinis->tenggorokan == 1) Normal @else {{$klinis->ket_tenggorokan}} @endif @endif</td>
		<td></td>
	</tr>
	<tr>
		<td><b>Tonsil</b></td>
		<td>:</td>
		<td colspan="2">@if(isset($klinis)) @if($klinis->tonsil == 1) Normal @else {{$klinis->ket_tonsil}} @endif @endif</td>
		<td></td>
	</tr>
	<tr>
		<td><b>Kulit</b></td>
		<td>:</td>
		<td colspan="2">@if(isset($klinis)) @if($klinis->kulit == 1) Normal @else {{$klinis->ket_kulit}} @endif @endif</td>
		<td></td>
	</tr>
	<tr>
		<td><b>Spirometry</b></td>
		<td>:</td>
		<td colspan="2">@if(isset($klinis)) {{$klinis->spirometry or "-"}} @endif</td>
		<td></td>
	</tr>
	<tr>
		<td><b>Neurologi</b></td>
		<td>:</td>
		<td colspan="2">@if(isset($klinis)) {{$klinis->neurologi or "-"}} @endif &nbsp;( Normal : 30 )</td>
		<td></td>
	</tr>
</table>