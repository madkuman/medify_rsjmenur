@extends('layouts.print')

@section('title')
Print Asesmen Napza - {{$kasus->identitas->nama}}
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

    table.separated {
      border-collapse: separate;
      border-spacing: 10px;
    }
    .separated th, .separated td {
      border: 1px solid black;
    }
    table.no-border td {
        border: none;
    }
</style>
@endsection

@section('content')
    <table width="100%">
        <tr>
            <td width="55%" valign="top">
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
            <td width="40%" valign="top">
                <table class="bordered" cellpadding="5" align="right">
                    <tr>
                        <td align="center" class="has-border">RM 11</td>
                    </tr>
                    <tr>
                        <td><i>Halaman 1</i></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="separated" width="100%" cellpadding="3">
        <tr>
            <td width="55%" align="center" colspan="2">
                <p style="font-size: 15px;"><b>ASESMEN NAPZA</b></p>
                <p><i>(Diisi oleh Dokter / Perawat / Psikologi)</i></p>
            </td>
            <td width="45%">
                <table class="no-border" width="100%">
                    <tr>
                        <td width="38%">No. Rekam Medis</td>
                        <td width="3%">:</td>
                        <td width="59%">{{ $kasus->pasien->no_rm ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $kasus->identitas->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir/Umur</td>
                        <td>:</td>
                        <td>{{ !is_null($kasus->identitas->tanggal_lahir) ? date('d/m/Y', strtotime($kasus->identitas->tanggal_lahir)) : '-' }} / {{ $kasus->identitas->umur ?? '-' }} Tahun</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{ $kasus->identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr valign="top">
            <td align="center" height="50">
                <p>ALERGI : </p>
                <p>{{ $asesmen_napza->alergi ?? '' }}</p>
            </td>
            <td align="center">
                <p>RISIKO :</p>
                <p>{{ $asesmen_napza->risiko ?? '' }}</p>
            </td>
            <td align="center">
                <p>TANGGAL DAN JAM PENGKAJIAN</p>
                <p>{{ !is_null($asesmen_napza->tanggal_pengkajian) ? date('d/m/Y', strtotime($asesmen_napza->tanggal_pengkajian)) : '-' }}, {{ $asesmen_napza->jam_pengkajian ?? '' }}</p>
            </td>
        </tr>
    </table>

    @php 
        $checked = '<div style="font-family: ZapfDingbats, sans-serif; display: inline;">4</div>';
        $jenis = json_decode($asesmen_napza->jenis_zat_yang_dipakai);
    @endphp

    <table class="bordered" width="100%" cellpadding="5">
        <tr>
            <td width="5%" align="center" valign="top" style="padding-top: 8px;">1.</td>
            <td width="95%">
                <table width="100%">
                    <tr>
                        <td colspan="5">Jenis  zat yang dipakai</td>
                    </tr>
                    @foreach($jenis as $item)
                    <tr>
                        <td>{{$loop->iteration}}. {{$item->jenis_zat_yang_dipakai}}</td>
                        <td width="7%">Sejak</td>
                        <td width="15%">{{!is_null($item->tanggal_sejak) ? date('d/m/Y', strtotime($item->tanggal_sejak->date)) : '-' }}</td>
                        <td width="7%">s/d</td>
                        <td>{{!is_null($item->tanggal_sampai_dengan) ? date('d/m/Y', strtotime($item->tanggal_sampai_dengan->date)) : '-' }}</td>
                    </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td width="5%" align="center" valign="top" style="padding-top: 8px;">2.</td>
            <td width="95%">
                <table width="100%">
                    <tr>
                        <td colspan="3">Alasan penggunaan zat</td>
                    </tr>
                    <tr>
                        <td width="50%">
                        	{!! $asesmen_napza->alasan_penggunaan_zat_diajak_teman ? $checked : '-' !!} Diajak teman
                        </td>
                        <td width="50%">
                        	{!! $asesmen_napza->alasan_penggunaan_zat_coba_coba_keinginan_sendiri ? $checked : '-' !!} Coba-coba keinginan sendiri
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	{!! $asesmen_napza->alasan_penggunaan_zat_dipaksa_teman ? $checked : '-' !!} Dipaksa teman
                        </td>
                        <td>
                        	{!! $asesmen_napza->alasan_penggunaan_zat_pelarian_dari_masalah ? $checked : '-' !!} Pelarian dari masalah
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td width="5%" align="center"  valign="top" style="padding-top: 8px;">3.</td>
            <td width="95%">
                <table width="100%">
                    <tr>
                        <td>Komplikasi medik / jiwa</td>
                    </tr>
                    <tr>
                        <td>{{!is_null($asesmen_napza->komplikasi_medik_jiwa) ? 'Ada, '. $asesmen_napza->komplikasi_medik_jiwa : 'Tidak Ada' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td width="5%" align="center" valign="top" style="padding-top: 8px;">4.</td>
            <td width="95%">
                <table width="100%">
                    <tr>
                        <td colspan="2">Perilaku kriminal didalam rumah sendiri</td>
                    </tr>
                    <tr>
                        <td width="50%">
                        	{!! $asesmen_napza->kriminal_dirumah_tidak_ada_masalah ? $checked : '-' !!} Tidak ada Masalah
                        </td>
                        <td width="50%">
                        	{!! $asesmen_napza->kriminal_dirumah_mengambil_barang_dengan_paksaan ? $checked : '-' !!} Mengambil barang dengan paksaan
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	{!! $asesmen_napza->kriminal_dirumah_mencuri ? $checked : '-' !!} Mencuri
                        </td>
                        <td>
                        	{!! $asesmen_napza->kriminal_dirumah_menjual_barang_sendiri ? $checked : '-' !!} Menjual barang sendiri
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	{!! $asesmen_napza->kriminal_dirumah_mengancam ? $checked : '-' !!} Mengancam
                        </td>
                        <td>
                        	{!! $asesmen_napza->kriminal_dirumah_mengambil_barang ? $checked : '-' !!} Mengambil barang
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	{!! $asesmen_napza->kriminal_dirumah_menggadai ? $checked : '-' !!} Menggadai
                        </td>
                        <td>
                        	{!! $asesmen_napza->kriminal_dirumah_merusak ? $checked : '-' !!} Merusak
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td width="5%" align="center" valign="top" style="padding-top: 8px;">5.</td>
            <td width="95%">
                <table width="100%">
                    <tr>
                        <td colspan="2">Perilaku kriminal diluar rumah</td>
                    </tr>
                    <tr>
                        <td width="50%">{!! $asesmen_napza->kriminal_diluar_rumah_tidak_ada_masalah ? $checked : '-' !!} Tidak ada Masalah</td>
                        <td width="50%">{!! $asesmen_napza->kriminal_diluar_rumah_merampok ? $checked : '-' !!} Merampok</td>
                    </tr>
                    <tr>
                        <td>{!! $asesmen_napza->kriminal_diluar_rumah_mencuri ? $checked : '-' !!} Mencuri</td>
                        <td>{!! $asesmen_napza->kriminal_diluar_rumah_mengancam ? $checked : '-' !!} Mengancam</td>
                    </tr>
                    <tr>
                        <td>{!! $asesmen_napza->kriminal_diluar_rumah_merampas_barang ? $checked : '-' !!} Merampas barang</td>
                        <td>{!! $asesmen_napza->kriminal_diluar_rumah_merusak ? $checked : '-' !!} Merusak</td>
                    </tr>
                    <tr>
                        <td>{!! $asesmen_napza->kriminal_diluar_rumah_membunuh ? $checked : '-' !!} Membunuh</td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td width="5%" align="center" valign="top" style="padding-top: 8px;">6.</td>
            <td width="95%">
                <table width="100%">
                    <tr>
                        <td colspan="2">Catatan polisi</td>
                    </tr>
                    <tr>
                        <td width="50%">{!! $asesmen_napza->catatan_polisi_tidak_ada ? $checked : '-' !!} Tidak ada</td>
                        <td width="50%">{!! $asesmen_napza->catatan_polisi_ditahan_kemudian_langsung_dipulangkan ? $checked : '-' !!} Ditahan kemudian langsung dipulangkan</td>
                    </tr>
                    <tr>
                        <td>{!! $asesmen_napza->catatan_polisi_ditahan_diproses_pengadilan ? $checked : '-' !!} Ditahan diproses pengadilan</td>
                        <td>{!! !is_null($asesmen_napza->lain_lain_catatan_polisi) ? $checked : '-' !!} Lain-lain, {{ !is_null($asesmen_napza->lain_lain_catatan_polisi) ? $asesmen_napza->lain_lain_catatan_polisi : '-' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td width="5%" align="center" valign="top" style="padding-top: 8px;">7.</td>
            <td width="95%">
                <table width="100%">
                    <tr>
                        <td colspan="2">Problem sekolah</td>
                    </tr>
                    <tr>
                        <td width="50%">{!! $asesmen_napza->problem_sekolah_tidak_ada_masalah ? $checked : '-' !!} Tidak ada masalah</td>
                        <td width="50%">{!! $asesmen_napza->problem_sekolah_susah_konsentrasi_belajar ? $checked : '-' !!} Susah konsentrasi</td>
                    </tr>
                    <tr>
                        <td>{!! $asesmen_napza->problem_sekolah_tidak_naik_kelas ? $checked : '-' !!} Tidak naik kelas</td>
                        <td>{!! $asesmen_napza->problem_sekolah_dikeluarkan_dari_sekolah ? $checked : '-' !!} Dikeluarkan dari sekolah</td>
                    </tr>
                    <tr>
                        <td>{!! $asesmen_napza->problem_sekolah_berhenti_sekolah ? $checked : '-' !!} Berhenti sekolah</td>
                        <td>{!! $asesmen_napza->problem_sekolah_tidak_disiplin ? $checked : '-' !!} Tidak disiplin</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection