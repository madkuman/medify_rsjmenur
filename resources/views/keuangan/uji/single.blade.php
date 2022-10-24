@extends('keuangan.layouts.main')

@section('title')
Uji 123456 - Keuangan
@endsection

@section('content')


<!-- Page Content -->
<div class="content p-0" id="print-content">
    <!-- Invoice -->
    <h2 class="content-heading d-print-none pt-0">
        Invoice Utang
    </h2>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">#DEB{{$utang->id}}</h3>
            <div class="block-options">
                <!-- Print Page functionality is initialized in Codebase() -> uiHelperPrint() -->
                <button type="button" class="btn btn-sm btn-alt-primary" onclick="printContent('print-content')" data-toggle="tooltip" title="Print Invoice">
                    <i class="si si-printer"></i>
                </button>
                <a href="{{url('keuangan/utang')}}/edit/{{$utang->id}}" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Transaksi">
                    <i class="fa fa-edit"></i>
                </a>
                <button class="btn btn-sm btn-alt-danger remove" data-pk="{{$utang->id}}" data-toggle="tooltip" title="Delete Transaksi">
                    <i class="fa fa-trash"></i>
                </button>
                <button type="button" class="btn btn-sm btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
            </div>
        </div>
        <div class="block-content">
            <!-- Invoice Info -->
            <div class="row">
                <div class="col-12 text-center">
                    <p class="h4" style="margin-bottom:0">{{$utang->judul}}</p>
                </div>
            </div>
            <hr>
            <div class="row my-20">
                <!-- Company Info -->
                <div class="col-5">
                    <label>Pemberi</label>
                    <p class="h4">{{$utang->pemberi}}</p>
                </div>
                <div class="col-5">
                    <label>Penerima</label>
                    <p class="h4">{{$utang->penerima}}</p>
                </div>
                <!-- END Company Info -->
                <div class="col-2 text-right">
                    <address>
                        {{date('d F Y', strtotime($utang->tanggal_transaksi))}}
                    </address>
                </div>
            </div>
            <!-- END Invoice Info -->

            <!-- Table -->
            <div class="table-responsive push">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;"></th>
                            <th>Deskripsi</th>
                            <th class="text-center" style="width: 90px;">Jumlah</th>
                            <th class="text-right" style="width: 120px;">Harga</th>
                            <th class="text-right" style="width: 90px;">Diskon</th>
                            <th class="text-right" style="width: 120px;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 0 @endphp
                        @foreach($utang->detail as $item)
                        <tr>
                            <td class="text-center">{{++$count}}</td>
                            <td>
                                <p class="font-w600 mb-5">{{$item->deskripsi}}</p>
                                <div class="text-muted">{{$item->keterangan}}</div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-pill badge-primary">{{$item->jumlah}}</span>
                            </td>
                            <td class="text-right">Rp {{number_format($item->harga,0)}}</td>
                            <td class="text-center">
                                {{$item->diskon}} %
                            </td>
                            <td class="text-right">Rp {{number_format($item->subtotal)}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" class="font-w600 text-right">Subtotal</td>
                            <td class="text-right">Rp {{number_format($utang->jumlah)}}</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="font-w600 text-right">Diskon</td>
                            <td class="text-right">Rp {{number_format($utang->diskon)}}</td>
                        </tr>
                        <tr class="table-warning">
                            <td colspan="5" class="font-w700 text-uppercase text-right">Total</td>
                            <td class="font-w700 text-right">Rp {{number_format($utang->total)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END Table -->
            <!-- Table -->
            <div class="table-responsive push">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="8">Histori Pembayaran</th>
                        </tr>
                        <tr>
                            <th class="text-center" style="width: 60px;"></th>
                            <th>Deskripsi</th>
                            <th class="text-center" style="width: 90px;">Jumlah</th>
                            <th class="text-right" style="width: 120px;">Harga</th>
                            <th class="text-right" style="width: 90px;">Diskon</th>
                            <th class="text-right" style="width: 120px;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 0; $curr_date = '00/00/0000'; @endphp
                        
                        @foreach($utang->pengeluaranDetail as $item)
                        @if (date('d F Y', strtotime($curr_date)) != date('d F Y', strtotime($item->created_at)))
                        <tr>
                            <td colspan="7" class="text-center">
                            {{date('d F Y', strtotime($item->created_at))}}
                            </td>
                        </tr>
                        @php $curr_date = $item->created_at; @endphp
                        @endif
                        <tr>
                            <td class="text-center">{{++$count}}</td>
                            <td>
                                <p class="font-w600 mb-5">{{$item->layanan_string}}</p>
                                <div class="text-muted">{{$item->keterangan}}</div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-pill badge-primary">{{$item->jumlah}}</span>
                            </td>
                            <td class="text-right">Rp {{number_format($item->harga,0)}}</td>
                            <td class="text-center">
                                {{$item->diskon}} %
                            </td>
                            <td class="text-right">Rp {{number_format($item->subtotal)}}</td>
                        </tr>
                        @endforeach
                        <tr class="table-warning">
                            <td colspan="5" class="font-w700 text-uppercase text-right">Terbayar</td>
                            <td class="font-w700 text-right" id="total_paid">Rp {{number_format($utang->total_paid)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END Table -->
            @if (($utang->total - $utang->total_paid)>0)
            <div class="row">
                <div class="col-md-12" style="float: right;">
                    <button class="btn btn-primary btn-fill pull-right" id="submit">Bayar utang</button>
                </div>
            </div>
            @endif
            <!-- Footer -->
            <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>
            <!-- END Footer -->
        </div>
    </div>
    <!-- END Invoice -->
</div>
<!-- modal bayar -->
<div id="confirmPayment" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed">
                <div class="block-header bg-primary">
                    <h5 class="block-title">Masukkan Jumlah Pembayaran</h5>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                    </div>
                </div>
                <div class="block-content">
                    
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">Belum Terbayar</h5>
                        </div>
                        <div class="col-md-1">
                        <h5 style="margin-bottom:0">Rp</h5>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="d-none" id="bill" value="{{$utang->total - $utang->total_paid}}">
                            <h5 style="margin-bottom:0">{{number_format($utang->total - $utang->total_paid)}}</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group align-items-center">
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">Pembayaran</h5>
                        </div>
                        <div class="col-md-1">
                        <h5 style="margin-bottom:0">Rp</h5>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control"  id="input-paid" name="example-nf-password" placeholder="Masukkan Pembayaran..">
                            <!-- <input type="text" class="d-none" id="input-paid">  
                            <a href="#" class="input-paid h5" data-type="text" data-placeholder="Masukkan Pembayaran.."></a> -->
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">Akun Rekening</h5>
                        </div>
                        <div class="col-md-7">
                        <select class="js-select2 form-control" id="akun" name="akun" style="width: 100%;" data-placeholder="Pilih Akun Rekening">
                        </select>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class=" col-md-5 font-w700" style="width:50%; margin-bottom:2rem;">
                    <input type="text" class="d-none" id="id_utang" value="{{$utang->id}}">
                    <button class="btn btn-primary btn-hero" disabled id="buttonSubmit"><i class="fa fa-check"></i> Terima Pembayaran</button>
                    <button class="btn btn-alt-primary btn-hero" style="display: none; width:100%" id="buttonLoading">
                        <i class="fa fa-asterisk fa-spin"></i> Loading
                    </button>
                </div>
            </div>
        </div>
    </div>        
</div>

<!-- END Page Content -->
@endsection

@section('js')
<script src="{{asset('js/keuangan/utang/single.js')}}"></script>
@endsection
