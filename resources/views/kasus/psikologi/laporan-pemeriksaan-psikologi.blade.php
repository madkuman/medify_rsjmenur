@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Psikologi - Laporan Pemeriksaan Psikologi
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
                      <h3 class="block-title">Laporan Pemeriksaan Psikologi</h3>
                  </div>
                  <div class="block-content">
                    <div class="block border-0">
                        <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link tab-default-nav active" href="#deskripsi">Deskripsi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tab-psikogram-nav" href="#psikogram">Psikogram</a>
                            </li>
                        </ul>
                        <div class="block-content p-0 tab-content">
                            <div class="tab-pane active" id="deskripsi" role="tabpanel">
                                @include('kasus.asesmen.laporan-deskripsi-pemeriksaan-psikologi.index')
                            </div>
                            <div class="tab-pane" id="psikogram" role="tabpanel">
                                @include('kasus.asesmen.laporan-psikogram-pemeriksaan-psikologi.index')
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
    var deskripsi = JSON.parse({!!json_encode(str_replace("`", "'", $laporan_deskripsi_pemeriksaan_psikologi))!!});
    var psikogram = JSON.parse({!!json_encode(str_replace("`", "'", $laporan_psikogram_pemeriksaan_psikologi))!!});
    var tab = "{{session('tab')}}";

    $(document).ready(function(){
        $(".time").mask("00:00");

        if (tab == 'psikogram') {
            $('#psikogram').addClass('active show');
            $('#deskripsi').removeClass('active show');

            $("a[href$='#psikogram']").addClass('active show');
            $("a[href$='#deskripsi']").removeClass('active show');

        } else if (tab == 'deskripsi') {
            $('#psikogram').removeClass('active show');
            $('#deskripsi').addClass('active show');

            $("a[href$='#psikogram']").removeClass('active show');
            $("a[href$='#deskripsi']").addClass('active show');
        }
    });

    function nl2br (str, is_xhtml) {   
        var breakTag = (is_xhtml || typeof is_xhtml === "undefined") ? "<br />" : "<br>";    
        return (str + "").replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, "$1"+ breakTag +"$2");
    }

    $('#deskripsi').on('click', '.deleteBtn', function(e){
        e.preventDefault();
        id = $(this).data("id");
        $("#deskripsi #deleteInputId").val(id);
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
                $("#deskripsi #formDelete").submit();
            }
        });
    });

    $('#deskripsi').on('click', '.editBtn', function(e){
        id = $(this).data("id");
        var item = deskripsi[$(this).data("index")];
        resetForm('deskripsi');

        if (item != "" && item != undefined) {
            $("#deskripsi #id").val(item.id);
            @include("kasus.asesmen.laporan-deskripsi-pemeriksaan-psikologi.js-form-edit")
        } else {
            $("#deskripsi #id").val(0);
            resetForm('deskripsi');

            var date = new Date();
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

            $('.js-datepicker').datepicker('setDate', today);
        }
        $("#deskripsi #addModal").modal("toggle");
    });

    $('#deskripsi').on('click', '.showBtn', function(e){
        id = $(this).data("id");

        var item = deskripsi[$(this).data("index")];
        var tujuan_pemeriksaan = item.tujuan_pemeriksaan ? item.tujuan_pemeriksaan : "-";
        var rujukan_dari = item.rujukan_dari ? item.rujukan_dari : "-";
        var tanggal_pemeriksaan = item.tanggal_pemeriksaan ? formatDate(item.tanggal_pemeriksaan) : "-";
        var hasil = item.hasil ? nl2br(item.hasil) : "-";
        
        var hasil = `@include("kasus.asesmen.laporan-deskripsi-pemeriksaan-psikologi.hasil")`;
        $("#deskripsi #showModalHasil #myModalBody").html(hasil);
        $("#deskripsi #showModalHasil").modal("toggle");
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
        resetForm('psikogram');

        if (item != "" && item != undefined) {
            $("#psikogram #id").val(item.id);
            @include("kasus.asesmen.laporan-psikogram-pemeriksaan-psikologi.js-form-edit");
        } else {
            $("#psikogram #id").val(0);
            resetForm('psikogram');
            
            var date = new Date();
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

            $('.js-datepicker').datepicker('setDate', today);
        }
        $("#psikogram #addModal").modal("toggle");
    });

    $('#psikogram').on('click', '.showBtn', function(e){
        id = $(this).data("id");

        var item = psikogram[$(this).data("index")];
        var tujuan_pemeriksaan = item.tujuan_pemeriksaan ? item.tujuan_pemeriksaan : "-";
        var rujukan_dari = item.rujukan_dari ? item.rujukan_dari : "-";
        var kemampuan_intelektual_berfungsi_pada_taraf = item.kemampuan_intelektual_berfungsi_pada_taraf ? item.kemampuan_intelektual_berfungsi_pada_taraf : "-";
        var kesimpulan = item.kesimpulan ? item.kesimpulan : "-";
        var tanggal_pemeriksaan = item.tanggal_pemeriksaan ? formatDate(item.tanggal_pemeriksaan) : "-";
        var kecerdasan_umum = item.kecerdasan_umum ? item.kecerdasan_umum : "-";
        var stabilitas_emosi = item.stabilitas_emosi ? item.stabilitas_emosi : "-";
        var kemampuan_adaptasi = item.kemampuan_adaptasi ? item.kemampuan_adaptasi : "-";
        var kepekaan_sosial = item.kepekaan_sosial ? item.kepekaan_sosial : "-";
        var motivasi = item.motivasi ? item.motivasi : "-";
        var daya_tahan_terhadap_stres = item.daya_tahan_terhadap_stres ? item.daya_tahan_terhadap_stres : "-";
        
        var hasil = `@include("kasus.asesmen.laporan-psikogram-pemeriksaan-psikologi.hasil")`;
        $("#psikogram #showModalHasil #myModalBody").html(hasil);
        $("#psikogram #showModalHasil").modal("toggle");
    });

    function resetForm(type) {
        if (type == 'deskripsi') {
            @include("kasus.asesmen.laporan-deskripsi-pemeriksaan-psikologi.js-form-create")
        } else if (type == 'psikogram') {
            @include("kasus.asesmen.laporan-psikogram-pemeriksaan-psikologi.js-form-create");
        }
    }
</script>
@endsection