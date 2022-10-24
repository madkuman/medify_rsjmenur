@extends('bpjs.layouts.main')

@section('title')
Piutang Asuransi- BPJS
@endsection

@section('subtitle')
Piutang Asuransi
@endsection

@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
.pink {
  background-color: pink !important;
}
</style>
@endsection
@section('content')

<main id="main-container">
    @include('bpjs.layouts.navbar')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded">
                    <div class="block-header py-20">
                        <span><h4 class="mb-0">Tagihan & Piutang Belum Terbayar</h4>
                        </span>
                        <a class="btn-alt btn-primary float-right" href="{{url('bpjs/monitoring/data-klaim')}}"><i class="fa fa-desktop"></i> Monitoring Klaim</a>
                        <input type="text" class="d-none" id="today" value="{{date('d F Y', strtotime($today))}}">

                    </div>
                    <div class="block-content py-20">
                        <div class="row">
                            <div class="col-2">
                                <label>Asal</label>
                                <select class="js-select2 form-control" id="asal_dropdown" style="width: 100%;">
                                    <option value="" selected>Semua</option>
                                    <option value="{{$rawat_inap}}">Rawat Inap</option>
                                    <option value="{{$rawat_jalan}}">Rawat Jalan</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <label>Status File</label>
                                <select class="js-select2 form-control" id="file_dropdown" style="width: 100%;">
                                    <option value="" selected>Semua</option>
                                    <option value="1">Siap</option>
                                    <option value="0">Belum</option>
                                </select>
                            </div>
                        <div class="col-3">
                            <label>Perusahaan</label>
                            <select class="js-select2 form-control" multiple id="perusahaan_dropdown" name="perusahaan_id" style="width: 100%;">
                                <option value="all">Semua</option>
                                @foreach($perusahaan as $item)
                                <option value="{{$item->id}}" @if($item->is_bpjs == 1) selected @endif>{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                                <label>Tampilkan</label>
                                <select class="js-select2 form-control" id="kategori_date" name="kategori_date" style="width: 100%;">
                                    <option value="1" selected>All Date</option>
                                    <option value="2">By Date</option>
                                </select>
                            </div>
                            <div class="col-2" id="by-date-start" style="display:none">
                                <label for="example-datepicker1">Tanggal Start</label>
                                <input type="text" class="js-datepicker form-control" id="tanggaltransaksi_start" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd MM yyyy" placeholder="Masukkan Tanggal" value="" autocomplete="off">
                            </div>
                            <div class="col-2" id="by-date-end" style="display: none">
                                <label>Tanggal End</label>
                                <input type="text" class="js-datepicker form-control" id="tanggaltransaksi_end" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd MM yyyy" placeholder="Masukkan Tanggal" value="" autocomplete="off">

                            </div>
                            <div class="col-2" id="by-date-button">
                                <label>&nbsp;</label><br>
                                <button id="buttonRefresh" style="margin-bottom: 5px;" url="" class="btn btn-md btn-alt-primary" data-toggle="tooltip" title="Refresh Transaksi">
                                    <i class="fa fa-refresh"></i> Filter
                                </button>
                            </div>
                            <div class="col-12">
                                <hr>                
                            </div>
                        </div> 
                        <div class="col-12">
                            <table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="transaksiTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 1%;">SEP  </th>
                                        <th class="text-left" style="width: 23%;">Judul  </th>
                                        <th class="text-left" style="width: 15%;">Debitur  </th>
                                        <th class="text-center" style="width: 10%;">TGL KRS</th>
                                        <th class="text-right" style="width: 12%;">Total  </th>
                                        <th class="text-right" style="width: 12%;">Terbayar  </th>
                                        <th class="text-center" style="width: 2%;">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" id="btnGroupDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilihan</button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <button class="btn btn-block btn-sm btn-info" id="buttonSubmitRekap" data-toggle="tooltip" title="Centang Transaksi untuk Penagihan"><i class="fa fa-check"></i> Penagihan</button> <button class="btn btn-block btn-sm btn-info" id="buttonCheckPage" data-toggle="tooltip" title="Centang transaksi untuk halaman ini"><i class="fa fa-check"></i> Centang Halaman</button>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

@include('keuangan.piutang.components.modal-akun-penagihan')
@endsection

@section('js')
@include('bpjs.piutang.components.index-js')


@endsection