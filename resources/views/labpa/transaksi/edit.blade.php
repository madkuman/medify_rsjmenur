@extends('layouts.main2') @section('title') Laboratorium Patologi Anatomi @endsection @section('css')
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
.disabled-div {
    pointer-events: none;
    opacity: 0.4;
    background: gainsboro;
}
</style>
@endsection @section('content') @include('labpa.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Permintaan Transaksi #{{$transaksi['id']}}</h3>
        </div>

        <div class="block-content pb-20">
            <div class="row" style="padding-left: 2%">
                @include('layouts.components2.lab.biodata-pasien-lab')
                <div class="col-3" style="border-style: solid; margin-left: 30px; border-width: 1px; padding-left: 1%; padding-top: 1%">
                    <p class="h6 my-0 mb-10">PERMINTAAN PEMERIKSAAN</p>
                    <table>
                        @foreach($transaksi->detail as $detail)
                        <tr>
                            <td>{{$detail->tarif->deskripsi}}</td>
                        </tr>
                        @endforeach
                    </table>
                    <span class="badge badge-primary">{{$transaksi->pasien->typestring}}</span>
                    <br>
                </div>

                <div class="modal fade" id="modalConfirmationSEP" tabindex="-1" role="dialog" aria-labelledby="modalConfirmation" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="block block-themed block-transparent mb-0">
                                <div class="block-content">
                                    <form action="{{url('labpa/transaksi/sep/edit/'.$transaksi->slug)}}" method="POST">
                                        <h3>Ubah Nomor SEP</h3> {{csrf_field()}}
                                        <p>Masukkan Nomor SEP yang baru</p>
                                        {{ Form::label('tanggal_periksa', 'Nomor SEP baru')}}
                                        <input type="number" name="sep_number" class="form-control" placeholder="Masukkan Nomor SEP baru di sini">
                                        <br>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary">Simpan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <hr>
            <div class="row">
                <div class="col-12 form-group">
                    <div style="font-weight: 700; 
                    color: rgba(0,0,0,.38);">
                    <p class="h6 my-0 mb-10"><strong>FOTO HASIL PEMERIKSAAN</strong></p>
                </div>
                @include('layouts.components2.lab.edit-photo-gallery')
                <div class="col-12 form-group">

                    <p class="h6 my-0 mb-10">PEMERIKSAAN</p>
                    <form action="{{url('labpa/upload/gambar')}}" class="dropzone" id="my-dropzone" method="POST">
                        <input type="hidden" name="saltPict" value="{{$key}}">
                        <input type="hidden" name="fileNumber" value="0" id="fileNumber">
                        <input type="hidden" name="target" value="{{$transaksi->slug}}"> {{csrf_field()}}
                    </form>
                </div>
                <form action="{{url('labpa/transaksi/edit/'.$transaksi->slug)}}" id="periksaForm" method="POST">
                    <div class="col-12 form-group">
                        <br>
                        <p class="h6 my-0 mb-10">HASIL BACA PEMERIKSAAN</p>
                        <div id="deleteDiv">

                        </div>
                        {{csrf_field()}}
                        <input type="hidden" name="saltForm" value="{{$key}}">
                        <input type="hidden" name="transaction_slug" value="{{$transaksi->slug}}">
                        <textarea class="form-control tinymce" name="summary" rows="6" placeholder="Masukkan Hasil Pemeriksaan disini...">{{$transaksi->result}}</textarea>
                    </div>
                    <div style="display: none;" id="fileDetailsTarget">

                    </div>
                    <br>
                    <div class="col-12">
                        <br>
                        <p class="h6 my-0 mb-10">VERIFIKASI PEMERIKSAAN</p>
                        @foreach($transaksi->detail as $id => $detail)
                        <div class="form-group row">
                            <div class="col-lg-12">
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
                            </div>
                            <div class="col-lg-4">
                                <div class="col-md-12" style="margin-bottom: 6px;">
                                    <label></label>
                                </div>
                                <select class="form-control js-select2 select-form-layanan" style="width: 100%;" id="select2Form{{$detail->id}}" name="formDetail[{{$detail->id}}]" data-id="{{$detail->id}}">
                                    <option value="0" @if(is_null($detail->result)) selected="" @endif)>Pilih Form yang dibutuhkan</option>
                                    <option value="papsmear" @if(!is_null($detail->result) && json_decode($detail->result)->jenis_form == 'papsmear') selected="" @endif>Pap Smear</option>
                                    <option value="sitologi" @if(!is_null($detail->result) && json_decode($detail->result)->jenis_form == 'sitologi') selected="" @endif>Sitologi / FNA-B</option>
                                    <option value="aspirasi" @if(!is_null($detail->result) && json_decode($detail->result)->jenis_form == 'aspirasi') selected="" @endif>Sitologi / Aspirasi</option>
                                    <option value="hispatologi" @if(!is_null($detail->result) && json_decode($detail->result)->jenis_form == 'hispatologi') selected="" @endif>Hispatologi</option>
                                    <option value="vriescoupe" @if(!is_null($detail->result) && json_decode($detail->result)->jenis_form == 'vriescoupe') selected="" @endif>Vries Coupe</option>
                                    <option value="histopatologi" @if(!is_null($detail->result) && json_decode($detail->result)->jenis_form == 'histopatologi') selected="" @endif>Histopatologi</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-2">
                                <p class="h6 my-0 mb-10">Jumlah Slide</p>              
                                <input type="text" name="slide[{{$detail->id}}]" placeholder="Masukkan Jumlah Slide disini" class="form-control" value="{{$detail->slide}}">
                            </div>
                            <div class="col-sm-12 col-lg-2">
                                <p class="h6 my-0 mb-10">Lokasi</p>                                
                                <input type="text" name="lokasi[{{$detail->id}}]" class="form-control" placeholder="Masukkan Lokasi Disini" value="{{$detail->lokasi}}">
                            </div>
                            <div class="col-sm-12 col-lg-2">
                                <p class="h6 my-0 mb-10">Kode Sediaan</p>
                                <input type="text" name="kode_sediaan[{{$detail->id}}]" class="form-control" placeholder="Masukkan Kode Pasien Disini" value="{{$detail->kode_sediaan}}">
                            </div>
                            @if($detail->status == "ask")
                            <div class="col-sm-6 col-lg-2">
                                <div class="col-md-12" style="margin-bottom: 6px;">
                                    <label></label>
                                </div>
                                <div class="col-md-12 pb-10">
                                    <button class="btn btn-hero btn-alt-danger cancel-periksa" type="button" data-target="{{$detail->tarif->deskripsi}}" data-state="enabled" id="cancel-{{$detail->id}}" data-id="{{$detail->id}}">Batalkan</button>
                                </div>
                            </div>
                            @endif
                            <div id="formLayananDiv{{$detail->id}}" class="col-12 mb-10 mt-10">
                                @if(!is_null($detail->result))
                                @include('labpa.transaksi.content.edit-form-layanan')
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <hr>
                <br>
                <div class="col-12 form-group">
                    <p class="h5 my-0 mb-10">TAMBAHAN PEMERIKSAAN</p>
                    <div class="form-layanan">
                        <p>*Layanan harus ada pada kelas dan tipe yang dipilih</p>
                        <div class="row form-group single-layanan  layananBaru" id="layanan_0" data-index="0">
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
                <div class="col-12 row">
                    <div class="col-sm-12 col-lg-6">
                        <p class="h5 my-0 mb-10">KETERANGAN</p>                                
                        <textarea class="form-control" rows="4" cols="50" placeholder="Tambahkan Keterangan Di Sini" name="info">{{$transaksi->info}}</textarea>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <p class="h5 my-0 mb-10">DIAGNOSIS</p>
                        <textarea class="form-control" rows="4" cols="50" placeholder="Tambahkan Diagnosis Di Sini" name="diagnosis">{{$transaksi->diagnosis}}</textarea>
                    </div>
                    <div class="col-12 mt-10">
                        <button id="submit-all" class="btn btn-hero btn-alt-primary pull-right" type="button" >Simpan Pemeriksaan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@include('layouts.components2.lab.transaksi-creator')
</div>
</div>
</div>

</div>
@include('labpa.transaksi.content.edit-confirmation-modal') 
@include('layouts.components2.lab.save-pemeriksaan-modal')
@include('layouts.components2.lab.delete-pemeriksaan-modal')
@include('labpa.components.footer') 
@endsection @section('js')
<script src="{{ URL::asset('/plugins/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
@include('labpa.transaksi.content.form-pemeriksaan-js')
<script type="text/javascript">
    $("#lightgallery").lightGallery({
        pager: true,
        zoom: true,
        actualSize: true,
        fullscreen: true,
        selector: '.photo-preview'
    });
    function deleteConfirmation(id) {
        $("#deleteBtn").data("delete", id);
        $("#modal-popout").modal("show");
    }

    function deleteImg() {
        var target = $("#deleteBtn").data("delete");
        // var photoDiv = $("#photo"+target);
        $("#photo" + target).remove();
        // photoDiv.html(`<img src="{{URL::asset('assets/img/deleted.jpg')}}" class="four-col">`);
        $("#modal-popout").modal("hide");
        $("#deleteDiv").append(`<input type="hidden" name="deletedPhoto[]" value="` + target + `">`);
    }
</script>
@endsection('js')