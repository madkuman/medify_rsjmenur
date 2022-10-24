@extends('keuangan.layouts.main')

@section('title')
Laporan Pemasukan Harian - Keuangan
@endsection

@section('css')

@endsection
@section('content')
@include('keuangan.laporan.components.header')
<!-- Page Content -->   
<div class="mt-20">
    <div class="row">
        <div class="col-12">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Laporan Pemasukan - Rekap Pemasukan Harian</h5>
                </div>
                <div class="block-content block-content-full">
                    <form method="get" action="{{url()->current()}}/cetak">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Pilih Tanggal</label>
                                    <div class="input-daterange input-group" data-date-format="yyyy-mm-dd" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                        <input type="text" required class="form-control" id="tanggalMulai" name="start" autocomplete="off" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                        <div class="input-group-prepend input-group-append">
                                            <span class="input-group-text font-w600">to</span>
                                        </div>
                                        <input type="text" required class="form-control" id="tanggalAkhir" name="end" autocomplete="off" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Cetak</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection

@section('js')

@endsection