@extends('pasien.layouts.laporanv2.page-result')

@section('title')
    RL 3.2 Rawat Darurat - Laporan - Administrasi & Rekam Medis
@endsection

@section('subtitle')
    Laporan
@endsection

@section('page-title')
    RL 3.2 Rawat Darurat
@endsection


@section('content')
    <div class="block-content">
        <h6>FILTER</h6>
        <div class="row">
            <div class="col-4">
                <div class="form-group row">
                    <div class="col-12">
                        <label>Tahun*</label>
                        <select class="form-control js-select2" name="tahun_transaksi">
                            @foreach ($tahun_transaksi as $item)
                                <option value={{$item->tahun}}> {{$item->tahun}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-2 pt-20">
                @include('pasien.laporanv2.components.form-btn-filter')
            </div>
        </div>
        <div class="row progress-data-loader-container" style="display: none">
            <div class="col-4">
                Progress (Total Data : <span class="progress-data-loader-total-data">0</span>)
                <div class="progress push progress-data-loader-loading">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        style="width: 0%;">
                        <span class="progress-bar-label">0%</span>
                    </div>
                </div>
                <div class="progress push progress-data-loader-complete" style="display: none">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100"
                        aria-valuemin="0" aria-valuemax="100">
                        <span class="progress-bar-label">100%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block-content">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
            <thead>
                <tr>
                    <th>KODE PROPINSI</th>
                    <th>KAB/KOTA</th>
                    <th>KODE RS</th>
                    <th>NAMA RS</th>
                    <th>TAHUN</th>
                    <th>NO</th>
                    <th>JENIS PELAYANAN</th>
                    <th>TOTAL PASIEN RUJUKAN</th>
                    <th>TOTAL PASIEN_NON RUJUKAN</th>
                    <th>TINDAK LANJUT PELAYANAN DIRAWAT</th>
                    <th>TINDAK LANJUT PELAYANAN DIRUJUK</th>
                    <th>TINDAK LANJUT PELAYANAN PULANG</th>
                    <th>MATI DI UGD</th>
                    <th>DOA</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

@endsection

@section('js')
    @include('pasien.laporanv2.pages.rl-3-2-rawat-darurat.js-index')
    @include('pasien.laporanv2.components.js-progress-bar-updater')
    @include('pasien.laporanv2.components.js-error-notify')
@endsection
