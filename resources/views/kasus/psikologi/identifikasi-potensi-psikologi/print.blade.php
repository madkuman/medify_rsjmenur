@extends('layouts.print')

@section('title')
{{$kasus->identitas->nama}} - Print Identifikasi Potensi Psikologi
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
        Identifikasi Potensi Psikologi - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$identifikasi_potensi_psikologi->id.'}'}} | Halaman <span class="pagenum"></span> of 1
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

    <table width="100%" style="margin-top: 15px;">
        <tr>
            <td align="center"><p style="font-size: 12"><b>HASIL EVALUASI PSIKOLOGI</b></p></td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 15px;" cellpadding="3">
        <tr>
            <td colspan="3"><b><u>IDENTITAS</u></b></td>
        </tr>
        <tr>
            <td width="23%">Nama</td>
            <td width="2%">:</td>
            <td width="76%">{{ $kasus->identitas->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $kasus->identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <td>Umur</td>
            <td>:</td>
            <td>{{ $kasus->identitas->umur ?? '-' }}</td>
        </tr>
        
        <tr>
            <td>Pendidikan</td>
            <td>:</td>
            <td>{{ $kasus->pasien->pendidikan->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tanggal Pemeriksaan</td>
            <td>:</td>
            <td>{{ indonesian_date($identifikasi_potensi_psikologi->tanggal_pemeriksaan) }}</td>
        </tr>
        <tr>
            <td>Tujuan Pemeriksaan</td>
            <td>:</td>
            <td>{{ $identifikasi_potensi_psikologi->tujuan_pemeriksaan ?? '-' }}</td>
        </tr>
        <tr>
            <td>Rujukan</td>
            <td>:</td>
            <td>{{ $identifikasi_potensi_psikologi->rujukan ?? '-' }}</td>
        </tr>
    </table>

    <table width="100%" style="margin-top:20px;" cellpadding="5">
        <tr>
            <td><b><u>HASIL</u></b></td>
        </tr>
        <tr>
            <td>
                <div class="word-break">
                    {!! nl2br(e($identifikasi_potensi_psikologi->hasil ?? '-')) !!}
                </div>
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 15px;">
        <tr>
            <td width="60%"></td>
            <td width="40%" align="center">Surabaya, {{ indonesian_date($identifikasi_potensi_psikologi->created_at) }}</td>
        </tr>
        <tr>
            <td></td>
            <td align="center">Pemeriksa,</td>
        </tr>
        @if(isset($identifikasi_potensi_psikologi->creator->ttd) && !empty($identifikasi_potensi_psikologi->creator->ttd))
            <tr>
                <td></td>
                <td align="center" height="50"><img src="{{{url('')}}}/{{{$identifikasi_potensi_psikologi->creator->ttd}}}" height="50px"></td>
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
                <p><u>{{$identifikasi_potensi_psikologi->dokterPemeriksa->name ?? '.........................................'}}</u></p>
                {{-- <p>NIP. 3050103198227361</p> --}}
            </td>
        </tr>
    </table>
@endsection

@section('scripts')
<script type="text/php">
    if (isset($pdf)) {
        $x = $pdf->get_width() - 310;
        $y = $pdf->get_height() - 34;
        $text = "Identifikasi Potensi Psikologi - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$identifikasi_potensi_psikologi->id.'}'}} | Halaman {PAGE_NUM} of {PAGE_COUNT}";
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