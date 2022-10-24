@extends('farmasi.layouts.main')

@section('title')
Sumber Dana
@endsection

@section('content')
	<div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Sumber Dana</h3>
            <div class="block-options">
            <button type="submit" class="btn btn-sm btn-primary btn-square" data-toggle="modal" data-target="#modal-normal">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Sumber Dana Baru
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
                    <input type="text" class="form-control" id="searchSumberDana" placeholder="Cari berdasarkan nama sumber dana">
                </div>
            </div>
            
            <table class="table table-hover" id="sumber-dana">
                <thead>
                    <tr>
                        <th style="width: 5%">ID</th>
                        <th class="d-none d-sm-table-cell" style="width: 35%">Nama Nama</th>
                        <th class="d-none d-sm-table-cell" style="width: 35%">Kategori</th>
                        <th class="d-none d-sm-table-cell" style="width: 25%">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1 @endphp
                    @foreach($sumber_dana as $row)
                    <tr data-href="{{url('farmasi/'.session('farmasi')->slug.'/sumber-dana/'.$row->id)}}">
                        <td>{{$i++}}</td>
                        <td>
                            <p class="font-w600 mb-0">{{$row->nama}}</p>
                        </td>
                        <td>
                            <p class="font-w600 mb-0">{{$row->kategori->nama}}</p>
                        </td>
                        <td>
                            <a href="{{url('farmasi/'.session('farmasi')->slug.'/sumber-dana/'.$row->id)}}" class="btn btn-sm btn-primary mr-5 mb-5"><i class="fa fa-search-plus"></i> Lihat</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    @include('farmasi.sumber-dana.modals.modal-add')
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
        var table = $('#sumber-dana').DataTable({
            searching: true,
            ordering: true,
            pageLength: 10,
            lengthChange: false,
            drawCallback: function() {
                $('#sumber-dana_filter').addClass('d-none');
            }
        });

        $('#searchSumberDana').keyup(function() {
            $('div.dataTables_wrapper div.dataTables_filter input').val($(this).val()).trigger('keyup');
        });
    </script>
@endsection