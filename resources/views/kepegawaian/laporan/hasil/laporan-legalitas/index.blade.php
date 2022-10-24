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
	<title>Laporan Legalitas</title>
</head>
<body>
	<table width="100%">
	<tr>
		<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
	</tr>
</table>
	<br><br>
	<table>
		<tr>
			<td class="centered title"> <b> LAPORAN LEGALITAS EXPIRED </b></td>
		</tr>
		<tr>
			<td class="centered title"> <b> TANGGAL {{Date::parse($tanggal[0])->format('d F Y')}} -  {{Date::parse($tanggal[1])->format('d F Y')}} </b></td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<tr>
			<th width="5%" class="centered bordered"><b>No</b></th>
			<th width="40%" class="centered bordered"><b>Nama</b></th>
			<th width="20%" class="centered bordered"><b>Pangkat</b></th>
			<th width="20%" class="centered bordered"><b>Jabatan</b></th>
			<th width="15%" class="centered bordered"><b>Pensiun Pada</b></th>
		</tr>
		@if (count($pegawai) == 0)
			<tr>
				<td class="centered bordered" colspan="6">Tidak Ada Data</td>
			</tr>
		@else
		@foreach($pegawai as $item)
		<tr>
			<td class="bordered centered">{{$loop->iteration}}</td>
			<td class="bordered">{{$item->pegawai->name ?? '-'}}</td>
			<td class="bordered">{{$item->pegawai->masterPangkat->nama ?? '-' }}</td>
			<td class="bordered">{{$item->pegawai->masterJabatan->nama ?? '-'}}</td>
			<td class="centered bordered">
				{{Date::parse($item->tanggal)->format('d F Y')}}
			</td>
		</tr>
		@endforeach
		@endif
	</table>
	<br>
		{{-- @include('kepegawaian.laporan.hasil.components.ttd') --}}
</body>
</html>