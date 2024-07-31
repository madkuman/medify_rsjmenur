<script>
    var nomor_kasus = '{{ $kasus->nomor_kasus }}';
    var is_bpjs = parseInt('{{ $kasus->pembayaran->perusahaan->tipe->slug == "bpjs" ? 1 : 0 }}');
    var kategori_resep = 'default';
    function _initComponents(element) {
        element.find('.select2-select-obat').select2({
            width: '100%',
            ajax: {
                url: API_URL + "/farmasi/" + ($('#nama-apotek').find(':selected').data('slug')) + "/item/get",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        keyword: params.term,
                        page: params.page,
                        order_by_stok: 1,
                        kasus_id: "{{ $kasus->id }}",
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
            placeholder: "Cari Barang",
            templateResult: function(item) {
                if (item.loading) {
                    return item.text;
                }
                var stok = 0;
                if (item.stok)
                    stok = item.stok.aggregate;
                var markup = item.item_detail.nama + " (" + item.item_detail.satuan + ") - Stok : " + stok + " - Harga : " + item
                    .item_detail.harga;
                if (stok == 0) {
                    markup =
                        `<div class="select2-warning-item">${markup}</div>`;
                }
                return markup;
            },
            templateSelection: function(item) {
                if (item.item_detail) {
                    var stok = 0;
                    if (item.stok) {
                        stok = item.stok.aggregate;
                    } else {
                        item.stok = 0;
                    }
                    return item.item_detail.nama + " (" + item.item_detail.satuan + ")";
                } else return item.text;
            }
        });

        element.find('.select-kategori').on('change', function () {
            let parent = $(this).parents('.hh-parent');
            let table = parent.parents('table');
            let index = parent.data('index');
            let val = $(this).val();

            if (val == 'generik') {
                parent.find('.kategori-generik').show();
                parent.find('.kategori-racikan').hide();
                parent.find('.kategori-generik').each(function (i, item) {
                    $(item).find('.has-required').attr('required', true);
                });
                parent.find('.kategori-racikan').each(function (i, item) {
                    $(item).find('.has-required').attr('required', false);
                });
                parent.find('.hh-jumlah').attr('readonly', true);
                table.find('.hh-embalase-'+index).remove();
                table.find('.hh-parent-'+index).remove();
            } else {
                parent.find('.kategori-generik').hide();
                parent.find('.kategori-racikan').show();
                parent.find('.kategori-generik').each(function (i, item) {
                    $(item).find('.has-required').attr('required', false);
                });
                parent.find('.kategori-racikan').each(function (i, item) {
                    $(item).find('.has-required').attr('required', true);
                });
                parent.find('.hh-jumlah').attr('readonly', false);
            }
        });
    }

    function _invokeOnlyBpjs(element) {
        if (is_bpjs) {
            element.find('.only-bpjs').show();
        } else {
            element.find('.only-bpjs').hide();
        }
    }

    var ajax_hitung_harga = null;
    function _kategoriResepHitungHarga(element) {
        let modal = element.parents('.modal');
        let table = modal.find('#table-kategori-resep-'+kategori_resep);

        let obat = [];
        table.find('.hh-parent').each(function (i, item) {
            let index = $(item).data('index');
            if (kategori_resep == 'dispensing_aseptik') {
                let racikan = [];
                racikan.push({
                    item_farmasi_id: $(item).find('.hh-obat_permintaan').val(),
                    jumlah: $(item).find('.hh-jumlah_permintaan').val(),
                });
                racikan.push({
                    item_farmasi_id: $(item).find('.hh-obat_pelarut').val(),
                    jumlah: 1,
                });
                obat.push({
                    index: $(item).data('index'),
                    racikan: racikan,
                    jumlah: $(item).find('.hh-jumlah').val(),
                });
            } else {
                let racikan = [];
                let tipe_racikan_id = null;
                if ($(item).find('.select-kategori').val() == 'racikan') {
                    tipe_racikan_id = $(item).find('.hh-tipe-racikan').val();
                    table.find('.hh-parent-'+index).each(function (i_racikan, item_racikan) {
                        racikan.push({
                            racikan_index: $(item_racikan).data('racikan_index'),
                            item_farmasi_id: $(item_racikan).find('.hh-racikan-obat').val(),
                            dosis: $(item_racikan).find('.hh-racikan-dosis').val(),
                        });
                    });
                }
                obat.push({
                    index: $(item).data('index'),
                    item_farmasi_id : $(item).find('.hh-obat').val(),
                    tipe_racikan_id: tipe_racikan_id,
                    racikan: racikan,
                    dosis: $(item).find('.hh-dosis').val(),
                    jumlah: $(item).find('.hh-jumlah').val(),
                });
            }
        });
        if (ajax_hitung_harga != null) {
            ajax_hitung_harga.abort();
        }
        ajax_hitung_harga = $.ajax({
            url: BASE_URL+'/kasus/'+nomor_kasus+'/datamedis/resep/hitung-harga',
            type: "POST",
            dataType: 'JSON',
            data: {
                kategori_resep: kategori_resep,
                farmasi_id: $('#nama-apotek').val(),
                obat: obat,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                table.find('.total-obat').text("Rp " + number_format_formatter.format(response.data?.total || 0));
                let table_summary = modal.find('#table-summary');
                table_summary.find('.total-obat').text("Rp " + number_format_formatter.format(response.data?.total || 0));
                table_summary.find('.total-hari7-obat').text("Rp " + number_format_formatter.format(response.data?.total_hari7 || 0));
                table_summary.find('.total-hari23-obat').text("Rp " + number_format_formatter.format(response.data?.total_hari23 || 0));
                table_summary.find('.total-sisa-plafon').text("Rp " + number_format_formatter.format(response.data?.total_sisa_plafon || 0));

                let is_warning_restriksi = false;
                $.each(response.data.data_obat, function (i, item) {
                    let tr = table.find(`[data-index="${item.index}"]`);
                    let jumlah = tr.find('.hh-jumlah').val();
                    tr.find('.hh-satuan').val(item.satuan);
                    tr.find('.hh-dosis').val(item.dosis);
                    tr.find('.hh-jumlah').val(item.jumlah);
                    tr.find('.hh-restriksi').val(item.restriksi);
                    tr.find('.hh-kekuatan').val(item.kekuatan);
                    tr.find('.hh-subtotal').val(item.subtotal);

                    tr.find('.warning-message').remove();
                    if (is_bpjs && item.restriksi && jumlah > item.restriksi) {
                        tr.find('.hh-jumlah').after(`<span class="text-warning warning-message">Melebihi restriksi</span>`);
                        is_warning_restriksi = true;
                    }

                    $.each(item.data_racikan, function (i_racikan, item_racikan) {
                        let racikan_parent = table.find(`[data-racikan_index="${item_racikan.racikan_index}"]`);
                        if (racikan_parent.length != 0) {
                            racikan_parent.find('.hh-racikan-jumlah').val(item_racikan.jumlah);
                            racikan_parent.find('.hh-racikan-restriksi').val(item_racikan.restriksi);
                            racikan_parent.find('.hh-racikan-kekuatan').val(item_racikan.kekuatan);
                            racikan_parent.find('.hh-racikan-subtotal').val(item_racikan.subtotal_racikan);
                            _invokeOnlyBpjs(racikan_parent);
                        }
                    });

                    let index = item.index;
                    table.find('.hh-embalase-'+index).remove();
                    if (kategori_resep == 'default') {
                        if (item?.kategori == 'racikan') {
                            if (item.embalase != 0) {
                                let element_after = parent;
                                if (table.find('.hh-parent-'+index).length != 0) {
                                    element_after = table.find('.hh-parent-'+index+':last');
                                }
                                let html = '';
                                if (kategori_resep == 'default') {
                                    html = `@include('kasus.datamedis.content.resep.components.form-kategori-resep-default-row-embalase', ['index' => "\${index}"])`;
                                }
                                let new_element = $(html).insertAfter(element_after);
                                new_element.find('.hh-embalase-subtotal').val(item.embalase);
                                _invokeOnlyBpjs(new_element);
                            }
                        }
                    }
                });
                modal.find('.header-warning-message').remove();
                if (is_warning_restriksi) {
                    modal.find('.submit-resep').after('<span class="alert d-block mt-3 alert-warning header-warning-message">WARNING OBAT MELEBIHI RESTRIKSI BPJS</span>');
                }
            }
        });
    }

    $(document).on('change', '.hh-obat,.hh-jumlah,.hh-dosis,.hh-jumlah_permintaan,.hh-obat_permintaan,.hh-tipe-racikan,.select-kategori, .hh-racikan-dosis, .hh-racikan-obat', function () {
        _kategoriResepHitungHarga($(this));
    });

    function _renumberTable(table) {
        table.find('.table-number').each(function(i, item) {
            $(item).text(i + 1);
        });
    }

    $('#modal-create-resep,#resepModalEdit').on('show.bs.modal', function(e) {
        let modal = $(this);
        let button = $(e.relatedTarget);
        kategori_resep = button.data('kategori_resep');
        modal.find('[name="kategori_resep"]').val(kategori_resep);

        modal.find('#container-kategori-resep-tpn').hide();
        modal.find('#container-kategori-resep-dispensing_aseptik').hide();
        modal.find('#container-kategori-resep-default').hide();

        modal.find('#container-kategori-resep-tpn').find('.has-required').attr('required', false);
        modal.find('#container-kategori-resep-dispensing_aseptik').find('.has-required').attr('required', false);
        modal.find('#container-kategori-resep-default').find('.has-required').attr('required', false);

        let container = modal.find('#container-kategori-resep-'+ kategori_resep);
        container.show();
        container.find('.has-required').attr('required', true);
        if (kategori_resep == 'default') {
            container.find('.select-kategori').each(function (i, item) {
                $(item).trigger('change');
            });
        }
        _invokeOnlyBpjs(modal);
        let table_summary = modal.find('#table-summary');
        table_summary.find('.total-obat').text("Rp " + number_format_formatter.format(0));
        table_summary.find('.total-hari7-obat').text("Rp " + number_format_formatter.format(0));
        table_summary.find('.total-hari23-obat').text("Rp " + number_format_formatter.format(0));
        table_summary.find('.total-sisa-plafon').text("Rp " + number_format_formatter.format(0));

        modal.find('.submit-resep').attr('disabled', false);

        let is_edit = modal.data('edit') || false;
        let table = modal.find('#table-kategori-resep-'+kategori_resep);
        if (modal.attr('id') == 'resepModalEdit') {
            $('#loading-top').fadeIn();
            table.find('tbody').html('');
            let edit_id = button.data('id');
            modal.find('#resepEditId').val(edit_id);
            $.ajax({
                url: API_URL + '/kasus/'+nomor_kasus+'/datamedis/resep/' + edit_id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    modal.find('[name="resep_iter"]').val(response.resep_iter);
                    if (kategori_resep == 'tpn') {
                        let resep = response.resep_detail[0];
                        if (resep) {
                            modal.find('[name*="[alergi]"]').val(resep.tpn_alergi);
                            modal.find('[name*="[berat_badan]"]').val(resep.tpn_berat_badan);
                            modal.find('[name*="[diagnosis]"]').val(resep.tpn_diagnosis);
                            modal.find('[name*="[jumlah_tpn]"]').val(resep.jumlah);
                            modal.find('[name*="[kemasan]"]').val(resep.tpn_kemasan);
                            modal.find('[name*="[rute_pemberian]"]').val(resep.tpn_rute_pemberian);
                            modal.find('[name*="[aturan_penggunaan]"]').val(resep.tpn_aturan_penggunaan);
                            
                            $.each(resep.racikan_detail, function (i, item) {
                                table.find('.btn-create-row').trigger('click');
                                let parent_element = table.find('.hh-parent:last');
                                parent_element.find('[name*="[jumlah]"]').val(item.jumlah);
                                parent_element.find('[name*="[item_farmasi_id]"]').select2("trigger", "select", {
                                    data: {
                                        id: item.item_farmasi_id,
                                        text: item.nama_obat,
                                    },
                                });
                                parent_element.find('[name*="[catatan]"]').val(item.tpn_catatan);
                            });
                        }
                    } else if (kategori_resep == 'dispensing_aseptik') {
                        $.each(response.resep_detail, function (i, item) {
                            table.find('.btn-create-row').trigger('click');
                            let parent_element = table.find('.hh-parent:last');

                            parent_element.find('[name*="[nama_obat]"]').val(item.racikan);
                            parent_element.find('[name*="[jumlah]"]').val(item.jumlah);
                            parent_element.find('[name*="[aturan_penggunaan]"]').val(item.aturan);
                            parent_element.find('[name*="[catatan]"]').val(item.dispensing_aseptik_catatan);
                            if (item.racikan_detail[0] != undefined) {
                                parent_element.find('[name*="[obat]"]').select2("trigger", "select", {
                                    data: {
                                        id: item.racikan_detail[0].item_farmasi_id,
                                        text: item.racikan_detail[0].nama_obat,
                                    },
                                });
                                parent_element.find('[name*="[dosis_yang_dibutuhkan]"]').val(item.racikan_detail[0].dispensing_aseptik_dosis_yang_dibutuhkan);
                                parent_element.find('[name*="[dosis]"]').val(item.racikan_detail[0].dispensing_aseptik_dosis);
                            }
                            if (item.racikan_detail[1] != undefined) {
                                parent_element.find('[name*="[obat_pelarut]"]').select2("trigger", "select", {
                                    data: {
                                        id: item.racikan_detail[1].item_farmasi_id,
                                        text: item.racikan_detail[1].nama_obat,
                                    },
                                });
                            }
                        })
                    } else {
                        $.each(response.resep_detail, function (i, item) {
                            table.find('.btn-create-row').trigger('click');
                            let parent_element = table.find('.hh-parent:last');
                            let index = parent_element.data('index');
                            parent_element.find('[name*="[aturan_penggunaan]"]').val(item.aturan);
                            parent_element.find('[name*="[kategori]"]').val(item.kategori).trigger('change');
                            parent_element.find('.hh-dosis').val(item.dosis);
                            parent_element.find('.hh-jumlah').val(item.jumlah);
                            parent_element.find('.hh-restriksi').val(item.item_template?.retriksi_bpjs_jumlah || '');
                            parent_element.find('.hh-satuan').val(item.type);
                            if (item.kategori == 'generik') {
                                parent_element.find('[name*="[item_farmasi_id]"]').select2("trigger", "select", {
                                    data: {
                                        id: item.item_farmasi_id,
                                        text: item.obat_name,
                                    },
                                });
                            } else {
                                parent_element.find('[name*="[nama_obat]"]').val(item.racikan).trigger('change');
                                parent_element.find('[name*="[tipe_racikan_id]"]').val(item.tipe_racikan_id).trigger('change');
                                $.each(item.racikan_detail, function (i_racikan, item_racikan) {
                                    parent_element.find('.btn-add-racikan').trigger('click');
                                    let parent_racikan_element = table.find('.hh-parent-'+index+':last');
                                    parent_racikan_element.find('.hh-racikan-jumlah').val(item_racikan.jumlah);
                                    parent_racikan_element.find('.hh-racikan-dosis').val(item_racikan.dosis);
                                    parent_racikan_element.find('.hh-racikan-obat').select2("trigger", "select", {
                                        data: {
                                            id: item_racikan.item_farmasi_id,
                                            text: item_racikan.nama_obat,
                                        },
                                    });
                                    _invokeOnlyBpjs(parent_racikan_element);
                                });
                            }
                        })
                    }
                        
                    $('#loading-top').fadeOut();
                },
                error: function() {
                    alert('error');
                },
            });
        }
    });

    $(document).on('click', '.btn-create-row', function() {
        let table = $(this).parents('table');
        let index = table.data('last_index');
        index++;
        table.data('last_index', index);
        let html = '';
        if (kategori_resep == 'tpn') {
            html = `@include('kasus.datamedis.content.resep.components.form-kategori-resep-tpn-row', ['index' => "\${index}"])`;
        } else if (kategori_resep == 'dispensing_aseptik') {
            html = `@include('kasus.datamedis.content.resep.components.form-kategori-resep-dispensing_aseptik-row', ['index' => "\${index}"])`;
        } else {
            html = `@include('kasus.datamedis.content.resep.components.form-kategori-resep-default-row', ['index' => "\${index}"])`;
        }
        let new_element = $(html).appendTo(table.find('tbody'));

        _initComponents(new_element);
        _renumberTable(table);
        new_element.find('.has-required').attr('required', true);
        new_element.find('.select-kategori').each(function (i, item) {
            $(item).trigger('change');
        });
        _invokeOnlyBpjs(new_element);
    });

    $(document).on('click', '.btn-add-racikan', function() {
        let table = $(this).parents('table');
        let parent = $(this).parents('.hh-parent')
        let index = parent.data('index');
        let index_racikan = $(this).data('last_index_racikan');
        let html = '';
        if (kategori_resep == 'default') {
            html = `@include('kasus.datamedis.content.resep.components.form-kategori-resep-default-row-racikan', ['index' => "\${index}", 'racikan_index' => "\${index_racikan}"])`;
        }
        let element_after = parent;
        if (table.find('.hh-parent-'+index).length != 0) {
            element_after = table.find('.hh-parent-'+index+':last');
        }
        let new_element = $(html).insertAfter(element_after);

        index_racikan++;
        $(this).data('last_index_racikan', index_racikan);

        _initComponents(new_element);
        new_element.find('.has-required').attr('required', true);
    });

    $(document).on('click', '.btn-delete-row', function() {
        let table = $(this).parents('table');
        let button = $(this);
        button.parents('tr').remove();
        _renumberTable(table);
    });

    $(document).on('click', '.btn-remove-racikan', function() {
        let parent = $(this).parents('.racikan-parent');
        parent.remove();
    });

    _initComponents($('#table-kategori-resep-tpn'));
    _initComponents($('#table-kategori-resep-default'));
    _initComponents($('#table-kategori-resep-dispensing_aseptik'));
</script>
