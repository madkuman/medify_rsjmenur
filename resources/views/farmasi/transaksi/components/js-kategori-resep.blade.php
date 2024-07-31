<script>
    var farmasi_slug = '{{ session('farmasi')->slug }}';
    var kasus_id = '{{ $transaksi->kasus_id }}';
    var kategori_resep = '{{ $transaksi->ori_detail->kategori_resep }}';
    var transaksi_id = '{{ $transaksi->id }}';
    var transaksi_slug = '{{ $transaksi->slug }}';
    var kemasan = '{{ $transaksi->ori_detail->resep_detail[0]->tpn_kemasan }}';
    var is_stok_kurang_confirm = "{{!is_null(session('farmasi')->stok_kurang_confirm)}}";
    
    function _initComponents(element) {
        element.find('.select2-select-obat').select2({
            width: '100%',
            ajax: {
                url: API_URL + "/farmasi/" + farmasi_slug + "/item/get",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        keyword: params.term,
                        page: params.page,
                        order_by_stok: 1,
                        kasus_id: kasus_id,
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

        $(element).find('.has-required').attr('required', true);
    }

    function _renumberTable(table) {
        table.find('.table-number').each(function(i, item) {
            $(item).text(i + 1);
        });
    }

    var ajax_hitung_harga = null;
    function _kategoriResepHitungHarga(element) {
        let container = $('.container-kategori-resep');
        let table = $('.container-kategori-resep table.table-main');

        let obat = [];
        table.find('.hh-parent').each(function (i, item) {
            if (kategori_resep == 'dispensing_aseptik') {
                let racikan = [];
                racikan.push({
                    item_farmasi_id: $(item).find('.hh-obat_permintaan').val(),
                    jumlah: $(item).find('.hh-jumlah_permintaan').val(),
                });
                racikan.push({
                    item_farmasi_id: $(item).find('.hh-obat_pelarut').val(),
                    jumlah: $(item).find('.hh-jumlah_pelarut').val(),
                });
                obat.push({
                    index: $(item).data('index'),
                    racikan: racikan,
                    jumlah: $(item).find('.hh-jumlah').val(),
                });
            } else {
                let tipe_racikan_id = null;
                if ($(item).find('.select-kategori').val() == 'racikan') {
                    tipe_racikan_id = $(item).find('.hh-tipe-racikan').val();
                }
                let index = $(item).data('index');  
                let racikan = [];
                table.find('.hh-parent-'+index).each(function (i, item_racikan) {
                    racikan.push({
                        racikan_index: $(item_racikan).data('racikan_index'),
                        item_farmasi_id: $(item_racikan).find('.hh-racikan-obat').val(),
                        jumlah: $(item_racikan).find('.hh-racikan-jumlah').val(),
                    });
                });
                obat.push({
                    index: $(item).data('index'),
                    item_farmasi_id : $(item).find('.hh-obat').val(),
                    tipe_racikan_id: tipe_racikan_id,
                    racikan: racikan,
                    jumlah: $(item).find('.hh-jumlah').val(),
                });
            }
        });
        if (ajax_hitung_harga != null) {
            ajax_hitung_harga.abort();
        }
        ajax_hitung_harga = $.ajax({
            url: BASE_URL+'farmasi/'+farmasi_slug+'/transaksi/'+transaksi_slug+'/hitung-harga',
            type: "POST",
            dataType: 'JSON',
            data: {
                transaksi_id: transaksi_id,
                obat: obat,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                $(".warning-stok-kurang").remove();
                container.find('.input-hidden-header-embalase').val(response.data?.total_embalase || 0);
                table.find('.header-embalase').text("Rp " + number_format_formatter.format(response.data?.total_embalase || 0));
                table.find('.header-total_obat').text("Rp " + number_format_formatter.format(response.data?.total_obat || 0));
                table.find('.header-total').text("Rp " + number_format_formatter.format(response.data?.total || 0));

                let is_warning_restriksi = false;
                let total_obat_permintaan = 0;
                let total_obat_pelarut = 0;
                $.each(response.data.data_obat, function (i, item) {
                    let tr = table.find(`[data-index="${item.index}"]`);
                    let jumlah = tr.find('.hh-jumlah').val();
                    tr.find('.hh-hidden-subtotal').val(item?.subtotal);
                    tr.find('.hh-satuan').text(item.satuan);
                    tr.find('.hh-harga').text("Rp " + number_format_formatter.format(item?.harga || 0));
                    tr.find('.hh-subtotal').text("Rp " + number_format_formatter.format(item?.subtotal || 0));
                    tr.find('.hh-input-harga').val(item?.harga || 0);
                    tr.find('.hh-input-subtotal').val(item?.subtotal || 0);
                    if (kategori_resep == 'dispensing_aseptik') {
                        tr.find('.hh-subtotal_obat_permintaan').text("Rp " + number_format_formatter.format(item?.data_racikan[0]?.subtotal_racikan || 0));
                        tr.find('.hh-subtotal_obat_pelarut').text("Rp " + number_format_formatter.format(item?.data_racikan[1]?.subtotal_racikan || 0));

                        tr.find('.hh-input-subtotal_obat_permintaan').val(item?.data_racikan[0]?.subtotal_racikan || 0);
                        tr.find('.hh-input-subtotal_obat_pelarut').val(item?.data_racikan[1]?.subtotal_racikan || 0);

                        total_obat_permintaan += parseFloat(item?.data_racikan[0]?.subtotal_racikan) || 0;
                        total_obat_pelarut += parseFloat(item?.data_racikan[1]?.subtotal_racikan) || 0;
                    }
                    tr.find('.hh-embalase').val(item?.embalase || 0);
                    tr.find('.hh-laba').val(item?.laba || 0);

                    if (item.kategori == 'racikan') {
                        $.each(item.data_racikan, function (j, racikan_item) {
                            let tr_racikan = $(`.hh-parent-${item.index}-${racikan_item.racikan_index}`);
                            if (!is_stok_kurang_confirm && racikan_item.max_stok != -1 && racikan_item.jumlah > racikan_item.max_stok) {
                                tr_racikan.find('.hh-racikan-jumlah').parents('td').append(`<small class="warning-stok-kurang text-danger">Stok kurang, maximal ${racikan_item.max_stok}</small>`);
                            }
                        });
                    } else {
                        if (!is_stok_kurang_confirm && item.max_stok != -1 && item.jumlah > item.max_stok) {
                            tr.find('.hh-jumlah').parents('td').append(`<small class="warning-stok-kurang text-danger">Stok kurang, maximal ${item.max_stok}</small>`);
                        }
                    }
                });
                table.find('.header-total_obat_permintaan').text("Rp " + number_format_formatter.format(total_obat_permintaan));
                table.find('.header-total_obat_pelarut').text("Rp " + number_format_formatter.format(total_obat_pelarut));

                $('[name="tujuan_pembayaran"]').first().trigger('change');
            }
        });
    }

    $(document).on('change', '.hh-obat,.hh-jumlah,.hh-jumlah_permintaan,.hh-jumlah_pelarut,.hh-obat_permintaan,.hh-tipe-racikan,.select-kategori,.hh-racikan-obat,.hh-racikan-jumlah, .hh-tipe-racikan', function () {
        _kategoriResepHitungHarga($(this));
    });

    $(document).on('change','.hh-aturan-per-jam', function () {
        let parent = $(this).parents('.hh-parent');
        let jam = $(this).data('jam');
        if (parseFloat($(this).val()) || 0) {
            parent.find('.hh-text-aturan-per-jam-'+jam).show();
        } else {
            parent.find('.hh-text-aturan-per-jam-'+jam).hide();
        }
    })

    $(document).on('click', '.btn-tambah-detail-racikan', function() {
        let table = $(this).parents('table');
        let parent = $(this).parents('.hh-parent');
        let index = parent.data('index');
        let racikan_index = parseInt(parent.data('last_racikan_index')) || 0;
        
        html = `@include('farmasi.transaksi.components.kategori-resep-default-table-belum-dikonfirmasi-row-racikan', ['index' => "\${index}", 'racikan_index' => "\${racikan_index}"])`;

        let element_after = parent;
        if (table.find('.hh-parent-'+index).length != 0) {
            element_after = table.find('.hh-parent-'+index+':last');
        }
        let new_element = $(html).insertAfter(element_after);
        racikan_index++;
        parent.data('last_racikan_index', racikan_index);

        _initComponents(new_element);
        new_element.find('.has-required').attr('required', true);
        new_element.find('.select-kategori').each(function (i, item) {
            $(item).trigger('change');
        });
    });

    $(document).on('click', '.btn-create-row', function() {
        let table = $(this).parents('table');
        let index = table.data('last_index');
        index++;
        table.data('last_index', index);
        let html = '';
        if (kategori_resep == 'tpn') {
            html = `@include('farmasi.transaksi.components.kategori-resep-tpn-container-row', ['index' => "\${index}", 'item' => null, 'kemasan' => "\${kemasan}"])`;
        } else if (kategori_resep == 'dispensing_aseptik') {
        } else {
        }
        let new_element = $(html).appendTo(table.find('tbody'));

        _initComponents(new_element);
        _renumberTable(table);
        new_element.find('.has-required').attr('required', true);
        new_element.find('.select-kategori').each(function (i, item) {
            $(item).trigger('change');
        });
    });

    $(document).on('click', '.btn-delete-row', function() {
        let table = $(this).parents('table');
        let button = $(this);
        button.parents('tr').remove();
        _renumberTable(table);
        _kategoriResepHitungHarga(table);
    });

    $(document).on('change', '.hh-calc-harian', function () {
        let parent = $(this).parents('.hh-parent');
        let jumlah = parseFloat(parent.find('.hh-jumlah').val()) || 0;
        let hari7 = parseFloat(parent.find('.hh-hari7').val()) || 0;
        let hari23 = parseFloat(parent.find('.hh-hari23').val()) || 0;
        let dukunganrs = parseFloat(parent.find('.hh-dukunganrs').val()) || 0;

        if ($(this).hasClass('hh-jumlah')) {
            hari7 = Math.ceil(jumlah * 7 / 30);
            hari23 = jumlah - hari7;
            parent.find('.hh-hari7').val(hari7);
            parent.find('.hh-hari23').val(hari23);
            parent.find('.hh-dukunganrs').val(0);
        } else if ($(this).hasClass('hh-hari7')) {
            if (hari7 > jumlah) {
                hari7 = jumlah;
                parent.find('.hh-hari7').val(hari7);
            }
            hari23 = jumlah - hari7;
            parent.find('.hh-hari23').val(hari23);
            parent.find('.hh-dukunganrs').val(0);
        } else if ($(this).hasClass('hh-hari23')) {
            if (hari23 > jumlah) {
                hari23 = jumlah;
                parent.find('.hh-hari23').val(hari23);
            }
            hari7 = jumlah - hari23;
            parent.find('.hh-hari7').val(hari7);
            parent.find('.hh-dukunganrs').val(0);
        } else if ($(this).hasClass('hh-dukunganrs')) {
            if (dukunganrs > jumlah) {
                dukunganrs = jumlah;
                hari7 = 0;
                hari23 = 0;
                parent.find('.hh-dukunganrs').val(dukunganrs);
            }
            hari23 = (jumlah - hari7) - dukunganrs;
            if (hari23 < 0) {
                let kekurangan = hari23 * -1;
                hari23 = 0;
                hari7 = hari7 - kekurangan;
            }
            parent.find('.hh-hari7').val(hari7);
            parent.find('.hh-hari23').val(hari23);
        }
    });

    _initComponents($('.container-kategori-resep'));
    _renumberTable($('.container-kategori-resep table.table-main'))
    _kategoriResepHitungHarga($(window));

    // tombol konfirmasi
    $('[name="tujuan_pembayaran"]').on('change', function () {
        let val = $('[name="tujuan_pembayaran"]:checked').val();
        $('#btn-tujuan-pembayaran-kirim-kasir').hide();
        let is_stok_kurang = $('.warning-stok-kurang').length != 0;
        if (is_stok_kurang && !is_stok_kurang_confirm) {
            $('#btn-konfirmasi-pesanan').attr('disabled', true);
        } else {
            $('#btn-konfirmasi-pesanan').attr('disabled', false);
        }
        if (val == 'kasir') {
            $('#btn-tujuan-pembayaran-kirim-kasir').show();
            $('#btn-konfirmasi-pesanan').attr('disabled', true);
        }
    });
    $('[name="tujuan_pembayaran"]').first().trigger('change');
</script>