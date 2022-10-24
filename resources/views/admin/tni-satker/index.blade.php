@extends('layouts.main-dashboard')

@section('title')
Admin - Daftar Satker TNI
@endsection

@section('css')

<style type="text/css">
.paginate_button {
  color: white;
  text-align: center;
  display: inline-block;
  background-color: #42A5F5;
  padding: 8px 10px;
  cursor: pointer;
  font-size: 13px;
  border: 1px solid white;
  width: 70px;
}

.paginate_button:hover {
    background-color: #4298f5;
}

.paginate_button:active {
    background-color: #42A5F5;
}

.paginate_page {
  text-align: center;
  display: inline-block;
  margin-left: 7px;
  margin-right: 3px;
}
.paginate_of {
  text-align: center;
  display: inline-block;
  margin-right: 7px;
  margin-left: 3px;
}
.paginate_input{
  color: green;  
}
</style>
@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<div class="content" style="margin-top:50px;">
    <div class="block p-10">
        <div class="block-header">
            <h3 class="block-title">
                <small><a href="{{url('admin/tni-satker/baru')}}" class="pull-right">
                <i class="fa fa-plus-circle"></i> Input Satker TNI Baru</a></small> 
                Daftar Satker TNI
            </h3>
        </div>
        <div class="block-content">
            <form method="GET">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <select class="js-select2 form-control" name="kotama">
                                <option value="0">Semua</option>
                                @foreach($kotama as $item)
                                <option value="{{$item->id}}" @if($item->id == $kotama_id) selected @endif>{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <button class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
            <table class="table table-bordered table-striped table-vcenter" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kotama</th>
                        <th>Kode</th>
                        <th>Print</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div id="deletemodal" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Data</h4>
            </div>
            <div class="modal-body">
                <p id="show-name"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a id="del-btn">
                    <button type="button" class="btn btn-danger pull-right" style="margin-left: 4px ;">Hapus</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')


<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.pagination-input.js')}}"></script>
<script type="text/javascript">
var table = $('#example').DataTable({
        "pagingType": "input",
        "ordering": true,
        pageLength: 8,
        lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
            type: "GET",
            dataType: "json",
            @if(!empty($kotama_id))
            data: {
                "kotama_id": {{$kotama_id}}
            },
            @endif
            url: "{{url('/admin/tni-satker/data')}}",
        },
       columns: [
            {
                data: 'no',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            {
                data: 'nama',
            },
            {
                data: 'kotama',
            },
            {
                data: 'kode',
            },
            {
                data: 'print',
                render: function(data,type,row,meta){
                    if(row.print == 1)
                    {
                        return `<label class="css-control css-control-lg css-control-primary css-checkbox" style="display: inline !important;">
                                    <input type="checkbox" class="form-control checkbox css-control-input check-print" checked value="1" data-id="${row.id}">
                                    <span class="css-control-indicator"></span>
                                </label>
                        `;
                    }
                    else
                    {
                        return `<label class="css-control css-control-lg css-control-primary css-checkbox" style="display: inline !important;">
                                    <input type="checkbox" class="form-control checkbox css-control-input check-print" value="0" data-id="${row.id}">
                                    <span class="css-control-indicator"></span>
                                </label>
                        `;
                    }
                }
            },
            {
                data: 'aksi',
                render: function (data, type, row, meta) {
                    return `
                        <a href="{{url('/admin/tni-satker/edit/')}}/${row.id}" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="#deletemodal" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5" data-toggle="modal" data-id="${row.id}" data-nama="${row.nama}">
                            <i class="fa fa-trash"></i>
                        </a>
                    `;
                }
            },
        ],
        order: [[ 0, "asc" ]],
    });
    
    

    $.fn.dataTable.ext.errMode = 'none';

    $('#example').on('click','.check-print', function(){
        if($(this).is(':checked'))
        {
            var flag = 1;
            var id = $(this).data('id');
            aktifPrint(id,flag);
        }
        else
        {
            var flag = 0;
            var id = $(this).data('id');
            deaktifPrint(id,flag);   
        }
    });

    function deaktifPrint(id,flag)
    {
        swal({
            title: 'Apakah Anda Yakin?',
            text: "Flag print akan menjadi tidak aktif",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-secondary',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Ya, Non Aktifkan!',
            cancelButtonText: 'Batalkan',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        type: "GET",
                        url: API_URL + "/admin/tni-satker/aktif-print/" + id + "/" + flag,
                        dataType: "json",
                        success: function (data) {
                            table.ajax.reload(null,false);
                            callSwal(data.type,data.title,data.text,0);
                        },
                        error: function () {
                            callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                        }
                    })
                });
            }
        })
    }

    function aktifPrint(id,flag)
    {
        swal({
            title: 'Apakah Anda Yakin?',
            text: "Flag print akan menjadi aktif",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-secondary',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Ya, Aktifkan!',
            cancelButtonText: 'Batalkan',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        type: "GET",
                        url: API_URL + "/admin/tni-satker/aktif-print/" + id + "/" + flag,
                        dataType: "json",
                        success: function (data) {
                            table.ajax.reload(null,false);
                            callSwal(data.type,data.title,data.text,0);
                        },
                        error: function () {
                            callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                        }
                    })
                });
            }
        })
    }

    function deleteModal(id)
    {
        swal({
            title: 'Apakah Anda Yakin?',
            text: "Satker TNI akan dihapus.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-secondary',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batalkan'
        }).then((result) => {
            if (result.value) {
                swal(
                    'Sukses!',
                    'Satker TNI berhasil dihapus.',
                    'success'
                    )
            }
        })

    }
    $(document).on("click",".btn-outline-danger", function () {
        var id = $(this).data('id')
        var nama = $(this).data('nama');
        console.log(id,nama);
        $("#del-btn").attr('href','{{url('admin/tni-satker/delete')}}' + '/' + id)
        $("#show-name").html('Anda yakin ingin menghapus data satker TNI ' + nama + '?')

    })
    $(document).ready(function(){
        console.log(table);
        table.draw();
    });
</script>

@endsection