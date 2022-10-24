@extends('bpjs.layouts.main')

@section('title')
Tambah SEP
@endsection

@section('subtitle')
Tambah SEP
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
                            <h5>Buat SEP Baru</h5>
                        </div>
                        <form id="formSEP">
                            <input type="hidden" class="noSep" name="nomor_sep">
                            <div class="block-content">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <!--INFORMASI PASIEN-->
                                        @include('bpjs.sep.create-v2.components.form-pasien')
                                        @include('bpjs.sep.create-v2.components.form-rujukan')
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        @include('bpjs.sep.create-v2.components.form-bpjs')
                                        <!-- LAKA -->
                                        @include('bpjs.sep.create-v2.components.form-laka')
                                    </div>
                                    <div class="col-12 py-10 text-center font-w600 bg-danger text-white mb-20 align-middle" id="error-wrapper" style="display: none;">
                                        <i class="fa fa-exclamation-circle mr-5"></i>
                                        <span></span>
                                    </div>
                                    <div class="col-12">
                                        <div class="pull-right">
                                            <button id="submit" class="btn btn-primary">
                                                Simpan  
                                            </button>
                                            <i class="fa fa-asterisk fa-2x fa-spin text-info px-20 my-5" id="loading" style="display: none;"></i>
                                        </div>
                                    </div>
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
    <script type="text/javascript">
        var ppk_self = "{{config('app.bpjs_ppk')}}";
        var pasien_id_window = {{$pasien_id}};
        var pembayaran_id_window = {{$pembayaran_id}};
        var rujukan_sep = "{{$rujukan}}";
        var is_inap = "{{$is_inap}}";
    </script>

    <script src="{{url('')}}/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{url('')}}/assets/js/plugins/jquery-validation/additional-methods.js"></script>
    <script type="text/javascript" src="{{url('js/bpjs/sep/create/validator-v1-2.js')}}"></script>
    @include('bpjs.sep.create-v2.js.create-js')
    @endsection