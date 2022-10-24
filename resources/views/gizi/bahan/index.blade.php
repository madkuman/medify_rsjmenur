@extends('gizi.layouts.index')

@section('title')
Gizi Bahan
@endsection

@section('css')

@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<small><a href="{{url('gizi/bahan/baru')}}" class="pull-right"><i class="fa fa-plus-circle"></i> Bahan Baru</a></small> 
				Bahan Makanan
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th>Bahan</th>
						<th class="">Satuan</th>
						<th class="">Stok Minimal</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody>
				@foreach($data as $data)
					<tr>
						<td class="text-center">{{$data->id}}</td>
						<td class="font-w600">{{$data->nama}}</td>
						<td class="">{{$data->satuan}}</td>
						<td class="">{{$data->stok_minimal}}</td>
						<td class="text-center">
							<a href="{{url('/gizi/bahan/edit/')}}/{{$data->id}}" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5"
							data-id="{{$data->id}}" data-nama="{{$data->nama}}" data-satuan="{{$data->satuan}}"
							data-stokminimal="{{$data->stok_minimal}}"><i class="fa fa-edit"></i></a>
							<a href="#deletemodal" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5"
							data-toggle="modal" data-id="{{$data->id}}" data-nama="{{$data->nama}}">
							<i class="fa fa-trash"></i></a>
						</td>
					</tr>
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
	$(document).on("click", ".btn-outline-info", function(){
            var nama = $(this).data('nama');
            var id = $(this).data('id');
            var minimal_stok = $(this).data('stokminimal');
            var satuan = $(this).data('satuan');
            //console.log(id);
            //console.log(val(nama_barang));
            $("#id").val(id);
            $("#nama").val(nama);
            $("#minimalstok").val(minimal_stok);
            $("#satuan").val(satuan);

            $("#form-edit").attr('action','{{url('/gizi/bahan/edit')}}' + '/' + id);
        });

        $(document).on("click",".btn-outline-danger", function () {
            var id = $(this).data('id')
            var nama = $(this).data('nama');
            $("#del-btn").attr('href','{{url('gizi/bahan/delete')}}' + '/' + id)
            $("#show-name").html('Anda yakin ingin menghapus bahan ' + nama + '?')

        })
</script>
@endsection