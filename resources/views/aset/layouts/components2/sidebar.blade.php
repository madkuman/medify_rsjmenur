<nav id="sidenav" class="bg-white">
    <div id="sidebar-scroll">
        <div class="sidebar-content">
            <div class="content-header content-header-fullrow px-15">
                <div class="content-header-section sidebar-mini-visible-b">
                    <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                        <span class="text-dual-primary-dark">a</span><span class="text-primary">d</span>
                    </span>
                </div>

                <div class="content-header-section text-center align-parent sidebar-mini-hidden">

                    <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                        <i class="fa fa-times text-danger"></i>
                    </button>

                    <div class="content-header-item">
                        <a class="link-effect font-w700" href="index.html">
                            <i class="fa fa-h-square fa-2x text-primary"></i>
                            <span class="font-size-xl text-dual-primary-dark">Medify</span> <span class="font-size-xl text-primary">Hospital</span>
                        </a>
                    </div>
                </div>
            </div>


            <div class="content-side content-side-full">
                <ul class="nav-main">
                        <li>
                            <a href="{{url('')}}"><i class="si si-home"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                        </li>
                        <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Menu Utama</span></li>
                        <li>
                            <a href="{{url('pasien')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Pasien</span></a>
                        </li>
                        <li>
                            <a href="{{url('igd')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">IGD</span></a>
                        </li>
                        <li>
                            <a href="{{url('rawatinap')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Rawat Inap</span></a>
                        </li>
                        <li>
                            <a href="{{url('rawatjalan')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Rawat Jalan</span></a>
                        </li>
                        {{--
                        <li>
                            <a href="{{url('')}}"><i class="fa fa-angle-double-down"></i><span class="sidebar-mini-hide">Menu Lainnya</span></a>
                        </li>
                        <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Arsip</span></li>
                        <li>
                            <a href="{{url('')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Arsip Kasus</span></a>
                        </li>
                        <li>
                            <a href="{{url('')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Log Book</span></a>
                        </li>
                        <li>
                            <a href="{{url('')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Gaji & Jasa Medis</span></a>
                        </li>
                        --}}
                    </ul>
            </div>
            <!-- END Side Navigation -->
        </div>
        <!-- Sidebar Content -->
    </div>
    <!-- END Sidebar Scroll Container -->
</nav>


<div id="page-overlay" onclick="closeNav()"></div>  