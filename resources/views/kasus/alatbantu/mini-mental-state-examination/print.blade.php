@extends('layouts.print')

@section('title')
Print Mini Mental State Examination - {{$kasus->identitas->nama}}
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

    <table width="100%" style="margin-top: 20px;">
        <tr>
            <td align="center"><b><i>MINI MENTAL STATE EXAMINATION</i></b></td>
        </tr>
    </table>

    @php
    	$count = count($mini_mental_state_examination);
    @endphp

    <table class="bordered" width="100%" style="margin-top: 10px;">
        <tr>
            <th rowspan="2" width="50%" align="center">Item</th>
            <th rowspan="2" width="10%" align="center">Skor Maksimal</th>
            <th colspan="{{ $count }}" width="40%" align="center">Skor Manula</th>
        </tr>
        <tr>
        	@foreach($mini_mental_state_examination as $item)
            <th align="center">Tgl</th>
            @endforeach
        </tr>

        <tr>
            <th align="center" bgcolor="#d9d9d9">ORIENTASI</td>
            <th></th>
            @foreach($mini_mental_state_examination as $item)
            <th align="center"></th>
            @endforeach
        </tr>
        <tr>
            <td>
                <table class="no-border" width="100%">
                    <tr>
                        <td width="5%" valign="top">1.</td>
                        <td width="95%">Sekarang (hari), (tanggal), (bulan), (tahun) berapa dan (musim) apa ?</td>
                    </tr>
                </table>
            </td>
            <td align="center">5</td>

            @foreach($mini_mental_state_examination as $item)
            <td align="center">{{ $item->hari_tanggal_bulan_tahun_musim ?? '' }}</td>
            @endforeach
        </tr>
        <tr>
            <td>
                <table class="no-border" width="100%">
                    <tr>
                        <td width="5%" valign="top">2.</td>
                        <td width="95%">Sekarang kita berada di mana? (jalan), (nomor rumah), (kabupaten), (provinsi), (negara)</td>
                    </tr>
                </table>
            </td>
            <td align="center">5</td>
            @foreach($mini_mental_state_examination as $item)
            <td align="center">{{ $item->kita_berada_dimana ?? '' }}</td>
            @endforeach
        </tr>

        <tr>
            <th align="center" bgcolor="#d9d9d9">REGISTRASI</th>
            <th></th>
            @foreach($mini_mental_state_examination as $item)
            <th align="center"></th>
            @endforeach
        </tr>
        <tr>
            <td>
                <table class="no-border" width="100%">
                    <tr>
                        <td width="5%" valign="top">3.</td>
                        <td width="95%">Pewawancara menyebutkan nama 3 buah benda, 1 detik untuk tiap benda. Kemudian mintalah Lansia mengulang ke 3 nama benda tersebut. Berikan 1 angka untuk tiap jawaban yang benar. Bila masih salah, ulanglah penyebutan ke 3 nama benda tersebut sampai ia dapat mengulangnya dengan benar. Hitunglah jumlah percobaan dan catatlah (bola, kursi, sepatu). Jumlah percobaan _______ 
                        </td>
                    </tr>
                </table>
            </td>
            <td align="center">3</td>
            @foreach($mini_mental_state_examination as $item)
            <td align="center">{{ $item->nama_tiga_buah_benda ?? '' }}</td>
            @endforeach
        </tr>

        <tr>
            <th align="center" bgcolor="#d9d9d9">ATENSI DAN KALKULASI</th>
            <th></th>
            @foreach($mini_mental_state_examination as $item)
            <th></th>
            @endforeach
        </tr>
        <tr>
            <td>
                <table class="no-border" width="100%">
                    <tr>
                        <td width="5%" valign="top">4.</td>
                        <td width="95%">Hitunglah berturut-turut selang 7 mulai dan 100 ke bawah. Berilah 1 angka untuk tiap jawaban yang benar. Berhenti setelah 5 hitungan (93, 86, 79, 72, 65). Kemungkinan lain, ejalah kata "dunia" dari akhir ke awal (a-i-n-u-d).
                        </td>
                    </tr>
                </table>
            </td>
            <td align="center">5</td>
            @foreach($mini_mental_state_examination as $item)
            <td align="center">{{ $item->hitung_berturut_turut ?? '' }}</td>
            @endforeach
        </tr>

        <tr>
            <th align="center" bgcolor="#d9d9d9">MENGINGAT KEMBALI <i>(RECALL)</i></th>
            <th></th>
            @foreach($mini_mental_state_examination as $item)
            <td></td>
            @endforeach
        </tr>
        <tr>
            <td>
                <table class="no-border" width="100%">
                    <tr>
                        <td width="5%" valign="top">5.</td>
                        <td width="95%">Tanyalah kembali nama ke 3 benda yang telah disebutkan di atas. Berilah 1 angka untuk tiap jawaban yang benar.
                        </td>
                    </tr>
                </table>
            </td>
            <td align="center">5</td>
            @foreach($mini_mental_state_examination as $item)
            <td align="center">{{ $item->tanya_nama_benda ?? '' }}</td>
            @endforeach
        </tr>

        <tr>
            <th align="center" bgcolor="#d9d9d9">BAHASA</th>
            <th></th>
            @foreach($mini_mental_state_examination as $item)
            <th></th>
            @endforeach
        </tr>
        <tr>
            <td>
                <table class="no-border" width="100%">
                    <tr>
                        <td width="5%" valign="top">6.</td>
                        <td width="95%">Apakah nama benda-benda ini? Perlihatkan pensil dan arloji. (2 angka) 
                        </td>
                    </tr>
                </table>
            </td>
            <td align="center">2</td>
            @foreach($mini_mental_state_examination as $item)
            <td align="center">{{ $item->nama_benda_benda ?? '' }}</td>
            @endforeach
        </tr>
        <tr>
            <td>
                <table class="no-border" width="100%">
                    <tr>
                        <td width="5%" valign="top">7.</td>
                        <td width="95%">Ulanglah kalimat berikut: "Namun, Tanpa, Bila". (1 angka)</td>
                    </tr>
                </table>
            </td>
            <td align="center">1</td>
            @foreach($mini_mental_state_examination as $item)
            <td align="center">{{ $item->ulangi_kalimat_berikut ?? '' }}</td>
            @endforeach
        </tr>
        <tr>
            <td>
                <table class="no-border" width="100%">
                    <tr>
                        <td width="5%" valign="top">8.</td>
                        <td width="95%">Laksakan 3 buah perintah ini: "Peganglah selembar kertas dengan tangan kananmu, lipatlah kertas itu pada pertengahan dan letakkanlah di lantai". (3 angka)</td>
                    </tr>
                </table>
            </td>
            <td align="center">3</td>
            @foreach($mini_mental_state_examination as $item)
            <td align="center">{{ $item->laksanakan_perintah ?? '' }}</td>
            @endforeach
        </tr>
        <tr>
            <td>
                <table class="no-border" width="100%">
                    <tr>
                        <td width="5%" valign="top">9.</td>
                        <td width="95%">Bacalah dan laksanakan perintah berikut: "PEJAMKAN MATA ANDA". (1 angka)</td>
                    </tr>
                </table>
            </td>
            <td align="center">1</td>
            @foreach($mini_mental_state_examination as $item)
            <td align="center">{{ $item->bacalah_dan_laksanakan_perintah ?? '' }}</td>
            @endforeach
        </tr>
        <tr>
            <td>
                <table class="no-border" width="100%">
                    <tr>
                        <td width="5%" valign="top">10.</td>
                        <td width="95%">Tulislah sebuah kalimat. (1 angka) </td>
                    </tr>
                </table>
            </td>
            <td align="center">1</td>
            @foreach($mini_mental_state_examination as $item)
            <td align="center">{{ $item->tulis_sebuah_kalimat ?? '' }}</td>
            @endforeach
        </tr>
        <tr>
            <td>
                <table class="no-border" width="100%">
                    <tr>
                        <td width="5%" valign="top">11.</td>
                        <td width="95%">
                            Tirulah gambar ini. (1 angka) <br>
                            <img src="{{ asset('assets/img/segilima.png') }}" height="50">
                        </td>
                    </tr>
                </table>
            </td>
            <td align="center">1</td>
            @foreach($mini_mental_state_examination as $item)
            <td align="center">{{ $item->tirulah_gambar ?? '' }}</td>
            @endforeach
        </tr>

        <tr bgcolor="#d9d9d9">
            <th align="center">TOTAL SKOR</th>
            <th align="center">30</th>
            @foreach($mini_mental_state_examination as $item)
            <th align="center">{{$item->total_skor}}</th>
            @endforeach
        </tr>
    </table>

    <table width="100%">
        <tr>
            <th>SKOR : 24-30 Normal</th>
            <th>17-23 : Probable Gangguan Kognitif</th>
            <th>0-16 :Definite Gangguan  Kognitif</th>
        </tr>
    </table>
@endsection