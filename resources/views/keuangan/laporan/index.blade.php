@extends('keuangan.layouts.main')

@section('title')
Laporan - Keuangan
@endsection

@section('content')
<div class="bg-image bg-image-bottom" style="background-image: url('{{asset('assets/img/photos/photo34@2x.jpg')}}');">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden pt-50">
            <div class="pt-0 pb-20">
                <h2 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">Laporan Keuangan</h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->   
<div class="mt-20">
    <h5>Pemasukan</h5>
    <div class="row">
        <div class="col-3">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Laporan Riwayat Pemasukan</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Laporan riwayat pemasukan setiap pasien berdasarkan departemen</p>
                    <a href="{{url('keuangan/laporan/riwayat-pemasukan-pasien')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Laporan Rekap Pemasukan Harian</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Laporan rekap pemasukan harian berdasarkan departemen</p>
                    <a href="{{url('keuangan/laporan/pemasukan-harian')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Laporan Pendapatan Per Unit</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Laporan rekap pendapatan bulanan per unit</p>
                    <a href="{{url('keuangan/laporan/pendapatan-unit')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Laporan Rekap Klaim</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Laporan rekap klaim bulanan</p>
                    <a href="{{url('keuangan/laporan/rekap-klaim')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
    </div>
    <h5>Pengeluaran</h5>
    <div class="row">
        <div class="col-3">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Laporan PO</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Realisasi Pengadaan UKPBJ</p>
                    <a href="{{url('keuangan/laporan/po')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Laporan PJK</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Laporan laporan terkait PJK</p>
                    <a href="{{url('keuangan/laporan/pengeluaran-pjk')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Laporan SPP</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Laporan laporan terkait SPP</p>
                    <a href="{{url('keuangan/laporan/pengeluaran-spp')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Laporan Uji</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Laporan laporan terkait Uji</p>
                    <a href="{{url('keuangan/laporan/pengeluaran-uji')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Laporan BK</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Laporan laporan terkait BK</p>
                    <a href="{{url('keuangan/laporan/pengeluaran-bk')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Laporan Pengeluaran</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Laporan laporan terkait pengeluaran</p>
                    <a href="{{url('keuangan/laporan/rekap-pengeluaran')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Laporan Transaksi File Pengadaan</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Laporan mengenai transaksi file pengadaan barang {{config('app.name')}}</p>
                    <a href="{{url('keuangan/laporan/transaksi-file')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
    </div>

    <h5>Laporan Lain Lain</h5>
    <div class="row">
        <div class="col-3">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Laporan Utang</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Buku utang setiap bulan</p>
                    <a href="{{url('keuangan/laporan/buku-utang')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Laporan Piutang</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Buku piutang setiap bulan</p>
                    <a href="{{url('keuangan/laporan/buku-piutang')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Laporan KAS</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Buku KAS setiap bulan</p>
                    <a href="{{url('keuangan/laporan/buku-kas')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Laporan Penerimaan dan Pengeluaran</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Laporan Bulanan dan Tahunan</p>
                    <a href="{{url('keuangan/laporan/terima-keluar')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Pembagian Remunerasi</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Berbagai laporan untuk menunjang pembagian jasa (remunerasi)</p>
                    <a href="{{url('keuangan/laporan/remunerasi')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection

@section('js')
<script src="{{asset('js/keuangan/dashboard.js')}}"></script>
<!-- <script src="{{asset('assets/js/pages/be_pages_dashboard.js')}}"></script> -->

@endsection