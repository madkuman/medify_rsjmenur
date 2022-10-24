@extends('pasien.layouts.main')

@section('title')
Pasien - Medify
@endsection

@section('subtitle')
Ubah Metode Pembayaran Pasien
@endsection

@section('content')
<main id="main-container">
    @include('pasien.layouts.navbar')
    <div class="container">
        <div class="">
            <div class="block-content">
                <h4 class="mb-0">Ubah Metode Pembayaran</h4>
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
                                                    onchange="changeJenis('{{$item->id}}&&{{$item->slug}}')" @if(!empty($pembayaran->perusahaan) && $item->id == $pembayaran->perusahaan->type) checked @endif>
                                                    <label class="custom-control-label"  for="type-{{$item->id}}">{{$item->nama}}</label>
                                                </div>
                                                @endforeach


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mobile-block col-sm-12 mb-20"></div>
                                @php $show = 0 @endphp
                                <div class="col-lg-6 col-sm-12">

                                    @foreach($form['jenis_pasien'] as $item_tipe)

                                    @if(!empty($pembayaran->perusahaan) && $item_tipe->id == $pembayaran->perusahaan->type)
                                        @php $show = 1  @endphp
                                    @else 
                                        @php $show = 0  @endphp
                                    @endif

                                    <div class="row justify-content-center perusahaan-select-container perusahaan-select-{{$item_tipe->id}}-container" @if($show == 0) style="display: none" @endif>
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label class="control-label">Asuransi</label>
                                                <select name="asuransi" class="form-control js-select2" data-size="5" id="perusahaan-select-{{$item_tipe->id}}" style="width: 100%:" onchange="pembayaranCheck()">
                                                    @foreach($form['perusahaan'] as $item)
                                                    
                                                    @if($item->type == $item_tipe->id)
                                                    <option value="{{$item->id}}" @if($item->id == $pembayaran->perusahaan_id) selected @endif>{{$item->nama}}</option>
                                                    
                                                    @endif
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    
                                    @endforeach
                                    <div class="row justify-content-center nomor-asuransi">
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label class="control-label">Nomor Asuransi <i id="pembayaranLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                                                <input class="form-control mb-5" type="text" id="asuransiNomor" name="nomorasuransi" placeholder="Nomor" autofocus="true" value="{{$pembayaran->no_asuransi ?? ''}}" />
                                                <div id="textAutoInputBPJS"></div>
                                                <div id="textCekNomorAsuransi"></div>
                                                <a href="javascript:void(0)" id="notifExistAutoInputBPJS" data-toggle="modal" data-target="#modal-autoinput-pasien" style="display: none">Klik Disini! Kami menemukan data pasien yang sesuai dengan nomor BPJS</a>
                                                <label class="notif-bpjs badge badge-danger" style="white-space: break-spaces;"></label>
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
                                                    <option value="{{$item->id}}" @if($item->id == $pembayaran->kelas_id) selected @endif>{{$item->nama}}</option>
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
                        <input class="form-control" type="hidden" id="pasien_id" name="pasien_id" value="{{$pembayaran->pasien_id}}" />
                        <input class="form-control" type="hidden" id="bayar_id" name="bayar_id" value="{{$pembayaran->id}}" />
                        <input class="form-control" type="hidden" id="utama" name="utama" value="{{$pembayaran->utama}}" />
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

@include('pasien.pembayaran.edit-components.js-submit')
@include('pasien.pembayaran.edit-components.js-autoinput')
<script type="text/javascript">
    var realJenisPasien = {{$item->id}}
    var pasien_id = {{$pembayaran['pasien_id']}}

    $( document ).ready(function() {
        $(document).on('change','#asuransiNomor', pembayaranCheck);
        if(realJenisPasien == 7)
        {
            getNomorBPJSController()
        }
    });
</script>
<script type="text/javascript">
    $('#select').select2();
    $('.js-select2').select2();
    $('#pembayaranLoading').fadeOut();

    var valJenisPasien = '{{$pembayaran->perusahaan->type ?? ''}}'
    var valJenisPasienSlug = '{{$pembayaran->perusahaan->tipe->slug ?? ''}}'
    var noAsuransi = '{{$pembayaran->no_asuransi}}'
    changeJenis(valJenisPasien+'&&'+valJenisPasienSlug)
    $("#asuransiNomor").val(noAsuransi);
    
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

@endsection