@extends('layouts.print')

@section('title')
Print Asesmen Napza Rawat Jalan (Non IPWL)
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
    table.bordered, .bordered th, .bordered td {
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
                        <td align="center">RM 11</td>
                    </tr>
                    <tr>
                        <td><i>Halaman 1/2</i></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="separated" width="100%" cellpadding="3">
        <tr>
            <td width="55%" align="center" colspan="2">
                <p style="font-size: 15px;"><b>ASESMEN NAPZA RAWAT JALAN (NON IPWL)</b></p>
                <p><i>(Diisi oleh Dokter / Perawat)</i></p>
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
                <p>{{ $asesmen_napza_non_ipwl->alergi ?? '' }}</p>
            </td>
            <td align="center">
                <p>RISIKO :</p>
                <p>{{ $asesmen_napza_non_ipwl->risiko ?? '' }}</p>
            </td>
            <td align="center">
                <p>TANGGAL DAN JAM PENGKAJIAN</p>
                <p>{{ !is_null($asesmen_napza_non_ipwl->tanggal_pengkajian) ? date('d/m/Y', strtotime($asesmen_napza_non_ipwl->tanggal_pengkajian)) : '-' }}, {{ $asesmen_napza_non_ipwl->jam_pengkajian ?? '' }}</p>
            </td>
        </tr>
    </table>

    @php 
        $checked = '<div style="font-family: ZapfDingbats, sans-serif; display: inline;">4</div>';
        $jenis = json_decode($asesmen_napza_non_ipwl->jenis_napza_yang_dipakai);
        $rowspan = count($jenis) + 1;
    @endphp

    <table class="bordered" width="100%" cellpadding="5">
        <tr>
            <th width="5%" align="center">No.</th>
            <th width="95%" colspan="4">Pertanyaan</th>
        </tr>
        <tr>
            <td align="center" valign="top">1.</td>
            <td colspan="4">
                Riwayat Pemakaian Napza <br>
                {{!is_null($asesmen_napza_non_ipwl->riwayat_pemakaian_napza) ? 'Ada, '. $asesmen_napza_non_ipwl->riwayat_pemakaian_napza : 'Tidak Ada' }}
            </td>
        </tr>
        <tr>
            <td rowspan="{{$rowspan}}" align="center" valign="top">2.</td>
            <td>Jenis napza yang dipakai</td>
            <td align="center">Sejak</td>
            <td align="center">s/d</td>
            <td align="center">Cara pakai</td>
        </tr>

        @foreach($jenis as $item)
        <tr>
            <td>{{$loop->iteration}}. {{$item->jenis_napza_yang_dipakai}}</td>
            <td>{{!is_null($item->tanggal_sejak) ? date('d/m/Y', strtotime($item->tanggal_sejak->date)) : '-' }}</td>
            <td>{{!is_null($item->tanggal_sampai_dengan) ? date('d/m/Y', strtotime($item->tanggal_sampai_dengan->date)) : '-' }}</td>
            <td>{{$item->cara_pakai}}</td>
        </tr>
        @endforeach

        <tr>
            <td align="center" valign="top">3.</td>
            <td colspan="4">
                <table class="no-border" width="100%">
                    <tr>
                        <td colspan="2">Etiologi penggunaan zat</td>
                    </tr>
                    <tr>
                        <td>{!! $asesmen_napza_non_ipwl->etiologi_penggunaan_zat_diajak_teman ? $checked : '-' !!} Diajak teman</td>
                        <td>{!! $asesmen_napza_non_ipwl->etiologi_penggunaan_zat_coba_coba_keinginan_sendiri ? $checked : '-' !!} Coba-coba keinginan sendiri</td>
                    </tr>
                    <tr>
                        <td>{!! $asesmen_napza_non_ipwl->etiologi_penggunaan_zat_dipaksa_teman ? $checked : '-' !!} Dipaksa teman</td>
                        <td>{!! $asesmen_napza_non_ipwl->etiologi_penggunaan_zat_pelarian_dari_masalah ? $checked : '-' !!} Pelarian dari masalah</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">4.</td>
            <td colspan="4">
                Komplikasi medik/jiwa <br>
                {{!is_null($asesmen_napza_non_ipwl->komplikasi_medik_jiwa) ? 'Ada, '. $asesmen_napza_non_ipwl->komplikasi_medik_jiwa : 'Tidak Ada' }}
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">5.</td>
            <td colspan="4">
                Perilaku kriminal di dalam rumah sendiri <br>
                {{!is_null($asesmen_napza_non_ipwl->perilaku_kriminal_di_dalam_rumah_sendiri) ? 'Ada, '. $asesmen_napza_non_ipwl->perilaku_kriminal_di_dalam_rumah_sendiri : 'Tidak Ada' }}
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">6.</td>
            <td colspan="4">
                Perilaku kriminal di luar rumah <br>
                {{!is_null($asesmen_napza_non_ipwl->perilaku_kriminal_di_luar_rumah) ? 'Ada, '. $asesmen_napza_non_ipwl->perilaku_kriminal_di_luar_rumah : 'Tidak Ada' }}
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">7.</td>
            <td colspan="4">
                Problem sekolah/keluarga/pekerjaan/masyarakat <br>
                {{!is_null($asesmen_napza_non_ipwl->problem_masyarakat) ? 'Ada, '. $asesmen_napza_non_ipwl->problem_masyarakat : 'Tidak Ada' }}
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">8.</td>
            <td colspan="4">
                Riwayat perawatan di rumah sakit terkait napza <br>
                {{!is_null($asesmen_napza_non_ipwl->riwayat_perawatan_di_rumah_sakit_terkait_napza) ? 'Ada, '. $asesmen_napza_non_ipwl->riwayat_perawatan_di_rumah_sakit_terkait_napza : 'Tidak Pernah' }}
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">9.</td>
            <td colspan="4">
                Riwayat rehabilitasi napza sebelumnya <br>
                {{!is_null($asesmen_napza_non_ipwl->riwayat_rehabilitasi_napza_sebelumnya) ? 'Pernah, kapan '. $asesmen_napza_non_ipwl->riwayat_rehabilitasi_napza_sebelumnya : 'Tidak Pernah' }}
				{!! !is_null($asesmen_napza_non_ipwl->tempat_rehabilitasi) ? '<br> Tempat Rehabilitasi, '. $asesmen_napza_non_ipwl->tempat_rehabilitasi : '-' !!}
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">10.</td>
            <td colspan="4">
                Riwayat relaps dengan / tanpa rehabilitasi napza <br>
                {{!is_null($asesmen_napza_non_ipwl->riwayat_relaps_dengan_tanpa_rehabilitasi_napza) ? 'Pernah, kapan '. $asesmen_napza_non_ipwl->riwayat_relaps_dengan_tanpa_rehabilitasi_napza : 'Tidak Pernah' }}
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">11.</td>
            <td colspan="4">
                <table class="no-border" width="100%">
                    <tr>
                        <td>Faktor penyebab relaps (bisa lebih dari satu faktor)</td>
                    </tr>
                    <tr>
                        <td>{!! $asesmen_napza_non_ipwl->faktor_penyebab_relaps_diajak_teman ? $checked : '-' !!} Diajak teman</td>
                    </tr>
                    <tr>
                        <td>{!! $asesmen_napza_non_ipwl->faktor_penyebab_relaps_dipaksa_teman ? $checked : '-' !!} Dipaksa teman</td>
                    </tr>
                    <tr>
                        <td>{!! $asesmen_napza_non_ipwl->faktor_penyebab_relaps_tidak_memiliki_aktivitas_berarti ? $checked : '-' !!} Tidak memiliki aktivitas berarti</td>
                    </tr>
                    <tr>
                        <td>{!! $asesmen_napza_non_ipwl->faktor_penyebab_relaps_dendam_setelah_masa_pemulihan ? $checked : '-' !!} Dendam setelah masa pemulihan</td>
                    </tr>
                    <tr>
                        <td>{!! $asesmen_napza_non_ipwl->faktor_penyebab_relaps_konflik_dengan_orang_tua ? $checked : '-' !!} Konflik dengan orang tua/orang terdekat</td>
                    </tr>
                    <tr>
                        <td>{!! $asesmen_napza_non_ipwl->faktor_penyebab_relaps_bergabung_dengan_pengguna_zat ? $checked : '-' !!} Bergabung dengan kelompok pengguna zat</td>
                    </tr>
                    <tr>
                        <td>{!! $asesmen_napza_non_ipwl->faktor_penyebab_relaps_tidak_mampu_menahan_suggest ? $checked : '-' !!} Tidak mampu menahan <i>suggest</i></td>
                    </tr>
                    <tr>
                        <td>{!! $asesmen_napza_non_ipwl->faktor_penyebab_relaps_keinginan_untuk_menggunakan ? $checked : '-' !!} Keinginan untuk menggunakan</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">12.</td>
            <td colspan="4">
                Riwayat seks bebas <br>
                {{!is_null($asesmen_napza_non_ipwl->riwayat_seks_bebas) ? 'Pernah, kapan '. $asesmen_napza_non_ipwl->riwayat_seks_bebas : 'Tidak Pernah' }}
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">13.</td>
            <td colspan="4">
                Anggota keluarga yang menggunakan napza <br>
                {{!is_null($asesmen_napza_non_ipwl->anggota_keluarga_yang_menggunakan_napza) ? 'Ada, '. $asesmen_napza_non_ipwl->anggota_keluarga_yang_menggunakan_napza : 'Tidak Ada' }}
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 30px;">
        <tr>
            <td width="60%" rowspan="4">
                <div style="border: 1px solid #000; width: 60%; text-align: center; padding: 15px;">
                <p>TANGGAL DAN JAM SELESAI PENGKAJIAN</p>
                <p>{{ !is_null($asesmen_napza_non_ipwl->tanggal_selesai_pengkajian) ? date('d/m/Y', strtotime($asesmen_napza_non_ipwl->tanggal_selesai_pengkajian)) : '' }}, {{ $asesmen_napza_non_ipwl->jam_selesai_pengkajian ?? '' }}</p>
                </div>
            </td>
            <td width="40%" align="center">
                Dokter / Perawat
            </td>
        </tr>
        <tr>
            <td align="center">
                ({{$kasus->admin->user->name ?? '.........................................'}})
            </td>
        </tr>
        <tr>
            <td align="center" height="50"></td>
        </tr>
        <tr>
            <td align="center">
                Tanda tangan dan nama terang
            </td>
        </tr>
    </table>
@endsection