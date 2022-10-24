@extends('layouts.main2')
@section('title')
Laboratorium Patologi Anatomi
@endsection
@section('css')
@include('labpa.layouts.css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/basic.css')}}">
<style type="text/css">
.tambah{
    position: relative;
    padding: 10px;
    margin-top: 10px;
    width: 25%;
    height: 170px;
    border-radius: 2%;
    display: block;
    float: left;
    background-color: #dedede;
    },
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

    .ml-60 {
        margin-left: 60px;
    }

    .ml-90 {
        margin-left: 90px;
    }
    .disabled-div {
        pointer-events: none;
        opacity: 0.4;
        background: gainsboro;
    }
</style>
@endsection
@section('content')
@include('labpa.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Transaksi #{{$transaksi->id}}</h3>
        </div>
        <div class="block-content pb-20">
            <div class="row px-15">
                @include('layouts.components2.lab.biodata-pasien-lab')
                <div class="col-5 mb-10 content-box">
                    <p class="h5 my-0 mb-10">PERMINTAAN PEMERIKSAAN</p>
                    <table>
                        @foreach($transaksi->detail as $detail)
                        <tr>
                            <td>{{$detail->tarif->deskripsi}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group">
                    <br><hr>
                    <p class="h5 my-0 mb-10">PEMERIKSAAN</p>
                    <form action="{{url('labpa/upload/gambar')}}" id="my-dropzone" method="POST" class="dropzone">
                        <input type="hidden" name="saltPict" value="{{$key}}">
                        <input type="hidden" name="fileNumber" value="0" id="fileNumber">
                        <input type="hidden" name="target" value="{{$transaksi->slug}}">
                        {{csrf_field()}}
                    </form>
                </div>
                <form action="{{url('labpa/transaksi/periksa')}}" id="periksaForm" method="POST">
                    <div class="col-12 form-group">
                        <br><p class="h5 my-0 mb-10">HASIL BACA PEMERIKSAAN</p>
                        {{csrf_field()}}
                        <input type="hidden" name="saltForm" value="{{$key}}">
                        <input type="hidden" name="transaction_slug" value="{{$transaksi->slug}}">
                        <textarea class="form-control tinymce" name="summary" rows="6" placeholder="Masukkan Hasil Pemeriksaan disini..."></textarea>
                    </div>
                    <br>
                    <div style="display: none;" id="fileDetailsTarget">

                    </div>
                    <div class="col-12">
                        <br><p class="h5 my-0 mb-10">VERIFIKASI PEMERIKSAAN</p>
                            @php $id = 1; @endphp
                            @foreach($transaksi->detail as $detail)
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <div class="custom-control custom-checkbox mb-5">
                                    <input class="custom-control-input akan-ditagih" name="layanan[]" id="example-checkbox{{$id}}" value="{{$detail->id}}" type="checkbox" data-harga="{{$detail->harga}}">
                                    <label class="custom-control-label" for="example-checkbox{{$id}}">{{$detail->tarif->deskripsi}}</label>
                                </div>
                                <input type="hidden" class="jumlah-periksa" value="1" name="jumlah_periksa[{{$detail->id}}]">
                            </div>
                            <div class="col-lg-4" >
                                <div class="col-md-12" style="margin-bottom: 6px;">
                                    <label></label>
                                </div>
                                <select class="form-control js-select2 select-form-layanan" style="width: 100%;" id="select2Form{{$detail->id}}" name="formDetail[{{$detail->id}}]" data-id="{{$detail->id}}">
                                    <option value="0" selected="">Pilih Form yang dibutuhkan</option>
                                    <option value="papsmear">Pap Smear</option>
                                    <option value="sitologi">Sitologi / FNA-B</option>
                                    <option value="aspirasi">Sitologi / Aspirasi</option>
                                    <option value="hispatologi">Hispatologi</option>
                                    <option value="vriescoupe">Vries Coupe</option>
                                    <option value="histopatologi">Histopatologi</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-2">
                                <p class="h6 my-0 mb-10">Jumlah Slide</p>              
                                <input type="text" name="slide[{{$detail->id}}]" placeholder="Masukkan Jumlah Slide disini" class="form-control">
                            </div>
                            <div class="col-sm-12 col-lg-2">
                                <p class="h6 my-0 mb-10">Lokasi</p>                                
                                <input type="text" name="lokasi[{{$detail->id}}]" class="form-control" placeholder="Masukkan Lokasi Disini">
                            </div>
                            <div class="col-sm-12 col-lg-2">
                                <p class="h6 my-0 mb-10">Kode Sediaan</p>
                                <input type="text" name="kode_sediaan[{{$detail->id}}]" class="form-control" placeholder="Masukkan Kode Pasien Disini">
                            </div>
                            <div class="col-sm-6 col-lg-2">
                                <div class="col-md-12" style="margin-bottom: 6px;">
                                    <label></label>
                                </div>
                                <div class="col-md-12 pb-10">
                                    <button class="btn btn-hero btn-alt-danger cancel-periksa" type="button" data-target="{{$detail->tarif->deskripsi}}" data-state="enabled" id="cancel-{{$detail->id}}" data-id="{{$detail->id}}">Batalkan</button>
                                </div>
                            </div>
                            <div id="formLayananDiv{{$detail->id}}" class="col-12 mb-10 mt-10">

                            </div>
                            </div>
                            @php $id++; @endphp
                            @endforeach
                        <hr>
                        <br><p class="h5 my-0 mb-10">TAMBAHAN PEMERIKSAAN</p>
                        <div class="form-group">
                            <div class="form-layanan">
                                <p>*Layanan harus ada pada kelas dan tipe yang dipilih</p>
                                <div class="row form-group single-layanan  layananBaru pb-10" id="layanan_0" data-index="0">
                                    <div class="col-md-6 mb-10">
                                        <select class="form-control new-layanan js-select2" id="layanan0" name="" style="width: 100%;" >
                                            <option value="0" selected="">Pilih layanan tambahan</option>
                                            @foreach($layanan as $row)
                                            <option value="{{$row->id}}">{{$row->deskripsi}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control js-select2 select-form-layanan" style="width: 100%;"  name="formDetailBaru[0]" data-id="Baru0">
                                            <option value="0" selected="">Pilih Form yang dibutuhkan</option>
                                            <option value="papsmear">Pap Smear</option>
                                            <option value="sitologi">Sitologi / FNA-B</option>
                                            <option value="hispatologi">Hispatologi</option>
                                            <option value="vriescoupe">Vries Coupe</option>
                                            <option value="histopatologi">Histopatologi</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <p class="h6 my-0 mb-10">Jumlah Slide</p>              
                                        <input type="text" placeholder="Masukkan Jumlah Slide disini" class="form-control new-slide">
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <p class="h6 my-0 mb-10">Lokasi</p>                                
                                        <input type="text" class="form-control new-lokasi" placeholder="Masukkan Lokasi Disini">
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <p class="h6 my-0 mb-10">Kode Sediaan</p>
                                        <input type="text" class="form-control new-kode-sediaan" placeholder="Masukkan Kode Pasien Disini">
                                    </div>
                                    <div id="formLayananDivBaru0" class="col-md-12 mb-10 mt-10">

                                    </div>
                                </div>
                            </div>
                            <button type="button" id="tambahBtn" class="btn btn-rounded btn-noborder btn-success" onclick="addForm();">
                                <i class="fa fa-plus mr-5"> Tambah</i>
                            </button>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-lg-6">
                                <p class="h5 my-0 mb-10">KETERANGAN</p>                                
                                <textarea class="form-control" rows="4" cols="50" placeholder="Tambahkan Keterangan Di Sini" name="info"></textarea>
                            </div>
                            <div class="form-group col-sm-12 col-lg-6">
                                <p class="h5 my-0 mb-10">DIAGNOSIS</p>
                                <textarea class="form-control" rows="4" cols="50" placeholder="Tambahkan Diagnosis Di Sini" name="diagnosis"></textarea>
                            </div>
                        </div>
                    </form>
                    <div class="pull-right">
                        <button id="submit-all" class="btn btn-hero btn-alt-primary" type="button" >Simpan Pemeriksaan</button>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.components2.lab.transaksi-creator')
    </div>

</div>
@include('layouts.components2.lab.save-pemeriksaan-modal')
@include('layouts.components2.lab.delete-pemeriksaan-modal')
@include('labpa.components.footer')
@endsection
@section('js')
<script src="{{ URL::asset('/plugins/tinymce/tinymce.min.js') }}" type="text/javascript" ></script> 
@include('labpa.transaksi.content.form-pemeriksaan-js')
@endsection('js')