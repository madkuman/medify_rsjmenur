<head>
	<title>Rekapitulasi Hasil Uji dan Pemeriksaan Kesehatan</title>
	<style type="text/css">
		body{
			font-family: sans-serif;
		}
	</style>
</head>

<body>
	<table style="width: 100vw; page-break-inside:avoid; border-collapse: collapse;" autosize="1">
		<tr>
			<td style="font-size: 12px; width: 24%; border: 1px solid white;  text-align: center">{{config('app.name')}}</td>
			<td style="font-size: 12px; width: 76%; border: 1px solid white;"></td>
		</tr>
	</table>

	<br><br>

	<table style="width: 100vw; page-break-inside:avoid; border-collapse: collapse;" autosize="1">
		<tr>
			<td style="font-size: 15px; text-align: center; border: 1px solid white; text-decoration: underline;">REKAPITULASI HASIL UJI DAN PEMERIKSAAN KESEHATAN</td>
		</tr>
	</table>

	<br>

	<table style="width: 100vw; page-break-inside:avoid; border-collapse: collapse;" autosize="1">
		<tr>
			<td style="width: 23%; border: 1px solid white"></td>
			<td style="width: 25%; border: 1px solid white">PELAKSANA</td>
			<td style="width: 2%; border: 1px solid white">:</td>
			<td style="width: 33%; border: 1px solid white">{{config('app.name')}}</td>
			<td style="width: 17%; border: 1px solid white"></td>
		</tr>
		<tr>
			<td style="width: 23%; border: 1px solid white"></td>
			<td style="width: 25%; border: 1px solid white">TAHUN ANGGARAN</td>
			<td style="width: 2%; border: 1px solid white">:</td>
			<td style="width: 33%; border: 1px solid white">{{$date}}</td>
			<td style="width: 17%; border: 1px solid white"></td>
		</tr>
		<tr>
			@if($type == 'nrp')

			@elseif($type == 'satker-pilihan')
			<td style="width: 23%; border: 1px solid white"></td>
			<td style="width: 25%; border: 1px solid white">KESATUAN</td>
			<td style="width: 2%; border: 1px solid white">:</td>
			<td style="width: 33%; border: 1px solid white">@foreach($satker as $item) {{$item}}, @endforeach</td>
			<td style="width: 17%; border: 1px solid white"></td>			
			@else
			<td style="width: 23%; border: 1px solid white"></td>
			<td style="width: 25%; border: 1px solid white">KESATUAN</td>
			<td style="width: 2%; border: 1px solid white">:</td>
			<td style="width: 33%; border: 1px solid white">{{$satker}} - {{$kesatuan}}</td>
			<td style="width: 17%; border: 1px solid white"></td>
			@endif
		</tr>	
	</table>

	<br>

	<table style="width: 100vw;  border-collapse: collapse;" autosize="1">
		<tr>
			<td style="font-size: 14px; border: 1px solid black; border-right: 1px solid white; width:33%">&nbsp;&nbsp;&nbsp; 1. JUMLAH PERSONIL @if($type!='nrp') KOTAMA/SATKER @endif</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:2%">:</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:14%">&nbsp;{{$subtotal[16]}} ORANG</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:22%">5. RENCANA / HASIL INTENSIF I</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:2%">:</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:15%">{{$rencana[0]}} / {{$subtotal[0]+ $subtotal[1] +$subtotal[8] + $subtotal[9]}} ORANG</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; width:12%">Prosentase @if($rencana[0]!=0) {{number_format(($subtotal[0]+ $subtotal[1] +$subtotal[8] + $subtotal[9]) / $rencana[0] * 100, 1, ",", ".")}}
				@else -
				@endif
			%</td>
		</tr>
		<tr>
			<td style="font-size: 14px; border: 1px solid black; border-right: 1px solid white; width:33%">&nbsp;&nbsp;&nbsp; 2. JUMLAH PERSONIL YANG DIRENCANAKAN</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:2%">:</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:14%">&nbsp;{{$rencana['total']}} ORANG</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:22%">6. RENCANA / HASIL INTENSIF II</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:2%">:</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:15%">{{$rencana[1]}} / {{$subtotal[2]+ $subtotal[3] +$subtotal[10] + $subtotal[11]}} ORANG</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; width:12%">Prosentase
				@if($rencana[1]!=0) {{number_format(($subtotal[2]+ $subtotal[3] +$subtotal[10] + $subtotal[11]) / $rencana[1] *100, 1, ",", ".")}}
				@else -
				@endif
			%</td>
		</tr>
		<tr>
			<td style="font-size: 14px; border: 1px solid black; border-right: 1px solid white; width:33%">&nbsp;&nbsp;&nbsp; 3. JUMLAH YANG TELAH MELAKSANAKAN</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:2%">:</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:14%">&nbsp;{{$subtotal[16]}} ORANG</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:22%">7. RENCANA / HASIL INTENSIF III</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:2%">:</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:15%">{{$rencana[2]}} / {{$subtotal[4]+ $subtotal[5] +$subtotal[6] + $subtotal[12] + $subtotal[13] + $subtotal[14]}} ORANG</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; width:12%">Prosentase 
				@if($rencana[2]) {{number_format(($subtotal[4]+ $subtotal[5] +$subtotal[6] + $subtotal[12] + $subtotal[13] + $subtotal[14]) / $rencana[2] *100, 1, ",", ".")}}
				@else -
				@endif
			%</td>
		</tr>
		<tr>
			<td style="font-size: 14px; border: 1px solid black; border-right: 1px solid white; width:33%">&nbsp;&nbsp;&nbsp; 4. PROSENTASE PENCAPAIAN</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:2%">:</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:14%">
				@if($rencana['total']!=0)
				{{number_format($subtotal[16]/$rencana['total']*100, 1, ",", ".")}}
				@else
				-
				@endif
				%
			</td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:22%"></td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:2%"></td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; width:15%"></td>
			<td style="font-size: 14px; border: 1px solid black; border-left: 1px solid white; width:12%"></td>
		</tr>

	</table>

	<br>

	<table style="width: 100vw; page-break-inside:avoid; border-collapse: collapse;" autosize="1">
		<tr>
			<td rowspan="3" style="text-align: center; font-size: 12px; border: 1px solid black; width: 3%">NO</td>
			<td rowspan="3" style="text-align: center; font-size: 12px; border: 1px solid black; width: 7%">STAKES</td>
			<td colspan="7" style="text-align: center; font-size: 12px; border: 1px solid black; width: 28%">MILITER</td>
			<td rowspan="3" style="text-align: center; font-size: 12px; border: 1px solid black; width: 10%">JUMLAH</td>
			<td colspan="7" style="text-align: center; font-size: 12px; border: 1px solid black; width: 28%">P N S</td>
			<td rowspan="3" style="text-align: center; font-size: 12px; border: 1px solid black; width: 12%">JUMLAH</td>
			<td rowspan="3" style="text-align: center; font-size: 12px; border: 1px solid black; width: 12%">JML TOTAL</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center; font-size: 12px; border: 1px solid black; width: 8%">INTENSIF I</td>
			<td colspan="2" style="text-align: center; font-size: 12px; border: 1px solid black; width: 8%">INTENSIF II</td>
			<td colspan="3" style="text-align: center; font-size: 12px; border: 1px solid black; width: 12%">INTENSIF III</td>
			<td colspan="2" style="text-align: center; font-size: 12px; border: 1px solid black; width: 8%">INTENSIF I</td>
			<td colspan="2" style="text-align: center; font-size: 12px; border: 1px solid black; width: 8%">INTENSIF II</td>
			<td colspan="3" style="text-align: center; font-size: 12px; border: 1px solid black; width: 12%">INTENSIF III</td>
		</tr>
		<tr>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">PATI</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">KOL</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">LTK</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">MAY</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">PAMA</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">BA</td> 
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">TA</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">IV/D</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">IV/C</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">IV/B</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">IV/A</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">III</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">II</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">I</td>
		</tr>
		@php($nilai_stakes = ['I', 'II', 'IIP', 'IIIP', 'III', 'IV'])
		@foreach($stakes as $item)
		<tr>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 3%">{{$loop->iteration}}</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 7%">{{$nilai_stakes[$loop->iteration-1]}}</td>
			@foreach($item as $key => $hasil)
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">
				@if($hasil!=0 || in_array($key, [7, 15, 16])) {{$hasil}}
				@else -
				@endif
			</td>
			@endforeach
		</tr>
		@endforeach
		<tr>
			<td colspan="2" style="text-align: center; font-size: 12px; border: 1px solid black;"> Jumlah</td>
			@foreach($subtotal as $hasil)
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">{{$hasil}}</td>
			@endforeach
		</tr>
	</table>
	<br><br>
	<table style="width: 100vw; page-break-inside:avoid; border-collapse: collapse;" autosize="1">
		<tr>
			<td style="width: 65%; border: 1px solid white; text-align: center"></td>
			<td style="width: 30%; border: 1px solid white; text-align: center">{{$dokter->sebagai}}</td>
			<td style="width: 5%; border: 1px solid white; text-align: center"></td>
		</tr>
		<tr>
			<td colspan="3" style="border: 1px solid white; color: white; font-size: 40px;">.</td>
		</tr>
		<tr>
			<td style="border: 1px solid white"></td>
			<td style="border: 1px solid white; text-align: center">{{$dokter->nama}}</td>
			<td style="border: 1px solid white"></td>
		</tr>
		<tr>
			<td style="border: 1px solid white"></td>
			<td style="border: 1px solid white; text-align: center">{{$dokter->keterangan}}</td>
			<td style="border: 1px solid white"></td>
		</tr>

	</table>
</body>