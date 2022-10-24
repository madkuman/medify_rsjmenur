@extends('gizi.layouts.index')

@section('title')
Gizi Resep
@endsection

@section('css')

@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<small><a href="{{url('gizi/resep/baru')}}" class="pull-right"><i class="fa fa-plus-circle"></i> Resep Baru</a></small> 
				Resep Makanan
			</h3>
		</div>
		
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th>Nama Resep</th>
						<th class="text-center">Waktu Masak</th>
						<th class="text-center">Jumlah Porsi</th>
						<th class="text-center">Ukuran Tiap Porsi</th>
						<th class="text-center">Detail</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $data)
					<tr>
						<td class="text-center">{{$data->id}}</td>
						<td class="font-w600">{{$data->nama}}</td>
						<td class="text-center">{{$data->waktu_masak}}</td>
						<td class="text-center">{{$data->porsi}}</td>
						<td class="text-center">{{$data->ukuran_tiap_porsi}}</td>
						<td class="text-center">
						<a href="{{url('gizi/resep/')}}/{{$data->id}}" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5" data-id="{{$data->id}}"><i class="fa fa-search-plus"></i></a>
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

	function deleteModal(id)
	{
		swal({
			title: 'Apakah Anda Yakin?',
			text: "Bahan akan terhapus dari daftar bahan dan resep",
			type: 'warning',
			showCancelButton: true,
			confirmButtonClass: 'btn btn-secondary',
			cancelButtonClass: 'btn btn-danger',
			confirmButtonText: 'Ya, Hapus!',
			cancelButtonText: 'Batalkan'
		}).then((result) => {
			if (result.value) {
				swal(
					'Deleted!',
					'Your file has been deleted.',
					'success'
					)
			}
		})

	}
</script>
@endsection