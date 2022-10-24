<script type="text/javascript">
var input_type = 1;
var jenis_kontrol = '{{$jenis}}';
$('.input-type').click(function(){
    resetInputan();

    input_type = $('.input-type:checked');

    if(input_type.val() == 1) {
        $('.pilih-form-pasien').removeClass('d-none');
        $('.form-no-sep').removeClass('d-none');
        $('#noSep').attr('readonly', true);
    } else if (input_type.val() == 2) {
        $('.pilih-form-pasien').addClass('d-none');
        $('.form-no-sep').removeClass('d-none');
        $('#noSep').attr('readonly', false);
        _temp_kartu = null;
        _temp_sep = null;
    }
});

$('#pasienSelect').select2({
    ajax: {
        url: function (params) {
            return API_URL+'/pasien/get-bpjs/'+params.term;
        },
        dataType: 'json',
        beforeSend(){
            $('#pasienLoading').show();
        },
        processResults: function (data, params) {
            $('#pasienLoading').hide();
            return {
                results: $.map(data, function(obj) {
                    return { id: JSON.stringify((obj)), text: obj.name, pasien_id : obj.id };
                })
            };
        },
        cache: true
    }
});

$('#dokterSelect').select2({
    ajax: {
        url: function(params) {
            return API_URL+'/bpjs/rencana-kontrol/data-dokter';
        },
        data: function(params){
            return {
                jenis_kontrol: jenis_kontrol,   
                poli: $('#poliSelect').val(), 
                tgl: $('#tglRencanaKontrol').val()
            };
        },
        processResults: function (data, params) {
            let res = JSON.parse(data);
            console.log(res)
            let results = [];
            if(res.metaData.code == 200){
                results = res.response.list;
            }
            return {
                results: $.map(results, function(obj) {
                    return { id: obj.kodeDokter, text: obj.namaDokter };
                })
            };
        },
        cache: true
    },
    "language": {
        "noResults": function(){
            if ($('#poliSelect').val() == "") {
                return "Pilih poli terlebih dahulu";
            }
        }
    },
    escapeMarkup: function (markup) {
        return markup;
    }
});

// $('#poliSelect').select2({
//     ajax: {
        // url: API_URL+'/bpjs/referensi/poli',
//         data: function(params){
//             return {
//                 poli: params.term, 
//             };
//         },
//         processResults: function (data, params) {
//             var  res = JSON.parse(data);
//             var results = [];
//             if(res.metaData.code == 200){
//                 results = res.response.poli;
//             }
//             return {
//                 results: $.map(results, function(obj) {
//                     return { id: obj.kode, text: obj.nama };
//                 })
//             };
//         },
//         cache: true
//     }
// });

$('#pasienSelect').change(function(e) { 
    let pasien_val = JSON.parse($(this).val());
    let kasus = pasien_val.kasus;
    let option_kasus = '<option value="" disabled selected>Pilih kasus</option>';
    $('#noSep').val('');

    if (kasus.length > 0) {
        $.each(kasus, function(i, item) {
            option_kasus += `<option value="${item.sep.no_sep}" data-kasus_id="${item.id}" data-kartu="${item.sep?.no_bpjs || ''}">${item.judul_kasus} (${item.nomor_kasus})</option>`
        });   
    } else {
        option_kasus = `<option value="" disabled selected>Pasien tidak memiliki kasus bpjs</option>`;
    }

    $('#kasusPasien').html(option_kasus);
});

var _temp_sep = null, _temp_kartu = null;
$('#kasusPasien').change(function(e) {
    let sep = $(this).val();
    _temp_sep = sep;
    _temp_kartu = $('#kasusPasien :selected').data('kartu') || null;
    if(jenis_kontrol == 1){
        sep = _temp_kartu;
    }
    $('#noSep').val(sep);
    getPoli();

});

$('#submit').click(function(e) {
    e.preventDefault();
    const valid = $('#formRencanaKontrol').valid()
    if (valid) {
        let formData = new FormData();
        formData.append('no_sep', $('#noSep').val());
        formData.append('pasien_id', $('[name="pasien"]').select2('data')[0]?.pasien_id || null);
        let kasus_id = $('#kasusPasien :selected').data('kasus_id') || null;
        formData.append('kasus_id', kasus_id);
        formData.append('kode_dokter', $('#dokterSelect').val());
        formData.append('poli_kontrol', $('#poliSelect').val());
        formData.append('nama_poli', $('#poliSelect').select2('data')[0].text);
        formData.append('tgl_rencana_kontrol', $('#tglRencanaKontrol').val());
        formData.append('jenis_kontrol', jenis_kontrol);
        formData.append('input_type', $('.input-type:checked').val());
        formData.append('user', '{{$user->name}}');
        formData.append('user_id', '{{$user->id}}');

        $.ajax({
            type: 'POST',
            data: formData,
            url: API_URL+'/bpjs/rencana-kontrol/create',
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function(){
                setActiveButton($('#submit'),false);
                $('#error-wrapper').hide();
            },
            success: function (response) {
                setActiveButton($('#submit'),true);
                console.log(response)
                let result = response.result;
                if (result.metaData.code == 200) {
                    swal('success', 'Rencana kontrol berhasil dibuat', 'success')
                    .then(() => {
                        window.location = BASE_URL+`bpjs/rencana-kontrol/`+jenis_kontrol;
                    })
                } else {
                    // console.log(result)
                    $('#error-wrapper > span').text(result.metaData.message);
                    $('#error-wrapper').show();
                    return;
                }
            },
            error: function (error) {
                console.log(error)
                setActiveButton($('#submit'),true);
                $('#error-wrapper > span').text('Error server, coba lagi atau hubungi admin');
                $('#error-wrapper').show();
                return;
            }
        });
    }

});

function getPoli(){
    if( $('#noSep').val() != '' &&  $('#tglRencanaKontrol').val() != ''){
        $('#error-select-poli').hide()
        $.ajax({
            type: "GET",
            url: API_URL+'/bpjs/surat-kontrol/get-poli',
            data: {
                jenis_kontrol :jenis_kontrol,
                no_sep : $('#noSep').val(),
                no_sk : $('#noSep').val(),
                tgl : $('#tglRencanaKontrol').val(),
            },
            contentType: false,
            success: function (resp) {
                $('#poliSelect').html('').select2({data: [{id: '', text: ''}]});
                var resp = JSON.parse(resp);
                if(resp.metaData.code != 200){
                    $('#error-select-poli').html(resp.metaData.message)
                    $('#error-select-poli').show()
                }else{
                    resp.response.list.forEach(function(item) {
                        var kapasitas = '  (kapasitas ' + item.jmlRencanaKontroldanRujukan + '/' + item.kapasitas + ')';
                        var newOption = new Option(item.namaPoli + kapasitas , item.kodePoli, false, false);
                        $("#poliSelect").append(newOption).trigger('change');
                    });
                    $('#poliSelect_loading').fadeOut();
                }
                },
                error:function(error){
                    $('#error-select-poli').html('Gagal Mencari poli')
                    $('#error-select-poli').show()
                    console.log(error);
                }
        });
    }
}
function resetInputan() {
    $('#tglRencanaKontrol').val('');
    $('#noSep').val('');
    $('#pasienSelect').empty();
    $('#kasusPasien').empty();
    $('#poliSelect').empty();
    $('#dokterSelect').empty();
}

$('#noSep').on('change', function(){
    getPoli();
});
$('#tglRencanaKontrol').on('change', function(){
    getPoli();
});


</script>