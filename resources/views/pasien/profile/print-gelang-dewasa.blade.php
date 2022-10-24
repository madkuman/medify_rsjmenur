<!DOCTYPE html>
<html>
<head>
	<title>Print Gelang  - {{$pasien->name}}</title>
	<style type="text/css">
		table {
			border-collapse: collapse;
			font-size: 16px;
		}
		body{
			margin: 0px;
			margin-top: 20px;
			font-family: sans-serif;
		}
		@page{
			margin-top: 0.1cm;
			margin-right: 0.1cm;
			margin-left: 1cm;
			margin-bottom: 0cm;
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
			font-size: 12px;
		}
		.va-top td{
			vertical-align: top;
		}
	</style>
</head>
<body>
	<table width="100%">
		<tr>
			<td width="15%">
				<img src="{{asset('assets/img/logo/rsj_bw.jpg')}}" style="margin-right: 0.2cm">
			</td>
			<td width="50%">
				<table width="100%" class="va-top">
					<tr>
						<td>Nama</td>
						<td>: {{$pasien->name}}</td>
					</tr>
					<tr>
						<td>RM</td>
						<td>: {{$pasien->no_rm_formatted}}</td>
					</tr>
					<tr>
						<td>TL</td>
						<td>: {{date("d-F-Y", strtotime($pasien->date_of_birth))}}</td>
					</tr>
				</table>
			</td>
			<td width="20%" style="text-align: center;">
				{!!$barcode!!}<br>
				<b style="font-size: 9px;">{{$pasien->no_rm}}</b>
			</td>
			<td width="15%">
				{!!$qrcode!!}
			</td>
		</tr>
	</table>
</body>
</html>