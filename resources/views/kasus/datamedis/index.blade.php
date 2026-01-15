@extends('kasus.layouts.main')
@section('title')
{{$kasus->judul_kasus}}  - Data Medis - Kasus
@endsection

@section('content')
<style type="text/css">
    .nav-link{
        font-size: 12px;
    }
    .modal { overflow: auto !important;}
</style>

<!-- Main Container -->
<main id="main-container">
    @include('kasus.layouts.header')

    <div class="content">
        <div class="row">
            @include('kasus.layouts.sidebar')

            @if(!empty($kasus->my_invitation) && $kasus->my_invitation->invitation == 1) 
            @php $my_role = 1 @endphp
            @else 
            @php
            $my_role = 0  
            @endphp
            @endif
            @php $my_role_admin = 0 @endphp
            @if($my_role == 1) 
            @if($kasus->my_invitation && $kasus->my_invitation->admin == 1) @php $my_role_admin = 1 @endphp
            @else @php $my_role_admin = 0 @endphp @endif
            @endif

            @php $allow_crud = 0 @endphp

            @if($my_role && $kasus->end_at == null)
            @php $allow_crud = 1 @endphp
            @endif


            <!-- Updates -->
            <div class="col-lg-4 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="block rounded p-0">
                            <ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary full-only">
                                <li class="nav-item">
                                    <a class="nav-link 
                                    @if(empty($active_nav) || $active_nav == 'identitas')
                                    active
                                    @endif
                                    " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis" id="nav-identitas">Identitas</a>
                                </li>
                                <li class="nav-item" >
                                    <a class="nav-link
                                    @if ($active_nav == 'asesmenawal')
                                    active
                                    @endif
                                    " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/asesmenawal" id="nav-asesmenawal">Asesmen<span style="visibility: hidden;">.</span>Awal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link
                                    @if ($active_nav == 'cppt')
                                    active
                                    @endif
                                    " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/cppt" id="nav-cppt">CPPT</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link 
                                    @if ($active_nav == 'vital')
                                    active
                                    @endif
                                    " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/vital-sign" id="nav-vital">Monitoring</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link
                                    @if ($active_nav == 'diagnosis')
                                    active
                                    @endif
                                    " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/diagnosis" id="nav-diagnosis">Diagnosis<span style="visibility: hidden;">.</span>Medis</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link
                                    @if ($active_nav == 'tindakan')
                                    active
                                    @endif
                                    " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/tindakan" id="nav-tindakan">Tindakan<span style="visibility: hidden;">.</span>Kolaborasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link
                                    @if ($active_nav == 'icd9')
                                    active
                                    @endif
                                    " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/icd9" id="nav-icd9">ICD<span style="visibility: hidden;">.</span>9</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link
                                    @if ($active_nav == 'resep')
                                    active
                                    @endif
                                    " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/resep" id="nav-resep">Resep</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link
                                    @if ($active_nav == 'lokasi')
                                    active
                                    @endif
                                    " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/lokasi" id="nav-lokasi">Lokasi</a>
                                </li>
                            </ul>

                            <ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary mobile-flex row mx-0">
                                <li class="col-4 head-pane">
                                    <a class="pl-0 nav-link  
                                    @if (empty($active_nav) || $active_nav == 'identitas')
                                    active
                                    @endif
                                    " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/identitas" id="nav-identitas">Identitas</a>
                                </li>
                                <li class="col-4 head-pane">
                                    <a class="pl-0 nav-link  
                                    @if ($active_nav == 'vital')
                                    active
                                    @endif
                                    " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/vital-sign" id="nav-vital">Monitoring</a>
                                </li>
                                <li class="col-4 head-pane">
                                    <a class="pl-0 nav-link 
                                    @if ($active_nav == 'cppt')
                                    active
                                    @endif
                                    " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/cppt" id="nav-cppt">CPPT</a>
                                </li>
                                <li class="col-4 head-pane">
                                    <a class="pl-0 nav-link 
                                    @if ($active_nav == 'asesmenawal')
                                    active
                                    @endif
                                    " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/asesmenawal" id="nav-asesmenawal">Asesmen Awal</a>
                                </li>
                                <li class="col-4 head-pane">
                                    <a class="pl-0 nav-link 
                                    @if ($active_nav == 'diagnosis')
                                    active
                                    @endif
                                    " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/diagnosis" id="nav-diagnosis">Diagnosis Medis</a>
                                </li>
                                <li class="col-4 head-pane">
                                    <a class="pl-0 nav-link 
                                    @if ($active_nav == 'tindakan')
                                    active
                                    @endif
                                    " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/tindakan" id="nav-tindakan">Tindakan Kolaborasi</a>
                                </li>
                                <li class="col-4 head-pane">
                                    <a class="pl-0 nav-link
                                    @if ($active_nav == 'icd9')
                                    active
                                    @endif
                                    " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/icd9" id="nav-icd9">ICD<span style="visibility: hidden;">.</span>9</a>
                                </li>
                                <li class="col-4 head-pane">
                                    <a class="pl-0 nav-link 
                                    @if ($active_nav == 'resep')
                                    active
                                    @endif
                                    " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/resep" id="nav-resep">Resep</a>
                                </li>
                                <li class="col-4 head-pane">
                                    <a class="pl-0 nav-link 
                                    @if ($active_nav == 'lokasi')
                                    active
                                    @endif
                                    " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/lokasi" id="nav-lokasi">Lokasi</a>
                                </li>
                                
                            </ul>

                            <div class="block-content">
                                @if($active_nav == 'identitas')
                                @include('kasus.datamedis.content.identitas.index')
                                @elseif($active_nav == 'cppt')
                                @include('kasus.datamedis.content.cppt.index')
                                @elseif($active_nav == 'diagnosis')
                                @include('kasus.datamedis.content.diagnosis.index')
                                @elseif($active_nav == 'tindakan')
                                @include('kasus.datamedis.content.tindakan.index')
                                @elseif($active_nav == 'icd9')
                                @include('kasus.datamedis.content.tindakan-icd9.index')
                                @elseif($active_nav == 'vital')
                                @include('kasus.datamedis.content.vital.index')
                                @elseif($active_nav == 'resep')
                                @include('kasus.datamedis.content.resep.index')
                                @elseif($active_nav == 'lokasi')
                                @include('kasus.datamedis.content.lokasi.index')
                                @elseif($active_nav == 'asesmenawal')
                                @include('kasus.datamedis.content.asesmenawal.index')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@if($active_nav == 'identitas')
