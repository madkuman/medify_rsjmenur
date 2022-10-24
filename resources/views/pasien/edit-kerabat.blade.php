@extends('pasien.layouts.main')

@section('title')
Data Kerabat - {{$pasien['identitas']->name}} - Pasien - Medify
@endsection

@section('subtitle')
{{$pasien['identitas']->name}} / Data Kerabat
@endsection

@section('content')
<main id="main-container">
    @include('pasien.layouts.navbar')
    <div class="container">
        <div class="block">
            <div class="block-content">
                <h4 class="mb-0">Data Kerabat</h4>

                <hr>
                <div class="row">
                    <div class="col-4">
                        <div class="block block-bordered">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Identitas Pasien</h3>
                            </div>

                            <div class="block-content">
                                <div class="row mx-0 mb-20">
                                    <div class="col-4 px-0">
                                        <img src="{{asset('')}}/{{$pasien['identitas']->photo_thumb}}" class="img-avatar-lg" >
                                    </div>
                                    <div class="col-8 pl-0" style="padding-top: 0px;">
                                        <h4 class="title mb-5">{{$pasien['identitas']->name}}</h4>
                                        <h6 class="font-w400 mb-5">
                                            @if($pasien['identitas']->gender == 1) Laki laki
                                            @else Perempuan
                                            @endif
                                            , 
                                            {{$pasien['identitas']->age}} tahun
                                        </h6>
                                        <h6 class="font-w400 mb-0">No Rekam Medis : #{{$pasien['identitas']->id}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <form id="pasienSubmit">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Nama Lengkap</label>
                                        <input class="form-control" type="text" name="name" placeholder="ex: Aldi Sujana" value="{{$wali->name}}" />
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Jenis Kelamin</label>

                                        <div class="custom-control custom-radio mb-5">
                                            <input class="custom-control-input" type="radio" name="gender" id="gender-1" value="1" onchange="changeGender(1)" 
                                            @if($wali->gender == 1) checked @endif
                                            > 
                                            <label class="custom-control-label" for="gender-1">Laki Laki</label>
                                        </div>
                                        <div class="custom-control custom-radio mb-5">
                                            <input class="custom-control-input" type="radio" id="gender-2" name="gender" value="2" onchange="changeGender(2)"
                                            @if($wali->gender == 2) checked @endif>
                                            <label class="custom-control-label" for="gender-2">Perempuan</label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Tempat Lahir</label>
                                        <input class="form-control" type="text" name="birthplace" placeholder="ex : Surabaya"  value="{{$wali->birthplace}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Lahir</label>
                                        <input type="text" class="form-control datepicker" id="tanggal-lahir" name="birthdate" placeholder="ex : 02/14/2018"  value="{{$wali->birthdate}}" >
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">No KTP</label>
                                        <input class="form-control" type="text" name="ktp" placeholder="Nomor KTP"  value="{{$wali->ktp}}" />
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Alamat</label>
                                        <input class="form-control" type="text" name="address" placeholder="ex: Jalan Merpati no.11"  value="{{$wali->address}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group row">
                                        <label class="col-12" for="example-select2">Kota/Kabupaten</label>
                                        <div class="col-lg-12">
                                            <select class="js-select2 form-control" id="kotaSelect2" name="city" style="width: 100%;" data-placeholder="Pilih kota/kabupaten">

                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Kecamatan 
                                            @if(!empty($wali->city))
                                            <i id="kecamatanLoading" class="fa fa-asterisk fa-spin text-info"></i>
                                            @else
                                            <i id="kecamatanLoading" class="fa fa-asterisk fa-spin text-info" style="display: none"></i>
                                            @endif

                                        </label>
                                        <select name="district" class="form-control js-select2" data-placeholder="Pilih Kecamatan" id="kecamatanSelect2">
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">No Telp</label>
                                        <input class="form-control" type="text" name="phone" placeholder="HP/Nomor Rumah"  value="{{$wali->phone}}" />
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Hubungan</label>
                                        <select name="relatives_type" id="relativesType" class="form-control" data-size="2">
                                            <option value="1" @if($pasien['identitas']->relatives_type == 1) selected @endif >Pasangan</option>
                                            <option value="2" @if($pasien['identitas']->relatives_type == 2) selected @endif>Orang Tua</option>
                                            <option value="3" @if($pasien['identitas']->relatives_type == 3) selected @endif>Anak</option>
                                            <option value="4" @if($pasien['identitas']->relatives_type == 4) selected @endif>Saudara</option>
                                            <option value="5" @if($pasien['identitas']->relatives_type == 5) selected @endif>Kerabat</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="col-12 pt-20">
                            <label class="css-control css-control-primary css-checkbox">
                                <input type="checkbox" class="css-control-input" id="anggota-trigger" @if($wali->is_anggota == 1) checked @endif>
                                <span class="css-control-indicator"></span> Pasien Memiliki Kerabat Anggota TNI
                            </label>
                        </div>

                    </div>
                    <hr>
                    <div class="row" id="formAnggota">
                        <div class="col-6">
                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Nama Anggota</label>
                                        <input class="form-control" type="text" name="name" id="tniNama" placeholder="Nama Lengkap Anggota Sesuai KTA" value="{{$wali->tni_nama}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">NRP/NIP</label>
                                        <input class="form-control" type="text" name="nrp" id="tniNrp" placeholder="NRP / NIP Anggota" value="{{$wali->tni_nrp}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Keanggotaan</label>
                                        <select name="kelas" id="selectKeanggotaan" class="form-control js-select2" data-size="2">
                                            @foreach($form['tni_keanggotaan'] as $item)
                                            <option value="{{$item->id}}" 
                                                @if($item->id == $wali->tni_keanggotaan_id) selected @endif>
                                                {{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Pangkat</label>
                                        <select name="kelas" id="selectPangkat" class="form-control js-select2" data-size="2">
                                            @foreach($form['tni_pangkat'] as $item)
                                            <option value="{{$item->id}}"
                                                @if($item->id == $wali->tni_pangkat_id) selected @endif> {{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-6">

                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Kotama</label>
                                        <select name="kelas" id="selectKotama" class="form-control js-select2" data-size="2">
                                            @foreach($form['tni_kotama'] as $item)
                                            <option value="{{$item->id}}"
                                                @if($item->id == $wali->tni_kotama_id) selected @endif>{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Satker</label>
                                        <select name="kelas" id="selectSatker" class="form-control js-select2" data-size="2">
                                            @foreach($form['tni_satker'] as $item)
                                            <option value="{{$item->id}}" 
                                                @if($item->id == $wali->tni_satker_id) selected @endif>{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Hubungan</label>
                                        <select name="relatives_type" id="tniRelativesType" class="form-control" data-size="2">
                                            <option value="1" @if($wali->hubungan_type == 1) selected @endif >Pasangan</option>
                                            <option value="2" @if($wali->hubungan_type == 2) selected @endif>Orang Tua</option>
                                            <option value="3" @if($wali->hubungan_type == 3) selected @endif>Anak</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>


                        <div class="col-12" style="height: 75px">
                            <button class="btn btn-success btn-hero pull-right" type="button" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                            <button class="btn btn-alt-success btn-hero pull-right" style="display: none" type="button"  id="buttonLoading">
                                <i class="fa fa-asterisk fa-spin"></i> Loading
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection


@section('angular')
<script type="text/javascript">
    $('#kotaSelect2').select2();
    $('#kecamatanSelect2').select2();
    $('#tanggal-lahir').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
    $('.js-select2').select2();

    var valGender = "{{$wali->gender}}";
    var valMarriage = "{{$wali->marriage}}";
    var valCity = "{{$wali->city}}"
    var isAnggota = "{{$wali->is_anggota}}"

    function getKota()
    {
        $.ajax({
            type:'GET',
            url:API_URL + '/pasien/alamat/kota/get/',
            dataType: 'json',
            success:function(data){
                console.log(data);
                data.forEach(function(item) {
                    var newOption = new Option(item.name, item.id, false, false);
                    $("#kotaSelect2").append(newOption).trigger('change');
                });
                $('#kotaSelect2').val('{{$wali->city}}').trigger('change');


                if(valCity !== '')
                {
                    setKecamatan('{{$wali->city}}')
                }


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
                console.log(data);
                $('#kecamatanSelect2').html('').select2({data: [{id: '', text: ''}]});
                data.forEach(function(item) {
                    var newOption = new Option(item.name, item.id, false, false);
                    $("#kecamatanSelect2").append(newOption).trigger('change');
                });
                $('#kecamatanSelect2').val('{{$wali->district}}').trigger('change');
                $('#kecamatanLoading').fadeOut();
            },
            error:function(data){
                console.log(data);
            }
        });
    }

    $( document ).ready(function() {
        getKota();
        $('#kotaSelect2').on("select2:select", function(e) { 
            id = $('#kotaSelect2').val()
            setKecamatan(id)
        });
    });


    function changeGender(val)
    {
        valGender = val;
    }

    function changeMarriage(val)
    {
        valMarriage = val;
    }

    if(isAnggota == 1)
    {
        var clickAnggota = 1;
        $('#formAnggota').show();
    }
    else
    {
        var clickAnggota = 0;
        $('#formAnggota').hide();
    }

    $('#anggota-trigger').click(function() {
        if(clickAnggota == 1) 
        {
            clickAnggota = 0;
            $('#formAnggota').slideUp();
        }
        else {
            $('#formAnggota').slideDown();
            clickAnggota =1 ;
        }


    });


</script>

<script type="text/javascript">

    $('#buttonSubmit').click(function() {

        $('#buttonSubmit').hide();
        $('#buttonLoading').show();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        id = "{{$wali->id}}"
        name = $("input[name='name']").val();
        gender = valGender
        marriage = valMarriage
        birthplace = $("input[name='birthplace']").val();
        birthdate = $("input[name='birthdate']").val();
        ktp = $("input[name='ktp']").val();
        address = $("input[name='address']").val();
        city = $("#kotaSelect2").val();
        district = $("#kecamatanSelect2").val();
        phone = $("input[name='phone']").val();
        relatives_type = $("#relativesType").val();
        pasien_id = "{{$pasien['identitas']->id}}"
        isAnggota = clickAnggota;
        tniNama = $('#tniNama').val();
        tniNRP = $('#tniNrp').val();
        tniKeanggotaan = $('#selectKeanggotaan').val();
        tniPangkat = $('#selectPangkat').val();
        tniKotama = $('#selectKotama').val();
        tniSatker = $('#selectSatker').val();
        tniHubungan = $('#tniRelativesType').val();
        redirect_to = "{{$redirect_to}}"

        $.ajax({
            type: "POST",
            url: API_URL + "/pasien/kerabat/edit",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id : id,
                name : name,
                gender : gender,
                birthplace : birthplace,
                birthdate : birthdate,
                ktp : ktp,
                address : address,
                city : city,
                district : district,
                phone : phone,
                relatives_type : relatives_type,
                pasien_id : pasien_id,
                is_anggota : isAnggota,
                tni_nama : tniNama,
                tni_nrp : tniNRP,
                tni_keanggotaan_id : tniKeanggotaan,
                tni_pangkat_id : tniPangkat,
                tni_kotama_id : tniKotama,
                tni_satker_id : tniSatker,
                tni_hubungan_type : tniHubungan,
                redirect_to : redirect_to

            },
            success: function (data) {
                callSwal(data.type,data.title,data.text,data.url);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();

            },
            error: function (xhr) {
                callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
            }
        });



    });

</script>

@endsection