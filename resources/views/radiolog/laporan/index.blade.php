@extends('layouts.main2')
@section('title')
Laporan Radiologi
@endsection
@section('css')
@include('radiolog.layouts.css')
@endsection
@section('content')
@include('radiolog.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Cetak Laporan</h3>
        </div>
        <div class="block-content">
            @include('radiolog.laporan.content-files')
        </div>
    </div>
</div>

@include('radiolog.components.footer')
@endsection

@section('js')


<script type="text/javascript">
const errorDate = "Mohon isi tanggal/bulan yang dituju";
const errorDept = "Mohon centang departemen yang dibutuhkan";

$(document).ready(function() {
    @if(session('status'))
    swal(
        '{{session("message")}}',
        "",
        '{{session("status")}}'
    );
    @endif
    $("#cetakBulananPolos").datepicker({
        format: "yyyy-mm",
        startView: "months",
        minViewMode: "months"
    });


    $(document).on('click', '.btn-submit', function(){
        $(this).closest('form').unbind('submit').submit();
    })


    jQuery('.js-dataTable-full').dataTable({
        "ordering": true,
        pageLength: 10,
        lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
        autoWidth: false
    });
    
});

function submitLaporan(type) {
    var target = $(".checkbox-input:checked");
    var dept = [];
    $.each(target, (key, value) => {
        dept.push($(value).val());
    });

    switch (type) {
        case 'pasien-bpjs-bulanan':
            if (!dept.length) {
                swal("Error", errorDept, "error")
                return false;
            }
            var date = $("#cetakBulananPolos").val();
            break;
        case 'histori_bpjs':
            if (!dept.length) {
                swal("Error", errorDept, "error")
                return false;
            }
            var dateStart = $("#tanggalMulaiHistori").val();
            var dateEnd = $("#tanggalAkhirHistori").val();
            if (!dateStart || !dateEnd) {
                swal("Error", errorDate, "error")
                return false;
            }
            window.open(
                "{{url('/radiologi/laporan')}}/" + type + "?dateStart=" + dateStart + "&dateEnd=" + dateEnd + "&dept=" + dept,
                '_blank' // <- This is what makes it open in a new window.
            );
            return false;
        case 'pasien-bpjs-harian':
            var date = $("#cetakHarianPolos").val();
            break;
        case 'pembayaran':
            var dateStart = $("#tanggalMulaiPembayaran").val();
            var dateEnd = $("#tanggalAkhirPembayaran").val();
            if (!dateStart || !dateEnd) {
                swal("Error", errorDate, "error")
                return false;
            }
            window.open(
                "{{url('/radiologi/laporan')}}/" + type + "?dateStart=" + dateStart + "&dateEnd=" + dateEnd + "&dept=" + dept,
                '_blank' // <- This is what makes it open in a new window.
            );
            return false;
        default:
            return false;
    }
    if (!date) {
        swal("Error", errorDate, "error")
        return false;
    }
    window.open(
        "{{url('/radiologi/laporan')}}/" + type + "?date=" + date + "&dept=" + dept,
        '_blank' // <- This is what makes it open in a new window.
    );
}
</script>
@endsection