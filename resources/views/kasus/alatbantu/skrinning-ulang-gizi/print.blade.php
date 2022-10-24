@extends('layouts.print')

@section('title')
Print Skrinning Ulang Gizi - {{$kasus->identitas->nama}}
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
    <table width="100%" cellpadding="5" style="border-collapse: collapse;">
        <tr>
            <td width="85%"></td>
            <td width="15%" align="center" style="border: 1px solid #000;">RM 29</td>
        </tr>
        <tr>
            <td></td>
            <td align="center" style="border: 1px solid #000;"><i>Halaman 1/1</i></td>
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
                        <td width="35%">No. RM</td>
                        <td width="3%">:</td>
                        <td width="62%">{{ $kasus->pasien->no_rm ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $kasus->identitas->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Tgl Lahir / Umur</td>
                        <td>:</td>
                        <td>{{!is_null($kasus->identitas->tanggal_lahir) ? indonesian_date($kasus->identitas->tanggal_lahir) : '-'}} / {{ $kasus->identitas->umur ?? '-' }} Tahun</td>
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

    @php 
        $colspan = count($skrinning_ulang_gizi) + 4;
    @endphp

    <table class="bordered" width="100%" cellpadding="5" style="margin-top: 20px;">
        <tr>
            <th colspan="{{ $colspan }}">
                SKRINNING ULANG GIZI <small style="font-size: 10px;"><i>(Diisi oleh Nutrisionis)</i></small>
            </th>
        </tr>
        <tr>
            <td width="20%" align="center" rowspan="4"><b>KATEGORI STATUS GIZI</b></td>
            <td width="15%" align="center">Anak</td>
            <td width="15%" align="center">Dewasa</td>
            <td width="15%">Tanggal</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>
                {{ !is_null($item->tanggal) ? indonesian_date($item->tanggal) : '-' }}
            </td>
            @endforeach
        </tr>
        <tr>
            <td align="center" rowspan="3">Standar Deviasi</td>
            <td align="center" rowspan="3">Kg/m²</td>
            <td>Jam</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>{{ $item->jam ?? '-' }}</td>
            @endforeach
        </tr>
        <tr>
            <td>Ruangan</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>{{ $item->ruangan ?? '-' }}</td>
            @endforeach
        </tr>
        <tr>
            <td>Dx Medis</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>{{ $item->dx_medis ?? '-' }}</td>
            @endforeach
        </tr>
        <tr>
            <td>Sangat Kurus</td>
            <td align="center">&#60;-3 </td>
            <td align="center">&#60; 17,0</td>
            <td>TB (cm)</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>{{ $item->tinggi_badan ?? '-' }}</td>
            @endforeach
        </tr>
        <tr>
            <td>Kurus</td>
            <td align="center">-3 s/d &#60; -2</td>
            <td align="center">17 - &#60; 18,5 </td>
            <td>BB (kg)</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>{{ $item->berat_badan ?? '-' }}</td>
            @endforeach
        </tr>
        <tr>
            <td>Normal</td>
            <td align="center">-2 s/d 1</td>
            <td align="center">18,5 - 25,0</td>
            <td>IMT (kg/m²)</td>
            @foreach($skrinning_ulang_gizi as $item)
            {{-- @php
            $bb = $item->berat_badan ?? 0;
            $tb = $item->tinggi_badan ?? 0;
            $imt = $bb != 0 && $tb != 0 ? $bb / pow($tb, 2) : 0;
            @endphp --}}
            {{-- <td>{{ $imt ? number_format($imt, 3, ',', '') : '-' }}</td> --}}
            <td>{{ $item->imt ?? '-' }}</td>
            @endforeach
        </tr>
        <tr>
            <td>Gemuk</td>
            <td align="center">&#62; 1  s/d 2 </td>
            <td align="center">&#62; 25,0 - 27,0</td>
            <td>IMT/U (SD)</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>{{ $item->imtu ?? '-' }}</td>
            @endforeach
        </tr>
        <tr>
            <td>Obesitas</td>
            <td align="center">&#62; 2 </td>
            <td align="center">&#62; 27,0</td>
            <td>Status Gizi</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>{{ $item->status_gizi ?? '-' }}</td>
            @endforeach
        </tr>
        <tr>
            <td colspan="{{$colspan}}" height="1" align="center"></td>
        </tr>
        <tr>
            <td colspan="3" align="center">Parameter</td>
            <td align="center">Skor</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td></td>
            @endforeach
        </tr>

        @php 
	        $checked = '<div style="font-family: ZapfDingbats, sans-serif;">4</div>';
	    @endphp
        
        <tr>
            <td colspan="4"><b>1. Asupan nutrisi/makanan rata-rata</b></td>
            @foreach($skrinning_ulang_gizi as $item)
            <td></td>
            @endforeach
        </tr>
        <tr>
            <td colspan="3">a. Asupan > 50%</td>
            <td align="center">0</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>{!! $item->asupan_nutrisi == 'Asupan lebih dari 50' ? $checked : '' !!}</td>
            @endforeach
        </tr>
        <tr>
            <td colspan="3">b. Asupan 25 - 50%</td>
            <td align="center">1</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>{!! $item->asupan_nutrisi == 'Asupan 25 sampai 50' ? $checked : '' !!}</td>
            @endforeach
        </tr>
        <tr>
            <td colspan="3">c. Asupan &lt; 25%</td>
            <td align="center">2</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>{!! $item->asupan_nutrisi == 'Asupan kurang dari 25' ? $checked : '' !!}</td>
            @endforeach
        </tr>

        <tr>
            <td colspan="4"><b>2. Status Gizi</b></td>
            @foreach($skrinning_ulang_gizi as $item)
            <td></td>
            @endforeach
        </tr>
        <tr>
            <td colspan="3">a. Normal / Gemuk</td>
            <td align="center">0</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>{!! $item->status_gizi == 'Normal' || $item->status_gizi == 'Gemuk' ? $checked : '' !!}</td>
            @endforeach
        </tr>
        <tr>
            <td colspan="3">b. Kurus / Sangat kurus / Obesitas</td>
            <td align="center">2</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>{!! $item->status_gizi == 'Kurus' || $item->status_gizi == 'Sangat Kurus' || $item->status_gizi == 'Obesitas' ? $checked : '' !!}</td>
            @endforeach
        </tr>

        <tr>
            <td colspan="4"><b>3. Pasien dengan kondisi khusus ?</b></td>
            @foreach($skrinning_ulang_gizi as $item)
            <td></td>
            @endforeach
        </tr>
        <tr>
            <td colspan="3">a. Tidak</td>
            <td align="center">0</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>{!! $item->pasien_dengan_kondisi_khusus == 'Tidak' ? $checked : '' !!}</td>
            @endforeach
        </tr>
        <tr>
            <td colspan="3">b. Ya</td>
            <td align="center">2</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>
                {!! $item->pasien_dengan_kondisi_khusus == 'Ya' ? $checked : '' !!}
                <p>{{ $item->sebutkan_pasien_dengan_kondisi_khusus }}</p>
            </td>
            @endforeach
        </tr>
        
        <tr>
            <td colspan="4" align="center"><b>TOTAL SKOR</b></td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>{{ $item->total_skor ?? '0' }}</td>
            @endforeach
        </tr>
        <tr>
            <td colspan="2" rowspan="3" align="center"><b>Kategori Risiko)* Beri tanda centang</b></td>
            <td>Risiko rendah</td>
            <td>Skor 0</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>{!! $item->total_skor == 0 ? $checked : '' !!}</td>
            @endforeach
        </tr>
        <tr>
            <td>Risiko sedang</td>
            <td>Skor 1</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>{!! $item->total_skor == 1 ? $checked : '' !!}</td>
            @endforeach
        </tr>
        <tr>
            <td>Risiko tinggi</td>
            <td>Skor &#62;= 2</td>
            @foreach($skrinning_ulang_gizi as $item)
            <td>{!! $item->total_skor >= 2 ? $checked : '' !!}</td>
            @endforeach
        </tr>
        <tr>
            <td colspan="4" align="center" height="50"><b>NAMA TERANG & TTD NUTRISIONIS</b></td>
            @foreach($skrinning_ulang_gizi as $item)
            <td height="50">{{ $item->creator->name }}</td>
            @endforeach
        </tr>
        <tr>
            <td colspan="{{ $colspan }}"><i>*  Kategori risiko masalah gizi : Risiko rendah ulangi skrining min setiap 7. Risiko sedang monitoring asupan rata-rata 2 hari jika tidak ada peningkatan, dilanjutkan skrining gizi </i></td>
        </tr>
    </table>
@endsection