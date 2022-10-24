@extends('igd.layouts.main')

@section('title')
Laporan dan Statistik - Medify
@endsection

@section('subtitle')
Laporan dan Statistik
@endsection

@section('content')
<main id="main-container">
    @include('igd.layouts.navbar')
    <div class="container">
        <div class="row row-deck">

            <div class="col-md-6">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            10 Besar Penyakit Bulan Ini
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
                                            <td>{{$item->icd10->code_icd}} {{$item->icd10->long_desc}}</td>
                                            <td class="text-center">{{$item->kasus_count}}</td>
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
            <div class="col-xl-6">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Kunjungan Pasien</h3>
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
            <div class="col-xl-4">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Distribusi Rujukan</h3>
                    </div>
                    <div class="block-content block-content-full">
                        @if($distribusiRujukan[0]['value']==0 && $distribusiRujukan[1]['value']==0)
                        <div class="chart-null text-center" style="height: 250px;">
                            Tidak ada data yang ditampilkan
                        </div>
                        @else
                        <div class="js-flot-pie1" style="height: 250px;"></div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Jenis Pasien</h3>
                    </div>
                    <div class="block-content block-content-full">
                       
                        <div class="js-flot-pie2" style="height: 250px;"></div>

                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Pasien Lama/Baru</h3>
                    </div>
                    <div class="block-content block-content-full">
                        @if($distribusiPasienCreated[0]['value']==0 && $distribusiPasienCreated[1]['value']==0)
                        <div class="chart-null text-center" style="height: 250px;">
                            Tidak ada data yang ditampilkan
                        </div>
                        @else
                        <div class="js-flot-pie3" style="height: 250px;"></div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Ruangan Pasien</h3>
                    </div>
                    <div class="block-content block-content-full">
                        @if(empty($distribusiRuangan[0]) && empty($distribusiRuangan[1]))
                        <div class="chart-null text-center" style="height: 250px;">
                            Tidak ada data yang ditampilkan
                        </div>
                        @else
                        <div class="js-flot-pie4" style="height: 250px;"></div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Pasien Datang Per Jam Tiap Bulan</h3>
                    </div>
                    <div class="block-content block-content-full">

                        <div class="js-flot-bars" style="height: 250px;"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
 

@section('js')

