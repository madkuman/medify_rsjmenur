<div style="height: 100px;padding-top: 70px">
	<table>
		<tr>
			<td style="width: 25%">No RM</td>
			<td style="width: 2%">:</td>
			<td>{{$transaksi->pasien_detail->no_rm ?? '-'}}</td>
		</tr>
		<tr>
			<td>Nama Pasien</td>
			<td>:</td>
			<td>{{$transaksi->pasien_detail->name ?? $transaksi->nama_pasien ?? '-'}}</td>
		</tr>
		<tr>
			<td>Tgl Lhr</td>
			<td>:</td>
			<td>{{$transaksi->pasien_detail->date_of_birth ?? '-'}} / {{$transaksi->pasien_detail->age ?? '-'}}</td>
		</tr>
		<tr>
			<td>B/T. Badan</td>
			<td>:</td>
			<td>{{$transaksi->kasus->identitas->berat_badan ?? '-'}} kg / {{$transaksi->kasus->identitas->tinggi_badan ?? '-'}} cm</td>
		</tr>
		<tr>
			<td>Jns</td>
			<td>:</td>
			<td>{{$transaksi->pasien_detail->jenis_kelamin ?? '-'}}</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td>{{$transaksi->pasien_detail->text_alamat ?? '-'}}</td>
		</tr>
	</table>
</div>