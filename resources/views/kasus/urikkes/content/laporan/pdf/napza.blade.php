<!DOCTYPE html>
<html>
<style type="text/css">
    html {
        padding: 0%;
        height: 100%;
        font-family: sans-serif;
    }

    body {
        font-size: 16px;
        height: 100%;
    }

    table {
        border-collapse: collapse;

    }

    .noBorder {
        border: 0;
    }

    .bordered {
        border: 1px solid black;
    }

    .centered {
        text-align: center;
    }

    .table-title {
        padding-bottom: 5px;
        padding-top: 5px;
    }

    td {
        white-space: pre;
        padding-top: 0px;
        padding-bottom: 0px;
        vertical-align: top;
    }

    .bigfont {
        font-size: 20px;
    }

    .gambar {
        text-align: center;
        align-content: center;
    }

    .va-mid {
        vertical-align: middle;
    }

    #watermark {
        position: fixed;

        z-index: -1000;
        opacity: 0.05;
        top: 200px;
        left: 5%;
    }
</style>

<head>
    <title>Laporan Kegiatan Kesehatan - Pemeriksaan Napza</title>
</head>

<body>
    <table width="100%" class="noBorder bigfont">
        <tr>
            <td width="100%" class="centered va-mid"><b>{{ config('app.name') }}<br>DEPARTEMEN KESEHATAN JIWA</b></td>
        </tr>
    </table>
    <hr><br>
    <div style="align-content: center; text-align: center;">
        SURAT KETERANGAN PEMERIKSAAN NAPZA<br>
        Nomor : R / {{ $nomor_surat }} / {{ $bulan_romawi }} / {{ $tanggal_surat->format('Y') }} / Urikkes
    </div>
    <br>
    <table width="100%" class="noBorder">
        <tr>
            <td>Yang bertanda tangan di bawah ini :</td>
        </tr>
    </table>
    <br>
    <table width="100%" class="noBorder">
        <tr>
            <td width="30%">Nama</td>
            <td width="70%">: {{ $nama_ttd }}</td>
        </tr>
        <tr>
            <td>No. SIPDS</td>
            <td>: {{ $sipds_ttd }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>: {{ $jabatan_ttd }}</td>
        </tr>
        <tr>
            <td>Instansi</td>
            <td>: {{ $instansi_ttd }}</td>
        </tr>
    </table>
    <br>
    <table width="100%" class="noBorder">
        <tr>
            <td>Atas permintaan tertulis dari :</td>
        </tr>
    </table>
    <br>
    <table width="100%" class="noBorder">
        <tr>
            <td width="30%">Nama</td>
            <td width="70%">: {{ $nama_peminta }}</td>
        </tr>
        <tr>
            <td>No. SIPDS</td>
            <td>: {{ $sipds_peminta }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>: {{ $jabatan_peminta }}</td>
        </tr>
        <tr>
            <td>Instansi</td>
            <td>: {{ $instansi_peminta }}</td>
        </tr>
        <tr>
            <td>Perihal Permintaan</td>
            <td>: {{ $perihal }}</td>
        </tr>
    </table>
    <br>
    <table width="100%" class="noBorder">
        <tr>
            <td>Telah melakukan pemeriksaan psikiatrik pada tanggal {{ $tgl_periksa }} terhadap :</td>
        </tr>
    </table>
    <br>
    <table width="100%" class="noBorder">
        <tr>
            <td width="30%">Nama</td>
            <td width="70%">: {{ $identitas->nama }}</td>
        </tr>
        <tr>
            <td>Tempat/ Tanggal Lahir</td>
            <td>: {{ $identitas->tempat_lahir }} / {{ $tgl_lahir }}</td>
        </tr>
        <tr>
            <td>Pendidikan</td>
            <td>: {{ $pasien->pendidikan->nama }}</td>
        </tr>
        <tr>
            <td>Status Pernikahan</td>
            <td>:@if ($pasien->marriage == 2)
                    Menikah
                @elseif($pasien->marriage == 3)
                    Duda/Janda
                @else
                    Single
                @endif
            </td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>: {{ $pasien->agama->nama }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $pasien->address }}</td>
        </tr>
    </table>
    <br>
    <table width="100%" class="noBorder">
        <tr>
            <td>Dengan berdasarkan pemeriksaan :</td>
        </tr>
    </table>
    <br>
    <table width="100%" class="noBorder">
        <tr>
            <td width="5%">-</td>
            <td width="25%">Fisik Diagnostik</td>
            <td width="2%">:</td>
            <td width="68%">Pada tanggal {{ $tgl_fisik }}, jam {{ $jam_fisik }} WIB</td>
        </tr>
        <tr>
            <td width="5%">-</td>
            <td width="25%">Psikiatrik</td>
            <td width="2%">:</td>
            <td width="68%">Pada tanggal {{ $tgl_psikiatrik }}, jam {{ $jam_psikiatrik }} WIB</td>
        </tr>
        <tr>
            <td width="5%">-</td>
            <td width="25%">Pemeriksaan tambahan</td>
            <td width="2%">:</td>
            <td width="68%">Pada tanggal {{ $tgl_tambahan }}, jam {{ $jam_tambahan }} WIB</td>
        </tr>
    </table>
    <br>
    <div style="padding-right: 50px">
        Menunjukkan tidak ada gejala-gejala penggunaan narkoba/ zat psikoaktif.<br>
        Hasil Laboratorium Urine terlampir.<br>
        Surat keterangan Pemeriksaan Napza ini digunakan untuk keperluan <span
            style="font-weight: 700">{{ $keperluan }}</span>
    </div>
    <br>
    <table width="100%" class="noBorder">
        <tr>
            <td width="35%">&nbsp;</td>
            <td width="50%" class="centered">Surabaya, {{ $tanggal_surat_format_ind }}</td>
        </tr>
        <tr>
            <td width="35%">&nbsp;</td>
            <td width="50%" class="centered">Dokter yang memeriksa,</td>
        </tr>
    </table>
    <br><br><br>
    <table width="100%" class="noBorder">
        <tr>
            <td width="35%">&nbsp;</td>
            <td width="50%" class="centered">{{ $nama_ttd }}</td>
        </tr>
        <tr>
            <td width="35%">&nbsp;</td>
            <td width="50%" class="centered">
                <div style="white-space: pre"> {!! nl2br($keterangan_ttd) !!}</div>
            </td>
        </tr>
    </table>
</body>

</html>
