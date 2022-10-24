@extends('layouts.main', ['app' => "warehouse"])

@section('title')
Transaksi - Pergudangan - Medify
@endsection

@section('sidebarcomponent')
    @include('warehouse.components.sidebar')
@endsection

@section('content')

<div class="row page-title-container">
    <div class="icon">
        <i class="fa fa-exchange"></i>
    </div>
    <div class="title">
        Transaksi<br>
        <small>
            Barang Keluar
        </small>
    </div>
</div>


<div class="card main-content transaction-index">

    <div class="card-header "> 
        {{-- <a href="{{url('warehouse/transaction/new')}}" class="btn btn-fill btn-round btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Transaksi Baru</a> --}}
        <h4 class="card-title">Transaksi Terbaru</h4>
        <p class="card-category">Transaksi tercatat pada hari ini</p>
    </div>

    <div class="card-body table-full-width inventory">
        <table class="table">
            <thead>
                <tr class="header">
                    <th class="text-center">#</th>
                    <th>Tujuan</th>
                    <th>Waktu</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                <a href="{{url('warehouse/transaction/'.$transaction->slug)}}" rel="tooltip" title="" data-original-title="Lihat Transaksi">
                    @if($transaction->status != 0)
                    <tr class="transaction clickable-row" data-href="{{url('warehouse/transaction/'.$transaction->slug)}}">
                    @else
                    <tr class="unread transaction clickable-row" data-href="{{url('warehouse/transaction/'.$transaction->slug)}}">
                    @endif
                        <td class="text-center">
                            <span class="out"><i class="fa fa-reply"  rel="tooltip" data-original-title="Transaksi Keluar"></i> </span>
                        </td>
                        <td>
                            @if($transaction->buyer_detail != null)
                                {{$transaction->buyer_detail->nama}}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ date('d F Y, H:i', strtotime($transaction->created_at)) }}</td>
                        <td>
                            @if($transaction->status == 0)
                                Menunggu Konfirmasi
                            @elseif($transaction->status == 1)
                                @if($transaction->type == 1)
                                    Barang Telah Diterima
                                @else 
                                    Barang Telah Dikirim
                                @endif
                            @else
                                Transaksi Ditolak   
                            @endif
                        </td>
                        <td>@if($transaction->status == 2)
                                (tertolak) {{$transaction->explanation}}
                            @endif {{$transaction->description}}</td>
                        {{-- <td class="td-actions text-right">
                            <a href="{{url('warehouse/transaction/'.$transaction->slug)}}" rel="tooltip" title="" class="btn btn-info btn-link btn-xs" data-original-title="Lihat Transaksi">
                                <i class="fa fa-paper-plane"></i>
                            </a>
                        </td> --}}
                    </tr>
                </a>
                @empty
                <tr style="text-align: center;">
                    <td></td>
                    <td colspan="6">Tidak ada transaksi pada hari ini.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script type="text/javascript">
        @if(session('status')) {
            swal('Berhasil', '{{(session('status'))}}', 'success');
        }
        @endif

        function imgError(image) {
            image.onerror = "";
            image.src = "https://cdn.browshot.com/static/images/not-found.png";
            return true;
        }
    </script>
@endsection