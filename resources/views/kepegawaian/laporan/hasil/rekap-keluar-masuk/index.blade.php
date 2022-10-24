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
		background-color: #ffdb4d;
	}
	.grey-col{
		background-color: #eaeae1;
	}
	.mint-col{
		background-color: #00e6e6;
	}
	.yellow-col{
		background-color: yellow;
	}
	.cream-col{
		background-color: #ffe680;
	}
	.red-text{
		color: red;
	}
	.blue-text{
		color: blue;
	}
	.pink-col{
		background-color: #ffe6ff;
	}

</style>
<head>
	<title>Rekap Personel Keluar Masuk</title>
</head>
<body>
	<table width="100%">
		<tr>
			<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
		</tr>
	</table>
	<br><br>

	@include('kepegawaian.laporan.hasil.rekap-keluar-masuk.components.personel-masuk')
	<br>
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

	@include('kepegawaian.laporan.hasil.rekap-keluar-masuk.components.personel-keluar')	
	<br>
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

	@include('kepegawaian.laporan.hasil.rekap-keluar-masuk.components.personel-dpb')
	<br>	
	@include('kepegawaian.laporan.hasil.components.ttd')


</body>
</html>