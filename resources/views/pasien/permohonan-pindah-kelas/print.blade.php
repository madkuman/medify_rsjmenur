@extends('layouts.print')

@section('title')
{{$identitas->name}} - Surat Permohonan Pindah Kelas
@endsection

@section('css')
<style type="text/css">
    body, p {
        font-size: 13px;
        font-family: Arial, Helvetica, sans-serif;
        line-height: 16px;
    }
    table.bordered {
      border-collapse: collapse;
  }
  table.bordered, .bordered th, .bordered td {
      border: 1px solid black;
  }
  .border{
    border: 1px solid black;
}
</style>
@endsection

@section('content')
<table width="100%">
    <tr>
        <td width="90%"></td>
        <td width="10%" class="border" align="center">RM. 24.K1</td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="55%" valign="top">
            <table width="100%" cellpadding="5">
             <tr>
                <td width="15%" align="left">
                    <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="50">
                </td>
                <td width="63%" align="center">
                    <p style="font-size: 10px;">PEMERINTAH PROVINSI JAWA TIMUR <br>
                        <b>RUMAH SAKIT JIWA MENUR</b> <br>
                        Jln. Menur No. 120, Telp. (031) 5021635, 5021637 <br>
                        <b>SURABAYA</b>
                    </p>
                </td>
                <td width="17%" align="left">
                    <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="50">
                </td>
            </tr> 
        </table>
    </td>
    <td width="45%">
        <div style="border: 1px solid #000;">
            <table width="100%" cellpadding="5">
                <tr>
                    <td>No. RM</td>
                    <td>: {{ $identitas->no_rm }}</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>
                        : {{ $identitas->name }} <b>(@if ($identitas->gender == 1) Laki laki @else Perempuan @endif)</b>
                    </td>
                </tr>
                <tr>
                    <td>Tgl Lahir/Umur</td>
                    <td>: {{ date("d/m/Y", strtotime($identitas->date_of_birth)) }} / {{$identitas->age}} Tahun</td>
                </tr>
            </table>
        </div>
    </td>
</tr>
</table>

<table width="100%" style="margin: 20px">
    <tr>
        <td align="center">
            <h3>SURAT PERMOHONAN PINDAH KELAS</h3>
        </td>
    </tr>
</table>

<div style="border: 1px solid black; padding: 5px;">
    <table width="100%" style="margin-bottom: 15px; border-bottom: 2px solid black">
        <tr>
            <td><i><b>Disampaikan Oleh Petugas Ruang Rawat Inap</b></i></td>
        </tr>
    </table>

    <p>Yang bertanda tangan di bawah ini :</p>

    <table width="100%" cellpadding="5">
        <tr>
            <td width="28%">Nama</td>
            <td width="2%">:</td>
            <td width="70%">{{ $surat->nama_wali ?? "-" }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $surat->alamat ?? "-" }}</td>
        </tr>
        <tr>
            <td>No. Telepon</td>
            <td>:</td>
            <td>{{ $surat->no_telp ?? "-" }}</td>
        </tr>
        <tr>
            <td>Hubungan dengan Pasien</td>
            <td>:</td>
            <td>{{ $surat->hubungan ?? "-" }}</td>
        </tr>
        <tr>
            <td colspan="3">Dengan ini kami sebagai penanggung jawab / pengampu pasien mohon supaya pasien tersebut dipindahkan perawatannya dari kelas <b>{{ $surat->awalKelas->nama ?? "-" }}</b> ke kelas <b>{{ $surat->tujuanKelas->nama ?? "-" }}</b> dengan pasien :</td>
        </tr>
        <tr>
            <td>No. RM</td>
            <td>:</td>
            <td> {{ $identitas->no_rm }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td> {{ $identitas->name }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>@if ($identitas->gender == 1) Laki laki @else Perempuan @endif</td>
        </tr>
        <tr>
            <td>Tanggal Lahir / Umur</td>
            <td>:</td>
            <td> {{ date("d/m/Y", strtotime($identitas->date_of_birth)) }} / {{$identitas->age}} Tahun</td>
        </tr>
        <tr>
            <td>Ruangan</td>
            <td>:</td>
            <td>{{$surat->ruangan}}</td>
        </tr>
        <tr>
            <td colspan="3">Demikian surat pernyataan ini harap menjadikan periksa adanya</td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 20px;">
        <tr>
            <td width="67%%"></td>
            <td width="33%%" align="center">Surabaya, {{ !is_null($surat->created_at) ? indonesian_date($surat->created_at) : '_____________' }}</td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td width="33%" align="center">Perawat Ruangan</td>
            <td width="33%" align="center">Saksi Keluarga / Petugas</td>
            <td width="33%" align="center">Yang membuat pernyataan</td>
        </tr>
        <tr>
            <td colspan="3"><br><br><br></td>
        </tr>
        <tr>
            <td align="center">(............................................)</td>
            <td align="center">(............................................)</td>
            <td align="center">({{ $surat->nama_wali ?? "............................................" }})</td>
        </tr>
    </table>
</div>

@endsection