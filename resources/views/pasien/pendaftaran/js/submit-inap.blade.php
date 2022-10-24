<script type="text/javascript">
	
    function inputValidation(){
        var errCounter=0;
        $('#pasienSubmit input, #pasienSubmit select').not('.sep_input').each(function(n,element){
            if ($(element).val()=='') {
                errCounter++;
            }
        });
    

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

        

        $('#buttonSubmit').hide();
        $('#error-wrapper').hide();
        $('#buttonLoading').show();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        pasienID = $("#pasien_id").val();
        // poli_id = $("#selectPoli").val();
        // ruangan_id = $("#selectIGD").val();
        bayar_id = $("#selectPembayaran").val();
        // kelas = $("#selectKelasPoli").val();
        // kasus_id = $("#selectKasus").val();
        nomor_sep = $("#noSEP").val();
        // paket_urikkes = $('#selectPaket').val();
        // pasien_baru = clickPasienBaru;
        // kartubaru = clickKartu;
        // poli = clickPoli;
        // total = totalBayar;
        // asal_rujukan = $("#selectRujukan").val();
        // rujuk_id = $('#selectRujukanID').val();

        var formData = new FormData();
        formData.append('pasien_id', pasienID);
        // formData.append('ruangan_id', ruangan_id);
        // formData.append('poliklinik_id', poli_id);
        // formData.append('kasus_id', kasus_id);
        // formData.append('kelas', kelas);
        formData.append('bayar_id', bayar_id);
        formData.append('nomor_sep', nomor_sep);
        // formData.append('is_pasien_baru', pasien_baru);
        // formData.append('is_kartu', kartubaru);
        // formData.append('is_kartu_poli', poli);
        // formData.append('total_retribusi', total);
        // formData.append('asal_rujukan', asal_rujukan);
        // formData.append('rujuk_id', rujuk_id);
        // formData.append('layanan', valLayanan);
        // formData.append('paket_urikkes', paket_urikkes);
        formData.append('is_bpjs', is_bpjs);

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
                url: API_URL + "/pasien/pendaftaran/inap-baru",
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
    });

</script>