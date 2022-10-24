@extends('layouts.main-dashboard')
@section('content')

@include('layouts.components2.navbar')
<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <div class="row">
            <div class="col-3">
                <a class="block block-transparent mb-10" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix  p-0 pl-10">
                        <div class="float-left mr-10">
                            <img class="img-avatar-sm" src="assets/img/avatars/avatar12.jpg" alt="">
                        </div>
                        <div class="float-left text-left mt-10">
                            <h5 class="font-w600 mb-5">Klinik Annisa <i class="fa fa-caret-down fa"></i></h5>
                        </div>
                    </div>
                </a>


                <div class="block block-rounded block-transparent">
                    <div class="content-side content-side-full">
                        <ul class="nav-main">
                            <li>
                                <a href="{{url('')}}"><i class="si si-home"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                            </li>
                            <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Menu Utama</span></li>
                            <li>
                                <a href="{{url('pasien')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Pasien</span></a>
                            </li>
                            <li>
                                <a href="{{url('igd')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">IGD</span></a>
                            </li>
                            <li>
                                <a href="{{url('rawatinap')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Rawat Inap</span></a>
                            </li>
                            <li>
                                <a href="{{url('rawatjalan')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Rawat Jalan</span></a>
                            </li>
                            <li>
                                <a href="{{url('')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Kasir</span></a>
                            </li>
                            <li>
                                <a href="{{url('')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Keuangan</span></a>
                            </li>
                            <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Arsip</span></li>
                            <li>
                                <a href="{{url('')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Arsip Kasus</span></a>
                            </li>
                            <li>
                                <a href="{{url('')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Gaji & Jasa Medis</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="row gutters-tiny invisible" data-toggle="appear">
                    <!-- Row #1 -->
                    <div class="col-6 col-xl-3">
                        <a class="block block-link-shadow text-right" href="javascript:void(0)">
                            <div class="block-content block-content-full clearfix">
                                <div class="float-left mt-10 d-none d-sm-block">
                                    <i class="si si-bag fa-3x text-body-bg-dark"></i>
                                </div>
                                <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="1500">0</div>
                                <div class="font-size-sm font-w600 text-uppercase text-muted">Sales</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-xl-3">
                        <a class="block block-link-shadow text-right" href="javascript:void(0)">
                            <div class="block-content block-content-full clearfix">
                                <div class="float-left mt-10 d-none d-sm-block">
                                    <i class="si si-wallet fa-3x text-body-bg-dark"></i>
                                </div>
                                <div class="font-size-h3 font-w600">$<span data-toggle="countTo" data-speed="1000" data-to="780">0</span></div>
                                <div class="font-size-sm font-w600 text-uppercase text-muted">Earnings</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-xl-3">
                        <a class="block block-link-shadow text-right" href="javascript:void(0)">
                            <div class="block-content block-content-full clearfix">
                                <div class="float-left mt-10 d-none d-sm-block">
                                    <i class="si si-envelope-open fa-3x text-body-bg-dark"></i>
                                </div>
                                <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="15">0</div>
                                <div class="font-size-sm font-w600 text-uppercase text-muted">Messages</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-xl-3">
                        <a class="block block-link-shadow text-right" href="javascript:void(0)">
                            <div class="block-content block-content-full clearfix">
                                <div class="float-left mt-10 d-none d-sm-block">
                                    <i class="si si-users fa-3x text-body-bg-dark"></i>
                                </div>
                                <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="4252">0</div>
                                <div class="font-size-sm font-w600 text-uppercase text-muted">Online</div>
                            </div>
                        </a>
                    </div>
                    <!-- END Row #1 -->
                </div>

                <div class="row gutters-tiny">
                    <!-- Latest Orders -->
                    <div class="col-xl-6">
                        <div class="block block-rounded">
                            <div class="block-header">
                                <h3 class="block-title">
                                    Pemasukan <small>Terbaru</small>
                                </h3>
                            </div>
                            <div class="block-content">
                                <table class="table table-borderless table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 100px;">ID</th>
                                            <th>Status</th>
                                            <th class="d-none d-sm-table-cell">Customer</th>
                                            <th class="text-right">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a class="font-w600" href="be_pages_ecom_order.html">ORD.1851</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">Processing</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell">
                                                <a href="be_pages_ecom_customer.html">Jose Mills</a>
                                            </td>
                                            <td class="text-right">
                                                <span class="text-black">$443</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="font-w600" href="be_pages_ecom_order.html">ORD.1850</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">Processing</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell">
                                                <a href="be_pages_ecom_customer.html">Andrea Gardner</a>
                                            </td>
                                            <td class="text-right">
                                                <span class="text-black">$130</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="font-w600" href="be_pages_ecom_order.html">ORD.1849</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-danger">Canceled</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell">
                                                <a href="be_pages_ecom_customer.html">Danielle Jones</a>
                                            </td>
                                            <td class="text-right">
                                                <span class="text-black">$132</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="font-w600" href="be_pages_ecom_order.html">ORD.1848</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">Processing</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell">
                                                <a href="be_pages_ecom_customer.html">Jack Greene</a>
                                            </td>
                                            <td class="text-right">
                                                <span class="text-black">$534</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="font-w600" href="be_pages_ecom_order.html">ORD.1847</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">Processing</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell">
                                                <a href="be_pages_ecom_customer.html">Laura Carr</a>
                                            </td>
                                            <td class="text-right">
                                                <span class="text-black">$968</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="block block-rounded">
                            <div class="block-header">
                                <h3 class="block-title">
                                    Pengeluaran <small>Terbaru</small>
                                </h3>
                            </div>
                            <div class="block-content">
                                <table class="table table-borderless table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 100px;">ID</th>
                                            <th>Status</th>
                                            <th class="d-none d-sm-table-cell">Customer</th>
                                            <th class="text-right">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a class="font-w600" href="be_pages_ecom_order.html">ORD.1851</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">Processing</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell">
                                                <a href="be_pages_ecom_customer.html">Jose Mills</a>
                                            </td>
                                            <td class="text-right">
                                                <span class="text-black">$443</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="font-w600" href="be_pages_ecom_order.html">ORD.1850</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">Processing</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell">
                                                <a href="be_pages_ecom_customer.html">Andrea Gardner</a>
                                            </td>
                                            <td class="text-right">
                                                <span class="text-black">$130</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="font-w600" href="be_pages_ecom_order.html">ORD.1849</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-danger">Canceled</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell">
                                                <a href="be_pages_ecom_customer.html">Danielle Jones</a>
                                            </td>
                                            <td class="text-right">
                                                <span class="text-black">$132</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="font-w600" href="be_pages_ecom_order.html">ORD.1848</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">Processing</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell">
                                                <a href="be_pages_ecom_customer.html">Jack Greene</a>
                                            </td>
                                            <td class="text-right">
                                                <span class="text-black">$534</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="font-w600" href="be_pages_ecom_order.html">ORD.1847</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">Processing</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell">
                                                <a href="be_pages_ecom_customer.html">Laura Carr</a>
                                            </td>
                                            <td class="text-right">
                                                <span class="text-black">$968</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END Latest Orders -->
                </div>

                <div class="row gutters-tiny">
                    <div class="col-6">
                        <div class="block">
                            <div class="block-header">
                                <h3 class="block-title">
                                    Kasus <small>Bulan ini</small>
                                </h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="pull-all">
                                    <!-- Lines Chart Container -->
                                    <canvas class="js-chartjs-dashboard-lines"></canvas>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="row items-push">
                                    <div class="col-6 text-center">
                                        <div class="font-size-sm font-w600 text-uppercase text-muted">Kasus Baru <br>Bulan Ini</div>
                                        <div class="font-size-h4 font-w600">720</div>
                                        <div class="font-w600 text-success">
                                            <i class="fa fa-caret-up"></i> +16%
                                        </div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="font-size-sm font-w600 text-uppercase text-muted">Rata Rata <br>Setiap Bulan</div>
                                        <div class="font-size-h4 font-w600">24.3</div>
                                        <div class="font-w600 text-success">
                                            <i class="fa fa-caret-up"></i> +9%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="block">
                            <div class="block-header">
                                <h3 class="block-title">
                                    Pasien Baru <small>Bulan ini</small>
                                </h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="pull-all">
                                    <!-- Lines Chart Container -->
                                    <canvas class="js-chartjs-dashboard-lines2"></canvas>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="row items-push">
                                    <div class="col-6 text-center">
                                        <div class="font-size-sm font-w600 text-uppercase text-muted">Kasus Baru <br>Bulan Ini</div>
                                        <div class="font-size-h4 font-w600">720</div>
                                        <div class="font-w600 text-success">
                                            <i class="fa fa-caret-up"></i> +16%
                                        </div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="font-size-sm font-w600 text-uppercase text-muted">Rata Rata <br>Setiap Bulan</div>
                                        <div class="font-size-h4 font-w600">24.3</div>
                                        <div class="font-w600 text-success">
                                            <i class="fa fa-caret-up"></i> +9%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gutters-tiny">
                    <div class="col-12">
                        <div class="block">
                            <div class="block-header">
                                <h3 class="block-title">Pemasukan & Pengeluaran</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                        <i class="si si-refresh"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content block-content-full text-center">
                                <!-- Bars Chart Container -->
                                <canvas class="js-chartjs-bars"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gutters-tiny">
                     <div class="col-xl-6">
                            <!-- Pie Chart -->
                            <div class="block">
                                <div class="block-header ">
                                    <h3 class="block-title">Distribusi Kasus</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content block-content-full text-center">
                                    <!-- Pie Chart Container -->
                                    <canvas class="js-chartjs-pie"></canvas>
                                </div>
                            </div>
                            <!-- END Pie Chart -->
                        </div>
                        <div class="col-xl-6">
                            <!-- Donut Chart -->
                            <div class="block">
                                <div class="block-header">
                                    <h3 class="block-title">Distribusi Pemasukan</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content block-content-full text-center">
                                    <!-- Donut Chart Container -->
                                    <canvas class="js-chartjs-donut"></canvas>
                                </div>
                            </div>
                            <!-- END Donut Chart -->
                        </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection

@section('js')
<script src="assets/js/pages/be_comp_charts.js"></script>
<script>
    jQuery(function () {
                // Init page helpers (Easy Pie Chart plugin)
                Codebase.helpers('easy-pie-chart');
            });
        </script>

        <script src="assets/js/pages/be_pages_dashboard.js"></script>
        @endsection