<!DOCTYPE html>
<html>
<head>
	<title>Cetak Label Obat</title>
	<style type="text/css">
	html{
		margin:10px;
		margin-bottom: 0px;
		font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
	}
	@page{
		margin-bottom: 0px;
	}
	.page-break {
		page-break-after: always;
	}
	.box {
		border: 1px solid black;
		padding-top: 7px;
		padding-right: 0px;
		padding-left: 7px;
		padding-bottom: 0px;
	}
	.table {
		width: 100%;
		border-collapse: collapse;
	}
	.fs-8 {
		font-size: 8px;
	}
	.table-bordered, .table-bordered td, .table-bordered th {
		border: 1px solid #000;
	}
	.table-bordered td {
		padding: 2px 3px 2px 3px;
		font-weight: normal;
	}
	.text-small {
		font-size: 8px;
	}
	.mt-5 {
		margin-top: 5px;
	}
	.mt-25 {
		margin-top:25px;
	}
	.mt-10 {
		margin-top:10px;
	}
	.text-center {
		text-align: center !important;
	}
	.text-right {
		text-align: right !important;
	}
	.rs-title { 
		font-size: 11px;
	}
	.rs-subtitle {
		font-size: 8px;
	}
</style>
</head>
<body>
	@foreach($transaksi->final_detail->resep_detail as $i => $detail)
	<div class="box">
		<div class="text-center" style="width: 100%">
			<div class="rs-title">
				<b>{{config('app.name')}}</b>
			</div>
			<div class="rs-subtitle" style="text-transform: uppercase;">
				UNIT PELAYANAN FARMASI {{session('farmasi')->nama}}
			</div>
		</div>

		<div class="mt-5">
			<table class="table">
				<tr class="text-right">
					<td class="fs-8">Tanggal : {{date('d F Y')}}</td>
				</tr>
			</table>
		</div>
		<div class="">
			<table class="table">
				<tr>
					<td class="fs-8">Nama Pasien / Usia</td>
					<td class="fs-8">:</td>
					@if($transaksi->pasien_detail)
					<td class="fs-8">{{ substr(($transaksi->pasien_detail ? $transaksi->pasien_detail->name : $transaksi->nama_pasien), 0,15)}} / {{$transaksi->pasien_detail->age ?? '-'}}</td>
					@else
					<td class="fs-8">{{$transaksi->nama_pasien ?? 'Pasien Bebas'}} / -</td>
					@endif
				</tr>
				<tr>
					<td class="fs-8">Ruangan</td>
					<td class="fs-8">:</td>
					<td class="fs-8">{{ $transaksi->kasus->lokasi->lokasi->nama ?? 'Kemoterapi'}}</td>
				</tr>
				<tr>
					<td class="fs-8">Sediaan Obat</td>
					<td class="fs-8">:</td>
					<td class="fs-8">{{$detail->dagang}}</td>
				</tr>
				<tr>
					<td class="fs-8">Dosis</td>
					<td class="fs-8">:</td>
					<td class="fs-8">{{$detail->dosis}}</td>
				</tr>
				<tr>
					<td class="fs-8">Dalam</td>
					<td class="fs-8">:</td>
					<td class="fs-8">{{($detail->obat_detail->item_detail->nama ?? '-').', '.$detail->volume_infus}}</td>
				</tr>
				<tr>
					<td class="fs-8">Rute Pemberian</td>
					<td class="fs-8">:</td>
					<td class="fs-8">{{$detail->satuan_penggunaan}}</td>
				</tr>
				<tr>
					<td class="fs-8">Lama Pemberian</td>
					<td class="fs-8">:</td>
					<td class="fs-8">{{$detail->lama_pemberian}}</td>
				</tr>
				<tr>
					<td class="fs-8">Penyimpanan</td>
					<td class="fs-8">:</td>
					<td class="fs-8">{{$detail->kondisi}} / {{$detail->penyimpanan}}</td>
				</tr>
				<tr>
					<td class="fs-8">Tgl Diracik</td>
					<td class="fs-8">:</td>
					<td class="fs-8">{{indonesian_date($detail->created_at)}}</td>
				</tr>
				<tr>
					<td class="fs-8">Exp Date</td>
					<td class="fs-8">:</td>
					<td class="fs-8">{{$detail->exp_date}}</td>
				</tr>
			</table>
		</div>
	</div>
	@if(isset($transaksi->final_detail->resep_detail[$i+1]))
	<div style="page-break-after: always;"></div>
	@endif
	@endforeach
</body>
</html>