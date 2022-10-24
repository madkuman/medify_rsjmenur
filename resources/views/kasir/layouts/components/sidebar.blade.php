<div id="sidebar-scroll" class="bg-white" style="position: fixed; width: 14.5%" >
    <div class="sidebar-content" >

        <div class="content-side content-side-full px-10 align-parent">

            <div class="sidebar-mini-hidden-b text-center">
                <a class="img-link" href="be_pages_generic_profile.html">
                    <img class="img-avatar" src="{{asset('assets/img/avatars/avatar15.jpg')}}"  alt="">
                </a>
                <ul class="list-inline mt-10">
                    <li class="list-inline-item">
                        <a class="link-effect text-primary font-size-xs font-w600 text-uppercase" href="be_pages_generic_profile.html">{{$kasir->nama}}</a>
                        <h5 class="my-5">KASIR</h5>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content-side content-side-full pt-10" data-toggle="slimscroll" data-always-visible="true" data-height="389px" style="overflow-y:scroll;height: 100%">
            <ul class="nav-main">
                <li>
                    <a @if($sidebar_active == 'switch') class="active" @endif href="{{url('kasir')}}"><i class="si si-arrow-left"></i><span class="sidebar-mini-hide">Daftar Kasir</span></a>
                </li>

                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Menu Utama</span></li>
                <li>
                    <a @if($sidebar_active == 'dashboard') class="active" @endif href="{{url('kasir/'.$kasir->id.'/dashboard')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                </li>
                <li>
                    <a @if($sidebar_active == 'transaksi') class="active" @endif href="{{url('kasir/'.$kasir->id.'/transaksi')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Transaksi</span></a>
                </li>
                <li>
                    <a @if($sidebar_active == 'history') class="active" @endif href="{{url('kasir/'.$kasir->id.'/transaksi/history')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">History Transaksi</span></a>
                </li>

            </ul>
        </div>
    </div>
</div>