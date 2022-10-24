@extends('bpjs.layouts.main')

@section('title')
Edit Rencana Kontrol
@endsection

@section('subtitle')
Edit Rencana Kontrol
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
                        <h5>Edit @if ($jenis == 1)
                            SPRI
                        @else            
                            SKDP
                        @endif
                        Baru</h5>
                    </div>
                    <form id="formRencanaKontrol">
                        <div class="block-content">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <input type="hidden" name="no_sk" value="{{ $rencana_kontrol->no_sk }}" id="noSk">
                                    <input type="hidden" name="jenis_kontrol" value="{{$jenis}}">
                                    <hr>
                                    @include('bpjs.rencana-kontrol.edit.components.form-pasien-sep')
                                    @include('bpjs.rencana-kontrol.edit.components.form-dokter')
                                </div>
                                <div class="col-12 py-10 text-center font-w600 bg-danger text-white mb-20 align-middle" id="error-wrapper" style="display: none;">
                                    <i class="fa fa-exclamation-circle mr-5"></i>
                                    <span></span>
                                </div>
                                <div class="col-12">
                                    <div class="pull-right">
                                        <button id="submit" class="btn btn-primary">Simpan</button>
                                        <i class="fa fa-asterisk fa-2x fa-spin text-info px-20 my-5" id="loading" style="display: none;"></i>
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
<script>
    let JENIS_KONTROL = "{!! $rencana_kontrol->jenis_kontrol ?? 2 !!}";
</script>
@include('bpjs.rencana-kontrol.edit.js.validate-js')
@include('bpjs.rencana-kontrol.edit.js.edit-js')
@endsection