<ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary">
    <li class="nav-item">
        <a class="nav-link @if($active_nav == 'ringkasan_pasien_pulang' || empty($active_nav))
        active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/ringkasan-pasien-pulang">Ringkasan Pasien Pulang</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($active_nav == 'ringkasan_masuk_keluar') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/ringkasan-pasien-masuk-dan-keluar">Ringkasan Masuk Keluar</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($active_nav == 'resume_gawat_darurat') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/resume-gawat-darurat">Resume Gawat Darurat</a>
    </li>
</ul>