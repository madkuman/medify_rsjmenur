<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="6">LAPORAN PEMERIKSAAN LABORATORIUM</th>
        </tr>
        <tr>
            <th colspan="6">{{$keterangan_waktu}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th>NO</th>
            <th>JENIS PEMERIKSAAN</th>
            <th>SEDERHANA</th>
            <th>SEDANG</th>
            <th>CANGGIH</th>
            <th>TOTAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{$item['no']}}</td>
            <td>{{$item['nama']}}</td>
            <td>{{$item['sederhana']}}</td>
            <td>{{$item['sedang']}}</td>
            <td>{{$item['canggih']}}</td>
            <td>{{$item['total']}}</td>
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td>TOTAL</td>
            @php $last_row =count($data) + 5; @endphp
            <td>=SUM(C6:C{{$last_row}})</td>
            <td>=SUM(D6:D{{$last_row}})</td>
            <td>=SUM(E6:E{{$last_row}})</td>
            <td>=SUM(F6:F{{$last_row}})</td>
        </tr>
    </tbody>
</table>
