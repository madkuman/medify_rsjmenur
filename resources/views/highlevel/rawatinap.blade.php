@extends('highlevel.layouts.main')

@section('title')
Rawat Inap - High Level Report
@endsection

@section('subtitle')
Rawat Inap
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
                    <div class="col-sm-6" style="max-height: 200px;">
                        <div class="block">
                            <div class="block-content">
                                <div class="text-right text-primary display-4 font-w600">{{$bed['semua']}}</div>
                                <div class="font-size-md font-w600 text-uppercase text-right">total Bed</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" style="max-height: 200px;">
                        <div class="block">
                            <div class="block-content">
                                <div class="text-right text-primary display-4 font-w600">{{$bed['terisi']}} / {{$bed['kosong']}}</div>
                                <div class="font-size-md font-w600 text-uppercase text-right">Bed terisi / Kosong </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" style="max-height: 200px;">
                        <div class="block">
                            <div class="block-content">
                                <div class="text-right text-primary display-4 font-w600">{{$bor_bulan_lalu}}</div>
                                <div class="font-size-md font-w600 text-uppercase text-right">BOR Bulan Lalu</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" style="max-height: 200px;">
                        <div class="block">
                            <div class="block-content">
                                <div class="text-right text-primary display-4 font-w600">{{$avlos_bulan_lalu}}</div>
                                <div class="font-size-md font-w600 text-uppercase text-right">AVLOS Bulan Lalu</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" style="max-height: 200px;">
                        <div class="block">
                            <div class="block-content">
                                <div class="text-right text-primary display-4 font-w600">{{$toi_bulan_lalu}}</div>
                                <div class="font-size-md font-w600 text-uppercase text-right">TOI Bulan Lalu</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" style="max-height: 200px;">
                        <div class="block">
                            <div class="block-content">
                                <div class="text-right text-primary display-4 font-w600">{{$bto_bulan_lalu}}</div>
                                <div class="font-size-md font-w600 text-uppercase text-right">BTO Bulan Lalu</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" style="max-height: 200px;">
                        <div class="block">
                            <div class="block-content">
                                <div class="text-right text-primary display-4 font-w600">{{$ndr_bulan_lalu}}</div>
                                <div class="font-size-md font-w600 text-uppercase text-right">NDR Bulan Lalu</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" style="max-height: 200px;">
                        <div class="block">
                            <div class="block-content">
                                <div class="text-right text-primary display-4 font-w600">{{$gdr_bulan_lalu}}</div>
                                <div class="font-size-md font-w600 text-uppercase text-right">GDR Bulan Lalu</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-deck">
                    <div class="col-md-6">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">
                                    10 Besar Penyakit Bulan Lalu
                                </h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="row gutters-tiny">
                                    <div class="col-12">
                                        <table width="100%" class="table table-striped table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">No</th>
                                                    <th>Nama Penyakit</th>
                                                    <th class="text-center">Jumlah Kasus</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($sepuluhPenyakit as $index => $item)
                                                <tr>
                                                    <td class="text-center" >{{$index+1}}</td>
                                                    @if(!empty($item))
                                                    <td>{{$item->golongan_sebab_sebab_sakit}}</td>
                                                    @php
                                                    $total_1 = $item->transaksi['all-1'] ?? 0;
                                                    $total_2 = $item->transaksi['all-2'] ?? 0;
                                                    $total = $total_1 + $total_2;
                                                    @endphp
                                                    <td class="text-center">{{$total}}</td>
                                                    @else
                                                    <td></td>
                                                    <td></td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Bor </h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                        <i class="si si-refresh"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="js-flot-lines" style="height: 340px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-deck">
                    <div class="col-xl-6">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">AVLOS </h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                        <i class="si si-refresh"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="js-flot-lines2" style="height: 340px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">TOI </h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                        <i class="si si-refresh"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="js-flot-lines3" style="height: 340px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">BTO </h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                        <i class="si si-refresh"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="js-flot-lines4" style="height: 340px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">GDR </h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                        <i class="si si-refresh"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="js-flot-lines5" style="height: 340px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">NDR </h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                        <i class="si si-refresh"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="js-flot-lines6" style="height: 340px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Distribusi Asal Pasien </h3>
                            </div>
                            <div class="block-content block-content-full">
                                @if($distribusi_rj==0 && $distribusi_igd==0)
                                <div class="chart-null text-center" style="height: 250px;">
                                    Tidak ada data yang ditampilkan
                                </div>
                                @else
                                <div class="js-flot-pie1" style="height: 250px;"></div>
                                @endif
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
<script src="{{ asset('bower/amcharts3/amcharts/plugins/export/export.min.js') }}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/themes/light.js') }}"></script>
<script src="{{ asset('js/rawat-inap/borv1.1.js')}}"></script>

<script type="text/javascript">

        
        var BeCompCharts = function() {
            var initChartsFlot = function(){
                var flotLines = jQuery('.js-flot-lines');
                var flotLines2 = jQuery('.js-flot-lines2');
                var flotLines3 = jQuery('.js-flot-lines3');
                var flotLines4 = jQuery('.js-flot-lines4');
                var flotLines5 = jQuery('.js-flot-lines5');
                var flotLines6 = jQuery('.js-flot-lines6');
                var flotPie1 = jQuery('.js-flot-pie1');


                var dataLine    = [];


                var dataMonths  = [[1, 'Jan'], [2, 'Feb'], [3, 'Mar'], [4, 'Apr'], [5, 'May'], [6, 'Jun'], [7, 'Jul'], [8, 'Aug'], [9, 'Sep'], [10, 'Oct'], [11, 'Nov'], [12, 'Dec']];

                var dataWeek = [[1, 'Senin'], [2, 'Selasa'], [3, 'Rabu'], [4, 'Kamis'], [5, 'Jumat'], [6, 'Sabtu'], [7, 'Minggu']];

                var dataWeek2 = [[1, 'Minggu 1'], [2, 'Minggu 2'], [3, 'Minggu 3'], [4, 'Minggu 4']];

                var color = ['#1abc9c', '#ffca28', '#26c6da', '#9ccc65', '#e67e22', '#2c3e50', '#95a5a6', '#3498db', '#ecf0f1', '#c0392b', '#bdc3c7', '#8e44ad'];




                @include('rawatinap.statistik.js-bor')
                @include('rawatinap.statistik.js-avlos')
                @include('rawatinap.statistik.js-bto')
                @include('rawatinap.statistik.js-toi')
                @include('rawatinap.statistik.js-ndr')
                @include('rawatinap.statistik.js-gdr')
                @include('rawatinap.statistik.js-distribusi')
                


            };


            return {
                init: function () {
                    // Init Flot Charts
                    initChartsFlot();
                }
            };
        }();
        jQuery(function(){ 
            BeCompCharts.init(); 
        });
</script>
@endsection
