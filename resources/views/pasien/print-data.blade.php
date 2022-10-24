@extends('layouts.print')

@section('title')
Print Identitas - {{$identitas->name}}
@endsection

@section('css')
<style type="text/css">
    body, p {
        font-size: 12px;
        font-family: sans-serif;
    }
    table.bordered {
        border-collapse: collapse;
    }
    table.bordered, .bordered th, .bordered td {
        border: 1px solid black;
    }
    .section {
        padding: 5px;
        margin-bottom: 15px;
        border: 1px solid #000;
    }
    .cbx::after{
        content: "4";
        line-height: 0.6;
        z-index: 100;
        font-family: ZapfDingbats, sans-serif;
    }
    .cb{
        border: 1px solid black;
        display: inline-block;
        width: 7px;
        height: 7px;
    }
    .invis{
        color: white;
        padding-left: 150px; 
    }
    .ml-20{
        margin-left: 20px;
    }
</style>
@endsection

@section('content')
<table class="" width="100%">
    <tr>
        <td width="50%" valign="top">
            <div style="border: 1px solid #000;">
                <table width="100%" cellpadding="5">
                    <tr>
                        <td width="15%" align="left">
                            <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="50">
                        </td>
                        <td width="63%" align="center">
                            <p style="font-size: 10px;">PEMERINTAH PROVINSI JAWA TIMUR <br>
                                RUMAH SAKIT JIWA MENUR <br>
                                Jln. Menur No. 120, Telp. (031) 5021635, 5021637 <br>
                                S U R A B A Y A
                            </p>
                        </td>
                        <td width="17%" align="left">
                            <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="50">
                        </td>
                    </tr> 
                </table>
            </div>
            <div style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px; border: 3px solid #000; text-align: center; margin-top: 20px;"><b>FORMULIR IDENTITAS</b></div>
        </td>
        <td width="25%" align="center">
            @if(!is_null($identitas->photo_ori) && $identitas->photo_ori != 'assets/img/placeholder.jpg')
            <img src="{{ asset($identitas->photo_ori) }}" width="140" height="140" class="ml-20">
            @else
            <div style="width: 50%; padding-left: 20px; padding-right: 20px; padding-top: 60px; padding-bottom: 60px; margin-left: 20px; border: 1px solid #000;">
                FOTO PASIEN
            </div>
            @endif
        </td>
        <td width="25%" valign="top">
            <table class="bordered" style="border-collapse: collapse;" cellpadding="5" align="right" width="110%">
                <tr>
                    <td>No. RM : {{ $identitas->no_rm }}</td>
                </tr>
                <tr>
                    <td>Halaman 1/1</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table width="100%" class="bordered" cellpadding="5" style="margin-top: 10px;">
    <tr>
        <th align="center" colspan="2">DATA PASIEN</th>
    </tr>
    <tr>
        <td width="30%">Nama</td>
        <td width="70%">{{strtoupper($identitas->name)}}</td>
    </tr>
    <tr>
        <td>No. KTP</td>
        <td>{{strtoupper($identitas->no_identitas)}}</td>
    </tr>
    <tr>
        <td>Tempat, Tanggal Lahir / Usia</td>
        <td>{{strtoupper($identitas->place_of_birth)}}, {{Date::parse($identitas->date_of_birth)->format('d F Y')}} / {{strtoupper($identitas->detailed_long_age)}}</td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>{{$identitas->gender == '1' ? 'LAKI-LAKI' : 'PEREMPUAN'}}</td>
    </tr>
    <tr>
        <td>Alamat Domisili</td>
        <td>{{strtoupper($identitas->address_domisili)}},</td>
    </tr>
    <tr>

        <td>Alamat KTP</td>
        <td>
            {{strtoupper($identitas->address)}}, 
            @if(!empty($identitas->alamat_kecamatan))
            {{$identitas->alamat_kelurahan->nama or '-'}}, {{$identitas->alamat_kecamatan->nama or '-'}}, {{$identitas->alamat_kota->nama or '-'}}, {{$identitas->alamat_kota->provinsi->nama or '-'}}
            @endif
        </td>
    </tr>
    <tr>
        <td>No. Telepon</td>
        <td>{{strtoupper($identitas->phone)}}</td>
    </tr>
