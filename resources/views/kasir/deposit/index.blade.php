@extends('kasir.layouts.main')

@section('css')

@endsection

@section('title')
Deposit - {{$kasir->nama}} - Kasir
@endsection

@section('content')
@include('kasir.transaksi.components.header')
<!-- Page Content -->
<div class="content p-0" id="print-content">
    <!-- Invoice -->
    <div class="block">
        <div class="block-content">
            <!-- Invoice Info -->
            <a href="{{url('kasir')}}/{{$kasir->id}}/transaksi/dp-baru" class="btn btn-primary pull-right">Deposit Baru</a>
            <h4>Daftar Deposit Pasien</h4>
            <hr>

            <div class="table-full-width spinner-container" id=""> 
                <div class="spinner-back">
                    <table class="table table-striped table-hover table-pointer dataTable no-footer" id="histori-deposit"> 
                        <thead>
                            <tr class="header" ng-click="getCurrentPage()">
                                <th style="width:5%">No</th>
                                <th>Nama Pasien</th>
                                <th>Jumlah</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deposit as $item)
                            <tr>
                                <td class="py-10 px-10">{{$loop->iteration}}</td>
                                <td>{{$item->pasien->name ?? 'Pasien tidak ditemukan'}}</td>
                                <td>{{number_format($item->jumlah,0)}}</td>
                                <td>
                                    <a href="{{url('')}}/keuangan/deposit/single/{{$item->id}}" class="btn btn-primary btn-sm">Detail</a>
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
<script type="text/javascript" src="{{asset('assets\js\jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets\js\dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var oTable = $("#histori-deposit").DataTable({
        scrollX: true,
    });
</script>
@endsection
