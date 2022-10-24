@extends('rekammedis.layouts.main')

@section('title')
Rekam Medis - Medify
@endsection

@section('css')

@endsection

@section('subtitle')
Dashboard
@endsection

@section('content')
<main id="main-container">
    <div class="container pt-50">

        <div class="block mt-5">
            <div class="p-20">
                <a href="{{url('rekammedis/permintaan')}}"><i class="fa fa-arrow-left"></i> Kembali ke daftar permintaan</a>
            </div>
            <div class="block-content block-content-full text-center p-30 mb-20">
                <h2>PENGIRIMAN FILE</h2>
                <h4 class="mb-5">Kirim File RM berdasarkan Permintaan</h4>
                <p>Masukkan no RM. Gunakan barcode scanner untuk mempercepat proses</p>
                <form id="formSubmit">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-8 col-lg-6">
                            <div class="form-group">
                                <input id="noRM" type="text" class="form-control">
                            </div>
                            <button class="btn btn-primary" id="btnSubmit">Submit</button> 
                            <button class="btn btn-primary" id="btnSubmitLoading" disabled style="display: none">Submit <i class="fa fa-sun-o fa-spin text-white"></i></button> 
                        </div>
                    </div>
                </form>
            </div>
            <div class="block-content block-content-full" id="containerTransaksiMultiple" style="display: none">
                <div class="row justify-content-center">
                    <div class="col-1">
                        No
                    </div>
                    <div class="col-3">
                        <h6 class="font-w400 text-muted">TUJUAN PENGIRIMAN</h6>
                    </div>
                    <div class="col-3">
                        <h6 class="font-w400 text-muted">WAKTU PENGIRIMAN</h6>
                    </div>
                    <div class="col-1">
                        <h6 class="font-w400 text-muted">AKSI</h6>
                    </div>
                </div>
                <div id="contentTransaksiMultiple">
                </div>
            </div>
        </div>
    </div>
</main>

@endsection


@section('js')
<script type="text/javascript">
    $('#formSubmit').submit(function(e){
        e.preventDefault()
        kirimNoRM();
    })

    var is_sending = 0;

    function kirimNoRM(){
        if(is_sending == 0){
            is_sending = 1;
            $('#btnSubmit').hide();
            $('#btnSubmitLoading').show();
            no_rm = $('#noRM').val();
            $.ajax({
                type: "POST",
                url: "{{url()->current()}}",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    no_rm : no_rm
                },
                success: function (data) 
                {
                    $('#containerTransaksiMultiple').hide();
                    if(data.type == 'question') showMultiTransaksi(data.transaksi);
                    callSwal(data.type,data.title,data.text,data.url);
                    $('#noRM').val('');
                    $('#btnSubmitLoading').hide();
                    $('#btnSubmit').show();
                    is_sending = 0;
                },
                error: function () 
                {
                    callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                    $('#btnSubmitLoading').hide();
                    $('#btnSubmit').show(); 
                    is_sending = 0;

                }
            });
        }
    }

    function showMultiTransaksi(transaksi)
    {
        $('#contentTransaksiMultiple').empty()
        content = ''
        $.each(transaksi, function( index, value ) {
            content += `
            <div class="row justify-content-center">
            <div class="col-1">`
            content += index + 1 
            content += `
            </div>
            <div class="col-3">
            <h6 class="font-w400 ">` 
            content += value.tujuan 
            content+= `</h6>
            </div>
            <div class="col-3">
            <h6 class="font-w400 ">` 
            content += value.waktu  
            content += `</h6>
            </div>
            <div class="col-1">
                <form action="{{url('rekammedis/transaksi')}}/`+value.id+`/setuju-pengiriman" method="POST">
                    {{csrf_field()}}
                    <button class="btn btn-sm btn-primary ">
                        <i class="fa fa-paper-plane"></i> Kirim
                    </button>
                </form>
            </div>
            </div>
            `
        });
        $('#contentTransaksiMultiple').append(content);
        $('#containerTransaksiMultiple').show();
    }

</script>
@endsection