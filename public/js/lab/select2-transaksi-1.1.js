//FORMAT DISPLAY
function formatPasien (item) {
    if (item.loading) {
        return item.text;
    }
    var markup = item.name
    return markup;
}
//FORMAT UNTUK DI SHOW DI HTML
function formatPasienSelection (item) {
    return item.name || item.text;
}

$("#pasien").select2({
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

$('#pasien').on('select2:select', function (e) {
    var data = e.params.data;
    var pasien_id = $(this).val();
    $.ajax({
       url: API_URL + '/pasien/'+pasien_id+'/kasus',
       dataType: 'json',
       success: function(data){
            if(!data.length){
                changeForm();
                return;
            }
            $('#kasus_dropdown').html('');

            var kasus_current = $('#kasus_dropdown').val();
            var option = [];
            data.sort((a, b) => parseInt(b.id) - parseInt(a.id));
            for (i in data) {
               if(kasus_current != data[i].id)
               {
                 option.push({
                   id: data[i].id,
                   text: data[i].lokasi +' - '+data[i].judul_kasus,
                   kelas: data[i].kelas_id
                 });
               }
            }
            $('#kasus_dropdown').html('').select2({
                data: option
            });
            $('#kasus_dropdown').trigger({
                type: 'select2:select',
            });
       }
    });
    $.ajax({
        type: "POST",
        url: API_URL + "/gizi/pemesanan/getPembayaranPasien",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id : data.id
        },
        success: function (data) {
            var option = [];
            option.push({
                id: '',
                text: '',
            });
            // alert(data[0].tipe.name);
            for (i in data) {
                option.push({
                    id: data[i].id,
                    text: data[i].perusahaan.nama,
                    tipe: data[i].perusahaan.type,
                    nomor: data[i].no_asuransi
                });
            }
            $('#pasien-pembayaran').select2({
                data: option
            });
            //filtered data to take kelasUtama
            data = data.filter(function(i){
                return i.utama == 1;
            });
            if(data.length){
                document.querySelector('#kelasLayanan [value="'+data[0].kelas_id+'"]').selected = true;
                $("#kelasInput").val(data[0].kelas_id);
            }
        }
    });
})

$('#pasien-pembayaran').select2();

$(document).on('select2:select', '#pasien-pembayaran', function(e) {
    let tipe = pembayaranForm.select2('data')[0].tipe;
    let nomor = pembayaranForm.select2('data')[0].nomor;
    if(tipe == "1")
        $('#sepNumber').val(nomor);
    else
        $('#sepNumber').val("");
});




$(document).ready(function(){
    Codebase.helpers(['select2']);
    $('#date-format').bootstrapMaterialDatePicker({ format : 'dddd DD MMMM YYYY - HH:mm' });
});

function validate(){
    var check = true;

    if(!$("#pasien").val()){
        check = false;
        pasienWarning.html("Pilih Pasien terlebih dahulu");
    }
    if(tipeForm.val() == 0){
        check = false;
        tipeWarning.html("Pilih Tipe Layanan terlebih dahulu");
    }
    if(kelasForm.val() == 0){
        check = false;
        kelasWarning.html("Pilih Kelas Layanan terlebih dahulu");
    }
    if($('input[name="layanan[]"]:checked').length == 0){
        check = false;
        $("#layananWarn").html("Pilih minimal Satu Layanan terlebih dahulu");
    }
    if(!pembayaranForm.val()){
        check = false;
        pembayaranWarning.html("Pilih Jenis Pembayaran terlebih dahulu");
    }
    if(!$('#tanpa-kasus')[0].checked && kasusForm.val() == ""){
        check = false;
        $('#kasusWarn').html("Pilih Kasus terlebih dahulu");
    }
    // if(check){
    //     if($("#modalConfirmation").length){
    //         $("#modalConfirmation").modal('show');
    //     }
    //     else{
    //         $("#permintaanForm").submit();
    //     }
    //     return true;
    // }
    $(".teksWarning").show();
}

function submitForm() {
    $("#permintaanForm").submit();
}
$(document).on('select2:select', '#kasus_dropdown', function(e) {
    let kelas = kasusForm.select2('data')[0].kelas;
    document.querySelector('#kelasLayanan [value="'+kelas+'"]').selected = true;
    $("#kelasInput").val(kelas);
    changeForm();
});

$(document).on('change', '#tanpa-kasus', function(){
    if(this.checked){
        $('#asal-kasus').hide();
        $('#tujuan-bayar').hide();
        $('input[name=kirim_kasir][value=1]').prop('checked', true);
    } else{
        $('#asal-kasus').show();
        $('#tujuan-bayar').show();
    }
});