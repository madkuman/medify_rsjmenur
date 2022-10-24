<nav id="sidebar">
    <div id="sidebar-scroll">
        <div class="sidebar-content">
            <div class="content-header content-header-fullrow bg-black-op-10">
                <div class="content-header-section text-center align-parent">
                    <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r mt-10" data-toggle="layout" data-action="sidebar_close">
                        <i class="fa fa-times text-danger fa-2x"></i>
                    </button>

                </div>
            </div>
            <div class="content-side content-side-full">
                <ul class="nav-main">
                    <li>
                    <a @if($sidebar_active == 'dashboard') class="active" @endif href="{{url('/e-sakip')}}"><i class="si si-home"></i><span class="sidebar-mini-hide">Dokumen</span></a>
                    </li>

                    <li>
                        <a @if($sidebar_active == 'verifikasi') class="active" @endif href="{{url('/e-sakip/verifikasi')}}"><i class="si si-basket"></i><span class="sidebar-mini-hide">Verifikasi</span></a>
                    </li>

                    <li>
                        <a @if($sidebar_active == 'monitoring') class="active" @endif href="{{url('/e-sakip/monitoring')}}"><i class="si si-basket"></i><span class="sidebar-mini-hide">Monitoring</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="bg-white mb-20" >
    <div class="sidebar-content">

        <div class="content-side content-side-full d-none d-lg-block"  style="overflow: visible !important;">
            <ul class="nav-main-header">
                <li>
                    <a @if($sidebar_active == 'dashboard') class="active" @endif href="{{url('/e-sakip')}}"><i class="si si-book-open"></i><span class="sidebar-mini-hide">Dokumen</span></a>
                </li>

                <li>
                    <a @if($sidebar_active == 'verifikasi') class="active" @endif href="{{url('/e-sakip/verifikasi')}}"><i class="si si-check"></i><span class="sidebar-mini-hide">Verifikasi</span></a>
                </li>

                <li>
                    <a @if($sidebar_active == 'monitoring') class="active" @endif href="{{url('/e-sakip/monitoring')}}"><i class="si si-eye"></i><span class="sidebar-mini-hide">Monitoring</span></a>
                </li>
            </ul>
        </div>

        <div class="content-header-section text-center">
            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none mb-10" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-navicon fa-2x"></i>
            </button>
        </div>
    </div>
</div>