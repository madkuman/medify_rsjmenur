@extends('eusulan.layouts.main')

@section('title')
    E-Usulan - Pengaturan - Unit
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
                <span><h4 class="mb-0">Unit</h4><hr>
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
                                    <th class="text-center" width="35%">Nama</th>
                                    <th class="text-center" width="10%">Aksi</th>
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
    @include('eusulan.pengaturan.unit.components.modal-create')
    @include('eusulan.pengaturan.unit.components.modal-edit')
@endsection

@section('js')
    @include('eusulan.pengaturan.unit.components.js-index')
    @include('eusulan.pengaturan.unit.components.js-create')
    @include('eusulan.pengaturan.unit.components.js-edit')
@endsection