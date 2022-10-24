@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - {{$title_extra}}
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    @include('kasus.layouts.header')

    <div class="content">
        <div class="row"  id="form-list">
            @include('kasus.layouts.sidebar')
            <div class="col-lg-9 col-xl-9">
                <div class="row mb-20">
                    <div class="col-12">
                        <input type="text" class="form-control fuzzy-search" placeholder="Cari Form">
                    </div>
                </div>
                <div class="row row-deck list" >
                    @foreach($form as $item)
                    <div class="col-md-4 text-center ">
                        <a class="block block-link-pop block-themed" href="{{url()->current()}}/{{$item->id}}">
                            <div class="block-content">
                                <h5 class="mb-5 judul">{{$item->judul}}</h5>
                                <p class="deskripsi">{{$item->deskripsi}}</p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')

<script src="{{asset('assets/js/plugins/listjs/list.min.js')}}"></script>
<script type="text/javascript">
    var options = {
        valueNames: [ 'judul', 'deskripsi' ]
    };

    var hackerList = new List('form-list', options);
</script>

@endsection

