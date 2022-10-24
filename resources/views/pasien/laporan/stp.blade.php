<!DOCTYPE html>
<html>
<head>
	<title>Laporan STP</title>
	<style type="text/css">
	table{
		border-collapse: collapse;;
		width: 100vw;
	}
	.title{
		text-align: center;
		vertical-align: middle;
	}
	.bordered{
		border: 1px solid black;
	}
	.center{
		text-align: center;
	}
	.bot-only{
		border-bottom: 1px solid black;
	}
	td{
		padding-left: 7px;
	}
</style>
</head>
<body>
	
<table width="100%">
	<tr>
		<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
	</tr>
</table>
	<table>
		<tr>
			<td class="center">LAPORAN STP {{$layanan}} RUMAH SAKIT</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="15%">RUMAH SAKIT</td>
			<td width="85%">: {{config('app.name')}}</td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>: {{$start->format('d-m-Y')}} s/d {{$end->format('d-m-Y')}}</td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<tr>
			<td class="center bordered" width="5%" rowspan="2">No.</td>
			<td class="center bordered" width="7%" rowspan="2">No.I.C.D.O</td>
			<td class="center bordered" width="18%" rowspan="2">Jenis Penyakit</td>
			<td class="center bordered" width="48%" colspan="8">Golongan Umur</td>
			<td class="center bordered" width="5%" rowspan="2">L</td>
			<td class="center bordered" width="5%" rowspan="2">P</td>
			<td class="center bordered" width="12%" rowspan="2">Total Kunjungan</td>
		</tr>
		<tr>
			<td class="center bordered">0-8 hr</td>
			<td class="center bordered">28-&lt;1th</td>
			<td class="center bordered">1-4th</td>
			<td class="center bordered">5-14th</td>
			<td class="center bordered">15-24th</td>
			<td class="center bordered">25-44th</td>
			<td class="center bordered">45-64th</td>
			<td class="center bordered">65+ th</td>
		</tr>
		<tr>
			@for($i=1;$i<=14;$i++)
			<td class="center bordered">{{$i}}</td>
			@endfor
		</tr>
		@php $idx=1 @endphp
		@foreach($jenis_penyakit_A as $key => $item)
		<tr>
			<td class="center bordered">{{$idx++}}</td>
			<td class="bordered">{{$item[0]}}</td>
			<td class="bordered">{{$item[1]}}</td>
			@for($i=0; $i<=10; $i++)
			<td class="center bordered">{{$result[$idx-2][$i]}}</td>
			@endfor
		</tr>
		@endforeach
		<tr>
			<td colspan="3" class="center bordered">JUMLAH A</td>
			@for($i=0; $i<=10; $i++)
			<td class="center bordered">{{$result[50][$i]}}</td>
			@endfor
		</tr>
	</table>
	<div style="page-break-after: always;"></div>
	<table>
		<tr>
			<td width="5%" class="center bordered">1</td>
			<td width="7%" class="center bordered">2</td>
			<td width="18%" class="center bordered">3</td>
			<td width="6%" class="center bordered">4</td>
			<td width="6%" class="center bordered">5</td>
			<td width="6%" class="center bordered">6</td>
			<td width="6%" class="center bordered">7</td>
			<td width="6%" class="center bordered">8</td>
			<td width="6%" class="center bordered">9</td>
			<td width="6%" class="center bordered">10</td>
			<td width="6%" class="center bordered">11</td>
			<td width="5%" class="center bordered">12</td>
			<td width="5%" class="center bordered">13</td>
			<td width="12%" class="center bordered">14</td>
		</tr>
		@foreach($jenis_penyakit_B as $key => $item)
		<tr>
			<td class="center bordered">{{$idx++}}</td>
			<td class="bordered">{{$item[0]}}</td>
			<td class="bordered">{{$item[1]}}</td>
			@for($i=0; $i<=10; $i++)
			<td class="center bordered">{{$result[$idx-2][$i]}}</td>
			@endfor
		</tr>
		@endforeach
		<tr>
			<td colspan="3" class="center bordered">JUMLAH B</td>
			@for($i=0; $i<=10; $i++)
			<td class="center bordered">{{$result[51][$i]}}</td>
			@endfor
		</tr>
	</table>

	<div style="page-break-after: always;"></div>
	<table>
		<tr>
			<td width="5%" class="center bordered">1</td>
			<td width="7%" class="center bordered">2</td>
			<td width="18%" class="center bordered">3</td>
			<td width="6%" class="center bordered">4</td>
			<td width="6%" class="center bordered">5</td>
			<td width="6%" class="center bordered">6</td>
			<td width="6%" class="center bordered">7</td>
			<td width="6%" class="center bordered">8</td>
			<td width="6%" class="center bordered">9</td>
			<td width="6%" class="center bordered">10</td>
			<td width="6%" class="center bordered">11</td>
			<td width="5%" class="center bordered">12</td>
			<td width="5%" class="center bordered">13</td>
			<td width="12%" class="center bordered">14</td>
		</tr>
		@foreach($jenis_penyakit_C as $key => $item)
		<tr>
			<td class="center bordered">{{$idx++}}</td>
			<td class="bordered">{{$item[0]}}</td>
			<td class="bordered">{{$item[1]}}</td>
			@for($i=0; $i<=10; $i++)
			<td class="center bordered">{{$result[$idx-2][$i]}}</td>
			@endfor
		</tr>
		@endforeach
		<tr>
			<td colspan="3" class="center bordered">JUMLAH C</td>
			@for($i=0; $i<=10; $i++)
			<td class="center bordered">{{$result[52][$i]}}</td>
			@endfor
		</tr>
		<tr>
			<td colspan="3" class="center bordered">JUMLAH A+B+C</td>
			@for($i=0; $i<=10; $i++)
			<td class="center bordered">{{$result[53][$i]}}</td>
			@endfor
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="50%"></td>
			<td width="50%" class="center">Surabaya, &nbsp;&nbsp;&nbsp;&nbsp; {{$tanggal_ttd}}</td>
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
			<td width="50%"></td>
			<td class="center" width="50%">{{$ttd->nama}}</td>
		</tr>
		<tr>
			<td></td>
			<td class="center">{{$ttd->pangkat}} NRP.{{$ttd->nip}}</td>
		</tr>
	</table>

</body>