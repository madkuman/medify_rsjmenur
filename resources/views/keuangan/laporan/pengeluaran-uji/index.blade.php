@extends('keuangan.layouts.main')

@section('title')
Laporan Rekap Pengeluaran - Keuangan
@endsection


@section('content')


<!-- Page Content -->   
<div class="mt-20">
    <div class="block">
        <div class="block-content block-content-full">
            <h4>Laporan Pengeluaran - UJI</h4>
            <hr>
            <div class="row mb-10">
                <div class="col-2">
                    <h6 class="pt-10">Pilih Tanggal</h6>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <div class="input-daterange input-group" data-date-format="dd MM yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" id="uji_awal" name="uji_awal" placeholder="From" data-week-start="1" data-autoclose="true" autocomplete="off" required="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" id="uji_akhir" name="uji_akhir" placeholder="To" data-week-start="1" data-autoclose="true" autocomplete="off" required="true">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-2">
                    <h6 class="pt-10">Rekanan</h6>
                </div>
                <div class="col-3">
                    <select class="form-control js-select2" id="perusahaan">
                        <option value="0">Semua</option>
                        @foreach($perusahaan as $item)
                        <option value="{{$item->id}}">{{$item->nama}} ({{$item->direktur or '-'}})</option>
                        @endforeach
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
                <div class="col-2">
                    <button class="btn btn-primary" onclick="Cetak()">Cetak</button>
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
        var start = $('#uji_awal').data('datepicker').getFormattedDate('dd-mm-yyyy');
        var end = $('#uji_akhir').data('datepicker').getFormattedDate('dd-mm-yyyy');
        var perusahaan = $('#perusahaan').val();
        var status_terbayar = $('#status-terbayar').val();

        var url ="{{url()->current()}}/laporanuji?uji_awal="+start+"&uji_akhir="+end+"&status_terbayar="+status_terbayar+"&perusahaan="+perusahaan;
        popupwindow(url,'Laporan UJI',1000,700);
    }
</script>
@endsection