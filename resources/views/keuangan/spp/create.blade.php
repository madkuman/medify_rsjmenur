@extends('keuangan.layouts.main')

@section('title')
SPP Baru - Keuangan
@endsection

@section('content')
@include('keuangan.spp.components.header')

<!-- Page Content -->
<div class="block rounded">
    <div class="block-header">
        <h3 class="block-title">Buat SPP Baru</h3>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="d-none">
                <input type="text" class="d-none" id="idtransaksi" value="">
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Tanggal SPP</label>
                <input type="text" class="js-datepicker form-control" id="tanggalspp" name="tanggalspp" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Auto" value="{{date('d-m-Y', time())}}">
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-8">
                <label for="example-datepicker1">Nomor PJK</label>
                <select class="js-select2 form-control" id="nopjk" name="nopjk" style="width: 100%;" data-placeholder="Pilih No. PJK">
                    <option></option>
                    @foreach($pjk as $item)
                    <option value="{{$item->id}}">{{$item->nomor_pjk}} | {{$item->judul}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <div class="row pjk-detail" style="display: none;">
            <div class="col-4">
                <label for="example-datepicker1">Tanggal PJK</label>
                <input type="text" class="js-datepicker form-control" id="tanggaltransaksi" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Auto" value="{{date('d-m-Y', time())}}" disabled="true">
            </div>
            <div class="col-4" id="input-perusahaan-container">
                <label>Rekanan</label>
                <select class="js-select2 form-control" id="perusahaan" name="perusahaan" style="width: 100%;" data-placeholder="Auto" disabled="true">
                </select>
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Jumlah</label>
                <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Auto" disabled="true">
            </div>
        </div>
        <hr class="pjk-detail" style="display: none;">
        <div class="row pjk-detail" style="display: none;">
            <div class="col-4">
                <label for="example-datepicker1">Nomor Faktur</label>
                <input type="text" class="form-control" id="nofaktur" name="nofaktur" placeholder="Auto" disabled="true">
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Mengenai</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Auto" disabled="true">
            </div>
        </div>
        <br>
        <div class="row pjk-detail" style="display: none;">
            <div id="gambar-faktur" class="col-4">
                <label for="example-datepicker1">Gambar Faktur</label>
                <br>
                <img id="preview-gambar-faktur" src="" alt="" style="max-width: 300px; cursor: pointer;">
            </div>
        </div>
        <hr class="pjk-detail" style="display: none;">
        <div class="row pjk-detail" style="display: none;">    
            <div class="col-4">
                <label>Kategori/MA</label>
                <select class="js-select2 form-control" id="kategori" name="kategori" style="width: 100%;" data-placeholder="Pilih Kategori Transaksi">
                    <option></option>
                    @foreach($kategori as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Tahun Anggaran</label>
                <input type="text" class="form-control" id="tahunanggaran" name="tahunanggaran" placeholder="Masukkan Tahun Anggaran" value="TA. {{date('Y', time())}}">
            </div>
        </div>
        <br>
        <div class="row pjk-detail" style="display: none;">
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

<div class="modal" id="modal-preview-gambar-faktur" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Gambar Faktur</h3>
                </div>
                <div class="block-content">
                    <p style="text-align: center;"> <img id="modal-faktur" src="" alt="your image" style="max-width: 500px;"/></p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- END Page Content -->
@endsection

@section('js')
@include('keuangan.spp.components.create-js')
{{-- <script src="{{asset('js/keuangan/pengeluaran/spp/create.js')}}"></script> --}}
<script type="text/javascript">
        $('#preview-gambar-faktur').on('click', function(){
            $('#modal-preview-gambar-faktur').modal('show');
        });
    </script>
@endsection