@extends('farmasi.layouts.laporanv2.non-navbar')

@section('title')
Farmasi - Laporan E-Resep kolektif
@endsection

@section('subtitle')
Laporan
@endsection

@section('page-title')
Laporan E-Resep kolektif
@endsection


@section('content')

<div class="block">
    <div class="block-content">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#resep-obat-kronis-files">Pilih File</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#resep-obat-kronis-picker">Buat Ulang</a>
                    </li>
                </ul>
                <hr>
                <div class="tab-content">
                    <div class="tab-pane container active p-0" id="resep-obat-kronis-files">
                        <h5 class="font-w400">Download laporan dan file yang telah tersedia.</h5>
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full dataTable">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama File</th>
                                    <th class="text-center">Download</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($files as $item)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    @if ($item->zipper)
                                        <td data-zipper_id="{{ $item->zipper->id }}">
                                            @if ($item->zipper->status == 0)
                                                Proses : {{ $item->zipper->percentage }}%
                                            @else
                                                {{ $item->file_name }}
                                            @endif
                                        </td>
                                    @else
                                        @if($item->status != -1)
                                            <td>{!! $item->file_name ?? '<span class="badge badge-secondary">File sedang di buat</span>' !!}</td>
                                        @else
                                            <td>{{ $item->file_name }}</td>
                                        @endif
                                    @endif
                                    <td class="text-center">
                                        @if($item->status == 1 && file_exists(public_path($item->file_path)))
                                        <a class="btn btn-sm btn-primary" href="{{ !empty($item->file_path)? url($item->file_path) : '#' }}">
                                            <i class="fa fa-download"></i> Download
                                        </a>
                                        @elseif($item->status == -1)
                                            <span class="badge badge-danger">Error Saat Membuat File</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane container fade" id="resep-obat-kronis-picker">
                        <h5 class="font-w400">File akan dibuat ulang, dan akan tersedia pada pemilihan file.</h5>
                        <form method="POST" action="{{url()->current()}}/generate">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-3">
                                    @include('farmasi.laporanv2.components.form-date-range')
                                </div>
                                <div class="col-3">
                                    @include('farmasi.laporan.modals.components.form-farmasi-basic')
                                </div>
                                <div class="col-3">
                                    @include('farmasi.laporan.modals.components.form-asal-pelayanan')
                                </div>
                                <div class="col-3">
                                    @include('farmasi.laporan.modals.components.form-jenis-resep')
                                </div>
                                <div class="col-3">
                                    @include('farmasi.laporan.modals.components.form-select-kategori')
                                </div>
                                <div class="col-3">
                                    @include('farmasi.laporan.modals.components.form-sumber-dana-ada-semua')
                                </div>
                                <div class="col-3">
                                    @include('farmasi.laporan.modals.components.form-asuransi')
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="penyedia">Nama File</label>
                                        <select class="form-control js-select2" name="nama_file" id="nama_file" placeholder="Pilih Nama File" style="width: 100%;">
                                            <option value="no_rm">No RM</option>
                                            <option value="no_sep">No SEP</option>
                                            <option value="nama_pasien">Nama Pasien</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="penyedia">Jenis Cetak</label>
                                        <select class="form-control js-select2" name="jenis_cetak" id="jenis_cetak" placeholder="Pilih Jenis Cetak" style="width: 100%;">
                                            <option value="all">Semua Resep 1 File</option>
                                            <option value="one">1 Resep 1 File</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="penyedia">Cetak</label>
                                        <select class="form-control js-select2" name="file_list[]" id="file_list" placeholder="Pilih Berkas yang di Cetak" style="width: 100%;" multiple data-placeholder="Semua">
                                            <option value="">Semua</option>
                                            <option value="resep">Resep</option>
                                            <option value="sep">SEP</option>
                                            <option value="hasil-lab">Hasil Pemeriksaan Lab</option>
                                            <option value="identitas">Identitas</option>
                                            <option value="profil">Profil Pasien</option>
                                            <option value="billing">Billing</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-submit">Generate</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('.js-dataTable-full').dataTable({
        pageLength: 10,
        scrollX: true,
        autoWidth: false,
        "searching": false,
        "ordering": false
    });
</script>
@include('farmasi.laporanv2.components.js-error-notify')
@endsection