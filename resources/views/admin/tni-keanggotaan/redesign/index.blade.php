@extends('layouts.main-dashboard')

@section('title')
Admin - Daftar Keanggotaan TNI
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
                Daftar Keanggotaan TNI (Redesign)
            </h3>
        </div>
        <div class="block-content">
            <table class="table table-striped table-vcenter" id="example">
                <thead>
                    <tr>
                        <th width="8%" style="text-align: center;">ID</th>
                        <th width="92%">Nama</th>
                    </tr>
                </thead>
            </table>
            @include('admin.tni-keanggotaan.redesign.form')
            @include('admin.tni-keanggotaan.redesign.form')
            @include('admin.tni-keanggotaan.redesign.form')
            @include('admin.tni-keanggotaan.redesign.form')
            @include('admin.tni-keanggotaan.redesign.form')
            <div class="row gutters-tiny" id="container-new-form">

            </div>

            <div class="form-group text-center" style="margin-top: 25px !important;">
                <div class="row">
                    <div class="col-12">
                        <button type="button" class="btn btn-circle btn-outline-primary mr-5 mb-5" id="buttonAdd"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <button class="btn btn-alt btn-primary btn-hero m-0" type="submit" id="button_submit">Simpan</button>
                <button class="btn btn-alt btn-primary btn-hero m-0 disabled" id="button_loading" style="display: none"><i class="fa fa-spinner fa-spin"></i> Loading</button>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js')



<script type="text/javascript">
    $('#buttonAdd').click(function(){
        content = `
        <div class="form-group col-1">
        <input type="text" class="form-control" name="id" disabled="disabled" value="1803">
        </div>
        <div class="form-group col-10" style="margin-bottom: 6px !important;">
        <input type="text" class="form-control" name="nama" value="PURNAWIRAWAN TNI AL">
        </div>
        <div class="col-1 text-center">
        <button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove">
        <i class="fa fa-trash"></i>
        </button>
        </div>
        `

        $('#container-new-form').append(content);
    });

    $.fn.dataTable.ext.errMode = 'none';

    function deleteModal(id)
    {
        swal({
            title: 'Apakah Anda Yakin?',
            text: "Keanggotaan TNI akan dihapus.",
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
                    'Keanggotaan TNI berhasil dihapus.',
                    'success'
                    )
            }
        })

    }
    $(document).on("click",".btn-outline-danger", function () {
        var id = $(this).data('id')
        var nama = $(this).data('nama');
        console.log(id,nama);
        $("#del-btn").attr('href','{{url('admin/tni-keanggotaan/delete')}}' + '/' + id)
        $("#show-name").html('Anda yakin ingin menghapus data keanggotaan TNI ' + nama + '?')

    })
</script>

@endsection