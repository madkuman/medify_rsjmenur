<html>
    <table>
        <tr>
            <td colspan="{{ $max_column }}">LAPORAN LAHIR MATI</td>
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
            <th rowspan="2">No</th>
            <th rowspan="2">Nama Bayi Yang Lahir Mati</th>
            <th rowspan="2">Nama Ayah</th>
            <th rowspan="2">Nama Ibu</th>
            <th rowspan="2">NIK ORANG TUA (Ayah / Ibu)</th>
            <th rowspan="2">Alamat sesuai KTP dan Domisili (Apabila alamat KTP dan domisili berbeda). ( Lengkap dengan Kelurahan dan Kecamatan )</th>
            <th rowspan="2">Usia Ibu (th)</th>
            <th rowspan="2">Jenis Kelamin (L/P)</th>
            <th rowspan="2">Usia Kehamilan saat bayi lahir (minggu)</th>
            <th rowspan="2">Anak Ke</th>
            <th rowspan="2">Tanggal dan Jam Lahir Mati</th>
            <th rowspan="2">Penyebab Lahir Mati</th>
            <th rowspan="2">Tempat Meninggal</th>
            <th colspan="5">Asal Rujukan</th>
            <th rowspan="2">Ket</th>
        </tr>
        <tr>
            <th>Puskesmas</th>
            <th>Klinik</th>
            <th>PBM</th>
            <th>dr. / dr Sp.</th>
            <th>RS</th>
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