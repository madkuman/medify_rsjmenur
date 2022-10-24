@extends('layouts.print')

@section('title')
Print Tes Minat Bakat - {{ $kasus->identitas->nama }}
@endsection

@section('css')
<style type="text/css">
    body, p {
        font-size: 12px;
        font-family: Arial, Helvetica, sans-serif;
        /*line-height: 16px;*/
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
        Bakat Minat Dewasa - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$bakat_minat_dewasa->id.'}'}} | Halaman <span class="pagenum"></span> of 2
    </div> --}}

    <table width="100%" align="center" style="border-bottom: 5px double #000;">
        <tr>
            <td width="100%" valign="top">
                <table width="100%" cellpadding="5">
                   <tr>
                        <td width="20%" align="right">
                            <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="80">
                        </td>
                        <td width="60%" align="center">
                            <p style="font-size: 14px;"><b>PEMERINTAH PROVINSI JAWA TIMUR</b></p>
                            <p style="font-size: 22px;"><b>RUMAH SAKIT JIWA MENUR</b></p>
                            <p style="font-size: 10px;">Jln. Menur No. 120, Telp. (031) 5021635, 5021637</p>
                        </td>
                        <td width="20%" align="left">
                            <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="80">
                        </td>
                   </tr> 
                </table>
            </td>
        </tr>
    </table>

    <table width="100%" cellpadding="5" style="margin-top: 15px;">
        <tr>
            <td width="90%"></td>
            <td width="15%" align="center" bgcolor="#000" style="border: 3px solid #d9d9d9;">
                <p style="font-size: 14px; color: #fff;"><b>rahasia</b></p>
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 15px;">
        <tr>
            <td align="center"><p style="font-size: 12"><b><u>LAPORAN HASIL PEMERIKSAAN PSIKOLOGI</u></b></p></td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 10px;" cellpadding="3">
        <tr>
            <td width="20%">Tujuan Tes</td>
            <td width="3%">:</td>
            <td width="77%">{{ $bakat_minat_dewasa->tujuan_tes ?? '-' }}</td>
        </tr>
        <tr>
            <td>No. RM</td>
            <td>:</td>
            <td>{{ $kasus->pasien->no_rm ?? '-' }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $kasus->identitas->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $kasus->identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <td>Tgl. Lahir / Usia</td>
            <td>:</td>
            <td>{{ indonesian_date($kasus->identitas->tanggal_lahir) ?? '-' }} / {{ $kasus->identitas->umur ?? '-' }} Tahun</td>
        </tr>
        <tr>
            <td>Pendidikan</td>
            <td>:</td>
            <td>{{ $kasus->pasien->pendidikan->nama ?? '-' }}</td>
        </tr>       
        <tr>
            <td>Status</td>
            <td>:</td>
            <td>
                @if($kasus->pasien->marriage == 1 ) Single
                @elseif($kasus->pasien->marriage == 2 ) Menikah
                @elseif($kasus->pasien->marriage == 3 ) Duda/Janda
                @else -
                @endif
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $kasus->identitas->alamat ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tanggal Pemeriksaan</td>
            <td>:</td>
            <td>{{ indonesian_date($bakat_minat_dewasa->tanggal_pemeriksaan) ?? '-' }}</td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 20px;">
        <tr>
            <td>
                <p>Berdasarkan pemeriksaan yang telah dilakukan pada hari {{ trim(indonesian_date($bakat_minat_dewasa->tanggal_pemeriksaan, 'l')) }}, tanggal {{ trim(indonesian_date($bakat_minat_dewasa->tanggal_pemeriksaan)) }}, maka dapat diketahui <b><u>bahwa pada saat ini :</u></b></p>
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 20px;">
        <tr>
            <td align="center"><p style="font-size: 13px;"><b>PSIKOGRAM</b></td>
        </tr>
    </table>

    @php 
        $checked = '<div style="font-family: ZapfDingbats, sans-serif;">4</div>';
    @endphp

    <table width="100%" class="bordered" cellpadding="3" style="margin-top: 15px;">
        <tr>
            <th rowspan="2" colspan="2" align="center">ASPEK-ASPEK</th>
            <th colspan="6" align="center">KRITERIA</th>
        </tr>
        <tr>
            <th align="center">SR</th>
            <th align="center">R</th>
            <th align="center">HC</th>
            <th align="center">C</th>
            <th align="center">T</th>
            <th align="center">ST</th>
        </tr>
        <tr>
            <td colspan="8" align="center"><b>A. ASPEK INTELEGENSI</b></td>
        </tr>
        <tr>
            <td>a. Intelegensi Umum</td>
            <td>Kemampuan untuk memahami dan mengkaji persoalan / permasalahan dan kemudian merespon sesuai tuntutan yang ada</td>
            <td align="center">{!! $bakat_minat_dewasa->intelegensi_umum == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->intelegensi_umum == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->intelegensi_umum == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->intelegensi_umum == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->intelegensi_umum == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->intelegensi_umum == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>b. Daya Nalar</td>
            <td>Kemampuan berpikir logis dengan mengarahkan pikiran dan perhatian pada suatu persoalan serta dapat membedakan hal-hal penting dan tidak penting</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_nalar == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_nalar == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_nalar == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_nalar == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_nalar == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_nalar == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>c. Daya Analisa Sintesa</td>
            <td>Kemampuan menguraikan persoalan dan menangkap aspek-aspek terkait dengan memahami esensi persoalan</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_analisa_sintesa == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_analisa_sintesa == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_analisa_sintesa == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_analisa_sintesa == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_analisa_sintesa == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_analisa_sintesa == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>d. Fleksibilitas Berpikir</td>
            <td>Kemampuan untuk dapat menemukan berbagai alternatif pemecahan masalah dengan, cepat, lancar, disertai kelincahan berpikir agar bisa mencari jalan keluar yang efektif jika mendapat hambatan</td>
            <td align="center">{!! $bakat_minat_dewasa->fleksibilitas_berpikir == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->fleksibilitas_berpikir == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->fleksibilitas_berpikir == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->fleksibilitas_berpikir == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->fleksibilitas_berpikir == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->fleksibilitas_berpikir == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>e. Daya Ingat</td>
            <td>Kemampuan untuk mengingat informasi dan menghasilkan pemikiran yang konvergen</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_ingat == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_ingat == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_ingat == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_ingat == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_ingat == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_ingat == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>

        <tr>
            <td colspan="8" align="center"><b>B. SIKAP & CARA KERJA</b></td>
        </tr>
        <tr>
            <td>a. Kecepatan Kerja</td>
            <td>Sikap Kerja yang mencerminkan usaha untuk melakukan secepat mungkin penyelesaian tugas, sehingga mampu menghasilkan produktivitas tinggi</td>
            <td align="center">{!! $bakat_minat_dewasa->kecepatan_kerja == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kecepatan_kerja == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kecepatan_kerja == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kecepatan_kerja == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kecepatan_kerja == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kecepatan_kerja == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>b. Ketelitian</td>
            <td>Sikap Kerja yang mencerminkan usaha untuk melakukan sebaik dan setepat mungkin dengan tidak banyak membuat kesalahan</td>
            <td align="center">{!! $bakat_minat_dewasa->ketelitian == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->ketelitian == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->ketelitian == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->ketelitian == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->ketelitian == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->ketelitian == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>c. Daya Tahan Kerja</td>
            <td>Kemampuan untuk menghasilkan kerja tetap stabil meski ada tekanan beban kerja yang berlebih atau waktu kerja yang terbatas</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_tahan_kerja == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_tahan_kerja == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_tahan_kerja == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_tahan_kerja == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_tahan_kerja == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->daya_tahan_kerja == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>

        <tr>
            <td colspan="8" align="center"><b>C. ASPEK KEPRIBADIAN</b></td>
        </tr>
        <tr>
            <td>a. Stabilitas Emosi</td>
            <td>Kemampuan individu untuk mengolah emosi sehingga tidak mudah terbawa emosi dan mampu mengekspresikan emosi dengan tepat sehingga dapat diterima oleh diri dan lingkungannya</td>
            <td align="center">{!! $bakat_minat_dewasa->stabilitas_emosi == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->stabilitas_emosi == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->stabilitas_emosi == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->stabilitas_emosi == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->stabilitas_emosi == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->stabilitas_emosi == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>b. Penyesuaian Diri</td>
            <td>Kemampuan untuk beradaptasi dengan lingkungan baru maupun orang yang baru dikenal</td>
            <td align="center">{!! $bakat_minat_dewasa->penyesuaian_diri == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->penyesuaian_diri == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->penyesuaian_diri == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->penyesuaian_diri == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->penyesuaian_diri == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->penyesuaian_diri == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>c. Motivasi, Dorongan & Ambisi</td>
            <td>Dorongan atau keinginan untuk selalu mencapai prestasi yang terbaik, siap menghadapi tantangan serta mau belajar dan berusaha</td>
            <td align="center">{!! $bakat_minat_dewasa->motivasi_dorongan_ambisi == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->motivasi_dorongan_ambisi == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->motivasi_dorongan_ambisi == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->motivasi_dorongan_ambisi == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->motivasi_dorongan_ambisi == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->motivasi_dorongan_ambisi == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>d. Kerja Sama</td>
            <td>Kemampuan dan kemauan seseorang untuk berperan serta dalam bekerja secara efektif dan mencapai tujuan kelompok</td>
            <td align="center">{!! $bakat_minat_dewasa->kerja_sama == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kerja_sama == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kerja_sama == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kerja_sama == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kerja_sama == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kerja_sama == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>

        <tr>
            <td colspan="8" align="center"><b>D. ASPEK BAKAT DAN KEMAMPUAN</b></td>
        </tr>
        <tr>
            <td>a. Kemampuan Verbal</td>
            <td>Kemampuan berpikir semantik dan pemahaman terhadap konsep-konsep bahasa</td>
            <td align="center">{!! $bakat_minat_dewasa->kemampuan_verbal == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kemampuan_verbal == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kemampuan_verbal == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kemampuan_verbal == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kemampuan_verbal == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kemampuan_verbal == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
        <tr>
            <td>b. Kemampuan Numerik</td>
            <td>Kemampuan menggunakan konsep dasar numerik dan pemahaman terhadap konsep-konsep hitungan</td>
            <td align="center">{!! $bakat_minat_dewasa->kemampuan_numerik == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kemampuan_numerik == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kemampuan_numerik == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kemampuan_numerik == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kemampuan_numerik == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $bakat_minat_dewasa->kemampuan_numerik == 'Sangat Tinggi' ? $checked : '' !!}</td>
        </tr>
    </table>

    @php
        $minat = json_decode($bakat_minat_dewasa->minat);
    @endphp

    <table class="" width="100%" style="margin-top: 20px;" cellpadding="5">
        <tr>
            <td>Kesimpulan :</td>
        </tr>
        <tr>
            <td style="padding-bottom: 20px;">
                <div class="word-break">
                    {!! nl2br(e($bakat_minat_dewasa->kesimpulan ?? '-')) !!}
                </div>
            </td>
        </tr>
        @foreach($minat as $item)
        <tr>
            <td>Minat {{$loop->iteration}} : {{ $item }}</td>
        </tr>
        @endforeach
    </table>

    {{-- <table width="100%" cellpadding="3">
        <tr>
            <td><b>Keterangan</b></td>
        </tr>
        <tr>
            <td>SR: Sangat Rendah</td>
            <td>R: Rendah</td>
            <td>HC: Hampir Cukup</td>
            <td>C: Cukup</td>
            <td>T: Tinggi</td>
            <td>ST: Sangat Tinggi</td>
        </tr>
    </table> --}}

    <table width="100%" style="margin-top: 25px;">
        <tr>
            <td width="60%"></td>
            <td width="40%" align="center">Surabaya,  {{ indonesian_date($bakat_minat_dewasa->created_at) ?? '-' }}</td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>Psikolog</b></td>
        </tr>
        @if(isset($bakat_minat_dewasa->creator->ttd) && !empty($bakat_minat_dewasa->creator->ttd))
            <tr>
                <td></td>
                <td align="center" height="50"><img src="{{{url('')}}}/{{{$bakat_minat_dewasa->creator->ttd}}}" height="50px"></td>
            </tr>
        @else
            <tr>
                <td></td>
                <td align="center" height="50"></td>
            </tr>
        @endif
        <tr>
            <td></td>
            <td align="center">{{$bakat_minat_dewasa->creator->name ?? '.........................................'}}</td>
        </tr>
    </table>
@endsection

@section('scripts')
<script type="text/php">
    if (isset($pdf)) {
        $x = $pdf->get_width() - 280;
        $y = $pdf->get_height() - 34;
        $text = "Bakat Minat Dewasa - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$bakat_minat_dewasa->id.'}'}} | Halaman {PAGE_NUM} of {PAGE_COUNT}";
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