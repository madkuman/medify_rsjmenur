@extends('highlevel.layouts.main')

@section('title')
Kamar Operasi - High Level Report
@endsection

@section('subtitle')
Kamar Operasi
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
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title"><center>Permintaan Operasi ({{$count_permintaan}})</center></h3>
                            </div>
                            <div class="block-content block-content-full">
                              @if($permintaans->count())
                                <table class="table table-hover table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Pasien</th>
                                            <th>Diagnosis</th>
                                            <th>Waktu Permintaan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permintaans as $i => $permintaan)
                                        <tr>
                                            <td>{{$i+1}}</td>
                                            <td>@isset($permintaan->pasien_detail->name){{$permintaan->pasien_detail->name}}@endisset</td>
                                            <td>{{$permintaan->diagnosis ? $permintaan->diagnosis : '-'}}</td>
                                            <td>{{$permintaan->getWaktuPermintaan()->diffForHumans()}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                              @else
                              <h4 class="text-center">Tidak ada Data</h4>
                              @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-deck">
                    <div class="col-xl-12">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title"><center>Jadwal Operasi Hari Ini ({{$count_jadwal}})</center></h3>
                            </div>
                            <div class="block-content block-content-full">
                                <table class="table table-hover table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Pasien</th>
                                            <th>Ruangan</th>
                                            <th>Ronde</th>
                                            <th>Dokter</th>
                                            <th>Jenis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1 @endphp
                                        @forelse ($jadwals as $jadwal)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$jadwal->pasien_detail->name}}</td>
                                            <td>{{$jadwal->ruangan->nama}}</td>
                                            <td>{{$jadwal->nomor_ronde}}</td>
                                            <td>{{$jadwal->dokter->nama}}</td>
                                            <td>{{$jadwal->hasil ? $jadwal->hasil->jenis_operasi ? $jadwal->hasil->jenis_operasi : '-' : '-'}}</td>
                                        </tr>
                                        @empty
                                        <tr class="text-center">
                                              <td colspan="6">Belum ada operasi untuk hari ini</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-deck">
                    <div class="col-12">
                        <div class="block">
                            <div class="block-content block-content-full text-center">
                                <h5>Occupancy Kamar Operasi Dalam 1 Bulan</h5>
                                <div id="occupancy-chart" style="width:100%; height:400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-deck">
                    <div class="col-12">
                        <div class="block">
                            <div class="block-content block-content-full text-center">
                                <h5>Kasus Terbanyak Dalam 1 Bulan</h5>
                                <div id="kasus-terbanyak-chart" style="width:100%; height:400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-deck">
                    <div class="col-12">
                        <div class="block">
                            <div class="block-content block-content-full text-center">
                                <h5>Kamar Operasi Dengan Efektifitas Tertinggi Selama Sebulan</h5>
                                <div id="ok-tertinggi-chart" style="width:100%; height:400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-deck">
                    <div class="col-12">
                        <div class="block">
                            <div class="block-content block-content-full text-center">
                                <h5>Distribusi Jenis Operasi Selama Sebulan</h5>
                                <div id="jenis-operasi-chart" style="width:100%; height:400px;"></div>
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
<script src="{{ asset('bower/amcharts3/amcharts/pie.js') }}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/serial.js') }}"></script>
@include('kamaroperasi.laporan.components.js-ok-occupancy')
@include('kamaroperasi.laporan.components.js-kasus-terbanyak')
@include('kamaroperasi.laporan.components.js-ok-tertinggi')
@include('kamaroperasi.laporan.components.js-jenis-operasi')

@endsection