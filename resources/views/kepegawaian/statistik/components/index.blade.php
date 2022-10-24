@extends('kepegawaian.layouts.main')

@section('title')
  {{$htmlheader_title}}
@endsection

@section('subtitle')
  {{$contentheader_title}}
@endsection

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6 col-md-3 px-5">
        <div class="block rounded">
          <div class="block-content mb-10">
            <div class="text-right text-primary display-4 font-w600">{{$employees}}</div>
            <div class="block-title font-size-md font-w600 text-right text-uppercase">Jumlah Pegawai</div>
          </div>
        </div>
      </div>
      {{-- <div class="col-6 col-md-3 px-5">
        <div class="block rounded">
          <div class="block-content mb-10">
            <div class="text-right text-primary display-4 font-w600">{{$status[0]['total']}}</div>
            <div class="block-title font-size-md font-w600 text-right text-uppercase">Pegawai Militer</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3 px-5">
        <div class="block rounded">
          <div class="block-content mb-10">
            <div class="text-right text-primary display-4 font-w600">{{$status[1]['total']}}</div>
            <div class="block-title font-size-md font-w600 text-right text-uppercase">Pegawai PNS</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3 px-5">
        <div class="block rounded">
          <div class="block-content mb-10">
            <div class="text-right text-primary display-4 font-w600">{{$status[2]['total']}}</div>
            <div class="block-title font-size-md font-w600 text-right text-uppercase">Pegawai PHL</div>
          </div>
        </div>
      </div> --}}
    </div>
    <div class="row justify-content-center">
      <div class="col-12 col-md-6 px-5">
        <div class="block rounded">
          <div class="block-content block-content-full">
            <div id="activechart" style="width: 100%; height: 400px;"></div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 px-5">
        <div class="block rounded">
          <div class="block-content block-content-full">
            <div id="outchart" style="width: 100%; height: 400px;"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-12 col-md-6 px-5">
        <div class="block rounded">
          <div class="block-content block-content-full">
            <div id="statuschart" style="width: 100%; height: 400px;"></div>
          </div>
        </div>
      </div><!--
      <div class="col-12 col-md-6 px-5">
        <div class="block rounded">
          <div class="block-content block-content-full">
            <div id="genderchart" style="width: 100%; height: 400px;"></div>
          </div>
        </div>
      </div>-->
      <div class="col-12 col-md-6 px-5">
        <div class="block rounded">
          <div class="block-content block-content-full">
            <div id="ageschart" style="width: 100%; height: 400px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('footer-script')
