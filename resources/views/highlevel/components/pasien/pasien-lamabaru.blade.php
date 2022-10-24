<script type="text/javascript">
	var lamaData;
var lamaChart = AmCharts.makeChart( "lamaChart", {
  "type": "pie",
  "theme": "light",
  "valueField": "jumlah",
  "titleField": "jenis",
  "fontSize": 14,
  "outlineAlpha": 0.4,
  "titles": [ {
    "text": "Pasien Lama",
    "size": 16
  } ],
  "depth3D": 5,
  "balloonText": "[[title]]<br><span style='font-size:15px'><b>[[value]]</b> ([[percents]]%)</span>",
  "export": {
    "enabled": true
  }
} );
var baruData;
var baruChart = AmCharts.makeChart( "baruChart", {
  "type": "pie",
  "valueField": "jumlah",
  "titleField": "jenis",
  "fontSize": 14,
  "outlineAlpha": 0.4,
  "titles": [ {
    "text": "Pasien Baru",
    "size": 16
  } ],
  "depth3D": 5,
  "balloonText": "[[title]]<br><span style='font-size:15px'><b>[[value]]</b> ([[percents]]%)</span>",
  "export": {
    "enabled": true
  }
} );

Codebase.blocks('#lamaBaruBlock', 'state_loading')
$.ajax({
    type: 'GET',
    url: API_URL+'/pasien/statistik/lamabaru',
    dataType: 'JSON',
    success: function(response){
        // console.log(response);
        lamaData = response.lama;
        lamaChart.dataProvider = lamaData;
        lamaChart.validateData();
        baruData = response.baru;
        baruChart.dataProvider = baruData;
        baruChart.validateData();
        Codebase.blocks('#lamaBaruBlock', 'state_toggle');
    }
});
</script>