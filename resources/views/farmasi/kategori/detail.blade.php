@extends('farmasi.layouts.main')

@section('title')
Gudang Detail Kategori
@endsection

@section('content')
	<div class="block">
        <div class="block-header bordered">
            <h3 class="block-title">
            	<small>KATEGORI</small> <br>
            	{{$kategori->nama}}
                @if($kategori->is_kandungan)
                <span class="badge badge-primary">Kandungan Obat</span>
                @endif
            </h3>
            <div class="block-options">
                <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/kategori/delete')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="kategori_id" value="{{$kategori->id}}">
                </form>
	            <button type="submit" class="confirm-del btn btn-secondary btn-square">
	                <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
	            </button>
	            <button type="button" class="btn btn-secondary btn-square" id="edit-kategori">
	                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
	            </button>
            </div>
            <hr class="my-5">
        </div>
        <div class="block-content">
            <div class="block block-transparent">
                <div class="row">
                	<div class="col">
                		<label>DIBUAT OLEH</label>
                		<h5>{{$kategori->created_by_detail->name}}</h5>
                	</div>
                	<div class="col">
                        <label>TANGGAL DIBUAT</label>
                        <h5>{{ date('d F Y', strtotime($kategori->created_at)) }}</h5>
                	</div>
                </div>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="block-header bordered">
            <h3 class="block-title">
                <small>Obat Dengan Kategori Ini ({{$kategori->item->count()}})</small>
            </h3>
        </div>
        <div class="block-content">
            <table class="table table-hover js-dataTable-full">
                <thead>
                    <tr>
                        <th style="width: 5%">ID</th>
                        <th class="d-none d-sm-table-cell" style="width: 50%">Nama Obat</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%">Harga</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%">Stok</th>
                        <th class="d-none d-sm-table-cell" style="width: 20%">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1 @endphp
                    @foreach($obat as $item)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$item->item_detail->nama ?? ''}}</td>
                        <td>Rp {{number_format($item->item_detail->harga) ?? 0}}</td>
                        @php $stok = $item->stok ?? 0 @endphp
                        <td>{{number_format($stok)}}</td>
                        <td>
                            <a href="{{url('farmasi/'.session('farmasi')->slug.'/item/'.$item->slug)}}" class="btn btn-sm btn-primary mr-5 mb-5"><i class="fa fa-search-plus"></i> Lihat</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    @include('farmasi.kategori.modals.modal-edit')
@endsection

@section('css')
	<style type="text/css">
		.bordered {
			border-bottom: 1px solid #eaecee;
		}
	</style>
@endsection

@section('js')
    <script type="text/javascript">
        $('#edit-kategori').on('click', function(){
            $('#modal-normal').modal('show');
        })

        $('.confirm-del').on('click', function(){
            var deleteSupp = $(this).parent().find('form');
            swal({
                title: 'Apa anda yakin?',
                text: 'Data yang telah terhapus tidak dapat dikembalikan lagi',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Hapus',
                html: false,
                preConfirm: function() {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 50);
                    });
                }
            }).then(function(result){
                if (result.value) {
                    deleteSupp.submit();
                } else if (result.dismiss === 'cancel') {
                    swal('Batal', 'Hapus data dibatalkan.', 'error');
                }
            });
        });
    </script>





    <script type="text/javascript">
        
    jQuery('.js-dataTable-full').dataTable({
        "ordering": true,
        pageLength: 8,
        lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
        autoWidth: false
    });

    </script>
@endsection