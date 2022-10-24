@extends('layouts.print')

@section('title')
Remunerasi Pegawai - {{$pegawai->pegawai->name}}
@endsection

@section('content')
<table width="100%">
    <tr>
        <td width="100%"><img src="{{config('app.kop_lg')}}" height="50"></td>
    </tr>
</table>


<hr>
<h4 class="text-center">REMUNERASI PEGAWAI<br>
    NRP : {{strtoupper($pegawai->pegawai->nrp)}}
</h4>
<table width="100%">
    <tr>
        <th width="42.5%"></th>
        <th width="15%">
            <img src="" height="100" style="border-radius: 50px;">
        </th>
        <th width="42.5%"></th>
    </tr>
</table>

<br>
<h3>DATA UMUM</h3>

<table width="100%">
    <tr>
        <th width="20%"></th>
        <th width="30%"></th>
        <th width="20%"></th>
        <th width="30%"></th>
    </tr>
    <tr>
        <td>Nama Pegawai</td>
        <td><span class="text-uppercase"> : {{strtoupper($pegawai->pegawai->name)}} </span></td>
        <td>Status Kepegawaian</td>
        <td>: {{!empty($pegawai->masterJenisPegawai->nama) ? $pegawai->masterJenisPegawai->nama : '-'}}</td>
    </tr>
    <tr>
        <td>NRP</td>
        <td>: 
            {{!empty($pegawai->pegawai->nrp) ? $pegawai->pegawai->nrp : '-'}}
        </td>
        <td>Golongan</td>
        <td>: {{!empty($pegawai->masterGolonganPegawai->nama) ? $pegawai->masterGolonganPegawai->nama : '-'}}</td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>: 
            @if($pegawai->pegawai->gender == "L") LAKI-LAKI
            @else PEREMPUAN
            @endif
        </td>
        <td>Jabatan</td>
        <td>: {{!empty($pegawai->MasterJabatan->nama) ? $pegawai->MasterJabatan->nama : '-'}}</td> 
    </tr>
    <tr>
        <td>Tempat Lahir</td>
        <td>: {{$pegawai->pegawai->birth_place ?? '-'}}</td>
        <td>Pendidikan</td>
        <td>: {{!empty($pegawai->masterGelar->nama) ? $pegawai->masterGelar->nama : '-'}}</td>
    </tr>
    <tr>
        <td>Tgl Lahir</td>
        <td>: 
            <span class="text-uppercase"> {{Date::parse($pegawai->pegawai->birth_date)->format('d F Y')}}</span>
        </td>
        <td></td>
        <td></td>
    </tr>
</table>

<br>
<h3>JASA PELAYANAN TAMBAHAN</h3>
<table width="100%">
    <tr>
        <th width="35%"></th>
        <th width="65%"></th>
    </tr>
    <tr>
        <td>JP Dasar</td>
        <td>: {{!empty($keuangan->jp_dasar) ? "Rp. " . number_format($keuangan->jp_dasar ,0,',','.'): '-'}}</td>
    </tr>
    <tr>
        <td>Visite Tetap</td>
        <td>: 
            {{!empty($keuangan->visite_tetap) ? "Rp. " . number_format($keuangan->visite_tetap,0,',','.') : '-'}}
        </td>
    </tr>
    <tr>
        <td>Visite Anggrek</td>
        <td>:
            {{!empty($keuangan->visite_anggrek) ? "Rp. " . number_format($keuangan->visite_anggrek,0,',','.') : '-'}} 
        </td>
    </tr>
    <tr>
        <td>Jasa Pendidikan</td>
        <td>:
            {{!empty($keuangan->jasa_pendidikan) ? "Rp. " . number_format($keuangan->jasa_pendidikan,0,',','.') : '-'}}
        </td>
    </tr>
    <tr>
        <td>Tindakan Dokter</td>
        <td>: 
            {{!empty($keuangan->tindakan_dokter) ? "Rp. " . number_format($keuangan->tindakan_dokter,0,',','.') : '-'}}
        </td>
    </tr>
    <tr>
        <td>Konsultasi Dokter</td>
        <td>:
            {{!empty($keuangan->konsul_dokter) ? "Rp. " . number_format($keuangan->konsul_dokter,0,',','.') : '-'}}
        </td>
    </tr>
    <tr>
        <td>Poli Tumbang</td>
        <td>:
            {{!empty($keuangan->poli_tumbang) ? "Rp. " . number_format($keuangan->poli_tumbang,0,',','.') : '-'}}
        </td>
    </tr>
    <tr>
        <td>APS / ECT</td>
        <td>:
            {{!empty($keuangan->aps_ect) ? "Rp. " . number_format($keuangan->aps_ect,0,',','.') : '-'}}
        </td>
    </tr>
    <tr>
        <td>Patologi Klinik</td>
        <td>:
            {{!empty($keuangan->patologi_klinik) ? "Rp. " . number_format($keuangan->patologi_klinik,0,',','.') : '-'}}
        </td>
    </tr>
    <tr>
        <td>IPWL</td>
        <td>:
            {{!empty($keuangan->ipwl) ? "Rp. " . number_format($keuangan->ipwl,0,',','.') : '-'}}
        </td>
    </tr>
    <tr>
        <td> <b> TOTAL</b></td>
        <td>: <b>{{!empty($pelayanan_tambahan) ? "Rp. " . number_format($pelayanan_tambahan,0,',','.') : '0'}}</b></td>
    </tr>
