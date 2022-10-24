@extends('keuangan.layouts.main')

@section('title')
Dashboard - Keuangan
@endsection

@section('content')
<div class="bg-image bg-image-bottom" style="background-image: url('assets/img/photos/photo34@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-top text-center overflow-hidden pt-50">
            <div class="pt-0 pb-20">
                <h1 class="font-w700 text-white mb-10 invisible" data-toggle="appear" data-class="animated fadeInUp">Dashboard</h1>
                <h2 class="h4 font-w400 text-white-op invisible" data-toggle="appear" data-class="animated fadeInUp">Selamat datang di Keuangan</h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <div class="row invisible" data-toggle="appear">
        <!-- Row #1 -->
        <div class="col-6 col-xl-3">
            <a class="block block-link-pop text-right bg-primary" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="si si-bar-chart fa-3x text-primary-light d-none"></i>
                    </div>
                    <div class="font-size-h4 font-w600 text-white">Rp {{number_format($pemasukan_total,0)}}</span></div>
                    <div class="font-size-sm font-w600 text-uppercase text-white-op">Pemasukan</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-pop text-right bg-earth" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="si si-trophy fa-3x text-earth-light d-none"></i>
                    </div>
                    <div class="font-size-h4 font-w600 text-white">Rp {{number_format($pengeluaran_total,0)}}</span></div>
                    <div class="font-size-sm font-w600 text-uppercase text-white-op">Pengeluaran</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-pop text-right bg-elegance" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="si si-envelope-letter fa-3x text-elegance-light d-none"></i>
                    </div>
                    <div class="font-size-h4 font-w600 text-white">Rp {{number_format($utang_total,0)}}</span></div>
                    <div class="font-size-sm font-w600 text-uppercase text-white-op">Utang</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-pop text-right bg-corporate" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="si si-fire fa-3x text-corporate-light d-none"></i>
                    </div>
                    <div class="font-size-h4 font-w600 text-white">Rp {{number_format($piutang_total,0)}}</span></div>
                    <div class="font-size-sm font-w600 text-uppercase text-white-op">Piutang</div>
                </div>
            </a>
        </div>
        <!-- END Row #1 -->
    </div>
    <div class="row invisible" data-toggle="appear">
        <!-- Row #2 -->
        <div class="col-md-6">
            <div class="block">
                <div class="block-header bg-primary-lighter">
                    <h3 class="block-title">
                        Pemasukan <small>Minggu ini</small>
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="pull-all pt-30">
                        <!-- Lines Chart Container -->
                        <canvas class="js-chartjs-dashboard-lines"></canvas>
                    </div>
                </div>
                <div class="block-content d-none">
                    <div class="row items-push text-center">
                        <div class="col-12 col-sm-4">
                            <div class="font-w600 text-success">
                                <i class="fa fa-caret-up"></i> +6%
                            </div>
                            <div class="font-size-h4 font-w600">35.2</div>
                            <div class="font-size-sm font-w600 text-uppercase text-muted">Rata Rata</div>
                            <button type="button" class="btn btn-sm btn-circle btn-alt-info mr-5 mb-5 mt-10" data-toggle="popover" title="Bagaimana Maksudnya?" data-placement="top" data-content="Rata rata pemasukan bulan ini.">
                                <i class="fa fa-info"></i>
                            </button>
                        </div>
                        <div class="col-6 col-sm-4">
                            <div class="font-w600 text-success">
                                <i class="fa fa-caret-up"></i> +14%
                            </div>
                            <div class="font-size-h4 font-w600">960</div>
                            <div class="font-size-sm font-w600 text-uppercase text-muted">Total Bulan Ini</div>
                            <button type="button" class="btn btn-sm btn-circle btn-alt-info mr-5 mb-5 mt-10" data-toggle="popover" title="Bagaimana Maksudnya?" data-placement="top" data-content="Total pemasukan selama bulan ini. Dibandingkan dengan bulan sebelumnya.">
                                <i class="fa fa-info"></i>
                            </button>
                        </div>
                        <div class="col-6 col-sm-4">
                            <div class="font-w600 text-danger">
                                <i class="fa fa-caret-down"></i> -1%
                            </div>
                            <div class="font-size-h4 font-w600">263</div>
                            <div class="font-size-sm font-w600 text-uppercase text-muted">Total Minggu Ini 
                            </div>
                            <button type="button" class="btn btn-sm btn-circle btn-alt-info mr-5 mb-5 mt-10" data-toggle="popover" title="Bagaimana Maksudnya?" data-placement="top" data-content="Total pemasukan selama 7 hari terakhir. Dibandingkan dengan 7 hari sebelumnya.">
                                <i class="fa fa-info"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block">
                <div class="block-header bg-earth-lighter">
                    <h3 class="block-title">
                        Pengeluaran <small>Minggu ini</small>
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="pull-all pt-30">
                        <!-- Lines Chart Container -->
                        <canvas class="js-chartjs-dashboard-lines2"></canvas>
                    </div>
                </div>
                <div class="block-content d-none">
                    <div class="row items-push text-center">
                        <div class="col-12 col-sm-4">
                            <div class="font-w600 text-success">
                                <i class="fa fa-caret-up"></i> +6%
                            </div>
                            <div class="font-size-h4 font-w600">35.2</div>
                            <div class="font-size-sm font-w600 text-uppercase text-muted">Rata Rata</div>
                            <button type="button" class="btn btn-sm btn-circle btn-alt-info mr-5 mb-5 mt-10" data-toggle="popover" title="Bagaimana Maksudnya?" data-placement="top" data-content="Rata rata pemasukan bulan ini.">
                                <i class="fa fa-info"></i>
                            </button>
                        </div>
                        <div class="col-6 col-sm-4">
                            <div class="font-w600 text-success">
                                <i class="fa fa-caret-up"></i> +14%
                            </div>
                            <div class="font-size-h4 font-w600">960</div>
                            <div class="font-size-sm font-w600 text-uppercase text-muted">Total Bulan Ini</div>
                            <button type="button" class="btn btn-sm btn-circle btn-alt-info mr-5 mb-5 mt-10" data-toggle="popover" title="Bagaimana Maksudnya?" data-placement="top" data-content="Total pemasukan selama bulan ini. Dibandingkan dengan bulan sebelumnya.">
                                <i class="fa fa-info"></i>
                            </button>
                        </div>
                        <div class="col-6 col-sm-4">
                            <div class="font-w600 text-danger">
                                <i class="fa fa-caret-down"></i> -1%
                            </div>
                            <div class="font-size-h4 font-w600">263</div>
                            <div class="font-size-sm font-w600 text-uppercase text-muted">Total Minggu Ini 
                            </div>
                            <button type="button" class="btn btn-sm btn-circle btn-alt-info mr-5 mb-5 mt-10" data-toggle="popover" title="Bagaimana Maksudnya?" data-placement="top" data-content="Total pemasukan selama 7 hari terakhir. Dibandingkan dengan 7 hari sebelumnya.">
                                <i class="fa fa-info"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Row #2 -->
    </div>
    <div class="row invisible d-none" data-toggle="appear">
        <!-- Row #4 -->
        <div class="col-md-4">
            <div class="block">
                <div class="block-content block-content-full">
                    <div class="py-20 text-center">
                        <div class="mb-20">
                            <i class="si si-earphones fa-3x text-success"></i>
                        </div>
                        <div class="font-size-h4 font-w600">Rp 5,800,000,000</div>
                        <div class="text-muted">
                            <h5>
                                <span class="badge badge-pill badge-primary py-10">Cash</span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="block">
                <div class="block-content block-content-full">
                    <div class="py-20 text-center">
                        <div class="mb-20">
                            <i class="si si-diamond fa-3x text-warning"></i>
                        </div>
                        <div class="font-size-h4 font-w600">Rp 2,900,000,000</div>
                        <div class="text-muted">
                            <h5>
                                <span class="badge badge-pill badge-secondary py-10">BNI</span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="block">
                <div class="block-content block-content-full">
                    <div class="py-20 text-center">
                        <div class="mb-20">
                            <i class="si si-grid fa-3x text-info"></i>
                        </div>
                        <div class="font-size-h4 font-w600">Rp 1,200,000,000</div>
                        <div class="text-muted">
                            <h5>
                                <span class="badge badge-pill badge-warning py-10">BCA</span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Row #4 -->
    </div>
</div>
<!-- END Page Content -->
@endsection

@section('js')
<script src="{{asset('js/keuangan/dashboard.js')}}"></script>
<!-- <script src="{{asset('assets/js/pages/be_pages_dashboard.js')}}"></script> -->

@endsection