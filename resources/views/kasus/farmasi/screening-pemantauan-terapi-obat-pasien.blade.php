@extends('kasus.layouts.main')

@section('title')
    {{ $kasus->judul_kasus }} - Screening Pemantauan Terapi Obat Pasien - Kasus
@endsection

@section('css')
    <style type="text/css">
        .text-center {
            text-align: center;
            vertical-align: middle;
        }
    </style>
@endsection

@section('content')
    <main id="main-container">
        @include('kasus.layouts.header')
        <div class="content">
            <div class="row">
                @include('kasus.layouts.sidebar')

                <div class="col-lg-8 col-xl-9">
                    <div class="row">
                        <div class="col-lg-12 modal-sidebar" style="display: none; margin-bottom: 5px;">
                            <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal"
                                data-target="#modal-menu"><i class="fa fa-list"></i> Menu</button>
                        </div>
                        <div class="col-lg-12">
                            <div class="block rounded p-0">
                                @include('kasus.farmasi.components.navbar')

                                <div class="block-content px-20 pt-20">
                                    @if (session('my_role_' . $kasus->nomor_kasus))
                                        @if (session('my_role_' . $kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
                                            <a href="{{ url()->current() }}/print" class="btn btn-info" target="_blank"><i
                                                    class="fa fa-print" aria-hidden="true"></i> Cetak</a>
                                            <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#addModal"
                                                style="float: right"><i class="fa fa-pencil" aria-hidden="true"></i> Tambah
                                                Data Baru</button>
                                        @endif
                                    @endif
                                    <table class="table table-bordered table-vcenter" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="20%" class="text-center" style="vertical-align: middle">Nama
                                                    Pasien</th>
                                                <th width="10%" class="text-center" style="vertical-align: middle">No. RM
                                                </th>
                                                <th width="30%" class="text-center" style="vertical-align: middle">Hasil
                                                    Cek List Pemantauan Terapi Obat</th>
                                                <th width="30%" class="text-center" style="vertical-align: middle">Alasan
                                                </th>
                                                <th width="10%" class="text-center" style="vertical-align: middle">Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pemantauan_terapi as $item)
                                                @php $res = json_decode($item->val) @endphp
                                                <tr>
                                                    <td>{{ $kasus->pasien->name ?? '' }}</td>
                                                    <td>{{ $kasus->pasien->no_rm ?? '' }}</td>
                                                    @php
                                                        $hasil_cek_list = '';
                                                        if (
                                                            !empty($res->polifarmasi) ||
                                                            !empty($res->variasi_rute) ||
                                                            !empty($res->variasi_aturan) ||
                                                            !empty($res->variasi_cara_pemberian)
                                                        ) {
                                                            $hasil_cek_list = 'Dilakukan Pemantauan Terapi Obat';
                                                        }

                                                        $polifarmasi = !empty($res->polifarmasi) ? 'Polifarmasi' : '';
                                                        $variasi_rute = !empty($res->variasi_rute)
                                                            ? ', Variasi Rute'
                                                            : '';
                                                        $varasi_aturan = !empty($res->varasi_aturan)
                                                            ? 'Variasi Aturan'
                                                            : '';
                                                        $variasi_cara_pemberian = !empty($res->variasi_cara_pemberian)
                                                            ? ', Variasi Cara Pemberian'
                                                            : '';
                                                    @endphp
                                                    <td style="text-align: center">{{ $hasil_cek_list ?? '' }}</td>
                                                    <td style="text-align: center">{{ $polifarmasi ?? '' }}
                                                        {{ $variasi_rute ?? '' }} {{ $varasi_aturan ?? '' }}
                                                        {{ $variasi_cara_pemberian ?? '' }}</td>
                                                    <td style="text-align: center">
                                                        @if (session('my_role_' . $kasus->nomor_kasus))
                                                            @if (session('my_role_' . $kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
                                                                <button
                                                                    class="btn btn-sm btn-circle btn-outline-danger deleteBtn"
                                                                    data-id="{{ $item->id }}">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" style="text-align: center; vertical-align: middle">
                                                        <b>Belum ada data</b>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ceklist Pasien Dengan Pemantauan Terapi Obat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url()->current() }}/create" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <table width="100%">
                                <thead>
                                    <tr style="background-color: #d4d4d4">
                                        <th colspan="2" width="80%">Kondisi Pasien</th>
                                        <th class="text-center" width="10%">YA</th>
                                        <th class="text-center" width="10%">TIDAK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td width="5%" class="text-center">1</td>
                                        <td>Dengan multi penyakit</td>
                                        <td class="text-center"><input type="radio" name="multi_penyakit" value="1">
                                        </td>
                                        <td class="text-center"><input type="radio" name="multi_penyakit" value="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td>Pasien kanker yang menerima terapi sitostatika</td>
                                        <td class="text-center"><input type="radio" name="pasien_kanker" value="1">
                                        </td>
                                        <td class="text-center"><input type="radio" name="pasien_kanker" value="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td>Pasien dengan gangguan fungsi organ terutama hati dan ginjal</td>
                                        <td class="text-center"><input type="radio" name="pasien_gangguan_fungsi_organ"
                                                value="1"></td>
                                        <td class="text-center"><input type="radio" name="pasien_gangguan_fungsi_organ"
                                                value="0"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td>Pasien geriatri dan pediatri</td>
                                        <td class="text-center"><input type="radio" name="pasien_geriatri"
                                                value="1"></td>
                                        <td class="text-center"><input type="radio" name="pasien_geriatri"
                                                value="0"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">5</td>
                                        <td>Pasien hamil dan menyusui</td>
                                        <td class="text-center"><input type="radio" name="pasien_hamil"
                                                value="1"></td>
                                        <td class="text-center"><input type="radio" name="pasien_hamil"
                                                value="0"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">6</td>
                                        <td>Pasien dengan perawatan intensif</td>
                                        <td class="text-center"><input type="radio" name="pasien_perawatan"
                                                value="1"></td>
                                        <td class="text-center"><input type="radio" name="pasien_perawatan"
                                                value="0"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <table width="100%">
                                <thead>
                                    <tr style="background-color: #d4d4d4">
                                        <th colspan="4">Obat</th>
                                    </tr>
                                    <tr style="background-color: #d4d4d4">
                                        <th width="5%" class="text-center">A</th>
                                        <th width="75%">Jenis Obat</th>
                                        <th width="10%">&nbsp;</th>
                                        <th width="10%">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>Obat dengan indeks terapi sempit (contoh: digoksin, fenitoin)</td>
                                        <td class="text-center"><input type="radio" name="obat_indeks_terapi"
                                                value="1"></td>
                                        <td class="text-center"><input type="radio" name="obat_indeks_terapi"
                                                value="0"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td>Obat yang bersifat nefrotoksik (contoh: gentamisin) dan hepatotoksik (contoh:
                                            OAT)</td>
                                        <td class="text-center"><input type="radio" name="nefrotoksik" value="1">
                                        </td>
                                        <td class="text-center"><input type="radio" name="nefrotoksik" value="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td>Sitostatika (contoh: metotreksat)</td>
                                        <td class="text-center"><input type="radio" name="sitostatika" value="1">
                                        </td>
                                        <td class="text-center"><input type="radio" name="sitostatika" value="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td>Antikoagulan (contoh: warfarin, heparin)</td>
                                        <td class="text-center"><input type="radio" name="antikoagulan"
                                                value="1"></td>
                                        <td class="text-center"><input type="radio" name="antikoagulan"
                                                value="0"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">5</td>
                                        <td>Obat yang sering menimbulkan ROTD (contoh: metoklopramid, AINS)</td>
                                        <td class="text-center"><input type="radio" name="rotd" value="1">
                                        </td>
                                        <td class="text-center"><input type="radio" name="rotd" value="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">6</td>
                                        <td>Obat kardiovaskular (contoh: nitrogliserin)</td>
                                        <td class="text-center"><input type="radio" name="kardiovaskular"
                                                value="1"></td>
                                        <td class="text-center"><input type="radio" name="kardiovaskular"
                                                value="0"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <table width="100%">
                                <thead>
                                    <tr style="background-color: #d4d4d4">
                                        <th width="5%" class="text-center">B</th>
                                        <th width="75%">Kompleksitas regimen</th>
                                        <th width="10%">&nbsp;</th>
                                        <th width="10%">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>Polifarmasi</td>
                                        <td class="text-center"><input type="radio" name="polifarmasi" value="1">
                                        </td>
                                        <td class="text-center"><input type="radio" name="polifarmasi" value="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td>Variasi rute pemberian</td>
                                        <td class="text-center"><input type="radio" name="variasi_rute"
                                                value="1"></td>
                                        <td class="text-center"><input type="radio" name="variasi_rute"
                                                value="0"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td>Variasi aturan pakai</td>
                                        <td class="text-center"><input type="radio" name="variasi_aturan"
                                                value="1"></td>
                                        <td class="text-center"><input type="radio" name="variasi_aturan"
                                                value="0"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td>Cara pemberian khusus (contoh: inhalis)</td>
                                        <td class="text-center"><input type="radio" name="variasi_cara_pemberian"
                                                value="1"></td>
                                        <td class="text-center"><input type="radio" name="variasi_cara_pemberian"
                                                value="0"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <form method="POST" action="{{ url()->current() }}/delete" id="formDelete">
            {{ csrf_field() }}
            <input name="id" type="hidden" id="deleteInputId">
        </form>

    </main>
@endsection

@section('js')
    <script>
        $(".deleteBtn").click(function(e) {
            e.preventDefault();
            id = $(this).data("id");
            $('#deleteInputId').val(id);
            swal({
                title: "Hapus",
                text: "Apakah anda yakin akan menghapus data ini?",
                showCancelButton: true,
                reverseButtons: true,
                type: 'warning',
                confirmButtonClass: "btn btn-danger",
                cancelButtonClass: "btn btn-default",
                confirmButtonText: "Hapus",
                cancelButtonText: "Kembali",
                closeOnConfirm: false
            }).then(function(result) {
                if (result.value) {
                    $('#formDelete').submit();
                }
            });
        });
    </script>
@endsection