</table>
<br>
<h3>Daftar Hadir</h3>
<table width="100%">
    <tr>
        <th width="35%"></th>
        <th width="35%"></th>
        <th width="10%"></th>
        <th width="20%"></th>
    </tr>
    <tr>
        <td>Tidak Masuk dengan Keterangan</td>
        <td>: {{!empty($absensi->absen_ket) ? $absensi->absen_ket : '-'}}</td>
        <td>x</td>
        <td>{{!empty($absensi->Denda->absen_ket) ? "Rp. " . number_format($absensi->Denda->absen_ket,0,',','.') : '-'}}</td>
    </tr>
    <tr>
        <td>Tidak Masuk tanpa Keterangan</td>
        <td>: 
            {{!empty($absensi->absen) ? $absensi->absen : '-'}}
        </td>
        <td>x</td>
        <td>{{!empty($absensi->Denda->absen) ? "Rp. " . number_format($absensi->Denda->absen,0,',','.') : '-'}}</td>
    </tr>
    <tr>
        <td>Telat 30 Menit</td>
        <td>: {{!empty($absensi->telat_satu) ? $absensi->telat_satu : '-'}}</td>
        <td>x</td>
        <td>{{!empty($absensi->Denda->telat_satu) ? "Rp. " . number_format($absensi->Denda->telat_satu,0,',','.') : '-'}}</td>
    </tr>
    <tr>
        <td>Telat 31 - 60 Menit</td>
        <td>: {{ !empty($absensi->telat_dua) ? $absensi->telat_dua : '-'}}</td>
        <td>x</td>
        <td>{{!empty($absensi->Denda->telat_dua) ? "Rp. " . number_format($absensi->Denda->telat_dua,0,',','.') : '-'}}</td>
    </tr>
    <tr>
        <td>Telat 61 - 90 Menit</td>
        <td>: {{!empty($absensi->telat_tiga) ? $absensi->telat_tiga : '-'}}</td>
        <td>x</td>
        <td>{{!empty($absensi->Denda->telat_tiga) ? "Rp. " . number_format($absensi->Denda->telat_tiga,0,',','.') : '-'}}</td>
    </tr>
    <tr>
        <td>Telat > 91 Menit</td>
        <td>: {{ !empty($absensi->telat_empat) ? $absensi->telat_empat : '-'}}</td>
        <td>x</td>
        <td>{{!empty($absensi->Denda->telat_empat) ? "Rp. " . number_format($absensi->Denda->telat_empat,0,',','.') : '-'}}</td>
    </tr>
    <tr>
        <td>Pulang 30 Menit</td>
        <td>: {{!empty($absensi->pulang_satu) ? $absensi->pulang_satu : '-'}}</td>
        <td>x</td>
        <td>{{!empty($absensi->Denda->pulang_satu) ? "Rp. " . number_format($absensi->Denda->pulang_satu,0,',','.') : '-'}}</td>
    </tr>
    <tr>
        <td>Pulang 31 - 60 Menit</td>
        <td>: {{ !empty($absensi->pulang_dua) ? $absensi->pulang_dua : '-'}}</td>
        <td>x</td>
        <td>{{!empty($absensi->Denda->pulang_dua) ? "Rp. " . number_format($absensi->Denda->pulang_dua,0,',','.') : '-'}}</td>
    </tr>
    <tr>
        <td>Pulang 61 - 90 Menit</td>
        <td>: {{!empty($absensi->pulang_tiga) ? $absensi->pulang_tiga : '-'}}</td>
        <td>x</td>
        <td>{{!empty($absensi->Denda->pulang_tiga) ? "Rp. " . number_format($absensi->Denda->pulang_tiga,0,',','.') : '-'}}</td>
    </tr>
    <tr>
        <td>Pulang > 91 Menit</td>
        <td>: {{ $absensi->pulang_empat ?? '-'}}</td>
        <td>x</td>
        <td>{{!empty($absensi->Denda->pulang_empat) ? "Rp. " . number_format($absensi->Denda->pulang_empat,0,',','.') : '-'}}</td>
    </tr>
    <tr>
        <td>Terlambat Senam</td>
        <td>: {{!empty($absensi->telat_senam) ? $absensi->telat_senam : '-'}}</td>
        <td>x</td>
        <td>{{!empty($absensi->Denda->telat_senam) ? "Rp. " . number_format($absensi->Denda->telat_senam,0,',','.') : '-'}}</td>
    </tr>
    <tr>
        <td>Tidak Ikut Senam</td>
        <td>: {{ !empty($absensi->tidak_senam) ? $absensi->tidak_senam : '-'}}</td>
        <td>x</td>
        <td>{{!empty($absensi->Denda->tidak_senam) ? "Rp. " . number_format($absensi->Denda->tidak_senam,0,',','.') : '-'}}</td>
    </tr>
    <tr>
        <td>Lupa Absen Masuk</td>
        <td>: {{!empty($absensi->lupa_absen_masuk) ? $absensi->lupa_absen_masuk : '-'}}</td>
        <td>x</td>
        <td>{{!empty($absensi->Denda->lupa_absen_masuk) ? "Rp. " . number_format($absensi->Denda->lupa_absen_masuk,0,',','.') : '-'}}</td>
    </tr>
    <tr>
        <td>Lupa Absen Pulang</td>
        <td>: {{ !empty($absensi->lupa_absen_pulang) ? $absensi->lupa_absen_pulang : '-'}}</td>
        <td>x</td>
        <td>{{!empty($absensi->Denda->lupa_absen_pulang) ? "Rp. " . number_format($absensi->Denda->lupa_absen_pulang,0,',','.') : '-'}}</td>
    </tr>
    <tr>
        <td> <b> TOTAL DENDA </b></td>
        <td>: <b>{{!empty($total_denda)? "Rp. " . number_format($total_denda,0,',','.') : '0'}}</b></td>
    </tr>
