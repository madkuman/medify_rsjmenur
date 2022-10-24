@extends('layouts.main2')

@section('title')
Profil {{$user->name}}
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <div class="row">
            <div class="col-md-9">
                <!--BASIC INFO-->
                <div class="block block-content block-link-shadow">
                    <div class="row">
                        <div class="col-md-2">
                            @if(!empty($user->avatar_ori))
                            <img class="avatar-preview mb-20" src="{{asset($user->avatar_ori)}}" alt="Card image cap" style="width: 125px; height: 125px">
                            @else
                            <img class="avatar-preview mb-20" src="{{url('assets/img/placeholder.jpg')}}" alt="Card image cap" style="width: 125px; height: 125px">
                            @endif
                        </div>
                        <div class="col-md-9">
                            <h4 class="font-w400 mb-0 mt-20">{{$user->name}}</h4>
                            <h5 class="font-w300 mb-0">
                                @if(!empty($user->profesi_id))
                                {{$user->profesi_detail->title}}
                                @endif
                                @if(!empty($user->specialty))
                                 - {{$user->specialty_detail->name}}
                                @endif
                            </h5>
                            @if(!empty($posisi))
                            <h5 class="font-w300" style="color: grey">{{$posisi->strata}} - {{$posisi->name}}</h5>
                            @endif
                        </div>
                        @if(Auth::user()->id == $user->id)
                        <div class="col-md-1">
                            <a class="float-right btn btn-sm btn-circle btn-outline-primary" href="javascript:void(0)" data-toggle="modal" data-target="#edit-about-me">
                                <span class="fa fa-pencil"></span>
                            </a>
                        </div>
                        @endif
                        <div class="col-md-12">
                            <hr>
                            @if(!empty($user->about_me))
                            <h5 class="mb-5"><small>Tentang Saya</small></h5>
                            <p>{{$user->about_me}}</p>
                            @endif
                        </div>           
                    </div> 
                </div>
                <!-- END OF BASIC INFO -->

                <!-- PENDIDIKAN -->
                <div class="block block-content block-link-shadow">
                    <div class="row">
                        <div class="col-md-11">
                            <h4 class="mb-5"><small class="font-black text-primary-darker">Pendidikan</small></h4>
                        </div>
                        @if(Auth::user()->id == $user->id)
                        <div class="col-md-1">
                            <a class="btn btn-circle btn-outline-primary btn-sm float-right" href="javascript:void(0)" data-toggle="modal" data-target="#add-pendidikan">
                                <span class="fa fa-plus"></span>
                            </a>
                        </div>
                        @endif
                        <div class="col-md-12 block-transparent mb-10">
                            <hr style="border-top: 1px solid #0b72c6">
                            @if($userpend->count() == 0)
                            @if(Auth::user()->id == $user->id)
                            <h5 class="font-w400 text-center">Anda belum menambahkan informasi pendidikan</h5>
                            @else
                            <h5 class="font-w400 text-center">{{$user->name}} belum menambahkan informasi pendidikan</h5>
                            @endif
                            @else
                            @foreach($userpend as $pend)
                            <div class="{{ (Auth::user()->id == $user->id) ? 'list-group-item' : 'list-profile-item' }} can-edit pb-1 mb-0">
                                @if(Auth::user()->id == $user->id)
                                <a class="btn btn-outline-primary btn-sm btn-circle float-right" href="javascript:void(0)" data-toggle="modal" data-target="#edit-pendidikan{{$pend->id}}" style="display: none">
                                <i class="fa fa-pencil"></i>
                                </a>
                                @endif
                                <h5 class="font-w600 mb-5">{{$pend->institusi}}</h5>
                                <h6 class="font-w400 mb-5">{{$pend->departemen}}</h6>
                                <h6 class="font-w400 text-muted">{{$pend->tahun_masuk}} - {{$pend->tahun_tamat}}</h6>
                            </div>
                            @include('profile.modals.edit-pendidikan')
                            @include('profile.modals.delete-pendidikan')
                            @endforeach
                            @endif
                        </div>                   
                    </div>
                </div>

                <!-- PELATIHAN -->
                <div class="block block-content block-link-shadow">
                    <div class="row">
                        <div class="col-md-11">
                            <h4 class="mb-5"><small class="text-primary-darker">Pelatihan</small></h4>
                        </div>
                         @if(Auth::user()->id == $user->id)
                        <div class="col-md-1">
                            <a class="btn btn-sm btn-circle btn-outline-primary font-w300 float-right" href="javascript:void(0)" data-toggle="modal" data-target="#add-pelatihan">
                                <span class="fa fa-plus"></span>
                            </a>
                        </div>
                        @endif
                        <div class="col-md-12 block-transparent mb-10">
                            <hr style="border-top: 1px solid #0b72c6">
                            @if($userpel->count() > 0)
                            @php $i = 0 @endphp
                            @foreach($userpel as $pel)
                            @if($i < 5)
                            <div class="{{ (Auth::user()->id == $user->id) ? 'list-group-item' : 'list-profile-item' }} can-edit pb-1 mb-0">
                            @php $i++ @endphp
                            @else
                            <div class="{{ (Auth::user()->id == $user->id) ? 'list-group-item' : 'list-profile-item' }} pelatihan-hidden can-edit pb-1 mb-0" style="display: none;">
                            @endif
                                @if(Auth::user()->id == $user->id)
                                <a class="btn btn-sm btn-outline-primary btn-circle float-right" href="javascript:void(0)" data-toggle="modal" data-target="#edit-pelatihan{{$pel->id}}" style="display: none;">
                                    <span class="fa fa-pencil"></span>
                                </a>
                                @endif
                                <h5 class="font-w600 mb-5">{{$pel->nama}}</h5>
                                <h6 class="font-w400 mb-5">{{$pel->tempat}}</h6>
                                <h6 class="font-w400">{{$pel->tahun}}</h6>
                            </div>
                            @include('profile.modals.edit-pelatihan')
                            @include('profile.modals.delete-pelatihan')
                            @endforeach
                            @if($i == 5)
                            <div class="text-center">
                                <a id="expand-pelatihan" class="btn btn-sm btn-outline-primary btn-circle font-w300 py-0" href="javascript:void(0)">
                                    <span class="fa fa-2x fa-chevron-circle-down"></span>
                                </a>
                                <a id="shrink-pelatihan" class="btn btn-sm btn-outline-primary btn-circle font-w300 py-0" href="javascript:void(0)" style="display: none;">
                                    <span class="fa fa-2x fa-chevron-circle-up"></span>
                                </a>
                            </div>
                            @endif
                            @else
                            @if(Auth::user()->id == $user->id)
                            <h5 class="font-w400 text-center">Anda belum menambahkan informasi pelatihan</h5>
                            @else
                            <h5 class="font-w400 text-center">{{$user->name}} belum menambahkan informasi pelatihan</h5>
                            @endif
                            @endif
                        </div>                   
                    </div>
                </div>

                <!-- STAF MEDIS -->
                @if(!empty($user->employee_id) && $user->employee_id != 0)
                <div class="block block-content block-link-shadow">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="mb-5"><small class="text-primary-darker">Data Staff Medis</small></h4>
                        </div>
                        <div class="col-md-12 block-transparent mb-10">
                            <hr style="border-top: 1px solid #0b72c6">
                            <div class="row my-10">
                                <div class="col-sm-5 col-xs-3 col-12">
                                    <label>Kualifikasi</label>
                                </div>
                                <div class="col">
                                    {{!empty($user->employee->kualifikasi) ? $user->employee->kualifikasi : '-'}}
                                </div>
                            </div>
                            <div class="row my-10">
                                <div class="col-sm-5 col-xs-3 col-12">
                                    <label>Subkualifikasi</label>
                                </div>
                                <div class="col">
                                    {{!empty($user->employee->subkualifikasi) ? $user->employee->subkualifikasi : '-'}}
                                </div>
                            </div>
                            <div class="row my-10">
                                <div class="col-sm-5 col-xs-3 col-12">
                                    <label>Surat Izin Praktek</label>
                                </div>
                                <div class="col">
                                    {{!empty($user->employee->sip) ? $user->employee->sip : '-'}}
                                </div>
                            </div>
                            <div class="row my-10">
                                <div class="col-sm-5 col-xs-3 col-12">
                                    <label>Surat Izin Praktek Aktif Hingga</label>
                                </div>
                                <div class="col">
                                    {{!empty($user->employee->sip_expired_at) ? $user->employee->sip_expired : '-'}}
                                </div>
                            </div>
                            <div class="row my-10">
                                <div class="col-sm-5 col-xs-3 col-12">
                                    <label>File Surat Izin Praktek</label>
                                </div>
                                <div class="col">
                                    @if(!empty($user->employee->sip_file))
                                    <a href="{{url('uploads/kepegawaian/profile')}}/{{$user->employee->sip_file}}" target=_blank>Lihat File</a>
                                    @else
                                    Tidak Tersedia
                                    @endif
                                </div>
                            </div>
                            <div class="row my-10">
                                <div class="col-sm-5 col-xs-3 col-12">
                                    <label>STR</label>
                                </div>  
                                <div class="col">
                                    {{ $user->employee->str ?? '-'}}
                                </div>
                            </div>
                            <div class="row my-10">
                                <div class="col-sm-5 col-xs-3 col-12">
                                    <label>STR Aktif Hingga</label>
                                </div>
                                <div class="col">
                                    {{ $user->employee->str_expired ?? '-'}}
                                </div>
                            </div>
                            <div class="row my-10">
                                <div class="col-sm-5 col-xs-3 col-12">
                                    <label>File STR</label>
                                </div>
                                <div class="col">
                                    @if(!empty($user->employee->str_file))
                                    <a href="{{url('uploads/kepegawaian/profile')}}/{{$user->employee->str_file}}" target=_blank>Lihat File</a>
                                    @else
                                    Tidak Tersedia
                                    @endif
                                </div>
                            </div>
                            <div class="row my-10">
                                <div class="col-sm-5 col-xs-3 col-12">
                                    <label>SKK/RKK</label>
                                </div>  
                                <div class="col">
                                    {{ $user->employee->ppa_1 ?? '-'}}
                                </div>
                            </div>
                            <div class="row my-10">
                                <div class="col-sm-5 col-xs-3 col-12">
                                    <label>File SKK/RKK</label>
                                </div>
                                <div class="col">
                                    @if(!empty($user->employee->ppa_1_file))
                                    <a href="{{url('uploads/kepegawaian/profile')}}/{{$user->employee->ppa_1_file}}" target=_blank>Lihat File</a>
                                    @else
                                    Tidak Tersedia
                                    @endif
                                </div>
                            </div>
                            <div class="row my-10">
                                <div class="col-sm-5 col-xs-3 col-12">
                                    <label>KRED</label>
                                </div>  
                                <div class="col">
                                    {{ $user->employee->ppa_2 ?? '-'}}
                                </div>
                            </div>
                            <div class="row my-10">
                                <div class="col-sm-5 col-xs-3 col-12">
                                    <label>File KRED</label>
                                </div>
                                <div class="col">
                                    @if(!empty($user->employee->ppa_2_file))
                                    <a href="{{url('uploads/kepegawaian/profile')}}/{{$user->employee->ppa_2_file}}" target=_blank>Lihat File</a>
                                    @else
                                    Tidak Tersedia
                                    @endif
                                </div>
                            </div>
                            <div class="row my-10">
                                <div class="col-sm-5 col-xs-3 col-12">
                                    <label>EVKIN</label>
                                </div>  
                                <div class="col">
                                    {{ $user->employee->ppa_3 ?? '-'}}
                                </div>
                            </div>
                            <div class="row my-10">
                                <div class="col-sm-5 col-xs-3 col-12">
                                    <label>File EVKIN</label>
                                </div>
                                <div class="col">
                                    @if(!empty($user->employee->ppa_3_file))
                                    <a href="{{url('uploads/kepegawaian/profile')}}/{{$user->employee->ppa_3_file}}" target=_blank>Lihat File</a>
                                    @else
                                    Tidak Tersedia
                                    @endif
                                </div>
                            </div>
                        </div>                   
                    </div>
                </div>
                @endif

                <!-- KARYA -->
                <div class="block block-content block-link-shadow">
                    <div class="row">
                        <div class="col-md-11">
                            <h4 class="mb-5"><small class="text-primary-darker">Karya</small></h4>
                        </div>
                         @if(Auth::user()->id == $user->id)
                        <div class="col-md-1">
                            <a class="btn btn-circle btn-sm btn-outline-primary font-w300 float-right" href="javascript:void(0)" data-toggle="modal" data-target="#add-karya">
                                <span class="fa fa-plus"></span>
                            </a>
                        </div>
                        @endif
                        <div class="col-md-12 block-transparent mb-10">
                            <hr style="border-top: 1px solid #0b72c6">
                            @if($userkar->count() > 0)
                            @php $i = 0 @endphp
                            @foreach($userkar as $kar)
                            @if($i < 5)
                            <div class="{{ (Auth::user()->id == $user->id) ? 'list-group-item' : 'list-profile-item' }} can-edit pb-1 mb-0">
                            @php $i++ @endphp
                            @else
                            <div class="{{ (Auth::user()->id == $user->id) ? 'list-group-item' : 'list-profile-item' }} karya-hidden can-edit pb-1 mb-0" style="display: none;">
                            @endif
                                @if(Auth::user()->id == $user->id)
                                <a class="btn btn-outline-primary btn-circle btn-sm float-right" href="javascript:void(0)" data-toggle="modal" data-target="#edit-karya{{$kar->id}}" style="display: none;">
                                    <span class="fa fa-pencil"></span>
                                </a>
                                @endif
                                <h5 class="font-w600 mb-5">{{$kar->judul}}</h5>
                                <h6 class="font-w400 mb-5">{{$kar->jenis_karya}}</h6>
                                <h6 class="font-w400">{{$kar->publikasi}} - {{$kar->tahun}}</h6>
                            </div>
                            @include('profile.modals.edit-karya')
                            @include('profile.modals.delete-karya')
                            @endforeach
                            @if($i == 5)
                            <div class="text-center">
                                <a id="expand-karya" class="btn btn-sm btn-outline-primary btn-circle font-w300 py-0" href="javascript:void(0)">
                                    <span class="fa fa-2x fa-chevron-circle-down"></span>
                                </a>
                                <a id="shrink-karya" class="btn btn-sm btn-outline-primary btn-circle font-w300 py-0" href="javascript:void(0)" style="display: none;">
                                    <span class="fa fa-2x fa-chevron-circle-up"></span>
                                </a>
                            </div>
                            @endif
                            @else
                            @if(Auth::user()->id == $user->id)
                            <h5 class="font-w400 text-center">Anda belum menambahkan informasi karya</h5>
                            @else
                            <h5 class="font-w400 text-center">{{$user->name}} belum menambahkan informasi karya</h5>
                            @endif
                            @endif
                        </div>                   
                    </div>
                </div>

                <!-- SKILL -->
                <div class="block block-content block-link-shadow">
                    <div class="row">
                        <div class="col-md-11">
                            <h4 class="mb-5"><small class="text-primary-darker">Skill</small></h4>
                        </div>
                         @if(Auth::user()->id == $user->id)
                        <div class="col-md-1">
                            <a class="btn btn-sm btn-outline-primary btn-circle font-w300 float-right" href="javascript:void(0)" data-toggle="modal" data-target="#add-skill">
                                <span class="fa fa-plus"></span>
                            </a>
                        </div>
                        @endif
                        <div class="col-md-12 block-transparent mb-10">
                            <hr style="border-top: 1px solid #0b72c6">
                            @if($userskill->count() > 0)
                            @php $i = 0 @endphp
                            @foreach($userskill as $skill)
                            @if($i < 5)
                            <div class="{{ (Auth::user()->id == $user->id) ? 'list-group-item' : 'list-profile-item' }} can-edit mb-0 ">
                            @php $i++ @endphp
                            @else
                            <div class="{{ (Auth::user()->id == $user->id) ? 'list-group-item' : 'list-profile-item' }} skill-hidden can-edit mb-0 " style="display: none;">
                            @endif
                                @if(Auth::user()->id == $user->id)
                                <a class="float-right btn-sm btn-circle btn-outline-primary btn" href="javascript:void(0)" data-toggle="modal" data-target="#edit-skill{{$skill->id}}" style="display: none;">
                                    <span class="fa fa-pencil"></span>
                                </a>
                                @endif
                                    <h5 class="font-w400 mb-0">{{$skill->skill}}</h5>
                            </div>
                            @include('profile.modals.edit-skill')
                            @include('profile.modals.delete-skill')
                            @endforeach
                            @if($i == 5)
                            <div class="text-center">
                                <button id="expand-skill" class="btn btn-sm btn-outline-primary btn-circle font-w300 py-0" href="javascript:void(0)">
                                    <span class="fa fa-chevron-down"></span>
                                </button>
                                <button id="shrink-skill" class="btn btn-sm btn-outline-primary btn-circle font-w300 py-0" href="javascript:void(0)" style="display: none;">
                                    <span class="fa fa-chevron-up"></span>
                                </button>
                            </div>
                            @endif
                            @else
                            @if(Auth::user()->id == $user->id)
                            <h5 class="font-w400 text-center">Anda belum menambahkan informasi skill</h5>
                            @else
                            <h5 class="font-w400 text-center">{{$user->name}} belum menambahkan informasi skill</h5>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>

                <!-- HISTORI KASUS -->
                <div class="block block-content block-link-shadow">
                    <div class="row">
                        <div class="col-md-11">
                            <h4 class="mb-5"><small class="text-primary-darker">Histori Kasus</small></h4>
                        </div>
                        <div class="col-md-12 block-transparent mb-10">
                            <hr style="border-top: 1px solid #0b72c6">
                            @if($userkasus->count() > 0)
                            @php $i = 0 @endphp
                            @foreach($userkasus as $kasus)
                            @if($i < 5)
                            <div class="{{ (Auth::user()->id == $user->id) ? 'list-group-item' : 'list-profile-item' }} mb-0 ">
                            @php $i++ @endphp
                            @else
                            <div class="{{ (Auth::user()->id == $user->id) ? 'list-group-item' : 'list-profile-item' }} kasus-hidden mb-0 " style="display: none;">
                            @endif
                                <h5 class="font-w400 mb-0">{{$kasus->judul_kasus}}</h5>
                            </div>
                            @endforeach
                            @if($i == 5)
                            <div class="text-center mt-10">
                                <button id="expand-kasus" class="btn btn-sm btn-outline-primary btn-circle font-w300 py-0">
                                    <span class="fa fa-chevron-down"></span>
                                </button>
                                <button id="shrink-kasus" class="btn btn-sm btn-outline-primary btn-circle font-w300 py-0"  style="display: none;">
                                    <span class="fa fa-chevron-up"></span>
                                </button>
                            </div>
                            @endif
                            @else
                            @if(Auth::user()->id == $user->id)
                            <h5 class="font-w400 text-center">Anda belum memiliki histori kasus</h5>
                            @else
                            <h5 class="font-w400 text-center">{{$user->name}} belum memiliki histori kasus</h5>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>

                <!-- JADWAL PRAKTEK -->
                @if($user->profesi == 1)
                <div class="block block-content block-link-shadow">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="mb-5"><small class="text-primary-darker">Jadwal Praktek</small></h4>
                        </div>
                        @if(!empty($user->dokter_id))
                        @if(Auth::user()->id == $user->id)
                        <div class="col-md-2">
                            <a class="btn btn-sm btn-outline-primary btn-circle font-w300 float-right" href="javascript:void(0)" data-toggle="modal" data-target="#add-jadwal">
                                <span class="fa fa-plus"></span>
                            </a>
                        </div>
                        @endif
                        @endif
                        <div class="col-md-12 block-transparent mb-10">
                            <hr style="border-top: 1px solid #0b72c6"> 
                            @if($userpraktek->count() > 0)
                            <div class="row py-20">
                                @foreach($userpraktek as $praktek)
                                <div class="col-md-9 mb-20">
                                    <h5 class="font-w400 text-uppercase text-primary mb-0">{{$praktek->poli->name}}</h5>
                                    @php $hari = "array" @endphp
                                    @foreach($userjadwal as $jadwal)
                                    @if($jadwal->poliklinik_id == $praktek->poliklinik_id)
                                    @include('profile.modals.edit-jadwal')
                                    @include('profile.modals.delete-jadwal')
                                    <div class="row can-edit">
                                        @if($hari !== $jadwal->hari)
                                        <hr class="col-md-11 mt-5" style="border-top: 1px solid #eee">
                                        <h5 class="col-md-5 font-w300">{{$jadwal->hari}}</h5>
                                        @php $hari = $jadwal->hari @endphp
                                        @else
                                        <h5 class="col-md-5" style="visibility: hidden;">{{$jadwal->hari}}</h5>
                                        @endif
                                        <h5 class="col-md-5 font-w300 float-right">{{ Carbon\Carbon::parse($jadwal->jam_buka)->format('H:i') }} - {{ Carbon\Carbon::parse($jadwal->jam_tutup)->format('H:i') }}</h5>
                                        @if(Auth::user()->id == $user->id)
                                        <a class="btn btn-circle btn-sm btn-outline-primary edit-jadwal" href="javascript:void(0)" data-toggle="modal" data-target="#edit-jadwal{{$jadwal->id}}" style="display: none;">
                                            <span class="fa fa-pencil mx-0 px-0"></span>
                                        </a>
                                        @endif
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                            @else
                            @if(Auth::user()->id == $user->id)
                            @if(!empty($user->dokter_id))
                            <h5 class="font-w400 text-center">Anda belum menambahkan informasi jadwal praktek</h5>
                            @else
                            <h5 class="font-w400 text-center">Anda belum melakukan sinkronisasi dengan Data Dokter Rumah Sakit. <a href="{{url('settings/sync')}}">Klik Disini</a></h5>
                            @endif
                            @else
                            <h5 class="font-w400 text-center">{{$user->name}} belum menambahkan informasi jadwal praktek</h5>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
                @endif


            </div>
            <div class="col-md-3">
                <!-- PROFIL LAIN -->
                <div class="block block-content block-link-shadow">
                    <h4 class="font-w400 mb-10">Profil Lain</h4>
                    <hr class="mt-5 mb-15" style="border-top: 1px solid #0b72c6">
                    <ul class="nav-users pull-all nav-users-big pt-5">
                        @foreach($randomuser as $randuser)
                        <li>
                            <a class="pl-20" href="{{route('profil', ['id' => $randuser->id])}}">
                                <div class="row">
                                    <div class="col-md-3">
                                        @if(!empty($randuser->avatar_thumb))
                                        <img class="img-avatar-sm" src="{{asset($randuser->avatar_thumb)}}" alt="">
                                        @else
                                        <img class="img-avatar-sm" src="{{url('assets/img/placeholder.jpg')}}" alt="">
                                        @endif
                                    </div>
                                    <div class="col-md-9 pl-0">
                                        <div class="font-w600 font-size-s text-black">{{$randuser->name}}</div>
                                        <div class="font-w400 font-size-xs text-muted">
                                            @if(!empty($randuser->profesi))
                                            {{$randuser->profesi_detail->title}}
                                            @endif
                                            @if(!empty($randuser->specialty))
                                             - {{$randuser->specialty_detail->name}}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>


