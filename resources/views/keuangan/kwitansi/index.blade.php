@extends('keuangan.layouts.main')

@section('title')
Daftar Kwitansi - Keuangan
@endsection

@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
</style>
@endsection
@section('content')
@include('keuangan.kwitansi.components.header')

<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-header block-header-default py-20">
                <span><h4 class="mb-0">Transaksi Hari Ini</h4><hr>
                <h5>{{date('d F Y', strtotime($today))}}</h5></span>
                <input type="text" class="d-none" id="today" value="{{date('d F Y', strtotime($today))}}">
                {{-- <div class="block-options">
                    <a href="{{url()->current()}}/baru" class="btn btn-sm btn-primary btn-hero">
                        <i class="fa fa-plus"></i> Buat Kwitansi
                    </a>
                </div> --}}
            </div>
            <div class="block-content py-20">
                <table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="transaksiTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#  </th>
                            <th class="text-center" style="width: 100px;">Waktu  </th>
                            <th class="text-center" style="width: 150px;">Tipe  </th>
                            <th class="text-center" style="width: 250px;">Jenis  </th>
                            <th class="text-center" style="width: 200px;">Total  </th>
                            <th class="text-center" style="width: 200px;">Pembayar  </th>
                            <th class="text-center" style="width: 200px;">Penerima  </th>
                            <th class="text-center">Aksi </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 0 @endphp
                        @foreach($kwitansi as $item)
                        <tr>
                            <td class="text-center">{{++$count}}</td>
                            <td class="text-center">{{date('H:i', strtotime($item->created_at))}}</td>
                            <td class="text-left">
                                @if($item->type == 1)
                                    Pemasukan
                                @elseif($item->type == 2)
                                    Pengeluaran
                                @endif
                            </td>
                            <td class="text-left">{{$item->jenis_transaksi}}</td>
                            <td class="text-right">Rp {{number_format($item->total)}}</td>
                            <td class="text-left">{{$item->pembayar_nama}}</td>
                            <td class="text-left">{{$item->penerima_nama}}</td>
                            <td class="text-center">
                                <a href="{{ route('kwitansi_single', ['id' => $item->id]) }}" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Detail">
                                    <i class="fa fa-search-plus"></i>
                                </a>
                                {{-- <a href="{{ route('kwitansi_print', ['id' => $item->id]) }}" class="btn btn-sm btn-alt-success">
                                    <i class="fa fa-search"></i>
                                </a> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('js/keuangan/kwitansi/index.js')}}"></script>


@endsection