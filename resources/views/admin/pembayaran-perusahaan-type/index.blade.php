@extends('layouts.main-dashboard')

@section('title')
Admin - Daftar Tipe Pembayaran Perusahaan
@endsection

@section('css')

@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<div class="content" style="margin-top:50px;">
    <div class="block p-10">
        <div class="block-header">
            <h3 class="block-title">
                <small><a href="{{url('admin/pembayaran-perusahaan-type/baru')}}" class="pull-right">
                <i class="fa fa-plus-circle"></i> Input Tipe Pembayaran Perusahaan Baru</a></small> 
                Daftar Tipe Pembayaran Perusahaan
            </h3>
        </div>
        <div class="block-content">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
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



<script type="text/javascript">
    $('.js-dataTable-full').dataTable({
        ordering: false,
        pageLength: 8,
        lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: "{{url('/admin/pembayaran-perusahaan-type/data')}}",
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
                data: 'aksi',
                render: function (data, type, row, meta) {
                    content = `
                        <a href="{{url('/admin/pembayaran-perusahaan-type/edit/')}}/${row.id}" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5">
                            <i class="fa fa-edit"></i>
                        </a>
                    `;
                    console.log(row.disable_delete)
                    if(!row.disable_delete){
                    content += `
                        <a href="#deletemodal" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5" data-toggle="modal" data-id="${row.id}" data-nama="${row.nama}">
                            <i class="fa fa-trash"></i>
                        </a>
                    `
                    }
                    return content
                    ;
                }
            },
        ],
    });

    $.fn.dataTable.ext.errMode = 'none';

    function deleteModal(id)
    {
        swal({
            title: 'Apakah Anda Yakin?',
            text: "Tipe pembayaran perusahaan akan dihapus.",
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
                    'Tipe pembayaran perusahaan berhasil dihapus.',
                    'success'
                    )
            }
        })

    }
    $(document).on("click",".btn-outline-danger", function () {
        var id = $(this).data('id')
        var nama = $(this).data('nama');
        console.log(id,nama);
        $("#del-btn").attr('href','{{url('admin/pembayaran-perusahaan-type/delete')}}' + '/' + id)
        $("#show-name").html('Anda yakin ingin menghapus data tipe pembayaran perusahaan ' + nama + '?')

    })
</script>

@endsection