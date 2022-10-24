@extends('bpjs.layouts.main')

@section('title')
Kunjungan - Monitoring
@endsection

@section('subtitle')
Monitoring / Kunjungan
@endsection

@section('css')

@endsection
@section('content')
<main id="main-container">
    @include('bpjs.layouts.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded" id="main-block">
                    <div class="block-header py-20">
                        <h4 class="mb-0">Monitoring Kunjungan</h4>
                        <a class="btn-alt btn-primary float-right" href="{{url('bpjs/monitoring/histori-pelayanan-peserta')}}"><i class="fa fa-search"></i> Cari Histori Peserta</a>
                    </div>
                    <div class="block-content py-20">
                        <div class="row">
                            <div class="col-2">
                                <label>Pelayanan</label>
                                <select class="form-control filter-jenis-pelayanan" style="width: 100%;">
                                    <option value="1">Rawat Inap</option>
                                    <option value="2" selected="">Rawat Jalan</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="text" class="js-datepicker form-control filter-tanggal"  data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal" value="{{$today}}" autocomplete="off">
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
                                        <th class="text-left">Nama</th>
                                        <th class="text-center" style="width:5%;">Kelas</th>
                                        <th class="text-center" style="width:25%;">Poli</th>
                                        <th class="text-center" style="width:10%;">Tanggal SEP</th>
                                        <th class="text-right" style="width:15%;">Detail</th>

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

@include('bpjs.monitoring.kunjungan.components.modal-detail-kunjungan')

@endsection

@section('js')


<script type="text/javascript">

    var init_data = 1;
    var datatable;
    var current_data = [];
    var poliklinik_data = JSON.parse('{!! $poliklinik_bpjs !!}');

    $( document ).ready(function() {
        getData();
    });

    function getUrl()
    {
        var tanggal = $('.filter-tanggal').val();
        var pelayanan = $('.filter-jenis-pelayanan').val();
        url = "{{url('')}}/api/bpjs/monitoring/kunjungan/get-data?tanggal="+tanggal+"&pelayanan="+pelayanan

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
                var data_kunjungan = [];
                current_data = data;
                $.each(data, function( index, item ) {

                    var buttonDetail = `<button class="btn btn-primary btn-detail-kunjungan" data-index="`+index+`"><i class="fa fa-search-plus"></i> Detail</button>`

                    var poli = '';

                    if(item.poli != null){
                        if(isNaN(item.poli)){
                            var poli_text = item.poli;
                            poli_text.toString(poli_text)
                        }
                        else
                        {
                            var poli_text = item.poli;
                            poli_text = Number(poli_text)
                        }
                        poli = poliklinik_data[poli_text];
                    }
                    item.poli = poli;
                    temp_array = [];
                    temp_array.push(item.noSep);
                    temp_array.push(item.nama);
                    temp_array.push(item.kelasRawat);
                    temp_array.push(poli);
                    temp_array.push(item.tglSep);
                    temp_array.push(buttonDetail);
                    data_kunjungan.push(temp_array);
                });

                if(init_data == 1) {
                    loadDataTable(data_kunjungan)
                    init_data = 0;
                }
                else updateDataTable(data_kunjungan)
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
                { title: "Kelas",className: "text-center" },
                { title: "Poli",className: "text-left"  },
                { title: "Tanggal",className: "text-center"  },
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