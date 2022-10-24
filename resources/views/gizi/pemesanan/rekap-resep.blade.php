@extends('gizi.layouts.index')

@section('title')
Medify - Gizi Rekap Resep
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Rekap Resep Pesanan <small>@if(empty($tanggal)) {{$date('d F Y')}} @else {{$tanggal}} @endif</small>
			</h3>
		</div>
		@include('gizi.pemesanan.components.filter')
		<<!-- div class="block-header">
			<h3 class="block-tittle">
				<small><a href="{{url('gizi/pemesanan/print/rekap-resep')}}?tanggal=
				@if(!empty($tanggal))
				{{$tanggal}}
				@else
				{{$date('d F Y')}}
				@endif
				" class="pull-right mr-15"><i class="fal fa-print"></i> Print Rekap</a></small>
			</h3>
		</div> -->
		<div class="block-content">
			<table class="table table-bordered  table-hover table-striped table-center">
				<tbody>
					<tr>
						<th rowspan="2" style="width: 13%;">RESEP</th>
						<th rowspan="2" class="text-center">TOTAL</th>
					</tr>
					<tr></tr>
					@foreach($data as $item)
					<tr>
						<td>{{$item['nama']}}</td>
						<td>{{$item['jumlah']}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection