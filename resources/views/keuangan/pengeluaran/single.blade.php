@extends('keuangan.layouts.main')

@section('title')
BK {{$pengeluaran->id}} - Keuangan
@endsection

@section('content')


<!-- Page Content -->
<div class="content p-0" id="print-content">
    <!-- Invoice -->
    <h2 class="content-heading d-print-none pt-0">
        Invoice Pengeluaran
    </h2>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">#OUT{{$pengeluaran->id}}</h3>
            <div class="block-options">
                <!-- Print Page functionality is initialized in Codebase() -> uiHelperPrint() -->
                {{-- <button type="button" class="btn btn-sm btn-alt-primary" onclick="printContent('print-content')" data-toggle="tooltip" title="Print Invoice">
                    <i class="si si-printer"></i>
                </button> --}}
                <a href="{{ route('pengeluaran_kwitansi', ['id' => $pengeluaran->id]) }}" class="btn btn-sm btn-alt-primary">
                    Kwitansi <i class="si si-printer"></i>
                </a>
                <a href="{{url('keuangan/pengeluaran')}}/edit/{{$pengeluaran->id}}" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Transaksi">
                    <i class="fa fa-edit"></i>
                </a>
                <button class="btn btn-sm btn-alt-danger remove" data-pk="{{$pengeluaran->id}}" data-toggle="tooltip" title="Delete Transaksi">
                    <i class="fa fa-trash"></i>
                </button>
                <button type="button" class="btn btn-sm btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
            </div>
        </div>
        <div class="block-content">
            <!-- Invoice Info -->
            <div class="row">
                <div class="col-12 text-center">
                    <p class="h4" style="margin-bottom:0">{{$pengeluaran->judul}}</p>
                </div>
            </div>
            <hr>
            <div class="row my-20">
                <!-- Company Info -->
                <div class="col-5">
                    <label>Penerima</label>
                    <p class="h4">{{$pengeluaran->penerima}}</p>
                </div>
                <div class="col-5">
                    <label>Pembayar</label>
                    <p class="h4">{{$pengeluaran->pembayar}}</p>
                </div>
                <!-- END Company Info -->
                <div class="col-2 text-right">
                    <address>
                        {{date('d F Y', strtotime($pengeluaran->tanggal_transaksi))}}
                    </address>
                </div>
            </div>
            <!-- END Invoice Info -->

            <!-- Table -->
            <div class="table-responsive push">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;"></th>
                            <th>Deskripsi</th>
                            <th class="text-center" style="width: 90px;">Jumlah</th>
                            <th class="text-right" style="width: 120px;">Harga</th>
                            <th class="text-right" style="width: 90px;">Diskon</th>
                            <th class="text-right" style="width: 120px;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 0 @endphp
                        @foreach($pengeluaran->detail as $item)
                        <tr>
                            <td class="text-center">{{++$count}}</td>
                            <td>
                                <p class="font-w600 mb-5">{{$item->layanan_string}}</p>
                                <div class="text-muted">{{$item->keterangan}}</div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-pill badge-primary">{{$item->jumlah}}</span>
                            </td>
                            <td class="text-right">Rp {{number_format($item->harga,0)}}</td>
                            <td class="text-center">
                                {{$item->diskon}} %
                            </td>
                            <td class="text-right">Rp {{number_format($item->subtotal)}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" class="font-w600 text-right">Subtotal</td>
                            <td class="text-right">Rp {{number_format($pengeluaran->jumlah)}}</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="font-w600 text-right">Diskon</td>
                            <td class="text-right">Rp {{number_format($pengeluaran->diskon)}}</td>
                        </tr>
                        <tr class="table-warning">
                            <td colspan="5" class="font-w700 text-uppercase text-right">Total</td>
                            <td class="font-w700 text-right">Rp {{number_format($pengeluaran->total)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END Table -->

            <!-- Footer -->
            <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>
            <!-- END Footer -->
        </div>
    </div>
    <!-- END Invoice -->
</div>

<!-- END Page Content -->
@endsection

@section('js')
<script src="{{asset('js/keuangan/pengeluaran/single.js')}}"></script>
<script src="{{asset('js/keuangan/pengeluaran/delete.js')}}"></script>
@endsection
