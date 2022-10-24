@extends('layouts.main2')

@section('title')
Pasien Pulang Paksa
@endsection

@section('subtitle')
Pasien Pulang Paksa
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
						@php $thisYear = Carbon\Carbon::now()->format('Y'); @endphp
						<select class="form-control" name="tahun" id="selectTahun">
							@for($i=2019;$i<=$thisYear;$i++)
							<option value="{{$i}}" @if($thisYear == $i) selected @endif>{{$i}}</option>
							@endfor
						</select>
					</div>
				</div>
				<div class="col-3">
					<div class="form-group">
						<button id="filterButton" class="btn btn-primary">Filter</button>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 py-50">
					<div id="chartdiv" style="width: 100%; height: 400px;"></div>
					<div id="chartKeterangan" class="text-center font-w600"></div>
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
    		var tahun = $('#selectTahun').val();

    		$.ajax({
    			url: API_URL + '/spm/pasien-pulang-paksa?year='+tahun,
    			type: 'GET',
    			dataType: 'json',
    			tryCount : 0,
    			retryLimit : 3,
    			beforeSend: function(){
    			},
    			success: function(data) {
    				chartData = data.data;
    				loadChart();
    				$('#chartKeterangan').html('Rata Rata total : '+data.total_rata_rata + '% dari data '+ data.total_bulan + ' bulan')
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
		valueAxis.title = "Total Kejadian";
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