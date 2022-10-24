<script type="text/javascript">

    function changeDaftar(val)
    {
        valLayanan = val;
        if(val == 1)
        {
            $('.pilih-poli').show();
            $('.pilih-igd').hide();
            $('.pilih-medical-checkup').hide();
            is_igd = 0;
            $('.pilih-dokter').show();
            $('.konsul-dokter').show();
            checkKelas();
        }
        else if(val == 2)
        {
            $('.pilih-poli').hide();
            $('.pilih-igd').show();
            $('.pilih-medical-checkup').hide();
            is_igd = 1;
            checkKelas();
            $('.pilih-dokter').hide();
            $('.konsul-dokter').hide();
        }
        else if(val == 3)
        {
            $('.pilih-poli').hide();
            $('.pilih-igd').hide();
            $('.pilih-medical-checkup').show();
            if({{isset($identitas->is_anggota) ? $identitas->is_anggota : 0}} == 0){
                $("#selectPembayaran option").each(function() {
                    if($(this).data('tunai') == 'yes'){
                        $('#selectPembayaran').val($(this).val());
                        $('#selectPembayaran').trigger('change');
                        lihatMetode($(this).val());
                    }
                });
            }
            setMetodeBayarTunai()
            is_igd = 0;
            checkKelas();

            $('.pilih-dokter').hide();
            $('.konsul-dokter').hide();
        }

        removeRujukan();
    }


    function loadingPoli()
    {
        $("#InfoPoli").html(`<div id="myLoading" class="col-12 text-center">
            <i class="fa fa-4x fa-asterisk fa-spin text-info mb-5"></i>
            </div>
            `);
        $("#selectDokterElement").prop('disabled', false);
        $("#selectDokterElement").html(`<option value="0" selected disabled>Pilih Dokter</option>`);
        $("#selectDokterLoading").show();
    }

   

    function lihatRuang(id)
    {
        loadingPoli();
        var this_url = API_URL + '/pasien/pendaftaran/poli/get/'+id;
        $.ajax({
            type:'GET',
            url:this_url,
            dataType: 'json',
            success:function(data){
                console.log(data);
                $("#InfoPoli").html(`<div class="col-lg-4 col-12">
                    <img class="full-only" src="{{asset("`+data.image_thumb+`")}}" alt="" height="100">
                    <div class="font-w600 h3">`+data.name+`</div>                            
                    </div>
                    `);
                    console.log(data)
                if (data.dokter.length == 0) {
                    $("#selectDokterElement").prop('disabled', true);
                    $("#selectDokterElement").html(`<option value="0" selected disabled>Dokter praktek belum tersedia hari ini</option>`)
                    $("#error-wrapper-poliklinik").text("Dokter prakter tidak boleh kosong")
                    $("#error-wrapper-poliklinik").show();
                } else {
                    $.each(data.dokter, function(key,item) { 
                        temp_jobs_count = item.jobs_today_count;
                        
                        if(item.id == dokter && id == mesin_antrian_poli_id){
                            console.log(item.id,dokter)
                            temp_jobs_count--
                            $("#selectDokterElement").append(`<option value="${item.id}" selected>${item.name} - ${temp_jobs_count} Pasien</option>`)
                        }
                        else{
                            $("#selectDokterElement").append(`<option value="${item.id}" ${key == 0 ? 'selected' : ''}>${item.name} - ${temp_jobs_count} Pasien</option>`)
                        }
                        //$("#selectDokterElement").append(`<option value="${item.id}" ${key == 0 ? 'selected' : ''}>${item.name} - ${temp_jobs_count} Pasien</option>`)
                        
                        
                    });
                }

                $("#selectDokterLoading").hide();
                if($.trim(data.transaksi))
                {
                    $("#InfoPoli").append(`<div class="col-lg-4 col-12">
                        <div class="font-size-md text-center">Nomor Sekarang</div>
                        <div class="font-w700 mb-5 h1 text-center">`+data.transaksi[0].nomor_antrian+`</div>                            
                        </div>
                        `);
                }
                else {
                    $("#InfoPoli").append(`<div class="col-lg-4 col-12">
                        <div class="font-size-md  text-center">Nomor Sekarang</div>
                        <div class="font-w700 mb-5 h1 text-center">0</div>                            
                        </div>
                        `);
                };
                if($.trim(data.antrian_tunggu))
                {
                    $("#InfoPoli").append(`<div class="col-lg-4 col-12">
                        <div class="font-size-md text-center">Total Antrian</div>
                        <div class="font-w700 mb-5 h1 text-center">`+data.total_antrian+`</div>                            
                        </div>
                        `);
                }
                else {
                    $("#InfoPoli").append(`<div class="col-lg-4 col-12">
                        <div class="font-size-md  text-center">Total Antrian</div>
                        <div class="font-w700 mb-5 h1 text-center">0</div>                            
                        </div>
                        `);
                }
            },
            error:function(data){
            }
        });
    }

    function cekHistoriPoli(id)
    {
        $('#error-wrapper-poliklinik').hide();
        $('#cek-pesanan-duplicate').val(0);
        $.ajax({
            type:'GET',
            url:API_URL + '/pasien/pendaftaran/poli/get-histori/'+id+'/'+pasien_id,
            dataType: 'json', 
            tryCount : 0,
            retryLimit : 3,
            success:function(data){
                if(data.status == 1)
                {
                    $('#error-wrapper-poliklinik').show();
                    $('#error-wrapper-poliklinik').text(data.text);
                    $('#cek-pesanan-duplicate').val(1);
                }
            },
            error : function(xhr, textStatus, errorThrown ) {
                if (textStatus == 'timeout') {
                    this.tryCount++;
                    if (this.tryCount <= this.retryLimit) {
                        $.ajax(this);
                        return;
                    }            
                    return;
                }
                if (xhr.status == 500) {
                    alert('Error - Tidak dapat mengecek apakah pasien pernah berkunjung ke poli pilihan')
                } else {
                    alert('Error - Tidak dapat mengecek apakah pasien pernah berkunjung ke poli pilihan')
                }
            }
        });
    }

</script>