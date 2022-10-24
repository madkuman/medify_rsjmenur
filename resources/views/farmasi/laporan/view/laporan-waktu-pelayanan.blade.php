<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="14">LAPORAN WAKTU PELAYANAN</th>
        </tr>
        <tr>
            <th colspan="14">Periode : {{indonesian_date($date_start,'d F Y')}} - {{indonesian_date($date_end,'d F Y')}}</th>
        </tr>
        <tr>
            <th colspan="14">Farmasi : {{$farmasi}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">ITEM</th>
            <th colspan="3">IGD</th>
            <th colspan="3">RAWAT JALAN</th>
            <th colspan="3">RAWAT INAP</th>
            <th colspan="3">TOTAL</th>
        </tr>
        <tr>
        	@for($i=0;$i<4;$i++)
        	<td>&#8804; 60</td>
        	<td>&#x3E; 60</td>
        	<td>TOTAL</td>
        	@endfor
        </tr>
        <tr>
        	<td rowspan="2">1</td>
        	<td rowspan="2">Jumlah Resep
                @if($jenis_resep == 'all')
                @elseif($jenis_resep == 'racikan') Racikan
                @elseif($jenis_resep == 'non-racikan') Non Racikan
                @endif
            </td>
            <td>{{$data['igd']['less_60']}}</td>
            <td>{{$data['igd']['more_60']}}</td>
            <td>=SUM(C8:D8)</td>
            <td>{{$data['rawat_jalan']['less_60']}}</td>
            <td>{{$data['rawat_jalan']['more_60']}}</td>
            <td>=SUM(F8:G8)</td>
            <td>{{$data['rawat_inap']['less_60']}}</td>
            <td>{{$data['rawat_inap']['more_60']}}</td>
            <td>=SUM(I8:J8)</td>
            <td>=C8+F8+I8</td>
            <td>=D8+G8+J8</td>
            <td>=E8+H8+K8</td>
        </tr>
        <tr>
            <td>=C8/E8</td>
            <td>=D8/E8</td>
            <td></td>
            <td>=F8/H8</td>
            <td>=G8/H8</td>
            <td></td>
            <td>=I8/K8</td>
            <td>=J8/K8</td>
            <td></td>
            <td>=L8/N8</td>
            <td>=M8/N8</td>
            <td></td>
        </tr>
    </tbody>
</table>
