@extends('highlevel.layouts.main')

@section('title')
Lab PK - High Level Report
@endsection

@section('subtitle')
Lab PK
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
                    <div class="col-xl-6">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Kunjungan Pasien Harian</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                        <i class="si si-refresh"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="js-flot-lines1" style="height: 340px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Kunjungan Pasien Bulanan</h3>
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
                                <h3 class="block-title">Distribusi Asal Pasien</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="js-flot-pie1" style="height: 250px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Distribusi Jenis Pasien</h3>
                            </div>
                            <div class="block-content block-content-full">
                               
                                <div class="js-flot-pie2" style="height: 250px;"></div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">
                                    10 Tarif Paling Sering Digunakan
                                </h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="row gutters-tiny">
                                    <div class="col-12">
                                        <table width="100%" class="table table-striped table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">No</th>
                                                    <th>Nama Tarif</th>
                                                    <th class="text-center">Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($tarif10Besar as $index => $item)
                                                <tr>
                                                    <td class="text-center" >{{$index+1}}</td>
                                                    @if(!empty($item))
                                                    <td>{{$item->tarif->deskripsi}}</td>
                                                    <td class="text-center">{{$item->transaksi_count}}</td>
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
                var flotLines1 = jQuery('.js-flot-lines1');
                var flotLines2 = jQuery('.js-flot-lines2');
                var flotPie1  = jQuery('.js-flot-pie1');
                var flotPie2  = jQuery('.js-flot-pie2');

                var dataLine1    = [];
                var dataLine2    = [];


                var dataMonths  = [[1, 'Jan'], [2, 'Feb'], [3, 'Mar'], [4, 'Apr'], [5, 'May'], [6, 'Jun'], [7, 'Jul'], [8, 'Aug'], [9, 'Sep'], [10, 'Oct'], [11, 'Nov'], [12, 'Dec']];

                var dataWeek = [[1, 'Senin'], [2, 'Selasa'], [3, 'Rabu'], [4, 'Kamis'], [5, 'Jumat'], [6, 'Sabtu'], [7, 'Minggu']];

                var color = ['#1abc9c', '#ffca28', '#26c6da', '#9ccc65', '#e67e22', '#2c3e50', '#95a5a6', '#3498db', '#ecf0f1', '#c0392b', '#bdc3c7', '#8e44ad'];

                @foreach($pasienHarian as $value)
                    dataLine1.push([{{$value['date']}}, {{$value['pasien_count']}}]); @endforeach
                console.log(dataLine1);

                @foreach($pasienBulanan as $value)
                    dataLine2.push([{{$value['month']}}, {{$value['pasien_count']}}]); @endforeach
                console.log(dataLine2);



                // Init lines chart
                if ( flotLines1.length ) {
                    jQuery.plot(flotLines1,
                        [
                            {
                                label: 'Lab PK',
                                data: dataLine1,
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
                    flotLines1.bind('plothover', function(event, pos, item) {
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

                if ( flotLines2.length ) {
                    jQuery.plot(flotLines2,
                        [
                            {
                                label: 'Lab PK',
                                data: dataLine2,
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
                                ticks: dataMonths,
                                tickColor: '#f5f5f5'
                            }
                        }
                    );

                    // Creating and attaching a tooltip to the classic chart
                    var previousPoint = null, ttlabel = null;
                    flotLines2.bind('plothover', function(event, pos, item) {
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
                    
                    @foreach($distribusiAsalPasien as $label => $value)
                        array.push({label: '{{ $label }}'   , data: {{ $value }} });
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
                    @foreach($distribusiJenisPasien as $item)
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
