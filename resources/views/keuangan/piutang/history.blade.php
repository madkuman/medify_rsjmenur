@extends('keuangan.layouts.main')

@section('title')
Histori Tagihan & Piutang - Keuangan
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/datatables.min.css')}}"/>
<style>
.dataTables_processing {
    background-color: white;
}
</style>
@endsection
@section('content')
@include('keuangan.piutang.components.header')
<div class="row">
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-header py-20">
                <h4 class="mb-0">History Tagihan dan Piutang</h4>
            </div>
            <div class="block-content py-20"> 
                <div class="row">
                    @include('keuangan.piutang.components.filter')
                    <div class="col-3">
                        <label>Status Terbayar</label>
                        <select class="js-select2 form-control" id="filter_status_terbayar" name="filter_status_terbayar" style="width: 100%;">
                            <option value="all" selected>All Data</option>
                            <option value="paid">Terbayar</option>
                            <option value="unpaid">Belum Terbayar</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="tabel">
                        <table id="transaksiTable" class="table table-striped table-hover table-vcenter js-dataTable-simple">
                            <thead>
                                <tr>
                                   <th class="text-center" style="width: 1%;">#</th>
                                   <th class="text-left" style="width: 23%;">Judul</th>
                                   <th class="text-left" style="width: 15%;">Debitur</th>
                                   <th class="text-center" style="width: 10%;">Tanggal</th>
                                   <th class="text-right" style="width: 12%;">Lokasi</th>
                                   <th class="text-right" style="width: 12%;">Total</th>
                                   <th class="text-right" style="width: 12%;">Total Terbayar</th>
                                   <th class="text-center" style="width: 12%;">Aksi</th>
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

<script type="text/javascript">
var lokasi_rj = JSON.parse('{!! json_encode($lokasi_rj) !!}')
var lokasi_ri = JSON.parse('{!! json_encode($lokasi_ri) !!}')
var dep_rj = "{{$rawat_jalan}}"
var dep_ri = "{{$rawat_inap}}"
$("#kategori_date").select2();
var filter = "all";
var asal_layanan;
var transaksiIdSerial;
var lokasi_selected = 'all';
</script>

@include('keuangan.piutang.components-history.js')
<script src="{{URL::to('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::to('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
@endsection