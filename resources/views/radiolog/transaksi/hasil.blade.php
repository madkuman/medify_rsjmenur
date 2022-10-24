@extends('layouts.main2')
@section('title')
Radiologi Hasil
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
</style>
@include('radiolog.layouts.css')
@endsection
@section('content')
@include('radiolog.components.header')
<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Permintaan Transaksi #{{$transaksi['id']}}</h3>
            @if($transaksi->status != -1)
                <span class="pull-right">
                    <a class="btn btn-hero btn-secondary" href="{{url('radiologi/transaksi/edit/'.$transaksi->slug)}}"><i class="fa fa-pencil"></i>&nbsp&nbsp&nbspEdit</a>
                </span>
            @endif
        </div>
        <div class="block-content pb-20">
            <div class="row px-15">
                @include('layouts.components2.lab.biodata-pasien-lab')
                @include('layouts.components2.lab.permintaan-pemeriksaan')
                @include('layouts.components2.lab.transaksi-creator')

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
            @include('layouts.components2.lab.lightgallery-hasil')
            @if($transaksi->status == -1)
            <div class="col-md-12 form-group" >
                <div>
                    <p class="h6 my-0 mb-10"><strong>ALASAN PENOLAKAN</strong></p>
                </div>
                <div>
                    {{$transaksi->alasan_batal}}
                </div>                                        
            </div>
            @endif
            @if($is_dokter && !is_null($transaksi->kasus_id) && $transaksi->status == 1)
                <div class="col-md-12 form-group mt-10">
                    <button class="btn btn-secondary pull-right ml-5 mb-5 wide-mobile" type="button" data-toggle="modal" data-target="#modal-create-tindakan-icd9">Tambah Tindakan ICD9</button>
                </div>
            @endif
            <div class="col-12">
                <div>
                    <p class="h6 my-0 mb-10">PEMERIKSAAN YANG DILAKUKAN  </p>
                </div>
                <div class="full-only">
                    <ul>
                        @foreach($transaksi->detail as $detail)
                        @if($detail->status == "done")
                        <li><p class="font-w600 mb-5">{{$detail->tarif->deskripsi}} &nbsp&nbsp&nbsp <span style="font-weight: 400;"><br>- {{$detail->qty}} kali <br>- {{$detail->film_dipakai}} Film dipakai <br>- {{$detail->film_ditolak}} Film ditolak <br>- Ukuran Film ({{$detail->ukuran_film}})<br>- {{$detail->foto_ditolak}} Foto Ulang ({{$detail->alasan_foto_ulang}})<br>- {{$detail->kontras_dipakai}} Kontras dipakai<br>- {{$detail->kontras_dikembalikan}} Kontras dikembalikan</span></p>
                        <br><button class="btn btn-hero btn-primary btn-hasil-baca" type="button" data-title="{{$detail->tarif->deskripsi}}">Hasil Baca</button>
                    <input type="hidden" class="hasil-baca" value="{{$detail->hasil_baca}}"></li>
                        @endif
                        @endforeach
                    </ul>
                    <br>
                </div>
                <div class="mobile-block">
                    <ul>
                        @foreach($transaksi->detail as $detail)
                        @if($detail->status == "done")
                        <li><p class="font-w600 mb-5">{{$detail->tarif->deskripsi}}<span style="font-weight: 400;"><br>- {{$detail->qty}} kali <br>- {{$detail->film_dipakai}} Film dipakai <br>- {{$detail->film_ditolak}} Film ditolak - Ukuran Film ({{$detail->ukuran_film}})</span></p></li>
                        @endif
                        @endforeach
                    </ul>
                    <br>
                </div>
            </div>
            <div class="col-12">
                <div>
                    <p class="h6 my-0 mb-10">KETERANGAN </p>
                </div>
                <div>
                    {{$transaksi->info ? $transaksi->info : '-'}}
                </div>
            </div>
               @include('layouts.components2.lab.cetak-verifikasi')
               @include('layouts.components2.lab.pemeriksaan-oleh')
           </div>
       </div>
   </div>

</div>

<div class="modal" id="hasil_baca_modal" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Hasil Baca <span id="modal_block_title"></span></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content" id="hasil_baca_content">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<form id="verificationForm">
    {{csrf_field()}}
    <input type="hidden" name="status" value="2">
</form>
@include('radiolog.transaksi.content.modal-hasil')
@include('radiolog.components.footer')
@if(!is_null($transaksi->kasus))
    @include('radiolog.transaksi.content.modal-icd9')
@endif
@endsection

@section('js')
<script type="text/javascript">
    const CURRENT_URL = "{{url()->current()}}";
    const LAB_URL = "{{url($link)}}";
    $(document).ready(function(){
        AutoCompleteCreateTindakanICD9.init();

        @foreach($photos as $item)
        $(document).on('click', "#titleForm{{$item->id}}", function(){
            console.log($(this).val());
        });
        @endforeach
    })
    $(document).on('click', '.btn-hasil-baca', function(el){
        var content = $(this).parent().find('input').val();
        var title = $(this).data('title')
        console.log(content)
        console.log(el)
        console.log($(this).parent())
        $("#modal_block_title").text(title);
        $("#hasil_baca_content").html(content)
        $("#hasil_baca_modal").modal('show')
    })
</script>
<script type="text/javascript" src="{{asset('js/lab/hasil-1.5.js')}}"></script>
<script src="{{ URL::asset('/plugins/tinymce/tinymce.min.js') }}" type="text/javascript" ></script> 
<script>tinymce.init({
    selector:'#textarea' 
});</script>
@if(!is_null($transaksi->kasus))
    @include('radiolog.transaksi.content.icd9-js')
@endif
@endsection('js')