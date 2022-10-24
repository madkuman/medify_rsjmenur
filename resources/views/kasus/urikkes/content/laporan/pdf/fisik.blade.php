<!DOCTYPE html>
<html>
<style type="text/css">
	html{
		padding: 0%;
		height: 100%;
	}
	body{
		font-size: 16px;
		height: 100%;
		font-family: sans-serif;
	}
	table{
		border-collapse: collapse;

	}
	.noBorder{
		border: 0;
	}
	.bordered{
		border: 1px solid black;
	}
	.centered{
		text-align: center;
	}

	.table-title{
		padding-bottom: 5px;
		padding-top: 5px;
	}
	td div { 
		height: 33px;
		overflow: hidden; 
	}
	td{
		white-space: pre;
		padding-top: 0px;
		padding-bottom: 0px;
		vertical-align: top;
	}
	hr {
		border: none;
		height: 1px;
		/* Set the hr color */
		color: #333; /* old IE */
		background-color: #333; /* Modern Browsers */
	}

</style>
<head>
	<title>Laporan Kegiatan Kesehatan - Pemeriksaan Fisik</title>
</head>
<body>
	<div style="text-align: center; position: absolute; width: 26%;">
		{{config('app.name')}}
		<hr>
	</div>
	<div style="align-content: center; text-align: center;">
		<div style="margin-bottom: 8px">
			<img src="{{asset('assets/img/rumkital.png')}}" width="13%">
		</div>
		<strong>HASIL PEMERIKSAAN FISIK</strong>
		<hr style="width: 35%;">
		<p style="margin-top: 0px;">
			Tanggal Urikkes : {{$tanggal_hari_ini or '-'}}
		</p>
	</div>
	<table width="100%" class="noBorder">
		<tr>
			<th width="28%">&nbsp;</th>
			<th width="2%">&nbsp;</th>
			<th width="70%">&nbsp;</th>
		</tr>
		<tr>
			<td >Nama</td>
			<td>:</td>
			<td>{{$identitas->nama or '-'}}</td>
		</tr>
		<tr>
			<td>Tempat/tgl.lahir</td>
			<td>:</td>
			<td>{{$identitas->tempat_lahir or '-'}},{{$tgl_lahir or '-'}}</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td>{{$identitas->alamat}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="noBorder">
		<tr>
			<td width="28%"><u><b>Hasil Pemeriksaan</b></u></td>
			<th width="2%">&nbsp;</th>
			<th width="70%">&nbsp;</th>
		</tr>
		<tr>
			<td>Berat badan</td>
			<td>:</td>
			<td>{{$identitas->berat_badan or '-'}} kg</td>
		</tr>
		<tr>
			<td>Tinggi badan</td>
			<td>:</td>
			<td>{{$identitas->tinggi_badan or '-'}} cm</td>
		</tr>
		<tr>
			<td>Tensi nadi</td>
			<td>:</td>
			<td>{{$identitas->tekanan_darah_tensi or '-'}} mm/Hg, Denyut nadi : {{$identitas->nadi }} X/menit</td>
		</tr>
		<tr>
			<td>Postur tubuh</td>
			<td>:</td>
			<td>{{$identitas->bentuk_badan or '-'}}</td>
		</tr>
		<tr>
			<td>Kepala</td>
			<td>:</td>
			<td>@if($klinis->kepala == 1) Tak ada kelainan @else {{$klinis->ket_kepala}} @endif</td>
		</tr>
		<tr>
			<td>Hidung</td>
			<td>:</td>
			<td>@if($klinis->hidung == 1) Tak ada kelainan @else {{$klinis->ket_hidung}} @endif</td>
		</tr>
		<tr>
			<td>Tenggorokan / Tonsil</td>
			<td>:</td>
			<td>@if($klinis->tenggorokan == 1) Tak ada kelainan @else {{$klinis->ket_tenggorokan}} @endif</td>
		</tr>
		<tr>
			<td>Telinga / Tajam dengar</td>
			<td>:</td>
			<td>@if($klinis->telinga == 1) Tak ada kelainan @else {{$klinis->ket_telinga}} @endif</td>
		</tr>
		<tr>
			<td>Membran / tympani</td>
			<td>:</td>
			<td>@if($klinis->membran_tympani == 1) Tak ada kelainan @else {{$klinis->ket_membran_tympani}} @endif</td>
		</tr>
		<tr>
			<td>Jantung</td>
			<td>:</td>
			<td>@if($klinis->jantung == 1) Tak ada kelainan @else {{$klinis->ket_jantung}} @endif</td>
		</tr>
		<tr>
			<td>Dada dan Paru-paru</td>
			<td>:</td>
			<td>@if($klinis->dada_paru == 1) Tak ada kelainan @else {{$klinis->ket_dada_paru}} @endif</td>
		</tr>
		<tr>
			<td>Extremitas atas</td>
			<td>:</td>
			<td>@if($klinis->extrimitas_atas == 1) Tak ada kelainan @else {{$klinis->ket_extrim_atas}} @endif</td>
		</tr>
		<tr>
			<td>Kelainan jari-jari</td>
			<td>:</td>
			<td>@if($jari_jari == '-' || empty($jari_jari)) Tak ada kelainan @else {{$jari_jari}} @endif</td>
		</tr>
		<tr>
			<td>Extremitas bawah</td>
			<td>:</td>
			<td>@if($klinis->extrimitas_bwh == 1) Tak ada kelainan @else {{$klinis->ket_extrim_bwh}} @endif</td>
		</tr>
		<tr>
			<td>Bentuk kaki</td>
			<td>:</td>
			<td>@if($klinis->kaki == 1) Tak ada kelainan @else {{$klinis->ket_kaki}} @endif</td>
		</tr>
		<tr>
			<td>Telapak kaki</td>
			<td>:</td>
			<td>@if($klinis->telapak_kaki == 1) Tak ada kelainan @else {{$klinis->ket_telapak_kaki}} @endif</td>
		</tr>
		<tr>
			<td>Kulit (kelenjar limfe)</td>
			<td>:</td>
			<td>@if($klinis->kulit == 1) Tak ada kelainan @else {{$klinis->ket_kulit}} @endif</td>
		</tr>
		<tr>
			<td>Abdomen&Viscera (Hernia)</td>
			<td>:</td>
			<td>@if($klinis->abdomen_viscera == 1) Tak ada kelainan @else {{$klinis->ket_abdomen_viscera}} @endif</td>
		</tr>
		<tr>
			<td>Membedakan warna</td>
			<td>:</td>
			<td>{{$mata->membedakan_warna}}</td>
		</tr>
		<tr>
			<td>Mata</td>
			<td>:</td>
			<td>@if($klinis->mata == 1) Tak ada kelainan @else {{$klinis->ket_mata}} @endif</td>
		</tr>
		<tr>
			<td>Visus</td>
			<td>:</td>
			<td><span class="mr-10">OD : {{$mata->visus_od or '-'}}</span> &nbsp; &nbsp; &nbsp; &nbsp; <span>OS :{{$mata->visus_os or '-'}}</span></td>
		</tr>
		<tr>
			<td>Koreksi Visus</td>
			<td>:</td>
			<td><span class="mr-10">VOD : {{$mata->koreksi_od or '-'}}</span> &nbsp; &nbsp; &nbsp; &nbsp;<span>VOS : {{$mata->koreksi_os or '-'}}</span></td>
		</tr>
		<tr>
			<td>Gigi</td>
			<td>:</td>
			<td>@if($klinis->mulut == 1) Tak ada kelainan @else {{$klinis->ket_mulut}} @endif</td>
		</tr>
		<tr>
			<td>Thorax photo</td>
			<td>:</td>
			<td>{{$klinis->x_ray or '-'}}</td>
		</tr>
		<tr>
			<td>ECG</td>
			<td>:</td>
			<td>{{$klinis->ecg or '-'}}</td>
		</tr>
		<tr>
			<td>Laboratorium / Imunologi</td>
			<td>:</td>
			<td>{{$laborat or '-'}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="noBorder">
		<tr>
			<td width="28%"><b>Kesimpulan</b></td>
			<td width="2%">:</td>
			<td width="70%">@if(!empty($kesimpulan)){{$kesimpulan}} @else - @endif</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="noBorder">
		<tr>
			<td width="28%"><b>Saran</b></td>
			<td width="2%">:</td>
			<td width="70%">@if(!empty($saran)){{$saran}} @else - @endif</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="noBorder">
		<tr>
			<td width="50%">&nbsp;</td>
			<td width="50%" class="centered">Surabaya, {{$tanggal_hari_ini or '-'}}</td>
		</tr>
		<tr>
			<td width="50%">&nbsp;</td>
			<td width="50%" class="centered">Dokter yang memeriksa,</td>
		</tr>
	</table>
	<br><br><br>
	<table width="100%" class="noBorder">
		<tr>
			<td width="50%">&nbsp;</td>
			<td width="50%" class="centered">{{$dokter->nama or '-'}}</td>
		</tr>
		<tr>
			<td width="50%">&nbsp;</td>
			<td width="50%" class="centered"><p style="white-space: pre;margin: 0;margin-top: 3px"> {{ $dokter->keterangan or '-'}}</p></td>
		</tr>
	</table>
</body>
</html>