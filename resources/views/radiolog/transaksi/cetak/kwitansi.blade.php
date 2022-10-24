<!DOCTYPE html>
<html>
<head>
	<title>Cetak Permintaan</title>
	<style type="text/css">
	@page{
		margin-top : 15px;
		margin-bottom : 15px;
		margin-right: 50px;
		margin-left: 35px;
	}
	table{
		border-collapse: collapse;
		width: 100%;
		font-family: sans-serif;
		font-size: 12px;
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
		font-size: 14px;
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
	.gap{
		color: white;
		font-size: 7px;
	}
	.bot-border{
		border-bottom: 1px solid black;
	}
	.mx-20{
		margin-left: 20px;
		margin-right: 20px;
	}
	.righted{
		text-align: right;
	}
	.kop{
		border: 4px solid black;
		border-radius: 5px;
		width: 50%
	}
</style>
</head>
<body>
	<div class="kop">
		<table width="100%">
			<tr>
				<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
			</tr>
		</table>
	</div>
	<table>
		<tr>
			<td colspan="2" class="gap">-</td>
		</tr>
		<tr>
			<td width="50%" class="bold"><u>KWITANSI</u> A.</td>
			<td width="50%" class="bold righted">POLI : {{$transaksi->asal->nama ?? '-'}}</td>
		</tr>
	</table>
	
	<br>
	<table>
		<tr>
			<td width="20%">Terima dari</td>
			<td width="2%">:</td>
			<td width="78%">{{$transaksi->pasien->name}}</td>
		</tr>
		<tr>
			<td>Terbilang</td>
			<td>:</td>
			<td>{{$terbilang}}</td>
		</tr>
		<tr>
			<td colspan="3" class="gap">-</td>
		</tr>
		<tr>
			<td colspan="3">Untuk biaya sesuai rincian</td>
		</tr>
	</table>
	<table>
		<tr>
			<td colspan="5" class="gap">-</td>
		</tr>
		<tr>
			<td width="20%">Jumlah</td>
			<td width="2%">:</td>
			<td width="4%">Rp</td>
			<td width="34%">{{number_format($transaksi->harga_total,0)}}</td>
			<td class="righted" width="40%">Surabaya, {{date('d F Y')}}</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td class="centered"><u>RINCIAN BIAYA</u></td>
		</tr>
		<tr>
			<td class="gap">-</td>
		</tr>
	</table>
	<table>
		<tr>
			<td colspan="5"><u>TINDAKAN</u></td>
		</tr>
		@php $i=1 @endphp
		@foreach($transaksi->detail as $detail)
			<tr>
				<td width="10%"></td>
				<td width="5%">{{$i++}}.</td>
				<td width="55%">{{$detail->tarif->deskripsi}}</td>
				<td width="10%">Rp.</td>
				<td width="20%" class="righted">{{number_format($detail->harga)}}</td>
			</tr>
		@endforeach
	</table>
	<br>
	<table class="bot-border">
		<tr>
			<td colspan="5"><u>MATERIAL KESEHATAN</u></td>
		</tr>
		@for($i = 1; $i <= 3; $i++)
		<tr>
			<td width="10%"></td>
			<td width="5%">{{$i}}.</td>
			<td width="55%">....................................................</td>
			<td width="10%">Rp.</td>
			<td width="20%" class="righted">..........................</td>
		</tr>
		@endfor
	</table>
	<br>
	<table>
		<tr>
			<td width="70%" class="bold">JUMLAH</td>
			<td width="10%">Rp.</td>
			<td width="20%" class="righted">{{number_format($transaksi->harga_total,0)}}</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="60%"></td>
			<td width="40%" class="centered">Surabaya, {{date('d F Y')}}</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">Dokter yang merawat,</td>
		</tr>
		<tr>
			<td class="ttd" colspan="2">-</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">(................................................)</td>
		</tr>
	</table>
</body>
</html>