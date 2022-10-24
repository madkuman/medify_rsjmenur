@extends('rawatjalan.layouts.main')

@section('title')
{{$poli->name}} - Rawat Jalan - Medify
@endsection

@section('subtitle')
{{$poli->name}}
@endsection

@section('content')
<main id="main-container">
    @include('rawatjalan.layouts.navbar')
    <div class="container">
        <h4>Daftar Antrian</h4>
        @include('rawatjalan.antrian.component-antrian')
    </div>
</main>

<form method="POST" action="{{url('rawatjalan/transaksi')}}/cancel" id="formBatal">
    {{csrf_field()}}
    <input type="hidden" id="cancel_id" name="id">
    <input type="hidden" id="cancel_keterangan" name="keterangan">
    <input type="hidden" id="poli_id" name="poli_id" value="{{$poli->id}}">
    <input type="hidden" id="url" name="url" value="rawatjalan-single">
</form>

@endsection

@section('js')
<script type="text/javascript">
    $('input[type="text"]').keyup(function(){

    var that = this, $allListElements = $('.toSearch');
    $(".panel").toggle(true);
    var $matchingListElements = $allListElements.filter(function(i, li){
        var listItemText = $(li).text().toUpperCase(), 
        searchText = that.value.toUpperCase();
        return ~listItemText.indexOf(searchText);
    });

    $allListElements.hide();
    $matchingListElements.show();

});

function confirmSwalBatalkan(id)
{
    swal({
        title: 'Apa anda yakin?',
        input: 'text',
        text: "Mengapa anda membatalkan transaksi ini?",
        type: 'warning',
        confirmButtonClass: 'btn btn-primary',
        cancelButtonClass: 'btn btn-outline-danger',
        showCancelButton: true,
        confirmButtonText: 'Tolak Transaksi',
        cancelButtonText: 'Batal',
        inputValidator: (value) => {
            return !value && 'Masukan Alasan Pembatalan!'
        }
    }).then((result) => {
        if (result.value) {
            $('#cancel_keterangan').val(result.value)            
            $('#cancel_id').val(id)
            $('#formBatal').submit()
        }
    })
}
</script>

@endsection