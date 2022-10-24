
<div class="block block-rounded block-transparent">
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li>
                <a href="{{url('my/rekam-medis')}}"><i ><img src="{{asset('assets/icons/32/014-medical-history-1.png')}}" ></i><span class="sidebar-mini-hide">Rekam Medis Saya</span></a>
            </li>
            <li>
                <a href="{{url('my/group')}}"><i ><img src="{{asset('assets/icons/32/075-networking.png')}}" ></i><span class="sidebar-mini-hide">Grup Saya</span></a>
            </li>
            @if(!empty(Auth::user()->employee_id))
            <li>
                <a href="{{url('kepegawaian/pegawai/profile')}}/{{Auth::user()->employee_id}}"><i ><img src="{{asset('assets/icons/32/022-doctor-1.png')}}" ></i><span class="sidebar-mini-hide">Profil PERS</span></a>
            </li>
            @endif
            <li>
                <a href="{{url('my/arsip-kasus')}}"><i ><img src="{{asset('assets/icons/32/007-clipboard.png')}}" ></i><span class="sidebar-mini-hide">Arsip Kasus</span></a>
            </li>
            <li>
                <a href="{{config('app.url_sismadak')}}" target="_blank"><i ><img src="{{asset('assets/icons/32/medal.png')}}" ></i><span class="sidebar-mini-hide">Sismadak</span></a>
            </li>
            <li>
                <a href="{{url('covid19')}}" target="_blank"><i ><img src="{{asset('assets/icons/32/virus.png')}}" ></i><span class="sidebar-mini-hide">COVID 19</span>
                    <span class="badge badge-primary">New !</span>
                </a>
            </li>
            <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Menu Utama</span></li>
            @php $i = 0 @endphp
            @foreach($grup as $item)
            @if($item->invitation == 1)
            @if($i < 5)
            <li>
            @else
            <li class="module-hidden" style="display: none;">
            @endif
                <a href="{{url($item->grup->url)}}">
                <i>
                    @if(!empty($item->grup->icons_img))
                    <img src="{{asset('assets/icons')}}/32/{{$item->grup->icons_img}}" >
                    @else
                    <img src="{{asset($item->grup->photo_thumb)}}">
                    @endif
                </i>
                <span class="sidebar-mini-hide">{{$item->grup->name}}</span></a>
            </li>
            @php $i++ @endphp
            @endif
            @endforeach
            @if($i > 5)
            <li class="btn">
                <button id="expand-module" class="btn font-w300 py-0">
                    <span class="fa fa-angle-double-down"></span> Tampilkan lebih banyak
                </button>
                <button id="shrink-module" class="btn font-w300 py-0" style="display: none;">
                    <span class="fa fa-angle-double-up"></span> Tampilkan lebih sedikit
                </button>
            </li>
            @endif
            
            @if (!empty($kuisioner))
            <li class="nav-main-heading mt-20"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">KUESIONER TERISI</span></li>
                @foreach ($kuisioner as $item)
                    @if (count($item->jawaban) != 0)
                    <li>    
                        <a href="{{url('kuisioner/'.$item->slug)}}"><i class="fa fa-check text-success"></i><span class="sidebar-mini-hide">{{strtoupper($item->nama)}}</span></a>
                    </li>
                    @endif
                @endforeach
            @endif
            
            {{--
            <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span></li>
            <li>
                <a href="{{url('')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Arsip Kasus</span></a>
            </li>
            <li>
                <a href="{{url('')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Profil</span></a>
            </li>
            <li>
                <a href="{{ route('index-kepegawaian') }}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Informasi Kepegawaian</span></a>
            </li>
            <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Grup</span></li>
            @foreach($grup as $group)
            <li>
                <a href="{{url('')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">{{ $group->grup->name }}</span></a>
            </li>
            @endforeach
            --}}
        </ul>
    </div>
</div>