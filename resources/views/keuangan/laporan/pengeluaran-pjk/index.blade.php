@extends('keuangan.layouts.main')

@section('title')
Laporan Rekap Pengeluaran - Keuangan
@endsection


@section('content')


<!-- Page Content -->   
<div class="mt-20">
    <div class="block">
        <div class="block-content block-content-full">
            <h4>Laporan Pengeluaran - PJK</h4>
            <hr>
            <div class="row mb-10">
                <div class="col-2">
                    <h6 class="pt-10">Pilih Tanggal</h6>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <div class="input-daterange input-group" data-date-format="dd MM yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" id="pjk_awal" name="pjk_awal" placeholder="From" data-week-start="1" data-autoclose="true" autocomplete="off" required="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" id="pjk_akhir" name="pjk_akhir" placeholder="To" data-week-start="1" data-autoclose="true" autocomplete="off" required="true">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-2">
                    <h6 class="pt-10">Akun PJK</h6>
                </div>
                <div class="col-3">
                    <select class="form-control js-select2" id="akun">
                        <option value="0">Semua</option>
                        @foreach($akun as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-2">
                    <h6 class="pt-10">Status SPP</h6>
                </div>
                <div class="col-3">
                    <select class="form-control" id="status-spp">
                        <option value="0">Semua Status</option>
                        <option value="1">Ada SPP</option>
                        <option value="-1">Tidak Ada SPP</option>
                    </select>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-2">
                    <h6 class="pt-10">Status Terbayar</h6>
                </div>
                <div class="col-3">
                    <select class="form-control" id="status-terbayar">
                        <option value="0">Semua Status</option>
                        <option value="1">Terbayar</option>
                        <option value="-1">Belum Terbayar</option>
                    </select>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-2">
                    <h6 class="pt-10"></h6>
                </div>
                <div class="col-3">
                    <h5><button class="btn btn-primary" onclick="Cetak()">Cetak</button></h5>
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

    function Cetak() {
        var start = $('#pjk_awal').data('datepicker').getFormattedDate('dd-mm-yyyy');
        var end = $('#pjk_akhir').data('datepicker').getFormattedDate('dd-mm-yyyy');
        var akun = $('#akun').val();
        var status_spp = $('#status-spp').val();
        var status_terbayar = $('#status-terbayar').val();

        var url ="{{url()->current()}}/laporanpjk?pjk_awal="+start+"&pjk_akhir="+end+"&status_spp="+status_spp+"&status_terbayar="+status_terbayar+"&akun="+akun;
        popupwindow(url,'Laporan PJK',1000,700);
    }
</script>
@endsection