<html>
    <table>
        <tr>
            <td colspan="{{ $max_column }}">DAFTAR LANSIA  YANG TELAH MENDAPATKAN PELAYANAN KESEHATAN MINIMAL</td>
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
            <th rowspan="2">NAMA</th>
            <th colspan="2">JENIS KELAMIN</th>
            <th rowspan="2">USIA</th>
            <th rowspan="2">NIK</th>
            <th rowspan="2">ALAMAT</th>
        </tr>
        <tr>
            <th>Laki - laki</th>
            <th>Perempuan</th>
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