@extends('layouts.main-dashboard')

@section('title')
Admin - Buat Dokter
@endsection

@section('css')

@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<!-- Page Content -->
<div class="content" style="margin-top:50px;">
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Buat Dokter Baru</h3>
        </div>
        <div class="block-content container">
            <form method="POST" id="form-dokter">
                {{csrf_field()}}
                <div class="row justify-content-start">
                    <div class="col-6">
                        <h5 class="py-10 mb-10 border-b">Data Dokter</h5>
                        <div class="form-group row">
                            <div class="col-12 col-md-9">
                                <label>Nama</label>
                                <input type="text" id="name" name="name" class="form-control" style="width: 100%;" placeholder="Deskripsi Dokter" required="" value="{{$dokter->name}}">
                            </div>
                            <div class="col-12 col-md-3">
                                <label>Kode Dokter</label>
                                <input type="text" id="kode_dokter" name="kode_dokter" class="js-maxlength form-control" style="width: 100%;" placeholder="Maksimal 3 Digit" maxlength="3" required="" value="{{$dokter->kode_dokter}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <label>Kuota Pasien Offline Harian</label>
                                <input type="number" name="kuota_offline" class="form-control kuota" placeholder="Batas Pasien Harian" required="" value="{{$dokter->kuota_offline}}" {{is_null($dokter->kuota_offline) ? 'disabled' : ''}}>
                            </div>
                            <div class="col-12 col-md-3 pt-30">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" name="unlimited_offline" class="css-control-input unlimited" value="1" {{is_null($dokter->kuota_offline) ? 'checked' : ''}}>
                                    <span class="css-control-indicator"></span> Unlimited
                                </label>
                            </div>
                        </div>
                        @if(config('app.bpjs_enable'))
                        <hr>
                        <h5>Data Dokter BPJS</h5>
                        <div class="form-group">
                            <label>Spesialisasi<i class="fa fa-spinner fa-spin" id="spesialisasiLoading"></i></label>
                            <div>
                                <select class="js-select2 form-control" id="selectSpesialisBpjs" name="bpjs_spesialis">
                                    @if(!empty($dokter->bpjs_spesialis_text) && !empty($dokter->bpjs_spesialis))
                                    <option value="{{$dokter->bpjs_spesialis}}" selected>{{$dokter->bpjs_spesialis_text}}</option>
                                    @endif
                                </select>
                                <input type="hidden" id="inputBpjsSpesialisText" name="bpjs_spesialis_text" value="{{$dokter->bpjs_spesialis_text}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Poli BPJS</label>
                            <select class="js-select2 form-control" id="selectPoliBPJS" name="bpjs_poli">
                                @if(!empty($dokter->bpjs_poli_text) && !empty($dokter->bpjs_poli))
                                <option value="{{$dokter->bpjs_poli}}" selected>{{$dokter->bpjs_poli_text}}</option>
                                @endif
                            </select>
                            <input type="hidden" id="inputBpjsPoliText" name="bpjs_poli_text"  value="{{$dokter->bpjs_poli_text}}">
                            <small>Cari nama poli BPJS</small>
                        </div>

                        <div class="form-group">
                            <label>Kode DPJP
                                <span id="loader"><i class="fa fa-spinner fa-spin"></i></span>
                            </label>
                            <select class="js-select2 form-control" id="selectDokterBPJS" name="bpjs_kode_dpjp">
                                @if(!empty($dokter->bpjs_kode_dpjp_text) && !empty($dokter->bpjs_kode_dpjp))
                                <option value="{{$dokter->bpjs_kode_dpjp}}" selected>{{$dokter->bpjs_kode_dpjp_text}}</option>
                                @endif
                            </select>
                            <input type="hidden" id="inputBpjsDpjpText" name="bpjs_kode_dpjp_text" value="{{$dokter->bpjs_kode_dpjp_text}}">
                            <small>Cari nama dokter</small>
                        </div>

                        <div class="form-group">
                            <div id="dpjpError201" style="display:none">
                                <h4 class="mb-5">Whoops!</h4>
                                Data dokter DPJP tidak ditemukan. Coba gunakan pilihan lain
                            </div>
                            <div id="dpjpError"  style="display: none;">
                                <h4 class="mb-5">Whoops!</h4>
                                Data terjadi kesalahan. Silahkan coba lagi. Jika sering terjadi error ini coba hubungi admin.
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-6">
                        <h5 class="py-10 mb-10 border-b">Jadwal Praktek Dokter
                            <i class="fa fa-spinner fa-spin ml-10 d-none" id="jadwal_praktek_loading"></i>
                            <a class="btn btn-sm btn-circle btn-outline-primary position-absolute" id="btn_add_jadwal" style="top:7px;right:30px" href="javascript:void(0)">
                                <i class="fa fa-plus"></i>
                            </a>
                        </h5>
                        <p class="text-center" id="jadwal_praktek_empty">Dokter belum memiliki jadwal praktek</p>
                        <div class="mt-20 d-none" id="jadwal_praktek_content">
                        </div>
                    </div>
                </div>
                <hr>
                <button class="btn btn-primary" type="button" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>
