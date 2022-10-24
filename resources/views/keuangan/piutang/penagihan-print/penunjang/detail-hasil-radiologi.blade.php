	<div class="logo">
		<img src="{{asset('assets/img/rumkital.png')}}" height="75px">
	</div>
	<table width="100%">
		<tr>
			<td class="va-mid centered bot">
				<b class="head"> {{config('app.name')}}</b><br>
				Jl.Menur No. 120, Kode Pos 60282.<br>.<br>
			</td>
		</tr>
	</table>
	<p class="title">RADIOLOGI</p>
	<hr>
	<table style="width: 100%; font-size: 13px;">
		<thead>
			<tr>
				<td class="small-col" >Nama</td>
				<td class="big-col" >: {{$row['transaksi']->pasien->name}}</td>\
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="small-col" >Umur/TTL</td>
				<td class="big-col" >: {{$row['transaksi']->pasien->age}} Tahun / {{$row['transaksi']->pasien->place_of_birth}}, {{date('d F Y', strtotime($row['transaksi']->pasien->date_of_birth))}}</td>
				<td class="small-col" >Register</td>
				<td class="med-col" >: {{$row['transaksi']->pasien->no_rm}} </td>          
			</tr>
			<tr>
				<td class="small-col" >Alamat</td>
				<td class="big-col" >: {{$row['transaksi']->pasien->address}}</td>
				<td class="small-col" >Rumah Sakit</td>
				<td class="med-col" >: {{is_null($row['transaksi']->nama_rs) ? 'RSJ Menur' : $row['transaksi']->nama_rs}}</td>
			</tr>
			<tr>
				<td class="small-col" >Pangkat</td>
				<td class="big-col" >: {{($row['transaksi']->pasien->tni_pangkat_id != 0 && isset($row['transaksi']->pasien->tni_pangkat->nama)) ? $row['transaksi']->pasien->tni_pangkat->nama : '-'}}</td>
				<td class="small-col" >Poli/ Ruang</td>
				<td class="med-col" >: {{ $row['transaksi']->asal['nama'] }}</td>
			</tr>
			<tr>
				<td class="small-col" >Rol / Kesatuan</td>
				<td class="big-col" >: {{($row['transaksi']->pasien->tni_kotama_id != 0 && isset($row['transaksi']->pasien->tni_kotama->nama)) ? $row['transaksi']->pasien->tni_kotama->nama : '-'}} /
					{{($row['transaksi']->pasien->tni_satker_id != 0 && isset($row['transaksi']->pasien->tni_satker->nama)) ? $row['transaksi']->pasien->tni_satker->nama : '-'}} 
				</td>
				<td class="small-col" >Tanggal Terima</td>
				<td class="med-col" >: {{date('d F Y', strtotime($row['transaksi']->created_at))}}</td>
			</tr>
			<tr>
				<td class="small-col" >Dokter</td>
				<td class="big-col" >: {{$dpjp->user->name ?? '-'}}</td>
				<td class="small-col" >Tanggal Selesai</td>
				<td class="med-col" >: {{date('d F Y', strtotime($row['transaksi']->result_created_at))}}</td>
			</tr>
		</tbody>
	</table>
	<hr>
	<div style=" margin-bottom: 30px; font-size: 13px;">
		{!! nl2br($d->hasil_baca) !!}
	</div>
<table style="width: 100%">
	<tr>
		<td style="width: 35%; text-align: center;">Dokter yang memeriksa</td>
		<td style="width: 65%"></td>
	</tr>
	<tr>
		<td colspan="2" style="color: white; font-size: 40px;">dummy</td>
	</tr>
	<tr>
		<td style="width: 35%; text-align: center;">{{$row['transaksi']->pemeriksa->name ?? ''}}</td>
		<td style="width: 65%"></td>
	</tr>
</table>