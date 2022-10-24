<!DOCTYPE html>
<html>
<style type="text/css">

body{
	font-family: sans-serif;
}
html{
	padding: 0%;
	height: 100%;
}
body{
	font-size: 14px;
	height: 100%;
}
table{
	border-collapse: collapse;
	width: 100%;
}
.bordered{
	border: 1px solid black;
}

.table-title{
	padding-bottom: 5px;
	padding-top: 5px;
}
.bottom-border{
	border-bottom: 1px solid black;
}
.centered{
	text-align: center;
}
.no-bottom{
	border-top: none;
	border-left: 1px solid black;
	border-right: 1px solid black;
	border-bottom: none;
}


</style>
<head>
	<title>Daftar Personel Jabatan Fungsional</title>
</head>
<body>
	<table>
		<tr>
			<td width="23%" class="centered">{{config('app.name')}}</td>
			<td width="70%" class="centered"></td>
		</tr>
	</table>
	<br><br>
	<table>
		<tr>
			<td class="centered">DAFTAR JABFUNG PERSONEL {{config('app.name')}}</td>
		</tr>
		<tr>
			<td class="centered">Bulan {{$kop_bulan}}</td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<tr>
			<th width="5%" class="centered bordered"><b>No</b></th>
			<th width="15%" class="centered bordered"><b>Jabatan</b></th>
			<th width="15%" class="centered bordered"><b>Nama</b></th>
			<th width="7%" class="centered bordered"><b>Pangkat Korp</b></th>
			<th width="8%" class="centered bordered"><b>NRP</b></th>
			<th width="20%" class="centered bordered"><b>ST Kasal<br>SP Satuan</b></th>
			<th width="30%" class="centered bordered"><b>Jabatan Internal<br>SP Internal</b></b></th>
		</tr>
		<tr>
			<td class="centered bordered">1</td>
			<td class="centered bordered">2</td>
			<td class="centered bordered">6</td>
			<td class="centered bordered">7</td>
			<td class="centered bordered">8</td>
			<td class="centered bordered">9</td>
			<td class="centered bordered">10</td>
		</tr>
		@php $i = 1; @endphp
		@foreach($pegawai as $item)
		<tr>
			<td class="centered no-bottom">{{$i}}</td>
			<td class="no-bottom">{{$item->pns_jabatan_fungsional ?? '-'}}/{{$item->jabatan}}</td>
			<td class="no-bottom">{{$item->name}}</td>
			<td class="no-bottom">{{$item->pangkat}}/{{$item->korps}}</td>
			<td class="no-bottom">{{$item->nrp}}</td>
			<td class="no-bottom">{{$item->st_kasal_no_st}}<br>{{$item->st_kasal_no_sp}}</td>
			<td class="no-bottom">{{$item->intern_dep}}/{{$item->intern_jabatan}}<br>{{$item->intern_no_sp}}</td>
		</tr>
		@php $i++; @endphp
		@endforeach
	</table>
	<br>
	@include('kepegawaian.laporan.hasil.components.ttd')
</body>
</html>