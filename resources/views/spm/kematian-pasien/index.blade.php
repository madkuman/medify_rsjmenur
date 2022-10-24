@extends('layouts.main2')

@section('title')
Grafik Pasien Meninggal
@endsection

@section('subtitle')
Grafik Pasien Meninggal
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
						<select class="form-control" name="departemen" id="selectDepartemen">
							<option value="1,2,3">Semua</option>
							<option value="1">IGD</option>
							<option value="2">Rawat Jalan</option>
							<option value="3">Rawat Inap</option>

						</select>
					</div>
				</div>
				@php $thisMonth = Carbon\Carbon::now()->format('F'); @endphp
				<div class="col-3">
					<div class="form-group">
						<select class="form-control" name="bulan" id="selectBulan">
							<option value="January" @if($thisMonth == "January") selected @endif>Januari</option>
							<option value="February" @if($thisMonth == "February") selected @endif>Febuari</option>
							<option value="March" @if($thisMonth == "March") selected @endif>March</option>
							<option value="April" @if($thisMonth == "April") selected @endif>April</option>
							<option value="May" @if($thisMonth == "May") selected @endif>May</option>
							<option value="June" @if($thisMonth == "June") selected @endif>June</option>
							<option value="July" @if($thisMonth == "July") selected @endif>July</option>
							<option value="August" @if($thisMonth == "August") selected @endif>August</option>
							<option value="September" @if($thisMonth == "September") selected @endif>September</option>
							<option value="October" @if($thisMonth == "October") selected @endif>October</option>
							<option value="November" @if($thisMonth == "November") selected @endif>November</option>
							<option value="December" @if($thisMonth == "December") selected @endif>December</option>
						</select>
					</div>
				</div>
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
    		var departemen = $('#selectDepartemen').val();
    		var bulan = $('#selectBulan').val();
    		var tahun = $('#selectTahun').val();
    		var date = bulan +' '+tahun;

    		$.ajax({
    			url: API_URL + '/spm/kematian-pasien?departemen='+departemen+'&date='+date,
    			type: 'GET',
    			dataType: 'json',
    			tryCount : 0,
    			retryLimit : 3,
    			beforeSend: function(){
    			},
    			success: function(data) {
    				chartData = data.data;
    				loadChart();
    				$('#chartKeterangan').html('Total Data : '+data.total)
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
		valueAxis.title = "Jumlah Kematian";
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