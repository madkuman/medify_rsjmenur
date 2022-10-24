@extends('kasus.layouts.main')
@section('title')
  {{$kasus->judul_kasus}}  - Pemeriksaan Lab - Kasus
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
                            <ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary" data-toggle="tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link 
                                    @if (session('active_nav') == 'darahlengkap' || empty(session('active_nav')))
                                    active
                                    @endif
                                    " href="#darahlengkap" id="nav-darahlengkap">Darah Lengkap</a>
                                </li>
                                <li class="nav-item"  style="display: none;">
                                    <a class="nav-link 
                                    @if (session('active_nav') == 'hematologi' || empty(session('active_nav')))
                                    active
                                    @endif
                                    " href="#hematologi" id="nav-hematologi">Hematologi</a>
                                </li>
                                <li class="nav-item"  style="display: none;">
                                    <a class="nav-link 
                                    @if (session('active_nav') == 'kimia' || empty(session('active_nav')))
                                    active
                                    @endif
                                    " href="#kimia" id="nav-kimia">Kimia</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link 
                                    @if (session('active_nav') == 'urine')
                                    active
                                    @endif
                                    " href="#urine" id="nav-urine">Urine</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link 
                                    @if (session('active_nav') == 'imun')
                                    active
                                    @endif
                                    " href="#imun" id="nav-imun">Immunologi</a>
                                </li>
<!--                                 <li class="nav-item">
                                    <a class="nav-link 
                                    @if (session('active_nav') == 'smear')
                                    active
                                    @endif
                                    " href="#smear" id="nav-smear">PAP SMEAR</a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link 
                                    @if (session('active_nav') == 'feces')
                                    active
                                    @endif
                                    " href="#feces" id="nav-feces">Feces Lengkap</a>
                                </li>
                            </ul>
                            <div class="block-content tab-content overflow-hidden">
                                <div class="tab-pane fade fade-left
                                @if (session('active_nav') == 'darahlengkap' || empty(session('active_nav')))
                                show active
                                @endif
                                " id="darahlengkap" role="tabpanel">
                                @include('kasus.pemeriksaanlab.content.darahlengkap.index')
                                </div>

                                <div class="tab-pane fade fade-left
                                @if (session('active_nav') == 'hematologi' || empty(session('active_nav')))
                                show active
                                @endif
                                " id="hematologi" role="tabpanel">
                                @include('kasus.pemeriksaanlab.content.hematologi.index')
                                </div>

                                <div class="tab-pane fade fade-left
                                @if (session('active_nav') == 'kimia' || empty(session('active_nav')))
                                show active
                                @endif
                                " id="kimia" role="tabpanel">
                                @include('kasus.pemeriksaanlab.content.kimia.index')
                                </div>
                            
                                <div class="tab-pane fade fade-left
                                @if (session('active_nav') == 'urine')
                                show active
                                @endif
                                " id="urine" role="tabpanel">
                                @include('kasus.pemeriksaanlab.content.urine.index')
                                </div>
                            
                                <div class="tab-pane fade fade-left
                                @if (session('active_nav') == 'imun')
                                show active
                                @endif
                                " id="imun" role="tabpanel">
                                @include('kasus.pemeriksaanlab.content.immunologi.index')
                                </div>
                            
                                <!-- <div class="tab-pane fade fade-left
                                @if (session('active_nav') == 'smear')
                                show active
                                @endif
                                " id="smear" role="tabpanel">
                                @include('kasus.pemeriksaanlab.content.papsmear.index')
                                </div> -->
                            
                                <div class="tab-pane fade fade-left
                                @if (session('active_nav') == 'feces')
                                show active
                                @endif
                                " id="feces" role="tabpanel">
                                @include('kasus.pemeriksaanlab.content.feces.index')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Updates -->
        </div>
    </div>
</main>
<!-- END Main Container -->

