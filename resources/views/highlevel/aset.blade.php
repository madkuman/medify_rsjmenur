@extends('highlevel.layouts.main')

@section('title')
Aset - High Level Report
@endsection

@section('subtitle')
Aset
@endsection

@section('content')

<main id="main-container">
  @include('highlevel.layouts.navbar')
  <div class="container">
    <div class="row">
      <div class="col-xl-3 mb-20">
        @include('highlevel.layouts.sidebar')
      </div>
      <div class="col-xl-9">
        <div class="pb-3">
        <h5>Statistik Pengadaan Barang Tetap</h5>
          <div class="row gutters-tiny js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="col">
              <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                  <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500">{{$pengadaan_tetap_bulan_ini}}</div>
                  <div class="font-size-sm font-w600 text-uppercase text-muted">Pengadaan Bulan Ini</div>
                </div>
              </a>
            </div>
            <div class="col">
              <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                  <div class="font-size-h3 font-w600"><span data-toggle="countTo" data-speed="1000" data-to="780" class="js-count-to-enabled">Rp. {{number_format($total_harga_tetap)}}</span></div>
                  <div class="font-size-sm font-w600 text-uppercase text-muted">Total Nilai Pengadaan</div>
                </div>
              </a>
            </div>
            <div class="col">
              <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                  <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="15">Rp. {{number_format($total_harga_tetap_bulan_ini)}}</div>
                  <div class="font-size-sm font-w600 text-uppercase text-muted">Total Nilai Pengadaan Bulan Ini</div>
                </div>
              </a>
            </div>
          </div>
        </div>

        <div class="pb-3">
          <h5>Statistik Pengadaan Barang Habis Pakai</h5>
          <div class="row gutters-tiny js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="col">
              <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                  <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500">{{$pengadaan_habis_pakai_bulan_ini}}</div>
                  <div class="font-size-sm font-w600 text-uppercase text-muted">Pengadaan Bulan Ini</div>
                </div>
              </a>
            </div>
            <div class="col">
              <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                  <div class="font-size-h3 font-w600"><span data-toggle="countTo" data-speed="1000" data-to="780" class="js-count-to-enabled">Rp. {{number_format($total_harga_habis_pakai)}}</span></div>
                  <div class="font-size-sm font-w600 text-uppercase text-muted">Total Nilai Pengadaan</div>
                </div>
              </a>
            </div>
            <div class="col">
              <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                  <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="15">Rp. {{number_format($total_harga_habis_pakai_bulan_ini)}}</div>
                  <div class="font-size-sm font-w600 text-uppercase text-muted">Total Nilai Pengadaan Bulan Ini</div>
                </div>
              </a>
            </div>
          </div>
        </div>

        <div class="row row-deck">
          <div class="col-xl-8">
            <div class="block">
              <div class="block-header block-header-default">
                <h3 class="block-title"><center>Statistik Jumlah Pengadaan Barang Tetap</center></h3>
              </div>
              <div class="block-content block-content-full">
                <div class="js-flot-lines1" style="height: 340px;"></div>
              </div>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="block">
              <div class="block-header block-header-default">
                <h3 class="block-title"><center>Persebaran Kategori</center></h3>
              </div>
              <div class="block-content block-content-full">
                <div class="js-flot-pie4" style="height: 250px;"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="row row-deck">
          <div class="col-xl-8">
            <div class="block">
              <div class="block-header block-header-default">
                <h3 class="block-title"><center>Statistik Jumlah Pengadaan Barang Habis Pakai</center></h3>
              </div>
              <div class="block-content block-content-full">
                <div class="js-flot-lines2" style="height: 340px;"></div>
              </div>
            </div>
          </div>
        </div>

      </div>  
    </div>
  </div>
</main>
@endsection

