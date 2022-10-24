@extends('kasir.layouts.main')

@section('title')
Dashboard {{$kasir->nama}} - Kasir
@endsection

@section('css')

@endsection
@section('content')
@include('kasir.transaksi.components.header')
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <div class="row invisible" data-toggle="appear">
        <!-- Row #1 -->
        <div class="col-4 col-xl-4">
            <a class="block block-link-pop text-right bg-primary" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="si si-bar-chart fa-3x text-primary-light d-none"></i>
                    </div>
                    <div class="font-size-h4 font-w600 text-white"><span data-toggle="countTo" data-speed="1000" data-to="{{$num_bayar}}"></span></div>
                    <div class="font-size-sm font-w600 text-uppercase text-white-op">Tagihan Terbayar</div>
                </div>
            </a>
        </div>
        <div class="col-4 col-xl-4">
            <a class="block block-link-pop text-right bg-earth" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="si si-trophy fa-3x text-earth-light d-none"></i>
                    </div>
                    <div class="font-size-h4 font-w600 text-white"><span data-toggle="countTo" data-speed="1000" data-to="{{$num_belum_bayar}}"></span></div>
                    <div class="font-size-sm font-w600 text-uppercase text-white-op">Tagihan Belum Terbayar</div>
                </div>
            </a>
        </div>
        <div class="col-4 col-xl-4">
            <a class="block block-link-pop text-right bg-elegance" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="si si-envelope-letter fa-3x text-elegance-light d-none"></i>
                    </div>
                    <div class="font-size-h4 font-w600 text-white">Rp <span data-toggle="countTo" data-speed="1000" data-to="{{$total}}"></span></div>
                    <div class="font-size-sm font-w600 text-uppercase text-white-op">Total Nilai Transaksi</div>
                </div>
            </a>
        </div>
        <!-- END Row #1 -->
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-default py-20">
                    <span><h4 class="mb-0">Tagihan Belum Terbayar</h4></span>
                </div>
                <div class="block-content py-20">
                    <table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="transaksiTable1">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">No. Tagihan  </th>
                                <th class="text-center" style="width: 20%;">Pasien  </th>
                                <th class="text-center" style="width: 20%;">Asal Layanan  </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tagihan_belum_bayar as $rownum =>$item)
                            <tr>
                                <th class="text-center" scope="row">{{$item->id}}</th>
                                <td class="text-left">
                                    {{$item->pasien->name}}<br>
                                    <span class="badge badge-pill badge-primary">No. RM : {{$item->pasien->no_rm}}</span>
                                </td>
                                <td class="text-center">
                                    {{$item->latest_lokasi->lokasi}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-default py-20">
                    <span><h4 class="mb-0">Tagihan Terbayar</h4></span>
                </div>
                <div class="block-content py-20">
                    <table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="transaksiTable2">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">No. Tagihan  </th>
                                <th class="text-center" style="width: 20%;">Pasien  </th>
                                <th class="text-center" style="width: 20%;">Asal Layanan  </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tagihan_bayar as $rownum =>$item)
                            <tr>
                                <th class="text-center" scope="row">{{$item->id}}</th>
                                <td class="text-left">
                                    {{$item->pasien->name}}<br>
                                    <span class="badge badge-pill badge-primary">No. RM : {{$item->pasien->no_rm}}</span>
                                </td>
                                <td class="text-center">
                                    {{$item->latest_lokasi->lokasi}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection

@section('js')
<script>
    $(document).ready(function() {
        var table1 = $('#transaksiTable1').DataTable({
            "paging":   false,
            "ordering": false,
            "searching": false
        }); 
        var table2 = $('#transaksiTable2').DataTable({
            "paging":   false,
            "ordering": false,
            "searching": false
        }); 
        table1.draw();
        table2.draw();
    } );
</script>


@endsection