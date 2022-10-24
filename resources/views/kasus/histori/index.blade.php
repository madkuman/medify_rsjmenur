@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}}  - Penunjang - Kasus
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    @include('kasus.layouts.header')

    <div class="content">
        <div class="row">
            @include('kasus.layouts.sidebar')

            <!-- Updates -->
            <div class="col-lg-4 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="block">
                            <div class="block-content pb-15">
                                <h4 class="my-0">Histori Kasus Pasien</h4>
                                <hr class="my-20">
                                <ul class="nav-users nav-users-big">
                                    @foreach($histori as $item)
                                    <li>

                                        @if($kasus->id == $item->id) 
                                        <a href="javascript:void(0)">
                                        @else
                                        <a href="{{url('kasus/')}}/{{$item->nomor_kasus}}">
                                        @endif

                                            <img class="img-avatar" src="{{asset('assets/img/avatars/avatar5.jpg')}}" alt="">
                                            {{$item->judul_kasus}} 
                                            <span class="text-muted"> 
                                                @if($kasus->id == $item->id) (Kasus Saat Ini) @endif
                                            </span>
                                            <div class="font-w400 font-size-xs text-muted">
                                                {{date('d F Y, H:i', strtotime($item->created_at))}}
                                            </div>
                                            <div class="font-w400 font-size-xs text-muted">{{$item->lokasi->lokasi->departemen->nama}} - {{$item->lokasi->lokasi->nama}}</div>
                                        </a>
                                    </li>
                                    @endforeach
                                  
                                </ul>
                                
                            </div>
                            @if(count($anak) > 0)
                            <div class="block-content pb-15">
                                <h4 class="my-0">Histori Kasus Anak Pasien</h4>
                                <hr class="my-20">
                                <ul class="nav-users nav-users-big">
                                    @foreach($anak as $item)
                                    <li>

                                        @if($kasus->id == $item->id) 
                                        <a href="javascript:void(0)">
                                        @else
                                        <a href="{{url('kasus/')}}/{{$item->nomor_kasus}}">
                                        @endif

                                            <img class="img-avatar" src="{{asset('assets/img/avatars/avatar5.jpg')}}" alt="">
                                            {{$item->judul_kasus}}
                                            <div class="font-w400 font-size-xs text-muted">
                                                {{date('d F Y, H:i', strtotime($item->created_at))}}
                                            </div>
                                            <div class="font-w400 font-size-xs text-muted">{{$item->lokasi->lokasi->departemen->nama}} - {{$item->lokasi->lokasi->nama}}</div>
                                        </a>
                                    </li>
                                    @endforeach
                                  
                                </ul>
                            </div> 
                            @endif
                            @if(count($ibu) > 0)
                            <div class="block-content pb-15">
                                <h4 class="my-0">Histori Kasus Ibu Pasien</h4>
                                <hr class="my-20">
                                <ul class="nav-users nav-users-big">
                                    @foreach($ibu as $item)
                                    <li>

                                        @if($kasus->id == $item->id) 
                                        <a href="javascript:void(0)">
                                        @else
                                        <a href="{{url('kasus/')}}/{{$item->nomor_kasus}}">
                                        @endif

                                            <img class="img-avatar" src="{{asset('assets/img/avatars/avatar5.jpg')}}" alt="">
                                            {{$item->judul_kasus}}
                                            <div class="font-w400 font-size-xs text-muted">
                                                {{date('d F Y, H:i', strtotime($item->created_at))}}
                                            </div>
                                            <div class="font-w400 font-size-xs text-muted">{{$item->lokasi->lokasi->departemen->nama}} - {{$item->lokasi->lokasi->nama}}</div>
                                        </a>
                                    </li>
                                    @endforeach
                                  
                                </ul>
                            </div>
                            @endif 
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Updates -->
        </div>
    </div>
</main>



<!--MODAL-->




@endsection

@section('js')


@endsection