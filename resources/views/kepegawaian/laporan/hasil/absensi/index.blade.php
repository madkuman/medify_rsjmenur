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
.yellow-col{
	background-color: #ffcc00;
}
th{
	height: 45px;
}


</style>
<head>
	<title>Absensi</title>
</head>
<body>
	<table>
		<tr>
			<td width="30%" class="centered">{{config('app.name')}}</td>
			<td width="70%" class="centered"></td>
		</tr>
	</table>
	<br><br>
	<table>
		<tr>
			<td class="centered title"><b>{{$judul}}</b></td>
		</tr>
		<tr>
			<td class="centered title"><b>Bulan {{$kop_bulan}}</b></td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<thead>
			<tr>
				<th width="5%" class="centered bordered yellow-col"><b>No</b></th>
				<th width="33%" class="centered bordered yellow-col"><b>Nama, Pangkat, Korp, NRP</b></th>
				<?php for($i=1; $i<=31; $i++) {?>
				<th width="2%" class="centered bordered yellow-col"><b>{{$i}}</b></th>
				<?php } ?>
			</tr>	
		</thead>
		<tbody>
		@php $i = 1; @endphp
		@foreach($pegawai as $item)
			<tr>
				<td class="bordered centered">{{$loop->iteration}}</td>
				<td class="bordered">{{$item->name}},{{$item->pangkat}},{{$item->korp}},{{$item->nrp}}</td>
				<?php for($i=1; $i<=31; $i++) {?>
				<td class="bordered"></td>
				<?php } ?>
			</tr>
		@php $i++; @endphp
		@endforeach
		</tbody>
	</table>
	<br>
	@include('kepegawaian.laporan.hasil.components.ttd')
</body>
</html>