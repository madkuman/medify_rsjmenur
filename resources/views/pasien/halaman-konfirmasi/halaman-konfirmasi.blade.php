@extends('pasien.layouts.main')

@section('title')
Pasien - Medify
@endsection

@section('subtitle')
Pendaftaran Pasien Baru
@endsection

@section('css')
<style type="text/css">
    .labl {
        display : block;
        width: 100%;
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
    .labl p
    {
        font-size: 12px;
    }

    .custom-tabbable .custom-nav-tabs {
       overflow-x: auto;
       overflow-y:hidden;
       flex-wrap: nowrap;
    }

    .modal-full {
        min-width: 100%;
        margin: 0;
    }
    .modal-full .modal-content {
        min-height: 100vh;
    }
</style>
@endsection

@section('content')
<main id="main-container">
    @include('pasien.layouts.navbar')
    <div class="container">
        <div class="">
            <div class="block-content">
                <h4 class="mb-0">Pendaftaran Pasien ke Pelayanan</h4>
                Anda akan mendaftarkan pasien ke salah satu pelayanan di rumah sakit
                <br><br>
                <form id="pasienSubmit">
                    <input type="text" name="inputKasusID" id="selectKasus" value="0" style="display: none">
                    <input type="text" name="rujukan_id" id="selectRujukanID" value="0" style="display: none">
                    <input type="text" name="antrian_id" id="antrian_id" value="{{$antrian->id}}" style="display: none">
                    <input type="text" name="nomor_antrian" id="nomor_antrian" value="{{$antrian->jumlah_antrian}}" style="display: none">
                    <div class="block rounded" id="dataJenis">
                        <div class="block-content">
                            <h5 class="uppercase">Form Pendaftaran Layanan 
                                <hr>
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    @include('pasien.halaman-konfirmasi.content.layanan-utama')
                                    <hr>
                                    @include('pasien.halaman-konfirmasi.content.pilih-poli')
                                    {{-- @include('pasien.halaman-konfirmasi.content.pilih-igd')
                                    @include('pasien.halaman-konfirmasi.content.pilih-urikkes') --}}
                                    <hr>
                                    @include('pasien.halaman-konfirmasi.content.metode-bayar')
                                    <hr>
                                    @include('pasien.halaman-konfirmasi.content.retribusi')
                                </div>
                                <div class="col-md-6">
                                    @include('pasien.halaman-konfirmasi.content.my-rujuk-poli')
                                    @include('pasien.halaman-konfirmasi.content.urikkes-paket-custom')
                                </div>
                            </div>
                        </div>
                        <div class="py-10 text-center font-w600 bg-danger text-white mb-20 align-middle" id="error-wrapper" style="display: none;">
                            <i class="fa fa-exclamation-circle mr-5"></i>
                            <span></span>
                        </div>
                        <input type="hidden" id="cek-pesanan-duplicate" value="0">
                        <input type="hidden" id="cek-pesanan-duplicate-text" value="text">
                        <div class="col-12">
                            @if(count($kasus_krs_today) > 0 || count($kasus_masih_ranap) > 0)
                            <div class="alert alert-warning alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h3 class="alert-heading font-size-h4 font-w400">Perhatian!</h3>
                                @if(count($kasus_masih_ranap) > 0)
                                <p class="mb-0">Pasien masih menjalani Rawat Inap. Pastikan anda yakin ingin melanjutkan pendaftaran.</p>
                                @else
                                <p class="mb-0">Pasien baru saja KRS hari ini. Pastikan anda yakin ingin melanjutkan pendaftaran.</p>
                                @endif
                            </div>
                            @endif
                            <div class="row flex-row-reverse">
                                <button class="btn btn-success btn-hero col-lg-2 col-12" type="button" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                                <button class="btn btn-alt-success btn-hero col-lg-2 col-12" style="display: none;" type="button"  id="buttonLoading">
                                    <i class="fa fa-asterisk fa-spin"></i> Loading
                                </button>  
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@include('pasien.pendaftaran.content.modal.paket-info')
@include('pasien.pendaftaran.content.modal.urikkes-paket-custom')
@endsection


@section('js')
<script type="text/javascript">
    var totalBayar = 0;
    var clickPasienBaru = 0;
    var clickIGD = 0;
    var clickKartu = 0;
    var clickPoli = 0;
    var clickFile = 0;
    var clickBiayaBPJS = 0;
    var valLayanan = $('input[type="radio"][name="radioname"]:checked').val();
    var data_rujukan;
    var nomor_kartu = '';
    var is_bpjs = 0;
    var is_igd = 0;
    var pasien_id = {{$pasien->id}};
    var new_sep_url = "{{url('')}}/bpjs/sep/create?window=true&pasien_id={{$pasien->id}}&pasien_name={{$pasien->name}}";
    var online_id = 0;
    @isset($online_id)
        online_id = '{{ $online_id }}';
    @endisset
</script>

@include('pasien.halaman-konfirmasi.js.metode_pembayaran')
@include('pasien.halaman-konfirmasi.js.rujukan_bpjs')
@include('pasien.halaman-konfirmasi.js.permintaan_rujuk')
@include('pasien.halaman-konfirmasi.js.pilih_pelayanan')
@include('pasien.halaman-konfirmasi.js.retribusi')
@include('pasien.halaman-konfirmasi.js.submit_bpjs')
@include('pasien.halaman-konfirmasi.js.submit')
@include('pasien.halaman-konfirmasi.js.bpjs_window')
@include('pasien.halaman-konfirmasi.js.urikkes')

<script type="text/javascript">

    changeDaftar(valLayanan);

    $('#select').select2();
    $('.js-select2').select2();
    $('#selectPoli').select2();
    $('#selectPaket').select2({
        placeholder: "Pilih Paket", 
    });
    $('.select-igd').select2();
    $('#selectPembayaran').select2();
    $('#selectRujukan').select2({
      "language": {
            "noResults": function(){
                return "Asal rujukan tidak ditemukan. Buat asal rujukan baru? <button id='tambahRujukan' class='btn btn-primary' onclick='mintaRujukan()'>Buat Asal Rujukan</button>";
            }
      },
      escapeMarkup: function (markup) {
          return markup;
      }
    });


    function mintaRujukan()
    {   
        var rujukan = $(".select2-search__field").val();
        var formData = new FormData();
        formData.append('nama_rujukan',rujukan);
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type:'POST',
             url: API_URL + "/pasien/rujukan/baru",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {
                $('#selectRujukan').append(`<option value="`+response.id+`" data-self="`+response.self+`">`+response.nama+`</option>`)
                //$("#selectRujukan").select2("destroy").select2();
                callSwal('success','Berhasil Ditambah','Asal Rujukan Berhasil Ditambah',0);
                //$('#selectRujukan').select2('data',{id : response.id, text : response.nama});
                //$("#tambahRujukan").hide();
            },
            error: function () {
                
            }
        });
    }

    $('.block-link-pop').click(function() {
        $(this).siblings().removeClass('active')
        $(this).addClass('active');
    });

    $("#tanggal_laka").datepicker( {
        format: "dd-mm-yyyy",
    });

    $('input[type="radio"][name="radioname"]').on('click change', function() {
        changeDaftar($(this).val());
    });

    $('#laka_wrap').change(function() {
        if ($('#laka')[0].checked) {
            $('#form_laka').show();
        } else {
            $('#form_laka').hide();   
        }
    });

     $('#suplesi_wrap').change(function() {
        if ($('#suplesi')[0].checked) {
            $('#sep_suplesi_wrap').show();
        } else {
            $('#sep_suplesi_wrap').hide();   
        }
    });

    $('#selectNoRujukan').on('select2:select', function (e) {
        if($(e.currentTarget).find("option:selected").val() != -1){
            data_rujukan = JSON.parse($(e.currentTarget).find("option:selected").val());
            if(data_rujukan && data_rujukan !== 'null' && data_rujukan !== 'undefined'){
                $('#preview_bpjs_modal_diagnosis')
                    .text(data_rujukan.diagnosa.kode+" - "+data_rujukan.diagnosa.nama || "-");
                $('#preview_bpjs_modal_pelayanan').text(data_rujukan.pelayanan.nama || "-");
                $('#preview_bpjs_modal_perujuk')
                    .text(data_rujukan.provPerujuk.kode+" - "+data_rujukan.provPerujuk.nama || "-");
                $('#preview_bpjs_modal_poli').text(data_rujukan.poliRujukan.nama || "-");
                $('#preview_bpjs_modal_keluhan').text(data_rujukan.keluhan || "-");
                $('#preview_bpjs_modal_cob_nama').text(data_rujukan.peserta.cob.nmAsuransi || "-");
                $('#preview_bpjs_modal_cob_nomor').text(data_rujukan.peserta.cob.noAsuransi || "-");
                var perujuk = data_rujukan.provPerujuk;
                $('#selectRujukan > option').each(function() {
                   if($(this).data('kode') == perujuk.kode){
                        $(this).prop('selected', true);
                        $('#selectRujukan').trigger('change');
                        return false;
                   }
                });
                $('#selectRujukan').prop('disabled', true);
                if($('#selectRujukan :selected').data('kode') != perujuk.kode){
                    //kasi ajax untuk buat asal rujukan baru trus diselect
                }
            }else{
                resetBPJSModalPreview();
            }
        }else{
            data_rujukan = null;
           $('#selectRujukan').prop('disabled', false);
        }
        $('#error-wrapper').hide();
    });

    $('#provinsi_laka').on("select2:select", function(arg) {
        getKabupaten($('#provinsi_laka').val());
    });

    $('#kota_laka').on("select2:select", function(arg) {
        getKecamatan($('#kota_laka').val());
    });

    var is_video = "0";
    var select_poli = "0";
    $(document).ready(function() {
        @if(count($kasus_krs_today) > 0 || count($kasus_masih_ranap) > 0)
        swal({
            type: 'warning',
            title: 'Perhatian!',
            @if(count($kasus_masih_ranap) > 0)
            text: "Pasien masih menjalani Rawat Inap. Pastikan anda yakin ingin melanjutkan pendaftaran"
            @else
            text: "Pasien baru saja KRS hari ini. Pastikan anda yakin ingin melanjutkan pendaftaran"
            @endif
        });
        @endif
        
        
        getPropinsi();
        $('#selectPoli').on("select2:select", function(e) { 
            removeRujukan();

            id = $('#selectPoli').val();
            select_poli = $('#selectPoli').val();
            if(id != null)
            {   
                $('#check-pesanan-duplicate').val(0);
                lihatRuangVideo(id,is_video)
                cekHistoriPoli(id)
            }
        });

        $('#selectKelasAntrian').on("select2:select", function(e) { 

            if(select_poli!="0"){
                removeRujukan();
            }

            id = $('#selectKelasAntrian').val()
            if(id == "5"){
                is_video="1";
                console.log("pakai video");
            }
            else{
                is_video="0";
                console.log("tidak pakai video");
            }
            if(id != null && select_poli!="0")
            {   
                $('#check-pesanan-duplicate').val(0);
                lihatRuangVideo(select_poli,is_video)
                cekHistoriPoli(select_poli)
            }
        });

        pembayaran_id = $('#selectPembayaran').val()
        lihatMetode(pembayaran_id)
        $('#selectPembayaran').on("select2:select", function(e) { 
            //removeRujukan()
            pembayaran_id = $('#selectPembayaran').val()
                lihatMetode(pembayaran_id);
                if ($(this).find(':selected').data('bpjs')=="yes"){
                    $('#form-no-sep').show();
                    $('#selectRujukan').prop('disabled', false);
                    is_bpjs = 1;
                }
                else {
                    $('#form-no-sep').hide();
                    $('#selectRujukan').prop('disabled', false);
                    is_bpjs = 0;
                };
            });

        $("#total_bayar").html(`<span class="control-label font-w700" >`+totalBayar+`</span>`);

        $('.select-igd').on("select2:select", function(e) { 
            removeRujukan();
            if ($(this).attr('id') == 'selectIGDTriage') {
                $('#selectKasus').val($(this).val());
            }
        });
        setOpsiIGD();
        $('input[name="opsi_igd"]').change(function() {
            setOpsiIGD();
        })

        $('#helpPaket').popover();

        $('#selectNoRujukan').select2({
            "language": {
                "noResults": function(){
                    return "Nomor Rujukan Tidak Ditemukan. Ajukan SEP Baru? <button class='btn btn-primary' onclick='mintaSEP'>Pengajuan SEP</button>";
                }
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        });
    });

    function setOpsiIGD() {
        if ($('input[name="opsi_igd"]:checked').val() == 1) {
            $('.igd-ruang').hide();
            $('.igd-triage').show();
            $("#selectIGDRuang").val('').change();
        } else {
            $('.igd-ruang').show();
            $('.igd-triage').hide();
            $('#selectKasus').val(0);
            $("#selectIGDTriage").val('').change();
        }
    }

    function resetBPJSModalPreview(){
        $('#preview_bpjs_modal_diagnosis').text("-");
        $('#preview_bpjs_modal_pelayanan').text("-");
        $('#preview_bpjs_modal_perujuk').text("-");
        $('#preview_bpjs_modal_poli').text("-");
        $('#preview_bpjs_modal_keluhan').text("-");
        $('#preview_bpjs_modal_cob_nama').text("-");
        $('#preview_bpjs_modal_cob_nomor').text("-");
    }
</script>
@endsection

{{-- @extends('pasien.layouts.main')

@section('title')
Pasien - Halaman Konfirmasi
@endsection

@section('subtitle')
Halaman Konfirmasi
@endsection

@section('css')
<style type="text/css">
.block-content {
    padding-bottom: 18px;
}
</style>
@endsection

@section('content')
<main id="main-container">
    @include('pasien.layouts.navbar')
    <div class="container">
        <div class="row row-deck">
            <div class="col-sm-12">
                <div class="block rounded main-content transaction-index"  ng-controller="PasienController">
                    <div class="block-header">
                        <h3 class="block-title">Konfirmasi Mesin Antrian</h3>
                    </div>

                    <form style="margin-left: 50px; margin-top: 50px;" class="js-validation-be-contact" action="{{url("pasien/konfirmasi-antrian/konfirmasi")}}/{{$antrian->id}}" method="post">
                        {{ csrf_field() }}
                        <input type="text" hidden name="layanan" value="1">
                        <input type="text" hidden name="poliklinik_id" value="{{$antrian->poliklinik_id}}">
                        <input type="text" hidden name="kasus_id" value="0">
                        <input type="text" hidden name="dokter_poli" value="{{$antrian->dokter_id}}">
                        <input type="text" hidden name="antrian" value="{{$antrian->jumlah_antrian}}">
                        <input type="text" hidden name="dokter_jadwal" value="{{$jadwal->id}}">
                        <div class="form-group row">
                            <div class="col-8">
                                <label for="be-contact-name">Pembayaran Utama</label>
                                <select class="form-control" data-size="5" id="identitas-edit-asuransi" name="pembayaran_utama_id" style="width: 100%;" disabled >
                                    @foreach($metode as $item)
                                    <option value="{{$item->id}}"
                                        @if (isset($pasien))
                                            @if($item->id == $pasien->pembayaranUtama->id) selected="selected" @endif
                                        @endif
                                        data-type = "{{$item->perusahaan->tipe->slug}}"
                                        >
                                        {{$item->perusahaan->nama}} - {{$item->no_asuransi}}  - Kelas {{$item->kelas->nama}}
                                    </option>                                    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" id="tunai_from_wrapper" style="display: none">
                            <div class="col-8">
                                <div class="block content pb-20">
                                    <h4 class="mb-10" id="judul_pembayaran"></h4>
                                    <table class="table-borderless" style="width: 100%">
                                        <tr>
                                            <th width="140px">Nama Pasien</th>
                                            <td>:</td>
                                            <td>{{$pasien->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>No RM Pasien</th>
                                            <td>:</td>
                                            <td>{{$pasien->no_rm}}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td>:</td>
                                            <td>{{$pasien->jenis_kelamin}}</td>
                                        </tr>
                                        <tr>
                                            <th>Usia Pasien</th>
                                            <td>:</td>
                                            <td>{{$pasien->age}}</td>
                                        </tr>
                                        <tr>
                                            <th>Poliklinik</th>
                                            <td>:</td>
                                            <td>{{$antrian->poliklinik->name ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Dokter</th>
                                            <td>:</td>
                                            <td>{{$antrian->dokter->name ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Antrian</th>
                                            <td>:</td>
                                            <td>{{$antrian->jumlah_antrian ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Metode Bayar</th>
                                            <td>:</td>
                                            <td>{{$pasien->pembayaranUtama->jenis->nama ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Asuransi</th>
                                            <td>:</td>
                                            <td>{{$pasien->pembayaranUtama->no_asuransi ?? '-'}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="bpjs_from_wrapper" style="display: none">
                            <div class="col-8">
                                <div class="block content pb-20">
                                    <h4 class="mb-10">SEP BPJS</h4>
                                    <table class="table-borderless" style="width: 100%">
                                        <tr>
                                            <th width="140px">Nama Pasien</th>
                                            <td>:</td>
                                            <td>{{$pasien->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>No RM Pasien</th>
                                            <td>:</td>
                                            <td>{{$pasien->no_rm}}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td>:</td>
                                            <td>{{$pasien->jenis_kelamin}}</td>
                                        </tr>
                                        <tr>
                                            <th>Usia Pasien</th>
                                            <td>:</td>
                                            <td>{{$pasien->age}}</td>
                                        </tr>
                                        <tr>
                                            <th>Poliklinik</th>
                                            <td>:</td>
                                            <td>{{$antrian->poliklinik->name ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Dokter</th>
                                            <td>:</td>
                                            <td>{{$antrian->dokter->name ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Antrian</th>
                                            <td>:</td>
                                            <td>{{$antrian->jumlah_antrian ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Metode Bayar</th>
                                            <td>:</td>
                                            <td>{{$pasien->pembayaranUtama->jenis->nama ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Asuransi</th>
                                            <td>:</td>
                                            <td>{{$pasien->pembayaranUtama->no_asuransi ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Layanan</th>
                                            <td>:</td>
                                            @php $jenis_layanan = $pasien->kasusFirst->active_sep->jenis_pelayanan ?? '' @endphp
                                            <td> @if($jenis_layanan == 1) Rawat Inap @else Rawat Jalan @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor SEP</th>
                                            <td>:</td>
                                            @php $nomor_sep_aktif = $pasien->kasusFirst->active_sep->no_sep ?? '' @endphp
                                            <td>{{$nomor_sep_aktif ?? ''}}</td>
                                        </tr>
                                    </table>
                        
                                    <div class="py-20 row">
                                        <div class="form-group col-12 mb-0">
                                            <label>Pilih SEP</label>
                                        </div>
                                        <div class="form-group mb-0 col-12" id="sep_select_wrapper">
                                            <div class="input-group ">
                                                <select name="no_sep" class="form-control js-select2" id="sep_select" data-placeholder="Nomor SEP Pasien" style="width: 80%">
                                                    <option value=""></option>
                                                    @foreach($sep as $item)
                                                    @if(isset($item->no_sep))
                                                    <option value="{{json_encode($item)}}" @if(isset($nomor_sep_aktif) && $nomor_sep_aktif == $item->no_sep) selected="" @endif>
                                                        {{$item->no_sep}} - @if($item->jenis_pelayanan == 1) Rawat Inap @else Rawat Jalan @endif - {{indonesian_date($item->created_at)}}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-alt-primary" id="sep_select_refresh" data-tanggal-start="{{date('d-m-Y',strtotime("-3 months"))}}" data-tanggal-end="{{date('d-m-Y')}}" data-ppk="{{config('app.bpjs_ppk')}}">
                                                        <i class="fa fa-refresh"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-alt-primary" style="display: none;" id="sep_select_loading" disabled="">
                                                        <i class="fa fa-asterisk fa-spin"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12" id="sep_manual_wrapper">
                                        <div class="form-group input-group">
                                            <label class="css-control css-control-primary css-checkbox">
                                                <input type="checkbox" class="css-control-input" id="custom_sep_check">
                                                <span class="css-control-indicator"></span> Nomor SEP yang saya cari tidak terdaftar
                                            </label>
                                        </div>
                                        <div class="form-group"  id="sep_custom_wrapper" style="display: none;">
                                            <label>Nomor SEP</label>
                                            <input type="text" name="custom_sep" id="custom_sep" class="form-control" placeholder="Nomor SEP Pasien" value="{{$nomor_sep_aktif}}">
                                        </div>
                                    </div>
                                    <div class="col-12" style="display: none;" id="infoBPJSWrapper">
                                        <div class="form-group">
                                            <div class="block block-bordered">
                                                <div class="block-content">
                                                    <div id="infoBPJS" class="row">
                                                        <div class="col-12 mb-20">
                                                            <span class="font-w600 h3">
                                                                Data Penerbitan SEP <i class="fa fa-spin fa-asterisk text-info" id="data_sep_loading" style="display: none;"></i>
                                                            </span>
                                                        </div>
                                                        <div class="col-lg-4 col-12">
                                                            <div class="font-w600">Nomor SEP</div>                            
                                                        </div>
                                                        <div class="col-lg-8 col-12 mb-5" id="data_sep"></div>
                                                        <div class="col-lg-4 col-12">
                                                            <div class="font-w600">Nomor Rujukan</div>                            
                                                        </div>
                                                        <div class="col-lg-8 col-12 mb-5" id="data_sep_rujukan"></div>
                                                        <div class="col-lg-4 col-12">
                                                            <div class="font-w600">Jenis Pelayanan</div>
                                                        </div>
                                                        <div class="col-lg-8 col-12 mb-5" id="data_sep_jenis_pelayanan"></div>
                                                        <div class="col-lg-4 col-12">
                                                            <div class="font-w600">Poli</div>
                                                        </div>
                                                        <div class="col-lg-8 col-12 mb-5" id="data_sep_poli"></div>
                                                        <div class="col-lg-4 col-12">
                                                            <div class="font-w600">Poli Eksekutif</div>
                                                        </div>
                                                        <div class="col-lg-8 col-12 mb-5" id="data_sep_poli_eksekutif"></div>
                                                        <div class="col-lg-4 col-12">
                                                            <div class="font-w600">COB</div>
                                                        </div>
                                                        <div class="col-lg-8 col-12 mb-5" id="data_sep_cob"></div>
                                                        <div class="col-lg-4 col-12">
                                                            <div class="font-w600">Katarak</div>
                                                        </div>
                                                        <div class="col-lg-8 col-12 mb-5" id="data_sep_katarak"></div>
                                                        <div class="col-lg-4 col-12">
                                                            <div class="font-w600">Jaminan Laka</div>
                                                        </div>
                                                        <div class="col-lg-8 col-12 mb-5" id="data_sep_laka"></div>
                                                        <div class="col-lg-4 col-12">
                                                            <div class="font-w600">SEP Suplesi</div>
                                                        </div>
                                                        <div class="col-lg-8 col-12 mb-5" id="data_sep_suplesi_laka"></div>
                                                        <div class="col-lg-4 col-12">
                                                            <div class="font-w600">Tanggal Laka</div>
                                                        </div>
                                                        <div class="col-lg-8 col-12 mb-5" id="data_sep_tanggal_laka"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12" id="sep_create_wrapper">
                                        <button type="button" class="btn btn-info" id="sep_button_auto">
                                            <i class="fa fa-plus"></i> Buat SEP Otomatis
                                        </button>
                                        <button type="button" class="btn btn-outline-info" id="sep_button">
                                            <i class="fa fa-plus"></i> Buat SEP Manual
                                        </button>   
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <hr>
                        <div id="append-pembayaran-tambahan-container">
                        </div>
                        <div class="row urikkes-hide">
                            <div class="col-12">
                                <div class="row justify-content-center">
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                            <label class="control-label">Retribusi</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="css-control css-control-primary css-checkbox">
                                                <input type="checkbox" class="css-control-input" id="pasien_baru">
                                                <span class="css-control-indicator"></span> Pasien Baru (Rp 36,000)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="css-control css-control-primary css-checkbox">
                                                <input type="checkbox" class="css-control-input" id="is_kartu_baru">
                                                <span class="css-control-indicator"></span> Kartu RSAL (Rp 15,000)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="css-control css-control-primary css-checkbox">
                                                <input type="checkbox" class="css-control-input" id="karcis_poli">
                                                <span class="css-control-indicator"></span> Karcis Kontrol (Rp 9,000)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                            <span class="control-label font-w700">TOTAL TAGIHAN PEMBAYARAN : Rp </span><span id="total_bayar"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 ">
                                        <div class="form-group">                                                
                                            <input class="form-control" type="hidden" name="pasien_id" id="pasien_id" value="{{$pasien->id}}" />
                                        </div>
                                    </div>
                                </div>
                            </div>                             
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn-alt btn-click-animate btn-hero btn-primary min-width-175 pull-right">
                                    <i class="fa fa-send mr-5"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('js')
@include('pasien.halaman-konfirmasi.js.submit')
@include('pasien.halaman-konfirmasi.js.metode_pembayaran')
<script type="text/javascript">
    var totalBayar = 0;
    var clickPasienBaru = 0;
    var clickKartu = 0;
    var clickPoli = 0;
    var nomor_kartu = '';
    var valLayanan = 1;
    var is_bpjs = 1;
    var online_id = 0;
    @isset($online_id)
        online_id = '{{ $online_id }}';
    @endisset

    $('#selectPembayaran').on("select2:select", function(e) { 
            
        pembayaran_id = $('#selectPembayaran').val()
        lihatMetode(pembayaran_id);
        if ($(this).find(':selected').data('bpjs')=="yes"){
            $('#form-no-sep').show();
            $('#selectRujukan').prop('disabled', false);
            is_bpjs = 1;
        }
        else {
            $('#form-no-sep').hide();
            $('#selectRujukan').prop('disabled', false);
            is_bpjs = 0;
        };
    });
    checkJenisPerusahaan();
    function checkJenisPerusahaan()
    {
        var type_slug = $('#identitas-edit-asuransi').find(':selected').data('type');
        if(type_slug == 'bpjs')
        {
            $('#bpjs_from_wrapper').show()
            $('#bpjs_from_wrapper :input').attr("disabled", false);
        }
        else
        {
            $('#bpjs_from_wrapper').hide()
            $('#bpjs_from_wrapper :input').attr("disabled", true);
        }

        if (type_slug == 'tunai' || type_slug == 'asuransi' || type_slug == 'kerjasama') {
            $('#tunai_from_wrapper').show()
            $('#tunai_from_wrapper :input').attr("disabled", false);
            if (type_slug == 'tunai') {
                $('#judul_pembayaran').html('Pembayaran Tunai');
            }
            if (type_slug == 'asuransi') {
                $('#judul_pembayaran').html('Pembayaran Perusahaan Asuransi');
            }
            if (type_slug == 'kerjasama') {
                $('#judul_pembayaran').html('Pembayaran Perusahaan Kerjasama');
            }
        }else{
            $('#tunai_from_wrapper').hide()
            $('#tunai_from_wrapper :input').attr("disabled", true);
            $('#judul_pembayaran').html('');
        }
    }
    $('#identitas-edit-asuransi').change(function(){
        checkJenisPerusahaan();
    })

    $('#sep_select_refresh').on('click', function(){
        refreshSelectSEP()
	});

    function refreshSelectSEP(select_first_value = false){
        $('#infoBPJSWrapper').hide();
        $('#sep_select_refresh').hide();
        $('#sep_select_loading').show();
        var sep_select_first_value = '';
        var tanggal_start =  $('#sep_select_refresh').attr('data-tanggal-start');
        var tanggal_end =  $('#sep_select_refresh').attr('data-tanggal-end');
        var ppk = $('#sep_select_refresh').attr('data-ppk');
        $.ajax({
            type:'GET',
            url:"{{url('')}}/api/bpjs/monitoring/histori-pelayanan-peserta/get-data?tanggal_start="+tanggal_start+"&tanggal_end="+tanggal_end+"&no_bpjs="+nomor_kartu,
            dataType: 'json',
            success:function(data){
                $('#sep_select_refresh').show();
                $('#sep_select_loading').hide();
                $('#sep_select').empty();
                var option = [];
                option.push({
                    id : "",
                    text : ""});

                for (var i = 0; i < data.length; i++) {
                    var sep_ppk = data[i].noSep.substr(0,8);
                    if (data[i].jnsPelayanan == 1) jenis_pelayanan = 'Rawat Inap';
                    else jenis_pelayanan = 'Rawat Jalan';

                    if(data[i].jnsPelayanan == 2 && sep_ppk == ppk) {
                        data[i].no_sep = data[i].noSep;
                        data[i].no_rujukan = data[i].noRujukan;
                        data[i].jenis_pelayanan = data[i].jnsPelayanan;
                        var nilai = JSON.stringify(data[i]);
                        option.push({
                            id: nilai,
                            text: data[i].noSep + ' - ' + jenis_pelayanan + ' - ' + (data[i].poli ?? '')
                        });
                        if (i == 0) sep_select_first_value = nilai;
                    }
                }
                $('#sep_select').select2({
                    data : option
                })

                if(select_first_value) {
                    $('#sep_select').val(sep_select_first_value).trigger('change')
                    var sep = JSON.parse($('#sep_select').val());
                    preview_sep(sep);
                }
            },
            error:function(error){
                $('#sep_select_refresh').show();
                $('#sep_select_loading').hide();

            }
        });
    }

    $('#custom_sep_check').click(function() {
        if ($(this).is(':checked')) {
            $('#sep_custom_wrapper').show();
            $('.konfirmasiButton').attr("disabled", true);
            $('#sep_button').attr("disabled", true);
            $('#sep_select').attr("disabled", true);
            $('#sep_select').attr("readonly", true);
            $('#sep_select_refresh').attr("disabled", true);
        }else{
            $('#sep_custom_wrapper').hide();
            $('.konfirmasiButton').attr("disabled", false);
            $('#sep_button').attr("disabled", false);
            $('#sep_select').attr("disabled", false);
            $('#sep_select').attr("readonly", false);
            $('#sep_select_refresh').attr("disabled", false);
        }
    });

    $('#sep_select').on("select2:select", function(arg) {
		var sep = JSON.parse($('#sep_select').val());
        preview_sep(sep);
	});

    function preview_sep(sep) {
        $('#data_sep').text("-");
        $('#data_sep_rujukan').text("-");
        $('#data_sep_jenis_pelayanan').text("-");
        $('#data_sep_poli').text("-");
        $('#data_sep_poli_eksekutif').text("-");
        $('#data_sep_cob').text("-");
        $('#data_sep_katarak').text("-");
        $('#data_sep_laka').text("-");
        $('#data_sep_suplesi_laka').text("-");
        $('#data_sep_tanggal_laka').text("-");
        if(sep){
            console.log(sep);
            $('#data_sep').text( sep.no_sep || "-");
            $('#data_sep_rujukan').text( sep.no_rujukan || "Tidak Ada Rujukan");
            $('#data_sep_jenis_pelayanan').text((sep.jenis_pelayanan == 1) ? "Rawat Inap" : "Rawat Jalan");
            $('#data_sep_poli_eksekutif').text( sep.poli_eksekutif == 1 ? "Ya" : "Tidak" );
            $('#data_sep_cob').text( sep.cob == 1 ? "Ya" : "Tidak");
            $('#data_sep_katarak').text( sep.katarak == 1 ? "Ya" : "Tidak");
            if(sep.jaminan_lakalantas == 1){
                if(sep.penjamin_laka=="0" || sep.penjamin_laka == null || sep.penjamin_laka == 0){
                    $('#data_sep_laka').text("Tidak");
                }else{
                    var penjamin = sep.penjamin_laka.split(',');
                    var penjaminArr = ["PT Jasa Raharja", "BPJS Ketenagakerjaan", "PT Taspen", "PT Asabri"];
                    var penjaminStr = [];
                    for (var i = 0; i < penjamin.length; i++) {
                        penjaminStr.push(penjaminArr[penjamin[i] - 1]);
                    }
                    $('#data_sep_laka').text(penjaminStr.join(", "));
                }
                $('#data_sep_suplesi_laka').text(sep.no_suplesi == 0 ? "-" : sep.no_suplesi);
                $('#data_sep_tanggal_laka').text(sep.tgl_kejadian.split("-").reverse().join("-"));
            }
            $('#infoBPJSWrapper').show();
        }
    }

    $('#sep_button').on('click', function(e){
        popupwindow("{{url('')}}/bpjs/sep/create?window=true&pasien_id={{$pasien->id}}&pasien_name={{$pasien->name}}&rujukan={{$pasien->kasusFirst->active_sep->no_sep ??''}}", "Terbitkan SEP Baru", 900, 900);
    });

    $('#sep_button_auto').on('click', function(){
        var pembayaran_id='{{$pasien->pembayaranUtama->id}}'
        var pasien_id= '{{$pasien->id}}'
        
        var type_layanan = 'rawatjalan'
        var poli_id = '{{$antrian->poliklinik_id}}'
        var dokter_id = "{{$antrian->dokter_id ?? '0'}}"

        $('#sep_button_auto').prepend('<i class="fa fa-spinner fa-spin"></i>');    
        $('#sep_button_auto').attr('disabled', true);
        $.ajax({
            type: "GET",
            url: BASE_URL + "bpjs/auto-sep/generate/"+type_layanan+"/" + pasien_id + "/" + pembayaran_id + "/" + poli_id + "/" + dokter_id,
            contentType: false,
            dataType: 'json',
            success: function (resp) {
                if(resp.status == 200)
                {
                    callSwal('success','Sukses','Silahkan pilih SEP pada input nomor SEP','');
                    $('#sep_button_auto').find(".fa-spinner").remove();  
                    refreshSelectSEP(true)
                }
                else if(resp.status == 201)
                {
                    callSwal('error','Gagal',resp.message,'');
                    $('#sep_button_auto').removeAttr('disabled'); 
                    $('#sep_button_auto').find(".fa-spinner").remove();  
                }
                else
                {
                    callSwal('error','Gagal','Gagal kesalahan server tidak diketahui. Gunakan SEP Manual','');

                    $('#sep_button_auto').removeAttr('disabled')
                    $('#sep_button_auto').find(".fa-spinner").remove(); 
                }
            },
            error:function(error){    
                $('#sep_button_auto').removeAttr('disabled');
                $('#sep_button_auto').find(".fa-spinner").remove();  
                callSwal('error','Gagal','Silahkan coba lagi atau Gunakan SEP Manual','');
            }
        });

    });

    function add(jumlah)
    {
        totalBayar = totalBayar + jumlah;
    }
    function min(jumlah)
    {
        totalBayar = totalBayar - jumlah;
    }
    
    $('#pasien_baru').click(function() {
        if(clickPasienBaru == 1) 
        {
            clickPasienBaru = 0;
            min(36000);
            $("#total_bayar").html(`<span class="control-label font-w700" >`+totalBayar+`</span>`);
        }
        else {
            add(36000);
            clickPasienBaru =1 ;
            $("#total_bayar").html(`<span class="control-label font-w700" >`+totalBayar+`</span>`);
        }
    });

    $('#is_kartu_baru').click(function() {
        if(clickKartu == 1) 
        {
            min(15000);
            clickKartu = 0;
            $("#total_bayar").html(`<span class="control-label font-w700" >`+totalBayar+`</span>`);
        }
        else {
            add(15000);
            clickKartu =1 ;
            $("#total_bayar").html(`<span class="control-label font-w700" >`+totalBayar+`</span>`);
        }
    });

    $('#karcis_poli').click(function() {
        if(clickPoli == 1) 
        {
            clickPoli = 0;
            min(9000);
            $("#total_bayar").html(`<span class="control-label font-w700" >`+totalBayar+`</span>`);
        }
        else {
            add(9000);
            clickPoli =1 ;
            $("#total_bayar").html(`<span class="control-label font-w700" >`+totalBayar+`</span>`);
        }
    });
</script>
@endsection --}}