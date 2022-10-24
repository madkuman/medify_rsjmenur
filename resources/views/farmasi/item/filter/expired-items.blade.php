@extends('farmasi.layouts.main')

@section('title')
Barang Akan Expired - {{session('farmasi')->nama}}
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-checkboxes')}}/dataTables.checkboxes.css">

@endsection

@section('content')
<div class="block" style="min-height: 350px">
    <div class="block-header block-header-default">
        <h3 class="block-title">Barang Akan Expired</h3>
        <div class="block-options">
            <button type="button" class="btn btn-primary btn-square btn-request" data-toggle="modal" data-jenis-distribusi="Pengembalian" data-target="#modal-permintaan-distribusi">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Pengembalian
            </button>
            <button type="button" class="btn btn-primary btn-square btn-request" data-toggle="modal" data-jenis-distribusi="Permintaan" data-target="#modal-permintaan-distribusi">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Permintaan Distribusi
            </button>
        </div>
    </div>
    <div class="block-content">
        <form method="GET">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label>Batas Expired</label>
                        <select class="form-control" name="batas_hari">
                            <option value="30" @if($batas_hari == 30) selected @endif>1 Bulan Lagi</option>
                            <option value="60" @if($batas_hari == 60) selected @endif>2 Bulan Lagi</option>
                            <option value="90" @if($batas_hari == 90) selected @endif>3 Bulan Lagi</option>
                            <option value="180" @if($batas_hari == 180) selected @endif>6 Bulan Lagi</option>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group" style="padding-top: 25px">
                        <button class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </div>
        </form>
        <table class="table table-hover table-vcenter js-dataTable-full" style="width: 100%">
            <thead>
                <tr>
                    <th></th>
                    <th>No</th>
                    <th class="d-none d-sm-table-cell">Nama Barang</th>
                    <th class="d-none d-sm-table-cell">Stok</th>
                    <th class="d-none d-sm-table-cell">Harga</th>
                    <th class="d-none d-sm-table-cell">Expired</th>
                    <th class="d-none d-sm-table-cell">No Batch</th>
                    <th class="d-none d-sm-table-cell">Distributor</th>
                    <th class="d-none d-sm-table-cell">Tgl Faktur</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->item_farmasi->item_template->nama}}</td>
                    <td>{{number_format($item->jumlah,0)}}</td>
                    <td>Rp {{number_format($item->item_farmasi->harga,0)}}</td>
                    <td>{{indonesian_date($item->kadaluarsa,'d-m-Y')}}</td>
                    <td>{{$item->log_pengadaan->batch}}</td>
                    <td>{{$item->log_pengadaan->pengadaan->supplier_detail->nama}}</td>
                    <td>
                        @php $tgl_faktur = $item->log_pengadaan->pengadaan->tanggal_faktur ?? '' @endphp
                        @if(!empty($tgl_faktur))
                        {{indonesian_date($tgl_faktur,'d-m-Y')}}
                        @endif
                    </td>
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
                    <input type="hidden" class="form-control" id="jenis-distribusi" name="jenis" value="">
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

    $(document).on("click", ".btn-request", function () {
        var jenis_distribusi = $(this).data('jenis-distribusi');
        $("#modal-permintaan-distribusi #jenis-distribusi").val(jenis_distribusi);
    });

    $('#request-distribusi').on('click', function(e){
        var rows_selected = datatable.column(0).checkboxes.selected();
        var arrayIds = [];
        $.each(rows_selected, function(index, rowId){
            arrayIds.push(rowId)
        });
        var textIds = arrayIds.join(",");
        var farmasiId = $('#farmasi-select2').val();
        var jenis = $('#jenis-distribusi').val();
        var url = "{{url('farmasi/'.session('farmasi')->slug.'/distribusi')}}?auto-request-items="+textIds+"&auto-request-farmasi-id="+farmasiId+"&jenis="+jenis
        window.open(url, '_blank');
    });
</script>
@endsection