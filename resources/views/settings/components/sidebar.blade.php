<div class="col-md-3 mb-20">
    <div class="block block-content block-link-shadow">
        <h5 class="mb-0">
            {{Auth::user()->name}}
            <br>
            <small>{{Auth::user()->profesi_detail->title}}</small>
            @if(!empty(Auth::user()->specialty))
            <small class="font-w400"> - {{Auth::user()->specialty_detail->name}}</small>
            @endif
        </h5>
    </div>
    <div class="list-group">
        <a class="list-group-item" href="{{url('settings/account')}}">Akun</a>
        <a class="list-group-item" href="{{url('settings/password')}}">Password</a>
        <a class="list-group-item" href="{{url('settings/profession')}}">Profesi</a>
        @if(Auth::user()->profesi == 1)
        <a class="list-group-item" href="{{url('settings/publication')}}">Publikasi</a>
        @endif 
        <a class="list-group-item" href="{{url('settings/sync')}}">Sinkronisasi Akun</a>
        <a class="list-group-item" href="{{url('settings/tanda-tangan')}}">Tanda Tangan</a>
        @if(Auth::user()->profesi == 1)
        <a class="list-group-item" href="{{url('settings/dokter-paket-obat')}}">Paket Obat</a>
        <a class="list-group-item" href="{{url('settings/perizinan-akses')}}">Perizinan & Akses</a>
        @endif
    </div>
</div>