@extends('rekammedis.layouts.main')

@section('title')
Hasil Pencarian untuk '{{$keyword}}'
@endsection

@section('content')
<main id="main-container">
    <div class="row" style="padding-top: 50px;">
        <div class="col-3 full-only"></div>
        <div class="container col-lg-6 col-sm-12 px-30">

            <form autocomplete="off" class="push pb-0 mb-20" action="{{url('search')}}" method="get">
                <div class="input-group input-group-lg">
                    @if(Request::is('getting-started/*'))
                    <input type="text" class="form-control" placeholder="Cari.." id="navbarSearch" name="keyword"aria-haspopup="true" aria-expanded="false" disabled="disabled">
                    @else
                    <input type="text" class="form-control" placeholder="Cari.." id="navbarSearch" name="keyword"aria-haspopup="true" aria-expanded="false">
                    @endif
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <div class="dropdown-menu" id="search-dropdown" aria-labelledby="navbarSearch" x-placement="bottom-end" style="position: absolute; transform: translate3d(-57px, 34px, 0px); top: 100%; left: 0px; right: 0px; will-change: transform;">
                    </div>
                </div>
            </form>


            <h5 class="text-uppercase text-muted text-center">Hasil Pencarian untuk '{{$keyword}}'</h5>
            <div class="block block-rounded block-transparent">
                <div class="row mx-0">
                    <div class="col-md-12 pl-0" style="padding-bottom: 10px">
                        <h6 class="text-uppercase text-muted my-0 py-0">User</h6>
                    </div>
                    <div class="col-md-12 row block border" style="padding: 0px; margin: 0px; margin-bottom: 30px;">
                        @forelse($result['users'] as $item)
                        <div class="block-content col-md-12 row" style="margin: 0px; padding-left: 0px; padding-top: 20px; padding-bottom: 20px; border-bottom: 1px solid gainsboro">
                            <div class="col-md-1">
                                @if(!empty($item->avatar_ori))
                                <img class="img-avatar-sm" src="{{asset($item->avatar_ori)}}" alt="">
                                @else
                                <img class="img-avatar-sm" src="{{url('assets/img/placeholder.jpg')}}" alt="">
                                @endif
                            </div>
                            <div class="col-md-11">
                                <a class="font-w600 font-size-s text-black" href="{{url('profil')}}/{{$item->id}}">{{$item->name}}</a>
                                <br>
                                <span class="font-w400 font-size-xs text-muted">
                                    {{$item->profesi_detail->title ?? ''}}
                                </span>
                            </div>
                        </div>
                        @empty
                        <div class="block-content py-20">
                            <div class="text-center mt-10">
                                <div class="font-w600 mb-5">User tidak dapat ditemukan</div>
                            </div>
                        </div>
                        @endforelse    
                    </div>
                    <div class="col-md-12 pl-0" style="padding-bottom: 10px"> 
                        <h6 class="text-uppercase text-muted mt-20 mb-0">Grup</h6>
                    </div>
                    <div class="block border col-md-12 row" style="padding: 0px; margin: 0px;">
                        @forelse($result['groups'] as $item)
                        <div class="block-content col-md-12 row mb-10" style="margin: 0px; padding-left: 0px; padding-top: 20px; padding-bottom: 20px; border-bottom: 1px solid gainsboro">
                            <div class="col-md-1">
                                @if(!empty($item->photo_ori))
                                <img class="img-avatar-sm" src="{{asset($item->photo_ori)}}" alt="">
                                @else
                                <img class="img-avatar-sm" src="{{url('assets/img/poli/001-brain.png')}}" alt="">
                                @endif
                            </div>
                            <div class="col-md-11">
                                <a class="font-w600 font-size-s text-black" href="{{url('group')}}/{{$item->slug}}/members">{{$item->name}}</a>
                                <br>
                            </div>
                        </div>
                        @empty
                        <div class="block-content py-20">
                            <div class="text-center mt-10">
                                <div class="font-w600 mb-5">Grup tidak dapat ditemukan</div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 full-only"></div>
    </div>
</main>

@endsection
@section('js')
@endsection