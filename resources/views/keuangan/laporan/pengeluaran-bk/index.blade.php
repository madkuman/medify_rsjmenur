@extends('keuangan.layouts.main')

@section('title')
Laporan Rekap Pengeluaran - Keuangan
@endsection


@section('content')


<!-- Page Content -->   
<div class="mt-20">
    <div class="block">
        <div class="block-content block-content-full">
            <h4>Laporan Pengeluaran - BK</h4>
            <hr>
            <div class="row mb-10">
                <div class="col-2">
                    <h6 class="pt-10">Pilih Tanggal</h6>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <div class="input-daterange input-group" data-date-format="dd MM yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" id="bk_awal" name="bk_awal" placeholder="From" data-week-start="1" data-autoclose="true" autocomplete="off" required="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" id="bk_akhir" name="bk_akhir" placeholder="To" data-week-start="1" data-autoclose="true" autocomplete="off" required="true">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-2">
                    <h6 class="pt-10"></h6>
                </div>
                <div class="col-2">
                    <button class="btn btn-primary" onclick="CetakFormat1()">Cetak Format Standard</button>
                </div>
                <div class="col-2">
                    <button class="btn btn-primary" onclick="CetakFormat2()">Cetak Format Detail</button>
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

    function CetakFormat1() {
        var start = $('#bk_awal').data('datepicker').getFormattedDate('dd-mm-yyyy');
        var end = $('#bk_akhir').data('datepicker').getFormattedDate('dd-mm-yyyy');

        var url ="{{url()->current()}}/laporanbk?bk_awal="+start+"&bk_akhir="+end;
        popupwindow(url,'Laporan BK',1000,700);
    }

    function CetakFormat2() {
        var start = $('#bk_awal').data('datepicker').getFormattedDate('dd-mm-yyyy');
        var end = $('#bk_akhir').data('datepicker').getFormattedDate('dd-mm-yyyy');

        var url ="{{url()->current()}}/laporanbk-detail?bk_awal="+start+"&bk_akhir="+end;
        popupwindow(url,'Laporan BK Detail',1000,700);
    }
</script>
@endsection