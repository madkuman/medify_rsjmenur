@extends('layouts.main2')
@section('title')
Laboratorium Patologi Anatomi
@endsection
@section('css')

@endsection
@section('content')
@include('labpa.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Cetak Laporan</h3>
        </div>
        <div class="block-content">
            @include('labpa.laporan.content-files')
        </div>
    </div>
</div>
@include('labpa.components.footer')
@endsection

@section('js')


<script type="text/javascript">
    $(document).ready(function(){

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
    });
</script>
@endsection