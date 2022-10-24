<script type="text/javascript">
    var flag = 0;
    $(document).ready(function(){
        $(this).scrollTop(0);
    });
    
    $('#selectPekerjaan').select2({
       escapeMarkup: function (markup) {
           return markup;
       },
       tags: true
   });
    function pembayaranCheck(){
        if(flag == 0)
        {
            flag++;
        }
        else
        {
            if($('#asuransiNomor').val() != ''){
            $('#pembayaranLoading').show();
            var perusahaanAsuransi;
            var nomorAsuransi;

            nomorAsuransi = $('#asuransiNomor').val();
            perusahaanAsuransi = $("#perusahaan-select-"+valJenisPasien).val();
            var formCheck = new FormData();
            formCheck.append('perusahaan', perusahaanAsuransi);
            formCheck.append('no_asuransi', nomorAsuransi);

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
                                        'href="{{url("pasien")}}/'+id_array[i].id+'"><i class="fa fa-search"></i></a>'+
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
        
    }

    function nomorCheck(){
        $('#identitasLoading').show();
        noIdentitas = $("#noIdentitas").val();
        jenisKartuIdentitas = $("#selectKartuIdentitas").val();
        var formCheck = new FormData();
        formCheck.append('no_identitas', noIdentitas);
        formCheck.append('jenis_kartu', jenisKartuIdentitas);

        $("#error-no-identitas").remove();
        $('#textCekNomorIdentitas').text('Sedang mencari data pasien dengan NIK sama');
        $.ajax({
                type: "POST",
                url: API_URL + "/pasien/check/nomor",
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formCheck,
                success: function (response) {
                    if(response=='[]'){
                        
                        $("#infoSameID").empty();
                        $("#error-no-identitas").remove();

                        $("#noIdentitas").removeClass("is-invalid");
                        $("#noIdentitas").parentsUntil(".justify-content-center").removeClass("is-invalid");
                        $("#noIdentitas").addClass("is-valid");
                        $('#textCekNomorIdentitas').text('');
                        $('#identitasLoading').fadeOut();
                    }
                    else {
                        var id_array = JSON.parse(response);
                        $("#noIdentitas").removeClass("is-valid");
                        $("#noIdentitas").addClass("is-invalid");
                        $("#error-no-identitas").remove();
                        $("#noIdentitas").parent().append('<div class="invalid-feedback" id="error-no-identitas">Nomor identitas ini sudah digunakan <a data-toggle="modal" data-target="#pasien_id_sama" class="link-effect text-info"><i class="fa fa-search ml-5"></i></a></td></div>');

                        $("#infoSameID").empty();
                        for (var i = 0; i < id_array.length; i++) {
                            var gender;
                            if(id_array[i].gender == 1){
                                gender = 'Laki-laki';
                            }else{
                                gender = 'Perempuan';
                            }
                            if(i>0){
                               $("#infoSameID").append('<hr>');
                            }
                            $("#infoSameID").append(
                            '<div class="row my-20">'+
                                '<div class="col-3 pr-0 pl-20">'+
                                    '<img src="{{asset('')}}/'+id_array[i].photo_thumb+''+'" class="img-avatar-lg" >'+
                                '</div>'+
                                '<div class="col pl-0" style="padding-top: 0px;">'+
                                    '<h4 class="title mb-0">'+id_array[i].name+'</h4>'+
                                    '<h6 class="font-w400 mb-0">'+
                                        gender+
                                        ', '+id_array[i].age+' tahun'+
                                    '</h6>'+
                                    '<h6 class="font-w400 mb-0">'+
                                        'No Rekam Medis : #'+id_array[i].no_rm_formatted+
                                    '</h6>'+
                                    '<h6 class="font-w400 mb-0">'+
                                        'Kartu Identitas : '+id_array[i].jenis_kartu_identitas+', '+id_array[i].no_identitas+
                                    '</h6>'+
                                '</div>'+
                                '<div class="col-1 pr-0 pl-20">'+
                                    '<a target="_blank" class="link-effect text-info" '+
                                    'href="{{url("pasien")}}/'+id_array[i].id+'"><i class="fa fa-search ml-5"></i></a>'+
                                '</div>'+
                            '</div>'
                            );
                        }
                        $('#identitasLoading').fadeOut();
                        $('#textCekNomorIdentitas').text('');
                    }
                },
                error: function (response) {
                    console.log(response);  
                }
            });
    }

    function namaCheck(){
        $('#namaLoading').show();
        name = $("input[name='name']").val();
        var formCheck = new FormData();
        formCheck.append('nama', name);

        $.ajax({
                type: "POST",
                url: API_URL + "/pasien/check/nama",
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formCheck,
                success: function (response) {
                    if(response=='null'){
                        $("#namaPasien").removeClass("is-invalid");
                        $("#namaPasien").parentsUntil(".justify-content-center").removeClass("is-invalid");
                        $("#namaPasien").addClass("is-valid");
                        $('#namaLoading').fadeOut();
                    }
                    else {
                        $("#namaPasien").removeClass("is-valid");
                        $("#namaPasien").addClass("is-invalid");
                        $('#namaLoading').fadeOut();
                    }
                },
                error: function (response) {
                    console.log(response);  
                }
            });
    }

    function inputValidation(){
        var errCounter=0;
        $('#pasienSubmit input, #pasienSubmit .js-select2').each(function(n,element){
            if ($(element).is(':enabled')) {
                if(!$(element).hasClass('emptiable-dasar') && !$(element).hasClass('emptiable-kerabat')){
                    if ($(element).val()=='' || $(element).val()==null || $(element).val()=='null') {   
                        errCounter++;
                    }
                }
            }
        });
        if ($('#pasienSubmit input[name="avatar"]').val() == '') {
            errCounter--;
        }
        if ($('#pasienSubmit input[name="foto_identitas"]').val() == '') {
            errCounter--;
        }
        if ($('#pasienSubmit input[name="kategori_pasien"]:checked').length === 0) {
            errCounter++;
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
            $('#pasienSubmit .js-select2').each(function(n,element){
                if ($(element).is(':enabled') && !$(element).hasClass('emptiable-kerabat') && !$(element).hasClass('emptiable-dasar')) {
                    if ($(element).val()=='' || $(element).val()==null || $(element).val()=='null') {
                        $($(element).parentsUntil(".justify-content-center")).parent().addClass("is-invalid");
                    }
                    else {
                        $($(element).parentsUntil(".justify-content-center")).parent().removeClass("is-invalid");
                    }
                }
                else if($(element).is(':disabled')) {
                    $($(element).parentsUntil(".justify-content-center")).parent().removeClass("is-invalid");
                }
            });
            return 0;
        }
    }
</script>
<script type="text/javascript">
	function getKota()
    {
        $.ajax({
            type:'GET',
            url:API_URL + '/pasien/alamat/kota/get',
            dataType: 'json',
            success:function(data){
                var newOption = new Option('-', 0, false, false);       //DEFAULT KOSONG
                $("#kotaSelect2").append(newOption).trigger('change');
                data.forEach(function(item) {
                    var newOption = new Option(item.nama, item.id, false, false);
                    $("#kotaSelect2").append(newOption).trigger('change');
                });
                setKecamatan(0)
            },
            error:function(data){
                if(getKotaErrorCounter<3) getKota();
                else swalError()
                    getKotaErrorCounter++;
            }
        });
    }

function setKecamatan(id)
{
    $('#kecamatanLoading').show();
    $.ajax({
        type:'GET',
        url:API_URL + '/pasien/alamat/kecamatan/get/'+id,
        dataType: 'json',
        success:function(data){
            $('#kecamatanSelect2').html('').select2({data: [{id: '', text: ''}]});
            var newOption = new Option('-', 0, false, false);       //DEFAULT KOSONG
            $("#kecamatanSelect2").append(newOption).trigger('change');
            data.forEach(function(item) {
                var newOption = new Option(item.nama, item.id, false, false);
                $("#kecamatanSelect2").append(newOption).trigger('change');
            });
            $('#kecamatanLoading').fadeOut();
        },
        error:function(data){
            console.log(data);
        }
    });
}

function setKelurahan(id)
{
    $('#kelurahanLoading').show();
    $.ajax({
        type:'GET',
        url:API_URL + '/pasien/alamat/kelurahan/get/'+id,
        dataType: 'json',
        success:function(data){
            $('#kelurahanSelect2').html('').select2({data: [{id: '', text: ''}]});
            var newOption = new Option('-', 0, false, false);       //DEFAULT KOSONG
            $("#kelurahanSelect2").append(newOption).trigger('change');
            data.forEach(function(item) {
                var newOption = new Option(item.nama, item.id, false, false);
                $("#kelurahanSelect2").append(newOption).trigger('change');
            });
            $('#kelurahanLoading').fadeOut();
        },
        error:function(data){
            console.log(data);
        }
    });
}

    //**----------------------------------------------------------------------------------------FILTER KEANGGOTAAN

    function setPangkat(id)
    {
        $('#pangkatLoading').show();
        $.ajax({
            type:'GET',
            url:API_URL + '/pasien/pangkat/get/'+id,
            dataType: 'json',
            success:function(data){
                $('#selectPangkat').html('').select2({data: [{id: '', text: ''}]});
                data.forEach(function(item) {
                    var newOption = new Option(item.nama, item.id, false, false);
                    $("#selectPangkat").append(newOption).trigger('change');
                });
                $('#pangkatLoading').fadeOut();
            },
            error:function(data){
                console.log(data);
            }
        });
    }

    function setSatker(id)
    {
        $('#satkerLoading').show();
        $.ajax({
            type:'GET',
            url:API_URL + '/pasien/satker/get/'+id,
            dataType: 'json',
            success:function(data){
                $('#selectSatker').html('').select2({data: [{id: '', text: ''}]});
                data.forEach(function(item) {
                    var newOption = new Option(item.nama, item.id, false, false);
                    $("#selectSatker").append(newOption).trigger('change');
                });
                $('#satkerLoading').fadeOut();
            },
            error:function(data){
                console.log(data);
            }
        });
    }

    function setPangkatKerabat(id)
    {
        $('#pangkatLoadingKerabat').show();
        $.ajax({
            type:'GET',
            url:API_URL + '/pasien/pangkat/get/'+id,
            dataType: 'json',
            success:function(data){
                $('#selectPangkatKerabat').html('').select2({data: [{id: '', text: ''}]});
                data.forEach(function(item) {
                    var newOption = new Option(item.nama, item.id, false, false);
                    $("#selectPangkatKerabat").append(newOption).trigger('change');
                });
                $('#pangkatLoadingKerabat').fadeOut();
            },
            error:function(data){
                console.log(data);
            }
        });
    }

    function setSatkerKerabat(id)
    {
        $('#satkerLoadingKerabat').show();
        $.ajax({
            type:'GET',
            url:API_URL + '/pasien/satker/get/'+id,
            dataType: 'json',
            success:function(data){
                $('#selectSatker').html('').select2({data: [{id: '', text: ''}]});
                data.forEach(function(item) {
                    var newOption = new Option(item.nama, item.id, false, false);
                    $("#selectSatkerKerabat").append(newOption).trigger('change');
                });
                $('#satkerLoadingKerabat').fadeOut();
            },
            error:function(data){
                console.log(data);
            }
        });
    }

    //!!--------------

    function copyData()
    {
        nameKerabat = $("input[name='nameKerabat']").val();
        hubungan = $("#relativesType").val();
        $("#tniNamaKerabat").val(nameKerabat)
        $("#tniRelativesTypeKerabat").val(hubungan).change();
    }

    function changeJenis(val)
    {
        var temp_array = val.split("&&");
        var perusahaan_tipe_id = temp_array[0]
        var perusahaan_tipe_slug = temp_array[1]

        valJenisPasien = perusahaan_tipe_id;

        $('.perusahaan-select-container').hide();
        $('.perusahaan-select-'+perusahaan_tipe_id+'-container').show();
        $('.nomor-asuransi').show();
        
        if(perusahaan_tipe_slug == 'tunai')
        {
            $('.nomor-asuransi').hide();
            $("#asuransiNomor").val(" ");
        }
        else
        {
            $('.perusahaan-select-'+perusahaan_tipe_id+'-container').show();
        }
        pembayaranCheck();
    }

    function changeGender(val)
    {
        valGender = val;
    }
    function changeGenderKerabat(val)
    {
        valGenderKerabat = val;
    }

    function changeMarriage(val)
    {
        valMarriage = val;
    }

    /*AUTO INPUT*/

    var asuransiNomorTimeout = setTimeout(getNomorBPJSController, 30000000);
    var noIdentitasTimeout = setTimeout(getNIKController, 30000000);
    var pasienAutoInputDataTemp;

    $( "#asuransiNomor" ).keyup(function() {
        clearTimeout(asuransiNomorTimeout)
        if(valJenisPasien == 1)
            asuransiNomorTimeout = setTimeout(getNomorBPJSController, 1000)
    });


    $( "#noIdentitas" ).keyup(function() {
        clearTimeout(noIdentitasTimeout)
        var valJenisKartuIdentitas = $('#selectKartuIdentitas').val()
        if(valJenisKartuIdentitas == 1)
            noIdentitasTimeout = setTimeout(getNIKController, 1000)
    });

    function textAutoInputBPJS() {
        $('#textAutoInputBPJS').fadeOut(500);
        $('#textAutoInputBPJS').fadeIn(500);
    }
    setInterval(textAutoInputBPJS, 1000);

    function textAutoInputNIK() {
        $('#textAutoInputNIK').fadeOut(500);
        $('#textAutoInputNIK').fadeIn(500);
    }
    setInterval(textAutoInputNIK, 1000);

    function textCekNomorAsuransi() {
        $('#textCekNomorAsuransi').fadeOut(500);
        $('#textCekNomorAsuransi').fadeIn(500);
    }
    setInterval(textCekNomorAsuransi, 1000);

    function textCekNomorIdentitas() {
        $('#textCekNomorIdentitas').fadeOut(500);
        $('#textCekNomorIdentitas').fadeIn(500);
    }
    setInterval(textCekNomorIdentitas, 1000);

    function getNomorBPJSController()
    {
        pembayaranCheck();
        $('#notifExistAutoInputBPJS').hide();
        var nomor_bpjs = $('#asuransiNomor').val();
        if(nomor_bpjs == '') return
        var tanggal_today = moment(new Date());
        $('#textAutoInputBPJS').text('Sedang mencari data pasien BPJS');
        $.ajax({
            type:'GET',
            url:API_URL + '/bpjs/peserta/get/kartu/'+nomor_bpjs+'/'+tanggal_today.format('DD-MM-YYYY'),
            dataType: 'json',
            tryCount : 0,
            retryLimit : 3,
            success:function(data){
                if(data.metaData.code == 200)
                {
                    $('#notifExistAutoInputBPJS').show();
                    assignDisplayAutoInput(data.response.peserta)
                }
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

    function getNIKController()
    {
        nomorCheck()
        $('#notifExistAutoInputNIK').hide();
        var nik = $('#noIdentitas').val();
        var tanggal_today = moment(new Date());
        $('#textAutoInputNIK').text('Sedang mencari data NIK');
        $.ajax({
            type:'GET',
            url:API_URL + '/bpjs/peserta/get/nik/'+nik+'/'+tanggal_today.format('DD-MM-YYYY'),
            dataType: 'json',
            tryCount : 0,
            retryLimit : 3,
            success:function(data){
                if(data.metaData.code == 200)
                {
                    $('#notifExistAutoInputNIK').show();
                    assignDisplayAutoInput(data.response.peserta)
                }
                $('#textAutoInputNIK').text('');
            },
            error:function(data){
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    
                    $.ajax(this);
                    return;
                }else{
                    $.notify({
                        title: '<strong>Sorry</strong>',
                        message: 'Terjadi kesalahan server, tidak dapat melakukan auto Input nomor NIK.'
                    },{
                        type: 'danger',
                        placement: {
                            from: "top",
                            align: "center"
                        },
                        delay: 3000
                    });
                    $('#textAutoInputNIK').text('');
                    $('#notifExistAutoInputNIK').hide();
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
            changeGender(1);
        }
        else
        {
            document.querySelector("#gender-1").checked = false;
            document.querySelector("#gender-2").checked = true;
            changeGender(2);
        }

        $('#notifExistAutoInputNIK').show();
        $('#notifExistAutoInputBPJS').show();
        $('.js-select2').trigger('change');
    }

</script>