@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Psikologi - Pemeriksaan Dewasa
@endsection

@section('css')
<style type="text/css">
    .w-100 {
        width: 100% !important;
    }
    .padding-0 {
        padding: 0 !important;
    }
    .table-bordered {
        border: none !important;
    }
</style>
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
						<h3 class="block-title">Pemeriksaan Psikologi Anak</h3>
					</div>
                	<div class="block-content">
                        <div class="block border-0">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tes-iq-keswara">Pemeriksaan Psikologi Keswara</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tes-minat-bakat">Tes Bakat Minat Anak</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#identifikasi-potensi-psikologi">Identifikasi Potensi Psikologi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#pemeriksaan-psikologis-anak">Psikogram</a>
                                </li>
                            </ul>
                            <div class="block-content padding-0 tab-content">
                                <div class="tab-pane active" id="tes-iq-keswara" role="tabpanel">
                                    @include('kasus.alatbantu.tes-iq-keswara.index')
                                </div>
                                <div class="tab-pane" id="tes-minat-bakat" role="tabpanel">
                                    @include('kasus.psikologi.bakat-minat-anak.index')
                                </div>
                                <div class="tab-pane" id="identifikasi-potensi-psikologi" role="tabpanel">
                                    @include('kasus.psikologi.identifikasi-potensi-psikologi.index')
                                </div>
                                <div class="tab-pane" id="pemeriksaan-psikologis-anak" role="tabpanel">
                                    @include('kasus.psikologi.pemeriksaan-psikologis-anak.index')
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
    var data = JSON.parse({!!json_encode(str_replace("`", "'", $tes_iq_keswara))!!});
    var $bakat_minat_anak = JSON.parse({!!json_encode(str_replace("`", "'", $bakat_minat_anak))!!});
    var $identifikasi_potensi_psikologi = JSON.parse({!!json_encode(str_replace("`", "'", $identifikasi_potensi_psikologi))!!});
    var $pemeriksaan_psikologis_anak = JSON.parse({!!json_encode(str_replace("`", "'", $pemeriksaan_psikologis_anak))!!});

    $(document).ready(function(){
        $(".time").mask("00:00");
    });

    function nl2br (str, is_xhtml) {   
        var breakTag = (is_xhtml || typeof is_xhtml === "undefined") ? "<br />" : "<br>";    
        return (str + "").replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, "$1"+ breakTag +"$2");
    }

    $(".deleteBtn").click(function(e){
        e.preventDefault();

        var $this = $(this);
        var id = $this.data("id");
        var tipe_asesmen = $this.parents('.tab-pane').attr('id');

        $("#"+ tipe_asesmen +" #deleteInputId").val(id);
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
                $("#"+ tipe_asesmen +" #formDelete").submit();
            }
        });
    });

    $(".editBtn").click(function(e){

        var $this = $(this);
        var id = $this.data("id");
        var tipe_asesmen = $this.parents('.tab-pane').attr('id');

        if (tipe_asesmen == 'tes-iq-keswara') {
            var item = data[$(this).data("index")];
            resetForm('tes-iq-keswara');

            if (item != "" && item != undefined) {
                $("#" + tipe_asesmen + " #id").val(item.id);
                @include("kasus.alatbantu.tes-iq-keswara.js-form-edit")
            } else {
                $("#" + tipe_asesmen + " #id").val(0);
                resetForm('tes-iq-keswara');

                var date = new Date();
                var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

                $('.js-datepicker').datepicker('setDate', today);
            }    
        } else if (tipe_asesmen == 'tes-minat-bakat') {
            var item = $bakat_minat_anak[$this.data("index")];
            resetForm('tes-minat-bakat');

            if (item != "" && item != undefined) {
                $("#" + tipe_asesmen + " #id").val(item.id);
                @include("kasus.psikologi.bakat-minat-anak.js-form-edit")
            } else {
                $("#" + tipe_asesmen + " #id").val(0);
                resetForm('tes-minat-bakat');

                var date = new Date();
                var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

                $('.js-datepicker').datepicker('setDate', today);
            }
        } else if (tipe_asesmen == 'identifikasi-potensi-psikologi') {
            var item = $identifikasi_potensi_psikologi[$this.data("index")];
            resetForm('identifikasi-potensi-psikologi');

            if (item != "" && item != undefined) {
                $("#" + tipe_asesmen + " #id").val(item.id);
                @include("kasus.psikologi.identifikasi-potensi-psikologi.js-form-edit")
            } else {
                $("#" + tipe_asesmen + " #id").val(0);
                resetForm('identifikasi-potensi-psikologi');

                var date = new Date();
                var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

                $('.js-datepicker').datepicker('setDate', today);
            }
        } else if (tipe_asesmen == 'pemeriksaan-psikologis-anak') {
            var item = $pemeriksaan_psikologis_anak[$this.data("index")];
            resetForm('pemeriksaan-psikologis-anak');

            if (item != "" && item != undefined) {
                $("#" + tipe_asesmen + " #id").val(item.id);
                @include("kasus.psikologi.pemeriksaan-psikologis-anak.js-form-edit")
            } else {
                $("#" + tipe_asesmen + " #id").val(0);
                resetForm('pemeriksaan-psikologis-anak');

                var date = new Date();
                var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

                $('.js-datepicker').datepicker('setDate', today);
            }
        }

        $("#" + tipe_asesmen + " #addModal").modal("toggle");
    });

    $(".showBtn").click(function(e){
        var $this = $(this);
        var id = $this.data("id");
        var tipe_asesmen = $this.parents('.tab-pane').attr('id');

        if (tipe_asesmen == "tes-iq-keswara") {
            var item = data[$this.data("index")];
            var tanggal_pemeriksaan = item.tanggal_pemeriksaan ? formatDate(item.tanggal_pemeriksaan) : "-";
            var alasan_pengiriman = item.alasan_pengiriman ? item.alasan_pengiriman : "-";
            var bisa_bekerja_sama = item.bisa_bekerja_sama ? item.bisa_bekerja_sama : "-";
            var aktif = item.aktif ? item.aktif : "-";
            var sikap_tenang = item.sikap_tenang ? item.sikap_tenang : "-";
            var mudah_menjawab = item.mudah_menjawab ? item.mudah_menjawab : "-";
            var yakin = item.yakin ? item.yakin : "-";
            var kritis = item.kritis ? item.kritis : "-";
            var cepat = item.cepat ? item.cepat : "-";
            var hati_hati = item.hati_hati ? item.hati_hati : "-";
            var berpikir_cepat = item.berpikir_cepat ? item.berpikir_cepat : "-";
            var rapi = item.rapi ? item.rapi : "-";
            var perilaku_tenang = item.perilaku_tenang ? item.perilaku_tenang : "-";
            var mengetahui = item.mengetahui ? item.mengetahui : "-";
            var bekerja_keras = item.bekerja_keras ? item.bekerja_keras : "-";
            var reaksi_gagal_tenang = item.reaksi_gagal_tenang ? item.reaksi_gagal_tenang : "-";
            var reaksi_tenang = item.reaksi_tenang ? item.reaksi_tenang : "-";
            var semakin_giat = item.semakin_giat ? item.semakin_giat : "-";
            var cara_bicara_baik = item.cara_bicara_baik ? item.cara_bicara_baik : "-";
            var jawaban_jelas = item.jawaban_jelas ? item.jawaban_jelas : "-";
            var spontan = item.spontan ? item.spontan : "-";
            var reaksi_cepat = item.reaksi_cepat ? item.reaksi_cepat : "-";
            var coba_coba = item.coba_coba ? item.coba_coba : "-";
            var gerakan_baik = item.gerakan_baik ? item.gerakan_baik : "-";
            var koordinasi_baik = item.koordinasi_baik ? item.koordinasi_baik : "-";
            var intelegensi_umum = item.intelegensi_umum ? item.intelegensi_umum : "-";
            var pengertian_umum = item.pengertian_umum ? item.pengertian_umum : "-";
            var kemampuan_visual_motor = item.kemampuan_visual_motor ? item.kemampuan_visual_motor : "-";
            var kemampuan_berhitung = item.kemampuan_berhitung ? item.kemampuan_berhitung : "-";
            var kemampuan_mengingat_dan_berkonsentrasi = item.kemampuan_mengingat_dan_berkonsentrasi ? item.kemampuan_mengingat_dan_berkonsentrasi : "-";
            var perbendaharaan_kata = item.perbendaharaan_kata ? item.perbendaharaan_kata : "-";
            var pemahaman_dan_penalaran = item.pemahaman_dan_penalaran ? item.pemahaman_dan_penalaran : "-";
            var ringkasan_dan_saran = item.ringkasan_dan_saran ? nl2br(item.ringkasan_dan_saran) : "-";
            var catatan = item.catatan ? nl2br(item.catatan) : "-";
            
            var hasil = `@include("kasus.alatbantu.tes-iq-keswara.hasil")`;
        } else if (tipe_asesmen == 'tes-minat-bakat') {
            @include("kasus.psikologi.bakat-minat-anak.js-hasil")
        }  else if (tipe_asesmen == 'identifikasi-potensi-psikologi') {
            @include("kasus.psikologi.identifikasi-potensi-psikologi.js-hasil")
        } else if (tipe_asesmen == 'pemeriksaan-psikologis-anak') {
            @include("kasus.psikologi.pemeriksaan-psikologis-anak.js-hasil")
        }

        $("#"+ tipe_asesmen +" #showModalHasil #myModalBody").html(hasil);
        $("#"+ tipe_asesmen +" #showModalHasil").modal("toggle");
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

    function resetForm(type) {
        if (type == 'tes-iq-keswara') {
            @include("kasus.alatbantu.tes-iq-keswara.js-form-create")
        } else if (type == 'tes-minat-bakat') {
            @include("kasus.psikologi.bakat-minat-anak.js-form-create")
        } else if (type == 'identifikasi-potensi-psikologi') {
            @include("kasus.psikologi.identifikasi-potensi-psikologi.js-form-create")
        } else if (type == 'pemeriksaan-psikologis-anak') {
            $("#form-psikologis-anak").trigger('reset');
        }
    }
</script>
@endsection