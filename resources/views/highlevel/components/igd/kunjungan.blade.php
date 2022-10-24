
<script type="text/javascript">
	var chartKunjungan;
	var chartKunjunganData = [];
	loadDataKunjungan()

	function loadDataKunjungan()
	{
        Codebase.blocks('#kunjunganBlock', 'state_toggle');
		var date = '{{Carbon\Carbon::today()->format('m-Y')}}'

		$.ajax({
			url: API_URL + '/igd/statistik/kunjungan-pasien?date='+date,
			type: 'GET',
			dataType: 'json',
			tryCount : 0,
			retryLimit : 3,
			beforeSend: function(){
			},
			success: function(data) {
				chartKunjunganData = data.data;
				loadChartKunjungan();
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
	function loadChartKunjungan(){

		chartKunjungan = new AmCharts.AmSerialChart();
		chartKunjungan.dataProvider = chartKunjunganData;
		chartKunjungan.categoryField = "kategori";
		chartKunjungan.depth3D = 20;
		chartKunjungan.angle = 30;

		var categoryAxis = chartKunjungan.categoryAxis;
		categoryAxis.labelRotation = 90;
		categoryAxis.dashLength = 5;
		categoryAxis.gridPosition = "start";

		var valueAxis = new AmCharts.ValueAxis();
		valueAxis.title = "Kunjungan IGD";
		valueAxis.dashLength = 5;
		chartKunjungan.addValueAxis(valueAxis);

		var graph = new AmCharts.AmGraph();
		graph.valueField = "value";
		graph.colorField = "color";
		graph.balloonText = "<span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>";
		graph.type = "column";
		graph.lineAlpha = 0;
		graph.fillAlphas = 1;
		chartKunjungan.addGraph(graph);

		var chartCursor = new AmCharts.ChartCursor();
		chartCursor.cursorAlpha = 0;
		chartCursor.zoomable = false;
		chartCursor.categoryBalloonEnabled = false;
		chartKunjungan.addChartCursor(chartCursor);

		chartKunjungan.creditsPosition = "top-right";


		chartKunjungan.write("kunjunganChart");
        Codebase.blocks('#kunjunganBlock', 'state_toggle');
	};

</script>