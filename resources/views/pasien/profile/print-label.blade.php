@extends('layouts.print')

@section('title')
Print Label - {{$pasien->name}}
@endsection

@section('css')
<style type="text/css">
	@page {
		margin-top: 0.3cm;
		margin-left: 0.1cm;
		margin-bottom: -0.5cm;
		margin-right: -0.2cm;
		size: 104mm 33mm;
		font-family: sans-serif;
	}
	td{
		font-size: 10px;
		vertical-align: top;
		padding: 0px;
		font-weight: bold;
	}
</style>
@endsection

@section('content')

<table width="100%">
	<tr>
		<td width="50%">
			<table width="100%">
				<tr>
					<td><b style="font-size: 16px;">{{$pasien->no_rm}}</b></td>
					<td style="vertical-align: middle;">{!!$barcode!!}</td>
				</tr>
			</table>
			<table width="100%">
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td>{{substr($pasien->name, 0,19)}} ({{$pasien->gender == '1' ? 'L' : 'P'}})</td>
				</tr>
				<tr>
					<td>Tgl Lhr</td>
					<td>:</td>
					<td>{{indonesian_date($pasien->date_of_birth,'d-m-Y')}}/{{$pasien->age}}</td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:</td>
					<td>{{$pasien->address}}</td>
				</tr>
			</table>
		</td>
		<td width="50%" style="padding-left: 0.1cm;">
			<table width="100%">
				<tr>
					<td><b style="font-size: 16px;">{{$pasien->no_rm}}</b></td>
					<td style="vertical-align: middle;">{!!$barcode!!}</td>
				</tr>
			</table>
			<table width="100%">
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td>{{substr($pasien->name, 0,19)}} ({{$pasien->gender == '1' ? 'L' : 'P'}})</td>
				</tr>
				<tr>
					<td>Tgl Lhr</td>
					<td>:</td>
					<td>{{indonesian_date($pasien->date_of_birth,'d-m-Y')}}/{{$pasien->age}}</td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:</td>
					<td>{{$pasien->address}}</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
@endsection