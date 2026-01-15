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
            @php $total_igd = $data['igd']['less_60'] + $data['igd']['more_60'] @endphp
            <td>
                @if($total_igd != 0) {{round($data['igd']['less_60'] / $total_igd * 100)}}%
                @else 0% @endif
            </td>
            <td>
                @if($total_igd != 0) {{round($data['igd']['more_60'] / $total_igd * 100)}}%
                @else 0% @endif
            </td>
            <td></td>
            
            @php $total_rawat_jalan = $data['rawat_jalan']['less_60'] + $data['rawat_jalan']['more_60'] @endphp
            <td>
                @if($total_rawat_jalan != 0) {{round($data['rawat_jalan']['less_60'] / $total_rawat_jalan * 100)}}%
                @else 0% @endif
            </td>
            <td>
                @if($total_rawat_jalan != 0) {{round($data['rawat_jalan']['more_60'] / $total_rawat_jalan * 100)}}%
                @else 0% @endif
            </td>
            <td></td>
            
            @php $total_rawat_inap = $data['rawat_inap']['less_60'] + $data['rawat_inap']['more_60'] @endphp
            <td>
                @if($total_rawat_inap != 0) {{round($data['rawat_inap']['less_60'] / $total_rawat_inap * 100)}}%
                @else 0% @endif
            </td>
            <td>
                @if($total_rawat_inap != 0) {{round($data['rawat_inap']['more_60'] / $total_rawat_inap * 100)}}%
                @else 0% @endif
            </td>
            <td></td>
            
            @php $total_less = $data['igd']['less_60'] + $data['rawat_inap']['less_60'] + + $data['rawat_jalan']['less_60'] @endphp
            @php $total_more = $data['igd']['more_60'] + $data['rawat_inap']['more_60'] + + $data['rawat_jalan']['more_60'] @endphp
            @php $total_grand = $total_less + $total_more @endphp
            <td>
                @if($total_grand != 0) {{round($total_less / $total_grand * 100)}}%
                @else 0% @endif
            </td>
            <td>
                @if($total_grand != 0) {{round($total_more / $total_grand * 100)}}%
                @else 0% @endif
            </td>
            <td></td>
        </tr>
    </tbody>
</table>
