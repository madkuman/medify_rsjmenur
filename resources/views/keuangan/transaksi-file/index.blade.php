@extends('keuangan.layouts.main')

@section('title')
Transaksi File Pengadaan - Keuangan
@endsection

@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
</style>
@endsection

@section('content')
@include('keuangan.transaksi-file.components.header')
<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-header block-header-default py-20">
                <span><h4 class="mb-0"></h4><hr>
                </span>
                <div class="block-options">
                    {{-- <button class="btn btn-sm btn-success btn-hero konfirmasi-batch" style="display: none;">
                        <i class="fa fa-check"></i> Konfirmasi Semua
                    </button>
                    <button class="btn btn-sm btn-danger btn-hero cancel-konfirmasi-batch" style="display: none;">
                        <i class="fa fa-close"></i> Batalkan Semua
                    </button>
                    <button class="btn btn-sm btn-danger btn-hero cancel-kirim-batch" style="display: none;">
                        <i class="fa fa-close"></i> Batalkan Semua
                    </button> --}}
                    <a href="{{url()->current()}}/baru" class="btn btn-sm btn-primary btn-hero">
                        <i class="fa fa-paper-plane"></i> Kirim File
                    </a>
                </div>
            </div>
            <div class="block-content py-20">
                <div class="row">
                    <div class="col-sm-12 col-xs-12 col-lg-3 form-group">
                        <label>Status Pengiriman File</label>
                        <select class="form-control" id="status" name="status">
                            <option value="0">Menunggu Konfirmasi</option>
                            <option value="1">Sedang Dipegang</option>
                            <option value="2">Telah Dikirim</option>
                            <option value="3" selected>Semua</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-xs-12 col-lg-2 form-group">
                        <label>Lokasi</label>
                        <select class="form-control" id="lokasi" name="lokasi">
                            @foreach($lokasi as $item)
                            <option value="{{$item->nama}}" @if($item->nama == $lokasi_req) selected @endif>{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-xs-12 col-lg-4 form-group">
                        <label>Tanggal</label>
                        <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" id="date_start" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" id="date_end" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 col-lg-2 form-group">
                        <label>&nbsp;</label>
                        <button type="button" class="btn btn-primary btn-block" id="buttonFilter">Filter <i id="loading" class="fa fa-spinner fa-spin" style="display: none;"></i></button>
                    </div>
                </div>
                <table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="transaksiTable">
                    <thead>
                        <tr>
                            <th style="width: 200px;">No. PJK  </th>
                            <th style="width: 200px;">Perusahaan  </th>
                            <th style="width: 200px;">Mengenai  </th>
                            <th style="width: 200px;">Jumlah  </th>
                            <th style="width: 200px;">Status  </th>
                            <th style="width: 200px;">Aksi  </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="kirimFileTags" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kirim File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{url('rekammedis/transaksi-file/permintaan/kirim')}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <p>Gunakan Barcode Scanner untuk mempercepat input</p>
                                <label class="col-12" for="example-tags1">Masukkan No RM</label>
                                <div class="col-12">
                                    {{csrf_field()}}
                                    <input type="text" class="js-tags-input form-control" id="example-tags2" name="no_rm" value="">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="konfirmasiTolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Akan Menolak Semua Transaksi Ini?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <p>Permintaan yang telah ditolak tidak dapat dikembalikan lagi</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="{{url()->full()}}&tolak_batch=1" class="btn btn-primary">Ya</a>
            </div>
        </div>
    </div>
</div>

<form method="POST" action="{{url('keuangan/transaksi-file/konfirmasi')}}" id="formKonfirmasi">
    {{csrf_field()}}
    <input name="file_id" type="hidden" class="file_id">
</form>
<form method="POST" action="{{url('keuangan/transaksi-file/konfirmasi/batch')}}" id="formKonfirmasiBatch">
    {{csrf_field()}}
    <input name="lokasi" type="hidden" class="lokasi">
</form>
<form method="POST" action="{{url('keuangan/transaksi-file/konfirmasi/cancel')}}" id="formKonfirmasiCancel">
    {{csrf_field()}}
    <input name="file_id" type="hidden" class="file_id">
</form>
<form method="POST" action="{{url('keuangan/transaksi-file/konfirmasi/batch/cancel')}}" id="formKonfirmasiBatchCancel">
    {{csrf_field()}}
    <input name="lokasi" type="hidden" class="lokasi">
</form>
<form method="POST" action="{{url('keuangan/transaksi-file/kirim/cancel')}}" id="formKirimCancel">
    {{csrf_field()}}
    <input name="file_id" type="hidden" class="file_id">
</form>
<form method="POST" action="{{url('keuangan/transaksi-file/kirim/batch/cancel')}}" id="formKirimBatchCancel">
    {{csrf_field()}}
    <input name="lokasi" type="hidden" class="lokasi">
</form>
@endsection


@section('js')




<script type="text/javascript">
    $(document).ready(function() {
        var start_date = $("#date_start").val();
        var end_date = $("#date_end").val();
        var status = $("#status").val();
        var lokasi = $("#lokasi").val();
        draw(start_date,end_date,status,lokasi);
        // changeDefaultBatch();

        $('#buttonFilter').click(function() {
            var start_date = $("#date_start").val();
            var end_date = $("#date_end").val();
            var status = $("#status").val();
            var lokasi = $("#lokasi").val();

            $('#loading').show();
            table.destroy();
            draw(start_date,end_date,status,lokasi);
            // changeDefaultBatch();
        });
    });

    function changeDefaultBatch() {
        if ($('#status').val() == '0') {
            $('.konfirmasi-batch').show();
            $('.cancel-konfirmasi-batch').hide();
            $('.cancel-kirim-batch').hide();
        } else if ($('#status').val() == '1') {
            $('.konfirmasi-batch').hide();
            $('.cancel-konfirmasi-batch').show();
            $('.cancel-kirim-batch').hide();
        } else if ($('#status').val() == '2') {
            $('.konfirmasi-batch').hide();
            $('.cancel-konfirmasi-batch').hide();
            $('.cancel-kirim-batch').show();
        } else {
            $('.konfirmasi-batch').hide();
            $('.cancel-konfirmasi-batch').hide();
            $('.cancel-kirim-batch').hide();
        }
    }

    function initForm() {
        $(".konfirmasi").click(function(e){
            e.preventDefault();
            id = $(this).data("id");
            $('.file_id').val(id);
            swal({
                title: "Konfirmasi File Ini?",
                showCancelButton: true,
                reverseButtons: true,
                type: 'warning',
                confirmButtonClass: "btn btn-success",
                cancelButtonClass: "btn btn-default",
                confirmButtonText: "Ya!",
                cancelButtonText: "Tidak"
            }).then(function(result) {
                if(result.value)
                {
                    $('#formKonfirmasi').submit();
                }
            });
        });
        $(".cancel-konfirmasi").click(function(e){
            e.preventDefault();
            id = $(this).data("id");
            $('.file_id').val(id);
            swal({
                title: "Batalkan Konfirmasi File Ini?",
                showCancelButton: true,
                reverseButtons: true,
                type: 'warning',
                confirmButtonClass: "btn btn-success",
                cancelButtonClass: "btn btn-default",
                confirmButtonText: "Ya!",
                cancelButtonText: "Tidak"
            }).then(function(result) {
                if(result.value)
                {
                    $('#formKonfirmasiCancel').submit();
                }
            });
        });
        $(".cancel-kirim").click(function(e){
            e.preventDefault();
            console.log('cancel kirim');
            id = $(this).data("id");
            $('.file_id').val(id);
            swal({
                title: "Batalkan Kirim File Ini?",
                showCancelButton: true,
                reverseButtons: true,
                type: 'warning',
                confirmButtonClass: "btn btn-success",
                cancelButtonClass: "btn btn-default",
                confirmButtonText: "Ya!",
                cancelButtonText: "Tidak"
            }).then(function(result) {
                if(result.value)
                {
                    $('#formKirimCancel').submit();
                }
            });
        });
        $(".konfirmasi-batch").click(function(e){
            e.preventDefault();
            id = $(this).data("id");
            $('.lokasi').val(id);
            swal({
                title: "Konfirmasi Semua File?",
                showCancelButton: true,
                reverseButtons: true,
                type: 'warning',
                confirmButtonClass: "btn btn-success",
                cancelButtonClass: "btn btn-default",
                confirmButtonText: "Ya!",
                cancelButtonText: "Tidak"
            }).then(function(result) {
                if(result.value)
                {
                    $('#formKonfirmasiBatch').submit();
                }
            });
        });
        $(".cancel-konfirmasi-batch").click(function(e){
            e.preventDefault();
            id = $(this).data("id");
            $('.lokasi').val(id);
            swal({
                title: "Batalkan Konfirmasi Semua File?",
                showCancelButton: true,
                reverseButtons: true,
                type: 'warning',
                confirmButtonClass: "btn btn-success",
                cancelButtonClass: "btn btn-default",
                confirmButtonText: "Ya!",
                cancelButtonText: "Tidak"
            }).then(function(result) {
                if(result.value)
                {
                    $('#formKonfirmasiBatchCancel').submit();
                }
            });
        });
        $(".cancel-kirim-batch").click(function(e){
            e.preventDefault();
            id = $(this).data("id");
            $('.lokasi').val(id);
            swal({
                title: "Batalkan Kirim Semua File?",
                showCancelButton: true,
                reverseButtons: true,
                type: 'warning',
                confirmButtonClass: "btn btn-success",
                cancelButtonClass: "btn btn-default",
                confirmButtonText: "Ya!",
                cancelButtonText: "Tidak"
            }).then(function(result) {
                if(result.value)
                {
                    $('#formKirimBatchCancel').submit();
                }
            });
        });
    }

    var table;
    function draw(start_date,end_date,status,lokasi){
        table = $('#transaksiTable').DataTable({
        processing: true,
        serverSide: true,
        language: {
            processing: '<div class="panel panel-default"><i class="fa fa-4x fa-gear fa-spin text-info"></i></div>'
        },
        ajax: {
            type: "POST",
            dataType: "json",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                start_date: start_date,
                end_date: end_date,
                status: status,
                lokasi: lokasi
            },
            url: API_URL + '/keuangan/transaksi-file/get-table',
        },
        columns: [
            { data: 'file.nomorpjk', name: 'file.nomorpjk'},
            { data: 'file.perusahaan.nama', name: 'file.perusahaan.nama'},
            { data: 'file.judul', name: 'file.judul'},
            { data: 'file.total', name: 'file.total',
                render: function ( data ) {
                    return "Rp "+numeral(data).format('0,0');
                }
            },
            { data: 'status', name: 'status',
                render: function (data, type, row, meta) {
                    var content = "";
                    if (data == 0) {
                        if (row.lokasi_tujuan == lokasi) {
                            content = '<span class="badge badge-secondary">Menunggu Konfirmasi</span><br>';
                            content += 'Asal: '+row.lokasi_last;
                        } else if (row.lokasi_last == lokasi) {
                            content = '<span class="badge badge-primary">Telah Dikirim</span><br>';
                            content += 'Tujuan: '+row.lokasi_tujuan;
                        }
                    } else {
                        if (row.transfer_status == 2) {
                            content = '<span class="badge badge-default">Selesai</span>';
                        } else {
                            content = '<span class="badge badge-success">Sedang Dipegang</span>';
                        }
                    }
                    return content;
                },
                searchable: false,
                sortable: false
            },
            { data: 'status', name: 'status', className: 'text-center', 
                render: function(data, type, row, meta){
                    var content = "";
                    content += '<a href="transaksi-file/'+row.utang_id+'" class="btn btn-sm btn-alt-success" data-toggle="tooltip" title="Lihat Detail">&nbsp;<i class="fa fa-search-plus"></i></a>';
                    if (row.status == 0) {
                        if (row.lokasi_tujuan == lokasi) {
                            content += '&nbsp;<button class="btn btn-sm btn-alt-success konfirmasi" data-id="'+row.file_id+'" data-toggle="tooltip" title="Konfirmasi">&nbsp;<i class="fa fa-check"></i></button>';
                        } else if (row.lokasi_last == lokasi) {
                            content += '&nbsp;<button class="btn btn-sm btn-alt-danger cancel-kirim" data-id="'+row.file_id+'" data-toggle="tooltip" title="Batal Kirim">&nbsp;<i class="fa fa-close"></i></button>';
                        }
                    } else {
                        if (row.transfer_status != 2) {
                            content += '&nbsp;<button class="btn btn-sm btn-alt-danger cancel-konfirmasi" data-id="'+row.file_id+'" data-toggle="tooltip" title="Batal Konfirmasi">&nbsp;<i class="fa fa-close"></i></button>';
                            content += '&nbsp;<a href="transaksi-file/baru?file_id='+row.file_id+'&lokasi_asal='+lokasi+'" class="btn btn-sm btn-alt-primary" title="Kirim File"><i class="fa fa-paper-plane"></i></a>';
                        }
                    }
                    return content;
                },
                searchable: false,
                sortable: false
            }
        ],
        drawCallback: function() {
            initForm();
            $('#loading').hide();
        }
        });
        
    }
    
</script>
@endsection