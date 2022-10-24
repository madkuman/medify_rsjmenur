@extends('layouts.print')

@section('title')
Print Laporan Hasil Pemeriksaan Psikologi - {{$kasus->identitas->nama}}
@endsection

@section('css')
<style type="text/css">
    .pagenum:before {
        content: counter(page);
    }
    body, p {
        font-size: 13px;
        font-family: Arial, Helvetica, sans-serif;
    }
    
    table.bordered {
      border-collapse: collapse;
    }
    table.bordered, .bordered th, .bordered td {
      border: 1px solid black;
    }

    table.no-border {
      border-collapse: unset;
    }
    table.no-border, .no-border th, .no-border td {
      border: none;
    }
    .word-break {
        word-wrap: break-word;width:100%;
    }
    .footer {
        width: 100%;
        text-align: right;
        position: fixed;
        bottom: 0px;
    }
    .pagenum:before {
        content: counter(page);
    }
</style>
@endsection

@section('content')
    {{-- <div class="footer">
        Laporan Hasil Pemeriksaan Psikologi Rekruitmen - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$laporan_psikologi_rekruitmen->id.'}'}} | Halaman <span class="pagenum"></span> of 2
    </div> --}}

    <table width="100%" cellpadding="5">
        <tr>
            <td width="90%"></td>
            <td width="15%" align="center" bgcolor="#000" style="border: 3px solid #d9d9d9;">
                <p style="font-size: 14px; color: #fff;"><b>rahasia</b></p>
            </td>
        </tr>
    </table>

    <table class="bordered" width="100%" style="margin-top: 5px;">
        <tr>
            <td align="center" colspan="2">
                <p style="font-size: 12"><b>LAPORAN HASIL PEMERIKSAAN PSIKOLOGI</b></p>
            </td>
        </tr>
        <tr>
            <td width="50%">
                <table class="no-border" width="100%">
                    <tr>
                        <td width="42%">Nama</td>
                        <td width="2%">:</td>
                        <td width="56%">{{ $kasus->identitas->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Tempat / Tanggal Lahir</td>
                        <td>:</td>
                        <td>{{ $kasus->pasien->place_of_birth ?? '-' }} / {{ !is_null($kasus->pasien->date_of_birth) ? indonesian_date($kasus->pasien->date_of_birth) : '-'}}</td>
                    </tr>
                    <tr>
                        <td>Pendidikan</td>
                        <td>:</td>
                        <td>{{ $kasus->pasien->pendidikan->nama ?? '-' }}</td>
                    </tr>
                </table>
            </td>
            <td width="50%">
                <table class="no-border" width="100%">
                    <tr>
                        <td width="40%">Nomor RM</td>
                        <td width="2%">:</td>
                        <td width="58%">{{ $kasus->pasien->no_rm ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Posisi yang dituju</td>
                        <td>:</td>
                        <td>{{ $laporan_psikologi_rekruitmen->posisi_yang_dituju ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Pemeriksaan</td>
                        <td>:</td>
                        <td>{{ !is_null($laporan_psikologi_rekruitmen->tanggal_pemeriksaan) ? indonesian_date($laporan_psikologi_rekruitmen->tanggal_pemeriksaan) : '-'}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    @php 
        $checked = '<div style="font-family: ZapfDingbats, sans-serif;">4</div>';
    @endphp

    <table class="bordered" width="100%" cellpadding="3">
        <tr>
            <td rowspan="2" align="center" style="background-color:#feedbb"><b>ASPEK</b></td>
            <td rowspan="2" align="center" style="background-color:#feedbb"><b>URAIAN</b></td>
            <td colspan="6" align="center" style="background-color:#feedbb"><b>RATING</b></td>
        </tr>
        <tr>
            <td align="center" style="background-color:#feedbb"><b>KS</b></td>
            <td align="center" style="background-color:#feedbb"><b>K</b></td>
            <td align="center" style="background-color:#feedbb"><b>HC</b></td>
            <td align="center" style="background-color:#feedbb"><b>C</b></td>
            <td align="center" style="background-color:#feedbb"><b>B</b></td>
            <td align="center" style="background-color:#feedbb"><b>BS</b></td>
        </tr>
        <tr>
            <td colspan="8" style="background-color:#feedbb"><b>KEMAMPUAN UMUM</b></td>
        </tr>
        <tr>
            <td width="22%">Intelegensi</td>
            <td width="57%">Tingkat kecerdasan umum</td>
            <td width="4%" align="center">{!! $laporan_psikologi_rekruitmen->intelegensi == 'Kurang Sekali' ? $checked : '' !!}</td>
            <td width="3%" align="center">{!! $laporan_psikologi_rekruitmen->intelegensi == 'Kurang' ? $checked : '' !!}</td>
            <td width="4%" align="center">{!! $laporan_psikologi_rekruitmen->intelegensi == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td width="3%" align="center">{!! $laporan_psikologi_rekruitmen->intelegensi == 'Cukup' ? $checked : '' !!}</td>
            <td width="3%" align="center">{!! $laporan_psikologi_rekruitmen->intelegensi == 'Baik' ? $checked : '' !!}</td>
            <td width="4%" align="center">{!! $laporan_psikologi_rekruitmen->intelegensi == 'Baik Sekali' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>Daya Tangkap</td>
            <td>Kemampuan dalam memahami informasi yang diberikan atau permasalahan yang ada disekitarnya</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_tangkap == 'Kurang Sekali' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_tangkap == 'Kurang' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_tangkap == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_tangkap == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_tangkap == 'Baik' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_tangkap == 'Baik Sekali' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>Daya Analisa</td>
            <td>Kemampuan dalam memahami menguraikan permasalahan, melakukan analisa dan membuat suatu kesimpulan atas suatu masalah</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_analisa == 'Kurang Sekali' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_analisa == 'Kurang' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_analisa == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_analisa == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_analisa == 'Baik' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_analisa == 'Baik Sekali' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>Daya Konsentrasi</td>
            <td>Kemampuan mengarahkan dan memusatkan perhatian pada satu hal tanpa mudah teralihkan oleh hal lainnya</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_konsentrasi == 'Kurang Sekali' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_konsentrasi == 'Kurang' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_konsentrasi == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_konsentrasi == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_konsentrasi == 'Baik' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_konsentrasi == 'Baik Sekali' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>Bekerja Dengan Angka</td>
            <td>Kemampuan untuk menganalisa dan memecahkan masalah dengan hitungan</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->bekerja_dengan_angka == 'Kurang Sekali' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->bekerja_dengan_angka == 'Kurang' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->bekerja_dengan_angka == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->bekerja_dengan_angka == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->bekerja_dengan_angka == 'Baik' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->bekerja_dengan_angka == 'Baik Sekali' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td colspan="8" style="background-color:#feedbb"><b>SIKAP KERJA</b></td>
        </tr>
        <tr>
            <td>Sistematika Kerja</td>
            <td>Membuat perencanaan dalam bekerja, sehingga kinerja yang dimiliki menjadi lebih efektif dan efisien</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->sistimatika_kerja == 'Kurang Sekali' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->sistimatika_kerja == 'Kurang' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->sistimatika_kerja == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->sistimatika_kerja == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->sistimatika_kerja == 'Baik' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->sistimatika_kerja == 'Baik Sekali' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>Ketelitian Kerja</td>
            <td>Kecermatan dalam mengerjakan tugas-tugas yang berhubungan dengan pengamatan visual - motorik</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->ketelitian_kerja == 'Kurang Sekali' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->ketelitian_kerja == 'Kurang' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->ketelitian_kerja == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->ketelitian_kerja == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->ketelitian_kerja == 'Baik' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->ketelitian_kerja == 'Baik Sekali' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>Kecepatan Kerja</td>
            <td>Kecekatan atau ketanggapan dalam menghadapi tugas-tugas yang bersifat visual - motorik</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->kecepatan_kerja == 'Kurang Sekali' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->kecepatan_kerja == 'Kurang' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->kecepatan_kerja == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->kecepatan_kerja == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->kecepatan_kerja == 'Baik' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->kecepatan_kerja == 'Baik Sekali' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>Ketekunan Kerja</td>
            <td>Ketekunan/keuletan menghadapi tugas rutin dan monoton serta kemampuan menyelesaikan tugas hingga selesai</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->ketekunan == 'Kurang Sekali' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->ketekunan == 'Kurang' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->ketekunan == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->ketekunan == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->ketekunan == 'Baik' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->ketekunan == 'Baik Sekali' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>Daya Tahan Kerja</td>
            <td>Kemampuan untuk mempertahankan hasil kerja yang optimal dalam situasi yang kompleks dan penuh tekanan</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_tahan_kerja == 'Kurang Sekali' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_tahan_kerja == 'Kurang' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_tahan_kerja == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_tahan_kerja == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_tahan_kerja == 'Baik' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->daya_tahan_kerja == 'Baik Sekali' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>Inisiatif</td>
            <td>Keinginan untuk memulai tugas secara mandiri tanpa arahan atau perintah orang lain</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->inisiatif == 'Kurang Sekali' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->inisiatif == 'Kurang' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->inisiatif == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->inisiatif == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->inisiatif == 'Baik' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->inisiatif == 'Baik Sekali' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td colspan="8" style="background-color:#feedbb"><b>KEPRIBADIAN</b></td>
        </tr>
        <tr>
            <td>Motivasi Berprestasi</td>
            <td>Kemampuan untuk menunjukkan dan meningkatkan prestasi serta upaya untuk mencapai hasil kerja yang optimal</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->motivasi_berprestasi == 'Kurang Sekali' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->motivasi_berprestasi == 'Kurang' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->motivasi_berprestasi == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->motivasi_berprestasi == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->motivasi_berprestasi == 'Baik' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->motivasi_berprestasi == 'Baik Sekali' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>Percaya Diri</td>
            <td>Keyakinan atas kemampuan yang dimiliki dalam berinteraksi sosial serta yakin pada keputusannya</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->percaya_diri == 'Kurang Sekali' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->percaya_diri == 'Kurang' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->percaya_diri == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->percaya_diri == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->percaya_diri == 'Baik' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->percaya_diri == 'Baik Sekali' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>Menyesuaikan Diri</td>
            <td>Kemampuan untuk menyesuaikan diri dengan lingkungan dan situasi yang berbeda</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->menyesuaikan_diri == 'Kurang Sekali' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->menyesuaikan_diri == 'Kurang' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->menyesuaikan_diri == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->menyesuaikan_diri == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->menyesuaikan_diri == 'Baik' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->menyesuaikan_diri == 'Baik Sekali' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>Stabilitas Emosi</td>
            <td>Mampu mengendalikan perasaan dan dorongan dalam diri, bereaksi tenang atas situasi dan masalah yang dihadapi</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->stabilitas_emosi == 'Kurang Sekali' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->stabilitas_emosi == 'Kurang' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->stabilitas_emosi == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->stabilitas_emosi == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->stabilitas_emosi == 'Baik' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->stabilitas_emosi == 'Baik Sekali' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>Kerjasama</td>
            <td>Kesediaan untuk aktif berpartisipasi dalam berkelompok</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->kerja_sama == 'Kurang Sekali' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->kerja_sama == 'Kurang' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->kerja_sama == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->kerja_sama == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->kerja_sama == 'Baik' ? $checked : '' !!}</td>
            <td align="center">{!! $laporan_psikologi_rekruitmen->kerja_sama == 'Baik Sekali' ? $checked : '' !!}</td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td width="70%">
                <table width="100%">
                    <tr>
                        <td colspan="2"><b>KESIMPULAN</b></td>
                    </tr>
                    <tr>
                        <td align="center" width="7%" style="border: 1px solid #000;">
                            {!! $laporan_psikologi_rekruitmen->kesimpulan == 'Disarankan' ? $checked : '' !!}
                        </td>
                        <td width="93%">Disarankan</td>
                    </tr>
                    <tr>
                        <td align="center" style="border: 1px solid #000;">
                            {!! $laporan_psikologi_rekruitmen->kesimpulan == 'Dipertimbangkan' ? $checked : '' !!}
                        </td>
                        <td>Dipertimbangkan</td>
                    </tr>
                    <tr>
                        <td align="center" style="border: 1px solid #000;">
                            {!! $laporan_psikologi_rekruitmen->kesimpulan == 'Tidak Disarankan' ? $checked : '' !!}
                        </td>
                        <td>Tidak Disarankan</td>
                    </tr>
                </table>
            </td>
            <td width="30%">
                <table width="100%" style="border: 1px solid #000;">
                    <tr>
                        <td colspan="3"><b>Keterangan</b></td>
                    </tr>
                    <tr>
                        <td width="10%">KS</td>
                        <td width="1%" align="center">:</td>
                        <td width="89%">Kurang Sekali</td>
                    </tr>
                    <tr>
                        <td>K</td>
                        <td align="center">:</td>
                        <td>Kurang</td>
                    </tr>
                    <tr>
                        <td>HC</td>
                        <td align="center">:</td>
                        <td>Hampir Cukup</td>
                    </tr>
                    <tr>
                        <td>C</td>
                        <td align="center">:</td>
                        <td>Cukup</td>
                    </tr>
                    <tr>
                        <td>B</td>
                        <td align="center">:</td>
                        <td>Baik</td>
                    </tr>
                    <tr>
                        <td>BS</td>
                        <td align="center">:</td>
                        <td>Baik Sekali</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div style="page-break-after: always;"></div>

    <table width="100%" class="bordered" cellpadding="3" style="margin-top: 15px;">
        <tr>
            <td align="center" style="background-color:#feedbb">
                <p style="font-size: 12"><b>LAPORAN HASIL EVALUSAI PSIKOLOGIS</b></p>
            </td>
        </tr>
        <tr>
            <td style="background-color:#feedbb"><b>URAIAN PSIKOLOGIS :</b></td>
        </tr>
        <tr>
            <td>
                <div class="word-break">
                    {!! nl2br(e($laporan_psikologi_rekruitmen->uraian_psikologis ?? "-")) !!}
                </div>
            </td>
        </tr>
        
        <tr>
            <td style="background-color:#feedbb"><b>KELEBIHAN :</b></td>
        </tr>
        <tr>
            <td>
                <div class="word-break">
                    {!! nl2br(e($laporan_psikologi_rekruitmen->kelebihan ?? "-")) !!}
                </div>
            </td>
        </tr>
        <tr>
            <td style="background-color:#feedbb"><b>KELEMAHAN :</b></td>
        </tr>
        <tr>
            <td>
                <div class="word-break">
                    {!! nl2br(e($laporan_psikologi_rekruitmen->kelemahan ?? "-")) !!}
                </div>
            </td>
        </tr>
        <tr>
            <td style="background-color:#feedbb"><b>SARAN :</b></td>
        </tr>
        <tr>
            <td>
                <div class="word-break">
                    {!! nl2br(e($laporan_psikologi_rekruitmen->saran ?? "-")) !!}
                </div>
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 25px;">
        <tr>
            <td width="60%"></td>
            <td width="40%" align="center">Surabaya, {{ !is_null($laporan_psikologi_rekruitmen->created_at) ? indonesian_date($laporan_psikologi_rekruitmen->created_at) : '_____________' }}</td>
        </tr>
        @if(isset($laporan_psikologi_rekruitmen->creator->ttd) && !empty($laporan_psikologi_rekruitmen->creator->ttd))
            <tr>
                <td></td>
                <td align="center" height="50"><img src="{{{url('')}}}/{{{$laporan_psikologi_rekruitmen->creator->ttd}}}" height="50px"></td>
            </tr>
        @else
            <tr>
                <td></td>
                <td align="center" height="50"></td>
            </tr>
        @endif
        <tr>
            <td></td>
            <td align="center">
                <p><u>{{$laporan_psikologi_rekruitmen->creator->name ?? '.........................................'}}</u></p>
            </td>
        </tr>
    </table>
@endsection

@section('scripts')
<script type="text/php">
    if (isset($pdf)) {
        $x = $pdf->get_width() - 395;
        $y = $pdf->get_height() - 34;
        $text = "Laporan Hasil Pemeriksaan Psikologi Rekruitmen - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$laporan_psikologi_rekruitmen->id.'}'}} | Halaman {PAGE_NUM} of {PAGE_COUNT}";
        $font = null;
        $size = 9;
        $color = array(0,0,0);
        $word_space = 0.0;
        $char_space = 0.0;
        $angle = 0.0;
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script> 
@endsection