@extends('pasien.layouts.main')

@section('title')
Pasien - Medify
@endsection

@section('subtitle')
Pendaftaran Pasien Baru
@endsection

@section('css')
<style type="text/css">
    .js-select2 {
        width: 100%;
    }
    .berkas-preview {
        border-radius: 0;
        width: 300px;
    }

    .berkas-preview div {
        border-radius: 0;
    }

    .berkas-upload {
        margin: 20px auto;
        max-width: 300px;
    }
</style>
@endsection

@section('content')
<main id="main-container">
    @include('pasien.layouts.navbar')
    <div class="container">
        <div class="">
            <div class="block-content">
                <h4 class="mb-0">Pendaftaran Pasien Baru</h4>
                <p class="full-only">Pastikan tidak ada pasien yang memiliki identitas yang mirip dengan pasien baru yang akan anda masukkan</p>
                <hr>
                <form id="pasienSubmit" enctype="multipart/form-data" method="POST">
                    <div class="block rounded {{ config('medify.pasien.pasien_baru.enable_pasien_laborat') ? '' : 'd-none' }}" id="dataJenis">
                        <div class="block-content">
                            @include('pasien.pasien-baru.pilih-tipe')
                        </div>
                    </div>
                    <div class="block rounded" id="dataJenis">
                        <div class="block-content">
                            @include('pasien.pasien-baru.data-jenis')
                        </div>
                    </div>
                    <div class="block rounded" id="dataDasar">
                        <div class="block-content">
                            @include('pasien.pasien-baru.data-dasar')
                        </div>
                    </div>
                    <div class="block rounded rm_biasa" id="dataKerabat">
                        <div class="block-content">
                            @include('pasien.pasien-baru.data-kerabat')
                        </div>
                    </div>
                    <div class="block rounded rm_biasa_2" id="dataBerkas">
                        <div class="block-content">
                            @include('pasien.pasien-baru.data-berkas')
                        </div>
                    </div>
                    <div class="col-12" style="height: 75px">
                        <button class="btn btn-success btn-hero pull-right" type="submit" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                        <button class="btn btn-alt-success btn-hero pull-right" style="display: none" type="button"  id="buttonLoading">
                            <i class="fa fa-asterisk fa-spin"></i> Loading
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>

@include('pasien.components.modals.pasien_identitas_sama')
@include('pasien.components.modals.pasien_pembayaran_sama')
@include('pasien.components.modals.autoinput-pasien',['show_autofill_confirm' => 1])
@endsection


