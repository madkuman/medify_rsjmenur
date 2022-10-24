<table>
	<tr>
		<td colspan="10">LAPORAN HARMAT - PERBAIKAN ALAT</td>
	</tr>
	<tr>
		<td colspan="10">{{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<th class="text-center"><b>No</b></th>
        <th class="text-center"><b>Nama Alat</b></th>
        <th class="text-center"><b>Asal Ruangan</b></th>
        <th class="text-center"><b>Tanggal Laporan</b></th>
        <th class="text-center"><b>Tanggal Identifikasi</b></th>
        <th class="text-center"><b>Tanggal Service</b></th>
        <th class="text-center"><b>Tanggal Selesai</b></th>
        <th class="text-center"><b>Status</b></th>
        <th class="text-center"><b>Alasan</b></th>
        <th class="text-center"><b>Sesuai</b></th>
	</tr>
	@foreach($data as $each_data)
		<tr>
			@php
				$rentang_menit = date_diff(date_create($each_data->tgl_laporan), date_create($each_data->tgl_identifikasi))->i;
			@endphp
			<td>{{$loop->iteration}}</td>
            <td class="text-center">{{$each_data->asal_ruangan}}</td>
            <td class="text-center">{{$each_data->nama_alat}}</td>
            <td class="text-center">@if(isset($each_data->tgl_laporan)){{date('d-m-Y H:i', strtotime($each_data->tgl_laporan))}}@else-@endif</td>
            <td class="text-center">@if(isset($each_data->tgl_identifikasi)){{date('d-m-Y H:i', strtotime($each_data->tgl_identifikasi))}}@else-@endif</td>
            <td class="text-center">@if(isset($each_data->tgl_mulai)){{date('d-m-Y', strtotime($each_data->tgl_mulai))}}@else-@endif</td>
            <td class="text-center">@if(isset($each_data->tgl_selesai)){{date('d-m-Y', strtotime($each_data->tgl_selesai))}}@else-@endif</td>
            <td class="text-center">
                @if($each_data->status == 0)
                    Request
                @elseif($each_data->status == 1)
                    Identifikasi
                @elseif($each_data->status == 2)
                    Dikerjakan
                @elseif($each_data->status == 3)
                    Selesai
                @endif
            </td>
            <td class="text-center">{{$each_data->alasan}}</td>
            <td align="center">
            	@if($rentang_menit < 15)
                    &#10004;
                @else
                    &#10060;
                @endif
            </td>
		</tr>
	@endforeach
</table>
