@extends('farmasi.layouts.main')

@section('title')
Kategori Barang
@endsection

@section('content')
	<div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Kategori</h3>
            <div class="block-options">
            <button type="submit" class="btn btn-sm btn-primary btn-square" data-toggle="modal" data-target="#modal-normal">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Kategori Baru
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
                    <input type="text" class="form-control" id="searchSupp" placeholder="Cari berdasarkan nama kategori">
                </div>
            </div>
            
            <table class="table table-hover" id="supplier">
                <thead>
                    <tr>
                        <th style="width: 5%">ID</th>
                        <th class="d-none d-sm-table-cell" style="width: 50%">Nama Kategori</th>
                        <th class="d-none d-sm-table-cell" style="width: 25%">Keterangan</th>
                        <th class="d-none d-sm-table-cell" style="width: 20%">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1 @endphp
                    @foreach($kategori as $row)
                    <tr data-href="{{url('farmasi/kategori/'.$row->slug)}}">
                        <td>{{$i++}}</td>
                        <td>
                            <p class="font-w600 mb-0">{{$row->nama}}</p>
                        </td>
                        <td>
                            @if($row->is_kandungan)
                            <span class="badge badge-primary" style="width: auto">Kandungan Obat</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('farmasi/'.session('farmasi')->slug.'/kategori/'.$row->slug)}}" class="btn btn-sm btn-primary mr-5 mb-5"><i class="fa fa-search-plus"></i> Lihat</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    @include('farmasi.kategori.modals.modal-add')
@endsection

@section('css')
    
	<style type="text/css">
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



    <script type="text/javascript">
        var table = $('#supplier').DataTable({
            searching: true,
            ordering: true,
            pageLength: 5,
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