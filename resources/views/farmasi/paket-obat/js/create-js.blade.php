
<script type="text/javascript">
    /*RESEP*/
    URL = '{{url('')}}'
    var recordCount = 0;
    var harian = "{{!is_null(session('farmasi')->perharian)}}";
    

    $('.button-tambah-obat').prop('disabled',true);
    $('.submit-resep').prop('disabled',true);
    $(".racikan").hide();

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
        }
        validateCreateResepForm(element.closest('.form-resep'));
    }


    var ItemKV = {};
    var idItem;
    $('.obatLoading').hide();

    var typingTimer2;                
    var doneTypingInterval2 = 2000;  

    function searchResep(search_url,suggestions,suggest)
    {   
        $.ajax({
            url: search_url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                data = response.data
                for (i = 0; i < data.length; i++) {
                    var suggestword = data[i].item_detail.nama+" ("+data[i].item_detail.satuan+")";
                    ItemKV[suggestword] = data[i];
                    suggestions.push(suggestword);
                    var suggestword = {};
                }
                suggest(suggestions);
                $('.obatLoading').hide();
            },
            error: function() {
            },
        });
       
    }

    var temp_obat_id;
    var temp_obat_tipe;
    var temp_obat_harga;

    $('.resep-autocomplete').autoComplete({
        minChars: 3,
        delay:1000,
        source: function(term, suggest){
            term = term.toLowerCase();
            var search_url = API_URL+"/farmasi/{{session('farmasi')->slug}}/item/get?keyword="+term
            var suggestions    = [];
            $('.obatLoading').show();
            clearTimeout(typingTimer2);
            typingTimer2 = setTimeout(searchResep(search_url,suggestions,suggest), doneTypingInterval2);
        },
        onSelect: function(event, term,item) {
            item_selected = ItemKV[term];
            temp_obat_id = item_selected.id
            temp_obat_tipe = item_selected.item_detail.satuan
            temp_obat_harga = item_selected.item_detail.harga
        }
    });

    $('.obat-nama-generik').change(function (){
        $(this).closest('.form-resep').find('.obat-id-generik').val(temp_obat_id)
        $(this).closest('.form-resep').find('.obat-tipe-generik').val(temp_obat_tipe)
        $(this).closest('.form-resep').find('.obat-harga-generik').val(temp_obat_harga)
    })
    $('.obat-barang-racikan').change(function (){
        idItem = $(this).attr('id').slice(-1);
        $(this).closest('.racikan-wrapper').find(".obat-harga-racikan").val(temp_obat_harga);
        $(this).closest('.racikan-wrapper').find(".obat-id-racikan").val(temp_obat_id);
    })

    $(".obat-jumlah").on('input', function() {
        if (harian) {changeDukungan($(this));}
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    $(".obat-jumlah-hari-7").on('input', function() {
        changeDukungan($(this));
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    $(".obat-jumlah-hari-23").on('input', function() {
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    $(".obat-jumlah-dukungan-rs").on('input', function() {
        changeDukungan($(this));
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    $(".obat-nama-generik").on('input', function() {
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    $(".obat-nama-racikan").on('input', function() {
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    $(".obat-aturan").change(function() {
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    $(".obat-tipe-racikan").change(function() {
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    $(".obat-satuan-penggunaan").change(function() {
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    $(".obat-barang-racikan").on('input', function() {
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    $(".obat-jumlah-racikan").on('input', function() {
        validateCreateResepForm($(this).closest('.form-resep'));
    });

    function validateCreateResepForm(element)
    {
        var check_empty = 0;
        var jenis_resep = 'generik';

        if (element.find("input[name='kategori']:checked").val() == 'generik') jenis_resep = 'generik';
        else jenis_resep = 'racikan';

        //jika jenis resep generik maka mengecek input nama obat di generik
        if(jenis_resep == 'generik')
            if(element.find(".obat-nama-generik").val() == '') check_empty = 1;

        //jika jenis resep racikan maka mengecek input nama obat di generik
        if(jenis_resep == 'racikan')
        {
            if(element.find(".obat-nama-racikan").val() == '') check_empty = 1;
            if(element.find(".obat-tipe-racikan").val() == null) check_empty = 1;
            if(element.find(".obat-barang-racikan").val() == '') check_empty = 1;
            if(element.find(".obat-jumlah-racikan").val() == '') check_empty = 1;
        }

        //jika harian mengecek jumlah harian
        if (harian) {
            if(element.find(".obat-jumlah-hari-7").val() == '') check_empty = 1;
            if(element.find(".obat-jumlah-hari-23").val() == '') check_empty = 1;
            if(element.find(".obat-jumlah-dukungan-rs").val() == '') check_empty = 1;
        }

        if(element.find(".obat-jumlah").val() == '') check_empty = 1;
        if(element.find(".obat-aturan").val() == '') check_empty = 1;
        if(element.find(".obat-satuan-penggunaan").val() == '') check_empty = 1;

        if(check_empty == 0) 
            element.find('.button-tambah-obat').prop('disabled',false);
        else
            element.find('.button-tambah-obat').prop('disabled',true);
    }

    $('.btn-add-racikan').on('click', function() {
        addRacikan($(this));
    });

    racikan_id_count = 1;
    function addRacikan(element) {
        racikan_id_count++;
        var formRacikan = 
        `<div class="row racikan-wrapper mt-5">
            <input type="hidden" class="form-control obat-harga-racikan" id="harga-racikan-`+racikan_id_count+`">
            <input type="hidden" class="form-control obat-id-racikan" id="id-racikan-`+racikan_id_count+`">
            <div class="col-md-7">
                <input type="text" class="resep-autocomplete form-control form-control-lg obat-barang-racikan" id="barang-racikan-`+racikan_id_count+`" name="obat-barang-racikan[]" placeholder="" value="">
            </div>
            <div class="col-md-3 px-1">
                <input type="number" class="form-control obat-jumlah-racikan" id="jumlah-racikan-`+racikan_id_count+`" placeholder="Jumlah">
            </div>
            <div class="col-md-2">
                <button type="button" class="button-control btn btn-danger btn-circle btnRemoveRacikan">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </div>
        </div>`
        element.closest('.form-resep').find('.racikan-row').append(formRacikan);

        // INITIALIZE NECESSARY COMPONENTs
        removeRacikan();
        $('.resep-autocomplete').autoComplete({
            minChars: 3,
            delay:1000,
            source: function(term, suggest){
                term = term.toLowerCase();
                var search_url = API_URL+"/farmasi/{{session('farmasi')->slug}}/item/get?keyword="+term
                var suggestions    = [];
                $('.obatLoading').show();
                clearTimeout(typingTimer2);
                typingTimer2 = setTimeout(searchResep(search_url,suggestions,suggest), doneTypingInterval2);
            },
            onSelect: function(event, term,item) {
                item_selected = ItemKV[term];
                temp_obat_id = item_selected.id
                temp_obat_tipe = item_selected.item_detail.satuan
                temp_obat_harga = item_selected.item_detail.harga
            }
        });
        $('.obat-barang-racikan').change(function (){
            idItem = $(this).attr('id').slice(-1);
            $(this).closest('.racikan-wrapper').find(".obat-harga-racikan").val(temp_obat_harga);
            $(this).closest('.racikan-wrapper').find(".obat-id-racikan").val(temp_obat_id);
        })
        $(".obat-barang-racikan").on('input', function() {
            validateCreateResepForm($(this).closest('.form-resep'));
        });
        $(".obat-jumlah-racikan").on('input', function() {
            validateCreateResepForm($(this).closest('.form-resep'));
        });
        validateCreateResepForm(element.closest('.form-resep'));
        
    }

    function removeRacikan() {
        $('.btnRemoveRacikan').on('click', function() {
            var remove_racikan = $(this).parents('.racikan-wrapper');
            remove_racikan.remove();
            validateCreateResepForm($(this).closest('.form-resep'));
        })
    }

    $(".button-tambah-obat").click( function() {
        addToResepList($(this).closest('.form-resep'));
    });

    function addToResepList(element)
    {
        recordCount++;
        var type = element.find(".obat-tipe-generik").val();
        if (type=='') type = element.find(".obat-tipe-racikan").val();
        var obat = element.find(".obat-nama-generik").val();
        var obat_id = element.find(".obat-id-generik").val();
        var racikan = element.find(".obat-nama-racikan").val();
        var jumlah = element.find(".obat-jumlah").val();
        var aturan = element.find(".obat-aturan").val();
        var kategori = element.find("input[name='kategori']:checked").val();
        var satuan = element.find(".obat-satuan-penggunaan").val();
        var namaObatTemp = '';

        //cek resep harian
        if (harian) {
            var hari7 = element.find(".obat-jumlah-hari-7").val();
            var hari23 = element.find(".obat-jumlah-hari-23").val();
            var dukRS = element.find(".obat-jumlah-dukungan-rs").val();
        }

        //cek kategori resep
        if(kategori == 'racikan'){
            var obat_string = racikan;
            var arrInputNamaObat = [];
            var arrInputJumlahObat = [];
            var arrInputHargaObat = [];
            var arrInputIdObat = [];
            var harga = 0;
            var listRacikan = element.find(".obat-barang-racikan");

            listRacikan.each(function () {
                // add nama obat racikan
                namaObatTemp = $(this).val();
                namaObatTemp = namaObatTemp.replace("'","");
                namaObatTemp = namaObatTemp.replace('"','');
                arrInputNamaObat.push(namaObatTemp);

                // add jumlah, harga, & id obat racikan
                idItem = $(this).attr('id').slice(-1);
                arrInputJumlahObat.push($(this).closest('.racikan-wrapper').find(".obat-jumlah-racikan").val());
                arrInputHargaObat.push($(this).closest('.racikan-wrapper').find(".obat-harga-racikan").val());
                arrInputIdObat.push($(this).closest('.racikan-wrapper').find(".obat-id-racikan").val());
                harga += $(this).closest('.racikan-wrapper').find(".obat-jumlah-racikan").val() * $(this).closest('.racikan-wrapper').find(".obat-harga-racikan").val();
            });
        }
        else{
            namaObatTemp = obat.replace("'","");
            namaObatTemp = namaObatTemp.replace('"','');
            var obat_string = namaObatTemp;
            var harga = element.find(".obat-harga-generik").val();
        }

        // generate content
        content = '<div class="col-12 resep-item-container" id="resepCreateItemContainer'+recordCount+'">'
        content += '<div class="border p-15">'
        content += '<button type="button" class="float-right btn btn-sm btn-circle btn-alt-danger mr-5 mb-5 button-delete-item">'
        content += '<i class="fa fa-times"></i>'
        content += '</button>'
        content += '<button type="button" class="float-right btn btn-sm btn-circle btn-alt-info mr-5 mb-5 button-edit-item">'
        content += '<i class="fa fa-pencil"></i>'
        content += '</button>'
        content += '<span class="font-w400 text-muted" id="display-kategori-tipe-obat">'+type+'</span>'
        content += '<p class="font-w600 mb-5" id="display-nama-obat" style="white-space: pre;">'+obat_string+'</p>'
        if (kategori == 'racikan') {
            for (var i = 0; i < arrInputNamaObat.length; i++) {
                idItem = i+1;
                content += '<span class="font-w400 text-muted" id="display-racikan-obat-'+idItem+'">'+arrInputNamaObat[i]+' - '+arrInputJumlahObat[i]+'</span><br>';
            }
        }
        content += '<span class="font-w400" id="display-jumlah-aturan-obat">Jumlah : '+jumlah;
        if (harian) {
            content += ' (7 Hari : '+hari7+', 23 Hari : '+hari23+', Duk RS : '+dukRS+')'
        }
        content += '</span><br><span style="white-space:pre">Aturan : '+aturan+' '+satuan+'</span><br>'
        content += '<span class="font-w600 mt-5" id="display-harga-obat">Harga : '+ parseFloat(harga*jumlah).toLocaleString('id-ID', {currency: 'IDR', style: 'currency'}) +'</span>'

        // generate hidden input
        var input = {};
        input.kategori = kategori;
        input.type = type;
        input.jumlah = jumlah;
        input.aturan = aturan;
        input.satuan = satuan;
        if (kategori == 'racikan') {
            input.racikan = racikan;
            input.idObat = arrInputIdObat;
            input.namaObat = arrInputNamaObat;
            input.jumlahObat = arrInputJumlahObat;
            input.hargaObat = arrInputHargaObat;
        } else {
            input.idObat = obat_id;
            input.namaObat = obat_string;
            input.hargaObat = harga;
        }
        if (harian) {
            input.jumlahHari7 = hari7;
            input.jumlahHari23 = hari23;
            input.jumlahDukRS = dukRS; 
        }
        content += `<input type="hidden" name="input[]" class="resep-input" value='`+ JSON.stringify(input) +`'>`
        content += '</div>'
        content += '</div>'

        //empty form
        element.find('.daftar-obat').append(content);
        element.find(".obat-nama-generik").val('');
        element.find(".obat-jumlah").val('');
        element.find(".obat-aturan").val('').trigger('change');
        element.find(".obat-satuan-penggunaan").val('').trigger('change');
        element.find(".obat-nama-racikan").val('');
        element.find(".obat-tipe-generik").val('');
        element.find(".obat-id-generik").val('');
        if (kategori == 'racikan') {
            $(".obat-tipe-racikan").val('').trigger('change');
            $(".obat-barang-racikan").val('');
            $(".obat-jumlah-racikan").val('');
            $(".obat-harga-racikan").val('');
            $(".obat-id-racikan").val('');
            $(".btnRemoveRacikan").each(function () {
                var remove_racikan = $(this).parents('.racikan-wrapper');
                remove_racikan.remove();
            });
        }
        if (harian) {
            element.find(".obat-jumlah-hari-7").val('');
            element.find(".obat-jumlah-hari-23").val('');
            element.find(".obat-jumlah-dukungan-rs").val('');
        }
        element.find('.button-tambah-obat').prop('disabled',true);
        element.parent().find('.submit-resep').prop('disabled',false);
        racikan_id_count = 1;

        $(".button-delete-item").click(function (){
            var count_list_resep = $(this).parents('.daftar-obat').children('.resep-item-container').length;
            count_list_resep = count_list_resep - 1;
            if (count_list_resep<1) {
                $(this).closest('.main-form-container').find('.submit-resep').prop('disabled',true);   
            }
            $(this).parents('.resep-item-container').remove();
        })

        $(".button-edit-item").click( function() {
            var input = JSON.parse($(this).siblings('.resep-input').val());
            var element = $(this).closest('.form-resep');
            fillFormTambahObat(element,input);

            var count_list_resep = $(this).parents('.daftar-obat').children('.resep-item-container').length;
            count_list_resep = count_list_resep - 1;
            if (count_list_resep<1) {
                $(this).closest('.main-form-container').find('.submit-resep').prop('disabled',true);   
            }
            $(this).parents('.resep-item-container').remove();

        });
    }

    function changeDukungan(element) {
        jumlah = element.closest('.form-resep').find('.obat-jumlah').val();
        hari7 = element.closest('.form-resep').find('.obat-jumlah-hari-7').val();
        dukungan = element.closest('.form-resep').find('.obat-jumlah-dukungan-rs').val();
        element.closest('.form-resep').find('.obat-jumlah-hari-23').val(jumlah-hari7-dukungan);
    }

    function fillFormTambahObat(element_form_resep,input_resep)
    {
        if(input_resep.kategori == 'generik')
        {
            var element_radio = element_form_resep.find('.kategori-radio-generik')
            element_form_resep.find('.kategori-radio-generik').prop("checked", true).click();
            element_form_resep.find('.obat-nama-generik').val(input_resep.namaObat)
            element_form_resep.find('.obat-tipe-generik').val(input_resep.type)
            element_form_resep.find('.obat-id-generik').val(input_resep.idObat)
            element_form_resep.find('.obat-harga-generik').val(input_resep.hargaObat)

            toggleRacikanGenerik(element_radio,'generik',0)
        }
        else
        {
            var element_radio = element_form_resep.find('.kategori-radio-racikan')
            element_form_resep.find('.kategori-radio-racikan').prop("checked", true).click();
            element_form_resep.find('.obat-tipe-racikan').val(input_resep.type).trigger('change');
            element_form_resep.find('.obat-nama-racikan').val(input_resep.racikan)
            toggleRacikanGenerik(element_radio,'racikan')

            // empty racikan field
            $(".obat-barang-racikan").val('');
            $(".obat-jumlah-racikan").val('');
            $(".obat-harga-racikan").val('');
            $(".obat-id-racikan").val('');
            $(".btnRemoveRacikan").each(function () {
                var remove_racikan = $(this).parents('.racikan-wrapper');
                remove_racikan.remove();
            });
            racikan_id_count = 1;

            for (var i = 0; i < input_resep.namaObat.length; i++) {
                if (i > 0) {
                    addRacikan(element_form_resep.find('.btn-add-racikan'));
                }
                idItem = racikan_id_count;
                element_form_resep.find(".obat-barang-racikan:last").val(input_resep.namaObat[i]);
                element_form_resep.find(".obat-jumlah-racikan:last").val(input_resep.jumlahObat[i]);
                element_form_resep.find(".obat-harga-racikan:last").val(input_resep.hargaObat[i]);
                element_form_resep.find(".obat-id-racikan:last").val(input_resep.idObat[i]);
            }
        }

        element_form_resep.find(".obat-jumlah").val(input_resep.jumlah);
        if (harian) {
            element_form_resep.find(".obat-jumlah-hari-7").val(input_resep.jumlahHari7);
            element_form_resep.find(".obat-jumlah-hari-23").val(input_resep.jumlahHari23);
            element_form_resep.find(".obat-jumlah-dukungan-rs").val(input_resep.jumlahDukRS);
        }
        element_form_resep.find(".obat-aturan").val(input_resep.aturan).trigger('change');
        element_form_resep.find(".obat-satuan-penggunaan").val(input_resep.satuan).trigger('change');
        element_form_resep.find('.button-tambah-obat').prop('disabled',false);

    }

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
</script>