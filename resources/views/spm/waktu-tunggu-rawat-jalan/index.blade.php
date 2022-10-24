@extends('layouts.main2')

@section('title')
Waktu Tunggu Rawat Jalan
@endsection

@section('subtitle')
Waktu Tunggu Rawat Jalan
@endsection

@section('css')
@include('spm.layouts.css')
@endsection

@section('content')
<main id="main-container" class="main-content-boxed ">
	@include('spm.layouts.navbar')

	<div class="container">
		<div class="content">
			<div class="row gutters-tiny">
				<div class="col-3">
					<div class="form-group">
						<select class="form-control js-select2" name="poli" id="select-poli">
							<option value="0">Semua Poli</option>
							@foreach($poli as $item)
							<option value="{{$item->id}}">{{$item->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<div class="form-group">
							<div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
								<input type="text" class="form-control" id="tanggal-awal" name="tanggal-awal" placeholder="Dari" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$tanggal_awal}}">
								<div class="input-group-prepend input-group-append">
									<span class="input-group-text font-w600">to</span>
								</div>
								<input type="text" class="form-control" id="tanggal-akhir" name="tanggal-akhir" placeholder="Hingga" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$tanggal_akhir}}">
							</div>
						</div>
					</div>
				</div>
				<div class="col-2">
					<div class="form-group">
						<select class="form-control js-select2" name="tipe_waktu" id="select-tipe-waktu">
							<option value="m">Bulanan</option>
							<option value="w">Mingguan</option>
							<option value="d">Harian</option>
						</select>
					</div>
				</div>
				<div class="col-2">
					<div class="form-group">
						<button id="filterButton" class="btn btn-primary">Filter</button>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 py-50">
					<div id="chartdiv" style="width: 100%; height: 400px;"></div>
					<div id="chartKeterangan" class="text-center font-w600"></div>
					<div class="text-center">Maksimal menampilkan 24 data</div>
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
<script type="text/javascript">
	
</script>
<script>

	$('#filterButton').click(function(){
		loadData();
	})
	$( document ).ready(function() {
		loadData();
	});

	function loadData()
    	{
		$('#loading-top').show();
    		var poli = $('#select-poli').val();
    		var tanggal_awal = $('#tanggal-awal').val();
    		var tanggal_akhir = $('#tanggal-akhir').val();
    		var tipe_waktu = $('#select-tipe-waktu').val();

    		if(tipe_waktu == 'm')
    		var tipe_waktu_format = 'bulan';
    		else if(tipe_waktu == 'w')
    		var tipe_waktu_format = 'minggu';
    		else if(tipe_waktu == 'd')
    		var tipe_waktu_format = 'hari';


    		$.ajax({
    			url: API_URL + '/spm/waktu-tunggu-rawat-jalan?poli='+poli+'&tanggal-awal='+tanggal_awal+'&tanggal-akhir='+tanggal_akhir+'&tipe-waktu='+tipe_waktu,
    			type: 'GET',
    			dataType: 'json',
    			tryCount : 0,
    			retryLimit : 3,
    			beforeSend: function(){
    			},
    			success: function(data) {
    				chartData = data.data;
    				loadChart();
    				$('#chartKeterangan').html('Rata Rata total : '+data.total_rata_rata + ' menit dari '+ data.total_bulan + ' ' + tipe_waktu_format)
    			},
    			error:function(data){
    				this.tryCount++;
    				if (this.tryCount <= this.retryLimit) {

    					$.ajax(this);
    					return 1;
    				}else{
    					return 1;
    				}  
    			}
    		});
    }

	var chart;
	var chartData = [];
	function loadChart(){

		chart = new AmCharts.AmSerialChart();
		chart.dataProvider = chartData;
		chart.categoryField = "kategori";
		chart.depth3D = 20;
		chart.angle = 30;

		var categoryAxis = chart.categoryAxis;
		categoryAxis.labelRotation = 90;
		categoryAxis.dashLength = 5;
		categoryAxis.gridPosition = "start";

		var valueAxis = new AmCharts.ValueAxis();
		valueAxis.title = "Rata Rata Waktu Tunggu";
		valueAxis.dashLength = 5;
		chart.addValueAxis(valueAxis);

		var graph = new AmCharts.AmGraph();
		graph.valueField = "value";
		graph.colorField = "color";
		graph.balloonText = "<span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>";
		graph.type = "column";
		graph.lineAlpha = 0;
		graph.fillAlphas = 1;
		chart.addGraph(graph);

		var chartCursor = new AmCharts.ChartCursor();
		chartCursor.cursorAlpha = 0;
		chartCursor.zoomable = false;
		chartCursor.categoryBalloonEnabled = false;
		chart.addChartCursor(chartCursor);

		chart.creditsPosition = "top-right";


		chart.write("chartdiv");
		$('#loading-top').hide();
	};
  </script>

@endsection