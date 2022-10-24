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
        @foreach($data as $dokter => $dokter_data)
        <tr>
        	<td rowspan="2">{{$loop->iteration}}</td>
        	<td rowspan="2">{{$dokter}}</td>
            <td>{{$dokter_data['igd']['sesuai']}}</td>
            <td>{{$dokter_data['igd']['tidak_sesuai']}}</td>
            <td>=SUM(C{{$row}}:D{{$row}})</td>
            <td>{{$dokter_data['rawat_jalan']['sesuai']}}</td>
            <td>{{$dokter_data['rawat_jalan']['tidak_sesuai']}}</td>
            <td>=SUM(F{{$row}}:G{{$row}})</td>
            <td>{{$dokter_data['rawat_inap']['sesuai']}}</td>
            <td>{{$dokter_data['rawat_inap']['tidak_sesuai']}}</td>
            <td>=SUM(I{{$row}}:J{{$row}})</td>
            <td>=C{{$row}}+F{{$row}}+I{{$row}}</td>
            <td>=D{{$row}}+G{{$row}}+J{{$row}}</td>
            <td>=E{{$row}}+H{{$row}}+K{{$row}}</td>
        </tr>
        @php $row++ @endphp
        <tr>
            <td>=IF(E{{$row-1}}=0,0,C{{$row-1}}/E{{$row-1}})</td>
            <td>=IF(E{{$row-1}}=0,0,D{{$row-1}}/E{{$row-1}})</td>
            <td></td>

            <td>=IF(H{{$row-1}}=0,0,F{{$row-1}}/H{{$row-1}})</td>
            <td>=IF(H{{$row-1}}=0,0,G{{$row-1}}/H{{$row-1}})</td>
            <td></td>

            <td>=IF(K{{$row-1}}=0,0,I{{$row-1}}/K{{$row-1}})</td>
            <td>=IF(K{{$row-1}}=0,0,J{{$row-1}}/K{{$row-1}})</td>
            <td></td>

            <td>=IF(N{{$row-1}}=0,0,L{{$row-1}}/N{{$row-1}})</td>
            <td>=IF(N{{$row-1}}=0,0,M{{$row-1}}/N{{$row-1}})</td>
            <td></td>
        </tr>
        @php $row++ @endphp
        @endforeach

        
        <tr>
            <td colspan="2" rowspan="2">TOTAL RESEP</td>
            @php $last_row_dokter = $last_row-2 @endphp
            @for($i=3;$i<=14;$i++)
                @php $column = excel_column($i) @endphp
                <td>=
                @for($j=7;$j<=$last_row_dokter;$j++)
                    @if($j%2!=0)
                        {{$column}}{{$j}}
                        @if($j!=$last_row_dokter-1)
                            +
                        @endif
                    @endif
                @endfor
                </td>
            @endfor
        </tr>

        <tr>
            <td>=IF(E{{$last_row-1}}=0,0,C{{$last_row-1}}/E{{$last_row-1}})</td>
            <td>=IF(E{{$last_row-1}}=0,0,D{{$last_row-1}}/E{{$last_row-1}})</td>
            <td></td>

            <td>=IF(H{{$last_row-1}}=0,0,F{{$last_row-1}}/H{{$last_row-1}})</td>
            <td>=IF(H{{$last_row-1}}=0,0,G{{$last_row-1}}/H{{$last_row-1}})</td>
            <td></td>

            <td>=IF(K{{$last_row-1}}=0,0,I{{$last_row-1}}/K{{$last_row-1}})</td>
            <td>=IF(K{{$last_row-1}}=0,0,J{{$last_row-1}}/K{{$last_row-1}})</td>
            <td></td>

            <td>=IF(N{{$last_row-1}}=0,0,L{{$last_row-1}}/N{{$last_row-1}})</td>
            <td>=IF(N{{$last_row-1}}=0,0,M{{$last_row-1}}/N{{$last_row-1}})</td>
            <td></td>
        </tr>
    </tbody>
</table>
