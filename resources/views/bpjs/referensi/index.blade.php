@extends('bpjs.layouts.main')

@section('title')
    Referensi BPJS
@endsection

@section('subtitle')
    Pencarian Referensi BPJS
@endsection

@section('css')

    <style type="text/css">
        .block-content {
            padding-bottom: 18px;
        }

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
                            <h3 class="block-title">Pencarian Referensi BPJS
                                <br>
                                <small>Data ini berdasarkan data yang ada pada server BPJS.</small><br>
                            </h3>
                        </div>

                        <div class="block-content">
                            <div class="row">
                                <div class="col-6">
                                    <form id="form-search">
                                        <div class="form-group">
                                            <label for="select">Jenis Referensi</label>
                                            <select class="form-control js-select2 required" name="select_referensi" id="select-referensi">
                                                <option value="diagnosa">Diagnosa</option>
                                                <option value="poli">Poli</option>
                                                <option value="faskes">Faskes</option>
                                                <option value="dpjp">DPJP</option>
                                                <option value="propinsi">Provinsi</option>
                                                <option value="kabupaten">Kabupaten</option>
                                                <option value="kecamatan">Kecamatan</option>
                                                <option value="diagnosa-prb">Diagnosa PRB</option>
                                                <option value="obat-prb">Obat PRB</option>
                                            </select>
                                        </div>
                                        <div class="dpjp-component" style="display: none;">
                                            <div class="form-group">
                                                <label for="">Pelayanan</label>
                                                <select class="form-control required" name="pelayanan" id="pelayanan-dpjp">
                                                    <option value="1">Rawat Jalan</option>
                                                    <option value="2">Rawat Inap</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Pelayanan</label>
                                                <input type="text" class="form-control datepicker" name="tgl_pelayanan" id="tgl-pelayanan-dpjp" value="{{ now()->format('d-m-Y') }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Spesialis</label>
                                                <select class="form-control js-select2 select-spesialis" name="spesialis" id="spesialis-dpjp" data-placeholder="Pilih Spesialis"
                                                    style="width: 100%">
                                                    @foreach ($sepsialis as $item)
                                                        <option value="{{$item->kode}}">{{$item->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="propinsi-div" style="display: none;">
                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <select class="form-control js-select2 select-propinsi" name="propinsi" id="propinsi-select" data-placeholder="Pilih Propinsi"
                                                    style="width: 100%">
                                                    @foreach ($propinsi as $item)
                                                        <option value="{{$item->kode}}">{{$item->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="kabupaten-div" style="display: none;">
                                            <div class="form-group">
                                                <label>Kabupaten  <i class="fa fa-asterisk fa-spin text-info" id="loading-spin-kecamatan" style="display: none"></i></label>
                                                <select class="form-control js-select2 select-kabupaten" name="kabupaten" id="kabupaten-select" data-placeholder="Pilih kabupaten"
                                                    style="width: 100%">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group keyword-div">
                                            <label>Keyword</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="keyword" id="keyword-search">
                                            </div>
                                        </div>
                                        <div class="alert alert-danger mt-3 mb-0" id="error-message" style="display: none;"></div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg" style="margin-top: 19px; width: 100%;" id="btnSubmit"><i
                                                    class="fa fa-search mr-5"></i>Cari</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <i class="fa fa-3x fa-asterisk fa-spin text-primary" id="loading-spin" style="display: none"></i>
                            </div>
                            <div class="row">
                                <div class="col-12 result"></div>
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
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true,
        })

        $('#select-referensi').on('change', function() {
            $('.result').html('');
            let referensi = $(this).val();

            if (referensi == 'dpjp') {
                $('.dpjp-component').show();
                $('.propinsi-div').hide();
                $('.kabupaten-div').hide();
                $('.keyword-div').hide();
            } else if (referensi == 'propinsi') {
                $('.dpjp-component').hide();
                $('.propinsi-div').hide();
                $('.kabupaten-div').hide();
                $('.keyword-div').hide();
            } else if (referensi == 'kabupaten') {
                $('.dpjp-component').hide();
                $('.propinsi-div').show();
                $('.kabupaten-div').hide();
                $('.keyword-div').hide();
            } else if (referensi == 'kecamatan') {
                $('.dpjp-component').hide();
                $('.propinsi-div').show();
                $('.kabupaten-div').show();
                $('.keyword-div').hide();
                fetchSelectKabupaten();
            } else if (referensi == 'diagnosa-prb') {
                $('.dpjp-component').hide();
                $('.propinsi-div').hide();
                $('.kabupaten-div').hide();
                $('.keyword-div').hide();
            }else {
                $('.dpjp-component').hide();
                $('.propinsi-div').hide();
                $('.kabupaten-div').hide();
                $('.keyword-div').show();
            }
        })

        $('#propinsi-select').on('change', function() {
            fetchSelectKabupaten();
        })

        function fetchSelectKabupaten() {
            $('#loading-spin-kecamatan').show();
            $.ajax({
                url: API_URL+'/bpjs/referensi/kabupaten/'+$('#propinsi-select').val(),
                type: "GET",
                dataType: "JSON",
                success: (data) => {
                    $('#kabupaten-select').empty();
					if (data.metaData.code == 200)
					{
						$('#kabupaten-select').append('<option value="">--Pilih Kabupaten--</option>');
						$.each(data.response.list, function(key, value){
							let opt = new Option( `${value.nama}`, `${value.kode}`);
							$('#kabupaten-select').append(opt);
						});
			
                    }
                    $('#loading-spin-kecamatan').hide();
                }
            })
        }

        $('#form-search').submit(function(e) {
            e.preventDefault();

            let form_data = new FormData($(this)[0]);
            $('#loading-spin').show();
            $('#rk-result').hide();
            $('.result').html('');

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                dataType: "JSON",
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    $('#loading-spin').hide();

                    if (response.response.metaData.code == 200) {
                        $('#keyword-search').removeClass('is-invalid');
                        $('#error-message').hide();

                        let html = '';
                        if (response.referensi == 'diagnosa') {
                            $.each(response.response.response.diagnosa, function (index, value) { 
                                html += `<table>
                                    <tr>
                                        <td style="width: 175px">Kode</td>
                                        <td style="width: 1px">:</td>
                                        <td>`+value.kode+`</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Diagnosa</td>
                                        <td>:</td>
                                        <td>`+value.nama+`</td>
                                    </tr>
                                </table>
                                <br>`;
                            });
                        } else if (response.referensi == 'poli') {
                            $.each(response.response.response.poli, function (index, value) { 
                                html += `<table>
                                    <tr>
                                        <td style="width: 175px">Kode</td>
                                        <td style="width: 1px">:</td>
                                        <td>`+value.kode+`</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Poli</td>
                                        <td>:</td>
                                        <td>`+value.nama+`</td>
                                    </tr>
                                </table>
                                <br>`;
                            });

                        } else if (response.referensi == 'faskes') {
                            $.each(response.response.response.faskes, function (index, value) { 
                                html += `<table>
                                    <tr>
                                        <td style="width: 175px">Kode</td>
                                        <td style="width: 1px">:</td>
                                        <td>`+value.kode+`</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Faskes</td>
                                        <td>:</td>
                                        <td>`+value.nama+`</td>
                                    </tr>
                                </table>
                                <br>`;
                            });
                        } else {
                            $.each(response.response.response.list, function (index, value) { 
                                html += `<table>
                                    <tr>
                                        <td style="width: 175px">Kode</td>
                                        <td style="width: 1px">:</td>
                                        <td>`+value.kode+`</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>`+value.nama+`</td>
                                    </tr>
                                </table>
                                <br>`;
                            });
                        }

                        $('.result').html(html);
                    } else {
                        $('#keyword-search').addClass('is-invalid');
                        $('#error-message').text(response.response.metaData.message).show();
                    }
                }
            })
        })
    })
</script>
@endsection