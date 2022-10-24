
<!DOCTYPE html>
<html>
<head>
	<title>Lembar Observasi</title>
	<style type="text/css">
		table {
			border-collapse: collapse;
			width : 100%;
			font-family : sans-serif;
			font-size: 13px;
		}
		.centered{
			text-align: center;
		}
		.bordered td, .bordered th, .bordered{
			padding-left: 5px;
			padding-right: 5px;
			border: 1px solid black;
		}
		.mt-10{
			margin-top: 10px;
		}
		.small{
			font-size: 10px;
		}
		.big{
			font-size: 15px;
		}
		.bot{
			border-bottom: 1px solid black;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td width="85%"></td>
			<td width="15%" class="bordered" align="center">RM 21 K.10</td>
		</tr>
	</table>
	<table>
		<tr>
			<td width="55%" valign="top" class="bot">
				<table cellpadding="5">
					<tr>
						<td width="15%" align="left">
							<img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="50">
						</td>
						<td width="63%" align="center">
							<p class="small">PEMERINTAH PROVINSI JAWA TIMUR <br>
								<b>RUMAH SAKIT JIWA MENUR</b> <br>
								Jln. Menur No. 120, Telp. (031) 5021635, 5021637 <br>
								<b>SURABAYA</b>
							</p>
						</td>
						<td width="17%" align="left">
							<img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="50">
						</td>
					</tr> 
				</table>
			</td>
			<td width="45%"></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td class="centered big"><b>LEMBAR OBSERVASI</b></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td style="padding-left: 20px;">
				<table>
					<tr>
						<td width="15%">Nama Pasien</td>
						<td width="40%">: {{$kasus->pasien->name}}</td>
						<td width="10%">No RM</td>
						<td width="35%">: {{$kasus->pasien->no_rm}}</td>
					</tr>
					<tr>
						<td>Tgl Lahir/Umur</td>
						<td>: {{$kasus->pasien->date_of_birth ? date('d-m-Y', strtotime($kasus->pasien->date_of_birth)) : '-'}} / {{$kasus->pasien->age}}</td>
						<td>Ruang</td>
						<td>: {{$kasus->lokasi->lokasi->nama}}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<thead>
			<tr>
				<th rowspan="2">Tanggal/Jam</th>
				<th rowspan="2">Tensi</th>
				<th rowspan="2">Nadi</th>
				<th rowspan="2">Suhu</th>
				<th rowspan="2">RR</th>
				<th colspan="2">Cairan yang masuk</th>
				<th colspan="2">Cairan yang keluar</th>
				<th rowspan="2">Rencana Tindakan</th>
			</tr>
			<tr>
				<th>Infus</th>
				<th>Per OS</th>
				<th>Urine</th>
				<th>Lain2</th>
			</tr>
		</thead>
		<tbody>
			@foreach($lembar_observasi as $item)
			<tr>
				<td>{{$item->tanggal ? date('d-m-y', strtotime($item->tanggal)) : '-'}} / {{$item->jam}}</td>
				<td>{{$item->tensi}}</td>
				<td>{{$item->nadi}}</td>
				<td>{{$item->suhu}}</td>
				<td>{{$item->rr}}</td>
				<td>{{$item->infus}}</td>
				<td>{{$item->per_os}}</td>
				<td>{{$item->urine}}</td>
				<td>{{$item->cairan_lain_lain}}</td>
				<td>{!! nl2br($item->rencana_tindakan) !!}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<br>
	<table>
		<tr>
			<td style="padding-left: 20px">
				<table>
					<tr>
						<td width="20%">Balans Cairan </td>
						<td width="80%">: {{$balans}}</td>
					</tr>
					<tr>
						<td>Masuk</td>
						<td>: {{$all_masuk}}</td>
					</tr>
					<tr>
						<td>Keluar</td>
						<td>: {{$all_keluar}}</td>
					</tr>
					<tr>
						<td>Obat-obatan</td>
						<td>: </td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>