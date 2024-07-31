@extends('layouts.print')

@section('title')
    {{ $kasus->judul_kasus }} - Print Form Transfer Antar Ruangan
@endsection

@section('css')
    <style>
        body {
            font-size: 12px
        }

        td {
            vertical-align: top;
            padding: 2px;
        }

        .bordered {
            border: 1px solid #000;
            border-bottom: none;
            padding-bottom: 10px;
        }

        .bordered-full {
            border: 1px solid #000;
        }

        .subheader {
            padding: 2px 0;
            background-color: rgb(227, 227, 227);
        }
    </style>
@endsection

@section('content')
    <table style="width:100%; border-collapse: collapse">
        <tr>
            <td width="80%"> </td>
            <td style="border: 1px solid #000; border-bottom: none; text-align: center">
                <span>RM. 09</span>
            </td>
        </tr>
    </table>

    <table style="width:100%" class="bordered">
        <tr>
            <td width="60%" style="vertical-align: middle; padding: 10px 0">
                <table width="100%">
                    <tr>
                        <td width="18%" style="text-align: right;">
                            <img src="{{ url('') }}/assets/img/pemprov-jatim-100px.png" height="55">
                        </td>
                        <td width="62%" style="text-align: center; font-size: 11px;">
                            <b>
                                PEMERINTAH PROVINSI JAWA TIMUR<br>
                                RUMAH SAKIT JIWA MENUR<br>
                                Jl Menur No.120, Telp(031) 5021635, 5021637<br>
                                Surabaya
                            </b>
                        </td>
                        <td width="20%" style="text-align: left;">
                            <img src="{{ url('') }}/assets/img/menur-100px.png" height="55">
                        </td>
                    </tr>
                </table>
            </td>

            <td>
                <table width="100%">
                    <tr>
                        <td><span>No. RM</span></td>
                        <td width="2%"><span>:</span></td>
                        <td> {{ $kasus->pasien->no_rm ?? '' }} </td>
                    </tr>
                    <tr>
                        <td><span>Nama</span></td>
                        <td><span>:</span></td>
                        <td> {{ $kasus->pasien->name ?? '' }} </td>
                    </tr>
                    <tr>
                        <td><span>Tgl lahir / umur</span></td>
                        <td><span>:</span></td>
                        <td> {{ indonesian_date($kasus->pasien->date_of_birth) }} / {{ $kasus->identitas->age ?? '' }} </td>
                    </tr>
                    <tr>
                        <td><span>Jenis kelamin</span></td>
                        <td><span>:</span></td>
                        <td> {{ $kasus->pasien->jenis_kelamin ?? '' }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>
    <table style="width:100%" class="bordered">
        <tr>
            <td>
                <h3 style="text-align: center; padding-top: 2px">FORM TRANSFER INTERNAL RUMAH SAKIT</h3>
            </td>
        </tr>
    </table>
    <table style="width:100%" class="bordered">
        <tr>
            <td width="20%"><span>DPJP</span></td>
            <td width="2%"><span>:</span></td>
            <td width="28%">
                @if (!empty($form_data->dpjp) && ($dpjp = app\User::find($form_data->dpjp)))
                    {{ $dpjp->name }}
                @endif
            </td>
            <td width="20%"><span>Tanggal MRS</span></td>
            <td width="2%"><span>:</span></td>
            <td width="28%">{{ $form_data->tgl_mrs ?? '' }}</td>
        </tr>
        <tr>
            <td><span>Dokter Spesialis Lain</span></td>
            <td><span>:</span></td>
            <td>
                @if (
                    !empty($form_data->dokter_spesialis_lain) &&
                        ($dokter_spesialis_lain = app\User::find($form_data->dokter_spesialis_lain)))
                    {{ $dokter_spesialis_lain->name }}
                @endif
            </td>
            <td><span>Tanggal Pindah</span></td>
            <td><span>:</span></td>
            <td>{{ $form_data->tgl_pindah ?? '' }}</td>
        </tr>
        <tr>
            <td><span>Diagnosis MRS</span></td>
            <td><span>:</span></td>
            <td>{{ $form_data->diagnosis_mrs ?? '' }}</td>
            <td><span>Alergi</span></td>
            <td><span>:</span></td>
            <td>{{ $form_data->alergi ?? ('' ?? '') }}</td>
        </tr>
        <tr>
            <td><span>Alasan Admisi</span></td>
            <td><span>:</span></td>
            <td colspan="4" rowspan="1">{{ $form_data->alasan_admisi ?? ('' ?? '') }}
            </td>
        </tr>
    </table>
    <table style="width:100%" class="bordered subheader">
        <tr>
            <td>
                <h4>I. RINGKASAN RIWAYAT PASIEN</h4>
            </td>
        </tr>
    </table>
    <table style="width:100%" class="bordered">
        <tr>
            <td width="20%">
                <span>Anamnesis</span>
            </td>
            <td width="2%"><span>:</span></td>
            <td>{{ $form_data->anamnesis ?? ('' ?? '') }}</td>
        </tr>
        <tr>
            <td><span>Keluhan Utama</span></td>
            <td>:</td>
            <td>{!! nl2br($form_data->keluhan_utama) ?? ('' ?? '') !!}
            </td>
        </tr>
        <tr>
            <td><span>Riwayat Penyakit</span></td>
            <td><span>:</span></td>
            <td>{!! nl2br($form_data->riwayat_penyakit) ?? ('' ?? '') !!}</td>
        </tr>
        <tr>
            <td><span>Pemeriksaan Fisik</span></td>
            <td><span>:</span></td>
            <td>{!! nl2br($form_data->pemeriksaan_fisik) ?? ('' ?? '') !!}</td>
        </tr>
        <tr>
            <td><span>Keadaan Umum</span></td>
            <td><span>:</span></td>
            <td>{!! nl2br($form_data->keadaan_umum ?? ('' ?? '')) !!}</td>
        </tr>
    </table>
    <table style="width:100%;" class="bordered subheader">
        <tr>
            <td>
                <h4>II. PEMERIKSAAN PENUNJANG</h4>
            </td>
        </tr>
    </table>
    <table style="width:100%" class="bordered">
        <tr>
            <td>{!! nl2br($form_data->pemeriksaan_penunjang) ?? ('' ?? '') !!}</td>
        </tr>
    </table>
    <table style="width:100%;" class="bordered subheader">
        <tr>
            <td>
                <h4>III. TINDAKAN MEDIS YANG SUDAH DILAKUKAN</h4>
            </td>
        </tr>
    </table>
    <table style="width:100%" class="bordered">
        <tr>
            <td>{!! nl2br($form_data->tindakan_medis) ?? ('' ?? '') !!}</td>
        </tr>
    </table>
    <table style="width:100%;" class="bordered subheader">
        <tr>
            <td>
                <h4>IV. PEMBERIAN TERAPI</h4>
            </td>
        </tr>
    </table>
    <table style="width:100%" class="bordered">
        <tr>
            <td>{!! nl2br($form_data->pemberian_terapi) ?? ('' ?? '') !!}</td>
        </tr>
    </table>
    <table style="width:100%;" class="bordered subheader">
        <tr>
            <td>
                <h4>V. LAIN-LAIN</h4>
            </td>
        </tr>
    </table>
    <table style="width:100%" class="bordered-full">
        <tr>
            <td>{!! nl2br($form_data->lain_lain) ?? ('' ?? '') !!}</td>
        </tr>
    </table>

    <table width="100%" style="margin: 20px 0;">
        <tr class="text-center">
            <td width="70%"></td>
            <td>
                <div style="margin-bottom: 80px">Dokter</div>
                <div>
                    @php $user = !empty($form_data->dpjp) ? app\User::find($form_data->dpjp) : null @endphp
                    @if ($user && file_exists($user->ttd))
                        <div><img src="{{ url('') }}/{{ $user->ttd }}" height="80"></div>
                    @else
                        <br><br>
                    @endif
                    ({{ $user->name ?? '..................................' }})
                </div>
            </td>
        </tr>
    </table>

    <table style="width:100%; page-break-before: always;" class="bordered subheader">
        <tr>
            <td colspan="8" rowspan="1">
                <h4>VI. KONDISI PASIEN</h4>
            </td>
        </tr>
    </table>

    <table style="width:100%" class="bordered">
        <tr class="bordered">
            <td width="20%"><span>Dari Ruang</span></td>
            <td width="2%"><span>:</span></td>
            <td width="25%">
                {{ $form_data->dari_ruang ?? ('' ?? '') }}
            </td>
            <td width="5%"></td>
            <td width="20%"><span>Ke Ruang</span></td>
            <td width="2%"><span>:</span></td>
            <td width="25%">
                {{ $form_data->ke_ruang ?? ('' ?? '') }}
            </td>
        </tr>

        <tr class="bordered">
            <td><span>Sebelum Transfer, jam</span></td>
            <td><span>:</span></td>
            <td>{{ $form_data->transfer_sebelum ?? ('' ?? '') }}</td>
            <td width="5%"></td>
            <td><span>Setelah Transfer, jam</span></td>
            <td><span>:</span></td>
            <td>{{ $form_data->transfer_sesudah ?? ('' ?? '') }}</td>
        </tr>
    </table>

    <table style="width:100%" class="bordered">
        <tr>
            <td width="20%"><span>Keadaan Umum</span></td>
            <td width="2%"><span>:</span></td>
            <td width="25%">{{ $form_data->keadaan_umum ?? ('' ?? '') }}
            </td>
            <td width="5%"></td>
            <td width="20%"><span>Keadaan Umum</span></td>
            <td width="2%"><span>:</span></td>
            <td width="25%">
                {{ $form_data->keadaan_umum_sesudah ?? ('' ?? '') }}</td>
        </tr>
        <tr>
            <td><span>Kesadaran</span></td>
            <td><span>:</span></td>
            <td>
                {{ $form_data->kesadaran_sebelum ?? ('' ?? '') }}</td>
            <td width="5%"></td>
            <td><span>Kesadaran</span></td>
            <td><span>:</span></td>
            <td>
                {{ $form_data->kesadaran_sesudah ?? ('' ?? '') }}</td>
        </tr>
        <tr>
            <td><span>Pemeriksaan tanda-tanda vital :</span>
            </td>
            <td> </td>
            <td> </td>
            <td width="5%"></td>
            <td><span>Pemeriksaan tanda-tanda vital :</span>
            </td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td><span>Tensi</span></td>
            <td><span>:</span></td>
            <td>{{ $form_data->tensi_sebelum ?? ('' ?? '') }} <span style="padding-left: 10px">mmHg</span>
            </td>
            <td width="5%"></td>
            <td><span>Tensi</span></td>
            <td><span>:</span></td>
            <td>{{ $form_data->tensi_sesudah ?? ('' ?? '') }} <span style="padding-left: 10px">mmHg</span>
            </td>
        </tr>
        <tr>
            <td><span>Suhu</span></td>
            <td><span>:</span></td>
            <td>{{ $form_data->suhu_sebelum ?? ('' ?? '') }} <span style="padding-left: 10px">&deg;C</span>
            </td>
            <td width="5%"></td>
            <td><span>Suhu</span></td>
            <td><span>:</span></td>
            <td>{{ $form_data->suhu_sesudah ?? ('' ?? '') }} <span style="padding-left: 10px">&deg;
                    C</span>
            </td>
        </tr>
        <tr>
            <td><span>Nadi</span></td>
            <td><span>:</span></td>
            <td>{{ $form_data->nadi_sebelum ?? ('' ?? '') }} <span style="padding-left: 10px">x / mnt</span>
            </td>
            <td width="5%"></td>
            <td><span>Nadi</span></td>
            <td><span>:</span></td>
            <td>{{ $form_data->nadi_sesudah ?? ('' ?? '') }} <span style="padding-left: 10px">x / mnt</span>
            </td>
        </tr>
        <tr>
            <td><span>Respirasi</span></td>
            <td><span>:</span></td>
            <td>{{ $form_data->resp_sebelum ?? ('' ?? '') }} <span style="padding-left: 10px">x /
                    mnt</span>
            </td>
            <td width="5%"></td>
            <td><span>Respirasi</span></td>
            <td><span>:</span></td>
            <td>{{ $form_data->resp_sesudah ?? ('' ?? '') }} <span style="padding-left: 10px">x /
                    mnt</span>
            </td>
        </tr>
    </table>
    <table style="width:100%" class="bordered">
        <tr>
            <td width="48%"><strong>Catatan Penting :</strong></td>
            <td width="4%"></td>
            <td width="48%"><strong>Catatan Penting :</strong></td>
        </tr>
        <tr>
            <td width="48%">{!! nl2br($form_data->catatan_sebelum) ?? ('' ?? '') !!}</td>
            <td width="4%"></td>
            <td width="48%">{!! nl2br($form_data->catatan_sesudah) ?? ('' ?? '') !!}</td>
        </tr>
    </table>
    <table style="width:100%" class="bordered-full">
        <tr class="text-center">
            <td width="48%"><strong>Petugas yang menyerahkan</strong></td>
            <td width="4%"></td>
            <td width="48%"><strong>Petugas yang menyerahkan</strong></td>
        </tr>
        <tr class="text-center">
            <td width="48%" style="padding-top: 50px">
                @php $user = !empty($form_data->petugas_sebelum) ? app\User::find($form_data->petugas_sebelum) : null @endphp
                @if ($user && file_exists($user->ttd))
                    <div><img src="{{ url('') }}/{{ $user->ttd }}" height="80"></div>
                @else
                    <br><br>
                @endif
                {{ $user->name ?? '' }}
            </td>
            <td width="4%"></td>
            <td width="48%" style="padding-top: 50px">
                @php $user = !empty($form_data->petugas_sesudah) ? app\User::find($form_data->petugas_sesudah) : null @endphp
                @if ($user && file_exists($user->ttd))
                    <div><img src="{{ url('') }}/{{ $user->ttd }}" height="80"></div>
                @else
                    <br><br>
                @endif
                {{ $user->name ?? '' }}
            </td>
        </tr>
    </table>
@endsection
