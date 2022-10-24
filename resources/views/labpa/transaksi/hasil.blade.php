@extends('layouts.main2')
@section('title')
Laboratorium Patologi Anatomi
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
@include('layouts.components2.lab.css')
@endsection
@section('content')
@include('labpa.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Permintaan Transaksi #{{$transaksi['id']}}</h3>
            @if($transaksi->status != -1)
                <span class="pull-right">
                    <a class="btn btn-hero btn-secondary" href="{{url('labpa/transaksi/edit/'.$transaksi->slug)}}"><i class="fa fa-pencil"></i>&nbsp&nbsp&nbspEdit</a>
                </span>
            @endif
        </div>

        <div class="block-content pb-20">
            <div class="row mx-0">
                @include('layouts.components2.lab.biodata-pasien-lab')
                @include('layouts.components2.lab.permintaan-pemeriksaan')
                @include('layouts.components2.lab.transaksi-creator')
            </div>
            <hr>
            <div class="row mx-0">
                <div class="col-12 px-0" style="overflow-x: auto;">
                    <p class="h6 my-0 mb-10">PERMINTAAN PEMERIKSAAN</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">No.</th>
                                <th style="width: 60%;">Layanan</th>
                                <th class="text-right text-center" style="width: 40%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi->detail as $key => $detail)
                            <tr>
                                <td class="text-center">{{$key+1}}</td>
                                <td>
                                    <p class="font-w600 mb-5">{{$detail->tarif->deskripsi}}</p>
                                </td>
                                <td class="text-center">
                                    @if(is_null($detail->result))
                                    <button type="button" class="btn btn-secondary" disabled="">Form tidak ada</button>
                                    @else
                                    <button type="button" class="btn btn-success ml-10 mb-10" data-toggle="modal" data-target="#modalHasil{{$detail->id}}">Lihat Form</button>
                                    <a href="{{url()->current().'/cetak/'.$detail->id}}" class="btn btn-info ml-10 mb-10" target="_blank">
                                        Download
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @include('layouts.components2.lab.lightgallery-hasil')
            </div>
            @if($transaksi->status == -1)
            <div class="col-12 px-0 form-group" >
                <div>
                    <p class="h6 my-0 mb-10"><strong>ALASAN PENOLAKAN</strong></p>
                </div>
                <div>
                    {{$transaksi->alasan_batal}}
                </div>                                        
            </div>
            @endif
            @if($transaksi->status != -1)
                <div class="col-12 px-0 form-group mt-10" >
                    <div>
                        <p class="h6 my-0 mb-10"><strong>HASIL BACA PEMERIKSAAN</strong></p>
                    </div>
                    <button class="btn btn-sm btn-outline-primary pull-right" type="button" onclick="editHasilBaca()"><i class="fa fa-pencil"></i></button>
                    <div id="showPemeriksaanDiv">
                        <?php echo htmlspecialchars_decode(stripslashes($transaksi->result ? $transaksi->result : '-')); ?>
                    </div>
                    <div id="editPemeriksaanDiv" style="display: none;">
                        <form id="hasilBacaForm" method="POST">
                            {{csrf_field()}}
                            <textarea class="form-control" style="" id="textarea" rows="6" placeholder="Masukkan Hasil Pemeriksaan disini...">
                                {{$transaksi->result}}
                            </textarea>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-outline-primary pull-right mt-10 ml-5" type="button" onclick="submitEditHasilBaca()" >Simpan</button>
                                    <button class="btn btn-outline-warning pull-right mt-10 ml-5" type="button" onclick="cancelEditHasilBaca()">Batal</button>
                                </div>
                            </div>
                            <input type="hidden" name="pemeriksaan" id="pemeriksaanInput">
                        </form>
                    </div>
                </div>
            @endif
            <div class="col-12 px-0 form-group">
                <div>
                    <p class="h6 my-0 mb-10">DIAGNOSIS </p>
                </div>
                <div>
                    {{is_null($transaksi->diagnosis) ? '-' : $transaksi->diagnosis}}
                </div>
            </div>
            {{--
            <div class="col-12 px-0 form-group">
                <div>
                    <p class="h6 my-0 mb-10">LOKASI </p>
                </div>
                <div>
                    {{is_null($transaksi->lokasi) ? '-' : $transaksi->lokasi}}
                </div>
            </div>
            <div class="col-12 px-0 form-group">
                <div>
                    <p class="h6 my-0 mb-10">JUMLAH SLIDE </p>
                </div>
                <div>
                    {{is_null($transaksi->slide) ? '-' : $transaksi->slide}}
                </div>
            </div>
            <div class="col-12 px-0 form-group">
                <div>
                    <p class="h6 my-0 mb-10">KODE PASIEN </p>
                </div>
                <div>
                    {{is_null($transaksi->kode_pasien) ? '-' : $transaksi->kode_pasien}}
                </div>
            </div>--}}

            <div class="col-12 px-0 form-group">
                <div>
                    <p class="h6 my-0 mb-10">PEMERIKSAAN YANG DILAKUKAN  </p>
                </div>
                <div>
                    @if($transaksi->status != -1)
                    <ul>
                        @foreach($transaksi->detail as $detail)
                        @if($detail->status != "ask")
                        <li><p class="font-w600 mb-5">{{$detail->tarif->deskripsi}} </p>
                            <p><span class="mr-30"><b>Jumlah slide </b>: {{$detail->slide}}</span><span class="ml-50"><b>Kode Sediaan </b>: {{$detail->kode_sediaan}}</span>
                            <span class="ml-50"><b>Lokasi </b>: {{$detail->lokasi}}</span></p>
                        @endif
                        @endforeach
                    </ul>
                    @else
                    -
                    @endif
                </div>
            </div>
            <div class="col-12 px-0">
                <div>
                    <p class="h6 my-0 mb-10">KETERANGAN </p>
                </div>
                @if(!is_null($transaksi->info))
                <hr>
                @endif
                
                <div>
                    {{is_null($transaksi->info) ? '-' : $transaksi->info}}
                </div>
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
@include('labpa.transaksi.content.modal-hasil')
@include('labpa.components.footer')
@endsection

@section('js')
<script type="text/javascript">
    const CURRENT_URL = "{{url()->current()}}";
    const LAB_URL = "{{url($link)}}";
    $(document).ready(function(){
        @if(session('success'))
        swal('Berhasil', '{{(session('success'))}}', 'success');
        @endif
    })
</script>
<script src="{{ URL::asset('/plugins/tinymce/tinymce.min.js') }}" type="text/javascript" ></script> 
<script>tinymce.init({
    selector:'#textarea' 
});</script>
<script type="text/javascript" src="{{asset('js/lab/hasil-1.5.js')}}"></script>
@endsection('js')