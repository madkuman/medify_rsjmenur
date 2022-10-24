@extends('pasien.layouts.main')

@section('title')
Pasien - Update Daftar Online
@endsection

@section('subtitle')
Update Daftar Pasien Online
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
                        <h3 class="block-title">Update Daftar Pasien Online</h3>
                    </div>
                    <form style="margin-left: 50px; margin-top: 50px;" class="js-validation-be-contact" action="{{url("pasien/daftar-online/update")}}/{{$transaksi->id}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-8">
                                <label for="be-contact-name">Pembayaran Utama</label>
                                <select class="form-control" data-size="5" id="identitas-edit-asuransi" name="pembayaran_utama_id" style="width: 100%;" disabled >
                                    @foreach($metode as $item)
                                    <option value="{{$item->id}}"
                                        @if (isset($transaksi))
                                            @if($item->id == $transaksi->pasien_pembayaran_id) selected="selected" @endif
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
                                            <td>{{$transaksi->pasien->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>No RM Pasien</th>
                                            <td>:</td>
                                            <td>{{$transaksi->pasien->no_rm}}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td>:</td>
                                            <td>{{$transaksi->pasien->jenis_kelamin}}</td>
                                        </tr>
                                        <tr>
                                            <th>Usia Pasien</th>
                                            <td>:</td>
                                            <td>{{$transaksi->pasien->age}}</td>
                                        </tr>
                                        <tr>
                                            <th>Poliklinik</th>
                                            <td>:</td>
                                            <td>{{$transaksi->poliklinik->name ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Dokter</th>
                                            <td>:</td>
                                            <td>{{$transaksi->dokter->name ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Antrian</th>
                                            <td>:</td>
                                            <td>{{$transaksi->nomor_antrian ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Jam Pendaftaran</th>
                                            <td>:</td>
                                            <td>{{date('H:i', strtotime($transaksi->waktu_masuk)) ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Metode Bayar</th>
                                            <td>:</td>
                                            <td>{{$transaksi->pasien_pembayaran->perusahaan->nama ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Asuransi</th>
                                            <td>:</td>
                                            <td>{{$transaksi->pasien_pembayaran->no_asuransi ?? '-'}}</td>
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
                                            <td>{{$transaksi->pasien->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>No RM Pasien</th>
                                            <td>:</td>
                                            <td>{{$transaksi->pasien->no_rm}}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td>:</td>
                                            <td>{{$transaksi->pasien->jenis_kelamin}}</td>
                                        </tr>
                                        <tr>
                                            <th>Usia Pasien</th>
                                            <td>:</td>
                                            <td>{{$transaksi->pasien->age}}</td>
                                        </tr>
                                        <tr>
                                            <th>Poliklinik</th>
                                            <td>:</td>
                                            <td>{{$transaksi->poliklinik->name ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Dokter</th>
                                            <td>:</td>
                                            <td>{{$transaksi->dokter->name ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Antrian</th>
                                            <td>:</td>
                                            <td>{{$transaksi->nomor_antrian ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Jam Pendaftaran</th>
                                            <td>:</td>
                                            <td>{{date('H:i', strtotime($transaksi->waktu_masuk)) ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Metode Bayar</th>
                                            <td>:</td>
                                            <td>{{$transaksi->pasien_pembayaran->perusahaan->nama ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Asuransi</th>
                                            <td>:</td>
                                            <td>{{$transaksi->pasien_pembayaran->no_asuransi ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Layanan</th>
                                            <td>:</td>
                                            @php $jenis_layanan = $transaksi->kasus->active_sep->jenis_pelayanan ?? '' @endphp
                                            <td> @if($jenis_layanan == 1) Rawat Inap @else Rawat Jalan @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor SEP</th>
                                            <td>:</td>
                                            @php $nomor_sep_aktif = $transaksi->kasus->active_sep->no_sep ?? '' @endphp
                                            <td>{{$nomor_sep_aktif ?? ''}}</td>
                                        </tr>
                                    </table>
                        
                                    <div class="py-20 row">
                                        <div class="form-group col-12 mb-0">
                                            <label>Pilih SEP</label>
                                        </div>
                                        <div class="form-group mb-0 col-12" id="sep_select_wrapper">
                                            <div class="input-group ">
                                                <select name="sep" class="form-control js-select2" id="sep_select" data-placeholder="Nomor SEP Pasien" style="width: 80%">
                                                    <option value=""></option>
                                                    @foreach($sep as $item)
                                                    @if(isset($item->no_sep))
                                                    <option value="{{$item->no_sep}}" @if(isset($nomor_sep_aktif) && $nomor_sep_aktif == $item->no_sep) selected="" @endif>
                                                        {{$item->no_sep}} - @if($item->jenis_pelayanan == 1) Rawat Inap @else Rawat Jalan @endif - {{!is_null($item->tgl_sep) ? indonesian_date(strtotime($item->tgl_sep)) : indonesian_date($item->created_at)}}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-alt-primary" id="sep_select_refresh">
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

    $('#sep_select_refresh').click(function(){
        $('#sep_select_refresh').hide();
        $('#sep_select_loading').show();
        $.ajax({
            type:'GET',
            url:BASE_URL + 'bpjs/sep/search-pasien/'+{{$transaksi->pasien->id}},
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
        popupwindow("{{url('')}}/bpjs/sep/create?window=true&pasien_id={{$transaksi->pasien->id}}&pasien_name={{$transaksi->pasien->name}}&rujukan={{$transaksi->kasus->active_sep->no_sep ??''}}", "Terbitkan SEP Baru", 900, 900);
    });

    $('#sep_button_auto').on('click', function(){
        var pembayaran_id='{{$transaksi->pasien_pembayaran->id}}'
        var pasien_id= '{{$transaksi->pasien->id}}'
        
        var type_layanan = 'rawatjalan'
        var poli_id = '{{$transaksi->poliklinik->id}}'
        var dokter_id = "{{$transaksi->dokter_id ?? '0'}}"

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
</script>
@endsection