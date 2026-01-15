

var pharmacyId = 1;
var recordCount = 0;

$('input:radio[name=kategori]').change(function () {
    if ($("input[name='kategori']:checked").val() == 'generik') {
        $("#resep-racikan").hide();
        $("#resep-obat").show();
    }
    if ($("input[name='kategori']:checked").val() == 'racikan') {
        $("#resep-obat").hide();
        $("#resep-racikan").show();
    }
});

$("#modal-create-resep #nama-apotek").change(function () {
     alert($(this).find(':selected').data('city'));
});

$('#nama-apotek').on('change', function(e) {

    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;

    pharmacyId = valueSelected;

});


var ItemKV = {};
var idItem;
var inserted_id_obat=0;

jQuery('.resep-autocomplete').autoComplete({


    minChars: 3,
    source: function(term, suggest){
        term = term.toLowerCase();
        //var search_url = API_URL+"/kasus/datamedis/resep/search?keyword="+term+"&apotek_id="+pharmacyId
        var search_url = API_URL+"/api/farmasi/{farmasi}/item/get"

        $.ajax({
            url: search_url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                data = response.data
                console.log(data)
                for (i = 0; i < data.length; i++) {
                    ItemKV[data[i].name] = data[i];
                    suggestions.push(data[i].name);
                }
                suggest(suggestions);
            },
            error: function() {
                alert('error');
            },
        });

        var suggestions    = [];


    },
    onSelect: function(event, term, item) {
        item = ItemKV[term];
        inserted_id_obat = item.id;
    }
});

$("#button-tambah-obat").click( function() {

    recordCount++;
    var type = $('#tipe-obat').find(":selected").text();
    var obat = $("input[name='nama-obat']").val();
    var racikan = $("#racikanObat").val();
    var jumlah = $("input[name='jumlah']").val();
    var aturan = $("input[name='aturan']").val();
    var kategori = $("input[name='kategori']:checked").val()



    if(kategori == 'racikan'){
        var obat_string = racikan;
    }
    else{
        var obat_string = obat;
    }

    content = '<div class="col-12 resep-item-container" id="resepCreateItemContainer'+recordCount+'">'
    content += '<div class="border p-15">'
    content += '<button type="button" class="float-right btn btn-sm btn-circle btn-alt-danger mr-5 mb-5 button-delete-item">'
    content += '<i class="fa fa-times"></i>'
    content += '</button>'
    content += '<span class="font-w400 text-muted" id="display-kategori-tipe-obat">'+type+'</span>'
    content += '<p class="font-w600 mb-5" id="display-nama-obat" style="white-space: pre;">'+obat_string+'</p>'
    content += '<span class="font-w400" id="display-jumlah-aturan-obat">Jumlah : '+jumlah+' - Aturan : ' + aturan + '</span>'
    content += '<input type="hidden" name="kategori-obat[]" value="'+kategori+'">'
    content += '<input type="hidden" name="tipe-obat[]" value="'+type+'">'
    content += '<input type="hidden" name="jumlah-obat[]" value="'+jumlah+'">'
    content += '<input type="hidden" name="nama-obat[]" value="'+obat+'">'
    content += '<textarea name="racikan[]" rows="3" style="display:none">'+racikan+'</textarea>'
    content += '<input type="hidden" name="aturan-obat[]" value="'+aturan+'">'
    content += '<input type="hidden" name="id-obat[]" value="'+inserted_id_obat+'">'
    content += '</div>'
    content += '</div>'

    $('#daftar-obat').after(content);
    inserted_id_obat = 0;

    $("input[name='nama-obat']").val('');
    $("input[name='jumlah']").val('');
    $("input[name='aturan']").val('');
    $("input[name='racikan-obat']").val('');
    $("input[name='racikan-obat']").val('');


    $(".button-delete-item").click(function (){
        $(this).parents('.resep-item-container').fadeOut();
        $(this).parents('.resep-item-container').remove();
    })

});

var AutoCompleteObat = function() {

    var DiagnosisKV = {};

    // Init jQuery AutoComplete example, for more examples you can check out https://github.com/Pixabay/jQuery-autoComplete
    var initAutoComplete = function(){
        // Init autocomplete functionality

    };

    return {
        init: function () {
            // Init jQuery AutoComplete example
            initAutoComplete();
        }
    };
}();

var recordEditCount = 0;

function resepEdit(id)
{
    $('#editModalDaftarObat').empty();
    $("input[name='nama-obat']").val('');
    $("input[name='jumlah']").val('');
    $("input[name='aturan']").val('');
    $("input[name='racikan-obat']").val('');
    $("input[name='racikan-obat']").val('');

    $('#loading-top').fadeIn();
    $.ajax({
        url: API_URL + '/kasus/{{$kasus->nomor_kasus}}/datamedis/resep/'+ id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data);
            $('#resepEditId').val(data.id);

            details = data.resep_detail
            $.each(details, function(i) {

                recordEditCount++;

                var type = details[i].type
                var obat = details[i].obat_name
                var racikan = details[i].racikan
                var jumlah = details[i].jumlah
                var aturan = details[i].aturan
                var kategori = details[i].kategori
                var obat_id = details[i].obat_id


                if(kategori == 'racikan'){
                    var obat_string = racikan;
                }
                else{
                    var obat_string = obat;
                }

                content = generateEditItem(recordEditCount,type,obat,racikan,obat_string,jumlah,aturan,kategori,obat_id)

                $('#editModalDaftarObat').append(content);

            });

            $("input[name='nama-obat']").val('');
            $("input[name='jumlah']").val('');
            $("input[name='aturan']").val('');
            $("input[name='racikan-obat']").val('');
            $("input[name='racikan-obat']").val('');


            $(".button-delete-item").click(function (){
                $(this).parents('.resep-item-container').fadeOut();
                $(this).parents('.resep-item-container').remove();
            })


            $('#resepModalEdit').modal('show');
            $('#loading-top').hide();
        },
        error: function() {
            alert('error');
        },
    });
}



