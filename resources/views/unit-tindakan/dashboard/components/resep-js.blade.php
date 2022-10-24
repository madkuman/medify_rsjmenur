
<script type="text/javascript">
    /*RESEP*/
    URL = '{{url('')}}'

    var pharmacyId =  $('#nama-apotek').val();
    var pharmacySlug = $('#nama-apotek').find(':selected').data('slug');
    var recordCount = 0;
    var warningCount = 0;

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
        }
        validateCreateResepForm(element.closest('.form-resep'));
    }

    $('#nama-apotek').on('change', function(e) {

        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;

        pharmacyId = valueSelected;
        pharmacySlug = $(this).find(':selected').data('slug')
    });


    var ItemKV = {};
    var idItem;
    var stok = {}
    $('.obatLoading').hide();

    var typingTimer2;                
    var doneTypingInterval2 = 2000;  

    function searchResep(search_url,suggestions,suggest, term)
    {   
        $.ajax({
                url: search_url,
                type: 'GET',
                data: {
                    keyword : term
                },
                dataType: 'json',
                success: function(response) {
                    data = response.data
                    console.log(response);
                    for (i = 0; i < data.length; i++) {

                        var stok = 0;
                        if(data[i].stok)
                            stok = data[i].stok.aggregate;
                        var suggestword = data[i].item_detail.nama+" ( Stok: "+ stok +" "+data[i].item_detail.satuan+") | Rp."+data[i].item_detail.harga;
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

    var temp_obat_id_generik;
    var temp_obat_tipe_generik;

     $('.resep-autocomplete').autoComplete({
        minChars: 3,
        source: function(term, suggest){
            term = term.toLowerCase();
            var search_url = API_URL+"/farmasi/"+pharmacySlug+"/item/get"
            var suggestions    = [];
            $('.obatLoading').show();
            clearTimeout(typingTimer2); 
            typingTimer2 = setTimeout(searchResep(search_url,suggestions,suggest, term), doneTypingInterval2);
        },
        onSelect: function(event, term,item) {
            clearTimeout(typingTimer2); 
            item_selected = ItemKV[term].item_detail;
            stok[item_selected.id] = ItemKV[term].stok;
            $('.obat-nama-generik').val(item_selected.nama);
            temp_obat_id_generik = item_selected.id
            temp_obat_tipe_generik = item_selected.satuan
        }
    });

    $('.obat-nama-generik').change(function (){
        $(this).closest('.form-resep').find('.obat-id-generik').val(temp_obat_id_generik)
        $(this).closest('.form-resep').find('.obat-tipe-generik').val(temp_obat_tipe_generik)
    })




    $(".obat-jumlah").on('input', function() {
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    $(".obat-nama-generik").on('input', function() {
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    $(".obat-nama-racikan").on('input', function() {
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    // $(".obat-aturan").on('change', function() {
    //     validateCreateResepForm($(this).closest('.form-resep'));
    // });
    $(".obat-aturan").on('input', function() {
        validateCreateResepForm($(this).closest('.form-resep'));
    });
    $(".obat-tipe-racikan").change(function() {
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
            if(element.find(".obat-nama-generik").val() == '') check_empty = 1;

        //jika jenis resep racikan maka mengecek input nama obat di generik
        if(jenis_resep == 'racikan')
        {
            if(element.find(".obat-nama-racikan").val() == '') check_empty = 1;
            if(element.find(".obat-tipe-racikan").val() == null) check_empty = 1;

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
        var obat = element.find(".obat-nama-generik").val();
        var obat_id = element.find(".obat-id-generik").val();
        var racikan = element.find(".obat-nama-racikan").val();
        var jumlah = element.find(".obat-jumlah").val();
        var aturan = element.find(".obat-aturan").val();
        var kategori = element.find("input[name='kategori']:checked").val();

        if(kategori == 'racikan'){
            var obat_string = racikan;
        }
        else{
            var obat_string = obat;
        }
        if(jumlah > stok[obat_id]){
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
        content += '<p class="font-w600 mb-5" id="display-nama-obat" style="white-space: pre;">'+obat_string+'</p>'
        content += '<span class="font-w400" id="display-jumlah-aturan-obat">Jumlah : '+jumlah+' - Aturan : ' + aturan + '</span>'
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
        content += '<input type="hidden" class="input-id-obat" name="id-obat[]" value="'+obat_id+'">'
        content += '<input type="hidden" class="input-warning-obat" name="warning-obat[]" value="'+usage_warning+'">'
        content += '</div>'
        content += '</div>'

        //empty form
        element.find('.daftar-obat').append(content);
        element.find(".obat-nama-generik").val('');
        element.find(".obat-jumlah").val('');
        element.find(".obat-aturan").val('').trigger('change');
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
            var element = $(this).closest('.form-resep')
            fillFormTambahObat(element,kategori,tipe,nama,jumlah,racikan,aturan,id)


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
        var pasien_id = element.find(".resep-pasien").val();
        var kategori = element.find("input[name='kategori']:checked").val();

        if (kategori != 'racikan') {
            $.ajax({
                url: API_URL+"/farmasi/resep/check-penggunaan?obat_id="+obat_id+"&pasien_id="+pasien_id+"",
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



    function fillFormTambahObat(element_form_resep,kategori,tipe,nama,jumlah,racikan,aturan,id)
    {
        if(kategori == 'generik')
        {
            var element_radio = element_form_resep.find('.kategori-radio-generik')
            element_form_resep.find('.kategori-radio-generik').prop("checked", true).click();
            element_form_resep.find('.obat-nama-generik').val(nama)
            element_form_resep.find('.obat-tipe-generik').val(tipe)
            element_form_resep.find('.obat-id-generik').val(id)

            toggleRacikanGenerik(element_radio,'generik',0)
        }
        else
        {
            var element_radio = element_form_resep.find('.kategori-radio-racikan')
            element_form_resep.find('.kategori-radio-racikan').prop("checked", true).click();
            element_form_resep.find('.obat-tipe-racikan').val(tipe).trigger('change');
            element_form_resep.find('.obat-nama-racikan').val(racikan)
            toggleRacikanGenerik(element_radio,'racikan')
        }

        element_form_resep.find('.obat-jumlah').val(jumlah)
        // element_form_resep.find('.obat-aturan').val(aturan).trigger('change');
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


    getArrayAturan()
    function initAturanAutocomplete(array_aturan){
        console.log('init-aturan-done')
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

</script>