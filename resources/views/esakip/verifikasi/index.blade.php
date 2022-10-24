@extends('esakip.layouts.main')

@section('title')
E-Sakip - Dashboard
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
                <span><h4 class="mb-0">Verifikasi</h4><hr>
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
@endsection

@section('js')
@include('esakip.verifikasi.components.js-index')
@endsection