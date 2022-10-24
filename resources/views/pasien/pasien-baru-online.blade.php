@extends('pasien.layouts.main')

@section('title')
Pasien - Daftar Pasien Baru Online
@endsection

@section('subtitle')
Daftar Pasien Baru Online
@endsection

@section('css')
<style type="text/css">
.block-content {
    padding-bottom: 18px;
}

</style>
@endsection

@section('content')
<main id="main-container">
    @include('pasien.layouts.navbar')
    <div class="container">
        <div class="row row-deck">
            <div class="col-sm-12">
                <div class="block rounded main-content transaction-index"  ng-controller="PasienController">
                    <div class="block-header">
                        <h3 class="block-title">Daftar Pasien Baru Online</h3>
                    </div>
                    <div class="block-content">
                        <div class="row mb-20">
                            <div class="col-sm-12"> 
                                <form style="margin-top: 10px">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                    <input type="text" class="form-control" id="start_date" name="start_date" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{Carbon\Carbon::now()->format('d/m/Y')}}" autocomplete="off">
                                                    <div class="input-group-prepend input-group-append">
                                                      <span class="input-group-text font-w600">to</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="end_date" name="end_date" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{Carbon\Carbon::now()->format('d/m/Y')}}" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mt-15">
                                          <a href="javascript:void(0)" type="button" class="btn btn-primary btn-block mb-10" id="btn_filter_pasien">Filter</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-pointer table-vcenter" id="data_tabel_daftar_pasien" style="font-family: sans-serif; width: 100%" >
                            <thead>
                                <tr class="header">
                                    <th style="width:8%;">No</th>
                                    <th style="width:20%">Nama Pasien</th>
                                    <th style="width:20%">No Identitas</th>
                                    <th style="width:5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tabel_daftar_pasien">
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection


@section('js')


<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    $('#btn_filter_pasien').click(function(){
        $('#spinner').removeAttr('class');
        $('#data_tabel_daftar_pasien').dataTable().fnDestroy();
        loadData();
    })

    loadData()

    function loadData() {
        table = $('#data_tabel_daftar_pasien').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            processing: true,
            serverSide: true,
            searching: true,
            pagingType: "full_numbers",
            paging: true,
            lengthMenu: [[10, 15, 25, 50], [10, 15, 25, 50]],
            order: [[ 1, 'desc' ]],
            language: {
                    processing: '<div style="position: absolute; left:50%; top:25%"><i class="fa fa-4x fa-spinner fa-spin text-info"></i></div>'
                },
            ajax: {
                url: API_URL + '/pasien/get-pasien-baru-online',
                data: function(d){
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                },
            },
            columnDefs: [
                { width: 50, targets: 0, className: "text-center" },
                { width: 100, targets: 1, className: "text-center" },
                { width: 100, targets: 2, className: "text-center" },
                { width: 50, targets: 3, className: "text-center" }
            ],
            columns: [
                { data: '', sortable: false, searchable: false,
                    render: function(data, type, row, meta) 
                    {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    } 
                },
                { data: 'nama_pasien'},
                { data: 'no_identitas'},
                { data: 'aksi'},
            ],
        });
    }
</script>

@endsection