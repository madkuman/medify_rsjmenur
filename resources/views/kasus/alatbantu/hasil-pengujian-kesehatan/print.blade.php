@extends('layouts.print')

@section('title')
{{ $kasus->judul_kasus }} - Print Hasil Pengujian Kesehatan
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
            <h2 style="text-align: center; padding-top: 2px"><u>HASIL PENGUJIAN KESEHATAN</u></h2>
            <h2 style="text-align: center">No : 812 / {{ $form_data->nomor }} / 4 / 102.8 / {{ date('Y') }}</h2>
        </td>
    </tr>
</table>
<br>
<div>
    <p>Tim Penguji Kesehatan Pegawai Negeri Sipil di RS Jiwa Menur Provinsi Jawa Timur yang ditetapkan berdasarkan
        Keputusan Menteri Kesehatan Republik Indonesia Nomor HK.01.07/MENKES/119/2025 tanggal 24 Februari 2025,
        menerangkan bahwa:</p>
    <table style="padding-left: 50px;">
        <tr>
            <td style="width:110px">
                <p>Nama</p>
            </td>
            <td style="width:10px">
                <p>: </p>
            </td>
            <td>
                @if (!empty($form_data->dpjp) && ($dpjp = app\User::find($form_data->dpjp)))
                <p>{{ $dpjp->name }}</p>
                @endif
            </td>
        </tr>
        <tr>
            <td style="width:110px">
                <p>NIP</p>
            </td>
            <td style="width:10px">
                <p>: </p>
            </td>
            <td>
                <p>{{ $form_data->nip }}</p>
            </td>
        </tr>
        <tr>
            <td style="width:110px">
                <p>Golongan Ruang</p>
            </td>
            <td style="width:10px">
                <p>: </p>
            </td>
            <td>
                <p>{{ $form_data->nip }}</p>
            </td>
        </tr>
        <tr>
            <td style="width:110px">
                <p>Pekerjaan</p>
            </td>
            <td style="width:10px">
                <p>: </p>
            </td>
            <td>
                <p>{{ $form_data->nip }}</p>
            </td>
        </tr>
        <tr>
            <td style="width:110px">
                <p>Alamat</p>
            </td>
            <td style="width:10px">
                <p>: </p>
            </td>
            <td>
                <p>{{ $form_data->nip }}</p>
            </td>
        </tr>
    </table>
    <br>
    <p>Telah diperiksa dengan teliti pada tanggal 9 April 2025 dan berpendapat bahwa yang diperiksa :</p>
    <table style="padding-left: 50px;">
        <tr>
            <td style="width:110px">
                <p>Nama</p>
            </td>
            <td style="width:10px">
                <p>: </p>
            </td>
            <td>
                <p>{{ ucwords(strtolower($kasus->pasien->name)) }}</p>
            </td>
        </tr>
        <tr>
            <td style="width:110px">
                <p>Jenis Kelamin</p>
            </td>
            <td style="width:10px">
                <p>: </p>
            </td>
            <td>
                <p>{{ $kasus->pasien->jenis_kelamin }}</p>
            </td>
        </tr>
        <tr>
            <td style="width:110px">
                <p>Tanggal Lahir</p>
            </td>
            <td style="width:10px">
                <p>: </p>
            </td>
            <td>
                <p>{{ indonesian_date($kasus->pasien->date_of_birth) }}</p>
            </td>
        </tr>
        <tr>
            <td style="width:110px">
                <p>Alamat</p>
            </td>
            <td style="width:10px">
                <p>: </p>
            </td>
            <td>
                <p>{{ $form_data->alamat }}</p>
                {{-- <p>{{ ucwords(strtolower($kasus->pasien->address)) }}, Kel.
                    {{ ucwords(strtolower($kasus->pasien->alamat_kelurahan->nama)) }}, Kec.
                    {{ ucwords(strtolower($kasus->pasien->alamat_kecamatan->nama)) }},
                    {{ ucwords(strtolower($kasus->pasien->alamat_kota->nama)) }}</p> --}}
            </td>
        </tr>
        <tr>
            <td style="width:110px">
                <p>Pendidikan</p>
            </td>
            <td style="width:10px">
                <p>: </p>
            </td>
            <td>
                <p>{{ $form_data->pendidikan }}</p>
            </td>
        </tr>
    </table>
    <br>
    <p>Pada pemeriksaan fisik tanggal {{ indonesian_date($form_data->tanggal_pemeriksaan) }} tidak ditemukan kelainan
        serta tidak buta
        warna dengan hasil
        sebagai berikut:</p>
    <table style="padding-left: 50px;">
        <tr>
            <td style="width:110px">
                <p>Tensi</p>
            </td>
            <td style="width:10px">
                <p>: </p>
            </td>
            <td>
                <p>{{ $form_data->tensi }} mmHg</p>
            </td>
        </tr>
        <tr>
            <td style="width:110px">
                <p>Berat Badan</p>
            </td>
            <td style="width:10px">
                <p>: </p>
            </td>
            <td>
                <p>{{ $form_data->berat_badan }} Kg</p>
            </td>
        </tr>
        <tr>
            <td style="width:110px">
                <p>Tinggi Badan</p>
            </td>
            <td style="width:10px">
                <p>: </p>
            </td>
            <td>
                <p>{{ $form_data->tinggi_badan }} cm</p>
            </td>
        </tr>
        <tr>
            <td style="width:110px">
                <p>Visus</p>
            </td>
            <td style="width:10px">
                <p>: </p>
            </td>
            <td>
                <p>{{ $form_data->visus }}</p>
            </td>
        </tr>
    </table>
    <br>
    <p>Yang bersangkutan dinyatakan:</p>
    <div class="subheader">
        <b>SEHAT FISIK</b>
    </div>
    <br>
    <p>Demikian Hasil Pengujian Kesehatan yang telah dilakukan oleh Tim Penguji Kesehatan Rumah Sakit Jiwa Menur
        Provinsi Jawa Timur yang digunakan untuk persyaratan <b>{{ $form_data->syarat }}</b>.</p>
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
                <p>Ketua Tim Penguji Kesehatan <br> RS Jiwa Menur Provinsi Jawa Timur</p>
            </td>
        </tr>
        <tr>
            <td><br><br><br><br><br></td>
        </tr>
        <tr>
            <td>
                @if (!empty($form_data->dpjp) && ($dpjp = app\User::find($form_data->dpjp)))
                <p><u>{{ $dpjp->name }}</u></p>
                @endif
            </td>
        </tr>
        <tr>
            <td>
                <p>NIP. {{ $form_data->nip }}</p>
            </td>
        </tr>
    </table>
</div>
@endsection