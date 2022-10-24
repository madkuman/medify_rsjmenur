@extends('gizi.layouts.index')

@section('title')
Gizi Produksi
@endsection

@section('css')

@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Produksi Makanan
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="text-center" style="width:-50%;">No</th>
						<th class="text-center">Tanggal Produksi</th>
						<th class="text-center">Keterangan</th>
						<th class="text-center">Detail</th>
					</tr>
				</thead>
				<tbody>
					@php $i = 1; @endphp
					@foreach($data as $item)
					<tr>
						<td class="text-center">{{$i}}</td>
						<td class="text-center">{{indonesian_date(strtotime($item->tanggal_produksi),'d F Y')}}</td>
						<td class="text-center">-</td>
						<td class="text-center"><a href="{{url('/gizi/produksi/')}}/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-primary"><i class="fa fa-search-plus"></i></a></td>
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