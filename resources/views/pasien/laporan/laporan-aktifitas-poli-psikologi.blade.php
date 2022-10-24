<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">LAPORAN AKTIFITAS POLI PSIKOLOGI</th>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">Periode : {{indonesian_date($date_start,'d F Y')}} - {{indonesian_date($date_end,'d F Y')}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">AKTIFITAS</th>
            <th colspan="2">JENIS KELAMIN</th>
            <th rowspan="2">JUMLAH</th>
        </tr>
        <tr>
            <td>LAKI LAKI</td>
            <td>PEREMPUAN</td>
        </tr>
        @php $row = 7 @endphp

        @foreach($data as $jenis_data_text => $jenis_data)
            @php
                if($jenis_data_text == 'transaksi') $jenis_data_text2 = 'KUNJUNGAN POLI PSIKOLOGI';
                else if($jenis_data_text == 'tindakan') $jenis_data_text2 = 'PEMERIKSAAN PSIKOLOGI BERDASARKAN LAYANAN';
                else if($jenis_data_text == 'rujukan') $jenis_data_text2 = 'ASAL RUJUKAN';
            @endphp
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$jenis_data_text2}}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @php $row++ @endphp

            @foreach($jenis_data as $item)
            <tr>
            	<td></td>
            	<td>{{$item['nama']}}</td>
                <td>{{$item['lk']}}</td>
                <td>{{$item['pr']}}</td>
                <td>=SUM(C{{$row}}:D{{$row}})</td>
            </tr>
            @php $row++ @endphp
            @endforeach
            <tr>
                <td></td>
            </tr>
            @php $row++ @endphp
        @endforeach
        <tr>
            <td></td>
            <td>TOTAL</td>
            <td>=SUM(C{{$last_row-3}}:C{{$last_row-2}})</td>
            <td>=SUM(D{{$last_row-3}}:D{{$last_row-2}})</td>
            <td>=SUM(C{{$row}}:D{{$row}})</td>
        </tr>
    </tbody>
</table>
