@extends('layouts.print')

@section('title')
Print Bukti Pelayanan - {{$kasus->pasien->name}}
@endsection

@section('css')
<style type="text/css">
td, body, th{
	font-size: 14px;
	font-family: sans-serif;
}
table {
	border-collapse: collapse;
	text-align: left;
	font-size: 10px;
}

th, td {
	border: 1px solid black;
	padding:10px 5px;
}
td.borderless {
	border-bottom:none !important; 
	border-top:none !important; 
	padding:10px 5px;
}

table.borderless th,
table.borderless td{
	border:none !important; 
	padding-top: 5px;
	padding-bottom: 5px;
}

table.nopadding tr th {
	padding: 5px 5px;
}

table.nopadding tr td {
	padding: 0 0;
}

.center
{
	text-align: center;
}
.bold
{
	font-weight: 700;
}
.underline
{
	text-decoration: underline;
}
.box
{
	border:solid 1px #000;
}

.belum_ada {
	font-style: italic;
}
.text-center{
	text-align: center;
}
.big{
	font-weight: bold;
	font-size: 16px;
}
.dummy{
	font-size: 150px;
	color: white;
}
.no-left{
	border-left: none;
}
.no-right{
	border-right: none;
}
.no-bottom{
	border-bottom: none;
}

</style>
@endsection

@section('content')
<table class="borderless" width="100%">
	<tr>
		<td width="80%"></td>
		<td width="20%">No. RM : {{$kasus->pasien->no_rm}}</td>
	</tr>
</table>
<table class="borderless" width="100%">
	<tr>
		<td class="text-center big">BUKTI PELAYANAN</td>
	</tr>
	<tr>
		<td class="text-center big">RAWAT INAP</td>
	</tr>
</table>
<table class="borderless">
	<tr>
		<td>Nama</td>
		<td>: {{$kasus->pasien->name}}</td>
	</tr>
	<tr>
		<td>No SEP</td>
		<td>: {{$kasus->activeSep->no_sep ?? '-'}}</td>
	</tr>
	<tr>
		<td>Tanggal SEP</td>
		<td>: {{isset($kasus->activeSep->tgl_sep) ? indonesian_date($kasus->activeSep->tgl_sep) :  '-'}}</td>
	</tr>
	<tr>
		<td>Diagnosa</td>
		<td>: {{$kasus->diagnosisUtama->icd10->code_icd ?? '-'}}</td>
	</tr>

	<tr>
		<td colspan="2">Sembuh - Dirujuk - Meninggal</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<th width="20%"></th>
		<th width="20%" style="text-align: center;">TANGGAL</th>
		<th width="60%" style="text-align: center;">KETERANGAN</th>
	</tr>
	<tr>
		<td>MASUK</td>
		<td>{{indonesian_date($kasus->mrs_at) ?? indonesian_date($kasus->created_at)}}</td>
		<td class="borderless"></td>
	</tr>
	<tr>
		<td>KELUAR</td>
		<td>{{indonesian_date($kasus->krs_at) ?? '-'}}</td>
		<td class="borderless"></td>
	</tr>
	<tr>
		<td>OPERASI</td>
		<td>@if(isset($kasus->operasiTransaksi[0]->jadwal_operasi)) {{indonesian_date($kasus->operasiTransaksi[0]->jadwal_operasi)}} @else - @endif</td>
		<td class="borderless"></td>
	</tr>
	@php($row = -1)
	@foreach($kasus->diagnosis as $i => $diagnosis)
	@if($i == 0)
	<tr>
		<td class="">PEMERIKSAAN/<br>TINDAKAN LAIN</td>
		<td class="">{{indonesian_date($kasus->mrs_at) ?? indonesian_date($kasus->created_at)}}</td>
		<td class="borderless">({{$diagnosis->lokasi->nama}}) {{$diagnosis->icd10->code_icd}} - {{$diagnosis->icd10->long_desc}}</td>
	</tr>
	@else
	<tr>
		<td class="no-right borderless"></td>
		<td class="no-left borderless"></td>
		<td class="borderless">({{$diagnosis->lokasi->nama}}) {{$diagnosis->icd10->code_icd}} - {{$diagnosis->icd10->long_desc}}</td>
	</tr>
	@endif
	@php($row++)
	@endforeach

	@foreach($kasus->tindakan_icd9 as $i => $tindakan)
	@if($row == -1)
	<tr>
		<td class="">PEMERIKSAAN/<br>TINDAKAN LAIN</td>
		<td class="">{{$kasus->mrs_at ?? $kasus->created_at}}</td>
		<td class="borderless">({{$tindakan->lokasi->nama}}) {{$tindakan->icd9->code_icd}} - {{$tindakan->icd9->long_desc}}</td>
	</tr>
	@else
	<tr>
		<td class="no-right borderless"></td>
		<td class="no-left borderless"></td>
		<td class="borderless">({{$tindakan->lokasi->nama}}) {{$tindakan->icd9->code_icd}} - {{$tindakan->icd9->long_desc}}</td>
	</tr>
	@endif
	@php($row++)
	@endforeach
	@if($row == -1)
	<tr>
		<td>PEMERIKSAAN/<br>TINDAKAN LAIN</td>
		<td>{{$kasus->mrs_at ?? $kasus->created_at}}</td>
		<td class="borderless"></td>
	</tr>
	@php($row++)
	@endif
	<tr>
		<th colspan="3" style="text-align: center;">VERIFIKATOR</th>
	</tr>
	<tr>
		<td colspan="3" class="dummy">&nbsp;</td>
	</tr>
</table>
<br>
<table class="borderless" width="100%">
	<tr>
		<td class="text-center" width="40%">Dokter yang merawat,</td>
		<td width="20%"></td>
		<td class="text-center" width="40%">Penerima Pelayan</td>
	</tr>
	<tr>
		<td colspan="3" style="font-size: 30px; color: white">.</td>
	</tr>
	<tr>
		<td class="text-center">Nama : .....................................</td>
		<td></td>
		<td class="text-center">Nama : .....................................</td>
	</tr>
</table>
@endsection