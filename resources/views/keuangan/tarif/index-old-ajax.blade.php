@extends('keuangan.layouts.main')

@section('title')
Daftar Tarif - Keuangan
@endsection

@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
</style>
@endsection
@section('content')
@include('keuangan.tarif.components.header')

<div class="row">
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-header py-20">
                <span><h4 class="mb-0">Daftar Tarif</h4><hr>
                <h5></h5></span>
                <div class="block-options">
                    <a href="{{url()->current()}}/baru" class="btn btn-sm btn-primary btn-hero">
                        <i class="fa fa-plus"></i> Buat Tarif
                    </a>
                </div>
            </div>
            <div class="col-6">
                <span style="display:inline-block"> 
                <label>Departemen </label>
                <select class="js-select2 form-control" id="departemen" name="departemen" style="width: 100%;">
                    <option value="none" selected>All Departemen</option>
                    @foreach($departemen as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                </span>
                <span style="display:inline-block">
                <button id="buttonRefresh" style="margin-bottom: 5px" url="" class="btn btn-md btn-alt-primary" data-toggle="tooltip" title="Refresh Tarif">
                    <i class="fa fa-refresh"></i>
                </button>
                </span>
            </div>
            <div class="col-6">
                <label>Search: </label>
                <input type="text" name="keyword" id="keyword" class="form-control">
            </div>
            <div class="block-content py-20">
                <table class="table table-striped table-hover table-vcenter transaksiTable" id="transaksiTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;">#  </th>
                            <!-- <th class="text-center" style="width: 200px;">Tanggal  </th> -->
                            <th class="text-center" style="width: 200px;">Departemen  </th>
                            <th class="text-center" style="width: 200px;">Kategori Tarif  </th>
                            <!-- <th class="text-center" style="width: 100px;">Kode Tarif  </th> -->
                            <th class="text-center" style="width: 200px;">Deskripsi  </th>
                            <th class="text-center" style="width: 20%;">Aksi      </th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{asset('assets/js/jquery1.10.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/dataTables1.10.bootstrap4.min.js')}}"></script>
<script type="text/javascript"> 
    $("#departemen").select2();
    $(document).on('click', '.remove', function(){
        var id = $(this).data("pk")			
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        type: "POST",
                        url: API_URL + "/keuangan/tarif/delete",
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id : id
                        },
                        success: function (data) {
                            table.destroy();
                            dept = $("#departemen").val();
                            callSwal(data.type,data.title,data.text,0);
                            draw(dept);
                        },
                        error: function () {
                            callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                        }
                    })
                });
            }
        })
    });
    var oTable;
        oTable = $("#transaksiTable").DataTable({
            dom: "t p r",
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{route("datatable/getdata")}}',
                // method: 'POST',
                headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function(d) {
                    d.departemen = $("#departemen").val();
                    d.keyword = $("#keyword").val();
                }
            },
            language: {
                processing: '<i class="fa fa-4x fa-asterisk fa-spin text-info"></i>'
            },
            columns: [
            { data: 'id', name: 'id', className: 'text-center' },
            // { data: 'created_at', name: 'created_at', className: "text-center",
            //     render: function ( data ) {
            //     var date = new Date(data);
            //     return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();} },
            { data: 'departemen', name: 'departemen.name', className: 'text-center' },
            { data: 'kategori', name: 'tarif_kategori' },
            // { data: 'kode', name: 'tarif_kode',className: 'text-center' },
            { data: 'deskripsi', name: 'deskripsi' },
            { data: 'id', name: 'id', className: 'text-center', 
                // defaultContent: '<a href="" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Detail Transaksi">&nbsp;<i class="fa fa-search-plus"></i></a>&nbsp;<a href="" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Transaksi">&nbsp;<i class="fa fa-edit"></i></a>&nbsp;<button class="btn btn-sm btn-alt-danger remove" data-pk="" data-toggle="tooltip" title="Delete Transaksi">&nbsp;<i class="fa fa-trash"></i></button>',
                render: function(data, type, row, meta){
                    data = '<a href="{{url()->current()}}/'+data+'" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Detail Transaksi">&nbsp;<i class="fa fa-search-plus"></i></a>&nbsp;<a href="{{url()->current()}}/edit/'+data+'" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Transaksi">&nbsp;<i class="fa fa-edit"></i></a>&nbsp;<button class="btn btn-sm btn-alt-danger remove" id="remove" data-pk="'+data+'" data-toggle="tooltip" title="Delete Transaksi">&nbsp;<i class="fa fa-trash"></i></button>';
                    
                    return data;
                },
                searchable: false,
                sortable: false}
            ]
        });
        // $('#searchBtn').on('click', function(e) {
        //     oTable.draw();
        //     e.preventDefault();
        // });
        // $("#resetForm").on('click', (e)=> {
        //     document.getElementById('searchForm').reset();
        //     oTable.draw();
        // })
   //  function draw(dept){
   //      table = $('#transaksiTable').DataTable({
   //      processing: true,
   //      serverSide: true,
   //      ajax: {
   //          type: "POST",
   //          dataType: "json",
			// headers: {
			// 	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			// },
   //          url: '{{ route('datatable/getdata') }}',
   //          data: {
   //              departemen: dept
   //          },
   //      },
   //      columns: [
   //          { data: 'id', name: 'id', className: 'text-center' },
   //          { data: 'created_at', name: 'created_at', className: "text-center",
   //              render: function ( data ) {
   //              var date = new Date(data);
   //              return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();} },
   //          { data: 'departemen', name: 'departemen.name', className: 'text-center' },
   //          { data: 'kategori', name: 'tarif_kategori.name' },
   //          { data: 'kode', name: 'tarif_kode.name',className: 'text-center' },
   //          { data: 'deskripsi', name: 'deskripsi' },
   //          { data: 'id', name: 'id', className: 'text-center', 
   //              // defaultContent: '<a href="" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Detail Transaksi">&nbsp;<i class="fa fa-search-plus"></i></a>&nbsp;<a href="" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Transaksi">&nbsp;<i class="fa fa-edit"></i></a>&nbsp;<button class="btn btn-sm btn-alt-danger remove" data-pk="" data-toggle="tooltip" title="Delete Transaksi">&nbsp;<i class="fa fa-trash"></i></button>',
   //              render: function(data, type, row, meta){
   //                  data = '<a href="{{url()->current()}}/'+data+'" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Detail Transaksi">&nbsp;<i class="fa fa-search-plus"></i></a>&nbsp;<a href="{{url()->current()}}/edit/'+data+'" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Transaksi">&nbsp;<i class="fa fa-edit"></i></a>&nbsp;<button class="btn btn-sm btn-alt-danger remove" id="remove" data-pk="'+data+'" data-toggle="tooltip" title="Delete Transaksi">&nbsp;<i class="fa fa-trash"></i></button>';
                    
   //                  return data;
   //              },
   //              searchable: false,
   //              sortable: false}
   //          ]
   //      });
   //  }
    $('#buttonRefresh').click(function() {   
        // table.destroy();
        dept = $("#departemen").val();
        oTable.draw();
    });
   //  $(document).ready(function() {
   //      var dept = $("#departemen").val();
   //      draw(dept);
   //  }); 
</script>
@endsection