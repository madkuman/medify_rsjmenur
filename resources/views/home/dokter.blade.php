@extends('layouts.main2')

@section('title')
Home
@endsection

@section('css')
<style type="text/css">
    .kasus-rawatjalan-empty, .kasus-rawatinap-empty, .kasus-igd-empty{
        display: none;
    }
</style>
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <div class="row">
            <div class="col-xl-3">
                @include('home.home-components.sidebar-left')
            </div>

            <div class="col-xl-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="block kasus-list">
                            <ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#kasus-rawatinap">Rawat Inap</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#kasus-rawatjalan">Rawat Jalan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#kasus-igd">IGD</a>
                                </li>
                            </ul>
                            <div class="col-12 mt-10">
                                <input type="text" class="form-control fuzzy-search" placeholder="Cari Kasus">
                            </div>
                            <div class="block-content tab-content overflow-hidden">
                                <div class="tab-pane fade fade-left show active" id="kasus-rawatinap" role="tabpanel">
                                    <ul class="nav-users pull-all nav-users-big list" id="kasus-rawatinap-container">
                                        <div class="col-12 text-center py-50 kasus-loading">
                                            <i class="fa fa-spin fa-spinner fa-4x text-primary"></i>
                                        </div>
                                        <div class="col-12 text-center py-50 kasus-rawatinap-empty">
                                            <h4 class="font-w400 mb-5">Belum ada kasus untuk Rawat Inap</h4>
                                        </div>
                                    </ul>
                                    <p class="text-center kasus-rawatinap-empty">
                                        <a class="link-effect" href="javascript:void(0)" data-toggle="modal" data-target="#modal-how-to-kasus">Bagaimana cara mendapatkan kasus?</a>
                                    </p>
                                </div>
                                <div class="tab-pane fade fade-left" id="kasus-rawatjalan" role="tabpanel">
                                    <ul class="nav-users pull-all nav-users-big list" id="kasus-rawatjalan-container">
                                        <div class="col-12 text-center py-50 kasus-loading">
                                            <i class="fa fa-spin fa-spinner fa-4x text-primary"></i>
                                        </div>
                                        <div class="col-12 text-center py-50 kasus-rawatjalan-empty">
                                            <h4 class="font-w400 mb-5">Belum ada kasus untuk Rawat Jalan</h4>
                                        </div>
                                    </ul>
                                    <p class="text-center kasus-rawatjalan-empty">
                                        <a class="link-effect" href="javascript:void(0)" data-toggle="modal" data-target="#modal-how-to-kasus">Bagaimana cara mendapatkan kasus?</a>
                                    </p>
                                </div>
                                <div class="tab-pane fade fade-left" id="kasus-igd" role="tabpanel">
                                    <ul class="nav-users pull-all nav-users-big list" id="kasus-igd-container">
                                        <div class="col-12 text-center py-50 kasus-loading">
                                            <i class="fa fa-spin fa-spinner fa-4x text-primary"></i>
                                        </div>
                                        <div class="col-12 text-center py-50 kasus-igd-empty">
                                            <h4 class="font-w400 mb-5">Belum ada kasus untuk IGD</h4>
                                        </div>
                                    </ul>
                                    <p class="text-center kasus-igd-empty">
                                        <a class="link-effect" href="javascript:void(0)" data-toggle="modal" data-target="#modal-how-to-kasus">Bagaimana cara mendapatkan kasus?</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                @include('home.home-components.sidebar-right')
            </div>
        </div>
    </div>
</main>

@include('home.modals.how-to-kasus')
@include('home.modals.undangan')
@include('home.modals.undangan-grup')




@endsection

