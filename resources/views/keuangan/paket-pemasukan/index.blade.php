@extends('keuangan.layouts.main')

@section('title')
Daftar Penerimaan - Keuangan
@endsection


@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
</style>
@endsection
@section('content')
@include('keuangan.paket-pemasukan.components.header')

<div class="row gutters-tiny">
    <div class="col-xl-4">
        <div class="block block-link-shadow text-right">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10">
                    <i class="si si-bag fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600">{{$pemasukan_num}}</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">Transaksi</div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="block block-link-shadow text-right">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10">
                    <i class="si si-wallet fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600">Rp {{number_format($pemasukan_total,0)}}</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">Total Penerimaan</div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="block block-link-shadow text-right">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10">
                    <i class="si si-wallet fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600">% {{number_format(($pemasukan_total/$pemasukan_rata*100)-100,2)}}</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">Naik dibanding rata rata</div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-header py-20">
                <span><h4 class="mb-0">Transaksi Penerimaan Hari Ini</h4><hr>
                <h5>{{date('d F Y', strtotime($today))}}</h5></span>
                <input type="text" class="d-none" id="today" value="{{date('d F Y', strtotime($today))}}">
            </div>
            <div class="block-content py-20">
                <table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="transaksiTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;">#  </th>
                            <th class="text-left" style="width: 250px;">Judul  </th>
                            <th class="text-center" style="width: 200px;">Jam  </th>
                            <th class="text-right" style="width: 200px;">Total  </th>
                            <th class="text-center" style="width: 15%;">Aksi  </th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('keuangan.paket-pemasukan.components.index-js')


@endsection