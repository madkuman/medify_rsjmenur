@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Psikologi - Pemeriksaan Dewasa
@endsection

@section('css')
<style type="text/css">
    .padding-0 {
        padding: 0 !important;
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
						<h3 class="block-title">Pemeriksaan Psikologi Dewasa</h3>
					</div>
                	<div class="block-content">
                        <div class="block border-0">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tes-iq">Tes IQ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tes-minat-bakat">Tes Minat Bakat</a>
                                </li>
                            </ul>
                            <div class="block-content padding-0 tab-content">
                                <div class="tab-pane active" id="tes-iq" role="tabpanel">
                                     @include('kasus.alatbantu.tes-iq.index')
                                </div>
                                <div class="tab-pane" id="tes-minat-bakat" role="tabpanel">
                                     @include('kasus.psikologi.bakat-minat-dewasa.index')
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
    var tes_iq = JSON.parse({!!json_encode(str_replace("`", "'", $tes_iq))!!});
    var $bakat_minat_dewasa = JSON.parse({!!json_encode(str_replace("`", "'", $bakat_minat_dewasa))!!});

    // CKEDITOR.replace('js-ckeditor');

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

        if (tipe_asesmen == 'tes-iq') {
            var item = tes_iq[$(this).data("index")];
            resetForm('tes-iq');

            if (item != "" && item != undefined) {
                $("#" + tipe_asesmen + " #id").val(item.id);
                @include("kasus.alatbantu.tes-iq.js-form-edit")
            } else {
                $("#" + tipe_asesmen + " #id").val(0);
                resetForm('tes-iq');
                
                var date = new Date();
                var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

                $('.js-datepicker').datepicker('setDate', today);
            }
        } else if (tipe_asesmen == 'tes-minat-bakat') {
            var item = $bakat_minat_dewasa[$this.data("index")];
            resetForm('tes-minat-bakat');

            if (item != "" && item != undefined) {
                $("#" + tipe_asesmen + " #id").val(item.id);
                @include("kasus.psikologi.bakat-minat-dewasa.js-form-edit")
            } else {
                $("#" + tipe_asesmen + " #id").val(0);
                resetForm('tes-minat-bakat');

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

        if (tipe_asesmen == "tes-iq") {
            var item = tes_iq[$(this).data("index")];
            var tanggal_pemeriksaan = item.tanggal_pemeriksaan ? formatDate(item.tanggal_pemeriksaan) : "-";
            var tujuan_tes = item.tujuan_tes ? item.tujuan_tes : "-";
            var rujukan_dari = item.rujukan_dari ? item.rujukan_dari : "-";
            var kecerdasan_umum = item.kecerdasan_umum ? item.kecerdasan_umum : "-";
            var fleksibilitas_berpikir = item.fleksibilitas_berpikir ? item.fleksibilitas_berpikir : "-";
            var analisa_sintesa = item.analisa_sintesa ? item.analisa_sintesa : "-";
            var berpikir_konseptual = item.berpikir_konseptual ? item.berpikir_konseptual : "-";
            var kesimpulan = item.kesimpulan ? item.kesimpulan : "-";
            var kemampuan_intelektual = item.kemampuan_intelektual ? item.kemampuan_intelektual : "-";
            
            var hasil = `@include("kasus.alatbantu.tes-iq.hasil")`;
        } else if (tipe_asesmen == 'tes-minat-bakat') {
            @include("kasus.psikologi.bakat-minat-dewasa.js-hasil")
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
        if (type == 'tes-iq') {
            @include("kasus.alatbantu.tes-iq.js-form-create")
        } else if (type == 'tes-minat-bakat') {
            @include("kasus.psikologi.bakat-minat-dewasa.js-form-create")
        }
    }
</script>
@endsection