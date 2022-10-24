@extends('pasien.layouts.main')

@section('title')
Pindah Ruangan IGD
@endsection

@section('subtitle')
Pindah Ruangan IGD
@endsection

@section('css')
<style type="text/css">
    .labl {
    display : block;
    }
    .labl > input{ /* HIDE RADIO */
        visibility: hidden; /* Makes input not-clickable */
        position: absolute; /* Remove input from document flow */
    }
    .labl > input + div{ /* DIV STYLES */
        cursor:pointer;
        border:2px solid transparent;
    }
    .labl > input:checked + div{ /* (RADIO CHECKED) DIV STYLES */
        border: 4px solid #42a5f5;
    }
</style>
@endsection

@section('content')
<main id="main-container">
    @include('pasien.layouts.navbar')
    <div class="container">
        <div class="">
            <div class="block-content">
                <h4 class="mb-0">Rujuk Pasien ke Ruang IGD</h4>
                Anda akan merujuk pasien ke salah satu ruang igd di rumah sakit
                <hr>
                <form id="pasienSubmit">

                    <div class="block rounded" id="dataJenis">
                        <div class="block-content">
                            <h5 class="uppercase">Form Rujuk Ruang IGD
                                <hr>
                            </h5>
                            <div class="row">
                                <div class="col-6">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label class="control-label">Pasien</label>
                                                <div class="block block-bordered">
                                                    <div class="block-content">
                                                        <div class="row" style="margin-left: 1%;">
                                                            <div class="col-2 px-0">
                                                                <img src="{{asset('')}}/{{$identitas->photo_thumb}}" class="img-avatar-lg" >
                                                            </div>
                                                            <div class="col pl-0" style="padding-top: 0px;">
                                                                <h4 class="title mb-5">{{$identitas->name}}</h4>
                                                                <h6 class="font-w400 mb-5">
                                                                    @if($identitas->gender == 1) Laki laki
                                                                    @else Perempuan
                                                                    @endif
                                                                    , 
                                                                    {{$identitas->age}} tahun
                                                                </h6>
                                                                <h6 class="font-w400 mb-0">No Rekam Medis : #{{$identitas->id}}</h6>
                                                                <h6> </h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label class="control-label">Pilih Layanan Rumah Sakit</label>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <label class="labl">
                                                            <input type="radio" name="radioname" value="2" checked="checked"/>
                                                            <div class="block block-bordered block-link-shadow text-center">
                                                                <div class="block-content">
                                                                    <p class="mt-5">
                                                                        <i class="fal fa-ambulance fa-4x"></i>
                                                                    </p>
                                                                    <p class="font-w600">IGD</p>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                             
                            </div>
                            <hr>
                            <div class="row pilih-igd">
                                <div class="col-6">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label class="control-label">Ruang IGD</label>
                                                <select name="igd" class="form-control js-select2" data-size="5" id="selectIGD" style="width: 100%;">
                                                    @foreach($igd as $item)
                                                        @if(strpos($kasus->lokasi->lokasi->nama, $item->name))
                                                        <option value="{{$item->id}}" myName="{{$item->name}}" selected="selected">{{$item->name}}</option>
                                                        @else
                                                        <option value="{{$item->id}}" myName="{{$item->name}}">{{$item->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" id="nomor_kasus" value="{{$kasus->nomor_kasus}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" id="kasus_id" value="{{$kasus->id}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" id="pasien_id" value="{{$identitas->id}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" id="ruangan_name">
                                            </div>
                                        </div>
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
    $('#select').select2();
    $('.js-select2').select2();

    $(document).ready(function(){
        var option = $(this).find('#selectIGD option:selected');
        var myName = option.attr("myName");

        $('#ruangan_name').val(myName); 
    });

    $(function() {
        $("#selectIGD").change(function(){
            var option = $(this).find('option:selected');
            var myName = option.attr("myName");

            $('#ruangan_name').val(myName);
        });
    });

    valLayanan = $('input[type="radio"][name="radioname"]:checked').val();

    function inputValidation(){
        var errCounter=0;
        $('#pasienSubmit input, #pasienSubmit select').each(function(n,element){
            if ($(element).val()=='') {
                errCounter++;
            }
        });
        console.log(errCounter);
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
        $('#buttonLoading').show();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        pasienID = $("#pasien_id").val();
        ruangan_id = $("#selectIGD").val();
        nomor_kasus = $("#nomor_kasus").val();
        kasus_id = $("#kasus_id").val();
        transaksi_masuk_id = $("#transaksi_masuk_id").val();
        ruangan_name = $("#ruangan_name").val();
        console.log(nomor_kasus);

        var formData = new FormData();
        formData.append('pasien_id', pasienID);
        formData.append('ruangan_id', ruangan_id);
        formData.append('nomor_kasus', nomor_kasus);
        formData.append('kasus_id', kasus_id);
        formData.append('transaksi_masuk_id', transaksi_masuk_id);
        formData.append('ruangan_name', ruangan_name);

        var validate = inputValidation();
        if (validate==0) {
            callSwal('error','Transaksi Gagal','Terdapat Masukan yang Kosong',0);
            $('#buttonSubmit').show();
            $('#buttonLoading').hide();
        }
        else {
            $.ajax({
                    type: "POST",
                    url: API_URL + "/kasus/administrasi/rujuk/igd",
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

@endsection