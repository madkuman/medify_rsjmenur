@extends('keuangan.layouts.main')


@section('title')
Daftar Kategori - Keuangan
@endsection


@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
</style>
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-header py-20">
                <span><h4 class="mb-0">Daftar Kategori</h4><hr>
                <h5></h5></span>
                <div class="block-options">
                    <a href="{{url()->current()}}/baru" class="btn btn-sm btn-primary btn-hero">
                        <i class="fa fa-plus"></i> Buat Kategori
                    </a>
                </div>
            </div>
            <div class="block-content py-20">
                <table class="table table-striped table-hover table-vcenter js-dataTable-simple transaksiTable" id="transaksiTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;">#  </th>
                            <th class="text-center" style="width: 200px;">Nama Kategori  </th>
                            <th class="text-center" style="width: 200px;">Tipe  </th>
                            <th class="text-center" style="width: 200px;">Sub Kategori Dari  </th>
                            <th class="text-center" style="width: 100px;">Kode Anggaran  </th>
                            <th class="text-center" style="width: 100px;">Total  </th>
                            <th class="text-center" style="width: 100px;">Detail  </th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script type="text/javascript"> 
$("#departemen").select2();
    var table;
    function draw(dept){
        table = $('#transaksiTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: "GET",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: API_URL + "/keuangan/pengaturan/kategori/get",
        },
        columns: [
            { data: 'DT_Row_Index', name: 'DT_Row_Index'},
            { data: 'name', name: 'name'},
            { data: 'type', name: 'type'},
            { data: 'parent_id', name: 'parent_id'},
            { data: 'kode_anggaran', name: 'kode_anggaran'},
            { data: 'total_anggaran', name: 'total_anggaran'},
            { data: 'action', name: 'action'},
            ]
        });
    }
    $('#buttonRefresh').click(function() {   
        table.destroy();
        dept = $("#departemen").val();
        draw(dept);
    });
    $(document).ready(function() {
        var dept = $("#departemen").val();
        draw(dept);
    }); 
</script>

@endsection