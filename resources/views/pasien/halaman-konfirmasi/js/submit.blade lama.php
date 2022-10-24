<script type="text/javascript">
    function inputValidation(){
        var errCounter=0;
        $('#pasienSubmit input, #pasienSubmit select').not('.sep_input').each(function(n,element){
            if ($(element).val()=='' && !$(element).hasClass('not-required')) {
                if (valLayanan != 2 && $(element).hasClass('select-igd')) {
                    return;
                }
                else {
                    if (valLayanan == 2) {
                        if ($(element).attr('id') == 'selectIGDTriage') {
                            if ($('#selectIGDRuang').val() == '')
                                errCounter++;
                            else
                                return;
                        }
                        else if($(element).attr('id') == 'selectIGDRuang') {
                            if ($('#selectIGDTriage').val() == '')
                                errCounter++;
                            else
                                return;
                        } 
                        else {
                            errCounter++;
                        }
                    } 
                    else {
                        errCounter++;
                    }
                }
                console.log(errCounter, $(element))
            }
        });

        if(valLayanan == 1){
            if($("#selectPoli").val() == null) {
                $("#error-wrapper-poliklinik").text("Poliklinik tidak boleh kosong")
                $("#error-wrapper-poliklinik").show();
                return 0;
            }
            
            rajal_shift = $('input[name=rajal_shift]:checked').val();
            if (rajal_shift == 'pagi') {
                console.log($("#selectDokterElementPagi").val())
                if($("#selectDokterElementPagi").val() == null) {
                    $("#error-wrapper-poliklinik").text("Dokter prakter tidak boleh kosong")
                    $("#error-wrapper-poliklinik").show();
                    return 0;
                }
            } else {
                if($("#selectDokterElementSore").val() == null) {
                    $("#error-wrapper-poliklinik").text("Dokter prakter tidak boleh kosong")
                    $("#error-wrapper-poliklinik").show();
                    return 0;
                }
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
            var title_text = $('#cek-pesanan-duplicate-text').val();
            swal({
                title: title_text,
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

    function submitForm() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        pasienID = $("#pasien_id").val();
        poli_id = $("#selectPoli").val();
        antrian = $('#selectKelasAntrian').val()
        if(antrian == "5"){
            is_video="1";
        }
        else{
            is_video="0";
        }
        antrian_kelas = $("#selectKelasAntrian").val();
        ruangan_id = $('input[name="opsi_igd"]:checked').val() == 1 ? $("#selectIGDTriage").val() : $("#selectIGDRuang").val();
        bayar_id = $("#selectPembayaran").val();
        kelas = $("#selectKelasPoli").val();
        kasus_id = $("#selectKasus").val();
        nomor_sep = $("#noSEP").val();
        paket_urikkes = $('#selectPaket').val();
        dokter_urikkes = $('#selectDokterUrikkes').val();
        pasien_baru = clickPasienBaru;
        kartubaru = clickKartu;
        poli = clickPoli;
        total = totalBayar;
        asal_rujukan = $("#selectRujukan").val();
        rujuk_id = $('#selectRujukanID').val();
        rajal_shift = $('input[name=rajal_shift]:checked').val();
        if (rajal_shift == 'pagi') {
            dokter_poli = $('#selectDokterElementPagi').val();
            dokter_jadwal_id = $('#dokterJadwalPagi').val();
        } else {
            dokter_poli = $('#selectDokterElementSore').val();
            dokter_jadwal_id = $('#dokterJadwalSore').val();
        }

        var formData = new FormData();
        formData.append('pasien_id', pasienID);
        formData.append('ruangan_id', ruangan_id);
        formData.append('poliklinik_id', poli_id);
        formData.append('is_video',is_video);
        formData.append('kasus_id', kasus_id);
        formData.append('kelas', kelas);
        formData.append('bayar_id', bayar_id);
        formData.append('nomor_sep', nomor_sep);
        formData.append('is_pasien_baru', pasien_baru);
        formData.append('is_kartu', kartubaru);
        formData.append('is_kartu_poli', poli);
        formData.append('total_retribusi', total);
        formData.append('asal_rujukan', asal_rujukan);
        formData.append('rujuk_id', rujuk_id);
        formData.append('layanan', valLayanan);
        formData.append('paket_urikkes', paket_urikkes);
        formData.append('dokter_urikkes', dokter_urikkes);
        formData.append('is_bpjs', is_bpjs);
        formData.append('antrian_kelas', antrian_kelas);
        formData.append('dokter_poli', dokter_poli);
        formData.append('dokter_jadwal_id', dokter_jadwal_id);

        // for urikkes online 
        console.log(online_id)
        if (online_id > 0) formData.append('online_id', online_id);

        if(valLayanan == 3){
            total_harga = $("#total_harga").val();
            var custom_tarif_id = [];
            custom_tarif_id = $('input[name="tarif_master_id[]"]').map(function(){return $(this).val();}).get();
            formData.append('tarif_master_id', custom_tarif_id);
            formData.append('total_harga', total_harga);            
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
                    console.log(sep);
                }
                formData.append("no_sep", sep.no_sep);
            }
        }

        
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
                    else if(valLayanan == 2 && is_bpjs)
                        url_redir = 'igd/transaksi/pendaftaran/'+resp.transaksi_id;
                    else
                        url_redir = 'pasien';

                    /*
                    if(resp.is_bpjs){
                        var print_sep_url = BASE_URL + "bpjs/sep/"+ sep.no_sep +"/print";
                        popupwindow(print_sep_url, "Print SEP Pasien", 600, 900);
                    }
                    
                    if(resp.transaksi_id != -1){
                        var print_karcis_url = BASE_URL + "rawatjalan/antrian/print/"+resp.transaksi_id;
                        popupwindow(print_karcis_url, "Print Nomor Antrian Pasien", 600, 500);
                    }*/
                    
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
</script>