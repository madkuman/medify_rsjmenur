@extends('kasir.layouts.main')
@section('title')
Histori Transaksi - {{$kasir->nama}} - Kasir
@endsection

@section('css')

<style>
    .dataTables_processing {
        background-color: white;
    }
</style>
@endsection
@section('content')
@include('kasir.transaksi.components.header')
<!-- Page Content -->

<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-header block-header-default py-20">
                <span><h4 class="mb-0">History Transaksi Tagihan</h4><hr></span>
            </div>
            <input type="text" class="d-none" id="idkasir" value="{{$kasir->id}}">
            <div class="row p-20">
                <div class="col-2" id="by-date-start">
                    <label for="example-datepicker1">Tanggal Start</label>
                    <input type="text" autocomplete="off" class="js-datepicker form-control" id="tanggaltransaksi_start" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd MM yyyy" placeholder="Masukkan Tanggal" value="">
                </div>
                <div class="col-2" id="by-date-end">
                    <label>Tanggal End</label>
                    <input type="text" autocomplete="off" class="js-datepicker form-control" id="tanggaltransaksi_end" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd MM yyyy" placeholder="Masukkan Tanggal" value="">
                </div>
                <div class="col-2" id="by-date-button">
                    <label>&nbsp;</label><br>
                    <button id="buttonRefresh" style="margin-bottom: 5px;" url="" class="btn btn-md btn-alt-primary" data-toggle="tooltip" title="Refresh Transaksi">
                        <i class="fa fa-refresh"></i>
                    </button>
                </div>
            </div>

            <div class="block-content py-20">
                <table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="transaksiTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">No. Tagihan  </th>
                            <th class="text-center" style="width: 15%;">Pasien  </th>
                            <th class="text-center" style="width: 10%;">Asal Layanan  </th>
                            <th class="text-center" style="width: 20%;">Judul  </th>
                            <th class="text-center" style="width: 15%;">Total Tagihan  </th>
                            <th class="text-center" style="width: 10%;">Tanggal Tagihan  </th>
                            <th class="text-center" style="width: 15%;">Aksi </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('kasir.transaksi.components.history-js')
<script type="text/javascript">
    var kasir_id = {{$kasir->id}}
</script>

<!-- <script src="{{asset('js/kasir/tagihan/historyv1.2.js')}}"></script> -->

@endsection