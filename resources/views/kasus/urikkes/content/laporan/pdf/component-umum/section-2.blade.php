
<div  style="text-align:center; width:61%; margin-left: 20px;">
	<span>{{config('app.name')}}</span>
	<hr>
</div>
<br><br><br>

<p style="text-align: center;">UJI PEMERIKSAAN KESEHATAN <br>(MEDICAL CHECK UP)</p><hr align="center" width="50%">
<p style="text-align: center;">Tanggal : {{{$waktu_pemeriksaan}}}</p>
<br><br><br>
<table width="100%" style="margin-left: 20px; vertical-align: text-top;">
	<tr><th width="38%"></th><th width="2%"></th><th width="60%"></th></tr>
	<tr>
		<td>NAMA</td>
		<td>:</td>
		<td>{{$identitas->nama}}</td>
	</tr>
	<tr>
		<td colspan="2" class="dummy">dummy</td>
	</tr>
	<tr>
		<td>TEMPAT/TGL. LAHIR</td>
		<td>:</td>
		<td>{{$identitas->tempat_lahir}}, {{$tgl_lahir}}</td>
	</tr>
	<tr>
		<td colspan="2" class="dummy">dummy</td>
	</tr>
	<tr>
		<td>PANGKAT/KORPS</td>
		<td>:</td>
		<td>
			@if($pasien->is_anggota == 1)
			{{$pasien->tni_pangkat_singkat ?? '-'}}
			@else
			-
		@endif</td>
	</tr>
	<tr>
		<td colspan="2" class="dummy">dummy</td>
	</tr>
	<tr>
		<td>PEKERJAAN</td>
		<td>:</td>
		<td>
			@if(empty($identitas->pekerjaan) || $identitas->pekerjaan == 'undefined')
			-
			@else
			{{$identitas->pekerjaan}}
		@endif</td>
	</tr>
	<tr>
		<td colspan="2" class="dummy">dummy</td>
	</tr>
	<tr>
		<td>ALAMAT</td>
		<td>:</td>
		<td>{{$identitas->alamat}}</td>
	</tr>
</table>