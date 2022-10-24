@extends('pasien.layouts.main')

@section('title')
Pasien - Medify
@endsection

@section('subtitle')
Konfirmasi Data Pasien Online
@endsection

@section('css')
    <style>
        .avatar-preview {
            border-radius: 0;
            width: 300px;
        }

        .avatar-preview div {
            border-radius: 0;
        }

        .avatar-upload {
            margin: 20px auto;
            max-width: 300px;
        }
    </style>
@endsection

@section('content')
<main id="main-container">
    @include('pasien.layouts.navbar')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form id="pasienEdit">
                <div class="block rounded" id="dataDasar">
                    <div class="block-content">
                        @include('pasien.pasien-edit.data-dasar')
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="block rounded" id="dataKerabat">
                    <div class="block-content">
                        @include('pasien.pasien-edit.data-kerabat')
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="block rounded" id="dataBerkas">
                    <div class="block-content">
                        @include('pasien.pasien-edit.data-berkas')
                    </div>
                </div>
            </div>
        </form>
            <div class="col-12" style="height: 75px">
                <button class="btn btn-success btn-hero pull-right" type="button" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                <button class="btn btn-alt-success btn-hero pull-right" style="display: none" type="button"  id="buttonLoading">
                    <i class="fa fa-asterisk fa-spin"></i> Loading
                </button>
            </div>
        </div>
    </div>
</main>

@include('pasien.components.modals.pasien_identitas_sama')
@endsection


