<script type="text/javascript">
//FORMAT DISPLAY
$('#select_dokter').select2({
    tags: true
});

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

function ajaxKasus(pasien_id){
    $.ajax({
     url: API_URL + '/pasien/'+pasien_id+'/kasus',
     dataType: 'json',
     success: function(data){
        $('#kasus_dropdown').html('').select2('data', null);
        if(!data.length){
            changeForm();
            return;
        }

        var kasus_current = $('#kasus_dropdown').val();
        var option = [];
        data.sort((a, b) => parseInt(b.id) - parseInt(a.id));
        for (i in data) {
         if(kasus_current != data[i].id)
         {
           option.push({
             id: data[i].id,
             text: data[i].lokasi +' - '+data[i].judul_kasus,
             kelas: data[i].kelas_id,
             active_sep: data[i].active_sep
         });
       }
   }
   $('#kelasInput').val(option[0].kelas);
   if(option[0].active_sep != '')
        $('#no_sep').val(option[0].active_sep);
   $('#kasus_dropdown').html('').select2({
        data: option
    });
   $('#kasus_dropdown').trigger({
        type: 'select2:select',
    });
}
});
}
function ajaxPembayaran(data){
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
                    nomor: data[i].no_asuransi,
                    kelas: data[i].kelas_id
                });
            }
            $('#pasien-pembayaran').select2({
                data: option
            });
            //filtered data to take kelasUtama
            data = data.filter(function(i){
                return i.utama == 1;
            });
            // if(data.length){
            //     document.querySelector('#kelasLayanan [value="'+data[0].kelas_id+'"]').selected = true;
            //     $("#kelasInput").val(data[0].kelas_id);
            // }
        }
    });
}
$('#pasien').on('select2:select', function (e) {
    var data = e.params.data;
    var pasien_id = $(this).val();
    $('#no_bpjs').val("");
    $("#no_sep").val(""); 
    ajaxKasus(pasien_id);
    ajaxPembayaran(data);
});

$('#pasien-pembayaran').select2();

$(document).on('select2:select', '#pasien-pembayaran', function(e) {
    let tipe = pembayaranForm.select2('data')[0].tipe;
    let nomor = pembayaranForm.select2('data')[0].nomor;
    if($('#tanpa-kasus')[0].checked){
        let kelas = pembayaranForm.select2('data')[0].kelas;
        $('#kelasInput').val(kelas);
    }


    if(tipe == "1")
        $('#no_bpjs').val(nomor);
    else
        $('#no_bpjs').val("");
});




$(document).ready(function(){
    Codebase.helpers(['select2']);
    $('#date-format').bootstrapMaterialDatePicker({ format : 'dddd DD MMMM YYYY - HH:mm' });
});

function validate(){
    var check = true;
    $(".teksWarning").hide();

    if(!$("#pasien").val()){
        check = false;
        pasienWarning.html("Pilih Pasien terlebih dahulu");
    }
    if(tipeForm.val() == 0){
        check = false;
        tipeWarning.html("Pilih Tipe Layanan terlebih dahulu");
    }

    if($('input[name="layanan[]"]:checked').length == 0){
    // console.log("ha");

    check = false;
    swal('Gagal!', 'Pilih minimal satu layanan yang akan dipesan', 'error');
}
if(!$('#tanpa-kasus')[0].checked && kasusForm.val() == null){
    check = false;
    swal('Gagal!', 'Pilih Kasus terlebih dahulu', 'error');
}
if($('input[name=kirim_kasir]:checked').val() == undefined){
    check = false;
    swal('Gagal!', 'Pilih Tujuan pembayaran', 'error');
}

if(!pembayaranForm.val()){
    check = false;
    pembayaranWarning.html("Pilih Jenis Pembayaran terlebih dahulu");
} else {
    if($('#tanpa-kasus')[0].checked){
        if(pembayaranForm.select2('data')[0].kelas == null){
            check = false;
            swal('Gagal!', 'Jenis Pembayaran tidak memiliki kelas', 'error');
        }
    }
}

    // disableClick(submitBtn);
    // $('#submitBuatPermintaanBtn').prepend(`<i class="fa fa-spinner fa-spin"></i>`);
    $('#submitBuatPermintaanBtn').off('click');

    if(!check){
        enableClick(submitBtn);
        $(".teksWarning").show();
        return false;
    }
    submitForm();
}

function submitForm() {
    $("#permintaanForm").submit();
}
$(document).on('select2:select', '#kasus_dropdown', function(e) {
    var kelas = kasusForm.select2('data')[0].kelas;
    if(kasusForm.select2('data')[0].active_sep != '')
        var sep = kasusForm.select2('data')[0].active_sep;
    $("#no_sep").val(sep);
    $("#kelasInput").val(kelas);
    changeForm();
});

$(document).on('change', '#tanpa-kasus', function(){
    if(this.checked){
        $('#rs-dokter').show();
        $('#asal-kasus').hide();
        $('#tujuan-bayar').hide();
        $('input[name=kirim_kasir][value=1]').prop('checked', true);
        $('#kelasInput').val($('#kelasDefault').val());
        changeForm();
        $("#no_sep").val('');
    } else{
        $('#rs-dokter').hide();
        $('#asal-kasus').show();
        $('#tujuan-bayar').show();
        $('#kelasInput').val("");
        changeForm();
    }
});
</script>