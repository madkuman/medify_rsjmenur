<script type="text/javascript">

    $(document).on('change', '.rajal-shift', function () {
        shift = $(this).val();
        $('#selectDokterPagi').hide();
        $('#selectDokterSore').hide();

        if (shift == 'pagi') {
            $('#selectDokterPagi').show();
            jadwal_id = $('#selectDokterPagi').find('select').children("option:selected").data('jadwal-id');
            $('#dokterJadwalPagi').val(jadwal_id);
        } else {
            $('#selectDokterSore').show();
            jadwal_id = $('#selectDokterSore').find('select').children("option:selected").data('jadwal-id');
            $('#dokterJadwalSore').val(jadwal_id);
        }
        console.log('jadwal', jadwal_id)
    })

    $('.selectDokterElement').on("select2:select", function(e) { 
        jadwal_id = $(this).children("option:selected").data('jadwal-id');
        $(this).siblings('input[name="dokter_jadwal_id"]').val(jadwal_id);
    });

    function changeDaftar(val)
    {
        valLayanan = val;
        if(val == 1)
        {
            $('.pilih-poli').show();
            $('.pilih-igd').hide();
            $('.pilih-urikkes').hide();
            $('.urikkes-hide').show();
            $(".urikkes-detail").empty();
            $("#paket_custom_content").hide();
            is_igd = 0;
            resetCheck();
        }
        else if(val == 2)
        {
            $('.pilih-poli').hide();
            $('.pilih-igd').show();
            $('.pilih-urikkes').hide();
            $('.urikkes-hide').show();
            $(".urikkes-detail").empty();
            $("#paket_custom_content").hide();
            is_igd = 1;
            resetCheck();
        }
        else if(val == 3)
        {
            $('.pilih-poli').hide();
            $('.pilih-igd').hide();
            $('.pilih-urikkes').show();
            $('.urikkes-hide').hide();
            if({{isset($pasien->is_anggota) ? $pasien->is_anggota : 0}} == 0){
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
            resetCheck();
            $('#selectPaket').trigger('select2:select');
        }

        removeRujukan();
    }

    function resetCheck()
    {
        $('#file_tni_bpjs').prop('checked', false);
        $('#karcis_poli').prop('checked', false);
        $('#karcis_igd').prop('checked', false);
        $('#is_kartu_baru').prop('checked', false);
        $('#is_karcis').prop('checked', false);
        clickPoli=0
        clickKartu=0;
        clickFile=0;
        clickIGD=0;
        clickKarcis=0;
        totalBayar=0;
        $("#total_bayar").html(`<span class="control-label font-w700" >`+totalBayar+`</span>`);
    }


    function loadingPoli()
    {
        $("#InfoPoli").html(`<div id="myLoading" class="col-12 text-center">
            <i class="fa fa-4x fa-asterisk fa-spin text-info mb-5"></i>
            </div>
            `);
        $(".selectDokterElement").prop('disabled', false);
        $(".selectDokterElement").html(`<option value="0" selected disabled>Pilih Dokter</option>`);
        $(".selectDokterLoading").show();
        $('#dokterJadwalPagi').val(0);
        $('#dokterJadwalSore').val(0);
    }

   

    function lihatRuangVideo(id, is_video = 0)
    {
        loadingPoli();
        $.ajax({
            type:'GET',
            url:API_URL + '/pasien/pendaftaran/poli/get/'+id+'/'+is_video,
            dataType: 'json',
            success:function(data){
                $("#InfoPoli").html(`<div class="col-lg-4 col-12">
                    <img class="full-only" src="{{asset("`+data.image_thumb+`")}}" alt="" height="100">
                    <div class="font-w600 h3">`+data.name+`</div>                            
                    </div>
                    `);
                var jadwal_pagi = data.dokter_jadwal.pagi;
                var jadwal_sore = data.dokter_jadwal.sore;

                if (jadwal_pagi.length == 0) {
                    $("#selectDokterElementPagi").prop('disabled', true);
                    $("#selectDokterElementPagi").html(`<option value="0" selected disabled>Dokter praktek belum tersedia hari ini</option>`)
                }
                if (jadwal_sore.length == 0) {
                    $("#selectDokterElementSore").prop('disabled', true);
                    $("#selectDokterElementSore").html(`<option value="0" selected disabled>Dokter praktek belum tersedia hari ini</option>`)
                }
                
                if (jadwal_pagi.length > 0 ){
                    $.each(jadwal_pagi, function(key,item) { 
                        if (key == 0) {
                            $('#dokterJadwalPagi').val(item.id);
                        }
                        $("#selectDokterElementPagi").append(`<option value="${item.dokter_id}" data-jadwal-id="${item.id}" ${key == 0 ? 'selected' : ''}>${item.employee_name ?? item.name} - ${item.jobs_count} Pasien</option>`)
                    });
                }
                if (jadwal_sore.length > 0 ){
                    $.each(jadwal_sore, function(key,item) { 
                        if (key == 0) {
                            $('#dokterJadwalSore').val(item.id);
                        }
                        $("#selectDokterElementSore").append(`<option value="${item.dokter_id}" data-jadwal-id="${item.id}" ${key == 0 ? 'selected' : ''}>${item.employee_name ?? item.name} - ${item.jobs_count} Pasien</option>`)
                    });
                }

                $(".selectDokterLoading").hide();
                if($.trim(data.transaksi))
                {
                    antrian_nomor_temp = data.transaksi[0].nomor_antrian;
                    antrian_nomor = antrian_nomor_temp.split('-');
                    $("#InfoPoli").append(`<div class="col-lg-4 col-12">
                        <div class="font-size-md text-center">Nomor Sekarang</div>
                        <div class="font-w700 mb-5 h1 text-center">`+(antrian_nomor[1] ?? antrian_nomor[0])+`</div>                            
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
                console.log(data);
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
                // console.log(data);
                if(data.status == 1)
                {
                    $('#error-wrapper-poliklinik').show();
                    $('#error-wrapper-poliklinik').text(data.text);
                    $('#cek-pesanan-duplicate').val(1);
                    $('#cek-pesanan-duplicate-text').val(data.text);
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