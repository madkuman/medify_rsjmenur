@extends('keuangan.layouts.main')

@section('title')
Histori Pemasukan - Keuangan
@endsection


@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
</style>
@endsection
@section('content')
@include('keuangan.pemasukan.components.header')
<div class="row">
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-header py-20">
                <h4 class="mb-0">History Transaksi Pemasukan</h4>
            </div>
            <div class="block-content py-20">    
                <div class="row">
                    <div class="col-3">
                        <label>Filter Tanggal</label>
                        <select class="js-select2 form-control" id="kategori" name="kategori" style="width: 100%;">
                            <option value="1" selected>All Data</option>
                            <option value="2">By Date</option>
                        </select>
                    </div>
                    <div class="col-4" id="by-date" style="display: none">
                    <label for="example-datepicker1">Tanggal Transaksi</label>
                        <div class="row">
                        <div class="col-6">
                            <input type="text" class="js-datepicker form-control" id="tanggaltransaksi" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd MM yyyy" placeholder="Masukkan Tanggal" value="" autocomplete="off">
                        </div>
                        <div class="col-2" style="padding-left:0">
                            <button id="buttonRefresh" style="margin-bottom: 5px;" url="" class="btn btn-md btn-alt-primary" data-toggle="tooltip" title="Refresh Transaksi">
                                <i class="fa fa-refresh"></i>
                            </button>
                        </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr>                
                    </div> 
                    <div class="col-12" id="tabel">
                        <table id="transaksiTable" class="table table-striped table-hover table-vcenter js-dataTable-simple">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 5%;">#  </th>
                                    <th class="text-left" style="width: 40%;">Judul  </th>
                                    <th class="text-left" style="width: 20%;">Debitur  </th>
                                    <th class="text-center" style="width: 12.5%;">Tanggal  </th>
                                    <th class="text-right" style="width: 12.5%;">Total  </th>
                                    <th class="text-center" style="width: 10%;">Aksi  </th>
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
<script src="{{asset('js/keuangan/pemasukan/historyv2.js')}}"></script>


@endsection