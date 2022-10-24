@extends('farmasi.layouts.main')

@section('title')
Farmasi Pengaturan Layar Antrian
@endsection

@section('content')
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Pengaturan</h3>
    </div>
    <div class="block-content">
        <div class="row row-deck">
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Pengaturan Jenis Antrian</h3>
                    </div>
                    <div class="block-content">
                        <p>Pengaturan Jenis Antrian</p>
                    </div>
                    <div class="block-content block-content-full">
                        <a class="btn btn-hero btn-sm btn-noborder btn-secondary" href="{{url('farmasi/'.session('farmasi')->slug.'/screen-tv/jenis-antrian/')}}">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Pengaturan Waktu Estimasi Per Jenis Resep</h3>
                    </div>
                    <div class="block-content">
                        <p>Pengaturan Waktu Estimasi Per Jenis Resep</p>
                    </div>
                    <div class="block-content block-content-full">
                        <a class="btn btn-hero btn-sm btn-noborder btn-secondary" href="{{url('farmasi/'.session('farmasi')->slug.'/screen-tv/waktu-estimasi')}}">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Pengaturan Loket Antrian</h3>
                    </div>
                    <div class="block-content">
                        <p>Pengaturan Loket Antrian</p>
                    </div>
                    <div class="block-content block-content-full">
                        <a class="btn btn-hero btn-sm btn-noborder btn-secondary" href="{{url('farmasi/'.session('farmasi')->slug.'/screen-tv/loket-antrian')}}">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
        <hr>
    </div>
</div>
@endsection