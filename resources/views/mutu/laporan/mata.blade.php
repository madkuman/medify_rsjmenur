<table>
	<tr>
		<td colspan="8">LAPORAN AUDIT MATA</td>
	</tr>
	<tr>
		<td colspan="8">{{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<td align="center" rowspan="2"><b>No</b></td>
		<td align="center" rowspan="2"><b>Tanggal</b></td>
		<td align="center" rowspan="2"><b>No RM</b></td>
		<td align="center" rowspan="2"><b>Nama</b></td>
		<td align="center" rowspan="2"><b>Lokasi</b></td>
		<td align="center" rowspan="2"><b>DPJP</b></td>
		<td colspan="2" style="text-align: center;"><b>Diagnosis</b></td>
	</tr>
	<tr>
		<td align="center"><b>Kode</b></td>
		<td align="center"><b>Deskripsi</b></td>
	</tr>
	@foreach($data as $item)
	<tr>
		<td align="center">{{$loop->iteration}}</td>
		<td align="center">{{indonesian_date($item->created_at,'d/m/Y')}}</td>
		<td align="center">{{$item->kasus->pasien->no_rm}}</td>
		<td>{{$item->kasus->pasien->name}}</td>
		<td>{{$item->kasus->lokasi->lokasi->nama}}</td>
		<td>{{$item->kasus->dpjp['user']['name']}}</td>
		<td align="center">{{$item->icd10->code_icd}}</td>
		<td>{{$item->icd10->long_desc}}</td>
	</tr>
	@endforeach
	<tr></tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="center"><b>Jumlah</b></td>
		<td align="center"><b>{{$jumlah}}</b></td>
	</tr>
</table>
