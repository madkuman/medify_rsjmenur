@extends('farmasi.layouts.main')

@section('title')
Farmasi Penghapusan
@endsection

@section('css')
    
    <style type="text/css">
    .modal-content {
        border-radius: 0;
    }
    .modal-full {
        min-width: 100%;
        margin: 0;
    }

    .modal-full .modal-content {
        min-height: 100vh;
    }
    .clickable-row {
        cursor: pointer;
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
    #penghapusan_farmasi_filter {
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
            <h3 class="block-title">Penghapusan</h3>
            <div class="block-options">
                <a href="{{url('farmasi')}}/{{$farmasi->slug}}/master-penghapusan-jenis" class="btn btn-secondary btn-sm">Master Jenis Penghapusan</a>
                <button type="submit" class="btn btn-sm btn-primary btn-square" id="new">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Penghapusan Baru
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="block block-transparent">
                <button type="submit" class="btn btn-secondary btn-square" id="btnFilter">
                    <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter Data
                </button>
                <div class="d-none" id="filter-data">
                    <form method="POST" action="">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="penyedia">TANGGAL PENGELUARAN</label>
                                    <input type="text" class="js-datepicker form-control datepicker" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" value="{{$tanggal_awal}}" autocomplete="off">
                                    <input type="text" class="js-datepicker form-control mt-2 datepicker" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" value="{{$tanggal_akhir}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>PENYEDIA </label>
                                    <select class="form-control js-select2" id="filter_penyedia_id" style="width: 100%;">
                                        <option value="">SEMUA</option>
                                        @foreach($supplier as $supp)
                                        <option value="{{$supp->id}}">{{$supp->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>JENIS PENGHAPUSAN </label>
                                    <select class="form-control js-select2" id="filter_jenis_penghapusan_id" style="width: 100%;">
                                        <option value="">SEMUA</option>
                                        @foreach($penghapusan_jenis as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                     <label>SURAT PERINTAH</label>
                                    <input type="text" class="form-control" id="filter_surat_perintah">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>NO PENGELUARAN</label>
                                    <input type="text" class="form-control" id="filter_no_pengeluaran">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>KETERANGAN</label>
                                    <input type="text" class="form-control" id="filter_keterangan">
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary btn-square" id="btnCancel">Tutup</button>
                                <span>&nbsp;</span>
                                <button type="button" class="btn btn-primary btn-square" id="searchBtn">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <table class="table table-hover table-vcenter" id="penghapusan_farmasi">
                <thead>
                    <tr>
                        <th width="30px">ID</th>
                        <th width="120px">Tanggal</th>
                        <th width="120px">Jenis</th>
                        <th width="120px">Penyedia</th>
                        <th width="120px">No Pengeluaran</th>
                        <th width="120px">No Surat Perintah</th>
                        <th width="150px">Keterangan</th>
                        <th width="60px">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    @include('farmasi.penghapusan.components.modal-index')
@endsection



@section('js')
    <script type="text/javascript" src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    @include('farmasi.penghapusan.components.js-index')
@endsection