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
                <a href="{{url('rekammedis/pengembalian')}}"><i class="fa fa-arrow-left"></i> Kembali ke daftar pengembalian</a>
            </div>
            <div class="block-content block-content-full text-center p-30 mb-20">
                <h2>PENGEMBALIAN FILE</h2>
                <h4 class="mb-5">Konfirmasi Penerimaan File RM berdasarkan Daftar Pengembalian</h4>
                <p>Masukkan no RM. Gunakan barcode scanner untuk mempercepat proses</p>
                <form id="formSubmit">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8 col-sm-12">
                            <div class="form-group">
                                <input id="noRM" type="text" class="form-control">
                            </div>
                            <button class="btn btn-primary" id="btnSubmit">Submit</button> 
                            <button class="btn btn-primary" id="btnSubmitLoading" disabled style="display: none">Submit <i class="fa fa-sun-o fa-spin text-white"></i></button> 
                        </div>
                    </div>
                </form>
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

    function kirimNoRM(force){
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
                    no_rm : no_rm,
                    force:force
                },
                success: function (data) 
                {
                    is_sending = 0;
                    if(data.type == 'confirm') callConfirm(data.title,data.text);
                    else 
                    {
                        callSwal(data.type,data.title,data.text,data.url);
                        $('#noRM').val('');
                        $('#btnSubmitLoading').hide();
                        $('#btnSubmit').show();
                    }
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

    function callConfirm(title,text)
    {
        swal({
            title: title,
            text: text,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, konfirmasi penerimaan!'
        }).then((result) => {
            if (result.value) {
                kirimNoRM(1);
            }
            else
            {

                $('#noRM').val('');
                $('#btnSubmitLoading').hide();
                $('#btnSubmit').show();
            }
        })
    }

</script>
@endsection