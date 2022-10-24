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
				<!-- <small><a href="{{url('gizi/belanja/baru')}}" class="pull-right"><i class="fa fa-plus-circle"></i> Buat Belanja</a></small> --> 
				<small><a href="{{url('gizi/belanja/histori')}}" class="pull-right mr-15"><i class="far fa-clock"></i> Histori Belanja</a></small> 
				<small><a href="{{url('gizi/pemesanan/rekap-resep')}}" class="pull-right mr-15"><i class="fal fa-table"></i> Lihat Rekap Resep</a></small> 
				Daftar Pemesanan Makanan <small>{{date('d F Y')}} sore - {{$data['besok']}} siang</small>
			</h3>
		</div>
		<div class="block-content pt-0">
			<hr>
			<h6 class="mb-0">Buat Daftar Belanja Berdasarkan Rekap Bahan</h6>
			<p class="mb-5">Dengan ini anda tidak perlu memasukkan rekap bahan ulang untuk membuat daftar belanja</p>
			<a href="{{url('gizi/belanja/auto')}}" class="btn btn-primary">Buat Daftar Belanja</a>
			<button id="tombol" class="btn btn-primary">Tampilkan Daftar Belanja</button>
			<hr>
		</div>
		<div class="block-content" id="isi" @if($show == 1) style="display:none" @endif>
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th>Bahan Makanan</th>
						<th class="text-center">Kebutuhan BB</th>
						<th class="text-center">Kebutuhan BK</th>
						<th class="text-center">Stok Gudang Saat Ini</th>
						<th class="text-center">Jumlah Belanja</th>
					</tr>
				</thead>
				<tbody>
					@php $i = 0; @endphp
					@foreach($data['resep_detail'] as $item)
					<tr>

						<td class="text-center">{{$i+1}}</td>
						<td class="font-w600">{{$item['nama']}}({{$item['satuan']}})</td>
						<td class="text-center">{{$item['total_bb_final']}}</td>
						<td class="text-center">{{$item['total_bk_final']}}</td>
						<td class="text-center">{{$item['stok']}}</td>
						<td class="text-center font-w600">
						@if(($item['total_bk_final'] - $item['stok']) < 0)
						0
						@else
						{{$item['total_bk_final'] - $item['stok']}}
						@endif
						@php $i++; @endphp
						</td>
					</tr>
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

	$("#tombol").click(function(){
    	$("#isi").toggle();
	});
</script>
@endsection