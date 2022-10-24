@extends('gizi.layouts.index')

@section('title')
Gizi Histori Belanja
@endsection

@section('css')

@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Histori Belanja Bahan
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th class="text-center">Deskripsi</th>
						<th class="text-center">Tanggal Belanja</th>
						<th class="text-center">Total Belanja</th>
						<th class="text-center">Keterangan</th>
						<th class="text-center">Status</th>
						<th class="text-center">Detail</th>
					</tr>
				</thead>
				<tbody>
					@php $i = 0; @endphp
					@foreach($data as $item)
					<tr>
						@php $number = number_format($item->total_belanja, 0, '.' , ','); @endphp
						<td class="text-center">{{$i+1}}</td>
						<td>{{$item->deskripsi}}</td>
						<td class="text-center">{{$item->created_at}}</td>
						<td class="text-center">Rp{{$number}}</td>
						<td class="text-center">{{$item->keterangan}}</td>
						<td class="text-center font-w600">
						@if(empty($item->confirmed_at))
						Belum Selesai
						@else
						Selesai
						@endif	
						</td>
						<td class="text-center"><a href="{{url('/gizi/belanja/')}}/{{$item->id}}
						@if(empty($item->confirmed_at))
						?status=1
						@endif" class="btn btn-sm btn-circle btn-outline-primary"><i class="fa fa-search-plus"></i></a></td>
					</tr>
					@php $i++; @endphp
					@endforeach
					
				</tbody>
			</table>
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