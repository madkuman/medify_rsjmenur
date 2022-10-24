@extends('layouts.print')

@section('title')
Print DESKRIPSI - {{$kasus->identitas->nama}}
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
    .footer {
        width: 100%;
        text-align: right;
        position: fixed;
        bottom: 0px;
    }
    .pagenum:before {
        content: counter(page);
    }
    .text-bold {
        font-weight: bold;
    }
</style>
@endsection

@section('content')
    {{-- <div class="footer">
        Pemeriksaan Psikologi Visum - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$pemeriksaan_psikologi_visum->id.'}'}} | Halaman <span class="pagenum"></span> of 1
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

    <table width="100%" style="margin-top: 15px;" cellpadding="3">
    	<tr>
    		<td colspan="3"><b><u>IDENTITAS</u></b></td>
    	</tr>
        <tr>
            <td width="23%">NAMA</td>
            <td width="2%">:</td>
            <td width="76%"><b>{{ $kasus->identitas->nama ?? '-' }}</b></td>
        </tr>
        <tr>
            <td>NOMOR RM</td>
            <td>:</td>
            <td><b>{{ $kasus->pasien->no_rm ?? '-' }}</b></td>
        </tr>
        <tr>
            <td>USIA</td>
            <td>:</td>
            <td>{{ $kasus->identitas->umur ?? '-' }}</td>
        </tr>
        <tr>
            <td>JENIS KELAMIN</td>
            <td>:</td>
            <td>{{ $kasus->identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <td>PENDIDIKAN</td>
            <td>:</td>
            <td>{{ $kasus->pasien->pendidikan->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td>STATUS PERNIKAHAN</td>
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
            <td>TUJUAN PEMERIKSAAN</td>
            <td>:</td>
            <td>{{ $pemeriksaan_psikologi_visum->tujuan_pemeriksaan ?? '_____________' }}</td>
        </tr>
        <tr>
            <td>TANGGAL PEMERIKSAAN</td>
            <td>:</td>
            <td>{{ !is_null($pemeriksaan_psikologi_visum->tanggal_pemeriksaan) ? indonesian_date($pemeriksaan_psikologi_visum->tanggal_pemeriksaan) : '_____________' }}</td>
        </tr>
    </table>

    <table width="100%" style="margin-top:20px;" cellpadding="5">
    	<tr>
    		<td><b><u>HASIL</u></b></td>
    	</tr>
        <tr>
            <td><p><b>Berdasarkan pemeriksaan yang telah dilakukan pada hari {{ !is_null($pemeriksaan_psikologi_visum->tanggal_pemeriksaan) ? indonesian_date($pemeriksaan_psikologi_visum->tanggal_pemeriksaan, 'l') : '_____________' }}, tanggal {{ !is_null($pemeriksaan_psikologi_visum->tanggal_pemeriksaan) ? indonesian_date($pemeriksaan_psikologi_visum->tanggal_pemeriksaan) : '_________________'}}, maka dapat diketahui <u>bahwa pada saat ini :</u></b></p></td>
        </tr>
        <tr>
        	<td>
        		{!! $pemeriksaan_psikologi_visum->hasil ?? '-' !!}
        	</td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 15px;">
        <tr>
            <td width="60%"></td>
            <td width="40%" align="center">Surabaya, {{ !is_null($pemeriksaan_psikologi_visum->created_at) ? indonesian_date($pemeriksaan_psikologi_visum->created_at) : '_____________' }} </td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>Psikolog</b></td>
        </tr>
        <tr>
            <td></td>
            <td align="center" height="50"></td>
        </tr>
        <tr>
            <td></td>
            <td align="center">
            	<p><u>{{$pemeriksaan_psikologi_visum->creator->name ?? '.........................................'}}</u></p>
            </td>
        </tr>
    </table>
@endsection

@section('scripts')
<script type="text/php">
    if (isset($pdf)) {
        $x = $pdf->get_width() - 315;
        $y = $pdf->get_height() - 34;
        $text = "Pemeriksaan Psikologi Visum - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$pemeriksaan_psikologi_visum->id.'}'}} | Halaman {PAGE_NUM} of {PAGE_COUNT}";
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