@extends('aset.layouts.main')


@section('title')
{{$supplier->name_perusahaan}} - Supplier
@endsection


@section('content')
	<div class="block">
        <div class="block-header bordered">
            <h3 class="block-title">
            	<small>SUPPLIER</small> <br>
                {{$supplier->name_perusahaan}}
            </h3>
            <div class="block-options">
	            <button class="btn btn-alt-danger btn-square" data-toggle="modal" data-target="#modal-delete">
	                <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
	            </button>
	            <button class="btn btn-alt-primary btn-square" data-toggle="modal" data-target="#modal-edit">
	                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
	            </button>
            </div>
            <hr class="my-5">
        </div>
        <div class="block-content">
            <div class="">
                <div class="row">
                	<div class="col">
                        <label>ALAMAT PERUSAHAAN</label>
                		<p>{{$supplier->address_perusahaan}}</p>
                        <label>NOMOR TELEPON PERUSAHAAN</label>
                        <p>{{$supplier->phone_perusahaan}}</p>
                        <label>NOMOR NPWP PERUSAHAAN</label>
                        <p>{{$supplier->npwp}}</p>
                	</div>
                	<div class="col">
                        <label>PERWAKILAN</label>
                		<p>{{$supplier->name_perwakilan}}</p>
                        <label>NOMOR TELEPON PERWAKILAN</label>
                        <p>{{$supplier->phone_perwakilan}}</p>
                        <label>KETERANGAN</label>
                        <p>{{$supplier->description}}</p>
                	</div>
                </div>
            </div>
        </div>
    </div>

    <div class="block">
        <div class="block-header">
            <h3 class="block-title">History Transaksi</h3>
        </div>
        <div class="block-content">
            <table class="table table-bordered table-striped table-vcenter dataTable">
                <thead>
                    <tr>
                        <th class="w-1">Kode</th>
                        <th>Date</th>
                        <th>Total Transaction</th>
                        <th>Description</th>
                        <th>User</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form  method="post" accept-charset="UTF-8" enctype="multipart/form-data" action="{{route('supplier.update',$supplier->id)}}">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Edit Supplier</h3>
                        </div>
                        <div class="block-content">
                            {{csrf_field()}}
                            {!! method_field('patch') !!}
                            <div class="col">
                                <div class="form-group">
                                    <label class="control-label">Nama Perusahaan</label>
                                    <input value="{{$supplier->name_perusahaan}}" type="text" class="form-control" name="name_perusahaan" placeholder="Nama Perusahaan" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Nomor Telepon Perusahaan</label>
                                    <input value="{{$supplier->phone_perusahaan}}" type="text" class="form-control" name="phone_perusahaan" placeholder="Nomor Telepon" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Alamat Perusahaan</label>
                                    <input value="{{$supplier->address_perusahaan}}" type="text" class="form-control" name="address_perusahaan" placeholder="Alamat Perusahaan">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Nomor NPWP</label>
                                    <input value="{{$supplier->npwp}}" type="text" class="form-control" name="npwp" placeholder="Nomor NPWP">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="control-label">Nama Perwakilan</label>
                                    <input value="{{$supplier->name_perwakilan}}" type="text" class="form-control" name="name_perwakilan" placeholder="Nama Perwakilan" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Nomor Telepon Perwakilan</label>
                                    <input value="{{$supplier->phone_perwakilan}}" type="text" class="form-control" name="phone_perwakilan" placeholder="Nomor Telepon Perwakilan" required>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan <small>(Opsional)</small></label>
                                    <input value="{{$supplier->description}}" type="text" class="form-control" id="keterangan" name="description" placeholder="Berikan Informasi Lebih">
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

    <div class="modal" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form  method="post" accept-charset="UTF-8" enctype="multipart/form-data" action="{{route('supplier.update',$supplier->id)}}">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Hapus Supplier</h3>
                        </div>
                        <div class="block-content">
                            <p>Apakah Anda benar ingin menghapus item ini?</p>
                            <form  method="post" action="{{route('supplier.destroy',$supplier->id)}}">
                                {{csrf_field()}}
                                {!! method_field('delete') !!}
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                                    <button type="submit" class="btn btn-danger btn-square">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('css')
	<style type="text/css">
        tr {
            cursor: pointer;
        }
		.bordered {
			border-bottom: 1px solid #eaecee;
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
        ajax: '{{ route('admin.supplier.history.json',$supplier->id) }}',
        columns: [
            { data: 'kode'},
            { data: 'date'},
            { data: 'total_price'},
            { data: 'description'},
            { data: 'description'},
        ],
        columnDefs: [{
            targets:   1,
            "render": function ( data, type, row, meta ) {
                return date_manusia(data);
            }
        },{
            targets:   2,
            "render": function ( data, type, row, meta ) {
                return convert_rupiah(data);
            }
        },{
            targets:   4,
            "render": function ( data, type, row, meta ) {
                return row.user.name;
                }
        },


        ],
    });

    table.on( 'click', 'tbody td', function () {
        var kode = table.row(this).data().kode;
        $(location).attr('href', '{{url('aset/transaction')}}/'+kode);
    });

    // $('#myInputTextField').keyup(function(){
    //     table.search($(this).val()).draw() ;
    // })
</script>
@endsection