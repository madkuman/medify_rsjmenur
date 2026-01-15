@extends('layouts.print')

@section('title')
Print Instrumen Activity Daily Living
@endsection

@section('css')
<style type="text/css">
    @page{
        margin-top: 20px;
    }
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

    table.no-border td {
        border: none;
    }
</style>
@endsection

@section('content')
    <table width="100%" cellpadding="5">
        <tr>
            <td width="85%"></td>
            <td width="15%" align="center" style="border: 1px solid #000;">RM. 12.K1</td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td width="55%" valign="top">
                <table width="100%" cellpadding="5">
                   <tr>
                        <td width="15%" align="right">
                            <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="55">
                        </td>
                        <td width="60%" align="center">
                            <p style="font-size: 10px;">PEMERINTAH PROVINSI JAWA TIMUR <br>
                            <b>RUMAH SAKIT JIWA MENUR</b> <br>
                            Jln. Menur No. 120, Telp. (031) 5021635, 5021637 <br>
                            <b>SURABAYA</b>
                            </p>
                        </td>
                        <td width="25%" align="left">
                            <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="55">
                        </td>
                   </tr> 
                </table>
            </td>
            <td width="40%" valign="top">
                <table class="no-border" width="100%">
                    <tr>
                        <td width="37%">No. RM</td>
                        <td width="3%">:</td>
                        <td width="60%">{{ $kasus->pasien->no_rm }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $kasus->identitas->nama }}</td>
                    </tr>
                    <tr>
                        <td>Tgl Lahir / Umur</td>
                        <td>:</td>
                        <td>{{ !is_null($kasus->identitas->tanggal_lahir) ? date('d-m-Y', strtotime($kasus->identitas->tanggal_lahir)) : '-' }} / {{$kasus->identitas->umur}} Tahun</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{ $kasus->identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 5px;">
        <tr>
            <td align="center"><b><i>INSTRUMEN ACTIVITY DAILY LIVING</i></b></td>
        </tr>
    </table>

    @php 
        $checked = '<div style="font-family: ZapfDingbats, sans-serif;">4</div>';
    @endphp

    <table class="bordered" width="100%" style="margin-top: 5px;" cellpadding="3">
        <tr bgcolor="#d9d9d9">
            <th rowspan="2" width="4%" align="center">No.</th>
            <th rowspan="2" width="30%" align="center">Fungsi</th>
            <th rowspan="2" width="6%" align="center">Skor</th>
            <th rowspan="2" width="26%" align="center">Keterangan</th>
            <th colspan="{{count($instrumen_activity_daily_living)}}" width="34%" align="center">Nilai Skor</th>
        </tr>
        <tr bgcolor="#d9d9d9">
        	@foreach($instrumen_activity_daily_living as $i=> $item)
            @php
                $total_skor[$i] = 0;
            @endphp
            <th align="center">{{!is_null($item->tanggal) ? date('d/m/Y', strtotime($item->tanggal)) : 'Tgl'}}</th>
            @endforeach
        </tr>

        <tr>
            <td rowspan="3" valign="top" align="center">1.</td>
            <td rowspan="3" valign="top">Mengendalikan rangsang pembuangan tinja</td>
            <td align="center">0</td>
            <td>Tak terkendali/tak teratur (perlu pencahar)</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->mengendalikan_rangsang_pembuangan_tinja == 'Tak terkendali atau tak teratur (perlu pencahar)')
                    {!! $checked !!}
                @endif
            </td>
            @endforeach

        </tr>
        <tr>
            <td align="center">1</td>
            <td>Kadang-kadang tak terkendali (1x seminggu)</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->mengendalikan_rangsang_pembuangan_tinja == 'Kadang-kadang tak terkendali (1x seminggu)')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 1;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">2</td>
            <td>Terkendali teratur</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->mengendalikan_rangsang_pembuangan_tinja == 'Terkendali teratur')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 2;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>

        <tr>
            <td rowspan="3" align="center" valign="top">2.</td>
            <td rowspan="3" valign="top">Mengendalikan rangsang berkemih</td>
            <td align="center">0</td>
            <td>Tak terkendali/pakai kateter</td>
            @foreach($instrumen_activity_daily_living as $item)
            <td align="center">
                @if($item->mengendalikan_rangsang_berkemih == 'Tak terkendali / pakai kateter')
                    {!! $checked !!}
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">1</td>
            <td>Kadang-kadang tak terkendali (hanya 1x/24 jam)</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->mengendalikan_rangsang_berkemih == 'Kadang-kadang tak terkendali (hanya 1x/24 jam)')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 1;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">2</td>
            <td>Mandiri</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->mengendalikan_rangsang_berkemih == 'Mandiri')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 2;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>

        <tr>
            <td rowspan="2" align="center" valign="top">3.</td>
            <td rowspan="2" valign="top">Membersihkan diri (Seka muka,sisir rambut,sikat gigi)</td>
            <td align="center">0</td>
            <td>Butuh pertolongan orang lain</td>
            @foreach($instrumen_activity_daily_living as $item)
            <td align="center">
                @if($item->membersihkan_diri == 'Butuh pertolongan orang lain')
                    {!! $checked !!}
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">1</td>
            <td>Mandiri</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->membersihkan_diri == 'Mandiri')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 1;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>

        <tr>
            <td rowspan="3" align="center" valign="top">4.</td>
            <td rowspan="3" valign="top">Penggunaan jamban,masuk dan keluar (melepaskan, memakai celana, membersihkan, menyiram)</td>
            <td align="center">0</td>
            <td>Tergantung pertolongan orang lain</td>
            @foreach($instrumen_activity_daily_living as $item)
            <td align="center">
                @if($item->penggunaan_jamban == 'Tergantung pertolongan orang lain')
                    {!! $checked !!}
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">1</td>
            <td>Perlu pertolongan pada beberapa kegiatan tetapi dapat mengerjakan sendiri beberapa kegiatan lain</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->penggunaan_jamban == 'Perlu pertolongan pada beberapa kegiatan tetapi dapat mengerjakan sendiri beberapa kegiatan lain')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 1;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">2</td>
            <td>Mandiri</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->penggunaan_jamban == 'Mandiri')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 2;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>

        <tr>
            <td rowspan="3" align="center" valign="top">5.</td>
            <td rowspan="3" valign="top">Makan</td>
            <td align="center">0</td>
            <td>Tidak mampu</td>
            @foreach($instrumen_activity_daily_living as $item)
            <td align="center">
                @if($item->makan == 'Tidak mampu')
                    {!! $checked !!}
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">1</td>
            <td>Perlu ditolong memotong makanan</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->makan == 'Perlu ditolong memotong makanan')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 1;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">2</td>
            <td>Mandiri</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->makan == 'Mandiri')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 2;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>

        <tr>
            <td rowspan="4" align="center" valign="top">6.</td>
            <td rowspan="4" valign="top">Berubah sikap dari berbaring ke duduk</td>
            <td align="center">0</td>
            <td>Tidak mampu</td>
            @foreach($instrumen_activity_daily_living as $item)
            <td align="center">
                @if($item->berubah_sikap == 'Tidak mampu')
                    {!! $checked !!}
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">1</td>
            <td>Perlu banyak bantuan untuk bisa duduk (2 orang)</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->berubah_sikap == 'Perlu banyak bantuan untuk bisa duduk (2 orang)')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 1;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">2</td>
            <td>Bantuan minimal satu orang</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->berubah_sikap == 'Bantuan minimal satu orang')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 2;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">3</td>
            <td>Mandiri</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->berubah_sikap == 'Mandiri')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 3;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>

        <tr>
            <td rowspan="4" align="center" valign="top">7.</td>
            <td rowspan="4" valign="top">Berpindah/berjalan</td>
            <td align="center">0</td>
            <td>Tidak mampu</td>
            @foreach($instrumen_activity_daily_living as $item)
            <td align="center">
                @if($item->berpindah_atau_berjalan == 'Berpindah/berjalan')
                    {!! $checked !!}
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">1</td>
            <td>Bisa pindah dengan kursi roda</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->berpindah_atau_berjalan == 'Bisa pindah dengan kursi roda')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 1;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">2</td>
            <td>Berjalan dengan bantuan 1 orang</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->berpindah_atau_berjalan == 'Berjalan dengan bantuan 1 orang')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 2;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">3</td>
            <td>Mandiri</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->berpindah_atau_berjalan == 'Mandiri')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 3;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td rowspan="3" align="center" valign="top">8.</td>
            <td rowspan="3" valign="top">Memakai baju</td>
            <td align="center">0</td>
            <td>Tergantung orang lain</td>
            @foreach($instrumen_activity_daily_living as $item)
            <td align="center">
                @if($item->memakai_baju == 'Tergantung orang lain')
                    {!! $checked !!}
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">1</td>
            <td>Sebagian dibantu (misalnya mengancing baju)</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->memakai_baju == 'Sebagian dibantu (misalnya mengancing baju)')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 1;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">2</td>
            <td>Mandiri</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->memakai_baju == 'Mandiri')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 2;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>

        <tr>
            <td rowspan="3" align="center" valign="top">9.</td>
            <td rowspan="3" valign="top">Naik turun tangga</td>
            <td align="center">0</td>
            <td>Tidak mampu</td>
            @foreach($instrumen_activity_daily_living as $item)
            <td align="center">
                @if($item->naik_turun_tangga == 'Tidak mampu')
                    {!! $checked !!}
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">1</td>
            <td>Butuh pertolongan</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->naik_turun_tangga == 'Butuh pertolongan')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 1;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">2</td>
            <td>Mandiri</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->naik_turun_tangga == 'Mandiri')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 2;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>

        <tr>
            <td rowspan="2" align="center" valign="top">10.</td>
            <td rowspan="2" valign="top">Mandi</td>
            <td align="center">0</td>
            <td>Tergantung orang lain</td>
            @foreach($instrumen_activity_daily_living as $item)
            <td align="center">
                @if($item->mandi == 'Tergantung orang lain')
                    {!! $checked !!}
                @endif
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center">1</td>
            <td>Mandiri</td>
            @foreach($instrumen_activity_daily_living as $i => $item)
            <td align="center">
                @if($item->mandi == 'Mandiri')
                    {!! $checked !!}
                    @php
                        $total_skor[$i] += 1;
                    @endphp
                @endif
            </td>
            @endforeach
        </tr>

        <tr bgcolor="#d9d9d9">
            <td colspan="4" align="center"><b>TOTAL SKOR</b></td>
            @foreach($instrumen_activity_daily_living as $i => $item)
                <td align="center">{{ $total_skor[$i] }}</td>
            @endforeach
            {{-- <td align="center">{{ $total_skor }}</td> --}}
        </tr>
    </table>

    <table width="100%" style="margin-top: 25px;">
        <tr>
            <th width="7%">20</th>
            <th width="3%">:</th>
            <th width="20%" align="left">Mandiri</th>
            <th width="7%">5-8</th>
            <th width="3%">:</th>
            <th width="60%" align="left">Ketergantungan berat</th>
        </tr>
        <tr>
            <th>12-19</th>
            <th>:</th>
            <th align="left">Ketergantungan ringan</th>
            <th>0-4</th>
            <th>:</th>
            <th align="left">Ketergantungan penuh</th>
        </tr>
        <tr>
            <th>9-11</th>
            <th>:</th>
            <th align="left">Ketergantungan sedang</th>
            <th>Total</th>
            <th>:</th>
            <th align="left">
                @php
                    $total = 0;
                    foreach($total_skor as $skor) {
                        $total += $skor;
                    }
                @endphp
                {{ $total }}
            </th>
        </tr>
    </table>
@endsection