<!DOCTYPE html>
<html>
<head>
	<title>Perincian Pasien Rawat Inap</title>
	<style type="text/css">
		body{
			font-size: 12px;
			font-family: sans-serif;
		}
		table{
			width: 100%;
			border-collapse: collapse;
		}
		.bordered td{
			border: 1px solid black;
			padding-left: 5px;
			padding-right: 5px;
		}
		.centered{
			text-align: center;
		}
		.bot{
			border-bottom: 1px solid black;
		}
		td{
			word-wrap: break-word;
			vertical-align: top;
		}
	</style>
</head>
<body>
	<table width="100%">
		<tr>
			<td colspan="5">PERINCIAN PASIEN MASUK / PINDAHAN / DIPINDAH / KELUAR</td>
		</tr>
		<tr>
			<td colspan="5">TANGGAL DILAPORKAN : {{indonesian_date($date_start,'d F Y')}} - {{indonesian_date($date_end,'d F Y')}}</td>
		</tr>
		<tr><td></td></tr>
		<tr><td></td></tr>



		<tr>
			<td colspan="6">PASIEN MASUK RUMAH SAKIT</td>
		</tr>
		<tr>
			<td rowspan="2">NO RM</td>
			<td rowspan="2">NAMA</td>
			<td rowspan="2">RUANGAN</td>
			<td colspan="2">UMUR</td>
			<td rowspan="2">JENIS PASIEN / STATUS</td>
			<td rowspan="2">KELAS</td>
			<td rowspan="2">DIAGNOSIS</td>
			<td rowspan="2">TGL MRS</td>
		</tr>
		<tr>
			<td>L</td>
			<td>P</td>
		</tr>
		@foreach($mrs as $m)
		<tr>
			<td>{{$m->pasien->no_rm ?? '-'}} </td>
			<td>{{$m->pasien->name ?? '-'}}</td>
			<td>{{$m->lokasi->lokasi->ruangan->bangsal->nama ?? '-'}}</td>
			@if($m->pasien->gender == "1")
			<td>{{$m->identitas->age_year}}</td>
			<td></td>
			@else
			<td></td>
			<td>{{$m->identitas->age_year}}</td>
			@endif
			<td>{{$m->pembayaran->perusahaan->nama ?? '-'}}</td>
			<td>{{$m->kelas->nama}}</td>
			<td>{{$m->diagnosisUtama->icd10->code_icd ?? '-'}}</td>
			<td>{{$m->mrs_at ?? '-'}}</td>
		</tr>
		@endforeach
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>








		<tr>
			<td colspan="5">PASIEN PINDAHAN / DIPINDAH / RUBAH STATUS</td>
		</tr>
		<tr>
			<td>NO RM</td>
			<td>NAMA</td>
			<td>DARI RUANGAN / STATUS LAMA</td>
			<td>KE RUANGAN / STATUS BARU</td>
			<td>JENIS PASIEN / TANGGAL RUBAH</td>
			<td>KELAS</td>
		</tr>
		@foreach($pindahan as $p)
		<tr>
			<td>{{$p->no_rm ?? '-'}}</td>
			<td>{{$p->nama ?? '-'}}</td>
			<td>{{$p->ruangan_awal}}</td>
			<td>{{$p->ruangan_akhir}}</td>
			<td>{{$p->tgl_masuk}}</td>
			<td>{{$p->kelas}}</td>
		</tr>
		@endforeach
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>





		<tr>
			<td colspan="10">PASIEN KELUAR RUMAH SAKIT (KRS)</td>
		</tr>
		<tr>
			<td rowspan="2">NO RM</td>
			<td rowspan="2">NAMA</td>
			<td rowspan="2">RUANGAN</td>
			<td colspan="5">HIDUP</td>
			<td colspan="2">MENINGGAL</td>
			<td rowspan="2">ICD X</td>
		</tr>
		<tr>
			<td>SEMBUH</td>
			<td>MEM BAIK</td>
			<td>APS</td>
			<td>LARI</td>
			<td>DIRUJUK</td>
			<td> &le; 48 </td>
			<td> &gt; 48 </td>
		</tr>
		@foreach($krs as $item)
		<tr>
			<td>{{$item->pasien->no_rm ?? '-'}}</td>
			<td>{{$item->pasien->name ?? '-'}}</td>
			<td>{{$item->lokasi->lokasi->ruangan->bangsal->nama ?? '-'}}</td>
			<td>@if(($item->status_krs->nama ?? '') == "Sehat") X @endif</td>
			<td>@if(($item->status_krs->nama ?? '') == "Membaik") X @endif</td>
			<td>@if(($item->alasan_krs->nama ?? '') == "APS") X @endif</td>
			<td>@if(($item->alasan_krs->nama ?? '') == "Melarikan Diri") X @endif</td>
			<td>@if(($item->alasan_krs->nama ?? '') == "Rujuk Rumah Sakit Lain") X @endif</td>
			<td>@if(isset($item->pasien) && ($item->status_krs->nama ?? '') == "Meninggal" && $item->lama_perawatan < 2) X @endif</td>
			<td>@if(isset($item->pasien) && ($item->status_krs->nama ?? '') == "Meninggal" && $item->lama_perawatan > 2) X @endif</td>
			<td>{{$item->diagnosisUtama->icd10->code_icd ?? '-'}}</td>
		</tr>
		@endforeach
	</table>
</body>
</html>
