@extends('layouts.main2') 
@section('title') Hasil Pemeriksaan Transaksi #{{$transaksi->id}} @endsection 
@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/basic.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/lightgallery.css')}}">
<style type="text/css">
.four-col {
    width: 210px;
    height: 210px;
    object-fit: cover;
    border-radius: 2%;
}

.katalog {
    /*border-style: solid;*/
    position: relative;
    padding: 10px;
    width: 25%;
    height: auto;
    display: block;
    border-radius: 5%;
    float: left;
}

.tambah {
    position: relative;
    padding: 10px;
    margin-top: 10px;
    width: 25%;
    height: 170px;
    border-radius: 2%;
    display: block;
    float: left;
    background-color: #dedede;
}

,
input[type="file"] {
    display: none;
}

.custom-file-upload {
    position: relative;
    padding: 10px;
    margin-top: 10px;
    width: 25%;
    height: 170px;
    border-radius: 2%;
    display: inline-block;
    float: left;
    background-color: #dedede;
    cursor: pointer;
}
</style>
@endsection @section('content') @include('labpk.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Transaksi #{{$transaksi->id}}</h3>
            @if($transaksi->status != -1)
                <span class="pull-right">
                    <a class="btn btn-secondary" href="{{url('labpk/transaksi/edit/'.$transaksi->slug)}}"><i class="fa fa-pencil"></i>&nbsp&nbsp&nbspEdit</a>
                </span>
            @endif
        </div>
        <div class="block-content pb-20">
            <div class="row" style="padding-left: 2%">
                @include('layouts.components2.lab.biodata-pasien-lab')
                @include('layouts.components2.lab.permintaan-pemeriksaan')

            </div>

            <div class="row">
                <div class="col-12">
                    <hr>
                    <p class="h6 my-0 mb-10">PERMINTAAN PEMERIKSAAN</p>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">No.</th>
                                <th style="width: 70%;">Layanan</th>
                                <th class="text-right text-center" style="width: 30%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi->detail as $key => $detail)
                            <tr>
                                <td class="text-center">{{$key+1}}</td>
                                <td>
                                    <p class="font-w600 mb-5">{{$detail->tarif->deskripsi}}
                                        @if($detail->keterangan_result == 'kritis') 
                                            <span class="badge badge-danger">Kritis</span>
                                        @elseif($detail->keterangan_result == 'bahaya') 
                                            <span class="badge badge-warning">Abnormal</span>
                                        @endif
                                    </p>
                                </td>
                                <td class="text-center">
                                    @if($detail->status == "done" && count($detail->hasil)  == 0)
                                    <button disabled type="button" class="btn btn-secondary">Tidak Tersedia</button>
                                    @elseif($detail->status == "done")
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalHasil{{$detail->id}}">Lihat Hasil</button>
                                    @else
                                    <button disabled type="button" class="btn btn-secondary">Belum Diperiksa</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    @php $total_spesimen = count($transaksi->spesimen) ?? 0 @endphp
                    @if($total_spesimen > 0)
                    <p class="h6 my-0 mb-10">DAFTAR SPESIMEN</p>
                    <ul>
                        @foreach($transaksi->spesimen as $spesimen)
                        <li>
                            {{$spesimen->spesimen->kategori->nama}} - {{$spesimen->spesimen->nama}}
                            @if(!empty($spesimen->keterangan))
                            : {{$spesimen->keterangan}}
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                @include('layouts.components2.lab.lightgallery-hasil')

                <div class="col-12">
                    <div>
                        <p class="h6 my-0 mb-10">PEMERIKSAAN YANG DILAKUKAN </p>
                    </div>
                    <div>
                        <ul>
                            @foreach($transaksi->detail as $detail) @if($detail->status != "ask")
                            <li>
                                <p class="font-w600 mb-5">{{$detail->tarif->deskripsi}} &nbsp&nbsp&nbsp <span style="font-weight: 400;">- {{$detail->qty}} kali</span></p>
                            </li>
                            @endif @endforeach
                        </ul>
                        <br>
                    </div>
                </div>
                <div class="col-12 form-group">
                    <div>
                        <p class="h6 my-0 mb-10">GOLONGAN DARAH </p>
                    </div>
                    <div>
                        {{$transaksi->gol_darah}}
                    </div>
                </div>
                <div class="col-12 form-group">
                    <div>
                        <p class="h6 my-0 mb-10">DIAGNOSIS </p>
                    </div>
                    <div>
                        {{is_null($transaksi->diagnosis) ? '-' : $transaksi->diagnosis}}
                    </div>
                </div>
                <div class="col-12">
                    <div>
                        <p class="h6 my-0 mb-10">INFEKSI BAKTERI </p>
                    </div>
                    <div>
                        <ul>
                            <li>
                                <p class="font-w600 mb-5">
                                    Infeksi Bakteri MDR 
                                    <span style="font-weight: 400;"> - @if(is_null($transaksi->infeksi_mdr)) Tidak @endif Terjadi Infeksi</span>
                                </p>
                            </li>
                            <li>
                                <p class="font-w600 mb-5">
                                    Infeksi Bakteri Karbapenemasemase 
                                    <span style="font-weight: 400;"> - {{$transaksi->infeksi_karbapenemase}}</span>
                                </p>
                            </li>
                            <li>
                                <p class="font-w600 mb-5">
                                    Infeksi Bakteri ESBL 
                                    <span style="font-weight: 400;"> - {{$transaksi->infeksi_esbl}}</span>
                                </p>
                            </li>
                            <li>
                                <p class="font-w600 mb-5">
                                    Infeksi Bakteri Staphylococcus Aureus 
                                    <span style="font-weight: 400;"> - @if(is_null($transaksi->infeksi_aureus)) Tidak @endif Terjadi Infeksi</span>
                                </p>
                            </li>
                        </ul>
                        <br>
                    </div>
                </div>
                @if($has_transfusi)
                    @include('layouts.components2.lab.bukti-penyerahan-darah')
                @endif
                @if($transaksi->status == -1)
                <div class="col-md-12 form-group">
                    <div>
                        <p class="h6 my-0 mb-10"><strong>ALASAN PENOLAKAN</strong></p>
                    </div>
                    <div>
                        {{$transaksi->alasan_batal}}
                    </div>
                </div>
                @endif
            </div>
            @include('layouts.components2.lab.cetak-verifikasi')
            @include('layouts.components2.lab.pemeriksaan-oleh')
        </div>
    </div>
</div>

</div>
<form id="verificationForm" action="{{url()->current()}}/verifikasi" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="status" value="2">
</form>
@include('labpk.transaksi.content.pemeriksaan-modal-hasil') @include('labpk.transaksi.content.pemeriksaan-modal-tambah') @include('labpk.transaksi.content.save-confirmation-modal') @include('labpk.components.sep-modal') @include('labpk.components.footer') @endsection @section('js')
<script type="text/javascript">
    const CURRENT_URL = "{{url()->current()}}";
    const LAB_URL = "{{url($link)}}";

    $(document).ready(function() {
        @if(session('error'))
        swal('Gagal', '{{(session('
            error '))}}', 'error');
        @endif

    });
</script>
@include('layouts.components2.lab.hasil-js')
@endsection('js')