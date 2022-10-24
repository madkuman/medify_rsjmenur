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
        <a class="nav-link @if(Route::currentRouteName() == 'departments') active @endif" href="{{url('kepegawaian/pegawai/jabatan')}}/{{$pegawai->id}}">Jabatan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() == 'families') active @endif" href="{{route('families', ['id' => $pegawai->id, '_' => microtime(true)])}}">Keluarga</a>
    </li>
    @php
        $active_link = Route::currentRouteName() == 'appretiations' || Route::currentRouteName() == 'surat_peringatan' || Route::currentRouteName() == 'legalitas' ? 'active' : '';
    @endphp
    <li class="nav-item">
        <a class="nav-link {{$active_link}}" href="#" id="toolbarDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Lainnya <i class="fa fa-angle-down ml-5"></i></a>

        <div class="dropdown-menu" aria-labelledby="toolbarDrop">
            <a class="dropdown-item @if(Route::currentRouteName() == 'appretiations') active @endif" href="{{route('appretiations', ['id' => $pegawai->id, '_' => microtime(true)])}}">
                Penghargaan
            </a>
            <a class="dropdown-item @if(Route::currentRouteName() == 'surat_peringatan') active @endif" href="{{route('surat_peringatan', ['id' => $pegawai->id, '_' => microtime(true)])}}">
                Surat Peringatan
            </a>
            <a class="dropdown-item @if(Route::currentRouteName() == 'legalitas') active @endif" href="{{route('legalitas', ['id' => $pegawai->id, '_' => microtime(true)])}}">
                Legalitas
            </a>
        </div>
    </li> 
</ul>