@extends('kasus.layouts.main')
@section('title')
{{$kasus->judul_kasus}} - Rekonsiliasi Obat - Kasus
@endsection

@section('content')
<main id="main-container">
    @include('kasus.layouts.header')
    <div class="content">
        <div class="row">
            @include('kasus.layouts.sidebar')

            <!-- Updates -->
            <div class="col-lg-4 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="block rounded p-0">
                            <div class="block-content px-20">
                                <h4>Edit Pembayaran Pasien</h4>
                                <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/identitas/pembayaran/update" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <div class="col-8">
                                            <label for="be-contact-name">Pembayaran Utama</label>
                                            <select class="form-control" data-size="5" id="identitas-edit-asuransi" name="pembayaran_utama_id" style="width: 100%;">
                                                @foreach($metode as $item)
                                                <option value="{{$item->id}}" 
                                                    @if($item->id == $kasus->pasien_pembayaran_id) selected="selected" @endif
                                                    data-type = "{{$item->perusahaan->tipe->slug}}"
                                                    >
                                                    {{$item->perusahaan->nama}} - {{$item->no_asuransi}}  - Kelas {{$item->kelas->nama}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @include('kasus.datamedis.content.identitas.pembayaran.update-components-bpjs')
                                    <hr>
                                    <h5 class="mb-0">Pembayaran Tambahan</h5>
                                    <p>Digunakan jika pasien melakukan IUR, naik kelas, atau pihak penjamin utama <br>tidak dapat memenuhi seluruh tagihan pasien.</p>

                                    @if(count($kasus->pembayaranTambahan) > 0)
                                    @foreach($kasus->pembayaranTambahan as $item)
                                    @include('kasus.datamedis.content.identitas.components.select-edit-pembayaran-tambahan',['active_select_pembayaran_tambahan' => $item->pasien_pembayaran_id])
                                    @endforeach
                                    @else
                                    @include('kasus.datamedis.content.identitas.components.select-edit-pembayaran-tambahan',['active_select_pembayaran_tambahan' => 0])
                                    @endif
                                    <div id="append-pembayaran-tambahan-container">
                                    </div>
                                    <div class="row">
                                        <div class="col-10 text-center mt-20">
                                            <button type="button" class="btn btn-primary btn-circle" id="btn-add-edit-pembayaran-tambahan"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <hr>
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
            </div>
        </div>
    </div>
</main>
@endsection


@section('js')
<script type="text/javascript">
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
    }
    $('#identitas-edit-asuransi').change(function(){
        checkJenisPerusahaan();
    })
    
    $('#sep_select_refresh').click(function(){
        $('#sep_select_refresh').hide();
        $('#sep_select_loading').show();
        $.ajax({
            type:'GET',
            url:BASE_URL + 'bpjs/sep/search-pasien/'+{{$kasus->pasien->id}},
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
                    var text = data[i].no_sep
                    if(data[i].jenis_pelayanan == 1) text += ' - Rawat Inap'
                        else text += ' - Rawat Jalan'

                            text += ' - ' + moment(data[i].created_at).format('DD MMMM YYYY');
                        var nilai = JSON.stringify(data[i]);
                        option.push({
                            id : nilai,
                            text :  text
                        });
                    }
                    $('#sep_select').select2({
                        data : option
                    })
                },
                error:function(error){
                    $('#sep_select_refresh').show();
                    $('#sep_select_loading').hide();

                }
            });
    });

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

    $('#sep_button').on('click', function(e){
        popupwindow("{{url('')}}/bpjs/sep/create?window=true&pasien_id={{$kasus->pasien->id}}&pasien_name={{$kasus->pasien->name}}&rujukan={{$kasus->active_sep->no_sep ??''}}", "Terbitkan SEP Baru", 900, 900);
    });

    $('#sep_button_auto').on('click', function(){
        var pembayaran_id='{{$kasus->pembayaran->id}}'
        var pasien_id= '{{$kasus->pasien->id}}'
        @if($kasus->lokasi->lokasi->lokasi_departemen_id == 2)
        var type_layanan = 'rawatjalan'
        var poli_id = '{{$kasus->lokasi->lokasi->poliklinik->id}}'
        @else
        var type_layanan = 'rawatinap'
        var poli_id = ''
        @endif

        $('#sep_button_auto').prepend('<i class="fa fa-spinner fa-spin"></i>');    
        $('#sep_button_auto').attr('disabled', true);
        $.ajax({
            type: "GET",
            url: BASE_URL + "bpjs/auto-sep/generate/"+type_layanan+"/" + pasien_id + "/" + pembayaran_id + "/" + poli_id ,
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

    function refreshSelectSEP(select_first_value = false){
        $('#infoBPJSWrapper').hide();
        $('#sep_select_refresh').hide();
        $('#sep_select_loading').show();
        var sep_select_first_value = '';
        var pasien_id= '{{$kasus->pasien->id}}'
        $.ajax({
            type:'GET',
            url:BASE_URL + 'bpjs/sep/search-pasien/'+pasien_id,
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
                    var nilai = JSON.stringify(data[i]);
                    var text = data[i].no_sep
                    if(data[i].jenis_pelayanan == 1) text += ' - Rawat Inap'
                    else text += ' - Rawat Jalan'
                    text += ' - ' + moment(data[i].created_at).format('DD MMMM YYYY');

                    option.push({
                        id : nilai,
                        text :  text
                    });
                    if(i == 0) sep_select_first_value = nilai;
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

</script>
<script type="text/javascript">
    $('#btn-add-edit-pembayaran-tambahan').click(function(){
        content = `@include('kasus.datamedis.content.identitas.components.select-edit-pembayaran-tambahan',['active_select_pembayaran_tambahan' => 0])`
        $('#append-pembayaran-tambahan-container').append(content)
    })
    $(document).on("click", ".btn-delete-edit-pembayaran-pembayaran", function(){ 
        $(this).parent().parent().remove();
    })
</script>

@endsection

