@if(Auth::user()->profesi == 1)
@if(empty(Auth::user()->dokter_id))
<a class="block block-transparent text-center bg-danger" href="{{url('getting-started/integrasi-dpjp')}}">
    <div class="block-content">
        <p class="mt-5">
            <i class="fa fa-user-md fa-4x text-white"></i>
        </p>
        <p class="font-w600 text-white">Akun Anda Belum Terintegrasi dengan BPJS!<br><small class="text-white">Integrasikan akun anda, untuk mempermudah proses administrasi dan pembuatan SEP BPJS</small></p>
    </div>
</a>
@endif
@if(empty(Auth::user()->ttd))
<a class="block block-transparent text-center bg-primary" href="{{url('settings/tanda-tangan')}}">
    <div class="block-content">
        <p class="mt-5">
            <i class="fa fa-signature fa-4x text-white"></i>
        </p>
        <p class="font-w600 text-white">NEW!<br><small class="text-white">Berbagai form kini dapat otomatis ditanda tangani. Setting Tanda Tangan Anda Sekarang Juga</small></p>
    </div>
</a>
@endif
@endif

@if (!empty($kuisioner))
    @foreach ($kuisioner as $item)
        @if (count($item->jawaban) == 0)
        <a class="block text-center" href="{{url('kuisioner/'.$item->slug)}}">
            <div class="block-content ribbon {{count($item->jawaban) == 0 ? 'ribbon-danger' : 'ribbon-success'}}">
                <div class="ribbon-box">BELUM DIISI</div>
                <p class="mt-5">
                    <i class="fa fa-edit fa-4x text-primary"></i>
                </p>
                <p class="font-w600 mb-10">{{strtoupper($item->nama)}}</p>
                <small class="font-w700">{{$item->deskripsi}}</small>
            </div>
        </a>
        @endif
    @endforeach
@endif


<div class="block">
    
    <div class="block-header">
        <h6 class="text-uppercase mb-0">Undangan Kasus</h6>
    </div>
    <ul class="nav-users nav-users-big">
        @forelse($undangan_kasus as $item)
        <li>
            <a class="pl-10" href="javascript:void(0)" onclick="openModalUndanganKasus({{$item->id}})">
                <div class="row">
                    <div class="col-lg-2">
                        <img class="img-avatar" src="{{asset('')}}/{{$item->kasus->pasien->photo_thumb}}" alt="" style="height: 32px;width: 32px">
                    </div>
                    <div class="col-lg-10">

                        <span class="text-uppercase "> {{$item->kasus->judul_kasus}} </span>
                        <div class="font-w400 font-size-xs text-black"> 
                        {{$item->kasus->pasien->name}}</div>
                        <div class="font-w400 font-size-xs text-muted">
                            @if(isset($item->kasus->pasien->gender))
                            {{$item->kasus->pasien->gender == 1 ? 'Laki laki' : 'Perempuan' }}, {{$item->kasus->pasien->age ?? ''}} Tahun
                            @endif
                        </div>
                    </div>                                        
                </div>
            </a>
        </li>
        @empty
        <li class="py-20 text-center">
            Belum ada undangan kasus
        </li>
        @endforelse
    </ul>
</div>

<div class="block">
    <div class="block-header">
        <h6 class="text-uppercase mb-0">Undangan Grup</h6>
    </div>
    <ul class="nav-users nav-users-big">
        @forelse($undangan_grup as $item)
        <li>
            <a class="pl-10" href="javascript:void(0)" onclick="openModalUndanganGrup({{$item->id}})">
                <div class="row">
                    <div class="col-lg-2">
                        <img class="img-avatar" src="{{asset('assets/img/poli/001-brain.png')}}/" alt="" style="height: 32px;width: 32px">
                    </div>
                    <div class="col-lg-10">
                        <span class="text-uppercase "> 
                            {{$item->grup->name}} 
                            @if(!empty($item->grup->official))
                            <i class="fa fa-check-circle"></i>
                            @endif
                         </span>
                        <!-- <div class="font-w400 font-size-xs text-black"> 
                        Deskripsi Singkat Gr...</div> -->
                    </div>                                        
                </div>
            </a>
        </li>
        @empty
        <li class="py-20 text-center">
            Belum ada undangan grup
        </li>
        @endforelse
    </ul>
</div>

{{--
    <div class="block block-link-shadow">
        <div class="block-content block-content-full">
            <div class="py-20 text-center">
                <div class="font-size-h2 font-w700 text-success">{{$stat}}</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">Operasi hari ini</div>
            </div>
        </div>
    </div>
    <div class="block block-link-shadow">
        <div class="block-content block-content-full">
            <div class="py-20 text-center">
                <div class="font-size-h2 font-w700 text-success">{{$stat}}</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">Di bulan ini</div>
            </div>
        </div>
    </div>
    --}}