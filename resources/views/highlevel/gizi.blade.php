@extends('highlevel.layouts.main')

@section('title')
Gizi - High Level Report
@endsection

@section('subtitle')
Gizi
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
            	<div class="row">
            		<div class="col mx-0 px-0">
            			<div class="block text-right">
            				<div class="block-content block-content-full clearfix">
            					<div class="font-size-h3 font-w600">{{number_format($pagi)}}</div>
            					<div class="font-size-sm font-w600 text-uppercase text-muted">Pemesanan Pagi</div>
            				</div>
            			</div>
            		</div>
            		<div class="col mx-0 px-0">
            			<div class="block text-right">
            				<div class="block-content block-content-full clearfix">
            					<div class="font-size-h3 font-w600">{{number_format($siang)}}</div>
            					<div class="font-size-sm font-w600 text-uppercase text-muted">Pemesanan Siang</div>
            				</div>
            			</div>
            		</div>
            		<div class="col mx-0 px-0">
            			<div class="block text-right">
            				<div class="block-content block-content-full clearfix">
            					<div class="font-size-h3 font-w600">{{number_format($sore)}}</div>
            					<div class="font-size-sm font-w600 text-uppercase text-muted">Pemesanan Sore</div>
            				</div>
            			</div>
            		</div>
            		<div class="col mx-0 px-0">	
            			<div class="block text-right">
            				<div class="block-content block-content-full clearfix">
            					<div class="font-size-h3 font-w600">Rp. {{number_format($belanja)}}</div>
            					<div class="font-size-sm font-w600 text-uppercase text-muted">Total Belanja Hari Ini</div>
            				</div>
            			</div>
            		</div>
            	</div>
            	<div class="row">
            		<div class="col">
            			<div class="block">
            				<div class="block-header">
            					<h3 class="block-title">
            						Pemesanan <small>Bulan Ini</small>
            					</h3>
            				</div>
            				<div class="block-content block-content-full text-center">
            					<div class="pull-all">
            						<!-- Lines Chart Container -->
                                                <div id="pemesananchart" class="js-flot-pie4" style="height: 400px;"></div>
            						<!-- <canvas class="js-chartjs-dashboard-lines"></canvas> -->
            					</div>
            				</div>
            			</div>
            		</div>
                  </div>
                  <div class="row">
            		<div class="col">
            			<div class="block">
            				<div class="block-header">
            					<h3 class="block-title">
            						Belanja <small>Bulan Ini</small>
            					</h3>
            				</div>
            				<div class="block-content block-content-full text-center">
            					<div class="pull-all">
            						<!-- Lines Chart Container -->
                                                <div id="belanjachart" class="js-flot-pie4" style="height: 400px;"></div>
            						<!-- <canvas class="js-chartjs-dashboard-lines2"></canvas> -->
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
<script src="{{ asset('bower/amcharts3/amcharts/amcharts.js') }}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/serial.js') }}"></script>
<script type="text/javascript">
(function($){
      var ChHandler = {},
            dataPemesanan = {!! (isset($pemesanan_bulanan) ? json_encode($pemesanan_bulanan) : '[]' )!!};
            dataBelanja = {!! (isset($belanja_bulanan) ? json_encode($belanja_bulanan) : '[]' )!!};

      ChHandler.draw_pemesanan = function(params){
            var chart = null,
                  format_date = (params.format_date ? params.format_date : 'MM YYYY'),
                  chartData = generate_ChartData(dataPemesanan),
                  options = {
                        "type": "serial",
                        "theme": "light",
                        "hideCredits": true,
                        "fontFamily": "Verdana,Arial,sans-serif",
                        "dataProvider": chartData,
                        "valueAxes": [{
                              "gridColor": "#c1c1c1",
                              "axisColor": "#DADADA",
                              "axisThickness": 1,
                              "axisAlpha": 1,
                              "position": "left",
                        }],
                        "graphs": [{
                              "id": "g1",
                              "balloonText": "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",
                              "bullet": "round",
                              "bullerBorderAlpha": 1,
                              "bulletColor": "orange",
                              "bulletSize": 7,
                              "lineThickness": 2,
                              "type": "smoothedLine",
                              "useLineColorForBulletBorder": true,
                              "valueField": "value"
                        }],
                        "chartScrollbar": {
                              "enabled": true,
                        },
                        "chartCursor": {
                              "cursorPosition": "mouse",
                              "cursorColor": "#258cbb",
                              "valueLineAplha": 0.2,
                              "showHandOnHover": true,
                              "categoryBalloonDateFormat": format_date,
                        },
                        "categoryField": "date",
                  };

            function generate_ChartData(data_){
                  var ret = [], key;
                  for (key in data_){
                        if (data_.hasOwnProperty(key)) {
                              ret.push({
                                    date: key,
                                    value: ('undefined' != typeof data_[key] ? parseInt(data_[key]) : 0)
                              });
                        }
                  }
                  return ret;
            }

            chart = AmCharts.makeChart(params.dom_id_chart, options);
      };

      ChHandler.draw_belanja = function(params){
            var chart = null,
                  format_date = (params.format_date ? params.format_date : 'MM YYYY'),
                  chartData = generate_ChartData(dataBelanja),
                  options = {
                        "type": "serial",
                        "theme": "light",
                        "hideCredits": true,
                        "fontFamily": "Verdana,Arial,sans-serif",
                        "dataProvider": chartData,
                        "valueAxes": [{
                              "gridColor": "#c1c1c1",
                              "axisColor": "#DADADA",
                              "axisThickness": 1,
                              "axisAlpha": 1,
                              "position": "left",
                        }],
                        "graphs": [{
                              "id": "g1",
                              "balloonText": "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",
                              "bullet": "round",
                              "bullerBorderAlpha": 1,
                              "bulletBorderThickness": 1,
                              "bulletColor": "orange",
                              "bulletSize": 7,
                              "lineThickness": 2,
                              "type": "smoothedLine",
                              "useLineColorForBulletBorder": true,
                              "valueField": "value"
                        }],
                        "chartScrollbar": {
                              "enabled": true,
                        },
                        "chartCursor": {
                              "cursorPosition": "mouse",
                              "cursorColor": "#258cbb",
                              "valueLineAplha": 0.2,
                              "showHandOnHover": true,
                              "categoryBalloonDateFormat": format_date,
                        },
                        "categoryField": "date",
                  };

            function generate_ChartData(data_){
                  var ret = [], key;
                  for (key in data_){
                        if (data_.hasOwnProperty(key)) {
                              ret.push({
                                    date: key,
                                    value: ('undefined' != typeof data_[key] ? parseInt(data_[key]) : 0)
                              });
                        }
                  }
                  return ret;
            }

            chart = AmCharts.makeChart(params.dom_id_chart, options);
      };

      $(function(){
            ChHandler.draw_pemesanan({
                  dom_id_chart: 'pemesananchart',
            });
            ChHandler.draw_belanja({
                  dom_id_chart: 'belanjachart',
            });
      });

})(window.$||window.jQuery||jQuery);
</script>
@endsection