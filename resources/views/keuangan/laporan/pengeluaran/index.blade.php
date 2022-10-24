@extends('keuangan.layouts.main')

@section('title')
Laporan Rekap Pengeluaran - Keuangan
@endsection


@section('content')


<!-- Page Content -->   
<div class="mt-20">
    <div class="row">
        <div class="col-12">
            <div class="block">
                <div class="block-content block-content-full">
                    <div class="row" style="margin-left: 0px;">
                        <div class="col-3">
                            <form method="get" action="{{url()->current()}}/cetak">
                                <h5 class="mb-0">Rekap Pengeluaran - Bulanan</h5>
                                <div class="form-group">
                                    <label>Pilih Bulan</label>
                                    <input type="text" required class="form-control" id="cetakRekapDate" name="bulan" autocomplete="off" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" required placeholder="yyyy-mm">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Cetak</button>
                                </div>
                            </form>
                        </div> 
                        {{--<!--<div class="col-1"></div>
                        <div class="col-3">
                            <form method="get">
                                <h5 class="mb-0">Laporan BK Terbayar</h5>
                                <div class="form-group">
                                    <label>Pilih Tanggal</label>
                                    <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                        <input type="text" class="js-datepicker form-control" id="bk_awal" name="bk_awal" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" autocomplete="off" required="true">
                                        <div class="input-group-prepend input-group-append">
                                            <span class="input-group-text font-w600">to</span>
                                        </div>
                                        <input type="text" class="js-datepicker form-control" id="bk_akhir" name="bk_akhir" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" autocomplete="off" required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" onclick="BK()">Cetak</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-1"></div>
                        <div class="col-3">
                            <form method="get">
                                <h5 class="mb-0">Laporan Penyetoran Pajak</h5>
                                <div class="form-group">
                                    <label>Pilih Tanggal</label>
                                    <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                        <input type="text" class="form-control" id="pajak_awal" name="pajak_awal" placeholder="From" data-week-start="1" data-autoclose="true" autocomplete="off" required="true">
                                        <div class="input-group-prepend input-group-append">
                                            <span class="input-group-text font-w600">to</span>
                                        </div>
                                        <input type="text" class="form-control" id="pajak_akhir" name="pajak_akhir" placeholder="To" data-week-start="1" data-autoclose="true" autocomplete="off" required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" onclick="Pajak()">Cetak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="row" style="margin-left: 0px;">
                        <div class="col-3">
                            <form method="get">
                                <h5 class="mb-0">Laporan PJK Staf</h5>
                                <div class="form-group">
                                    <label>Pilih Tanggal</label>
                                    <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                        <input type="text" class="form-control" id="pjk_awal" name="pjk_awal" placeholder="From" data-week-start="1" data-autoclose="true" autocomplete="off" required="true">
                                        <div class="input-group-prepend input-group-append">
                                            <span class="input-group-text font-w600">to</span>
                                        </div>
                                        <input type="text" class="form-control" id="pjk_akhir" name="pjk_akhir" placeholder="To" data-week-start="1" data-autoclose="true" autocomplete="off" required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" onclick="PJK()">Cetak</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-3">
                            <form method="get">
                                <h5 class="mb-0">Laporan SPP</h5>
                                <div class="form-group">
                                    <label>Pilih Tanggal</label>
                                    <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                        <input type="text" class="form-control" id="spp_awal" name="spp_awal" placeholder="From" data-week-start="1" data-autoclose="true" autocomplete="off" required="true">
                                        <div class="input-group-prepend input-group-append">
                                            <span class="input-group-text font-w600">to</span>
                                        </div>
                                        <input type="text" class="form-control" id="spp_akhir" name="spp_akhir" placeholder="To" data-week-start="1" data-autoclose="true" autocomplete="off" required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" onclick="SPP()">Cetak</button>
                                </div>
                            </form>
                        </div> -->--}}
                    </div>
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

    function SPP() {
        var start = $('#spp_awal').val();
        var end = $('#spp_akhir').val();
        var url ="{{url()->current()}}/laporanspp?spp_awal="+start+"&spp_akhir="+end;
        popupwindow(url,'Laporan SPP',100,100);

    }

    function PJK() {
        var start = $('#pjk_awal').val();
        var end = $('#pjk_akhir').val();
        var url ="{{url()->current()}}/laporanpjk?pjk_awal="+start+"&pjk_akhir="+end;
        popupwindow(url,'Laporan PJK',100,100);

    }

    function Pajak() {
        var start = $('#pajak_awal').val();
        var end = $('#pajak_akhir').val();
        var url ="{{url()->current()}}/laporanpajak?pajak_awal="+start+"&pajak_akhir="+end;
        popupwindow(url,'Laporan Pajak',100,100);

    }

    function BK() {
        var start = $('#bk_awal').val();
        var end = $('#bk_akhir').val();
        var url ="{{url()->current()}}/laporanbk?bk_awal="+start+"&bk_akhir="+end;
        popupwindow(url,'Laporan BK',100,100);

    }
</script>
@endsection