@extends('gizi.layouts.index')

@section('title')
    Gizi Monitoring
@endsection

@section('css')
    
@endsection

@section('content')
    <div class="content px-0" style="background-color: #f5f6f7">
        <div class="text-center py-20">
            <h3 class="mb-0">Daftar Ruangan</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach($bangsals as $bangsal)
                <div class="col-md-3">

                    <a class="block block-rounded block-bordered block-link-pop text-center" href="{{url('gizi/monitoring/bangsal/'.$bangsal->id)}}">
                        <div class="block-header">

                        </div>
                        <div class="block-content">
                            <p class="font-size-h1 text-elegance">
                                <strong>{{$bangsal->nama}}</strong>
                            </p>
                            <p class="font-w600 text-pulse">
                                @if($mark[$bangsal->nama]['status'] == 1) <i class="fa fa-utensils fa-2x"></i> @endif
                                {{$mark[$bangsal->nama]['total_pasien']-$mark[$bangsal->nama]['belum_pesan']}}
                                /
                                {{$mark[$bangsal->nama]['total_pasien']}}
                            </p>

                        </div>
                    </a>

                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('js')

    
    
@endsection