@extends('layouts.main',['app' => "pasien"])

@section('title')
Transaksi#{{$tagihan->id}} - {{$kasir->nama}} - Kasir
@endsection

@section('sidebarcomponent')
@include('kasir.transaksi.components.sidebar')
@endsection

@section('content')
<div class="row page-title-container">  
    <div class="icon">  
        <i class="fa fa-exchange"></i>  
    </div>  
    <div class="title">  
        Rawat Inap<br><small>Permintaan Rawat Inap</small>
    </div>  
</div>  


<div class="card">
    <div class="card-header">
        <h5 class="title-bg">TAGIHAN 
            <span class="text-muted">#{{$tagihan->id}}</span>
        </h5>
    </div>

    <div class="card-body" ng-controller="paymentController" ng-cloak>
        <div class="patient-info">
            @if($tagihan->total_paid)
            <div class="pull-right">
                <img src="{{url('assets/img/paid_stamp.png')}}" style="margin-bottom: 20px;margin-top: 20px;width: 100px;">
            </div>
            @endif

            <h6>Tagihan Kepada Pasien :</h6>
            <h5>{{$tagihan->pasien->name}}</h5>
            <h5 class="text-muted"><small>{{$tagihan->pasien->address}}<br>{{$tagihan->pasien->phone}}</small></h5>
            Tanggal Tagihan : <i class="fa fa-calendar"></i> {{$tagihan->created_at}}
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Deskripsi</th>
                        <th>Jumlah</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1 @endphp
                    @foreach($tagihan->detail as $detail)
                    <tr>
                        <td class="text-center">{{$i++}}</td>
                        <td>{{$detail->desc}}</td>
                        <td>{{$detail->qty}}</td>
                        <td class="text-right">Rp {{number_format($detail->unit_price)}}</td>
                        <td class="text-right"><strong>Rp {{number_format($detail->subtotal)}}</strong></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="row">
            @if($tagihan->total_paid)
            <div class="col-md-7 text-center" style="padding-top: 20px">
                <small>Cetak bukti pembayaran</small>

                <div style="margin-top: 10px">
                    <button type="button"  class="btn btn-primary btn-fill" data-dismiss="modal">Print</button>
                </div>

            </div>
            @else
            <div class="col-md-7">
                &nbsp;
            </div>
            @endif

            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-5">
                        <h5 class="pull-right"><strong>Total</strong> </h5>
                    </div>
                    <div class="col-md-7" ng-init="total_tagihan = {{$tagihan->total_bill}}">
                        <h5><small>Rp </small>@{{total_tagihan | number:0}}</h5>
                    </div>
                </div>
                @if(!$tagihan->total_paid)
                <div class="row"  style="margin-bottom: 20px;">
                    <div class="col-md-5">
                        <h5 class="pull-right"><strong>Pembayaran</strong></h5>
                    </div>
                    <div class="col-md-7">
                        <input class="form-control" type="text" ng-model="total_bayar_fake" ng-blur="changePembayaran()" ng-focus="total_bayar_fake = total_bayar">
                        <input class="form-control" type="hidden" ng-model="total_bayar">
                    </div>
                </div>
                @else

                <div class="row">
                    <div class="col-md-5">
                        <h5 class="pull-right"><strong>Pembayaran</strong></h5>
                    </div>
                    <div class="col-md-7"  ng-init="total_bayar = {{$tagihan->total_paid}}">
                        <h5><small>Rp </small>@{{total_bayar | number:0}}</h5>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-5">
                        <h5 class="pull-right"><strong>Kembali</strong> </h5>
                    </div>
                    <div class="col-md-7" ng-init="total_kembali = total_bayar - total_tagihan">
                        <h5><small>Rp </small>@{{total_bayar - total_tagihan | number:0}}</h5>
                    </div>
                </div>

                @if(!$tagihan->total_paid)
                <div class="row">
                    <div class="col-md-9">
                        <button class="btn btn-primary btn-fill pull-right" data-toggle="modal" data-target="#confirmPayment" ng-disabled="total_bayar - total_tagihan < 0">Terima Pembayaran</button>
                    </div>
                </div>
                @endif

            </div>
            <hr>



            <div id="confirmPayment" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-body">
                            <h5>Apakah anda yakin untuk menerima pembayaran ini?</h5>
                            <hr>

                            <div class="patient-info">
                                <h6>Tagihan Kepada Pasien :</h6>
                                <h5>{{$tagihan->pasien->name}}</h5>
                                <h5 class="text-muted"><small>{{$tagihan->pasien->address}}<br>{{$tagihan->pasien->phone}}</small></h5>
                                Tanggal Tagihan : <i class="fa fa-calendar"></i> {{$tagihan->created_at}}
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <h5>Total</h5>
                                </div>
                                <div class="col-md-4" ng-init="total_tagihan = {{$tagihan->total_bill}}">
                                    <h5><small>Rp </small>@{{total_tagihan | number:0}}</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <h5><strong>Pembayaran</strong></h5>
                                </div>
                                <div class="col-md-4">
                                    <h5><strong><small>Rp </small>@{{total_bayar | number:0}}</strong></h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <h5>Kembali</h5>
                                </div>
                                <div class="col-md-4">
                                    <h5><small>Rp </small>@{{total_bayar - total_tagihan | number:0}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <form action="{{url('')}}/kasir/transaksi/payment" method="POST">
                                <button type="button"  class="btn btn-danger btn-simple" data-dismiss="modal">Batal</button>
                                {{csrf_field()}}
                                <input name="tagihan_id" value="{{$tagihan->id}}" type="hidden">
                                <input name="total_bayar" ng-model="total_bayar" style="display: none">
                                <button type="submit" class="btn btn-fill btn-primary">Terima Pembayaran</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>


            <div id="donePayment" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-body text-center">

                         <div class="icon icon-info">
                            <i class="material-icons" style="font-size: 200px">done</i>
                        </div>
                        <h5><strong>Pembayaran Sukses</strong>
                        </h5>
                        <small>Silahkan cetak bukti pembayaran melalui tombol dibawah ini</small>

                        <div class="modal-footer text-center" style="margin-top: 10px">
                            <button type="button"  class="btn btn-primary btn-fill" data-dismiss="modal">Print</button>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>


</div>






@endsection