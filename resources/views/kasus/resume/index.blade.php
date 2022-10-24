@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}}  - Ringkasan Pulang - Kasus
@endsection


@section('content')

<!-- Main Container -->
<main id="main-container">
    @include('kasus.layouts.header')

    <div class="content">
        <div class="row">
            @include('kasus.layouts.sidebar')

            <!-- Updates -->
            <div class="col-lg-4 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="block rounded p-0">
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

                            @include('kasus.resume.navbar')
                            
                            @if($active_nav == 'ringkasan_pasien_pulang' || empty($active_nav))
                            @include('kasus.resume.ringkasan-pasien-pulang.index')

                            @elseif($active_nav == 'ringkasan_masuk_keluar')
                            @include('kasus.resume.ringkasan-pasien-masuk-dan-keluar.index')

                            @elseif($active_nav == 'resume_gawat_darurat')
                            @include('kasus.resume.resume-gawat-darurat.index')

                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Updates -->
        </div>
    </div>
</main>
<form method="POST" action="{{url()->current()}}/delete" id="formDelete">
    {{csrf_field()}}
    <input name="id" type="hidden" id="deleteInputId">
    
</form>

@if($active_nav == 'ringkasan_pasien_pulang' || empty($active_nav))
@include("kasus.asesmen.ringkasan-pasien-pulang.modal")
@include("kasus.asesmen.ringkasan-pasien-pulang.modal-hasil")

@elseif($active_nav == 'ringkasan_masuk_keluar')
@include("kasus.asesmen.ringkasan-pasien-masuk-dan-keluar.modal")
@include("kasus.asesmen.ringkasan-pasien-masuk-dan-keluar.modal-hasil")

@elseif($active_nav == 'resume_gawat_darurat')
@include("kasus.asesmen.resume-gawat-darurat.modal")
@include("kasus.asesmen.resume-gawat-darurat.modal-hasil")

@endif
@endsection


@section('js')

@if($active_nav == 'ringkasan_pasien_pulang' || empty($active_nav))
@include("kasus.asesmen.ringkasan-pasien-pulang.js-index")

@elseif($active_nav == 'ringkasan_masuk_keluar')
@include("kasus.asesmen.ringkasan-pasien-masuk-dan-keluar.js-index")

@elseif($active_nav == 'resume_gawat_darurat')
@include("kasus.asesmen.resume-gawat-darurat.js-index")

@endif
@endsection