function resepPrint(id)
{
    window.open(URL+'/kasus/'+nomor_kasus+'/datamedis/resep/print/'+id, '_blank');
}

function resepDelete(id,index)
{
    $('#resepDeleteId').val(id)
    $('#resepModalDelete').modal('show');
}

function generateEditItem(index,type,obat,racikan,obat_string,jumlah,aturan,kategori,obat_id)
{
    content = '<div class="col-12 resep-item-container" id="resepCreateItemContainer'+index+'">'
    content += '<div class="border p-15">'
    content += '<button type="button" class="float-right btn btn-sm btn-circle btn-alt-danger mr-5 mb-5 button-delete-item">'
    content += '<i class="fa fa-times"></i>'
    content += '</button>'
    content += '<span class="font-w400 text-muted" id="display-kategori-tipe-obat">'+type+'</span>'
    content += '<p class="font-w600 mb-5" id="display-nama-obat" style="white-space: pre;">'+obat_string+'</p>'
    content += '<span class="font-w400" id="display-jumlah-aturan-obat">Jumlah : '+jumlah+' - Aturan : ' + aturan + '</span>'
    content += '<input type="hidden" name="kategori-obat[]" value="'+kategori+'">'
    content += '<input type="hidden" name="tipe-obat[]" value="'+type+'">'
    content += '<input type="hidden" name="jumlah-obat[]" value="'+jumlah+'">'
    content += '<input type="hidden" name="nama-obat[]" value="'+obat+'">'
    content += '<textarea name="racikan[]" rows="3" style="display:none">'+racikan+'</textarea>'
    content += '<input type="hidden" name="aturan-obat[]" value="'+aturan+'">'
    content += '<input type="hidden" name="id-obat[]" value="'+obat_id+'">'
    content += '</div>'
    content += '</div>'

    return content;
}


$('#resepModalEdit input:radio[name=kategori]').change(function () {
    if ($("#resepModalEdit input[name='kategori']:checked").val() == 'generik') {
        $("#resepModalEdit #editRacikanObat").hide();
        $("#resepModalEdit #editObat").show();
    }
    if ($("#resepModalEdit input[name='kategori']:checked").val() == 'racikan') {
        $("#resepModalEdit #editObat").hide();
        $("#resepModalEdit #editRacikanObat").show();
    }
});


$("#editResep-ButtonTambahObat").click( function() {



    recordEditCount++;
    var type = $('#resepModalEdit #tipe-obat').find(":selected").text();
    var obat = $("#resepModalEdit input[name='nama-obat']").val();
    var racikan = $("#resepModalEdit #racikanObat").val();
    var jumlah = $("#resepModalEdit input[name='jumlah']").val();
    var aturan = $("#resepModalEdit input[name='aturan']").val();
    var kategori = $("#resepModalEdit input[name='kategori']:checked").val()



    if(kategori == 'racikan'){
        var obat_string = racikan;
    }
    else{
        var obat_string = obat;
    }

    content = '<div class="col-12 resep-item-container" id="resepCreateItemContainer'+recordEditCount+'">'
    content += '<div class="border p-15">'
    content += '<button type="button" class="float-right btn btn-sm btn-circle btn-alt-danger mr-5 mb-5 button-delete-item">'
    content += '<i class="fa fa-times"></i>'
    content += '</button>'
    content += '<span class="font-w400 text-muted" id="display-kategori-tipe-obat">'+type+'</span>'
    content += '<p class="font-w600 mb-5" id="display-nama-obat" style="white-space: pre;">'+obat_string+'</p>'
    content += '<span class="font-w400" id="display-jumlah-aturan-obat">Jumlah : '+jumlah+' - Aturan : ' + aturan + '</span>'
    content += '<input type="hidden" name="kategori-obat[]" value="'+kategori+'">'
    content += '<input type="hidden" name="tipe-obat[]" value="'+type+'">'
    content += '<input type="hidden" name="jumlah-obat[]" value="'+jumlah+'">'
    content += '<input type="hidden" name="nama-obat[]" value="'+obat+'">'
    content += '<textarea name="racikan[]" rows="3" style="display:none">'+racikan+'</textarea>'
    content += '<input type="hidden" name="aturan-obat[]" value="'+aturan+'">'
    content += '<input type="hidden" name="id-obat[]" value="'+inserted_id_obat+'">'
    content += '</div>'
    content += '</div>'

    $('#editModalDaftarObat').append(content);
    inserted_id_obat = 0;

    $("#resepModalEdit input[name='nama-obat']").val('');
    $("#resepModalEdit input[name='jumlah']").val('');
    $("#resepModalEdit input[name='aturan']").val('');
    $("#resepModalEdit input[name='racikan-obat']").val('');
    $("#resepModalEdit #racikanObat").val('');


    $("#resepModalEdit .button-delete-item").click(function (){
        $(this).parents('.resep-item-container').fadeOut();
        $(this).parents('.resep-item-container').remove();
    })

});

