@extends('keuangan.layouts.main')

@section('title')
Laporan PO - Keuangan
@endsection


@section('content')


<!-- Page Content -->   
<div class="mt-20">
    <div class="block">
        <form method="GET" action="{{url()->current()}}/cetak">
            {{csrf_field()}}
            <div class="block-content block-content-full">
                <h4>Laporan PO - Realisasi Pengadaan UKPBJ</h4>
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
                        <h6 class="pt-10">Jenis</h6>
                    </div>
                    <div class="col-3">
                        <select class="form-control js-select2" id="jenis">
                            <option value="0" selected>Semua</option>
                            <option value="Farmasi">Bekkes</option>
                            <option value="Umum">Bekkum</option>
                            <option value="Konstruksi">Konstruksi</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-2">
                        <h6 class="pt-10"></h6>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- END Page Content -->
@endsection

@section('js')
<script type="text/javascript">
    function CetakFormat() {
        var start = $('#tanggal_awal').data('datepicker').getFormattedDate('dd-mm-yyyy');
        var end = $('#tanggal_akhir').data('datepicker').getFormattedDate('dd-mm-yyyy');
        var jenis = $('#jenis').val();

        var url ="{{url()->current()}}/cetak?tanggal_awal="+start+"&tanggal_akhir="+end+"&jenis="+jenis;
        popupwindow(url,'Laporan PO',1000,700);
    }
</script>
@endsection