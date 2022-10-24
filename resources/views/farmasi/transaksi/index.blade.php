@extends('farmasi.layouts.main')

@section('title')
Farmasi Transaksi
@endsection

@section('css')

<style type="text/css">
/* 
    .paginate_button {
      color: white;
      text-align: center;
      display: inline-block;
      background-color: #42A5F5;
      padding: 8px 10px;
      cursor: pointer;
      font-size: 13px;
      border: 1px solid white;
      width: 70px;
      z-index: 999;
    }
    .paginate_button:hover {
        background-color: #4298f5;
    }

    .paginate_button:active {
        background-color: #42A5F5;
    }

    .paginate_page {
      text-align: center;
      display: inline-block;
      margin-left: 7px;
      margin-right: 3px;
    }
    .paginate_of {
      text-align: center;
      display: inline-block;
      margin-right: 7px;
      margin-left: 3px;
    }
    .paginate_input{
      color: green;  
    } */
    .badge {
        width: 90px;
    }
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
    #modal-large {
        padding-right: 0 !important;
        padding-left: 0 !important;
    }
    .bordered {
        border-bottom: 1px solid #eaecee;
    }
    .modal-lg {
        max-width: 80% !important;
    }
    .no-border {
        border-top: 0 !important;
        border-right: 0 !important;
        border-left: 0 !important;
        border-bottom: 0;
        border-radius: 0 !important;
    }
    .clickable-row {
        cursor: pointer;
    }
    div.dataTables_wrapper div.dataTables_processing {
        position: absolute;
        top: 50%;
        left: 50%;
        /* width: 200px; */
        margin-left: -100px;
        margin-top: -26px;
        text-align: center;
        padding: 1em 0;
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
    .kemo td {
        padding: 3px;
    }
</style>
@endsection

@section('content')
<div class="block" style="min-height: 350px">
    <div class="block-header block-header-default">
        <h3 class="block-title">Transaksi Obat</h3>
        <div class="block-options">
            @if(session('farmasi')->kemoterapi)
            <button type="button" class="btn btn-sm btn-primary btn-square" data-toggle="modal" data-target="#modal-transaksi-kemoterapi" id="btn-modal-kemoterapi">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Transaksi Obat Kemoterapi Baru
            </button>
            @endif
            <button type="button" class="btn btn-sm btn-primary btn-square btn-toggle-histori-resep" data-toggle="modal" data-target="#modal-large">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Transaksi Obat Baru
            </button>
            <!-- <a href="{{url('farmasi/'.session('farmasi')->slug.'/transaksi/buat-racikan')}}" class="btn btn-sm btn-secondary btn-square">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Racikan
            </a> -->
        </div>
    </div>
    <div class="block-content">
        <div class="block block-transparent">
            <button type="submit" class="btn btn-secondary btn-square" id="btnFilter">
                <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter Data
            </button>
            <div class="d-none" id="filter-data">
                <form id="formFilter">
                    {!!csrf_field()!!}
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="penyedia">TANGGAL </label>
                                <input type="text" class="js-datepicker form-control datepicker" name="start" placeholder="Tanggal Awal" id="tanggal_awal" value="{{date("d/m/Y")}}" autocomplete="off">
                                <input type="text" class="js-datepicker form-control mt-2 datepicker" name="end" placeholder="Tanggal Akhir" id="tanggal_akhir" value="{{date("d/m/Y")}}" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="penyedia">Metode Pembayaran </label>
                                <select class="js-example-basic-multiple form-control" id="jenis-pembayaran" name="jenis_pembayaran" multiple="multiple" style="width: 100%;">
                                    @foreach($jenis_pembayaran as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="penyedia">STATUS </label><br>
                            <div class="row">
                                <div class="col-4">
                                <label class="css-control css-control-lg css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" name="status_selesai" id="status_selesai" @if($status_selesai) checked @endif>
                                    <input type="hidden" name="selesai">
                                    <span class="css-control-indicator"></span> Selesai
                                </label><br>
                                <label class="css-control css-control-lg css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" name="status_menunggu" id="status_menunggu" @if($status_menunggu) checked @endif>
                                    <input type="hidden" name="menunggu">
                                    <span class="css-control-indicator"></span> Menunggu
                                </label>
                                </div>
                                <div class="col-4">
                                <label class="css-control css-control-lg css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" name="sudah_ditelaah" id="sudah_ditelaah" @if($sudah_ditelaah) checked @endif>
                                    <input type="hidden" name="ditelaah">
                                    <span class="css-control-indicator"></span> Sudah ditelaah
                                </label><br>
                                <label class="css-control css-control-lg css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" name="belum_ditelaah" id="belum_ditelaah" @if($belum_ditelaah) checked @endif>
                                    <input type="hidden" name="ditelaah">
                                    <span class="css-control-indicator"></span> Belum ditelaah
                                </label>
                                </div>
                                <div class="col-4">
                                    <label class="css-control css-control-lg css-control-primary css-checkbox">
                                        <input type="checkbox" class="css-control-input" name="cito" id="cito">
                                        <span class="css-control-indicator"></span> Cito
                                    </label><br>
                                    <label class="css-control css-control-lg css-control-primary css-checkbox">
                                        <input type="checkbox" class="css-control-input" name="is_video" id="telekonsultasi">
                                        <span class="css-control-indicator"></span> Telekonsultasi
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-6">
                            <select class="js-select2 form-control" name="bangsal" style="width: 100%;" data-placeholder="Pilih Bangsal">
                                <option value="" selected> Pilih Bangsal </option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="js-select2 form-control" name="bangsal" style="width: 100%;" data-placeholder="Pilih Bangsal">
                                <option value="" selected> Pilih  </option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="pull-right">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary btn-square" id="btnCancel">Tutup</button>
                            <span>&nbsp;</span>
                            <button type="button" class="btn btn-warning btn-square d-none" id="btnReset">Reset</button>
                            <input id="reset" type="hidden" name="is_reset" value="0">
                            <span>&nbsp;</span>
                            <button type="button" class="btn btn-primary btn-square" id="searchBtn">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        {{-- <div class="table-responsive"> --}}
            <table class="table table-bordered table-striped table-vcenter" id="transaksi_farmasi" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Pasien</th>
                        <th>No Resep</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        {{-- </div> --}}
    </div>
</div>
    
    @include('farmasi.transaksi.modals.transaksi-baru')
    @if(session('farmasi')->kemoterapi)
    @include('farmasi.transaksi.modals.transaksi-baru-kemoterapi')
    @endif
    @include('farmasi.transaksi.modals.analisa-resep-index')
    @include('farmasi.transaksi.modals.modal-print-resep-index')
    @include('farmasi.transaksi.modals.modal-panggil-antrian')
@endsection

@section('js')
    @include('farmasi.transaksi.modals.components.dokter-js')
    @include('farmasi.transaksi.js.paket-js')
    <script type="text/javascript" src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.pagination-input.js')}}"></script>
    @include('farmasi.js-features.histori-resep.js')
    @include('farmasi.transaksi.js.js-index')
    @include('farmasi.transaksi.js.js-datatable')
    @if(session('farmasi')->kemoterapi)
    @include('farmasi.transaksi.js.transaksi-baru-kemoterapi-js')
    @endif
@endsection