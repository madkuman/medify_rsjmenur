@extends('keuangan.layouts.main')

@section('title')
Penerimaan #{{$pemasukan->id}} - Keuangan
@endsection

@section('content')


<!-- Page Content -->
<div class="content p-0" id="print-content">
    <!-- Invoice -->
    <h2 class="content-heading d-print-none pt-0">
        Invoice Penerimaan
    </h2>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">#INC{{$pemasukan->id}}</h3>
            <div class="block-options">
                <!-- Print Page functionality is initialized in Codebase() -> uiHelperPrint() -->
                <button type="button" class="btn btn-sm btn-alt-primary" onclick="popupwindow('{{url('keuangan/pemasukan/'.$pemasukan->id)}}/print-nota','Piutang',500,1000) " data-toggle="tooltip" title="Print Nota">
                    <i class="si si-printer"></i>
                </button>
                <button type="button" class="btn btn-sm btn-alt-primary" onclick="popupwindow('{{url('keuangan/pemasukan/'.$pemasukan->id)}}/print-kwitansi','Piutang',500,1000) " data-toggle="tooltip" title="Print Kwitansi">
                    <i class="si si-printer"></i>
                </button>
                <a href="{{url('keuangan/pemasukan/'.$pemasukan->id)}}" class="d-none btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Transaksi">
                    <i class="fa fa-edit"></i>
                </a>
                <button class="btn btn-sm btn-alt-danger remove" data-pk="{{$pemasukan->id}}" data-toggle="tooltip" title="Delete Transaksi">
                    <i class="fa fa-trash"></i>
                </button>
                <button type="button" class="btn btn-sm btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
            </div>
        </div>
        <div class="block-content">
            <!-- Invoice Info -->
            <div class="row">
                <div class="col-12 text-center">
                    <p class="h4" style="margin-bottom:0">{{$pemasukan->judul}}</p>
                </div>
            </div>
            <hr>
            <div class="row my-20">
                <!-- Company Info -->
                <div class="col-5">
                    <label>Pasien</label>
                    @if($pemasukan->pasien_id != null)
                    <p class="h4" style="margin-bottom:0">{{$pemasukan->pasien->name ?? '-'}}</p>
                        {{$pemasukan->pasien->address ?? '-'}}, <br>
                        {{$pemasukan->pasien->alamat_kecamatan->nama ?? '-'}}, {{$pemasukan->pasien->alamat_kota->nama ?? '-'}}<br>
                        {{$pemasukan->pasien->phone ?? '-'}}<br>
                    @else
                    <p class="h4" style="margin-bottom:0">-</p>
                    @endif
                </div>
                <div class="col-5">
                    <label>Penanggung Jawab Pembayaran</label>
                    <p class="h4">{{$pemasukan->pihak_ketiga}}</p>
                </div>
                <!-- END Company Info -->
                <div class="col-2 text-right">
                    <address>
                        {{date('d F Y', strtotime($pemasukan->tanggal_transaksi))}}
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
                            <th>Layanan</th>
                            <th class="text-center" style="width: 90px;">Kelas</th>
                            <th class="text-center" style="width: 90px;">Jumlah</th>
                            <th class="text-right" style="width: 120px;">Harga</th>
                            <th class="text-right" style="width: 90px;">Diskon</th>
                            <th class="text-right" style="width: 90px;">Beban Lain</th>
                            <th class="text-right" style="width: 120px;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 0 @endphp
                        @foreach($pemasukan_details as $tanggal => $kategori_item)
                            <tr class="table-warning">
                                <td colspan="8" class="text-center">
                                    {{$tanggal}}
                                </td>
                            </tr>
                            @if(!empty($kategori_item['Tindakan']))
                            @php $temp_data['pemasukan_detail'] = $kategori_item['Tindakan'] @endphp
                            @php $temp_data['kategori'] = 'Tindakan' @endphp
                            @include('keuangan.pemasukan.components-single.detail-content',$temp_data)
                            @endif
                            
                            @if(!empty($kategori_item['Farmasi']))
                            @php $temp_data['pemasukan_detail'] = $kategori_item['Farmasi'] @endphp
                            @php $temp_data['kategori'] = 'Farmasi' @endphp
                            @include('keuangan.pemasukan.components-single.detail-content',$temp_data)
                            @endif

                            @if(!empty($kategori_item['Penunjang']))
                            @php $temp_data['pemasukan_detail'] = $kategori_item['Penunjang'] @endphp
                            @php $temp_data['kategori'] = 'Penunjang' @endphp
                            @include('keuangan.pemasukan.components-single.detail-content',$temp_data)
                            @endif

                            @if(!empty($kategori_item['Lain lain']))
                            @php $temp_data['pemasukan_detail'] = $kategori_item['Lain lain'] @endphp
                            @php $temp_data['kategori'] = 'Lain lain' @endphp
                            @include('keuangan.pemasukan.components-single.detail-content',$temp_data)
                            @endif

                        @endforeach
                        <tr class="table-warning">
                            <td colspan="7" class="font-w700 text-uppercase text-right">Total</td>
                            <td class="font-w700 text-right">Rp {{number_format($pemasukan->total,5)}}</td>
                        </tr>
                        <tr>
                            <td colspan="8">&nbsp;</td>
                        </tr>
                        @if(!empty($pemasukan->piutang_id))
                        <tr class="table-info">
                            <td colspan="7" class="font-w700 text-uppercase text-right">Pembayaran Cash</td>
                            <td class="font-w700 text-right">Rp {{number_format($pemasukan->total_pembayaran,5)}}</td>
                        </tr>
                        <tr class="table-info">
                            <td colspan="7" class="font-w700 text-uppercase text-right">Deposit Digunakan</td>
                            <td class="font-w700 text-right">Rp {{number_format($pemasukan->total_deposit,5)}}</td>
                        </tr>
                        <tr class="table-info">
                            <td colspan="7" class="font-w700 text-uppercase text-right">Kembalian</td>
                            <td class="font-w700 text-right">Rp {{number_format($pemasukan->total_kembalian,5)}}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- END Table -->
        </div>
    </div>
    <!-- END Invoice -->
    {{--
    @if(!empty($pemasukan->kasus->id))
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">KOLABORATOR KASUS</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-6">
                    <div class="row"> 
                        @if(!empty($pemasukan->kasus->admin->user->name))
                        <div class="col-2">
                            <h6>DPJP</h6>
                        </div>
                        <div class="col-4">
                            - {{$pemasukan->kasus->admin->user->name}}
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <h6>Anggota</h6>
                        </div>
                        <div class="col-4">
                            @foreach($pemasukan->kasus->kolaboratorExceptAdmin as $kolaborator)
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
                                @foreach($pemasukan->kasus->lokasiAll as $lokasi)
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
    --}}
</div>

<!-- END Page Content -->
@endsection

@section('js')
<script src="{{asset('js/keuangan/pemasukan/singlev1.1.js')}}"></script>
@endsection
