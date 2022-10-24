@extends('rekammedis.layouts.main')

@section('title')
Rekam Medis - Medify
@endsection

@section('css')

@endsection

@section('subtitle')
Dashboard
@endsection

@section('content')
<main id="main-container">
    @include('rekammedis.layouts.navbar')
    <div class="container">
        <div class="block">
            <div class="block-content block-content-full">

                <div class="row mx-0">
                    <h4 class="col-lg-10 col-12">Daftar Pengembalian File ke Rekam Medis</h4>
                    <a class="btn btn-primary col-lg-2 col-12" href="{{url('rekammedis/transaksi/pengembalian/konfirmasi')}}">Konfirmasi Terima File</a>
                </div>
                <hr>
                <h5><small>FILTER</small></h5>
                <form method="GET" action="">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 col-lg-4 form-group">
                            <label>Range Tanggal</label>
                            <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                <input type="text" class="form-control" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_start}}">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text font-w600">to</span>
                                </div>
                                <input type="text" class="form-control" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_end}}">
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-lg-3 form-group">
                            <label>Status Pengembalian File</label>
                            <select class="form-control" name="status">
                                <option value="0" @if($status == 0) selected @endif>Proses Pengembalian</option>
                                <option value="1" @if($status == 1) selected @endif>Berhasil Dikembalikan</option>
                                <option value="1" @if($status == -1) selected @endif>Ditolak</option>
                                <option value="2" @if($status == 2) selected @endif>Semua</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-lg-1 form-group">
                            <label>&nbsp;</label>
                            <button class="btn btn-outline-primary btn-block">Filter</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div style="overflow: auto;">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>No RM</th>
                                <th class="">Nama Pasien</th>
                                <th class="">Lokasi Pengembalian</th>
                                <th class="">Waktu Permintaan</th>
                                <th class="">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi as $item)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="font-w600">#{{$item->pasien->no_rm}}</td>
                                <td class="">{{$item->pasien->name}}</td>
                                <td class="">{{$item->lokasi}}</td>
                                <td class="">
                                    @if($item->status == 0) <span class="badge badge-secondary">Menunggu</span>
                                    @elseif($item->status == 1) <span class="badge badge-primary">Proses Pengiriman</span>
                                    @elseif($item->status == 2) <span class="badge badge-success">Selesai</span>
                                    @elseif($item->status == -1) <span class="badge badge-danger">Pengiriman Ditolak</span>
                                    @elseif($item->status == -2) <span class="badge badge-warning">Konfirmasi Penerimaan Ditolak</span>
                                    @else Tanpa Status
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form action="{{url('rekammedis/transaksi')}}/{{$item->id}}/konfirmasi-penerimaan" method="POST">
                                        {{csrf_field()}}
                                        <a href="{{url('rekammedis/transaksi/'.$item->id)}}" class="btn btn-sm btn-secondary ">
                                            <i class="fa fa-search"></i> Detail
                                        </a>
                                        <button class="btn btn-sm btn-primary ">
                                            <i class="fa fa-paper-plane"></i> Terima
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="kirimFileTags" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kirim File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{url('rekammedis/transaksi/permintaan/kirim')}}">
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

@endsection


@section('js')




<script type="text/javascript">
    jQuery('.js-dataTable-full').dataTable({
        "ordering": true,
        pageLength: 8,
        lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
        autoWidth: false
    });
</script>
@endsection