@include('kasus.datamedis.content.identitas.edit-identitas-modal')
@include('kasus.datamedis.content.identitas.edit-identitas-medis-modal')
@include('kasus.datamedis.content.identitas.edit-pembayaran-modal')
@include('kasus.datamedis.content.identitas.update-from-rm')

@elseif($active_nav == 'cppt')
@include('kasus.datamedis.content.cppt.create-modal')
@include('kasus.datamedis.content.cppt.adime-modal')
@include('kasus.datamedis.content.cppt.edit-modal')
@include('kasus.datamedis.content.cppt.delete-modal')
@include('kasus.datamedis.content.cppt.deletefile-modal')
@include('kasus.datamedis.content.cppt.override-modal')
@include('kasus.datamedis.content.cppt.review-cppt-modal')
@include('kasus.datamedis.content.cppt.components.modal-covid-form')
@include('kasus.datamedis.content.cppt.components.modal-covid-histori')
@include('kasus.datamedis.content.cppt.histori-modal')
@include('kasus.datamedis.content.cppt.components.modal-readback')

@elseif($active_nav == 'diagnosis')
@include('kasus.datamedis.content.diagnosis.create-modal')
@include('kasus.datamedis.content.diagnosis.delete-modal')
@include('kasus.datamedis.content.diagnosis.modal-update-kanker-stadium')

@elseif($active_nav == 'tindakan')
@include('kasus.datamedis.content.tindakan.modals.create-modal')
@include('kasus.datamedis.content.tindakan.modals.subscribe-modal')
@include('kasus.datamedis.content.tindakan.modals.unsubscribe-modal')
@include('kasus.datamedis.content.tindakan.modals.delete-modal')
@include('kasus.datamedis.content.tindakan.modals.edit-modal')
@include('kasus.datamedis.content.tindakan.modals.create-manual')


@elseif($active_nav == 'icd9')
@include('kasus.datamedis.content.tindakan-icd9.modals.create')
@include('kasus.datamedis.content.tindakan.modals.delete-modal')
@include('kasus.datamedis.content.tindakan.modals.edit-modal')

@elseif($active_nav == 'vital')
@include('kasus.datamedis.content.vital.create-modal')
@include('kasus.datamedis.content.vital.edit-modal')
@include('kasus.datamedis.content.vital.delete-modal')
@include('kasus.datamedis.content.vital.modal-chart')

@elseif($active_nav == 'resep')
@include('kasus.datamedis.content.resep.create-modal')
@include('kasus.datamedis.content.resep.delete-modal')
@include('kasus.datamedis.content.resep.edit-modal')
@include('kasus.datamedis.content.resep.copyresep-modal')

@elseif($active_nav == 'lokasi')
@include('kasus.datamedis.content.lokasi.create-modal')

