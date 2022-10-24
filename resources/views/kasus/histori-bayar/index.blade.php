@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}}  - Administrasi - Kasus
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    @include('kasus.layouts.header')

    <div class="content">
        <div class="row">
            @include('kasus.layouts.sidebar')

            <!-- Updates -->
            <div class="col-lg-9 col-xl-9">
                <div class="row mb-15">
                    <div class="col-12 pl-5">
                        @include('kasus.tagihan.navbar')
                        <div class="block rounded mb-0">
                            <div class="block-header">
                                <h3 class="block-title">Riwayat Pembayaran dan DP Pasien</h3>
                                @if(session('my_role_'.$kasus->nomor_kasus))
                                <div class="block-options">
                                    <button type="button" class="btn-alt btn-rounded btn-primary min-width-125 float-right" data-toggle="modal" data-target="#tambahPembayaran"><i class="fa fa-plus"></i> Buat Pembayaran / DP</button>
                                </div>
                                @endif
                            </div>
                            <div class="block-content block-content-full">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="" style="width: 30%;">Judul Transaksi</th>
                                            <th class="" style="width: 30%;">Kasir Tujuan</th>
                                            <th class="" style="width: 30%;">Tgl Transaksi</th>
                                            <th style="width: 40%;">Nilai Transaksi</th>
                                            <th class="text-center" style="width: 30%;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($histori as $ht)
                                        <tr>
                                            <td>{{$ht->judul}}</td>
                                            <td>{{$ht->kasir->nama}}</td>
                                            @if(empty($ht->paid_date))
                                            <td>-</td>
                                            @else
                                            <td>{{$ht->paid_date}}</td>
                                            @endif
                                            @php $total = number_format($ht->total_bill,2,",","."); @endphp
                                            <td>Rp {{$total}}</td>
                                            <td class="text-center">
                                            @if(empty($ht->paid_date))
                                            <div class="badge badge-pill badge-warning">
                                                Menunggu
                                            </div>
                                            @else
                                            <div class="badge badge-pill badge-success">
                                                Dibayar
                                            </div>
                                            @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr><td rowspan="3" colspan="5" class="text-center pt-20">Belum Ada Histori Pembayaran Tersedia</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Updates -->
        </div>
    </div>
</main>
@include('kasus.histori-bayar.modal-tambah-bayar')
@endsection

@section('js')
@endsection