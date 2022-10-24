<ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary">
    <li class="nav-item">
        <a class="nav-link @if($active_nav == 'rencana_asuhan' || empty($active_nav))
        active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/keperawatan/rencana-asuhan">Rencana Asuhan Keperawatan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($active_nav == 'timbang_terima') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/keperawatan/timbang-terima">Timbang Terima</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($active_nav == 'nursing-notes') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/keperawatan/nursing-notes">Nursing Notes</a>
    </li>
</ul>