<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="14">Laporan Kesesuaian {{$jenis_resep}} Dokter Menulis Resep - Bulanan</th>
        </tr>
        <tr>
            <th colspan="14">Periode : {{indonesian_date($date_start,'d F Y')}} - {{indonesian_date($date_end,'d F Y')}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">NAMA DOKTER</th>
            <th colspan="3">IGD</th>
            <th colspan="3">RAWAT JALAN</th>
            <th colspan="3">RAWAT INAP</th>
            <th colspan="3">TOTAL</th>
        </tr>
        <tr>
        	@for($i=0;$i<4;$i++)
            <td>SESUAI</td>
            <td>TIDAK SESUAI</td>
        	<td>TOTAL</td>
        	@endfor
        </tr>
        @php $row = 7 @endphp
        @php $grand_total_igd_sesuai = 0 @endphp
        @php $grand_total_igd_tidak_sesuai = 0 @endphp
        @php $grand_total_rawat_jalan_sesuai = 0 @endphp
        @php $grand_total_rawat_jalan_tidak_sesuai = 0 @endphp
        @php $grand_total_rawat_inap_sesuai = 0 @endphp
        @php $grand_total_rawat_inap_tidak_sesuai = 0 @endphp

        @foreach($data as $dokter => $dokter_data)
        <tr>
        	<td rowspan="2">{{$loop->iteration}}</td>
        	<td rowspan="2">{{$dokter}}</td>
            <td>{{$dokter_data['igd']['sesuai']}}</td>
            <td>{{$dokter_data['igd']['tidak_sesuai']}}</td>
            <td>
                @php $total_igd = $dokter_data['igd']['sesuai'] + $dokter_data['igd']['tidak_sesuai']@endphp
                {{$total_igd}}
            </td>
            <td>{{$dokter_data['rawat_jalan']['sesuai']}}</td>
            <td>{{$dokter_data['rawat_jalan']['tidak_sesuai']}}</td>
            <td>
                @php $total_rawat_jalan = $dokter_data['rawat_jalan']['sesuai'] + $dokter_data['rawat_jalan']['tidak_sesuai']@endphp
                {{$total_rawat_jalan}}
            </td>
            <td>{{$dokter_data['rawat_inap']['sesuai']}}</td>
            <td>{{$dokter_data['rawat_inap']['tidak_sesuai']}}</td>
            <td>
                @php $total_rawat_inap = $dokter_data['rawat_inap']['sesuai'] + $dokter_data['rawat_inap']['tidak_sesuai']@endphp
                {{$total_rawat_inap}}
            </td>
            <td>=C{{$row}}+F{{$row}}+I{{$row}}</td>
            <td>=D{{$row}}+G{{$row}}+J{{$row}}</td>
            <td>=E{{$row}}+H{{$row}}+K{{$row}}</td>
        </tr>
        @php $row++ @endphp
        <tr>
            <td>
                @if($total_igd != 0) {{round($dokter_data['igd']['sesuai'] / $total_igd * 100)}}%
                @else 0% @endif
            </td>
            <td>
                @if($total_igd != 0) {{round($dokter_data['rawat_jalan']['tidak_sesuai'] / $total_igd * 100)}}%
                @else 0% @endif
            </td>
            <td></td>
            
            <td>
                @if($total_rawat_jalan != 0) {{round($dokter_data['rawat_jalan']['sesuai'] / $total_rawat_jalan * 100)}}%
                @else 0% @endif
            </td>
            <td>
                @if($total_rawat_jalan != 0) {{round($dokter_data['rawat_jalan']['tidak_sesuai'] / $total_rawat_jalan * 100)}}%
                @else 0% @endif
            </td>
            <td></td>
            
            <td>
                @if($total_rawat_inap != 0) {{round($dokter_data['rawat_inap']['sesuai'] / $total_rawat_inap * 100)}}%
                @else 0% @endif
            </td>
            <td>
                @if($total_rawat_inap != 0) {{round($dokter_data['rawat_inap']['tidak_sesuai'] / $total_rawat_inap * 100)}}%
                @else 0% @endif
            </td>
            <td></td>

            @php $total_tidak_sesuai = $dokter_data['igd']['tidak_sesuai'] + $dokter_data['rawat_jalan']['tidak_sesuai'] + $dokter_data['rawat_inap']['tidak_sesuai'] @endphp
            @php $total_sesuai = $dokter_data['igd']['sesuai'] + $dokter_data['rawat_jalan']['sesuai'] + $dokter_data['rawat_inap']['sesuai'] @endphp
            @php $total_all = $total_igd + $total_rawat_inap + $total_rawat_jalan @endphp 

            <td>
                @if($total_all != 0) {{round($total_sesuai / $total_all * 100)}}%
                @else 0% @endif
            </td>
            <td>
                @if($total_all != 0) {{round($total_tidak_sesuai / $total_all * 100)}}%
                @else 0% @endif
            </td>
            <td></td>
        </tr>

        
        @php $grand_total_igd_sesuai += $dokter_data['igd']['sesuai'] @endphp
        @php $grand_total_igd_tidak_sesuai += $dokter_data['igd']['tidak_sesuai'] @endphp
        @php $grand_total_rawat_jalan_sesuai += $dokter_data['rawat_jalan']['sesuai'] @endphp
        @php $grand_total_rawat_jalan_tidak_sesuai += $dokter_data['rawat_jalan']['tidak_sesuai'] @endphp
        @php $grand_total_rawat_inap_sesuai += $dokter_data['rawat_inap']['sesuai'] @endphp
        @php $grand_total_rawat_inap_tidak_sesuai += $dokter_data['rawat_inap']['tidak_sesuai'] @endphp


        @php $row++ @endphp
        @endforeach

        @php $grand_total_igd_all = $grand_total_igd_sesuai + $grand_total_igd_tidak_sesuai @endphp
        @php $grand_total_rawat_jalan_all = $grand_total_rawat_jalan_sesuai + $grand_total_rawat_jalan_tidak_sesuai @endphp
        @php $grand_total_rawat_inap_all = $grand_total_rawat_inap_sesuai + $grand_total_rawat_inap_tidak_sesuai @endphp
        @php $grand_total_sesuai_all = $grand_total_igd_sesuai + $grand_total_rawat_jalan_sesuai + $grand_total_rawat_inap_sesuai @endphp
        @php $grand_total_tidak_sesuai_all = $grand_total_igd_tidak_sesuai + $grand_total_rawat_jalan_tidak_sesuai + $grand_total_rawat_inap_tidak_sesuai @endphp
        @php $grand_total_all = $grand_total_sesuai_all + $grand_total_tidak_sesuai_all @endphp

        <tr>
            <td colspan="2" rowspan="2">TOTAL RESEP</td>
            <td>{{$grand_total_igd_sesuai}}</td>
            <td>{{$grand_total_igd_tidak_sesuai}}</td>
            <td>{{$grand_total_igd_all}}</td>
            <td>{{$grand_total_rawat_jalan_sesuai}}</td>
            <td>{{$grand_total_rawat_jalan_tidak_sesuai}}</td>
            <td>{{$grand_total_rawat_jalan_all}}</td>
            <td>{{$grand_total_rawat_inap_sesuai}}</td>
            <td>{{$grand_total_rawat_inap_tidak_sesuai}}</td>
            <td>{{$grand_total_rawat_inap_all}}</td>
            <td>{{$grand_total_sesuai_all}}</td>
            <td>{{$grand_total_tidak_sesuai_all}}</td>
            <td>{{$grand_total_all}}</td>
        </tr>

        <tr>
            <td>
                @if($grand_total_igd_all != 0) {{round($grand_total_igd_sesuai / $grand_total_igd_all * 100)}}%
                @else 0% @endif
            </td>
            <td>
                @if($grand_total_igd_all != 0) {{round($grand_total_igd_tidak_sesuai / $grand_total_igd_all * 100)}}%
                @else 0% @endif
            </td>
            <td></td>

            <td>
                @if($grand_total_rawat_jalan_all != 0) {{round($grand_total_rawat_jalan_sesuai / $grand_total_rawat_jalan_all * 100)}}%
                @else 0% @endif
            </td>
            <td>
                @if($grand_total_rawat_jalan_all != 0) {{round($grand_total_rawat_jalan_tidak_sesuai / $grand_total_rawat_jalan_all * 100)}}%
                @else 0% @endif
            </td>
            <td></td>

            <td>
                @if($grand_total_rawat_inap_all != 0) {{round($grand_total_rawat_inap_sesuai / $grand_total_rawat_inap_all * 100)}}%
                @else 0% @endif
            </td>
            <td>
                @if($grand_total_rawat_inap_all != 0) {{round($grand_total_rawat_inap_tidak_sesuai / $grand_total_rawat_inap_all * 100)}}%
                @else 0% @endif
            </td>
            <td></td>

            <td>
                @if($grand_total_all != 0) {{round($grand_total_sesuai_all / $grand_total_all * 100)}}%
                @else 0% @endif
            </td>
            <td>
                @if($grand_total_all != 0) {{round($grand_total_tidak_sesuai_all / $grand_total_all * 100)}}%
                @else 0% @endif
            </td>
            <td></td>
        </tr>
    </tbody>
</table>
