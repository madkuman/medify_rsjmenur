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

    $(".js-datepicker-month").datepicker( {
        format: "yyyy-mm",
        startView: "months", 
        minViewMode: "months"
    });
    $(".js-datepicker-year").datepicker( {
        format: "yyyy",
        startView: "years", 
        minViewMode: "years"
    });
</script>
@endsection