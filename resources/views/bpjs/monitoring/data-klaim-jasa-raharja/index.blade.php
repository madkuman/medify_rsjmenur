@extends('bpjs.layouts.main')

@section('title')
Data Klaim Jasa Raharja - Monitoring
@endsection

@section('subtitle')
Monitoring / Data Klaim Jasa Raharja
@endsection

@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
.pink {
  background-color: pink !important;
}
</style>
@endsection
@section('content')
<main id="main-container">
    @include('bpjs.layouts.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded" id="main-block">
                    <div class="block-header py-20">
                        <h4 class="mb-0">Monitoring Data Klaim Jasa Raharja <span class="badge badge-danger">BPJS API 404, WAITING FOR PRODUCTION, USING DATA SAMPLE</span></h4>
                    </div>
                    <div class="block-content py-20">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group row">
                                    <label class="col-12">Rentang Waktu</label>
                                    <div class="col-lg-12">
                                        <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-end-date="+0d">
                                            <input type="text" class="form-control filter-date-start" autocomplete="off" name="daterange1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_start}}" required="">
                                            <div class="input-group-prepend input-group-append">
                                                <span class="input-group-text font-w600">to</span>
                                            </div>
                                            <input type="text" class="form-control filter-date-end" autocomplete="off" name="daterange2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_end}}" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2" id="by-date-button">
                                <label>&nbsp;</label><br>
                                <button id="buttonRefresh" style="margin-bottom: 5px;" url="" class="btn btn-secondary">
                                    <i class="fa fa-refresh"></i> Filter
                                </button>
                            </div>
                            <div class="col-12">
                                <hr>                
                            </div>
                        </div> 
                        <div class="col-12">
                            <table class="table table-striped table-hover table-vcenter js-dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-left" style="width:20%">No SEP</th>
                                        <th class="text-center" style="width:12.5%;">Nama</th>
                                        <th class="text-center" style="width:10%;">Tanggal Kejadian</th>
                                        <th class="text-center" style="width:10%;">Status Jaminan</th>
                                        <th class="text-right" style="width:12.5%;">Biaya Dijamin</th>
                                        <th class="text-right" style="width:12.5%;">Plafon</th>
                                        <th class="text-right" style="width:12.5%;">Jumlah Dibayar</th>
                                        <th class="text-right" style="width:10%;">Detail</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

@include('bpjs.monitoring.data-klaim-jasa-raharja.components.modal-detail-klaim')

@endsection

@section('js')


<script type="text/javascript">

    var init_data = 1;
    var datatable;
    var current_data = [];
    var jsonFormatterNumberParse = ['biayaDijamin','plafon','jmlDibayar']

    $( document ).ready(function() {
        getData();
    });

    function getUrl()
    {
        var tanggal_start = $('.filter-date-start').val();
        var tanggal_end = $('.filter-date-end').val();

        url = "{{url('')}}/api/bpjs/monitoring/data-klaim-jasa-raharja/get-data?tanggal_start="+tanggal_start+"&tanggal_end="+tanggal_end;

        return url;

    }

    function getData()
    {
        url = getUrl();
        $.ajax({
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            success: function(data){
                var data_klaim = [];
                current_data = data;
                $.each(data, function( index, item ) {

                    var biayaDijamin = "Rp" + numeral(item.jasaRaharja.biayaDijamin).format('0,0')
                    var plafon = "Rp" + numeral(item.jasaRaharja.plafon).format('0,0')
                    var jmlDibayar = "Rp" + numeral(item.jasaRaharja.jmlDibayar).format('0,0')
                    var buttonDetail = `<button class="btn btn-primary btn-detail-klaim" data-index="`+index+`"><i class="fa fa-search-plus"></i> Detail</button>`

                    temp_array = [];
                    temp_array.push(item.sep.noSEP);
                    temp_array.push(item.sep.peserta.nama);
                    temp_array.push(item.jasaRaharja.tglKejadian);
                    temp_array.push(item.jasaRaharja.ketStatusDijamin);
                    temp_array.push(biayaDijamin);
                    temp_array.push(plafon);
                    temp_array.push(jmlDibayar);
                    temp_array.push(buttonDetail);
                    data_klaim.push(temp_array);
                });

                if(init_data == 1) {
                    loadDataTable(data_klaim)
                    init_data = 0;
                }
                else updateDataTable(data_klaim)
            },
            error: function (request, status, error) {
                if(init_data == 1) {
                    loadDataTable([])
                    init_data = 0;
                }
                else updateDataTable([])
            }
        });
    }

    function destroyDataTable()
    {
        $('js-dataTable').dataTable().fnClearTable();
        $('js-dataTable').dataTable().fnDestroy();
    }

    function updateDataTable(dataSet)
    {
        datatable.clear().draw();
        datatable.rows.add(dataSet);
        datatable.columns.adjust().draw();
    }

    function loadDataTable(dataSet)
    {
        datatable = $('.js-dataTable').DataTable({
            "data": dataSet,
            "processing": true,
            'language': {
                'loadingRecords': '&nbsp;',
                'processing': '<i class="fa fa-spinner fa-spin fa-4x"></i>'
            },
            "columns": [
                { title: "No SEP" },
                { title: "Nama" },
                { title: "Tangal Kejadian",className: "text-center" },
                { title: "Status Jaminan" },
                { title: "Dijamin", className: "text-right"},
                { title: "Plafon", className: "text-right"},
                { title: "Dibayar", className: "text-right"},
                { title: "Detail", className: "text-center"}
            ]

        });
    }
    $('#buttonRefresh').click(function(){
        getData();
    })

    $(document).on('click', '.btn-detail-klaim', function(){ 
        var id = $(this).data('index');
        var content = current_data[id];
        content = jsonFormatHtml(content)

        $('#modal-detail-klaim .block-content table tbody').html(content);
        $('#modal-detail-klaim').modal('show');
    });
</script>
@include('assets.js.json-formatter')
@endsection