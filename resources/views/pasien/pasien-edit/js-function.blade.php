<script type="text/javascript">
    $('#selectPekerjaan').select2({
       escapeMarkup: function (markup) {
           return markup;
       },
       tags: true
   });
    function nomorCheck(){
        $('#identitasLoading').show();
        noIdentitas = $("#noIdentitas").val();
        jenisKartuIdentitas = $("#selectKartuIdentitas").val();
        var formCheck = new FormData();
        formCheck.append('no_identitas', noIdentitas);
        formCheck.append('jenis_kartu', jenisKartuIdentitas);

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
                    
                    var id_array = JSON.parse(response);
                    if(id_array.length ==0 || (id_array.length == 1 && id_array[0].id =={{$pasien['identitas']->id}})){
                        
                        $("#infoSameID").empty();
                        $("#error-no-identitas").remove();

                        $("#noIdentitas").removeClass("is-invalid");
                        $("#noIdentitas").parentsUntil(".justify-content-center").removeClass("is-invalid");
                        $("#noIdentitas").addClass("is-valid");
                        $('#identitasLoading').fadeOut();
                    }
                    else {
                        var id_array = JSON.parse(response);
                        $("#noIdentitas").removeClass("is-valid");
                        $("#noIdentitas").addClass("is-invalid");
                        $("#error-no-identitas").remove();
                        $("#noIdentitas").parent().append('<div class="invalid-feedback" id="error-no-identitas">Jenis / Nomor identitas ini sudah digunakan <a data-toggle="modal" data-target="#pasien_id_sama" class="link-effect text-info"><i class="fa fa-search ml-5"></i></a></td></div>');

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
                        //var obj = JSON.parse(response);
                        //console.log(obj.name);
                    }
                },
                error: function () {
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
                        //console.log("Kosong");
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
                error: function () {
                    console.log(response);  
                }
            });
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
                $('#kotaSelect2').val('{{$pasien["identitas"]->city}}').trigger('change');
                setKecamatan('{{$pasien["identitas"]->city}}')
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
                $('#kecamatanSelect2').val('{{$pasien["identitas"]->district}}').trigger('change');
                $('#kecamatanLoading').fadeOut();
                setKelurahan('{{$pasien["identitas"]->district}}')
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
                $('#kelurahanSelect2').val('{{$pasien["identitas"]->kelurahan}}').trigger('change');
                $('#kelurahanLoading').fadeOut();
            },
            error:function(data){
                console.log(data);
            }
        });
    }

    ///////--------------------------------------------------------------FILTER KEANGGOTAAN

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
                $('#selectPangkat').val('{{$pasien["identitas"]->tni_pangkat_id}}').trigger('change');
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
                $('#selectSatker').val('{{$pasien["identitas"]->tni_satker_id}}').trigger('change');
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
                @if(!empty($pasien['identitas']->wali))
                $('#selectPangkatKerabat').val('{{$pasien["identitas"]->wali->tni_pangkat_id}}').trigger('change');
                @endif
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
                $('#selectSatkerKerabat').html('').select2({data: [{id: '', text: ''}]});
                data.forEach(function(item) {
                    var newOption = new Option(item.nama, item.id, false, false);
                    $("#selectSatkerKerabat").append(newOption).trigger('change');
                });
                @if(!empty($pasien['identitas']->wali))
                $('#selectSatkerKerabat').val('{{$pasien["identitas"]->wali->tni_satker_id}}').trigger('change');
                @endif
                $('#satkerLoadingKerabat').fadeOut();
            },
            error:function(data){
                console.log(data);
            }
        });
    }
    
    function changeJenis(val)
    {
        valJenisPasien = val;
        if(val == 1)
        {
            $('.jenis-asuransi').show();
            $('.jenis-kerjasama').hide();
        }
        if(val == 2)
        {
            $('.jenis-asuransi').show();
            $('.jenis-kerjasama').hide();
        }
        if(val == 3)
        {
            $('.jenis-asuransi').hide();
            $('.jenis-kerjasama').show();
        }
    }

    function changeGender(val)
    {
        valGender = val;
    }

    function changeMarriage(val)
    {
        valMarriage = val;
    }

    function inputValidation(){
        var errCounter=0;
        $('#pasienEdit input, #pasienEdit .js-select2').each(function(n,element){
            if ($(element).is(':enabled')) {
                if(!$(element).hasClass('emptiable-dasar') && !$(element).hasClass('emptiable-kerabat')){
                    if ($(element).val()=='' || $(element).val()==null || $(element).val()=='null') {
                        errCounter++;
                    }
                }
            }
        });

        console.log("bawah")
        if ($('#pasienEdit input[name="avatar"]').val()=='') {
            errCounter--;
        }
        if ($('#pasienEdit input[name="file_ktp"]').val()=='') {
            errCounter--;
        }
        if ($('#pasienEdit input[name="file_kk"]').val()=='') {
            errCounter--;
        }
        if ($('#pasienEdit input[name="file_kartu_asuransi"]').val()=='') {
            errCounter--;
        }
        if (errCounter==0) {
            return 1;
        } 
        else {
            $('#pasienEdit input').each(function(n,element){
                if ($(element).val()=='') {
                    if($(element).attr('id') == 'noIdentitas'){
                        $(element).parent().append('<div class="invalid-feedback" id="error-no-identitas">Nomor identitas tidak boleh kosong</div>');
                    }else if($(element).attr('id') == 'asuransiNomor'){
                        $(element).parent().append('<div class="invalid-feedback">Silahkan isi data nomor asuransi/bpjs/pegawai pasien </div>');
                    }
                    $(element).parentsUntil(".justify-content-center").addClass("is-invalid");
                }
                else {
                    $(element).parentsUntil(".justify-content-center").removeClass("is-invalid");
                }
            });
            $('#pasienEdit .js-select2').each(function(n,element){
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