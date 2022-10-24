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
                <div class="block">
                    <ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link @if ($active_nav == 'skrining-ulang') active @endif" href="#asesmen-gizi" id="nav-asesmen-gizi">Asesmen</a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link @if ($active_nav == 'skrining') active @endif" href="#skrining" id="nav-skrining">Skrining Gizi</a>--}}
{{--                        </li>--}}
                        <li class="nav-item">
                            <a class="nav-link @if ($active_nav == 'asesmen') active @endif" href="#asesmen" id="nav-asesmen">Asesmen Awal Lanjutan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  @if ($active_nav == 'order') active @endif" href="#order" id="nav-order">Order Diet</a>
                        </li>
                    </ul>
                    <div class="block-content tab-content overflow-hidden">
                        <div class="tab-pane fade fade-left @if ($active_nav == 'order')  show active @endif" id="order" role="tabpanel">
                            @include('kasus.gizi.content.order.index')
                        </div>
                        <div class="tab-pane fade fade-left @if ($active_nav == 'asesmen')  show active @endif" id="asesmen" role="tabpanel">
                            @include('kasus.gizi.content.asesmen.index')
                        </div>
{{--                        <div class="tab-pane fade fade-left @if ($active_nav == 'skrining') show active @endif" id="skrining" role="tabpanel">--}}
{{--                            @include('kasus.gizi.content.skrining.index')--}}
{{--                        </div>--}}
                        <div class="tab-pane fade fade-left @if ($active_nav == 'skrining-ulang')  show active @endif" id="asesmen-gizi" role="tabpanel">
                            @include('kasus.gizi.content.asesmen-gizi.index')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('kasus.gizi.content.skrining.add')
    @include('kasus.gizi.content.skrining.add-anak')
    @include('kasus.gizi.content.skrining.add-kebidanan')
    @include('kasus.gizi.content.order.modal-mutu')
    @include('kasus.gizi.content.asesmen.modal-add')
    @include('kasus.gizi.content.order.modal-edit')


   


</main>
@endsection

@section('js')
@include('kasus.datamedis.content.js.gizi')
@include('kasus.gizi.content.skrining.js')
@include('kasus.gizi.content.asesmen.js')
<script src="{{asset('js/gizi/function.js')}}"></script>
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.time').mask('00:00');
    });
</script>
@endsection