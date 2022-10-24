@extends('keuangan.layouts.main')

@section('css')

@endsection

@section('title')
Deposit #{{$deposit->id}} - Keuangan
@endsection

@section('content')


<!-- Page Content -->

@include('keuangan.deposit.components-single')

<!-- END Page Content -->
@endsection

@section('js')
<script type="text/javascript" src="{{asset('assets\js\jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets\js\dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var oTable = $("#histori-deposit").DataTable({
        scrollX: true,
    });

    $('.btn-delete').click(function(){
        $('#modal-delete-confirmation').modal('show')
        $('#modal-input-id').val($(this).data("id"))
    })
</script>
@endsection
