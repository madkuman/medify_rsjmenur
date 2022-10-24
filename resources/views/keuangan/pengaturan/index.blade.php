@extends('keuangan.layouts.main')

@section('title')
Pengaturan - Keuangan
@endsection

@section('content')

<div class="bg-image bg-image-bottom" style="background-image: url('{{asset('assets/img/photos/photo34@2x.jpg')}}');">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden pt-50">
            <div class="pt-0 pb-20">
                <h2 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">Pengaturan</h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->   
<div class="mt-20">
    <div class="row">
        <div class="col-6">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Pengaturan Kategori Keuangan</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Melihat, membuat dan mengatur kategori keuangan</p>
                    <a href="{{url('keuangan/pengaturan/kategori')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Pengaturan Akun Keuangan</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Melihat, membuat dan mengatur akun keuangan</p>
                    <a href="{{url('keuangan/pengaturan/akun')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Pengaturan Rekanan</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Melihat, membuat dan mengatur rekanan</p>
                    <a href="{{url('keuangan/pengaturan/rekanan')}}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="block">
                <div class="block-header text-center">
                    <h5 class="mb-0">Pengaturan TTD</h5>
                </div>
                <div class="block-content text-center block-content-full">
                    <p>Melihat, membuat dan mengatur tanda tangan untuk print dokumen keuangan</p>
                    <a href="{{url('keuangan/pengaturan/ttd')}}" class="btn btn-primary">Lihat</a>
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