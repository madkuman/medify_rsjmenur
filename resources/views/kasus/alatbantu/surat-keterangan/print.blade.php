@extends('layouts.print')

@section('title')
Surat Keterangan Istirahat / Dirawat / Sakit - {{$kasus->identitas->nama}}
@endsection

@section('css')
<style type="text/css">
    body, p {
        font-size: 14px;
        font-family: Arial, Helvetica, sans-serif;
        /*line-height: 26px;*/
    }
    table.bordered {
      border-collapse: collapse;
    }
    table.bordered, .bordered th, .bordered td {
      border: 1px solid black;
    }
</style>
@endsection

@section('content')
    <header>
        <table class="" align="right">
            <tr>
                <td><p style="font-size: 18px;"><b>RM. 33</b></p></td>
            </tr>
        </table>
    </header>

    <table width="80%" align="center">
        <tr>
            <td width="100%" valign="top">
                <table width="100%" cellpadding="5">
                   <tr>
                        <td width="15%" align="left">
                            <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="120">
                        </td>
                        <td width="63%" align="center">
                            <p style="font-size: 20px;"><b>PEMERINTAH PROVINSI JAWA TIMUR</b></p>
                            <p style="font-size: 36px;"><b>RUMAH SAKIT JIWA MENUR</b></p>
                            <p style="font-size: 16px;"><b>Jln. Menur No. 120, Telp. (031) 5021635, 5021637</b></p>
                            <p style="font-size: 20px;"><b>S U R A B A Y A</b></p>
                        </td>
                        <td width="17%" align="left">
                            <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="120">
                        </td>
                   </tr> 
                </table>
                <hr style="border: 3px double black">
            </td>
        </tr>
    </table>

    <table width="80%" align="center">
        <tr>
            <td align="center">
                <h2><u>SURAT KETERANGAN</u></h2>
            </td>
        </tr>
    </table>
    <br>
    <table width="80%" align="center">
        <tr>
            <td style="padding-left: 50px;">
                <p>Yang bertanda tangan dibawah ini dokter {{ $val->dokter_merawat ?? '...............................' }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>dokter Pemerintah pada Rumah Sakit Jiwa Menur Provinsi Jawa Timur Menerangkan :</p>
            </td>
        </tr>
    </table>
    <br>
    <table width="80%" align="center" style="padding-left: 50px;">
        <tr>
            <td width="15%">Nomor RM</td>
            <td width="2%">:</td>
            <td width="83%">{{ $kasus->pasien->no_rm ?? '...............................' }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $kasus->identitas->nama ?? '...............................' }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $kasus->identitas->jenis_kelamin == 'L' ? 'Laki' : $kasus->identitas->jenis_kelamin == 'P' ? 'Perempuan' : '...............................' }}</td>
        </tr>
        <tr>
            <td>Umur</td>
            <td>:</td>
            <td>{{ $kasus->identitas->umur ?? '...............................' }} Tahun</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $kasus->identitas->alamat ?? '...............................' }}</td>
        </tr>
    </table>

    <table width="80%" align="center">
        <tr>
            <td><p>Setelah kami periksa yang bersangkutan dinyatakan sakit sehingga :</p></td>
        </tr>
    </table>
    <table width="80%" align="center" style="padding-left: 50px;">
        @php $i=1; @endphp
        @if(isset($val->mulai_rawat_inap))
        <tr>
            <td>{{$i++}}.</td>
            <td>
                Memerlukan rawat inap di Rumah Sakit Jiwa Menur Provinsi Jawa Timur dari tanggal : {{ $val->mulai_rawat_inap ?? '...............................' }} s/d {{ $val->selesai_rawat_inap ?? '...............................' }}
            </td>
        </tr>
        @endif
        @if(isset($val->mulai_rawat_jalan))
        <tr>
            <td>{{$i++}}.</td>
            <td>
                Memerlukan rawat jalan dari tanggal {{ $val->mulai_rawat_jalan ?? '...............................' }} s/d {{ $val->selesai_rawat_jalan ?? '...............................' }}
            </td>
        </tr>
        @endif
        @if(isset($val->mulai_istirahat))
        <tr>
            <td>{{$i++}}.</td>
            <td>
                Memerlukan istirahat selama {{ $val->mulai_istirahat ?? '...............................' }} s/d {{ $val->selesai_istirahat ?? '...............................' }}            
            </td>
        </tr>
        @endif
    </table>
    <table width="80%" align="center">
        <tr>
            <td>
                <p>Surat ini diperlukan untuk {{ $val->keperluan_surat ?? '...............................' }}</p>
            </td>
        </tr>
        <tr>
            <td><p>Demikian untuk menjadikan maklum</p></td>
        </tr>
    </table>

    <table width="80%" align="center" style="margin-top: 20px;">
        <tr>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="25%">Surabaya, {{ indonesian_date($surat_keterangan->created_at) }}</td>
        </tr>
        <tr>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="25%"><p style="margin-bottom: 20px;">Dokter yang merawat</p></td>
        </tr>
        <tr>
            <td colspan="4"><br><br></td>
        </tr>
        <tr>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="25%">{{ $val->dokter_merawat ?? '...............................' }}</td>
        </tr>
        <tr>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="25%">NIP. {{$nip}}</td>
        </tr>
    </table>

@endsection