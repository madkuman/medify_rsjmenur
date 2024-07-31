@extends('layouts.main2')
@section('title')
Radiologi
@endsection
@section('css')
@include('radiolog.layouts.css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/basic.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/lightgallery.css')}}">
<link href="{{URL::asset('plugins/quill/quill.core.css')}}" rel="stylesheet">
<link href="{{URL::asset('plugins/quill/quill.snow.css')}}" rel="stylesheet">
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
 .disabled-div {
    pointer-events: none;
    opacity: 0.4;
    background: gainsboro;
}
.table td, .table th{
    border : 2px solid gainsboro;
}
</style>
@endsection
@section('content')
@include('radiolog.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Permintaan Transaksi #{{$transaksi['id']}}</h3>
        </div>

        <div class="block-content pb-20">
            <div class="row px-15">
                @include('layouts.components2.lab.biodata-pasien-lab')
                <div class="col-1 mw-10 full-only"></div>
                <div class="col-sm-12 col-md-3 mb-10 content-box">
                    <p class="h6 my-0 mb-10">PERMINTAAN PEMERIKSAAN</p>
                    <table>
                        @foreach($transaksi->detail as $detail)
                        <tr>
                            <td>{{$detail->tarif->deskripsi}}</td>
                        </tr>
                        @endforeach
                    </table>
                    <span class="badge badge-primary">{{$transaksi->pasien->typestring}}</span><br>
                </div>

                <div class="modal fade" id="modalConfirmationSEP" tabindex="-1" role="dialog" aria-labelledby="modalConfirmation" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="block block-themed block-transparent mb-0">
                                <div class="block-content">
                                    <form action="{{url('radiologi/transaksi/sep/edit/'.$transaksi->slug)}}" method="POST">
                                        <h3>Ubah Nomor SEP</h3>
                                        {{csrf_field()}}
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
                    <div style="font-weight: 700; color: rgba(0,0,0,.38);">
                        <p class="h6 my-0 mb-10"><strong>FOTO HASIL PEMERIKSAAN</strong></p>
                    </div>
                </div>
                @include('layouts.components2.lab.edit-photo-gallery')
                <div class="col-12 form-group">
                    <br><hr>
                    <p class="h6 my-0 mb-10">PEMERIKSAAN</p>
                    <form action="{{url('radiologi/upload/gambar')}}" class="dropzone" id="my-dropzone" method="POST">
                        <input type="hidden" name="saltPict" value="{{$key}}">
                        <input type="hidden" name="fileNumber" value="0" id="fileNumber">
                        <input type="hidden" name="target" value="{{$transaksi->slug}}">
                        {{csrf_field()}}
                    </form>
                </div>
                <div class="col-12 form-group">
                    <form action="{{url('radiologi/transaksi/edit/'.$transaksi->slug)}}" id="periksaForm" method="POST">
                        <div id="deleteDiv">

                        </div>
                        {{csrf_field()}}
                        <input type="hidden" name="saltForm" value="{{$key}}">
                        <input type="hidden" name="transaction_slug" value="{{$transaksi->slug}}">
                        <textarea class="form-control" id="textarea" style="display: none;" name="summary" rows="12" placeholder="Masukkan Hasil Pemeriksaan disini...">{{$transaksi->result}}</textarea>
                    </div>
                    <div style="display: none;" id="fileDetailsTarget">

                    </div>
                    <div class="col-12">
                        <br><p class="h6 my-0 mb-10">VERIFIKASI PEMERIKSAAN</p>
                        <div class="form-group row">
                            <div class="col-12">
                                @foreach($transaksi->detail as $id => $detail)
                                <table class="table table-bordered table-vcenter tabel-layanan" id="tabel_layanan_{{$detail->id}}">
                                    <tr>
                                        <td colspan="10">
                                            <div class="custom-control custom-checkbox mb-5">
                                                @if($detail->status == "ask")
                                                <input class="custom-control-input akan-ditagih layanan-checkbox" name="layanan[]" id="example-checkbox{{$id}}" value="{{$detail->id}}" type="checkbox" data-harga="{{$detail->harga}}">
                                                <label class="custom-control-label" for="example-checkbox{{$id}}">{{$detail->tarif->deskripsi}}</label>
                                                @else
                                                <input class="custom-control-input layanan-checkbox" id="example-checkbox{{$id}}" value="{{$detail->id}}" type="checkbox" disabled="" checked="">
                                                <label class="custom-control-label" for="example-checkbox{{$id}}">{{$detail->tarif->deskripsi}}</label>
                                                <input type="hidden" name="layanan[]" value="{{$detail->id}}">
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Pemeriksaan</th>
                                        <th>Film Dipakai</th>
                                        <th>Film Direject</th>
                                        <th style="width: 145px">Alasan Film Direject</th>
                                        <th style="width: 110px">Ukuran Film</th>
                                        <th>Foto Ulang</th>
                                        <th style="width: 125px">Alasan Foto Ulang</th>
                                        <th>Kontras Dipakai</th>
                                        <th>Kontras Dikembalikan</th>
                                        <th rowspan="2">
                                            <div class="col-md-12 pb-10">
                                                <button type="button" class="btn btn-lg btn-circle btn-outline-danger mr-5 mb-5 cancel-periksa" data-target="{{$detail->tarif->deskripsi}}" data-state="enabled" id="cancel-{{$detail->id}}" data-id="{{$detail->id}}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="col-12 pb-10 px-0">
                                                @if($detail->status == "ask")
                                                <input type="number" name="jumlahPeriksa[{{$detail->id}}]" class="form-control jumlah-periksa" placeholder="Masukkan Jumlah Pemeriksaan" value="{{is_null($detail->qty) ? 1 : $detail->qty }}">
                                                @else
                                                <input type="number" class="form-control" placeholder="Masukkan Jumlah Pemeriksaan" value="{{$detail->qty}}" disabled="">
                                                <input type="hidden" name="jumlahPeriksa[{{$detail->id}}]" class="form-control jumlah-periksa" placeholder="Masukkan Jumlah Pemeriksaan" value="{{is_null($detail->qty) ? 1 : $detail->qty }}">
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12 pb-10 px-0">
                                                <input type="text" name="dipakai[{{$detail->id}}]" class="form-control" placeholder="Masukkan Jumlah Film yang Dipakai" value="{{$detail->film_dipakai}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12 pb-10 px-0">
                                                <input type="text" name="direject[{{$detail->id}}]" class="form-control" placeholder="Masukkan Jumlah Film yang Di-reject" value="{{$detail->film_ditolak}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12 pb-10 px-0">
                                                <select class="form-control" name="alasan_direject[{{$detail->id}}]" style="width: 100%;" >
                                                    <option value="" selected="">-</option>
                                                    @foreach($alasan_direject as $ad)
                                                        <option value="{{$ad}}" @if($detail->alasan_film_direject == $ad) selected @endif>{{$ad}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12 pb-10 px-0">
                                                <select class="form-control" name="ukuran_film[{{$detail->id}}]" style="width: 100%;" >
                                                    <option value="">Tanpa Ukuran</option>
                                                    @foreach($ukuran as $u)
                                                    <option value="{{$u}}" @if($detail->ukuran_film == $u) selected @endif>{{$u}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-12 pb-10 px-0">
                                                <input type="number" name="foto_ulang[{{$detail->id}}]" value="{{$detail->foto_ulang}}" class="form-control foto-ulang">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-12 pb-10 px-0">
                                                <select class="form-control" name="alasan_ulang[{{$detail->id}}]" style="width: 100%;" >
                                                    <option value="" selected="">-</option>
                                                    @foreach($alasan_ulang as $au)
                                                    <option value="{{$au}}" @if($detail->alasan_foto_ulang == $au) selected @endif>{{$au}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-12 pb-10 px-0">
                                                <input type="number" name="kontras_dipakai[{{$detail->id}}]" value="{{$detail->kontras_dipakai}}" class="form-control kontras-dipakai">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-12 pb-10 px-0">
                                                <input type="number" name="kontras_dikembalikan[{{$detail->id}}]" value="{{$detail->kontras_dikembalikan}}" class="form-control kontras-dikembalikan">
                                            </div>
                                        </td>                                        
                                    </tr>
                                    <tr>
                                    <th class="text-center" colspan="10"><button class="btn btn-hero btn-primary btn-hasil-baca" type="button" data-toggle="modal" data-target="#hasil_baca_{{$detail->id}}_modal">Hasil Baca</button></th>
                                </tr>
                                </table>
                                @endforeach
                            </div>
                        </div>
                        @include('radiolog.transaksi.content.tambahan-pemeriksaan')
                        <div class="form-group row mt-100 mb-50">
                            <div class="col-sm-6">
                                <p class="h6 my-0 mb-10">KETERANGAN</p>
                                <textarea class="form-control" rows="4" cols="50" placeholder="Tambahkan Keterangan Di Sini" name="info">{{$transaksi->info}}</textarea>
                            </div>
                            <div class="col-6">
                                @include('radiolog.transaksi.content.bmhp')
                            </div>
                        </div>
                        
                    </form>
                    <div class="pull-right">
                        <button id="submit-all" class="btn btn-hero btn-alt-primary" type="button">Simpan Perubahan</button>
                    </div>
                </div>
            </div>

        </div>
        @include('layouts.components2.lab.transaksi-creator')

    </div>
</div>
</div>

</div>
@include('labpk.transaksi.content.delete-transfusi-modal')
@include('layouts.components2.lab.save-pemeriksaan-modal')
@include('layouts.components2.lab.delete-pemeriksaan-modal')
@include('layouts.components2.lab.delete-img-modal')
@foreach($transaksi->detail as $id => $detail)
    @include('radiolog.transaksi.content.modal-hasil-baca', ['id' => $detail->id, 'content' => $detail->hasil_baca])
@endforeach
@include('radiolog.transaksi.content.modal-hasil-baca', ['id' => 'new_0', 'content' => ''])
@include('radiolog.components.footer')
@endsection

@section('js')
@include('layouts.components2.lab.dropzone-lab')
@include('radiolog.transaksi.content.pemeriksaan-js')
<script src="{{URL::asset('plugins/quill/quill.core.js')}}"></script>
<script src="{{URL::asset('plugins/quill/quill.min.js')}}"></script>
<script type="text/javascript">
    function proceed(){
        if($('.final-form'))
            $('.final-form').remove()
        $(".layananBaru").each(function (i, el) {                
            $("<input>").attr({
                type: 'hidden',
                name: 'new_layanan[]',
                value: $(el).find('.new-layanan').val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
            $("<input>").attr({
                type: 'hidden',
                name: 'new_jumlah_periksa[]',
                value: $(el).find('.new-jumlah-periksa').val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
            $("<input>").attr({
                type: 'hidden',
                name: 'new_film_dipakai[]',
                value: $(el).find('.new-film-dipakai').val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
            $("<input>").attr({
                type: 'hidden',
                name: 'new_film_direject[]',
                value: $(el).find('.new-film-direject').val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
            $("<input>").attr({
                type: 'hidden',
                name: 'new_alasan_film_direject[]',
                value: $(el).find('.new-alasan-film-direject').val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
            $("<input>").attr({
                type: 'hidden',
                name: 'new_ukuran_film[]',
                value: $(el).find('.new-ukuran-film').val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
            $("<input>").attr({
                type: 'hidden',
                name: 'new_foto_ulang[]',
                value: $(el).find('.new-foto-ulang').val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
            $("<input>").attr({
                type: 'hidden',
                name: 'new_alasan_foto_ulang[]',
                value: $(el).find('.new-alasan-foto-ulang').val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
            $("<input>").attr({
                type: 'hidden',
                name: 'new_kontras_dipakai[]',
                value: $(el).find('.new-kontras-dipakai').val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
            $("<input>").attr({
                type: 'hidden',
                name: 'new_kontras_dikembalikan[]',
                value: $(el).find('.new-kontras-dikembalikan').val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
                        $("<input>").attr({
                type: 'hidden',
                name: 'new_hasil_baca[]',
                value: quills[`new_${i}`].root.innerHTML,
                class: 'final-form',
            }).appendTo("#periksaForm");
        });
        $(".judul-input").each(function (i, el) {
            $("<input>").attr({
                type: 'hidden',
                name: 'judul[]',
                value: $(el).val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
        });
        $(".caption-input").each(function (i, el) {
            $("<input>").attr({
                type: 'hidden',
                name: 'caption[]',
                value: $(el).val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
        });
        $(".cancel-periksa").each(function (i, el){
            if($(el).data('state') == 'enabled')
                return;
            $("<input>").attr({
                type: 'hidden',
                name: 'batal_layanan[]',
                value: $(el).data('id'),
                class: 'final-form',
            }).appendTo("#periksaForm");
        });
        $(".tabel-layanan").each(function (i, el){
            var checkbox = $(el).find('input:checkbox')[0];
            var id = checkbox.value;
            var quillContent = quills[id].root.innerHTML;
            $("<input>").attr({
                type: 'hidden',
                name: `hasil_baca[${id}]`,
                value: quillContent,
                class: 'final-form',
            }).appendTo("#periksaForm");
        });
        console.log($('.final-form'));
        $("#periksaForm").submit();
    }
</script> 
@endsection('js')