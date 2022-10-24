<script type="text/javascript">

    var tipeObatDb;
    pasien_id = 0;
    $(document).ready(function(){
        $('#jenis-pembayaran').select2();
        changePasien();
        checkResep();
        removeRacikan();
        initHistoriResep('.histori-resep-container',pasien_id);
    });
    var waschecked = null; //biar kalau klik 2x hilang centangnya
    var resepTemp;
    var harian = "{{!is_null(session('farmasi')->perharian)}}";
    var hargaPerRacikan;
    var warningCount = 0;

    $("#div-override-checkbox").hide();

    $('#satuan-select2').select2();
    $('#aturan-select2').select2({
        ajax: {
            url: API_URL+"/farmasi/aturan/search-has-usage",
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
                console.log(data);
                return {
                    results: data,
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 1,
        tags: true
    });
    $('#satuan-penggunaan-select2').select2({
        tags: true
    });
    //obat pertama
    $('#namaObat').select2({
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
    $('#kemo-select2-1').select2({
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
        templateSelection: formatBarangSelectionKemo
    });
    $('#racikan-select2-1').select2({
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

    function formatPasien (item) {
        if (item.loading) {
            return item.text;
        }

        var markup = item.name;

        return markup;
    }

    function formatPasienSelection (item) {
        if(item.name) return item.name;
        else return item.text;
    }

    function formatAturan (item) {
        if (item.loading || item.text) {
            return item.text;
        }
        console.log(item);
       
    } 

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
    function formatBarangSelectionKemo (item) {
        if(item.kadal){
            var kadaluarsa = item.kadal.kadal.split('-').reverse().join('/');
            $('#exp_date_kemo').val(kadaluarsa)
        }
        if(item.item_detail){
            tipeObatDb = item.item_detail.satuan;

            var stok = 0;
            if(item.stok)
                stok = item.stok.aggregate;
            return item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok : " + stok + " - Harga : "+item.harga;  
        } 
        else return item.text;
    }

    $('.pasien-select2').select2({
        ajax: {
            url: API_URL+"/pasien/get",
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
        placeholder: "Cari Pasien",
        templateResult: formatPasien,
        templateSelection: formatPasienSelection
    });

    $("#pasien-form").change(function(){
        var pasien_id = $(this).val();
        initHistoriResep('.histori-resep-container',pasien_id);
        $.ajax({
            url: API_URL + '/pasien/'+pasien_id+'/kasus-with-krs',
            dataType: 'json',
            success: function(data){
                var kasus_current = $('#kasus-select2').val();
                var option = [];
                option.push({
                    id: 0,
                    text: 'Tanpa kasus'
                });

                for (i in data) {
                    if(kasus_current != data[i].id)
                    {
                        option.push({
                            id: data[i].id,
                            text: data[i].lokasi +' - '+data[i].waktu_create +' - ('+data[i].status_krs_text +')' ,
                        });
                    }
                }
                $('#kasus-select2').html('').select2({
                    data: option
                })
            }
        });
    });

    $("#pasien-form-kemo").change(function(){
        var pasien_id = $(this).val();
        $.ajax({
            url: API_URL + '/pasien/'+pasien_id+'/kasus-with-krs',
            dataType: 'json',
            success: function(data){
                var kasus_current = $('#kasus-kemo-select2').val();
                var option = [];
                option.push({
                    id: 0,
                    text: 'Tanpa kasus'
                });

                for (i in data) {
                    if(kasus_current != data[i].id)
                    {
                        option.push({
                            id: data[i].id,
                            text: data[i].lokasi +' - '+data[i].waktu_create +' - ('+data[i].status_krs_text +')' ,
                        });
                    }
                }
                $('#kasus-kemo-select2').html('').select2({
                    data: option
                })
            }
        });
    });

    datepicker();

    function datepicker() {
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy',
        });
    }  

    $('#btnSubmit').on('click', function(){
        document.getElementById("form-transaksi").submit();
        $('#btnSubmit').attr('disabled', true);
    });

    function daftarPenunjang()
    {
        $('.btn-penunjang').on('click', function(){
            console.log('abcde');
            console.log($(this).data('slug'));
            var slug = $(this).data('slug');
            var farmasi = $(this).data('farmasi');
            daftarPenunjangWindow(slug,farmasi);
        });
    }

    function daftarPenunjangWindow(slug,farmasi)
    {
        window.open(
        "{{url('farmasi')}}/"+farmasi+"/penunjang/"+slug+"","popUpWindow",
        "height=800,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes");
    }

    $('#btnFilter').on('click', function(){
        $(this).addClass('d-none');
        $(this).parents('.block-content').find('#transaksi_farmasi_wrapper').css('margin-top','70px');
        $('#filter-data').removeClass('d-none');
    });

    $('#btnCancel').on('click', function(){
        $(this).parents('#filter-data').addClass('d-none');
        $(this).parents('.block-content').find('#transaksi_farmasi_wrapper').css('margin-top','');
        $('#btnFilter').removeClass('d-none'); 
    });

    // $('#btnReset').on('click', function(e) {
    //     $('#tanggal_awal').val(null).trigger('change');
    //     $('#tanggal_akhir').val(null).trigger('change');
    //     $('#pasien-filter').val(null).trigger('change');
    //     /*$('#harga_minimal').val(null).trigger('change');
    //     $('#harga_maksimal').val(null).trigger('change');*/
    //     $('#status_menunggu').prop('checked', true);
    //     $('#status_selesai').prop('checked', true);
    //     $('#reset').val(1).trigger('change');
    //     document.getElementById("formFilter").submit();
    // });

    counter = 1;
    $('#btnAddItems').on('click', function(){
        counter++;
        str = 
        `<div class="row item-wrapper">
        <div class="col-md-5">
        <div class="form-group">
        <h1 id="harga-hid-`+counter+`" hidden></h1>
        <select class="js-select2 barang-select2 form-control barang" id="barang-select2-`+counter+`" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang">
        <option></option>
        </select>
        </div>
        </div>
        <div class="col-md-2">
        <div class="form-group">
        <input type="number" class="form-control" id="jumlah-`+counter+`" name="jumlah[]" placeholder="Jumlah">
        </div>
        </div>
        <div class="col-md-2">
        <div class="form-group">
        <select class="js-select2 form-control" id="satuan-select2-`+counter+`" name="satuan[]" style="width: 100%;" data-placeholder="Pilih Satuan">
        <option value="caps">caps</option>
        <option value="tab">tab</option>
        <option value="inj">inj</option>
        <option value="syr">syr</option>
        <option value="pil">pil</option>
        </select>
        </div>
        </div>
        <div class="col-md-2">
        <div class="form-group">
        <input type="text" class="form-control" id="aturan-`+counter+`" name="aturan[]" placeholder="Aturan">
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
        $('#satuan-select2-'+counter).select2();
        //racikan
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
        removeItem();
        // changeBarang();
    });

    $('#btnAddHari').on('click', function(){
        counter++;
        str = 
        `<div class="row justify-content-center item-wrapper">
        <div class="col-md-3">
        <div class="form-group">
        <h1 id="harga-hid-`+counter+`" hidden></h1>
        <select class="js-select2 barang-select2 form-control barang" id="barang-select2-`+counter+`" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang">
        <option></option>
        </select>
        </div>
        </div>
        <div class="col-md-4">
        <div class="row">
        <div class="col-md-3 px-1">
        <div class="form-group">
        <input type="number" class="form-control" id="jumlah-`+counter+`" name="jumlah[]"  placeholder="Jumlah" onchange="changeDukungan(`+counter+`)" required>
        </div>
        </div>
        <div class="col-md-3 px-1">
        <div class="form-group">
        <input type="number" class="form-control" id="hari-7-`+counter+`" name="hari7[]"  placeholder="7 hari" onchange="changeDukungan(`+counter+`)" required>
        </div>
        </div>
        <div class="col-md-3 px-1">
        <div class="form-group">
        <input type="number" class="form-control" id="hari-23-`+counter+`" name="hari23[]"  placeholder="23 hari" required>
        </div>
        </div>
        <div class="col-md-3 px-1">
        <div class="form-group">
        <input type="number" class="form-control" id="dukungan-rs-`+counter+`" name="dukunganrs[]" placeholder="Dukungan RS" onchange="changeDukungan(`+counter+`)">
        </div>
        </div>
        </div>
        </div>
        <div class="col-md-2">
        <div class="form-group">
        <select class="js-select2 form-control" id="satuan-select2-`+counter+`" name="satuan[]" style="width: 100%;" data-placeholder="Pilih Satuan">
        <option value="caps">caps</option>
        <option value="tab">tab</option>
        <option value="inj">inj</option>
        <option value="syr">syr</option>
        <option value="pil">pil</option>
        </select>
        </div>
        </div>
        <div class="col-md-2">
        <div class="form-group">
        <input type="text" class="form-control" id="aturan-`+counter+`" name="aturan[]" placeholder="Aturan">
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
        $('#satuan-select2-'+counter).select2();
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
        removeItem();
        // changeBarang();
    });

    function changeDukungan() {
        jumlah = $('#jumlah-obat').val();
        hari7 = $('#hari-7').val();
        dukungan = $('#dukungan-rs').val();
        console.log(jumlah,hari7,dukungan);
        $('#hari-23').val(jumlah-hari7-dukungan);
    }

    $('.status_pasien').on('click', function(){
        $this = $(this);
        var uncheck = function(){
          setTimeout(function(){$this.removeAttr('checked');},0);
        };
        var unbind = function(){
          $this.unbind('mouseup',up);
        };
        var up = function(){
          uncheck();
          unbind();
        };
        if($this.data('waschecked') == false)
        {   
            if($this.data('flag') == 1)
            {
                $('.pasien-div').hide();
                $('.histori-resep-container').hide();
                $('input[type=radio][name=dokter-jenis][value=luar]').prop('checked', true).change();
                $('#text-pasien').addClass('d-none');
                $('#pasien-rsal-select2').show();
                $this.parent().siblings('.css-checkbox').children('.status_pasien').data('waschecked',false);
            }
            else
            {
                $('.pasien-div').hide();
                $('.histori-resep-container').hide();
                $('#nama-pasien-input').show();
                $('#dokter-input').show();
                $('input[type=radio][name=dokter-jenis][value=luar]').prop('checked', true).change();
                $('#text-pasien').removeClass('d-none');
                $('#pasien-rsal-select2').hide();
                $this.parent().siblings('.css-checkbox').children('.status_pasien').data('waschecked',false);
            }
            $this.data('waschecked',true);
            $this.bind('mouseup',up);
            $this.one('mouseout', unbind);
        }
        else if($this.data('waschecked') == true)
        {   
            $('.pasien-div').show();
            $('.histori-resep-container').show();
            $('input[type=radio][name=dokter-jenis][value=rsal]').prop('checked', true).change();
            $('#text-pasien').addClass('d-none');
            $('#pasien-rsal-select2').show();
            $this.data('waschecked',false);
            $this.prop('checked',false);
            $this.bind('mouseup',up);
            $this.one('mouseout', unbind);
        }

    });

    function changePasien() {
        pas = $('.status_pasien').is(":checked");
        if(!pas) {
            $('#text-pasien').addClass('d-none');
            $('input[type=radio][name=dokter-jenis][value=rsal]').prop('checked', true).change();
            $('.pasien-div').show();
        }
        // else if(pas) 
        // {   
        //     if($(this).data('waschecked') == false)
        //     {
        //         $('.pasien-div').hide();
        //         $('input[type=radio][name=dokter-jenis][value=luar]').prop('checked', true).change();
        //         $(this).data('waschecked',true);        
        //     }
        //     else
        //     {
        //         $('.pasien-div').show();
        //         $('input[type=radio][name=dokter-jenis][value=luar]').prop('checked', true).change();
        //         $(this).data('waschecked',false);
        //         $(this).prop('checked',false);
        //     }
        //     // $('#text-pasien').removeClass('d-none');
        // }
    }

    function removeItem() {
        $('.btnRemove').on('click', function(){
            var wrapper = $(this).parents('.item-wrapper');
            wrapper.remove();
        });
    }

    //Racikan
    $('#obatGenerik').on('click', function() {
        $(this).parents('.block-content').find('#obatForGenerik').removeClass('d-none');
        $('#satuan-select2').parent().addClass('d-none');
        $(this).parents('.block-content').find('#obatForRacikan').addClass('d-none');
    });

    $('#racikan').on('click', function() {
        $(this).parents('.block-content').find('#obatForGenerik').addClass('d-none');
        $('#satuan-select2').parent().removeClass('d-none');
        $(this).parents('.block-content').find('#obatForRacikan').removeClass('d-none');
    });

    $('#resepForm').on('select2:select', function (e) {
        var data = e.params.data;
        ide = $(e.target).attr('id');
        ideas = ide.slice(-1);
        if(data.item_detail) 
        {
            if(ideas == 't'){
                $("#obat-generik").text(data.item_detail.nama);
                $("#harga-generik").val(data.item_detail.harga);
            }
            else{
                $("#racikan-text-"+ideas).text(data.item_detail.nama);
                $("#harga-racikan-"+ideas).val(data.item_detail.harga);
            }
        }
    });

    cik = 1;
    $('#btnAddRacikan').on('click', function() {
        cik++;
        var formRacikan = 
        `<div class="row racikan-obat-wrapper mt-3">
        <h1 class="text-racikan" id="racikan-text-`+cik+`" hidden></h1>
        <input type="hidden" class="form-control harga-racikan" id="harga-racikan-`+cik+`">
        <div class="col-md-7">
        <select class="js-select2 form-control barang-racikan" id="racikan-select2-`+cik+`" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang">
        <option></option>
        </select>
        <p class="text-warning"></p>
        </div>
        <div class="col-md-3 px-1">
        <input type="number" class="form-control jumlah-obat" id="jumlah" placeholder="Jumlah">
        <p class="text-warning"></p>
        </div>
        <div class="col-md-2">
        <button type="button" class="button-control btn btn-sm btn-danger btn-square btnRemoveRacikan">
        <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
        </div>
        </div>`
        $('#racikan-row').append(formRacikan);
        removeRacikan();
        $('#racikan-select2-'+cik).select2({
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
    });

    function removeRacikan() {
        $('.btnRemoveRacikan').on('click', function() {
            var remove_racikan = $(this).parents('.racikan-obat-wrapper');
            remove_racikan.remove();
        })
    }

    $('#btn-add').on('click', function(){
        checkPenggunaan();
    });
    function checkPenggunaan() {
        $('#tambahResepBtn').addClass('d-none');
        $('#editResepBtn').addClass('d-none');
        $('#div-spinner').removeClass('d-none');
        var obat_id = $('#namaObat').find(":selected").val();
        var pasien_id = $('#pasien-form').find(":selected").val();
        var kategori = $('input[name=jenisObat]:checked').val();
                    
        if (kategori != 'racikan' && pasien_id && obat_id) {
            $.ajax({
                url: API_URL+"/farmasi/resep/check-penggunaan?obat_id="+obat_id+"&pasien_id="+pasien_id+"&from_farmasi=1",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    addToResepList(response);
                },
                error: function() {
                    addToResepList(0);
                },
            });
        } else {
            addToResepList(0);
        }
    }

    //tambah obat ke kiri
    function addToResepList(usage_warning) {
        flag = 0;
        var jenisObat = $('input[name=jenisObat]:checked').val();
        var tipeObat = $('#satuan-select2').val();
        
        if($('#satuan-select2').val() == '') 
        {
            $('#satuan-select2').parent('div').find('.text-warning').html('Harap diisi !');
            flag++;
        }
        else $('#satuan-select2').parent('div').find('.text-warning').html('');

        if($('#jumlahObat').val() == '') 
        {
            $('#jumlahObat').parent('div').find('.text-warning').html('Harap diisi !');
            flag++;
        }
        else $('#jumlahObat').parent('div').find('.text-warning').html('');
        
        var namaObat;
        var namaObatVal;
        var input = {};
        if(harian)
        {
            nomorObat = $('#jumlah-obat').val();
            if($('#jumlah-obat').val() == '') {
                $('#jumlah-obat').parent('div').find('.text-warning').html('Harap diisi !');
                flag++;
            }
            else $('#jumlah-obat').parent('div').find('.text-warning').html('');
            hari7 = $('#hari-7').val();
            hari23 = $('#hari-23').val();
            dukRS = $('#dukungan-rs').val();
        }
        else var nomorObat = $('#jumlahObat').val();
        
        var aturanPenggunaan = $('#aturan-select2 option:selected').text();
        var aturanPenggunaanVal = $('#aturan-select2').val();
        var satuan_penggunaan = $('#satuan-penggunaan-select2').val();
        if(aturanPenggunaan == '') 
        {
            $('#aturan-select2').parent('div').find('.text-warning').html('Harap diisi !');
            flag++;
        }
        else $('#aturan-select2').parent('div').find('.text-warning').html('');

        // if(satuan_penggunaan == '')
        // {
        //     $('#satuan-penggunaan-select2').parent('div').find('.text-warning').html('Harap diisi !');
        //     flag++;
        // }
        // else $('#satuan-penggunaan-select2').parent('div').find('.text-warning').html('');

        var detailRacikan = [];

        var resepJadi = 
        `<div class="col-md-12 resep-jadi">
        <a class="block block-link-shadow" href="javascript:void(0)">
        <div class="block-content block-content-full clearfix">
        <div class="float-right">
        <button type="button" class="btn-block-option btnRemoveResep">
        <i class="fa fa-times"></i>
        </button>
        <input type="hidden" class="input-warning-obat" name="warning-obat[]" value="`+usage_warning+`">
        </div>
        <div class="float-left mt-10">`

        if (jenisObat == 'generik') {
            namaObat = $('#obat-generik').text();
            hargaObat = $('#harga-generik').val();
            tipeObat = tipeObatDb;
            namaObatVal = $('#namaObat').find(":selected").val();

            if(namaObatVal == '') 
            {
                $('#namaObat').parent('div').find('.text-warning').html('Harap diisi !');
                flag++;
            }
            else $('#namaObat').parent('div').find('.text-warning').html('');
            if(flag) return 0;

            namaObat = namaObat.replace("'","")
            namaObat = namaObat.replace('"','')

            input.jenis = jenisObat;
            input.satuan = tipeObat;
            input.obat = namaObatVal;
            input.jumlah = nomorObat;
            input.aturan = aturanPenggunaan;
            input.satuan_penggunaan = satuan_penggunaan;
            input.namaObat = namaObat;
            input.hargaObat = hargaObat;
            if(harian)
            {
                input.hari7 = hari7;
                input.hari23 = hari23;
                input.dukRS = dukRS;
            }

            // cek kalau ada yang sama di resep list
            $('.resep-jadi').each(function() {
                var json_resep = $(this).find('.resep-input').val();

                if(json_resep == 'undefined' || json_resep == undefined)
                    return false;
                resep = JSON.parse(json_resep);
                if (resep.jenis == 'generik' && resep.obat == namaObatVal && resep.aturan == aturanPenggunaan && resep.satuan_penggunaan == satuan_penggunaan) {
                    input.jumlah = parseInt(input.jumlah)+parseInt(resep.jumlah);
                    if(harian)
                    {
                        input.hari7 = parseInt(input.hari7)+parseInt(resep.hari7);
                        input.hari23 = parseInt(input.hari23)+parseInt(resep.hari23);
                        input.dukRS = parseInt(input.dukRS)+parseInt(resep.dukRS);
                    }

                    // remove this from resep list
                    var remove_resep = $(this);
                    var warning_flag = $(this).find('.input-warning-obat').val();
                    if (warning_flag == 1) warningCount--;
                    remove_resep.remove();
                    checkResep();
                    checkWarningOverride();

                    return false;
                }
            });

            resepJadi += `<div class="font-w600 mb-5">Obat </div>
                    <div class="font-size-sm text-muted">`+ tipeObat +`</div>
                    <div class="font-size-sm text-muted">`+ namaObat +`</div>
                    <div class="font-size-sm text-muted">Jumlah : `+ input.jumlah; 

            if(harian) resepJadi += ` (7 Hari : `+input.hari7+`, 23 Hari : `+input.hari23+`, Duk RS : `+input.dukRS+`)`;
            
            resepJadi += ` - Aturan : `+ aturanPenggunaan + ` ` + satuan_penggunaan +`</div>
                    <div class="font-w600 mt-5">Harga : `+ parseFloat(hargaObat*input.jumlah).toLocaleString('id-ID', {currency: 'IDR', style: 'currency'}) +`</div>`;
            if(usage_warning == 1){
                resepJadi += '<div class="alert alert-danger mt-5 mb-5">Obat ini belum habis dikonsumsi pasien</div>';
                warningCount++;
            }
            resepJadi += `<input type="hidden" name="input[]" class="resep-input" value='`+ JSON.stringify(input) +`'>`;
                
        } else if (jenisObat == 'racikan') {
            var namaObatTxt = [];
            var jumlahObatTxt = [];
            var arrInputNamaObat = [];
            var arrInputHargaObat = [];
            var arrInputJumlah = [];
            var textRacikan = $('#textRacikan').val();

            if(textRacikan == '') 
            {
                $('#textRacikan').parent('div').find('.text-warning').html('Harap diisi !');
                flag++;
            }
            else $('#textRacikan').parent('div').find('.text-warning').html('');

            $(".barang-racikan").each(function () {
                if($(this).val() == '')
                {
                    $(this).parent('div').find('.text-warning').html('Harap diisi !');
                    flag++;
                }
                else $(this).parent('div').find('.text-warning').html('');
                arrInputNamaObat.push($(this).val());
                idol = $(this).attr('id').slice(-1);
                var namaObatTemp = $("#racikan-text-"+idol).text();

                namaObatTemp = namaObatTemp.replace("'","")
                namaObatTemp = namaObatTemp.replace('"','')

                namaObatTxt.push(namaObatTemp);
                arrInputHargaObat.push($("#harga-racikan-"+idol).val());
            });

            $(".jumlah-obat").each(function () {
                if($(this).val() == '')
                {
                    $(this).parent('div').find('.text-warning').html('Harap diisi !');
                    flag++;
                }
                else $(this).parent('div').find('.text-warning').html('');
                arrInputJumlah.push($(this).val());
                jumlahObatTxt.push($(this).val());
            });

            if(flag) return 0;

            resepJadi += 
            `<div class="font-w600 mb-5">Racikan</div>
            <div class="font-size-sm text-muted">`+ textRacikan +`</div>
            <div class="font-size-sm text-muted">`+ tipeObat +`</div>`;

            hargaPerRacikan = 0;
            for (var i = 0; i < arrInputNamaObat.length; i++) {
                resepJadi += 
                `<div class="font-size-sm text-muted">
                `+ namaObatTxt[i] +` - `+ jumlahObatTxt[i] +`
                </div>`;
                hargaPerRacikan += arrInputHargaObat[i]*jumlahObatTxt[i];
            }

            input.jenis = jenisObat;
            input.satuan = tipeObat;
            input.racikan = textRacikan;
            input.obat = arrInputNamaObat;
            input.jumlah = nomorObat;
            input.jumlah_racikan = arrInputJumlah;
            input.aturan = aturanPenggunaan;
            input.satuan_penggunaan = satuan_penggunaan;
            input.namaObat = namaObatTxt;
            input.hargaObat = arrInputHargaObat;
            if(harian)
            {
                input.hari7 = hari7;
                input.hari23 = hari23;
                input.dukRS = dukRS;
            }

            resepJadi +=
            `<div class="font-size-sm text-muted">Jumlah : `+ nomorObat; 
            if(harian) resepJadi += ` (7 Hari : `+hari7+`, 23 Hari : `+hari23+`, Duk RS : `+dukRS+`)`;
            resepJadi += ` - Aturan : `+ aturanPenggunaan + ` ` + satuan_penggunaan + `</div>
            <div class="font-w600 mt-5">Harga : `+ parseFloat(hargaPerRacikan*nomorObat).toLocaleString('id-ID', {currency: 'IDR', style: 'currency'}) +`</div>
            <input type="hidden" name="input[]" class="resep-input" value='`+ JSON.stringify(input) +`'>`;
                 /*<input type="hidden" name="jenisObatVal" value="`+ jenisObat +`">
                 <input type="hidden" name="tipeObatVal" value="`+ tipeObat +`">
                 <input type="hidden" name="textRacikan" value="`+ textRacikan +`">
                 <input type="hidden" name="aturanPenggunaanVal" value="`+ aturanPenggunaan +`">`*/
        }

        resepJadi += `</div>
                    </div>
                    </a>
                    </div>`;

        $('#resep-wrapper').append(resepJadi);
        removeResepJadi();
        changeResepJadi();
        reseFields();
        checkResep();
        checkWarningOverride();
        $('#tambahResepBtn').removeClass('d-none');
        $('#editResepBtn').addClass('d-none');
        $('#div-spinner').addClass('d-none');
    }

    function removeResepJadi() {
        $('.btnRemoveResep').on('click', function() {
            var remove_racikan = $(this).parents('.resep-jadi');
            var warning_flag = $(this).siblings('.input-warning-obat').val();
            if (warning_flag == 1) warningCount--;
            remove_racikan.remove();
            checkResep();
            checkWarningOverride();
        })
    }

    function checkWarningOverride() {
        if (warningCount>0) {
            $('#div-override-checkbox').show();
        } else {
            $('#div-override-checkbox').hide();
        }
        if (warningCount>0 && !($('#override-checkbox').is(':checked'))) {
            $('#btnSubmit').attr('disabled', true);
        } else {
            $('#btnSubmit').attr('disabled', false);
        }
    }

    $('#override-checkbox').change(function () {
        checkWarningOverride();
    });

    function reseFields() {
        $('#tipeObat').val(null).trigger('change');
        $('#namaObat').val(null).trigger('change');
        $('#jumlahObat').val(null).trigger('change');
                //$('#aturanPenggunaan').val(null).trigger('change');
        $('#racikan-select2-1').val(null).trigger('change');
        $('#textRacikan').val(null).trigger('change');
        $('#_racikan').val(null).trigger('change');
        $('#jumlah').val(null).trigger('change');
        $('#jumlah-obat').val(null).trigger('change');
        $('#hari-7').val(null).trigger('change');
        $('#hari-23').val(null).trigger('change');
        $('#dukungan-rs').val(null).trigger('change');
        //$('#satuan-select2').val(null).trigger('change');
        $('#aturan-select2').val(null).trigger('change');
        $('#satuan-penggunaan-select2').val(null).trigger('change');
        $('.btnRemoveRacikan').each(function () {
            var remove_racikan = $(this).parents('.racikan-obat-wrapper');
            remove_racikan.remove();
        });
    }

    function checkResep() {
        var countResep = document.getElementsByClassName("resep-jadi");
        if (countResep.length > 0){
            $('#btnSubmit').attr('disabled', false);
            $('#checkResep').addClass('d-none');
        }else{
            $('#btnSubmit').attr('disabled', true);
            $('#checkResep').removeClass('d-none');
        }
    }
    //ganti resep dari kanan ke kiri
    function changeResepJadi() {
        $('.resep-jadi').on('click', function(){
            reseFields();
            resepTemp = $(this);
            input = JSON.parse($(this).find('.resep-input').val());
            if (input.jenis == 'generik') {
                $("#obatGenerik").prop("checked", true).click();
                $("#namaObat").append('<option value="'+input.obat+'" selected>'+input.namaObat+'</option>');
                $('#namaObat').trigger('change');
                $("#obat-generik").text(input.namaObat);
                $("#harga-generik").val(input.hargaObat);
                tipeObatDb = input.satuan;
            }
            else {
                $("#racikan").prop("checked", true).click();
                $("#racikan-select2-1").append('<option value="'+input.obat[0]+'" selected>'+input.namaObat[0]+'</option>');
                $('#racikan-select2-1').trigger('change');
                $('#textRacikan').val(input.racikan);
                $("#racikan-text-1").text(input.namaObat[0]);
                $("#harga-racikan-1").text(input.hargaObat[0]);
                $("#jumlah").val(input.jumlah_racikan[0]);

                cik = 0;
                input.namaObat.forEach(function(nama) {
                    cik++;
                    if(cik==1) cik = cik;
                    else 
                    {
                        var formRacikan = 
                        `<div class="row racikan-obat-wrapper mt-3">
                        <h1 id="racikan-text-`+cik+`" hidden>`+nama+`</h1>
                        <input type="hidden" class="form-control harga-racikan" id="harga-racikan-`+cik+`" value="`+input.hargaObat[cik-1]+`">
                        <div class="col-md-7">
                        <select class="js-select2 form-control barang-racikan" id="racikan-select2-`+cik+`" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang">
                        <option value="`+input.obat[cik-1]+`" selected>`+nama+`</option>
                        </select>
                        </div>
                        <div class="col-md-3 px-1">
                        <input type="number" class="form-control jumlah-obat" id="jumlah" value="`+input.jumlah_racikan[cik-1]+`" placeholder="Jumlah">
                        </div>
                        <div class="col-md-2">
                        <button type="button" class="button-control btn btn-sm btn-danger btn-square btnRemoveRacikan">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                        </div>
                        </div>`
                        $('#racikan-row').append(formRacikan);
                        removeRacikan();
                        $('#racikan-select2-'+cik).select2({
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
                    }
                });
            } 
            $('#satuan-select2').val(input.satuan).change();
            $('#aturan-select2').val(input.aturan).change();
            $('#satuan-penggunaan-select2').val(input.satuan_penggunaan).change();
            if(harian)
            {
                nomorObat = $('#jumlah-obat').val(input.jumlah);
                hari7 = $('#hari-7').val(input.hari7);
                hari23 = $('#hari-23').val(input.hari23);
                dukRS = $('#dukungan-rs').val(input.dukRS);
            }
            else $('#jumlahObat').val(input.jumlah);

            $('#tambahResepBtn').addClass('d-none');
            $('#editResepBtn').removeClass('d-none');
        })
    }

    $('#btn-save').on('click', function(){
        var warning_flag = resepTemp.find('.input-warning-obat').val();
        if (warning_flag == 1) warningCount--;
        resepTemp.remove();
        
        checkPenggunaan();
    });

    $('#btn-cancel').on('click', function(){
        reseFields();

        $('#tambahResepBtn').removeClass('d-none');
        $('#editResepBtn').addClass('d-none');
    });

    function printResepModal(tipe,slug,id,no_resep,dokter_nama,dokter_id,dokter){
        $('#form-print').attr('action', "{{url('farmasi/'.session('farmasi')->slug)}}/"+tipe+"/print/"+slug);
        $('#id-transaksi').val(id);
        $('#nomor-resep-print').val(no_resep);
        if(dokter_nama != ''){
            $('#nama-dokter-print').val(dokter_nama).trigger('change');
        }
        if(dokter_id != '' && dokter != ''){
            $('#select-dokter').val(dokter_id).trigger('change');
        }
        $('#modal-print-resep-index').modal('show');
    }

    $(document).on('click', '.btn-analisa', function() {
        var slug = $(this).data('slug')
        window.open(`{{url('farmasi/'.session('farmasi')->slug.'/transaksi/analisa-resep/')}}/${slug}`, '_blank')
    })

    $(document).on('click', '.btn-call-antrian', function() {
        var slug = $(this).data('slug')
        $.ajax({
            url: `{{url('api/farmasi/transaksi/get')}}/${slug}`,
            beforeSend: function() {
                swal({
                    html: `<h4>Mengambil data...</h4><span class="fa fa-4x fa-cog fa-spin text-primary text-center loader"></span>`,
                    showCancelButton: false,
                    showConfirmButton: false
                });
            },
            success: function(res) {
                $("#id").val(res.id);
                $('#no_rm').val(res.pasien_detail ? res.pasien_detail.no_rm : '-');
                $('#nama_pasien_panggil').val(res.pasien_detail ? res.pasien_detail.name : res.nama_pasien);
                $('#nomor_resep_panggil').val(res.final_detail.nomor_resep);

                var loket_data = res.loket_antrian;
                $('#loket').empty();
                loket_data.forEach(function(item, index){
                    $('#loket').append(`<option value='${item.id}'>${item.nama}</option>`);
                })
                swal.close();
                $("#modal_panggil_antrian").modal('show');
            },
            dataType: "json"
        });       
    })

    $('#btn-simpan-print').on('click', function(e){
        e.preventDefault();
        var $this = $(this).parents('form');
        $this.unbind('submit').submit();
    })
    $('.barang-kemo').select2({
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
        templateSelection: formatBarangSelectionKemo
    });
    

</script>