@include('kasus.pemeriksaanlab.content.darahlengkap.create-modal')
@include('kasus.pemeriksaanlab.content.darahlengkap.edit-modal')
@include('kasus.pemeriksaanlab.content.darahlengkap.delete-modal')

@include('kasus.pemeriksaanlab.content.hematologi.create-modal')
@include('kasus.pemeriksaanlab.content.hematologi.edit-modal')
@include('kasus.pemeriksaanlab.content.hematologi.delete-modal')

@include('kasus.pemeriksaanlab.content.kimia.create-modal')
@include('kasus.pemeriksaanlab.content.kimia.edit-modal')
@include('kasus.pemeriksaanlab.content.kimia.delete-modal')

@include('kasus.pemeriksaanlab.content.urine.create-modal')
@include('kasus.pemeriksaanlab.content.urine.edit-modal')
@include('kasus.pemeriksaanlab.content.urine.delete-modal')

@include('kasus.pemeriksaanlab.content.immunologi.edit-modal')
@include('kasus.pemeriksaanlab.content.immunologi.create-modal')
@include('kasus.pemeriksaanlab.content.immunologi.delete-modal')

{{-- @include('kasus.pemeriksaanlab.content.papsmear.edit-modal')
@include('kasus.pemeriksaanlab.content.papsmear.create-modal')
@include('kasus.pemeriksaanlab.content.papsmear.delete-modal') --}}

@include('kasus.pemeriksaanlab.content.feces.edit-modal')
@include('kasus.pemeriksaanlab.content.feces.create-modal')
@include('kasus.pemeriksaanlab.content.feces.delete-modal')
@endsection

@section('css')
<style type="text/css">
        #modal-create-tindakan {
            padding-right: 0 !important;
            padding-left: 0 !important;
        }
        .modal-full {
            min-width: 100%;
            margin: 0;
        }
        .modal-full .modal-content {
            min-height: 100vh;
        }
</style>
@endsection

@section('js')
<script type="text/javascript">
    $(".nav-tabs").find("li a").last().click();

    var url = document.URL;
    var hash = url.substring(url.indexOf('#'));

    $(".nav-tabs").find("li a").each(function(key, val) {

      if (hash == $(val).attr('href')) {
        $(val).click();
      }
      $(val).click(function(ky, vl) {
        console.log($(this).attr('href')+"1");
        location.hash = $(this).attr('href');
      });

    });

   window.onhashchange = locationchange;

    function locationchange()
    {   
        var lokasi = location.hash;
        var satuan = lokasi.split("");
        satuan.splice(0,1);
        var hash_baru = satuan.join("");
        console.log(location.hash_baru+"2");
        if(lokasi === '')
        {
            $('.tab-pane').removeClass('show active');
            $('.nav-link').removeClass('active');
            $('#darahlengkap').addClass('show active');
            $('#nav-darahlengkap').addClass('active');    
        }
        else
        {
            $('.tab-pane').removeClass('show active');
            $('.nav-link').removeClass('active');
            $(''+lokasi+'').addClass('show active');
            $('#nav-'+hash_baru+'').addClass('active');    
        }
    }
    
   $(document).ready(function() {
    locationchange();
   });

   $('form input').keydown(function (e) {
        if (e.keyCode == 13) {
            var inputs = $(this).parents("form").eq(0).find(":input");
            if (inputs[inputs.index(this) + 1] != null) {                    
                inputs[inputs.index(this) + 1].focus();
            }
            e.preventDefault();
            return false;
        }
    });

   
</script>
@include('kasus.pemeriksaanlab.content.darahlengkap.components.darah-js')
@include('kasus.pemeriksaanlab.content.urine.components.urine-js')
@include('kasus.pemeriksaanlab.content.immunologi.components.immunologi-js')
@include('kasus.pemeriksaanlab.content.papsmear.components.papsmear-js')
@include('kasus.pemeriksaanlab.content.feces.components.feces-js')
@endsection
