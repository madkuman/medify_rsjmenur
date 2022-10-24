<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="15">LAPORAN RESPONSE TIME TAHUNAN</th>
        </tr>
        <tr>
            <th colspan="15">Tahun : {{$tahun}} </th>
        </tr>
        <tr>
            <th colspan="15">Farmasi : {{$farmasi}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">ITEM</th>
            <th colspan="12">BULAN</th>
            <th rowspan="2">RERATA</th>
        </tr>
        <tr>
            <th>JAN</th>
            <th>FEB</th>
            <th>MAR</th>
            <th>APR</th>
            <th>MEI</th>
            <th>JUNI</th>
            <th>JULI</th>
            <th>AGUS</th>
            <th>SEPT</th>
            <th>OKT</th>
            <th>NOV</th>
            <th>DES</th>
        </tr>
        @php $row = 8 @endphp
        @foreach($data as $nama => $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            @foreach($item as $value)
            @if($loop->first) 
                <td>
                    @if($nama == 'racikan') Resep Racikan @endif
                    @if($nama == 'non_racikan') Resep Non Racikan @endif
                </td>
            @endif

            <td>
                {{$value}}
            </td>
            @endforeach
            <td>
                =AVERAGE(C{{$row}}:N{{$row}})
            </td>
        </tr>
        @php $row++ @endphp
        @endforeach
    </tbody>
</table>
