@extends('rekammedis.layouts.main')

@section('title')
Notifikasi Saya
@endsection

@section('css')
<style type="text/css">
.hvr:hover
{
    background-color: lavender;
}
</style>
@endsection


@section('content')
<main id="main-container">
    <div class="container pt-50 px-100">
        <h5 class="text-uppercase text-muted">Notifikasi Saya</h5>
        <div class="block block-rounded block-transparent">
            <div class="row">
                @if($notif_unread->count() > 0)
                <div class="col-md-12">
                    <a class="link-effect pull-right mb-15" href="{{url('')}}/notification/mark_all_as_read">
                        Tandai Semua Sudah Dibaca
                    </a>
                    <h6 class="text-uppercase text-muted my-0 py-0">Notifikasi Belum Dibaca</h5>
                        <hr class="mt-0 mb-10">
                    </div>
                    @foreach($notif_unread as $item)
                    <div class="col-md-12 row hvr" style="padding: 15px;">
                        <div class="col-md-1">
                            @if(!empty($item->creator->avatar_ori))
                            <img class="img-avatar-sm" src="{{asset($item->creator->avatar_ori)}}" alt="">
                            @else
                            <img class="img-avatar-sm" src="{{url('assets/img/placeholder.jpg')}}" alt="">
                            @endif
                        </div>
                        <div class="col-md-11">
                            <a class="font-w600 font-size-s text-black" href="{{url('')}}/notification/mark_as_read/{{$item->id}}">{{$item->description}}</a>
                            <br>
                            <span class="font-w400 font-size-xs text-muted">
                                {{$item->created_at->diffForHumans()}}
                            </span>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <div class="col-md-12">
                        <h6 class="text-uppercase text-muted mt-20 mb-0" style="padding-top: 50px">Notifikasi Sudah Dibaca</h5>
                            <hr class="mt-0 mb-10">
                        </div>
                        @foreach($notif_read as $item)
                        <div class="col-md-12 row hvr" style="padding: 15px;">
                            <div class="col-md-1">
                                @if(!empty($item->creator->avatar_ori))
                                <img class="img-avatar-sm" src="{{asset($item->creator->avatar_ori)}}" alt="">
                                @else
                                <img class="img-avatar-sm" src="{{url('assets/img/placeholder.jpg')}}" alt="">
                                @endif
                            </div>
                            <div class="col-md-11">
                                <a class="font-w400 font-size-s text-muted" href="{{url('')}}/{{$item->url}}">{{$item->description}}</a>
                                <br>
                                <span class="font-w400 font-size-xs text-muted">
                                    {{$item->created_at->diffForHumans()}}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>

        @endsection
        @section('js')
        @endsection