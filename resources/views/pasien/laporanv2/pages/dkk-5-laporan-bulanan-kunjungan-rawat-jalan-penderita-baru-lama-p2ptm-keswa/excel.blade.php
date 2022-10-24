<html>
    <table>
        <tr>
            <td colspan="{{ $max_column }}">LAPORAN KUNJUNGAN RAWAT JALAN PENDERITA BARU DAN LAMA P2PTM DAN KESWA </td>
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
            <th rowspan="2">No.</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">NIK</th>
            <th rowspan="2">Jenis Kelamin</th>
            <th rowspan="2">Alamat</th>
            <th rowspan="2">Tanggal Lahir</th>
            <th colspan="2">Status Pasien</th>
            <th rowspan="2">Kode ICD X</th>
            <th rowspan="2">Nama Penyakit</th>
        </tr>
        <tr>
            <th>Baru</th>
            <th>Lama</th>
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