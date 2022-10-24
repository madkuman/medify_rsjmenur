@extends('keuangan.layouts.main')

@section('title')
Akun - Keuangan
@endsection


@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
</style>
@endsection
@section('content')
@include('keuangan.akun.components.header')

<div class="row">
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-header py-20">
                <span><h4 class="mb-0">Daftar Akun</h4><hr>
                <h5></h5></span>
                <div class="block-options">
                    <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-hero" data-toggle="modal" data-target="#add-account">
                        <i class="fa fa-plus"></i> Buat Akun
                    </a>
                </div>
            </div>
            <div class="block-content py-20">
                <table class="table table-striped table-hover table-vcenter" id="account-table">
                    <thead>
                        <tr>
                            <th class="d-none d-sm-table-cell">#</th>
                            <th class="d-none d-sm-table-cell">Nama</th>
                            <th class="d-none d-sm-table-cell">No. Rekening </th>
                            <th class="d-none d-sm-table-cell">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($accounts as $key => $value)
                        <tr>
                            <td class="d-none d-sm-table-cell">{{$key+1}}</td>
                            <td class="d-none d-sm-table-cell">{{$value->nama}}</td>
                            <td class="d-none d-sm-table-cell">{{$value->no_rekening}}</td>
                            <td class="d-none d-sm-table-cell">
                                <span data-toggle="modal" data-target="#edit-account{{$value->id}}">
                                    <a class="btn btn-outline-primary btn-sm btn-circle mr-5 mb-5" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </span>
                                <button type="button" id="button-decline-{{$value->id}}" class="btn btn-sm btn-circle btn-alt-danger mr-5 mb-5" onclick="deleteAccount({{$value->id}})" data-toggle="tooltip" data-placement="top" title="Hapus">
                                    <i class="fa fa-times"></i>
                                </button>
                                @include('keuangan.akun.components.edit-account')
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <h5 class="font-w400 text-center">Belum ada entry</h5>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('keuangan.akun.components.add-account')

<form method="POST" action="{{url()->current()}}/delete" id="formDelete">
    {{csrf_field()}}
    <input type="hidden" id="inputDeleteAccountID" name="id">
    <input type="hidden" name="delete" value="1">
</form>

@endsection

@section('js')

<script type="text/javascript">
    $(document).ready(function(){
        $('#account-table').DataTable({
            "pagingType": "full_numbers"
        });
    });
</script>
<script type="text/javascript">
    function deleteAccount(id)
    {
        swal({
            title: 'Hapus Akun?',
            text: "Anda akan menghapus akun ini. Apakah anda yakin?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            confirmButtonClass: 'btn btn-primary ml-10',
            cancelButtonClass: 'btn btn-outline-danger ',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#inputDeleteAccountID').val(id);
                $('#formDelete').submit();
            }
        })
    }
</script>

@endsection