@extends('unit-tindakan.layouts.main')

@section('title')
Histori Transaksi - {{$tindakan->nama}} - Unit Tindakan
@endsection

@section('subtitle')
{{$tindakan->nama}} / Histori
@endsection

@section('css')

<style type="text/css">

.clickable-row {
    cursor: pointer;
}
</style>
@endsection
@section('content')
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Transaksi Unit {{$tindakan->nama}}</h3>
    </div>
    <div class="block-content">
        <h5><small>FILTER</small></h5>
        <form method="GET" action="">
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-lg-4 form-group">
                    <label>Range Tanggal</label>
                    <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        <input type="text" class="form-control" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_start}}">
                        <div class="input-group-prepend input-group-append">
                            <span class="input-group-text font-w600">to</span>
                        </div>
                        <input type="text" class="form-control" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_end}}">
                    </div>
                </div>
                <div class="col-sm-12 col-xs-12 col-lg-2 form-group">
                    <label>&nbsp;</label>
                    <button class="btn btn-primary btn-block">Filter</button>
                </div>
            </div>
        </form>
        <hr>
        <div style="overflow: auto;">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
                <thead>
                    <tr>
                        <th>No RM</th>
                        <th width="35%">Nama Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>Usia</th>
                        <th>Lokasi</th>
                        <th>Tanggal</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @include('unit-tindakan.histori.tr')
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection


@section('js')



<script type="text/javascript">
    jQuery('.js-dataTable-full').dataTable({
        "ordering": true,
        pageLength: 8,
        lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
        autoWidth: false
    });
</script>
@endsection