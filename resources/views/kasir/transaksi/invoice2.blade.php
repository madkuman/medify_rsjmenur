@extends('kasir.layouts.main')

@section('title')
Transaksi#{{$tagihan->id}} - {{$kasir->nama}} - Kasir
@endsection


@section('content')


<!-- Page Content -->
<div>
    <!-- Invoice -->
    <div class="block" id="print-content">
        <div class="block-header block-header-default">
            <h3 class="block-title">Tagihan #{{$tagihan->id}}</h3>
            @if($total >= $tagihan->total_bill)
            <div class="block-options">
                <a href="{{url()->current()}}/print" target="_blank" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Print Invoice Pasien">
                    <i class="si si-printer"></i>
                </a>
                <a href="{{url()->current()}}/print-kwitansi" target="_blank" class="btn btn-sm btn-alt-info" data-toggle="tooltip" title="Print Invoice">
                    <i class="si si-printer"></i>
                </a>
                <a href="{{url('kasir/'.$tagihan->kasir_id.'/transaksi/edit/'.$tagihan->id)}}" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Transaksi">
                    <i class="fa fa-edit"></i>
                </a>
                <button class="btn btn-sm btn-alt-danger remove" data-pk="{{$tagihan->id}}" data-toggle="tooltip" title="Delete Transaksi">
                    <i class="fa fa-trash"></i>
                </button>
                <button type="button" class="btn btn-sm btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
            </div>
            @else
            <div class="block-options">
                <!-- Print Page functionality is initialized in Codebase() -> uiHelperPrint() -->
                <a href="{{url()->current()}}/print" style="display: none" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Print Invoice">
                    <i class="si si-printer"></i>
                </a>
                <a href="{{url()->current()}}/print-kwitansi" style="display: none" target="_blank" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Print Invoice">
                    <i class="si si-printer"></i>
                </a>
                <a href="{{url('kasir/'.$tagihan->kasir_id.'/transaksi/edit/'.$tagihan->id)}}" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Transaksi">
                    <i class="fa fa-edit"></i>
                </a>
                <button class="btn btn-sm btn-alt-danger remove" data-pk="{{$tagihan->id}}" data-toggle="tooltip" title="Delete Transaksi">
                    <i class="fa fa-trash"></i>
                </button>
                <button type="button" class="btn btn-sm btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
            </div>
            @endif
        </div>
        <hr>
        <div class="block-content">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="h4" style="margin-bottom:0">{{$tagihan->judul}}</p>
                </div>
            </div>
            <hr>
            <!-- Invoice Info -->
            <div class="row">
                <!-- Company Info -->
                <div class="col-6">
                    Identitas Pasien :<br><br>
                    <input type="text" class="d-none" id="pasien" value="{{$tagihan->pasien_id}}">
                    <p class="font-w700 h4" style="margin-bottom:0">{{$tagihan->pasien->name}} </p>
                    <address>
                        {{$tagihan->pasien->address}}<br>
                        {{$tagihan->pasien->phone}}
                    </address>
                </div> 
                <!-- END Company Info -->
                <div class="col-6 text-right">
                    @if($total >= $tagihan->total_bill)
                    <input type="text" class="d-none" id="total_paid" value="{{$tagihan->total_paid}}">
                    <div class="pull-right">
                        {{date('d F Y', strtotime($tagihan->paid_date))}}
                        <br>
                        <img src="{{url('assets/img/paid_stamp.png')}}" style="margin-bottom: 20px;margin-top: 20px; width: 100px;">
                    </div>
                    @else
                    <div class="pull-right">
                        <p id="paid-date"></p>
                        <img id="paid_img" src="{{url('assets/img/paid_stamp.png')}}" style="display:none;margin-bottom:20px;margin-top:20px;width:100px;">
                        <button style="margin-bottom: 20px;margin-top:20px" class="btn btn-alt-primary btn-fill" id="submitdiskon">Diskon Semua Tagihan</button>
                    </div>
                    @endif
                </div>
            </div>
            <!-- END Invoice Info -->

            <!-- Table -->
            <div class="table-responsive push">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th class="text-center" style="width: 30%;">Uraian</th>
                            <th class="text-center" style="width: 20%;">Departemen</th>
                            <th class="text-center" style="width: 15%;">Harga Satuan</th>
                            <th class="text-center" style="width: 5%;">Jumlah</th>
                            <th class="text-center" style="width: 5%;">Diskon</th>
                            <th class="text-center" style="width: 20%;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 0; $curr_date = '00/00/0000'; @endphp
                        @foreach($tagihan->detail as $item)
                        @if (date('d F Y', strtotime($curr_date)) != date('d F Y', strtotime($item->created_at)))
                        <tr class="table-warning">
                            <td colspan="7" class="text-center">
                                {{date('d F Y', strtotime($item->created_at))}}
                            </td>
                        </tr>
                        @php $curr_date = $item->created_at; @endphp
                        @endif
                        <tr>
                            <td class="text-center">{{++$count}}</td>
                            <td>
                                {{$item->desc}}
                            </td>
                            <td class="text-center">
                                @if (!empty($item->lokasi_detail->nama))
                                {{$item->lokasi_detail->nama}}
                                @elseif (!empty($item->tarif_id))
                                {{$item->tarif->departemen->name}}
                                @else
                                -
                                @endif
                            </td>
                            <td class="text-right">Rp {{number_format($item->unit_price,0)}}</td>
                            <td class="text-center">
                                <span class="badge badge-pill badge-primary">{{$item->qty}}</span>
                            </td>
                            <td class="text-center">
                                {{$item->diskon}} %
                            </td>
                            <td class="text-right">Rp {{number_format($item->subtotal)}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="6" class="font-w700 text-uppercase text-right">Subtotal</td>
                            <td class="text-right">
                               Rp {{number_format($tagihan->subtotal)}}
                           </td>
                       </tr>
                       <tr>
                        <td colspan="6" class="font-w700 text-uppercase text-right">Diskon</td>
                        <td class="text-right" id="diskon">
                            Rp {{number_format($tagihan->diskon)}}
                        </td>
                    </tr>
                    <tr class="table-warning">
                        <input type="text" class="d-none" id="bill" value="{{$tagihan->total_bill - $total}}">
                        <td colspan="6" class="font-w700 text-uppercase text-right">Total</td>
                        <td class="text-right font-w700">
                            Rp {{number_format($tagihan->total_bill)}}
                        </td>
                    </tr>
                    @if($total >= $tagihan->total_bill)
                    <tr>
                        <td colspan="6" class="font-w700 text-uppercase text-right">Pembayaran Tunai</td>
                        <td class="text-right">Rp {{number_format($pemasukan)}}</td>
                    </tr>
                    @if($piutang>0)
                    <tr>
                        <td colspan="6" class="font-w700 text-uppercase text-right">Melalui Piutang</td>
                        <td class="text-right">Rp {{number_format($piutang)}}</td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="6" class="font-w700 text-uppercase text-right">Kembalian</td>
                        <td class="text-right">Rp {{number_format($tagihan->total_paid-$tagihan->total_bill)}}</td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="6" class="font-w700 text-uppercase text-right">Terbayar Tunai</td>
                        <td class="text-right" id="total_paid">Rp {{number_format($pemasukan)}}</td>
                    </tr>
                    @if($piutang>0)
                    <tr>
                        <td colspan="6" class="font-w700 text-uppercase text-right">Melalui Piutang</td>
                        <td class="text-right">Rp {{number_format($piutang)}}</td>
                    </tr>
                    @endif
                    <tr style="display:none" id="total_paid-par">
                        <td colspan="6" class="font-w700 text-uppercase text-right">Pembayaran Tunai</td>
                        <td class="text-right " id="total_paid"></td>
                    </tr>
                    <tr style="display:none" id="kembalian-par">
                        <td colspan="6" class="font-w700 text-uppercase text-right">Kembalian</td>
                        <td class="text-right" id="kembalian"></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        @if($total < $tagihan->total_bill)
        <div class="row">
            <div class="col-md-12" style="float: right;">
                <button class="btn btn-primary btn-fill pull-right" id="submit">Terima Pembayaran</button>
            </div>
        </div>
        @endif
        <br>
        <br>
        <hr>
        <!-- END Table -->

        <!-- Footer -->
        <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>
        <!-- END Footer -->
    </div>
</div>
<!-- END Invoice -->
<!-- Table -->
@if($total>0)
<div class="block block-content">
    <div class="table-responsive push">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 60px;"></th>
                    <th>Layanan</th>
                    <th class="text-center" style="width: 90px;">Tipe</th>
                    <th class="text-center" style="width: 90px;">Kelas</th>
                    <th class="text-center" style="width: 90px;">Jumlah</th>
                    <th class="text-right" style="width: 120px;">Harga</th>
                    <th class="text-right" style="width: 90px;">Diskon</th>
                    <th class="text-right" style="width: 120px;">Subtotal</th>
                </tr>
                @if($pemasukan>0)
                <tr class="table-info">
                    <th class="text-center" colspan="8">Histori Pembayaran Tunai</th>
                </tr>
                @endif
            </thead>
            @php $count = 0; @endphp
            @if($pemasukan>0)
            <tbody>
                @php $curr_date = '00/00/0000';@endphp

                @foreach($tagihan->pemasukanDetail as $item)
                @if (date('d F Y', strtotime($curr_date)) != date('d F Y', strtotime($item->created_at)))
                <tr class="table-warning">
                    <td colspan="8" class="text-center">
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
                    <td class="text-center">{{$item->tipe->name}}</td>
                    <td class="text-center">{{$item->tarif_kelas}}</td>
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
            </tbody>
            @endif
            @if($piutang>0)
            <thead>
                <tr class="table-info">
                    <th class="text-center" colspan="8">Histori Pembayaran Melalui Piutang</th>
                </tr>
            </thead>
            <tbody>
                @php $curr_date = '00/00/0000';@endphp

                @foreach($tagihan->piutangDetail as $item)
                @if (date('d F Y', strtotime($curr_date)) != date('d F Y', strtotime($item->created_at)))
                <tr class="table-warning">
                    <td colspan="8" class="text-center">
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
                    <td class="text-center">{{$item->tipe->name}}</td>
                    <td class="text-center">{{$item->tarif_kelas}}</td>
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
            </tbody>
            @endif
            <tbody>
                <tr class="table-warning">
                    <td colspan="7" class="font-w700 text-uppercase text-right">Terbayar</td>
                    <td class="font-w700 text-right" id="total_paid">Rp {{number_format($total)}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @endif
    <!-- END Table -->
</div>

@if(!empty($tagihan->kasus->id))
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">KOLABORATOR KASUS</h3>
    </div>
    <div class="block-content block-content-full">
        <div class="row">
            <div class="col-6">
                <div class="row"> 
                    @if(!empty($tagihan->kasus->admin->user->name))
                    <div class="col-2">
                        <h6>DPJP</h6>
                    </div>
                    <div class="col-4">
                        - {{$tagihan->kasus->admin->user->name}}
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-2">
                        <h6>Anggota</h6>
                    </div>
                    <div class="col-4">
                        @foreach($tagihan->kasus->kolaboratorExceptAdmin as $kolaborator)
                        - {{$kolaborator->user->name}}<br>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-6">
                        <h6>HISTORI TEMPAT PELAYANAN</h6>
                        <ul>
                            @foreach($tagihan->kasus->lokasiAll as $lokasi)
                            <li>{{$lokasi->lokasi->nama}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
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
                    @if($tagihan->is_dp != 1)
                    <div>
                        <input type="checkbox" id="deposit" name="pakai_deposit" value="off"> <label>Gunakan Deposit</label>
                    </div>
                    <hr>
                    @endif
                    <div>
                        <h6>Tagihan Kepada Pasien :</h6>
                        <h5 style="margin-bottom:0">{{$tagihan->pasien->name}}</h5>
                        <address>
                            {{$tagihan->pasien->address}}<br>
                            {{$tagihan->pasien->phone}}<br>
                        </address>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">Total</h5>
                        </div>
                        <div class="col-md-1">
                            <h5 style="margin-bottom:0">Rp</h5>
                        </div>
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0" id="harus_bayar">   {{number_format($tagihan->total_bill - $total)}}</h5>
                        </div>
                    </div>
                    <hr>
                    @if($tagihan->is_dp != 1)
                    <div class="row" id="jumlah_deposit">
                        <input type="text" class="d-none" value="{{isset($deposit) ? $deposit->jumlah : 0}}" id="uang_deposit">
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">Deposit</h5>
                        </div>
                        <div class="col-md-1">
                            <h5 style="margin-bottom:0">Rp</h5>
                        </div>
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">   {{isset($deposit) ? number_format($deposit->jumlah) : 0 }}</h5>
                        </div>
                    </div>
                    <hr>
                    @endif
                    <div class="row form-group align-items-center">
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">Pembayaran</h5>
                        </div>
                        <div class="col-md-1">
                            <h5 style="margin-bottom:0">Rp</h5>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control"  id="input-paid" name="example-nf-password" placeholder="Masukkan Pembayaran..">
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group align-items-center" id="akun_par" style="display: none">
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">Akun Pembayaran</h5>
                        </div>
                        <div class="col-md-7">
                            <select class="js-select2 form-control" data-placeholder="Pilih Akun" disabled id="akun" name="akun" style="width: 100%;">
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group align-items-center">
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">Piutang</h5>
                        </div>
                        <div class="col-md-1">
                            <h5 style="margin-bottom:0">Rp   </h5>
                        </div>
                        <div class="col-md-6">
                            <h5 style="margin-bottom:0" id="paid-piutang">0</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group align-items-center" id="pasien_pembayaran_par" style="display: none">
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">Penanggung Jawab Piutang</h5>
                        </div>
                        <div class="col-md-7">
                            <select class="js-select2 form-control" data-placeholder="Pilih Perusahaan" disabled id="pasien_pembayaran" name="pasien_pembayaran" style="width: 100%;">
                            </select>
                            <input type="text" class="d-none form-control" id="perusahaan" name="perusahaan">
                            <input type="text" class="d-none form-control" id="penanggungjawab" name="perusahaan">
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group align-items-center" id="pasien_pembayaran_par">
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">Penanggung Jawab Pembayaran</h5>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control"  id="pj-pembayaran" name="pj-pembayaran" value="{{$tagihan->pasien->name}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class=" col-md-5 font-w700" style="width:50%; margin-bottom:2rem;">
                    <input type="text" class="d-none" id="id_tagihan" value="{{$tagihan->id}}">
                    <input type="text" class="d-none" value="{{$tagihan->is_dp}}" id="dp">
                    <input type="text" class="d-none" id="total_paid">
                    <button class="btn btn-primary btn-hero" id="buttonSubmit" disabled><i class="fa fa-check"></i> Terima Pembayaran</button>
                    <button class="btn btn-alt-primary btn-hero" style="display: none; width:100%" id="buttonLoading">
                        <i class="fa fa-asterisk fa-spin"></i> Loading
                    </button>
                </div>
            </div>
        </div>
    </div>        
</div>
<!-- modal diskon -->
<div id="inputDiskon" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed">
                <div class="block-header bg-primary">
                    <h5 class="block-title">Masukkan Persentase Diskon</h5>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row form-group justify-content-md-center align-items-center">
                        <div class="col-md-5" style="padding-right:0">
                            <input type="number" class="form-control"  id="input-diskon" name="example-nf-password" placeholder="Masukkan Diskon..">
                        </div>
                        <div class="col-md-1">
                            <h5 style="margin-bottom:0">%</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class=" col-md-5 font-w700 text-center" style="margin-bottom:2rem;">
                    <input type="text" class="d-none" id="id_tagihan" value="{{$tagihan->id}}">
                    <input type="text" class="d-none" id="total_paid">
                    <button class="btn btn-primary btn-hero" id="buttonSubmitDiskon" disabled>
                        <i class="fa fa-check"></i> Submit
                    </button>
                    <button class="btn btn-alt-primary btn-hero" style="display: none;" id="buttonLoadingDiskon">
                        <i class="fa fa-asterisk fa-spin"></i> Loading
                    </button>
                </div>
            </div>
        </div>
    </div>        
</div>
<!-- modal kembalian -->
<div id="modal-kembalian" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed">
                <div class="block-header bg-primary">
                    <h5 class="block-title">Kembalian</h5>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row justify-content-md-center align-items-center">
                        <div class="col-md-6 text-center">
                            <h3 id="text-kembalian"></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>


<!-- END Page Content -->
@endsection

@section('js')
<script src="{{asset('js/kasir/tagihan/single.js')}}"></script>
@endsection
