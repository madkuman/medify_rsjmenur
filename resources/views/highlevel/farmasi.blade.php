@extends('highlevel.layouts.main')

@section('title')
Farmasi - High Level Report
@endsection

@section('subtitle')
Farmasi
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
                <div class="form-group">
                    <select class="form-control" id="selectFarmasi">
                        <option value="{{implode(',',$farmasi_id)}}">Semua Farmasi</option>
                        @foreach($farmasi as $item)
                        <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="block" id="chartTransaksiJumlahBlock">
                    <div class="block-header">
                        <h3 class="block-title">Jumlah Transaksi</h3>
                    </div>
                    <div class="block-content">
                        <div id="chartTransaksiJumlah" style="width: 100%; height: 430px;"></div>
                    </div>
                </div>

                <div class="block" id="chartTransaksiNilaiBlock">
                    <div class="block-header">
                        <h3 class="block-title">Nilai Transaksi</h3>
                    </div>
                    <div class="block-content">
                        <div id="chartTransaksiNilai" style="width: 100%; height: 430px;"></div>
                    </div>
                </div>

                <div class="block" id="chartTransaksiResponseTimeBlock">
                    <div class="block-header">
                        <h3 class="block-title">Response Time Transaksi</h3>
                    </div>
                    <div class="block-content">
                        <div id="chartTransaksiResponseTime" style="width: 100%; height: 430px;"></div>
                    </div>
                </div>
                <div class="row row-deck">
                    <div class="col-lg-6 col-md-12">
                        <div class="block" id="chartDistribusiAsuransiPasienBlock">
                            <div class="block-header">
                                <h3 class="block-title">Asuransi Pasien</h3>
                                <div class="block-options">
                                    <select class="form-control" id="selectWaktuDistribusiAsuransiPasien">
                                        <option value="bulan">Bulan Ini</option>
                                        <option value="triwulan">Triwulan Ini</option>
                                        <option value="tahun">Tahun Ini</option>
                                    </select>
                                </div>
                            </div>
                            <div class="block-content">
                                <div id="chartDistribusiAsuransiPasien" style="width: 100%; height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="block" id="rankObatTopBlock">
                            <div class="block-header">
                                <h3 class="block-title">Obat Paling Sering Dipakai</h3>
                                <div class="block-options">
                                    <select class="form-control" id="selectWaktuRankObatTop">
                                        <option value="bulan">Bulan Ini</option>
                                        <option value="triwulan">Triwulan Ini</option>
                                        <option value="tahun">Tahun Ini</option>
                                    </select>
                                </div>
                            </div>
                            <div class="block-content">
                                <table class="table table-striped" id="rankObatTopTable">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Nama Obat</td>
                                            <td>Total Terpakai</td>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-deck">
                    <div class="col-lg-12 col-md-12">
                        <div class="block" id="chartAllDistribusiJumlahBlock">
                            <div class="block-header">
                                <h3 class="block-title">Distribusi Jumlah Transaksi</h3>
                                <div class="block-options">
                                    <select class="form-control" id="selectWaktuAllDistribusiJumlah">
                                        <option value="bulan">Bulan Ini</option>
                                        <option value="triwulan">Triwulan Ini</option>
                                        <option value="tahun">Tahun Ini</option>
                                    </select>
                                </div>
                            </div>
                            <div class="block-content">
                                <div id="chartAllDistribusiJumlah" style="width: 100%; height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="block" id="chartAllDistribusiNilaiBlock">
                            <div class="block-header">
                                <h3 class="block-title">Distribusi Nilai Transaksi <small>(Juta)</small></h3>
                                <div class="block-options">
                                    <select class="form-control" id="selectWaktuAllDistribusiNilai">
                                        <option value="bulan">Bulan Ini</option>
                                        <option value="triwulan">Triwulan Ini</option>
                                        <option value="tahun">Tahun Ini</option>
                                    </select>
                                </div>
                            </div>
                            <div class="block-content">
                                <div id="chartAllDistribusiNilai" style="width: 100%; height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script src="{{ asset('bower/amcharts3/amcharts/amcharts.js') }}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/pie.js') }}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/serial.js') }}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/themes/light.js') }}"></script>
