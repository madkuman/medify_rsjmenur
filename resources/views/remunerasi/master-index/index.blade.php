@extends('remunerasi.layouts.main')

@section('title')
Remunerasi - Daftar Absensi
@endsection


@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
</style>
@endsection
@section('content')

{{-- <div class="row gutters-tiny">
    <div class="col-xl-6">
        <div class="block block-link-shadow text-right">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10">
                    <i class="si si-bag fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600"></div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">Transaksi</div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="block block-link-shadow text-right">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10">
                    <i class="si si-wallet fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600">Rp </div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">Total Pemasukan</div>
            </div>
        </div>
    </div>
</div> --}}

<div class="row">
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-header py-20">
                <span><h4 class="mb-0">Master Index Pegawai</h4><hr>
                <h5></h5></span>
                <input type="text" class="d-none" id="today" value="">
                <div class="block-options">
                    <a href="{{url()->current()}}/baru" class="btn btn-sm btn-primary btn-hero">
                        <i class="fa fa-plus"></i> Pajak
                    </a>
                </div>
            </div>
            
            <div class="block-content py-20">
                <div class="row">
                    {{-- <div class="col-4">
                        <div class="form-group">
                            <form id="cariPeriode">
                            <label for="bulan_tahun"><h6>Pilih Periode</h6></label>
                            <div class="form-inline">
                                <input type="text" id="date" data-format="DD-MM-YYYY" data-template="MMMM YYYY" name="bulan_tahun" class="combodate" value="{{date('d-m-Y')}}">
                                <button style="margin-left: 10px" type="submit" class="btn btn-info btn-simple pull-right" >Terapkan</button>
                            </div>
                            </form>
                        </div>
                    </div> --}}
                    <div class="col12">
                        <table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="transaksiTable">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 5%;">#</th>
                                    <th class="text-center" style="width: 5%;">Pegawai</th>
                                    <th class="text-center" style="width: 5%;">Resiko Kerja</th>
                                    <th class="text-center" style="width: 5%;">Jenis</th>
                                    <th class="text-center" style="width: 5%;">Kualifikasi</th>
                                    <th class="text-center" style="width: 5%;">Gelar Pendidikan</th>
                                    <th class="text-center" style="width: 5%;">Pangkat</th>
                                    <th class="text-center" style="width: 5%;">Jabatan</th>
                                    <th class="text-center" style="width: 10%;">Action</th>
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

@endsection