@extends('gizi.layouts.index')

@section('title')
Gizi Laporan
@endsection

@section('content')
<div class="container">
    <div class="block-content">
        <div class="row row-deck">
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Permintaan Makanan Pasien</h3>
                    </div>
                    <div class="block-content">
                        <p>Permintaan Makanan Pasien</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-permintaan-makanan">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Surat Pemesanan Makanan</h3>
                    </div>
                    <div class="block-content">
                        <p>Surat Pemesanan Makanan</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-surat-pemesanan-makanan">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Diet Pasien Bulanan</h3>
                    </div>
                    <div class="block-content">
                        <p>Diet Pasien Bulanan</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-diet-pasien-bulanan">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Penyerapan Porsi Makanan Pasien</h3>
                    </div>
                    <div class="block-content">
                        <p>Penyerapan Porsi Makanan Pasien Tahunan</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-penyerapan-porsi-makanan">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Rekap Diet Pelayanan Makanan Pasien</h3>
                    </div>
                    <div class="block-content">
                        <p>Rekap Diet Pelayanan Makanan Pasien Bulanan</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-rekap-diet-pelayanan-makanan-pasien">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('gizi.laporan.modal.laporan-modal')

{{--    <div class="row">--}}
{{--        <div class="col-6 col-md-4 col-xl-3">--}}
{{--            <div class="block block-bordered" style="height: 285px !important">--}}
{{--                <div class="block-header">--}}
{{--                    <div class="block-title text-center">--}}
{{--                       Laporan Belanja Bahan--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="block-content block-content-full text-center">--}}
{{--                    Menampilkan laporan belanja untuk seluruh bahan pada rentang waktu tertentu.--}}
{{--                </div>--}}
{{--                <div class="block-content block-content-full text-center">--}}
{{--                    <button type="button" class="btn btn-secondary edit-button" onclick="sweetTalking2();" data-title="Laporan Kunjungan Harian">Buat Laporan</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-6 col-md-4 col-xl-3">--}}
{{--            <div class="block block-bordered" style="height: 285px !important">--}}
{{--                <div class="block-header">--}}
{{--                    <div class="block-title text-center">--}}
{{--                       Laporan Belanja Dinas--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="block-content block-content-full text-center">--}}
{{--                    Menampilkan laporan belanja untuk seluruh bahan pada rentang waktu tertentu.--}}
{{--                </div>--}}
{{--                <div class="block-content block-content-full text-center">--}}
{{--                    <button type="button" class="btn btn-secondary edit-button" onclick="sweetTalking3();" data-title="Laporan Kunjungan Harian">Buat Laporan</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-6 col-md-4 col-xl-3">--}}
{{--            <div class="block block-bordered" style="height: 285px !important">--}}
{{--                <div class="block-header">--}}
{{--                    <div class="block-title text-center">--}}
{{--                       Laporan Belanja Hankam--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="block-content block-content-full text-center">--}}
{{--                    Menampilkan laporan belanja untuk seluruh bahan pada rentang waktu tertentu.--}}
{{--                </div>--}}
{{--                <div class="block-content block-content-full text-center">--}}
{{--                    <button type="button" class="btn btn-secondary edit-button" onclick="sweetTalking4();" data-title="Laporan Kunjungan Harian">Buat Laporan</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--         <div class="col-6 col-md-4 col-xl-3">--}}
{{--            <div class="block block-bordered" style="height: 285px !important">--}}
{{--                <div class="block-header">--}}
{{--                    <div class="block-title text-center">--}}
{{--                       Laporan Belanja Non Hankam--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="block-content block-content-full text-center">--}}
{{--                    Menampilkan laporan belanja untuk seluruh bahan pada rentang waktu tertentu.--}}
{{--                </div>--}}
{{--                <div class="block-content block-content-full text-center">--}}
{{--                    <button type="button" class="btn btn-secondary edit-button" onclick="sweetTalking5();" data-title="Laporan Kunjungan Harian">Buat Laporan</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row">--}}
{{--        <div class="col-6 col-md-4 col-xl-3">--}}
{{--            <div class="block block-bordered" style="height: 285px !important">--}}
{{--                <div class="block-header">--}}
{{--                    <div class="block-title text-center">--}}
{{--                       Laporan Belanja Jamkesmas--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="block-content block-content-full text-center">--}}
{{--                    Menampilkan laporan belanja untuk seluruh bahan pada rentang waktu tertentu.--}}
{{--                </div>--}}
{{--                <div class="block-content block-content-full text-center">--}}
{{--                    <button type="button" class="btn btn-secondary edit-button" onclick="sweetTalking6();" data-title="Laporan Kunjungan Harian">Buat Laporan</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-6 col-md-4 col-xl-3">--}}
{{--            <div class="block block-bordered" style="height: 285px !important">--}}
{{--                <div class="block-header">--}}
{{--                    <div class="block-title text-center">--}}
{{--                       Laporan Belanja PC--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="block-content block-content-full text-center">--}}
{{--                    Menampilkan laporan belanja untuk seluruh bahan pada rentang waktu tertentu.--}}
{{--                </div>--}}
{{--                <div class="block-content block-content-full text-center">--}}
{{--                    <button type="button" class="btn btn-secondary edit-button" onclick="sweetTalking7();" data-title="Laporan Kunjungan Harian">Buat Laporan</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>        --}}
{{--</div>--}}
{{--<div id="modalTanggal2" class="modal fade " role="dialog">--}}
{{--    <div class="modal-dialog modal-dialog-centered modal-bg">--}}
{{--        <div class="modal-content ">--}}
{{--            <div class="modal-body">--}}
{{--                <form method="get" action="{{url('gizi/laporan/laporan-bahan')}}">--}}
{{--                    {{ csrf_field() }}--}}
{{--                    <input type="hidden" name="flag" value="0">--}}
{{--                    <div name="modal-title" class="font-size-lg font-w600">Modal Header</div>--}}
{{--                    <p class="mb-30">Pilih tanggal yang anda butuhkan.</p>--}}
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-12" for="example-daterange1">Date Range</label>--}}
{{--                        <div class="col-lg-8">--}}
{{--                            <div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--                                <input autocomplete="off" type="text" class="form-control" id="example-daterange1" name="daterange1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--                                <div class="input-group-prepend input-group-append">--}}
{{--                                    <span class="input-group-text font-w600">to</span>--}}
{{--                                </div>--}}
{{--                                <input autocomplete="off" type="text" class="form-control" id="example-daterange2" name="daterange2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div id="formid"> </div>--}}

{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
{{--                        <button type="submit" class="btn btn-success" >Print</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div id="modalTanggal3" class="modal fade " role="dialog">--}}
{{--    <div class="modal-dialog modal-dialog-centered modal-bg">--}}
{{--        <div class="modal-content ">--}}
{{--            <div class="modal-body">--}}
{{--                <form method="get" action="{{url('gizi/laporan/laporan-bahan')}}">--}}
{{--                    {{ csrf_field() }}--}}
{{--                     <input type="hidden" name="flag" value="1">--}}
{{--                    <div name="modal-title" class="font-size-lg font-w600">Modal Header</div>--}}
{{--                    <p class="mb-30">Pilih tanggal yang anda butuhkan.</p>--}}
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-12" for="example-daterange1">Date Range</label>--}}
{{--                        <div class="col-lg-8">--}}
{{--                            <div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--                                <input autocomplete="off" type="text" class="form-control" id="example-daterange1" name="daterange1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--                                <div class="input-group-prepend input-group-append">--}}
{{--                                    <span class="input-group-text font-w600">to</span>--}}
{{--                                </div>--}}
{{--                                <input autocomplete="off" type="text" class="form-control" id="example-daterange2" name="daterange2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div id="formid"> </div>--}}

{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
{{--                        <button type="submit" class="btn btn-success" >Print</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div id="modalTanggal4" class="modal fade " role="dialog">--}}
{{--    <div class="modal-dialog modal-dialog-centered modal-bg">--}}
{{--        <div class="modal-content ">--}}
{{--            <div class="modal-body">--}}
{{--                <form method="get" action="{{url('gizi/laporan/laporan-bahan')}}">--}}
{{--                    {{ csrf_field() }}--}}
{{--                     <input type="hidden" name="flag" value="2">--}}
{{--                    <div name="modal-title" class="font-size-lg font-w600">Modal Header</div>--}}
{{--                    <p class="mb-30">Pilih tanggal yang anda butuhkan.</p>--}}
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-12" for="example-daterange1">Date Range</label>--}}
{{--                        <div class="col-lg-8">--}}
{{--                            <div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--                                <input autocomplete="off" type="text" class="form-control" id="example-daterange1" name="daterange1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--                                <div class="input-group-prepend input-group-append">--}}
{{--                                    <span class="input-group-text font-w600">to</span>--}}
{{--                                </div>--}}
{{--                                <input autocomplete="off" type="text" class="form-control" id="example-daterange2" name="daterange2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div id="formid"> </div>--}}

{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
{{--                        <button type="submit" class="btn btn-success" >Print</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div id="modalTanggal5" class="modal fade " role="dialog">--}}
{{--    <div class="modal-dialog modal-dialog-centered modal-bg">--}}
{{--        <div class="modal-content ">--}}
{{--            <div class="modal-body">--}}
{{--                <form method="get" action="{{url('gizi/laporan/laporan-bahan')}}">--}}
{{--                    {{ csrf_field() }}--}}
{{--                     <input type="hidden" name="flag" value="3">--}}
{{--                    <div name="modal-title" class="font-size-lg font-w600">Modal Header</div>--}}
{{--                    <p class="mb-30">Pilih tanggal yang anda butuhkan.</p>--}}
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-12" for="example-daterange1">Date Range</label>--}}
{{--                        <div class="col-lg-8">--}}
{{--                            <div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--                                <input autocomplete="off" type="text" class="form-control" id="example-daterange1" name="daterange1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--                                <div class="input-group-prepend input-group-append">--}}
{{--                                    <span class="input-group-text font-w600">to</span>--}}
{{--                                </div>--}}
{{--                                <input autocomplete="off" type="text" class="form-control" id="example-daterange2" name="daterange2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div id="formid"> </div>--}}

{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
{{--                        <button type="submit" class="btn btn-success" >Print</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div id="modalTanggal6" class="modal fade " role="dialog">--}}
{{--    <div class="modal-dialog modal-dialog-centered modal-bg">--}}
{{--        <div class="modal-content ">--}}
{{--            <div class="modal-body">--}}
{{--                <form method="get" action="{{url('gizi/laporan/laporan-bahan')}}">--}}
{{--                    {{ csrf_field() }}--}}
{{--                     <input type="hidden" name="flag" value="4">--}}
{{--                    <div name="modal-title" class="font-size-lg font-w600">Modal Header</div>--}}
{{--                    <p class="mb-30">Pilih tanggal yang anda butuhkan.</p>--}}
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-12" for="example-daterange1">Date Range</label>--}}
{{--                        <div class="col-lg-8">--}}
{{--                            <div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--                                <input autocomplete="off" type="text" class="form-control" id="example-daterange1" name="daterange1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--                                <div class="input-group-prepend input-group-append">--}}
{{--                                    <span class="input-group-text font-w600">to</span>--}}
{{--                                </div>--}}
{{--                                <input autocomplete="off" type="text" class="form-control" id="example-daterange2" name="daterange2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div id="formid"> </div>--}}

{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
{{--                        <button type="submit" class="btn btn-success" >Print</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div id="modalTanggal7" class="modal fade " role="dialog">--}}
{{--    <div class="modal-dialog modal-dialog-centered modal-bg">--}}
{{--        <div class="modal-content ">--}}
{{--            <div class="modal-body">--}}
{{--                <form method="get" action="{{url('gizi/laporan/laporan-bahan')}}">--}}
{{--                    {{ csrf_field() }}--}}
{{--                     <input type="hidden" name="flag" value="5">--}}
{{--                    <div name="modal-title" class="font-size-lg font-w600">Modal Header</div>--}}
{{--                    <p class="mb-30">Pilih tanggal yang anda butuhkan.</p>--}}
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-12" for="example-daterange1">Date Range</label>--}}
{{--                        <div class="col-lg-8">--}}
{{--                            <div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--                                <input autocomplete="off" type="text" class="form-control" id="example-daterange1" name="daterange1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--                                <div class="input-group-prepend input-group-append">--}}
{{--                                    <span class="input-group-text font-w600">to</span>--}}
{{--                                </div>--}}
{{--                                <input autocomplete="off" type="text" class="form-control" id="example-daterange2" name="daterange2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div id="formid"> </div>--}}

{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
{{--                        <button type="submit" class="btn btn-success" >Print</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div> --}}
@endsection

@section('js')
<script type="text/javascript">

    $(document).ready(function() {
        $(".js-datepicker-year").datepicker( {
            format: "yyyy",
            startView: "years",
            minViewMode: "years"
        });
        $(".js-datepicker-month").datepicker( {
            format: "mm-yyyy",
            startView: "months",
            minViewMode: "months"
        });
    });

    $('.btn-excel').on('click', function(e){
        var $this = $(this).parents('form');
            $this.unbind('submit').submit();
    });
	// function sweetTalking2(id)
    // {
    //     $("#modalTanggal2").modal("show");
    //
    // }
    // function sweetTalking3(id)
    // {
    //     $("#modalTanggal3").modal("show");
    //
    // }
    // function sweetTalking4(id)
    // {
    //     $("#modalTanggal4").modal("show");
    //
    // }
    // function sweetTalking5(id)
    // {
    //     $("#modalTanggal5").modal("show");
    //
    // }
    // function sweetTalking6(id)
    // {
    //     $("#modalTanggal6").modal("show");
    //
    // }
    // function sweetTalking7(id)
    // {
    //     $("#modalTanggal7").modal("show");
    //
    // }
</script>
@endsection