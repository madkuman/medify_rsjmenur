<div class="row">
    <div class="col-12">
        <div class="block" style="background-color: #FCFCFD">
            <div class="block-content container pb-10">
                <a href="{{url('rekammedis/permintaan/baru')}}" class="btn btn-outline-primary pull-right">+ Permintaan File</a>
                <h4><span class="text-muted font-w400">Rekam Medis / </span> @yield('subtitle')</h4>
                <ul class="nav">
                  <!--  <li class="nav-item">
                        <a class="nav-link link-effect active" href="{{url('rekammedis')}}"><i class="fa fa-stethoscope"></i> Dashboard</a>
                    </li>
                   --> <li class="nav-item">
                        <a class="nav-link link-effect active" href="{{url('rekammedis/permintaan')}}"><i class="fa fa-address-book"></i> Permintaan File</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-effect active" href="{{url('rekammedis/pengembalian')}}"><i class="fa fa-address-book"></i> Pengembalian File</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-effect active" href="{{url('rekammedis/file-tidak-di-rm')}}"><i class="fa fa-question-circle"></i> Daftar File Tidak di RM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-effect" href="{{url('rekammedis/cari')}}"><i class="fa fa-search"></i> Cari RM</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>