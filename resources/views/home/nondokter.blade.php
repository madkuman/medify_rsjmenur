@extends('layouts.main2')

@section('title')
Home
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
                                    <div style="padding-top: 20%; padding-bottom: 20%; text-align: center; font-weight: bold; font-size: 16px;">
                                        Fitur ini tidak tersedia untuk Anda
                                    </div>
                                </div>
                                <div class="tab-pane fade fade-left" id="kasus-rawatjalan" role="tabpanel">
                                    <div style="padding-top: 20%; padding-bottom: 20%; text-align: center; font-weight: bold; font-size: 16px;">
                                        Fitur ini tidak tersedia untuk Anda
                                    </div>
                                </div>
                                <div class="tab-pane fade fade-left" id="kasus-igd" role="tabpanel">
                                    <div style="padding-top: 20%; padding-bottom: 20%; text-align: center; font-weight: bold; font-size: 16px;">
                                        Fitur ini tidak tersedia untuk Anda
                                    </div>
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
    var options = {
        valueNames: [ 'case-title', 'patient-name' ]
    };

    var rawatInapList = new List('kasus-rawatinap', options);
    var rawatJalanList = new List('kasus-rawatjalan', options);
    var igdList = new List('kasus-igd', options);

    $(".fuzzy-search").keyup(function(){
        rawatInapList.search($(this).val());
        rawatJalanList.search($(this).val());
        igdList.search($(this).val());
    });
</script>
@endsection
