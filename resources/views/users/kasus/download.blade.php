<!DOCTYPE html>
<html>
<head>
	<title>Arsip Kasus</title>
	<style type="text/css">
		body{
			font-family: sans-serif;
			font-size: 13px;
		}
		table{
			width: 100%;
			border-collapse: collapse;
		}
		td, th{
			padding-left: 5px;
			padding-right: 5px;
		}
		.bordered td, .bordered th{
			border : 1px solid black;
		}
		.bot{
			border-bottom: 1px solid black;
		}
		.centered{
			text-align: center;
		}
		.big{
			font-size: 18px;
		}
	</style>
</head>
<body>
<table width="100%">
	<tr>
		<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
	</tr>
</table>
<br>
<table>
	<tr>
		<td class="centered big"><b>ARSIP KASUS</b></td>
	</tr>
	@if(!empty($tanggal_mrs_min))
		<tr>
			<td class="centered">MRS: {{$tanggal_mrs_min ?? ''}} - {{$tanggal_mrs_max ?? ''}}</td>
		</tr>
	@endif
	@if(!empty($tanggal_krs_min))
		<tr>
			<td class="centered">KRS: {{$tanggal_krs_min ?? ''}} - {{$tanggal_krs_max ?? ''}}</td>
		</tr>
	@endif
	@if(!empty($ranap) || !empty($rajal) || !empty($igd) || !empty($medical_checkup))
		<tr>
			<td class="centered">{{$ranap}} {{$rajal}} {{$igd}} {{$medical_checkup}}</td>
		</tr>
	@endif
	@if(!empty($lokasi))
		<tr>
			<td class="centered">{{$lokasi}}</td>
		</tr>
	@endif
	@if(!empty($no_rm))
		<tr>
			<td class="centered">No Rm : {{$no_rm}}</td>
		</tr>
	@endif
</table>
<br>
<table class="bordered">
	<thead>
	<tr>
		<th width="5%">No</th>
		<th width="25%">Kasus</th>
		<th width="30%">Nama Pasien</th>
		<th width="10%">JK/Usia</th>
		<th width="15%">Lokasi</th>
		<th width="15%">Status</th>
	</tr>
	</thead>
	<tbody>
	@foreach($kasus as $i => $k)
		<tr>
			<td>{{++$i}}</td>
			<td>{{$k->judul_kasus}}</td>
			<td>{{$k->identitas->nama}}</td>
			<td>{{$k->identitas->gender}} / {{$k->identitas->age}}</td>
			<td>{{$k->lokasi->lokasi->nama}}</td>
			<td>{{is_null($k->krs_at) ? 'Belum KRS' : 'Telah KRS'}}</td>
		</tr>
	@endforeach
	</tbody>
</table>
</body>
</html>