@extends('keuangan.layouts.main')

@section('title')
PO {{$po->no_po}} - Keuangan
@endsection

@section('content')
@include('keuangan.po.components.pilih-ttd')

<!-- Page Content -->
<div class="content p-0" id="print-content">
    <!-- Invoice -->
    <h2 class="content-heading d-print-none pt-0">
        Invoice PO
    </h2>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">PO {{$po->no_po}}</h3>
            <div class="block-options">
                <!-- Print Page functionality is initialized in Codebase() -> uiHelperPrint() -->
                <!-- <button type="button" class="btn btn-sm btn-alt-primary" onclick="printContent('print-content')" data-toggle="tooltip" title="Print Invoice">
                    <i class="si si-printer"></i>
                </button> -->
                <span class="print" data-toggle="modal" data-target="#print-po">
                    <a href="javascript:void(0)" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Print PO">
                        <i class="si si-printer"></i>
                    </a>
                </span>
                {{--<a type="btn" class="btn btn-sm btn-alt-primary" href="{{url()->current()}}/print" target="_blank">
                    <i class="si si-printer"></i>
                </a>--}}
                <a href="{{url('keuangan/po')}}/edit/{{$po->id}}" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Transaksi">
                    <i class="fa fa-edit"></i>
                </a>
                @if(count($po->penerimaan) < 1)
                <button class="btn btn-sm btn-alt-danger remove" data-pk="{{$po->id}}" data-toggle="tooltip" title="Delete Transaksi">
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
                    @if($po->total < 200000000)
                    <label>Nomor PO</label>
                    @else
                    <label>Nomor Kontrak</label>
                    @endif
                    <p class="h5">{{$po->no_po}}</p>
                </div>
                <div class="col-4">
                    @if($po->total < 200000000)
                    <label>Tanggal PO</label>
                    @else
                    <label>Tanggal Kontrak</label>
                    @endif
                    <p class="h5">{{indonesian_date($po->tanggal_po)}}</p>
                </div>
                @if($po->total >= 200000000)
                <div class="col-4">
                    <label>Adendum</label>
                    <p class="h5">{{$po->adendum ?? '-'}}</p>
                </div>
                @endif
            </div>
            <br>
            <div class="row">
                <div class="col-4">
                    <label for="example-datepicker1">Mengenai</label>
                    <p class="h5">{{$po->judul}}</p>
                </div>
                <div class="col-4">
                    <label>Rekanan</label>
                    <p class="h5">{{$po->perusahaan->nama}}</p>
                </div>
                @if($po->total >= 200000000)
                <div class="col-4">
                    <label>Jumlah Termin</label>
                    <p class="h5">{{$po->termin}}</p>
                </div>
                @endif
            </div>
            @if(!empty($po->tanggal_spkktr))
            <br>
            <div class="row">
                <div class="col-4">
                    <label for="example-datepicker1">Nomor SPK/KTR</label>
                    <p class="h5">{{$po->no_spkktr}}</p>
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal SPK/KTR</label>
                    <p class="h5">{{indonesian_date($po->tanggal_spkktr)}}</p>
                </div>
            </div>
            @endif
            <br>
            @if(!empty($po->file_pendukung))
            <div class="row items-push js-gallery img-fluid-100">
                <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
                    <label for="example-datepicker1">Gambar Pendukung</label>
                    <a class="img-link img-link-zoom-in img-thumb img-lightbox" href="{{url($po->file_pendukung)}}">
                        <img class="img-fluid" src="{{url($po->file_pendukung)}}" alt="">
                    </a>
                </div>
                <div class="col-12">
                    <hr>                
                </div>
            </div>
            @endif
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
                        @foreach($po->detail as $item)
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
                            <td class="text-right">Rp {{number_format($po->jumlah)}}</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="font-w600 text-right">Diskon</td>
                            <td class="text-right">Rp {{number_format($po->diskon)}}</td>
                        </tr>
                        <tr class="table-warning">
                            <td colspan="5" class="font-w700 text-uppercase text-right">Total</td>
                            <td class="font-w700 text-right">Rp {{number_format($po->total)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END Table -->

            @if(count($po->penerimaan) > 0)
            <div class="table-responsive push">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="8">Histori Penerimaan</th>
                        </tr>
                        <tr>
                            <th class="text-center">No. Faktur</th>
                            <th class="text-center" style="width: 150px;">Tanggal Faktur</th>
                            <th class="text-center" style="width: 150px;">Total</th>
                            <th class="text-center" style="width: 150px;">Status</th>
                            <th class="text-center" style="width: 90px;">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($po->penerimaan as $key => $penerimaan)
                        <tr>
                            <td class="text-center">{{$penerimaan->no_faktur}}</td>
                            <td class="text-center" style="width: 150px;">{{indonesian_date($penerimaan->tanggal_faktur)}}</td>
                            <td class="text-center" style="width: 150px;">Rp {{number_format($penerimaan->total)}}</td>
                            <td class="text-center" style="width: 150px;">{{empty($penerimaan->no_pjk) ? 'Belum PJK' : 'Sudah PJK'}}</td>
                            <td class="text-center" style="width: 200px;">
                                @if(!empty($penerimaan->no_faktur))
                                <a href="{{url('keuangan/penerimaan/')}}/{{$penerimaan->id}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Lihat Penerimaan" target="_blank"><i class="fa fa-paper-plane"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            @if(count($po->pjk) > 0)
            <div class="table-responsive push">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="8">Histori PJK</th>
                        </tr>
                        <tr>
                            <th class="text-center" style="width: 150px;">No. PJK</th>
                            <th class="text-center">Judul</th>
                            <th class="text-center" style="width: 150px;">Tanggal Pembuatan</th>
                            <th class="text-center" style="width: 150px;">Total</th>
                            <th class="text-center" style="width: 150px;">Status</th>
                            <th class="text-center" style="width: 90px;">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($po->pjk as $key => $pjk)
                        <tr>
                            <td class="text-center" style="width: 150px;">{{$pjk->nomorpjk}}</td>
                            <td class="text-center">{{$pjk->judul}}</td>
                            <td class="text-center" style="width: 150px;">{{indonesian_date($pjk->tanggal_transaksi)}}</td>
                            <td class="text-center" style="width: 150px;">Rp {{number_format($pjk->total)}}</td>
                            <td class="text-center" style="width: 150px;">{{($pjk->total - $pjk->total_paid)>0 ? 'Belum Lunas' : 'Lunas'}}</td>
                            <td class="text-center" style="width: 200px;">
                                <a href="{{url('keuangan/pjk/')}}/{{$pjk->id}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Lihat PJK" target="_blank"><i class="fa fa-paper-plane"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            @if (($po->total - $po->pjk_processed) > 0)
                @if($po->total >= 200000000)
                    @if(count($po->penerimaan) < $po->termin)
                    <div class="row">
                        <div class="col-md-12" style="float: right;">
                            <a class="btn btn-primary btn-fill pull-right" href="{{url('keuangan/penerimaan/baru?po_id='.$po->id)}}">Buat Penerimaan</a>
                        </div>
                    </div>
                    @endif
                @else
                <div class="row">
                    <div class="col-md-12" style="float: right;">
                        <a class="btn btn-primary btn-fill pull-right" href="{{url('keuangan/penerimaan/baru?po_id='.$po->id)}}">Buat Penerimaan</a>
                    </div>
                </div>
                @endif
            @endif
        </div>
    </div>
    <!-- END Invoice -->
</div>
<!-- END Page Content -->
@endsection

@section('js')
<script src="{{ URL::asset('/plugins/tinymce/tinymce.min.js') }}" type="text/javascript" ></script> 
<script type="text/javascript">
    $(document).ready(function(){
        Codebase.helpers(['summernote']);
    });
</script>
<script type="text/javascript">
function printContent(id){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(id).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}

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
                    url: API_URL + "/keuangan/po/delete",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id : id
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
