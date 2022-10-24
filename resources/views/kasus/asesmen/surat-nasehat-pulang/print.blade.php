<!DOCTYPE html>
<html>
<head>
	<title>Pengantar Pengiriman Pasien</title>
	<style type="text/css">
		table{
			font-family: sans-serif;
			width: 100%;
			font-size: 13px;
			border-collapse: collapse;
		}
		.bordered td, .bordered th{
			border: 1px solid black;
			padding-left: 5px;
			padding-right: 5px;
		}
		td{
			vertical-align: top;
		}
		.centered td, .centered{
			text-align: center;
		}
		.big{
			font-size: 19px;
		}
		.va-mid{
			vertical-align: middle;
		}
		.px-5 td{
			padding-left: 5px;
			padding-right: 5px;
		}
		.gap{
			line-height: 2;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				RM 14
			</td>
		</tr>
	</table>
	<table class="big">
		<tr>
			<td width="20%" style="text-align: right;">
				<img src="{{url('')}}/assets/img/pemprov-jatim.png" height="55">
			</td>
			<td width="60%" style="text-align: center;">
				<b>
					PEMERINTAH PROVINSI JAWA TIMUR<br>
					RUMAH SAKIT JIWA MENUR<br>
					Jln Menur No.120, Telp(031)5021635,5021637<br>
					S U R A B A Y A
				</b>
			</td>
			<td width="20%" style="text-align: left;">
				<img src="{{url('')}}/assets/img/menur.png" height="55">
			</td>
		</tr>
	</table>
	<hr>
	<br>
	<table>
		<tr>
			<td class="centered big"><b>NASEHAT PASIEN PULANG</b></td>
		</tr>
	</table>
	<br>
	<table cellpadding="5">
		<tr>
			<td width="15%">Nama Pasien</td>
			<td width="40%">: {{$kasus->pasien->name}}</td>
			<td width="15%">No RM</td>
			<td width="30%">: {{$kasus->pasien->no_rm}}</td>
		</tr>
		<tr>
			<td>Umur</td>
			<td>: {{$kasus->pasien->age}}</td>
			<td>Ruangan</td>
			<td>: {{$kasus->lokasi->lokasi->nama}}</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>: {{$kasus->pasien->address}}</td>
			<td>Dokter</td>
			<td>: {{$kasus->dpjp->user->name}}</td>
		</tr>
		<tr>
			<td>Tgl Masuk RS</td>
			<td>: {{$kasus->mrs_at ? date('j F Y', strtotime($kasus->mrs_at)): '-'}}</td>
			<td>Tgl Keluar RS</td>
			<td>: {{$kasus->krs_at ? date('j F Y', strtotime($kasus->krs_at)): '-'}}</td>
		</tr>
		<tr>
			<td>Tgl Kontrol</td>
			<td>: {{$item->tanggal_kontrol ? date('j F Y', strtotime($item->tanggal_kontrol)) : '-'}}</td>
		</tr>
	</table>
	<br><br>
	<table cellpadding="5" class="gap">
		<tr>
			<td width="55%">
				<b>Obat yang diminum</b> <br>
				(aturan minum dan jumlah)<br>
				{!! nl2br($item->obat_yang_diminum) !!}
			</td>
			<td width="45%">
				<b>Obat yang tidak diminum</b><br> 
				(jumlah)<br>
				{!! nl2br($item->obat_yang_tidak_diminum) !!}
			</td>
		</tr>
	</table>
	<br><br>
	<table cellpadding="5" class="gap">
		<tr>
			<td width="10%"><b>Lain lain</b></td>
			<td width="1%">:</td>
			<td width="89%"> {!! nl2br($item->keterangan_lain_lain) !!}</td>
		</tr>
		<tr>
			<td width="10%"><b>Saran</b></td>
			<td width="1%">:</td>
			<td width="89%"> {!! nl2br($item->saran) !!}</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td>
				<table>
					<tr>
						<td width="50%" class=" centered"></td>
						<td width="50%" class=" centered">Surabaya, {{Carbon\Carbon::now()->format('j F Y')}}</td>
					</tr>
					<tr>
						<td class="centered">Keluarga,</td>
						<td class="centered">Petugas,</td>
					</tr>
					<tr>
						<td colspan="2"><br><br><br></td>
					</tr>
					<tr>
						<td class="centered">(..................................)</td>
						<td class="centered">{{$item->creator->name}}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>