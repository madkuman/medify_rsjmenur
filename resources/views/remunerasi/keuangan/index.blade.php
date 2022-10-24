@extends('remunerasi.layouts.main')

@section('title')
Remunerasi - Pelayanan
@endsection


@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
.d-none{
    display: none;
}
</style>
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-header py-20">
                <span><h4 class="mb-0">Pelayanan</h4><hr>
                <h5></h5></span>
                <input type="text" class="d-none" id="today" value="">
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-primary btn-hero" id="btn-modal-create">
                        <i class="fa fa-plus"></i> Pelayanan Pegawai
                    </button>
                </div>
            </div>
            
            <div class="block-content py-5">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <form id="cariPeriode">
                            <label for="bulan_tahun"><h6>Pilih Periode</h6></label>
                            <div class="form-inline">
                                <input type="text" id="date-pelayanan" data-format="DD-MM-YYYY" data-template="MMMM YYYY" name="bulan_tahun" class="combodate" value="{{date('d-m-Y')}}">
                                <button style="margin-left: 10px" type="submit" class="btn btn-info btn-simple pull-right" >Terapkan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12">
                        <table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="example" width="2000px">
                            <thead>
                                <tr>
                                    <th class="text-center" width="2%;">#</th>
                                    <th class="text-center" width="3%;">Bulan</th>
                                    <th class="text-center" width="62%;">Nama Pegawai</th>
                                    <th class="text-center" width="3%;">JP Dasar</th>
                                    <th class="text-center" width="3%;">Visite Tetap</th>
                                    <th class="text-center" width="3%;">Visite Anggrek</th>
                                    <th class="text-center" width="3%;">Jasa Pendidikan</th>
                                    <th class="text-center" width="3%;">Tindakan Dokter</th>
                                    <th class="text-center" width="3%;">Konsul Dokter</th>
                                    <th class="text-center" width="3%;">Poli Tumbang</th>
                                    <th class="text-center" width="3%;">APS/ECT</th>
                                    <th class="text-center" width="3%;">Patologi Klinik</th>
                                    <th class="text-center" width="3%;">IPWL</th>
                                    <th class="text-center" width="3%;">Action</th>
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
@include('remunerasi.keuangan.components.js-index')
@include('remunerasi.keuangan.components.js-create')
@include('remunerasi.keuangan.components.js-edit')
@include('remunerasi.keuangan.components.modal-create')

@endsection