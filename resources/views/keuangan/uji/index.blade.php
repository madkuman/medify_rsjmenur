@extends('keuangan.layouts.main')

@section('title')
Daftar Uji - Keuangan
@endsection

@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
</style>
@endsection
@section('content')
@include('keuangan.uji.components.header')

<div class="row gutters-tiny">
    <div class="col-xl-4">
        <div class="block block-link-shadow text-right">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10">
                    <i class="si si-bag fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600">{{$pengeluaran_num}}</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">Transaksi UJI Hari Ini</div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="block block-link-shadow text-right">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10">
                    <i class="si si-wallet fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600">Rp {{number_format($pengeluaran_total,0)}}</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">Total UJI Hari Ini</div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="block block-link-shadow text-right">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10">
                    <i class="si si-wallet fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600">% {{number_format(($pengeluaran_total/$pengeluaran_rata*100)-100,2)}}</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">Naik dibanding rata rata</div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-header block-header-default py-20">
                <h4 class="mb-0">Transaksi UJI</h4><hr>
                <div class="block-options">
                    <a href="{{url()->current()}}/baru" class="btn btn-sm btn-primary btn-hero pull-right">
                        <i class="fa fa-plus"></i> Buat UJI
                    </a>
                </div>
            </div>
            <div class="block-content py-20">
                <table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="transaksiTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">Nota  </th>
                            <th class="text-center" style="width: 200px;">Tgl.Tran  </th>
                            <th class="text-center" style="width: 50px;">PJK </th>
                            <th class="text-center" style="width: 200px;">Jumlah  </th>
                            <th class="text-center" style="width: 200px;">Pengadaan Brg  </th>
                            <th class="text-right" style="width: 200px;">Bebas PPN  </th>
                            <th class="text-right" style="width: 200px;">Kena PPN </th>
                            <th class="text-right" style="width: 200px;">Jasa  </th>
                            <th class="text-right" style="width: 300px;">Aksi </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('keuangan.uji.components.index-js')
{{-- <script src="{{asset('js/keuangan/pengeluaran/uji/index3.js')}}"></script> --}}


@endsection