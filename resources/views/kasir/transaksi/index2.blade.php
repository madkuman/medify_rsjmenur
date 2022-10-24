@extends('kasir.layouts.main')

@section('title')
Daftar Transaksi - {{$kasir->nama}} - Kasir
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


<div class="row">
    <div class="col-6 col-xl-6">
        <a class="block block-link-pop text-right bg-primary" href="javascript:void(0)">
            <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                <div class="float-left mt-10 d-none d-sm-block">
                    <i class="si si-bar-chart fa-3x text-primary-light d-none"></i>
                </div>
                <div class="font-size-h4 font-w600 text-white">Rp {{number_format($num_bayar,0)}}</div>
                <div class="font-size-sm font-w600 text-uppercase text-white-op">Tagihan Terbayar</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-xl-6">
        <a class="block block-link-pop text-right bg-earth" href="javascript:void(0)">
            <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                <div class="float-left mt-10 d-none d-sm-block">
                    <i class="si si-trophy fa-3x text-earth-light d-none"></i>
                </div>
                <div class="font-size-h4 font-w600 text-white">Rp {{number_format($num_belum_bayar,0)}}</div>
                <div class="font-size-sm font-w600 text-uppercase text-white-op">Tagihan Belum Terbayar</div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-header block-header-default py-20">
                <span><h4 class="mb-0">Daftar Tagihan Belum Dibayar</h4><hr></span>
                <div class="block-options">
                    <a href="{{url()->current()}}/baru" class="btn btn-sm btn-primary btn-hero">
                        <i class="fa fa-plus"></i> Buat Invoice
                    </a>
                    <a href="{{url()->current()}}/dp-baru" class="btn btn-sm btn-primary btn-hero">
                        <i class="fa fa-plus"></i> Buat Pembayaran DP
                    </a>
                </div>
            </div>
            <input type="text" class="d-none" id="idkasir" value="{{$kasir->id}}">
            <div class="block-content py-20">
                <table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="transaksiTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">No. Tagihan  </th>
                            <th class="text-center" style="width: 20%;">Pasien  </th>
                            <th class="text-center" style="width: 20%;">Asal Layanan  </th>
                            <th class="text-center" style="width: 20%;">Judul  </th>
                            <th class="text-center" style="width: 20%;">Total Tagihan  </th>
                            <th class="text-center" style="width: 20%;">Tanggal Tagihan  </th>
                            <th class="text-center" style="width: 5%;">Aksi </th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')


<script src="{{asset('js/kasir/tagihan/indexv1.1.js')}}"></script>
@endsection