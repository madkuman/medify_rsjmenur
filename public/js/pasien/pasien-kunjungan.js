var kunjunganChart = AmCharts.makeChart( "kunjunganChart", {
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
    "title": "Rawat Jalan",
    "type": "column",
    "color": "#000000",
    "valueField": "jalan"
  }, {
    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
    "fillAlphas": 0.8,
    "labelText": "[[value]]",
    "lineAlpha": 0.3,
    "title": "Rawat Inap",
    "type": "column",
    "newStack": true,
    "color": "#000000",
    "valueField": "inap"
  }, {
    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
    "fillAlphas": 0.8,
    "labelText": "[[value]]",
    "lineAlpha": 0.3,
    "title": "Departemen IGD",
    "type": "column",
    "newStack": true,
    "color": "#000000",
    "valueField": "igd"
  }],
  "categoryField": "month",
  "categoryAxis": {
    "gridPosition": "start",
    "axisAlpha": 0,
    "gridAlpha": 0,
    "position": "left"
  },
  "export": {
    "enabled": true
  }
} );
var kunjunganChartData = null;

Codebase.blocks("#kunjunganPasienBlock", "state_loading");
$.ajax({
    type: 'GET',
    url: API_URL+'/pasien/statistik/kunjungan',
    dataType: 'JSON',
    success: function(response){
        kunjunganChartData = response;
        kunjunganChart.dataProvider = kunjunganChartData;
        kunjunganChart.validateData();
        Codebase.blocks('#kunjunganPasienBlock', 'state_toggle');
    }
});