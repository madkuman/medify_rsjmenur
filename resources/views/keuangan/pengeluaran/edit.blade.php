@extends('keuangan.layouts.main')

@section('title')
BK Edit - Keuangan
@endsection

@section('content')
@include('keuangan.pengeluaran.components.header')

<!-- Page Content -->
<div class="block rounded">
    <div class="block-header">
        <h3 class="block-title">Edit BK</h3>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="d-none">
                <input type="text" class="d-none" id="idtransaksi" value="{{$pengeluaran->id}}">
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Tanggal Transaksi</label>
                <input type="text" class="js-datepicker form-control" id="tanggaltransaksi" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" value="{{date('d F Y', strtotime($pengeluaran->tanggal_transaksi))}}" disabled="true">
            </div>
            <div class="col-4">
                <label>Nota</label>
                <input type="text" class="form-control" id="nota" name="nota" value="{{$pengeluaran->id}}" disabled="true">
            </div>
            <div class="col-4">
                <label>SPP</label>
                <input type="text" class="form-control" id="nospp" name="nospp" value="{{$pengeluaran->spp->no_spp}}" disabled="true">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
                <label>No. PJK</label>
                <input type="text" class="form-control" id="nopjk" name="nopjk" value="{{$pengeluaran->spp->nomor_pjk}}" disabled="true">
            </div>
            <div class="col-4">
                <label>Jumlah</label>
                <input type="text" class="form-control" id="jumlah" name="jumlah" value="Rp. {{number_format($pengeluaran->total)}}" disabled="true">
            </div>
            <div class="col-4">
                <label>Rekanan</label>
                <select class="js-select2 form-control" id="perusahaan" name="perusahaan" style="width: 100%;" data-placeholder="Pilih Perusahaan" disabled="true">
                    <option value="{{$pengeluaran->spp->perusahaan_id}}" selected>{{$pengeluaran->spp->perusahaan->nama}}</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-4">
                <label>Akun Pembayaran</label>
                <select class="js-select2 form-control" id="akun" name="akun" style="width: 100%;" data-placeholder="Pilih Akun Rekening">
                    <option></option>
                    @foreach($akun as $item)
                    <option value="{{$item->id}}" @if($item->id == $pengeluaran->akun_id) selected @endif>{{$item->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Tanggal BK</label>
                <input type="text" class="js-datepicker form-control" id="tanggalbk" name="tanggalbk" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Auto" value="{{date('d-m-Y', time())}}">
            </div>
            <div class="col-4">
                <label>No. BK</label>
                <input type="text" class="form-control" id="nobk" name="nobk" autocomplete="off" value="{{$pengeluaran->bk->no_bk or ''}}">
            </div>
            <div class="col-12">
                <hr>                
            </div>
        </div>
        <div class="row pjk-detail">
            <div class="col-10"></div>
            <div class="col-2">
                <button class="btn btn-success btn-hero btn-block" id="buttonSubmit" type="button"><i class="fa fa-check"></i> Simpan</button>
                <button class="btn btn-alt-success btn-hero btn-block" style="display: none" id="buttonLoading">
                    <i class="fa fa-asterisk fa-spin"></i> Loading
                </button>
            </div>
        </div>
    </div>
</div>

<!-- END Page Content -->
@endsection

@section('js')
<script src="{{asset('js/keuangan/pengeluaran/edit3.js')}}"></script>
@endsection