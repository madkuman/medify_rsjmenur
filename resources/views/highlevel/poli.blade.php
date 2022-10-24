@extends('highlevel.layouts.main')

@section('title')
Poliklinik - High Level Report
@endsection

@section('subtitle')
Poliklinik
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

                    <div class="col-md-6">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">
                                    10 Besar Kunjungan Poli
                                </h3>
                            </div>
                            <div class="block-content block-content-full text-center">
                                <div class="row gutters-tiny">
                                    <div class="col-12">
                                        <table width="100%" class="table table-striped table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">No</th>
                                                    <th>Nama Poli</th>
                                                    <th>Jumlah Kunjungan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($sepuluhBesar as $index => $item)
                                                <tr>
                                                    <td class="text-center" scope="row">{{$index+1}}</td>
                                                    @if(!empty($item))
                                                    <td>Poli {{$item->poliklinik->name}}</td>
                                                    <td>{{$item->kasus_count}}</td>
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
                                <h3 class="block-title">Persebaran Transaksi Poli</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="chart-null text-center" style="height: 250px;" id="distribusi-null">
                                    <h5>Mengambil data...</h6>
                                    <span class="fa fa-4x fa-cog fa-spin text-primary text-center loader"></span>
                                </div>
                                <div class="js-flot-pie1" style="height: 250px;display: none;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Jenis Pasien</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="chart-null text-center" style="height: 250px;" id="jenis-pasien-null">
                                    <h5>Mengambil data...</h6>
                                    <span class="fa fa-4x fa-cog fa-spin text-primary text-center loader"></span>
                                </div>
                                <div class="js-flot-pie2" style="height: 250px;display: none;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Pasien Lama/Baru</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="chart-null text-center" style="height: 250px;" id="pasien-baru-null">
                                    <h5>Mengambil data...</h6>
                                    <span class="fa fa-4x fa-cog fa-spin text-primary text-center loader"></span>
                                </div>
                                <div class="js-flot-pie3" style="height: 250px;display: none;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">
                                    10 Besar Penyakit
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
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script type="text/javascript">
    var flotLines = jQuery('.js-flot-lines');

    var flotPie1 = jQuery('.js-flot-pie1');
    var flotPie2 = jQuery('.js-flot-pie2');
    var flotPie3 = jQuery('.js-flot-pie3');
    var dataLine = [];


    var dataMonths = [
        [1, 'Jan'],
        [2, 'Feb'],
        [3, 'Mar'],
        [4, 'Apr'],
        [5, 'May'],
        [6, 'Jun'],
        [7, 'Jul'],
        [8, 'Aug'],
        [9, 'Sep'],
        [10, 'Oct'],
        [11, 'Nov'],
        [12, 'Dec']
    ];

    var dataWeek = [
        [1, 'Senin'],
        [2, 'Selasa'],
        [3, 'Rabu'],
        [4, 'Kamis'],
        [5, 'Jumat'],
        [6, 'Sabtu'],
        [7, 'Minggu']
    ];

    var color = ['#1abc9c', '#ffca28', '#26c6da', '#9ccc65', '#e67e22', '#2c3e50', '#95a5a6', '#3498db', '#ecf0f1', '#c0392b', '#bdc3c7', '#8e44ad'];

    function initDistribusiPoli() {
        $.ajax({
          method: "GET",
          url: "{{url('api/rawatjalan/distribusi-poli')}}",
          dataType: "JSON",
          success: function(res) {
            if(res.length > 0){
                var array = [],
                item = {};
                res.forEach(function(item) {
                    item = {
                        label: item.name,
                        data: item.kasus_count
                    }
                    array.push(item);
                });
                $("#distribusi-null").hide();
                flotPie1.show();
                jQuery.plot(flotPie1,
                    array, {
                        colors: color,
                        legend: {
                            show: false
                        },
                        series: {
                            pie: {
                                show: true,
                                radius: 1,
                                label: {
                                    show: true,
                                    radius: 2 / 3,
                                    formatter: function(label, pieSeries) {
                                        return `<div class="flot-pie-label">${label}<br>${Math.round(pieSeries.percent)}%</div>`;
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
            }else{
                $('#distribusi-null').html('Tidak ada data yang ditampilkan');
            }
            
          }
        });
    }

    function initJenisPasien() {
        $.ajax({
          method: "GET",
          url: "{{url('api/rawatjalan/jenis-pasien')}}",
          dataType: "JSON",
          success: function(res) {
            var jenis_pasien_array = [],
                jenis_pasien_item = {},
                jenis = '';
            console.log(res);
            $.each(res, function(i, item) {
                switch(item.type) {
                    case 1:
                        jenis = 'BPJS';
                        break;
                    case 2:
                        jenis = 'Kerjasama';
                        break;
                    case 3:
                        jenis = 'Asuransi';
                        break;
                    case 4:
                        jenis = 'Tunai';
                        break;
                    default:
                        break;
                }
                jenis_pasien_item = {
                    label: jenis,
                    data: item.jumlah
                };
                jenis_pasien_array.push(jenis_pasien_item);
            });
            $("#jenis-pasien-null").hide();
            flotPie2.show();
            jQuery.plot(flotPie2,
                jenis_pasien_array, {
                    colors: color,
                    legend: {
                        show: true,
                        labelFormatter: function(label, pieSeries) {
                            // series is the series object for the label
                            return `${Math.round(pieSeries.percent)}% ${label}`;
                        },
                        position: "se"
                    },
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            label: {
                                show: false,
                                radius: 3/4,
                                formatter: function(label, pieSeries) {
                                    return `<div class="flot-pie-label">${label}<br>${Math.round(pieSeries.percent)}%</div>`;
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
        });
    }
    function initPasienBaru() {
        $.ajax({
          method: "GET",
          url: "{{url('api/rawatjalan/pasien-baru')}}",
          dataType: "JSON",
          success: function(res) {
            if (res.length > 0) {
                var pasien_baru_array = [],
                pasien_baru_item = {};
                $.each(res, function(i, item) {
                    console.log(item);
                    pasien_baru_item = {
                        label: item.label,
                        data: item.value
                    }
                    pasien_baru_array.push(pasien_baru_item);
                });
                console.log(pasien_baru_array);
                $("#pasien-baru-null").hide();
                flotPie3.show();
                jQuery.plot(flotPie3, pasien_baru_array, {
                    colors: color,
                    legend: {
                        show: false
                    },
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            label: {
                                show: true,
                                radius: 2 / 3,
                                formatter: function(label, pieSeries) {
                                    return `<div class="flot-pie-label">${label}<br>${Math.round(pieSeries.percent)}%</div>`;
                                },
                                background: {
                                    opacity: .75,
                                    color: '#000000'
                                }
                            }
                        }
                    }
                });
            } else {
                $("#pasien-baru-null").html('Tidak ada data yang ditampilkan');   
            }
            
          }
        });
    }

        
    var BeCompCharts = function() {
        var initChartsFlot = function(){

            @foreach($grafikKasus as $value)
                dataLine.push([{{$value->date}}, {{$value->kasus_count}}]); 
            @endforeach
            console.log(dataLine);

            // Init lines chart
            if ( flotLines.length ) {
                jQuery.plot(flotLines,
                    [
                        {
                            label: 'Rawat Jalan',
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

    $(document).ready(function() {
        initDistribusiPoli();
        initJenisPasien();
        initPasienBaru();
    });
</script>
@endsection
