@extends('bpjs.layouts.main')

@section('title')
    Rujuk Balik
@endsection

@section('subtitle')
    Rujuk Balik
@endsection

@section('css')
    <style type="text/css">
    </style>
@endsection

@section('content')
    <main id="main-container">
        @include('bpjs.layouts.navbar')
        <div class="container">
            <div class="block rounded">
                <div class="block-header">
                    <h3 class="block-title">Daftar Rujuk Balik</h3>
                    <div class="block-options">
                        <a href="{{ url('') }}/bpjs/rujuk-balik/create" class="btn btn-primary">Buat Rujuk Balik</a>
                        <a href="{{ url('') }}/bpjs/rujuk-balik/search" class="btn btn-primary">Cari dengan Nomor</a>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label">Sumber Data</label>
                                <select class="form-control" data-size="5" id="filter-source" tabindex="-1" aria-hidden="true">
                                    <option value="rs">RS</option>
                                    <option value="bpjs">BPJS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label">&nbsp;</label>
                                <input type="text" class="form-control-plaintext mt-1" value="TANGGAL SURAT RB">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group filter-by-date">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Tanggal Start</label>
                                            <input type="text" class="form-control js-datepicker js-datepicker-enabled" id="filter-date-start"
                                                data-week-start="1" data-today-highlight="true" data-auto-close="true" value="09/01/2021">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Tanggal End </label>
                                            <input type="text" class="form-control js-datepicker js-datepicker-enabled" id="filter-date-end"
                                                data-week-start="1" data-today-highlight="true" data-auto-close="true" value="09/30/2021">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button class="btn btn-primary btn-lg" style="margin-top: 19px; width: 100%;" id="filter-submit"><i
                                        class="fa fa-search mr-5"></i>Filter</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-vcenter no-footer" id="table-rujuk-balik" style="width: 100%">
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </main>
    @include('bpjs.rujuk-balik.components.modal-detail')
@endsection


