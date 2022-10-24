@extends('bpjs.layouts.main')

@section('title')
Edit SEP
@endsection

@section('subtitle')
Edit SEP
@endsection

@section('css')
<style type="text/css">
</style>
@endsection

@section('content')
@if(!$window)
<main id="main-container">
    @include('bpjs.layouts.navbar')
    <div class="container">
        <div class="row row-deck">
            <div class="col-sm-12">
@else
<main id="main-container" class="pt-0">
@endif

                <div class="block rounded">
                    <div class="block-header border-bottom">
                        <h5>Edit SEP - {{$sep->no_sep}}</h5>
                        <div class="float-right">
                            <button id="delete" class="btn btn-alt-danger">
                                Hapus SEP
                            </button>
                        </div>
                    </div>
                    <form id="formSEP">
                        <div class="block-content">
                            <div class="row">
                                <div class="col-6">
                                    <!--INFORMASI PASIEN-->
                                    @include('bpjs.sep.edit-v2.components.form-pasien')
                                    @include('bpjs.sep.edit-v2.components.form-rujukan')
                                </div>
                                <div class="col-6">
                                    @include('bpjs.sep.edit-v2.components.form-bpjs')
                                    <!-- LAKA -->
                                    @include('bpjs.sep.edit-v2.components.form-laka')
                                </div>
                                <div class="col-12 py-10 text-center font-w600 bg-danger text-white mb-20 align-middle" id="error-wrapper" style="display: none;">
                                    <i class="fa fa-exclamation-circle mr-5"></i>
                                    <span></span>
                                </div>
                            </div>
                            <div class="float-right">
                                <button id="submit" class="btn btn-primary">
                                    Simpan  
                                </button>
                                <i class="fa fa-asterisk fa-2x fa-spin text-info px-20 my-5" id="loading" style="display: none;"></i>
                            </div>
                        </div>
                    </form>
                </div>
    @if(!$window)
            </div>
        </div>
    </div>
    @endif
</main>
@endsection


@section('js')
@php
    $kelas = $sep->kelas_rawat;
    $kelas = explode(' ', $kelas);
    $kelas = end($kelas);
@endphp
<script type="text/javascript">
        var objSep = JSON.parse(`{!!(json_encode($sep))!!}`);
        var pasienRM = null;
        var pasienBPJS = null;
        var data_rujukan = null;
        var ppk_self = "{{config('app.bpjs_ppk')}}";
        $(document).ready(function() {
            showPasien($('#pasienSelect').val());
            getPropinsi();
        });

</script>
 @include('bpjs.sep.edit-v2.js.edit-js')
@endsection