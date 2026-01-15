<script type="text/javascript">
    var ItemObat = {};
    var typingTimer2;
    var doneTypingInterval2 = 2000;
    $('.obatLoading').hide();
    var currentSelectedItem;
    var currentSelectedItemName;
    const FITUR_INFO_PEMBERIAN_OBAT = `{{ config('medify.kasus.info_pemberian_obat.on') }}`
    const FITUR_TTD_VERIFIKATOR_PEMBERIAN_OBAT = `{{ config('medify.kasus.ttd_verifikator_pemberian_obat.on') }}`
    const FITUR_VERIFIKATOR_PEMBERIAN_OBAT = `{{ config('medify.kasus.verifikator_pemberian_obat.on') }}`

    $(".input-rute").select2({
        dropdownParent: $("#modalFormObat")
    });

    function catatanPengobatanPasien(cpo_id) {
        const badge = $("#obat-badged");
        badge.empty();
        var newElements = '';
        $.ajax({
            url: `/api/kasus/farmasi/pengobatan-pasien/by-id?id=${cpo_id}`,
            type: 'GET',
            success: (res) => {
                console.log('loaded medicine attribute');
                var date = new Date(res.created_at);
                var format_date = `${date.getDate()}-${date.getMonth()+1}-${date.getFullYear()}`
                newElements +=
                    `<span class="badge badge-pill badge-primary">nama obat : ${res.nama_obat}</span>`;
                newElements +=
                    `<span class="badge badge-pill ml-1 badge-primary">signa : ${res.aturan_pemakaian ?? '-'}</span>`;
                newElements +=
                    `<span class="badge badge-pill ml-1 badge-primary">tanggal resep : ${format_date}</span>`;
                newElements +=
                    `<span class="badge badge-pill ml-1 badge-primary">jumlah resep : ${res.jumlah_obat != 0 ? res.jumlah_obat : ''}</span>`;
                newElements +=
                    `<span class="badge badge-pill ml-1 badge-primary">jumlah terkonsumsi : ${res.consumed}</span>`;
                newElements +=
                    `<span class="badge badge-pill ml-1 badge-primary">sisa : ${res.jumlah_obat != 0 ? res.sisa : ''}</span>`;
                badge.append(newElements);
                $('#loading-obat').hide();
            },
            error: (xhr, status, error) => {
                console.log('loaded error');
                newElements += `<span class="badge badge-pill ml-1 badge-danger">ERROR</span>`;
                badge.append(newElements);
                $('#loading-obat').hide();
            }
        })
    }

    function searchResep(search_url, suggestions, suggest, term) {
        currentSelectedItem = '';
        $.ajax({
            url: search_url,
            type: 'GET',
            data: {
                keyword: term
            },
            dataType: 'json',
            success: function(response) {
                data = response.data
                for (i = 0; i < data.length; i++) {
                    var suggestword = data[i].nama;
                    suggestions.push(suggestword);
                    ItemObat[suggestword] = data[i];
                }
                suggest(suggestions);
                $('.obatLoading').hide();
            },
            error: function() {},
        });

    }
    $('.obat-autocomplete').autoComplete({
        minChars: 3,
        source: function(term, suggest) {
            term = term;
            var search_url = API_URL +
                "/{{ session('farmasi')->attr_kategori_farmasi ?? 'farmasi' }}/item/get"
            var suggestions = [];
            $('.obatLoading').show();
            clearTimeout(typingTimer2);
            typingTimer2 = setTimeout(searchResep(search_url, suggestions, suggest, term),
                doneTypingInterval2);
        },
        onSelect: function(event, term, item) {
            clearTimeout(typingTimer2);
            var selected = ItemObat[term]
            currentSelectedItem = ItemObat[term].id;
            item.parent().parent().find('.obat-id').val(currentSelectedItem)
            currentSelectedItemName = term;
        }
    });
    $('.obat-autocomplete').change(function() {
        if ($(this).val() != currentSelectedItemName)
            $(this).parent().parent().find('.obat-id').val('')
        else
            $(this).parent().parent().find('.obat-id').val(currentSelectedItem)
    })

    $(document).on('click', '.isiPemberianObatBtn', function() {
        $('#error-nama-pemberian-obat').addClass('d-none');
        $('#error-verifikator-pemberian-obat').addClass('d-none');

        var method = $(this).data("method")

        if (method == 'create') {
            $('#modalFormPemberianObat .deleteBtnPemberian').hide();
            var default_tanggal = moment().format('YYYY-MM-DD');
            var default_jam = "{{ Carbon\Carbon::now()->format('H:i') }}"

            var obat_px_id = $(this).data("obat-px-id")
            $('#modalFormPemberianObat .input-select-obat').prop('disabled', false).val('').trigger('change');
            $('#modalFormPemberianObat .input-id').val("")
            $('#modalFormPemberianObat .input-method').val(method)
            $('#modalFormPemberianObat .input-tanggal').val(default_tanggal)
            $('#modalFormPemberianObat .input-jam').val(default_jam)
            $('#modalFormPemberianObat .input-status').val("sukses")
            $('#modalFormPemberianObat .input-evaluasi').val("")
            $('#modalFormPemberianObat .deleteBtnPemberian').data('id', "");

            if (FITUR_VERIFIKATOR_PEMBERIAN_OBAT != undefined && FITUR_VERIFIKATOR_PEMBERIAN_OBAT == 1) {
                $('#modalFormPemberianObat .input-verifikator-name-1').val(null);
                $('#modalFormPemberianObat .input-verifikator-name-2').val(null);
            }

            if (FITUR_TTD_VERIFIKATOR_PEMBERIAN_OBAT != undefined && FITUR_TTD_VERIFIKATOR_PEMBERIAN_OBAT ==
                1) {
                $('#btn-edit-ttd-1, #btn-edit-ttd-2, #img-signature-1, #img-signature-2, #btn-back-ttd-1, #btn-back-ttd-2')
                    .addClass('d-none');
                $('#signature-1, #signature-2').removeClass('d-none');
            }
            $('#modalFormPemberianObat').modal('show')
        } else {
            var id = $(this).data("id")
            content = getCatatanPengobatanPasienDetailData(id, "edit");
        }


    });

    $(document).on('click', '.isiPemberianObatBtnSingle', function() {
        var method = $(this).data("method")
        if (method == 'create') {
            $('#modalFormPemberianObatSingle .deleteBtnPemberian').hide();
            var default_tanggal = moment().format('YYYY-MM-DD');
            var default_jam = "{{ Carbon\Carbon::now()->format('H:i') }}"
            var obat_px_id = $(this).data("obat-px-id")
            $('#modalFormPemberianObatSingle .input-select-obat').prop('disabled', false).val('').trigger(
                'change');
            $('#modalFormPemberianObatSingle .input-id').val("")
            $('#modalFormPemberianObatSingle .input-method').val(method)
            $('#modalFormPemberianObatSingle .input-tanggal').val(default_tanggal)
            $('#modalFormPemberianObatSingle .input-jam').val(default_jam)
            $('#modalFormPemberianObatSingle .input-status').val("sukses")
            $('#modalFormPemberianObatSingle .input-evaluasi').val("")
            $('#modalFormPemberianObatSingle .deleteBtnPemberian').data('id', "");
            $('#modalFormPemberianObatSingle').modal('show')
        } else {
            var id = $(this).data("id")
            content = getCatatanPengobatanPasienDetailData(id, "edit");
        }
    });

    function getCatatanPengobatanPasienDetailData(id, method) {
        $.ajax({
            url: BASE_URL + 'api/kasus/farmasi/pengobatan-pasien/get-detail',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {

                if (method == 'edit') editPemberianObat(response)
                else return response;

            },
            error: function() {},
        });
    }


    function editPemberianObat(data) {
        $('#modalFormPemberianObat .deleteBtnPemberian').show();
        $('#riwayatModal').modal('hide')
        var pemberian_at = moment(data.pemberian_at)
        var tanggal = pemberian_at.format('YYYY-MM-DD');
        var jam = pemberian_at.format('HH:mm');

        $('#modalFormPemberianObat .input-select-obat').val(data.catatan_pengobatan_pasien_id).trigger('change')
            .select2({
                disabled: 'readonly'
            })
        $('#modalFormPemberianObat .input-id').val(data.id)
        $('#modalFormPemberianObat .input-method').val("edit")
        $('#modalFormPemberianObat .input-tanggal').val(tanggal)
        $('#modalFormPemberianObat .input-jam').val(jam)
        $('#modalFormPemberianObat .input-status').val(data.status)
        $('#modalFormPemberianObat .input-evaluasi').val(data.evaluasi)
        $('#modalFormPemberianObat .input-verified-by').val(data.verified_by).trigger('change');

        if (FITUR_VERIFIKATOR_PEMBERIAN_OBAT != undefined && FITUR_VERIFIKATOR_PEMBERIAN_OBAT == 1) {
            $('#modalFormPemberianObat .input-verifikator-name-1').val(data.verifikator_name_1);
            $('#modalFormPemberianObat .input-verifikator-name-2').val(data.verifikator_name_2);
        } else {
            $('#modalFormPemberianObat .input-verified-by-2').val(data.verified_by_2).trigger('change');
            $('#modalFormPemberianObat .input-verified').val(data.verified_by).trigger('change');
        }

        if (FITUR_TTD_VERIFIKATOR_PEMBERIAN_OBAT != undefined && FITUR_TTD_VERIFIKATOR_PEMBERIAN_OBAT == 1) {
            $('#signature-1, #signature-2, #btn-back-ttd-1, #btn-back-ttd-2').addClass('d-none');
            $('#img-signature-1').removeClass('d-none').attr('src', data.path_ttd_verif_1);
            $('#img-signature-2').removeClass('d-none').attr('src', data.path_ttd_verif_2);
            $('#btn-edit-ttd-1, #btn-edit-ttd-2 ').removeClass('d-none');
            $('#tmp_path_signature_1').val(data.path_ttd_verif_1);
            $('#tmp_path_signature_2').val(data.path_ttd_verif_2);

            $('#btn-edit-ttd-1').click(function() {
                $('#signature-1, #btn-back-ttd-1').removeClass('d-none');
                $('#img-signature-1, #btn-edit-ttd-1').addClass('d-none');
                $('#tmp_path_signature_1').val(null);
            });

            $('#btn-edit-ttd-2').click(function() {
                $('#signature-2, #btn-back-ttd-2').removeClass('d-none');
                $('#img-signature-2, #btn-edit-ttd-2').addClass('d-none');
                $('#tmp_path_signature_2').val(null);

            });

            $('#btn-back-ttd-1').click(function() {
                $('#signature-1, #btn-back-ttd-1').addClass('d-none');
                $('#img-signature-1').removeClass('d-none').attr('src', data.path_ttd_verif_1);
                $('#btn-edit-ttd-1').removeClass('d-none');
                $('#tmp_path_signature_1').val(data.path_ttd_verif_1);
            });

            $('#btn-back-ttd-2').click(function() {
                $('#signature-2, #btn-back-ttd-2').addClass('d-none');
                $('#img-signature-2').removeClass('d-none').attr('src', data.path_ttd_verif_2);
                $('#btn-edit-ttd-2').removeClass('d-none');
                $('#tmp_path_signature_2').val(data.path_ttd_verif_2);
            });

        }
        if (FITUR_INFO_PEMBERIAN_OBAT != undefined && FITUR_INFO_PEMBERIAN_OBAT == 1) {
            $('#modalFormPemberianObat .input-created-by').val(data.creator ? data.creator.name : '-');
            $('#modalFormPemberianObat .input-updated-by').val(data.updater ? data.updater.name : '-');
        }
        $('#modalFormPemberianObat .deleteBtnPemberian').data('id', data.id);
        $('#modalFormPemberianObat').modal('show')
    }


    $('.deleteBtnPemberian').click(function() {
        id = $(this).data("id");
        $('#formDeletePemberian .input-id').val(id);
        swal({
            title: "Hapus",
            text: "Apakah anda yakin akan menghapus data ini?",
            showCancelButton: true,
            reverseButtons: true,
            type: 'warning',
            confirmButtonClass: "btn btn-danger",
            cancelButtonClass: "btn btn-default",
            confirmButtonText: "Hapus",
            cancelButtonText: "Kembali",
            closeOnConfirm: false
        }).then(function(result) {
            if (result.value) {
                $('#formDeletePemberian').submit();
            }
        });
    })

    $('.isiObatBtn').click(function() {
        var id = $(this).data("id")
        var method = $(this).data("method")

        $('#modalFormObat .input-id').val(id)
        if (method == 'create') {
            $('#modalFormObat .input-id').val("")
            $('#modalFormObat .input-nama').val("")
            $('#modalFormObat .input-rute').val("")
            $('#modalFormObat .input-keterangan').val("")
            $('#modalFormObat .input-aturan').val("")
            $('#modalFormObat .input-pemberian-segera').prop('checked', false);
            $('#modalFormObat .input-pemberian-lambat').prop('checked', false);
            $('#modalFormObat .input-pemberian-bebas').prop('checked', false);
        } else {
            var content = $(this).data("content")

            $('#modalFormObat .input-id').val(content.id)
            $('#modalFormObat .input-nama').val(content.nama_obat)
            $('#modalFormObat .input-rute').val(content.rute).trigger('change');
            $('#modalFormObat .input-keterangan').val(content.keterangan)
            $('#modalFormObat .input-aturan').val(content.aturan_pemakaian)
            $('#modalFormObat .input-obat-id').val(content.obat_id)

            if ($('#modalFormObat .input-rute').val() != content.rute) {
                var newOption = new Option(content.rute, content.rute, false, false);
                $('#modalFormObat .input-rute').append(newOption);
                $('#modalFormObat .input-rute').val(content.rute).trigger('change');
            }

            $('#modalFormObat .input-pemberian-segera').prop('checked', content.cb_segera_diberikan != null);
            $('#modalFormObat .input-pemberian-lambat').prop('checked', content.cb_terlambat_diberikan != null)
            $('#modalFormObat .input-pemberian-bebas').prop('checked', content.cb_pemberian_bebas != null)
        }

        $('#modalFormObat').modal('show')

    });
</script>
