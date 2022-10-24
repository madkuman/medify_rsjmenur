@extends('keuangan.layouts.main')

@section('title')
Daftar SPP - Keuangan
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
<div class="row gutters-tiny">
    <div class="col-xl-4">
        <div class="block block-link-shadow text-right">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10">
                    <i class="si si-bag fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600">{{$spp_num}}</div>
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
                <div class="font-size-h3 font-w600">Rp {{number_format($spp_total,0)}}</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">Total SPP</div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="block block-link-shadow text-right">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10">
                    <i class="si si-wallet fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600">% {{number_format(($spp_total/$spp_rata*100)-100,2)}}</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">Naik dibanding rata rata</div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-header block-header-default py-20">
                <span><h4 class="mb-0">Transaksi SPP Belum Dibayar</h4><hr>
                </span>
                <div class="block-options">
                    <a href="{{url()->current()}}/baru" class="btn btn-sm btn-primary btn-hero">
                        <i class="fa fa-plus"></i> Buat SPP
                    </a>
                </div>
            </div>
            <div class="block-content py-20">
                <table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="indexTable">
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
@endsection

@section('js')
@include('keuangan.spp.components.index-js')
{{-- <script src="{{asset('js/keuangan/pengeluaran/spp/index5.js')}}"></script> --}}


@endsection