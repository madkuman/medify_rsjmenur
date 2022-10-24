@extends('farmasi.layouts.main')

@section('title')
Stok Akan Habis - {{session('farmasi')->nama}}
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-checkboxes')}}/dataTables.checkboxes.css">

@endsection

@section('content')
<div class="block" style="min-height: 350px">
    <div class="block-header block-header-default">
        <h3 class="block-title">Stok Akan Habis</h3>
        <button type="button" class="btn btn-success btn-square btn-excel" id="export-excel">
            <i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp;&nbsp;Export
        </button>
        <div class="block-options">
            <button type="button" class="btn btn-primary btn-square" data-toggle="modal" data-target="#modal-permintaan-distribusi">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Permintaan Distribusi
            </button>
        </div>
    </div>
    <div class="block-content">
        <table class="table table-hover table-vcenter js-dataTable-full" style="width: 100%">
            <thead>
                <tr>
                    <th></th>
                    <th>No</th>
                    <th class="d-none d-sm-table-cell">Nama Barang</th>
                    <th class="d-none d-sm-table-cell">Minimal Stock</th>
                    <th class="d-none d-sm-table-cell">Stok</th>
                    <th class="d-none d-sm-table-cell">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->item_template->nama}}</td>
                    <td>{{number_format($item->min_stok,0)}}</td>
                    <td>{{number_format($item->stok,0)}}</td>
                    <td>Rp {{number_format($item->harga,0)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal" id="modal-permintaan-distribusi" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Permintaan Distribusi</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label>Pilih Farmasi</label><br>
                            <select class="js-select2" id="farmasi-select2" style="width: 100%">
                                @foreach($farmasi as $item)
                                @if($item->id != session('farmasi')->id)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endif
                                @endforeach
                            </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                    <button id="request-distribusi" class="btn btn-primary btn-square">
                         <i class="fa fa-save"></i> Lakukan Permintaan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('assets/js/plugins/datatables-checkboxes')}}/dataTables.checkboxes.min.js"></script>
<script type="text/javascript">

    var datatable = jQuery('.js-dataTable-full').DataTable({
        "ordering": true,
        'pageLength': 8,
        'lengthMenu': [[5, 8, 15, 20], [5, 8, 15, 20]],
        'autoWidth': false,
        'columnDefs': [
        {
            'targets': 0,
            'checkboxes': {
                'selectRow': true
            }
        }
        ],
        'select': {
            'style': 'multi'
        },
        'order': [[1, 'asc']]
    });

    $('#request-distribusi').on('click', function(e){
        var rows_selected = datatable.column(0).checkboxes.selected();
        var arrayIds = [];
        $.each(rows_selected, function(index, rowId){
            arrayIds.push(rowId)
        });
        var textIds = arrayIds.join(",")
        var farmasiId = $('#farmasi-select2').val()
        var jenis = 'Permintaan';
        var url = "{{url('farmasi/'.session('farmasi')->slug.'/distribusi')}}?auto-request-items-farmasi="+textIds+"&auto-request-farmasi-id="+farmasiId+"&jenis="+jenis
        window.open(url, '_blank');
    });

    $("#export-excel").click(function () {
        var url = "{{url('farmasi/'.session('farmasi')->slug.'/item/filter/low-stock/export')}}"
        window.open(url, '_blank');
    })
</script>
@endsection