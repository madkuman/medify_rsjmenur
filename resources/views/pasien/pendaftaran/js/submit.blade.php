<script type="text/javascript">
	
    function inputValidation(){
        var errCounter=0;
        $('#pasienSubmit input, #pasienSubmit select').not('.sep_input').each(function(n,element){
            if ($(element).val()=='') {
                errCounter++;
            }
        });

        if(valLayanan == 1){
            if($("#selectPoli").val() == null) {
                $("#error-wrapper-poliklinik").text("Poliklinik tidak boleh kosong")
                $("#error-wrapper-poliklinik").show();
                return 0;
            }
            if($("#selectKelasPoli").val() == null) {
                $("#error-wrapper-kelas").text("Kelas tidak boleh kosong")
                $("#error-wrapper-kelas").show();
                return 0;
            }
        }
        else if(valLayanan == 2)
        {
            if($("#selectKelasIGD").val() == null) {
                $("#error-wrapper-kelas").text("Kelas tidak boleh kosong")
                $("#error-wrapper-kelas").show();
                return 0;
            }
        }
        else if(valLayanan == 3)
        {
            if($("#selectKelasMedicalCheckup").val() == null) {
                $("#error-wrapper-kelas").text("Kelas tidak boleh kosong")
                $("#error-wrapper-kelas").show();
                return 0;
            }
        }

        if (errCounter==0) {
            return 1;
        } 
        else {
            $('#pasienSubmit input').each(function(n,element){
                if ($(element).val()=='') {
                    $(element).parentsUntil(".justify-content-center").addClass("is-invalid");
                }
                else {
                    $(element).parentsUntil(".justify-content-center").removeClass("is-invalid");
                }
            });
            return 0;
        }
    }

    $('#buttonSubmit').click(function() {
        var checkSwal = true;
        $('#buttonSubmit').hide();
        $('#error-wrapper').hide();
        $('#buttonLoading').show();
        if($('#cek-pesanan-duplicate').val() == 1 && valLayanan == 1){
            swal({
                title: 'Pasien Sudah terdaftar hari ini',
                type: 'warning',
                confirmButtonClass: 'btn btn-warning',
                cancelButtonClass: 'btn btn-primary',
                showCancelButton: true,
                confirmButtonText: 'Daftarkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if(result.value) {
                    submitForm();
                }
                else{ 
                    $('#buttonSubmit').show();
                    $('#buttonLoading').hide();
                    return;
                }
            });
        } else {
            submitForm();
        }
    });

    function getRetribusi()
    {
        var all_value = [];
        $('.retribusi-checkbox').each(function() {
            if($(this).prop('checked'))
                all_value.push($(this).val());
        });
        return all_value;
    }

    function submitForm() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        pasienID = $("#pasien_id").val();
        poli_id = $("#selectPoli").val();
        antrian_kelas = $("#selectKelasAntrian").val();
        ruangan_id = $("#selectIGD").val();
        bayar_id = $("#selectPembayaran").val();
        
        if(valLayanan == 1) kelas = $("#selectKelasPoli").val();
        else if(valLayanan == 2) kelas = $("#selectKelasIGD").val();
        else if(valLayanan == 3) kelas = $("#selectKelasMedicalCheckup").val();

        kasus_id = $("#selectKasus").val();
        nomor_sep = $("#noSEP").val();
        paket_urikkes = $('#selectPaket').val();
        retribusi = getRetribusi()
        total_harga = $('#total_bayar').text();
        dokter_id = $('#selectDokterElement').val();


        asal_rujukan = $("#selectRujukan").val();
        rujuk_id = $('#selectRujukanID').val();

        var formData = new FormData();
        formData.append('pasien_id', pasienID);
        formData.append('ruangan_id', ruangan_id);
        formData.append('poliklinik_id', poli_id);
        formData.append('kasus_id', kasus_id);
        formData.append('kelas', kelas);
        formData.append('bayar_id', bayar_id);
        formData.append('nomor_sep', nomor_sep);
        formData.append('retribusi', retribusi);
        formData.append('asal_rujukan', asal_rujukan);
        formData.append('rujuk_id', rujuk_id);
        formData.append('layanan', valLayanan);
        formData.append('paket_urikkes', paket_urikkes);
        formData.append('is_bpjs', is_bpjs);
        formData.append('antrian_kelas', antrian_kelas);
        formData.append('total_bayar', total_harga);
        formData.append('dokter_id', dokter_id);
        formData.append('sirs_pelayanan_khusus_id', $('#sirs_pelayanan_khusus_id').val());
        formData.append('asal_rujukan', $('select[name="asal_rujukan"]').val())

        if (mesin_antrian_data != null) {
            formData.append('mesin_antrian_id', mesin_antrian_id);
            formData.append('mesin_antrian_konfirmasi', 1);
        }

        if(is_bpjs == 1){
            var sep_bpjs = false;
            
            if($('#custom_sep_check').is(':checked')){
                var sep = $('#sep_custom').val();
                if((!sep || sep == 'null' || sep == 'undefined') &&
                        @if(config("app.bpjs_enable", false)) true
                        @else false
                        @endif
                    ){

                    $('#error-wrapper > span').text('Nomor SEP belum diisi');
                    $('#error-wrapper').show();
                    $('#buttonSubmit').show();
                    $('#buttonLoading').hide();
                    return;
                }
                formData.append("no_sep", sep);   
            }else{
                if($('#sep_select').val() == ""  &&
                    @if(config("app.bpjs_enable", false)) true
                    @else false
                    @endif
                    ){

                    $('#error-wrapper > span').text('SEP belum dipilih. Klik tombol "Terbitkan SEP Baru" untuk Melengkapi data.');
                    $('#error-wrapper').show();
                    $('#buttonSubmit').show();
                    $('#buttonLoading').hide();
                    return;
                }

                var sep = JSON.parse($('#sep_select').val());
                if(sep && sep !== 'null' && sep !== 'undefined'){
                    sep_bpjs = true;
                }
                formData.append("no_sep", sep.no_sep);
            }
        }

        var validate = inputValidation();
        if (validate==0) {
            callSwal('error','Transaksi Gagal','Terdapat Masukan yang Kosong',0);
            $('#buttonSubmit').show();
            $('#buttonLoading').hide();
        }
        else {
            $.ajax({
                type: "POST",
                url: API_URL + "/pasien/pendaftaran/baru",
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function (response) {
                    var resp = jQuery.parseJSON(response);
                    if(resp.type == "error" && resp.is_bpjs){
                        $('#error-wrapper > span').text(resp.long_text);
                        $('#error-wrapper').show();
                        callSwal(resp.type,resp.title,resp.text, resp.url);
                    }else{
                        if(valLayanan == 1)
                            url_redir = 'rawatjalan/transaksi/pendaftaran/'+resp.transaksi_id;
                        else if(valLayanan == 2)
                            url_redir = 'igd/transaksi/pendaftaran/'+resp.transaksi_id;
                        else
                            url_redir = 'pasien';
                        
                        callSwal(resp.type,resp.title,resp.text, url_redir);
                    }
                    $('#buttonSubmit').show();
                    $('#buttonLoading').hide();
                },
                error: function () {
                    callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                    $('#buttonSubmit').show();
                    $('#buttonLoading').hide();
                }
            });
        }
    }
</script>