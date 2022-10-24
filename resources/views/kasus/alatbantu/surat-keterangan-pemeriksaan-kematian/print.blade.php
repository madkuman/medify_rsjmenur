@extends('layouts.print')

@section('title')
Print Surat Keterangan Pemeriksaan Kematian
@endsection

@section('css')
<style type="text/css">
    body, p {
        font-size: 12px;
        font-family: sans-serif, Arial, Helvetica;
        /*line-height: 16px;*/
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
                <td><p style="font-size: 18px;"><b>RM. 34</b></p></td>
            </tr>
        </table>
    </header>

    <table width="90%" align="center">
        <tr>
            <td width="100%" valign="top">
                <table width="100%" cellpadding="5">
                   <tr>
                        <td width="15%" align="left">
                            <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="80">
                        </td>
                        <td width="63%" align="center">
                            <p style="font-size: 18px;"><b>PEMERINTAH PROVINSI JAWA TIMUR</b></p>
                            <p style="font-size: 22px;"><b>RUMAH SAKIT JIWA MENUR</b></p>
                            <p style="font-size: 14px;"><b>Jln. Menur No. 120, Telp. (031) 5021635, 5021637</b></p>
                            <p style="font-size: 18px;"><b>S U R A B A Y A</b></p>
                        </td>
                        <td width="17%" align="left">
                            <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="80">
                        </td>
                   </tr> 
                </table>
                <hr>
            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td align="center">
                <h4><b>SURAT KETERANGAN PEMERIKSAAN KEMATIAN (FORM : A)</b></h4>
            </td>
        </tr>
    </table>

    <table width="80%" align="center">
        <tr>
            <td>
                <p style="line-height : 2;">
                Yang bertanda tangan dibawah ini Dokter {{ $surat_keterangan_pemeriksaan_kematian->dokter_yang_memeriksa ?? '___________________' }} <br> 
                Atas sumpah atau janji waktu menerima jabatan, menyatakan bahwa pada hari ini, Hari {{ $surat_keterangan_pemeriksaan_kematian->dokter_yang_memeriksa ?? '___________________' }} Tanggal {{ $surat_keterangan_pemeriksaan_kematian->tanggal ? date('d F Y', strtotime($surat_keterangan_pemeriksaan_kematian->tanggal)) : '___________________' }} Pukul {{ $surat_keterangan_pemeriksaan_kematian->pukul ?? '___________________' }} telah memeriksa Jenazah : {{ $kasus->identitas->nama ?? '___________________' }} Jenis {{ $kasus->identitas->jenis_kelamin ?? '___________________' }} Umur {{ $kasus->identitas->umur ?? '___________________' }} Tahun Agama {{ $kasus->pasien->agama->nama ?? '___________________' }} <br> di Rumah Sakit Jiwa Menur Surabaya
                </p>
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 20px;">
        <tr>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="25%">Surabaya, {{ $surat_keterangan_pemeriksaan_kematian->created_at ? date('d F Y', strtotime($surat_keterangan_pemeriksaan_kematian->created_at))  : '___________________' }}</td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td align="center"></td>
            <td align="center">Dokter yang memeriksa</td>
        </tr>
        <tr>
            <td colspan="2"><br><br><br><br></td>
        </tr>
        <tr>
            <td align="center">*(Untuk dibawa Keluarga)</td>
            <td align="center">(______________________)</td>
        </tr>
    </table>
    <br><br><br>
    <hr style="margin-top: 35px; margin-bottom: 35px;">

    <header>
        <table class="" align="right">
            <tr>
                <td><p style="font-size: 18px;"><b>RM. 34</b></p></td>
            </tr>
        </table>
    </header>

    <table width="90%" align="center">
        <tr>
            <td width="100%" valign="top">
                <table width="100%" cellpadding="5">
                   <tr>
                        <td width="15%" align="left">
                            <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="80">
                        </td>
                        <td width="63%" align="center">
                            <p style="font-size: 18px;"><b>PEMERINTAH PROVINSI JAWA TIMUR</b></p>
                            <p style="font-size: 22px;"><b>RUMAH SAKIT JIWA MENUR</b></p>
                            <p style="font-size: 14px;"><b>Jln. Menur No. 120, Telp. (031) 5021635, 5021637</b></p>
                            <p style="font-size: 18px;"><b>S U R A B A Y A</b></p>
                        </td>
                        <td width="17%" align="left">
                            <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="80">
                        </td>
                   </tr> 
                </table>
                <hr>
            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td align="center">
                <h4><b>SURAT KETERANGAN PEMERIKSAAN KEMATIAN (FORM : B)</b></h4>
            </td>
        </tr>
    </table>

    <table width="80%" align="center">
        <tr>
            <td>
                <p style="line-height : 2;">
                Tempat kematian Rumah Sakit Jiwa Menur Surabaya <br> Pelaporan kematian tanggal {{ $surat_keterangan_pemeriksaan_kematian->tanggal ? date('d F Y', strtotime($surat_keterangan_pemeriksaan_kematian->tanggal)) : '___________________' }} <br> 
                Pukul {{ $surat_keterangan_pemeriksaan_kematian->pukul ?? '___________________' }} Nama Jenazah : {{ $kasus->identitas->nama ?? '___________________' }} Jenis Kelamin {{ $kasus->identitas->jenis_kelamin ?? '___________________' }} Umur {{ $kasus->identitas->umur ?? '___________________' }} Tahun Agama {{ $kasus->pasien->agama->nama ?? '___________________' }} Alamat {{ $kasus->identitas->alamat ?? '___________________' }} <br>
                Prasangka kematian {{ $surat_keterangan_pemeriksaan_kematian->persangkaan_kematian ?? '___________________' }}
                </p>

            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 20px;">
        <tr>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="25%"></td>
            <td width="25%">Surabaya, {{ $surat_keterangan_pemeriksaan_kematian->created_at ? date('d F Y', strtotime($surat_keterangan_pemeriksaan_kematian->created_at))  : '___________________' }}</td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td align="center"></td>
            <td align="center">Dokter yang memeriksa</td>
        </tr>
        <tr>
            <td colspan="2"><br><br><br><br></td>
        </tr>
        <tr>
            <td align="center">*(Untuk Pelaporan)</td>
            <td align="center">({{ $surat_keterangan_pemeriksaan_kematian->dokter_yang_memeriksa ?? '___________________' }})</td>
        </tr>
    </table>

@endsection