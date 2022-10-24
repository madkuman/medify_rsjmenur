@extends('layouts.main2')
@section('title')
Edit Transaksi #{{$transaksi->id}}
@endsection
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
.katalog{
    /*border-style: solid;*/
    position: relative;
    padding: 10px;
    width: 25%;
    height: auto;
    display: block;
    border-radius: 5%;
    float: left;
}
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
    .delete-btn {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      background-color: #555;
      color: white;
      font-size: 16px;
      padding: 12px 24px;
      border: none;
      cursor: pointer;
      border-radius: 5px;
  }
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
    .ml-60 {
        margin-left: 60px;
    }
    .ml-90 {
        margin-left: 90px;
    }
</style>
@endsection
@section('content')
@include('labpk.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Edit Transaksi #{{$transaksi->id}}</h3>
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
                                <th class="text-center" style="width: 60px;"></th>
                                <th>Layanan</th>
                                <th class="text-right text-center" style="width: 200px;">Periksa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi->detail as $index => $detail)
                            <tr>
                                <td class="text-center">{{$index+1}}</td>
                                <td>
                                    <p class="font-w600 mb-5">{{$detail->tarif->deskripsi}}</p>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit{{$detail->id}}">Periksa</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @include('layouts.components2.lab.edit-photo-gallery')
                <div class="col-12 form-group">
                    <br><hr>
                    <p class="h6 my-0 mb-10">PEMERIKSAAN</p>
                    <form action="{{url($link.'/upload/gambar')}}" class="dropzone" id="my-dropzone" method="POST">
                        <input type="hidden" name="saltPict" value="{{$key}}">
                        <input type="hidden" name="fileNumber" value="0" id="fileNumber">
                        <input type="hidden" name="target" value="{{$transaksi->slug}}">
                        {{csrf_field()}}
                    </form>
                </div>
                <div class="col-12">

                    <form action="{{url('labpk/transaksi/edit/'.$transaksi->slug)}}" method="POST" id="periksaForm">
                        {{csrf_field()}}
                        <input type="hidden" name="saltForm" value="{{$key}}">
                        <div id="deleteDiv"></div>
                        <div class="col-12 form-group">
                            <br><p class="h6 my-0 mb-10">VERIFIKASI PEMERIKSAAN</p>
                            @php $id = 1; @endphp
                            @foreach($transaksi->detail as $detail)
                            @if($detail->status == "ask")
                            <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input akan-ditagih" name="layanan[]" id="example-checkbox{{$id}}" value="{{$detail->id}}" type="checkbox" data-harga="{{$detail->harga}}">
                                <label class="custom-control-label" for="example-checkbox{{$id}}">{{$detail->tarif->deskripsi}}</label>
                            </div>
                            @else
                            <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input" id="example-checkbox{{$id}}" value="{{$detail->id}}" type="checkbox" disabled="" checked="">
                                <input type="hidden" name="layanan[]" value="{{$detail->id}}">
                                <label class="custom-control-label" for="example-checkbox{{$id}}">{{$detail->tarif->deskripsi}}</label>
                            </div>
                            @endif
                            <input type="hidden" class="jumlah-periksa" value="{{$detail->qty}}" name="jumlah_periksa[{{$detail->id}}]">
                            @php $id++; @endphp
                            @endforeach
                        </div>
                        <div class="form-group col-12">
                            <p class="h5 my-0 mb-10">GOLONGAN DARAH (+Rhesus)</p>
                            <input type="form-control" class="form-control" rows="4" cols="50" placeholder="Tambahkan Detail Golongan Darah disini" name="gol_darah" value="{{$transaksi->gol_darah}}">
                        </div>
                        <div class="form-group col-12">
                            <p class="h5 my-0 mb-10">DIAGNOSIS</p>                                
                            <textarea class="form-control" rows="4" cols="50" placeholder="Tambahkan Diagnosis Di Sini" name="diagnosis"></textarea>
                        </div>
                        <hr>
                        <div class="form-group col-12">
                            <p class="h6 my-0 mb-10">INFEKSI BAKTERI MDR</p>
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input" name="infeksi_mdr" value="1" id="infeksi_mdr" @if($transaksi->infeksi_mdr) checked="" @endif>
                                <label class="custom-control-label" for="infeksi_mdr"> Terjadi Infeksi Bakteri MDR</label>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group col-12">
                            <p class="h6 my-0 mb-10">INFEKSI BAKTERI KARBAPENEMASE</p>
                            <select class="form-control js-select2" name="infeksi_karbapenemase">
                                @foreach($karbapenemase as $k)
                                <option value="{{$k}}" @if($transaksi->infeksi_karbapenemase == $k) selected @endif>{{$k}}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <div class="form-group col-12">
                            <p class="h6 my-0 mb-10">INFEKSI BAKTERI ESBL</p>
                            <select class="form-control js-select2" name="infeksi_esbl">
                                @foreach($esbl as $e)
                                <option value="{{$e}}" @if($transaksi->infeksi_karbapenemase == $e) selected @endif>{{$e}}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <div class="form-group col-12">
                            <p class="h6 my-0 mb-10">INFEKSI BAKTERI STAPHYLOCOCCUS AUREUS</p>
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input" name="infeksi_aureus" value="1" id="infeksi_aureus" @if($transaksi->infeksi_aureus) checked="" @endif>
                                <label class="custom-control-label" for="infeksi_aureus"> Terjadi Infeksi Bakteri Staphylococcus Aureus</label>
                            </div>
                        </div>
                        <hr>
                        @if($has_transfusi)
                            @include('labpk.transaksi.content.transfusi-input')
                        @endif

                        <div class="form-group col-12">
                            <p class="h5 my-0 mb-10">Analis</p>
                            <select class="form-control js-select2" name="result_created_by" data-placeholder="Pilih Analis" required>
                                @foreach($list_user as $user)
                                    <option value="{{$user->id}}" @if($user->id == $transaksi->result_created_by) selected @endif>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <p class="h5 my-0 mb-10">Dokter Verifikator</p>
                            <select class="form-control js-select2" name="verified_by" data-placeholder="Pilih Dokter Verifikator" required>
                                @foreach($list_user as $user)
                                    @if($user->profesi == $is_dokter)
                                        <option value="{{$user->id}}" @if($user->id == $transaksi->verified_by) selected @endif>{{$user->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="pull-right">
                            <button id="submit-all" class="btn btn-hero btn-alt-primary" type="button">Simpan Perubahan</button>
                        </div>
                        @include('labpk.transaksi.content.pemeriksaan-modal-edit')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.components2.lab.save-pemeriksaan-modal')
@include('labpk.transaksi.content.delete-transfusi-modal')
@include('layouts.components2.lab.delete-img-modal')
@include('labpk.components.sep-modal')
@include('labpk.components.footer')
@endsection

@section('js')
@include('layouts.components2.lab.dropzone-lab')
@include('labpk.transaksi.content.pemeriksaan-js')
<script type="text/javascript">
    $(document).ready(function(){
        $("#lightgallery").lightGallery({
            pager: true,
            zoom: true,
            actualSize: true,
            fullscreen: true,
            selector: '.photo-preview'
        });
    })
</script>
@endsection('js')