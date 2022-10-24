<!DOCTYPE html>
<html>
<head>
	<title>Print Gelang  - {{$pasien->name}}</title>
	<style type="text/css">
	table {
		border-collapse: collapse;
		font-size: 11px;
	}
	body{
		margin: 0px;
		margin-top: 0px;
	}
	@page{
		margin: 0px;
	}
	.centered{
		text-align: center;
	}
	.dummy{
		color: white;
	}
	td{
		margin: 0px;
		padding: 0px;
	}
</style>
</head>
<body>
<table style="width: 100vw">
	<tr>
		<td rowspan="3" style="width:45% "></td>
		<td rowspan="3" style="width:7% ">{!!$barcode!!}</td>
		<td class="centered" style="width: 18%">#{{$pasien->no_rm_formatted}}</td>
		<td class="dummy" style="width: 30%">.</td>
	</tr>
	<tr>
		<td class="centered"><b>{{$pasien->name}}</b></td>
		<td></td>
	</tr>
	<tr>
		<td class="centered">{{date("d-m-Y", strtotime($pasien->date_of_birth))}} / {{$pasien->age}} Thn</td>
		<td></td>
	</tr>
</table>
</body>
</html>