@section('js')
<script src="assets/js/pages/be_pages_dashboard.js"></script>
<script type="text/javascript">
    function openModalUndanganKasus(id)
    {
        $.ajax({
            url: '{{url("api")}}/undangan-kasus-saya/'+id,
            type: "GET",
            dataType: "json",
            success: function(data){
                console.log(data);
                $('#modalUndangan #id-undangan').html(data.id);
                $('#modalUndangan #img').attr("src","{{url('')}}/"+data.img);
                $('#modalUndangan #nama').text(data.nama)
                $('#modalUndangan #gender').text(data.jenis_kelamin)
                $('#modalUndangan #usia').text(data.age)
                $('#modalUndangan #judulkasus').text(data.judul_kasus)
                $('#modalUndangan #layanan').text(data.layanan)
                $('#modalUndangan #lokasi').text(data.lokasi)
                $('#modalUndangan #creator-name').text(data.creator_name)
                $('#modalUndangan #message').text(data.message)
                $('#modalUndangan #creator-date').text(data.creator_date)
                $('#modalUndangan #inputIDUndangan').val(data.id)
                $('#modalUndangan').modal('show');
            }
        });

    }

    function openModalUndanganGrup(id)
    {
        $.ajax({
            url: '{{url("api")}}/undangan-grup-saya/'+id,
            type: "GET",
            dataType: "json",
            success: function(data){
                var slug = data.slug;
                var link = '{{url("")}}/group/'+slug+'/members';
                $('#modalUndanganGrup #link').attr("href", link);
                $('#modalUndanganGrup #nama').text(data.nama)
                $('#modalUndanganGrup #creator-name').text(data.creator_name)
                $('#modalUndanganGrup #creator-date').text(data.creator_date)
                $('#modalUndanganGrup #inputIDUndangan').val(data.id)
                $('#modalUndanganGrup').modal('show');
            }
        });

    }

    function seedKasus()
    {
        $.ajax({
            url: '{{url("api")}}/get-kasus-aktif',
            type: "GET",
            dataType: "json",
            success: function(data){
                var igdshow = 1;
                var rawatjalanshow = 1;
                var rawatinapshow = 1;
                $.each(data, function(key, item) {
                    if(item?.lokasi?.lokasi?.departemen == undefined)
                        return
                    var content = 
                    `
                    <li>
                    <a class="pl-20" href="{{url('kasus')}}/`+(item?.nomor_kasus == undefined ? '-' : item.nomor_kasus)+`">
                    <div class="row no-gutters">
                    <div class="col-2">
                    <img class="img-avatar" src="{{asset('')}}/`+(item?.identitas?.avatar_thumb == undefined ? '-' : item.identitas.avatar_thumb)+`" alt="">
                    </div>
                    <div class="col-8">
                    <span class="text-uppercase case-title"> `+(item?.judul_kasus == undefined ? '-' : item.judul_kasus)+` </span>
                    <div class="font-w400 font-size-s text-black patient-name"> `+(item?.identitas?.nama == undefined ? '-' : item.identitas.nama)+`</div>
                    <div class="font-w400 font-size-xs text-muted">`+(item?.identitas?.gender == undefined ? '-' : item.identitas.gender)+`, `+(item?.identitas?.age == undefined ? '-' : item.identitas.age)+`</div>
                    <div class="font-w400 font-size-xs text-muted lokasi">`+(item?.lokasi?.lokasi?.nama == undefined ? '-' : item.lokasi.lokasi.nama)+`</div>
                    </div>                     
                    </div>
                    </a>
                    </li>
                    `
                    if(item.lokasi.lokasi.departemen.id == 1)
                    {
                        igdshow = 0;
                        $('#kasus-igd-container').append(content)
                    }
                    else if(item.lokasi.lokasi.departemen.id == 2)
                    {
                        rawatjalanshow = 0;
                        $('#kasus-rawatjalan-container').append(content)
                    }
                    else if(item.lokasi.lokasi.departemen.id == 3)
                    {
                        rawatinapshow = 0;
                        $('#kasus-rawatinap-container').append(content)
                    }
                });
                $('.kasus-loading').hide();
                if(igdshow) $('.kasus-igd-empty').show();
                if(rawatjalanshow) $('.kasus-rawatjalan-empty').show();
                if(rawatinapshow) $('.kasus-rawatinap-empty').show();
                initSearch();

            }
        });
    }
    seedKasus()

    $('#buttonTerimaUndangan').click(function() {
        $('#undanganForm').attr('action', "{{url('api/kasus/kolaborator/terima-undangan')}}").submit();
    });

    $('#buttonTolakUndangan').click(function() {
        $('#undanganForm').attr('action', "{{url('api/kasus/kolaborator/tolak-undangan')}}").submit();
    });

    $('#buttonTerimaUndanganGrup').click(function() {
        $('#undanganGrupForm').attr('action', "{{url('api/group/invite/accept')}}").submit();
    });

    $('#buttonTolakUndanganGrup').click(function() {
        $('#undanganGrupForm').attr('action', "{{url('api/group/invite/decline')}}").submit();
    });

    $('#expand-module').click(function(){
        $('.module-hidden').slideToggle('slow');
        $('#shrink-module').css("display","inline-block");
        $(this).css("display","none");
    });
    $('#shrink-module').click(function(){
        $('.module-hidden').slideToggle('slow');
        $('#expand-module').css("display","inline-block");
        $(this).css("display","none");
    });

</script>
<script src="{{asset('assets/js/plugins/listjs/list.min.js')}}"></script>
<script type="text/javascript">
    function initSearch()
    {
        var options = {
            valueNames: [ 'case-title', 'patient-name','lokasi' ]
        };

        var rawatInapList = new List('kasus-rawatinap', options);
        var rawatJalanList = new List('kasus-rawatjalan', options);
        var igdList = new List('kasus-igd', options);

        $(".fuzzy-search").keyup(function(){
            rawatInapList.search($(this).val());
            rawatJalanList.search($(this).val());
            igdList.search($(this).val());
        });
    }
</script>
@endsection
