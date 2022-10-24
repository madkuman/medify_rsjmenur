<script type="text/javascript">

    $('#buttonSubmit').click(function() {

        $('#buttonSubmit').hide();
        $('#buttonLoading').show();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        pasien = $("#pasien_id").val();
        bayar_id = $("#bayar_id").val();
        utama = $("#utama").val();
        jenisPasien = valJenisPasien;
        perusahaan_pembayaran_id = $("#perusahaan-select-"+jenisPasien).val();
        nomor_asuransi = $("#asuransiNomor").val();
        kelas_rawat = $("#selectKelas").val();

        var formData = new FormData();
        formData.append('pasien_id', pasien);
        formData.append('bayar_id', bayar_id);
        formData.append('utama', utama);
        formData.append('jenis_pasien', jenisPasien);
        formData.append('perusahaan_pembayaran_id', perusahaan_pembayaran_id);
        formData.append('nomor_asuransi', nomor_asuransi);
        formData.append('kelas', kelas_rawat);
        
        console.log(formData);
        $.ajax({
            type: "POST",
            url: API_URL + "/pasien/pembayaran/edit",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {

                callSwalString(response);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
            },
            error: function () {
                callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
            }
        });

        function callSwalString(string)
        {
            var response = jQuery.parseJSON(string);
            callSwal(response.type,response.title,response.text,response.url);
        }

    });
</script>