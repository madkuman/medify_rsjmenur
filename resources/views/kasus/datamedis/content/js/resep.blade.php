
<script type="text/javascript">
    /*RESEP*/
    URL = '{{url('')}}'
    nomor_kasus = '{{$kasus->nomor_kasus}}'
    pasien_id = '{{$kasus->pasien_id}}'

    var globaltester;

    var pharmacyId =  $('#nama-apotek').val();
    var pharmacySlug = $('#nama-apotek').find(':selected').data('slug');
    var recordCount = 0;
    var warningCount = 0;
    var stok = {};
    var itemKV = {};

    $('.button-tambah-obat').prop('disabled',true);
    $('.submit-resep').prop('disabled',true);
    $(".racikan").hide();
    $(".div-override-checkbox").hide();

    $('.override-checkbox').change(function () {
        checkWarningOverride($(this).closest('.main-form-container'));
    });

    $('input:radio[name=kategori]').change(function () {
        toggleRacikanGenerik($(this),this.value)
    });

    function toggleRacikanGenerik(element,value,reset=1)
    {
        if (value == 'generik') {
            element.closest('.form-resep').find(".racikan").hide();
            element.closest('.form-resep').find(".generik").show();
            if(reset) element.closest('.form-resep').find(".obat-tipe-generik").val('');
            element.closest('.form-resep').find(".obat-tipe-racikan").prop('disabled',true);
        }
        else {
            element.closest('.form-resep').find(".racikan").show();
            element.closest('.form-resep').find(".generik").hide();
            element.closest('.form-resep').find(".obat-tipe-generik").val('');
            element.closest('.form-resep').find(".obat-tipe-racikan").prop('disabled',false);
            element.closest('.form-resep').find(".racikan-detail-content-dynamic").empty()
            element.closest('.form-resep').find(".btn-add-racikan-detail").trigger( "click" );
        }
        validateCreateResepForm(element.closest('.form-resep'));
    }

    $('#nama-apotek').on('change', function(e) {
        $('#form-resep').show();
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        pharmacyId = valueSelected;
        pharmacySlug = $(this).find(':selected').data('slug')
        initResepRacikanSelect2();
        initSelectNamaObat();
    });

    $(document).ready(function() {
        initSelectNamaObat();
    });

    function initSelectNamaObat() {
        $('.obat-nama-generik').select2({
            ajax: {
                url: API_URL + "/farmasi/" + pharmacySlug + "/item/get",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        keyword: params.term,
                        page: params.page,
                        order_by_stok : 1,
                        kasus_id: "{{ $kasus->id }}",
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    $('.obat-nama-generik').text('').trigger('change');
                    return {
                        results: data.data,
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            minimumInputLength: 3,
            placeholder: "Cari Barang",
            templateResult: formatBarang,
            templateSelection: formatBarangSelection
        });
    }
    function formatBarang (item) {
        if (item.loading) {
            return item.text;
        }

        var stok = 0;
        if(item.stok)
            stok = item.stok.aggregate;
        var markup = item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok : " + stok + " - Harga : "+item.item_detail.harga;
        if (stok == 0) {
            markup = `<div class="select2-warning-item">${markup}</div>`;
        }
        return markup;
    }

    function formatBarangSelection (item) {
        if(item.item_detail){
            tipeObatDb = item.item_detail.satuan;
            var stok = 0;
            if(item.stok){
                stok = item.stok.aggregate;
                itemKV[item.id] = item;
            }else{
                item.stok = 0;
                itemKV[item.id] =item;
            }
            return item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok : " + stok + " - Harga : "+item.item_detail.harga;
        }
        else return item.text;
    }

    $('.obat-nama-generik').on("select2:select", function(e) {
        stok[$(this).val()] = itemKV[$(this).val()].stok;
        $(this).closest('.form-resep').find('.obat-id-generik').val(itemKV[$(this).val()].item_detail.id);
        $(this).closest('.form-resep').find('.obat-tipe-generik').val(itemKV[$(this).val()].item_detail.satuan);
        validateCreateResepForm($(this).closest('.form-resep'));
    });

    $(".obat-jumlah").on('input', function() {
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    $(".obat-nama-racikan").on('input', function() {
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    $(".obat-aturan").on('input', function() {
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    $(".obat-tipe-racikan").change(function() {
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    $(document).on('change', '.resep-racikan-select2', function(){ 
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    $(document).on('change', '.racikan-obat-jumlahs', function(){ 
        validateCreateResepForm($(this).closest('.form-resep'));
    });

    function validateCreateResepForm(element)
    {
        var check_empty = 0;
        var jenis_resep = 'generik';

        if (element.find("input[name='kategori']:checked").val() == 'generik') jenis_resep = 'generik';
        else jenis_resep = 'racikan';

        if(element.find(".obat-jumlah").val() == '') check_empty = 1;
        if(element.find(".obat-aturan").val() == '') check_empty = 1;

        //jika jenis resep generik maka mengecek input nama obat di generik
        if(jenis_resep == 'generik')
            if(element.find(".obat-nama-generik").val() == '' || element.find(".obat-nama-generik").val() == null) check_empty = 1;

        //jika jenis resep racikan maka mengecek input nama obat di generik
        if(jenis_resep == 'racikan')
        {
            if(element.find(".obat-nama-racikan").val() == '') check_empty = 1;
            if(element.find(".obat-tipe-racikan").val() == null) check_empty = 1;

            var obat_items = element.find('.racikan-obat-items');
            var obat_jumlahs = element.find('.racikan-obat-jumlahs');


            obat_items.each(function(i, obj) {
                var $temp_item = $(obj)
                var item_value = $temp_item.val()
                if(item_value == '') check_empty = 1;
            });
            obat_jumlahs.each(function(i, obj) {
                var $temp_item = $(obj)
                var jumlah_value = $temp_item.val()
                if(jumlah_value == '') check_empty = 1;
            });

        }

        if(check_empty == 0) 
            element.find('.button-tambah-obat').prop('disabled',false);
        else
            element.find('.button-tambah-obat').prop('disabled',true);
    }

    $(".button-tambah-obat").click(function() {
        checkPenggunaan($(this).closest('.form-resep'));
    });

    function addToResepList(element, usage_warning)
    {
        recordCount++;
        var type = element.find(".obat-tipe-generik").val();
        if (type=='') type = element.find(".obat-tipe-racikan").val();
        var obat = element.find(".obat-nama-generik").text();
        var obat_id = element.find(".obat-id-generik").val();
        var racikan = element.find(".obat-nama-racikan").val();
        var jumlah = element.find(".obat-jumlah").val();
        var aturan = element.find(".obat-aturan").val();
        var kategori = element.find("input[name='kategori']:checked").val();
        var racikan_detail_items_json = JSON.stringify([]);
        var racikan_detail_jumlah_json = JSON.stringify([]);
        var racikan_detail_nama_json = JSON.stringify([]);

        if(kategori == 'racikan'){
            obat_id = null;
            var obat_string = racikan;
            
            var obat_items = element.find('.racikan-obat-items');
            var obat_jumlahs = element.find('.racikan-obat-jumlahs');

            var obat_items_array = [];
            var obat_nama_array = [];
            var obat_jumlah_array= [];

            obat_items.each(function(i, obj) {
                var $temp_item = $(obj)
                var data =  $temp_item.select2('data')
                console.log(obj, i, data, $temp_item);
                if(data == [0] || data[0] == undefined)
                    return;
                var item_value = data[0].id
                
                if(data[0].text == "") var item_text = data[0].item_detail.nama
                else var item_text = data[0].text

                obat_items_array.push(item_value)
                obat_nama_array.push(item_text)
                obat_string += '<br>'+item_text
            });
            obat_jumlahs.each(function(i, obj) {
                var $temp_item = $(obj)
                var jumlah_value = $temp_item.val()
                obat_jumlah_array.push(jumlah_value)
            });

            racikan_detail_items_json =  JSON.stringify(obat_items_array);
            racikan_detail_jumlah_json =  JSON.stringify(obat_jumlah_array);
            racikan_detail_nama_json =  JSON.stringify(obat_nama_array);
        }
        else{
            var obat_string = obat;
        }
        if(obat_id != null && jumlah > stok[obat_id]){
            warningStok =   `<span class="badge badge-danger warning-stok-'+recordCount+'">
                                <i class="fa fa-warning"/> Stok Kurang (Stok: ${stok[obat_id]})
                            </span><br>`;
        }else{
            warningStok = "";
        }

        content = '<div class="col-12 resep-item-container" id="resepCreateItemContainer'+recordCount+'">'
        content += '<div class="border p-15">'
        content += '<button type="button" class="float-right btn btn-sm btn-circle btn-alt-danger mr-5 mb-5 button-delete-item">'
        content += '<i class="fa fa-times"></i>'
        content += '</button>'
        content += '<button type="button" class="float-right btn btn-sm btn-circle btn-alt-info mr-5 mb-5 button-edit-item">'
        content += '<i class="fa fa-pencil"></i>'
        content += '</button>'
        content+= warningStok
        content += '<span class="font-w400 text-muted" id="display-kategori-tipe-obat">'+type+'</span>'
        content += '<p class="font-w600 mb-5" id="display-nama-obat" style="overflow:hidden; display:block;">'+obat_string+'</p>'
        content += '<span class="font-w400" id="display-jumlah-aturan-obat">Jumlah : '+jumlah+' </span><br>'
        content += '<span style="overflow:hidden; display:block;">Aturan : ' + aturan + '</span>'
        if(usage_warning == 1){
            content += '<div class="alert alert-danger mt-5 mb-5">Obat ini belum habis dikonsumsi pasien</div>';
            warningCount++;
        }
        content += '<input type="hidden" class="input-kategori-obat" name="kategori-obat[]" value="'+kategori+'">'
        content += '<input type="hidden" class="input-tipe-obat" name="tipe-obat[]" value="'+type+'">'
        content += '<input type="hidden" class="input-jumlah-obat" name="jumlah-obat[]" value="'+jumlah+'">'
        content += '<input type="hidden" class="input-nama-obat" name="nama-obat[]" value="'+obat+'">'
        content += '<textarea name="racikan[]" rows="3" style="display:none" class="input-racikan-obat" >'+racikan+'</textarea>'
        content += '<input type="hidden" class="input-aturan-obat" name="aturan-obat[]" value="'+aturan+'">'
        content += '<input type="hidden" class="input-id-obat" name="id-obat[]" value="'+(obat_id || '')+'">'
        content += '<input type="hidden" class="input-warning-obat" name="warning-obat[]" value="'+usage_warning+'">'

        content += `<input type="hidden" class="input-racikan-detail-obat" name="racikan-detail-obat[]" value='`+racikan_detail_items_json+`'>`

        content +=  `<input type="hidden" class="input-racikan-detail-jumlah" name="racikan-detail-jumlah[]" value='`+racikan_detail_jumlah_json+`'>`

        content +=  `<input type="hidden" class="input-racikan-detail-nama" name="racikan-detail-nama[]" value='`+racikan_detail_nama_json+`'>`

        content += '</div>'
        content += '</div>'

        //empty form
        element.find('.daftar-obat').append(content);
        element.find(".obat-nama-generik").val('').trigger('change');
        element.find(".obat-nama-generik").text('').trigger('change');
        element.find(".obat-jumlah").val('');
        element.find(".obat-aturan").val('').trigger('change');
        element.find('.racikan-detail-content-dynamic').empty();
        element.find(".btn-add-racikan-detail").trigger( "click" );
        element.find(".obat-nama-racikan").val('');
        element.find(".obat-tipe-generik").val('');
        element.find(".obat-id-generik").val('');
        element.find('.button-tambah-obat').prop('disabled',true);
        element.parent().find('.submit-resep').prop('disabled',false);
        element.find('#tambah-button').removeClass('d-none');
        element.find('#div-spinner').addClass('d-none');
        checkWarningOverride(element.closest('.main-form-container'));

        $(".button-delete-item").click(function (){
            var warning_flag = $(this).siblings('.input-warning-obat').val();
            var count_list_resep = $(this).parents('.daftar-obat').children('.resep-item-container').length;
            count_list_resep = count_list_resep - 1;
            if (warning_flag == 1) warningCount--;
            checkWarningOverride($(this).closest('.main-form-container'));
            if (count_list_resep<1) {
                $(this).closest('.main-form-container').find('.submit-resep').prop('disabled',true);   
            }
            $(this).parents('.resep-item-container').remove();
        })

        $(".button-edit-item").click( function() {
            var kategori = $(this).siblings('.input-kategori-obat').val();
            var tipe = $(this).siblings('.input-tipe-obat').val();
            var nama = $(this).siblings('.input-nama-obat').val();
            var jumlah = $(this).siblings('.input-jumlah-obat').val();
            var racikan = $(this).siblings('.input-racikan-obat').val();
            var aturan = $(this).siblings('.input-aturan-obat').val();
            var id = $(this).siblings('.input-id-obat').val();

            var racikan_detail_nama_json = $(this).siblings('.input-racikan-detail-nama').val();
            var racikan_detail_jumlah_json = $(this).siblings('.input-racikan-detail-jumlah').val();
            var racikan_detail_obat_json = $(this).siblings('.input-racikan-detail-obat').val();

            var element = $(this).closest('.form-resep')
            fillFormTambahObat(element,kategori,tipe,nama,jumlah,racikan,aturan,id,racikan_detail_nama_json,racikan_detail_jumlah_json, racikan_detail_obat_json)


            var warning_flag = $(this).siblings('.input-warning-obat').val();
            var count_list_resep = $(this).parents('.daftar-obat').children('.resep-item-container').length;
            count_list_resep = count_list_resep - 1;
            if (warning_flag == 1) warningCount--;
            checkWarningOverride($(this).closest('.main-form-container'));
            if (count_list_resep<1) {
                $(this).closest('.main-form-container').find('.submit-resep').prop('disabled',true);
            }
            $(this).parents('.resep-item-container').remove();

        });
    }

    function checkPenggunaan(element, is_paket = 0, paket_data = []) {
        console.log('checking--------------')
        element.find('#tambah-button').addClass('d-none');
        element.find('#div-spinner').removeClass('d-none');
        var obat_id = element.find(".obat-id-generik").val();
        var kategori = element.find("input[name='kategori']:checked").val();

        if (kategori != 'racikan') {
            $.ajax({
                url: API_URL+"/farmasi/resep/check-penggunaan?obat_id="+obat_id+"&pasien_id={{$kasus->pasien_id}}",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    addToResepList(element, response);
                    if(is_paket){
                        paket_data["i"] = paket_data["i"]+1
                        if(paket_data["i"] <= paket_data["size"])
                            seedFormResep(paket_data["details"],paket_data["i"],paket_data["size"])
                    }
                    
                },
                error: function() {
                    addToResepList(element, 0);
                },
            });
        } else {
            addToResepList(element, 0);
            if(is_paket){
                paket_data["i"] = paket_data["i"]+1
                if(paket_data["i"] <= paket_data["size"])
                    seedFormResep(paket_data["details"],paket_data["i"],paket_data["size"])
            }
        }


        element.closest('.form-resep').find(".racikan-detail-content-dynamic").empty()
        element.closest('.form-resep').find(".btn-add-racikan-detail").trigger( "click" );
            
    }

    function checkWarningOverride(element) {
        if (warningCount>0) {
            element.find('.div-override-checkbox').show();
        } else {
            element.find('.div-override-checkbox').hide();
        }
        if (warningCount>0 && !(element.find('.override-checkbox').is(':checked'))) {
            element.find('.submit-resep').prop('disabled',true);
        } else {
            element.find('.submit-resep').prop('disabled',false);
        }
    }



    function fillFormTambahObat(element_form_resep,kategori,tipe,nama,jumlah,racikan,aturan,id,racikan_detail_nama_json,racikan_detail_jumlah_json, racikan_detail_obat_json)
    {
        if(kategori == 'generik')
        {
            var element_radio = element_form_resep.find('.kategori-radio-generik')
            element_form_resep.find('.kategori-radio-generik').prop("checked", true).click();
            element_form_resep.find('.obat-nama-generik').find('option').remove().end().append(new Option(nama,id, true,true));
            element_form_resep.find('.obat-tipe-generik').val(tipe)
            element_form_resep.find('.obat-id-generik').val(id)

            toggleRacikanGenerik(element_radio,'generik',0)
        }
        else
        {
            var element_radio = element_form_resep.find('.kategori-radio-racikan')
            toggleRacikanGenerik(element_radio,'racikan')
            element_form_resep.find('.kategori-radio-racikan').prop("checked", true).click();
            element_form_resep.find('.obat-tipe-racikan').val(tipe).trigger('change');
            element_form_resep.find('.obat-nama-racikan').val(racikan)

            var racikan_detail_nama = JSON.parse(racikan_detail_nama_json)
            var racikan_detail_jumlah = JSON.parse(racikan_detail_jumlah_json)
            var racikan_detail_obat = JSON.parse(racikan_detail_obat_json)
            var length = racikan_detail_nama.length;

            var index;
            element_form_resep.find(".racikan-detail-content-dynamic").empty()
            for (index = 0; index < length; ++index) {
                element_form_resep.find(".btn-add-racikan-detail").trigger( "click" );


                var elements_racikan_obat_array = element_form_resep.find('.racikan-obat-items')
                var elements_racikan_jumlah_array = element_form_resep.find('.racikan-obat-jumlahs')

                var elements_racikan_obat = elements_racikan_obat_array[index]
                var elements_racikan_jumlah = elements_racikan_jumlah_array[index]

                var value_obat_id = racikan_detail_obat[index]
                var value_obat_text = racikan_detail_nama[index]


                var $newOption = $("<option selected='selected'></option>").val(value_obat_id).text(value_obat_text)

                $(elements_racikan_obat).append($newOption).trigger('change');

                $(elements_racikan_jumlah).val(racikan_detail_jumlah[index])

            };



            
        }

        element_form_resep.find('.obat-jumlah').val(jumlah)
        element_form_resep.find('.obat-aturan').val(aturan);
        element_form_resep.find('.button-tambah-obat').prop('disabled',false);


    }

    $(document).ready(function() {

        $('#resepKirimFarmasiCheck').change(function() {

            if ($('#resepKirimFarmasiCheck').is(":checked"))
            {
                $('#nama-apotek').attr('required','required');
            }
            else {
                $('#nama-apotek').removeAttr('required');
            }

        });

    });


    $('#form_create_resep input').keydown(function (e) {
        if (e.keyCode == 13) {
            var inputs = $(this).parents("form").eq(0).find(":input");
            if (inputs[inputs.index(this) + 1] != null) {                    
                inputs[inputs.index(this) + 1].focus();
            }
            e.preventDefault();
            return false;
        }
    });

    $('#form_edit_resep input').keydown(function (e) {
        if (e.keyCode == 13) {
            var inputs = $(this).parents("form").eq(0).find(":input");
            if (inputs[inputs.index(this) + 1] != null) {                    
                inputs[inputs.index(this) + 1].focus();
            }
            e.preventDefault();
            return false;
        }
    });
    
    function historiResep()
    {
        window.open(
        "{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/resep/histori","popUpWindow",
        "height=800,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes");
    }


    getArrayAturan()
    function initAturanAutocomplete(array_aturan){
       $('.aturan-autocomplete').autoComplete({
        minChars: 1,
        source: function(term, suggest){
            term = term.toLowerCase();

            var aturanList  = array_aturan
            var suggestions    = [];

            for (i = 0; i < aturanList.length; i++) {
                if (~ aturanList[i].toLowerCase().indexOf(term)) suggestions.push(aturanList[i]);
            }

            suggest(suggestions);
        }
    });
    }

   function getArrayAturan()
   {
        $.ajax({
            url: API_URL + '/farmasi/aturan/get-has-usage',
            type: 'GET',
            dataType: 'json',
            tryCount : 0,
            retryLimit : 3,
            success: function(response) {
                initAturanAutocomplete(response)
            },
            error: function() {

                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {

                    $.ajax(this);
                    return;
                }else{
                   //donothing
                }  

            },
        });
    }

    $('.btn-add-racikan-detail').click(function(){
        var $content = $(
        `
        <div class="row gutters-tiny form-group resep-racikan-new-appended">
            <div class="col-7">
                <select class="js-select2 form-control resep-racikan-select2 racikan-obat-items" name="obat_racikan[]">
                </select>
            </div>
            <div class="col-3">
                <input type="number" class="form-control racikan-obat-jumlahs" name="jumlah_racikan[]">
            </div>
            <div class="col-2 pt-5 pl-10">
                <button class="btn btn-danger racikan-btn-delete btn-sm" type="button"><i class="fa fa-trash"></i></button>
            </div>
        </div>
        `)

        var content = $(this).parent().parent().find('.racikan-detail-content-dynamic').append($content);

        var obat_items = $(this).parent().parent().find('.racikan-obat-items')

        var obat_length = obat_items.length
        if(obat_length == 1){
            content.find('.racikan-btn-delete').prop('disabled',true);
        }
        


        var $element = $content.find('.resep-racikan-select2')
        initResepRacikanSelect2($element);
        // initResepRacikanSelect2();
        validateCreateResepForm($(this).closest('.form-resep'));
    })

    function initResepRacikanSelect2(element)
    {
        if(element == undefined)
            return
        element.select2({
        // $('.resep-racikan-select2').select2({
            ajax: {
                url: API_URL+"/farmasi/"+pharmacySlug+"/item/get",
                dataType: 'json',
                delay: 250,
                data: function (params) 
                {
                    return {
                        keyword: params.term,
                        page: params.page,
                        order_by_stok: 1,
                        kasus_id: "{{ $kasus->id }}",
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    var items = data.data
                    var i;
                    for(i = 0;i<items.length;i++)
                    {
                       items[i].id = items[i].item_detail.id
                    }
                    return {
                        results: items,
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            placeholder: "Cari Barang",
            templateResult: formatObatRacikan,
            templateSelection: formatObatRacikanSelection
        });
    }

    



    function formatObatRacikan (item) {
        if (item.loading) {
            return item.text;
        }

        var stok = 0;
        if(item.stok)
            stok = item.stok.aggregate;
        var markup = item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok : " + stok + " - Harga : "+item.item_detail.harga;

        return markup;
    }

    function formatObatRacikanSelection (item) {
        if(item.item_detail){
            tipeObatDb = item.item_detail.satuan;

            var stok = 0;
            if(item.stok)
                stok = item.stok.aggregate;
            return item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok : " + stok + " - Harga : "+item.harga;  
        } 
        else return item.text;
    } 

    $(document).on('click', '.racikan-btn-delete', function(){ 
        $(this).closest(".resep-racikan-new-appended").remove();
        validateCreateResepForm($(this).closest('.form-resep'));
    }); 

    

    $(document).on('click', '.btn-toggle-histori-resep', function(){ 
        initHistoriResep('.histori-resep-container',pasien_id);
    }); 

</script>