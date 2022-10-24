<?php 
if(!is_null($detail->result))
	$result = json_decode($detail->result); ?>
<head>
	<title>Hasil Pemeriksaan Radioologi</title>
</head>

<style type="text/css">
.small-col {
	width: 17%;
}
.big-col {
	width: 43%;
}
.med-col {
	width: 23%;
}
td {
	vertical-align: top;
}
.title {
	text-align: center; 
	font-weight: bold;
}
.left-hr{
	width: 50%; 
	margin-left: 0px;
}
.mb-5{
	margin-bottom: 5px;
}
body {
	margin-top: -30px;
	margin-bottom: -30px;    
}
.centered{
	text-align: center;
}
.bot{
	border-bottom: 2px solid black
}
.va-mid{
	vertical-align: middle;
}
.logo{
	position: absolute;
	z-index: 100;
}
.head{
	font-size: 42px;
}
</style>
<body>
<table width="100%">
	<tr>
		<td width="20%" style="text-align: center;">
			<img src="{{url('')}}/assets/img/pemprov-jatim.png" height="100">
		</td>
		<td width="60%" style="text-align: center; font-size: 17px;">
			<b>
				PEMERINTAH PROVINSI JAWA TIMUR<br>
				RUMAH SAKIT JIWA MENUR<br>
				Jln Menur No.120, Telp(031)5021635,5021637<br>
				Surabaya
			</b>
		</td>
		<td width="20%" style="text-align: center;">
			<img src="{{url('')}}/assets/img/menur.png" height="100">
		</td>
	</tr>
</table>
	@php
		$dpjp = $transaksi->kasus->dpjp->user->name ?? '';
	@endphp
	<p class="title">RADIOLOGI</p>
	<hr>
	<table style="width: 100vw; font-size: 13px;">
		<thead>
			<tr>
				<td class="small-col" >Nama</td>
				<td class="big-col" >: {{$transaksi->pasien->name}}</td>
				<td class="small-col" >Register</td>
				<td class="med-col" >: {{$transaksi->pasien->no_rm}} </td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="small-col" >Umur/TTL</td>
				<td class="big-col" >: {{$transaksi->pasien->age}} Tahun / {{$transaksi->pasien->place_of_birth}}, {{date('d F Y', strtotime($transaksi->pasien->date_of_birth))}}</td>
				<td class="small-col" >Rumah Sakit</td>
				<td class="med-col" >: {{is_null($transaksi->nama_rs) ? config('app.name') : $transaksi->nama_rs}}</td>
			</tr>
			<tr>
				<td class="small-col" >Alamat</td>
				<td class="big-col" >: {{$transaksi->pasien->address}}</td>
				<td class="small-col" >Poli/ Ruang</td>
				<td class="med-col" >: {{ $transaksi->asal['nama'] }}</td>
			</tr>
			<tr>
				<td class="small-col" >Dokter</td>
				<td class="big-col" >: {{$transaksi->creator->profesi ==  1 ? $transaksi->creator->name : $dpjp}}</td>
				<td class="small-col" >Tanggal Terima</td>
				<td class="med-col" >: {{date('d F Y', strtotime($transaksi->created_at))}}</td>
			</tr>
			<tr>
				<td class="small-col" ></td>
				<td class="big-col" ></td>
				<td class="small-col" >Tanggal Selesai</td>
				<td class="med-col" >: {{date('d F Y', strtotime($transaksi->result_created_at))}}</td>
			</tr>
		</tbody>
	</table>
	<hr>
	{{--
		<table style="width: 100vw">
			<tr>
				<td class="small-col">Diagnosa</td>
				<td class="big-col">: {{$transaksi->diagnosis}}</td>
				<td class="small-col"></td>
				<td class="med-col"></td>  
			</tr>
			<tr>
				<td class="small-col">Lokasi</td>
				<td class="big-col">: {{$transaksi->lokasi}}</td>
				<td class="small-col"></td>
				<td class="med-col"></td>
			</tr>
		</table>
		<hr>--}}
		<div style=" margin-bottom: 30px; font-size: 13px;">
			{!! nl2br($detail->hasil_baca) !!}
		</div>
	</table>
</table>
<table style="width: 100vw">
	<tr>
		<td style="width: 35%; text-align: center;">Dokter yang memeriksa</td>
		<td style="width: 65%"></td>
	</tr>
	<tr>
		<td colspan="2" style="color: white; font-size: 40px;">@if(!empty($transaksi->verified_at) && $transaksi->verificator->profesi == 1 && !is_null($transaksi->verificator->ttd))
					<img src="{{asset($transaksi->verificator->ttd)}}" style="height: 50px; margin-left: 80px;" />
				@else
					dummy
				@endif</td>
	</tr>
	<tr>
		<td style="width: 35%; text-align: center;">{{!empty($transaksi->verified_at) && $transaksi->verificator->profesi == 1 ? $transaksi->verificator->name : '(..................................)'}}</td>
		<td style="width: 65%"></td>
	</tr>
</table>
</body>