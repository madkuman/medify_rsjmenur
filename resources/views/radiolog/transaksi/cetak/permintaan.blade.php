<!DOCTYPE html>
<html>
<head>
	<title>Cetak Permintaan</title>
	<style type="text/css">
	@page{
		margin-top : 15px;
		margin-bottom : 15px;
		margin-right: 25px;
		margin-left: 15px;
	}
	table{
		border-collapse: collapse;
		width: 100%;
		font-family: sans-serif;
		font-size: 10px;
	}
	.centered{
		text-align: center;
	}
	.underline{
		text-decoration: underline;
	}
	.bordered, .bordered td{
		border: 1px solid black;
	}
	.bordered td{
		padding-left: 10px;
	}
	.bold{
		font-weight: bold;
	}
	.big{
		font-size: 12px;
	}
	.m-20{
		margin: 20px;
	}
	td{
		vertical-align: top;
	}
	.stretched{
		-webkit-transform:scale(1,1.5);
	}
	.fill{
		color: white;
		font-size: 80px;
	}
	.ttd{
		color: white;
		font-size: 30px;	
	}
	.bot-border{
		border-bottom: 1px solid black;
	}
	.mx-20{
		margin-left: 20px;
		margin-right: 20px;
	}
	.parent{
		border: 5px solid black;
		font-family: courier !important;
		text-align: center;
		vertical-align: middle;
		font-weight: bold;
		font-size: 17px;
	}
	.mr-20{
		margin-right: 20px;
	}
	.br{
		color: white;
		font-size: 5px;
	}
</style>
</head>
<body>

	<table class="mr-20">
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
						<td class="big centered bold bot-border">RADIOLOGI</td>
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
						<td>{{$transaksi->pasien->no_rm}}</td>
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
				<td width="50%">{{$transaksi->asal->nama ?? ""}}</td>
				<td width="13%">Tanggal SEP</td>
				<td width="2%">:</td>
				<td width="20%">{{isset($transaksi->kasus->active_sep->created_at) ? 
					date('d F Y', strtotime($transaksi->kasus->active_sep->created_at)) : ""}}</td>
				</tr>
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td colspan="4">{{$transaksi->pasien->name}} ({{$transaksi->pasien->gender == 1 ? 'Laki laki' : 'Perempuan' }}, {{$transaksi->pasien->age}} Tahun)</td>
				</tr>
				<tr>
					<td>No_SEP</td>
					<td>:</td>
					<td>{{$transaksi->kasus->active_sep->no_sep ?? ""}}</td>
				</tr>
				<tr>
					<td>Diagnosa</td>
					<td>:</td>
					<td>{{$transaksi->kasus->diagnosisUtama->icd10->code_icd ?? ""}} {{$transaksi->kasus->diagnosisUtama->icd10->long_desc ?? ""}}</td>
					<td rowspan="4" colspan="3" class="parent">{{$transaksi->asal->nama ?? "Radiologi"}}</td>
				</tr>
				<tr>
					<td>Anggota/Klg</td>
					<td>:</td>
					<td>{{$transaksi->pasien->tni_anggota->nama ?? ""}}</td>
				</tr>
				<tr>
					<td>Pangkat</td>
					<td>:</td>
					<td>{{$transaksi->pasien->tni_pangkat->nama ?? ""}}</td>
				</tr>
				<tr>
					<td>Kesatuan</td>
					<td>:</td>
					<td>{{$transaksi->pasien->tni_kesatuan->nama ?? ""}}</td>
				</tr>
			</table>
			<div class="br">.</div>
			<table>
				<tr>
					<td>Pemeriksaan/tindakan yang diminta :</td>
				</tr>
				<tr>
					<td>@foreach($transaksi->detail as $d)
						- {{$d->tarif->deskripsi}}<br>
						@endforeach
					</td>
				</tr>
			</table>
			<div class="br">.</div>
			<table>
				<tr>
					<td>Keterangan Permintaan :</td>
				</tr>
				<tr>
					<td>{{{$transaksi->keterangan_permintaan}}}</td>
				</tr>
			</table>
			<div class="br">.</div>
			<table>
				<tr>
					<td>Klinis :</td>
				</tr>
				<tr>
					<td>{{{$transaksi->keterangan}}}</td>
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
				@if($transaksi->tanpa_kasus == 1)
					<tr>
						<td></td>
						<td class="ttd centered">@if(!is_null($transaksi->nama_dokter) || is_null($transaksi->creator->ttd))
							-
							@else
							<img src="{{asset($transaksi->creator->ttd)}}" style="height: 50px;" />
							@endif
						</td>
					</tr>
					<tr>
						<td></td>
						<td class="centered">({{is_null($transaksi->nama_dokter) ? $transaksi->creator['name'] : $transaksi->nama_dokter}})</td>
					</tr>
				@else
					<tr>
						<td></td>
						@php
						$ttd = $transaksi->kasus->dpjp->user->ttd ?? '';
						@endphp
						<td class="ttd centered">@if(empty($ttd))
							-
							@else
							<img src="{{asset($transaksi->kasus->dpjp->user->ttd)}}" style="height: 50px;" />
							@endif
						</td>
					</tr>
					<tr>
						<td></td>
						<td class="centered">({{$transaksi->kasus->dpjp->user->name ?? $transaksi->creator['name']}})</td>
					</tr>
				@endif
			</table>
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
	</body>
	</html>