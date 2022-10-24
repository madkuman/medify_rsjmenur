<ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary">
    <li class="nav-item">
        <a class="nav-link
        @if ($active_nav == 'laporan' || empty($active_nav))
        active
        @endif
        " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/laporan">Laporan</a>
    </li>
</ul>
