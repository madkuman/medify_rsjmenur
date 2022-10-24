@extends('layouts.main-dashboard')

@section('title')
Admin - Daftar Lokasi
@endsection

@section('css')

@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<div class="content" style="margin-top:50px;">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<small><a href="{{url('admin/lokasi/baru')}}" class="pull-right">
				<i class="fa fa-plus-circle"></i> Input Lokasi Baru</a></small> 
				Daftar Lokasi
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="">No</th>
						<th>Nama</th>
						<th>Departemen</th>
						<th>Kategori Keuangan</th>
						<th>Zona PPI</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				@php $i = 1; @endphp
				@foreach($data as $isi)
					<tr>
						<td class="">{{$i}}</td>
						<td class="font-w600">{{$isi->nama}}</td>
						<td class="font-w600">{{$isi->departemen->nama ?? '-'}}</td>
						<td class="font-w600">{{$isi->kategori_keuangan->name ?? '-'}}</td>
						<td class="font-w600">{{$isi->zona_ppi_detail->zona ?? '-'}}</td>
						<td class="">
							<a href="{{url('/admin/lokasi/edit/')}}/{{$isi->id}}" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5">
							<i class="fa fa-edit"></i></a>
							<a href="#deletemodal" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5"
							data-toggle="modal" data-id="{{$isi->id}}" data-nama="{{$isi->nama}}">
							<i class="fa fa-trash"></i></a>
						</td>
					</tr>
				@php $i++; @endphp	
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<div id="deletemodal" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Data</h4>
            </div>
            <div class="modal-body">
                <p id="show-name"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a id="del-btn">
                    <button type="button" class="btn btn-danger pull-right" style="margin-left: 4px ;">Hapus</button>
                </a>
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
    $(document).on("click",".btn-outline-danger", function () {
        var id = $(this).data('id')
        var nama = $(this).data('nama');
        console.log(id,nama);
        $("#del-btn").attr('href','{{url('admin/lokasi/delete')}}' + '/' + id)
        $("#show-name").html('Anda yakin ingin menghapus data lokasi ' + nama + '?')

    })
</script>

@endsection