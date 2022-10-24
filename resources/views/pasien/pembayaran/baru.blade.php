@extends('pasien.layouts.main')

@section('title')
Pasien - Medify
@endsection

@section('subtitle')
Pendaftaran Pasien Baru
@endsection

@section('content')
<main id="main-container">
    @include('pasien.layouts.navbar')
    <div class="container">
        <div class="">
            <div class="block-content">
                <h4 class="mb-0">Penambahan Metode Pembayaran Baru</h4>
                <hr>
                <form id="pasienSubmit">

                    <div class="block rounded" id="dataJenis">
                        <div class="block-content">
                            <h5 class="uppercase">Jenis Pasien
                                <hr>
                            </h5>
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label class="control-label">Jenis Pasien</label>


                                                @foreach($form['jenis_pasien'] as $item)
                                                <div class="custom-control custom-radio mb-5">
                                                    <input class="custom-control-input" type="radio" name="jenispasien" 
                                                    id="type-{{$item->id}}" value="{{$item->id}}" 
                                                    onchange="changeJenis('{{$item->id}}&&{{$item->slug}}')" @if($item->id == 1) checked @endif>
                                                    <label class="custom-control-label"  for="type-{{$item->id}}">{{$item->nama}}</label>
                                                </div>
                                                @endforeach


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mobile-block col-sm-12 mb-20"></div>
                                <div class="col-lg-6 col-sm-12">

                                    @php $show = 0 @endphp
                                    @foreach($form['jenis_pasien'] as $item_tipe)
                                    <div class="row justify-content-center perusahaan-select-container perusahaan-select-{{$item_tipe->id}}-container {{$show}}" @if($show == 1) style="display: none" @endif>
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label class="control-label">Asuransi</label>
                                                <select name="asuransi" class="form-control js-select2" data-size="5" id="perusahaan-select-{{$item_tipe->id}}" style="width: 100%:" onchange="pembayaranCheck()">
                                                    @foreach($form['perusahaan'] as $item)
                                                    @if($item->type == $item_tipe->id)
                                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    @if($show == 0) @php $show = 1 @endphp @endif
                                    @endforeach

                                    <div class="row justify-content-center nomor-asuransi">
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label class="control-label">Nomor Asuransi <i id="pembayaranLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                                                <input class="form-control mb-5" type="text" id="asuransiNomor" name="nomorasuransi" placeholder="Nomor" autofocus="true" />
                                                <div id="textAutoInputBPJS"></div>
                                                <div id="textCekNomorAsuransi"></div>
                                                <a href="javascript:void(0)" id="notifExistAutoInputBPJS" data-toggle="modal" data-target="#modal-autoinput-pasien" style="display: none">Klik Disini! Kami menemukan data pasien yang sesuai dengan nomor BPJS</a>
                                                <div class="invalid-feedback">Silahkan isi nomor asuransi pasien</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label class="control-label">Kelas Perawatan</label>
                                                <select name="kelas" id="selectKelas" class="form-control js-select2" data-size="2">
                                                    @foreach($form['kelas'] as $item)
                                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">Silahkan isi kelas pasien</div>
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
                        <input class="form-control" type="hidden" id="pasienid" name="pasienid" value="{{$pasienid}}" />
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>

@include('pasien.components.modals.pasien_pembayaran_sama')
@include('pasien.components.modals.autoinput-pasien',['show_autofill_confirm' => 0])
@endsection


@section('js')
@include('pasien.pembayaran.edit-components.js-autoinput')
<script type="text/javascript">
    var pasien_id = {{$pasienid}}
    var valJenisPasien = {{$form['jenis_pasien'][0]->id}}
    $('#select').select2();
    $('.js-select2').select2();
    
    $('#pembayaranLoading').fadeOut();

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

</script>

<script type="text/javascript">

    $('#buttonSubmit').click(function() {

        $('#buttonSubmit').hide();
        $('#buttonLoading').show();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


        pasienID = $("#pasienid").val();
        jenisPasien = valJenisPasien;
        perusahaan_pembayaran_id = $("#perusahaan-select-"+jenisPasien).val();
        nomor_asuransi = $("#asuransiNomor").val();
        kelas_rawat = $("#selectKelas").val();

        var formData = new FormData();
        formData.append('pasien_id', pasienID);
        formData.append('jenis_pasien', jenisPasien);
        formData.append('perusahaan_pembayaran_id', perusahaan_pembayaran_id);
        formData.append('nomor_asuransi', nomor_asuransi);
        formData.append('kelas', kelas_rawat);
        
        $.ajax({
            type: "POST",
            url: API_URL + "/pasien/pembayaran/baru",
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

@endsection