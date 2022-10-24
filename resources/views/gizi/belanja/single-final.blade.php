@extends('gizi.layouts.index')

@section('title')
Gizi Belanja
@endsection

@section('css')

@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<a href="{{url('gizi/laporan/laporan-bahan/')}}?daterange1={{$data['passing']}}&daterange2={{$data['passing']}}" class="btn btn-success pull-right mr-5">Print</a>
				<a href="{{url('gizi/belanja/edit/')}}/{{$data['belanja']->id}}" class="btn btn-warning pull-right  mr-5"><i class="fa fa-edit"></i> Edit</a>
				<a href="{{url('gizi/belanja/delete/')}}/{{$data['belanja']->id}}"><button class="btn btn-danger pull-right mr-5"><i class="fa fa-trash"></i> Delete</button></a>
				Belanja <small>#{{$data['belanja']->id}}</small>
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-vcenter  table-sm table-borderless" id="example">
				<tbody>
					<tr>
						<td>Tanggal Belanja</td>
						<td>:</td>
						<td>{{$data['tanggal']}}</td>
					</tr>
					<tr>
						<td>Deskripsi</td>
						<td>:</td>
						<td>{{$data['belanja']->deskripsi}}</td>
					</tr>
					<tr>
						<td>Keterangan</td>
						<td>:</td>
						<td>{{$data['belanja']->keterangan}}</td>
					</tr>
					<tr>
						<td>Total Belanja</td>
						<td>:</td>
						@if(!empty($data['belanja']->total_belanja))
						@php $number = number_format($data['belanja']->total_belanja, 0, '.' , ','); @endphp
						<td>Rp {{$number}}</td>
						@else
						<td>-</td>
						@endif
					</tr>
					<tr>
						<td>Dikonfirmasi Oleh</td>
						<td>:</td>
						<td>{{$data['belanja']->konfirmasi->name}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<hr>
		<div class="block-content">
			<div class="row">
				<div class="col-6">
				<h3>Bahan Kering</h3>
					<table class="table table-vcenter js-dataTable-full" id="example">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Bahan Makanan</th>
								<th class="text-center">Rencana Belanja</th>
								<th class="text-center">Realisasi</th>
								<th class="texc-center">Subtotal</th>
							</tr>
						</thead>
						<tbody>
							@php $i = 0 @endphp
							@foreach($data['detail_kering'] as $detail)
							<tr>
								<td class="text-center">{{$i+1}}</td>
								<td>{{$detail->detail_bahan->nama}}({{$detail->detail_bahan->satuan}})</td>
								<td class="text-center">{{$detail->jumlah_estimasi}}</td>
								@if(empty($detail->jumlah_realisasi))
								<td class="text-center">-</td>
								@else
								<td class="text-center">{{$detail->jumlah_realisasi}}</td>
								@endif
								@php $number = number_format($detail->total_satuan, 0, '.' , ','); @endphp
								<td class="text-center">Rp {{$number}}</td>
								@php $i++ @endphp
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="col-6">
				<h3>Bahan Basah</h3>
					<table class="table table-vcenter js-dataTable-full" id="example">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Bahan Makanan</th>
								<th class="text-center">Rencana Belanja</th>
								<th class="text-center">Realisasi</th>
								<th class="texc-center">Subtotal</th>
							</tr>
						</thead>
						<tbody>
							@php $i = 0 @endphp
							@foreach($data['detail_basah'] as $detail)
							<tr>
								<td class="text-center">{{$i+1}}</td>
								<td>{{$detail->detail_bahan->nama}}({{$detail->detail_bahan->satuan}})</td>
								<td class="text-center">{{$detail->jumlah_estimasi}}</td>
								@if(empty($detail->jumlah_realisasi))
								<td class="text-center">-</td>
								@else
								<td class="text-center">{{$detail->jumlah_realisasi}}</td>
								@endif
								@php $number = number_format($detail->total_satuan, 0, '.' , ','); @endphp
								<td class="text-center">Rp {{$number}}</td>
								@php $i++ @endphp
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="block-content">
			<div class="row mt-20">
				<div class="col">
					<hr>
					<h6 class="p-10">
						<small class="text-muted">Dibuat Oleh</small><br>
						{{$data['belanja']->pembuat->name}}<br>
						<span class="font-w400">{{$data['belanja']->created_at}}</span>
					</h6>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')




<script type="text/javascript">
	jQuery('.js-dataTable-full').dataTable({
		"ordering": true,
		pageLength: 8,
		lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
		autoWidth: false
	});
</script>
@endsection