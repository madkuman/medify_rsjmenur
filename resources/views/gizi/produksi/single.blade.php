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
				<a href="{{url('gizi/produksi/edit/')}}/{{$data['produksi']->id}}" 
				class="btn btn-warning pull-right"><i class="fa fa-edit"></i> Edit</a>
				<a href="{{url('gizi/produksi/delete/')}}/{{$data['produksi']->id}}/delete" 
				class="btn btn-danger pull-right mr-5"><i class="fa fa-trash"></i> Delete</a>
				Produksi <small>#{{$data['produksi']->id}}</small>
			</h3>
		</div>
		<div class="block-content">
			<div class="row">
				<div class="col-4">
					<h5 class="font-w400"><small>PRODUKSI UNTUK TANGGAL</small><br>
					{{$tanggal}}
					@foreach($data['detail'] as $item)					
						@if($item->waktu_makan_id == 1) Pagi @endif
						@if($item->waktu_makan_id == 2) Siang @endif
						@if($item->waktu_makan_id == 3) Sore @endif
					@endforeach
					</h5>
				</div>
				<!-- <div class="col-6">
					<h5 class="font-w400"><small>KETERANGAN</small><br>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</h5>
				</div> -->
			</div>
		</div>
		<div class="block-content">
			<div class="row">
				<div class="col">
					<h5>Daftar Makanan Yang Dibuat</h5>
					<table class="table table-bordered table-striped table-vcenter js-dataTable-full">
						<thead>
							<tr>
								<th>Makanan</th>
								<th class="">Jumlah</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data['makanan'] as $makanan)
							<tr>
								<td class="font-w600">{{$makanan->resep->nama}}</td>
								<td class="text-center">{{$makanan->jumlah_realisasi}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="col">
					<h5>Daftar Bahan Yang Dibuat</h5>
					<table class="table table-bordered table-striped table-vcenter js-dataTable-full">
						<thead>
							<tr>
								<th>Bahan</th>
								<th class="">Jumlah</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data['bahan'] as $bahan)
							<tr>
								<td class="font-w600">{{$bahan->bahan->nama}}</td>
								<td class="text-center">{{$bahan->jumlah_realisasi}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
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