@extends('keuangan.layouts.main')

@section('title')
Penerimaan #{{$paket->id}} - Keuangan
@endsection

@section('content')


<!-- Page Content -->
<div class="content p-0" id="print-content">
    <!-- Invoice -->
    <h2 class="content-heading d-print-none pt-0">
        Invoice Paket Penerimaan
    </h2>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">#INC{{$paket->id}}</h3>
            </div>
            <div class="block-content">
                <!-- Invoice Info -->
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="h4" style="margin-bottom:0">{{$paket->judul}}</p>
                    </div>
                </div>
                <hr>
                <div class="row my-20">
                    <!-- Company Info -->
                    <div class="col-5">
                    </div>
                    <div class="col-5">
                        <label>Penanggung Jawab Pembayaran</label>
                        <p class="h4">{{$paket->detail[0]->piutang_pivot->piutang->pihak_ketiga}}</p>
                    </div>
                    <!-- END Company Info -->
                    <div class="col-2 text-right">
                        <address>
                            {{date('d F Y', strtotime($paket->tanggal_transaksi))}}
                        </address>
                    </div>
                </div>
                <!-- END Invoice Info -->
                <!-- Table -->
                <div class="table-responsive push">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px;">No. </th>
                                <th class="text-center" style="width: 80px;">Kategori</th>
                                <th>Judul</th>
                                <th class="text-center" style="width: 120px;">Total</th>
                                <th class="text-center" >Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $count = 0 @endphp
                            @foreach($paket->detail as $i => $det)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$det->piutang_pivot->penagihan_bpjs->kategori_bpjs->name}}</td>
                                <td>{{$det->judul}}</td>
                                <td>Rp {{number_format($det->total)}}</td>
                                <td><a href="{{url()->current()}}/pemasukan/{{$det->id}}" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Detail">&nbsp;<i class="fa fa-search-plus"></i></a>&nbsp
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- END Table -->
            </div>
        </div>
        <!-- END Invoice -->

    </div>

    <!-- END Page Content -->
    @endsection

    @section('js')
    <script src="{{asset('js/keuangan/pemasukan/singlev1.1.js')}}"></script>
    @endsection
