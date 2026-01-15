@extends('layouts.main2')
@section('title')
Laporan
@endsection
@section('css')

@endsection
@section('content')
@include('labpk.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Cetak Laporan LabPK</h3>
        </div>
        <div class="block-content">
            @include('labpk.laporan.content-files')
        </div>
    </div>
    {{Form::close()}}
</div>
@include('labpk.components.footer')
@endsection

@section('js')


<script type="text/javascript">
    $(document).on('click', '.btn-submit', function(){
        $(this).closest('form').unbind('submit').submit();
    })

    jQuery('.js-dataTable-full').dataTable({
        "ordering": true,
        pageLength: 10,
        lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
        autoWidth: false
    });

    $(".datepicker-month").datepicker( {
        format: "yyyy-mm",
        startView: "months", 
        minViewMode: "months"
    });
    $(".js-datepicker-year").datepicker( {
        format: "yyyy",
        startView: "years", 
        minViewMode: "years"
    });
    $('.jenis_laporan').on('change', function(){
        var jenis_laporan = $(this).val();
        if(jenis_laporan == 'tahunan') {
            $('.col-year').show();
            $('.js-datepicker-year').attr('disabled', false);
            $('.col-month').hide();
            $('.js-datepicker-month').attr('disabled', true);
            $('.col-rentang-tanggal').hide();
            $('.input-daterange-start').attr('disabled', true);
            $('.input-daterange-end').attr('disabled', true);
        } else if (jenis_laporan == 'bulanan')  {
            $('.js-datepicker-year').attr('disabled', true);
            $('.js-datepicker-month').attr('disabled', false);
            $('.input-daterange-start').attr('disabled', true);
            $('.input-daterange-end').attr('disabled', true);
            $('.col-year').hide();
            $('.col-month').show();
            $('.col-rentang-tanggal').hide();
        } else if (jenis_laporan == 'rentang-tanggal')  {
            $('.js-datepicker-year').attr('disabled', true);
            $('.js-datepicker-month').attr('disabled', true);
            $('.input-daterange-start').attr('disabled', false);
            $('.input-daterange-end').attr('disabled', false);
            $('.col-year').hide();
            $('.col-month').hide();
            $('.col-rentang-tanggal').show();
        };
    });
</script>
@endsection