</table>
<table width="100%" class="bordered" cellpadding="5">
    <tr>
        <th align="center" colspan="2">DATA PENANGGUNG JAWAB</th>
    </tr>
    <tr>
        <td width="30%">Nama</td>
        <td width="70%">{{strtoupper($identitas->wali->name ?? '-')}}</td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td> 
            @php 
            $wali_gender = $identitas->wali->gender ?? 0;
            @endphp
            @if($wali_gender == 1) LAKI-LAKI
            @elseif($wali_gender == 2 ) PEREMPUAN
            @else -
            @endif
        </td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td> 
            {{strtoupper($identitas->wali->address ?? '-')}}, 
            @if(!empty($identitas->wali->alamat_kecamatan))
            {{$identitas->wali->alamat_kelurahan->nama ?? '-'}}, {{$identitas->wali->alamat_kecamatan->nama ?? '-'}}, {{$identitas->wali->alamat_kota->nama ?? '-'}}, {{$identitas->wali->alamat_kota->provinsi->nama ?? '-'}}
            @endif
        </td>
    </tr>
    <tr>
        <td>No Telepon</td>
        <td>{{strtoupper($identitas->wali->phone ?? '-')}}</td>
    </tr>
    <tr>
        <td>Hubungan</td>
        <td>{{strtoupper($identitas->jenis_hubungan_keluarga->nama ?? '-')}}</td>
    </tr>
</table>
<table width="100%" class="bordered" cellpadding="5">
    <tr>
        <th align="center" colspan="2">DATA SOSIAL PASIEN</th>
    </tr>
    <tr>
        <td width="30%">Pendidikan Terakhir</td>
        <td width="70%">{{strtoupper($identitas->pendidikan->nama ?? '-')}}</td>
    </tr>
    <tr>
        <td>Pekerjaan</td>
        <td>{{strtoupper($identitas->job ?? '-')}}</td>
    </tr>
    <tr>
        <td>Agama</td>
        <td>{{strtoupper($identitas->agama->nama ?? '-')}}</td>
    </tr>
    <tr>
        <td>Status Pernikahan</td>
        <td>{{strtoupper($identitas->pernikahan->nama ?? '-')}}</td>
    </tr>
    <tr>
        <td>Nama Keluarga</td>
        <td>{{strtoupper($identitas->wali->name ?? '-')}}</td>
    </tr>
    <tr>
        <td>Pembiayaan Pengobatan</td>
        <td>{{strtoupper($identitas->pembayaranUtama->perusahaan->nama ?? '')}} - {{$identitas->pembayaranUtama->no_asuransi ?? ''}}</td>
    </tr>
</table>
<br>
<br>
<table width="100%" cellpadding="5">
    <tr>
        <td width="70%">Pasien terdaftar pada <b>
                @if(!empty($kasus_last))
                    {{indonesian_date(strtotime($kasus_last->created_at))}}  </b> pukul <b> {{date('H:i', strtotime($kasus_last->created_at))}}
                @else
                    {{indonesian_date(strtotime($identitas->created_at))}}  </b> pukul <b> {{date('H:i', strtotime($identitas->created_at))}}
                @endif
           </b></td>
        <td width="30%">
            <p> Surabaya, {{indonesian_date(strtotime(\Carbon\Carbon::now()),'d F Y')}}</p>
            <p style="margin-bottom: 10px">Petugas Admisi</p>
            @if(!is_null($user->ttd))
                <img src="{{ asset($user->ttd) }}" width="50" height="30" class="ml-20">
            @else
                <p style="margin-bottom: 20px">&nbsp;</p>
            @endif
            <p> (<b>{{$user->name}}</b>)</p>
        </td>
    </tr>
</table>
@endsection