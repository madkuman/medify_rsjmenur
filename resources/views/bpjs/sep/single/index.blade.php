@extends('bpjs.layouts.main')

@section('title')
Pencarian Nomor SEP
@endsection

@section('subtitle')
Pencarian Nomor SEP
@endsection

@section('css')
<style type="text/css">
</style>
@endsection

@section('content')
@if(!$window)
<main id="main-container">
    @include('bpjs.layouts.navbar')
    <div class="container">
        <div class="row row-deck">
            <div class="col-sm-12">
@else
<main id="main-container" class="pt-0">
@endif
                <div class="block rounded">
                    <div class="block-header">
                        <h3 class="block-title">Pencarian nomor SEP
                            <br>
                            <small>Data ini berdasarkan data yang ada pada server BPJS.</small><br>
                            <small>Pada menu ini anda dapat mencari serta merubah data SEP, mencetak SEP, dan Update KRS Pasien BPJS.</small>
                        </h3>
                    </div>  
                    @include('bpjs.sep.search.components.input')
                    <hr>
                    <div class="block-content" >
                        <div class="row">
                            <div class="col-6">
                                <i class="fa fa-3x fa-asterisk fa-spin text-primary" id="loading-spin"></i>
                                <div class=" hide" id="sep-result">
                                    @include('bpjs.sep.single.components.result')        
                                </div>
                            </div>
                            <div class="col-5 offset-1">
                                <h5>Data SEP Internal</h5>
                                <div class="text-center" id="sep-empty-internal">
                                    Tidak Ditemukan Data SEP Internal
                                </div>
                                <div class="text-center">
                                    <i class="fa fa-3x fa-asterisk fa-spin text-primary" id="loading-spin-internal"></i>
                                </div>
                                <div id="sep-result-internal">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    @if(!$window)
            </div>
        </div>
    </div>
    @endif
</main>
@include('bpjs.sep.single.components.modals.modal-pulang')
@endsection


@section('js')
<script type="text/javascript">
    $('#loading-spin').hide();
    $('#loading-spin-internal').hide();
    $('#sep-result').hide();
    $(document).ready(function() {
        var no_sep = $('#search_nomor_sep').val();
        if(no_sep != "" && no_sep != null && no_sep != undefined){
            getSep();
            getInternal();
        }
    });

    function getSep(){
        var no_sep = $('#search_nomor_sep').val();
        $.ajax({
            type: "GET",
            url: API_URL + "/bpjs/sep/search/" + no_sep ,
            contentType: false,
            success: function (resp) {
                var response = JSON.parse(resp);
                console.log(response);
                if(response.metaData.code != 200){
                    $('#loading-spin').hide();
                    // showElement('#error_search_nomor_sep', response.metaData.message);
                    showElement('#error_search_nomor_sep', `${response?.metaData?.code} | ${response?.metaData?.message}`);
                    return;
                }
                $('#sep_edit_url').attr('href', "{{url('')}}/bpjs/sep/"+ no_sep +"/edit");
                $('#sep_print_url').attr('href', "{{url('')}}/bpjs/sep/"+ no_sep +"/print");

                var sep = response.response;
                var tgl_lahir = sep.peserta.tglLahir.split("-").reverse().join("-");
                var gender;
                if(sep.peserta.kelamin == "L"){
                    gender ="Laki-laki";
                }else{
                    gender = "Perempuan"
                }
                $('#result_no_sep').html(no_sep);
                $('#no_sep_krs').val(no_sep);
                $('#result_tgl_sep').html(sep.tglSep);
                $('#result_tgl_rujukan').html(sep.noRujukan);
                $('#result_no_kartu').html(sep.peserta.noKartu);
                $('#result_nama').html(sep.peserta.nama);
                $('#result_tgl_lahir').html(tgl_lahir);
                $('#result_gender').html(gender);
                $('#result_diagnosa').html(sep.diagnosa);
                $('#result_jenis_rawat').html(sep.jnsPelayanan);
                if(sep.jnsPelayanan == "Rawat Jalan"){
                    $('#sep_krs_url').hide();
                }else{
                    $('#sep_krs_url').show();
                }
                $('#result_kelas_rawat').html(sep.kelasRawat);
                $('#result_catatan').html(sep.catatan);
                $('#result_jenis').html(sep.peserta.jnsPeserta);
                $('#result_poliklinik').html(sep.poli);

                $('#sep-result').show();
                $('#loading-spin').hide();
            },
            error:function(error){
                $('#sep-result').hide();
                $('#loading-spin').hide();
                console.log(error);
            }
        });
    }

    function getInternal(){
        var no_sep = $('#search_nomor_sep').val();
        $.ajax({
            type: "GET",
            url: BASE_URL + "vclaim-v2/sep/internal/" + no_sep ,
            contentType: false,
            success: function (resp) {
                var response = JSON.parse(resp);
                console.log(response);
                if(response.metaData.code != 200){
                    $('#loading-spin-internal').hide();
                    // showElement('#error_search_nomor_sep', response.metaData.message);
                    $('#sep-empty-internal').html(`${response?.metaData?.code} | ${response?.metaData?.message}`);
                    return;
                }
                var index = 1;
                $('#sep-result-internal').empty();
                response.response.list.forEach(element => {
                    $('#sep-result-internal').append(`@include('bpjs.sep.single.components.result-internal')`);
                    $(`#result_no_sep_${index}`).html(element.nosep);
                    $(`.result_no_surat_${index}`).html(element.nosurat);
                    $(`#result_tgl_sep_${index}`).html(element.tglrujukinternal);
                    $(`#result_poli_asal_${index}`).html(element.nmpoliasal);
                    $(`#result_poli_tujuan_${index}`).html(element.nmtujuanrujuk);
                    $(`#result_diagnosa_${index}`).html(element.nmdiag);
                    index++;
                });

                
                $('#sep-result-internal').show();
                $('#loading-spin-internal').hide();
                $('#sep-empty-internal').hide();
            },
            error:function(error){
                $('#sep-result').hide();
                $('#loading-spin').hide();
                console.log(error);
            }
        });
    }
    $('#search').click(function(){
        $('#sep-result').hide();
        $('#loading-spin').show();
        hideElement('#error_search_nomor_sep');
        value = $('#search_nomor_sep').val();
        if(value == ''){
            showElement('#error_search_nomor_sep','Nomor SEP Wajib Diisi');
            return;
        }    })

    function showElement(element,text)
    {
        $(element).html(text);
        $(element).show();
    }
    function hideElement(element)
    {
        $(element).hide();
    }

    $('#form_search_sep').submit(function(event)
    {
        event.preventDefault();
        $('#loading-spin').show();
        $('#loading-spin-internal').show();
        $('#sep-result').hide();
        $('#sep-empty-internal').hide();

        getSep();
        getInternal();
    });
</script>
@endsection