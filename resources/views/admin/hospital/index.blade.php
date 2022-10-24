@extends('layouts.main-dashboard')

@section('title')
Admin - Pengaturan Akun Rumah Sakit
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
            <h3 class="block-title">Pengaturan Akun Rumah Sakit</h3>
        </div>
        <div class="block-content container">
            <form method="POST" action="{{url('admin/hospital')}}/edit" enctype='multipart/form-data'>
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" id="name" name="name" class="form-control" style="width: 100%;" value="{{$name}}" required="">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>Kode RS</label>
                                    <input type="text" id="env" name="env" class="form-control" style="width: 100%;" value="{{$env}}" required="" readonly>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row gutters-tiny">
                            <div class="col-9">
                                <div class="form-group">
                                    <label>Favicon</label>
                                    <input type="file" id="favicon_url" name="favicon_url" class="form-control" style="width: 100%;" value="{{$url}}" >
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <img src="{{url('')}}/{{$favicon_url}}" height="60px">
                            </div>
                        </div>
                        <div class="row gutters-tiny">
                            <div class="col-9">
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" id="logo_url" name="logo_url" class="form-control" style="width: 100%;" value="{{$url}}" >
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <img src="{{url('')}}/{{$logo_url}}" height="60px">
                            </div>
                        </div>
                        <div class="row gutters-tiny">
                            <div class="col-9">
                                <div class="form-group">
                                    <label>Kop Kecil</label>
                                    <input type="file" id="kop_sm" name="kop_sm" class="form-control" style="width: 100%;" value="{{$url}}" >
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <img src="{{url('')}}/{{$kop_sm}}" height="60px">
                            </div>
                        </div>
                        <div class="row gutters-tiny">
                            <div class="col-9">
                                <div class="form-group">
                                    <label>Kop Besar</label>
                                    <input type="file" id="kop_lg" name="kop_lg" class="form-control" style="width: 100%;" value="{{$url}}" >
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <img src="{{url('')}}/{{$kop_lg}}" height="60px">
                            </div>
                        </div>
                        @if(config('medify.third-party.rs_online.on'))
                            <div class="row gutters-tiny">
                                <div class="col-9">
                                    <div class="form-group">
                                        <label>Logo Header RS Online</label> <small> ( * .png ) </small>
                                        <input type="file" accept="image/png" id="logo_header_rsonline" name="logo_header_rsonline" class="form-control" style="width: 100%;" value="{{$url}}" >
                                    </div>
                                </div>
                                <div class="col-2 text-center">
                                    <img src="{{url('')}}/{{$logo_header_rsonline}}" height="60px">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>URL App</label>
                                    <input type="text" id="url" name="url" class="form-control" style="width: 100%;" value="{{$url}}" required="">
                                </div>
                                <div class="form-group">
                                    <label>URL SISMADAK</label>
                                    <input type="text" id="url_sismadak" name="url_sismadak" class="form-control" style="width: 100%;" value="{{$url_sismadak}}" required="">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="row">
                                    <div class="col-6 mt-10">
                                        <label>Debug Error</label>
                                        <div class=" mt-10">
                                            <label class="css-control css-control-primary css-switch">
                                                <input type="hidden" name="debug" value="0">
                                                <input type="checkbox" class="css-control-input" name="debug" @if($debug) checked="" @endif value="1">
                                                <span class="css-control-indicator"></span> On
                                                <button type="button" class="btn btn-rounded btn-sm ml-20 btn-alt-primary" data-toggle="tooltip" data-placement="top" title="
                                                   Menonaktifkan fitur ini akan memunculkan error kepada user. Tidak Disarankan
                                                ">
                                                    <i class="fa fa-info">
                                                    </i>
                                                </button>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Fitur Notifikasi</label>
                                        <div class=" mt-10">
                                            <label class="css-control css-control-primary css-switch">
                                                <input type="hidden" name="notification" value="0">
                                                <input type="checkbox" class="css-control-input" name="notification" @if($notification) checked="" @endif value="1">
                                                <span class="css-control-indicator"></span> On 
                                                <button type="button" class="btn btn-rounded btn-sm ml-20 btn-alt-primary" data-toggle="tooltip" data-placement="top" title="
                                                   Perhatian! Fitur ini mengonsumsi banyak memori dan CPU server
                                                ">
                                                    <i class="fa fa-info">
                                                    </i>
                                                </button>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="row">
                                    <div class="col-6 mt-10">
                                        <label>Pembatasan Akses Modul</label>
                                        <div class=" mt-10">
                                            <label class="css-control css-control-primary css-switch">
                                                <input type="hidden" name="check_module" value="0">
                                                <input type="checkbox" class="css-control-input" name="check_module" @if($check_module) checked="" @endif value="1">
                                                <span class="css-control-indicator"></span> On
                                                <button type="button" class="btn btn-rounded btn-sm ml-20 btn-alt-primary" data-toggle="tooltip" data-placement="top" title="
                                                   Fitur ini mencegah user untuk masuk ke modul yang tidak diinginkan.
                                                ">
                                                    <i class="fa fa-info">
                                                    </i>
                                                </button>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="row">
                                    <div class="col-6 mt-10">
                                        <label>Rumah Sakit Militer</label>
                                        <div class=" mt-10">
                                            <label class="css-control css-control-primary css-switch">
                                                <input type="hidden" name="is_military" value="0">
                                                <input type="checkbox" class="css-control-input" name="is_military" @if($is_military) checked="" @endif value="1">
                                                <span class="css-control-indicator"></span> On
                                                <button type="button" class="btn btn-rounded btn-sm ml-20 btn-alt-primary" data-toggle="tooltip" data-placement="top" title="
                                                   Mengaktifkan data satker dan kotama untuk rumah sakit militer
                                                ">
                                                    <i class="fa fa-info">
                                                    </i>
                                                </button>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>DB HOST</label>
                                    <input type="text" id="db_host" name="db_host" class="form-control" style="width: 100%;" value="{{$db_host}}" required="">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>DB PORT</label>
                                    <input type="text" id="db_port" name="db_port" class="form-control" style="width: 100%;" value="{{$db_port}}" required="">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>DB NAME</label>
                                    <input type="text" id="db_name" name="db_name" class="form-control" style="width: 100%;" value="{{$db_name}}" required="">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>DB USER</label>
                                    <input type="text" id="db_user" name="db_user" class="form-control" style="width: 100%;" value="{{$db_user}}" required="">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>DB PASSWORD</label>
                                    <input type="text" id="db_password" name="db_password" class="form-control" style="width: 100%;" value="{{$db_password}}">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>ELASTIC HOST</label>
                                    <input type="text" id="elastic_host" name="elastic_host" class="form-control" style="width: 100%;" value="{{$elastic_host}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6 align-self-start">
                        <div class="row">
                            <div class="col-12">
                                <label>Bridging BPJS</label>
                                <div class=" mt-10">
                                    <label class="css-control css-control-primary css-switch">
                                        <input type="hidden" name="bpjs_enable" value="0">
                                        <input type="checkbox" class="css-control-input" name="bpjs_enable" @if($bpjs_enable) checked="" @endif value="1">
                                        <span class="css-control-indicator"></span> On 
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label>BPJS Decrypt</label>
                                <div class=" mt-10">
                                    <label class="css-control css-control-primary css-switch">
                                        <input type="hidden" name="bpjs_decrypt" value="0">
                                        <input type="checkbox" class="css-control-input" name="bpjs_decrypt" @if($bpjs_decrypt) checked="" @endif value="1">
                                        <span class="css-control-indicator"></span> On 
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Stage</label>
                                    <select class="form-control" name="bpjs_stage">
                                        <option value="development" @if($bpjs_stage == "development") selected @endif>Development</option>
                                        <option value="production" @if($bpjs_stage == "production") selected @endif>Production</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>BPJS URL</label>
                                    <input type="text" id="bpjs_app_url" name="bpjs_app_url" class="form-control" style="width: 100%;" value="{{$bpjs_app_url}}" required="">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>BPJS PPK CODE</label>
                                    <input type="text" id="bpjs_ppk" name="bpjs_ppk" class="form-control" style="width: 100%;" value="{{$bpjs_ppk}}" required="">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>BPJS CONS ID</label>
                                    <input type="text" id="bpjs_cons_id" name="bpjs_cons_id" class="form-control" style="width: 100%;" value="{{$bpjs_cons_id}}" required="">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>BPJS SECRET</label>
                                    <input type="text" id="bpjs_secret" name="bpjs_secret" class="form-control" style="width: 100%;" value="{{$bpjs_secret}}" required="">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>BPJS User Key</label>
                                    <input type="text" id="bpjs_user_key" name="bpjs_user_key" class="form-control" style="width: 100%;" value="{{$bpjs_user_key}}" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 align-self-start">
                        <div class="row">
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>APLICARES PPK</label>
                                    <input type="text" id="applicare_ppk" name="applicare_ppk" class="form-control" style="width: 100%;" value="{{$applicare_ppk}}" required="">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>APLICARES CONS ID</label>
                                    <input type="text" id="applicare_cons_id" name="applicare_cons_id" class="form-control" style="width: 100%;" value="{{$applicare_cons_id}}" required="">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>APLICARES SECRET</label>
                                    <input type="text" id="applicare_secret" name="applicare_secret" class="form-control" style="width: 100%;" value="{{$applicare_secret}}" required="">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>INACBG URL</label>
                                    <input type="text" id="inacbg_url" name="inacbg_url" class="form-control" style="width: 100%;" value="{{$inacbg_url}}" required="">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>INACBG KODE TARIF</label>
                                    <select class="form-control" name="inacbg_kode_tarif">
                                        <option value="" seleceted>Pilih</option>
                                        <option value="AP" @if($inacbg_kode_tarif == 'AP') selected @endif>AP = TARIF RS KELAS A PEMERINTAH</option>
                                        <option value="AS" @if($inacbg_kode_tarif == 'AS') selected @endif>AS = TARIF RS KELAS A SWASTA</option>
                                        <option value="BP" @if($inacbg_kode_tarif == 'BP') selected @endif>BP = TARIF RS KELAS B PEMERINTAH</option>
                                        <option value="CP" @if($inacbg_kode_tarif == 'CP') selected @endif>CP = TARIF RS KELAS C PEMERINTAH</option>
                                        <option value="CS" @if($inacbg_kode_tarif == 'CS') selected @endif>CS = TARIF RS KELAS C SWASTA</option>
                                        <option value="DP" @if($inacbg_kode_tarif == 'DP') selected @endif>DP - TARIF RS KELAS D PEMERINTAH</option>
                                        <option value="DS" @if($inacbg_kode_tarif == 'DS') selected @endif>DS = TARIF RS KELAS D SWASTA</option>
                                        <option value="RSCM" @if($inacbg_kode_tarif == 'RSCM') selected @endif>RSCM = TARIF RSUPN CIPTO MANGUNKUSUMO</option>
                                        <option value="RSJP" @if($inacbg_kode_tarif == 'RSJP') selected @endif>RSJP = TARIF RSJPD HARAPAN KITA</option>
                                        <option value="RSD" @if($inacbg_kode_tarif == 'RSD') selected @endif>RSD = TARIF RS KANKER DHARMAIS</option>
                                        <option value="RSAB" @if($inacbg_kode_tarif == 'RSAB') selected @endif>RSAB = TARIF RSAB HARAPAN KITA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>INACBG KEY</label>
                                    <input type="password" id="inacbg_key" name="inacbg_key" class="form-control" style="width: 100%;" value="{{$inacbg_key}}" required="">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>NIK CODER INACBG</label>
                                    <input type="text" id="bpjs_secret" name="coder_nik" class="form-control" style="width: 100%;" value="{{$coder_nik}}" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6 align-self-start">
                        <div class="row">
                            <div class="col-12">
                                <label>Bridging SIRS</label>
                                <div class=" mt-10">
                                    <label class="css-control css-control-primary css-switch">
                                        <input type="hidden" name="sirs_enable" value="0">
                                        <input type="checkbox" class="css-control-input" name="sirs_enable" @if($sirs_enable) checked="" @endif value="1">
                                        <span class="css-control-indicator"></span> On
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>SIRS URL</label>
                                    <input type="text" id="sirs_url" name="sirs_url" class="form-control" style="width: 100%;" value="{{$sirs_url}}" required="">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>SIRS ID</label>
                                    <input type="text" id="sirs_id" name="sirs_id" class="form-control" style="width: 100%;" value="{{$sirs_id}}" required="">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>SIRS PASS</label>
                                    <input type="text" id="sirs_pass" name="sirs_pass" class="form-control" style="width: 100%;" value="{{$sirs_pass}}" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 align-self-start">
                        <div class="row">
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>Opentok Api Key</label>
                                    <input type="text" id="opentok_api_key" name="opentok_api_key" class="form-control" style="width: 100%;" value="{{$opentok_api_key}}" required="">
                                </div>
                            </div>
                            <div class="col-12 align-self-start">
                                <div class="form-group">
                                    <label>Opentok Api Secret</label>
                                    <input type="password" id="opentok_api_secret" name="opentok_api_secret" class="form-control" style="width: 100%;" value="{{$opentok_api_secret}}" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row pt-20">
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


@endsection

@section('js')
@endsection