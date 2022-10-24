@extends('gizi.layouts.index')

@section('title')
Gizi Menu
@endsection

@section('css')

@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<small><a href="{{url('gizi/menu/baru')}}" class="pull-right"><i class="fa fa-plus-circle"></i> Menu Baru</a></small> 
				Jadwal Menu Makanan
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th>Nama Menu</th>
						<th class="text-center">Kelas</th>
						<th class="text-center">Periode Tanggal</th>
						{{--<th class="text-center">Jenis Diet</th>--}}
						<th class="text-center">Detail</th>
					</tr>
				</thead>
				<tbody>
					@php $j = count($data) @endphp
					@for($i=0; $i<$j; $i++)
					<tr>
						<td class="text-center">{{$i+1}}</td>
						<td class="font-w600">{{$data[$i]->nama or '-'}}</td>
						<td class="text-center">{{$data[$i]->kelas_menu->nama or '-'}}</td>
						<td class="text-center">{{$data[$i]->tanggal_periode or '-'}}</td>
						{{--<td class="text-center">{{$data[$i]->diet_menu->nama or '-'}}</td>--}}
						<td class="text-center">
							<a href="{{url('gizi/menu/')}}/{{$data[$i]->id}}" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>
						</td>
					</tr>
					@endfor
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection

@section('js')




<script type="text/javascript">
	$(document).ready(function(){
		jQuery('.js-dataTable-full').dataTable({
			"ordering": true,
			pageLength: 8,
			lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
			autoWidth: false
		});	
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