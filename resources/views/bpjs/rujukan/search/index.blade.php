@extends('bpjs.layouts.main')

@section('title')
Pencarian Rujukan
@endsection

@section('subtitle')
Pencarian Rujukan
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
                        <h3 class="block-title">Pencarian Rujukan
                            <br>
                            <small>Data ini berdasarkan server BPJS</small>
                        </h3>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Cari dengan</label>
                            <select class="js-select2 form-control" id="search-method">
                                <option value="1" selected>Nomor Rujukan</option>
                                <option value="2">Nomor Kartu</option>
                            </select>
                        </div>
                    </div>
                    @include('bpjs.rujukan.search.components.input')
                    <hr>
                    <div class="text-center">
                        <i class="fa fa-3x fa-asterisk fa-spin text-primary" id="loading-spin"></i>
                    </div>
                    @include('bpjs.rujukan.search.components.result')
                </div>
            </div>
        </div>
    </div>
</main>
@endsection


@section('js')
<script type="text/javascript">
    $('#loading-spin').hide();
    $('#rujukan-result').hide();
    $('#form-search-kartu').hide();

    $('#search-method').on('change', function(e){
        var method = $(this).val();
        if(method == 1){
            $('#form-search-nomor').show();
            $('#form-search-kartu').hide();
        }
        else{
            $('#form-search-nomor').hide();
            $('#form-search-kartu').show();
        }
    });

    $('.search').click(function(){
        if (this.id == 'search-nomor') {
            hideElement('#error_search_rujukan_nomor');
            hideElement('#rujukan-result');
            value = $('#search_nomor_rujukan').val();
            var dataFound = 0;
            if(value == '') showElement('#error_search_rujukan_nomor','Nomor Wajib Diisi');
            else{
                $.ajax({
                    url: API_URL+'/bpjs/rujukan/get/no-rujukan?no_rujukan='+value,
                    type: "GET",
                    dataType: "json",
                    beforeSend: function(){
                        $('#loading-spin').show();
                    },
                    success: function(data){
                        // console.log(data);
                        if (data.length != 0)
                        {
                            $("#nomor_rujukan").text(data[0].noKunjungan);
                            $("#tanggal_rujukan").text(data[0].tglKunjungan);
                            $("#pelayanan").text(data[0].pelayanan.nama);
                            $("#diagnosa").text(data[0].diagnosa.nama);
                            $("#provPerujuk").text(data[0].provPerujuk.nama);
                            $("#poliRujukan").text(data[0].poliRujukan.nama);
                            dataFound = 1;
                        }
                        else
                        {
                            showElement('#error_search_rujukan_nomor','Data Tidak Ditemukan');
                        }

                    },
                    complete: function(){
                        if (dataFound) $('#rujukan-result').show();
                        $('#loading-spin').hide();
                    }
                });
            }
        } else {
            hideElement('#error_search_rujukan_kartu');
            hideElement('#rujukan-result');
            value = $('#search_nomor_kartu').val();
            var dataFound = 0;
            if(value == '') showElement('#error_search_rujukan_kartu','Nomor Wajib Diisi');
            else{
                var formData = new FormData();
                formData.append('nomor_kartu', value);
                formData.append('multiple', 1);

                $.ajax({
                    url: API_URL+'/bpjs/rujukan/get/kartu',
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        $('#loading-spin').show();
                    },
                    success: function(data){
                        // console.log(data);
                        if (data.metaData.code == '200')
                        {
                            $("#nomor_rujukan").text(data.response.rujukan[0].noKunjungan);
                            $("#tanggal_rujukan").text(data.response.rujukan[0].tglKunjungan);
                            $("#pelayanan").text(data.response.rujukan[0].pelayanan.nama);
                            $("#diagnosa").text(data.response.rujukan[0].diagnosa.nama);
                            $("#provPerujuk").text(data.response.rujukan[0].provPerujuk.nama);
                            $("#poliRujukan").text(data.response.rujukan[0].poliRujukan.nama);
                            dataFound = 1;
                        }
                        else
                        {
                            showElement('#error_search_rujukan_kartu','Data Tidak Ditemukan');
                        }

                    },
                    complete: function(){
                        if (dataFound) $('#rujukan-result').show();
                        $('#loading-spin').hide();
                    }
                });
            }
        }
    })

    function showElement(element,text)
    {
        $(element).html(text);
        $(element).show();
    }
    function hideElement(element)
    {
        $(element).hide();
    }
</script>
@endsection