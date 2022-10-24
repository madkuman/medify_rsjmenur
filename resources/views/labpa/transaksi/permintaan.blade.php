@extends('layouts.main2')
@section('title')
Laboratorium Patologi Anatomi
@endsection
@section('css')
@include('labpa.layouts.css')
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
                <div class="col full-only"></div>
                @include('layouts.components2.lab.jadwal-pasien')

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
            <div class="row">
                <div class="col-12">
                    <hr>
                    <p class="h6 my-0 mb-10">PERMINTAAN PEMERIKSAAN</p>

                    @include('layouts.components2.lab.verifikasi-permintaan')

                    <div class="pull-right full-only">
                        <button class="btn btn-hero btn-outline-danger" type="button" data-toggle="modal" data-target="#modalCancelConfirmation">Batalkan Pemeriksaan</button>
                        <a href="{{url('labpa/transaksi/periksa')}}/{{$transaksi->slug}}" class="btn btn-hero btn-primary">Lakukan Pemeriksaan</a>
                        <button class="btn btn-hero btn-success pull-right ml-5 mb-5" type="button" onclick="window.open('{{url('labpa/transaksi/cetak/permintaan/'.$transaksi->slug)}}', 
                             'newwindow', 
                             `width=${screen.width},height=${screen.height}`); return false;">Cetak Permintaan</button>

                        {{--
                        @if($transaksi->is_checkout)
                        <button class="btn btn-hero btn-secondary" disabled="">Tagihan sudah Dikirim</button>
                        @else
                        <a href="{{url('labpa/transaksi/kirim-tagihan')}}/{{$transaksi->slug}}" class="btn btn-hero btn-success">Kirim Tagihan</a>
                        @endif--}}
                    </div>
                    <div class="mobile-block">
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-hero btn-outline-danger mb-5" style="width: 100%" type="button" data-toggle="modal" data-target="#modalCancelConfirmation">Batalkan Pemeriksaan</button>    
                            </div>
                            <div class="col-12">
                                <a href="{{url('labpa/transaksi/periksa')}}/{{$transaksi->slug}}" class="btn btn-hero btn-primary mb-5" style="width: 100%">Lakukan Pemeriksaan</a>
                            </div>
                            {{--
                            <div class="col-12">
                                @if($transaksi->is_checkout)
                                <button class="btn btn-hero btn-secondary mb-5" style="width: 100%" disabled="">Tagihan sudah Dikirim</button>
                                @else
                                <a href="{{url('labpa/transaksi/kirim-tagihan')}}/{{$transaksi->slug}}" class="btn btn-hero btn-success mb-5" style="width: 100%">Kirim Tagihan</a>
                                @endif  
                            </div>--}}
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