</table>
<br>
<br>
<br>
<hr>
<table width="100%">
    <tr>
        <th width="50%"></th>
        <th width="50%"></th>
    </tr>
    <tr>
        <td> <b>Jasa Pelayanan </b></td>
        <td style="text-align:right"><b>&nbsp;&nbsp;{{!empty($jasa_pelayanan)? "Rp. " . number_format($jasa_pelayanan,0,',','.') : '0'}}</b></td>
    </tr>
    <tr>
        <td> <b>Total Pelayanan Tambahan </b></td>
        <td style="text-align:right">+<b>&nbsp;&nbsp;{{!empty($pelayanan_tambahan)? "Rp. " . number_format($pelayanan_tambahan,0,',','.') : '0'}}</b></td>
    </tr>
    <tr>
        <td> <b> Total Denda </b></td>
        <td style="text-align:right"><b>-&nbsp;&nbsp;{{!empty($total_denda)? "Rp. " . number_format($total_denda,0,',','.') : '0'}}</b></td>
    </tr>
    <tr>
        <td> <b> Total Terima Bersih </b></td>
        <td style="text-align:right"><b>&nbsp;&nbsp;{{ "Rp. " . number_format($total_pelayanan,0,',','.')}}</b></td>
    </tr>
</table>
<hr>

@endsection