<html>
<table>
    <tr>
        <td colspan="{{ $max_column }}">Laporan Kematian Rumah Sakit</td>
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
        <th rowspan="2">NIK</th>
        <th rowspan="2">NO RM</th>
        <th colspan="2">USIA</th>
        <th rowspan="2">TGL MRS</th>
        <th rowspan="2">Kode Penyakit</th>
        <th rowspan="2">Diagnosa Penyakit</th>
        <th rowspan="2">Diagnosa Meninggal</th>
        <th rowspan="2">Tgl Meninggal</th>
    </tr>
    <tr>
        <th>L</th>
        <th>P</th>
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
