@extends('bpjs.layouts.main')

@section('title')
    Rencana Kontrol - Medify
@endsection

@section('subtitle')
    Rencana Kontrol
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
                    <div class="block rounded main-content transaction-index">
                        <div class="block-header">
                            <h3 class="block-title">Daftar @if ($jenis == '1')
                                SPRI
                            @else
                                SKDP
                            @endif</h3>
                            <div class="block-options">
                                <a href="{{ url('bpjs/rencana-kontrol') }}/{{$jenis}}/create" class="btn btn-primary">Buat @if ($jenis == '1')
                                    SPRI
                                @else
                                    SKDP
                                @endif</a>
                                @if ($jenis == '2')
                                    <a href="{{ url()->current() }}/search" class="btn btn-primary">Cari dengan Nomor</a>
                                @endif
                            </div>
                        </div>
                        <div class="content">
                            <div class="row">
                                @include('bpjs.rencana-kontrol.components.content-filter')
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-full-width spinner-container" id="bpjsResult">
                                        <div class="spinner-back">
                                            <table class="table table-bordered table-striped table-vcenter no-footer" id="rencanaKontrolTable"
                                                style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th width="10">No.</th>
                                                        <th width="200">Tgl Rencana Kontrol</th>
                                                        <th>Pasien</th>
                                                        <th>No. SK</th>
                                                        <th>No. SEP</th>
                                                        <th>No. Kartu</th>
                                                        <th>Poli Tujuan</th>
                                                        <th width="200">Tgl Entri</th>
                                                        <th class="text-center" width="30">Detail</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
        <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Detail Surat Kontrol</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="text-center" id="loaderDetail">
                            <span class="fa fa-4x fa-cog fa-spin text-primary text-center loader" style=""></span>
                        </div>
                        <div id="modal-detail-content">
                            @include('bpjs.rencana-kontrol.search.result')
                        </div>
                        <div id="modal-detail-message">
                            <div class="alert alert-danger"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/jquery1.10.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dataTables1.10.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        var table_rencana_kontrol = $("#rencanaKontrolTable").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: API_URL + '/bpjs/rencana-kontrol/getData',
                data: function(d) {
                    d.source = $('#filter-source').val();
                    d.format = $('#filter-format').val();
                    d.date_start = $('#filter-date-start').val();
                    d.date_end = $('#filter-date-end').val();
                    d.jenis = '{{$jenis}}';
                },
                dataSrc: function(response){
                    if(response.message != undefined){
                        callSwal('warning','Gagal!',response.message,0);
                    }
                    return response.data;
                },
            },
            language: {
                processing: '<i class="fa fa-4x fa-asterisk fa-spin text-info"></i>'
            },
            columns: [{
                    data: 'DT_Row_Index',
                    'className': 'text-center',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'tgl_rk',
                    orderable: true
                },
                {
                    data: 'pasien',
                    orderable: false
                },
                {
                    data: 'no_sk',
                    orderable: false
                },
                {
                    data: 'no_sep',
                    orderable: false
                },
                {
                    data: 'no_kartu',
                    orderable: false
                },
                {
                    data: 'nama_poli',
                    orderable: false
                },
                {
                    data: 'created_at',
                    orderable: true
                },
                {
                    data: 'detail',
                    orderable: false,
                    searchable: false,
                    'className': 'text-center'
                }
            ],
            order: [],
            pageLength: 10
        });

        $('#filter-submit').on('click', function() {
            table_rencana_kontrol.ajax.reload();
        })

        function detail(no_sk) {
            $('#modalDetail').modal('show');
            $.ajax({
                url: API_URL + '/bpjs/rencana-kontrol/detail',
                dataType: 'json',
                data: {
                    no_sk: no_sk
                },
                beforeSend: function() {
                    $('#loaderDetail').show();
                    $('#modal-detail-content').hide();
                    $('#modal-detail-message').hide();
                },
                success: function(response) {
                    $('#loaderDetail').hide();

                    if (response.metaData.code != 200) {
                        $('#modal-detail-message').show();
                        $('#modal-detail-message').find('.alert').text(response.metaData.message);
                    } else {
                        $('#modal-detail-content').show();
                        fetchData(response.response);
                    }

                },
                error: function(err) {
                    console.log(err)
                }
            })
        }

        $('#btn-check-sep').on('click', function() {
            let sep = $(this).data('sep');
            if (sep == "") return;
            window.open(BASE_URL + "bpjs/sep/search?window=1&no_sep=" + sep, '_blank',
                'location=yes,height=570,width=520,scrollbars=yes,status=yes');
        })

        function hapus(no_sk) {
            $.ajax({
                url: API_URL + '/bpjs/rencana-kontrol/delete',
                dataType: 'json',
                type: 'POST',
                data: {
                    no_sk: no_sk,
                    user: '{{$user->name}}',
                    user_id: '{{$user->id}}',
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.metaData.code != 200) {
                        swal('error', response.metaData.message, 'error')
                            .then(() => {
                                location.reload();
                            })
                    } else {
                        swal('success', 'Rencana Kontrol berhasil dihapus')
                            .then(() => {
                                location.reload();
                            })
                    }
                }
            })
        }

        function fetchData(data) {
            $('#btn-check-sep').data('sep', data.sep?.noSep || '')
            $('#btn-print-rencana-kontrol').data('surat_kontrol', data.noSuratKontrol || '')
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
                                callSwal('success', 'Berhasil', "Berhasil Menghapus Data", `bpjs/rencana-kontrol/{{$jenis}}`)
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

        $('#btn-print-rencana-kontrol').on('click', function(){
            let surat_kontrol = $(this).data('surat_kontrol');
            if (surat_kontrol == "") return;
            window.open(`${BASE_URL}bpjs/rencana-kontrol/print?no_sk=${surat_kontrol}`, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
        })
    </script>
@endsection