@include('profile.modals.add-pendidikan')
@include('profile.modals.add-pelatihan')
@include('profile.modals.add-karya')
@include('profile.modals.add-skill')
@include('profile.modals.add-jadwal')
@include('profile.modals.edit-aboutme')

@endsection

@section('js')
<script src="assets/js/pages/be_pages_dashboard.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 5;
        var addPendidikan = $('#add-pendidikan-btn');
        var addPelatihan = $('#add-pelatihan-btn');
        var addKarya = $('#add-karya-btn');
        var addJadwal = $('#add-jadwal-btn');
        var pendWrapper = $('#pend-wrapper');
        var pelWrapper = $('#pel-wrapper');
        var karWrapper = $('#kar-wrapper');
        var jadwalWrapper = $('#jadwal-wrapper');
        var fieldPend = '<div class="form-group row"><input type="text" class="col-md-3 form-control ml-15" name="institution[]" value="" placeholder="Tempat Pendidikan" required><input type="text" class="col-md-3 form-control ml-5" name="faculty[]" value="" placeholder="Jurusan, Fakultas" required><input type="number" class="col-md-2 form-control ml-5" name="year_start[]" value="" placeholder="Tahun Mulai" required><input type="number" class="col-md-2 form-control ml-5" name="year_finish[]" value="" placeholder="Tahun Selesai" required><a href="javascript:void(0);" class="remove_button col-md-1 pr-0"><span class="fa fa-2x fa-trash" style="color: red;"></a></div>';
        var fieldPel = '<div class="form-group row"><input type="text" class="col-md-4 form-control ml-15" name="training[]" value="" placeholder="Nama Pelatihan" required><input type="text" class="col-md-4 form-control ml-5" name="place[]" value="" placeholder="Tempat" required><input type="number" class="col-md-2 form-control ml-5" name="year[]" value="" placeholder="Tahun" required><a href="javascript:void(0);" class="remove_button col-md-1 pr-0"><span class="fa fa-2x fa-trash" style="color: red;"></a></div>';
        var fieldKar = '<div class="form-group row"><input type="text" class="col-md-3 form-control ml-15" name="title[]" value="" placeholder="Judul" required><input type="text" class="col-md-2 form-control ml-5" name="type[]" value="" placeholder="Jenis Karya" required><input type="text" class="col-md-3 form-control ml-5" name="publisher[]" value="" placeholder="Tempat/Event Publikasi" required><input type="number" class="col-md-2 form-control ml-5" name="year[]" value="" placeholder="Tahun" required><a href="javascript:void(0);" class="remove_button col-md-1 pr-0"><span class="fa fa-2x fa-trash" style="color: red;"></a></div>';
        var fieldJadwal = '<div class="form-group row"><select class="js-select2 form-control col-md-3" id="poli" name="poli[]" required><option value="">Pilih Poli</option>@foreach($poliklinik as $id => $title)<option value="{{ $id }}">{{ $title }}</option>@endforeach</select><select class="js-select2 form-control col-md-3 ml-5" id="days" name="days[]" required><option value="">Pilih Hari</option><option value="1|Senin">Senin</option><option value="2|Selasa">Selasa</option><option value="3|Rabu">Rabu</option><option value="4|Kamis">Kamis</option><option value="5|Jumat">Jumat</option><option value="6|Sabtu">Sabtu</option><option value="7|Minggu">Minggu</option></select><input type="text" class=" js-masked-time form-control js-masked-enabled col-md-2 ml-5" id="time_start" name="time_start[]" value="" placeholder="Jam Mulai" required><input type="text" class=" js-masked-time form-control js-masked-enabled col-md-2 ml-5" id="time_finish" name="time_finish[]" value="" placeholder="Jam Selesai" required><a href="javascript:void(0);" class="remove_button col-md-1 pr-0"><span class="fa fa-2x fa-trash" style="color: red;"></a></div>';
        var pend = 0, pel=0, kar=0, jad=0;

        $('.js-select2').select2({
            width: 'resolve'
        });
        $('.js-masked-time').mask("99:99");
        $('#tags').tagsInput({
            'width': '100%'
        });

        $(addPendidikan).click(function(){
            if(pend < maxField){ 
                pend++;
                $(pendWrapper).append(fieldPend);
            }
        });
        $(addPelatihan).click(function(){
            if(pel < maxField){ 
                pel++;
                $(pelWrapper).append(fieldPel);
            }
        });
        $(addKarya).click(function(){
            if(kar < maxField){ 
                kar++;
                $(karWrapper).append(fieldKar);
            }
        });
        $(addJadwal).click(function(){
            if(jad < maxField){ 
                jad++;
                $(jadwalWrapper).append(fieldJadwal);
                $('.js-select2').select2();
                $('.js-masked-time').mask("99:99");
            }
        });
        
        $(pendWrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove();
            pend--;
        });
        $(pelWrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove();
            pel--;
        });
        $(karWrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove();
            kar--;
        });
        $(jadwalWrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove();
            jad--;
        });

        $(document).on('mouseenter', '.can-edit', function(){
            $(this).find("a").show();
        }).on('mouseleave', '.can-edit', function(){
            $(this).find("a").hide();
        });

        $('#expand-pelatihan').click(function(){
            $('.pelatihan-hidden').slideToggle('slow');
            $('#shrink-pelatihan').css("display","inline-block");
            $(this).css("display","none");
        });
        $('#shrink-pelatihan').click(function(){
            $('.pelatihan-hidden').slideToggle('slow');
            $('#expand-pelatihan').css("display","inline-block");
            $(this).css("display","none");
        });

        $('#expand-karya').click(function(){
            $('.karya-hidden').slideToggle('slow');
            $('#shrink-karya').css("display","inline-block");
            $(this).css("display","none");
        });
        $('#shrink-karya').click(function(){
            $('.karya-hidden').slideToggle('slow');
            $('#expand-karya').css("display","inline-block");
            $(this).css("display","none");
        });

        $('#expand-skill').click(function(){
            $('.skill-hidden').slideToggle('slow');
            $('#shrink-skill').css("display","inline-block");
            $(this).css("display","none");
        });
        $('#shrink-skill').click(function(){
            $('.skill-hidden').slideToggle('slow');
            $('#expand-skill').css("display","inline-block");
            $(this).css("display","none");
        });

        $('#expand-kasus').click(function(){
            $('.kasus-hidden').slideToggle('slow');
            $('#shrink-kasus').css("display","inline-block");
            $(this).css("display","none");
        });
        $('#shrink-kasus').click(function(){
            $('.kasus-hidden').slideToggle('slow');
            $('#expand-kasus').css("display","inline-block");
            $(this).css("display","none");
        });

        $('#import-pendidikan').click(function(e){
            $.ajax({
                url: 'import/pendidikan',
                type: 'GET',
                dataType: 'json',
                beforeSend: function(){
                    $('.loader').css('display', 'block');
                },
                success: function(data){
                    $(pendWrapper).empty();
                    if (data.length > 0) {
                        $.each(data, function(key, value){
                            $(pendWrapper).append('<div class="form-group row"><input type="text" class="col-md-3 form-control ml-15" name="institution[]" value="" placeholder="Tempat Pendidikan" required><input type="text" class="col-md-3 form-control ml-5" name="faculty[]" value="'+value.name+'" placeholder="Jurusan, Fakultas" required><input type="number" class="col-md-2 form-control ml-5" name="year_start[]" value="'+value.tmt+'" placeholder="Tahun Mulai" required><input type="number" class="col-md-2 form-control ml-5" name="year_finish[]" value="" placeholder="Tahun Selesai" required><a href="javascript:void(0);" class="remove_button col-md-1 pr-0"><span class="fa fa-2x fa-trash" style="color: red;"></a></div>');
                        });
                    }
                    else{
                        swal({
                          type: 'error',
                          title: "Gagal!",
                          text: "Anda tidak memiliki data pendidikan dari kepegawaian atau anda belum melakukan sinkronisasi. Silahkan lakukan sinkronisasi dari menu Settings."
                      });
                    }
                },
                complete: function(){
                    $('.loader').css('display','none');
                }
            });
        });

        $('#import-pelatihan').click(function(e){
            $.ajax({
                url: 'import/pelatihan',
                type: 'GET',
                dataType: 'json',
                beforeSend: function(){
                    $('.loader').css('display', 'block');
                },
                success: function(data){
                    $(pelWrapper).empty();
                    if (data.length > 0) {
                        $.each(data, function(key, value){
                            $(pelWrapper).append('<div class="form-group row"><input type="text" class="col-md-4 form-control ml-15" name="training[]" value="'+value.name+'" placeholder="Nama Pelatihan" required><input type="text" class="col-md-4 form-control ml-5" name="place[]" value="'+value.place+'" placeholder="Tempat" required><input type="number" class="col-md-2 form-control ml-5" name="year[]" value="'+value.period+'" placeholder="Tahun" required><a href="javascript:void(0);" class="remove_button col-md-1 pr-0"><span class="fa fa-2x fa-trash" style="color: red;"></a></div>');
                        });
                    }
                    else{
                        swal({
                          type: 'error',
                          title: "Gagal!",
                          text: "Anda tidak memiliki data pelatihan dari kepegawaian atau anda belum melakukan sinkronisasi. Silahkan lakukan sinkronisasi dari menu Settings."
                      });
                    }
                },
                complete: function(){
                    $('.loader').css('display','none');
                }
            });
        });

    });
</script>
@endsection
