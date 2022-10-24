@extends('esakip.layouts.main')

@section('title')
E-Sakip - Dokumen
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
                <span><h4 class="mb-0">Dokumen</h4><hr>
                <h5></h5></span>
                <input type="text" class="d-none" id="today" value="">
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-primary btn-hero" id="btn-modal-create">
                        <i class="fa fa-plus"></i> Upload
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
                                <input type="text" class="form-control js-datepicker-year" id="periode" value="{{date('Y')}}" data-date-autoclose="true">
                                <button style="margin-left: 10px" type="submit" class="btn btn-info btn-simple pull-right" >Terapkan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-striped table-vcenter"  id="example" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width= "5%">#</th>
                                    <th class="text-center" width= "35%">Pegawai</th>
                                    <th class="text-center" width= "20%">Judul</th>
                                    <th class="text-center" width= "30%">Status</th>
                                    <th class="text-center" width= "10%">Action</th>
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
@include('esakip.dashboard.components.modal-create')
@include('esakip.dashboard.components.modal-edit')
@endsection

@section('js')
@include('esakip.dashboard.components.js-index')
@include('esakip.dashboard.components.js-create')
@include('esakip.dashboard.components.js-edit')
@endsection