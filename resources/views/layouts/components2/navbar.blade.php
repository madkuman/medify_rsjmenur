<!-- Header HP-->
<div class="d-sm-none">
<header id="page-header">
    <!-- Header Content-->
    <div class="content-header">
        <!-- Left Section -->
        <div class="content-header-section">
            <div class="btn-group" role="group">
                <a class="link-effect font-w600 btn <?php if(Request::is('getting-started/*')) { ?> btn-rounded btn-dual-secondary" disabled> <?php } else { ?> " href="{{url('')}}" style="color: black"> <?php } ?>
                    <i class="fa fa-home"></i> Home
                </a>
            </div>
        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="content-header-section">
            <div class="row">                
                <div class="col-12 text-right">
                    <div class="btn-group" id="notifications" role="group">
                        <a type="btn button" href="{{url('search')}}" class="btn btn-rounded btn-dual-secondary">
                            <i class="fa fa-search"></i>
                        </a>
                        <button type="button" class="btn btn-rounded btn-dual-secondary notification-dropdown" id="page-header-notification-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="badge badge-primary" id="notification-counter-sm"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right min-width-320" id="notification-dropdown" aria-labelledby="page-header-notification-dropdown" x-placement="bottom-end" style="position: absolute; transform: translate3d(-57px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                        </div>
                        <form method="POST" action="{{url('')}}/api/notification/mark_as_read" id="markAsRead">
                            {{csrf_field()}}
                            <input type="hidden" id="notificationID" name="id">
                            <input type="hidden" id="notificationURL" name="url">
                        </form>
                        <audio id="notification-audio" src="{{asset('assets/audio/notification.mp3')}}" preload="auto"></audio>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php $out = strlen(Auth::user()->name) > 11 ? substr(Auth::user()->name,0,11)."..." : Auth::user()->name; ?>
                            {{$out}}<i class="fa fa-angle-down ml-5"></i>
                        </button>
                        @if(Request::is('getting-started/*'))
                        @else
                        <div class="dropdown-menu dropdown-menu-right min-width-150" aria-labelledby="page-header-user-dropdown" x-placement="bottom-end" style="position: absolute; transform: translate3d(-57px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="dropdown-item" href="{{route('profil', ['id' => Auth::user()->id])}}">
                                <i class="si si-user mr-5"></i> Profil
                            </a>
                            <a class="dropdown-item" href="{{url('settings/account')}}" data-toggle="layout" data-action="side_overlay_toggle">
                                <i class="si si-wrench mr-5"></i> Pengaturan
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{url('k3/laporkan-k3')}}">
                                <i class="si si-diamond mr-5"></i> Laporkan<br>Kecelakaan<br>Kerja
                            </a>
                            <a class="dropdown-item" href="{{url('it/komplain-buat')}}">
                                <i class="si si-diamond mr-5"></i> Laporkan Permasalahan IT
                            </a>
                            <a class="dropdown-item" href="{{url('cuti')}}">
                                <i class="si si-control-forward mr-5"></i> Pengajuan Cuti
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{url('logout')}}">
                                <i class="si si-logout mr-5"></i> Sign Out
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content-->        
</header>
</div>
<!-- END Header HP-->

<!-- Header PC Tab-->
<div class="d-none d-sm-block">
<header id="page-header" class="header-has-logo" style="padding-left: 7%; padding-right: 5%">
    <!-- Header Content-->
    <div class="content-header">
        <div class="content-header-logo">
            <div class="d-inline-block">
                
                @if(Request::is('getting-started/*'))
                <a class="link-effect font-w600" disabled>
                @else
                <a class="link-effect font-w600" href="{{url('')}}">
                @endif
                    <span class="d-none d-md-inline-block">
                        <span class="font-size-xl text-black"><i class="fa fa-home"></i> Home</span>
                    </span>
                </a>
            </div>
        </div>

        <div class="content-header-section">
            <div class="row no-gutters">
                <!-- <div class="col">
                    <button type="button" class="btn btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                        <i class="fa fa-navicon"></i>
                    </button>
                </div> -->
                <div class="col-7">
                    <!-- Search -->
                    <form autocomplete="off" class="push mb-0 pb-0 pl-50" action="{{url('search')}}" method="get" style="display: none;">
                        <div class="input-group input-group-lg">
                            @if(Request::is('getting-started/*'))
                            <input type="text" class="form-control" placeholder="Cari.." id="navbarSearch" name="keyword" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled="disabled">
                            @else
                            <input type="text" class="form-control" placeholder="Cari.." id="navbarSearch" name="keyword" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @endif
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                            <div class="dropdown-menu" id="search-dropdown" aria-labelledby="navbarSearch" x-placement="bottom-end" style="position: absolute; transform: translate3d(-57px, 34px, 0px); top: 100%; left: 0px; right: 0px; will-change: transform;">
                            </div>
                        </div>
                    </form>
                    <!-- END Search -->                
                </div>
                <div class="col-5 text-right">
                    <div class="btn-group" id="notifications" role="group">
                        <a type="btn button" href="{{url('search')}}" class="btn btn-rounded btn-dual-secondary">
                            <i class="fa fa-search"></i>
                        </a>
                        <button type="button" class="btn btn-rounded btn-dual-secondary notification-dropdown" id="page-header-notification-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="badge badge-primary" id="notification-counter"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right min-width-320" id="notification-dropdown" aria-labelledby="page-header-notification-dropdown-1" x-placement="bottom-end" style="position: absolute; transform: translate3d(-57px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                        </div>
                        <form method="POST" action="{{url('')}}/api/notification/mark_as_read" id="markAsRead">
                            {{csrf_field()}}
                            <input type="hidden" id="notificationID" name="id">
                            <input type="hidden" id="notificationURL" name="url">
                        </form>
                        <audio id="notification-audio" src="{{asset('assets/audio/notification.mp3')}}" preload="auto"></audio>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php $out = strlen(Auth::user()->name) > 11 ? substr(Auth::user()->name,0,7)."..." : Auth::user()->name; ?>
                            {{$out}}<i class="fa fa-angle-down ml-5"></i>
                        </button>
                        @if(Request::is('getting-started/*'))
                        @else
                        <div class="dropdown-menu dropdown-menu-right min-width-150" aria-labelledby="page-header-user-dropdown" x-placement="bottom-end" style="position: absolute; transform: translate3d(-57px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="dropdown-item" href="{{route('profil', ['id' => Auth::user()->id])}}">
                                <i class="si si-user mr-5"></i> Profil
                            </a>
                            <a class="dropdown-item" href="{{url('settings/account')}}" data-toggle="layout" data-action="side_overlay_toggle">
                                <i class="si si-wrench mr-5"></i> Pengaturan
                            </a>
                            @if(session('has_k3_access'))
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{url('k3/laporkan-k3')}}">
                                <i class="fa fa-heartbeat mr-5"></i> Laporkan Kecelakaan Kerja
                            </a>
                            @endif
                            <a class="dropdown-item" href="{{url('it/komplain-buat')}}">
                                <i class="fa fa-warning mr-5"></i> Laporkan Permasalahan IT
                            </a>
                            <a class="dropdown-item" href="{{url('cuti')}}">
                                <i class="si si-control-forward mr-5"></i> Pengajuan Cuti
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{url('logout')}}">
                                <i class="si si-logout mr-5"></i> Sign Out
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Header Content-->        
</header>
{{-- Modal Untuk Komplain IT --}}
@include('layouts.components2.modal-komplain-it')
{{-- End of Modal Untuk Komplain IT --}}
</div>
<!-- END Header PC Tab-->

@include('layouts.components2.sidebar')