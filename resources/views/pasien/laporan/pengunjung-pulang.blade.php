<table>
	<tr>
		<td colspan="8">LAPORAN PENGUNJUNG IGD</td>
	</tr>
	<tr><td colspan="8"></td></tr>
	<tr><td colspan="8"></td></tr>
	<tr>
		<td colspan="2">Lokasi</td>
		<td colspan="2">{{$lokasi_text}}</td>
	</tr>
	<tr>
		<td colspan="2">Tanggal</td>
		<td colspan="2">{{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<td colspan="2">Status</td>
		<td colspan="2">@if($status == 1) Pulang @else Rawat Inap @endif</td>
	</tr>
	<tr>
		<td colspan="2">Total</td>
		<td colspan="2">{{count($data)}}</td>
	</tr>
	<tr>
		<td colspan="8"></td>
	</tr>
	<tr>
		<td><b>No</b></td>
		<td><b>No RM</b></td>
		<td><b>Nama</b></td>
		<td><b>Tanggal Kunjungan</b></td>
		<td><b>Lokasi</b></td>
		<td><b>Status KRS</b></td>
		<td><b>Alasan KRS</b></td>
		<td><b>Diagnosis</b></td>
	</tr>
	@foreach($data as $kasus)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{$kasus->pasien->no_rm ?? '-'}}</td>
		<td>{{$kasus->pasien->name ?? '-'}}</td>
		<td>{{$kasus->created_at->format('d/m/Y')}}</td>
		<td>{{$kasus->lokasi->lokasi->nama ?? '-'}}</td>
		<td>{{$kasus->status_krs->nama ?? '-'}}</td>
		<td>{{$kasus->alasan_krs->nama ?? '-'}}</td>
		<td>
			@foreach($kasus->diagnosis as $dx)
			{{$dx->icd10->code_icd ?? '-'}} - {{$dx->icd10->long_desc ?? '-'}}
			@if(!$loop->last), @endif
			@endforeach
		</td>
	</tr>
	@endforeach
</table>