@extends('keuangan.layouts.main')

@section('title')
PJK {{$utang->nomor_pjk}} - Keuangan
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
            <h3 class="block-title">PJK {{$utang->nomor_pjk}}</h3>
            <div class="block-options">
                <!-- Print Page functionality is initialized in Codebase() -> uiHelperPrint() -->
                <button type="button" class="btn btn-sm btn-alt-primary" onclick="printContent('print-content')" data-toggle="tooltip" title="Print Invoice">
                    <i class="si si-printer"></i>
                </button>
                @if (($utang->total - $utang->total_paid)>0)
                <a href="{{url('keuangan/pjk')}}/edit/{{$utang->id}}" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Transaksi">
                    <i class="fa fa-edit"></i>
                </a>
                @endif
                <button class="btn btn-sm btn-alt-danger remove" data-pk="{{$utang->id}}" data-toggle="tooltip" title="Delete Transaksi">
                    <i class="fa fa-trash"></i>
                </button>
                <button type="button" class="btn btn-sm btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
            </div>
        </div>
        <div class="block-content">
            <!-- Invoice Info -->
            <div class="row">
                <div class="col-4">
                    <label>Nomor PJK</label>
                    <p class="h5">{{$utang->nomor_pjk}}</p>
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal PJK</label>
                    <p class="h5">{{indonesian_date($utang->tanggal_transaksi)}}</p>
                </div>
                <div class="col-4" id="input-perusahaan-container">
                    <label>Rekanan</label>
                    <p class="h5">{{$utang->perusahaan->nama}}</p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-4">
                    <label for="example-datepicker1">Mengenai</label>
                    <p class="h5">{{$utang->judul}}</p>
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Akun</label>
                    <p class="h5">{{$utang->akun->name}}</p>
                </div>
                <!-- <div class="col-4">
                    <label for="example-datepicker1">Penerima Utang</label>
                    <p class="h5">{{$utang->penerima}}</p>
                </div> -->
            </div>
            <br>
            <div class="row">
                <div class="col-4">
                    <label for="example-datepicker1">Nomor SPK/KTR</label>
                    <p class="h5">{{$utang->no_spkktr}}</p>
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal SPK/KTR</label>
                    <p class="h5">{{!empty($utang->tanggal_spkktr) ? indonesian_date($utang->tanggal_spkktr) : '-'}}</p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-4">
                    <label for="example-datepicker1">Nomor Sprin</label>
                    <p class="h5">{{$utang->no_sprin}}</p>
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal Sprin</label>
                    <p class="h5">{{!empty($utang->tanggal_sprin) ? indonesian_date($utang->tanggal_sprin) : '-'}}</p>
                </div>
            </div>
            <br>
            @if(!empty($utang->no_po))
            <div class="row">
                <div class="col-4">
                    <label for="example-datepicker1">Nomor PO</label>
                    <p class="h5 mb-0">{{$utang->no_po ?? '-'}}</p>
                    @if(!empty($utang->po_id))
                    <a href="{{url('keuangan/po/')}}/{{$utang->po_id}}" target="_blank"><i class="fa fa-paper-plane"></i> Lihat PO</a>
                    @endif
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal PO</label>
                    <p class="h5">{{!empty($utang->tanggal_po) ? indonesian_date($utang->tanggal_po) : '-'}}</p>
                </div>
            </div>
            <br>
            @endif
            <div class="row">
                <div class="col-4">
                    <label for="example-datepicker1">Nomor Faktur</label>
                    <p class="h5">{{$utang->no_faktur}}</p>
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal Faktur</label>
                    <p class="h5">{{!empty($utang->tanggal_faktur) ? indonesian_date($utang->tanggal_faktur) : '-'}}</p>
                </div>
            </div>
            <br>
            <div class="row items-push js-gallery img-fluid-100">
                <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
                    <label for="example-datepicker1">Gambar Faktur</label>
                    @if(!empty($utang->photo_faktur))
                    <a class="img-link img-link-zoom-in img-thumb img-lightbox" href="{{url($utang->photo_faktur)}}">
                        <img class="img-fluid" src="{{url($utang->photo_faktur)}}" alt="">
                    </a>
                    @else
                    <p class="h5">Belum memiliki gambar faktur</p>
                    @endif
                </div>
                <div class="col-12">
                    <hr>                
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
            @if (empty($utang->no_spp))
            <div class="row">
                <div class="col-md-12" style="float: right;">
                    <a class="btn btn-primary btn-fill pull-right" href="{{url('keuangan/spp/baru?utang_id='.$utang->id)}}">Buat SPP</a>
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
    @include('keuangan.pjk.components.single-js')
    {{--<script src="{{asset('js/keuangan/utang/single.js')}}"></script>--}}
    <script type="text/javascript">
        $('#preview-gambar-faktur').on('click', function(){
            $('#modal-preview-gambar-faktur').modal('show');
        });
    </script>
    @endsection
