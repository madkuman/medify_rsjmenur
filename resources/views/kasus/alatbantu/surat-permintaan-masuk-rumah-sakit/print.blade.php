@extends('layouts.print')

@section('title')
Print Surat Permintaan Masuk Rumah Sakit
@endsection

@section('css')
<style type="text/css">
    body, p {
        font-size: 12px;
        font-family: Arial, Helvetica, sans-serif;
        line-height: 16px;
    }
    table.bordered {
      border-collapse: collapse;
    }
    table.bordered, .bordered th, .bordered td.has-border {
      border: 1px solid black;
    }
</style>
@endsection

@section('content')
    <table class="bordered" align="right" cellpadding="3">
        <tr>
            <td align="center" class="has-border">RM. 17</td>
        </tr>
        <tr>
            <td align="center">Halaman 1/1</td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td width="60%" valign="top">
                <table width="100%" cellpadding="5">
                   <tr>
                        <td width="15%" align="right">
                            <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="50">
                        </td>
                        <td width="60%" align="center">
                            <p style="font-size: 10px;">PEMERINTAH PROVINSI JAWA TIMUR <br>
                            <b>RUMAH SAKIT JIWA MENUR</b> <br>
                            Jln. Menur No. 120, Telp. (031) 5021635, 5021637 <br>
                            <b>SURABAYA</b>
                            </p>
                        </td>
                        <td width="25%" align="left">
                            <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="50">
                        </td>
                   </tr> 
                </table>
            </td>
            <td width="40%"></td>
        </tr>
    </table>

    <table width="90%" class="bordered" align="center" cellpadding="5" style="margin-top: 20px;">
        <tr>
            <th align="center">
                <h4>SURAT PERMINTAAN MASUK RUMAH SAKIT</h4>
            </th>
        </tr>
        <tr>
            <td align="center" class="has-border">
                <table width="100%">
                    <tr>
                        <td colspan="3">Kepada yth : </td>
                    </tr>
                    <tr>
                        <td colspan="3">Unit Admission / TPP Rawat Inap</td>
                    </tr>
                    <tr>
                        <td colspan="3">Di tempat</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p style="margin-top: 20px;">Mohon didaftarkan sebagai pasien rawat inap :</p>
                        </td>
                    </tr>
                    <tr>
                        <td width="22%">No. RM</td>
                        <td width="3%">:</td>
                        <td width="75%">{{$kasus->pasien->no_rm ?? '.........................................'}}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{$kasus->identitas->nama ?? '.........................................'}}, {{$kasus->identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir / Umur</td>
                        <td></td>
                        <td>{{ !is_null($kasus->identitas->tanggal_lahir) ? date('d/m/Y', strtotime($kasus->identitas->tanggal_lahir)) : '-'}} / {{$kasus->identitas->umur ?? '.........................................'}} Tahun</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{$kasus->identitas->alamat ?? '.........................................'}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" class="has-border">
                <table width="100%">
                    <tr>
                        <td>Diagnosa Masuk :</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" class="has-border">
                <table width="100%">
                    <tr>
                        <td>Diagnosa Tambahan</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" class="has-border">
                <table width="100%">
                    <tr>
                        <td>Terapi yang diberikan</td>
                    </tr>
                    <tr>
                        <td>{{$surat_permintaan_masuk_rumah_sakit->terapi_yang_diberikan ?? ''}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" class="has-border">
                <table width="100%">
                    <tr>
                        <td colspan="3">Akan dirawat di :</td>
                    </tr>
                    <tr>
                        <td width="15%">Ruang</td>
                        <td width="3%">:</td>
                        <td width="82%">{{$surat_permintaan_masuk_rumah_sakit->ruang ?? '.........................................'}}</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td>{{$surat_permintaan_masuk_rumah_sakit->kelas ?? '.........................................'}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" class="has-border">
                <table width="100%">
                    <tr>
                        <td width="60%"></td>
                        <td width="40%" align="center"><p>Surabaya, {{date('d F Y', strtotime($surat_permintaan_masuk_rumah_sakit->created_at))}}</p></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="center">Dokter pemeriksa</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="center">
                            <p style="margin-top: 50px;">({{$kasus->admin->user->name ?? '.........................................'}})</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection