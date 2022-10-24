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
			<td class="centered title"><b>REKAP UMUR DAN JENIS KELAMIN</b></td>
		</tr>
		<tr>
			<td class="centered title"><b>06 Februari 2019</b></td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<tr>
			<th width="20%" rowspan="3" class="centered bordered orange-col"><b>UMUR</b></th>
			@if(in_array('MILITER',$status))<th width="20%" colspan="2" class="centered bordered orange-col"><b>01</b></th>@endif
			@if(in_array('PNS',$status))<th width="20%" colspan="2" class="centered bordered orange-col"><b>02</b></th>@endif
			@if(in_array('PHL',$status))<th width="20%" colspan="2" class="centered bordered orange-col"><b>03</b></th>@endif
			<th width="20%" rowspan="3" class="centered bordered orange-col"><b>JUMLAH TOTAL</b></th>
		</tr>
		<tr>
			@if(in_array('MILITER',$status))<th width="20%" colspan="2" class="centered bordered orange-col"><b>MILITER</b></th>@endif
			@if(in_array('PNS',$status))<th width="20%" colspan="2" class="centered bordered orange-col"><b>PNS</b></th>@endif
			@if(in_array('PHL',$status))<th width="20%" colspan="2" class="centered bordered orange-col"><b>PHL</b></th>@endif
		</tr>
		<tr>
			@if(in_array('MILITER',$status))<th width="10%" class="centered bordered orange-col"><b>L</b></th>
			<th width="10%" class="centered bordered orange-col"><b>P</b></th>@endif
			@if(in_array('PNS',$status))<th width="10%" class="centered bordered orange-col"><b>L</b></th>
			<th width="10%" class="centered bordered orange-col"><b>P</b></th>@endif
			@if(in_array('PHL',$status))<th width="10%" class="centered bordered orange-col"><b>L</b></th>
			<th width="10%" class="centered bordered orange-col"><b>P</b></th>@endif
		</tr>
		@foreach($list_umur as $data)
		<tr>
			<td class="centered bordered grey-col">{{$data['umur']}}</td>
			@if(in_array('MILITER',$status))<td class="centered bordered">{{$data['MILITER']['L'] or "0"}}</td>
			<td class="centered bordered">{{$data['MILITER']['P'] or "0"}}</td>@endif
			@if(in_array('PNS',$status))<td class="centered bordered">{{$data['PNS']['L'] or "0"}}</td>
			<td class="centered bordered">{{$data['PNS']['P'] or "0"}}</td>@endif
			@if(in_array('PHL',$status))<td class="centered bordered">{{$data['PHL']['L'] or "0"}}</td>
			<td class="centered bordered">{{$data['PHL']['P'] or "0"}}</td>@endif
			<td class="centered bordered blue-col">{{$data['total']}}</td>
		</tr>
		@endforeach
		<tr>
			<td class="centered bordered grey-col">JUMLAH TOTAL</td>
			@if(in_array('MILITER',$status))<td class="centered bordered">{{$umur_official['MILITER']['L'] or "0"}}</td>
			<td class="centered bordered">{{$umur_official['MILITER']['P'] or "0"}}</td>@endif
			@if(in_array('PNS',$status))<td class="centered bordered">{{$umur_official['PNS']['L'] or "0"}}</td>
			<td class="centered bordered">{{$umur_official['PNS']['P'] or "0"}}</td>@endif
			@if(in_array('PHL',$status))<td class="centered bordered">{{$umur_official['PHL']['L'] or "0"}}</td>
			<td class="centered bordered">{{$umur_official['PHL']['P'] or "0"}}</td>@endif
			<td class="centered bordered blue-col">{{$total_semua}}</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="50%" class="centered"></td>
			<td width="50%" class="centered">a.n. Kepala {{config('app.name')}}</td>
		</tr>
	</table>
</body>
</html>