@extends('keuangan.layouts.main')

@section('title')
Laporan Transaksi File Pengadaan - Keuangan
@endsection


@section('content')


<!-- Page Content -->   
<div class="mt-20">
    <div class="block">
        <div class="block-content block-content-full">
            <h4>Laporan Pengeluaran - Transaksi File Pengadaan</h4>
            <hr>
            <div class="row mb-10">
                <div class="col-2">
                    <h6 class="pt-10">Pilih Tanggal</h6>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <div class="input-daterange input-group" data-date-format="dd MM yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" id="tanggal_awal" name="tanggal_awal" placeholder="From" data-week-start="1" data-autoclose="true" autocomplete="off" required="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" id="tanggal_akhir" name="tanggal_akhir" placeholder="To" data-week-start="1" data-autoclose="true" autocomplete="off" required="true">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-2">
                    <h6 class="pt-10">Rekanan/Perusahaan</h6>
                </div>
                <div class="col-3">
                    <select class="form-control js-select2" id="perusahaan">
                        <option value="0" selected>Semua</option>
                        @foreach($perusahaan as $item)
                        <option value="{{$item->id}}">{{$item->nama}} ({{$item->direktur or '-'}})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-2">
                    <h6 class="pt-10"></h6>
                </div>
                <div class="col-2">
                    <button class="btn btn-primary" onclick="CetakFormat()">Cetak Laporan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END Page Content -->
@endsection

@section('js')
<script type="text/javascript">
    $("#cetakRekapDate").datepicker( {
        format: "yyyy-mm",
        startView: "months", 
        minViewMode: "months"
    });

    function CetakFormat() {
        var start = $('#tanggal_awal').data('datepicker').getFormattedDate('dd-mm-yyyy');
        var end = $('#tanggal_akhir').data('datepicker').getFormattedDate('dd-mm-yyyy');
        var rekanan = $('#perusahaan').val();

        var url ="{{url()->current()}}/print?tanggal_awal="+start+"&tanggal_akhir="+end+"&perusahaan="+rekanan;
        popupwindow(url,'Laporan Transaksi File Pengadaan',1000,700);
    }
</script>
@endsection