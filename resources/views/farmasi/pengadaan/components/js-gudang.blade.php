<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
    var max_jumlah = [];
    var validation = null;
    var laba_farmasi = {!!session('farmasi')->aturan_harga!!};
    $(document).on('keydown', '#form-pengadaan input', function(e){
        if (e.keyCode == 13) {
            e.preventDefault();
            $('#btnAddItems').trigger('click');
            return false;
        }
    });
    $(document).ready(function(){
        $('#ppn-all').on('change', function() {
            $('.ppn').each(function(){
                $(this).prop('checked', $('#ppn-all').is(':checked')).trigger('change');
            });
        });

        removeItem();

        // $('.money').mask('000.000.000.000.000', {reverse: true});
        checkValidDate();
        validation = validateForm();
        var penyedia = $('#cari-peyedia-select2').val();
        var tanggal_awal = $('#tanggal_awal').val();
        var tanggal_akhir = $('#tanggal_akhir').val();
        var harga_minimal = $('#harga_minimal').val();
        var harga_maksimal = $('#harga_maksimal').val();

        if (penyedia == "" && tanggal_awal == "" && tanggal_akhir == "" && harga_minimal == "" && harga_maksimal == "") {
            $('#filter-data').addClass('d-none');
            $('#btnFilter').removeClass('d-none');
        } else {
            $('#filter-data').removeClass('d-none');
            $('#btnFilter').addClass('d-none');
            $('#pengadaan_wrapper').addClass('mt-50');
        }
        initProdusenSelect2('#produsen-select2-1');
    });

    $('#new').on('click', function(){
        $('#modal-large').modal('show');
    });

    $('#close').on('click', function(){
        $('#modal-large').modal('hide');
    });

    $('#peyedia-select2').select2();
    $('#barang-select2-1').select2({
        ajax: {
            url: API_URL+"/farmasi/{{session('farmasi')->slug}}/item/get",
            dataType: 'json',
            delay: 250,
            data: function (params) 
            {
                return {
                    keyword: params.term,
                    page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: data.data,
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 3,
        placeholder: "Cari Barang",
        templateResult: formatBarang,
        templateSelection: formatBarangSelection
    });
    $('#cari-peyedia-select2').select2();
    $('#datepicker1').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'dd/mm/yyyy',
    }).datepicker('setDate', 'today');
    $('.tanggal-datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'dd/mm/yyyy',
    });

    datepicker();

    function datepicker() {
        $('.datepicker').datepicker({
            // startDate: "today",
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy',
        });
    }
    
    counter = 2;
    $('#btnSimpan').on('click', function(e){
        console.log($('.item-row'));
        if($('.item-row').length == 0){
            e.preventDefault();
        }

    });

    $('#btnFilter').on('click', function(){
        $(this).addClass('d-none');
        $(this).parents('.block-content').find('#pengadaan_farmasi_wrapper').css( "margin-top", "80px" );
        $('#filter-data').removeClass('d-none');
    });

    $('#btnCancel').on('click', function(){
        $(this).parents('#filter-data').addClass('d-none');
        $(this).parents('.block-content').find('#pengadaan_farmasi_wrapper').css( "margin-top", "" );
        $('#btnFilter').removeClass('d-none'); 
    });

    $('#btnAddItems').on('click', function(){
        str = `@include('farmasi.pengadaan.components.form-add-pengadaan', ['index' => "\${counter}", 'row' => null])`;
        $('#newItem').append(str);
        $('#barang-select2-'+counter).select2({
            ajax: {
            url: API_URL+"/farmasi/{{session('farmasi')->slug}}/item/get",
                // url: API_URL+"/farmasi/item/get",
                dataType: 'json',
                delay: 250,
                data: function (params) 
                {
                    return {
                        keyword: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.data,
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            placeholder: "Cari Barang",
            templateResult: formatBarang,
            templateSelection: formatBarangSelection
        });
        initProdusenSelect2('#produsen-select2-'+counter);
        datepicker();
        removeItem();
        checkValidDate();
        // $('.money').mask('000.000.000.000.000', {reverse: true});
        datepicker();
        checkValidDate();
        counter++;
    });
    
    function formatBarang (item) {
        if (item.loading) {
            return item.text;
        }
        var stok = 0;
        if(item.stok)
            stok = item.stok.aggregate;
        var markup = item.item_detail.nama + " ("+item.item_detail.satuan+") || Stok = " + stok;

        return markup;
    }

    function formatBarangSelection (item) {
        var stok;
        if(item.item_detail){
            if(item.stok)
                stok = item.stok.aggregate;
            else
                stok = item.stok;
            return item.item_detail.nama + " ("+item.item_detail.satuan+") || Stok = " + stok;
        }

        else return item.text;
    }

    function removeItem() {
        $('.btnRemove').on('click', function(){
            var wrapper = $(this).parents('.item-wrapper');
            wrapper.remove();
            updateTotal();
        });
    }

    $('#newItem').on('select2:select', function (e) {
        var data = e.params.data;
        ide = $(e.target).attr('id');
        ideas = ide.split('-')[2];
        changeHarga(ideas, data.harga);
    });

    function changeHarga(index, harga) {
        console.log(harga);
        // $('#harga-'+index).val(harga);
        // $('#harga-lama-'+index).html('Harga Lama : '.harga);
        // changeSubtotal(index);
        
        //1 bpjs, 2 umum, 0 lainnya
        laba = [];
        numeral.locale('id');
        for (var i = 0; i < laba_farmasi.length; i++) {
            if(laba_farmasi[i].harga_min < harga && laba_farmasi[i].harga_max > harga)
                laba[laba_farmasi[i].perusahaan_tipe_id] = numeral(
                    harga*(100 + laba_farmasi[i].laba) /100).format('0,0');;
        }
        $('#harga-beli-sebelum-'+index).val(harga);
    }

    function changeSubtotal(index, tipe = null) {
        kecil = $('#jumlah-kecil-'+index).val();
        besar = $('#jumlah-besar-'+index).val();
        diskon = parseFloat($('#diskon-'+index).val());
        // harga_box =  $('#harga-box-'+index).cleanVal();
        harga_box =  $('#harga-box-'+index).val();
        
        if (tipe == "jumlah") {
            if (besar == "") $('#jumlah-besar-'+index).val(1);
            if (kecil == "") $('#jumlah-kecil-'+index).val(1);
            kecil = $('#jumlah-kecil-'+index).val();
            besar = $('#jumlah-besar-'+index).val();
            hasil = kecil * besar;
            $('#jumlah-'+index).val(hasil);
        }
        jumlah = $('#jumlah-'+index).val();
        ppn = parseFloat($('#ppn-'+index).val());

        subtotal_diskon = harga_box * besar * diskon / 100.0;
        subtotal_belum_ppn = harga_box * besar;
        subtotal_ppn = harga_box * besar * (ppn) * (100-diskon) /10000;
        subtotal = harga_box * besar * (100+ppn) * (100-diskon) /10000;
        console.log(jumlah, besar, kecil, subtotal, harga_box, ppn, diskon);
        $('#subtotal-diskon-'+index).val(subtotal_diskon);
        $('#subtotal-belum-ppn-'+index).val(subtotal_belum_ppn);
        $('#subtotal-ppn-'+index).val(subtotal_ppn);
        $('#subtotal-'+index).val(subtotal);

        jumlah = besar * kecil;
        harga = subtotal / jumlah;
        $('#harga-'+index).val(isNaN(harga) ? 0 : harga);
        $('#subtotal-'+index).val(subtotal);
        // $('.money').mask('000.000.000.000.000', {reverse: true});
        updateTotal();
    }

    function updateTotal() {

        $('#total-ppn').text('0');
        $('#total-diskon').text('0');
        $('#total-belum-ppn').text('0');
        $('#total').text('0');

        subtotals = $('.subtotal-group');

        total_ppn =0;
        total_diskon =0;
        total_belum_ppn =0;
        total =0;
        console.log(subtotals);
        for (var i = 0; i < subtotals.length; i++) {
            total_ppn += parseFloat($(subtotals[i]).children('.subtotal-ppn').val());
            total_diskon += parseFloat($(subtotals[i]).children('.subtotal-diskon').val());
            total_belum_ppn += parseFloat($(subtotals[i]).children('.subtotal-belum-ppn').val());
            total += parseFloat($(subtotals[i]).children('.subtotal').val());
        }  
        numeral.locale('id');
        total_ppn = numeral(total_ppn).format('0,0');
        total_diskon = numeral(total_diskon).format('0,0');
        total_belum_ppn = numeral(total_belum_ppn).format('0,0');
        total = numeral(total).format('0,0');
        
        $('#total-ppn').text(total_ppn);
        $('#total-diskon').text(total_diskon);
        $('#total-belum-ppn').text(total_belum_ppn);
        $('#total').text(total);
    }

    function readImage(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var preview = 
                    '<center><img width="150" src="' + e.target.result + '" />'+
                    '<p>' + input.files[0].name + '</p></center>';
                var previewZone = $(input).parent().parent().find('.preview-zone');
                var boxZone = $(input).parent().find('.preview-zone').find('.box').find('.box-body').find('.preview-img');
                previewZone.removeClass('d-none');
                boxZone.empty();
                boxZone.append(preview);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function resetImg(e) {
        e.wrap('<form>').closest('form').get(0).reset();
        e.unwrap();
    }

    $('.remove-preview').on('click', function() {
        var previewZone = $(this).parents('.preview-zone');
        var changeImg = $(this).parents('.form-group').find('.change-img');
        previewZone.addClass('d-none');
        resetImg(changeImg);
    });

    $('.change-img').change(function() {
        readImage(this);
    });

    function checkValidDate() {
        $('.item-wrapper').on('change', '.datepicker', function(){
            var today = new Date();

            var str = $(this).val();
            var res = str.split('/');
            var expired = res[1]+'/'+res[0]+'/'+res[2];
            var expiredDate = new Date(expired);
            console.log(expiredDate, today);
            if (today > expiredDate) {
                $(this).parent('div').find('.txt-date').html('Tanggal kurang dari hari ini !');
            } else {
                $(this).parent('div').find('.txt-date').html('');
            }
        });
    }
</script>

<script type="text/javascript">
    function validateForm() {
        return jQuery('#form-pengadaan').validate({
            ignore: [],
            errorClass: 'invalid-feedback animated fadeInDown',
            errorElement: 'div',
            errorPlacement: function(error, e) {
                jQuery(e).parents('.form-group > div').append(error);
            },
            highlight: function(e) {
                jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
            },
            success: function(e) {
                jQuery(e).closest('.form-group').removeClass('is-invalid');
                jQuery(e).remove();
            },
            rules: {
                'peyedia': {
                    required: true,
                },
                'katalog_id': {
                    required: true,
                },
                'sumber_dana_id': {
                    required: true,
                },
                'barang[]': {
                    required: true,
                },
                'jumlah[]': {
                    required: true,
                    max: function(e){
                        max = jQuery(e).data('max');
                        return max;
                    }
                },
                'expired[]': {
                    required: true,  
                },
            },
            messages: {
                'peyedia': 'Kolom ini wajib diisi',
                'sumber_dana_id': 'Kolom ini wajib diisi',
                'katalog_id': 'Kolom ini wajib diisi',
                'barang[]': 'Kolom ini wajib diisi',
                'jumlah[]': 'Kolom ini wajib diisi dan harus < maximal',
                'expired[]': 'Kolom ini wajib diisi',
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    }
    function initProdusenSelect2(element_name)
    {
        $(element_name).select2({
            ajax: {
                url: API_URL+"/keuangan/perusahaan/search-select2",
                dataType: 'json',
                delay: 250,
                data: function (params) 
                {
                    return {
                        keyword: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.data,
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            placeholder: "Cari Produsen",
            templateResult: formatProdusen,
            templateSelection: formatProdusenSelection
        });
    }

    

    function formatProdusen (item) {
        if (item.loading) {
            return item.text;
        }
        var markup = item.nama;

        return markup;
    }

    function formatProdusenSelection (item) {
        if(item.nama) return item.nama;
        else return item.text;
    }

</script>