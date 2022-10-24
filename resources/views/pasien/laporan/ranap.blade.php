<!DOCTYPE html>
<html>
<head>
	<title>Laporan Rawat Inap</title>
	<style type="text/css">
	table{
		border-collapse: collapse;;
		width: 100vw;
		font-size: 10px;
	}
	.title{
		text-align: center;
		vertical-align: middle;
	}
	.bordered{
		border: 1px solid black;
	}
	.center{
		text-align: center;
	}
	.big{
		font-weight: bold;
	}
	td
	{
		padding: 2px;
	}
</style>
</head>
<body>
	<table>
		<tr>
			<td class="big" colspan="4">PASIEN RAWAT INAP {{strtoupper(config('app.name'))}}</td>
		</tr>
		<tr>
			<td colspan="4">Tanggal: {{indonesian_date(strtotime($start))}} - {{indonesian_date(strtotime($end))}}</td>
		</tr>
	</table>
	<br>
	<table>
		<thead>
			<tr>
				<th class="bordered title" style="width: 3%">No</th>
				<th class="bordered title" style="width: 7%">No RM</th>
				<th class="bordered title" style="width: 10%">Nama Pasien</th>
				<th class="bordered title" style="width: 15%">Alamat</th>
				<th class="bordered title" style="width: 3%">Jenis Kelamin</th>
				<th class="bordered title" style="width: 5%">Umur</th>
				<th class="bordered title" style="width: 5%">Agama</th>
				<th class="bordered title" style="width: 5%">Jenis Pasien</th>
				<th class="bordered title" style="width: 5%">Jenis Kunjungan</th>
				<th class="bordered title" style="width: 5%">Krs Sebelumnya</th>
				<th class="bordered title" style="width: 7%">Masuk Dari</th>
				<th class="bordered title" style="width: 7%">Bagian</th>
				<th class="bordered title" style="width: 7%">Kamar</th>
				<th class="bordered title" style="width: 5%">Kelas</th>
				<th class="bordered title" style="width: 7%">Tgl Masuk</th>
				<th class="bordered title" style="width: 7%">Tgl Keluar</th>
				<th class="bordered title" style="width: 7%">Lama Dirawat</th>
				<th class="bordered title" style="width: 10%">Nama Dokter</th>
				<th class="bordered title" style="width: 12%">Diagnosa</th>
				<th class="bordered title" style="width: 10%">Status Keluar RS</th>
				<th class="bordered title" style="width: 10%">Alasan Pulang</th>
				<th class="bordered title" style="width: 10%">No SEP</th>
				<th class="bordered title" style="width: 10%">Plafon</th>
				<th class="bordered title" style="width: 10%">Total Tagihan</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $item)
			<tr>
				<td class="bordered center">{{$loop->iteration}}</td>
				<td class="bordered center">{{$item->pasien->no_rm ?? "-"}}</td>
				<td class="bordered">{{$item->pasien->name ?? "-"}}</td>
				<td class="bordered">{{$item->pasien->address ?? "-"}}</td>
				<td class="bordered center">{{$item->pasien->jenis_kelamin ?? "-"}}</td>
				<td class="bordered center">{{$item->kasus->identitas->age ?? "-"}}</td>
				<td class="bordered">{{$item->pasien->agama->nama ?? "-"}}</td>
				<td class="bordered">{{$item->pasien_pembayaran->perusahaan->nama ?? "-"}}</td>
				<td class="bordered">{{!empty($item->kasus->is_baru) ? "Baru" : "Lama"}}</td>
				<td class="bordered">{{!empty($item->krs_sebelum) ? indonesian_date(strtotime($item->krs_sebelum)) : "-"}}</td>
				<td class="bordered">{{$item->kasus->lokasi_first->lokasi->nama ?? "-"}}</td>
				<td class="bordered">{{$item->tempat_tidur->ruangan->bangsal->nama ?? "-"}}</td>
				<td class="bordered">{{$item->tempat_tidur->ruangan->nama ?? "-"}} {{$item->tempat_tidur->nama ?? "-"}}</td>
				<td class="bordered">{{$item->kasus->kelas->nama}}</td>
				<td class="bordered center">{{indonesian_date($item->kedatangan_at) ?? "-"}}</td>
				<td class="bordered center">{{indonesian_date($item->krs_at) ?? "-"}}</td>
				<td class="bordered center">
					@php
						$start = Carbon\Carbon::parse($item->kedatangan_at);
						$end = Carbon\Carbon::parse($item->krs_at);
						$selisih = $start->diffInDays($end) + 2; 
					@endphp
					{{$selisih}}

				</td>
				<td class="bordered">{{$item->kasus->admin->user->name ?? "-"}}</td>
				<td class="bordered">
					@foreach($item->kasus->diagnosis as $dx)
					- {{$dx->icd10->code_icd}}<br>
					@endforeach
				</td>
				<td class="bordered">{{$item->kasus->status_krs->nama ?? ''}}</td>
				<td class="bordered">{{$item->kasus->alasan_krs->nama}}</td>
				<td class="bordered">{{$item->kasus->sep->no_sep ?? '-'}}</td>
				<td class="bordered">{{$item->kasus->sep->total_plafon ?? '-'}}</td>
				<td class="bordered">{{$item->total_tagihan ?? '-'}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>