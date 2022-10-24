@extends('eusulan.layouts.main')

@section('title')
    E-Usulan - Usulan
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
                <span><h4 class="mb-0">Usulan</h4><hr>
                <h5></h5></span>
                    <input type="text" class="d-none" id="today" value="">
                    <div class="block-options">
                        <a href="{{url()->current()}}/baru" class="btn btn-sm btn-primary btn-hero">
                            <i class="fa fa-plus"></i> Tambah
                        </a>
                    </div>
                </div>

                <div class="block-content py-5">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label>Pilih Periode</label>
                                <div class="form-inline">
                                    <input type="text" class="form-control js-datepicker-year" onkeydown="return false" id="filter-periode" value="{{date('Y')}}" data-date-autoclose="true">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Unit</label>
                                <div class="form-inline">
                                    <select class="js-select2 form-control"id="filter-unit" style="width: 100%;" data-placeholder="Pilih Kategori">
                                        <option value="all">Semua Unit</option>
                                        @foreach($unit as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered table-striped table-vcenter" id="example" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center" width="5%">#</th>
                                    <th class="text-center" width="15%">Tahun</th>
                                    <th class="text-center" width="30%">Unit</th>
                                    <th class="text-center" width="40%">Nama</th>
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
@endsection

@section('js')
    @include('eusulan.usulan.components.js-index')
@endsection