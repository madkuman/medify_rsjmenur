<table>
	<tr>
		<td colspan="6">LAPORAN HARMAT - LISTRIK MATI</td>
	</tr>
	<tr>
		<td colspan="6">{{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<th class="text-center"><b>No</b></th>
        <th class="text-center"><b>Tanggal</b></th>
        <th class="text-center"><b>Jam</b> Mati</th>
        <th class="text-center"><b>Jam</b> Nyala</th>
        <th class="text-center"><b>Keterangan</b></th>
        <th class="text-center"><b>Sesuai</b></th>
	</tr>
	@foreach($data as $each_data)
		<tr>
			@php
				$rentang_menit = date_diff(date_create($each_data->mati_at), date_create($each_data->nyala_at))->i;
			@endphp
			<td>{{$loop->iteration}}</td>
            <td>{{date("j F Y",strtotime($each_data->mati_at))}}</td>
            <td>{{date("H:i:s",strtotime($each_data->mati_at))}}</td>
            <td>{{date("H:i:s",strtotime($each_data->nyala_at))}}</td>
            <td>{{$each_data->keterangan}}</td>
            <td align="center">
            	@if($rentang_menit < 3)
                    &#10004;
                @else
                    &#10060;
                @endif
            </td>
		</tr>
	@endforeach
</table>