@section('angular')
@include('pasien.pasien-edit.js-function')
<script src="{{asset('assets/js/combodate.js')}}"></script>
<script type="text/javascript">
    $('#kotaSelect2').select2();
    $('#kecamatanSelect2').select2();
    $('#selectAsuransi').select2();
    $('#selectPerusahaan').select2();
    $('#select').select2();
    $('.js-select2').select2();


    var clickAnggota = 0;
    var clickAnggota2 = 0;
    $( document ).ready(function() {
        $('#identitasLoading').fadeOut();

        @if(!empty($pasien['identitas']->is_anggota))
        if({{$pasien['identitas']->is_anggota}} == 1)
        {
            clickAnggota =1 ;
            $( "#anggota-trigger" ).prop( "checked", true );
            $(".enabledisable").prop("disabled", false);
            tni_nrp = $('#tniNrp').val("{{$pasien['identitas']->tni_nrp}}");
        }
        else @endif {
            clickAnggota = 0;
            $(".enabledisable").prop("disabled", true);
            $('#tniNrp').val(0);
            $('#pangkatLoading').fadeOut();
            $('#satkerLoading').fadeOut();
            $('#pangkatLoadingKerabat').fadeOut();
            $('#satkerLoadingKerabat').fadeOut();       
        }

        @if(!empty($pasien['identitas']->wali) && !empty($pasien['identitas']->wali->is_anggota))
        if ({{$pasien['identitas']->wali->is_anggota}} == 1) 
        {
            $(".enabledisable2").prop("disabled", false);
            $( "#anggota-trigger2" ).prop( "checked", true );
            $('#tniNamaKerabat').val("{{$pasien['identitas']->wali->tni_nama}}");
            $('#tniNrpKerabat').val("{{$pasien['identitas']->wali->tni_nrp}}");
            clickAnggota2 =1 ;
        }
        else {
            clickAnggota2 = 0;
            $(".enabledisable2").prop("disabled", true); 
            $('#tniNamaKerabat').val(0);
            $('#tniNrpKerabat').val(0);
            $('#pangkatLoading').fadeOut();
            $('#satkerLoading').fadeOut();
            $('#pangkatLoadingKerabat').fadeOut();
            $('#satkerLoadingKerabat').fadeOut();
        }
        @else
            clickAnggota2 = 0;
            $(".enabledisable2").prop("disabled", true); 
            $('#tniNamaKerabat').val(0);
            $('#tniNrpKerabat').val(0);
            $('#pangkatLoading').fadeOut();
            $('#satkerLoading').fadeOut();
            $('#pangkatLoadingKerabat').fadeOut();
            $('#satkerLoadingKerabat').fadeOut();
        @endif
        //$(".enabledisable2").prop("disabled", true);

    });

    
    //$('#tniNrp').val(0);
    $('#anggota-trigger').click(function() {
        if(clickAnggota == 1)
        {
            clickAnggota = 0;
            $(".enabledisable").prop("disabled", true);
            $('#tniNrp').val(0);
            //$('#formAnggota').slideUp();
        }
        else {
            $(".enabledisable").prop("disabled", false);
            tni_nrp = $('#tniNrp').val("{{$pasien['identitas']->tni_nrp}}");
            //$('#formAnggota').slideDown();
            clickAnggota =1 ;
        }
    });

    $('#anggota-trigger2').click(function() {
        if(clickAnggota2 == 1)
        {
            clickAnggota2 = 0;
            $(".enabledisable2").prop("disabled", true); 
            $('#tniNamaKerabat').val(0);
            $('#tniNrpKerabat').val(0);            
        }
        else {
            $(".enabledisable2").prop("disabled", false);
            @if(!empty($pasien['identitas']->wali))
            $('#tniNamaKerabat').val("{{$pasien['identitas']->wali->tni_nama}}");
            $('#tniNrpKerabat').val("{{$pasien['identitas']->wali->tni_nrp}}");
            @endif
            clickAnggota2 =1 ;
        }
    });
    
    $(function(){
        $('#tanggal-lahir').combodate({
              minYear: 1900,
              maxYear: moment().format('YYYY'),
              customClass: 'form-control js-select2'
        });
        $('.js-select2').select2();
    });
    $(function(){
        $('#tanggal-lahir-kerabat').combodate({
              minYear: 1900,
              maxYear: moment().format('YYYY'),
              customClass: 'form-control js-select2'
        });
        $('.js-select2').select2();
    });
    //$('#tanggal-lahir').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
    //$('#tanggal-lahir-kerabat').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
    $('.jenis-kerjasama').hide();

    @if($pasien["identitas"]->type == 1)
    changeJenis(1);
    $('#selectAsuransi').val('{{$pasien["identitas"]->pasien_asuransi->company_id}}').trigger('change');
    @elseif($pasien["identitas"]->type == 2)
    changeJenis(2);
    $('#selectAsuransi').val('{{$pasien["identitas"]->pasien_asuransi->company_id}}').trigger('change');
    @elseif($pasien["identitas"]->type == 3)
    changeJenis(3);
    $('#selectPerusahaan').val('{{$pasien["identitas"]->pasien_kerjasama->company_id}}').trigger('change');
    @endif
   
    @if(!empty($pasien['identitas']->wali))
    var valGender = "{{$pasien['identitas']->gender}}";
    var valGenderKerabat = "{{$pasien['identitas']->wali->gender}}";
    var valMarriage = "{{$pasien['identitas']->marriage}}";
    @else
    var valGender = "";
    var valGenderKerabat = "";
    var valMarriage = "";
    @endif

    ///////////////

    $( document ).ready(function() {
        getKota();
        $('#kotaSelect2').on("select2:select", function(e) { 
            id = $('#kotaSelect2').val()
            setKecamatan(id)
        });
        $('#kotaSelect2kerabat').on("select2:select", function(e) { 
            idKer = $('#kotaSelect2kerabat').val()
            setKecamatanKerabat(idKer)
        });

        $('#kelurahanLoading').fadeOut();
        $('#kecamatanSelect2').on("select2:select", function(e) {
            id = $('#kecamatanSelect2').val()
            setKelurahan(id)
        });
//js kelurahan kerabat
        $('#kelurahanLoadingkerabat').fadeOut();
        $('#kecamatanSelect2kerabat').on("select2:select", function(e) {
            id = $('#kecamatanSelect2kerabat').val()
            setKelurahanKerabat(id)
        });

        /////js keanggotaan
        setPangkat('{{$pasien["identitas"]->tni_keanggotaan_id or '0'}}')
        $('#selectKeanggotaan').on("select2:select", function(e) {
            id = $('#selectKeanggotaan').val()
            setPangkat(id)
        });

        setSatker('{{$pasien["identitas"]->tni_kotama_id or '0'}}')
        $('#selectKotama').on("select2:select", function(e) {
            id = $('#selectKotama').val()
            setSatker(id)
        });

        setPangkatKerabat('{{$pasien["identitas"]->wali->tni_keanggotaan_id or '0'}}')
        $('#selectKeanggotaanKerabat').on("select2:select", function(e) {
            id = $('#selectKeanggotaanKerabat').val()
            setPangkatKerabat(id)
        });

        setSatkerKerabat('{{$pasien["identitas"]->wali->tni_kotama_id or '0'}}')
        $('#selectKotamaKerabat').on("select2:select", function(e) {
            id = $('#selectKotamaKerabat').val()
            setSatkerKerabat(id)
        });
    });

</script>

