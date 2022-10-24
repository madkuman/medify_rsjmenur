<script type="text/javascript">
    $(document).ready(function(){
        checkValidDate();
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
    
    counter = 1;
    $('#btnAddItems').on('click', function(){
        counter++;
        str = `<div class="row item-wrapper">
            <div class="col-md-2">
                <div class="form-group">
                    <h1 id="harga-hid-`+counter+`" hidden></h1>
                    <div>
                        <select class="js-select2 form-control" id="barang-select2-`+counter+`" name="barang[]"  style="width: 100%;">
                            <option value="">Cari Barang</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <div>
                        <input type="text" class="form-control" id="jumlah-`+counter+`" onchange="changeSubtotal(`+counter+`)" name="jumlah[]" placeholder="Jumlah">
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <div>
                        <input type="number" class="form-control" id="diskon-`+counter+`" onchange="changeSubtotal(`+counter+`)" name="diskon[]" placeholder="Diskon" value="0">
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <div>
                        <input type="number" class="form-control" id="ppn-`+counter+`" onchange="changeSubtotal(`+counter+`)" name="ppn[]" placeholder="PPN" value="10">
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="subtotal-`+counter+`" onchange="changeSubtotal(`+counter+`)" name="subtotal[]" placeholder="Subtotal">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" name="harga_satuan[]" id="harga-`+counter+`" onchange="changeSubtotal(`+counter+`)" placeholder="Harga Satuan" readonly>
                    <p id="harga-lama-`+counter+`"></p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <div>
                        <input type="text" class="js-datepicker form-control datepicker" name="expired[]" placeholder="Tanggal Expired" autocomplete="off">
                        <p class="text-warning txt-date"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>`;
        $('#newItem').append(str);
        $('#barang-select2-'+counter).select2({
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
        datepicker();
        removeItem();
        checkValidDate();
    });

     function formatBarang (item) {
        if (item.loading) {
            return item.text;
        }
        console.log(item);

        var stok = 0;
        if(item.stok)
            stok = item.stok.aggregate;
        var markup = item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok : " + stok + " - Harga : "+item.item_detail.harga;

        return markup;
    }

    function formatBarangSelection (item) {
       if(item.item_detail){
            tipeObatDb = item.item_detail.satuan;

            var stok = 0;
            if(item.stok)
                stok = item.stok.aggregate;
            return item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok : " + stok + " - Harga : "+item.harga;  
        } 
        else return item.text;
    }

    function removeItem() {
        $('.btnRemove').on('click', function(){
            var wrapper = $(this).parents('.item-wrapper');
            wrapper.remove();
        });
    }

    $('#newItem').on('select2:select', function (e) {
        var data = e.params.data;
        ide = $(e.target).attr('id');
        ideas = ide.slice(-1);
        
        $('#harga-lama-'+ideas).text('Harga Lama : '+data.item_detail.harga);
    });

    function changeHarga(index) {
        harga = $('#harga-hid-'+index).text();
        console.log(harga);
        $('#harga-'+index).val(harga);
        changeSubtotal(index);
    }

    function changeSubtotal(index) {
        jumlah = $('#jumlah-'+index).val();
        diskon = $('#diskon-'+index).val();
        ppn = $('#ppn-'+index).val();
        subtotal = $('#subtotal-'+index).val();
        harga_diskon = subtotal*(100-diskon)/100;
        harga_ppn = harga_diskon + harga_diskon*ppn/100;
        harga = harga_ppn/jumlah;

        $('#harga-'+index).val(harga);
    }

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

    function readImage(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var preview = 
                    '<center><img width="180" src="' + e.target.result + '" />'+
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
        var boxZone = $(this).parents('.preview-zone').find('.box-body');
        var previewZone = $(this).parents('.preview-zone');
        var changeImg = $(this).parents('.form-group').find('.change-img');
        boxZone.empty();
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

            if (today > expiredDate) {
                $(this).parent('div').find('.txt-date').html('Tanggal kurang dari hari ini !');
            } else {
                $(this).parent('div').find('.txt-date').html('');
            }
        });
    }
</script>

<script type="text/javascript">
    var BeFormValidation = function() {
        var initValidationBootstrap = function(){
            jQuery('#form-pengadaan').validate({
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
                    'no_surat': {
                        required: true,
                    },
                    'barang[]': {
                        required: true,
                    },
                    'jumlah[]': {
                        required: true,
                    },
                    'expired[]': {
                        required: true,  
                    }
                },
                messages: {
                    'peyedia': 'Kolom ini wajib diisi',
                    'no_surat': 'Kolom ini wajib diisi',
                    'barang[]': 'Kolom ini wajib diisi',
                    'jumlah[]': 'Kolom ini wajib diisi',
                    'expired[]': 'Kolom ini wajib diisi',
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