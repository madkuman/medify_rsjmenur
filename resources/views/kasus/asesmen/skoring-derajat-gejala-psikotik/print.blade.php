<!DOCTYPE html>
<html>
<head>
	<title>Skoring Derajat Gejala Psikotik</title>
	<style type="text/css">
		body, p {
			font-size: 12px;
			font-family: Arial, Helvetica, sans-serif;
		}
		p {
			line-height: 0.3;
		}
		table{
			width: 100%
		}
		table.bordered {
			border-collapse: collapse;
		}
		table.bordered, .bordered th, .bordered td {
			border: 1px solid black;
		}
		.bordered td{
			vertical-align: top !important;
			padding-left: 5px;
			padding-right: 5px; 
		}
		.border{
			border: 1px solid black;
		}
		.noBorder td{
			border: 1px solid white !important;
			vertical-align: top
		}
		.mx-5 td{
			margin-left: 5px !important;
			margin-right: 5px !important;
		}
		.fixed{
			width: 30px !important;
			overflow: hidden;
			white-space: nowrap;
		}
		.big {
			font-weight: bold;
		}
	</style>
</head>
<body>
	<table width="100%">
		<tr>
			<td width="90%"></td>
			<td width="10%" align="center" class="border">RM. 07</td>
		</tr>
	</table>

	<table width="100%">
		<tr>
			<td width="33%" valign="top">
				<table width="100%">
					<tr>
						<td width="15%" align="left">
							<img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="40">
						</td>
						<td width="63%" align="center">
							<p style="font-size: 11px;"><b>PEMERINTAH PROVINSI JAWA TIMUR</b></p>
							<p style="font-size: 13px;"><b>RUMAH SAKIT JIWA MENUR</b></p>
							<p style="font-size: 9px;"><b>Jln. Menur No. 120, Telp. (031) 5021635, 5021637</b></p>
							<p style="font-size: 11px;"><b>S U R A B A Y A</b></p>
						</td>
						<td width="17%" align="left">
							<img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="40">
						</td>
					</tr>
				</table>
			</td>
			<td width="33%" align="center">
				<b style="font-size: 15px;">SKORING DERAJAT GEJALA PSIKOTIK</b>
			</td>
			<td width="33%">
				<div style="border: 1px solid #000; padding: 5px;">
					<table width="100%" cellpadding="2">
						<tr>
							<td>No. RM</td>
							<td>: {{ $kasus->pasien->no_rm }}</td>
						</tr>
						<tr>
							<td>Nama</td>
							<td>: {{ $kasus->identitas->nama }}</td>
						</tr>
						<tr>
							<td>Tgl Lahir/Umur</td>
							<td>: {{ date("d/m/Y", strtotime($kasus->identitas->tanggal_lahir)) }} / {{$kasus->identitas->umur}} Tahun</td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td>
							<td>: {!! $kasus->identitas->jenis_kelamin !!}</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
	<table class="bordered" width="100%">
		<thead>
			<tr>
				<th width="5%">No</th>
				<th width="19%">Uraian</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
			</tr>
		</thead>
		<tbody>
			@foreach($all_data as $item)
			<tr>
				<td align="center">@if($loop->iteration<11){{$loop->iteration}}@endif</td>
				@for($i=0;$i<14;$i++)
				<td class="@if($loop->iteration > 10 && $i == 0) big @endif">{{$item[$i]}}</td>
				@endfor
			</tr>
			@endforeach
			<tr>
				<td></td>
				<td><b>Paraf</b></td>
				@for($i=0;$i<13;$i++)
				<td></td>
				@endfor
			</tr>
		</tbody>
	</table>
</body>
</html>