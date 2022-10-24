@extends('layouts.print')

@section('title')
MANAGEMEN DAN ASESMEN ULANG NYERI
@endsection

@section('css')
<style type="text/css">
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
</style>
@endsection

@section('content')
    <table width="100%">
        <tr>
            <td width="90%"></td>
            <td width="10%" align="center">RM. 28</td>
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
                            <p style="font-size: 9px;"><b>Jln. Menur No. 120, Telp. (031) 5021635, 5021637</b></p>
                            <p style="font-size: 11px;"><b>S U R A B A Y A</b></p>
                        </td>
                        <td width="17%" align="left">
                            <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="40">
                        </td>
                    </tr>
                </table>
            </td>
            <td width="33%" align="center">
                <b style="font-size: 15px;">MANAGEMEN DAN ASESMEN ULANG NYERI</b>
            </td>
            <td width="33%">
                <div style="border: 1px solid #000;">
                    <table width="100%" cellpadding="2">
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
                            <td>Jensi Kelamin</td>
                            <td>: {!! $kasus->identitas->jenis_kelamin !!}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <table width="100%" class="bordered" style="margin-top: 10px;">
        <tr>
            <td colspan="4">
                <h4><i>Diisi oleh dokter dan keperawatan</i></h4>
            </td>
        </tr>
        <tr>
            <td align="center">
                Skor Nyeri
            </td>
            <td align="center">
                Intervensi Farmakologi - WHO 3 step ladder
            </td>
            <td align="center">
                Intervensi Non Farmakologi
            </td>
            <td align="center">
                Pengkajian Ulang
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" class="noBorder">
                    <tr>
                        <td>0</td>
                        <td>:</td>
                        <td>Tidak Nyeri</td>
                    </tr>
                    <tr>
                        <td>1-3</td>
                        <td>:</td>
                        <td>Nyeri Ringan</td>
                    </tr>
                    <tr>
                        <td>4-6</td>
                        <td>:</td>
                        <td>Nyeri Sedang</td>
                    </tr>
                    <tr>
                        <td>7-10</td>
                        <td>:</td>
                        <td>Nyeri Berat</td>
                    </tr>
                </table>
            </td>
            <td>
                <table width="100%" class="noBorder">
                    <tr>
                        <td>Mild Pain : Parasetamol, NSAID, Adjuvant</td>
                    </tr>
                    <tr>
                        <td>Moderate Pain : Parasetamol, Mild Narcotic Analgesik (codein, Tramadol), Adjuvant</td>
                    </tr>
                    <tr>
                        <td>Severe Pain : Parasetamol, Mild Narcotic Analgesik, Adjuvant</td>
                    </tr>
                </table>
            </td>
            <td>
                <table width="100%" class="noBorder">
                    <tr>
                        <td>1</td>
                        <td>:</td>
                        <td>Dingin</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>:</td>
                        <td>Panas</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>:</td>
                        <td>Atur Posisi</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>:</td>
                        <td>Pijat</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>:</td>
                        <td>Terapi Music</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>:</td>
                        <td>Relaksasi & Pernafasan</td>
                    </tr>
                </table>
            </td>
            <td>
                <table width="100%" class="noBorder">
                    <tr>
                        <td>1.</td>
                        <td>15 menit setelah intervensi obat injeksi</td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>1 jam setelah intervensi obat oral atau lainnya</td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>1x/shift bila skor nyeri 1-3</td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>Setiap 3 jam bila skor nyeri 4-6</td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>Setiap 1 jam bila skor nyeri 7-10</td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td>Dihentikan bila skor nyeri 0</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="bordered" width="100%" style="margin-top: -2px;">
        <tr>
            <th colspan="10">Keperawatan</th>
            <th colspan="4">Dokter</th>
        </tr>
        <tr>
            <th rowspan="2">Tgl / Jam</th>
            <th rowspan="2">Skor nyeri</th>
            <th rowspan="2">Tensi</th>
            <th rowspan="2">Nadi</th>
            <th rowspan="2">Nafas</th>
            <th rowspan="2">Suhu</th>
            <th rowspan="2">Intervensi Non Farmokologi</th>
            <th rowspan="2">Waktu Kaji Ulang</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Paraf</th>
            <th colspan="2">Intervensi Farmokologi</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Paraf</th>
        </tr>
        <tr>
            <th>Nama Obat</th>
            <th>Dosis & Frekuensi</th>
        </tr>

        @foreach($managemen_dan_asesmen_ulang_nyeri as $item)
        <tr class="mx-5">
        	<td>{{ $item->tanggal ? date('d-m-y', strtotime($item->tanggal)) : '-' }} / {{ $item->jam }}</td>
        	<td>{{ $item->skor_nyeri }}</td>
        	<td>{{ $item->tensi }}</td>
        	<td>{{ $item->nadi }}</td>
        	<td>{{ $item->nafas }}</td>
        	<td>{{ $item->suhu }}</td>
        	<td>{{ $item->intervensi_non_farmokologi }}</td>
        	<td>{{ $item->waktu_kajian_ulang }}</td>
        	<td>{{ $item->nama_perawat }}</td>
        	<td></td>
        	<td>{{ $item->nama_obat }}</td>
        	<td>{{ $item->dosis_dan_frekuensi }}</td>
        	<td>{{ $item->nama_dokter }}</td>
        	<td></td>
        </tr>
        @endforeach
    </table>

@endsection