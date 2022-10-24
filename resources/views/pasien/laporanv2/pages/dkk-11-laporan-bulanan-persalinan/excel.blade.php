<html>
    <table>
        <tr>
            <td colspan="{{ $max_column }}">LAPORAN BULANAN PERSALINAN RUMAH SAKIT/ KLINIK/ PRAKTEK BIDAN MANDIRI (PBM) {{ config('app.name') }}</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="{{ $max_column }}">Periode : {{ $date_start->format('d-m-Y') }} - {{ $date_end->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th rowspan="3">No</th>
            <th rowspan="3">NAMA PASIEN (Ny.)</th>
            <th rowspan="3">NIK IBU BERSALIN</th>
            <th rowspan="3">NAMA SUAMI (Tn.)</th>
            <th rowspan="3">ALAMAT sesuai KTP dan Domisili (Apabila alamat KTP dan domisili berbeda). ( Lengkap dengan Kelurahan dan Kecamatan )</th>
            <th rowspan="3">UMUR IBU (Th)</th>
            <th rowspan="3">G....P....</th>
            <th rowspan="3">USIA KEHAMILAN</th>
            <th rowspan="3">TANGGAL PERSALINAN</th>
            <th colspan="3">JENIS PERSALINAN</th>
            <th colspan="2">JENIS KELAMIN</th>
            <th colspan="2">BAYI</th>
            <th rowspan="3">BERAT BADAN BAYI SAAT LAHIR (Gram)</th>
            <th colspan="2">MATERNAL</th>
        </tr>
        <tr>
            <th rowspan="2">TUNGGAL</th>
            <th colspan="2">GEMELLI / KEMBAR</th>
            <th rowspan="2">L</th>
            <th rowspan="2">P</th>
            <th rowspan="2">HIDUP</th>
            <th rowspan="2">MATI</th>
            <th rowspan="2">HIDUP</th>
            <th rowspan="2">MATI</th>
        </tr>
        <tr>
            <th>2</th>
            <th>&#8805; 3</th>
        </tr>
        @foreach ($data as $item)
            <tr>
                @foreach ($item as $col)
                    <td>{{ $col }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>
</html>