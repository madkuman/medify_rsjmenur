@extends('rawatinap.layouts.main')

@section('title')
Ruangan - Rawat Inap - Medify
@endsection

@section('subtitle')
Ruangan
@endsection

@section('content')


<main id="main-container">
    @include('rawatinap.layouts.navbar')
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center py-20">
                <h3>Daftar Ruangan</h3>
            </div>
            @foreach($bangsals as $bangsal)
            <div class="col-md-3">

                <a class="block block-rounded block-bordered block-link-pop text-center" href="{{url('rawatinap/bangsal/'.$bangsal->id)}}">
                    <div class="block-content">
                        <p class="font-size-h1 text-elegance">
                            <strong>{{$bangsal->nama}}</strong>
                        </p>
                        <p class="font-w600">
                            <i class="fa fa-user text-muted mr-5"></i> 
                            @if($bangsal->bed_total != 0)
                            {{$bangsal->pasien_total ?? 0}}
                            @else
                            0
                            @endif
                            / {{$bangsal->bed_total}}
                        </p>
                    </div>
                </a>

            </div>
            @endforeach
        </div>
    </div>
</main>
@endsection