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
                    <a @if($sidebar_active == 'dashboard') class="active" @endif href="{{url('/remunerasi')}}"><i class="si si-home"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                    </li>

                    <li>
                        <a @if($sidebar_active == 'absensi') class="active" @endif href="{{url('/remunerasi/absensi')}}"><i class="si si-basket"></i><span class="sidebar-mini-hide">Absensi</span></a>
                    </li>
                    <li>
                        <a @if($sidebar_active == 'keuangan') class="active" @endif href="{{url('/remunerasi/keuangan')}}"><i class="si si-basket"></i><span class="sidebar-mini-hide">Pelayanan</span></a>
                    </li>

                    <li>
                        <a @if($sidebar_active == 'dana') class="active" @endif href="{{url('remunerasi/dana')}}"><i class="si si-calculator"></i><span class="sidebar-mini-hide">Dana</span></a>
                    </li>

                    <li>
                        <a @if($sidebar_active == 'denda') class="active" @endif href="{{url('remunerasi/denda')}}"><i class="si si-calculator"></i><span class="sidebar-mini-hide">Denda</span></a>
                    </li>

                    <li>
                        <a @if($sidebar_active == 'beban-kerja') class="active" @endif href="{{url('remunerasi/beban-kerja')}}"><i class="si si-calculator"></i><span class="sidebar-mini-hide">Beban Kerja</span></a>
                    </li>
                    <li>
                        <a @if($sidebar_active == 'resiko-kerja') class="active" @endif href="{{url('remunerasi/resiko-kerja')}}"><i class="si si-calculator"></i><span class="sidebar-mini-hide">Resiko Kerja</span></a>
                    </li>
                    <li>
                        <a @if($sidebar_active == 'pajak') class="active" @endif href="{{url('remunerasi/pajak')}}"><i class="si si-bar-chart"></i><span class="sidebar-mini-hide">Pajak/PPH</span></a>
                    </li>

                    <li>
                        <a @if($sidebar_active == 'laporan') class="active" @endif href="{{url('remunerasi/laporan')}}"><i class="si si-bar-chart"></i><span class="sidebar-mini-hide">Laporan</span></a>
                    </li>
                    
                    {{-- <li>
                        <a @if($sidebar_active == 'master-index') class="active" @endif href="{{url('remunerasi/master-index')}}"><i class="si si-settings"></i><span class="sidebar-mini-hide">Master Index</span></a>
                    </li> --}}
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
                    <a @if($sidebar_active == 'dashboard') class="active" @endif href="{{url('/remunerasi')}}"><i class="si si-home"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                </li>

                <li>
                    <a @if($sidebar_active == 'absensi') class="active" @endif href="{{url('/remunerasi/absensi')}}"><i class="si si-calculator"></i><span class="sidebar-mini-hide">Absensi</span></a>
                </li>
                <li>
                    <a @if($sidebar_active == 'keuangan') class="active" @endif href="{{url('/remunerasi/keuangan')}}"><i class="si si-basket"></i><span class="sidebar-mini-hide">Pelayanan</span></a>
                </li>

                <li>
                    <a @if($sidebar_active == 'dana') class="active" @endif href="{{url('remunerasi/dana')}}"><i class="si si-calculator"></i><span class="sidebar-mini-hide">Dana</span></a>
                </li>

                <li>
                    <a @if($sidebar_active == 'denda') class="active" @endif href="{{url('remunerasi/denda')}}"><i class="si si-calculator"></i><span class="sidebar-mini-hide">Denda</span></a>
                </li>

                <li>
                    <a @if($sidebar_active == 'beban-kerja') class="active" @endif href="{{url('remunerasi/beban-kerja')}}"><i class="si si-calculator"></i><span class="sidebar-mini-hide">Beban Kerja</span></a>
                </li>

                <li>
                    <a @if($sidebar_active == 'resiko-kerja') class="active" @endif href="{{url('remunerasi/resiko-kerja')}}"><i class="si si-calculator"></i><span class="sidebar-mini-hide">Resiko Kerja</span></a>
                </li>

                <li>
                    <a @if($sidebar_active == 'pajak') class="active" @endif href="{{url('remunerasi/pajak')}}"><i class="si si-bar-chart"></i><span class="sidebar-mini-hide">Pajak/PPH</span></a>
                </li>

                <li>
                    <a @if($sidebar_active == 'laporan') class="active" @endif href="{{url('remunerasi/laporan')}}"><i class="si si-bar-chart"></i><span class="sidebar-mini-hide">Laporan</span></a>
                </li>
                
                {{-- <li>
                    <a @if($sidebar_active == 'master-index') class="active" @endif href="{{url('remunerasi/master-index')}}"><i class="si si-settings"></i><span class="sidebar-mini-hide">Master Index</span></a>
                </li> --}}
            </ul>
        </div>

        <div class="content-header-section text-center">
            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none mb-10" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-navicon fa-2x"></i>
            </button>
        </div>
    </div>
</div>