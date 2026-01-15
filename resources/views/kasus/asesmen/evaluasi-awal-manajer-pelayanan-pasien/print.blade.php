<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $judul_asesmen }}</title>
</head>

<style>
    @page {
        margin: 20px 30px;
    	footer: page-footer;
    }

    body {
        font-size: 14px;
        font-family: Arial, Helvetica, sans-serif;
    }

    table {
        width: 100%
    }

    table,
    tr,
    th,
    td {
        border-collapse: collapse;
    }

    table#content,
    #content tr,
    #content th,
    #content td {
        border: 1px solid #000;
    }

    #content td {
        padding: 3px 6px;
    }

    #info td {
        padding: 6px;
    }

    .text-center {
        text-align: center;
    }

    .border {
        border: 1px solid #000;
    }

    .b-bottom-0 {
        border-bottom: none;
    }
</style>

<body>
    @php
        $json = $asesmen->json_val;
    @endphp
    <table>
        <tr>
            <td width="80%"> </td>
            <td class="border b-bottom-0 text-center">
                <span>RM.30.1</span>
            </td>
        </tr>
        <tr>
            <td width="80%"> </td>
            <td class="border b-bottom-0 text-center">
                <span><em>Halaman 1/1</em></span>
            </td>
        </tr>
    </table>

    <!-- HEADER -->
    <table class="border border-bottom-0">
        <tr>
            <td width="60%" style="border: 1px solid #000">
                <table>
                    <tr>
                        <td width="18%" style="text-align: right;">
                            <img src="{{ url('') }}/assets/img/pemprov-jatim.png" height="55" loading="lazy">
                        </td>
                        <td width="62%" style="text-align: center; font-size: 11px;">
                            <b>
                                PEMERINTAH PROVINSI JAWA TIMUR<br>
                                RUMAH SAKIT JIWA MENUR<br>
                                Jl Menur No.120, Telp(031) 5021635-5021637<br>
                                Surabaya
                            </b>
                        </td>
                        <td width="20%" style="text-align: left;">
                            <img src="{{ url('') }}/assets/img/menur.png" height="55" loading="lazy">
                        </td>
                    </tr>
                </table>
            </td>
            <td style="border: 1px solid #000; padding-left: 10px">
                <table>
                    <tr>
                        <td><span>No. RM</span></td>
                        <td width="2%"><span>:</span></td>
                        <td> {{ optional($kasus->pasien)->no_rm }} </td>
                    </tr>
                    <tr>
                        <td><span>Nama</span></td>
                        <td><span>:</span></td>
                        <td> {{ optional($kasus->pasien)->name }} </td>
                    </tr>
                    <tr>
                        <td><span>Tgl lahir / umur</span></td>
                        <td><span>:</span></td>
                        <td> {{ optional($kasus->identitas)->tanggal }} / {{ optional($kasus->identitas)->age }} </td>
                    </tr>
                    <tr>
                        <td><span>Jenis kelamin</span></td>
                        <td><span>:</span></td>
                        <td> {{ optional($kasus->pasien)->jenis_kelamin }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="border b-bottom-0">
        <tr>
            <td class="text-center" style="padding: 6px">
                <h4>FORM A</h4>
                <h5>EVALUASI AWAL MANAJER PELAYANAN PASIEN (MPP)</h5>
            </td>
        </tr>
    </table>

    <table id="info" class="border b-bottom-0">
        <tr>
            <td width="20%">Diagnosa Medis</td>
            <td width="2%">:</td>
            <td>{{ $json->diagnosa_medis }}</td>
        </tr>

        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($json->tgl_asesmen)->format('d/m/Y') }}</td>
        </tr>

        <tr>
            <td>MPP</td>
            <td>:</td>
            <td>{{ $json->mpp }}</td>
        </tr>
    </table>

    @php
    @endphp

    <table id="content">
        <tr class="text-center">
            <th width="20%">TANGGAL/JAM</th>
            <th width="20%">DATA ASESMEN</th>
            <th>IDENTIFIKASI MASALAH</th>
            <th>PLAN</th>
            <th>KET</th>
        </tr>
        @foreach ($json->evaluasi as $index => $item)
            <tr>
                <td>{{ \Carbon\Carbon::parse($item->tgl)->format('d/m/Y') }} {{ $item->jam }}</td>
                <td>{{ $item->asesmen }}</td>
                <td @if (empty($item->masalah)) style="padding-top: 50px" @endif>{!! nl2br($item->masalah) !!}</td>
                <td @if (empty($item->plan)) style="padding-top: 50px" @endif>{!! nl2br($item->plan) !!}</td>
                <td @if (empty($item->ket)) style="padding-top: 50px" @endif>{!! nl2br($item->ket) !!}</td>
            </tr>
        @endforeach
    </table>

    <table style="text-align: center; margin-top: 10">
        <tr>
            <td></td>
            <td width="40%">Surabaya, {{ $asesmen->created_at->format('d F Y') }}</td>
        </tr>
        <tr>
            <td></td>
            <td>Manajer Pelayanan Pasien</td>
        </tr>
        <tr>
            <td></td>
            <td style="padding-top: 70px">
                <div>
                    (..............................................)
                </div>
            </td>
        </tr>
    </table>

    <htmlpagefooter name="page-footer">
        <small>RSJM / Revisi 00 / 08.2018</small>
    </htmlpagefooter>
</body>

</html>
