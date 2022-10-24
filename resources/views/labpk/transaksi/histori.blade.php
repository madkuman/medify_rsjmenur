@extends('layouts.main2')
@section('title')
Histori Transaksi
@endsection
@section('css')

@endsection
@section('content')
@include('labpk.components.header')
<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Histori Transaksi</h3>
        </div>
        <div class="clearfix"></div>
        <div class="block-content">
            @include('layouts.components2.lab.filter-histori')
            <hr>
            <table class="table table-bordered table-striped table-vcenter no-footer" aria-describedby="DataTables_info" id="historiTable">
                <thead>
                    <tr style="text-align: center">
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">No. RM</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 27%;">Nama</th>
                        <th style="width: 9%">Jenis</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Tgl Selesai Pemeriksaan</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 9%;">Tgl Permintaan</th>
                        <th class="text-center" style="width: 10%;">Asal Layanan</th>
                        <th style="width: 27%">Daftar Layanan</th>
                        <th style="width: 9%">Total Harga</th>
                        <th style="width: 9%">Status</th>
                        <th style="width: 8%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@include('labpk.components.footer')
@endsection
@section('js')
@section('js')


@include('layouts.components2.lab.histori-js')
@endsection