<script type="text/javascript">
        
        var BeCompCharts = function() {
            var initChartsFlot = function(){
                var flotLines = jQuery('.js-flot-lines');
                var flotPie1  = jQuery('.js-flot-pie1');
                var flotPie2  = jQuery('.js-flot-pie2');
                var flotPie3  = jQuery('.js-flot-pie3');
                var flotPie4  = jQuery('.js-flot-pie4');
                var flotBars  = jQuery('.js-flot-bars');

                var dataLine    = [];


                var dataMonths  = [[1, 'Jan'], [2, 'Feb'], [3, 'Mar'], [4, 'Apr'], [5, 'May'], [6, 'Jun'], [7, 'Jul'], [8, 'Aug'], [9, 'Sep'], [10, 'Oct'], [11, 'Nov'], [12, 'Dec']];

                var dataWeek = [[1, 'Senin'], [2, 'Selasa'], [3, 'Rabu'], [4, 'Kamis'], [5, 'Jumat'], [6, 'Sabtu'], [7, 'Minggu']];

                var color = ['#1abc9c', '#ffca28', '#26c6da', '#9ccc65', '#e67e22', '#2c3e50', '#95a5a6', '#3498db', '#ecf0f1', '#c0392b', '#bdc3c7', '#8e44ad'];

                @foreach($grafikKasus as $value)
                    dataLine.push([{{$value->date}}, {{$value->kasus_count}}]); @endforeach
                console.log(dataLine);



                // Init lines chart
                if ( flotLines.length ) {
                    jQuery.plot(flotLines,
                        [
                            {
                                label: 'IGD',
                                data: dataLine,
                                lines: {
                                    show: true,
                                    fill: true,
                                    fillColor: {
                                        colors: [{opacity: .7}, {opacity: .7}]
                                    }
                                },
                                points: {
                                    show: true,
                                    radius: 5
                                }
                            }
                        ],
                        {
                            colors: color,
                            legend: {
                                show: true,
                                position: 'nw',
                                backgroundOpacity: 0
                            },
                            grid: {
                                borderWidth: 0,
                                hoverable: true,
                                clickable: true
                            },
                            yaxis: {
                                tickColor: '#ffffff',
                                ticks: 3
                            },
                            xaxis: {
                                ticks: dataWeek,
                                tickColor: '#f5f5f5'
                            }
                        }
                    );

                    // Creating and attaching a tooltip to the classic chart
                    var previousPoint = null, ttlabel = null;
                    flotLines.bind('plothover', function(event, pos, item) {
                        if (item) {
                            if (previousPoint !== item.dataIndex) {
                                previousPoint = item.dataIndex;

                                jQuery('.js-flot-tooltip').remove();
                                var x = item.datapoint[0], y = item.datapoint[1];

                                if (item.seriesIndex === 0) {
                                    ttlabel = '<strong>' + y + '</strong>';
                                } else if (item.seriesIndex === 1) {
                                    ttlabel = '<strong>' + y + '</strong> sales';
                                } else {
                                    ttlabel = '<strong>' + y + '</strong> tickets';
                                }

                                jQuery('<div class="js-flot-tooltip flot-tooltip">' + ttlabel + '</div>')
                                    .css({top: item.pageY - 45, left: item.pageX + 5}).appendTo("body").show();
                            }
                        }
                        else {
                            jQuery('.js-flot-tooltip').remove();
                            previousPoint = null;
                        }
                    });
                }

                if ( flotPie1.length ) {
                    var array = [], item = {};
                    @foreach($distribusiRujukan as $item)
                        item = {label:'{{$item['label']}}', data:{{$item['value']}}}
                        array.push(item);
                    @endforeach
                    jQuery.plot(flotPie1,
                        array,
                        {
                            colors: color,
                            legend: {show: false},
                            series: {
                                pie: {
                                    show: true,
                                    radius: 1,
                                    label: {
                                        show: true,
                                        radius: 2/3,
                                        formatter: function(label, pieSeries) {
                                            return '<div class="flot-pie-label">' + label + '<br>' + Math.round(pieSeries.percent) + '%</div>';
                                        },
                                        background: {
                                            opacity: .75,
                                            color: '#000000'
                                        }
                                    }
                                }
                            }
                        }
                    );
                }

                if ( flotPie2.length ) {
                    var array = [], item = {};
                    @foreach($distribusiPasienType as $item)
                        @if($item['type'] == 1)
                            item = {label:'BPJS', data:{{$item['jumlah']}}}
                        @elseif($item['type'] == 2)
                            item = {label:'Kerjasama', data:{{$item['jumlah']}}}
                        @elseif($item['type'] == 3)
                            item = {label:'Asuransi', data:{{$item['jumlah']}}}
                        @elseif($item['type'] == 4)
                            item = {label:'Tunai', data:{{$item['jumlah']}}}
                        @endif
                        array.push(item);
                    @endforeach
                    
                    jQuery.plot(flotPie2,
                        array,
                        {
                            colors: color,
                            legend: {show: false},
                            series: {
                                pie: {
                                    show: true,
                                    radius: 1,
                                    label: {
                                        show: true,
                                        radius: 2/3,
                                        formatter: function(label, pieSeries) {
                                            return '<div class="flot-pie-label">' + label + '<br>' + Math.round(pieSeries.percent) + '%</div>';
                                        },
                                        background: {
                                            opacity: .75,
                                            color: '#000000'
                                        }
                                    }
                                }
                            }
                        }
                    );
                }

                if ( flotPie3.length ) {
                    var array = [], item = {};
                    @foreach($distribusiPasienCreated as $item)
                        item = {label:'{{$item['label']}}', data:{{$item['value']}}}
                        array.push(item);
                    @endforeach

                    jQuery.plot(flotPie3, array, 
                        {
                            colors: color,
                            legend: {show: false},
                            series: {
                                pie: {
                                    show: true,
                                    radius: 1,
                                    label: {
                                        show: true,
                                        radius: 2/3,
                                        formatter: function(label, pieSeries) {
                                            return '<div class="flot-pie-label">' + label + '<br>' + Math.round(pieSeries.percent) + '%</div>';
                                        },
                                        background: {
                                            opacity: .75,
                                            color: '#000000'
                                        }
                                    }
                                }
                            }
                        }
                    );
                }

                if ( flotPie4.length ) {
                    var array = [], item = {};
                    @foreach($distribusiRuangan as $item)
                        item = {label:'{{$item->ruangan->name}}', data:{{$item->kasus_count}}}
                        array.push(item);
                    @endforeach
                    jQuery.plot(flotPie4,
                        array,
                        {
                            colors: color,
                            legend: {show: false},
                            series: {
                                pie: {
                                    show: true,
                                    radius: 1,
                                    label: {
                                        show: true,
                                        radius: 2/3,
                                        formatter: function(label, pieSeries) {
                                            return '<div class="flot-pie-label">' + label + '<br>' + Math.round(pieSeries.percent) + '%</div>';
                                        },
                                        background: {
                                            opacity: .75,
                                            color: '#000000'
                                        }
                                    }
                                }
                            }
                        }
                    );
                }

                if ( flotBars.length ) {
                    //var dataSalesBefore = [[2, 5], [5, 6], [8, 1], [11, 6], [14, 8], [17, 12]];
                    var init_pos = 2;
                    var dataPasien = [];
                    @foreach($countPasienByTime as $item)
                        item = [init_pos,{{$item}}]
                        dataPasien.push(item)
                        init_pos += 3;
                    @endforeach
                    console.log(dataPasien);
                    var dataJamBars  = [[3, '00:00 - 03:59'], [6, '04:00 - 07:59'], [9, '08:00 - 11:59'], [12, '12:00 - 15:59'], [15, '16:00 - 19:59'], [18, '20:00 - 23:59']];
                    jQuery.plot(flotBars,
                        [
                            {
                                label: 'Jumlah Pasien',
                                data: dataPasien,
                                bars: {
                                    show: true,
                                    lineWidth: 0,
                                    fillColor: {
                                        colors: [{opacity: .75}, {opacity: .75}]
                                    }
                                }
                            },
                        ],
                        {
                            colors: ['#ef5350', '#9ccc65'],
                            legend: {
                                show: true,
                                position: 'nw',
                                backgroundOpacity: 0
                            },
                            grid: {
                                borderWidth: 0
                            },
                            yaxis: {
                                ticks: 3,
                                tickColor: '#f5f5f5'
                            },
                            xaxis: {
                                ticks: dataJamBars,
                                tickColor: '#f5f5f5'
                            }
                        }
                    );
                }

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
