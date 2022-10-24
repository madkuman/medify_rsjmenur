@extends('bpjs.layouts.main')

@section('title')
Approval Penerbitan SEP - Medify
@endsection

@section('subtitle')
Dashboard
@endsection

@section('css')
<style type="text/css">
</style>
@endsection

@section('content')
<main id="main-container">
    @include('bpjs.layouts.navbar')
    <div class="container">
        <div class="row row-deck">
            <div class="col-sm-12">
                 <div class="block rounded">
                    <div class="block-header">
                        <h3 class="block-title">Approval Pengajuan SEP</h3>
                    </div>
                        <div class="block-content">
                        <div class="row">
                            <div class="col-6" id="form_wrapper">
                                @include('bpjs.approve-pengajuan.contents.form')
                            </div>
                            <div class="col-6">
                                @include('bpjs.approve-pengajuan.contents.preview')
                            </div>
                            <div class="col-12 py-10 text-center font-w600 bg-danger text-white my-20 align-middle" id="error_wrapper" style="display: none;">
                                <i class="fa fa-exclamation-circle mr-5"></i>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection


@section('js')
<script type="text/javascript">
    // init
    $(document).ready(function(){
        $("#tanggal").datepicker( {
            format: "dd-mm-yyyy",
        });
    });
</script>
<script type="text/javascript">
    // get pasien
    $('#kartu-search').click(function(){
        var kartu = $("#no_kartu").val();
        var tgl = $("#tanggal").val();
        if(!kartu || kartu === ""){
            $('#preview_error_wrapper > span').text("Nomor kartu BPJS pasien harus diisi!");
            $('#preview_wrapper').hide();
            $('#preview_error_wrapper').show();
            return;
        }
        if(!tgl || tgl === ""){
            $('#preview_error_wrapper > span').text("Tanggal penerbitan SEP harus diisi!");
            $('#preview_wrapper').hide();
            $('#preview_error_wrapper').show();
            return;
        }
        $('#kartu-search').attr("disabled", true);
        $('#preview_loading').show();
        $('#preview_error_wrapper').hide();
        $('#preview_wrapper').hide();
        $.ajax({
            type: "GET",
            url: API_URL + "/bpjs/peserta/get/kartu/"+ kartu + "/" + tgl,
            contentType: false,
            success: function (response) {
                var res = JSON.parse(response);
                if(res.metaData.code == "200"){
                    var peserta = JSON.parse(response).response.peserta;
                    $('#preview_nama').html(peserta.nama);
                    $('#preview_no_kartu').html(peserta.noKartu);
                    $('#preview_status').html(peserta.statusPeserta.keterangan);
                    $('#preview_nik').html(peserta.nik);
                    $('#preview_umur').html(peserta.umur.umurSekarang.split(",")[0]);
                    $('#preview_gender').html(peserta.sex);
                    $('#preview_kelas').html(peserta.hakKelas.keterangan);
                    $('#preview_error_wrapper').hide();
                    $('#preview_wrapper').show();
                }else{
                    $('#preview_error_wrapper > span').text(res.metaData.message);
                    $('#preview_wrapper').hide();
                    $('#preview_error_wrapper').show();
                }
                $('#preview_loading').hide();
                $('#kartu-search').attr("disabled", false);
            },
            error: function (e) {
                console.log(e);
                callSwal('error','Pencarian Gagal','Silahkan Coba Lagi',0);
                $('#preview_loading').hide();
                $('#kartu-search').attr("disabled", false);
            }
        });
    });
</script>
<script type="text/javascript">
    $('#submit').click(function() {
        var err = 0;
        $('#form_wrapper .required').each(function() {
            if($(this).val() === "" || $(this).val() === null){
                if(!$(this).hasClass('no-required')){
                    $(this).addClass('is-invalid');
                    err++;
                }
            }else{
                $(this).parentsUntil(".form_group").removeClass("is-invalid");
                $(this).removeClass("is-invalid");
            }
        });
        if(err>1)
            return;
        $('#form_loading').show();
        $('#error_wrapper').hide();
        $('#submit').hide();
        var formData = new FormData;
        formData.append("no_kartu", $("#no_kartu").val());
        formData.append("tanggal", $("#tanggal").val());
        formData.append("jenis_pelayanan", $("#jenis_layanan").val());
        formData.append("keterangan", $("#keterangan").val());
        $.ajax({
            type: "POST",
            url: API_URL + "/bpjs/sep/approve",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {
                var res = JSON.parse(response);
                var metaData = res.metaData;
                if(metaData.code == "200"){
                    callSwal('success','Transaksi Berhasil','Pengajuan penerbitan SEP berhasil ditambahkan',0);
                    var peserta = JSON.parse(response).response.peserta;
                    $('#error_wrapper').hide();
                }else{
                    $('#error_wrapper > span').html(metaData.message);
                    $('#error_wrapper').show();
                }
                $('#submit').show();
                $('#form_loading').hide();
            },
            error: function (e) {
                console.log(e);
                callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                $('#submit').show();
                $('#form_loading').hide();
            }
        });
    });
</script>
@endsection