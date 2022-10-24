@extends('layouts.main2')
@section('title')
Radiologi
@endsection
@section('css')
@include('radiolog.layouts.css')
@endsection
@section('content')
@include('radiolog.components.header')
<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Transaksi #{{$transaksi->id}}</h3>
        </div>
        <div class="block-content pb-20">
            <div class="row mx-0">
                @include('layouts.components2.lab.biodata-pasien-lab')
                <div class="col full-only"></div>
                @include('layouts.components2.lab.jadwal-pasien')

                <div class="modal fade" id="modalConfirmationSEP" tabindex="-1" role="dialog" aria-labelledby="modalConfirmation" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form action="{{url('radiologi/transaksi/sep/edit/'.$transaksi->slug)}}" method="POST">
                                <div class="block block-themed block-transparent mb-0">
                                    <div class="block-content">
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
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <hr>
                    <p class="h6 my-0 mb-10">PERMINTAAN PEMERIKSAAN</p>

                    @include('layouts.components2.lab.verifikasi-permintaan')
                    <div class="full-only">
                        <a href="{{url('radiologi/transaksi/periksa')}}/{{$transaksi->slug}}" class="btn btn-hero btn-primary pull-right">Lakukan Pemeriksaan</a>

                        <button class="btn btn-hero btn-outline-danger" type="button" data-toggle="modal" data-target="#modalCancelConfirmation">Batalkan Pemeriksaan</button>
                        
                        <button class="btn btn-hero btn-success" type="button" onclick="window.open('{{url('radiologi/transaksi/cetak/permintaan/'.$transaksi->slug)}}', 
                           'newwindow', 
                           `width=${screen.width},height=${screen.height}`); return false;">Cetak Permintaan</button>
                    </div>
                    <div class="mobile-block">
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-hero btn-outline-danger mb-5" style="width: 100%" type="button" data-toggle="modal" data-target="#modalCancelConfirmation">Batalkan Pemeriksaan</button>    
                            </div>
                            <div class="col-12">
                                <a href="{{url('radiologi/transaksi/periksa')}}/{{$transaksi->slug}}" class="btn btn-hero btn-primary mb-5" style="width: 100%">Lakukan Pemeriksaan</a>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-hero btn-success pull-right ml-5 mb-5" type="button" onclick="window.open('{{url('radiologi/transaksi/cetak/permintaan/'.$transaksi->slug)}}', 
                             'newwindow', 
                             `width=${screen.width},height=${screen.height}`); return false;">Cetak Permintaan</button>  
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.components2.lab.transaksi-creator')
            </div>
        </div>
    </div>

</div>
@include('layouts.components2.lab.cancel-modal-lab')
@include('labpk.components.footer')
@endsection
@section('js')
<script type="text/javascript">
    function submitForm(){
        $("#cancelForm").submit();
    }
</script>
@endsection