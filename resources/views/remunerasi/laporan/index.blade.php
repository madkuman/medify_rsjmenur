@extends('remunerasi.layouts.main')

@section('title')
    Remunerasi - Laporan
@endsection


@section('css')

    <style>
        .dataTables_processing {
            background-color: white;
        }
    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="block block-rounded">
                <div class="block-header py-20">
                <span><h4 class="mb-0">Laporan</h4><hr>
                <h5></h5></span>
                    <input type="text" class="d-none" id="today" value="">
                    <div class="block-options">
                        <button type="button" class="btn btn-sm btn-warning btn-hero" id="btn-modal-cetak">
                            Cetak Laporan
                        </button>
                        <button type="button" class="btn btn-sm btn-primary btn-hero" id="btn-modal-create">
                            <i class="fa fa-plus"></i> Buat Laporan
                        </button>
                    </div>
                </div>

                <div class="block-content py-20">
                    <div class="row col-8">
                        <form id="cariPeriode">
                            <div class="form-group row col-12">
                                <div class="col-4 form-inline">
                                    <label for="bulan_tahun"><h6>Pilih Periode</h6></label>
                                    <input type="text" id="date" data-format="DD-MM-YYYY" data-template="MMMM YYYY"
                                           name="bulan_tahun" class="combodate" value="{{date('d-m-Y')}}">
                                </div>
                                <div class="col-4 form-inline">
                                    <label for="kategori"><h6>Pilih Kategori Pegawai</h6></label>
                                    <select class="js-select2 form-control" id="kategori" name="kategori[]"
                                            style="width: 100%;" data-placeholder="Pilih Kategori" required="required">
                                        <option value="all" selected>Semua Kategori</option>
                                        @foreach($kategori_pegawai as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-1 form-inline">
                                    <label>&nbsp;</label>
                                    <button style="margin-left: 10px" type="submit"
                                            class="btn btn-info btn-simple pull-right">Terapkan
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="row col-6">
                        <div class="col-6">
                        <label><h6>Total Index Pajak</h6></label>
                        </div>
                    </div>
                    @foreach($kategori_pegawai as $item)
                        <div class="row col-6">
                            <div class="col-3">
                                <label><h6>{{$item->nama}}</h6></label>
                            </div>
                            <div class="col-1">
                                <label><h6>:</h6></label>
                            </div>
                            <div class="col-2">
                                <label id="index-pajak-{{$item->id}}"><h6>0</h6></label>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12">
                        <table class="table table-bordered table-striped table-vcenter table-sm js-dataTable-full"
                               id="example" width="100%">
                            <thead>
                            <tr>
                                <th width="3%" class="centered"><b>No</b></th>
                                <th width="6%" class="centered"><b>Cetak</b></th>
                                <th width="10%" class="centered"><b>Pegawai</b></th>
                                <th width="10%" class="centered"><b>Bank</b></th>

                                <th width="5%" class="centered" colspan=""><b>Kategori</b></th>
                                <th width="5%" class="centered" colspan=""><b>Golongan</b></th>
                                <th width="5%" class="centered" colspan=""><b>Pendidikan</b></th>
                                <th width="5%" class="centered" colspan=""><b>Jabatan</b></th>
                                <th width="5%" class="centered" colspan=""><b>Jenis Pegawai</b></th>
                                <th width="5%" class="centered" colspan=""><b>Beban Kerja</b></th>
                                <th width="5%" class="centered" colspan=""><b>Resiko Kerja</b></th>
                                <th width="5%" class="centered" colspan=""><b>Masa Kerja</b></th>
                                <th width="5%" class="centered" colspan=""><b>Tim Pembagi Jasa</b></th>
                                <th width="5%" class="centered" colspan=""><b>Index Pajak</b></th>

                                <th width="9%" class="centered"><b>Jasa Pelayanan</b></th>
                                <th width="9%" class="centered"><b>Pelayanan Tambahan</b></th>
                                <th width="9%" class="centered"><b>Potongan</b></th>
                                <th width="9%" class="centered"><b>Terima Bersih</b></th>
                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection

@section('js')
    @include('remunerasi.components.js')
    @include('remunerasi.laporan.components.js-index')
    @include('remunerasi.laporan.components.modal-cetak')
    @include('remunerasi.laporan.components.modal-create')
@endsection