@extends('warehouse.layouts.main')

@section('title')
Gudang Supplier
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
        <div class="block-content block-content-full">
            <div class="block">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="searchSupp" placeholder="Cari berdasarkan nama, alamat, atau perwakilan supplier">
                </div>
            </div>
            
            <table class="table table-hover" id="supplier">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class="d-none d-sm-table-cell">Nama Perusahaan</th>
                        <th class="d-none d-sm-table-cell">Perwakilan</th>
                        <th class="d-none d-sm-table-cell">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1 @endphp
                    @foreach($supplier as $row)
                    <tr data-href="{{url('gudang/supplier/'.$row->slug)}}">
                        <td>{{$i++}}</td>
                        <td>
                            <p class="font-w600 mb-0">{{$row->nama}}</p>
                            <p class="text-muted mb-0">{{$row->alamat}}</p>
                            <p class="text-muted mb-0">{{$row->telepon}}</p>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <p class="text-muted mb-0">{{$row->agen}}</p>
                            <p class="text-muted mb-0">{{(!is_null($row->telepon_agen)) ? $row->telepon_agen : "-"}}</p>
                        </td>
                        <td>
                            <a href="{{url('gudang/supplier/'.$row->slug)}}" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal" id="modal-large" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" enctype="multipart/form-data" action="{{url('gudang/supplier')}}/new">
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
                                        <input type="text" class="form-control" name="nama" placeholder="Nama Perusahaan" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Alamat Perusahaan</label>
                                        <input type="text" class="form-control" name="alamat" placeholder="Alamat Perusahaan">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nomor Telepon</label>
                                        <input type="number" class="form-control" name="telepon" placeholder="Nomor Telepon">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nomor NPWP</label>
                                        <input type="number" class="form-control" name="npwp" placeholder="Nomor NPWP">
                                    </div>
                                </div>
                                <div class="col">
                                	<div class="form-group">
                                        <label class="control-label">Nama Perwakilan</label>
                                        <input type="text" class="form-control" name="nama_perwakilan" placeholder="Nama Perwakilan">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nomor Telepon Perwakilan</label>
                                        <input type="number" class="form-control" name="telepon_perwakilan" placeholder="Nomor Telepon Perwakilan">
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan <small>(Opsional)</small></label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Berikan Informasi Lebih">
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
		.clickable-row {
	        cursor: pointer;
	    }
	    .modal-content {
	        border-radius: 0;
	    }
        table.dataTable {
            border-collapse: collapse !important;
        }
	</style>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script type="text/javascript">
        var table = $('#supplier').DataTable({
            searching: true,
            ordering: false,
            pageLength: 20,
            lengthChange: false,
            drawCallback: function() {
                $('#supplier_filter').addClass('d-none');
            }
        });

        $('#searchSupp').keyup(function() {
            $('div.dataTables_wrapper div.dataTables_filter input').val($(this).val()).trigger('keyup');
        });
    </script>
@endsection