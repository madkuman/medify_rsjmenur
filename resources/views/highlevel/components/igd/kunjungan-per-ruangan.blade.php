<script type="text/javascript">

	var kunjunganPerRuanganChartData = null;
	var kunjunganPerRuanganChart;

	loadDataKunjunganPerRuangan();

	function loadDataKunjunganPerRuangan()
	{
		var date = "{{Carbon\Carbon::today()->format('m-Y')}}"

		Codebase.blocks("#kunjunganPerRuanganBlock", "state_loading");
		$.ajax({
			url: API_URL + '/igd/statistik/kunjungan-pasien-per-ruangan?date='+date,
			type: 'GET',
			dataType: 'json',
			tryCount : 0,
			retryLimit : 3,
			beforeSend: function(){
			},
			success: function(data) {
				loadChartKunjunganPerRuangan();
				kunjunganPerRuanganChartData = data;
				kunjunganPerRuanganChart.dataProvider = kunjunganPerRuanganChartData;
				kunjunganPerRuanganChart.validateData();
        		Codebase.blocks('#kunjunganPerRuanganBlock', 'state_toggle');
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

	function loadChartKunjunganPerRuangan()
	{

		kunjunganPerRuanganChart = AmCharts.makeChart( "kunjunganPerRuanganChart", {
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
			"title": "P3",
			"type": "column",
			"color": "#000000",
			"valueField": "P3"
		}, {
			"balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
			"fillAlphas": 0.8,
			"labelText": "[[value]]",
			"lineAlpha": 0.3,
			"title": "P2",
			"type": "column",
			"newStack": true,
			"color": "#000000",
			"valueField": "P2"
		}, {
			"balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
			"fillAlphas": 0.8,
			"labelText": "[[value]]",
			"lineAlpha": 0.3,
			"title": "P1",
			"type": "column",
			"newStack": true,
			"color": "#000000",
			"valueField": "P1"
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