@elseif($active_nav == 'asesmenawal')
@include('kasus.datamedis.content.asesmenawal.form.form-gawat-darurat')
@include('kasus.datamedis.content.asesmenawal.form.form-rawat-jalan')
@include('kasus.datamedis.content.asesmenawal.form.form-rawat-inap')
@include('kasus.datamedis.content.asesmenawal.form.form-dokter-gawat-darurat')
@include('kasus.datamedis.content.asesmenawal.form.form-dokter-rawat-jalan')
@include('kasus.datamedis.content.asesmenawal.form.form-dokter-rawat-inap')
@include('kasus.datamedis.content.asesmenawal.form.form-triage')
@include('kasus.datamedis.content.asesmenawal.non-jiwa.form.form-dokter-gawat-darurat-non-jiwa')
@include('kasus.datamedis.content.asesmenawal.non-jiwa.form.form-dokter-rawat-jalan-non-jiwa')
@include('kasus.datamedis.content.asesmenawal.non-jiwa.form.form-dokter-rawat-inap-non-jiwa')
@endif









@endsection

@section('css')
<style type="text/css">
#modal-create-tindakan {
    padding-right: 0 !important;
    padding-left: 0 !important;
}
.modal-full {
    min-width: 100%;
    margin: 0 !important;
}
.modal-full .modal-content {
    min-height: 100vh;
}
</style>
@endsection

@section('js')
<script src="{{asset('assets/js/plugins/echarts/echarts.min.js')}}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/amcharts.js') }}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/serial.js') }}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/pie.js') }}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/export.js') }}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/light.js') }}"></script>

<script type="text/javascript">
    @include('kasus.datamedis.content.resep.components.dokter-js');
    $('.js-select2').select2();
    
    function showModal() {
        $('#modal').modal('show');
    }

    jQuery(function () {
        Codebase.helpers(['datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider', 'tags-inputs']);
    });

    /*IDENTITAS*/
    $('#container-identitas-edit-noasuransi').hide();

    

    jQuery( function() {


        @if($active_nav == 'diagnosis')
        AutoCompleteCreateDiagnosis.init();
        @elseif($active_nav == 'tindakan')
        AutoCompleteCreateTindakan.init();
        AutoCompleteEditTindakan.init();
        @elseif($active_nav == 'icd9')
        AutoCompleteCreateTindakanICD9.init();
        AutoCompleteEditTindakanICD9.init();
        @endif

    });

    
</script>

@if($active_nav == 'identitas')
@include('kasus.datamedis.content.js.identitas')
@include('kasus.datamedis.content.js.identitas-edit-pembayaran')
@elseif($active_nav == 'cppt')
@include('kasus.datamedis.content.js.cppt')
@elseif($active_nav == 'diagnosis')
@include('kasus.datamedis.content.js.diagnosis')
@include('kasus.datamedis.content.diagnosis.js-toggle-diagnosis-utama')
@elseif($active_nav == 'tindakan')
@include('kasus.datamedis.content.js.tindakan-main')
@include('kasus.datamedis.content.js.tindakan-perawat')
@include('kasus.datamedis.content.js.tindakan-icd9')
@include('kasus.datamedis.content.js.tindakan-manual')
@elseif($active_nav == 'icd9')
@include('kasus.datamedis.content.js.tindakan-main')
@include('kasus.datamedis.content.js.tindakan-perawat')
@include('kasus.datamedis.content.js.tindakan-icd9')
@elseif($active_nav == 'vital')
@include('kasus.datamedis.content.vital.js')
@include('kasus.datamedis.content.js.vital-sign')
@elseif($active_nav == 'resep')
@include('kasus.datamedis.content.js.resep')
@include('kasus.datamedis.content.js.resep-edit')
@include('kasus.datamedis.content.js.resep-paket')
@include('farmasi.js-features.histori-resep.js')
@if (config('app.fitur_kasus_resep_kategori'))
@include('kasus.datamedis.content.js.js-kategori-resep')
@endif

@elseif($active_nav == 'gizi')
@include('kasus.datamedis.content.js.gizi')
@elseif($active_nav == 'asesmenawal')
@include('kasus.datamedis.content.js.asesmen-awal')
@include('kasus.datamedis.content.js.asesmen-awal-non-jiwa')
@include('kasus.datamedis.content.js.rapt')
@include('kasus.datamedis.content.js.asesmen-awal-alatbantu')
@endif


{{--<script src="{{asset('js/resep/function.js')}}"></script>--}}
<script src="{{asset('js/gizi/function.js')}}"></script>

<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.time').mask('00:00');
    });

    $(".button-kesalahan").click(function(e){
        var content = $(this).data('content');
        if(content != ""){

        }
        $('#modal-terjadi-kesalahan').modal('toggle');
    });

</script>

@endsection
