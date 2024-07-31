<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="4">JUMLAH PENDERITA YANG DIPERIKSA LABORATORIUM</th>
        </tr>
        <tr>
            <th colspan="4"> {{$keterangan_waktu}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th>NO</th>
            <th>RUANG</th>
            <th>JUMLAH PENDERITA</th>
            <th>KETERANGAN</th>
        </tr>
    </thead>
    @php
        $total_rj = 0;
        $total_ri = 0;
    @endphp
    <tbody>
        <tr>
            <th></th>
            <th>RAWAT INAP</th>
            <th></th>
            <th></th>
        </tr>
        @foreach($data['rawat_inap'] as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item['lokasi']}}</td>
            <td>{{$item['total']}}</td>
            <td></td>
        </tr>
        @php $total_ri+= $item['total'] @endphp
        @endforeach
        <tr>
            <th></th>
            <th>TOTAL RAWAT INAP</th>
            <th>{{$total_ri}}</th>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
            <th>RAWAT JALAN</th>
            <th></th>
            <th></th>
        </tr>
        @php $count = 1 @endphp
        @foreach($data['igd'] as $item)
        <tr>
            <td>{{$count++}}</td>
            <td>{{$item['lokasi']}}</td>
            <td>{{$item['total']}}</td>
            <td></td>
        </tr>
        @php $total_rj+= $item['total'] @endphp
        @endforeach
        @foreach($data['rawat_jalan'] as $item)
        <tr>
            <td>{{$count++}}</td>
            <td>{{$item['lokasi']}}</td>
            <td>{{$item['total']}}</td>
            <td></td>
        </tr>
        @php $total_rj+= $item['total'] @endphp
        @endforeach
        @foreach($data['medical_checkup'] as $item)
        <tr>
            <td>{{$count++}}</td>
            <td>{{$item['lokasi']}}</td>
            <td>{{$item['total']}}</td>
            <td></td>
        </tr>
        @php $total_rj+= $item['total'] @endphp
        @endforeach
        <tr>
            <th></th>
            <th>TOTAL RAWAT JALAN</th>
            <th>{{$total_rj}}</th>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
            <th>TOTAL PASIEN</th>
            <th>{{$total_ri+$total_rj}}</th>
            <th></th>
        </tr>
    </tbody>
</table>
