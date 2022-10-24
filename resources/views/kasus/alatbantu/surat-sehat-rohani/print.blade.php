@extends('layouts.print')

@section('title')
Print Surat Sehat Rohani - {{$kasus->identitas->nama}}
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
    table.border-bottom td {
        border-bottom: 1px solid #000;
        border-top: none;
        border-left: none;
        border-right: none;
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
        Surat Sehat Rohani - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$surat_sehat_rohani->id.'}'}} | Halaman <span class="pagenum"></span> of 1
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

    <table class="bordered border-bottom" width="100%" style="margin-top: 10px;" cellpadding="5">
        <tr>
            <td width="22%">Nama</td>
            <td width="3%">:</td>
            <td width="30%">{{ $kasus->identitas->nama ?? '-' }}</td>
            <td width="12%">Tujuan Tes</td>
            <td width="3%">:</td>
            <td width="30%">{{ $surat_sehat_rohani->tujuan_tes ?? '-' }}</td>
        </tr>
        <tr>
            <td>Nomor RM</td>
            <td>:</td>
            <td>{{ $kasus->pasien->no_rm ?? '-' }}</td>
            <td>Keperluan</td>
            <td>:</td>
            <td>{{ $surat_sehat_rohani->keperluan ?? '-' }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $kasus->identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            <td>Pendidikan</td>
            <td>:</td>
            <td>{{ $kasus->pasien->pendidikan->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td>Status Pernikahan</td>
            <td>:</td>
            <td>
                @if($kasus->pasien->marriage == 1 ) Single
                @elseif($kasus->pasien->marriage == 2 ) Menikah
                @elseif($kasus->pasien->marriage == 3 ) Duda/Janda
                @else -
                @endif
            </td>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $kasus->identitas->alamat ?? '-' }}</td>
        </tr>
        <tr>
            <td>Usia</td>
            <td>:</td>
            <td>{{ $kasus->identitas->umur ?? '-' }}</td>
            <td>Rujukan dari</td>
            <td>:</td>
            <td>{{ $surat_sehat_rohani->rujukan_dari ?? '-' }}</td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 10px;">
        <tr>
            <td><p>Berdasarkan pemeriksaan yang telah dilakukan pada hari {{!is_null($surat_sehat_rohani->tanggal) ? indonesian_date($surat_sehat_rohani->tanggal, 'l') : '_____________'}}, tanggal {{!is_null($surat_sehat_rohani->tanggal) ? indonesian_date($surat_sehat_rohani->tanggal) : '_____________'}}, maka dapat diketahui <b>bahwa pada saat ini :</b></p></td>
        </tr>
    </table>

    <table class="bordered" align="center" width="60%" cellpadding="5" style="margin-top: 15px;">
        <tr>
            <td align="center"><p style="font-size: 13px;">Kemampuan Intelektual Berfungsi pada Taraf : <b>{{ $surat_sehat_rohani->kemampuan_intelektual ?? '-' }}</b></p></td>
        </tr>
    </table>

    @php 
        $checked = '<div style="font-family: ZapfDingbats, sans-serif;">4</div>';
    @endphp

    <table width="100%" class="bordered" cellpadding="3">
        <tr>
            <th align="center" colspan="2">Aspek Psikologis</th>
            <th align="center">Gambaran Individu (Skor Rendah)</th>
            <th align="center">SR</th>
            <th align="center">R</th>
            <th align="center">HC</th>
            <th align="center">C</th>
            <th align="center">T</th>
            <th align="center">ST</th>
            <th align="center">Gambaran Individu (Skor Tinggi)</th>
        </tr>
        <tr>
            <td rowspan="5" align="center"><p style="transform: rotate(-90deg);">Intelegensi</p></td>
            <td>Kecerdasan Umum</td>
            <td>Ketidakmampuan untuk memahami &  mengkaji persoalan serta memberikan respon yang sesuai</td>
            <td align="center">{!! $surat_sehat_rohani->kecerdasan_umum == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kecerdasan_umum == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kecerdasan_umum == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kecerdasan_umum == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kecerdasan_umum == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kecerdasan_umum == 'Sangat Tinggi' ? $checked : '' !!}</td>
            <td>Kemampuan yang sangat baik untuk memahami & mengkaji persoalan serta memberikan respon yang sesuai</td>
        </tr>
        <tr>
            <td>Fleksibilitas Berpikir</td>
            <td>Ketidakmampuan untuk menemukan alternatif pemecahan masalah dengan cepat, lancar untuk mencari jalan keluar yang efektif ketika menghadapi hambatan</td>
            <td align="center">{!! $surat_sehat_rohani->fleksibilitas_berpikir == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->fleksibilitas_berpikir == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->fleksibilitas_berpikir == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->fleksibilitas_berpikir == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->fleksibilitas_berpikir == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->fleksibilitas_berpikir == 'Sangat Tinggi' ? $checked : '' !!}</td>
            <td>Kemampuan yang sangat baik untuk menemukan alternatif pemecahan masalah dengan cepat, lancar, untuk mencari jalan keluar yang efektif ketika menghadapi hambatan</td>
        </tr>
        <tr>
            <td>Sistematika Berpikir</td>
            <td>Kurang sistematis dalam berpikir</td>
            <td align="center">{!! $surat_sehat_rohani->sistematika_berpikir == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->sistematika_berpikir == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->sistematika_berpikir == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->sistematika_berpikir == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->sistematika_berpikir == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->sistematika_berpikir == 'Sangat Tinggi' ? $checked : '' !!}</td>
            <td>Sistematis dalam berpikir</td>
        </tr>
        <tr>
            <td>Analisa Sintesa</td>
            <td>Ketidakmampuan untuk  menguraikan persoalan & menangkap aspek-aspek terkait dengan memahami esensinya</td>
            <td align="center">{!! $surat_sehat_rohani->analisa_sintesa == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->analisa_sintesa == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->analisa_sintesa == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->analisa_sintesa == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->analisa_sintesa == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->analisa_sintesa == 'Sangat Tinggi' ? $checked : '' !!}</td>
            <td>Kemampuan yang sangat baik untuk menguraikan persoalan & menangkap aspek-aspek terkait dengan memahami esensinya</td>
        </tr>
        <tr>
            <td>Berpikir Konseptual</td>
            <td>Ketidakmampuan untuk mengidentifikasi pola/hubungan antar situasi, menyimpulkan berbagai informasi, & menciptakan konsep baru</td>
            <td align="center">{!! $surat_sehat_rohani->berpikir_konseptual == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->berpikir_konseptual == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->berpikir_konseptual == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->berpikir_konseptual == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->berpikir_konseptual == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->berpikir_konseptual == 'Sangat Tinggi' ? $checked : '' !!}</td>
            <td>Kemampuan yang sangat baik untuk mengidentifikasi pola/hubungan antar situasi, menyimpulkan berbagai informasi, & menciptakan konsep baru</td>
        </tr>

        <tr>
            <td rowspan="5" align="center"><p style="transform: rotate(-90deg);">Sosiabilitas & Emosi</p></td>
            <td>Stabilitas Emosi</td>
            <td>Ketidakmampuan untuk mengendalikan perasaan & mudah panik / reaktif dalam menghadapi tekanan</td>
            <td align="center">{!! $surat_sehat_rohani->stabilitas_emosi == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->stabilitas_emosi == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->stabilitas_emosi == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->stabilitas_emosi == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->stabilitas_emosi == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->stabilitas_emosi == 'Sangat Tinggi' ? $checked : '' !!}</td>
            <td>Kemampuan yang sangat baik untuk mengendalikan perasaan & tidak mudah panik / reaktif dalam menghadapi tekanan</td>
        </tr>
        <tr>
            <td>Kerja Sama</td>
            <td>Ketidakmampuan untuk menjalin hubungan kerja / sosialisasi dalam suatu tim untuk mencapai tujuan bersama</td>
            <td align="center">{!! $surat_sehat_rohani->kerja_sama == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kerja_sama == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kerja_sama == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kerja_sama == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kerja_sama == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kerja_sama == 'Sangat Tinggi' ? $checked : '' !!}</td>
            <td>Kemampuan yang sangat baik untuk menjalin hubungan kerja / sosialisasi dalam suatu tim untuk mencapai tujuan bersama</td>
        </tr>
        <tr>
            <td>Kepekaan Sosial</td>
            <td>Ketidakmampuan untuk mengenali kebutuhan & perasaan orang lain serta menindaklanjuti respon</td>
            <td align="center">{!! $surat_sehat_rohani->kepekaan_sosial == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kepekaan_sosial == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kepekaan_sosial == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kepekaan_sosial == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kepekaan_sosial == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kepekaan_sosial == 'Sangat Tinggi' ? $checked : '' !!}</td>
            <td>Kemampuan yang sangat baik untuk mengenali kebutuhan & perasaan orang lain serta menindaklanjuti respon</td>
        </tr>
        <tr>
            <td>Kemampuan Adaptasi</td>
            <td>Kaku, kurang luwes, membutuhkan waktu yang lama untuk menyesuaikan diri</td>
            <td align="center">{!! $surat_sehat_rohani->kemampuan_adaptasi == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kemampuan_adaptasi == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kemampuan_adaptasi == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kemampuan_adaptasi == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kemampuan_adaptasi == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->kemampuan_adaptasi == 'Sangat Tinggi' ? $checked : '' !!}</td>
            <td>Mampu menyesuaikan diri dengan perubahan situasi</td>
        </tr>
        <tr>
            <td>Motivasi</td>
            <td>Tidak mempunyai dorongan / keinginan untuk selalu mencapai prestasi terbaik, tidak siap menghadapi tantangan, tidak mau belajar & berusaha</td>
            <td align="center">{!! $surat_sehat_rohani->motivasi == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->motivasi == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->motivasi == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->motivasi == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->motivasi == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $surat_sehat_rohani->motivasi == 'Sangat Tinggi' ? $checked : '' !!}</td>
            <td>Mempunyai dorongan / keinginan yang kuat untuk selalu mencapai prestasi terbaik, siap menghadapi tantangan,  mau belajar & berusaha</td>
        </tr>
    </table>

    <table width="100%" cellpadding="3" style="margin-top: 20px;">
        <tr>
            <td></td>
            <td colspan="4" align="center"><b><u>Keterangan</u></b></td>
        </tr>
        <tr>
            <td width="60%"></td>
            <td width="5%">SR</td>
            <td width="15%">: Sangat Rendah</td>
            <td width="5%">R</td>
            <td width="15%">: Rendah</td>
        </tr>
        <tr>
            <td></td>
            <td>HC</td>
            <td>: Hampir Cukup</td>
            <td>C</td>
            <td>: Cukup</td>
        </tr>
        <tr>
            <td></td>
            <td>T</td>
            <td>: Tinggi</td>
            <td>ST</td>
            <td>: Sangat Tinggi</td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 35px;">
        <tr>
            <td width="60%"></td>
            <td width="40%" align="center">Surabaya, {{ !is_null($surat_sehat_rohani->created_at) ? indonesian_date($surat_sehat_rohani->created_at) : '_____________' }}</td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>Psikolog</b></td>
        </tr>
        @if(isset($surat_sehat_rohani->creator->ttd) && !empty($surat_sehat_rohani->creator->ttd))
            <tr>
                <td></td>
                <td align="center" height="50"><img src="{{{url('')}}}/{{{$surat_sehat_rohani->creator->ttd}}}" height="50px"></td>
            </tr>
        @else
            <tr>
                <td></td>
                <td align="center" height="50"></td>
            </tr>
        @endif
        <tr>
            <td></td>
            <td align="center">({{$surat_sehat_rohani->creator->name ?? '.........................................'}})</td>
        </tr>
    </table>
@endsection

@section('scripts')
<script type="text/php">
    if (isset($pdf)) {
        $x = $pdf->get_width() - 280;
        $y = $pdf->get_height() - 34;
        $text = "Surat Sehat Rohani - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$surat_sehat_rohani->id.'}'}} | Halaman {PAGE_NUM} of {PAGE_COUNT}";
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