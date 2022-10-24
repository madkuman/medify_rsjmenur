@extends('gizi.layouts.index')

@section('title')
Medify - Gizi Rekap Diet
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Rekap Diet Pesanan @if(!empty($date))<small>{{$date}}</small>@else<small>{{date('dd/mm/yyyy')}}</small>@endif
			</h3>
		</div>
		@include('gizi.pemesanan.components.filter')
		<!-- <div class="block-header">
			<h3 class="block-tittle">
				<small><a href="{{url('gizi/pemesanan/print/rekap-diet')}}?tanggal=
				@if(!empty($date))
				{{$date}}
				@else
				{{date('d F Y')}}
				@endif
				" class="pull-right mr-15"><i class="fal fa-print"></i> Print Rekap</a></small>
			</h3>
		</div> -->
		<div class="block-content">
			<table class="table-responsive table table-bordered  table-hover table-striped table-center">
				<tbody>
					<tr>
						<th rowspan="2" style="width: 13%;">DIET</th>
						<th class="text-center" colspan="6">PAGI</th>
						<th class="text-center" colspan="6">SIANG</th>
						<th class="text-center" colspan="6">SORE</th>
						<th rowspan="2" class="text-center">TOTAL</th>
					</tr>
					<tr>
						@foreach($kelas as $kelas_item)
						<th class="text-center" >{{$kelas_item->nama}}</th>
						@endforeach
						<th class="text-center">TOTAL</th>
						@foreach($kelas as $kelas_item)
						<th class="text-center" >{{$kelas_item->nama}}</th>
						@endforeach
						<th class="text-center">TOTAL</th>
						@foreach($kelas as $kelas_item)
						<th class="text-center" >{{$kelas_item->nama}}</th>
						@endforeach
						<th class="text-center">TOTAL</th>
					</tr>
					<tr></tr>
					@foreach($diet as $diet_item)
					<tr class="border-top-bold">
						<td>{{$diet_item->nama}}</td>
						@for($i=1;$i<=3;$i++)
						@foreach($kelas as $kelas_item)
						<td>{{$data[$diet_item->nama][$i][$kelas_item->nama]['normal']}}</td>
						@endforeach
						<td>{{$jumlah[$diet_item->nama][$i]['normal']}}</td>
						@endfor
						<td>{{$jumlah[$diet_item->nama]['normal']}}</td>	
					</tr>
					<tr class="border-bottom-bold">
						<td><i>Tambahan {{$diet_item->nama}}</i></td>
						@for($i=1;$i<=3;$i++)
						@foreach($kelas as $kelas_item)
						<td>{{$data[$diet_item->nama][$i][$kelas_item->nama]['tambahan']}}</td>
						@endforeach
						<td>{{$jumlah[$diet_item->nama][$i]['tambahan']}}</td>
						@endfor
						<td>{{$jumlah[$diet_item->nama]['tambahan']}}</td>	
					</tr>
					@endforeach
				</tr>

			</tbody>
		</table>
	</div>
</div>
</div>
@endsection

@section('js')
@endsection