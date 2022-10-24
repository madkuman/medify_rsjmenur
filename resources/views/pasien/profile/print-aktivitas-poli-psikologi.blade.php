@extends('layouts.print')

@section('title')
Print Akrifitas Poli Psikologi
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
    table.bordered, .bordered th, .bordered td.has-border {
      border: 1px solid black;
    }
    .bordered td.border-top {
        border-top: 1px solid #000;
    }
    .bordered td.border-right {
        border-right: 1px solid #000;
    }
</style>
@endsection

@section('content')
    <table width="100%" cellpadding="5">
        <tr>
            <th align="center" colspan="2">
                <p style="font-size: 14">LAPORAN AKTIVITAS POLI PSIKOLOGI</p>
            </th>
        </tr>
        <tr>
            <th align="left"><p>BULAN DESEMBER</p></th>
            <th align="right"><p>TAHUN 2019</p></th>
        </tr>
    </table>

    <table class="bordered" width="100%" cellpadding="5" style="margin-top: 5px;">
        <tr>
            <th rowspan="2" width="5%" align="center">NO.</th>
            <th rowspan="2" width="45%" align="center">AKTIFITAS</th>
            <th colspan="2" width="35%" align="center">JENIS KELAMIN</th>
            <th rowspan="2" width="15%" align="center">JUMLAH</th>
        </tr>
        <tr>
            <th align="center">LAKI-LAKI</th>
            <th align="center">PEREMPUAN</th>
        </tr>
        <tr>
            <td rowspan="4" align="center" valign="top" class="has-border">1.</td>
            <td class="border-right">Kunjungan Poli Psikologi</td>
            <td class="border-right"></td>
            <td class="border-right"></td>
            <td class="border-right"></td>
        </tr>
        <tr>
            <td class="border-right">Instalasi Psikologi</td>
            <td align="center" class="border-right">23</td>
            <td align="center" class="border-right">27</td>
            <td align="center" class="border-right">50</td>
        </tr>
        <tr>
            <td class="border-right">Instalasi NAPZA</td>
            <td align="center" class="border-right">84</td>
            <td align="center" class="border-right"></td>
            <td align="center" class="border-right">84</td>
        </tr>
        <tr>
            <td class="border-right">Instalasi Keswara</td>
            <td align="center" class="border-right">33</td>
            <td align="center" class="border-right">20</td>
            <td align="center" class="border-right">53</td>
        </tr>

        <tr>
            <td rowspan="10" align="center" valign="top" class="has-border">2.</td>
            <td class="border-top border-right">Pemeriksaan Psikologi Berdasarkan jenis Pelayanan</td>
            <td class="border-top border-right" align="center"></td>
            <td class="border-top border-right" align="center"></td>
            <td class="border-top border-right" align="center"></td>
        </tr>
        <tr>
            <td class="border-right">a. Psikotes Sedang</td>
            <td class="border-right" align="center">33</td>
            <td class="border-right" align="center">20</td>
            <td class="border-right" align="center">53</td>
        </tr>
        <tr>
            <td class="border-right" >b. Psikotes Lengkap</td>
            <td class="border-right" align="center">10</td>
            <td class="border-right" align="center">5</td>
            <td class="border-right" align="center">15</td>
        </tr>
        <tr>
            <td class="border-right">c. Visum et Repertum Psychiatricum</td>
            <td class="border-right" align="center"></td>
            <td class="border-right" align="center"></td>
            <td class="border-right" align="center"></td>
        </tr>
        <tr>
            <td class="border-right">d. MMPI</td>
            <td class="border-right" align="center"></td>
            <td class="border-right" align="center">1</td>
            <td class="border-right" align="center">1</td>
        </tr>
        <tr>
            <td class="border-right">e. Surat Keterangan Sehat Jiwa</td>
            <td class="border-right" align="center">19</td>
            <td class="border-right" align="center">19</td>
            <td class="border-right" align="center">38</td>
        </tr>
        <tr>
            <td class="border-right">f. Seleksi Karyawan</td>
            <td class="border-right" align="center"></td>
            <td class="border-right" align="center"></td>
            <td class="border-right" align="center"></td>
        </tr>
        <tr>
            <td class="border-right">g. CPNS</td>
            <td class="border-right" align="center"></td>
            <td class="border-right" align="center"></td>
            <td class="border-right" align="center"></td>
        </tr>
        <tr>
            <td class="border-right">h. Konsultasi</td>
            <td class="border-right" align="center">4</td>
            <td class="border-right" align="center">7</td>
            <td class="border-right" align="center">11</td>
        </tr>
        <tr>
            <td class="border-right">i. Layanan Psikologi di NAPZA</td>
            <td class="border-right" align="center">84</td>
            <td class="border-right" align="center"></td>
            <td class="border-right" align="center">84</td>
        </tr>

        <tr>
            <td rowspan="3" align="center" valign="top" class="has-border">3.</td>
            <td class="border-top border-right">Asal Rujukan</td>
            <td class="border-top border-right" align="center"></td>
            <td class="border-top border-right" align="center"></td>
            <td class="border-top border-right" align="center"></td>
        </tr>
        <tr>
            <td class="border-right">a. Rawat Jalan</td>
            <td class="border-right" align="center">130</td>
            <td class="border-right" align="center">51</td>
            <td class="border-right" align="center">181</td>
        </tr>
        <tr>
            <td class="border-right">b. Rawat Inap</td>
            <td class="border-right" align="center">4</td>
            <td class="border-right" align="center">1</td>
            <td class="border-right" align="center">5</td>
        </tr>

        <tr>
            <td colspan="2" align="right" class="has-border"><b>JUMLAH</b></td>
            <td align="center" class="has-border">134</td>
            <td align="center" class="has-border">52</td>
            <td align="center" class="has-border">186</td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 35px;">
        <tr>
            <td width="10%">Catatan :</td>
            <td width="60%"></td>
            <td width="30%" align="center">Surabaya, 3 Juni 2020</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td align="center"><b>Kepala Instalasi Psikologi</b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td height="30"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td align="center"><u>Lisa lorem ipsum dolor</u></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td align="center">NIP. 12312398123</td>
        </tr>
    </table>
@endsection