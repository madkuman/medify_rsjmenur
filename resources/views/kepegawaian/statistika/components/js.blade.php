
<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/frozen.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/dataviz.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
  jenisPegawai();
  statusPegawai();
  gender();
  umur();
  pegawaiAktif();
  pegawaiKeluar();

var jenis_pegawai;
var status_pegawai;
var gender;
var umur;
var pegawai_aktif;
var pegawai_keluar;

  // Ajax
  function jenisPegawai(){
    $.ajax({
      async: false,
			url: '{{url()->current()}}/jenis-pegawai',
			type: 'GET',
			dataType: 'json',
			beforeSend:function() {
					
			},
			success: function(data) {
        jenis_pegawai = JSON.stringify(data);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi sekali lagi", "error");
			},
		});
  }
  function statusPegawai(){
    $.ajax({
      async: false,
			url: '{{url()->current()}}/status-pegawai',
			type: 'GET',
			dataType: 'json',
			beforeSend:function() {
					
			},
			success: function(data) {
        status_pegawai = JSON.stringify(data);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi sekali lagi", "error");
				},
		})
  }
  function gender(){
    $.ajax({
      async: false,
			url: '{{url()->current()}}/gender',
			type: 'GET',
			dataType: 'json',
			beforeSend:function() {
					
			},
			success: function(data) {
        gender = JSON.stringify(data);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi sekali lagi", "error");
				},
		});
  }
  function umur(){
    $.ajax({
      async: false,
			url: '{{url()->current()}}/umur',
			type: 'GET',
			dataType: 'json',
			beforeSend:function() {
					
			},
			success: function(data) {
        umur = JSON.stringify(data);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi sekali lagi", "error");
				},
		});
  }
  function pegawaiAktif(){
    $.ajax({
      async: false,
			url: '{{url()->current()}}/pegawai-aktif',
			type: 'GET',
			dataType: 'json',
			beforeSend:function() {
					
			},
			success: function(data) {
        pegawai_aktif = data;
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi sekali lagi", "error");
				},
		});
  }
  function pegawaiKeluar(){
    $.ajax({
      async: false,
			url: '{{url()->current()}}/pegawai-keluar',
			type: 'GET',
			dataType: 'json',
			beforeSend:function() {
					
			},
			success: function(data) {
        pegawai_keluar = data;
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi sekali lagi", "error");
				},
		});
  }

function generateData(value) {
  var data = JSON.parse(value);
  var ret = [];
  if (data && data.length)
    for (var i = 0; i < data.length; i++) {
      ret.push({
        Kategori: data[i].category,
        Jumlah: data[i].jumlah,
      })
    }
  return ret;
}

am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// JENIS PEGAWAI
var chart = am4core.create("chartpiejenis", am4charts.PieChart3D);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

chart.legend = new am4charts.Legend();

chart.data = generateData(jenis_pegawai);

var series = chart.series.push(new am4charts.PieSeries3D());
series.dataFields.value = "Jumlah";
series.dataFields.category = "Kategori";

// STATUS PEGAWAI
var chart = am4core.create("chartpiestatus", am4charts.PieChart3D);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

chart.legend = new am4charts.Legend();

chart.data = generateData(status_pegawai);

var series = chart.series.push(new am4charts.PieSeries3D());
series.dataFields.value = "Jumlah";
series.dataFields.category = "Kategori";

}); // end am4core.ready()

am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
am4core.useTheme(am4themes_frozen);
// Themes end

// GENDER PEGAWAI
var chart = am4core.create("chartpiegender", am4charts.PieChart3D);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

chart.legend = new am4charts.Legend();

chart.data = generateData(gender);

var series = chart.series.push(new am4charts.PieSeries3D());
series.dataFields.value = "Jumlah";
series.dataFields.category = "Kategori";

// AGE PEGAWAI
var chart = am4core.create("chartpieage", am4charts.PieChart3D);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

chart.legend = new am4charts.Legend();

chart.data = generateData(umur);

