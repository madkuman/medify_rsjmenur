@extends('keuangan.layouts.main')

@section('title')
Laporan Rekap Pengeluaran - Keuangan
@endsection


@section('content')


<!-- Page Content -->   
<div class="mt-20">
    <div class="block">
        <div class="block-content block-content-full">
            <h4>Laporan Pengeluaran - SPP</h4>
            <hr>
            <div class="row mb-10">
                <div class="col-2">
                    <h6 class="pt-10">Pilih Tanggal</h6>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <div class="input-daterange input-group" data-date-format="dd MM yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control" id="spp_awal" name="spp_awal" placeholder="From" data-week-start="1" data-autoclose="true" autocomplete="off" required="true">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text font-w600">to</span>
                            </div>
                            <input type="text" class="form-control" id="spp_akhir" name="spp_akhir" placeholder="To" data-week-start="1" data-autoclose="true" autocomplete="off" required="true">
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
                        <option value="0">Semua</option>
                        @foreach($perusahaan as $item)
                        <option value="{{$item->id}}">{{$item->nama}} ({{$item->direktur or '-'}})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-10">
                <div class="col-2">
                    <h6 class="pt-10">Mata Anggaran</h6>
                </div>
                <div class="col-3">
                    <select class="form-control js-select2" id="kategori">
                        <option value="0">Semua</option>
                        @foreach($kategori as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
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
        var start = $('#spp_awal').data('datepicker').getFormattedDate('dd-mm-yyyy');
        var end = $('#spp_akhir').data('datepicker').getFormattedDate('dd-mm-yyyy');
        var kategori = $('#kategori').val();
        var perusahaan = $('#perusahaan').val();
        var status_terbayar = $('#status-terbayar').val();

        var url ="{{url()->current()}}/laporanspp?spp_awal="+start+"&spp_akhir="+end+"&status_terbayar="+status_terbayar+"&kategori="+kategori+"&perusahaan="+perusahaan;
        popupwindow(url,'Laporan SPP',1000,700);
    }

    function CetakFormat2() {
        var start = $('#spp_awal').data('datepicker').getFormattedDate('dd-mm-yyyy');
        var end = $('#spp_akhir').data('datepicker').getFormattedDate('dd-mm-yyyy');
        var kategori = $('#kategori').val();
        var perusahaan = $('#perusahaan').val();
        var status_terbayar = $('#status-terbayar').val();

        var url ="{{url()->current()}}/laporanspp-detail?spp_awal="+start+"&spp_akhir="+end+"&status_terbayar="+status_terbayar+"&kategori="+kategori+"&perusahaan="+perusahaan;
        popupwindow(url,'Laporan SPP',1000,700);
    }
</script>
@endsection