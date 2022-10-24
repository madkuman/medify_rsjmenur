<script type="text/javascript">    
    function getNoRujukan(nomor_kartu) {
        $('#dialog_error').hide();
        $('#loading_select_rujukan').show();
        var formData = new FormData();
        formData.append('nomor_kartu', nomor_kartu);
        formData.append('multiple', true);
        $.ajax({
            type: "POST",
            data: formData,
            url: API_URL + "/bpjs/rujukan/get/kartu",
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#loading_select_rujukan').hide();
                var res = JSON.parse(response);
                if(res.metaData.code != 200){
                    $('#dialog_error > span').text(res.metaData.message);
                    $('#dialog_error').show();
                }
                $('#selectNoRujukan').empty();
                var option = [];
                option.push({
                    id : "",
                    text : ""});
                var rujukan = res.response.rujukan;
                for (var i = 0; i < rujukan.length; i++) {
                    var nilai = JSON.stringify(rujukan[i]);
                    option.push({
                        id : nilai,
                        text :  rujukan[i].noKunjungan
                    });
                }
                option.push({
                    id:'-1',
                    text:'Tidak ada Rujukan'
                });
                $('#selectNoRujukan').select2({
                    data : option
                })
            },
            error: function () {
                callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
            }
        });
    }

    function getPropinsi() {
        $.ajax({
            type: "GET",
            url: API_URL + "/bpjs/referensi/propinsi",
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                var res = JSON.parse(response).response.list;
                $('#provinsi_laka').empty();
                var option = [];
                option.push({
                    id:"",
                    "text":""
                });
                for (var i = 0; i < res.length ; i++) {
                    option.push({
                        id: res[i].kode,
                        text: res[i].nama
                    })
                }
                $('#provinsi_laka').select2({
                    data : option
                });
            },
            error: function(e) {
                getPropinsi();
            }
        });
    }


    function getKabupaten(prov) {
        $.ajax({
            type: "GET",
            url: API_URL + "/bpjs/referensi/kabupaten/"+prov,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                var res = JSON.parse(response).response.list;
                $('#kota_laka').empty();
                var option = [];
                option.push({
                    id:"",
                    "text":""
                });
                for (var i = 0; i < res.length ; i++) {
                    option.push({
                        id: res[i].kode,
                        text: res[i].nama
                    })
                }
                $('#kota_laka').select2({
                    data : option
                });
            },
            error: function(e) {
                getPropinsi();
            }
        });
    }

    function getKecamatan(kota) {
        $.ajax({
            type: "GET",
            url: API_URL + "/bpjs/referensi/kecamatan/"+kota,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                var res = JSON.parse(response).response.list;
                $('#kecamatan_laka').empty();
                var option = [];
                option.push({
                    id:"",
                    "text":""
                });
                for (var i = 0; i < res.length ; i++) {
                    option.push({
                        id: res[i].kode,
                        text: res[i].nama
                    })
                }
                $('#kecamatan_laka').select2({
                    data : option
                });
            },
            error: function(e) {
                getPropinsi();
            }
        });
    }
</script>