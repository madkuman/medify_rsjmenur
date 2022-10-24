@extends('layouts.print')

@section('css')
<style type="text/css">
	body{
		font-family: sans-serif;
	}
</style>
@endsection

@section('content')
<table width="100%" border="0">
	<tr>
		<td class="text-center" colspan="6">
			<b>EVALUASI PENILAIAN  CPPT DAN KEHADIRAN DPJP</b>
		</td>
	</tr>
	<tr>
		<td class="text-center" colspan="6">
			<b>RUANG {{$lokasi ?? '-'}}</b>
		</td>
	</tr>
	<tr>
		<td class="text-center" colspan="6">
			<b>BULAN / TAHUN {{indonesian_date($start)}} - {{indonesian_date($end)}}</b>
		</td>
	</tr>
	<tr><td><br></td></tr>
</table>

<table width="100%" border="1" style="border-collapse: collapse;">
	<tr>
		<td align="center" rowspan="2">No.</td>
		<td align="center" rowspan="2">Tanggal</td>
		<td align="center" rowspan="2">Nama Dokter</td>
		<td align="center" colspan="2">CPPT</td>
		<td align="center" colspan="2">Hadir Visite</td>
	</tr>
	<tr>
		<td align="center">Mengisi</td>
		<td align="center">Tidak Mengisi</td>
		<td align="center">Ya</td>
		<td align="center">Tidak</td>
	</tr>

	@foreach($cppt as $item)
	<tr>
		<td align="center">{{$loop->iteration}}</td>
		<td align="center">{{indonesian_date($item->created_at,'d/m/Y')}}</td>
		<td>{{$item->creator->name}}</td>
		<td align="center"><div style="font-family: ZapfDingbats, sans-serif;">4</div></td>
		<td align="center"></td>
		<td align="center"><div style="font-family: ZapfDingbats, sans-serif;">4</div></td>
		<td align="center"></td>
	</tr>
	@endforeach
</table>
@endsection