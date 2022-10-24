@extends('keuangan.layouts.main')

@section('title')
SPP Histori - Keuangan
@endsection

@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
</style>
@endsection
@section('content')
@include('keuangan.spp.components.header')
@include('keuangan.spp.components.pilih-ttd')
<div class="row">
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-header py-20">
                <h4 class="mb-0">History Transaksi SPP</h4>
            </div>
            <div class="block-content py-20">    
                <div class="row">
                    <div class="col-3">
                        <label>Tampilkan</label>
                        <select class="js-select2 form-control" id="kategori" name="kategori" style="width: 100%;">
                            <option value="1" selected>All Data</option>
                            <option value="2">Terbayar</option>
                            <option value="3">Belum Terbayar</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label></label>
                        <select class="js-select2 form-control" id="kategori_date" name="kategori_date" style="width: 100%;">
                            <option value="1" selected>All Date</option>
                            <option value="2">By Date</option>
                        </select>
                    </div>
                    <div class="col-2" id="by-date-start" style="display:none">
                        <label for="example-datepicker1">Tanggal Start</label>
                        <input type="text" class="js-datepicker form-control" id="tanggaltransaksi_start" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd MM yyyy" placeholder="Masukkan Tanggal" value="">
                    </div>
                    <div class="col-4" id="by-date-end" style="display:none">
                        <label for="example-datepicker1">Tanggal End</label>
                        <div class="row">
                        <div class="col-6">
                            <input type="text" class="js-datepicker form-control" id="tanggaltransaksi_end" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd MM yyyy" placeholder="Masukkan Tanggal" value="">
                        </div>
                        <div class="col-2" style="padding-left:0">
                            <button id="buttonRefresh" style="margin-bottom: 5px;" url="" class="btn btn-md btn-alt-primary" data-toggle="tooltip" title="Refresh Transaksi">
                                <i class="fa fa-refresh"></i>
                            </button>
                        </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr>                
                    </div> 
                    <div class="col-12" id="tabel">
                        <table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="transaksiTable">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 100px;">SPP</th>
                                    <th class="text-center" style="width: 200px;">PJK  </th>
                                    <th class="text-center" style="width: 200px;">Tanggal SPP  </th>
                                    <th class="text-center" style="width: 200px;">Rekanan  </th>
                                    <th class="text-center" style="width: 200px;">Jumlah  </th>
                                    <th class="text-right" style="width: 350px;">Aksi </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('keuangan.spp.components.history-js')
{{--<script src="{{asset('js/keuangan/pengeluaran/spp/history3.js')}}"></script>--}}


@endsection