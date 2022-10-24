@extends('keuangan.layouts.main')

@section('title')
Daftar Tagihan & Piutang - Keuangan
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/datatables.min.css')}}"/>
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

<div class="row gutters-tiny">
    <div class="col-xl-6">
        <div class="block block-link-shadow text-right">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10">
                    <i class="si si-bag fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600">{{$piutang_num}}</div>
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
                <div class="font-size-h3 font-w600">Rp {{number_format($piutang_total,0)}}</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">Total Piutang</div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-header py-20">
                <span><h4 class="mb-0">Tagihan & Piutang Belum Terbayar</h4>
                </span>
                <input type="text" class="d-none" id="today" value="{{date('d F Y', strtotime($today))}}">
                <div class="block-options" style="margin-bottom:0">
                    <a href="{{url()->current()}}/baru" class="btn btn-sm btn-primary btn-hero">
                        <i class="fa fa-plus"></i> Buat Tagihan / Piutang
                    </a>
                </div>
            </div>
            <div class="block-content py-20">
                <div class="row">
                    @include('keuangan.piutang.components.filter')
                    <div class="col-12">
                        <hr>
                    </div>
                </div>
                <div class="">
                    <table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="transaksiTable">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 1%;">#  </th>
                                <th class="text-left" style="width: 23%;">Judul  </th>
                                <th class="text-left" style="width: 15%;">Debitur  </th>
                                <th class="text-center" style="width: 10%;">Tanggal  </th>
                                <th class="text-right" style="width: 12%;">Lokasi  </th>
                                <th class="text-right" style="width: 12%;">Total  </th>
                                <th class="text-center" style="width: 25%;">Aksi  </th>
                                <th class="text-center" style="width: 2%;">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" id="btnGroupDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilihan</button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <button class="btn btn-block btn-sm btn-info" id="buttonSubmitRekap" data-toggle="tooltip" title="Centang Transaksi untuk Penagihan"><i class="fa fa-check"></i> Penagihan</button>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal bayar -->
<div id="modal_penagihan" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed">
                <div class="block-header bg-primary">
                    <h5 class="block-title">Masukkan Akun Rekening</h5>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                    </div>
                </div>
                <div class="block-content">

                    <div class="row mb-20">
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">Akun Rekening</h5>
                        </div>
                        <div class="col-md-7">
                            <select class="js-select2 form-control" id="akun" name="akun" style="width: 100%;" data-placeholder="Pilih Akun Rekening">
                                @foreach($akun as $a)
                                    <option value="{{$a->id}}">{{$a->nama}} - {{$a->no_rekening}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class=" col-md-5 font-w700" style="width:50%; margin-bottom:2rem;">
                            <input type="text" class="d-none" id="id_piutang" value="">
                            <button class="btn btn-primary btn-hero" id="submit_penagihan"><i class="fa fa-check"></i> Kirim Penagihan</button>
                            <button class="btn btn-alt-primary btn-hero" style="display: none; width:100%" id="buttonLoading">
                                <i class="fa fa-asterisk fa-spin"></i> Loading
                            </button>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
var lokasi_rj = JSON.parse('{!! json_encode($lokasi_rj) !!}')
var lokasi_ri = JSON.parse('{!! json_encode($lokasi_ri) !!}')
var dep_rj = "{{$rawat_jalan}}"
var dep_ri = "{{$rawat_inap}}"
$("#kategori_date").select2();
var filter = "unpaid";
var asal_layanan;
var transaksiIdSerial;
var lokasi_selected = 'all';
</script>
@include('keuangan.piutang.components.js')
<script src="{{URL::to('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::to('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

@endsection