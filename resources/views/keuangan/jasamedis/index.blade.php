@extends('keuangan.layouts.main')

@section('title')
Jasa Medis - Keuangan
@endsection

@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
.pink {
  background-color: pink !important;
}
</style>
@endsection
@section('content')
@include('keuangan.piutang.components.header')


<div class="row">
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-header py-20">
                <span><h4 class="mb-0">Jasa Medis Belum Terbayar</h4><hr>
                <input type="text" class="d-none" id="today" value="{{date('d F Y', strtotime($today))}}">
                <div class="block-options">
                    <a href="{{url()->current()}}/baru" class="btn btn-sm btn-primary btn-hero">
                        <i class="fa fa-plus"></i> Buat Piutang
                    </a>
                </div>
            </div>
            <div class="block-content py-20">
                <table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="transaksiTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;">#</th>
                            <th class="text-right" style="width: 200px;">Tanggal</th>
                            <th class="text-left" style="width: 250px;">User/Grup</th>
                            <th class="text-center" style="width: 200px;">Deskripsi</th>
                            <th class="text-center" style="width: 200px;">Jumlah</th>
                            <th class="text-center" style="width: 15%;">
                                <button class="btn btn-success" id="buttonSubmit" data-toggle="tooltip" title="Centang Transaksi untuk Bayar"><i class="fa fa-check"></i> Bayar</button>
                            </th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal bayar -->
<div id="confirmPayment" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed">
                <div class="block-header bg-primary">
                    <h5 class="block-title">Masukkan Jumlah Pembayaran</h5>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                    </div>
                </div>
                <div class="block-content">
                    
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">Belum Terbayar</h5>
                        </div>
                        <div class="col-md-1">
                        <h5 style="margin-bottom:0">Rp</h5>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="d-none" id="bill" value="">
                            <h5 style="margin-bottom:0" id="allTotal"></h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group align-items-center">
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">Pembayaran</h5>
                        </div>
                        <div class="col-md-1">
                        <h5 style="margin-bottom:0">Rp</h5>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control"  id="input-paid" name="example-nf-password" placeholder="Masukkan Pembayaran..">
                            <!-- <input type="text" class="d-none" id="input-paid">  
                            <a href="#" class="input-paid h5" data-type="text" data-placeholder="Masukkan Pembayaran.."></a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class=" col-md-5 font-w700" style="width:50%; margin-bottom:2rem;">
                    <input type="text" class="d-none" id="id_piutang" value="">
                    <button class="btn btn-primary btn-hero" id="buttonPay" disabled><i class="fa fa-check"></i> Terima Pembayaran</button>
                    <button class="btn btn-alt-primary btn-hero" style="display: none; width:100%" id="buttonLoading">
                        <i class="fa fa-asterisk fa-spin"></i> Loading
                    </button>
                </div>
            </div>
        </div>
    </div>        
</div>
@endsection

@section('js')
<script src="{{asset('js/keuangan/jasa-medis/index.js')}}"></script>


@endsection