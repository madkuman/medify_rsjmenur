@extends('keuangan.layouts.main')

@section('title')
SPP {{$spp->no_spp}} - Keuangan
@endsection

@section('content')


<!-- Page Content -->
@include('keuangan.spp.components.pilih-ttd')
<div class="content p-0" id="print-content">
    <!-- Invoice -->
    <h2 class="content-heading d-print-none pt-0">
        Invoice SPP
    </h2>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">SPP {{$spp->no_spp}}</h3>
            <div class="block-options">
                <!-- Print Page functionality is initialized in Codebase() -> uiHelperPrint() -->
                {{--<button type="button" class="btn btn-sm btn-alt-primary" onclick="printContent('print-content')" data-toggle="tooltip" title="Print Invoice">
                    <i class="si si-printer"></i>
                </button>--}}
                <span class="print" data-toggle="modal" data-target="#print-spp" data-pk="{{$spp->id}}">
                    <a href="javascript:void(0)" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="Print Laporan SPP Struk">
                        <i class="fa fa-print"></i>
                    </a>
                </span>
                @if(count($spp->UJIDetail) == 0)
                <a href="{{url('keuangan/spp')}}/edit/{{$spp->id}}" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail SPP">
                    <i class="fa fa-edit"></i>
                </a>
                <button class="btn btn-sm btn-alt-danger remove" data-pk="{{$spp->id}}" data-toggle="tooltip" title="Delete SPP">
                    <i class="fa fa-trash"></i>
                </button>
                @endif
                <button type="button" class="btn btn-sm btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
            </div>
        </div>
        <div class="block-content">
            <!-- Invoice Info -->
            <div class="row">
                <div class="col-4">
                    <label>Nomor SPP</label>
                    <p class="h5">{{$spp->no_spp}}</p>
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal SPP</label>
                    <p class="h5">{{indonesian_date($spp->tanggal_spp)}}</p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-4" id="input-kategori-container">
                    <label>Kategori</label>
                    <p class="h5">{{$spp->kategori->name}}</p>
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tahun Anggaran</label>
                    <p class="h5">{{$spp->tahun_anggaran}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label>Nomor PJK</label>
                    <p class="h5">{{$spp->nomor_pjk}}</p>
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal PJK</label>
                    <p class="h5">{{indonesian_date($spp->tanggal_transaksi)}}</p>
                </div>
                <div class="col-4" id="input-perusahaan-container">
                    <label>Rekanan</label>
                    <p class="h5">{{$spp->perusahaan->nama}}</p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-4">
                    <label for="example-datepicker1">Mengenai</label>
                    <p class="h5">{{$spp->judul}}</p>
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Akun</label>
                    <p class="h5">{{$spp->akun->name}}</p>
                </div>
                <!-- <div class="col-4">
                    <label for="example-datepicker1">Penerima Utang</label>
                    <p class="h5">{{$spp->penerima}}</p>
                </div> -->
            </div>
            <br>
            <div class="row">
                <div class="col-4">
                    <label for="example-datepicker1">Nomor SPK/KTR</label>
                    <p class="h5">{{$spp->no_spkktr}}</p>
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal SPK/KTR</label>
                    <p class="h5">{{!empty($spp->tanggal_spkktr) ? indonesian_date($spp->tanggal_spkktr) : '-'}}</p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-4">
                    <label for="example-datepicker1">Nomor Sprin</label>
                    <p class="h5">{{$spp->no_sprin}}</p>
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal Sprin</label>
                    <p class="h5">{{!empty($spp->tanggal_sprin) ? indonesian_date($spp->tanggal_sprin) : '-'}}</p>
                </div>
            </div>
            <br>
            @if(!empty($spp->no_po))
            <div class="row">
                <div class="col-4">
                    <label for="example-datepicker1">Nomor PO</label>
                    <p class="h5 mb-0">{{$spp->no_po ?? '-'}}</p>
                    @if(!empty($spp->po_id))
                    <a href="{{url('keuangan/po/')}}/{{$spp->po_id}}" target="_blank"><i class="fa fa-paper-plane"></i> Lihat PO</a>
                    @endif
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal PO</label>
                    <p class="h5">{{!empty($spp->tanggal_po) ? indonesian_date($spp->tanggal_po) : '-'}}</p>
                </div>
            </div>
            <br>
            @endif
            <div class="row">
                <div class="col-4">
                    <label for="example-datepicker1">Nomor Faktur</label>
                    <p class="h5">{{$spp->no_faktur}}</p>
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal Faktur</label>
                    <p class="h5">{{!empty($spp->tanggal_faktur) ? indonesian_date($spp->tanggal_faktur) : '-'}}</p>
                </div>
            </div>
            <br>
            <div class="row items-push js-gallery img-fluid-100">
                <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
                    <label for="example-datepicker1">Gambar Faktur</label>
                    @if(!empty($spp->photo_faktur))
                    <a class="img-link img-link-zoom-in img-thumb img-lightbox" href="{{url($spp->photo_faktur)}}">
                        <img class="img-fluid" src="{{url($spp->photo_faktur)}}" alt="">
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
                        @foreach($spp->detail as $item)
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
                            <td class="text-right">Rp {{number_format($spp->jumlah)}}</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="font-w600 text-right">Diskon</td>
                            <td class="text-right">Rp {{number_format($spp->diskon)}}</td>
                        </tr>
                        <tr class="table-warning">
                            <td colspan="5" class="font-w700 text-uppercase text-right">Total</td>
                            <td class="font-w700 text-right">Rp {{number_format($spp->total)}}</td>
                        </tr>
                        <tr class="table-warning">
                            <td colspan="5" class="font-w700 text-uppercase text-right">Terbayar</td>
                            <td class="font-w700 text-right">Rp {{number_format($spp->total_paid)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END Table -->
            <!-- Table -->
            {{--<div class="table-responsive push">
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

                        @forelse($spp->pengeluaranDetail as $item)
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
                        @empty
                        @endforelse
                        <tr class="table-warning">
                            <td colspan="7" class="font-w700 text-uppercase text-right">Terbayar</td>
                            <td class="font-w700 text-right" id="total_paid">Rp {{number_format($spp->total_paid)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>--}}
            <!-- END Table -->
            @if (($spp->total - $spp->total_paid)>0)
            <div class="row">
                @if(count($spp->UJIDetail) == 0)
                <div class="col-md-12" style="float: right;">
                    <a class="btn btn-primary btn-fill pull-right" href="{{url('keuangan/uji/baru?spp_id='.$spp->id)}}">Buat UJI</a>
                </div>
                @else
                <div class="col-md-12" style="float: right;">
                    <a class="btn btn-primary btn-fill pull-right" href="{{url('keuangan/pengeluaran/edit')}}/{{$spp->UJIDetail[0]->id}}">Edit BK</a>
                </div>
                @endif
            </div>
            @endif
            <!-- Footer -->
            <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>
            <!-- END Footer -->
        </div>
    </div>
    <!-- END Invoice -->
</div>
<!-- END Page Content -->
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
                            <input type="text" class="d-none" id="bill" value="{{$spp->total - $spp->total_paid}}">
                            <h5 style="margin-bottom:0">{{number_format($spp->total - $spp->total_paid)}}</h5>
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
                        <input type="text" class="d-none" id="id_utang" value="{{$spp->id}}">
                        <button class="btn btn-primary btn-hero" disabled id="buttonSubmit"><i class="fa fa-check"></i> Terima Pembayaran</button>
                        <button class="btn btn-alt-primary btn-hero" style="display: none; width:100%" id="buttonLoading">
                            <i class="fa fa-asterisk fa-spin"></i> Loading
                        </button>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>

@endsection

@section('js')
{{--<script src="{{asset('js/keuangan/pengeluaran/spp/single.js')}}"></script>--}}
<script type="text/javascript">
    $('#preview-gambar-faktur').on('click', function(){
        $('#modal-preview-gambar-faktur').modal('show');
    });

    $(document).on('click', '.print', function(){
        var id = $(this).data("pk");
        $('#print-id').val(id);
    });

    $(document).on('click', '.remove', function(){
        var id = $(this).data("pk")     
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        type: "POST",
                        url: API_URL + "/keuangan/spp/edit",
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id : id,
                            delete : 1
                        },
                        success: function (data) {
                            callSwal(data.type,data.title,data.text,data.url);
                        },
                        error: function () {
                            callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                        }
                    })
                });
            }
        })
    });
</script>
@endsection