<script type="text/javascript">

    $('#buttonSubmit').click(function() {
    
    $('#buttonSubmit').hide();
    $('#buttonLoading').show();

    var validate = inputValidation();
    
    // return false;
    if (validate==0) {
        document.documentElement.scrollTop = 0;
        callSwal('error','Transaksi Gagal','Terdapat Masukan yang Kosong',0);
        $('#buttonSubmit').show();
        $('#buttonLoading').hide();
    }
    else {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        id = "{{$pasien['identitas']->id}}"
        jenisKartuIdentitas = $("#selectKartuIdentitas").val();
        noIdentitas = $("#noIdentitas").val();
        noKk = $("#noKk").val();
        name = $("input[name='name']").val();
        gender = valGender
        marriage = valMarriage
        birthplace = $("input[name='birthplace']").val();
        birthdate = $("input[name='birthdate']").val();
        address = $("input[name='address']").val();
        city = $("#kotaSelect2").val();
        district = $("#kecamatanSelect2").val();
        kelurahan = $("#kelurahanSelect2").val();
        alamat_domisili = $("#input_alamat_domisili").val();
        phone = $("input[name='phone']").val();
        occupation = $("#selectPekerjaan").val();
        agama = $("#selectAgama").val();
        pendidikan = $("#selectPendidikan").val();
        tni_nrp = $('#tniNrp').val();
        tni_keanggotaan = $('#selectKeanggotaan').val();
        tni_pangkat = $('#selectPangkat').val();
        tni_kotama = $('#selectKotama').val();
        tni_satker = $('#selectSatker').val();
        tni_korps = $('#selectKorps').val();
        tni_jabatan = $('#jabatanTNI').val();
        isAnggota = clickAnggota;
        var bahasa = $("#bahasa").val();
        var suku = $("#suku").val();  
        var no_rm = $("#no_rm").val();        

        //EDIT KERABAT
        @if(!empty($pasien['identitas']->wali))
        id_kerabat = {{$pasien['identitas']->wali->id}};
        @else
        id_kerabat = 0;
        @endif
        noIdentitasK = $("input[name='ktpKerabat']").val();
        nameK = $("input[name='nameKerabat']").val();
        genderK = $("input[name='genderKerabat']:checked").val();
        console.log(genderK);
        birthplaceK = $("input[name='birthplaceKerabat']").val();
        birthdateK = $("input[name='birthdateKerabat']").val();
        addressK = $("input[name='addressKerabat']").val();
        cityK = $("#kotaSelect2kerabat").val();
        districtK = $("#kecamatanSelect2kerabat").val();
        kelurahanK = $("#kelurahanSelect2kerabat").val();
        phoneK = $("input[name='phoneKerabat']").val();
        relative_typeK = $("#relativesType").val();
        
        //EDIT KERABAT ANGGOTA
        isAnggota2 = clickAnggota2;
        tni_nama_kerabat = $('#tniNamaKerabat').val();
        tni_nrp_kerabat = $('#tniNrpKerabat').val();
        tni_keanggotaan_kerabat = $('#selectKeanggotaanKerabat').val();
        tni_pangkat_kerabat = $('#selectPangkatKerabat').val();
        tni_kotama_kerabat = $('#selectKotamaKerabat').val();
        tni_satker_kerabat = $('#selectSatkerKerabat').val();
        tni_relative_kerabat = $('#tniRelativesTypeKerabat').val();
        tni_pangkat_singkat = $('#TNIsingkatPangkat').val();


        avatar =  $('#avatar').prop('files')[0]; 
        file_ktp = $("input[name='file_ktp'][type='file']")[0].files[0] ?? '';
        file_kk = $("input[name='file_kk'][type='file']")[0].files[0] ?? '';
        file_kartu_asuransi = $("input[name='file_kartu_asuransi'][type='file']")[0].files[0] ?? '';

        var formData = new FormData();
        formData.append('id', id);
        formData.append('no_rm', no_rm);
        formData.append('jenis_kartu_identitas', jenisKartuIdentitas);
        formData.append('nomor_identitas', noIdentitas);
        formData.append('nomor_kk', noKk);
        formData.append('name', name);
        formData.append('avatar', avatar);
        formData.append('gender', gender);
        formData.append('marriage', marriage);
        formData.append('birthplace', birthplace);
        formData.append('birthdate', birthdate);
        formData.append('address', address);
        formData.append('city', city);
        formData.append('district', district);
        formData.append('kelurahan', kelurahan);
        formData.append('alamat_domisili', alamat_domisili);
        formData.append('phone', phone);
        formData.append('occupation', occupation);
        formData.append('agama', agama);
        formData.append('pendidikan', pendidikan);
        formData.append('is_anggota', isAnggota);
        formData.append('tni_nrp', tni_nrp);
        formData.append('tni_keanggotaan', tni_keanggotaan);
        formData.append('tni_pangkat', tni_pangkat);
        formData.append('tni_kotama', tni_kotama);
        formData.append('tni_satker', tni_satker);
        formData.append('tni_korps', tni_korps);
        formData.append('tni_jabatan', tni_jabatan);
        formData.append('tni_pangkat_singkat', tni_pangkat_singkat);
        formData.append('bahasa', bahasa);
        formData.append('suku', suku);
        formData.append('idKerabat', id_kerabat);
        formData.append('noIdentitasKerabat', noIdentitasK);
        formData.append('nameKerabat', nameK);
        formData.append('genderKerabat', genderK);
        formData.append('birthplaceKerabat', birthplaceK);
        formData.append('birthdateKerabat', birthdateK);
        formData.append('addressKerabat', addressK);
        formData.append('cityKerabat', cityK);
        formData.append('districtKerabat', districtK);
        formData.append('kelurahanKerabat', kelurahanK);
        formData.append('phoneKerabat', phoneK);
        formData.append('relativeTypeKerabat', relative_typeK);
        formData.append('is_anggota2', isAnggota2);
        formData.append('tni_nama_kerabat', tni_nama_kerabat);
        formData.append('tni_nrp_kerabat', tni_nrp_kerabat);
        formData.append('tni_keanggotaan_kerabat', tni_keanggotaan_kerabat);
        formData.append('tni_pangkat_kerabat', tni_pangkat_kerabat);
        formData.append('tni_kotama_kerabat', tni_kotama_kerabat);
        formData.append('tni_satker_kerabat', tni_satker_kerabat);
        formData.append('tni_relative_kerabat', tni_relative_kerabat);
        formData.append('file_ktp', file_ktp);
        formData.append('file_kk', file_kk);
        formData.append('file_kartu_asuransi', file_kartu_asuransi);
        formData.append('is_konfirmasi', 1);
        /*
        for (var pair of formData.entries()) {
            }
    */
        $.ajax({
            type: "POST",
            url: API_URL + "/pasien/edit",
            contentType: false,
                processData: false,
                enctype: 'multipart/form-data',
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
    }

        function callSwalString(string)
        {
            var response = jQuery.parseJSON(string);
            callSwal(response.type,response.title,response.text,response.url);
        }
    


});

</script>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#avatar").change(function() {
        readURL(this);
    });
