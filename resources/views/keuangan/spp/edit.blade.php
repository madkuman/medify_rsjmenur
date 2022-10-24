@extends('keuangan.layouts.main')

@section('title')
Edit SPP - Keuangan
@endsection

@section('content')
@include('keuangan.spp.components.header')

<!-- Page Content -->
<div class="block rounded">
    <div class="block-header">
        <h3 class="block-title">Edit SPP</h3>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="d-none">
                <input type="text" class="d-none" id="idtransaksi" value="{{$spp->id}}">
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Nomor SPP</label>
                <input type="text" class="form-control" id="nospp" name="nospp" value="{{$spp->no_spp}}" disabled="true">
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Tanggal SPP</label>
                <input type="text" class="js-datepicker form-control" id="tanggalspp" name="tanggalspp" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Auto" value="{{date('d-m-Y', strtotime($spp->tanggal_spp))}}" disabled="true">
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-8">
                <label for="example-datepicker1">Nomor PJK</label>
                <select class="js-select2 form-control" id="nopjk" name="nopjk" style="width: 100%;" data-placeholder="Pilih No. PJK" disabled="true">
                    <option value="{{$spp->id}}" selected>{{$spp->nomor_pjk}} | {{$spp->judul}}</option>
                </select>
            </div>
        </div>
        <br>
        <div class="row pjk-detail">
            <div class="col-4">
                <label for="example-datepicker1">Tanggal PJK</label>
                <input type="text" class="js-datepicker form-control" id="tanggaltransaksi" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Auto" value="{{date('d-m-Y', strtotime($spp->tanggal_transaksi))}}" disabled="true">
            </div>
            <div class="col-4" id="input-perusahaan-container">
                <label>Rekanan</label>
                <select class="js-select2 form-control" id="perusahaan" name="perusahaan" style="width: 100%;" data-placeholder="Auto" disabled="true">
                    <option value="{{$spp->perusahaan_id}}" selected>{{$spp->perusahaan->nama}}</option>
                </select>
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Jumlah</label>
                <input type="text" class="form-control" id="jumlah" name="jumlah" value="Rp. {{number_format($spp->total)}}" disabled="true">
            </div>
        </div>
        <hr class="pjk-detail">
        <div class="row pjk-detail">
            <div class="col-4">
                <label for="example-datepicker1">Nomor Faktur</label>
                <input type="text" class="form-control" id="nofaktur" name="nofaktur" value="{{$spp->no_faktur}}" disabled="true">
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Mengenai</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{$spp->judul}}" disabled="true">
            </div>
        </div>
        <br>
        @if(!is_null($spp->photo_faktur))
        <div class="row pjk-detail">
            <div id="gambar-faktur" class="col-4">
                <label for="example-datepicker1">Gambar Faktur</label>
                <br>
                <img id="preview-gambar-faktur" src="{{url($spp->photo_faktur)}}" alt="" style="max-width: 300px; cursor: pointer;">
            </div>
        </div>
        @endif
        <hr class="pjk-detail">
        <div class="row pjk-detail">    
            <div class="col-4">
                <label>Kategori/MA</label>
                <select class="js-select2 form-control" id="kategori" name="kategori" style="width: 100%;" data-placeholder="Pilih Kategori Transaksi">
                    <option></option>
                    @foreach($kategori as $item)
                    <option value="{{$item->id}}" @if($item->id == $spp->kategori_id) selected @endif>{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Tahun Anggaran</label>
                <input type="text" class="form-control" id="tahunanggaran" name="tahunanggaran" placeholder="Masukkan Tahun Anggaran" value="{{$spp->tahun_anggaran}}">
            </div>
        </div>
        <br>
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

@if(!is_null($spp->photo_faktur))
<div class="modal" id="modal-preview-gambar-faktur" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Gambar Faktur</h3>
                </div>
                <div class="block-content">
                    <p style="text-align: center;"> <img id="modal-faktur" src="{{url($spp->photo_faktur)}}" alt="your image" style="max-width: 500px;"/></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- END Page Content -->
@endsection

@section('js')
<script src="{{asset('js/keuangan/pengeluaran/spp/edit.js')}}"></script>
@endsection