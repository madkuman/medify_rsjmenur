<script type="text/javascript">
var jenisChartData;
var jenisChart = AmCharts.makeChart( "jenisPasienChart", {
  "type": "pie",
  "theme": "light",
  "valueField": "jumlah",
  "titleField": "jenis",
  "fontSize": 14,
  "outlineAlpha": 0.4,
  // "depth3D": 5,
  "balloonText": "[[title]]<br><span style='font-size:15px'><b>[[value]]</b> ([[percents]]%)</span>",
  "export": {
    "enabled": true
  }
} );

Codebase.blocks('#jenisPasienBlock', 'state_loading')
$.ajax({
    type: 'GET',
    url: API_URL+'/pasien/statistik/jenispasien',
    dataType: 'JSON',
    success: function(response){
        console.log(response)
        jenisChartData = response;
        jenisChart.dataProvider = jenisChartData;
        jenisChart.validateData();
        Codebase.blocks('#jenisPasienBlock', 'state_toggle');
    }
});
</script>