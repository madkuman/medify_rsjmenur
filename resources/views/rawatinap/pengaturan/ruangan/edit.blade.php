@extends('rawatinap.layouts.main')

@section('title')
Edit ruangan {{$ruangan->nama}} - Rawat Inap - Medify
@endsection

@section('subtitle')
Pengaturan - Edit ruangan {{$ruangan->nama}}
@endsection

@section('content')

<main id="main-container">
    @include('rawatinap.layouts.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block pb-100">
                    <div class="block-content block-content text-left">
                        <button class="btn btn-danger pull-right" onclick="swalDelete({{$ruangan->id}})"><i class="fa fa-trash"></i> Hapus </button>

                        <h4>Edit Ruangan</h4>
                        <a href="{{url('rawatinap/pengaturan/bangsal/')}}/{{$ruangan->bangsal_id}}">Kembali ke bangsal</a>
                        <hr>
                        <form method="POST" action="{{url('rawatinap/pengaturan/ruangan/edit')}}" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label >Nama Ruangan</label>
                                    <input type="text" class="form-control" name="name" placeholder=".." value="{{$ruangan->nama}}" required>
                                    <input type="hidden" class="form-control" name="ruangan_id" placeholder=".." value="{{$ruangan->id}}">
                                </div>
                                <div class="form-group">
                                    <label>Jenis Tarif</label>
                                    <select class="js-select2 form-control requireForm" id="tipeLayanan" name="tarif_id" style="width: 100%;" data-placeholder="Choose one..">
                                        <option disabled="" hidden="" selected="">Pilih Jenis Tarif</option>
                                        @foreach($tarif as $row)
                                        <option value="{{$row->id}}" @if($ruangan->tarif_id == $row->id) selected @endif>
                                            {{$row->master->deskripsi ?? '-'}} - Kelas {{$row->kelas->nama ?? '-'}} | Rp {{number_format($row->harga,0)}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger teksWarning" id="tipeWarn" style="display: none; margin-bottom: 8px;"></p>
                                </div>
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select class="js-select2 form-control" name="kelas" style="width: 100%;" data-placeholder="Choose one.." required id="kelas_ruangan">
                                        @foreach($kelas as $item)
                                            @if($ruangan->kelas == $item->id)
                                                <option value="{{$item->id}}" selected="" data-tarif-kelas="{{$item->tarif_kelas}}">{{$item->nama}}</option>
                                            @else
                                                <option value="{{$item->id}}" data-tarif-kelas="{{$item->tarif_kelas}}">{{$item->nama}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @if(config('app.bpjs_enable'))
                                <div class="form-group">
                                    <label>Kelas/Tipe Bangsal <i class="fa fa-asterisk fa-spin text-info" id="loading_kelas"></i></label>
                                    <select class="js-select2 form-control requireForm" id="kelas-applicare" name="kelas_applicare" style="width: 100%;" data-placeholder="Pilih Kelas/Tipe Bangsal"  value="{{$ruangan->kelas_applicare}}" @if($ruangan->kelas_applicare)disabled="" @endif>
                                        <option></option>
                                    </select>
                                    <p class="text-danger teksWarning" id="kelasWarn" style="display: none; margin-bottom: 8px;"></p>
                                </div>
                                @endif

                                <div class="form-group">
                                    <label>SIRS COVID 19 - Tipe Ruangan<i class="fa fa-asterisk fa-spin text-info" id="loading_kelas_sirs_covid_19"></i></label>
                                    <select class="js-select2 form-control" id="sirs-covid-19-tipe-ruangan" name="sirs_covid_19_tt_id" style="width: 100%;" data-placeholder="Pilih Tipe Ruangan"  value="{{$ruangan->sirs_covid_19_tt_id}}">
                                        <option></option>
                                    </select>
                                    <p class="text-danger teksWarning" id="kelasWarn" style="display: none; margin-bottom: 8px;"></p>
                                </div>

                                <div class="form-group">
                                    <label>SIRANAP - Tipe Ruangan </label>
                                    <select class="js-select2 form-control" 
                                    name="siranap_kode_ruang_kode" style="width: 100%;" data-placeholder="Pilih Tipe Ruangan" >
                                        <option>Tidak Dikoneksikan</option>
                                        @foreach($siranap_master_kode_ruang as $item)
                                        <option value="{{$item->kode}}" @if($item->kode == $ruangan->siranap_kode_ruang_kode) selected @endif>{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>SIRANAP - Tipe Pasien </label>
                                    <select class="js-select2 form-control" 
                                    name="siranap_tipe_pasien_kode" style="width: 100%;" data-placeholder="Pilih Tipe Pasien" >
                                        <option>Tidak Dikoneksikan</option>
                                        @foreach($siranap_master_tipe_pasien as $item)
                                        <option value="{{$item->kode}}" @if($item->kode == $ruangan->siranap_tipe_pasien_kode) selected @endif>{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5">
                                        <input class="custom-control-input" type="checkbox" name="intensif" id="example-inline-checkbox1" value="1" @if($ruangan->intensif==1) checked @endif>
                                        <label class="custom-control-label" for="example-inline-checkbox1">Ruang Intensif</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5">
                                        <input class="custom-control-input" type="checkbox" name="bayi" 
                                        id="example-inline-checkbox2" value="1" @if($ruangan->bayi==1) checked @endif>
                                        <label class="custom-control-label" for="example-inline-checkbox2">Ruang Bayi</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="mb-3">Pengaturan Perhitungan Statistik</label><br>
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" name="is_hitung_statistik" id="example-inline-radio1" 
                                        value="" checked>
                                        <label class="custom-control-label" for="example-inline-radio1">Abaikan <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom"   data-container="body" title="Tidak merubah pengaturan dalam tempat tidur"></i></label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" name="is_hitung_statistik" id="example-inline-radio2" 
                                        value="1">
                                        <label class="custom-control-label" for="example-inline-radio2">Dihitung</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" name="is_hitung_statistik" id="example-inline-radio3" 
                                        value="0">
                                        <label class="custom-control-label" for="example-inline-radio3">Tidak dihitung</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Biaya Lain </label>
                                     <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="bottom"   data-container="body" title="Tarif lain adalah tarif-tarif diluar tarif sewa kamar yang dikenakan dan ditagihkan kepada pasien secara otomatis setiap harinya">
                                            <i class="fa fa-question-circle"></i>
                                        </button>
                                    <div class="row" id="tarif_lain_wrapper">
                                        @forelse($ruangan->tarif_lain as $tarif)
                                        <input type="text" name="tarif_lain[]" hidden="" value="{{$tarif->tarif->id}}">
                                        <div class="col-6" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                            {{$tarif->tarif->master->deskripsi ?? '-'}}
                                        </div>
                                        <div class="col-3">Rp {{number_format($tarif->tarif->harga,0)}}</div>
                                        <div class="col-3">Kelas {{$tarif->tarif->kelas->nama ?? '-'}}</div>
                                        @empty
                                        <div class="col-12">
                                            Tidak ada biaya tambahan lain.
                                        </div>
                                        @endforelse
                                    </div>
                                    <div class="col-12 text-center mt-20">
                                        <button type="button" class="btn btn-rounded btn-primary min-width-125 mb-10" data-toggle="modal" data-target="#modal_tarif">
                                            <i class="fa fa-plus"></i> Tambahkan Biaya Lain
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Dokter Umum</label>
                                    <select class="js-select2 form-control" name="tarif_dokter[]" style="width: 100%;"required>
                                        <option value="" selected="" disabled="">Pilih Tarif</option>
                                        @foreach($tarif_visite as $item)
                                            <option value="{{$item->id}}" @if(!empty($tarif_visite_ruangan[0]))
                                            @php $tarif_visite_id = $tarif_visite_ruangan[0]->tarif->master->id ?? '-' @endphp
                                            @if($tarif_visite_id == $item->id) selected @endif @endif>{{$item->deskripsi}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Dokter Spesialis</label>
                                    <select class="js-select2 form-control" name="tarif_dokter[]" style="width: 100%;"required>
                                        <option value="" selected="" disabled="">Pilih Tarif</option>
                                        @foreach($tarif_visite as $item)
                                            <option value="{{$item->id}}" @if(!empty($tarif_visite_ruangan[1])) 
                                            @php $tarif_visite_id = $tarif_visite_ruangan[1]->tarif->master->id ?? '-' @endphp
                                            @if($tarif_visite_id == $item->id) selected @endif 
                                            @endif>{{$item->deskripsi}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Dokter Subspesialis</label>
                                    <select class="js-select2 form-control" name="tarif_dokter[]" style="width: 100%;"required>
                                        <option value="" selected="" disabled="">Pilih Tarif</option>
                                        @foreach($tarif_visite as $item)
                                            <option value="{{$item->id}}" @if(!empty($tarif_visite_ruangan[2])) 
                                            @php $tarif_visite_id = $tarif_visite_ruangan[2]->tarif->master->id ?? '-' @endphp
                                            @if($tarif_visite_id == $item->id) selected @endif 
                                            @endif>{{$item->deskripsi}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>SIRS - Jenis Tempat Tidur</label>
                                    <select class="js-select2 form-control" name="sirs_tempat_tidur_jenis_id" style="width: 100%;"required>
                                        <option value="" selected="" disabled="">Pilih Jenis</option>
                                        @foreach($all_sirs_tempat_tidur_jenis as $item)
                                            <option value="{{$item->id}}" @if($ruangan->sirs_tempat_tidur_jenis_id == $item->id) selected @endif>{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>SIRS - Tempat Tidur Kelas</label>
                                    <select class="js-select2 form-control" name="sirs_tempat_tidur_kelas_id" style="width: 100%;"required>
                                        <option value="" selected="" disabled="">Pilih Kelas</option>
                                        @foreach($all_sirs_tempat_tidur_kelas as $item)
                                            <option value="{{$item->id}}" @if($ruangan->sirs_tempat_tidur_kelas_id == $item->id) selected @endif>{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>SIRS - Kunjungan Kegiatan</label>
                                    <select class="js-select2 form-control" name="sirs_kunjungan_kegiatan" style="width: 100%;"required>
                                        <option value="" selected="" disabled="">Pilih Jenis Kunjungan Kegiatan</option>
                                        @foreach($all_sirs_kunjungan_kegiatan as $item)
                                            <option value="{{$item->id}}" @if($ruangan->sirs_kunjungan_kegiatan == $item->id) selected @endif>{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group float-right">
                                    <button class="btn btn-primary btn-hero">Simpan</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</main>

@include('rawatinap.pengaturan.ruangan.modals.tarif_lain')

<form method="POST" action="{{url('rawatinap/pengaturan/ruangan/delete')}}" id="formDelete" >
    {{csrf_field()}}
    <input type="hidden" class="form-control" name="ruangan_id" placeholder=".." id="inputDeleteID">
</form>

<form method="POST" action="{{url('rawatinap/pengaturan/foto/delete')}}" id="formDeleteFoto" >
    {{csrf_field()}}
    <input type="hidden" class="form-control" name="foto_id" placeholder=".." id="inputDeleteFotoID">
</form>
@endsection

@section('js')
<script type="text/javascript">
    var tarif_kelas_id = {{$ruangan->kelas}};
    var visite_perusahaan_data = @json($tarif_visite_perusahaan, JSON_PRETTY_PRINT);

    // $('#kelas_ruangan').on('change', function(){
    //    tarif_kelas_id = $(this).find('option:selected').data('tarif-kelas');
    // })

    $(document).ready(function() {
        getKelasApplicare();
        getSIRSCovid19TipeRuangan();
        initVisitePerusahaan();
    });

    $('.select-kelas-tarif').select2();
    $('.select-tarif').select2({
        ajax: {
            url: API_URL+'/keuangan/tarif/search',
            data: function (params) {
                var query = {
                    keyword: params.term,
                    kelas: tarif_kelas_id,
                    tipe: 1
                }
                return query;
            },
            processResults: function (data) {
                // Tranforms the top-level key of the response object from 'items' to 'results'
                var res = JSON.parse(data);
                var result = [];
                for (var i = res.length - 1; i >= 0; i--) {
                    result.push({
                        id: JSON.stringify(res[i]),
                        text: res[i].deskripsi
                    })
                }
                return {
                    results: result
                };
            }
        }
    });
    $('.select-tarif').on('change', function(){
        var indexTarif = $(this).parent().parent().data('index');
        // console.log($(this));
        var tarifHarga = JSON.parse($(this).val()).harga;
        $(this).parent().parent().find('#harga-tarif-'+indexTarif).val("Rp "+tarifHarga.toFixed(0).replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1,"));
    });

    function simpanTarif(){
        $('#tarif_lain_wrapper').empty();
        var totalTarif = $(".select-tarif").length;
        $('#tarif-wrapper').children().each(function(){
            var indexTarif = $(this).data('index');
            var deskripsi = $(this).find('#tarif-'+indexTarif+' option:selected').html();
            var hargaTarif = $(this).find('#harga-tarif-'+indexTarif).val();
            var kelasTarif = $(this).find('#kelas-tarif-'+indexTarif+' option:selected').html();
            var tarif = JSON.parse($(this).find('#tarif-'+indexTarif).val());
            console.log(tarif);
            if(!(tarif == 'undefined' || tarif == undefined)){
                if(!(tarif.tarif_id == 'undefined' || tarif.tarif_id == undefined))
                var codeToAdd = `<input type="text" name="tarif_lain[]" hidden="" value="`+tarif.tarif_id+`">
                                <div class="col-6" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                    `+tarif.deskripsi+`
                                </div>`;
                else
                var codeToAdd = `<input type="text" name="tarif_lain[]" hidden="" value="`+tarif.id+`">
                                <div class="col-6" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                    `+tarif.master.deskripsi+`
                                </div>`;
                codeToAdd += `<div class="col-3">`+hargaTarif+`</div>
                                <div class="col-3">`+kelasTarif+`</div>`;
                $('#tarif_lain_wrapper').append(codeToAdd);
            }
        });
        $('#modal_tarif').modal('hide');
    }
    function addTarif(){
        var totalTarif = $(".select-tarif").length;
        var codeToAdd = `<div class="row" id="tarif-`+(totalTarif+1)+`" data-index="`+(totalTarif+1)+`">
                            <div class="col-3 form-group">
                                <select class="js-select2 form-control select-kelas-tarif" style="width: 100%;" data-placeholder="Pilih Kelas Tarif" id="kelas-tarif-`+(totalTarif+1)+`" disabled="">
                                    <option value=""></option>
                                    @foreach($tarif_kelas as $t)
                                    <option value="{{$t->id}}" @if($ruangan->kelas_ruang->tarif_kelas == $t->id) selected="" @endif>Kelas {{$t->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-5 form-group">
                                <select class="js-select2 form-control select-tarif" style="width: 100%;" data-placeholder="Pilih Tarif" id="tarif-`+(totalTarif+1)+`">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-3 form-group">
                                <input class="form-control" type="text" readonly="" value="" id="harga-tarif-`+(totalTarif+1)+`">
                            </div>
                            <div class="col-1 form-group">
                                <button type="button" class="btn btn-outline-danger btn-circle" onclick="removeTarif(`+(totalTarif+1)+`)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>`;
        $("#tarif-wrapper").append(codeToAdd);
        $('.select-kelas-tarif').select2();
        $('.select-tarif').select2({
            ajax: {
                url: API_URL+'/keuangan/tarif/search',
                data: function (params) {
                    var query = {
                        keyword: params.term,
                        kelas: tarif_kelas_id,
                        tipe: 1
                    }
                    return query;
                },
                processResults: function (data) {
                    // Tranforms the top-level key of the response object from 'items' to 'results'
                    var res = JSON.parse(data);
                    var result = [];
                    for (var i = res.length - 1; i >= 0; i--) {
                        result.push({
                            id: JSON.stringify(res[i]),
                            text: res[i].deskripsi
                        })
                    }
                    return {
                        results: result
                    };
                }
            }
        });
        $('.select-tarif').on('change', function(){
            var indexTarif = $(this).parent().parent().data('index');
            // console.log($(this));
            var tarifHarga = JSON.parse($(this).val()).harga;
            $(this).parent().parent().find('#harga-tarif-'+indexTarif).val("Rp "+tarifHarga.toFixed(0).replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1,"));
        });
    }

    function removeTarif(indexTarif) {
        $("#tarif-"+indexTarif).remove();
    }

    function addForm(){
        var totalFoto = $(".fotoForm").length;
        var codeToAdd = `<div class="row single-foto" id="foto_`+totalFoto+`" data-index="`+totalFoto+`">
                            <div class="col-8">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="form-control fotoForm" id="foto`+totalFoto+`" name="foto[]" accept=".png, .jpg, .jpeg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger" onclick="removeForm(`+totalFoto+`)">
                                        <i class="fa fa-times mr-5"></i>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>`;
        $(".form-foto").append(codeToAdd);
    }
    function removeForm(id) {
        $("#foto_"+id).remove();
    }

    function swalDelete(id)
    {
        swal({
            title: 'Apakah anda yakin',
            text: "Data yang telah dihapus tidak dapat dikembalikan.",
            type: 'warning',
            showCancelButton: true,
            reverseButtons:true,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-outline-danger',
            confirmButtonText: 'Ya, hapus ruangan',
            cancelButtonText: 'Batalkan'
        }).then((result) => {
            if (result.value) {
                $('#inputDeleteID').val(id);
                $('#formDelete').submit();
            }
        })
    }

    function swalDeleteGambar(id)
    {
        swal({
            title: 'Apakah anda yakin',
            text: "Foto yang telah dihapus tidak dapat dikembalikan.",
            type: 'warning',
            showCancelButton: true,
            reverseButtons:true,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-outline-danger',
            confirmButtonText: 'Ya, hapus foto',
            cancelButtonText: 'Batalkan'
        }).then((result) => {
            if (result.value) {
                $('#inputDeleteFotoID').val(id);
                $('#formDeleteFoto').submit();
            }
        })
    }
    $(document).ready(function() {
        getKelasApplicare();
    });

    function getKelasApplicare(){
        $('#loading_kelas').show();
        $.ajax({
            type: "GET",
            url: API_URL + "/bpjs/referensi/applicare/kelas",
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                var res = JSON.parse(response).response.list;
                $('#kelas-applicare').empty();
                var option = [];
                option.push({
                    id:"",
                    "text":""
                });
                if(res == undefined)
                    return;
                for (var i = 0; i < res.length ; i++) {
                    option.push({
                        id: res[i].kodekelas,
                        text: res[i].namakelas
                    });
                }
                $('#kelas-applicare').select2({
                    data : option
                });
                @if(isset($ruangan->kelas_applicare))
                $('#kelas-applicare').val("{{$ruangan->kelas_applicare}}").trigger('change');
                @endif
                $('#loading_kelas').hide();
            },
            error: function(e) {
                $('#loading_kelas').show();
            }
        });
    }

    function getSIRSCovid19TipeRuangan(){
        $('#loading_kelas_sirs_covid_19').show();
        $.ajax({
            type: "GET",
            url: API_URL + "/third-party/sirs-covid-19/rawatinap/get",
            cache: false,
            contentType: false,
            processData: false,
            tryCount : 0,
            retryLimit : 3,
            success: function(response) {
                var res = JSON.parse(response);
                $('#sirs-covid-19-tipe-ruangan').empty();
                var option = [];
                option.push({
                    id:"",
                    "text":""
                });
                if(res == undefined)
                    return;
                for (var i = 0; i < res.length ; i++) {
                    option.push({
                        id: res[i].id_tt,
                        text: res[i].tt
                    });
                }
                $('#sirs-covid-19-tipe-ruangan').select2({
                    data : option
                });
                @if(isset($ruangan->sirs_covid_19_tt_id))
                $('#sirs-covid-19-tipe-ruangan').val("{{$ruangan->sirs_covid_19_tt_id}}").trigger('change');
                @endif
                $('#loading_kelas_sirs_covid_19').hide();
            },
            error : function(xhr, textStatus, errorThrown ) {
                if (textStatus == 'timeout') {
                    this.tryCount++;
                    if (this.tryCount <= this.retryLimit) {
                        $.ajax(this);
                        return;
                    }            
                    return;
                }
                if (xhr.status == 500) {
                    $('#loading_kelas_sirs_covid_19').hide();
                } else {
                    $('#loading_kelas_sirs_covid_19').hide();
                }
            }
        });
    }

    $(document).on('click', '.visite-perusahaan-add', function () {
        index_visite = $('.visite-perusahaan-content').find('.visite-perusahaan-element').length - 1;
        content_el = $('.visite-perusahaan-content').find('.visite-perusahaan-element:first').clone();
        content_el.addClass(`visite-perusahaan-${index_visite}`).removeClass('hide').removeClass('block-mode-hidden');
        $('.visite-perusahaan-content').append(content_el);
        appended_el = $('.visite-perusahaan-content').find('.visite-perusahaan-element:last');
        appended_el.find('.visite-perusahaan-index').text(index_visite + 1);
        appended_el.find('.perusahaan-tipe').attr('name', `perusahaan_tipe[${index_visite}]`).select2().prop('disabled', false);
        appended_el.find('select').not('.perusahaan-tipe').each(function(i, obj) {
            jenis_dokter = $(this).data('jenis-dokter');
            $(this).attr('name', `visite_perusahaan[${index_visite}][${jenis_dokter}]`).select2().prop('disabled', false);
        });
    });

    $(document).on('click', '.visite-perusahaan-remove', function () {
       $(this).parents('.visite-perusahaan-element').remove();
    });

    function initVisitePerusahaan() {
        index_visite = 0;
        $.each(visite_perusahaan_data, function(key, item) {
            content_el = $('.visite-perusahaan-content').find('.visite-perusahaan-element:first').clone();
            content_el.addClass(`visite-perusahaan-${index_visite}`).removeClass('hide');
            $('.visite-perusahaan-content').append(content_el);

            appended_el = $('.visite-perusahaan-content').find('.visite-perusahaan-element:last');
            appended_el.find('.visite-perusahaan-index').text(index_visite + 1);
            appended_el.find('.perusahaan-tipe').attr('name', `perusahaan_tipe[${index_visite}]`).select2().prop('disabled', false).val(key).trigger('change');

            class_name = `.jenis-dokter-${item.jenis_dokter}`;
            appended_el.find(class_name)
                .attr('name', `visite_perusahaan[${index_visite}][${item.jenis_dokter}]`)
                .select2()
                .prop('disabled', false)
                .val(item.tarif.tarif_master_id)
                .trigger('change');
            index_visite++;
        });
    }
</script>
@endsection