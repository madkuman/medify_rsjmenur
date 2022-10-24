<table>
<tr>
	<td width="25%">
		<table>
			<tr>
				<td class="underline bold centered">{{config('app.name')}}</td>
			</tr>
			<tr>
				<td class="bold centered">BPJS KESEHATAN</td>
			</tr>
		</table>
		<table class="m-20">
			<tr>
				<td class="centered bordered bold stretched">A K T I F</td>
			</tr>
		</table>
	</td>

	<td width="10%">
	</td>

	<td width="27%">
		<table>
			<tr>
				<td class="big centered bold">PERMINTAAN</td>
			</tr>
			<tr>
				<td class="big centered bold bot-border">{{$departemen}}</td>
			</tr>
		</table>
	</td>

	<td width="18%">
	</td>

	<td width="20%">
		<table class="bordered">
			<tr>
				<td>NO.RM</td>
			</tr>
			<tr>
				<td>{{$row['transaksi']->pasien->no_rm}}</td>
			</tr>
			<tr>
				<td class="centered">Wajib diisi 6 digit</td>
			</tr>
		</table>
	</td>
</tr>
</table>
<div class="mx-20">
<table>
	<tr>
		<td width="13%">Poli/Ruang</td>
		<td width="2%">:</td>
		<td width="50%">{{$row['transaksi']->asal->nama ?? ""}}</td>
		<td width="13%">Tanggal SEP</td>
		<td width="2%">:</td>
		<td width="20%">{{isset($row['transaksi']->kasus->active_sep->created_at) ? 
			date('d F Y', strtotime($row['transaksi']->kasus->active_sep->created_at)) : ""}}</td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td colspan="4">{{$row['transaksi']->pasien->name}} ({{$row['transaksi']->pasien->gender == 1 ? 'Laki laki' : 'Perempuan' }}, {{$row['transaksi']->pasien->age}} Tahun)</td>
		</tr>
		<tr>
			<td>No_SEP</td>
			<td>:</td>
			<td>{{$row['transaksi']->kasus->active_sep->no_sep ?? ""}}</td>
		</tr>
		<tr>
			<td>Diagnosa</td>
			<td>:</td>
			<td>{{$row['transaksi']->kasus->diagnosisUtama->icd10->code_icd ?? ""}} {{$row['transaksi']->kasus->diagnosisUtama->icd10->long_desc ?? ""}}</td>
			<td rowspan="4" colspan="3" class="parent">{{$row['transaksi']->asal->nama ?? "Radiologi"}}</td>
		</tr>
		<tr>
			<td>Anggota/Klg</td>
			<td>:</td>
			<td>{{$row['transaksi']->pasien->tni_anggota->nama ?? ""}}</td>
		</tr>
		<tr>
			<td>Pangkat</td>
			<td>:</td>
			<td>{{$row['transaksi']->pasien->tni_pangkat->nama ?? ""}}</td>
		</tr>
		<tr>
			<td>Kesatuan</td>
			<td>:</td>
			<td>{{$row['transaksi']->pasien->tni_kesatuan->nama ?? ""}}</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td>Pemeriksaan/tindakan yang diminta :</td>
		</tr>
		<tr>
			<td>@foreach($row['transaksi']->detail as $d)
				- {{$d->tarif->deskripsi}}<br>
				@endforeach
			</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td>Keterangan Permintaan :</td>
		</tr>
		<tr>
			<td>{{{$row['transaksi']->keterangan_permintaan}}}</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td>Klinis :</td>
		</tr>
		<tr>
			<td>{{{$row['transaksi']->keterangan}}}</td>
		</tr>
	</table>
	<table>
		<tr>
			<td width="70%"></td>
			<td width="30%" class="centered">Surabaya, {{date('d F Y')}}</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">Dokter yang meminta,</td>
		</tr>
		<tr>
			<td></td>
			<td class="ttd centered">@if(is_null($row['transaksi']->creator->ttd))
				-
				@else
				<img src="{{asset($row['transaksi']->creator->ttd)}}" style="height: 50px;" />
				@endif
			</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">({{is_null($row['transaksi']->nama_dokter) ? $row['transaksi']->creator['name'] : $row['transaksi']->nama_dokter}})</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td class="bot-border centered">BUKTI PELAYANAN</td>
		</tr>
		<tr>
			<td class="centered">Telah menerima pelayanan pemeriksaan / tindakan seperti diatas</td>
		</tr>
	</table>
	<table>
		<tr>
			<td width="70%"></td>
			<td width="30%" class="centered">Tanda Tangan Peserta</td>
		</tr>
		<tr>
			<td colspan="2" class="ttd">-</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">(.....................................)</td>
		</tr>
	</table>
</div>