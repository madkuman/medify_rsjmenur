@extends('eusulan.layouts.main')

@section('title')
    E-Usulan - Pengaturan - Barang
@endsection


@section('css')

    <style>
        .dataTables_processing {
            background-color: white;
        }
    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="block block-rounded">
                <div class="block-header py-20">
                <span><h4 class="mb-0">Barang</h4><hr>
                <h5></h5></span>
                    <input type="text" class="d-none" id="today" value="">
                    <div class="block-options">
                        <button type="button" class="btn btn-sm btn-primary btn-hero" id="btn-modal-create">
                            <i class="fa fa-plus"></i> Tambah
                        </button>
                    </div>
                </div>

                <div class="block-content py-5">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered table-striped table-vcenter" id="example" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center" width="5%">#</th>
                                    <th class="text-center" width="15%">Kode</th>
                                    <th class="text-center" width="20%">Nama</th>
                                    <th class="text-center" width="5%">Tipe</th>
                                    <th class="text-center" width="10%">Harga</th>
                                    <th class="text-center" width="10%">Satuan</th>
                                    <th class="text-center" width="5%">Kelompok Upload</th>
                                    <th class="text-center" width="15%">Akun Rekening</th>
                                    <th class="text-center" width="15%">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('eusulan.pengaturan.barang.components.modal-create')
    @include('eusulan.pengaturan.barang.components.modal-edit')
@endsection

@section('js')
    @include('eusulan.pengaturan.barang.components.js-index')
    @include('eusulan.pengaturan.barang.components.js-create')
    @include('eusulan.pengaturan.barang.components.js-edit')
@endsection