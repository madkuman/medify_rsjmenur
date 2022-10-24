@extends('highlevel.layouts.main')

@section('title')
Gudang - High Level Report
@endsection

@section('subtitle')
Gudang
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
                <div class="block" id="chartKekayaanBlock">
                    <div class="block-header">
                        <h3 class="block-title">Grafik Kekayaan</h3>
                    </div>
                    <div class="block-content">
                        <div id="chartKekayaan" style="width: 100%; height: 430px;"></div>
                    </div>
                </div>
                <div class="block" id="chartDistribusiBlock">
                    <div class="block-header">
                        <h3 class="block-title">Grafik Distribusi Keluar</h3>
                    </div>
                    <div class="block-content">
                        <div id="chartDistribusi" style="width: 100%; height: 430px;"></div>
                    </div>
                </div>
                <div class="block" id="chartPengadaanBlock">
                    <div class="block-header">
                        <h3 class="block-title">Grafik Penerimaan dari Supplier</h3>
                    </div>
                    <div class="block-content">
                        <div id="chartPengadaan" style="width: 100%; height: 430px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script src="{{ asset('bower/amcharts3/amcharts/amcharts.js') }}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/serial.js') }}"></script>
<script src="{{ asset('assets/js/codebase.js') }}"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        Codebase.blocks('#chartKekayaanBlock', 'state_toggle');
        Codebase.blocks('#chartPengadaanBlock', 'state_toggle');
        Codebase.blocks('#chartDistribusiBlock', 'state_toggle');

        getData('kekayaan','chartKekayaan');
        getData('pengadaan','chartPengadaan');
        getData('distribusi','chartDistribusi');
    });


    function getData(type,element_id)
    {
        $.ajax({
            url: API_URL + '/highlevelreport/gudang/get-data/'+ type,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                makeChart(data,element_id)
                Codebase.blocks('#'+element_id+'Block', 'state_toggle');
            },
            error: function() {
            },
        });
    }


    function makeChart(chartData,element_id){
        chart = AmCharts.makeChart(element_id,
        {
            "type": "serial",
            "categoryField": "date",
            "dataDateFormat": "YYYY-MM",
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
                "unit": " jt"
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
</script>
@endsection