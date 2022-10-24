<script type="text/javascript">
	var chartData = null;
var pasienBaruChart = AmCharts.makeChart( "pasienBaruChart", {
  "type": "serial",
  "theme": "light",
  "dataDateFormat": "MM-YYYY",
  "valueAxes": [ {
    "id": "v1",
    "position": "left"
  } ],
  "graphs": [ {
    "id": "g1",
    "bullet": "round",
    "bulletBorderAlpha": 1,
    "bulletColor": "#FFFFFF",
    "bulletSize": 5,
    "hideBulletsCount": 50,
    "lineThickness": 2,
    "useLineColorForBulletBorder": true,
    "valueField": "value"
  } ],
  "chartScrollbar": {
    "graph": "g1",
    "oppositeAxis": false,
    "offset": 30,
    "scrollbarHeight": 50,
    "backgroundAlpha": 0,
    "selectedBackgroundAlpha": 0.1,
    "selectedBackgroundColor": "#888888",
    "graphFillAlpha": 0,
    "graphLineAlpha": 0.5,
    "selectedGraphFillAlpha": 0,
    "selectedGraphLineAlpha": 1,
    "autoGridCount": true,
    "color": "#AAAAAA"
  },
  "chartCursor": {
    "valueLineEnabled": true,
    "valueLineBalloonEnabled": true,
    "cursorAlpha": 1,
    "cursorColor": "#258cbb",
    "valueLineAlpha": 0.2,
    "categoryBalloonDateFormat": "MM-YYYY"
  },
  "categoryField": "date",
  "categoryAxis": {
    "parseDates": true,
    "minPeriod": "MM",
    "dashLength": 1,
    "minorGridEnabled": true
  },
  "zoomOutOnDataUpdate": false,
  "export": {
    "enabled": true
  }
} );

Codebase.blocks('#pasienBaruBlock', 'state_loading')
$.ajax({
    type: 'GET',
    url: API_URL+'/pasien/statistik/pasienbaru',
    data: {
        dateStart: $("#pasienBaruStart").val(),
        dateEnd: $("#pasienBaruEnd").val(),
        type: $("#pasienBaruType").val()
    },
    dataType: 'JSON',
    success: function(response){
        chartData = response;
        pasienBaruChart.dataProvider = chartData;
        pasienBaruChart.validateData();
        Codebase.blocks('#pasienBaruBlock', 'state_toggle')  
    }
});
</script>