@section('js')
    <script type="text/javascript">
        var table_rujuk_balik = $("#table-rujuk-balik").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: API_URL + '/bpjs/rujuk-balik/get-data',
                data: function(d) {
                    d.source = $('#filter-source').val();
                    d.date_start = $('#filter-date-start').val();
                    d.date_end = $('#filter-date-end').val();
                }
            },
            language: {
                processing: '<i class="fa fa-4x fa-asterisk fa-spin text-info"></i>'
            },
            columns: [{
                    title: 'No',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    'className': 'text-center'
                },
                {
                    title: 'No Surat RB',
                    data: 'no_surat_rujuk_balik',
                    orderable: false
                },
                {
                    title: 'Tanggal Surat RB',
                    data: 'tanggal_surat_rujuk_balik_format',
                    orderable: false
                },
                {
                    title: 'No SEP',
                    data: 'no_sep',
                    orderable: true
                },
                {
                    title: 'No Kartu',
                    data: 'no_kartu',
                    orderable: false
                },
                {
                    title: 'Nama',
                    data: 'nama_peserta',
                    orderable: false
                },
                {
                    title: 'Nama Program',
                    data: 'program_prb',
                    orderable: false
                },
                {
                    title: 'status',
                    data: (data) => {
                        let className = data.status_vclaim == 1 ? 'badge-success' : 'badge-secondary';
                        let text = data.status_vclaim == 1 ? 'Selesai' : 'Pending';
                        return `<span class="badge ${className}">${text}</span>`;
                    },
                    orderable: false,
                    searchable: false,
                    'className': 'text-center'
                },
                {
                    title: '',
                    data: (data) => {
                        let needle = `data-id="${data.id}"`;
                        if (data.id == null) {
                            needle = `data-noSrb="${data.no_surat_rujuk_balik}"`;
                        }
                        return `<button type="button" class="btn btn-sm btn-primary btn-detail" ${needle}>Detail</button>`;
                    },
                    orderable: false,
                    searchable: false,
                    'className': 'text-center'
                }
            ],
            order: [],
            pageLength: 10
        });

        $('#filter-submit').on('click', function() {
            table_rujuk_balik.ajax.reload();
        })

        $(document).on('click', '.btn-detail', function() {
            $('#modal-detail').modal('show');
            $.ajax({
                url: API_URL + '/bpjs/rujuk-balik/get-detail',
                dataType: 'json',
                data: {
                    id: $(this).data('id'),
                    noSrb: $(this).data('nosrb'),
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
        });

        $('#btn-kirim-vclaim').on('click', function() {
            let id = $(this).data('id');
            swal({
                type: "warning",
                title: "Apakah Anda Yakin?",
                text: "Pastikan Kembali data sudah benar!",
                showCancelButton: true,
                confirmButtonText: "Ya!",
                cancelButtonText: "Tidak",
            }).then(function(confirm) {
                if (confirm.value) {
                    let swal_loading = swalLoading();

                    $.ajax({
                        url: API_URL + '/bpjs/rujuk-balik/kirim-vclaim',
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            'id': id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            swal_loading.close();
                            if (response.metaData.code == 200) {
                                callSwal('success', 'Berhasil', "Berhasil Mengirim Vclaim", "bpjs/rujuk-balik")
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

        $('#btn-delete').on('click', function() {
            let id = $(this).data('id');
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
                        url: API_URL + '/bpjs/rujuk-balik/delete',
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            'id': id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            swal_loading.close();
                            if (response.metaData.code == 200) {
                                callSwal('success', 'Berhasil', "Berhasil Menghapus Data", "bpjs/rujuk-balik")
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

        function fetchData(data) {
            if (data.data != null) {
                $('#btn-kirim-vclaim').data('id', data.data.id);
                $('#btn-delete').data('id', data.data.id);
                $('#btn-check-sep').data('sep', data.data.no_sep);
                $('#btn-edit').attr('href', BASE_URL + "bpjs/rujuk-balik/edit/" + data.data.id);

                $('#rb-no_sep').text(data.data.no_sep);
                $('#rb-no_kartu').text(data.data.no_kartu);
                $('#rb-no_surat_rujuk_balik').text(data.data.no_surat_rujuk_balik);
                $('#rb-kode_program_prb').text(data.data.kode_program_prb);
                $('#rb-program_prb').text(data.data.program_prb);
                $('#rb-kode_dpjp').text(data.data.kode_dpjp);
                $('#rb-dpjp').text(data.data.dpjp);
                $('#rb-alamat_peserta').text(data.data.alamat_peserta);
                $('#rb-nama_peserta').text(data.data.nama_peserta);
                $('#rb-email_peserta').text(data.data.email_peserta);
                $('#rb-keterangan').text(data.data.keterangan);
                $('#rb-saran').text(data.data.saran);
                let className = data.data.status_vclaim == 1 ? 'badge-success' : 'badge-secondary';
                let text = data.data.status_vclaim == 1 ? 'Selesai' : 'Pending';
                let badge_status = `<span class="badge ${className}">${text}</span>`;
                $('#rb-status_vclaim').html(badge_status);

                if (data.data.status_vclaim == 1) {
                    $('#btn-kirim-vclaim').hide();
                } else {
                    $('#btn-kirim-vclaim').show();
                }

                $('#table-detail-obat').find('tbody').html('');
                $.each(data.data.detail, function(i, item) {
                    $('#table-detail-obat').find('tbody').append(`
                    <tr>
                        <td>${i+1}</td>
                        <td>${item.nama_obat}</td>
                        <td>${item.signa1} x ${item.signa2}</td>
                        <td>${item.jumlah}</td>
                    </tr>
                    `);
                });
            }else if(data.prb){
                $('#btn-kirim-vclaim').data('id', 'srb-'+data.prb.noSRB);
                $('#btn-delete').data('id', 'srb-'+data.prb.noSRB);
                $('#btn-check-sep').data('sep', data.prb.noSEP);
                $('#btn-edit').attr('href', BASE_URL + "bpjs/rujuk-balik/edit/srb-" + data.prb.noSRB);

                $('#rb-no_sep').text(data.prb.noSEP);
                $('#rb-no_kartu').text(data.prb.peserta.noKartu);
                $('#rb-no_surat_rujuk_balik').text(data.prb.noSRB);
                $('#rb-kode_program_prb').text(data.prb.programPRB.kode);
                $('#rb-program_prb').text(data.prb.programPRB.nama);
                $('#rb-kode_dpjp').text(data.prb.DPJP.kode);
                $('#rb-dpjp').text(data.prb.DPJP.nama);
                $('#rb-alamat_peserta').text(data.prb.peserta.alamat);
                $('#rb-nama_peserta').text(data.prb.peserta.nama);
                $('#rb-email_peserta').text(data.prb.peserta.email);
                $('#rb-keterangan').text(data.prb.keterangan);
                $('#rb-saran').text(data.prb.saran);
                let badge_status = `<span class="badge badge-success">Selesai</span>`;
                $('#rb-status_vclaim').html(badge_status);

                $('#btn-kirim-vclaim').hide();
                $('#table-detail-obat').find('tbody').html('');
                $.each(data.prb.obat.obat, function(i, item) {
                    $('#table-detail-obat').find('tbody').append(`
                    <tr>
                        <td>${i+1}</td>
                        <td>${item.nmObat}</td>
                        <td>${item.signa1} x ${item.signa2}</td>
                        <td>${item.jmlObat}</td>
                    </tr>
                    `);
                });
            }
            $('#result').show();
        }

        $('#btn-check-sep').on('click', function() {
            let sep = $(this).data('sep');
            if (sep == "") return;
            window.open(BASE_URL + "bpjs/sep/search?window=1&no_sep=" + sep, '_blank',
                'location=yes,height=570,width=520,scrollbars=yes,status=yes');
        })
    </script>
@endsection
