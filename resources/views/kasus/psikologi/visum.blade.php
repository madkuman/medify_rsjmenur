@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Psikologi - Visum
@endsection

@section('content')
<main id="main-container">
    @include('kasus.layouts.header')

    <div class="content">
        <div class="row">
            @include('kasus.layouts.sidebar')
            <div class="col-lg-9 col-xl-9">
                <div class="block">
                	<div class="block-header">
						<h3 class="block-title">Visum</h3>
					</div>
                	<div class="block-content">
                        <div class="block border-0">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link tab-default-nav active" href="#ver-deskriptif">VER Deskriptif</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tab-psikogram-nav" href="#psikogram">Psikogram</a>
                                </li>
                            </ul>
                            <div class="block-content p-0 tab-content">
                                <div class="tab-pane active" id="ver-deskriptif" role="tabpanel">
                                    @include('kasus.alatbantu.pemeriksaan-psikologi-visum.index')
                                </div>
                                <div class="tab-pane" id="psikogram" role="tabpanel">
                                    @include('kasus.alatbantu.psikogram-visum.index')
                                </div>
                            </div>
                        </div>
                	</div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
    var verDeskriptif = JSON.parse({!!json_encode(str_replace("`", "'", $pemeriksaan_psikologi_visum))!!});
    var psikogram = JSON.parse({!!json_encode(str_replace("`", "'", $psikogram_visum))!!});
    var tab = "{{session('tab')}}";

    $(document).ready(function(){
        $(".time").mask("00:00");

        if (tab == 'psikogram_visum') {
            $('#psikogram').addClass('active show');
            $('#ver-deskriptif').removeClass('active show');

            $("a[href$='#psikogram']").addClass('active show');
            $("a[href$='#ver-deskriptif']").removeClass('active show');

        } else if (tab == 'pemeriksaan_visum') {
            $('#psikogram').removeClass('active show');
            $('#ver-deskriptif').addClass('active show');

            $("a[href$='#psikogram']").removeClass('active show');
            $("a[href$='#ver-deskriptif']").addClass('active show');
        }
    });

    function nl2br (str, is_xhtml) {   
        var breakTag = (is_xhtml || typeof is_xhtml === "undefined") ? "<br />" : "<br>";    
        return (str + "").replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, "$1"+ breakTag +"$2");
    }

    $('#ver-deskriptif').on('click', '.deleteBtn', function(e){
        e.preventDefault();
        id = $(this).data("id");
        $("#ver-deskriptif #deleteInputId").val(id);
        swal({
            title: "Hapus",
            text: "Apakah anda yakin akan menghapus data ini?",
            showCancelButton: true,
            reverseButtons: true,
            type: "warning",
            confirmButtonClass: "btn btn-danger",
            cancelButtonClass: "btn btn-default",
            confirmButtonText: "Hapus",
            cancelButtonText: "Kembali",
            closeOnConfirm: false
        }).then(function(result) {
            if(result.value)
            {
                $("#ver-deskriptif #formDelete").submit();
            }
        });
    });

    $('#ver-deskriptif').on('click', '.editBtn', function(e){
        id = $(this).data("id");
        var item = verDeskriptif[$(this).data("index")];
        resetForm('ver-deskriptif');

        if (item != "" && item != undefined) {
            $("#ver-deskriptif #id").val(item.id);
            @include("kasus.alatbantu.pemeriksaan-psikologi-visum.js-form-edit")
        } else {
            $("#ver-deskriptif #id").val(0);
            resetForm('ver-deskriptif');

            var date = new Date();
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

            $('.js-datepicker').datepicker('setDate', today);
        }
        $("#ver-deskriptif #addModal").modal("toggle");
    });

    $('#ver-deskriptif').on('click', '.showBtn', function(e){
        id = $(this).data("id");

        var item = verDeskriptif[$(this).data("index")];
        var tujuan_pemeriksaan = item.tujuan_pemeriksaan ? item.tujuan_pemeriksaan : "-";
        var tanggal_pemeriksaan = item.tanggal_pemeriksaan ? formatDate(item.tanggal_pemeriksaan) : "-";
        var hasil = item.hasil ? nl2br(item.hasil) : "-";
        
        var hasil = `@include("kasus.alatbantu.pemeriksaan-psikologi-visum.hasil")`;
        $("#ver-deskriptif #showModalHasil #myModalBody").html(hasil);
        $("#ver-deskriptif #showModalHasil").modal("toggle");
    });

    function formatDate (input) {
        if (input === null) {
            return null;
        } else {
            var datePart = input.match(/\d+/g),
            year = datePart[0],
            month = datePart[1], day = datePart[2];

            return day+"/"+month+"/"+year;
        }
    }

    $('#psikogram').on('click', '.deleteBtn', function(e){
        e.preventDefault();
        id = $(this).data("id");
        $("#psikogram #deleteInputId").val(id);
        swal({
            title: "Hapus",
            text: "Apakah anda yakin akan menghapus data ini?",
            showCancelButton: true,
            reverseButtons: true,
            type: "warning",
            confirmButtonClass: "btn btn-danger",
            cancelButtonClass: "btn btn-default",
            confirmButtonText: "Hapus",
            cancelButtonText: "Kembali",
            closeOnConfirm: false
        }).then(function(result) {
            if(result.value)
            {
                $("#psikogram #formDelete").submit();
            }
        });
    });

    $('#psikogram').on('click', '.editBtn', function(e){
        id = $(this).data("id");
        var item = psikogram[$(this).data("index")];
        resetForm('psikogram-visum');

        if (item != "" && item != undefined) {
            $("#psikogram #id").val(item.id);
            @include("kasus.alatbantu.psikogram-visum.js-form-edit");
        } else {
            $("#psikogram #id").val(0);
            resetForm('psikogram-visum');
            
            var date = new Date();
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

            $('.js-datepicker').datepicker('setDate', today);
        }
        $("#psikogram #addModal").modal("toggle");
    });

    $('#psikogram').on('click', '.showBtn', function(e){
        id = $(this).data("id");

        var item = psikogram[$(this).data("index")];
        var tanggal_pemeriksaan = item.tanggal_pemeriksaan ? formatDate(item.tanggal_pemeriksaan) : "-";
        var tujuan_pemeriksaan = item.tujuan_pemeriksaan ? item.tujuan_pemeriksaan : "-";
        var rujukan_dari = item.rujukan_dari ? item.rujukan_dari : "-";
        var intelegensi_umum = item.intelegensi_umum ? item.intelegensi_umum : "-";
        var daya_nalar = item.daya_nalar ? item.daya_nalar : "-";
        var daya_analisa_sintesa = item.daya_analisa_sintesa ? item.daya_analisa_sintesa : "-";
        var fleksibilitas_berpikir = item.fleksibilitas_berpikir ? item.fleksibilitas_berpikir : "-";
        var kemampuan_berkomunikasi = item.kemampuan_berkomunikasi ? item.kemampuan_berkomunikasi : "-";
        var kemampuan_pengambilan_keputusan = item.kemampuan_pengambilan_keputusan ? item.kemampuan_pengambilan_keputusan : "-";
        var kreativitas = item.kreativitas ? item.kreativitas : "-";
        var potensi_kerja = item.potensi_kerja ? item.potensi_kerja : "-";
        var perencanaan_kerja = item.perencanaan_kerja ? item.perencanaan_kerja : "-";
        var daya_tahan_kerja = item.daya_tahan_kerja ? item.daya_tahan_kerja : "-";
        var inisiatif = item.inisiatif ? item.inisiatif : "-";
        var motivasi_dorongan_ambisi = item.motivasi_dorongan_ambisi ? item.motivasi_dorongan_ambisi : "-";
        var komitmen_pada_tugas = item.komitmen_pada_tugas ? item.komitmen_pada_tugas : "-";
        var stabilitas_emosi = item.stabilitas_emosi ? item.stabilitas_emosi : "-";
        var kerja_sama = item.kerja_sama ? item.kerja_sama : "-";
        var kepekaan_sosial = item.kepekaan_sosial ? item.kepekaan_sosial : "-";
        
        var hasil = `@include("kasus.alatbantu.psikogram-visum.hasil")`;
        $("#psikogram #showModalHasil #myModalBody").html(hasil);
        $("#psikogram #showModalHasil").modal("toggle");
    });

    function resetForm(type) {
        if (type == 'ver-deskriptif') {
            @include("kasus.alatbantu.pemeriksaan-psikologi-visum.js-form-create")
        } else if (type == 'psikogram-visum') {
            @include("kasus.alatbantu.psikogram-visum.js-form-create");
        }
    }
</script>
@endsection