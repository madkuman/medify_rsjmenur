<table>
	<tr>
		<td colspan="7">LAPORAN KEPATUHAN JAM VISITE</td>
	</tr>
	<tr>
		<td colspan="7">Ruangan : {{$lokasi}}</td>
	</tr>
	<tr>
		<td colspan="13">{{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<td>No</td>
		<td>Nama Dokter</td>
		<td>Pasien</td>
		<td>Ruangan</td>
		<td>Tgl Visite</td>
		<td>Jam Visite</td>
		<td>Tepat Waktu</td>
	</tr>
	@php $total = 0; @endphp
	@foreach($data as $item)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{$item->creator->name ?? '-'}}</td>
		<td>{{$item->tagihan->kasus->pasien->name ?? '-'}}</td>
		<td>{{$item->lokasi->nama ?? '-'}}</td>
		<td>{{$item->created_at->format('d/m/Y')}}</td>
		<td>{{$item->created_at->format('H:i')}}</td>
		<td>{{$item->is_tepat_waktu}}</td>
		@php $total += $item->is_tepat_waktu @endphp
	</tr>
	@endforeach
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Total</td>
		<td>{{$total}}</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Persentase</td>
		<td>{{round(($total/count($data)*100),2)}}%</td	>
	</tr>
</table>