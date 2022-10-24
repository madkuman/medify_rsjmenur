<script type="text/javascript">
    if($('#jenis-distribusi').val() == "Permintaan"){
        var farm_slug = $("select[name='unit_tujuan']").children('option:selected').data('slug');
        var farm_asal = "{{session('farmasi')->slug}}";
    }
    else {
        var farm_slug = "{{session('farmasi')->slug}}";
        var farm_asal = $("select[name='unit_tujuan']").children('option:selected').data('slug');
    }

    $('#cari-unit-select2').select2();
    $('#unit-tujuan-select2').select2();
    $('#barang-select2-1').select2({
        ajax: {
            url: API_URL+"/farmasi/"+farm_slug+"/item/get",
            dataType: 'json',
            delay: 250,
            data: function (params) 
            {
                return {
                    keyword: params.term,
                    page: params.page,
                    farm_asal : farm_asal
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

    function formatBarang (item) {
        if (item.loading) {
            return item.text;
        }

        var stok = 0;
        if(item.stok)
            stok = item.stok.aggregate;
        if($('#jenis-distribusi').val() == "Permintaan")
            var markup = item.item_detail.nama + " ("+item.item_detail.satuan+")- Stok Sekarang : "+(item.stok_asal == undefined ? 0 : item.stok_asal)+" - Stok Tujuan : " +(stok==undefined ? 0 : stok) + " - Harga : "+item.item_detail.harga;
        else
            var markup = item.item_detail.nama + " ("+item.item_detail.satuan+")- Stok Sekarang : "+(stok==undefined ? 0 : stok)+" - Stok Tujuan : " + (item.stok_asal == undefined ? 0 : item.stok_asal) + " - Harga : "+item.item_detail.harga;
        return markup;
    }

    function formatBarangSelection (item) {
       if(item.item_detail){
            tipeObatDb = item.item_detail.satuan;

            var stok = 0;
            if(item.stok)
                stok = item.stok.aggregate;

           if($('#jenis-distribusi').val() == "Permintaan")
                var markuup = item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok Sekarang : "+item.stok_asal+" - Stok Tujuan : " + stok + " - Harga : "+item.item_detail.harga;
           else
               var markuup = item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok Sekarang : "+stok+" - Stok Tujuan : " + item.stok_asal + " - Harga : "+item.item_detail.harga;
            return markuup
        } 
        else return item.text;
    }
    datepicker();

    function datepicker() {
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy',
        });
    }

    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });

    $('#btnFilter').on('click', function(){
        $(this).addClass('d-none');
        $('#filter-data').removeClass('d-none');
        $(this).parents('.block-content').find('#distribusi_farmasi_wrapper').addClass('mt-50');
    });

    $('#btnCancel').on('click', function(){
        $(this).parents('#filter-data').addClass('d-none');
        $('#btnFilter').removeClass('d-none');
        $(this).parents('.block-content').find('#distribusi_farmasi_wrapper').removeClass('mt-50');
    });

    $('#unit-tujuan-select2').on("select2:select", function(e) { 
        changeJenis();
    });

    var counter = 1;
    function strItem(i) {
        str = 
        `<div class="row justify-content-center item-wrapper">
            <div class="col-7">
                <div class="form-group">
                    <div>
                        <h1 id="stok-hid-`+i+`" hidden></h1>
                        <h1 id="distribusi-hid-`+i+`" hidden></h1>
                        <select class="js-select2 barang-select2 form-control template-select" id="barang-select2-`+i+`" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang">
                            <option></option>
                        </select>
                        <p class="text-danger" id="alert-`+i+`" hidden>Stok kurang</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <div class="input-group">
                        <input type="number" class="form-control" id="jumlah-`+i+`" name="jumlah[]" placeholder="Jumlah" autocomplete="off">
                        
                    </div>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>`;
        return str;
    }

    function strRetur(i) {
        str = 
        `<div class="row item-wrapper">
            <div class="col-5">
                <div class="form-group">
                    <div>
                        <h1 id="distribusi-hid-`+i+`" hidden></h1>
                        <select class="js-select2 form-control template-select" id="template-select2-`+i+`" name="template[]" style="width: 100%;">
                            <option value="">Cari Barang</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <div>
                        <select class="js-select2 form-control" id="barang-select2-`+i+`" name="barang[]" onchange="changeJumlah(`+i+`)" style="width: 100%;">
                            <option value="">Pilih Tanggal Kadaluarsa</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <div class="input-group">
                        <input type="number" class="form-control" id="jumlah-`+i+`" name="jumlah[]" placeholder="Jumlah" autocomplete="off">
                        
                    </div>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>`;
        return str;
    }
    $('#btnAddItems').on('click', function(){
        counter++;
        if($('#jenis-distribusi').val() == "Permintaan"){
            var farm_slug = $("select[name='unit_tujuan']").children('option:selected').data('slug');
            var farm_asal = "{{session('farmasi')->slug}}";
        }
        else {
            var farm_slug = "{{session('farmasi')->slug}}";
            var farm_asal = $("select[name='unit_tujuan']").children('option:selected').data('slug');
        }

        $('#newItem').append(strItem(counter));
        $('#barang-select2-'+counter).select2({
            ajax: {
                url: API_URL+"/farmasi/"+farm_slug+"/item/get",
                dataType: 'json',
                delay: 250,
                data: function (params) 
                {
                    return {
                        keyword: params.term,
                        page: params.page,
                        farm_asal : farm_asal
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
        removeItem();
    });

    $('#btnAddRetur').on('click', function(){
        counter++;
        if($('#jenis-distribusi').val() == "Permintaan"){
            var farm_slug = $("select[name='unit_tujuan']").children('option:selected').data('slug');
            var farm_asal = "{{session('farmasi')->slug}}";
        }
        else {
            var farm_slug = "{{session('farmasi')->slug}}";
            var farm_asal = $("select[name='unit_tujuan']").children('option:selected').data('slug');
        }
        $('#newItem').append(strRetur(counter));
        $('#barang-select2-'+counter).select2();
        $('#template-select2-'+counter).select2({
            ajax: {
                url: API_URL+"/farmasi/"+farm_slug+"/item/get",
                dataType: 'json',
                delay: 250,
                data: function (params) 
                {
                    return {
                        keyword: params.term,
                        page: params.page,
                        farm_asal:farm_asal
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
        removeItem();
    });

    $('#newItem').on('select2:select', '.template-select',function (e) {
        var data = e.params.data;
        ide = $(e.target).attr('id');
        ideas = ide.split("-")[2];
        var max_dist = 0;
        if (data.max_distribusi != null) max_dist = data.max_distribusi;
        $('#distribusi-hid-'+ideas).text(max_dist);

        if(($('#jenis-distribusi').val() == 'Retur' && !data.element) || $('#jenis-distribusi').val() == 'Kiriman' || $('#jenis-distribusi').val() == 'Pengembalian') {
            changeItems(ideas);
        }
        else {
            cekStok();

            if (data.stok != null) {
                $('#stok-hid-'+ideas).text(data.stok.aggregate);
                var min_stok = data.stok.aggregate;
                if (data.stok.aggregate > max_dist && max_dist != 0) min_stok = max_dist; 
                $('#jumlah-'+ideas).val('');
                $('#jumlah-'+ideas).parent().find('.input-group-append .input-group-text').text('Max: '+min_stok);
                $('#jumlah-'+ideas).attr({
                    "max" : min_stok,
                    "min" : 0
                });
            } else {
                $('#stok-hid-'+ideas).text(0);
                $('#jumlah-'+ideas).parent().find('.input-group-append .input-group-text').text('Max: 0');
                $('#jumlah-'+ideas).val('');
                $('#jumlah-'+ideas).attr({
                    "max" : 0,
                    "min" : 0
                });
            }
        }
    });

    function cekStok() {
        flag = 0;
        if($('#jenis-distribusi').val() == 'Kiriman' || $('#jenis-distribusi').val() == 'Pengembalian') {
            for(x=1; x<=counter; x++)
            {
                stok = parseInt($('#stok-hid-'+x).text());
                if(document.getElementById("jumlah-"+x) == null) continue;
                jumlah = $('#jumlah-'+x).val();
                if(jumlah>stok) 
                {
                    flag++;
                    $('#alert-'+x).attr('hidden', false);
                }
                else $('#alert-'+x).attr('hidden', true);
            }
            if(flag > 0) $('#saveBtn').attr('disabled', true);
            else $('#saveBtn').attr('disabled', false);
        }
    }

    function changeItems(index) {
        $("#barang-select2-"+index).children('option').remove();
        temp = $('#template-select2-'+index).val();
        var url = "{{ url('/api/farmasi/'.session('farmasi')->slug.'/item/active') }}/"+temp;            

        $.get( url , function( data ) {
            if(data.length == 0) {
                $("#barang-select2-"+index).append('<option>Belum ada barang</option>');
                $("#jumlah-"+index).val('');
                $('#jumlah-'+index).parent().find('.input-group-append .input-group-text').text('Max: 0');
                $("#jumlah-"+index).prop('max',0);
            }
            for(var key in data)
            {
                row = data[key];
                $("#barang-select2-"+index).append('<option value="'+row.id+'" data-max="'+row.jumlah+'">'+formatDate(row.kadaluarsa)+'</option>');
                var max_dist = $('#distribusi-hid-'+index).text();
                if(key==0) {
                    if (row.jumlah > parseInt(max_dist) && parseInt(max_dist) != 0) var batas = parseInt(max_dist);
                    else var batas = row.jumlah;

                    $("#jumlah-"+index).val(batas);
                    $("#jumlah-"+index).prop('max',batas);
                    $('#jumlah-'+index).parent().find('.input-group-append .input-group-text').text('Max: '+batas);
                }
            }
        });
        //$('#harga-'+index).val(harga);
    }

    function changeJumlah(index) {
        max = $("#barang-select2-"+index).find(':selected').data('max');
        $("#jumlah-"+index).val(max);
        $("#jumlah-"+index).prop('max', max);
        $('#jumlah-'+index).parent().find('.input-group-append .input-group-text').text('Max: '+max);
    }

    function lihatStok(index) {
        bar = $("#barang-select2-"+index).val();
        console.log(bar);
        var url = "{{ url('/farmasi/item/stok') }}/"+bar;
        if(bar) popupwindow(url,'Stok Barang Tiap Farmasi',620,1000);

    }

    function changeJenis() {
        counter = 1;
        if($('#jenis-distribusi').val() == 'Retur' || $('#jenis-distribusi').val() == 'Kiriman' || $('#jenis-distribusi').val() == 'Pengembalian') {
            $('#heading-item').addClass('d-none');
            $('#heading-retur').removeClass('d-none');
            $('#newItem').empty();
            $('#newItem').append(strRetur(counter));
            $('#barang-select2-'+counter).select2();
            var farm_asal = $("select[name='unit_tujuan']").children('option:selected').data('slug');
            $('#template-select2-'+counter).select2({
                ajax: {
                    url: API_URL+"/farmasi/{{session('farmasi')->slug}}/item/get",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) 
                    {
                        return {
                            keyword: params.term,
                            page: params.page,
                            farm_asal:farm_asal
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
            removeItem();
            $('#btnAddItems').attr('hidden', true);
            $('#btnAddRetur').attr('hidden', false);
        }
        else {
            var farm_slug = $("select[name='unit_tujuan']").children('option:selected').data('slug');
            var farm_asal = "{{session('farmasi')->slug}}";
            
            $('#heading-retur').addClass('d-none');
            $('#heading-item').removeClass('d-none');
            $('#newItem').empty();
            $('#newItem').append(strItem(counter));
            $('#barang-select2-'+counter).select2({
                ajax: {
                    url: API_URL+"/farmasi/"+farm_slug+"/item/get",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) 
                    {
                        return {
                            keyword: params.term,
                            page: params.page,
                            farm_asal:farm_asal
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
            removeItem();
            $('#btnAddItems').attr('hidden', false);
            $('#btnAddRetur').attr('hidden', true);
        }
    }

    function removeItem() {
        $('.btnRemove').on('click', function(){
            var wrapper = $(this).parents('.item-wrapper');
            wrapper.remove();
        });
    }

    $('#btnReset').on('click', function(e) {
        $('#cari-unit-select2').val(null).trigger('change');
        $('#tanggal_awal').val(null).trigger('change');
        $('#tanggal_akhir').val(null).trigger('change');
        $('#jenis-select2').val(null).trigger('change');
        $('#status_menunggu').prop('checked', true);
        $('#status_selesai').prop('checked', true);
        $('#status_konfirmasi').prop('checked', true);
        $('#tipe_masuk').prop('checked', true);
        $('#tipe_keluar').prop('checked', true);
        document.getElementById("formFilter").submit();
    });
</script>

<script type="text/javascript">
    var BeFormValidation = function() {
        var initValidationBootstrap = function(){
            jQuery('#form-distribusi').validate({
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
                    'unit_tujuan': {
                        required: true,
                    },
                    'barang[]': {
                        required: true,
                    },
                    'jumlah[]': {
                        required: true,
                    }
                },
                messages: {
                    'unit_tujuan': 'Kolom ini wajib diisi',
                    'barang[]': 'Kolom ini wajib diisi',
                    'jumlah[]': {
                        required: 'Kolom ini wajib diisi',
                        range: 'Stok kurang / melebihi batas distribusi',
                        max: 'Stok kurang / melebihi batas distribusi'
                    },
                }
            });
        };

        return {
            init: function () {
                initValidationBootstrap();
                jQuery('.js-select2').on('change', function(){
                    jQuery(this).valid();
                });
            }
        };
    }();

    jQuery(function(){ BeFormValidation.init(); });
</script>