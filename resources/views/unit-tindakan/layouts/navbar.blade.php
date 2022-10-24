<div class="row">
    <div class="col-12">
        <div class="block" style="background-color: #FCFCFD">
            <div class="block-content container pb-10">
                <h4><span class="text-muted font-w400">Unit Tindakan / </span> @yield('subtitle')</h4>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link link-effect active" href="{{url('unit-tindakan/'.$tindakan->slug.'/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-effect active" href="{{url('unit-tindakan/'.$tindakan->slug.'/histori')}}"><i class="fa fa-address-book"></i> Histori Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-effect" href="{{url('unit-tindakan/'.$tindakan->slug.'/pengaturan')}}"><i class="fa fa-cog"></i> Pengaturan</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>