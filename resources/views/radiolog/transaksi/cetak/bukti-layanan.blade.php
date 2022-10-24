<!DOCTYPE html>
<html>
<head>
	<title>Cetak Bukti Layanan</title>
	<style type="text/css">
	@page{
		margin : 15px 25px;
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
		font-size: 150px;
	}
	.ttd{
		color: white;
		font-size: 25px;	
	}
	.deskripsi{
		position: absolute;
		top: 135px;
		left: 10px;
		z-index: 100;
		font-size: 10px;
	}
</style>
</head>
<body>
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
			</td>

			<td width="10%">
			</td>

			<td width="27%">
				<table>
					<tr>
						<td class="underline bold centered big">BUKTI PELAYANAN</td>
					</tr>
					<tr>
						<td class="big centered">RADIOLOGI</td>
					</tr>
				</table>
			</td>

			<td width="18%">
				<table class="m-20">
					<tr>
						<td class="centered bordered big bold stretched">A K T I F</td>
					</tr>
				</table>
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
	<table>
		<tr>
			<td width="10%">Nama</td>
			<td width="1%">:</td>
			<td width="45%">{{$transaksi->pasien->name}}</td>
			<td width="18%"></td>
			<td width="1%"></td>
			<td width="25%"></td>
		</tr>
		<tr>
			<td>No_SEP</td>
			<td>:</td>
			<td>{{$transaksi->kasus->active_sep->no_sep ?? " - "}}</td>
			<td>Tanggal SEP</td>
			<td>:</td>
			<td>
				@if(!is_null($transaksi->kasus)&&isset($transaksi->kasus->active_sep->created_at))
					{{date('d F Y', strtotime($transaksi->kasus->active_sep->created_at))}}
				@else
					-
				@endif</td>
		</tr>
		<tr>
			<td>Diagnosa</td>
			<td>:</td>
			<td>{{$transaksi->kasus->diagnosisUtama->icd10->long_desc ?? " - "}}</td>
			<td>Tanggal Pelayanan</td>
			<td>:</td>
			<td>{{date('d F Y', strtotime($transaksi->result_created_at)) ?? " - "}}</td>
		</tr>
	</table>
	<table class="bordered">
		<tr>
			<td class="centered">J E N I S&nbsp;&nbsp;P E L A Y A N A N</td>
		</tr>
		<tr>
			<td class="fill">.</td>
		</tr>
	</table>
	<div class="deskripsi">
		@foreach($transaksi->detail as $key => $detail)
		- {{ isset($detail->tarif->deskripsi) ? $detail->tarif->deskripsi : "" }} <br>
		@endforeach
		<br>
		@foreach($transaksi->tindakan as $key => $t)
		- {{ $t->icd9->long_desc ?? "" }} <br>		
		@endforeach
	</div>
	<table>
		<tr>
			<td width="30%" class="centered bold">Pemberi Pelayanan,</td>
			<td width="40%"></td>
			<td width="30%" class="centered bold">Penerima Pelayanan,</td>
		</tr>
		<tr>
			<td class="ttd">
				@if(!is_null($transaksi->pemeriksa->ttd))
					<img src="{{asset($transaksi->pemeriksa->ttd)}}" style="height: 50px; margin-left: 35px;" />
				@else
					-
				@endif
			</td>
			<td class="ttd">-</td>
			<td class="ttd">-</td>
		</tr>
		<tr>
			<td class="centered"></td>
			<td></td>
			<td class="centered">Nama : {{$transaksi->pasien->name ?? '...................................'}} </td>
		</tr>
	</table>
</body>
</html>