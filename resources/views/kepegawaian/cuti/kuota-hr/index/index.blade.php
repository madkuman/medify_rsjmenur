@extends('kepegawaian.layouts.main')

@section('title')
Daftar Kuota Cuti
@endsection

@section('subtitle')
Cuti 
@endsection

@section('content')
<div class="container">
    <h3 class="mb-0">Kuota Cuti</h3>
    @include('kepegawaian.cuti.components.navbar-hr')
    <div class="block p-10"  >
        <div class="block-header">
            <h3 class="block-title">
                Daftar Kuota Cuti
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
                            <label>Jenis Cuti </label>
                            <select class="js-select2 form-control filter-jenis">
                                <option value="all">Semua</option>
                                @foreach($master_cuti as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
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
                        <th>Kuota</th>
                        <th>Cuti Terakhir</th>
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

    var filter_pegawai
    var filter_jenis

    initValue();

    function initValue()
    {
        filter_jenis = $('.filter-jenis').val();
        filter_pegawai= $('.filter-pegawai').val();
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
            url: API_URL + '/kepegawaian/cuti/kuota/get-data',
            data: function(d) {
                d.pegawai = filter_pegawai;
                d.jenis = filter_jenis;
            }
        },
        columns: [
        { data: 'id', name: 'id' },
        { data: 'user_nama', name: 'user_nama' },
        { data: 'kuota_cuti', name: 'kuota_cuti' },
        { data: 'cuti_terakhir_at', name: 'cuti_terakhir_at' },
        { data: null, name: 'id',
        render: function (data, type, row, meta) {
            content =`<a class="btn btn-secondary" target="_blank" href="{{url('')}}/kepegawaian/cuti/kuota/`+data.id+`">Lihat Kuota</a></div>`;
            return content;
        }},
        ],
        order: [[ 0, "asc" ]]
    });

    $(".filter-jenis").on('change', function(){
        initValue()
        table.draw(true);
    });
    $(".filter-pegawai").on('change', function(){
        initValue()
        table.draw(true);
    });

</script>

@endsection