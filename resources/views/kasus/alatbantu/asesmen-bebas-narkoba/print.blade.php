@extends('layouts.print')

@section('title')
Print Asesmen Bebas Narkoba
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
    table.bordered, .bordered th, .bordered td.has-border-full {
      border: 1px solid black;
    }
    .bordered td.has-border {
        border-right: 1px solid #000;
    }
</style>
@endsection

@section('content')
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
            <td class="has-border" width="40%">
                <table width="30%" class="bordered" align="right" cellpadding="3">
                    <tr valign="top">
                        <td align="center" class="has-border-full">RM. 11.K2</td>
                    </tr>
                    <tr>
                        <td align="center" class="has-border-full">Halaman 1/1</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr valign="top">
            <td>
                <table class="bordered" width="100%" cellpadding="28">
                    <tr valign="bottom">
                        <td class="has-border" align="center">
                            <p style="font-size: 16px;"><b>ASESMEN BEBAS NARKOBA</b></p>
                            <p style="font-size: 12px;"><i>(diisi oleh dokter)</i></p>
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="bordered" width="100%" cellpadding="3">
                    <tr>
                        <td width="38%">No Rekam Medis</td>
                        <td width="62%">: {{ $kasus->pasien->no_rm ?? '________________' }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{$kasus->identitas->nama ?? '________________'}}</td>
                    </tr>
                    <tr>
                        <td>Tgl Lahir/Umur</td>
                        <td>: {{ !is_null($kasus->identitas->tanggal_lahir) ? date('d/m/Y', strtotime($kasus->identitas->tanggal_lahir)) : '-'}} / {{$kasus->identitas->umur ?? '________________'}} Tahun</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: {{ $kasus->identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr valign="top">
            <td>
                <table class="bordered" border="1" width="100%">
                    <tr valign="top">
                        <td width="50%" align="center" class="has-border" style="padding-bottom: 33px; padding-top: 6px;">
                            <p>ALERGI :</p>
                            <p></p>
                        </td>
                        <td width="50%" align="center" class="has-border" style="padding-top: 6px;">
                            <p>RISIKO :</p>
                            <p></p>
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="bordered" width="100%" cellpadding="6">
                    <tr>
                        <td align="center">TANGGAL DAN JAM PENGKAJIAN</td>
                    </tr>
                    <tr>
                        <td align="center">{{ !is_null($asesmen_bebas_narkoba->tanggal_pengkajian) ? date('d/m/Y', strtotime($asesmen_bebas_narkoba->tanggal_pengkajian)) : '____________'}}, {{ $asesmen_bebas_narkoba->jam_pengkajian ?? '____________'}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    @php 
        $checked = '<div style="font-family: ZapfDingbats, sans-serif; display: inline;">4</div>';
        $jenis = json_decode($asesmen_bebas_narkoba->jenis_zat_yang_dipakai);
    @endphp

    <table class="bordered" width="100%" style="margin-top: 20px;" cellpadding="5">
        <tr>
            <th width="5%" align="center">No.</th>
            <th width="95%" align="center">Pertanyaan</th>
        </tr>
        <tr>
            <td class="has-border" align="center">1.</td>
            <td>
                <p>Apakah ada riwayat pemakaian zat</p>
                <p>{{!is_null($asesmen_bebas_narkoba->riwayat_pemakaian_zat) ? 'Ada, '. $asesmen_bebas_narkoba->riwayat_pemakaian_zat : 'Tidak Ada' }}</p>
            </td>
        </tr>
        <tr>
            <td class="has-border" align="center">2.</td>
            <td>
                <p>Jenis zat yang dipakai</p>
                @foreach($jenis as $item)
                    <p>{{$loop->iteration}} {{$item->jenis_zat_yang_dipakai}} sejak {{!is_null($item->tanggal_sejak) ? date('d/m/Y', strtotime($item->tanggal_sejak->date)) : '-' }} s/d {{!is_null($item->tanggal_sampai_dengan) ? date('d/m/Y', strtotime($item->tanggal_sampai_dengan->date)) : '-' }}</p>
                @endforeach
            </td>
        </tr>
        <tr>
            <td class="has-border" align="center">3.</td>
            <td>
                <table>
                    <tr>
                        <td colspan="2">Etiologi penggunaan zat</td>
                    </tr>
                    <tr>
                        <td width="50%">{!! $asesmen_bebas_narkoba->etiologi_penggunaan_zat_diajak_teman ? $checked : '-' !!} Diajak teman</td>
                        <td width="50%">{!! $asesmen_bebas_narkoba->etiologi_penggunaan_zat_coba_coba_keinginan_sendiri ? $checked : '-' !!} Coba-coba keingan sendiri</td>
                    </tr>
                    <tr>
                        <td>{!! $asesmen_bebas_narkoba->etiologi_penggunaan_zat_dipaksa_teman ? $checked : '-' !!} Dipaksa teman</td>
                        <td>{!! $asesmen_bebas_narkoba->etiologi_penggunaan_zat_pelarian_dari_masalah ? $checked : '-' !!} Pelarian dari masalah</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="has-border" align="center">4.</td>
            <td>
                <p>Kompilasi medik / jiwa</p>
                <p>{{!is_null($asesmen_bebas_narkoba->komplikasi_medik_jiwa) ? 'Ada, '. $asesmen_bebas_narkoba->komplikasi_medik_jiwa : 'Tidak Ada' }}</p>
            </td>
        </tr>
        <tr>
            <td class="has-border" align="center">5.</td>
            <td>
                <p>Perilaku kriminal didalam rumah</p>
                <p>{{!is_null($asesmen_bebas_narkoba->perilaku_kriminal_didalam_rumah) ? 'Ada, '. $asesmen_bebas_narkoba->perilaku_kriminal_didalam_rumah : 'Tidak Ada' }}</p>
            </td>
        </tr>
        <tr>
            <td class="has-border" align="center">6.</td>
            <td>
                <p>Perilaku kriminal diluar rumah</p>
                <p>{{!is_null($asesmen_bebas_narkoba->perilaku_kriminal_diluar_rumah) ? 'Ada, '. $asesmen_bebas_narkoba->perilaku_kriminal_diluar_rumah : 'Tidak Ada' }}</p>
            </td>
        </tr>
        <tr>
            <td class="has-border" align="center">7.</td>
            <td>
                <p>Problem sekolah / keluarga / pekerjaan / masyarakat</p>
                <p>{{!is_null($asesmen_bebas_narkoba->problem_masyarakat) ? 'Ada, '. $asesmen_bebas_narkoba->problem_masyarakat : 'Tidak Ada' }}</p>
            </td>
        </tr>
        <tr>
            <td class="has-border" align="center">8.</td>
            <td>
                <p>Riwayat perawatan dirumah sakit</p>
                <p>{{!is_null($asesmen_bebas_narkoba->riwayat_perawatan_dirumah_sakit) ? 'Ada, '. $asesmen_bebas_narkoba->riwayat_perawatan_dirumah_sakit : 'Tidak Ada' }}</p>
            </td>
        </tr>
        <tr>
            <td class="has-border" align="center">9.</td>
            <td>
                <p>Riwayat rehabilitasi napza</p>
                <p>{{!is_null($asesmen_bebas_narkoba->riwayat_rehabilitasi_napza) ? 'Ada, '. $asesmen_bebas_narkoba->riwayat_rehabilitasi_napza : 'Tidak Ada' }}</p>
            </td>
        </tr>
        <tr>
            <td class="has-border"></td>
            <td>
                <table width="100%">
                    <tr valign="top">
                        <td width="40%" align="center" style="border: 1px solid #000; height: 50px;">
                            TANGGAL DAN JAM SELESAI PENGKAJIAN
                            {{ !is_null($asesmen_bebas_narkoba->tanggal_selesai_pengkajian) ? date('d/m/Y', strtotime($asesmen_bebas_narkoba->tanggal_selesai_pengkajian)) : '____________'}}, {{ $asesmen_bebas_narkoba->jam_selesai_pengkajian ?? '____________'}}
                        </td>
                        <td width="60%" align="center">
                            Dokter
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="center">({{$kasus->admin->user->name ?? '.........................................'}})</td>
                    </tr>
                </table>
            </td>
        </tr>
            
    </table>
@endsection