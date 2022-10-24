<div style="padding: 20px; background-color: #E7F9DF;">
	<div class="row">
		<div class="col-6">
			<table>
				<thead>
					<tr>
						<th colspan="5">IDENTITAS PASIEN</th>
						<th class="text-right"><a href="{{url('')}}/kasus/{{$transaksi->kasus->nomor_kasus}}"><i class="fa fa-archive"></i> Lihat RM</a></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Nama</td>
						<td class="text-center" width="5%">:</td>
						<td width="35%">{{ $transaksi->pasien_detail->name }}</td>
						<td>No RM</td>
						<td class="text-center" width="5%">:</td>
						<td>{{ $transaksi->pasien_detail->no_rm }}</td>
					</tr>
					<tr>
						<td>JK</td>
						<td class="text-center" width="5%">:</td>
						<td width="35%">{{ $transaksi->pasien_detail->gender == 1 ? 'Laki laki' : 'Perempuan' }}</td>
						<td>Jenis Px</td>
						<td class="text-center" width="5%">:</td>
						<td>
							@if(!empty($transaksi->kasus->pembayaran->perusahaan->id))
							{{  $transaksi->kasus->pembayaran->perusahaan->tipe->nama.' - '.$transaksi->kasus->pembayaran->perusahaan->nama }}
							@endif
						</td>
					</tr>
					<tr>
						<td>Usia</td>
						<td class="text-center" width="5%">:</td>
						<td width="35%">{{ $transaksi->pasien_detail->age }}</td>
						<td>Diagnosis</td>
						<td class="text-center" width="5%">:</td>
						<td>{{ $transaksi->diagnosis }}</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="col-6">
			<table>
				<thead>
					<tr>
						<th colspan="5">INFORMASI OPERASI</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Tanggal</td>
						<td class="text-center" width="5%">:</td>
						<td width="35%">{{ \Carbon\Carbon::parse($transaksi->jadwal_operasi)->format('d M Y') }}</td>
						<td>Dokter</td>
						<td class="text-center" width="5%">:</td>
						<td>{{ $transaksi->dokter->name }}</td>
					</tr>
					<tr>
						<td>Ronde</td>
						<td class="text-center" width="5%">:</td>
						<td width="35%">{{ $transaksi->nomor_ronde }}</td>
						<td>Status</td>
						<td class="text-center" width="5%">:</td>
						<td>{{ $transaksi->getStatusInString() }}</td>
					</tr>
					<tr>
						<td>Ruangan</td>
						<td class="text-center" width="5%">:</td>
						<td width="35%">{{ $transaksi->ruangan->name }}</td>
						<td>Dijadwalkan Oleh</td>
						<td class="text-center" width="5%">:</td>
						<td width="35%">@if(!empty($transaksi->pembuat_jadwal->name))
						{{ $transaksi->pembuat_jadwal->name }} @else - @endif</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>