<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="12">LAPORAN PELAYANAN RESEP</th>
        </tr>
        <tr>
            <th colspan="12">Periode : {{indonesian_date($date_start,'d F Y')}} - {{indonesian_date($date_end,'d F Y')}}</th>
        </tr>
        <tr>
            <th colspan="12">Jenis Pasien : {{$perusahaan_pembayaran_nama}}</th>
        </tr>
        <tr>
            <th colspan="12">Unit Farmasi  : {{$farmasi_nama}}</th>
        </tr>
        <tr>
            <th colspan="12">Kategori  : {{$kategori_nama}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">DESKRIPSI</th>
            <th colspan="3">IGD</th>
            <th colspan="3">RAWAT JALAN</th>
            <th colspan="3">RAWAT INAP</th>
            <th rowspan="2">TOTAL</th>
        </tr>
        <tr>
            <th>Jumlah Resep yg dilayani</th>
            <th>Jumlah Resep yg tidak dilayani</th>
            <th>Total</th>
            <th>Jumlah Resep yg dilayani</th>
            <th>Jumlah Resep yg tidak dilayani</th>
            <th>Total</th>
            <th>Jumlah Resep yg dilayani</th>
            <th>Jumlah Resep yg tidak dilayani</th>
            <th>Total</th>
        </tr>
        @foreach($data as $row)
            <tr>
                @foreach($row as $value)
                    <td>{{$value}}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