</script>

<script type="text/javascript">
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        if (fileName.length > 30) {
            fileName = fileName.substring(0,30)+'..';
        }
        $(this).next().html(fileName);
    });

    $(".btn-batal").click(function (e) { 
        e.preventDefault();
        if ($(this).parent().parent().attr('data-img') != '') {
            $(this).parent().parent().removeClass('d-flex');
            $(this).parent().parent().addClass('d-none');
            $(this).parent().parent().next().attr('hidden',true);
        }
        $(this).parent().parent().next().next().attr('hidden', false);
        $(this).parent().prev().find("input[type='file']").val(null);
        $(this).parent().prev().find("label").text('Pilih file..');
    });

    $("#gantiKtp").click(function (e) { 
        e.preventDefault();
        $(this).parent().prev().prev().removeClass('d-none');
        $(this).parent().prev().prev().addClass('d-flex');
        $(this).parent().attr('hidden',true);
        $(this).parent().prev().attr('hidden',false);
    });

    $("#gantiKk").click(function (e) { 
        e.preventDefault();
        $(this).parent().prev().prev().removeClass('d-none');
        $(this).parent().prev().prev().addClass('d-flex');
        $(this).parent().attr('hidden',true);
        $(this).parent().prev().attr('hidden',false);
    });

    $("#gantiKartuAsuransi").click(function (e) { 
        e.preventDefault();
        $(this).parent().prev().prev().removeClass('d-none');
        $(this).parent().prev().prev().addClass('d-flex');
        $(this).parent().attr('hidden',true);
        $(this).parent().prev().attr('hidden',false);
    });

    $("#berkasKtp").click(function (e) { 
        e.preventDefault();
        var title = 'Kartu Tanda Penduduk';
        var url = '{{ $pasien['identitas']->file_ktp }}';
        if (url) {
            showBerkas(url ,title);
        }
    });
    
    $("#berkasKk").click(function (e) { 
        e.preventDefault();
        var title = 'Kartu Keluarga';
        var url = '{{ $pasien['identitas']->file_kk }}';
        console.log(url);
        if (url) {
            showBerkas(url ,title);
        }
    });
    
    $("#berkasKartuAsuransi").click(function (e) { 
        e.preventDefault();
        var title = 'Kartu Asuransi';
        var url = '{{ $pasien['identitas']->file_kartu_asuransi }}';
        if (url) {
            showBerkas(url ,title);
        }
    });
    
    function showBerkas(url, title) {    
        $("#modalBerkas .block-title").text(title);
        $("#modalBerkas .modal-content img").attr("src", `{{ asset('${url}') }}`);
        $("#modalBerkas .modal-content img").attr("alt", title);
        $("#modalBerkas").modal('show');
    }
</script>
@endsection