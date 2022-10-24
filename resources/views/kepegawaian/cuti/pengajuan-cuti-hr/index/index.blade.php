@extends('kepegawaian.layouts.main')

@section('title')
Daftar Pengajuan Cuti
@endsection

@section('subtitle')
Cuti 
@endsection

@section('content')
<div class="container">
    <h3 class="mb-0">Pengajuan Cuti</h3>
    @include('kepegawaian.cuti.components.navbar-hr')
    <div class="block p-10"  >
        <div class="block-header">
            <h3 class="block-title">
                Daftar Pengajuan Cuti
            </h3>
        </div>
        <div class="block-content">
            <div class="block">
                <div class="block-content">
                    <div class="row">
                        <div class="col-12">
                            <h6>FILTER</h6>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-lg-3 col-12">
                            <label>Nama Pegawai</label>
                            <select class="js-select2 form-control filter-pegawai">
                                <option value="all">Semua Pegawai</option>
                                @foreach($pegawai as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 col-12">
                            <label>Status Pengajuan</label>
                            <select class="js-select2 form-control filter-status">
                                <option value="all">Semua</option>
                                <option value="0">Belum Response</option>
                                <option value="1">Diterima</option>
                                <option value="-1">Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12">
                            <label>Rentang Waktu Cuti</label>
                            <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                <input type="text" class="form-control" autocomplete="off" id="filter-date-cuti-1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{date('d-m-Y')}}" required="">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text font-w600">to</span>
                                </div>
                                <input type="text" class="form-control" autocomplete="off" id="filter-date-cuti-2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{date('d-m-Y',strtotime('+1 months'))}}" required="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <label>Rentang Waktu Pengajuan</label>
                            <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-end-date="+0d">
                                <input type="text" class="form-control" autocomplete="off" id="filter-date-pengajuan-1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{date('d-m-Y',strtotime('-1 months'))}}" required="">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text font-w600">to</span>
                                </div>
                                <input type="text" class="form-control" autocomplete="off" id="filter-date-pengajuan-2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{date('d-m-Y')}}" required="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="tableCuti">
                <thead>
                    <tr>
                        <th class="">No</th>
                        <th>Nama Pegawai</th>
                        <th>Jenis Cuti</th>
                        <th>Tanggal Cuti</th>
                        <th>Lama Cuti</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status Pengajuan</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript">

    var filter_status_pengajuan
    var filter_cuti_start
    var filter_cuti_end
    var filter_cuti_pengajuan_start
    var filter_cuti_pengajuan_end
    var filter_pegawai

    initValue();

    function initValue()
    {
        filter_status_pengajuan= $('.filter-status').val();
        filter_pegawai= $('.filter-pegawai').val();
        filter_cuti_start = $('#filter-date-cuti-1').val();
        filter_cuti_end = $('#filter-date-cuti-2').val();
        filter_cuti_pengajuan_start = $('#filter-date-pengajuan-1').val();
        filter_cuti_pengajuan_end = $('#filter-date-pengajuan-2').val();
    }

    $(document).ready(function() {
        table.draw();
    });

    var table = $('#tableCuti').DataTable({
        "ordering": true,
        pageLength: 10,
        lengthMenu: [[10, 15, 20], [10, 15, 20]],
        autoWidth: false,
        processing: true,
        serverSide: true,
        bFilter:false,
        language: {
            processing: '<div class="panel panel-default"><i class="fa fa-4x fa-gear fa-spin text-info"></i></div>'
        },
        ajax: {
            type: "GET",
            dataType: "json",
            url: API_URL + '/kepegawaian/cuti/pengajuan/get-data',
            data: function(d) {
                d.pegawai = filter_pegawai;
                d.status_pengajuan = filter_status_pengajuan;
                d.cuti_start = filter_cuti_start;
                d.cuti_end = filter_cuti_end;
                d.cuti_pengajuan_start = filter_cuti_pengajuan_start;
                d.cuti_pengajuan_end = filter_cuti_pengajuan_end;
            }
        },
        columns: [
        { data: 'id', name: 'id', 
        render: function(data, type, row, meta){
            return meta.row + meta.settings._iDisplayStart + 1;}
        },
        { data: 'user_nama', name: 'user_nama' },
        { data: 'jenis_cuti', name: 'jenis_cuti' },
        { data: null, name: 'tanggal_cuti',
        render: function (data, type, row, meta) {
            content =data.date_start + ' - ' + data.date_end;
            return content;
        },
        searchable: false,
        sortable: false
    },
    { data: null, name: 'durasi_cuti',
    render: function (data, type, row, meta) {
        content =data.durasi_cuti + ' Hari';
        return content;
    },
    searchable: false,
    sortable: false
},
{ data: 'tanggal_pengajuan', name: 'tanggal_pengajuan' },

{ data: null, name: 'status_pengajuan_text',
render: function (data, type, row, meta) {
    if(data.status_pengajuan == 1) color_selected = 'success'
        else if(data.status_pengajuan == 0) color_selected = 'info'
            else if(data.status_pengajuan == -1) color_selected = 'danger'

                content = `<span class="badge badge-`+color_selected+`">`+data.status_pengajuan_text+`</span>`;
            return content;
        },
        searchable: false,
        sortable: false
    },
    { data: null, name: 'flag',
    render: function (data, type, row, meta) {
        content =`<a class="btn btn-secondary " href="{{url('')}}/kepegawaian/cuti/pengajuan/form/`+data.id+`">Lihat</a></div>`;
        return content;
    },
    searchable: false,
    sortable: false
},
],
order: [[ 0, "asc" ]]
});

    $(".filter-status").on('change', function(){
        initValue()
        table.draw(true);
    });
    $("#filter-date-cuti-1").on('change', function(){
        initValue()
        table.draw(true);
    });
    $("#filter-date-cuti-2").on('change', function(){
        initValue()
        table.draw(true);
    });
    $("#filter-date-pengajuan-1").on('change', function(){
        initValue()
        table.draw(true);
    });
    $("#filter-date-pengajuan-2").on('change', function(){
        initValue()
        table.draw(true);
    });
    $(".filter-pegawai").on('change', function(){
        initValue()
        table.draw(true);
    });

</script>

@endsection