@section('angular')
<script src="{{asset('assets/js/combodate.js')}}"></script>
<script type="text/javascript" src="{{asset('js/pasien/address-function.js')}}"></script>
@include('pasien.pasien-baru.js-function')
<script type="text/javascript">

    $('#buttonSubmit').click(function() {

        $('#buttonSubmit').hide();
        $('#buttonLoading').show();
        var validate = inputValidation();

        
        
        if (validate==0) {
            document.documentElement.scrollTop = 0;
            callSwal('error','Transaksi Gagal','Terdapat Masukan yang Kosong',0);
            $('#buttonSubmit').show();
            $('#buttonLoading').hide();
        }
        else{
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            avatar = $('input[name="avatar"][type=file]')[0].files[0];

            jenisPasien = valJenisPasien;
            perusahaan_pembayaran_id = $("#perusahaan-select-"+jenisPasien).val();
            nomor_asuransi = $("#asuransiNomor").val();
            kelas = $("#selectKelas").val();


            jenisKartuIdentitas = $("#selectKartuIdentitas").val();
            noIdentitas = $("#noIdentitas").val();
            identity = $('#avatar').prop('files')[0];
            // kategori_pasien = $("input[name='kategori_pasien']:checked").val();
            kategori_pasien = $("input[name='kategori_pasien']").is(':checked') ? $("input[name='kategori_pasien']:checked").val() : 0;
            name = $("input[name='name']").val();
            gender = valGender
            marriage = valMarriage
            birthplace = $("input[name='birthplace']").val();
            birthdate = $("input[name='birthdate']").val();
            address = $("input[name='address']").val();
            address_domisili = $("input[name='address_domisili']").val();
            city = $("#kotaSelect2").val();
            district = $("#kecamatanSelect2").val();
            kelurahan = $("#kelurahanSelect2").val();
            phone = $("input[name='phone']").val();            
            occupation = $("#selectPekerjaan").val();
            agama = $("#selectAgama").val();
            pendidikan = $("#selectPendidikan").val();
            isAnggota = clickAnggota;
            var bahasa = $("#bahasa").val();
            var suku = $("#suku").val();
            alergi = $("#alergi").val();

            nama_ayah = $("#nama_ayah").val();
            nama_ibu = $("#nama_ibu").val();
            nama_suami = $("#nama_suami").val();
            nama_istri = $("#nama_istri").val();

            tni_nrp = $('#tniNrp').val();
            tni_keanggotaan = $('#selectKeanggotaan').val();
            tni_pangkat = $('#selectPangkat').val();
            tni_kotama = $('#selectKotama').val();
            tni_satker = $('#selectSatker').val();
            tni_korps = $('#selectKorps').val();
            tni_jabatan = $('#jabatanTNI').val();
            tni_pangkat_singkat = $('#TNIsingkatPangkat').val();

            //EDIT KERABAT
            nameK = $("input[name='nameKerabat']").val();
            genderK = valGenderKerabat;
            addressK = $("input[name='addressKerabat']").val();
            phoneK = $("input[name='phoneKerabat']").val();
            relative_typeK = $("#relativesType").val();
            isAnggota2 = clickAnggota2;

            //EDIT KERABAT ANGGOTA
            tni_nama_kerabat = $('#tniNamaKerabat').val();
            tni_nrp_kerabat = $('#tniNrpKerabat').val();
            tni_keanggotaan_kerabat = $('#selectKeanggotaanKerabat').val();
            tni_pangkat_kerabat = $('#selectPangkatKerabat').val();
            tni_kotama_kerabat = $('#selectKotamaKerabat').val();
            tni_satker_kerabat = $('#selectSatkerKerabat').val();
            tni_relative_kerabat = $('#tniRelativesTypeKerabat').val();

            file_ktp = $("input[name='file_ktp'][type='file']")[0].files[0];
            file_kk = $("input[name='file_kk'][type='file']")[0].files[0];
            file_kartu_asuransi = $("input[name='file_kartu_asuransi'][type='file']")[0].files[0];
            
            var formData = new FormData();
            formData.append('avatar', avatar);
            formData.append('jenis_pasien', jenisPasien);
            formData.append('perusahaan_pembayaran_id', perusahaan_pembayaran_id);
            formData.append('nomor_asuransi', nomor_asuransi);
            formData.append('kelas', kelas);
            formData.append('jenis_kartu_identitas', jenisKartuIdentitas);
            formData.append('nomor_identitas', noIdentitas);
            formData.append('kategori_pasien', kategori_pasien);
            formData.append('name', name);
            formData.append('gender', gender);
            formData.append('marriage', marriage);
            formData.append('birthplace', birthplace);
            formData.append('birthdate', birthdate);
            formData.append('address', address);
            formData.append('address_domisili', address_domisili);
            formData.append('city', city);
            formData.append('district', district);
            formData.append('kelurahan', kelurahan);
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
            formData.append('tni_korps', tni_korps)
            formData.append('tni_jabatan', tni_jabatan)
            formData.append('tni_pangkat_singkat', tni_pangkat_singkat);
            formData.append('suku', suku);
            formData.append('alergi', alergi);
            formData.append('foto_identitas', identity);

            formData.append('nama_ayah', nama_ayah);
            formData.append('nama_ibu', nama_ibu);
            formData.append('nama_istri', nama_istri);
            formData.append('nama_suami', nama_suami);

            formData.append('nameKerabat', nameK);
            formData.append('genderKerabat', genderK);
            formData.append('addressKerabat', addressK);
            formData.append('phoneKerabat', phoneK);
            formData.append('relativeTypeKerabat', relative_typeK);
            formData.append('isAnggota', isAnggota2);
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

            $.ajax({
                type: "POST",
                url: API_URL + "/pasien/baru",
                enctype: 'multipart/form-data',
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
        }
        
        function callSwalString(string)
        {
            var response = jQuery.parseJSON(string);
            callSwal(response.type,response.title,response.text,response.url);
        }

    });

</script>
<script type="text/javascript">
    $('input[type=radio][name="pasien_tipe_rm"]').change(function () {   
        var check_tipe_rm = $('#pasienSubmit input[name="pasien_tipe_rm"]:checked').val();
        console.log(check_tipe_rm)
        if(check_tipe_rm == 1){
            $('#pasienSubmit .rm_biasa').hide();
            $('.rm_biasa_2').hide();
            $('.hapus_required').removeAttr('required');
            $('#pasienSubmit input:radio[name="jenispasien"]').filter('[value="2"]').prop('checked', true);
            console.log($('#pasienSubmit input:radio[name="jenispasien"]:checked').val())
            changeJenis('2&&tunai')
        }
        else{
            $('#pasienSubmit .rm_biasa').show();
            $('.rm_biasa_2').show();
            $('.hapus_required').attr('required');
        }

        $('#pasienSubmit .is-invalid').removeClass("is-invalid")
    });
    $(function(){
        $('#tanggal-lahir').combodate({
              value: new Date(),
              minYear: 1900,
              maxYear: moment().format('YYYY'),
              customClass: 'form-control js-select2'
        });    
        $('.js-select2').select2();
    });
    $(function(){
        $('#tanggal-lahir2').combodate({
              value: new Date(),
              minYear: 1900,
              maxYear: moment().format('YYYY'),
              customClass: 'form-control js-select2'
        });    
        $('.js-select2').select2();
    });
    //$('#kotaSelect2').select2();
    //$('#kecamatanSelect2').select2();
    //$('#select').select2();
    $('.js-select2').select2();
    //$('.selection').find('.select2-selection').addClass('is-invalid');
        //$('#tanggal-lahir').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
    //$('#tanggal-lahir2').bootstrapMaterialDatePicker({ weekStart : 0, time: false });

    var valJenisPasien = 1;
    var valGender = 1;
    var valGenderKerabat = 1;
    var valMarriage = 1;
    
    $( document ).ready(function() {
        $('#identitasLoading').fadeOut();
        $('#pembayaranLoading').fadeOut();
        $('#namaLoading').fadeOut();

        $(".enabledisable").prop("disabled", true);
        $(".enabledisable2").prop("disabled", true);
        getKota();
        $('#kotaSelect2').on("select2:select", function(e) {
            id = $('#kotaSelect2').val()
            //console.log(id)
            setKecamatan(id)
        });
        //js kelurahan
        $('#kelurahanLoading').fadeOut();
        $('#kecamatanSelect2').on("select2:select", function(e) {
            id = $('#kecamatanSelect2').val()
            //console.log(id)
            setKelurahan(id)
        });

        getKotaKerabat();
        $('#kotaSelect2Kerabat').on("select2:select", function(e) {
            idKerabat = $('#kotaSelect2Kerabat').val()
            //console.log(idKerabat)
            setKecamatanKerabat(idKerabat)
        });
        //js kelurahan kerabat
        $('#kelurahanLoadingKerabat').fadeOut();
        $('#kecamatanSelect2Kerabat').on("select2:select", function(e) {
            id = $('#kecamatanSelect2Kerabat').val()
            //console.log(id)
            setKelurahanKerabat(id)
        });


        ///// keanggotaan tni js
        $('#pangkatLoading').fadeOut();
        $('#selectKeanggotaan').on("select2:select", function(e) {
            id = $('#selectKeanggotaan').val()
            //console.log(id)
            setPangkat(id)
        });

        $('#satkerLoading').fadeOut();
        $('#selectKotama').on("select2:select", function(e) {
            id = $('#selectKotama').val()
            //console.log(id)
            setSatker(id)
        });

        $('#pangkatLoadingKerabat').fadeOut();
        $('#selectKeanggotaanKerabat').on("select2:select", function(e) {
            id = $('#selectKeanggotaanKerabat').val()
            //console.log(id)
            setPangkatKerabat(id)
        });

        $('#satkerLoadingKerabat').fadeOut();
        $('#selectKotamaKerabat').on("select2:select", function(e) {
            id = $('#selectKotamaKerabat').val()
            //console.log(id)
            setSatkerKerabat(id)
        });

    });

    /*
     $('#buttonNext').click(function() {
        $('#buttonSubmit').show();
        $('#buttonPrev').show();
        $('#buttonNext').hide();
        $('#dataJenis').hide();
        $('#dataDasar').hide();
        $('#dataKerabat').slideDown();

     });

     $('#buttonPrev').click(function() {
        $('#buttonSubmit').hide();
        $('#buttonPrev').hide();
        $('#dataKerabat').hide();
        $('#dataJenis').slideDown();
        $('#dataDasar').slideDown();
        $('#buttonNext').show();

     });*/



    var clickAnggota = 0;
    $('#tniNrp').val(0);
//$('#formAnggota').hide();
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
            tni_nrp = $('#tniNrp').val("");
            //$('#formAnggota').slideDown();
            clickAnggota =1 ;
        }
    });

    var clickAnggota2 = 0;
    $('#tniNamaKerabat').val(0);
    $('#tniNrpKerabat').val(0);
    $('#copydata').hide();
    $('#anggota-trigger2').click(function() {
        if(clickAnggota2 == 1)
        {
            clickAnggota2 = 0;
            $(".enabledisable2").prop("disabled", true); 
            $('#tniNamaKerabat').val(0);
            $('#tniNrpKerabat').val(0);
            $('#copydata').hide();
        }
        else {
            $(".enabledisable2").prop("disabled", false);
            $('#tniNamaKerabat').val("");
            $('#tniNrpKerabat').val("");
            clickAnggota2 =1 ;
            $('#copydata').show();
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
</script>

<script>
    
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

@endsection