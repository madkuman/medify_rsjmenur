@extends('highlevel.layouts.main')

@section('title')
IGD - High Level Report
@endsection

@section('subtitle')
IGD
@endsection

@section('content')

<main id="main-container">
    @include('highlevel.layouts.navbar')
    <div class="container">
        <div class="row">
            <div class="col-xl-3 mb-20">
                
        @include('highlevel.layouts.sidebar')
            </div>
            <div class="col-xl-9">
                <div class="row row-deck">
                    <div class="col-xl-12">
                        <div class="block" id="kunjunganBlock">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Grafik Kunjungan Pasien</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div id="kunjunganChart" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="block" id="sepuluhBesarPenyakitBlock">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">10 Besar Penyakit</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div id="sepuluhBesarPenyakitChart" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="block" id="kunjunganPerRuanganBlock">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Pasien per Ruangan dalam Sebulan</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div id="kunjunganPerRuanganChart" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12" style="display: none">
                        <div class="block" id="lamaBaruBlock">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Pasien Lama Baru</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div id="lamaBaruChart" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="block" id="statusKeluarBlock">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Status Keluar Pasien</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div id="statusKeluarChart" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script src="{{ asset('bower/amcharts3/amcharts/amcharts.js') }}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/serial.js') }}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/pie.js') }}"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
@include('highlevel.components.igd.kunjungan')
@include('highlevel.components.igd.sepuluh-besar-penyakit')
@include('highlevel.components.igd.kunjungan-per-ruangan')
@include('highlevel.components.igd.status-keluar')

@endsection
