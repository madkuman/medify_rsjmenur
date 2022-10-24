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
                    <a @if($sidebar_active == 'usulan') class="active" @endif href="{{url('/e-usulan')}}"><i class="si si-doc"></i><span class="sidebar-mini-hide">Usulan</span></a>
                    </li>
                    <li>
                        <a @if($sidebar_active == 'laporan') class="active" @endif href="{{url('/e-usulan/laporan')}}"><i class="fa fa-files-o"></i><span class="sidebar-mini-hide">Laporan</span></a>
                    </li>
                    <li>
                        <a @if($sidebar_active == 'pengaturan') class="active" @endif href="{{url('/e-usulan/pengaturan')}}"><i class="si si-settings"></i><span class="sidebar-mini-hide">Pengaturan</span></a>
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
                    <a @if($sidebar_active == 'usulan') class="active" @endif href="{{url('/e-usulan')}}"><i class="si si-doc"></i><span class="sidebar-mini-hide">Usulan</span></a>
                </li>
                <li>
                    <a @if($sidebar_active == 'laporan') class="active" @endif href="{{url('/e-usulan/laporan')}}"><i class="fa fa-files-o"></i><span class="sidebar-mini-hide">Laporan</span></a>
                </li>
                <li>
                    <a @if($sidebar_active == 'pengaturan') class="active" @endif href="{{url('/e-usulan/pengaturan')}}"><i class="si si-settings"></i><span class="sidebar-mini-hide">Pengaturan</span></a>
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