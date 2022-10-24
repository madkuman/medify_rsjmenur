@extends('aset.layouts.main')


@section('title')
Supplier
@endsection



@section('content')
	<div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Supplier</h3>
            <div class="block-options">
            <button type="submit" class="btn btn-sm btn-primary btn-square" data-toggle="modal" data-target="#modal-large">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Supplier Baru
            </button>
            </div>
        </div>
        <div class="block-content">

            <table class="table table-bordered table-striped table-vcenter dataTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th class="d-none d-sm-table-cell">Nama Perusahaan</th>
                        <th class="d-none d-sm-table-cell">Perwakilan</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal" id="modal-large" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form  id="form_edit" method="post" enctype="multipart/form-data" action="{{route('supplier.store')}}">
                {{csrf_field()}}
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Supplier Baru</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="control-label">Nama Perusahaan</label>
                                        <input type="text" class="form-control" name="name_perusahaan" placeholder="Nama Perusahaan" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nomor Telepon Perusahaan</label>
                                        <input type="text" class="form-control" name="phone_perusahaan" placeholder="Nomor Telepon" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Alamat Perusahaan</label>
                                        <input type="text" class="form-control" name="address_perusahaan" placeholder="Alamat Perusahaan">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nomor NPWP</label>
                                        <input type="text" class="form-control" name="npwp" placeholder="Nomor NPWP">
                                    </div>
                                </div>
                                <div class="col">
                                	<div class="form-group">
                                        <label class="control-label">Nama Perwakilan</label>
                                        <input type="text" class="form-control" name="name_perwakilan" placeholder="Nama Perwakilan" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nomor Telepon Perwakilan</label>
                                        <input type="text" class="form-control" name="phone_perwakilan" placeholder="Nomor Telepon Perwakilan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan <small>(Opsional)</small></label>
                                        <input type="text" class="form-control" id="keterangan" name="description" placeholder="Berikan Informasi Lebih">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary btn-square">
                             <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
	<style type="text/css">
		.badge {
			width: 90px;
		}
		tr {
	        cursor: pointer;
	    }
	    .modal-content {
	        border-radius: 0;
	    }
	</style>
@endsection

@section('js')
    <script>
        var table = $('.dataTable').DataTable({
            ordering: false,
            processing: false,
            serverSide: false,
            bLengthChange: false,
            pageLength: 10,
            responsive: true,
            scrollY: "calc( 100% - 70px )",
            scrollCollapse: true,
            ajax: '{{ route('admin.supplier.json') }}',
            columns: [
                { data: 'id' },
                { data: 'name_perusahaan' },
                { data: 'name_perwakilan' },
            ],
            columnDefs: [{
                orderable: false,
                targets:   1,
                "render": function ( data, type, row, meta ) {
                    if(row.name_perusahaan == null) row.name_perusahaan = '-<br>';
                    if(row.address_perusahaan == null) row.address_perusahaan = '-<br>';
                    if(row.phone_perusahaan == null) row.phone_perusahaan = '-<br>';

                    return '<p class="font-w600 mb-0">'+row.name_perusahaan+'</p>' +
                        '<p class="text-muted mb-0">'+row.address_perusahaan+'</p>' +
                        '<p class="text-muted mb-0">'+row.phone_perusahaan+'</p>';
                }
            },{
                orderable: false,
                targets:   2,
                "render": function ( data, type, row, meta ) {
                    if(row.name_perwakilan == null) row.name_perwakilan = '-<br>';
                    if(row.phone_perwakilan == null) row.phone_perwakilan = '-<br>';

                    return '<p class="text-muted mb-0">'+row.name_perwakilan+'</p>' +
                        '<p class="text-muted mb-0">'+row.phone_perwakilan+'</p>';
                }
            }]
        });

        table.on( 'click', 'tbody td', function () {
            var id = table.row(this).data().id;
            $(location).attr('href', '{{url('aset/supplier')}}/'+id);
        });

        // $('#myInputTextField').keyup(function(){
        //     table.search($(this).val()).draw() ;
        // })
    </script>
@endsection