@extends('layouts.print')

@section('title')
Print Barcode - {{$barcode}}
@endsection

@section('css')
<style type="text/css">
	@page {
		margin-top: 0.6cm;
		margin-left: 0.0cm;
		margin-bottom: 0cm;
		margin-right: 0cm;
	}
	body{
		text-align: center;
	}
</style>
@endsection

@section('content')
<table>
	<tbody>
		<tr>
			<td colspan="3">OrderNo {{$detail->transaksi->order_no}}</td>
		</tr>
		<tr>
			<td colspan="2">{{$detail->transaksi->pasien->name}}</td>
			<td>{{$detail->transaksi->asal->nama}}</td>
		</tr>
		<tr>
			<td>No.MR {{$detail->transaksi->pasien->no_rm}}</td>
			<td>???</td>
			<td>{{$detail->transaksi->pasien->date_of_birth}}</td>
		</tr>
	</tbody>
</table>
{!!$barcode_img!!}
<br>
{{$barcode}}
<br>

@endsection