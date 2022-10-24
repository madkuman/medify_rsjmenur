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
            <div class="row row-deck">
                <div class="col-sm-12">
                    <div class="block rounded">
                        <div class="block-header">
                            <h3 class="block-title">Pencarian Rujuk Balik
                                <br>
                                <small>Data ini berdasarkan server BPJS</small>
                            </h3>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nomor SRB</label>
                                <div class="input-group">
                                    <input type="text" class="form-control required" id="noSrb">
                                    <div class="input-group-append">
                                        <button id="filterNoSrb" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
                                    </div>
                                    <br>
                                </div>
                                <div class="invalid-feedback alert alert-danger" id="error_search_rujukan_nomor"></div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <i class="fa fa-3x fa-asterisk fa-spin text-primary" id="loading-spin"></i>
                        </div>
                        <div class="col-sm-12" id="result" style="display: none">
                            @include('bpjs.rujuk-balik.components.result')
                        </div>
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

        $('#searchMethod').change(function() {
            let val = $(this).val();
            if (val == 1) {
                $('#searchByNo').show();
                $('#searchByTanggal').hide();
            } else {
                $('#searchByNo').hide();
                $('#searchByTanggal').show();
            }
        });

        $('#filterNoSrb').click(function() {
            let no_srb = $('#noSrb').val();
            $('#result').hide();
            $.ajax({
                url: API_URL + '/bpjs/rujuk-balik/get-detail',
                type: "GET",
                dataType: 'json',
                data: {
                    noSrb: no_srb
                },
                success: function(response) {
                    console.log(response)
                    if (response.metaData.code != 200) {
                        swal('Error', response.metaData.message, 'error')
                            .then(() => {
                                location.reload();
                            })
                    } else {
                        fetchData(response.response);
                    }
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
    </script>
@endsection
