@extends('keuangan.layouts.main')

@section('title')
Kwitansi - Keuangan
@endsection

@section('content')


<!-- Page Content -->
<div class="content p-0" id="print-content">
    <div class="block">
        @foreach($kwitansi as $item)
        <div class="block-header block-header-default">
            <h3 class="block-title">#KWI{{$item->id}}</h3>
            <div class="block-options">
                <!-- Print Page functionality is initialized in Codebase() -> uiHelperPrint() -->
                <a href="{{ route('kwitansi_print', ['id' => $item->id]) }}" class="btn btn-sm btn-alt-success">
                    Cetak <i class="si si-printer"></i>
                </a>
                <a href="{{ route('kwitansi_ubah', ['id' => $item->id]) }}" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Transaksi">
                    <i class="fa fa-edit"></i>
                </a>
                {{-- <button type="button"  data-target="#delete-{{$item->id}}" data-toggle="tooltip" title="Delete Transaksi">
                    <i class="fa fa-trash"></i>
                </button> --}}
                
                <div class="modal fade" id="delete-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form class="form-horizontal form-material" action = "{{ route('kwitansi_delete', ['id' => $item->id]) }}" method = "get">
                                    <h5> Apakah Anda yakin untuk menghapus kwitansi ? </h5>
                                    <div class="form-group m-b-0">
                                        <a href="#" class="fcbtn btn btn-default btn-1f m-r-10 m-t-10" data-dismiss="modal" style="padding-top: 5.5px; padding-bottom: 5.5px; float: right;">Keluar</a>
                                        <button type="submit" class="btn btn-danger waves-effect waves-light m-t-10">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="block-content">
            <!-- Invoice Info -->
            <div class="row my-20">
                <!-- Company Info -->
                <div class="col-4">
                    <h4>Pembayar</h4>
                    <label>Nama     : {{$item->pembayar_nama}}</label><br>
                    <label>Pangkat  : {{$item->pembayar_pangkat}}</label><br>
                    <label>Jabatan  : {{$item->pembayar_jabatan}}</label><br>
                </div>
                <div class="col-6">
                    <h4>Penerima</h4>
                    <label>Nama     : {{$item->penerima_nama}}</label><br>
                    <label>Pangkat  : {{$item->penerima_pangkat}}</label><br>
                    <label>Jabatan  : {{$item->penerima_jabatan}}</label><br>
                </div>
                <!-- END Company Info -->
                <div class="col-2 text-right">
                    <address>
                        {{date('d F Y', strtotime($item->tanggal_transaksi))}}
                    </address>
                </div>
            </div>
            <!-- END Invoice Info -->
            <br>
            <!-- Table -->
            <div class="table-responsive push">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;"></th>
                            <th>Deskripsi</th>
                            <th class="text-center" style="width: 250px;">Subtotal</th>
                            <th class="text-right" style="width: 250px;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 0 @endphp
                        <tr>
                            <td class="text-center">{{++$count}}</td>
                            <td>
                                <div class="text-muted">Total Tagihan</div>
                            </td>
                            <td class="text-center">-</td>
                            <td class="text-right">Rp {{number_format($item->subtotal)}}</td>
                        </tr>
                        <tr>
                            <td class="text-center">{{++$count}}</td>
                            <td>
                                <div class="text-muted">PPN</div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-pill badge-primary">Rp {{number_format($item->ppn)}}</span>
                            </td>
                            <td class="text-right">-</td>
                        </tr>
                        <tr>
                            <td class="text-center">{{++$count}}</td>
                            <td>
                                <div class="text-muted">PPH 21</div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-pill badge-primary">Rp {{number_format($item->pph21)}}</span>
                            </td>
                            <td class="text-right">-</td>
                        </tr>
                        <tr>
                            <td class="text-center">{{++$count}}</td>
                            <td>
                                <div class="text-muted">PPH 22</div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-pill badge-primary">Rp {{number_format($item->pph22)}}</span>
                            </td>
                            <td class="text-right">-</td>
                        </tr>
                        <tr>
                            <td class="text-center">{{++$count}}</td>
                            <td>
                                <div class="text-muted">PPH 23</div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-pill badge-primary">Rp {{number_format($item->pph23)}}</span>
                            </td>
                            <td class="text-right">-</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="font-w600 text-right">Jumlah Potongan</td>
                            <td class="text-right">Rp {{number_format($item->ppn+$item->pph21+$item->pph22+$item->pph23)}}</td>
                        </tr>
                        <tr class="table-warning">
                            <td colspan="3" class="font-w700 text-uppercase text-right">Jumlah yang Dibayarkan</td>
                            <td class="font-w700 text-right">Rp {{number_format($item->total)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END Table -->
        </div>
        @endforeach
    </div>
</div>

<!-- END Page Content -->
@endsection

@section('js')
<script src="{{asset('js/keuangan/kwitansi/single.js')}}"></script>
@endsection
