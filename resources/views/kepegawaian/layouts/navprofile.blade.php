<ul class="nav nav-tabs nav-tabs-alt nav-fill nav-justified text-center">
    <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() == 'profile') active @endif" id="profile-active" href="{{route('profile', ['id' => $pegawai->id, '_' => microtime(true)])}}" >Profil</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() == 'trainings') active @endif" href="{{route('trainings', ['id' => $pegawai->id, '_' => microtime(true)])}}">Pelatihan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() == 'educations') active @endif" href="{{route('educations', ['id' => $pegawai->id, '_' => microtime(true)])}}">Pendidikan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() == 'positions') active @endif" href="{{route('positions', ['id' => $pegawai->id, '_' => microtime(true)])}}">Pangkat</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() == 'departments') active @endif" href="{{url('kepegawaian/pegawai/jabatan/{{$pegawai->id}}')}}">Jabatan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() == 'appretiations') active @endif" href="{{route('appretiations', ['id' => $pegawai->id, '_' => microtime(true)])}}">Tanda Jasa</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() == 'families') active @endif" href="{{route('families', ['id' => $pegawai->id, '_' => microtime(true)])}}">Keluarga</a>
    </li>	
</ul>