@include('admin.dokter.components.modal-jadwal')
@endsection

@section('js')
<script type="text/javascript">
    $('#selectPoliBPJS').select2({
        ajax: {
            url: API_URL+'/bpjs/referensi/poli',
            data: function(params){
                return {
                    poli: params.term, 
                };
            },
            processResults: function (data, params) {
                var  res = JSON.parse(data);
                var results = [];
                if(res.metaData.code == 200){
                    results = res.response.poli;
                }
                return {
                    results: $.map(results, function(obj) {
                        return { id: obj.kode, text: obj.nama };
                    })
                };
            },
            cache: true
        }
    });

    $.ajax({
        type: "POST",
        url: API_URL + '/getting-started/bpjs/referensi/spesialis',
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data.response.list.length != 0)
            {
                $.each(data.response.list, function(key, value){
                    $('#selectSpesialisBpjs').append('<option value="'+value.kode+'">'+value.nama+'</option>');
                });
            }
            $('#spesialisasiLoading').hide();
        }
    });

    $('#selectSpesialisBpjs').on('change', function(){
        getDPJPList();
        var data = $('#selectSpesialisBpjs').select2('data')
        $('#inputBpjsSpesialisText').val(data[0].text);
    });

    $('#selectDokterBPJS').on('change', function(){
        var data = $('#selectDokterBPJS').select2('data')
        $('#inputBpjsDpjpText').val(data[0].text);
    });

    $('#selectPoliBPJS').on('change', function(){
        var data = $('#selectPoliBPJS').select2('data')
        $('#inputBpjsPoliText').val(data[0].text);
    });


    $('#loader').hide();
    function getDPJPList() {
        var specialty = $('#selectSpesialisBpjs').val();

        $.ajax({
            url: API_URL + '/getting-started/bpjs/referensi/dpjp/1/'+specialty,
            type: "GET",
            dataType: "json",
            beforeSend: function(){
                $('#loader').show();
                $('#form-dpjp').hide();
                $('#dpjpError').hide();
                $('#dpjpError201').hide();
            },
            success: function(data){
                $('#selectDokterBPJS').empty();
                if (data.metaData.code == 200 && data.response.list.length != 0)
                {
                    $('#selectDokterBPJS').append('<option value="">Pilih DPJP</option>');
                    $.each(data.response.list, function(key, value){
                        $('#selectDokterBPJS').append('<option value="'+value.kode+'">'+value.nama+'</option>');
                    });
                    $('#form-dpjp').show();
                    $('#loader').hide()
                    $('#dpjpError201').hide();
                    $('#dpjpError').hide();
                    $('#inputBpjsDpjpText').val('');
                }
                else if(data.metaData.code == 201)
                {
                    $('#dpjpError').hide();
                    $('#dpjpError201').show();
                    $('#form-dpjp').hide();
                    $('#loader').hide()
                }
                else
                {
                    $('#dpjpError').show();
                    $('#dpjpError201').hide();
                    $('#form-dpjp').hide();
                    $('#loader').hide()
                }
            },
            complete: function(){
            }
        });
    }

    dokter_id = "{{Request::segment(4)}}";
    if (dokter_id == '') $('#btn_add_jadwal').addClass('disabled');
    else $('#btn_add_jadwal').removeClass('disabled');
    $.ajax({
        type: "GET",
        url: API_URL + '/rawatjalan/dokter/jadwal/get',
        dataType: "json",
        data: {dokter_id: dokter_id},
        beforeSend: function() {
            $('#jadwal_praktek_loading').removeClass('d-none');
            $('#jadwal_praktek_content').addClass('d-none');
            $('#jadwal_praktek_content').empty();
            $('#jadwal_praktek_empty').removeClass('d-none');
        },
        success: function (data) {
            $(data).each(function(index, item) {
                time_start = item.jam_buka.substring(0, item.jam_buka.length - 3);
                time_end = item.jam_tutup.substring(0, item.jam_tutup.length - 3);
                addJadwal(item.poliklinik_id, item.nama_poli, item.hari_order, item.hari, time_start, time_end, item.id,0,item.is_video)
            });
            $('#jadwal_praktek_loading').addClass('d-none');
            if (data.length > 0) {
                $('#jadwal_praktek_empty').addClass('d-none');
                $('#jadwal_praktek_content').removeClass('d-none');
            }
        }
    });
</script>
@include('admin.dokter.components.js-jadwal')
@endsection