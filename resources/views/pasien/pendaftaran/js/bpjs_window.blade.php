<script type="text/javascript">
    $('#sep_select_refresh').on('click', function() {
        refreshSelectSEP()
    });

    function refreshSelectSEP(select_first_value = false) {
        $('#infoBPJSWrapper').hide();
        $('#sep_select_refresh').hide();
        $('#sep_select_loading').show();
        var sep_select_first_value = '';
        var tanggal_start = $('#sep_select_refresh').attr('data-tanggal-start');
        var tanggal_end = $('#sep_select_refresh').attr('data-tanggal-end');
        var ppk = $('#sep_select_refresh').attr('data-ppk');
        $.ajax({
            type: 'GET',
            url: "{{ url('') }}/api/bpjs/monitoring/histori-pelayanan-peserta/get-data?tanggal_start=" +
                tanggal_start + "&tanggal_end=" + tanggal_end + "&no_bpjs=" + nomor_kartu,
            dataType: 'json',
            success: function(data) {
                $('#sep_select_refresh').show();
                $('#sep_select_loading').hide();
                $('#sep_select').empty();
                var option = [];
                option.push({
                    id: "",
                    text: ""
                });

                for (var i = 0; i < data.length; i++) {
                    var sep_ppk = data[i].noSep.substr(0, 8);
                    if (data[i].jnsPelayanan == 1) jenis_pelayanan = 'Rawat Inap';
                    else jenis_pelayanan = 'Rawat Jalan';

                    if (data[i].jnsPelayanan == 2 && sep_ppk == ppk) {
                        data[i].no_sep = data[i].noSep;
                        data[i].no_rujukan = data[i].noRujukan;
                        data[i].jenis_pelayanan = data[i].jnsPelayanan;
                        var nilai = JSON.stringify(data[i]);
                        option.push({
                            id: nilai,
                            text: data[i].noSep + ' - ' + jenis_pelayanan + ' - ' + (data[i].poli ??
                                '')
                        });
                        if (i == 0) sep_select_first_value = nilai;
                    }
                }
                $('#sep_select').select2({
                    data: option
                })

                if (select_first_value) {
                    $('#sep_select').val(sep_select_first_value).trigger('change')
                    var sep = JSON.parse($('#sep_select').val());
                    preview_sep(sep);
                }
            },
            error: function(error) {
                $('#sep_select_refresh').show();
                $('#sep_select_loading').hide();

            }
        });
    }

    $('#sep_custom_send').on('click', function() {
        $('#sep_custom_send').hide();
        $('#sep_custom_loading').show();
        var no_sep = $('#sep_custom').val();
        var formData = new FormData();
        formData.append('pasien_id', pasien_id);
        $.ajax({
            type: "POST",
            url: API_URL + "/bpjs/sep/manual/" + no_sep,
            contentType: false,
            cache: false,
            processData: false,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(resp) {
                $('#data_sep').text(no_sep || "-");
                $('#data_sep_rujukan').text("-");
                $('#data_sep_jenis_pelayanan').text("-");
                $('#data_sep_poli').text("-");
                $('#data_sep_poli_eksekutif').text("-");
                $('#data_sep_cob').text("-");
                $('#data_sep_katarak').text("-");
                $('#data_sep_laka').text("-");
                $('#data_sep_suplesi_laka').text("-");
                $('#data_sep_tanggal_laka').text("-");
                $('#sep_custom_send').show();
                $('#sep_custom_loading').hide();
                $('#infoBPJSWrapper').show();
            },
            error: function(error) {
                $('#infoBPJSWrapper').hide();
                $('#sep_custom').val("")
                $('#sep_custom_send').show();
                $('#sep_custom_loading').hide();
            }
        });
    });

    $('#custom_sep_check').click(function() {
        if ($(this).is(':checked')) {
            $('#sep_custom_wrapper').show();
            $('#sep_select').attr("disabled", true);
            $('#sep_select').attr("readonly", true);
            $('#sep_select_refresh').attr("disabled", true);
            $('#sep_button').attr("disabled", true);
        } else {
            $('#sep_custom_wrapper').hide();
            $('#sep_select').attr("disabled", false);
            $('#sep_select').attr("readonly", false);
            $('#sep_select_refresh').attr("disabled", false);
            $('#sep_button').attr("disabled", false);
        }
    });

    function requestGetSep(no_sep) {
        $('#data_sep_loading').show();
        $.ajax({
            type: "GET",
            url: API_URL + "/bpjs/sep/search/" + no_sep,
            contentType: false,
            success: function(resp) {
                var sep = JSON.parse(resp).response;
                $('#data_sep_poli').text(sep.poli);
                $('#data_sep_loading').hide();
            },
            error: function(error) {

                $('#data_sep_loading').hide();
            }
        });

    }

    $('#sep_select').on("select2:select", function(arg) {
        var sep = JSON.parse($('#sep_select').val());
        preview_sep(sep);
    });

    function preview_sep(sep) {
        $('#data_sep').text("-");
        $('#data_sep_rujukan').text("-");
        $('#data_sep_jenis_pelayanan').text("-");
        $('#data_sep_poli').text("-");
        $('#data_sep_dpjp').text("-");
        $('#data_sep_poli_eksekutif').text("-");
        $('#data_sep_cob').text("-");
        $('#data_sep_katarak').text("-");
        $('#data_sep_laka').text("-");
        $('#data_sep_suplesi_laka').text("-");
        $('#data_sep_tanggal_laka').text("-");
        if (sep) {
            console.log(sep)
            $('#data_sep').text(sep.no_sep || "-");
            $('#data_sep_rujukan').text(sep.no_rujukan || "Tidak Ada Rujukan");
            $('#data_sep_jenis_pelayanan').text(((sep.jenis_pelayanan ?? sep.jnsPelayanan) == 1) ? "Rawat Inap" :
                "Rawat Jalan");
            if (sep.poli_eksekutif != '' || sep.poli_eksekutif != null) {
                $('#data_sep_poli_eksekutif').text(sep.poli_eksekutif == 1 ? "Ya" : "Tidak");
            }
            $('#data_sep_cob').text(sep.cob == 1 ? "Ya" : "Tidak");
            $('#data_sep_katarak').text(sep.katarak == 1 ? "Ya" : "Tidak");
            if (sep.jaminan_lakalantas == 1) {
                if (sep.penjamin_laka == "0" || sep.penjamin_laka == null || sep.penjamin_laka == 0) {
                    $('#data_sep_laka').text("Tidak");
                } else {
                    var penjamin = sep.penjamin_laka.split(',');
                    var penjaminArr = ["PT Jasa Raharja", "BPJS Ketenagakerjaan", "PT Taspen", "PT Asabri"];
                    var penjaminStr = [];
                    for (var i = 0; i < penjamin.length; i++) {
                        penjaminStr.push(penjaminArr[penjamin[i] - 1]);
                    }
                    $('#data_sep_laka').text(penjaminStr.join(", "));
                }
                $('#data_sep_suplesi_laka').text(sep.no_suplesi == 0 ? "-" : sep.no_suplesi);
                $('#data_sep_tanggal_laka').text(sep.tgl_kejadian.split("-").reverse().join("-"));
            }
            if (sep.poli != null) {
                $('#data_sep_poli').text(sep.poli.name ?? sep.poli);
            }
            if (sep.dokter != null) {
                $('#data_sep_dpjp').text(sep.dokter.name);
            }
            $('#data_sep_kelas_rawat').text(sep.kelas_rawat ?? sep.kelasRawat)

            $('#infoBPJSWrapper').show();
        }
    }

    $('#sep_button').on('click', function() {
        popupwindow(new_sep_url + "&pembayaran_id=" + $('#selectPembayaran').val(), "Terbitkan SEP Baru", 700,
            1000);
    });

    $('#sep_button_auto').on('click', function() {
        var pembayaran_id = $('#selectPembayaran').val();
        var pasien_id = $("#pasien_id").val();
        var poli_id = $("#selectPoli").val();
        var dokter_id = $("#selectDokterElement").val();

        if (valLayanan == 1) {
            type_layanan = 'rawatjalan'

            if (poli_id == null) {
                callSwal('error', 'Poli Kosong', 'Poli masih kosong. Silahkan pilih poli', '');
                return
            }
            if (dokter_id == null) {
                callSwal('error', 'Dokter Praktek Kosong',
                    'Dokter praktek masih kosong. Silahkan pilih dokter praktek', '');
                return
            }
        } else {
            callSwal('error', 'Sorry', 'Fitur ini belum dapat digunakan pada layanan ini', '');
            return;
        }

        $('#sep_button_auto').prepend('<i class="fa fa-spinner fa-spin"></i>');
        $('#sep_button_auto').attr('disabled', true);
        $.ajax({
            type: "GET",
            url: BASE_URL + "bpjs/auto-sep/generate/" + type_layanan + "/" + pasien_id + "/" +
                pembayaran_id + "/" + poli_id + "/" + dokter_id,
            contentType: false,
            dataType: 'json',
            success: function(resp) {
                if (resp.status == 200) {
                    callSwal('success', 'Sukses', 'Silahkan pilih SEP pada input nomor SEP', '');
                    $('#sep_button_auto').find(".fa-spinner").remove();
                    refreshSelectSEP(true)
                } else if (resp.status == 201) {
                    callSwal('error', 'Gagal', resp.message, '');
                    $('#sep_button_auto').removeAttr('disabled');
                    $('#sep_button_auto').find(".fa-spinner").remove();
                } else {
                    callSwal('error', 'Gagal',
                        'Gagal kesalahan server tidak diketahui. Gunakan SEP Manual', '');

                    $('#sep_button_auto').removeAttr('disabled')
                    $('#sep_button_auto').find(".fa-spinner").remove();
                }
            },
            error: function(error) {
                $('#sep_button_auto').removeAttr('disabled');
                $('#sep_button_auto').find(".fa-spinner").remove();
                callSwal('error', 'Gagal', 'Silahkan coba lagi atau Gunakan SEP Manual', '');
            }
        });

    });
</script>
