@extends('kamarjenazah.layouts.main')

@section('title')
Kamar Jenazah - Medify
@endsection

@section('toprightmenu')
+ Tambah Layanan
@endsection

@section('url')
{{url('kamarjenazah/layanan/new')}}
@endsection

@section('subtitle')
<span class="text-muted font-w400">Tarif Layanan Jenazah / </span> Edit Layanan
@endsection

@section('css')
<style type="text/css">
    .block-content {
        padding-bottom: 18px;
    }
</style>
@endsection

@section('content')
    <div class="container">
        <div class="">
            <div class="block-content pl-0 pt-0">
                <form id="layananSubmit">
                    <div class="block rounded" id="layananBaru">
                        <div class="block-content">
                            @include('kamarjenazah.form.form-layananedit')
                        </div>
                    </div>
                    <div class="col-12" style="height: 75px">
                        <button class="btn btn-success btn-hero pull-right" type="button" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                        <button class="btn btn-alt-success btn-hero pull-right" style="display: none" type="button"  id="buttonLoading">
                            <i class="fa fa-asterisk fa-spin"></i> Loading
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('angular')

<script type="text/javascript">

    $('#buttonSubmit').click(function() {

        $('#buttonSubmit').hide();
        $('#buttonLoading').show();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        layanan = $("#selectLayanan").val();
        namaLayanan = $("input[name='namaLayanan']").val();
        hargaLayanan = $("input[name='hargaLayanan']").val();

        var formData = new FormData();
        formData.append('idlayanan',layanan);
        formData.append('nama_layanan', namaLayanan);
        formData.append('harga_layanan', hargaLayanan);
        for (var pair of formData.entries()) {
            console.log(pair[0]+ ', ' + pair[1]);
        }
        $.ajax({
            type: "POST",
            url: API_URL + "/kamarjenazah/layanan/edit",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {

                callSwalString(response);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
            },
            error: function () {
                callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
            }
        });

        function callSwalString(string)
        {
            var response = jQuery.parseJSON(string);
            callSwal(response.type,response.title,response.text,response.url);
        }

    });

</script>

@endsection
