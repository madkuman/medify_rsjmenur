
    <script type="text/javascript">
        @if($distribusi->status==0)
                @if($distribusi->tipe==1)
                counter = {{count($distribusi->draft)}}
                @elseif($distribusi->tipe == -1)
                counter = {{count($distribusi->distribusi_detail->draft)}}
                @endif
        @elseif($distribusi->status==1)
                @if($distribusi->tipe==1)
                counter = {{count($distribusi->distribusi_detail->log)}}
                @elseif($distribusi->tipe == -1)
                counter = {{count($distribusi->log)}}
                @endif
        @endif
        tipe = "{{$distribusi->tipe}}";
        status = "{{$distribusi->status}}";
        var farm_slug = "{{session('farmasi')->slug}}";
        var farm_asal= "{{$distribusi->detail_tujuan->slug}}";
        if ($('#form-distribusi').length) {
            var form_act = $('#form-distribusi').attr('action');
            var form_arr = form_act.split('/');
            var form_type = form_arr[form_arr.length - 1];
            console.log($("select[name='type']").val())
            if (form_type == 'edit' && $("select[name='type']").val() == "Permintaan") {
                farm_slug = $("select[name='unit_tujuan']").children('option').data('slug');
                farm_asal = "{{session('farmasi')->slug}}";
            }
        }
        removeItem();
        cekStok();
        datepicker();
        for(x=1; x<=counter; x++)
        {
            changeItems(x,0)
            $('#items-select2-'+x).select2();
            
            $('#barang-select2-'+x).select2({
                ajax: {
                    url: API_URL+"/farmasi/"+farm_slug+"/item/get",
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
        }
        $('#unit-tujuan-select2').select2();
    
        function formatBarang (item) {
                if (item.loading) {
                    return item.text;
                }
    
                var stok = 0;
                if(item.stok)
                    stok = item.stok.aggregate;
                console.log($('#jenis-distribusi').val())
            if($("select[name='type']").val() == "Permintaan")
                var markup = item.item_detail.nama + " ("+item.item_detail.satuan+")- Stok Sekarang : "+item.stok_asal+" - Stok Tujuan : " + stok + " - Harga : "+item.item_detail.harga;
            else
                var markup = item.item_detail.nama + " ("+item.item_detail.satuan+")- Stok Sekarang : "+stok+" - Stok Tujuan : " + item.stok_asal + " - Harga : "+item.item_detail.harga;

                return markup;
            }
    
            function formatBarangSelection (item) {
               if(item.item_detail){
                    tipeObatDb = item.item_detail.satuan;
    
                    var stok = 0;
                    if(item.stok)
                        stok = item.stok.aggregate;
                   if($("select[name='type']").val() == "Permintaan")
                       var markuup = item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok Sekarang : "+item.stok_asal+" - Stok Tujuan : " + stok + " - Harga : "+item.item_detail.harga;
                   else
                       var markuup = item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok Sekarang : "+stok+" - Stok Tujuan : " + item.stok_asal + " - Harga : "+item.item_detail.harga;
                   return markuup
                } 
                else return item.text;
            }
    
        $('.datepicker-1').datepicker({
            startDate: "today",
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy',
        })
    
        function datepicker() {
            $('.datepicker').datepicker({
                startDate: "today",
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy',
            }).datepicker('setDate', 'today');;
        }
    
        var input = document.createElement("input");
        input.type = "hidden";
        input.name = "form_changed";
        input.value = 0;
        $('#newItem').append(input);
    
        $("form :input").change(function() {
            $('input[name=form_changed]').val(1);
        });
    
        $('#btnEdit').on('click', function(){
            $('#modal-large-edit').modal('show');
        });
    
        $('#btnEditTerkirim').on('click', function(){
            $('#modal-large-terkirim').modal('show');
        });
    
        $('#btnAddItems').on('click', function(){
            counter++;
            str = `<div class="row item-wrapper">
            <div class="col-md-5">
            <div class="form-group">
            <div>
            <h1 id="stok-hid-`+counter+`" hidden></h1>
            <h1 id="distribusi-hid-`+counter+`" hidden></h1>
            <select class="js-select2 form-control template-select" id="barang-select2-`+counter+`" name="template[]" style="width: 100%;">
            <option value="">Cari Barang</option>
            </select>
            </div>
            </div>
            </div>
            <div class="col-md-3">
            <div class="form-group">
            <div>
            <select class="js-select2 form-control" id="items-select2-`+counter+`" name="barang[]" onchange="changeJumlah(`+counter+`)" style="width: 100%;">
            <option value="">Pilih Tanggal Kadaluarsa</option>
            </select>
            </div>
            </div>
            </div>
            <div class="col-md-3">
            <div class="form-group">
            <div class="input-group">
            <input type="number" class="form-control" id="jumlah-`+counter+`" name="jumlah[]" placeholder="Jumlah" autocomplete="off">
            <div class="input-group-append">
            <span class="input-group-text">Max: 0</span>
            </div>
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
            /*<div class="col-md-2">
                <div class="form-group">
                    <button type="button" class="btn btn-lg btn-outline-info btnStok" onclick="lihatStok(`+counter+`)">
                        Lihat Stok
                    </button>
                </div>
            </div>*/
            $('#newItem').append(str);
            $('#items-select2-'+counter).select2();
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
                            farm_asal: farm_asal
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
    
        $('#btnAddLog').on('click', function(){
            counter++;
            str = 
            `<div class="row justify-content-center item-wrapper">
            <div class="col-md-7">
            <div class="form-group">
            <div>
            <h1 id="stok-hid-`+counter+`" hidden></h1>
            <h1 id="distribusi-hid-`+counter+`" hidden></h1>
            <select class="js-select2 barang-select2 form-control template-select" id="barang-select2-`+counter+`" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang">
            <option></option>
            </select>
            <p class="text-danger" id="alert-`+counter+`" hidden>Stok kurang</p>
            </div>
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
            <div class="input-group">
            <input type="number" class="form-control" id="jumlah-`+counter+`" name="jumlah[]" placeholder="Jumlah" onchange="cekStok()" autocomplete="off">
            <div class="input-group-append">
            <span class="input-group-text">Max: 0</span>
            </div>
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
                    url: API_URL+"/farmasi/"+farm_slug+"/item/get",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) 
                    {
                        return {
                            keyword: params.term,
                            page: params.page,
                            farm_asal: farm_asal
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
            $('input[name=form_changed]').val(1);
        });
    
        function removeItem() {
            $('.btnRemove').on('click', function(){
                var wrapper = $(this).parents('.item-wrapper');
                wrapper.remove();
                $('input[name=form_changed]').val(1);
            });
        }


        $('.btnShow').on('click', function(){
            $(this).parents('.item-wrapper').children('.added').show();
            $(this).parents('.item-wrapper').children('.deleted').hide();
            $(this).parents('.item-wrapper').find('.ditolak').val(null);
            $('input[name=form_changed]').val(1);
        });

        $('.btnHide').on('click', function(){
            $(this).parents('.item-wrapper').children('.deleted').show();
            $(this).parents('.item-wrapper').children('.added').hide();
            $(this).parents('.item-wrapper').find('.ditolak').val(1);
            $('input[name=form_changed]').val(1);
        });
    
        $('#newItem').on('select2:select', '.template-select', function (e) {
            var data = e.params.data;
            ide = $(e.target).attr('id');
            ideas = ide.split("-")[2];
            if(status == 0) {
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
                    $('#jumlah-'+ideas).val('');
                    $('#jumlah-'+ideas).parent().find('.input-group-append .input-group-text').text('Max: 0');
                    $('#jumlah-'+ideas).attr({
                        "max" : 0,
                        "min" : 0
                    });
                }
            }
            if(!data.element && status == 1) {
                changeItems(ideas, 1);
            }
            var max_dist = 0;
            if (data.max_distribusi != null) max_dist = data.max_distribusi;
            $('#distribusi-hid-'+ideas).text(max_dist);
        });
    
        function cekStok() {
            flag = 0;
            if(tipe == 1) return;
            else {
                for(x=1; x<=counter; x++)
                {
                    stok = parseInt($('#stok-hid-'+x).text());
                    if(document.getElementById("jumlah-"+x) == null) continue;
                    jumlah = $('#jumlah-'+x).val();
                    if(jumlah>stok) 
                    {
                        flag++;
                        // $('#alert-'+x).attr('hidden', false);
                    }
                    // else $('#alert-'+x).attr('hidden', true);
                }
                if(flag > 0) $('#saveBtn').attr('disabled', true);
                else $('#saveBtn').attr('disabled', false);
            } 
        }
    
        function lihatStok(index) {
            bar = $("#barang-select2-"+index).val();
            console.log(bar);
            var url = "{{ url('/farmasi/item/stok') }}/"+bar;
            if(bar) popupwindow(url,'Stok Barang Tiap Farmasi',620,1000);
    
        }
    
        function changeItems(index, remove) {
            if(remove == 1) $("#items-select2-"+index).children('option').remove();
            temp = $('#barang-select2-'+index).val();
            var url = "{{ url('/api/farmasi/'.session('farmasi')->slug.'/item/active') }}/"+temp;            
    
            $.get( url , function( data ) {
                if(data.length == 0 && remove == 1) {
                    $("#items-select2-"+index).append('<option>Belum ada barang</option>');
                    $("#jumlah-"+index).val('');
                    $("#jumlah-"+index).prop('max',0);
                    $('#jumlah-'+index).parent().find('.input-group-append .input-group-text').text('Max: 0');
                }
                for(var key in data)
                {
                    row = data[key];
                    if(row.id != $("#items-select2-"+index).val() || remove == 1) $("#items-select2-"+index).append('<option value="'+row.id+'" data-max="'+row.jumlah+'">'+formatDate(row.kadaluarsa)+'</option>');
                    var max_dist = $('#distribusi-hid-'+index).text();
                    if(key==0 && remove == 1) {
                        if (row.jumlah >= max_dist && max_dist != 0) var batas = max_dist;
                        else var batas = row.jumlah;
                        console.log(batas, max_dist);
                        $("#jumlah-"+index).val(batas);
                        $("#jumlah-"+index).prop('max',batas);
                        $('#jumlah-'+index).parent().find('.input-group-append .input-group-text').text('Max: '+batas);
                    }
                }
            });
    
                //$('#harga-'+index).val(harga);
        }

        function changeJumlah(index) {
            max = $("#items-select2-"+index).find(':selected').data('max');
            // $("#jumlah-"+index).val(max);
            var item_id  = $("#items-select2-"+index).val();

            if(max == undefined)
                max = 0;

            if(item_id == $("#items-select2-"+index).data('default')) 
                max += $("#jumlah-"+index).data('default');
            $("#jumlah-"+index).prop('max', max);
            $('#jumlah-'+index).parent().find('.input-group-append .input-group-text').text('Max: '+max);
        }
    
        $('#btnKonfirm').on('click', function(){
            $('#modal-large-konfirm').modal('show');
        });

        $('.readonly').select2("readonly", true);

        $('#btnVerify').on('click', function(){
            var confirmSupp = $(this).parent().find('#form-konfirmasi');
            swal({
                title: 'Apa anda yakin?',
                text: 'Pastikan barang yang diterima benar',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Konfirmasi',
                html: false,
                preConfirm: function() {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 50);
                    });
                }
            }).then(function(result){
                if (result.value) {
                    confirmSupp.submit();
                    //swal('Berhasil', 'Data berhasil dihapus.', 'success');
                    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                } else if (result.dismiss === 'cancel') {
                    swal('Batal', 'Konfirmasi dibatalkan.', 'error');
                }
            });
        });

        $('.confirm-del').on('click', function(){
            var deleteSupp = $(this).parent().find('#form-hapus');
            swal({
                title: 'Apa anda yakin?',
                text: 'Data yang telah terhapus tidak dapat dikembalikan lagi',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Hapus',
                html: false,
                preConfirm: function() {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 50);
                    });
                }
            }).then(function(result){
                if (result.value) {
                    deleteSupp.submit();
                    //swal('Berhasil', 'Data berhasil dihapus.', 'success');
                    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                } else if (result.dismiss === 'cancel') {
                    swal('Batal', 'Hapus data dibatalkan.', 'error');
                }
            });
        });

        $('#confirm-reject').on('click', function(){
            var reject = 
            '<form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/distribusi/reject')}}" id="rejectForm">' +
            '{{csrf_field()}}' +
            '<input type="hidden" name="id" value="{{$distribusi->id}}">' +
            '<div class="form-container">' +
            '<div class="form-container">' +
            '<textarea name="explanation" class="form-control" rows="4" placeholder="Mengapa anda menolak permintaan ini" id="explanation"></textarea>' +
            '</div>' +
            '</div>' +
            '</form>';

            swal({
                title: 'Alasan Menolak',
                html: reject,
                showCancelButton: true,
                closeOnConfirm: false,
                allowOutsideClick: false,
                reverseButtons: true,
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-default',
                confirmButtonText: "Tolak",
                confirmButtonText: "Konfirmasi",
                cancelButtonText: "Batal",
                preConfirm: function() {
                    var value = $('#explanation').val();
                    return new Promise((resolve) => {
                        if (value === '') {
                            swal.showValidationError(
                              'Kolom ini wajib diisi.'
                              );
                            swal.enableButtons()
                        } else {
                            resolve();
                        }
                    })
                },
            }).then((result) => {
                if (result.value) {
                    document.getElementById('rejectForm').submit();
                } else if (result.dismiss === 'cancel') {
                    swal('Batal', 'Tolak permintaan dibatalkan.', 'error');
                }
            })
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