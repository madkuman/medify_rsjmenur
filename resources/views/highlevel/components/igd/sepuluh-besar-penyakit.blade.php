
<script type="text/javascript">
	var chartSepuluhBesar;
	var chartDataSepuluhBesarPenyakit = [];
	loadDataKunjungan()

	function loadDataKunjungan()
	{
        Codebase.blocks('#sepuluhBesarPenyakitBlock', 'state_toggle');
		var date = '{{Carbon\Carbon::today()->format('m-Y')}}'

		$.ajax({
			url: API_URL + '/igd/statistik/sepuluh-besar-penyakit?date='+date,
			type: 'GET',
			dataType: 'json',
			tryCount : 0,
			retryLimit : 3,
			beforeSend: function(){
			},
			success: function(data) {
				chartDataSepuluhBesarPenyakit = data.data;
				loadChartSepuluhBesar();
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
	function loadChartSepuluhBesar(){

		chartSepuluhBesar = new AmCharts.AmSerialChart();
		chartSepuluhBesar.dataProvider = chartDataSepuluhBesarPenyakit;
		chartSepuluhBesar.categoryField = "kategori";
		chartSepuluhBesar.depth3D = 20;
		chartSepuluhBesar.angle = 30;

		var categoryAxis = chartSepuluhBesar.categoryAxis;
		categoryAxis.dashLength = 5;
		categoryAxis.fillAlphas = 0.05;
		categoryAxis.position = "left";
		categoryAxis.gridPosition = "start";
		categoryAxis.autoWrap = true;

		var valueAxis = new AmCharts.ValueAxis();
		valueAxis.title = "Kunjungan IGD";
		valueAxis.dashLength = 5;
		chartSepuluhBesar.addValueAxis(valueAxis);

		var graph = new AmCharts.AmGraph();
		graph.valueField = "value";
		graph.descriptionField = "kategori_long"
		graph.colorField = "color";
		graph.balloonText = "<span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>";
		graph.type = "column";
		graph.fillAlphas = 1;
		graph.lineAlpha = 0;
		chartSepuluhBesar.addGraph(graph);

		var chartCursor = new AmCharts.ChartCursor();
		chartCursor.cursorAlpha = 0;
		chartCursor.zoomable = false;
		chartCursor.categoryBalloonEnabled = false;
		chartSepuluhBesar.addChartCursor(chartCursor);

		chartSepuluhBesar.creditsPosition = "top-right";


		chartSepuluhBesar.write("sepuluhBesarPenyakitChart");
        Codebase.blocks('#sepuluhBesarPenyakitBlock', 'state_toggle');
	};

</script>