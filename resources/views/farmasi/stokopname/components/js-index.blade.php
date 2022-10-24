<script>
    $(document).ready(function(){
        var oTable = $("#stokopname_farmasi").DataTable({
            pageLength: 10,
            autoWidth: false,
            lengthChange: false,
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: API_URL+"/farmasi/{{session('farmasi')->slug}}/stokopname/get",
                data: function(d) {
                    d.farmid = "{{session('farmasi')->id}}";
                    d.tanggal_awal = $('#tanggal_awal').val();
                    d.tanggal_akhir = $('#tanggal_akhir').val();
                    d.flag = function() {
                        var status = [];
                        if($('#so_besar').is(":checked")) status.push(0);
                        if($('#so_satuan').is(":checked")) status.push(1);
                        return status;
                    };
                }
            },
            language: {
                processing: '<i class="fa fa-4x fa-asterisk fa-spin text-info mt-50"></i>'
            },
            columns: [
                { data: 'rownum', name: 'rownum', orderable: false, searchable: false, class: 'text-center'},
                { data: 'tanggal', name: 'tanggal'},
                { data: 'keterangan', name: 'keterangan'},
                { data: 'dibuat', name: 'dibuat'},
                { data: 'status', name: 'status'},
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
            $(this).parents('.block-content').find('#stokopname_farmasi_wrapper').css('margin-top', '70px');
            $('#filter-data').removeClass('d-none');
        });

        $('#btnCancel').on('click', function(){
            $(this).parents('#filter-data').addClass('d-none');
            $(this).parents('.block-content').find('#stokopname_farmasi_wrapper').css('margin-top', '');
            $('#btnFilter').removeClass('d-none'); 
        });
    });
</script>

<script type="text/javascript">
    var idBarang =0;
    var namaBarang ="";

    $('#new').on('click', function(){        
        $('#modal-large').modal('show');
    });

    $('#new2').on('click', function(){
        $('#modal-large2').modal('show');
    });

    $('#close').on('click', function(){
        $('#modal-large').modal('hide');
    });

    var counter = 1;
    $('#btnAddItems').on('click', function(){
        counter++;
        str = 
        `<div class="row justify-content-center item-baru gutters-tiny">
        <div class="col-md-4">
        <div class="form-group">
        <div>
        <input type="hidden" id="barang-select2-`+counter+`" name="barang[]" value="${idBarang}" class="barang-dummy"/>
        <select class="js-select2 barang-select2-dummy form-control" style="width: 100%;" data-placeholder="Pilih Barang" disabled readonly>
        <option val="">${namaBarang}</option>
        </select>
        </div>
        </div>
        </div>
        <div class="col-md-2">
        <div class="form-group">
        <div>
        <input type="text" class="js-datepicker form-control" id="tanggal-datepicker-`+counter+`" name="kadaluarsa[]" placeholder="Masukkan Tanggal Kadaluarsa" autocomplete="off">
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
        <div class="col-md-3">
        <div class="form-group">
        <div>
        <input type="text" class="form-control" id="ket-`+counter+`" name="keterangan[]" placeholder="Keterangan">
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
        
        removeItem();
        $('#tanggal-datepicker-'+counter).datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy', 
        });
    });

    $('#barang-select2-1').on('select2:select', function(){
        var data = $('#barang-select2-1').select2('data')[0];
        idBarang = data.id;
        namaBarang = data.item_detail.nama + ' ('+data.item_detail.satuan+')';
        
        var newOption =  new Option(data.item_detail.nama + ' ('+data.item_detail.satuan+')', 0, true, true);
        $('.barang-select2-dummy').empty();
        $('.barang-select2-dummy').append(newOption).trigger('change');

        $('.barang-dummy').val(data.id);
    });

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
    removeItem();
    $('#tanggal-datepicker-1').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'dd/mm/yyyy', 
    });

    function formatBarang (item) {
        if (item.loading) {
            return item.text;
        }

        var markup = item.item_detail.nama + " ("+item.item_detail.satuan+")";

        return markup;
    }

    function formatBarangSelection (item) {
        if(item.item_detail) return item.item_detail.nama + " ("+item.item_detail.satuan+")";
        else return item.text;
    }

    function removeItem() {
        $('.btnRemove').on('click', function(){
            var wrapper = $(this).parents('.item-baru');
            wrapper.remove();
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