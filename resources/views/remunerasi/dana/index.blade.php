@extends('remunerasi.layouts.main')

@section('title')
Remunerasi - Riwayat Dana
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
                <span><h4 class="mb-0">Riwayat Dana</h4><hr>
                <h5></h5></span>
                <input type="text" class="d-none" id="today" value="">
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-primary btn-hero" id="btn-modal-create">
                        <i class="fa fa-plus"></i> Dana Baru
                    </button>
                </div>
            </div>
            
            <div class="block-content py-20">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-striped table-vcenter table-sm js-dataTable-full" id="example" width= "100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width= "5%">#</th>
                                    <th class="text-center" width= "20%">Nominal Dana</th>
                                    <th class="text-center" width= "25%">Tanggal</th>
                                    <th class="text-center" width= "25%">Action</th>
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
@include('remunerasi.dana.components.js.js-index')
@include('remunerasi.dana.components.js.js-edit')
@include('remunerasi.dana.components.modal.modal-create')
@include('remunerasi.dana.components.modal.modal-edit')
@endsection