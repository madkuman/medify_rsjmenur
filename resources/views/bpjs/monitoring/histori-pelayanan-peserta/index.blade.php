@extends('bpjs.layouts.main')

@section('title')
Histori Pelayanan Peserta - Monitoring
@endsection

@section('subtitle')
Monitoring / Histori Pelayanan Peserta
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
                        <h4 class="mb-0">Monitoring Histori Pelayanan Peserta <span class="text-pasien text-primary"></span></h4>
                    </div>
                    <div class="block-content py-20">
                        <div class="row">
                            <div class="col-3">
                                <label>No BPJS</label>
                                <input class="form-control filter-no-bpjs">
                                <small>Contoh : 0001160271256, 00011602712123</small>
                            </div>
                            <div class="col-4">
                                <div class="form-group row">
                                    <label class="col-12">Rentang Waktu</label>
                                    <div class="col-lg-12">
                                        <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
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
                                        <th class="text-center" style="width:12.5%;">Tanggal SEP</th>
                                        <th class="text-center" style="width:12.5%;">Jenis Pelayanan</th>
                                        <th class="text-right" style="width:12.5%;">Kelas</th>
                                        <th class="text-center" style="width:15%;">Poli</th>
                                        <th class="text-center" style="width:17.5%;">PPK</th>
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

@include('bpjs.monitoring.histori-pelayanan-peserta.components.modal-detail-kunjungan')

@endsection

@section('js')


<script type="text/javascript">

    var init_data = 1;
    var datatable;
    var current_data = [];
    var pasien_nama;

    function getUrl()
    {
        var tanggal_start = $('.filter-date-start').val();
        var tanggal_end = $('.filter-date-end').val();
        var no_bpjs = $('.filter-no-bpjs').val();

        url = "{{url('')}}/api/bpjs/monitoring/histori-pelayanan-peserta/get-data?tanggal_start="+tanggal_start+"&tanggal_end="+tanggal_end+"&no_bpjs="+no_bpjs;

        return url;

    }

    function getData()
    {
        $('.text-pasien').html('');
        pasien_nama = '';
        url = getUrl();
        $.ajax({
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            success: function(data){
                var data_kunjungan = [];
                current_data = data;
                $.each(data, function( index, item ) {
                    pasien_nama = item.namaPeserta;

                    var buttonDetail = `<button class="btn btn-primary btn-detail-kunjungan" data-index="`+index+`"><i class="fa fa-search-plus"></i> Detail</button>`

                    if(item.jnsPelayanan == 2) jenisPelayanan = 'Rawat Jalan';
                    else jenisPelayanan = 'Rawat Inap';

                    temp_array = [];
                    temp_array.push(item.noSep);
                    temp_array.push(item.tglSep);
                    temp_array.push(jenisPelayanan);
                    temp_array.push(item.kelasRawat);
                    temp_array.push(item.poli);
                    temp_array.push(item.ppkPelayanan);
                    temp_array.push(buttonDetail);
                    data_kunjungan.push(temp_array);

                    $('.text-pasien').html(pasien_nama);
                });

                if(init_data == 1) {
                    loadDataTable(data_kunjungan)
                    init_data = 0;
                }
                else updateDataTable(data_kunjungan)
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
                { title: "Tanggal SEP" },
                { title: "Jenis Pelayanan",className: "text-center" },
                { title: "Kelas" , className: "text-center"},
                { title: "Poli", className: "text-left"},
                { title: "PPK", className: "text-left"},
                { title: "Detail", className: "text-center"}
            ]

        });
    }
    $('#buttonRefresh').click(function(){
        getData();
    })

    $(document).on('click', '.btn-detail-kunjungan', function(){ 
        var id = $(this).data('index');
        var content = current_data[id];
        content = jsonFormatHtml(content)

        $('#modal-detail-kunjungan .block-content table tbody').html(content);
        $('#modal-detail-kunjungan').modal('show');
    });
</script>
@include('assets.js.json-formatter')
@endsection