<script src="{{ asset('assets/js/codebase.js') }}"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        getData('transaksi-jumlah','chartTransaksiJumlah','init');
        getData('transaksi-nilai','chartTransaksiNilai','init');
        getData('transaksi-response-time','chartTransaksiResponseTime','init');
        getData('distribusi-asuransi-pasien','chartDistribusiAsuransiPasien','init');
        getData('rank-obat-top','rankObatTop','init');
        getData('all-transaksi-jumlah','chartAllDistribusiJumlah','init');
        getData('all-transaksi-nilai','chartAllDistribusiNilai','init');
    });

    $('#selectFarmasi').change(function(){
        getData('transaksi-jumlah','chartTransaksiJumlah','update');
        getData('transaksi-nilai','chartTransaksiNilai','update');
        getData('transaksi-response-time','chartTransaksiResponseTime','update');
        getData('distribusi-asuransi-pasien','chartDistribusiAsuransiPasien','update');
        getData('rank-obat-top','rankObatTop','update')
    })


    function getData(type,element_id,action)
    {
        Codebase.blocks('#'+element_id+'Block', 'state_toggle');

        var url = '';
        var unit = '';
        var farmasi_id = $('#selectFarmasi').val()
        var chart_type = '';

        if(type == 'transaksi-jumlah') {
            url = 'transaksi/jumlah?farmasi='+farmasi_id;
            chart_type = 'serial'
        }
        else if(type == 'transaksi-nilai') {
            url = 'transaksi/nilai?farmasi='+farmasi_id;
            unit = 'jt';
            chart_type = 'serial'
        }
        else if(type == 'transaksi-response-time') {
            url = 'transaksi/response-time?farmasi='+farmasi_id;
            unit = 'menit';
            chart_type = 'serial'
        }
        else if(type == 'distribusi-asuransi-pasien') {
            custom_date = $('#selectWaktuDistribusiAsuransiPasien').val();
            url = 'transaksi/distribusi-asuransi-pasien?farmasi='+farmasi_id+'&custom_date='+custom_date;
            chart_type = 'pie'
        }
        else if(type == 'rank-obat-top') {
            custom_date = $('#selectWaktuRankObatTop').val();
            url = 'transaksi/rank-obat-top?farmasi='+farmasi_id+'&custom_date='+custom_date;
            chart_type = 'table'
        }
        else if(type == 'all-transaksi-jumlah')
        {
            custom_date = $('#selectWaktuAllDistribusiJumlah').val();
            url = 'transaksi/jumlah-all?custom_date='+custom_date;
            chart_type = 'pie'
        }
        else if(type == 'all-transaksi-nilai')
        {
            custom_date = $('#selectWaktuAllDistribusiNilai').val();
            url = 'transaksi/nilai-all?custom_date='+custom_date;
            chart_type = 'pie'
        }
        $.ajax({
            url: API_URL + '/highlevelreport/farmasi/get-data/'+ url,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if(chart_type=='table') makeTable(data,element_id)
                else{
                    if(action == 'init') {
                        if(chart_type == 'serial') makeChartSerial(data,element_id, unit)
                        else if(chart_type=='pie') makeChartPie(data,element_id,unit)
                    }
                    else updateChart(data,element_id)
                }

                Codebase.blocks('#'+element_id+'Block', 'state_toggle');
            },
            error: function() {
                Codebase.blocks('#'+element_id+'Block', 'state_toggle');
            },
        });
    }

    function getChart(id) {
        var allCharts = AmCharts.charts;
        for (var i = 0; i < allCharts.length; i++) {
            if (id == allCharts[i].div.id) {
                return allCharts[i];
            }
        }
    }

    function makeTable(data,element_id){
        var element_name = '#'+element_id+'Table tbody';
        $(element_name).empty();
        content = '';
        $.each(data, function( index, item ) {
            var number = index + 1;
            content+=`
                <tr>
                    <td class="text-center">`+number+`</td>
                    <td>`+item.obat_nama+`</td>
                    <td class="text-center">`+item.jumlah+`</td>
                </tr>
            `;
        });

        $(element_name).html(content);
    }

    function updateChart(data,element_id)
    {
        var chart = getChart(element_id)
        chart.dataProvider =  data;
        chart.validateData();
        chart.startEffect = 'easeInSine';
        chart.startvalue = 0.5;
        chart.animateAgain();
    }


    function makeChartPie(chartData,element_id,unit){
        chart = AmCharts.makeChart(element_id,
        {
            "type": "pie",
            "theme": "light",
            "labelsEnabled": false,
            "hideCredits": true,
            "dataProvider": chartData,
            "legend": {
                "position": "right"
            },
            "valueField": "value",
            "titleField": "nama"
        });
    }

    function makeChartSerial(chartData,element_id,unit){
        chart = AmCharts.makeChart(element_id,
        {
            "type": "serial",
            "categoryField": "date",
            "dataDateFormat": "YYYY-MM",
            "theme": "light",
            "pathToImages": "{{url('bower/amcharts3/amcharts/images')}}/",
            "categoryAxis": {
                "minPeriod": "mm",
                "parseDates": true
            },
            "chartCursor": {
                "enabled": true,
                "categoryBalloonDateFormat": "MMM YYYY"
            },
            "chartScrollbar": {
                "enabled": true
            },
            "trendLines": [],
            "graphs": [
            {
                "fillAlphas": 0.7,
                "id": "AmGraph-1",
                "lineAlpha": 0,
                "valueField": "value",
                "bullet" : "square",
                "bulletBorderThickness" : 1,
                "bulletBorderAlpha" : 1
            }
            ],
            "guides": [],
            "valueAxes": [
            {
                "id": "ValueAxis-1",
                "title": "Axis title",
                "unit": " "+unit
            }
            ],
            "allLabels": [],
            "balloon": {},
            "legend": {
                "enabled": true
            },
            "startEffect" : "easeInSine",
            "dataProvider": chartData
        });
    };

    $('#selectWaktuDistribusiAsuransiPasien').change(function(){
        getData('distribusi-asuransi-pasien','chartDistribusiAsuransiPasien','update');
    })
    $('#selectWaktuRankObatTop').change(function(){
        getData('rank-obat-top','rankObatTop','update');
    })
    $('#selectWaktuAllDistribusiNilai').change(function(){
        getData('all-transaksi-nilai','chartAllDistribusiNilai','update');
    })
    $('#selectWaktuAllDistribusiJumlah').change(function(){
        getData('all-transaksi-jumlah','chartAllDistribusiJumlah','init');
    })




</script>
@endsection