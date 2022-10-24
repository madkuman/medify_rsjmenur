@extends('bpjs.layouts.main')

@section('title')
Tambah Rencana Kontrol
@endsection

@section('subtitle')
Tambah Rencana Kontrol
@endsection

@section('css')
<style type="text/css">
</style>
@endsection

@section('content')
<main id="main-container">
    @include('bpjs.layouts.navbar')
    <div class="container">
        <div class="row row-deck">
            <div class="col-sm-12">
                <div class="block rounded">
                    <div class="block-header border-bottom">
                        <h5>Buat Rencana Kontrol @if($jenis == '1') SPRI @else SKDP @endif Baru</h5>
                    </div>
                    <form id="formRencanaKontrol">
                        <div class="block-content">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    @include('bpjs.rencana-kontrol.create.components.form-pilih-inputan')
                                    <hr>
                                    @include('bpjs.rencana-kontrol.create.components.form-pasien-sep')
                                    @include('bpjs.rencana-kontrol.create.components.form-dokter')
                                </div>
                                <div class="col-12 py-10 text-center font-w600 bg-danger text-white mb-20 align-middle" id="error-wrapper" style="display: none;">
                                    <i class="fa fa-exclamation-circle mr-5"></i>
                                    <span></span>
                                </div>
                                <div class="col-12">
                                    <div class="pull-right">
                                        <button id="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection


@section('js')
@include('bpjs.rencana-kontrol.create.js.validate-js')
@include('bpjs.rencana-kontrol.create.js.create-js')
@endsection