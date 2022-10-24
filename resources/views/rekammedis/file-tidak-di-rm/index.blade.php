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

                <h4>Daftar File Tidak di RM</h4>

                <hr>
                <div style="overflow: auto;">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>No RM</th>
                                <th class="">Nama Pasien</th>
                                <th class="">Lokasi</th>
                                <th class="">Dibawah Oleh</th>
                                <th class="">Status</th>
                                <th class="" style="width: 150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rm as $item)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="font-w600">#{{$item->no_rm}}</td>
                                <td class="">{{$item->name}}</td>
                                <td class="">{{$item->rm_transaksi->holder->name}}</td>
                                <td class="">
                                    @if($item->rm_current_holder->type == 2 && $item->rm_current_holder->id == 24)
                                    Ruang RM
                                    @else
                                    Tidak di Ruang RM (dibawa oleh)
                                    {{$item->rm_current_holder->name}}
                                    @endif
                                </td>

                                <td class="">
                                    @if($item->rm_transaksi->holder_group_id == 24)
                                    @if($item->rm_transaksi->status == 0) <span class="badge badge-secondary">Menunggu</span>
                                    @elseif($item->rm_transaksi->status == 1) <span class="badge badge-primary">Proses Pengiriman</span>
                                    @elseif($item->rm_transaksi->status == 2) <span class="badge badge-success">Selesai</span>
                                    @elseif($item->rm_transaksi->status == -1) <span class="badge badge-danger">Pengiriman Ditolak</span>
                                    @elseif($item->rm_transaksi->status == -2) <span class="badge badge-warning">Konfirmasi Penerimaan Ditolak</span>
                                    @else Tanpa Status
                                    @endif
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form action="{{url('rekammedis/transaksi/pengembalian/konfirmasi')}}" method="POST">
                                        {{csrf_field()}}
                                        <input type="hidden" name="no_rm" value="{{$item->no_rm}}">
                                        <input type="hidden" name="force" value="1">
                                        <input type="hidden" name="flag" value="1">
                                        <button class="btn btn-sm btn-primary ">
                                            <i class="fa fa-paper-plane"></i> Ambil
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