@extends('remunerasi.layouts.main')

@section('title')
Remunerasi - Beban Kerja
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
                <span><h4 class="mb-0">Beban Kerja Pegawai</h4><hr>
                <h5></h5></span>
                <input type="text" class="d-none" id="today" value="">
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-primary btn-hero" id="btn-modal-create">
                        <i class="fa fa-plus"></i> Beban Kerja Pegawai Baru
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
                                <input type="text" id="date" data-format="DD-MM-YYYY" data-template="MMMM YYYY" name="bulan_tahun" class="combodate" value="{{date('d-m-Y')}}">
                                <button style="margin-left: 10px" type="submit" class="btn btn-info btn-simple pull-right" >Terapkan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12">
                        <table class="table table-bordered table-striped table-vcenter table-sm js-dataTable-full"  id="example" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 10%;">#</th>
                                    <th class="text-center" style="width: 30%;">Pegawai</th>
                                    <th class="text-center" style="width: 20%;">Bulan</th>
                                    <th class="text-center" style="width: 20%;">Index</th>
                                    <th class="text-center" style="width: 20%;">Action</th>
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

@include('remunerasi.beban-kerja.components.js-create')
@include('remunerasi.beban-kerja.components.js-index')
@include('remunerasi.beban-kerja.components.modal-create')
@include('remunerasi.beban-kerja.components.modal-update')

@endsection