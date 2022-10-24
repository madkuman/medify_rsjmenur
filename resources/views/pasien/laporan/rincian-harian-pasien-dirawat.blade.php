<!DOCTYPE html>
<html>
<head>
	<title>PERINCIAN HARIAN PASIEN RAWAT INAP</title>
	<style type="text/css">
	body{
		font-size: 10px;
		font-family: sans-serif;
	}
	table{
		width: 100%;
		border-collapse: collapse;
	}
	.bordered td{
		border: 1px solid black;
		padding-left: 1px;
		padding-right: 1px;
	}
	.centered, .centered td{
		text-align: center !important;
	}
	.bot{
		border-bottom: 1px solid black;
	}
	td{
		word-wrap: break-word;
		vertical-align: top;
	}
	.px-5 td{
		padding-left: 5px;
		padding-right: 5px;
	}
	.righted td{
		text-align: right;
	}
</style>
</head>
<body>
	<table>
		<tr>
			<td class="centered"><b>PERINCIAN PASIEN RAWAT INAP</b></td>
		</tr>
		<tr>
			<td class="centered"><b>{{$date}}</b></td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<tr class="centered">
			<td rowspan="4">NO</td>
			<td rowspan="4">KELAS PERAWATAN</td>
			<td colspan="31">BPJS</td>
			<td>PC</td>
			<td rowspan="4">TOTAL</td>
		</tr>
		<tr class="centered">
			<td colspan="8">TNI AL</td>
			<td rowspan="3">JML</td>
			<td colspan="8">TNI AD</td>
			<td rowspan="3">JML</td>
			<td colspan="8">TNI AU</td>
			<td rowspan="3">JML</td>
			<td rowspan="3">PUR</td>
			<td rowspan="3">N.H</td>
			<td rowspan="3">MDR</td>
			<td rowspan="3">TOTAL<br>BPJS</td>
			<td rowspan="3">UMUM</td>
		</tr>
		<tr class="centered">
			<td colspan="5">MILITER</td>
			<td rowspan="2">PNS</td>
			<td colspan="2">KELUARGA</td>
			<td colspan="5">MILITER</td>
			<td rowspan="2">PNS</td>
			<td colspan="2">KELUARGA</td>
			<td colspan="5">MILITER</td>
			<td rowspan="2">PNS</td>
			<td colspan="2">KELUARGA</td>
		</tr>
		<tr class="centered">
			<td>PATI</td>
			<td>PAMEN</td>
			<td>PAMA</td>
			<td>BA</td>
			<td>TA</td>
			<td>MIL</td>
			<td>PNS</td>
			<td>PATI</td>
			<td>PAMEN</td>
			<td>PAMA</td>
			<td>BA</td>
			<td>TA</td>
			<td>MIL</td>
			<td>PNS</td>
			<td>PATI</td>
			<td>PAMEN</td>
			<td>PAMA</td>
			<td>BA</td>
			<td>TA</td>
			<td>MIL</td>
			<td>PNS</td>
		</tr>
		@foreach($kelas as $id => $item)
		<tr class="px-5 righted">
			<td class="centered">{{$id+1}}</td>
			<td style="text-align: left;">{{$item->nama}}</td>
			<td>{{$result[$item->id]['al'][PATI]}}</td>
			<td>{{$result[$item->id]['al'][PAMEN]}}</td>
			<td>{{$result[$item->id]['al'][PAMA]}}</td>
			<td>{{$result[$item->id]['al']['ba']}}</td>
			<td>{{$result[$item->id]['al']['ta']}}</td>
			<td>{{$result[$item->id]['al'][PNS_AL]}}</td>
			<td>{{$result[$item->id]['al'][KEL_TNI_AL]}}</td>
			<td>{{$result[$item->id]['al'][KEL_PNS_AL]}}</td>
			<td>{{$result[$item->id]['al']['jml']}}</td>
			<td>{{$result[$item->id]['ad'][PATI]}}</td>
			<td>{{$result[$item->id]['ad'][PAMEN]}}</td>
			<td>{{$result[$item->id]['ad'][PAMA]}}</td>
			<td>{{$result[$item->id]['ad']['ba']}}</td>
			<td>{{$result[$item->id]['ad']['ta']}}</td>
			<td>{{$result[$item->id]['ad'][PNS_AD]}}</td>
			<td>{{$result[$item->id]['ad'][KEL_TNI_AD]}}</td>
			<td>{{$result[$item->id]['ad'][KEL_PNS_AD]}}</td>
			<td>{{$result[$item->id]['ad']['jml']}}</td>
			<td>{{$result[$item->id]['au'][PATI]}}</td>
			<td>{{$result[$item->id]['au'][PAMEN]}}</td>
			<td>{{$result[$item->id]['au'][PAMA]}}</td>
			<td>{{$result[$item->id]['au']['ba']}}</td>
			<td>{{$result[$item->id]['au']['ta']}}</td>
			<td>{{$result[$item->id]['au'][PNS_AU]}}</td>
			<td>{{$result[$item->id]['au'][KEL_TNI_AU]}}</td>
			<td>{{$result[$item->id]['au'][KEL_PNS_AU]}}</td>
			<td>{{$result[$item->id]['au']['jml']}}</td>
			<td>{{$result[$item->id]['bpjs'][PURNA]}}</td>
			<td>{{$result[$item->id]['bpjs'][ANH]}}</td>
			<td>{{$result[$item->id]['bpjs'][MANDIRI]}}</td>
			<td>{{$result[$item->id]['bpjs']['jml']}}</td>
			<td>{{$result[$item->id]['pc']['umum']}}</td>
			<td>{{$total_kelas[$item->id]}}</td>
		</tr>
		@endforeach
		<tr class="px-5 righted">
			<td colspan="2" class="centered">JUMLAH</td>
			<td>{{$total['al'][PATI]}}</td>
			<td>{{$total['al'][PAMEN]}}</td>
			<td>{{$total['al'][PAMA]}}</td>
			<td>{{$total['al']['ba']}}</td>
			<td>{{$total['al']['ta']}}</td>
			<td>{{$total['al'][PNS_AL]}}</td>
			<td>{{$total['al'][KEL_TNI_AL]}}</td>
			<td>{{$total['al'][KEL_PNS_AL]}}</td>
			<td>{{$total['al']['jml']}}</td>
			<td>{{$total['ad'][PATI]}}</td>
			<td>{{$total['ad'][PAMEN]}}</td>
			<td>{{$total['ad'][PAMA]}}</td>
			<td>{{$total['ad']['ba']}}</td>
			<td>{{$total['ad']['ta']}}</td>
			<td>{{$total['ad'][PNS_AL]}}</td>
			<td>{{$total['ad'][KEL_TNI_AL]}}</td>
			<td>{{$total['ad'][KEL_PNS_AL]}}</td>
			<td>{{$total['ad']['jml']}}</td>
			<td>{{$total['au'][PATI]}}</td>
			<td>{{$total['au'][PAMEN]}}</td>
			<td>{{$total['au'][PAMA]}}</td>
			<td>{{$total['au']['ba']}}</td>
			<td>{{$total['au']['ta']}}</td>
			<td>{{$total['au'][PNS_AL]}}</td>
			<td>{{$total['au'][KEL_TNI_AL]}}</td>
			<td>{{$total['au'][KEL_PNS_AL]}}</td>
			<td>{{$total['au']['jml']}}</td>
			<td>{{$total['bpjs'][PURNA]}}</td>
			<td>{{$total['bpjs'][ANH]}}</td>
			<td>{{$total['bpjs'][MANDIRI]}}</td>
			<td>{{$total['bpjs']['jml']}}</td>
			<td>{{$total['pc']['umum']}}</td>
			<td>{{$total['pc']['jml']}}</td>
		</tr>
	</table>
	<br><br>
	<table class="bordered" style="width: 20%">
		<tr class="centered">
			<td>NO</td>
			<td>TINGKAT KETERGANTUNGAN PASIEN</td>
			<td>JUMLAH</td>
		</tr>
		<tr>
			<td>1</td>
			<td>TOTAL CARE</td>
			<td></td>
		</tr>
		<tr>
			<td>2</td>
			<td>PARTIAL CARE</td>
			<td></td>
		</tr>
		<tr>
			<td>3</td>
			<td>MINIMAL CARE</td>
			<td></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="70%"></td>
			<td width="30%" class="center">Surabaya, &nbsp;&nbsp;&nbsp;&nbsp; {{$tanggal_ttd}}</td>
		</tr>
		<tr>
			<td></td>
			<td class="center">a.n. Kepala {{config('app.name')}}</td>
		</tr>
		<tr>
			<td></td>
			<td class="center">{{$ttd->jabatan}},</td>
		</tr>
	</table>
	<br><br><br>
	<table>
		<tr>
			<td width="70%"></td>
			<td class="center" width="30%">{{$ttd->nama}}</td>
		</tr>
		<tr>
			<td></td>
			<td class="center">{{$ttd->pangkat}} NRP.{{$ttd->nip}}</td>
		</tr>
	</table>
</body>
</html>