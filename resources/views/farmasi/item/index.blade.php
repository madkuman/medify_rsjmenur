@extends('farmasi.layouts.main')

@section('title')
Farmasi Barang
@endsection

@section('css')

<style type="text/css">
    .inline {
        display: inline;
    }
    .modal-content {
        border-radius: 0;
    }
    .clickable-row {
        cursor: pointer;
    }
    .mt-70 {
        margin-top: 70px !important;
    }
    div.dataTables_wrapper div.dataTables_processing {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 200px;
        margin-left: -100px;
        margin-top: -26px;
        text-align: center;
        padding: 1em 0;
    }
    #items_farmasi_filter {
        display: none;
    }
    .panel-default {
        border-color: #eaecee !important;
    }
    .panel {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
</style>
@endsection

@section('content')
    <div class="block" style="min-height: 350px">
        <div class="block-header block-header-default">
            <h3 class="block-title">Barang</h3>
            <div class="block-options">
                @if (session('farmasi')->jenis == 4 && Auth::user()->id == 188)
                    <button type="button" class="btn btn-sm btn-primary btn-square" data-toggle="modal" data-target="#newItemModal">
                        <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Barang Baru
                    </button>
                @endif
                @if (session('farmasi')->jenis == 4)
                <a href="{{url('farmasi/'.session('farmasi')->slug)}}/master-data" class="btn btn-secondary"><i class="fa fa-cog"></i> Master</a>
                @endif
                <a href="{{url('farmasi/'.session('farmasi')->slug.'/item')}}/filter/expired" class="btn btn-secondary">Barang Expired</a>
                <a href="{{url('farmasi/'.session('farmasi')->slug.'/item')}}/filter/low-stock" class="btn btn-secondary">Barang Low Stock</a>
            </div>
        </div>
        <div class="block-content">
            <div class="block block-transparent">
                <button type="submit" class="btn btn-secondary btn-square" id="btnFilter">
                    <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter Data
                </button>
                <div class="d-none" id="filter-data">
                    <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/item')}}" id="formFilter">
                        {!!csrf_field()!!}
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="penyedia">NAMA BARANG </label>
                                    <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="penyedia">KATEGORI </label>
                                    <select class="js-example-basic-multiple form-control" id="kategori-select2" name="kategori[]" multiple="multiple" style="width: 100%;">
                                        @foreach($gorilla as $gori)
                                            <option value="{{$gori->id}}"
                                            >{{$gori->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="penyedia">JENIS </label>
                                    <select class="js-example-basic-multiple form-control" id="jenis-select2" name="jenis[]" multiple="multiple" style="width: 100%;">
                                        <option value="Obat">Obat</option>
                                        <option value="Matkes">Matkes</option>
                                        <option value="Alkes">Alkes</option>
                                        <option value="Implan">Implan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="penyedia">HARGA BELI </label>
                                    <input type="number" class="form-control" name="harga_minimal" id="harga_minimal" placeholder="Harga Minimal">
                                    <input type="number" class="form-control mt-2" name="harga_maksimal" id="harga_maksimal" placeholder="Harga Maksimal">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="penyedia">STOK </label>
                                    <input type="number" class="form-control" name="stok_minimal" id="stok_minimal" placeholder="Minimal">
                                    <input type="number" class="form-control mt-2" name="stok_maksimal" id="stok_maksimal" placeholder="Maksimal">
                                </div>
                            </div>
                        </div>
                        <div class="pull-right mt-15">
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary btn-square" id="btnCancel">Batalkan</button>
                                <button type="button" class="btn btn-warning btn-square" id="btnReset">Reset</button>
                                <button type="button" class="btn btn-primary btn-square" id="searchBtn">
                                    <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <table class="table table-hover table-vcenter" id="items_farmasi" style="width: 100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class="d-none d-sm-table-cell">Nama Barang</th>
                        <th class="d-none d-sm-table-cell">Stok</th>
                        <th class="d-none d-sm-table-cell">Harga Beli</th>
                        <th class="d-none d-sm-table-cell">Expired</th>
                        <th class="d-none d-sm-table-cell">Kategori</th>
                        <th class="d-none d-sm-table-cell">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    @include('farmasi.item.modals.modal-new-item')
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    @include('farmasi.item.components.js')
@endsection