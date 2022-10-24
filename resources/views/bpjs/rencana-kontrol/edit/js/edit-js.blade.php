<script type="text/javascript">
    var input_type = 1;
    var jenis_kontrol = '{{$jenis}}';

    $(document).ready(function(){
        function resetInputan() {
            $('#tglRencanaKontrol').val('');
            $('#noSep').val('');
            $('#pasienSelect').empty();
            $('#kasusPasien').empty();
            $('#poliSelect').empty();
            $('#dokterSelect').empty();
            $('#spri').prop('checked', false);
            $('#kontrol').prop('checked', true);
        }

    
        $('#dokterSelect').select2({
            ajax: {
                url: API_URL+'/bpjs/rencana-kontrol/data-dokter',
                data: function(params){
                    return {
                        jenis_kontrol: jenis_kontrol,   
                        poli: $('#poliSelect').val(), 
                        tgl: $('#tglRencanaKontrol').val()
                    };
                },
                processResults: function (data, params) {
                    let res = JSON.parse(data);
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
    
        $('#poliSelect').select2({
            ajax: {
                url: API_URL+'/bpjs/referensi/poli',
                data: function(params){
                    return {
                        poli: params.term, 
                    };
                },
                processResults: function (data, params) {
                    var  res = JSON.parse(data);
                    var results = [];
                    if(res.metaData.code == 200){
                        results = res.response.poli;
                    }
                    return {
                        results: $.map(results, function(obj) {
                            return { id: obj.kode, text: obj.nama };
                        })
                    };
                },
                cache: true
            }
        });
    
        $('#submit').click(function(e) {
            e.preventDefault();
            const valid = $('#formRencanaKontrol').valid()
            if (valid) {
                let formData = new FormData();
                formData.append('no_sk', $('#noSk').val());
                formData.append('no_sep', $('#noSep').val());
                formData.append('jenis_kontrol', jenis_kontrol);
                formData.append('kode_dokter', $('#dokterSelect').val());
                formData.append('poli_kontrol', $('#poliSelect').val());
                formData.append('nama_poli', $('#poliSelect').select2('data')[0].text);
                formData.append('tgl_rencana_kontrol', $('#tglRencanaKontrol').val());
                formData.append('user', '{{$user}}');

                $.ajax({
                    type: 'POST',
                    data: formData,
                    url: API_URL+'/bpjs/rencana-kontrol/update',
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
                        let result = response.result;
                        if (result.metaData.code == 200) {
                            swal('success', 'Rencana kontrol berhasil diubah', 'success')
                            .then(() => {
                                window.location = BASE_URL+`bpjs/rencana-kontrol/`+jenis_kontrol;
                            })
                        } else {
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
    });
    </script>