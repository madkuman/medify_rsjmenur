@extends('keuangan.layouts.main')

@section('title')
Daftar Pemasukan - Keuangan
@endsection


@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
</style>
@endsection
@section('content')
@include('keuangan.pemasukan.components.header')

<div class="row gutters-tiny">
    <div class="col-xl-6">
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
    <div class="col-xl-6">
        <div class="block block-link-shadow text-right">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10">
                    <i class="si si-wallet fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600">Rp {{number_format($pemasukan_total,0)}}</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">Total Pemasukan</div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-header py-20">
                <span><h4 class="mb-0">Transaksi Pemasukan Hari Ini</h4><hr>
                <h5>{{date('d F Y', strtotime($today))}}</h5></span>
                <input type="text" class="d-none" id="today" value="{{date('d F Y', strtotime($today))}}">
                <div class="block-options">
                    <a href="{{url()->current()}}/baru" class="btn btn-sm btn-primary btn-hero">
                        <i class="fa fa-plus"></i> Buat Pemasukan
                    </a>
                </div>
            </div>
            <div class="block-content py-20">
                <table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="transaksiTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th class="text-left" style="width: 50%;">Judul</th>
                            <th class="text-left" style="width: 20%;">Debitur</th>
                            <th class="text-right" style="width: 15%;">Total</th>
                            <th class="text-center" style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('js/keuangan/pemasukan/indexv2.js')}}"></script>


@endsection