var series = chart.series.push(new am4charts.PieSeries3D());
series.dataFields.value = "Jumlah";
series.dataFields.category = "Kategori";

}); // end am4core.ready()


//=======================================//
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_dataviz);
am4core.useTheme(am4themes_animated);
// Themes end

// AKTIF
// Create chart instance
var chart = am4core.create("chartpegawaiaktif", am4charts.XYChart);

// Add data
chart.data = pegawai_aktif;

// Set input format for the dates
chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

// Create axes
var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

// Create series
var series = chart.series.push(new am4charts.LineSeries());
series.dataFields.valueY = "active";
series.dataFields.dateX = "tanggal";
series.tooltipText = "{value}"
series.strokeWidth = 2;
series.minBulletDistance = 15;


// Drop-shaped tooltips
series.tooltip.background.cornerRadius = 20;
series.tooltip.background.strokeOpacity = 0;
series.tooltip.pointerOrientation = "vertical";
series.tooltip.label.minWidth = 40;
series.tooltip.label.minHeight = 40;
series.tooltip.label.textAlign = "middle";
series.tooltip.label.textValign = "middle";

// Make bullets grow on hover
var bullet = series.bullets.push(new am4charts.CircleBullet());
bullet.circle.strokeWidth = 4;
bullet.circle.radius = 6;
bullet.circle.fill = am4core.color("#fff");

var bullethover = bullet.states.create("hover");
bullethover.properties.scale = 1.5;

// Make a panning cursor
chart.cursor = new am4charts.XYCursor();
chart.cursor.behavior = "panXY";
chart.cursor.xAxis = dateAxis;
chart.cursor.snapToSeries = series;

// Create vertical scrollbar and place it before the value axis
chart.scrollbarY = new am4core.Scrollbar();
chart.scrollbarY.parent = chart.leftAxesContainer;
chart.scrollbarY.toBack();

// Create a horizontal scrollbar with previe and place it underneath the date axis
chart.scrollbarX = new am4charts.XYChartScrollbar();
chart.scrollbarX.series.push(series);
chart.scrollbarX.parent = chart.bottomAxesContainer;

dateAxis.start = 0;
dateAxis.keepSelection = true;


// KELUAR
// Create chart instance
var chart = am4core.create("chartpegawaikeluar", am4charts.XYChart);

// Add data
chart.data = pegawai_keluar;

// Set input format for the dates
chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

// Create axes
var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

// Create series
var series = chart.series.push(new am4charts.LineSeries());
series.dataFields.valueY = "out";
series.dataFields.dateX = "tanggal";
series.tooltipText = "{value}"
series.strokeWidth = 2;
series.minBulletDistance = 15;

// Drop-shaped tooltips
series.tooltip.background.cornerRadius = 20;
series.tooltip.background.strokeOpacity = 0;
series.tooltip.pointerOrientation = "vertical";
series.tooltip.label.minWidth = 40;
series.tooltip.label.minHeight = 40;
series.tooltip.label.textAlign = "middle";
series.tooltip.label.textValign = "middle";

// Make bullets grow on hover
var bullet = series.bullets.push(new am4charts.CircleBullet());
bullet.circle.strokeWidth = 4;
bullet.circle.radius = 6;
bullet.circle.fill = am4core.color("#fff");

var bullethover = bullet.states.create("hover");
bullethover.properties.scale = 1.5;

// Make a panning cursor
chart.cursor = new am4charts.XYCursor();
chart.cursor.behavior = "panXY";
chart.cursor.xAxis = dateAxis;
chart.cursor.snapToSeries = series;

// Create vertical scrollbar and place it before the value axis
chart.scrollbarY = new am4core.Scrollbar();
chart.scrollbarY.parent = chart.leftAxesContainer;
chart.scrollbarY.toBack();

// Create a horizontal scrollbar with previe and place it underneath the date axis
chart.scrollbarX = new am4charts.XYChartScrollbar();
chart.scrollbarX.series.push(series);
chart.scrollbarX.parent = chart.bottomAxesContainer;

dateAxis.start = 0;
dateAxis.keepSelection = true;

}); // end am4core.ready()
</script>