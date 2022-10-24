<script type="text/javascript">
         /*AUTO INPUT*/

    var asuransiNomorTimeout = setTimeout(getNomorBPJSController, 30000000);
    var pasienAutoInputDataTemp;

    $( "#asuransiNomor" ).keyup(function() {
        clearTimeout(asuransiNomorTimeout)
        if(valJenisPasien == 1)
            asuransiNomorTimeout = setTimeout(getNomorBPJSController, 1000)

    });

    function textAutoInputBPJS() {
        $('#textAutoInputBPJS').fadeOut(500);
        $('#textAutoInputBPJS').fadeIn(500);
    }
    setInterval(textAutoInputBPJS, 1000);


    function textCekNomorAsuransi() {
        $('#textCekNomorAsuransi').fadeOut(500);
        $('#textCekNomorAsuransi').fadeIn(500);
    }
    setInterval(textCekNomorAsuransi, 1000);

    function getNomorBPJSController()
    {
        pembayaranCheck()
        $('#notifExistAutoInputBPJS').hide();
        var nomor_bpjs = $('#asuransiNomor').val();
        var tanggal_today = moment(new Date());
        $('#textAutoInputBPJS').text('Sedang mencari data pasien BPJS');
        $.ajax({
            type:'GET',
            url:API_URL + '/bpjs/peserta/get/kartu/'+nomor_bpjs+'/'+tanggal_today.format('DD-MM-YYYY'),
            dataType: 'json',
            tryCount : 0,
            retryLimit : 3,
            success:function(data){
                console.log(data.metaData.code)
                if(data.metaData.code == 200)
                {
                    $('#notifExistAutoInputBPJS').show();
                    assignDisplayAutoInput(data.response.peserta)
                }
                else $('#notifExistAutoInputBPJS').hide();
                $('#textAutoInputBPJS').text('');
            },
            error:function(data){
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    
                    $.ajax(this);
                    return;
                }else{
                    $.notify({
                        title: '<strong>Sorry</strong>',
                        message: 'Terjadi kesalahan server, tidak dapat melakukan auto Input nomor BPJS.'
                    },{
                        type: 'danger',
                        placement: {
                            from: "top",
                            align: "center"
                        },
                        delay: 3000
                    });
                    $('#textAutoInputBPJS').text('');
                    $('#notifExistAutoInputBPJS').hide();
                }  
            }
        });
    }

    function assignDisplayAutoInput(peserta)
    {
        var tanggal = moment(peserta.tglLahir,'YYYY-MM-DD');
        $('#display-autoinput-pasien-nama').text(peserta.nama)
        $('#display-autoinput-pasien-gender').text(peserta.sex)
        $('#display-autoinput-pasien-tgl-lahir').text(tanggal.format('DD MMMM YYYY'))
        $('#display-autoinput-pasien-nik').text(peserta.nik)
        $('#display-autoinput-pasien-bpjs').text(peserta.noKartu)
        $('#display-autoinput-pasien-kelas').text(peserta.hakKelas.keterangan)
        $('#display-autoinput-pasien-jenis-bpjs').text(peserta.jenisPeserta.keterangan)
        $('#display-autoinput-pasien-status-bpjs').text(peserta.statusPeserta.keterangan)
        pasienAutoInputDataTemp = peserta;
    }

    function fillAutoInputData()
    {
        var tanggal = moment(pasienAutoInputDataTemp.tglLahir,'YYYY-MM-DD');
        $('#namaPasien').val(pasienAutoInputDataTemp.nama)
        $('#noIdentitas').val(pasienAutoInputDataTemp.nik)
        $("#selectKartuIdentitas").val("1");
        $('#tanggal-lahir').combodate('setValue', tanggal.format('YYYY-MM-DD'))

        if(pasienAutoInputDataTemp.sex == 'L')
        {
            document.querySelector("#gender-1").checked = true;
            document.querySelector("#gender-2").checked = false;
        }
        else
        {
            document.querySelector("#gender-1").checked = false;
            document.querySelector("#gender-2").checked = true;
        }

        $('#notifExistAutoInputNIK').hide();
        $('#notifExistAutoInputBPJS').hide();
        $('.js-select2').trigger('change');
    }

    function pembayaranCheck(){
        if($('#asuransiNomor').val() != ''){
        $('#pembayaranLoading').show();
        var perusahaanAsuransi;
        var nomorAsuransi;

        nomorAsuransi = $('#asuransiNomor').val();
        if(valJenisPasien == 1){
            perusahaanAsuransi = $('#selectBPJS').val();
        }else if (valJenisPasien == 2) {
            perusahaanAsuransi = $('#selectPerusahaan').val();
        }else if (valJenisPasien == 3) {
            perusahaanAsuransi = $('#selectAsuransi').val();
        }
        var formCheck = new FormData();
        formCheck.append('perusahaan', perusahaanAsuransi);
        formCheck.append('no_asuransi', nomorAsuransi);
        formCheck.append('pasien_id', pasien_id);

        $('#textCekNomorAsuransi').text('Sedang mencari data pasien dengan nomor yang sama');
        $("#error-no-pembayaran").remove();

        $.ajax({
                type: "POST",
                url: API_URL + "/pasien/check/pembayaran",
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formCheck,
                success: function (response) {
                    if(response=='[]'){               
                        $("#infoSameID").empty();
                        $("#error-no-pembayaran").remove();

                        $("#asuransiNomor").removeClass("is-invalid");
                        $("#asuransiNomor").parentsUntil(".justify-content-center").removeClass("is-invalid");
                        $("#asuransiNomor").addClass("is-valid");
                        $('#pembayaranLoading').fadeOut();
                        $('#textCekNomorAsuransi').text('');
                    }
                    else {
                        var id_array = JSON.parse(response);
                        $("#asuransiNomor").removeClass("is-valid");
                        $("#asuransiNomor").addClass("is-invalid");
                        $("#error-no-pembayaran").remove();
                        $("#asuransiNomor").parent().append('<div class="invalid-feedback" id="error-no-pembayaran"> Nomor Asuransi Telah Digunakan Pasien Lain. <a data-toggle="modal" data-target="#pasien_pembayaran_sama" class="link-effect text-info"><i class="fa fa-search ml-5"></i></a></td></div>');

                        $("#infoSamePayment").empty();
                        for (var i = 0; i < id_array.length; i++) {
                            var gender;
                            if(id_array[i].data_pasien.gender == 1){
                                gender = 'Laki-laki';
                            }else{
                                gender = 'Perempuan';
                            }
                            if(i>0){
                               $("#infoSamePayment").append('<hr>');
                            }
                            $("#infoSamePayment").append(
                            '<div class="row my-20">'+
                                '<div class="col-3 pr-0 pl-20">'+
                                    '<img src="{{asset('')}}/'+id_array[i].data_pasien.photo_thumb+''+'" class="img-avatar-lg" >'+
                                '</div>'+
                                '<div class="col pl-0" style="padding-top: 0px;">'+
                                    '<h4 class="title mb-0">'+id_array[i].data_pasien.name+'</h4>'+
                                    '<h6 class="font-w400 mb-0">'+
                                        gender+
                                        ', '+id_array[i].data_pasien.age+' tahun'+
                                    '</h6>'+
                                    '<h6 class="font-w400 mb-0">'+
                                        'No Rekam Medis : #'+id_array[i].data_pasien.no_rm_formatted+
                                    '</h6>'+
                                    '<h6 class="font-w400 mb-0">'+
                                        'Pembayaran : '+id_array[i].perusahaan_tipe.nama+', '+id_array[i].no_asuransi+
                                    '</h6>'+
                                '</div>'+
                                '<div class="col-2 pr-0 pl-20">'+
                                    '<a target="_blank" class="btn btn-primary" '+
                                    'href="{{url("pasien")}}/'+id_array[i].data_pasien.id+'"><i class="fa fa-search"></i></a>'+
                                '</div>'+
                            '</div>'
                            );
                        }
                        $('#pembayaranLoading').fadeOut();
                        $('#textCekNomorAsuransi').text('');
                    }
                },
                error: function (response) {
                    console.log(response);  
                }
            });
        }
    }
    
    
</script>