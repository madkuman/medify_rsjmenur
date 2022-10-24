@extends('layouts.main-dashboard')

@section('title')
    Admin - Pendaftaran Online - Tarif Kembali
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')

    @include('admin.layouts.components.sidebar')
    @include('layouts.components2.navbar-dashboard')

    <div class="content" style="margin-top:50px;">
        <div class="block p-10">
            <div class="block-header">
                <h3 class="block-title">
                    Daftar Tarif Kembali
                    <small>
                        <button class="btn btn-sm btn-outline-primary pull-right" type="button" data-toggle="modal"
                                data-target="#add-modal"><i class="fa fa-plus"></i> Tambah Data
                        </button>
                    </small>
                </h3>
            </div>
            <div class="block-content">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full"
                       id="tarif-kembali-table">
                    <thead>
                    <tr class="text-center">
                        <th width="10%">No</th>
                        <th width="70%">Tarif</th>
                        <th width="20%">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($master_tarif_kembali as $index => $row)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$row->tarif_master->deskripsi}}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-delete" onclick="deleteTarifKembali({{$row->id}})" data-toggle="tooltip" title="Hapus" data-original-title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-modal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
        <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="form-tarif-kembali" action="{{url()->current()}}/add" method="post">
                    {{csrf_field()}}
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title" id="title-modal"></h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>

                        <div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                            <div class="row">
                                <div class="col-12">
                                    <label>Tarif</label>
                                    <select class="js-select2 form-control" name="tarif_master_id"
                                            style="width: 100%;" data-placeholder="Pilih Tarif">
                                        @foreach($tarif_master as $item)
                                            <option value="{{$item->id}}">{{$item->deskripsi}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel
                            </button>
                            <button class="btn btn-primary btn-submit btn-click-animate" type="submit" id="btnSubmit">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script type="text/javascript">
        jQuery('.js-dataTable-full').dataTable({
            "ordering": true,
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            autoWidth: false
        });
        function deleteTarifKembali(id) {
            swal({
                title: 'Apakah Anda Yakin?',
                text: "Menghapus Tarif Kembali",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-secondary',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batalkan',
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve) {
                        $.ajax({
                            type: "GET",
                            url: "{{ url()->current() }}/hapus/" + id,
                            dataType: "json",
                            success: function (data) {
                                callSwal('success', 'Berhasil!', 'Data Berhasil Dihapus', "");
                                location.reload()
                            },
                            error: function () {
                                callSwal('error', 'Penghapusan Gagal', 'Silahkan Coba Lagi', 0);
                            }
                        })
                    });
                }
            })

        }
    </script>
@endsection