@section('css')
<style type="text/css">
.clickable-row {
  cursor: pointer;
}
</style>
@endsection
@section('js')
<script type="text/javascript">
  var BeCompCharts = function() {
    var initRandomEasyPieChart = function(){
      var flotLines1 = jQuery('.js-flot-lines1');
      var flotLines2 = jQuery('.js-flot-lines2');
      var flotPie4  = jQuery('.js-flot-pie4');

      var dataLine1    = [];
      var dataLine2    = [];

      var color = ['#1abc9c', '#ffca28', '#26c6da', '#9ccc65', '#e67e22', '#2c3e50', '#95a5a6', '#3498db', '#ecf0f1', '#c0392b', '#bdc3c7', '#8e44ad'];

      var dataMonths  = [[1, 'Jan'], [2, 'Feb'], [3, 'Mar'], [4, 'Apr'], [5, 'May'], [6, 'Jun'], [7, 'Jul'], [8, 'Aug'], [9, 'Sep'], [10, 'Oct'], [11, 'Nov'], [12, 'Dec']];

      var dataWeek = [[1, 'Senin'], [2, 'Selasa'], [3, 'Rabu'], [4, 'Kamis'], [5, 'Jumat'], [6, 'Sabtu'], [7, 'Minggu']];

      @foreach($statistik_pengadaan_tetap as $value)
      dataLine1.push([{{$value['month']}}, {{$value['pengadaan_tetap']}}]); @endforeach

      @foreach($statistik_pengadaan_habis_pakai as $value)
      dataLine2.push([{{$value['month']}}, {{$value['pengadaan_habis_pakai']}}]); @endforeach

      if ( flotLines1.length ) {
        jQuery.plot(flotLines1,
          [
            {
              label: 'Jumlah Pengadaan Tetap',
              data: dataLine1,
              lines: {
                show: true,
                fill: true,
                fillColor: {
                  colors: [{opacity: .7}, {opacity: .7}]
                }
              },
              points: {
                show: true,
                radius: 5
              }
            }
          ],
          {
            colors: color,
            legend: {
              show: true,
              position: 'nw',
              backgroundOpacity: 0
            },
            grid: {
              borderWidth: 0,
              hoverable: true,
              clickable: true
            },
            yaxis: {
              tickColor: '#ffffff',
              ticks: 3
            },
            xaxis: {
              ticks: dataMonths,
              tickColor: '#f5f5f5'
            }
          }
        );

        // Creating and attaching a tooltip to the classic chart
        var previousPoint = null, ttlabel = null;
        flotLines1.bind('plothover', function(event, pos, item) {
          if (item) {
            if (previousPoint !== item.dataIndex) {
              previousPoint = item.dataIndex;

              jQuery('.js-flot-tooltip').remove();
              var x = item.datapoint[0], y = item.datapoint[1];

              ttlabel = '<strong>' + y + '</strong> Data';


              jQuery('<div class="js-flot-tooltip flot-tooltip">' + ttlabel + '</div>')
              .css({top: item.pageY - 45, left: item.pageX + 5}).appendTo("body").show();
            }
          }
          else {
            jQuery('.js-flot-tooltip').remove();
            previousPoint = null;
          }
        });
      }

      if ( flotLines2.length ) {
        jQuery.plot(flotLines2,
                [
                  {
                    label: 'Jumlah Pengadaan Habis Pakai',
                    data: dataLine2,
                    lines: {
                      show: true,
                      fill: true,
                      fillColor: {
                        colors: [{opacity: .7}, {opacity: .7}]
                      }
                    },
                    points: {
                      show: true,
                      radius: 5
                    }
                  }
                ],
                {
                  colors: color,
                  legend: {
                    show: true,
                    position: 'nw',
                    backgroundOpacity: 0
                  },
                  grid: {
                    borderWidth: 0,
                    hoverable: true,
                    clickable: true
                  },
                  yaxis: {
                    tickColor: '#ffffff',
                    ticks: 3
                  },
                  xaxis: {
                    ticks: dataMonths,
                    tickColor: '#f5f5f5'
                  }
                }
        );

        // Creating and attaching a tooltip to the classic chart
        var previousPoint = null, ttlabel = null;
        flotLines2.bind('plothover', function(event, pos, item) {
          if (item) {
            if (previousPoint !== item.dataIndex) {
              previousPoint = item.dataIndex;

              jQuery('.js-flot-tooltip').remove();
              var x = item.datapoint[0], y = item.datapoint[1];

              ttlabel = '<strong>' + y + '</strong> Data';


              jQuery('<div class="js-flot-tooltip flot-tooltip">' + ttlabel + '</div>')
                      .css({top: item.pageY - 45, left: item.pageX + 5}).appendTo("body").show();
            }
          }
          else {
            jQuery('.js-flot-tooltip').remove();
            previousPoint = null;
          }
        });
      }

      if ( flotPie4.length ) {
        var array = [], item = {};
        array = [
          @foreach($persebaran as $nama => $jumlah)
            {data: {{$jumlah}}+0, label: '{{$nama}}'},
          @endforeach
        ]
        jQuery.plot(flotPie4,
          array,
          {
            colors: color,
            legend: {show: false},
            series: {
              pie: {
                show: true,
                radius: 1,
                label: {
                  show: true,
                  radius: 2/3,
                  formatter: function(label, pieSeries) {
                    return '<div class="flot-pie-label">' + label + '<br>' + Math.round(pieSeries.percent) + '%</div>';
                  },
                  background: {
                    opacity: .75,
                    color: '#000000'
                  }
                }
              }
            }
          }
        );
      }
    };
    return {
      init: function () {
        // Init Flot Charts
        initRandomEasyPieChart();
      }
    };
  }();
  jQuery(function(){ 
    BeCompCharts.init(); 
  });
  $(".clickable-row").click(function() {
    window.location = $(this).data("href");
  });
</script>
@endsection