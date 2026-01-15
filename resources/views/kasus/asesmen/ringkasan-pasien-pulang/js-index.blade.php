<script src="{{ url('') }}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
    var data = JSON.parse({!! json_encode(str_replace('`', "'", $ringkasan_pasien_pulang)) !!});

    $(document).ready(function() {
        $(".time").mask("00:00");
    });


    function nl2br(str, is_xhtml) {
        var breakTag = (is_xhtml || typeof is_xhtml === "undefined") ? "<br />" : "<br>";
        return (str + "").replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, "$1" + breakTag + "$2");
    }


    $(".deleteBtn").click(function(e) {
        e.preventDefault();
        id = $(this).data("id");
        $("#deleteInputId").val(id);
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
            if (result.value) {
                $("#formDelete").submit();
            }
        });
    });

    $(".editBtn").click(function(e) {
        id = $(this).data("id");
        var item = data[$(this).data("index")];
        if (item != "" && item != undefined) {
            $("#id").val(item.id);
            @include('kasus.asesmen.ringkasan-pasien-pulang.js-form-edit')
        } else {
            $("#id").val(0);
            @include('kasus.asesmen.ringkasan-pasien-pulang.js-form-create')
        }
        $("#addModal").modal("toggle");
    });

    $(".showBtn").click(function(e) {
        id = $(this).data("id");

        var item = data[$(this).data("index")];
        var keluhan_utama = item.keluhan_utama ? item.keluhan_utama : "-";
        var perjalanan_penyakit_pasien = item.perjalanan_penyakit_pasien ? item.perjalanan_penyakit_pasien :
        "-";
        var keluhan_lain = item.keluhan_lain ? item.keluhan_lain : "-";
        var riwayat_penyakit_sebelumnya = item.riwayat_penyakit_sebelumnya ? item.riwayat_penyakit_sebelumnya :
            "-";
        var riwayat_keluarga = item.riwayat_keluarga ? item.riwayat_keluarga : "-";
        var riwayat_penyakit_lain_lain = item.riwayat_penyakit_lain_lain ? item.riwayat_penyakit_lain_lain :
        "-";
        var fisik = item.fisik ? item.fisik : "-";
        var psikiatrik = item.psikiatrik ? item.psikiatrik : "-";
        var laboratorium = item.laboratorium ? item.laboratorium : "-";
        var radiologi = item.radiologi ? item.radiologi : "-";
        var pemeriksaan_lain_lain = item.pemeriksaan_lain_lain ? item.pemeriksaan_lain_lain : "-";
        var indikasi_mrs_diagnosa_masuk = item.indikasi_mrs_diagnosa_masuk ? item.indikasi_mrs_diagnosa_masuk :
            "-";

        var icd_10_axis_1 = item.icd_10_axis_1 ? item.icd_10_axis_1 : "-";
        var icd_10_axis_2 = item.icd_10_axis_2 ? item.icd_10_axis_2 : "-";
        var icd_10_axis_3 = item.icd_10_axis_3 ? item.icd_10_axis_3 : "-";

        var axis_1 = item.axis_1 ? item.axis_1 : "-";
        var axis_2 = item.axis_2 ? item.axis_2 : "-";
        var axis_3 = item.axis_3 ? item.axis_3 : "-";
        var axis_4 = item.axis_4 ? item.axis_4 : "-";
        var axis_5 = item.axis_5 ? item.axis_5 : "-";


        var diagnosa_sekunder = item.diagnosa_sekunder ? item.diagnosa_sekunder : "-";
        var icd_10_diagnosa_sekunder = item.icd_10_diagnosa_sekunder ? item.icd_10_diagnosa_sekunder : "-";
        var diagnosa_komplikasi = item.diagnosa_komplikasi ? item.diagnosa_komplikasi : "-";
        var icd_10_diagnosa_komplikasi = item.icd_10_diagnosa_komplikasi ? item.icd_10_diagnosa_komplikasi :
        "-";
        var masalah_utama_yang_dihadapi = item.masalah_utama_yang_dihadapi ? nl2br(item
            .masalah_utama_yang_dihadapi) : "-";
        var konsultasi = item.konsultasi ? nl2br(item.konsultasi) : "-";
        var pengobatan_medis = item.pengobatan_medis ? nl2br(item.pengobatan_medis) : "-";
        var tindakan_medis_operatif_non_operatif = item.tindakan_medis_operatif_non_operatif ? nl2br(item
            .tindakan_medis_operatif_non_operatif) : "-";
        var perjalanan_penyakit_selama_perawatan = item.perjalanan_penyakit_selama_perawatan ? nl2br(item
            .perjalanan_penyakit_selama_perawatan) : "-";
        var keadaan_waktu_krs = item.keadaan_waktu_krs ? item.keadaan_waktu_krs : "-";
        var sebab_meninggal = item.sebab_meninggal ? item.sebab_meninggal : "-";
        var tindak_lanjut = item.tindak_lanjut ? item.tindak_lanjut : "-";
        var catatan_khusus = item.catatan_khusus ? item.catatan_khusus : "-";

        var hasil = `@include('kasus.asesmen.ringkasan-pasien-pulang.hasil')`;
        $("#showModalHasil #myModalBody").html(hasil);
        $("#showModalHasil").modal("toggle");
    });

    function formatDate(input) {
        if (input === null) {
            return null;
        } else {
            var datePart = input.match(/\d+/g),
                year = datePart[0],
                month = datePart[1],
                day = datePart[2];

            return day + "/" + month + "/" + year;
        }
    }

    $('.icd10-search').select2({
        ajax: {
            url: API_URL + "/kasus/get/list/diagnosis",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    keyword: params.term,
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;
                return {
                    results: data.data,
                };
            },
            cache: true
        },
        escapeMarkup: function(markup) {
            return markup;
        },
        minimumInputLength: 3,
        placeholder: "Cari ICD 10",
        templateResult: formatICD10,
        templateSelection: formatICD10Selection
    });



    function formatICD10(item) {
        if (item.loading) {
            return item.text;
        }

        var markup = item.code_icd;

        return markup;
    }

    function formatICD10Selection(item) {
        if (item.code_icd) {
            var markup = item.code_icd;
            return markup;
        } else return item.text;
    }

    function printSEP() {
        var print_sep_url = BASE_URL + "bpjs/sep/{{ $kasus->active_sep->no_sep ?? '' }}/print";
        popupwindow(print_sep_url, "Print SEP Pasien", 600, 900);
    }
</script>
