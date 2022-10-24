@extends('bpjs.layouts.main')

@section('title')
    Pencarian Nomor Surat Kontrol - Medify
@endsection

@section('subtitle')
    Pencarian Nomor Surat Kontrol
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
                            <h3 class="block-title">Pencarian Nomor Surat Kontrol
                                <br>
                                <small>Data ini berdasarkan data yang ada pada server BPJS.</small><br>
                            </h3>
                        </div>

                        <div class="block-content">
                            <div class="row">
                                <div class="col-6">
                                    <form id="form-search">
                                        <div class="form-group">
                                            <label>Nomor Surat Kontrol</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control required" name="nomor_surat_kontrol" id="input-surat-kontrol"
                                                    value="{{ $nomor_surat_kontrol }}">
                                                <div class="input-group-append">
                                                    <button id="search" type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari
                                                    </button>
                                                </div>
                                            </div>
                                            <small>Contoh : 1301R0100921K000100</small>
                                            <div class="alert alert-danger mt-3 mb-0" id="error-message" style="display: none;"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <i class="fa fa-3x fa-asterisk fa-spin text-primary" id="loading-spin" style="display: none"></i>
                            </div>
                            <div class="block-content" id="rk-result" style="display: none">
                                @include('bpjs.rencana-kontrol.search.result')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection


    @section('js')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#form-search').submit(function(e) {
                    e.preventDefault();

                    let form_data = new FormData($(this)[0]);
                    $('#loading-spin').show();
                    $('#rk-result').hide();

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

                            if (response.metaData.code == 200) {
                                $('#input-surat-kontrol').removeClass('is-invalid');
                                $('#error-message').hide();

                                fetchData(response.response);
                            } else {
                                $('#input-surat-kontrol').addClass('is-invalid');
                                $('#error-message').text(response.metaData.message).show();
                            }
                        }
                    })
                })

                $('#btn-check-sep').on('click', function() {
                    let sep = $(this).data('sep');
                    if (sep == "") return;
                    window.open(BASE_URL + "bpjs/sep/search?window=1&no_sep=" + sep, '_blank',
                        'location=yes,height=570,width=520,scrollbars=yes,status=yes');
                })
            })

            function fetchData(data) {
                $('#btn-check-sep').data('sep', data.sep?.noSep || '')
                $('#btn-edit').attr('href', BASE_URL + "bpjs/rencana-kontrol/edit/{{$jenis}}/" + data.noSuratKontrol)
                $('#btn-delete').data('nosk', data.noSuratKontrol)

                $('#rk-nomor-surat-kontrol').text(data.noSuratKontrol);
                $('#rk-tanggal-rencana-kontrol').text(data.tglRencanaKontrol);
                $('#rk-nomor-sep').text(data.sep?.noSep);
                $('#rk-nama').text(data.sep?.peserta?.nama);
                $('#rk-tanggal-lahir').text(data.sep?.peserta?.tglLahir);
                $('#rk-jenis-kelamin').text(data.sep?.peserta?.kelamin);
                $('#rk-diagnosa-awal').text(data.sep?.diagnosa);
                $('#rk-jenis-kontrol').text(data.namaJnsKontrol);
                $('#rk-poliklinik').text(data.namaPoliTujuan);
                $('#rk-nama-dokter').text(data.namaDokter);

                $('#rk-result').show();
            }

            $('#btn-delete').on('click', function() {
                let nosk = $(this).data('nosk');
                swal({
                    type: "warning",
                    title: "Apakah Anda Yakin?",
                    text: "Data yang telah dihapus tidak dapat dikembalikan!",
                    showCancelButton: true,
                    confirmButtonText: "Ya!",
                    cancelButtonText: "Tidak",
                }).then(function(confirm) {
                    if (confirm.value) {
                        let swal_loading = swalLoading();

                        $.ajax({
                            url: API_URL + '/bpjs/rencana-kontrol/delete',
                            type: "POST",
                            dataType: "JSON",
                            data: {
                                'no_sk': nosk,
                                'user': '{{$user->name}}',
                                'user_id': '{{$user->id}}',
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: (response) => {
                                swal_loading.close();
                                if (response.metaData.code == 200) {
                                    callSwal('success', 'Berhasil', "Berhasil Menghapus Data", "bpjs/rencana-kontrol/{{$jenis}}")
                                } else {
                                    callSwal('error', 'Gagal', response.metaData.message, 0)
                                }
                            },
                            error: () => {
                                swal_loading.close();
                            }
                        })
                    }
                })
            });
        </script>
    @endsection
