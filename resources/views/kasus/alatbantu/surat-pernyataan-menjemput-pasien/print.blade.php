@extends('layouts.print')

@section('title')
    {{ $kasus->judul_kasus }} - Print Surat Pernyataan Menjemput Pasien
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
                <h2 style="text-align: center; padding-top: 2px"><u>SURAT PERNYATAAN MENJEMPUT PASIEN</u></h2>
            </td>
        </tr>
    </table>
    <br>
    <div>
        <p style="padding-left: 25px;">IDENTITAS PASIEN</p>
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
                    <p>{{ ucwords(strtolower($kasus->pasien->address)) }}</p>
                </td>
            </tr>
            <tr>
                <td style="width:110px">
                    <p>NIK</p>
                </td>
                <td style="width:10px">
                    <p>: </p>
                </td>
                <td>
                    <p>{{ $kasus->pasien->no_identitas ?? '--' }}</p>
                </td>
            </tr>
        </table>
        <br>
        <p style="padding-left: 25px;">Kami yang bertanda-tangan di bawah ini:</p>
        <table style="padding-left: 50px;">
            <tr>
                <td style="width:110px">
                    <p>Nama</p>
                </td>
                <td style="width:10px">
                    <p>: </p>
                </td>
                <td>
                  <p>{{ $form_data->nama }}</p> 
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
                   <p>{{ indonesian_date($form_data->tanggal_lahir) }}</p> 
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
                </td>
            </tr>
            <tr>
                <td style="width:110px">
                    <p>No.Telp</p>
                </td>
                <td style="width:10px">
                    <p>: </p>
                </td>
                <td>
                   <p>{{ $form_data->no_telepon }},     (<i>Nomor yang dapat dihubungi</i>)</p> 
                </td>
            </tr>
            <tr>
                <td style="width:110px">
                    <p>Hubungan</p>
                </td>
                <td style="width:10px">
                    <p>: </p>
                </td>
                <td>
                 <p>{{ $form_data->hubungan }}</p> 
                </td>
            </tr>
            {{--  <tr>
                <td style="width:110px">
                    <p>Heart Rate</p>
                </td>
                <td style="width:10px">
                    <p>: </p>
                </td>
                <td>
                    <p>{{ $form_data->heart_rate }} x/menit</p>
                </td>
            </tr>
            <tr>
                <td style="width:110px">
                    <p>Bacaan EKG</p>
                </td>
                <td style="width:10px">
                    <p>: </p>
                </td>
                <td>
                    <p>{{ $form_data->bacaan_ekg }} </p>
                </td>
            </tr>  --}}
            
        </table>
        <br>
        <div class="subheader">
           <b> MENYATAKAN BAHWA</b>
        </div>
        <table style="padding-left: 50px;">
            <tr>
                <td style="width:10px">
                    <p>1</p>
                </td>
                <td style="width:10px">
                    <p>.</p>
                </td>
                <td>
                    <p>Data alamat tempat tinggal dan nomor telepon adalah data yang benar dan bisa dihubungi;</p>
                </td>
            </tr>
            <tr>
                <td style="width:10px">
                    <p>2</p>
                </td>
                <td style="width:10px">
                    <p>.</p>
                </td>
                <td>
                    <p>Bersedia menjemput pasien apabila telah diperbolehkan pulang oleh Dokter Penanggung Jawab Pasien;</p>
                </td>
            </tr>
            <tr>
                <td style="width:10px">
                    <p>3</p>
                </td>
                <td style="width:10px">
                    <p>.</p>
                </td>
                <td>
                    <p>Bersedia menanggung biaya dropping pasien apabila tidak menjemput pasien setelah ada pemberitahuan via telepon sebanyak 3x(3 hari) dan pemberitahuan via surat tercatat sebanyak 1kali;</p>
                </td>
            </tr>
        </table>


    </div>
    <div class="footer">
        <table style="text-align: center">
            <tr>
                <td>
                    <p>Surabaya,</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Keluarga Pasien</p>
                </td>
            </tr>
            <tr>
                <td><br><br><br><br></td>
            </tr>
            <tr>
                <td>
                        <p>({{ $form_data->nama }})</p>
                </td>
            </tr>

        </table>
    </div>
@endsection
