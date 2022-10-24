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
	<title>Daftar Personel Jabatan Fungsional</title>
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
			<td class="centered title">LAPORAN @if($sipstr == 'sip') SIP
				@elseif($sipstr == 'str') STR
				@endif
		 	EXPIRED</td>
		</tr>
		<tr>
			<td class="centered title">06 Februari 2019</td>
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
		@foreach($pegawai as $item)
		<tr>
			<td class="bordered centered">{{$loop->iteration}}</td>
			<td class="bordered">{{$item->name}}</td>
			<td class="bordered">{{$item->pangkat}}</td>
			<td class="bordered">{{$item->jabatan}}</td>
			<td class="bordered">
				@if($sipstr == 'sip') {{date('d-m-Y', strtotime($item->sip_expired_at))}}
				@elseif($sipstr == 'str') {{date('d-m-Y', strtotime($item->str_expired_at))}}
				@endif
			</td>
		</tr>
		@endforeach
	</table>
	<br>
		@include('kepegawaian.laporan.hasil.components.ttd')
</body>
</html>