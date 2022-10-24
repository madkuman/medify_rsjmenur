@extends('rawatinap.layouts.main')

@section('title')
Pengaturan Bangsal - Rawat Inap - Medify
@endsection

@section('subtitle')
Pengaturan Bangsal
@endsection

@section('content')


<main id="main-container">
    @include('rawatinap.layouts.navbar')
    <div class="container">
        <div class="text-center py-20">
            <h3>Daftar Bangsal</h3>
        </div>
        <div class="row row-deck">
            <div class="col-md-3">

            <a class="block block-rounded block-bordered block-link-pop text-center bg-primary" href="{{url('rawatinap/pengaturan/bangsal/new')}}">
                <div class="block-content pt-20">
                    <p class="font-size-h5 text-elegance text-white">
                        <i class="fa fa-plus-circle fa-3x text-white"></i><br>
                        <strong class="text-white">Buat Bangsal Baru</strong>
                    </p>
                </div>
            </a>
            </div>    
            @foreach($bangsals as $bangsal)
            <div class="col-md-3">

                <a class="block block-rounded block-bordered block-link-pop text-center" href="{{url('rawatinap/pengaturan/bangsal/'.$bangsal->id)}}">
                    <div class="block-content">
                        <p class="font-size-h1 text-elegance">
                            <strong>{{$bangsal->nama}}</strong>
                        </p>
                        <p class="font-w600">
                            <span class="mr-10"><i class="fa fa-home text-muted"></i> 
                             {{count($bangsal->ruangan)}}
                         </span>
                         <i class="fa fa-bed text-muted"></i> 
                         @if(!empty($bangsal->count_tempat_tidur_total))
                         {{$bangsal->count_tempat_tidur_total}}
                         @else
                         0
                         @endif
                     </p>
                     <p class="font-w600">
                        <i class="fa fa-chart-area text-muted"></i> {{ $bangsal->count_tempat_tidur_statistik }} / {{ $bangsal->count_tempat_tidur_total }}
                     </p>
                 </div>
             </a>
            </div>
         @endforeach
        </div>
    </div>
</main>
@endsection