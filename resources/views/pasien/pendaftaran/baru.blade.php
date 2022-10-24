@extends('pasien.layouts.main')

@section('title')
Pasien - Medify
@endsection

@section('subtitle')
Pendaftaran Pelayanan
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
                    <div class="block rounded" id="dataJenis">
                        <div class="block-content">
                            <h5 class="uppercase">Form Pendaftaran Layanan 
                                <hr>
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    @include('pasien.pendaftaran.content.layanan-utama')
                                    <hr>
                                    @include('pasien.pendaftaran.content.pilih-poli')
                                    @include('pasien.pendaftaran.content.pilih-igd')
                                    @include('pasien.pendaftaran.content.pilih-urikkes')
                                    {{-- <hr>
                                    @include('pasien.pendaftaran.content.pilih-dokter')
                                    <hr> --}}
                                    @include('pasien.pendaftaran.content.metode-bayar')
                                    <hr>
                                    @include('pasien.pendaftaran.content.retribusi')
                                </div>
                                <div class="col-md-6">
                                    @include('pasien.pendaftaran.content.my-rujuk-poli')
                                </div>
                            </div>
                        </div>
                        <div class="py-10 text-center font-w600 bg-danger text-white mb-20 align-middle" id="error-wrapper" style="display: none;">
                            <i class="fa fa-exclamation-circle mr-5"></i>
                            <span></span>
                        </div>
                        <input type="hidden" id="cek-pesanan-duplicate" value="0">
                        <div class="col-12">
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
    var pasien_id = {{$identitas->id}};
    var new_sep_url = "{{url('')}}/bpjs/sep/create?window=true&pasien_id={{$identitas->id}}&pasien_name={{$identitas->name}}";
    var dokter = "{{$dokter_id}}";
    var mesin_antrian_id = "{{ $mesin_antrian->id ?? '0' }}";
    var mesin_antrian_poli_id = "{{ $mesin_antrian->poliklinik_id ?? '0' }}";
    console.log(mesin_antrian_id,dokter)
    var mesin_antrian_data = @json($mesin_antrian ?? null, JSON_PRETTY_PRINT);
</script>

@include('pasien.pendaftaran.js.metode_pembayaran')
@include('pasien.pendaftaran.js.rujukan_bpjs')
@include('pasien.pendaftaran.js.permintaan_rujuk')
@include('pasien.pendaftaran.js.pilih_pelayanan')
@include('pasien.pendaftaran.js.retribusi')
@include('pasien.pendaftaran.js.submit_bpjs')
@include('pasien.pendaftaran.js.submit')
@include('pasien.pendaftaran.js.bpjs_window')
@include('pasien.pendaftaran.js.urikkes')
{{-- @include('pasien.pendaftaran.js.pilih-dokter') --}}

<script type="text/javascript">

    changeDaftar(valLayanan);

    $('#select').select2();
    $('.js-select2').select2();
    $('#selectPoli').select2();
    $('#selectPaket').select2({
        placeholder: "Pilih Paket", 
    });
    $('#selectIGD').select2();
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

    $(document).ready(function() {
        getPropinsi();
        $('#selectPoli').on("select2:select", function(e) { 
            removeRujukan();

            id = $('#selectPoli').val()
                if(id != null)
                {   
                    $('#check-pesanan-duplicate').val(0);
                    lihatRuang(id)
                    cekHistoriPoli(id)
                    // getDokter(id)
                }
            });
        if ($('#selectPoli').select2().val() != 0) {
            removeRujukan();

            id = $('#selectPoli').val();
            if(id != null)
            {   
                $('#check-pesanan-duplicate').val(0);
                lihatRuang(id)
                cekHistoriPoli(id)
            }
        }

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
                }
                checkKelas()
            });

        $("#total_bayar").html(`<span class="control-label font-w700" >`+totalBayar+`</span>`);

        $('#selectIGD').on("select2:select", function(e) { 
            removeRujukan();
        });

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

    $('.asal-rujukan-select').select2({
            tags:true,
            placeholder: 'Masukkan Nomor Rujukan',
            minimumInputLength:2,
            ajax: {
                type: "POST",
                url: `${API_URL}/pasien/asal-rujukan`,
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    // console.log(data.data)
                    return {
                        results:  $.map(data.data, function (item) {
                            // console.log('item', item)
                            return {
                                text: item.nama,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        })
    });

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