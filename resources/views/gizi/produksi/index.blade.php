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
				<small><a href="{{url('gizi/produksi/baru')}}" class="pull-right"><i class="fa fa-plus-circle"></i> Buat Produksi</a></small> 
				<small><a href="{{url('gizi/produksi/histori')}}" class="pull-right mr-15"><i class="fal fa-clock"></i> Histori Produksi</a></small> 
				Produksi Makanan <small>{{$tanggal['hari_ini']}}pagi, siang, sore</small>
			</h3>
		</div>
		<div class="block-content pt-0">
			<hr>
			<h6 class="mb-0">Buat Laporan Produksi Hari Ini Berdasarkan Rekap</h6>
			<p class="mb-5">Dengan ini anda tidak perlu memasukkan rekap resep ulang untuk membuat daftar belanja</p>
			<a href="{{url('gizi/produksi/baru?auto=1')}}"  class="btn btn-primary">Buat Laporan Produksi</a>
			<button id="tombol" class="btn btn-primary">Tampilkan Daftar Produksi</button>
			<hr>
		</div>
		<div class="block-content" id="isi" @if($show == 1) style="display:none" @endif>
			<div class="col-8">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th class="text-center">Resep</th>
						<th class="text-center">Jumlah</th>
					</tr>
				</thead>
				<tbody>
					@php $i = 0; @endphp
					@foreach($data as $item)
					<tr>
						<td class="text-center">{{$i+1}}</td>
						<td class="text-center">{{$item['nama']}}</td>
						<td class="text-center">{{$item['jumlah']}}</td>
					</tr>
					@php $i++;@endphp
					@endforeach					
				</tbody>
			</table>
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

	$("#tombol").click(function(){
    	$("#isi").toggle();
	});
</script>
@endsection