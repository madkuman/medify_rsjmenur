@extends('layouts.print')

@section('title')
Print Hasil Tes Bakat Minat Anak - {{$kasus->identitas->nama}}
@endsection

@section('css')
<style type="text/css">
    body, p {
        font-size: 12px;
        font-family: Arial, Helvetica, sans-serif;
        /*line-height: 16px;*/
    }
    
    table.bordered {
      border-collapse: collapse;
    }
    table.bordered, .bordered th, .bordered td {
      border: 1px solid black;
    }
    .word-break {
        word-wrap: break-word;width:100%;
    }
    .footer {
        width: 100%;
        text-align: right;
        position: fixed;
        bottom: 0px;
    }
    .pagenum:before {
        content: counter(page);
    }

    .center-table {
        margin-left: auto;
        margin-right: auto;
    }
    .column {
        flex: 50%;
        padding: 5px;
    }
    .text-centered {
        text-align: center;
        vertical-align: middle;
    }
    .text-bold {
        font-weight: bold;
    }
    .rotated {
        writing-mode: tb-rl;
        transform: rotate(-90deg);
        position: relative;
    }
    /*table { page-break-inside:auto }
    tr.next-page { page-break-inside:avoid !important; }
    thead { display:table-header-group }
    tfoot { display:table-footer-group }*/
</style>
@endsection

