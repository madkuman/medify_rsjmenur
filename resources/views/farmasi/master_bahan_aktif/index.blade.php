@extends('farmasi.layouts.main')

@section('title')
Master Bahan Aktif
@endsection

@section('content')
	<div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Master Bahan Aktif</h3>
            <div class="block-options">
            <button type="submit" class="btn btn-sm btn-primary btn-square" data-toggle="modal" data-target="#modal-normal">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Bahan Aktif Baru
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
                    <input type="text" class="form-control" id="searchBahanAktif" placeholder="Cari berdasarkan nama bahan aktif">
                </div>
            </div>
            
            <table class="table table-hover" id="bahan_aktif">
                <thead>
                    <tr>
                        <th style="width: 5%">ID</th>
                        <th class="d-none d-sm-table-cell" style="width: 50%">Nama Bahan Aktif</th>
                        <th class="d-none d-sm-table-cell" style="width: 20%">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1 @endphp
                    @foreach($master_bahan_aktif as $row)
                    <tr data-href="{{url('farmasi/'.session('farmasi')->slug.'/master-bahan-aktif/'.$row->id)}}">
                        <td>{{$i++}}</td>
                        <td>
                            <p class="font-w600 mb-0">{{$row->nama}}</p>
                        </td>
                        <td>
                            <a href="{{url('farmasi/'.session('farmasi')->slug.'/master-bahan-aktif/'.$row->id)}}" class="btn btn-sm btn-primary mr-5 mb-5"><i class="fa fa-search-plus"></i> Lihat</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    @include('farmasi.katalog.modals.modal-add')
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
        var table = $('#bahan_aktif').DataTable({
            searching: true,
            ordering: true,
            pageLength: 10,
            lengthChange: false,
            drawCallback: function() {
                $('#bahan_aktif_filter').addClass('d-none');
            }
        });

        $('#searchBahanAktif').keyup(function() {
            $('div.dataTables_wrapper div.dataTables_filter input').val($(this).val()).trigger('keyup');
        });
    </script>
@endsection