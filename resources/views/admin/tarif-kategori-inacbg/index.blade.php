@extends('layouts.main-dashboard')

@section('title')
Admin - Daftar Tarif Kategori INACBG
@endsection

@section('css')

@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<div class="content" style="margin-top:50px;">
    <div class="block block-rounded">
        <div class="block-header py-20">
            <span><h4 class="mb-0">Daftar Tarif Kategori INACBG</h4><hr>
            <h5></h5></span>
            <div class="block-options">
                <button type="button" class="btn btn-sm btn-primary btn-hero btn-add">
                    <i class="fa fa-plus"></i> Tambah
                </button>
            </div>
        </div>
        <div class="block-content py-20">
            <table class="table table-striped table-hover table-vcenter transaksiTable js-dataTable-full" id="transaksiTable">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">ID</th>
                        <th class="text-center" >Nama</th>
                        <th class="text-center" >Slug</th>
                        <th class="text-center" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategori as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->nama}}</td>
                        <td>{{$item->slug}}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-alt-warning btn-edit" data-id="{{$item->id}}" data-nama="{{$item->nama}}" data-slug="{{$item->slug}}" data-toggle="tooltip" title="Edit">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-alt-danger btn-delete" data-id="{{$item->id}}" data-toggle="tooltip" title="Delete">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

@include('admin.tarif-kategori-inacbg.add')
<form method="post" action="{{url()->current()}}/delete" id="form-delete">
    {{ csrf_field() }}
    <input type="hidden" name="id" id="id-delete">
</form>
@endsection

@section('js')

<script type="text/javascript"> 
    $(document).ready(function() {

        $('.btn-add').on('click', function() {
            $('#id-jenis-pemasukan').val('');
            $('#nama-jenis-pemasukan').val('');
            $('#slug-jenis-pemasukan').val('');
            $('#add-modal').modal('toggle');
        })

        $('.btn-edit').on('click', function() {
            id = $(this).data('id');
            nama = $(this).data('nama');
            slug = $(this).data('slug');
            $('#id-jenis-pemasukan').val(id);
            $('#nama-jenis-pemasukan').val(nama);
            $('#slug-jenis-pemasukan').val(slug);
            $('#add-modal').modal('toggle');
        })

        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            id = $(this).data("id");
            $('#id-delete').val(id);
            swal({
                title: "Hapus",
                text: "Apakah anda yakin akan menghapus data ini?",
                showCancelButton: true,
                reverseButtons: true,
                type: 'warning',
                confirmButtonClass: "btn btn-danger",
                cancelButtonClass: "btn btn-default",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            }).then(function(result) {
                if(result.value)
                {
                    $('#form-delete').submit();
                }
            });
        })

    });
</script>
@endsection