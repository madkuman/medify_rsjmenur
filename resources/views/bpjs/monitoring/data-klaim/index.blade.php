@extends('bpjs.layouts.main')

@section('title')
Data Klaim - Monitoring
@endsection

@section('subtitle')
Monitoring / Data Klaim
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
                        <h4 class="mb-0">Monitoring Data Klaim</h4>
                    </div>
                    <div class="block-content py-20">
                        <div class="row">
                            <div class="col-2">
                                <label>Pelayanan</label>
                                <select class="form-control filter-jenis-pelayanan" style="width: 100%;">
                                    <option value="1">Rawat Inap</option>
                                    <option value="2">Rawat Jalan</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <label>Status File</label>
                                <select class="form-control filter-status" style="width: 100%;">
                                    <option value="1">Proses Verifikasi</option>
                                    <option value="2">Pending Verifikasi</option>
                                    <option value="3" selected>Klaim</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="example-datepicker1">Tanggal</label>
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
                                        <th class="text-center" style="width:5%;">Kelas Rawat</th>
                                        <th class="text-center" style="width:15%;">Poli</th>
                                        <th class="text-center" style="width:10%;">Tanggal SEP</th>
                                        <th class="text-right" style="width:15%;">Biaya Pengajuan</th>
                                        <th class="text-right" style="width:15%;">Biaya Disetujui</th>
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

@include('bpjs.monitoring.data-klaim.components.modal-detail-klaim')

@endsection

@section('js')


<script type="text/javascript">

    var init_data = 1;
    var datatable;
    var current_data = [];
    var jsonFormatterNumberParse = ['byPengajuan','bySetujui','byTarifGruper','byTarifRS','byTopup']

    $( document ).ready(function() {
        getData();
    });

    function getUrl()
    {
        var tanggal = $('.filter-tanggal').val();
        var pelayanan = $('.filter-jenis-pelayanan').val();
        var status = $('.filter-status').val();
        url = "{{url('')}}/api/bpjs/monitoring/data-klaim/get-data?tanggal="+tanggal+"&pelayanan="+pelayanan+"&status="+status

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

                    var byPengajuan = "Rp" + numeral(item.biaya.byPengajuan).format('0,0')
                    var bySetujui = "Rp" + numeral(item.biaya.bySetujui).format('0,0')
                    var buttonDetail = `<button class="btn btn-primary btn-detail-klaim" data-index="`+index+`"><i class="fa fa-search-plus"></i> Detail</button>`

                    temp_array = [];
                    temp_array.push(item.noSEP);
                    temp_array.push(item.peserta.nama);
                    temp_array.push(item.kelasRawat);
                    temp_array.push(item.poli);
                    temp_array.push(item.tglSep);
                    temp_array.push(byPengajuan);
                    temp_array.push(bySetujui);
                    temp_array.push(buttonDetail);
                    data_klaim.push(temp_array);
                });

                if(init_data == 1) {
                    loadDataTable(data_klaim)
                    init_data = 0;
                }
                else updateDataTable(data_klaim)
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
                { title: "Poli" },
                { title: "Tanggal" },
                { title: "Pengajuan", className: "text-right"},
                { title: "Disetujui", className: "text-right"},
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