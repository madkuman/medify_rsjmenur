var chartData = null;
var borChart = AmCharts.makeChart( "borChart", {
  "type": "serial",
  "theme": "light",
  "dataDateFormat": "YYYY-MM-DD",
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
    "categoryBalloonDateFormat": "YYYY-MM-DD"
  },
  "categoryField": "date",
  "categoryAxis": {
    "parseDates": true,
    "minPeriod": "DD",
    "dashLength": 1,
    "minorGridEnabled": true
  },
  "zoomOutOnDataUpdate": false,
  "export": {
    "enabled": true
  }
} );

Codebase.blocks('#borBlock', 'state_loading')
$.ajax({
    type: 'GET',
    url: API_URL+'/rawatinap/statistik/bor',
    data: {
        dateStart: '2018-01-01',
        dateEnd: '2018-12-31',
        type: 3
    },
    dataType: 'JSON',
    success: function(response){
      console.log(response);
        Codebase.blocks('#borBlock', 'state_toggle')
        chartData = response;
        borChart.dataProvider = chartData;
        borChart.validateData();
    }
});
