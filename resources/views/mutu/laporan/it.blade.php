<table>
	<tr>
		<td colspan="10">LAPORAN KOMPLAIN IT</td>
	</tr>
	<tr>
		<td colspan="10">{{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<td align="center" rowspan="2" valign="middle"><b>No</b></td>
		<td align="center" rowspan="2" valign="middle"><b>Hari</b></td>
		<td align="center" rowspan="2" valign="middle"><b>Tanggal</b></td>
		<td align="center" rowspan="2" valign="middle"><b>Ruang/Poli</b></td>
		<td align="center" rowspan="2" valign="middle"><b>Jenis</b></td>
		<td align="center" rowspan="1" colspan="2"><b>Jam</b></td>
		<td align="center" rowspan="1" colspan="2"><b>Catatan</b></td>
		<td align="center" rowspan="2" valign="middle"><b>Teknisi</b></td>
		<td align="center" rowspan="2" valign="middle"><b>Sesuai</b></td>
	</tr>
	<tr>
		<td align="center"><b>Komplain</b></td>
		<td align="center"><b>Respon</b></td>
		<td align="center"><b>Komplain</b></td>
		<td align="center"><b>Respon</b></td>
	</tr>
	@foreach($data as $each_data)
	{{-- {{dd($each_data)}} --}}
		<tr>
			@if(!empty($each_data->jam_respon))
			@php
				$rentang_menit = date_diff(date_create($each_data->jam_komplain), date_create($each_data->jam_respon))->i;
			@endphp
			@else
			@php $rentang_menit = 61 @endphp
			@endif
			<td align="center">{{$loop->iteration}}</td>
            <td>{{indonesian_date($each_data->tgl_komplain, 'l')}}</td>
            <td align="center">{{date('d/m/Y', strtotime($each_data->tgl_komplain))}}</td>
            <td>{{$each_data->lokasi}}</td>
            <td align="center">{{$each_data->jenisKomplain->nama ?? '-'}}</td>
            <td align="center">{{date('H:i', strtotime($each_data->jam_komplain))}}</td>
            <td align="center">{{!empty($each_data->jam_respon) ? date('H:i', strtotime($each_data->jam_respon)) : ''}}</td>
            <td>{{$each_data->catatan}}</td>
            <td>{{$each_data->respon ?? ''}}</td>
            <td align="center">{{!empty($each_data->teknisinya) ? $each_data->teknisinya->name : ''}}</td>
            <td align="center">
            	@if($rentang_menit < 60)
            		&#10004;
            	@else
                    &#10060;
            	@endif
            </td>
		</tr>
	@endforeach
</table>
