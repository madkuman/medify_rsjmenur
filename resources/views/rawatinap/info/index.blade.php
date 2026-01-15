@extends('rawatinap.layouts.main')

@section('title')
Informasi Ruangan - Rawat Inap - Medify
@endsection

@section('subtitle')
Informasi Ruangan
@endsection

@section('css')
<style type="text/css">
    .mt-5 {
        margin-bottom: 5px;
    }
</style>
@endsection

@section('content')
<main id="main-container">
    @include('rawatinap.layouts.navbar')
    <div class="container">
        <div class="row">
                        
            <div class="col-md-12">
            <ul class="list row row-deck">
                @foreach($bangsals as $bangsal)
                    <li class="col-md-3 text-center">
                        <a class="block block-link-pop" href="#">
                            <div class="block-content">
                                <div class="text-center mb-10">
                                    <h2 class="mb-0">KELAS {{strtoupper($bangsal->kelas_nama ?? '-')}}</h2>
                                </div>
                                <div class="text-center">
                                    <h2 class="text-primary mt-5 mb-0">
                                        {{$bangsal->bed_kosong ?? 0}} 
                                    </h2>
                                    <h5><small>KOSONG</small></h5>
                                </div>
                                <hr>
                                <table width="50%" class="center text-left" style="margin: 0px auto;">
                                    <tr>
                                        <td>Kapasitas</td>
                                        <td>:</td>
                                        <td class="text-right">{{$bangsal->bed_total ?? 0}}</td>
                                    </tr>
                                   {{-- <tr>
                                        <td>Booking</td>
                                        <td>:</td>
                                        <td class="text-right">{{$bangsal->pasien_booking ?? 0}}</td>
                                    </tr>--}}
                                    <tr>
                                        <td>Terisi</td>
                                        <td>:</td>
                                        <td class="text-right">{{$bangsal->pasien_total ?? 0}}</td>
                                    </tr>
                                </table>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            </div>
        </div>
    </div>
</main>
@endsection
