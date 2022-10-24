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
	.no-bottom-only{
		border-top: 1px solid black;
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
	.text-blue{
		color: blue;
	}
	.yellow-col{
		background-color: yellow;
	}
	.green-col{
		background-color: #669900;
	}
	.mint-col{
		background-color: #33ccff;
	}

</style>
<head>
	<title>Rekap Personel Profesi</title>
</head>
<body>
	<table width="100%">
		<tr>
			<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
		</tr>
	</table>
	<br><br>

	@include('kepegawaian.laporan.hasil.rekap-personel-profesi.components.kualifikasi')
	@include('kepegawaian.laporan.hasil.components.ttd')
	
	<!-- END -->
	<!-- END -->
	<div style="page-break-after: always;"></div> 
	<!-- START -->
	<!-- START -->

	<table width="100%">
		<tr>
			<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
		</tr>
	</table>
	<br><br>

	@include('kepegawaian.laporan.hasil.rekap-personel-profesi.components.pendidikan')
	@include('kepegawaian.laporan.hasil.components.ttd')
	<!-- END -->
	<!-- END -->
	<div style="page-break-after: always;"></div> 
	<!-- START -->
	<!-- START -->

	<table width="100%">
		<tr>
			<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
		</tr>
	</table>
	<br><br>
	
	@include('kepegawaian.laporan.hasil.rekap-personel-profesi.components.militer')
	@include('kepegawaian.laporan.hasil.components.ttd')
	<!-- END -->
	<!-- END -->
	<div style="page-break-after: always;"></div> 
	<!-- START -->
	<!-- START -->

	<table width="100%">
		<tr>
			<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
		</tr>
	</table>
	<br><br>

	@include('kepegawaian.laporan.hasil.rekap-personel-profesi.components.pns')
	@include('kepegawaian.laporan.hasil.components.ttd')
	<!-- END -->
	<!-- END -->
	<div style="page-break-after: always;"></div> 
	<!-- START -->
	<!-- START -->

	<table width="100%">
		<tr>
			<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
		</tr>
	</table>
	<br><br>

	@include('kepegawaian.laporan.hasil.rekap-personel-profesi.components.korps')	
	@include('kepegawaian.laporan.hasil.components.ttd')	<!-- END -->
	<!-- END -->
	<div style="page-break-after: always;"></div> 
	<!-- START -->
	<!-- START -->

</body>
</html>