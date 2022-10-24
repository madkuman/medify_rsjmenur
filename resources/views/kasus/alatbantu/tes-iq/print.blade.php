@extends('layouts.print')

@section('title')
Print TES IQ - {{$kasus->identitas->nama}}
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
        Tes IQ - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$tes_iq->id.'}'}} | Halaman <span class="pagenum"></span> of 1
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

    <table width="100%" cellpadding="5" style="margin-top: 10px;">
        <tr>
            <td width="90%"></td>
            <td width="15%" align="center" bgcolor="#000" style="border: 3px solid #d9d9d9;">
                <p style="font-size: 14px; color: #fff;"><b>RAHASIA</b></p>
            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td align="center"><p style="font-size: 13"><b><u>LAPORAN HASIL PEMERIKSAAN PSIKOLOGI</u></b></p></td>
        </tr>
    </table>

    <table width="100%" cellpadding="3" style="margin-top: 10px;">
        <tr>
            <td width="20%">Nama</td>
            <td width="2%">:</td>
            <td width="32%"><b>{{ $kasus->identitas->nama ?? '-' }}</b></td>
            <td width="12%">Tujuan Tes</td>
            <td width="2%">:</td>
            <td width="32%">{{ $tes_iq->tujuan_tes ?? '-' }}</td>
        </tr>
        <tr>
            <td>Nomor RM</td>
            <td>:</td>
            <td><b>{{ $kasus->pasien->no_rm ?? '-' }}</b></td>
            <td>Pendidikan</td>
            <td>:</td>
            <td>{{ $kasus->pasien->pendidikan->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $kasus->identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $kasus->identitas->alamat ?? '-' }}</td>
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
            <td>Rujukan dari</td>
            <td>:</td>
            <td>{{ $tes_iq->rujukan_dari }}</td>
        </tr>
        <tr>
            <td>Usia</td>
            <td>:</td>
            <td>{{ $kasus->identitas->umur ?? '-' }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 10px;">
        <tr>
            <td>
                <p>Berdasarkan pemeriksaan yang telah dilakukan pada hari {{ !is_null($tes_iq->tanggal_pemeriksaan) ? trim(indonesian_date($tes_iq->tanggal_pemeriksaan, 'l')) : '_____________' }}, tanggal {{ !is_null($tes_iq->tanggal_pemeriksaan) ? trim(indonesian_date($tes_iq->tanggal_pemeriksaan)) : '_________________'}}, maka dapat diketahui <b>bahwa pada saat ini:</b>
                </p>
            </td>
        </tr>
    </table>

    <table class="" align="center" width="70%" cellpadding="5" style="margin-top: 10px;">
        <tr>
            <td align="center">
                <div style="border: 1px solid #000; padding: 5px;">
                <p style="font-size: 13px;">Kemampuan Intelektual Berfungsi pada Taraf : <b>{{ $tes_iq->kemampuan_intelektual ?? '-' }}</b>
                </p>
                </div>
            </td>
        </tr>
    </table>

    @php 
		$checked = '<div style="font-family: ZapfDingbats, sans-serif;">4</div>';
	@endphp

    <table width="100%" class="bordered" cellpadding="3" style="table-layout: fixed;">
        <tr>
            <th align="center" colspan="2">Aspek Psikologis</th>
            <th align="center">Gambaran Individu <br> (Skor Rendah)</th>
            <th align="center">SR</th>
            <th align="center">R</th>
            <th align="center">HC</th>
            <th align="center">C</th>
            <th align="center">T</th>
            <th align="center">ST</th>
            <th align="center">Gambaran Individu <br> (Skor Tinggi)</th>
        </tr>
        <tr>
            <td width="5%" rowspan="4" align="center"><p style="transform: rotate(-90deg);">Intelegensi</p></td>
            <td width="15%">Kecerdasan Umum</td>
            <td width="28%">Ketidakmampuan untuk memahami &  mengkaji persoalan serta memberikan respon yang sesuai</td>
            <td width="4%" align="center">{!! $tes_iq->kecerdasan_umum == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td width="4%" align="center">{!! $tes_iq->kecerdasan_umum == 'Rendah' ? $checked : '' !!}</td>
            <td width="4%" align="center">{!! $tes_iq->kecerdasan_umum == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td width="4%" align="center">{!! $tes_iq->kecerdasan_umum == 'Cukup' ? $checked : '' !!}</td>
            <td width="4%" align="center">{!! $tes_iq->kecerdasan_umum == 'Tinggi' ? $checked : '' !!}</td>
            <td width="4%" align="center">{!! $tes_iq->kecerdasan_umum == 'Sangat Tinggi' ? $checked : '' !!}</td>
            <td width="28%">Kemampuan yang sangat baik untuk memahami & mengkaji persoalan serta memberikan respon yang sesuai</td>
        </tr>
        <tr>
            <td>Fleksibilitas Berpikir</td>
            <td>Ketidakmampuan untuk menemukan alternatif pemecahan masalah dengan cepat, lancar untuk mencari jalan keluar yang efektif ketika menghadapi hambatan</td>
            <td align="center">{!! $tes_iq->fleksibilitas_berpikir == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $tes_iq->fleksibilitas_berpikir == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $tes_iq->fleksibilitas_berpikir == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $tes_iq->fleksibilitas_berpikir == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $tes_iq->fleksibilitas_berpikir == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $tes_iq->fleksibilitas_berpikir == 'Sangat Tinggi' ? $checked : '' !!}</td>
            <td>Kemampuan yang sangat baik untuk menemukan alternatif pemecahan masalah dengan cepat, lancar, untuk mencari jalan keluar yang efektif ketika menghadapi hambatan</td>
        </tr>
        <tr>
            <td>Analisa Sintesa</td>
            <td>Ketidakmampuan untuk  menguraikan persoalan & menangkap aspek-aspek terkait dengan memahami esensinya</td>
            <td align="center">{!! $tes_iq->analisa_sintesa == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $tes_iq->analisa_sintesa == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $tes_iq->analisa_sintesa == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $tes_iq->analisa_sintesa == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $tes_iq->analisa_sintesa == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $tes_iq->analisa_sintesa == 'Sangat Tinggi' ? $checked : '' !!}</td>
            <td>Kemampuan yang sangat baik untuk menguraikan persoalan & menangkap aspek-aspek terkait dengan memahami esensinya</td>
        </tr>
        <tr>
            <td>Berpikir Konseptual</td>
            <td>Ketidakmampuan untuk mengidentifikasi pola/hubungan antar situasi, menyimpulkan berbagai informasi, & menciptakan konsep baru</td>
            <td align="center">{!! $tes_iq->berpikir_konseptual == 'Sangat Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $tes_iq->berpikir_konseptual == 'Rendah' ? $checked : '' !!}</td>
            <td align="center">{!! $tes_iq->berpikir_konseptual == 'Hampir Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $tes_iq->berpikir_konseptual == 'Cukup' ? $checked : '' !!}</td>
            <td align="center">{!! $tes_iq->berpikir_konseptual == 'Tinggi' ? $checked : '' !!}</td>
            <td align="center">{!! $tes_iq->berpikir_konseptual == 'Sangat Tinggi' ? $checked : '' !!}</td>
            <td>Kemampuan yang sangat baik untuk mengidentifikasi pola/hubungan antar situasi, menyimpulkan berbagai informasi, & menciptakan konsep baru</td>
        </tr>
        <tr>
        	<td colspan="10">
        		<p>Kesimpulan :</p>
                <div class="word-break">
                    {!! nl2br(e($tes_iq->kesimpulan ?? '-')) !!}
                </div>
        	</td>
        </tr>
    </table>

    <table width="100%" cellpadding="2" style="margin-top: 10px;">
        <tr>
            <td width="60%"></td>
            <td width="40%" style="border: 1px solid #000; border-radius: 10px;">
                <table width="100%">
                    <tr>
                        <td colspan="4" align="center"><b><u>Keterangan</u></b></td>
                    </tr>
                    <tr>
                        <td>SR</td>
                        <td>: Sangat Rendah</td>
                        <td>R</td>
                        <td>: Rendah</td>
                    </tr>
                    <tr>
                        <td>HC</td>
                        <td>: Hampir Cukup</td>
                        <td>C</td>
                        <td>: Cukup</td>
                    </tr>
                    <tr>
                        <td>T</td>
                        <td>: Tinggi</td>
                        <td>ST</td>
                        <td>: Sangat Tinggi</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 20px;">
        <tr>
            <td width="60%"></td>
            <td width="40%" align="center">Surabaya, {{ !is_null($tes_iq->created_at) ? indonesian_date($tes_iq->created_at) : '_____________' }}</td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>Psikolog</b></td>
        </tr>
        @if(isset($tes_iq->creator->ttd) && !empty($tes_iq->creator->ttd))
            <tr>
                <td></td>
                <td align="center" height="50"><img src="{{{url('')}}}/{{{$tes_iq->creator->ttd}}}" height="50px"></td>
            </tr>
        @else
            <tr>
                <td></td>
                <td align="center" height="50"></td>
            </tr>
        @endif
        <tr>
            <td></td>
            <td align="center">({{$tes_iq->creator->name ?? '.........................................'}})</td>
        </tr>
    </table>
@endsection

@section('scripts')
<script type="text/php">
    if (isset($pdf)) {
        $x = $pdf->get_width() - 230;
        $y = $pdf->get_height() - 34;
        $text = "Tes IQ - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$tes_iq->id.'}'}} | Halaman {PAGE_NUM} of {PAGE_COUNT}";
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