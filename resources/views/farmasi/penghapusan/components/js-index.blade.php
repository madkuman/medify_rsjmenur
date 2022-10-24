<script type="text/javascript">
    $(document).ready(function(){
        var tanggal_awal = $('#tanggal_awal').val();
        var tanggal_akhir = $('#tanggal_akhir').val();

        if (tanggal_awal == "" && tanggal_akhir == "") {
            $('#filter-data').addClass('d-none');
            $('#btnFilter').removeClass('d-none');
        } else {
            $('#filter-data').removeClass('d-none');
            $('#btnFilter').addClass('d-none');
            $('#pengadaan_wrapper').addClass('mt-50');
        }
    });

    $('#new').on('click', function(){
        $('#modal-large').modal('show');
    });

    $('#close').on('click', function(){
        $('#modal-large').modal('hide');
    });

    $('#barang-select2-1').select2();
    $('#template-select2-1').select2({
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

    $(document).ready(function(){
        var oTable = $("#penghapusan_farmasi").DataTable({
            pageLength: 10,
            autoWidth: false,
            lengthChange: false,
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: API_URL+"/farmasi/{{session('farmasi')->slug}}/penghapusan/get",
                data: function(d) {
                    d.farmid = "{{session('farmasi')->id}}";
                    d.tanggal_awal = $('#tanggal_awal').val();
                    d.tanggal_akhir = $('#tanggal_akhir').val();
                }
            },
            language: {
                processing: '<i class="fa fa-4x fa-asterisk fa-spin text-info mt-50"></i>'
            },
            columns: [
                { data: 'rownum', name: 'rownum', orderable: false, searchable: false, class: 'text-center'},
                { data: 'tanggal', name: 'tanggal'},
                { data: 'keterangan', name: 'keterangan'},
                { data: 'detail', name: 'detail', orderable: false, searchable: false, class: 'text-center'},
            ],
            order: []
        })
        $('#searchBtn').on('click', function(e) {
            oTable.draw();
            e.preventDefault();
        });

        $('#btnReset').on('click', function(e) {
            $('#tanggal_awal').val(null).trigger('change');
            $('#tanggal_akhir').val(null).trigger('change');
            oTable.draw();
            e.preventDefault();
        });

        $('#btnFilter').on('click', function(){
            $(this).addClass('d-none');
            $(this).parents('.block-content').find('#penghapusan_farmasi_wrapper').css('margin-top', '70px');
            $('#filter-data').removeClass('d-none');
        });

        $('#btnCancel').on('click', function(){
            $(this).parents('#filter-data').addClass('d-none');
            $(this).parents('.block-content').find('#penghapusan_farmasi_wrapper').css('margin-top', '');
            $('#btnFilter').removeClass('d-none'); 
        });
    });
    
    counter = 1;
    $('#btnAddItems').on('click', function(){
        counter++;
        str = `<div class="row item-wrapper">
                    <div class="col-md-5">
                        <div class="form-group">
                            <div>
                                <select class="js-select2 form-control" id="template-select2-`+counter+`" name="template[]" style="width: 100%;">
                                    <option value="">Cari Barang</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div>
                                <select class="js-select2 form-control" id="barang-select2-`+counter+`" name="barang[]" onchange="changeJumlah(`+counter+`)" style="width: 100%;">
                                    <option value="">Pilih Barang</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div>
                                <input type="number" class="form-control" id="jumlah-`+counter+`" name="jumlah[]" placeholder="Jumlah">
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
        $('#barang-select2-'+counter).select2();
        $('#template-select2-'+counter).select2({
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
        removeItem();
    });

     function formatBarang (item) {
        if (item.loading) {
            return item.text;
        }

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
            return item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok : " + stok + " - Harga : "+item.item_detail.harga;
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
        ideas = ide.split('-');
        ideas = ideas[ideas.length - 1];
        
        if(!data.element) changeItems(ideas);
    });

    function changeItems(index) {
        $("#barang-select2-"+index).children('option').remove();
        temp = $('#template-select2-'+index).val();
        var url = "{{ url('/api/farmasi/'.session('farmasi')->slug.'/item/active') }}/"+temp;            

        $.get( url , function( data ) {
            if(data.length == 0) {
                $("#barang-select2-"+index).append('<option>Belum ada barang</option>');
                $("#jumlah-"+index).val('');
                $("#jumlah-"+index).prop('max',0);
            }
            for(var key in data)
            {
                row = data[key];
                $("#barang-select2-"+index).append('<option value="'+row.id+'" data-max="'+row.jumlah+'">'+formatDate(row.kadaluarsa)+'</option>');
                if(key==0) {
                    $("#jumlah-"+index).val(row.jumlah);
                    $("#jumlah-"+index).prop('max',row.jumlah);
                }
            }
        });
        
    }

    function changeJumlah(index) {
        max = $("#barang-select2-"+index).find(':selected').data('max');
        $("#jumlah-"+index).val(max);
        $("#jumlah-"+index).prop('max', max);

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
                    'barang[]': {
                        required: true,
                    },
                    'jumlah[]': {
                        required: true,
                    },
                    'template[]': {
                        required: true,  
                    }
                },
                messages: {
                    'template[]': 'Kolom ini wajib diisi',
                    'barang[]': 'Kolom ini wajib diisi',
                    'jumlah[]': 'Jumlah tidak valid'                        
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