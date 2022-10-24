@extends('layouts.print')

@section('title')
PELAKSANAAN PEMBERIAN OBAT
@endsection

@section('css')
<style type="text/css">
    @page{
        margin-top: 30px;
    }
    body, p {
        font-size: 13px;
        font-family: Arial, Helvetica, sans-serif;
        /*line-height: 16px;*/
    }
    table.bordered {
        border-collapse: collapse;
    }
    table.bordered, .bordered th, .bordered td {
        border: 1px solid black;
    }
    .bordered td{
        vertical-align: top !important;
        padding-left: 5px;
        padding-right: 5px; 
    }
    .border{
        border: 1px solid black;
    }
    .noBorder td{
        border: 1px solid white !important;
        vertical-align: top
    }
    .mx-5 td{
        margin-left: 5px !important;
        margin-right: 5px !important;
    }
    .text-center{
        text-align: center;
    }
    .va-mid td{
        vertical-align: middle;
    }
</style>
@endsection

@section('content')
@foreach($pengobatan as $obat)
    @php
        $init_date_current_page[$loop->iteration] = 0;
        $init_date_current_page2[$loop->iteration] = 0;
    @endphp
@endforeach
@for($page = 0; $page<$jml_halaman; $page++)
<table width="100%">
    <tr>
        <td width="90%"></td>
        <td width="10%" align="center">RM. 25 </td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="33%" valign="top">
            <table width="100%" cellpadding="5">
                <tr>
                    <td width="15%" align="left">
                        <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="40">
                    </td>
                    <td width="63%" align="center">
                        <p style="font-size: 11px;"><b>PEMERINTAH PROVINSI JAWA TIMUR</b></p>
                        <p style="font-size: 13px;"><b>RUMAH SAKIT JIWA MENUR</b></p>
                        <p style="font-size: 9px;"><b>Jln. Menur No.120, Telp. (031) 5021635, 5021637</b></p>
                        <p style="font-size: 11px;"><b>S U R A B A Y A</b></p>
                    </td>
                    <td width="17%" align="left">
                        <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="40">
                    </td>
                </tr>
            </table>
        </td>
        <td width="33%" align="center">
            <b style="font-size: 15px;">PELAKSANAAN PEMBERIAN OBAT</b>
        </td>
        <td width="33%">
            <div>
                <table width="100%" cellpadding="2" style="border: 1px solid #000;">
                    <tr>
                        <td>No. RM</td>
                        <td>: {{ $kasus->pasien->no_rm }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $kasus->identitas->nama }}</td>
                    </tr>
                    <tr>
                        <td>Tgl Lahir/Umur</td>
                        <td>: {{ date("d/m/Y", strtotime($kasus->identitas->tanggal_lahir)) }} / {{$kasus->identitas->umur}} Tahun</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: {!! $kasus->identitas->jenis_kelamin !!}</td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="30%">RUANG : {{$kasus->lokasi->lokasi->nama}}</td>
        <td width="70%">TANGGAL : {{$awal ? $awal->format('d F') : ''}} - {{$akhir? $akhir->format('d F') : ''}}</td>
    </tr>
</table>

@if($awal)
<table class="bordered" width="100%">
    <thead>
        <tr>
            <th rowspan="2" colspan="2">Nama Obat</th>
            @for($i = 0; $i<3; $i++)
            <th colspan="6" class="text-center">{{isset($riwayat_date[$page*3 + $i]) ? $riwayat_date[$page*3 + $i]->format('d M') : ''}}</th>
            @endfor
        </tr>
        <tr>
            @for($i = 0; $i<3; $i++)
            @for($j = 1; $j <= 6; $j++)
            <th class="text-center">{{$j}}</th>
            @endfor
            @endfor
        </tr>
    </thead>
    <tbody class="va-mid">
        @foreach($pengobatan as $obat)
        <tr>
            <td rowspan="2" style="white-space: nowrap;">
                {{substr($obat->nama_obat ?? "-", 0,26)}}<br>
                Rute : {{$obat->rute ?? '-'}} <br>
                Aturan : {{$obat->aturan_pemakaian ?? '-'}}
            </td>
            <td>Jam</td>
            @php $index = $init_date_current_page[$loop->iteration] @endphp
            @for($i = 0; $i < 3; $i++)
            @for($j = 1; $j <= 6; $j++)
            @php
            if(!empty($obat->details[$index]))
            {
                $time = $obat->details[$index]->pemberian_at;
                if(isset($riwayat_date[$page*3 + $i]))
                {
                    $start = $riwayat_date[$page*3 + $i]->copy()->startOfDay();
                    $end = $riwayat_date[$page*3 + $i]->copy()->endOfDay();

                    $bool = Carbon\Carbon::parse($time)->between($start, $end);
                }
            }
            else $bool = false;
            @endphp

            @if($bool)
            <td class="text-center">{{indonesian_date($obat->details[$index]->pemberian_at,'H:i')}}</td>
            @php $index++ @endphp
            @php $init_date_current_page[$loop->iteration]++ @endphp
            @else
            <td style="color: white">00:00</td>
            @endif

            @endfor
            @endfor
        </tr>
        <tr>
            <td style="white-space: nowrap">Sisa Obat</td>
            @php $index = $init_date_current_page2[$loop->iteration] @endphp
            @for($i = 0; $i < 3; $i++)
                @for($j = 1; $j <= 6; $j++)
                    @php
                        if(!empty($obat->details[$index]))
                        {
                            $time = $obat->details[$index]->pemberian_at;
                            if(isset($riwayat_date[$page*3 + $i]))
                            {
                                $start = $riwayat_date[$page*3 + $i]->copy()->startOfDay();
                                $end = $riwayat_date[$page*3 + $i]->copy()->endOfDay();

                                $bool = Carbon\Carbon::parse($time)->between($start, $end);
                            }
                        }
                        else $bool = false;
                    @endphp

                    @if($bool)
                        <td class="text-center">@if(isset($obat_resep[$obat->nama_obat][$obat->aturan_pemakaian])){{$obat_resep[$obat->nama_obat][$obat->aturan_pemakaian] -= $obat->details[$index]->jumlah}} @endif</td>
                        @php $index++ @endphp
                        @php $init_date_current_page2[$loop->iteration]++ @endphp
                    @else
                        <td style="color: white">00:00</td>
                    @endif

                @endfor
            @endfor
        </tr>
        @endforeach
    </tbody>
</table>
@else
<table class="bordered" width="100%">
    <thead>
        <tr>
            <th style="padding: 15px;">BELUM ADA OBAT YANG DIBERIKAN</th>
        </tr>
    </thead>
</table>
@endif
@if(($page+1) != $jml_halaman) <div style="page-break-after: always;"></div> @endif
@endfor
@endsection