@section('content')
    <header>
        <table width="100%" align="center" style="border-bottom: 5px double #000;">
            <tr>
                <td width="100%" valign="top">
                    <table width="100%" cellpadding="5">
                       <tr>
                            <td width="20%" align="right">
                                <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="80">
                            </td>
                            <td width="60%" align="center">
                                <p style="font-size: 14px;"><b>PEMERINTAH PROVINSI JAWA TIMUR</b></p>
                                <p style="font-size: 22px;"><b>RUMAH SAKIT JIWA MENUR</b></p>
                                <p style="font-size: 10px;">Jln. Menur No. 120, Telp. (031) 5021635, 5021637</p>
                            </td>
                            <td width="20%" align="left">
                                <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="80">
                            </td>
                       </tr> 
                    </table>
                </td>
            </tr>
        </table>
    </header>

    <table width="100%" style="margin-top: 15px;">
        <tr>
            <td align="center"><p style="font-size: 14"><b><u>HASIL PEMERIKSAAN PSIKOLOGI</u></b></p></td>
        </tr>
    </table>

    <table width="100%" cellpadding="5" style="margin-top: 15px;">
        <tr>
            <td width="90%"></td>
            <td width="15%" align="center" bgcolor="#000" style="border: 3px solid #d9d9d9;">
                <p style="font-size: 14px; color: #fff;"><b>RAHASIA</b></p>
            </td>
        </tr>
    </table>

    <table class="bordered center-table" width="80%" style="margin-top: 15px;">
        <tr>
            <td style="width: 30%; text-align: center"><b>{{$kasus->identitas->nama ?? '-'}}</b></td>
            <td style="width: 30%; vertical-align: top;" rowspan="2">Tujuan Tes : {{ $pemeriksaan_psikologis_anak->tujuan_tes ?? '' }}</td>
            
        </tr>
        <tr>
            <td style="text-align: center">{{ $kasus->identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }} / {{ $kasus->identitas->umur ?? '-' }} Tahun</td>
        </tr>
        <tr>
            <td style="text-align: center">{{ $kasus->pasien->pendidikan->nama ?? '-' }}</td>
            <td>Tanggal Tes : 
                @if (isset($pemeriksaan_psikologis_anak->tanggal_pemeriksaan))
                    {{indonesian_date(date('d F Y', strtotime($pemeriksaan_psikologis_anak->tanggal_pemeriksaan)))}}
                @endif
            </td>
        </tr>
    </table>

    <table style="margin-top: 15px;">
        <tr>
            <td style="width: 15%"><b>A. OBSERVASI</b></td>
        </tr>
    </table>

    <table class="bordered center-table" width="80%" style="margin-top: 15px;">
        <tr>
            <th class="text-centered text-bold" style="width: 20%">Aspek Observasi</th>
            <th class="text-centered text-bold" style="width: 25%">Gambaran Individu (Skor Rendah)</th>
            <th class="text-centered text-bold" style="width: 5%">SR</th>
            <th class="text-centered text-bold" style="width: 5%">R</th>
            <th class="text-centered text-bold" style="width: 5%">S</th>
            <th class="text-centered text-bold" style="width: 5%">T</th>
            <th class="text-centered text-bold" style="width: 5%">ST</th>
            <th class="text-centered text-bold" style="width: 30%">Gambaran Individu (Skor Tinggi)</th>
        </tr>
        <tr>
            <td class="text-centered text-bold" rowspan="4">Sikap terhadap tester dan situasi tes</td>
            <td class="text-centered">Tidak mau bekerja sama</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kerja_sama ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kerja_sama ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kerja_sama ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kerja_sama ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kerja_sama ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Bisa bekerja sama</td>
        </tr>
        <tr>
            <td class="text-centered">Pasif</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->tester_pasif_aktif ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->tester_pasif_aktif ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->tester_pasif_aktif ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->tester_pasif_aktif ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->tester_pasif_aktif ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Aktif</td>
        </tr>
        <tr>
            <td class="text-centered">Tegang</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->tester_tegang_tenang ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->tester_tegang_tenang ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->tester_tegang_tenang ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->tester_tegang_tenang ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->tester_tegang_tenang ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Tenang</td>
        </tr>
        <tr>
            <td class="text-centered">Sulit menjawab</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->tester_menjawab ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->tester_menjawab ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->tester_menjawab ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->tester_menjawab ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->tester_menjawab ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Mudah menjawab</td>
        </tr>
        <tr>
            <td class="text-centered text-bold" rowspan="2">Sikap terhadap diri sendiri</td>
            <td class="text-centered">Ragu-ragu</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->sikap_keyakinan ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->sikap_keyakinan ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->sikap_keyakinan ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->sikap_keyakinan ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->sikap_keyakinan ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Yakin</td>
        </tr>
        <tr>
            <td class="text-centered">Menerima</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->sikap_penerimaan ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->sikap_penerimaan ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->sikap_penerimaan ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->sikap_penerimaan ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->sikap_penerimaan ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Kritis</td>
        </tr>
        <tr>
            <td class="text-centered text-bold" rowspan="4">Cara kerja</td>
            <td class="text-centered">Lambat</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecepatan_kerja ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecepatan_kerja ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecepatan_kerja ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecepatan_kerja ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecepatan_kerja ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Cepat</td>
        </tr>
        <tr>
            <td class="text-centered">Ceroboh</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecekatan_kerja ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecekatan_kerja ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecekatan_kerja ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecekatan_kerja ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecekatan_kerja ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Hati-hati</td>
        </tr>
        <tr>
            <td class="text-centered">Berpikir lambat</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->pikiran_kerja ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->pikiran_kerja ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->pikiran_kerja ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->pikiran_kerja ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->pikiran_kerja ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Berpikir cepat</td>
        </tr>
        <tr>
            <td class="text-centered">Sembarangan</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kerapian_kerja ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kerapian_kerja ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kerapian_kerja ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kerapian_kerja ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kerapian_kerja ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Rapi</td>
        </tr>
        <tr>
            <td class="text-centered text-bold">Perilaku</td>
            <td class="text-centered">Hiperaktif</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->perilaku ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->perilaku ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->perilaku ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->perilaku ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->perilaku ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Tenang</td>
        </tr>
        <tr>
            <td class="text-centered text-bold" rowspan="3">Reaksi terhadap kegagalan</td>
            <td class="text-centered">Tidak tahu</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->pengetahuan_kegagalan ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->pengetahuan_kegagalan ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->pengetahuan_kegagalan ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->pengetahuan_kegagalan ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->pengetahuan_kegagalan ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Mengetahui</td>
        </tr>
        <tr>
            <td class="text-centered">Kurang Usaha</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->usaha ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->usaha ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->usaha ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->usaha ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->usaha ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Mengetahui</td>
        </tr>
        <tr>
            <td class="text-centered">Gelisah</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kondisi_kegagalan ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kondisi_kegagalan ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kondisi_kegagalan ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kondisi_kegagalan ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kondisi_kegagalan ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Tenang</td>
        </tr>
        <tr>
            <td class="text-centered text-bold" rowspan="2">Reaksi dan cara bicara</td>
            <td class="text-centered">Janggal</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->ketenangan_bicara ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->ketenangan_bicara ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->ketenangan_bicara ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->ketenangan_bicara ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->ketenangan_bicara ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Tenang</td>
        </tr>
        <tr>
            <td class="text-centered">Kurang bergairah</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->reaksi_bicara ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->reaksi_bicara ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->reaksi_bicara ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->reaksi_bicara ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->reaksi_bicara ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Semakin Giat</td>
        </tr>
        <tr>
            <td class="text-centered text-bold" rowspan="3">Bahasa dan cara bicara</td>
            <td class="text-centered">Kurang baik</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kondisi_bicara ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kondisi_bicara ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kondisi_bicara ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kondisi_bicara ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kondisi_bicara ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Cara bicara baik</td>
        </tr>
        <tr>
            <td class="text-centered">Tidak jelas / tidak dapat dimengerti</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kejelasan_jawaban ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kejelasan_jawaban ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kejelasan_jawaban ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kejelasan_jawaban ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kejelasan_jawaban ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Jawaban jelas</td>
        </tr>
        <tr>
            <td class="text-centered">Hanya bicara bila ditanya</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecakapan_bicara ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecakapan_bicara ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecakapan_bicara ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecakapan_bicara ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecakapan_bicara ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Spontan</td>
        </tr>
        <tr>
            <td class="text-centered text-bold" rowspan="3">Visual Motorik</td>
            <td class="text-centered">Reaksi lambat</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecepatan_reaksi ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecepatan_reaksi ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecepatan_reaksi ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecepatan_reaksi ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecepatan_reaksi ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Reaksi cepat</td>
        </tr>
        <tr>
            <td class="text-centered">Coba-coba</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->reaksi_kehati_hatian ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->reaksi_kehati_hatian ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->reaksi_kehati_hatian ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->reaksi_kehati_hatian ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->reaksi_kehati_hatian ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Hati-hati dan sistematis</td>
        </tr>
        <tr>
            <td class="text-centered">Gerakan janggal</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->reaksi_gerakan ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->reaksi_gerakan ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->reaksi_gerakan ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->reaksi_gerakan ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->reaksi_gerakan ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Gerakan baik</td>
        </tr>
        <tr>
            <td class="text-centered text-bold">Motorik</td>
            <td class="text-centered">Koordinasi kurang baik</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->keadaan_koordinasi_motorik ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->keadaan_koordinasi_motorik ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->keadaan_koordinasi_motorik ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->keadaan_koordinasi_motorik ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->keadaan_koordinasi_motorik ?? '') == 'TS')
                    X
                @endif
            </td>
            <td class="text-centered">Koordinasi baik</td>
        </tr>
    </table>

    <div style="page-break-after: always;"></div>
    
    <header>
        <table width="100%" align="center" style="border-bottom: 5px double #000;">
            <tr>
                <td width="100%" valign="top">
                    <table width="100%" cellpadding="5">
                       <tr>
                            <td width="20%" align="right">
                                <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="80">
                            </td>
                            <td width="60%" align="center">
                                <p style="font-size: 14px;"><b>PEMERINTAH PROVINSI JAWA TIMUR</b></p>
                                <p style="font-size: 22px;"><b>RUMAH SAKIT JIWA MENUR</b></p>
                                <p style="font-size: 10px;">Jln. Menur No. 120, Telp. (031) 5021635, 5021637</p>
                            </td>
                            <td width="20%" align="left">
                                <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="80">
                            </td>
                       </tr> 
                    </table>
                </td>
            </tr>
        </table>
    </header>

    <table style="width: 100%; margin-top: 15px">
        <tr>
            <td style="width: 5%"></td>
            <td style="width: 95%" class="text-bold">B. PSIKOGRAM</td>
        </tr>
    </table>

    <table class="bordered" style="width: 80%; margin-top: 15px">
        <tr>
            <td class="text-centered" style="width: 50%">Kemampuan Intelegensi</td>
            <td class="text-centered" style="width: 50%">Kategori : {{$pemeriksaan_psikologis_anak->kategori ?? ''}}</td>
        </tr>
    </table>

    <table class="bordered" style="width: 100%; margin-top: 15px">
        <tr>
            <th class="text-centered text-bold" colspan="2" style="width: 25%">Aspek Psikologis</th>
            <th class="text-centered text-bold" style="width: 25%">Gambaran Individu (Skor Rendah)</th>
            <th class="text-centered text-bold" style="width: 5%">SR</th>
            <th class="text-centered text-bold" style="width: 5%">R</th>
            <th class="text-centered text-bold" style="width: 5%">S</th>
            <th class="text-centered text-bold" style="width: 5%">T</th>
            <th class="text-centered text-bold" style="width: 5%">ST</th>
            <th class="text-centered text-bold" style="width: 25%">Gambaran Individu (Skor Tinggi)</th>
        </tr>
        <tr>
            <td class="text-centered text-bold" rowspan="4">Kemampuan Intelektual</td>
            <td class="text-bold">Kecerdasan Umum</td>
            <td>Potensi kecerdasan secara umum kurang</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecerdasan_umum ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecerdasan_umum ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecerdasan_umum ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecerdasan_umum ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kecerdasan_umum ?? '') == 'TS')
                    X
                @endif
            </td>
            <td>Potensi kecerdasan secara umum memadai</td>
        </tr>
        <tr>
            <td class="text-bold">Pengamatan Ruang</td>
            <td>Kurang teliti dalam menyelesaikan suatu tugas</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->pengamatan_ruang ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->pengamatan_ruang ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->pengamatan_ruang ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->pengamatan_ruang ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->pengamatan_ruang ?? '') == 'TS')
                    X
                @endif
            </td>
            <td>Teliti dalam menyelesaikan suatu tugas</td>
        </tr>
        <tr>
            <td class="text-bold">Kemampuan Analisa</td>
            <td>Kurang mampu berpikir menyeluruh dalam menghadapi persoalan</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_analisa ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_analisa ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_analisa ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_analisa ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_analisa ?? '') == 'TS')
                    X
                @endif
            </td>
            <td>Kemampuan berpikir menyeluruh, menangkap, dan membentuk sesuatu</td>
        </tr>
        <tr>
            <td class="text-bold">Kemampuan berpikir Analogi</td>
            <td>Kurang mampu menalar masalah dan mengambil kesimpulan atas suatu persoalan</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_berpikir_analogi ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_berpikir_analogi ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_berpikir_analogi ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_berpikir_analogi ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_berpikir_analogi ?? '') == 'TS')
                    X
                @endif
            </td>
            <td>Mampu menalar masalah dan mengambil kesimpulan atas suatu persoalan</td>
        </tr>
        <tr>
            <td class="text-centered text-bold" rowspan="4">Kecerdasan Emosi</td>
            <td class="text-bold">Emosi</td>
            <td>Emosional, mudah tersinggung, dan lebih dipengaruhi perasaan.</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->emosi ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->emosi ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->emosi ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->emosi ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->emosi ?? '') == 'TS')
                    X
                @endif
            </td>
            <td>Kemampuan mengendalikan emosi dengan baik dan tidak mudah reaktif terhadap situasi lingkungan</td>
        </tr>
        <tr>
            <td class="text-bold">Kemampuan Sosial</td>
            <td>Kurang memperhatikan tuntunan sosial.</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_sosial ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_sosial ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_sosial ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_sosial ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_sosial ?? '') == 'TS')
                    X
                @endif
            </td>
            <td>Peka atau tanggap terhadap perasaan dan kebutuhan orang lain di lingkungan sosial</td>
        </tr>
        <tr>
            <td class="text-bold">Kemampuan Adaptasi</td>
            <td>Kaku, kurang luwes, membutuhkan waktu lama untuk menuyesuaikan diri.</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_adaptasi ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_adaptasi ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_adaptasi ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_adaptasi ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->kemampuan_adaptasi ?? '') == 'TS')
                    X
                @endif
            </td>
            <td>Mampu menyesuaikan diri dengan perubahan situasi</td>
        </tr>
        <tr>
            <td class="text-bold">Motivasi Berprestasi</td>
            <td>Mudah puas, kurang memiliki dorongan yang kuat untuk mencapai hasil atau prestasi yang lebih dari sekadarnya.</td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->motivasi_prestasi ?? '') == 'SR')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->motivasi_prestasi ?? '') == 'R')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->motivasi_prestasi ?? '') == 'S')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->motivasi_prestasi ?? '') == 'T')
                    X
                @endif
            </td>
            <td class="text-centered">
                @if (($pemeriksaan_psikologis_anak->motivasi_prestasi ?? '') == 'TS')
                    X
                @endif
            </td>
            <td>Memiliki dorongan untuk melakukan pekerjaan secara maksimal serta berusaha untuk mencapai hasil atau prestasi dengan sebaik mungkin</td>
        </tr>
    </table>

    <table style="width: 100%; margin-top: 15px">
        <tr>
            <td style="width: 50%;" align="center">
                <table class="bordered" style="width: 100%;">
                    <tr>
                        <td class="text-bold">Skor IQ</td>
                        <td class="text-bold">Klasifikasi</td>
                    </tr>
                    <tr>
                        <td class="text-center text-bold">>129</td>
                        <td>Sangat Superior</td>
                    </tr>
                    <tr>
                        <td class="text-center text-bold">120-129</td>
                        <td>Superior</td>
                    </tr>
                    <tr>
                        <td class="text-center text-bold">110-119</td>
                        <td>Rata-rata Atas</td>
                    </tr>
                    <tr>
                        <td class="text-center text-bold">90-109</td>
                        <td>Rata-rata</td>
                    </tr>
                    <tr>
                        <td class="text-center text-bold">80-89</td>
                        <td>Rata-rata Bawah</td>
                    </tr>
                    <tr>
                        <td class="text-center text-bold">70-79</td>
                        <td>Borderline</td>
                    </tr>
                    <tr>
                        <td class="text-center text-bold">{{"<70"}}</td>
                        <td>Intelectual deficient</td>
                    </tr>
                </table>
            </td>
            <td style="width: 50%;" align="center">
                <table>
                    <table style="width: 100%; border: 1px solid black">
                        <tr>
                            <td class="text-center text-bold">Keterangan : </td>
                        </tr>
                        <tr>
                            <td class="text-center">SR - Sangat Rendah</td>
                        </tr>
                        <tr>
                            <td class="text-center">R - Rendah</td>
                        </tr>
                        <tr>
                            <td class="text-center">S - Sedang</td>
                        </tr>
                        <tr>
                            <td class="text-center">T - Tinggi</td>
                        </tr>
                        <tr>
                            <td class="text-center">ST - Sangat Tinggi</td>
                        </tr>
                    </table>
                </table>
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 20px;">
        <tr>
            <td width="60%"></td>
            <td width="40%" align="center">Surabaya, {{ indonesian_date($pemeriksaan_psikologis_anak->created_at) ?? '-' }}</td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>Pemeriksa</b></td>
        </tr>
        <tr>
            <td></td>
            @if (isset($pemeriksaan_psikologis_anak->creator->ttd))
                <td class="text-centered"><img src="{{{url('')}}}/{{{$pemeriksaan_psikologis_anak->creator->ttd}}}" height="50px"></td>
            @else
                <td align="center" height="30"></td>
            @endif
        </tr>
        <tr>
            <td></td>
            <td align="center" class="text-bold">
                <p><u>{{$pemeriksaan_psikologis_anak->creator->name ?? '.........................................'}}</u></p>
            </td>
        </tr>
    </table>

    <div style="page-break-after: always;"></div>

    <header>
        <table width="100%" align="center" style="border-bottom: 5px double #000;">
            <tr>
                <td width="100%" valign="top">
                    <table width="100%" cellpadding="5">
                       <tr>
                            <td width="20%" align="right">
                                <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="80">
                            </td>
                            <td width="60%" align="center">
                                <p style="font-size: 14px;"><b>PEMERINTAH PROVINSI JAWA TIMUR</b></p>
                                <p style="font-size: 22px;"><b>RUMAH SAKIT JIWA MENUR</b></p>
                                <p style="font-size: 10px;">Jln. Menur No. 120, Telp. (031) 5021635, 5021637</p>
                            </td>
                            <td width="20%" align="left">
                                <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="80">
                            </td>
                       </tr> 
                    </table>
                </td>
            </tr>
        </table>
    </header>

    <table style="width: 100%; margin-top: 15px">
        <tr>
            <td style="width: 5%">&nbsp;</td>
            <td style="width: 95%"><b>KESIMPULAN</b></td>
        </tr>
        <tr>
            <td colspan="2">{{$pemeriksaan_psikologis_anak->kesimpulan ?? ''}}</td>
        </tr>
    </table>
    <table style="width: 100%">
        <tr>
            <td class="text-bold" style="width: 10%">Saran</td>
            <td class="text-bold" style="width: 90%">: {{$pemeriksaan_psikologis_anak->saran ?? ''}}</td>
        </tr>
        <tr>
            <td class="text-bold">Catatan</td>
            <td class="text-bold">: {{$pemeriksaan_psikologis_anak->catatan ?? ''}}</td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 20px;">
        <tr>
            <td width="60%"></td>
            <td width="40%" align="center">Surabaya, {{ indonesian_date($pemeriksaan_psikologis_anak->created_at) ?? '-' }}</td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>Pemeriksa</b></td>
        </tr>
        <tr>
            <td></td>
            @if (isset($pemeriksaan_psikologis_anak->creator->ttd))
                <td class="text-centered"><img src="{{{url('')}}}/{{{$pemeriksaan_psikologis_anak->creator->ttd}}}" height="50px"></td>
            @else
                <td align="center" height="30"></td>
            @endif
        </tr>
        <tr>
            <td></td>
            <td align="center">
                <p><u>{{$pemeriksaan_psikologis_anak->creator->name ?? '.........................................'}}</u></p>
            </td>
        </tr>
    </table>
@endsection