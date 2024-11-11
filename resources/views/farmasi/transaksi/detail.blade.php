@extends('farmasi.layouts.main')

@section('title')
    Farmasi Detail Transaksi
@endsection

@section('css')
    <style type="text/css">
        .bordered {
            border-bottom: 1px solid #eaecee;
        }

        .modal-content {
            border-radius: 0;
        }

        .modal-lg {
            max-width: 80% !important;
        }

        .no-border {
            border-top: 0 !important;
            border-right: 0 !important;
            border-left: 0 !important;
            border-bottom: 0;
            border-radius: 0 !important;
        }

        .editable-click {
            border-bottom: dashed 1px #0088cc;
        }

        .border-table {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table-responsive .table.table-sticky-header {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-responsive .table.table-sticky-header thead {
            position: sticky;
            background: #fff;
            top: 0;
            z-index: 1001;
        }
    </style>
@endsection

@section('content')
    <div class="block">
        <div class="block-content bordered">
            <div class="row">
                <h3 class="block-title col-lg-4 col-12">Transaksi #{{ $transaksi->slug }}</h3>
                <div class="col-lg-8 col-12">
                    <form method="POST" id="form-delete-transaksi"
                        action="{{ url('farmasi/' . session('farmasi')->slug . '/transaksi/delete') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id_transaksi" value="{{ $transaksi->id }}">
                    </form>
                    <form id="form-delete-retur" method="POST"
                        action="{{ url('farmasi/' . session('farmasi')->slug . '/transaksi/delete-retur') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="resep_id" id="resep-id" value="">
                    </form>

                    @if (!empty($transaksi->kasus_detail))
                        <div class="btn-group pull-right" role="group">
                            <button type="button" onclick="historiResep()" class="btn btn-warning btn-square mr-5 mb-5"><i
                                    class="fa fa-loop"></i> Histori Resep</button>
                        </div>
                    @endif
                    <div class="btn-group pull-right" role="group">

                        <button type="button" class="btn btn-alt-primary btn-square dropdown-toggle mr-5 mb-5"
                            id="page-header-options-dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;Menu
                        </button>

                        <div class="dropdown-menu" aria-labelledby="page-header-options-dropdown">
                            @if (!$transaksi->transaksi_asal_id)
                                <a class="dropdown-item"
                                    href="{{ url('farmasi/' . session('farmasi')->slug . '/transaksi/edit/copy/' . $transaksi->slug) }}">
                                    <i class="fa fa-copy" aria-hidden="true"></i>&nbsp;&nbsp;Buat Copy Resep
                                </a>
                            @endif
                            <a class="dropdown-item alih-resep" style="cursor: pointer;">
                                <i class="fa fa-arrows" aria-hidden="true"></i>&nbsp;&nbsp;Alih Resep
                            </a>
                            @if (count($transaksi->retur) == 0)
                                <a class="dropdown-item confirm-del copied-handler" style="cursor: pointer;">
                                    <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                                </a>
                            @endif
                            @if (empty($transaksi->transaksi_asal_id) && count($transaksi->retur) == 0)
                                <a class="dropdown-item copied-handler"
                                    href="{{ url('farmasi/' . session('farmasi')->slug . '/transaksi/edit/edit/' . $transaksi->slug) }}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
                                </a>
                            @endif
                            @if (!empty($transaksi->dikerjakan_at) && $transaksi->status == 1)
                                <a class="dropdown-item" id="btn-resep" style="cursor: pointer;">
                                    <i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Resep Original
                                </a>
                                <a class="dropdown-item" id="btn-retur" style="cursor: pointer;">
                                    <i class="fa fa-sync" aria-hidden="true"></i>&nbsp;&nbsp;Retur
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="btn-group pull-right" role="group">
                        <button type="button" class="btn btn-alt-warning btn-square dropdown-toggle mr-5 mb-5"
                            id="page-header-options-dropdown2" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak
                        </button>

                        <div class="dropdown-menu" aria-labelledby="page-header-options-dropdown2">
                            @if (!empty($transaksi->dikerjakan_at))
                                <a class="dropdown-item" id="btn-print-nota" style="cursor: pointer;">
                                    <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak Nota
                                </a>
                                <a class="dropdown-item" id="btn-print-kwitansi" style="cursor: pointer;">
                                    <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak Kwitansi
                                </a>
                            @endif
                            {{-- <a href="{{url('farmasi/'.session('farmasi')->slug.'/label-obat/print/'.$transaksi->slug)}}" class="dropdown-item" target="_blank">
                            <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak Label Obat
                        </a> --}}
                            <!-- label obat baru -->
                            @if (
                                !empty($transaksi->final_detail->kasus_resep_detail->kategori_resep) &&
                                    $transaksi->final_detail->kasus_resep_detail->kategori_resep == 'dispensing_aseptik')
                                <a href="{{ url('farmasi/' . session('farmasi')->slug . '/label-obat/print-dispensing-aseptik/' . $transaksi->slug) }}"
                                    class="dropdown-item" target="_blank">
                                    <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak Label Obat Dispensing
                                    Aseptik
                                </a>
                            @elseif (
                                !empty($transaksi->final_detail->kasus_resep_detail->kategori_resep) &&
                                    $transaksi->final_detail->kasus_resep_detail->kategori_resep == 'tpn')
                                <a href="{{ url('farmasi/' . session('farmasi')->slug . '/label-obat/print-tpn/' . $transaksi->slug) }}"
                                    class="dropdown-item" target="_blank">
                                    <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak Label Obat TPN
                                </a>
                            @else
                                <a href="{{ url('farmasi/' . session('farmasi')->slug . '/label-obat/print-rawat-jalan/' . $transaksi->slug) }}"
                                    class="dropdown-item" target="_blank">
                                    <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak Label Obat Rawat Jalan
                                </a>
                                <a data-url="{{ url('farmasi/' . session('farmasi')->slug . '/label-obat/print-oddd-rawat-inap/' . $transaksi->slug) }}"
                                    class="btn-print-udd-odd dropdown-item" style="cursor: pointer;" target="_blank">
                                    <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak Label Obat Rawat Inap
                                </a>
                            @endif
                            <!-- end label obat baru -->
                            <a class="dropdown-item"
                                href="{{ url('farmasi/' . session('farmasi')->slug . '/transaksi/cetak-analisa/' . $transaksi->slug) }}"
                                target="_blank">
                                <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak Pengkajian Resep
                            </a>
                            @if (!empty($transaksi->final_detail->konfirmasi_permintaan_at))
                                @if ($transaksi->final_detail->kategori_resep ?? '' == 'dispensing_aseptik')
                                    <a class="dropdown-item"
                                        href="{{ url('farmasi/' . session('farmasi')->slug . '/transaksi/formulir-permintaan-dispensing-aseptik/' . $transaksi->slug) }}"
                                        target="_blank">
                                        <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Formulir Permintaan
                                        Dispensing Aseptik
                                    </a>
                                @endif
                                @if ($transaksi->final_detail->kategori_resep ?? '' == 'tpn')
                                    <a class="dropdown-item"
                                        href="{{ url('farmasi/' . session('farmasi')->slug . '/transaksi/formulir-permintaan-tpn/' . $transaksi->slug) }}"
                                        target="_blank">
                                        <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Formulir Permintaan
                                        Sediaan TPN
                                    </a>
                                @endif
                            @endif
                            @if (!$transaksi->transaksi_asal_id)
                                <a class="dropdown-item" id="btn-print-resep" style="cursor: pointer;" target="_blank">
                                    <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak Resep
                                </a>
                                <a class="dropdown-item" id="btn-print-resep-format-dokter" style="cursor: pointer;"
                                    target="_blank">
                                    <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak Resep Format Dokter
                                </a>
                            @else
                                <a class="dropdown-item"
                                    href="{{ url('farmasi/' . session('farmasi')->slug . '/transaksi/cetak-copy/' . $transaksi->slug) }}"
                                    target="_blank">
                                    <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak Copy Resep
                                </a>
                            @endif
                        </div>
                    </div>
                    {{--                <div class="btn-group pull-right" role="group"> --}}
                    {{--                    @if (empty($transaksi->dikerjakan_at)) --}}
                    {{--                    <a href="#" id="dikerjakan" class="btn btn-secondary btn-square mr-5 mb-5"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;Dikerjakan</a> --}}
                    {{--                    @endif --}}
                    {{--                </div> --}}
                    <div class="btn-group pull-right" role="group">
                        @if (!empty($kasus))
                            <a href="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}"
                                class="btn btn-info btn-square mr-5 mb-5"><i class="fa fa-eye"
                                    aria-hidden="true"></i>&nbsp;&nbsp;Lihat Kasus</a>
                        @endif
                    </div>
                    <div class="btn-group pull-right" role="group">
                        @if (!empty($transaksi->pasien_detail))
                            <button type="button" class="btn btn-alt-danger btn-square btn-call-antrian mr-5 mb-5"
                                data-slug="{{ $transaksi->slug }}">
                                <i class="fa fa-bullhorn" aria-hidden="true"></i>&nbsp;&nbsp;Panggil Antrian
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="block-content">
                        <div class="block block-transparent">
                            <div class="row row-deck">
                                <div class="col-md-8">
                                    <div class="block">
                                        <div class="block-content">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5>Data Pasien</h5>
                                                </div>
                                                <div class="col-6">
                                                    <table class="table table-borderless table-vcenter table-sm">
                                                        <tr>
                                                            <td style="width: 100px">Nama Pasien </td>
                                                            <td>:</td>
                                                            <td>{{ $transaksi->pasien_detail ? $transaksi->pasien_detail->name : $transaksi->nama_pasien }}
                                                            </td>
                                                        </tr>
                                                        @if ($transaksi->pasien_detail)
                                                            <tr>
                                                                <td>No RM</td>
                                                                <td>:</td>
                                                                <td>
                                                                    #{{ $transaksi->pasien_detail->no_rm }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Jenis Kelamin</td>
                                                                <td>:</td>
                                                                <td>
                                                                    @if ($transaksi->pasien_detail->gender == 1)
                                                                        Laki-Laki
                                                                    @else
                                                                        Perempuan
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Usia</td>
                                                                <td>:</td>
                                                                <td>
                                                                    {{ $transaksi->pasien_detail->age }} Tahun
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Alamat KTP</td>
                                                                <td>:</td>
                                                                <td>
                                                                    {{ $transaksi->pasien_detail->text_alamat }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Domisili</td>
                                                                <td>:</td>
                                                                <td>
                                                                    {{ $transaksi->pasien_detail->address_domisili ?? '-' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tgl Lahir</td>
                                                                <td>:</td>
                                                                <td>
                                                                    {{ date('j F Y', strtotime($transaksi->pasien_detail->date_of_birth)) }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>No HP</td>
                                                                <td>:</td>
                                                                <td>
                                                                    {{ $transaksi->pasien_detail->phone }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Alergi Obat</td>
                                                                <td>:</td>
                                                                <td>
                                                                    {{ $transaksi->kasus->identitas->alergi_obat }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <td>Keterangan</td>
                                                            <td>:</td>
                                                            <td>
                                                                @if ($transaksi->status_retur == 1)
                                                                    (Retur) {{ $transaksi->deskripsi }}
                                                                @elseif($transaksi->status_retur == 2)
                                                                    (Dibatalkan) {{ $transaksi->deskripsi }}
                                                                @else
                                                                    {{ $transaksi->deskripsi ? $transaksi->deskripsi : '-' }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-6">
                                                    <table class="table table-borderless table-vcenter table-sm">

                                                        @if ($transaksi->pasien_detail)
                                                            <tr>
                                                                <td>Metode Pembayaran</td>
                                                                <td>:</td>
                                                                <td>
                                                                    @if ($transaksi->pembayaran_detail)
                                                                        {{ $transaksi->pembayaran_detail->perusahaan->nama }}
                                                                        - Kelas
                                                                        {{ $transaksi->pembayaran_detail->kelas->nama }}
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>No Asuransi</td>
                                                                <td>:</td>
                                                                <td>
                                                                    {{ $transaksi->pembayaran_detail->no_asuransi ?? '-' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>No SEP</td>
                                                                <td>:</td>
                                                                <td>
                                                                    {{ $transaksi->kasus->sep->no_sep }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Sisa Plafon</td>
                                                                <td>:</td>
                                                                <td>
                                                                    {{ $transaksi->sep_detail ? 'Rp. ' . number_format($transaksi->sep_detail->sisa_plafon) : '-' }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        <tr style="width: 100px">
                                                            <td>Asal Pelayanan</td>
                                                            <td>:</td>
                                                            <td>
                                                                {{ $transaksi->lokasi ? $transaksi->lokasi->nama : '-' }}
                                                            </td>
                                                        </tr>
                                                        <tr style="width: 100px">
                                                            <td>Diagnosa</td>
                                                            <td>:</td>
                                                            <td>
                                                                @if (isset($transaksi->kasus->diagnosis))
                                                                    @foreach ($transaksi->kasus->diagnosis as $dx)
                                                                        {{ $dx->icd10->code_icd }}
                                                                        @if (!$loop->last)
                                                                            ,
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Penulis Resep</td>
                                                            <td>:</td>
                                                            <td>
                                                                {{ $transaksi->created_by_detail->name }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nama Dokter</td>
                                                            <td>:</td>
                                                            <td>
                                                                {{ $transaksi->dokter_nama }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Dilayani oleh</td>
                                                            <td>:</td>
                                                            <td>
                                                                {{ $transaksi->final_detail->konfirmasi_permintaan_user->name ?? '-' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Iter Resep</td>
                                                            <td>:</td>
                                                            <td>
                                                                {{ $transaksi->final_detail->resep_iter ?? '-' }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @if ($transaksi->pasien_detail)
                                        <div class="histori-resep-container">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (isset($transaksi->transaksi_asal))
                    <div class="col">
                        <a href="{{ url('farmasi/' . session('farmasi')->slug . '/transaksi/' . $transaksi->transaksi_asal->slug) }}"
                            class="btn  btn-square">
                            <i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp;Resep Asal
                        </a>
                    </div>
                @endif
                @php $i=1 @endphp
                @foreach ($transaksi->copy_resep as $copy)
                    <div class="col">
                        <a href="{{ url('farmasi/' . session('farmasi')->slug . '/transaksi/' . $copy->slug) }}"
                            class="btn  btn-square">
                            <i class="fa fa-copy" aria-hidden="true"></i>&nbsp;&nbsp;Copy Resep {{ $i++ }}
                        </a>
                    </div>
                @endforeach
            </div>

            <hr class="my-5">

            <div class="block-header bordered">
                <h3 class="block-title">Resep {{ $transaksi->final_detail->nomor_resep }}
                    @if ($transaksi->is_racikan)
                        <small class="badge badge-primary text-white">Racikan</small>
                    @endif
                    @if ($transaksi->is_fornas)
                        <small class="badge badge-primary text-white">Fornas</small>
                    @endif
                    @if ($transaksi->is_formularium_rs)
                        <small class="badge badge-primary text-white">Formularium RS</small>
                    @endif
                </h3>
                <h4 class="block-title float-right" style="flex: none">No. Antrian : {{ $transaksi->nomor_antrian }}</h4>
            </div>
            @php
                global $flag;
            @endphp
            @include('farmasi.transaksi.components.detail-konfirmasi-permintaan')
            @if (!empty($transaksi->final_detail->konfirmasi_permintaan_at))
                @include('farmasi.transaksi.components.detail-konfirmasi-pemesanan')
            @endif
            <hr>
            @if (!(isset($transaksi->copy_resep) && is_countable($transaksi->copy_resep) && count($transaksi->copy_resep) != 0))
                @include('farmasi.transaksi.components.telaah-obat-container')
            @endif
            @include('farmasi.transaksi.components.add-ttd-pasien')
        </div>
    </div>

    @foreach ($transaksi->retur as $index => $resep)
        <div class="block">
            <div class="block-header bordered">
                <h3 class="block-title">Retur #{{ $index + 1 }}</h3>
                <div class="btn-group pull-right mr-5" role="group">
                    <button type="button"class="btn btn-alt-warning btn-square btn-print-retur"
                        data-resep-id="{{ $resep->id }}">
                        <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Print
                    </button>
                </div>
                <div class="btn-group pull-right mr-5" role="group">
                    <button type="button"class="btn btn-alt-primary btn-square btn-edit-retur"
                        data-index="{{ $index }}">
                        <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
                    </button>
                </div>
                <div class="btn-group pull-right" role="group">
                    <button class="btn btn-alt-danger btn-square btn-delete-retur" data-resep-id="{{ $resep->id }}">
                        <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                    </button>
                </div>
            </div>
            <div class="block-content">
                <div class="block block-transparent">
                    <table class="table table-vcenter">
                        <thead>
                            <tr>
                                <th width="50px">No.</th>
                                <th width="200px">Barang</th>
                                <th width="80px">Jumlah</th>
                                <th width="150px" class="text-right">Harga Jual</th>
                                <th width="150px" class="text-right">Potongan</th>
                                <th width="150px" class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                                $subtotal_retur = 0;
                            @endphp
                            @foreach ($resep->resep_detail as $detail)
                                @foreach ($detail->log as $log)
                                    @if (!is_null($log->jumlah_retur))
                                        @php $subtotal_retur += $log->subtotal_retur @endphp
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $detail->nama_obat }}</td>
                                            <td>{{ $log->jumlah_retur }} {{ $detail->satuan }}</td>
                                            <td class="text-right">Rp. {{ number_format($detail->harga) }}</td>
                                            <td class="text-right">{{ $log->potongan }}%</td>
                                            <td class="text-right">Rp. {{ number_format($log->subtotal_retur) }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                            <tr>
                                <td colspan="5" class="text-right font-w600">TOTAL RETUR :</td>
                                <td class="text-right">Rp. {{ number_format($subtotal_retur) }}</td>
                            </tr>
                            @if ($loop->last == true)
                                <tr>
                                    <td colspan="5" class="text-right font-w600">TOTAL BIAYA AKHIR:</td>
                                    <td class="text-right" id="total-harga">Rp.
                                        {{ number_format($transaksi->total_biaya_obat) }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach

    @include('farmasi.transaksi.modals.modal-alih')
    @include('farmasi.transaksi.modals.modal-penunjang')
    @include('farmasi.transaksi.modals.modal-print-analisa-resep')
    @include('farmasi.transaksi.modals.modal-print-kwitansi')
    @include('farmasi.transaksi.modals.modal-print-nota')
    @include('farmasi.transaksi.modals.modal-print-nota-retur')
    @include('farmasi.transaksi.modals.modal-print-resep-dokter')
    @include('farmasi.transaksi.modals.modal-print-resep')
    @include('farmasi.transaksi.modals.modal-resep')
    @include('farmasi.transaksi.modals.modal-panggil-antrian')
    @include('farmasi.transaksi.modals.modal-print-label-obat-udd-dan-oddd')

    <div class="modal" id="modal-retur" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="{{ url('farmasi/' . session('farmasi')->slug . '/transaksi/retur') }}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $transaksi->id }}">
                <input type="hidden" name="farmasi" value="{{ session('farmasi')->slug }}">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Retur Barang</h3>
                        </div>
                        <div class="block-content">
                            <div class="col-12">
                                <table class="table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                            <th>Kadaluarsa</th>
                                            <th>Harga</th>
                                            <th>Potongan (%)</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $j = 0;
                                            $total = 0;
                                            $log_retur = [];
                                            $max = [];
                                            foreach ($transaksi->retur as $retur) {
                                                foreach ($retur->resep_detail as $detail) {
                                                    if (!$detail->tipe) {
                                                        foreach ($detail->log as $log) {
                                                            if (empty($log_retur[$log->item_id])) {
                                                                $log_retur[$log->item_id] = $log->jumlah_retur;
                                                            } else {
                                                                $log_retur[$log->item_id] += $log->jumlah_retur;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        @endphp
                                        @foreach ($transaksi->final_detail->resep_detail as $resep_detail_index => $detail)
                                            @if (!$detail->tipe)
                                                @foreach ($detail->log as $index => $log)
                                                    <tr>
                                                        <td>
                                                            {{ ++$j }}
                                                            <h5 id="harga-jual-{{ $j }}" hidden>
                                                                {{ $detail->harga }}</h5>
                                                            <input type="hidden" name="detail[]"
                                                                value="{{ $detail->id }}">
                                                            <input type="hidden" name="log[]"
                                                                value="{{ $log->id }}">
                                                            <input type="hidden" name="resep_detail_index[]"
                                                                value="{{ $resep_detail_index }}">
                                                        </td>
                                                        <td>{{ $detail->nama_obat }}</td>
                                                        <td>
                                                            <input type="number" name="jumlah[]"
                                                                class="form-control input-diskon input-jumlah-retur d-none"
                                                                value="{{ isset($log_retur[$log->item_id]) ? $log->jumlah - $log_retur[$log->item_id] : $log->jumlah }}"
                                                                max="{{ isset($log_retur[$log->item_id]) ? $log->jumlah - $log_retur[$log->item_id] : $log->jumlah }}"
                                                                id="jumlah-retur-{{ $j }}"
                                                                onchange="changeRetur()">
                                                            <a href="javascript:void(0)"
                                                                class="no-border editable editable-click">{{ isset($log_retur[$log->item_id]) ? $log->jumlah - $log_retur[$log->item_id] : $log->jumlah }}
                                                                {{ $detail->satuan }}</a>
                                                            <input type="hidden" class="satuan"
                                                                value="{{ $detail->satuan }}">
                                                        </td>
                                                        <td>{{ date('d F Y', strtotime($log->detail_item->kadaluarsa)) }}
                                                        </td>
                                                        <td>Rp. {{ number_format($detail->harga) }}</td>
                                                        <td>
                                                            <input type="number" class="form-control input-diskon d-none"
                                                                name="potongan[]" value="0" onchange="changeRetur()"
                                                                id="diskon-retur-{{ $j }}">
                                                            <a href="javascript:void(0)"
                                                                class="no-border editable editable-click">0 %</a>
                                                            <input type="hidden" class="satuan" value="%">
                                                        </td>
                                                        <td class="text-right" id="subtotal-retur-{{ $j }}">
                                                            Rp. {{ number_format($detail->subtotal) }}</td>
                                                    </tr>
                                                    @php($max[$j] = isset($log_retur[$log->item_id]) ? $log->jumlah - $log_retur[$log->item_id] : $log->jumlah)
                                                @endforeach
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td colspan="6" class="text-right font-w600">TOTAL KEMBALI :</td>
                                            <td class="text-right" id="total-retur">Rp.
                                                {{ number_format($transaksi->total_biaya_obat) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn-simpan-retur btn btn-alt-primary" id="btn-simpan-retur">
                            <i class="fa fa-check"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('farmasi.transaksi.modals.modal-edit-retur')





@endsection

@section('js')
    @include('farmasi.transaksi.modals.components.dokter-js')
    @include('farmasi.transaksi.components.js-kategori-resep')
    @include('farmasi.js-features.histori-resep.js')
    @include('farmasi.transaksi.components.js-ttd')


    <script type="text/javascript">
        $('#select-farmasi').select2();
        $('.alih-resep').on('click', function() {
            $('#modal-alih').modal('show');
        });
        var flag = "{{ $flag }}";
        var idx = "{{ $transaksi->final_detail->resep_detail->count() }}";
        var status = "{{ $transaksi->status }}";
        var kasus = "{{ is_null($transaksi->kasus_id) }}";
        var bulat = "{{ !is_null(session('farmasi')->pembulatan) }}";
        var stok_kurang_confirm = "{{ !is_null(session('farmasi')->stok_kurang_confirm) }}";
        var cash = "{{ is_null(session('farmasi')->cash) }}";
        var kerja_at = "{{ $transaksi->dikerjakan_at ? 1 : 0 }}"
        $(document).ready(function() {
            if (kerja_at == 0) changeTotal();
            if (status == 1) changeRetur();
            if (kasus) $('#input-tagihan').hide();
            if (cash && !$('#status_pembayaran').is(":checked")) {
                $('#input-bayar').show();
                // $('#btn-simpan').attr('disabled', true);
            } else {
                $('#input-bayar').hide();
                $('#btn-simpan').attr('disabled', false);
            }
            if (!status)
                changePembayaran();

            pasien_id = '{{ $transaksi->pasien_detail->id ?? 0 }}';
            initHistoriResep('.histori-resep-container', pasien_id);
            console.log(flag);

        });
        if (flag > 0 && !stok_kurang_confirm) $('#btnConfirm').attr('disabled', true);
        else $('#btnConfirm').attr('disabled', false);

        $('#btnConfirm').on('click', function() {
            $('#modal-normal').modal('show');
        });

        // $('#dibayar').on('keyup', function(){
        //     var dibayar = parseFloat($(this).val());
        //     var total = parseFloat($('#total').val());
        //     console.log(dibayar);
        //     if (dibayar < total || isNaN(dibayar)) {
        //         $('#btn-simpan').attr('disabled', true);
        //     } else {
        //         $('#btn-simpan').attr('disabled', false);
        //     }
        // });

        $('#btn-resep').on('click', function() {
            $('#modal-resep').modal('show');
        });

        $('#btn-analisa-resep').on('click', function() {
            $('#modal-analisa-resep').modal('show');
        });

        $('#btn-penunjang').on('click', function() {
            $('#modal-penunjang').modal('show');
        });

        $('#btn-print-nota').on('click', function() {
            $('#modal-print-nota').modal('show');
        });

        $('#btn-print-nota-retur').on('click', function() {
            $('#modal-print-nota-retur').modal('show');
        });

        $('#btn-print-kwitansi').on('click', function() {
            $('#modal-print-kwitansi').modal('show');
        });

        $('#btn-print-resep').on('click', function() {
            $('#modal-print-resep-{{ $transaksi->id }}').modal('show');
        });

        $('.btn-print-udd-odd').on('click', function() {
            $('#modal-print-label-obat-udd-oddd').modal('show');
        });

        $('#btn-print-resep-format-dokter').on('click', function() {
            $('#modal-print-resep-format-dokter').modal('show');
        });

        $('#btn-retur').on('click', function() {
            $('#modal-retur').modal('show');
        });

        $('.confirm-del').on('click', function() {
            var deleteSupp = $('#form-delete-transaksi');
            console.log(deleteSupp);
            swal({
                title: 'Apa anda yakin?',
                text: 'Data yang telah terhapus tidak dapat dikembalikan lagi',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Hapus',
                html: false,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        setTimeout(function() {
                            resolve();
                        }, 50);
                    });
                }
            }).then(function(result) {
                if (result.value) {
                    deleteSupp.submit();
                    //swal('Berhasil', 'Data berhasil dihapus.', 'success');
                    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                } else if (result.dismiss === 'cancel') {
                    swal('Batal', 'Hapus data dibatalkan.', 'error');
                }
            });
        });
        $(".form-print").on('click', function(e) {
            var form = $(this);
            console.log(form);
            $(this).parent().parent().parent().unbind('submit').submit();
        })
        $('.editable-click').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var inputDiskon = $this.parent('td').find('input');

            setTimeout(function() {
                inputDiskon.focus();
            });

            $this.addClass('d-none');
            inputDiskon.removeClass('d-none');
            _onChangeDisc(inputDiskon);
        });
        $('.editable-embalase-click').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var inputEmbalase = $this.parent('td').find('input.input-embalase');

            setTimeout(function() {
                inputEmbalase.focus();
            });

            $this.addClass('d-none');
            inputEmbalase.removeClass('d-none');
            _onChangeEmbalase(inputEmbalase);
        });

        /*function changeSubtotal(index) {
            harga_beli = parseInt($('#harga-beli-'+index).text());
            jumlah = parseInt($('#jumlah-'+index).text());
            diskon = $('#diskon-'+index).val();
            harga_jual = harga_beli + (harga_beli * diskon / 100);
            $('#harga-'+index).text(harga_jual);
            subtotal = harga_jual * jumlah;
            $('#subtotal-'+index).text(subtotal);
            changeTotal();
        }*/

        function changePembayaran() {
            ran = $('#status_pembayaran').is(":checked");
            if (ran) {
                $('#input-bayar').addClass('d-none');
                $('#input-bayar').hide();
                $('#dibayar').val(0);
                $('#btn-simpan').attr('disabled', false);
            } else {
                $('#input-bayar').removeClass('d-none');
                $('#input-bayar').show();
                $('#dibayar').val(0);
                // $('#btn-simpan').attr('disabled', true);
            }
            changeTotal();
        }

        function changeTotal() {
            total = 0;
            ran = $('#status_pembayaran').is(":checked");
            let total_embalase = 0;
            for (i = 1; i <= idx; i++) {
                if ($('#racik-' + i).length) {
                    subtotal = 0;
                    racik = parseInt($('#racik-' + i).text());
                    jumlah_racikan = parseFloat($('#jumlah-' + i).text());
                    for (j = 0; j < racik; j++) {
                        harga_beli = parseInt($('#harga-beli-' + i + '-' + j).text());
                        jumlah = parseFloat($('#jumlah-' + i + '-' + j).text());
                        //console.log(harga_beli);
                        diskon = $('#diskon-' + i).val();
                        harga_racikan = harga_beli + (harga_beli * diskon / 100);
                        subtotal += harga_racikan * jumlah;
                    }
                    if (jumlah_racikan == 0) {
                        jumlah_asal = parseFloat($('#jumlah-asal-' + i).text())
                        if (jumlah_asal > 0) {
                            harga_jual = Math.round(subtotal / jumlah_asal);
                        } else {
                            harga_jual = 0;
                        }
                    } else {
                        harga_jual = Math.round(subtotal / parseFloat($('#jumlah-' + i).text()));
                    }
                    subtotal = harga_jual * parseFloat($('#jumlah-' + i).text());
                } else {
                    harga_beli = parseInt($('#harga-beli-' + i).text());
                    jumlah = parseFloat($('#jumlah-' + i).text());
                    diskon = $('#diskon-' + i).val();
                    harga_jual = Math.round(harga_beli + (harga_beli * diskon / 100));
                    $('#harga-' + i).text(formatMoney(harga_jual));
                    subtotal = harga_jual * jumlah;
                }
                let embalase = parseFloat($('#embalase-' + i).val()) || 0;
                total_embalase += embalase;
                subtotal += embalase;
                subtotal = Math.ceil(subtotal)
                $('#harga-' + i).text(formatMoney(harga_jual));
                $('#subtotal-' + i).text(formatMoney(subtotal));
                total += subtotal;
            }
            $('#subtotal-harga').text(formatMoney(total));
            var final_subtotal = total;
            if (!ran && bulat) total = Math.ceil(total / 1000) * 1000;

            $('#total-embalase').text(formatMoney(total_embalase));
            $('#subtotal-obat-harga').text(formatMoney(total - total_embalase));
            $('#total-bayar').text(formatMoney(total));
            $('#total').val(total);
        }

        function changeRetur() {
            total = 0;
            index = "{{ $j }}";
            for (i = 1; i <= index; i++) {
                harga_jual = parseInt($('#harga-jual-' + i).text());
                jumlah = $('#jumlah-retur-' + i).val();
                diskon = $('#diskon-retur-' + i).val();
                subtotal = harga_jual * jumlah;
                subtotal -= subtotal * diskon / 100;
                console.log(harga_jual, jumlah, diskon, subtotal);
                $('#subtotal-retur-' + i).text(formatMoney(subtotal));
                total += subtotal;
            }
            if (bulat) total = Math.ceil(total / 1000) * 1000;
            $('#total-retur').text(formatMoney(total));
        }

        function _onChangeDisc(input) {
            input.on('change', function() {
                var $this = $(this);
                var valDiskon = $this.val();
                var txtDiskon = $this.parent('td').find('.editable');
                var satuan = $this.parent('td').find('.satuan').val();
                if (satuan == undefined) satuan = '%';
                if ($this.hasClass('input-embalase')) satuan = '';

                if ($.isNumeric(valDiskon)) {
                    valDiskon = $this.val();
                } else {
                    valDiskon = 0;
                    $this.val(valDiskon);
                }

                $this.addClass('d-none');
                txtDiskon.removeClass('d-none');
                txtDiskon.html(valDiskon + ' ' + satuan);
            });

            input.on('blur', function() {
                var $this = $(this);
                var txtDiskon = $this.parent('td').find('.editable');

                $this.addClass('d-none');
                txtDiskon.removeClass('d-none');
            });
        }

        function _onChangeEmbalase(input) {
            input.on('change', function() {
                var $this = $(this);
                var valEmbalase = $this.val();
                var txtEmbalase = $this.parent('td').find('.editable');
                var satuan = $this.parent('td').find('.satuan').val();
                if (satuan == undefined) satuan = '';

                if ($.isNumeric(valEmbalase)) {
                    valEmbalase = $this.val();
                } else {
                    valEmbalase = 0;
                    $this.val(valEmbalase);
                }

                $this.addClass('d-none');
                txtEmbalase.removeClass('d-none');
                txtEmbalase.html('Rp ' + valEmbalase + ' ' + satuan);
            });

            input.on('blur', function() {
                var $this = $(this);
                var txtEmbalase = $this.parent('td').find('.editable');

                $this.addClass('d-none');
                txtEmbalase.removeClass('d-none');
            });
        }
        @if (!empty($transaksi->kasus_detail))
            function historiResep() {
                window.open(
                    "{{ url('kasus') }}/{{ $transaksi->kasus_detail->nomor_kasus }}/datamedis/resep/histori",
                    "popUpWindow",
                    "height=800,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes"
                );
            }
        @endif


        // $( "form" ).submit(function( event ) {
        //     setTimeout(
        //       function() 
        //       {
        //         location.reload();
        //     }, 1000);
        // });
        $('#btn-cetak-nota-2').on('click', function() {
            var $this = $(this).parents('form');
            $this.unbind('submit').submit();
        });
        $('#btn-cetak-nota-retur').on('click', function() {
            var $this = $(this).parents('form');
            $this.unbind('submit').submit();
        });
        $('#btn-cetak-kwitansi-2').on('click', function() {
            var $this = $(this).parents('form');
            $this.unbind('submit').submit();
        });

        $('#btn-submit-5-benar').on('click', function() {
            var lima_benar_pasien = 0;
            var lima_benar_obat = 0;
            var lima_benar_dosis = 0;
            var lima_benar_aturan = 0;
            var lima_benar_waktu = 0;

            if ($('.benar_pasien_yes').is(':checked')) lima_benar_pasien = 1
            if ($('.benar_obat_yes').is(':checked')) lima_benar_obat = 1
            if ($('.benar_dosis_yes').is(':checked')) lima_benar_dosis = 1
            if ($('.benar_am_yes').is(':checked')) lima_benar_aturan = 1
            if ($('.benar_wpo_yes').is(':checked')) lima_benar_waktu = 1
            $(this).find(".btn-click-animate i").remove();
            $(this).prepend('<i class="fa fa-spinner fa-spin mr-2"></i>');
            $(this).attr("disabled", true);
            $('#btn-edit-cancel-5-benar').hide();



            $.ajax({
                url: "{{ url()->current() }}/5-benar",
                type: "post",
                dataType: 'json',
                data: {
                    lima_benar_pasien: lima_benar_pasien,
                    lima_benar_obat: lima_benar_obat,
                    lima_benar_dosis: lima_benar_dosis,
                    lima_benar_aturan: lima_benar_aturan,
                    lima_benar_waktu: lima_benar_waktu,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.status == 1) {
                        callSwal(response.type, response.title, response.message, response.url);
                        $(this).attr("disabled", true);
                        $(this).find(".btn-click-animate i").remove();
                        location.reload();

                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    callSwal('error', 'Error', 'Terjadi kesalahan silahkan coba lagi', 0);
                    $(this).removeAttr("disabled");
                    $(this).find(".btn-click-animate i").remove();
                }
            });


        });

        $('#btn-edit-5-benar').on('click', function() {
            $('#lima-benar-form').show();
            $('#lima-benar-display').hide();
            $('.benar_pasien_yes').removeAttr("disabled");
            $('.benar_obat_yes').removeAttr("disabled");
            $('.benar_dosis_yes').removeAttr("disabled");
            $('.benar_am_yes').removeAttr("disabled");
            $('.benar_wpo_yes').removeAttr("disabled");
            $('#btn-submit-5-benar').show();
            $('#btn-edit-cancel-5-benar').show();
            $('#btn-edit-5-benar').hide();
        })

        $('#btn-edit-cancel-5-benar').on('click', function() {
            $('#lima-benar-form').hide();
            $('#lima-benar-display').show();
            $('.benar_pasien_yes').attr("disabled", true);
            $('.benar_obat_yes').attr("disabled", true);
            $('.benar_dosis_yes').attr("disabled", true);
            $('.benar_am_yes').attr("disabled", true);
            $('.benar_wpo_yes').attr("disabled", true);
            $('#btn-submit-5-benar').hide();
            $('#btn-edit-cancel-5-benar').hide();
            $('#btn-edit-5-benar').show();
        })
        @if (count($transaksi->copy_resep) > 0)
            $('.copied-handler').click(function(e) {
                e.preventDefault;
                swal({
                    type: 'error',
                    title: 'Resep Memiliki Copy!',
                    html: 'Mohon hapus resep copy yang ada terlebih dahulu!',
                    timer: 3000,
                });
                return false;
            })
        @endif

        $("#dikerjakan").on('click', function(e) {
            $.ajax({
                url: "{{ url()->current() }}/kerjakan",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.status == 1) {
                        $("#dikerjakan").addClass('d-none');
                        callSwal(response.type, response.title, response.message, response.url).then(
                            function(result) {
                                window.open(
                                    "{{ url('farmasi') }}/{{ session('farmasi')->slug }}/label-obat/print/{{ $transaksi->slug }}",
                                    "popUpWindow",
                                    "height=800,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes"
                                );
                            });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    callSwal('error', 'Error', 'Terjadi kesalahan silahkan coba lagi', 0);
                }
            });
        });

        $("#konfirmasi-penyiapan").on('click', function(e) {
            $.ajax({
                url: "{{ url()->current() }}/konfirmasi-penyiapan",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.status == 1) {
                        $("#konfirmasi-penyiapan").addClass('d-none');
                        callSwal(response.type, response.title, response.message, response.url)
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    callSwal('error', 'Error', 'Terjadi kesalahan silahkan coba lagi', 0);
                }
            });
        });

        $(".btn-delete-retur").on('click', function(e) {
            e.preventDefault();
            var form_delete_retur = $("#form-delete-retur");
            var resep_id = $(this).attr('data-resep-id');
            $("#form-delete-retur #resep-id").val(resep_id);
            swal({
                title: 'Apa anda yakin?',
                text: 'Data yang telah terhapus tidak dapat dikembalikan lagi',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Hapus',
                html: false
            }).then(function(result) {
                if (result.value) {
                    form_delete_retur.submit();
                    //swal('Berhasil', 'Data berhasil dihapus.', 'success');
                    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                } else if (result.dismiss === 'cancel') {
                    swal('Batal', 'Hapus data dibatalkan.', 'error');
                }
            });
        })

        function changeEditRetur(counter) {
            var total_retur = 0;
            index = "{{ $j }}";
            for (i = 1; i <= index; i++) {
                harga_jual = parseInt($('#modal-edit-retur-' + counter + ' #harga-jual-' + i).text());
                jumlah = $('#modal-edit-retur-' + counter + ' #jumlah-edit-retur-' + i).val();
                diskon = $('#modal-edit-retur-' + counter + ' #diskon-edit-retur-' + i).val();
                subtotal = harga_jual * jumlah;
                subtotal -= subtotal * diskon / 100;
                total_retur += subtotal;
                $('#modal-edit-retur-' + counter + ' #subtotal-edit-retur-' + i).text(formatMoney(subtotal));
            }
            if (bulat) total_retur = Math.ceil(total_retur / 1000) * 1000;
            $('#modal-edit-retur-' + counter + ' #total-edit-retur').text(formatMoney(total_retur));
        }

        $(".btn-edit-retur").on('click', function(e) {
            e.preventDefault();
            var counter = $(this).attr('data-index');
            $('#modal-edit-retur-' + counter).modal('show');
        })

        $(".btn-print-retur").on('click', function(e) {
            e.preventDefault();
            console.log($(this).attr('data-resep-id'));
            $('#modal-print-nota-retur input[name=resep_id]').val($(this).attr('data-resep-id'));
            $('#modal-print-nota-retur').modal('show');
        })
        $(".btn-simpan-retur").on('click', function(e) {
            var form = $(this).parents('form');
            form.unbind('submit');
            var flag = validateRetur(form);
            if (flag == 0) {
                form.unbind('submit').submit();
            }
        });

        $("#btn-simpan-konfirmasi-pesanan").on('click', function(e) {
            $("#form-payment").submit();
        });

        function validateRetur(form) {
            var input_jumlah = form.find('.input-jumlah-retur');
            var flag = 0;
            input_jumlah.each(function(i, obj) {
                var each_input_jumlah = $(obj);
                var each_max = parseInt(each_input_jumlah.attr('max'));
                var val = parseInt(each_input_jumlah.val());
                if (val > each_max) {
                    flag += 1;
                }
            });
            return flag;
        }

        $('.btn-call-antrian').on('click', function(e) {
            e.preventDefault();
            // var modal_transaksi_id = "{{ $transaksi->id }}";
            // var modal_pasien_nama = "{{ $transaksi->pasien_detail->name }}";
            // var modal_pasien_no_rm = "{{ $transaksi->pasien_detail->no_rm }}";
            // var modal_no_resep = "{{ $transaksi->final_detail->nomor_resep }}";
            // // var loket_data = {{ $loket }};
            // // console.log(loket_data);

            // $("#id").val(modal_transaksi_id);
            // $('#no_rm').val(modal_pasien_no_rm);
            // $('#nama_pasien_panggil').val(modal_pasien_nama);
            // $('#nomor_resep_panggil').val(modal_no_resep);

            // $('#loket').empty();
            // loket_data.forEach(function(item, index){
            //     $('#loket').append(`<option value='${item.id}'>${item.nama}</option>`);
            // });

            // $("#modal_panggil_antrian").modal('show');
            var slug = $(this).data('slug')
            $.ajax({
                url: `{{ url('api/farmasi/transaksi/get') }}/${slug}`,
                beforeSend: function() {
                    swal({
                        html: `<h4>Mengambil data...</h4><span class="fa fa-4x fa-cog fa-spin text-primary text-center loader"></span>`,
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                },
                success: function(res) {
                    $("#id").val(res.id);
                    $('#no_rm').val(res.pasien_detail.no_rm);
                    $('#nama_pasien_panggil').val(res.pasien_detail ? res.pasien_detail.name : res
                        .nama_pasien);
                    $('#nomor_resep_panggil').val(res.final_detail.nomor_resep);

                    var loket_data = res.loket_antrian;
                    $('#loket').empty();
                    loket_data.forEach(function(item, index) {
                        $('#loket').append(`<option value='${item.id}'>${item.nama}</option>`);
                    })
                    swal.close();
                    $("#modal_panggil_antrian").modal('show');
                },
                dataType: "json"
            });
        });

        // js modal-print-labal-obat-udd-dan-oddd
        $(document).ready(function() {
            $(".aturan-per-jam-1").each(function() {
                if ($(this).parent().css('display') != 'none') {
                    $("#aturan-per-jam-1").removeAttr('hidden');
                    return false;
                }
            });
            $(".aturan-per-jam-2").each(function() {
                if ($(this).parent().css('display') != 'none') {
                    $("#aturan-per-jam-2").removeAttr('hidden');
                    return false;
                }
            });
            $(".aturan-per-jam-3").each(function() {
                if ($(this).parent().css('display') != 'none') {
                    $("#aturan-per-jam-3").removeAttr('hidden');
                    return false;
                }
            });
            $(".aturan-per-jam-4").each(function() {
                if ($(this).parent().css('display') != 'none') {
                    $("#aturan-per-jam-4").removeAttr('hidden');
                    return false;
                }
            });
            $(".aturan-per-jam-5").each(function() {
                if ($(this).parent().css('display') != 'none') {
                    $("#aturan-per-jam-5").removeAttr('hidden');
                    return false;
                }
            });
        });

        $(document).on("click", "#btn-print-udd", function() {

            let items_rows = [];

            $(".tr-resep-detail").each(function() {
                let obat_ids = [];
                let aturan = [];

                let obat_id_1;
                let aturan_1

                let obat_id_2
                let aturan_2

                let obat_id_3
                let aturan_3

                let obat_id_4
                let aturan_4

                let obat_id_5
                let aturan_5

                let el_td_1 = $(this).find(".aturan-per-jam-1");
                if (el_td_1.is(":checked")) {
                    obat_id_1 = $(this).find(".aturan-per-jam-1").data("obat-resep-detail-id");
                    aturan_1 = $(this).find(".aturan-per-jam-1").val();
                }

                let el_td_2 = $(this).find(".aturan-per-jam-2");
                if (el_td_2.is(":checked")) {
                    obat_id_2 = $(this).find(".aturan-per-jam-2").data("obat-resep-detail-id");
                    aturan_2 = $(this).find(".aturan-per-jam-2").val();
                }

                let el_td_3 = $(this).find(".aturan-per-jam-3");
                if (el_td_3.is(":checked")) {
                    obat_id_3 = $(this).find(".aturan-per-jam-3").data("obat-resep-detail-id");
                    aturan_3 = $(this).find(".aturan-per-jam-3").val();
                }

                let el_td_4 = $(this).find(".aturan-per-jam-4");
                if (el_td_4.is(":checked")) {
                    obat_id_4 = $(this).find(".aturan-per-jam-4").data("obat-resep-detail-id");
                    aturan_4 = $(this).find(".aturan-per-jam-4").val();
                }

                let el_td_5 = $(this).find(".aturan-per-jam-5");
                if (el_td_5.is(":checked")) {
                    obat_id_5 = $(this).find(".aturan-per-jam-5").data("obat-resep-detail-id");
                    aturan_5 = $(this).find(".aturan-per-jam-5").val();
                }

                if (obat_id_1) {
                    obat_ids.push(obat_id_1);
                }
                if (obat_id_2) {
                    obat_ids.push(obat_id_2);
                }
                if (obat_id_3) {
                    obat_ids.push(obat_id_3);
                }
                if (obat_id_4) {
                    obat_ids.push(obat_id_4);
                }
                if (obat_id_5) {
                    obat_ids.push(obat_id_5);
                }

                if (aturan_1) {
                    aturan.push(aturan_1);
                }
                if (aturan_2) {
                    aturan.push(aturan_2);
                }
                if (aturan_3) {
                    aturan.push(aturan_3);
                }
                if (aturan_4) {
                    aturan.push(aturan_4);
                }
                if (aturan_5) {
                    aturan.push(aturan_5);
                }

                let unique_obat_ids = [...new Set(obat_ids)];
                let unique_jam_aturan_pakai = [...new Set(aturan)];
                items_rows.push(`[${unique_obat_ids},${unique_jam_aturan_pakai}]`);
            });

            $("#items-rows").val(items_rows);
            $("#label-type").val('udd');

            // $('form#form-cetak-label-rawat-inap').submit(); // ini diubah menjadi di bawah

            const item_row = $("#items-rows").val();
            const label_type = $("#label-type").val();
            const id_label_udd_oddd = $("#id-label-udd-oddd").val();
            const farmasi_slug_label_udd_oddd = $("#farmasi-slug-label-udd-oddd").val();

            let current_url =
                "{{ url('farmasi/' . session('farmasi')->slug . '/label-obat/print-udd-oddd-rawat-inap/' . $transaksi->slug) }}";
            let full_url = current_url +
                `?id=${id_label_udd_oddd}&farmasi=${farmasi_slug_label_udd_oddd}&label_type=${label_type}&items_rows=` +
                encodeURIComponent(items_rows);
            window.open(full_url, '_blank');
        });


        $(document).on("click", "#btn-print-oddd", function() {
            let items_rows = [];

            $(".tr-resep-detail").each(function() {
                let obat_ids = [];
                let aturan = [];

                let obat_id_1;
                let aturan_1

                let obat_id_2
                let aturan_2

                let obat_id_3
                let aturan_3

                let obat_id_4
                let aturan_4

                let obat_id_5
                let aturan_5

                let el_td_1 = $(this).find(".aturan-per-jam-1");
                if (el_td_1.is(":checked")) {
                    obat_id_1 = $(this).find(".aturan-per-jam-1").data("obat-resep-detail-id");
                    aturan_1 = $(this).find(".aturan-per-jam-1").val();
                }

                let el_td_2 = $(this).find(".aturan-per-jam-2");
                if (el_td_2.is(":checked")) {
                    obat_id_2 = $(this).find(".aturan-per-jam-2").data("obat-resep-detail-id");
                    aturan_2 = $(this).find(".aturan-per-jam-2").val();
                }

                let el_td_3 = $(this).find(".aturan-per-jam-3");
                if (el_td_3.is(":checked")) {
                    obat_id_3 = $(this).find(".aturan-per-jam-3").data("obat-resep-detail-id");
                    aturan_3 = $(this).find(".aturan-per-jam-3").val();
                }

                let el_td_4 = $(this).find(".aturan-per-jam-4");
                if (el_td_4.is(":checked")) {
                    obat_id_4 = $(this).find(".aturan-per-jam-4").data("obat-resep-detail-id");
                    aturan_4 = $(this).find(".aturan-per-jam-4").val();
                }

                let el_td_5 = $(this).find(".aturan-per-jam-5");
                if (el_td_5.is(":checked")) {
                    obat_id_5 = $(this).find(".aturan-per-jam-5").data("obat-resep-detail-id");
                    aturan_5 = $(this).find(".aturan-per-jam-5").val();
                }

                if (obat_id_1) {
                    obat_ids.push(obat_id_1);
                }
                if (obat_id_2) {
                    obat_ids.push(obat_id_2);
                }
                if (obat_id_3) {
                    obat_ids.push(obat_id_3);
                }
                if (obat_id_4) {
                    obat_ids.push(obat_id_4);
                }
                if (obat_id_5) {
                    obat_ids.push(obat_id_5);
                }

                if (aturan_1) {
                    aturan.push(aturan_1);
                }
                if (aturan_2) {
                    aturan.push(aturan_2);
                }
                if (aturan_3) {
                    aturan.push(aturan_3);
                }
                if (aturan_4) {
                    aturan.push(aturan_4);
                }
                if (aturan_5) {
                    aturan.push(aturan_5);
                }

                let unique_obat_ids = [...new Set(obat_ids)];
                let unique_jam_aturan_pakai = [...new Set(aturan)];
                items_rows.push(`[${unique_obat_ids},${unique_jam_aturan_pakai}]`);
            });

            console.log(items_rows);

            $("#items-rows").val(items_rows);
            $("#label-type").val('oddd');

            // $('form#form-cetak-label-rawat-inap').submit(); // ini diubah menjadi di bawah

            const item_row = $("#items-rows").val();
            const label_type = $("#label-type").val();
            const id_label_udd_oddd = $("#id-label-udd-oddd").val();
            const farmasi_slug_label_udd_oddd = $("#farmasi-slug-label-udd-oddd").val();

            let current_url =
                "{{ url('farmasi/' . session('farmasi')->slug . '/label-obat/print-udd-oddd-rawat-inap/' . $transaksi->slug) }}";
            let full_url = current_url +
                `?id=${id_label_udd_oddd}&farmasi=${farmasi_slug_label_udd_oddd}&label_type=${label_type}&items_rows=` +
                encodeURIComponent(items_rows);
            window.open(full_url, '_blank');
        });

        $(document).on("click", "#aturan-per-jam-1", function() {
            $(".aturan-per-jam-1:checkbox").each(function() {
                if ($(this).is(":checked")) {
                    $(this).attr("checked", false);
                } else {
                    $(this).attr("checked", true);
                }
            })
        });

        $(document).on("click", "#aturan-per-jam-2", function() {
            $(".aturan-per-jam-2:checkbox").each(function() {
                if ($(this).is(":checked")) {
                    $(this).attr("checked", false);
                } else {
                    $(this).attr("checked", true);
                }
            })
        });

        $(document).on("click", "#aturan-per-jam-3", function() {
            $(".aturan-per-jam-3:checkbox").each(function() {
                if ($(this).is(":checked")) {
                    $(this).attr("checked", false);
                } else {
                    $(this).attr("checked", true);
                }
            })
        });

        $(document).on("click", "#aturan-per-jam-4", function() {
            $(".aturan-per-jam-4:checkbox").each(function() {
                if ($(this).is(":checked")) {
                    $(this).attr("checked", false);
                } else {
                    $(this).attr("checked", true);
                }
            })
        });

        $(document).on("click", "#aturan-per-jam-5", function() {
            $(".aturan-per-jam-5:checkbox").each(function() {
                if ($(this).is(":checked")) {
                    $(this).attr("checked", false);
                } else {
                    $(this).attr("checked", true);
                }
            })
        });
        // end js modal-print-labal-obat-udd-dan-oddd

        $("#btn-submit-tindak-lanjut").on('click', function(e) {
            const tindakLanjut = $('#tindak-lanjut').val();
            $.ajax({
                url: "{{ url('farmasi/' . session('farmasi')->slug . '/transaksi/tindak-lanjut') }}",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": "{{ $transaksi->id }}",
                    "tindak_lanjut": tindakLanjut,
                },
                success: function(response) {
                    if (response.status == 1) {
                        callSwal(response.type, response.title, response.message, response.url);
                        $('#tindak-lanjut').val(response.tindak_lanjut);
                    } else {
                        callSwal(response.type, response.title, response.message, response.url);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    callSwal('error', 'Error', 'Terjadi kesalahan silahkan coba lagi', 0);
                }
            });
        });
    </script>


    @include('farmasi.transaksi.js.js-tagihan')
@endsection
