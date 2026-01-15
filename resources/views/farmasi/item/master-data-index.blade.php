@extends('farmasi.layouts.main')

@section('title')
    Master Data Farmasi
@endsection


@section('content')
    <div class="row">
        <div class="col-3"><a class="block" href="{{ url('farmasi/' . session('farmasi')->slug . '/kategori') }}">
                <div class="block-content"><i class="fa fa-fw fa-columns mr-5"></i> Kategori Barang</div>
            </a></div>
        <div class="col-3"><a class="block" href="{{ url('farmasi/' . session('farmasi')->slug . '/sumber-dana') }}">
                <div class="block-content"><i class="fa fa-fw fa-money mr-5"></i> Sumber Dana</div>
            </a></div>
        <div class="col-3"><a class="block" href="{{ url('farmasi/' . session('farmasi')->slug . '/katalog') }}">
                <div class="block-content"><i class="fa fa-fw fa-book mr-5"></i> Katalog</div>
            </a></div>
        <div class="col-3"><a class="block" href="{{ url('farmasi/' . session('farmasi')->slug . '/master-rak-obat') }}">
                <div class="block-content"><i class="fa fa-fw fa-arrows mr-5"></i> Master Rak Obat</div>
            </a></div>
        <div class="col-3"><a class="block"
                href="{{ url('farmasi/' . session('farmasi')->slug . '/master-bahan-aktif') }}">
                <div class="block-content"><i class="fa fa-fw fa-cubes mr-5"></i> Master Bahan Aktif</div>
            </a></div>
        <div class="col-3"><a class="block" href="{{ url('farmasi/' . session('farmasi')->slug . '/master-rute') }}">
                <div class="block-content"><i class="fa fa-fw fa-arrows mr-5"></i> Master Rute</div>
            </a></div>
        <div class="col-3"><a class="block"
                href="{{ url('farmasi/' . session('farmasi')->slug . '/master-jenis-interaksi') }}">
                <div class="block-content"><i class="fa fa-fw fa-handshake mr-5"></i> Master Jenis Interaksi</div>
            </a></div>
        <div class="col-3"><a class="block"
                href="{{ url('farmasi/' . session('farmasi')->slug . '/master-satuan-kekuatan') }}">
                <div class="block-content"><i class="fa fa-fw fa-balance-scale mr-5"></i> Master Satuan Kekuatan</div>
            </a></div>
        <div class="col-3"><a class="block"
                href="{{ url('farmasi/' . session('farmasi')->slug . '/master-kode-rekening') }}">
                <div class="block-content"><i class="fa fa-fw fa-bank mr-5"></i> Master Kode Rekening</div>
            </a></div>
        <div class="col-3"><a class="block"
                href="{{ url('farmasi/' . session('farmasi')->slug . '/master-kode-bidang') }}">
                <div class="block-content"><i class="fa fa-fw fa-cubes mr-5"></i> Master Kode Bidang</div>
            </a></div>
        <div class="col-3"><a class="block" href="{{ url('farmasi/' . session('farmasi')->slug . '/master-kfa') }}">
                <div class="block-content"><i class="fa fa-fw fa-cubes mr-5"></i> Master KFA</div>
            </a></div>
    </div>
@endsection

@section('js')
@endsection
