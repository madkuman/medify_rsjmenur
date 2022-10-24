@extends('aset.layouts.main')

@section('title')
Dashboard
@endsection

@section('content')
	<div class="pb-3">
		<div class="row gutters-tiny js-appear-enabled animated fadeIn" data-toggle="appear">
	        <div class="col">
	            <a class="block block-link-shadow text-right" href="javascript:void(0)">
	                <div class="block-content block-content-full clearfix">
	                    <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500">{{$pengadaan_bulan_ini}}</div>
	                    <div class="font-size-sm font-w600 text-uppercase text-muted">Pengadaan Bulan Ini</div>
	                </div>
	            </a>
	        </div>
	        <div class="col">
	            <a class="block block-link-shadow text-right" href="javascript:void(0)">
	                <div class="block-content block-content-full clearfix">
	                    <div class="font-size-h3 font-w600"><span data-toggle="countTo" data-speed="1000" data-to="780" class="js-count-to-enabled">{{$total_barang}}</span></div>
	                    <div class="font-size-sm font-w600 text-uppercase text-muted">Total Barang</div>
	                </div>
	            </a>
	        </div>
	        <div class="col">
	            <a class="block block-link-shadow text-right" href="javascript:void(0)">
	                <div class="block-content block-content-full clearfix">
	                    <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="15">{{$barang_baru}}</div>
	                    <div class="font-size-sm font-w600 text-uppercase text-muted">Barang Baru Bulan Ini</div>
	                </div>
	            </a>
	        </div>
	    </div>
	</div>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Pengadaan</h3>
        </div>
        <div class="block-content">
            <table class="table table-hover table-vcenter">
                <thead>
                <tr>
                    <th>Kode</th>
                    <th>Penyedia</th>
                    <th>Tanggal</th>
                    <th>Total Harga</th>
                    <th>Keterangan</th>
                    <th>Admin</th>
                </tr>
                </thead>
                <tbody>
                	@foreach($transaksi as $count=>$list_transaksi)
                	<tr class='clickable-row' data-href='{{route('transaction.show',$list_transaksi->kode)}}'>
                		<td>{{$list_transaksi->kode}}</td>
                		<td>@if($list_transaksi->supplier){{$list_transaksi->supplier->name_perusahaan}}@endif</td>
                        <td>{{indonesian_date($list_transaksi->date)}}</td>
                        <td>{{formatCurrency($list_transaksi->total_price)}}</td>
                        <td>{{$list_transaksi->description}}</td>
                        <td>{{$list_transaksi->user->name}}</td>
                	</tr>
                	@endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row row-deck">
	    <div class="col-xl-8">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title"><center>Statistik Jumlah Pengadaan Barang</center></h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="js-flot-lines" style="height: 340px;"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title"><center>Persebaran Kategori</center></h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="js-flot-pie4" style="height: 250px;"></div>
                </div>
            </div>
        </div>
	</div>
@endsection
@section('css')
    <style type="text/css">
        .clickable-row {
            cursor: pointer;
        }
    </style>
@endsection
@section('js')
	<script type="text/javascript">
		var BeCompCharts = function() {
		    var initRandomEasyPieChart = function(){
		    	var flotLines = jQuery('.js-flot-lines');
		        var flotPie4  = jQuery('.js-flot-pie4');

		        var tes_line = [];

		        var color = ['#1abc9c', '#ffca28', '#26c6da', '#9ccc65', '#e67e22', '#2c3e50', '#95a5a6', '#3498db', '#ecf0f1', '#c0392b', '#bdc3c7', '#8e44ad'];

		        var dataMonths  = [[1, 'Jan'], [2, 'Feb'], [3, 'Mar'], [4, 'Apr'], [5, 'May'], [6, 'Jun'], [7, 'Jul'], [8, 'Aug'], [9, 'Sep'], [10, 'Oct'], [11, 'Nov'], [12, 'Dec']];

                var dataWeek = [[1, 'Senin'], [2, 'Selasa'], [3, 'Rabu'], [4, 'Kamis'], [5, 'Jumat'], [6, 'Sabtu'], [7, 'Minggu']];

                tes_line = [[1,0], [2,0], [3,0], [4,0], [5,0], [6,0], [7,0], [8,0], [9,0], [10,0], [11,0], [12,0]];

                @foreach($statistik_pengadaan as $list_statistik)
                        tes_line[{{$list_statistik->month}}+0][1] = {{$list_statistik->sums}}+0;
                @endforeach

		        if ( flotLines.length ) {
                    jQuery.plot(flotLines,
                        [
                            {
                                label: 'Jumlah Pengadaan',
                                data: tes_line,
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
                    flotLines.bind('plothover', function(event, pos, item) {
                        if (item) {
                            if (previousPoint !== item.dataIndex) {
                                previousPoint = item.dataIndex;

                                jQuery('.js-flot-tooltip').remove();
                                var x = item.datapoint[0], y = item.datapoint[1];
    
                                ttlabel = '<strong>' + y + '</strong> Data';
                            

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

                if ( flotPie4.length ) {
		        	var array = [], item = {};
		        	array = [
		        	    @foreach($persebaran as $nama => $jumlah)
                            {data: {{$jumlah}}+0, label: '{{$nama}}'},
                        @endforeach
		        	    ]
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
		    };
		    return {
                init: function () {
                    // Init Flot Charts
                    initRandomEasyPieChart();
                }
            };
        }();
        jQuery(function(){ 
            BeCompCharts.init(); 
        });
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
	</script>
@endsection