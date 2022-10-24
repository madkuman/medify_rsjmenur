<!DOCTYPE html>
<html>
<style type="text/css">
html{
	padding: 0%;
	height: 100%;
}
body{
	font-size: 14px;
	height: 100%;
	font-family: sans-serif;
}
table{
	border-collapse: collapse;
	width: 100%;
}
td{
	vertical-align: middle;
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
.title{
	font-size: 16px;
}
.orange-col{
	background-color: #ffc266;
}
.grey-col{
	background-color: #eaeae1;
}
.blue-col{
	background-color: #b3ffff;
}


</style>
<head>
	<title>Daftar Personel Akan Pensiun</title>
</head>
<body>
	<table>
		<tr>
			<td width="40%" class="centered">{{config('app.name')}}</td>
			<td width="60%" class="centered"></td>
		</tr>
	</table>
	<br><br>
	<table>
		<tr>
			<td class="centered title">REKAP PERSONEL PENSIUN DALAM {{$angka_pensiun}} {{$satuan_pensiun}}</td>
		</tr>
		<tr>
			<td class="centered title">{{$kop_bulan}}</td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<tr>
			<th width="5%" class="centered bordered"><b>No</b></th>
			<th width="40%" class="centered bordered"><b>Nama</b></th>
			<th width="20%" class="centered bordered"><b>Pangkat</b></th>
			<th width="20%" class="centered bordered"><b>Jabatan</b></th>
		</tr>
		@php $i = 1; @endphp
		@foreach($pegawai as $item)
		<tr>
			<td class="bordered centered">{{$i}}</td>
			<td class="bordered">{{$item->name}}</td>
			<td class="bordered">{{$item->pangkat}}</td>
			<td class="bordered">{{$item->jabatan}}</td>
		</tr>
		@php $i++; @endphp;
		@endforeach
	</table>
	<br>
	@include('kepegawaian.laporan.hasil.components.ttd')
</body>
</html>