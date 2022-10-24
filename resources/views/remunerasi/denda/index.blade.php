@extends('remunerasi.layouts.main')

@section('title')
Remunerasi - Daftar Absensi
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
                <span><h4 class="mb-0">Denda</h4><hr>
                <h5></h5></span>
                <input type="text" class="d-none" id="today" value="">
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-primary btn-hero" id="btn-modal-create">
                        <i class="fa fa-plus"></i> Denda Absensi Baru
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
                                <input type="text" id="date-denda" data-format="DD-MM-YYYY" data-template="MMMM YYYY" name="bulan_tahun" class="combodate" value="{{date('d-m-Y')}}">
                                <button style="margin-left: 10px" type="submit" class="btn btn-info btn-simple pull-right" >Terapkan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12">
                        <table class="table table-bordered table-striped table-vcenter table-sm js-dataTable-full"  id="example" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width= "4%">#</th>
                                    <th class="text-center" width= "15%">Bulan</th>
                                    <th class="text-center" width= "15%">Absen </th>
                                    <th class="text-center" width= "15%">Lupa Absen </th>
                                    <th class="text-center" width= "18%">Telat Masuk</th>
                                    <th class="text-center" width= "18%">Pulang Lebih Awal</th>
                                    <th class="text-center" width= "15%">Senam</th>
                                    <th class="text-center" width= "15%">Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>

							</tbody>
                            
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
@include('remunerasi.denda.components.js-index')
@include('remunerasi.denda.components.js-create')
@include('remunerasi.denda.components.js-edit')
@include('remunerasi.denda.components.modal-create')

@endsection