<script src="{{ asset('bower/amcharts3/amcharts/amcharts.js') }}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/pie.js') }}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/serial.js') }}"></script>
<script>
  // onReady closure-scope
  (function($){
    var ChHandler = {},
        dataActive = {!! (isset($emps_active) ? json_encode($emps_active) : '[]' )!!},
        dataOut = {!! (isset($emps_out) ? json_encode($emps_out) : '[]' )!!},
        dataStatus = {!! (isset($status) ? json_encode($status) : '[]' )!!},
        dataGender = {!! (isset($gender) ? json_encode($gender) : '[]' )!!},
        dataEducations = {!! (isset($educations) ? json_encode($educations) : '[]' )!!},
        dataAges = {!! (isset($ages) ? json_encode($ages) : '[]' )!!};

    // amchart: lines
    ChHandler.draw_active = function(params){
      var chart = null,
          format_date = (params.format_date ? params.format_date : 'DD MM YYYY'),
          chartData = generate_ChartData(dataActive),
          options = {
            "type": "serial",
            "theme": "light",
            "pathToImages": ChHandler.get_amchart_imagepath(),
            "hideCredits": true,
            "fontFamily": "Verdana,Arial,sans-serif",
            "dataProvider": chartData,
            "titles": [{
              "text": "Statistik Jumlah Pegawai Aktif Bulanan",
              "color": "#666",
              "size": 16
            }],
            "valueAxes": [{
              "gridColor": "#c1c1c1",
              "axisColor": "#DADADA",
              "axisThickness": 1,
              "axisAlpha": 1,
              "position": "left",
              "integersOnly": true,
            }],
            "graphs": [{
              "id": "g1",
              "balloonText": "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",
              "bullet": "round",
              "bulletBorderAlpha": 1,
              "bulletColor": "#FFFFFF",
              "bulletSize": 7,
              "lineThickness": 2,
              "type": "smoothedLine",
              "useLineColorForBulletBorder": true,
              "valueField": "value"
            }],
            "chartScrollbar": {
              "enabled": false,
            },
            "chartCursor": {
              "cursorPosition": "mouse",
              "cursorColor": "#258cbb",
              "valueLineAplha": 0.2,
              "showHandOnHover": true,
              "categoryBalloonDateFormat": format_date,
            },
            "categoryField": "date",
          }
      ;
      function generate_ChartData(data_){
        var ret = [];
        if(data_ && data_.length)
          for (var i = data_.length-1; i >= 0; i--) {
            ret.push({
              date: data_[i].tanggal,
              value: ('undefined' != typeof data_[i].count ? parseInt(data_[i].count) : 0)
            })
          }
        return ret;
      }

      // render-chart
      chart = AmCharts.makeChart(params.dom_id_chart, options);
    };

    ChHandler.draw_out = function(params){
      var chart = null,
          chartData = generate_ChartData(dataOut),
          options = {
            "type": "serial",
            "theme": "light",
            "pathToImages": ChHandler.get_amchart_imagepath(),
            "hideCredits": true,
            "fontFamily": "Verdana,Arial,sans-serif",
            "dataProvider": chartData,
            "titles": [{
              "text": "Statistik Jumlah Pegawai Keluar Bulanan",
              "color": "#666",
              "size": 16
            }],
            "valueAxes": [{
              "gridColor": "#c1c1c1",
              "axisColor": "#DADADA",
              "axisThickness": 1,
              "axisAlpha": 1,
              "position": "left",
              "integersOnly": true,
            }],
            "graphs": [{
              "id": "g1",
              "balloonText": "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",
              "bullet": "round",
              "bulletBorderAlpha": 1,
              "bulletColor": "#FFFFFF",
              "bulletSize": 7,
              "lineThickness": 2,
              "type": "smoothedLine",
              "useLineColorForBulletBorder": true,
              "valueField": "value"
            }],
            "chartScrollbar": {
              "enabled": false,
            },
            "chartCursor": {
              "cursorPosition": "mouse",
              "cursorColor": "#258cbb",
              "valueLineAplha": 0.2,
              "showHandOnHover": true
            },
            "categoryField": "date"
          }
      ;
      function generate_ChartData(data_){
        var ret = [];
        if(data_ && data_.length)
          for (var i = data_.length-1; i >= 0; i--) {
            ret.push({
              date: data_[i].tanggal,
              value: ('undefined' != typeof data_[i].count ? parseInt(data_[i].count) : 0)
            })
          }
        return ret;
      }

      // render-chart
      chart = AmCharts.makeChart(params.dom_id_chart, options);
    };

    // amchart: pies
    ChHandler.draw_status = function(params){
      var chart = null,
          chartData = generate_ChartData(dataStatus),
          options = {
            "type": "pie",
            "theme": "light",
            "pathToImages": ChHandler.get_amchart_imagepath(),
            "hideCredits": true,
            "fontFamily": "Verdana,Arial,sans-serif",
            "dataProvider": chartData,
            "titles": [{
              "text": "Distribusi Pegawai Berdasarkan Status",
              "color": "#666",
              "size": 16
            }],
            "valueField": "value",
            "titleField": "status"
          }
      ;
      function generate_ChartData(data_){
        var ret = [];
        if(data_ && data_.length)
          for (var i = 0, iL = data_.length; i < iL; i++) {
            ret.push({
              status: data_[i].status,
              value: ('undefined' != typeof data_[i].total ? parseInt(data_[i].total) : 0)
            })
          }
        return ret;
      }

      // render-chart
      chart = AmCharts.makeChart(params.dom_id_chart, options);
    };

    ChHandler.draw_gender = function(params){
      var chart = null,
          chartData = generate_ChartData(dataGender),
          options = {
            "type": "pie",
            "theme": "light",
            "pathToImages": ChHandler.get_amchart_imagepath(),
            "hideCredits": true,
            "fontFamily": "Verdana,Arial,sans-serif",
            "dataProvider": chartData,
            "titles": [{
              "text": "Distribusi Pegawai Berdasarkan Jenis Kelamin",
              "color": "#666",
              "size": 16
            }],
            "valueField": "value",
            "titleField": "gender"
          }
      ;
      function generate_ChartData(data_){
        var ret = [];
        if(data_ && data_.length)
          for (var i = 0, iL = data_.length; i < iL; i++) {
            ret.push({
              gender: data_[i].gender,
              value: ('undefined' != typeof data_[i].total ? parseInt(data_[i].total) : 0)
            })
          }
        return ret;
      }

      // render-chart
      chart = AmCharts.makeChart(params.dom_id_chart, options);
    };

    ChHandler.draw_educations = function(params){
      var chart = null,
          chartData = generate_ChartData(dataEducations),
          options = {
            "type": "pie",
            "theme": "light",
            "pathToImages": ChHandler.get_amchart_imagepath(),
            "hideCredits": true,
            "fontFamily": "Verdana,Arial,sans-serif",
            "dataProvider": chartData,
            "titles": [{
              "text": "Distribusi Pegawai Berdasarkan Pendidikan",
              "color": "#666",
              "size": 16
            }],
            "valueField": "value",
            "titleField": "level"
          }
      ;
      function generate_ChartData(data_){
        var ret = [];
        if(data_ && data_.length)
          for (var i = 0, iL = data_.length; i < iL; i++) {
            ret.push({
              level: data_[i].level,
              value: ('undefined' != typeof data_[i].total ? parseInt(data_[i].total) : 0)
            })
          }
        return ret;
      }

      // render-chart
      chart = AmCharts.makeChart(params.dom_id_chart, options);
    };

    ChHandler.draw_ages = function(params){
      var chart = null,
          chartData = generate_ChartData(dataAges),
          options = {
            "type": "pie",
            "theme": "light",
            "pathToImages": ChHandler.get_amchart_imagepath(),
            "hideCredits": true,
            "fontFamily": "Verdana,Arial,sans-serif",
            "dataProvider": chartData,
            "titles": [{
              "text": "Distribusi Pegawai Berdasarkan Usia",
              "color": "#666",
              "size": 16
            }],
            "valueField": "value",
            "titleField": "age"
          }
      ;
      function generate_ChartData(data_){
        var ret = [];
        if(data_ && data_.length)
          for (var i = 0, iL = data_.length; i < iL; i++) {
            ret.push({
              age: data_[i].age,
              value: ('undefined' != typeof data_[i].total ? parseInt(data_[i].total) : 0)
            })
          }
        return ret;
      }

      // render-chart
      chart = AmCharts.makeChart(params.dom_id_chart, options);
    };

    // chart-helpers
    ChHandler.get_amchart_imagepath = function(){
      return BASE_URL+"/bower/amcharts3/amcharts/images/";
    };
    
    // Ready !
    $(function(){
      ChHandler.draw_active({
        dom_id_chart: 'activechart',
      });
      ChHandler.draw_out({
        dom_id_chart: 'outchart',
      });
      ChHandler.draw_status({
        dom_id_chart: 'statuschart',
      });
      ChHandler.draw_gender({
        dom_id_chart: 'genderchart',
      });
      ChHandler.draw_educations({
        dom_id_chart: 'educationschart',
      });
      ChHandler.draw_ages({
        dom_id_chart: 'ageschart',
      });
    });
  })(window.$||window.jQuery||jQuery);
</script>

@endpush