@extends('layouts.print')

@section('title')
    {{ $kasus->judul_kasus }} - Print Surat Keterangan Sehat Jiwa
@endsection

@section('css')
    <style>
        body {
            font-size: 12px;
            margin-left: 10px;
        }

        td {
            vertical-align: top;
            padding: 1px;
            font-size: 12px;
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
            text-align: center;
            font-size: 16px;
        }

        .footer {
            margin-top: 50px;
            margin-left: 380px;
        }
    </style>
@endsection

@section('content')
    <table width="100%">
        <tr>
            <td width="100%"><img src="{{ config('app.kop_lg') }}" height="165"></td>
        </tr>
        <hr>
    </table>
    <br>
    <table style="width:100%">
        <tr>
            <td>
                <h2 style="text-align: center; padding-top: 2px"><u>SURAT KETERANGAN SEHAT JIWA</u></h2>
                <h2 style="text-align: center">NOMOR : {{ $form_data->nomor }}</h2>
            </td>
        </tr>
    </table>
    <br>
    <div>
        <p>Yang bertanda tangan dibawah ini:</p>
        <table style="padding-left: 50px;">
            <tr>
                <td style="padding-right: 133px">
                    <p>Nama</p>
                </td>
                <td>
                    <p>: {{ $form_data->dpjp }}</p>
                </td>
            </tr>
            <tr>
                <td style="padding-right:80px">
                    <p>SIP</p>
                </td>
                <td>
                    <p>: {{ $form_data->sip }}</p>
                </td>
            </tr>
            <tr>
                <td style="padding-right:80px">
                    <p>NIP</p>
                </td>
                <td>
                    <p>: {{ $form_data->nip }}</p>
                </td>
            </tr>
        </table>
        <br>
        <p>Menerangkan dengan sebenarnya bahwa :</p>
        <table style="padding-left: 50px;">
            <tr>
                <td style="padding-right:80px">
                    <p>Nama</p>
                </td>
                <td>
                    <p>: {{ $kasus->pasien->name }}</p>
                </td>
            </tr>
            <tr>
                <td style="padding-right:80px">
                    <p>Jenis Kelamin</p>
                </td>
                <td>
                    <p>: {{ $kasus->pasien->jenis_kelamin }}</p>
                </td>
            </tr>
            <tr>
                <td style="padding-right:80px">
                    <p>Tanggal Lahir</p>
                </td>
                <td>
                    <p>: {{ indonesian_date($kasus->pasien->date_of_birth) }}</p>
                </td>
            </tr>
            <tr>
                <td style="padding-right:80px">
                    <p>Alamat</p>
                </td>
                <td>
                    <p>: {{ $kasus->pasien->address }}</p>
                </td>
            </tr>
            <tr>
                <td style="padding-right:80px">
                    <p>Pendidikan</p>
                </td>
                <td>
                    <p>: {{ $form_data->pendidikan }}</p>
                </td>
            </tr>
        </table>
        <br>
        <p>Setelah dilakukan wawancara psikiatrik, pemeriksaan psikiatrik dan psikotest, disimpulkan saat ini yang
            bersangkutan dinyatakan: </p>
        <br>
        <div class="subheader">
            <b>SEHAT JIWA</b>
        </div>
        <br>
        <p>Surat keterangan ini dibuat sebagai <b>{{ $form_data->syarat }}</b>.</p>
    </div>
    <div class="footer">
        <table style="text-align: center">
            <tr>
                <td>
                    <p>Surabaya, {{ indonesian_date($form_data->tanggal_pemeriksaan) }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Dokter yang memeriksa,</p>
                </td>
            </tr>
            <tr>
                <td><br><br><br><br><br></td>
            </tr>
            <tr>
                <td>
                    <p>{{ $form_data->dpjp }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>SIP. {{ $form_data->sip }}</p>
                </td>
            </tr>
        </table>
    </div>
@endsection
