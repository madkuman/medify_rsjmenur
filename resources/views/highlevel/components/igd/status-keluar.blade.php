<script type="text/javascript">

	var statusKeluarChartData = null;
	var statusKeluarChart;

	loadDatastatusKeluarChart();

	function loadDatastatusKeluarChart()
	{
		var date = "{{Carbon\Carbon::today()->format('m-Y')}}"

		Codebase.blocks("#statusKeluarBlock", "state_loading");
		$.ajax({
			url: API_URL + '/igd/statistik/pengunjung-pulang?date='+date,
			type: 'GET',
			dataType: 'json',
			tryCount : 0,
			retryLimit : 3,
			beforeSend: function(){
			},
			success: function(data) {
				loadChartstatusKeluarChart();
				statusKeluarChartData = data;
				statusKeluarChart.dataProvider = statusKeluarChartData;
				statusKeluarChart.validateData();
        		Codebase.blocks('#statusKeluarBlock', 'state_toggle');
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

	function loadChartstatusKeluarChart()
	{

		statusKeluarChart = AmCharts.makeChart( "statusKeluarChart", {
		"type": "serial",
		"theme": "light",
		"depth3D": 20,
		"angle": 30,
		"legend": {
			"horizontalGap": 10,
			"useGraphSettings": true,
			"markerSize": 15
		},
		"valueAxes": [ {
			"stackType": "regular",
			"axisAlpha": 1,
			"gridAlpha": 0
		} ],
		"graphs": [ {
			"balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
			"fillAlphas": 0.8,
			"labelText": "[[value]]",
			"lineAlpha": 0.3,
			"title": "Pulang",
			"type": "column",
			"color": "#000000",
			"valueField": "pulang"
		}, {
			"balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
			"fillAlphas": 0.8,
			"labelText": "[[value]]",
			"lineAlpha": 0.3,
			"title": "Rawat Inap",
			"type": "column",
			"newStack": true,
			"color": "#000000",
			"valueField": "ranap"
		}],
		"categoryField": "month",
		"categoryAxis": {
			"gridPosition": "start",
			"axisAlpha": 0,
			"gridAlpha": 0,
			"position": "left"
		}
	} );
	}
</script>