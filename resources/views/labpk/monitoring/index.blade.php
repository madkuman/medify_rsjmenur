@extends('layouts.main2')
@section('title')
Monitoring
@endsection
@section('css')

@endsection
@section('content')
@include('labpk.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Monitoring</h3>
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label>Pasien</label>
                        <select class="form-control js-select2" id="filter-pasien" style="width: 100%;" data-placeholder="Cari Pasien">
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label>Parameter</label>
                        <select class="form-control js-select2" id="filter-parameter" style="width: 100%;">
                            @foreach($parameters as $item)
                            <option value="{{$item->id}}">{{$item->parameter}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group row">
                        <label class="col-12" for="example-daterange1">Rentang Waktu*</label>
                        <div class="col-lg-12">
                            <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-end-date="+0d">
                                <input type="text" class="form-control" autocomplete="off" id="filter-daterange1" name="daterange1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_range_start_month_default->format('d-m-Y')}}" required="">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text font-w600">to</span>
                                </div>
                                <input type="text" class="form-control" autocomplete="off" id="filter-daterange2" name="daterange2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_range_end_month_default->format('d-m-Y')}}" required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group pt-20">
                        <button class="btn-alt btn-primary" id="filter-btn">Filter</button>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="block-content" id="result" style="display: none">
            <div id="result-title"></div>
            <div id="result-graph" style="width: 100%; height: 430px;display: none"></div>
            <div id="loading" style="height: 400px" class="text-center pt-50" style="display: none">
                <i class="fa fa-spin fa-spinner text-primary fa-4x"></i>
            </div>
        </div>
    </div>
    {{Form::close()}}
</div>
@include('labpk.components.footer')
@endsection

@section('js')
@include('layouts.components2.js.pasien-select2-search')
<script type="text/javascript">
    initSelect2PasienSearch('#filter-pasien')
</script>

<script src="{{ asset('bower/amcharts3/amcharts/amcharts.js') }}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/serial.js') }}"></script>
<script src="{{ asset('assets/js/codebase.js') }}"></script>
<script type="text/javascript">
    $('#filter-btn').click(function(){
        $('#result').show()
        getData('result-graph');
    })

    function getData(element_id)
    {   
        var pasien_id = $('#filter-pasien').val()
        var parameter = $('#filter-parameter').val()
        var start_date = $('#filter-daterange1').val()
        var end_date = $('#filter-daterange2').val()

        $('#result #result-graph').hide();
        $('#result #loading').show();

        $.ajax({
            url: API_URL + '/labpk/monitoring/get-data?pasien_id='+pasien_id+'&parameter='+parameter+'&start_date='+start_date+'&end_date='+end_date,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var unit = '';
                var parameter_name = '';
                if(data.length > 0) unit = data[0].satuan
                if(data.length > 0) parameter_name = data[0].parameter
                makeChartSerial(data,element_id,unit,parameter_name,'YYYY-MM-DD HH:NN','DD MMM YYYY HH:NN','mm')
                $('#result #result-graph').show();
                $('#result #loading').hide();
            },
            error: function() {
                $('#result #result-graph').show();
                $('#result #loading').hide();
            },
        });
    }

    function makeChartSerial(chartData,element_id,unit, title,date_format, date_format_pretty, minPeriod){
        chart = AmCharts.makeChart(element_id,
        {
            "type": "serial",
            "categoryField": "date",
            "dataDateFormat": date_format,
            "theme": "light",
            "pathToImages": "https://sim.rsalramelan.com/bower/amcharts3/amcharts/images/",
            "categoryAxis": {
                "minPeriod": minPeriod,
                "parseDates": true
            },
            "chartCursor": {
                "enabled": true,
                "categoryBalloonDateFormat": date_format_pretty
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
                "id": "ID",
                "title": title,
                "unit": " "+unit
            }
            ],
            "allLabels": [],
            "balloon": {},
            "legend": {
                "enabled": false
            },
            "startEffect" : "easeInSine",
            "dataProvider": chartData
        });
    };
</script>
@endsection