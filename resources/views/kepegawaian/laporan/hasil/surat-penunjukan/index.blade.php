<!DOCTYPE html>
<html>
<style type="text/css">
html{
	padding: 0%;
	height: 100%;
}
body{
	font-size: 15px;
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
.no-bot-top{
	border-top: none;
	border-left: 1px solid black;
	border-right: 1px solid black;
	border-bottom: none;
}
.title{
	font-size: 18px;
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
.dummy{
	color: white;
	font-size: 8px;
}
th{
	height: 40px;
}


</style>
<head>
	<title>Surat Penunjukan</title>
</head>
<body>
	<table>
		<tr>
			<td colspan="2"></td>
			<td width="15%">Nomor {{$type}}/</td>
			<td width="20%" style="text-align: right;">/{{$letter_num}}</td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td class="bottom-border">Tanggal</td>
			<td class="bottom-border" style="text-align: right;">{{$date}}</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td class="centered title">{{$title}}</td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<thead>
			<tr>
				<th width="10%" class="bordered centered">No</th>
				<th width="30%" class="bordered centered">Nama</th>
				<th width="15%" class="bordered centered">Pangkat</th>
				<th width="20%" class="bordered centered">NRP/NIP</th>
				<th width="25%" class="bordered centered">Keterangan</th>
			</tr>
		</thead>
		<tr>
			<td class="bordered centered">1</td>
			<td class="bordered centered">2</td>
			<td class="bordered centered">3</td>
			<td class="bordered centered">4</td>
			<td class="bordered centered">5</td>
		</tr>
		@php $i = 1 @endphp
		@foreach($data as $item)
		<tr>
			<td class="no-bot-top centered">{{$i}}</td>
			<td class="no-bot-top">{{$item->name}}</td>
			<td class="no-bot-top">{{$item->pangkat}} {{$item->korps}}</td>
			<td class="no-bot-top centered">{{$item->nrp}}</td>
			<td class="no-bot-top"></td>
		</tr>
		@php $i++ @endphp
		@endforeach
	</table>
	<br>
	<table>
		<tr>
			<td width="50%" class="centered"></td>
			<td width="50%" class="centered">U.b.</td>
		</tr>
		<tr>
			<td class="centered"></td>
			<td class="centered">{{$ttd->alias}},</td>
		</tr>
		<tr>
			<td class="centered"></td>
			<td class="centered">{{$ttd->bagian_bawah}}</td>
		</tr>
	</table> 
</body>
</html>