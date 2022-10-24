<!DOCTYPE html>
<html>
<head>
	<title>Ringkasan Riwayat Klinis Rawat Inap</title>
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
	</style>
</head>
<body>
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				RM 03.K1
			</td>
		</tr>
	</table>
	<table style="margin-top: 5px;">
		<tr>
			<td width="60%">
				<table>
					<tr>
						<td width="20%" style="text-align: center;">
							<img src="{{url('')}}/assets/img/pemprov-jatim.png" height="55">
						</td>
						<td width="60%" style="text-align: center; font-size: 10px;">
							<b>
								PEMERINTAH PROVINSI JAWA TIMUR<br>
								RUMAH SAKIT JIWA MENUR<br>
								Jln Menur No.120, Telp(031)5021635,5021637<br>
								Surabaya
							</b>
						</td>
						<td width="20%" style="text-align: center;">
							<img src="{{url('')}}/assets/img/menur.png" height="55">
						</td>
					</tr>
					<tr>
						<td colspan="3" style="font-size: 7px;">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">
							<b style="font-size: 16px;">RINGKASAN RIWAYAT KLINIS RAWAT INAP</b><br>
							<i style="font-size: 14px;">(Diisi oleh Perekam Medis)</i>
						</td>
					</tr>
				</table>
			</td>
			<td width="40%">
				<div style="border: 1px solid black; padding: 5px;">
					<table style="font-size: 11px;">
						<tr>
							<td>No Rekam Medis</td>
							<td>: {{$identitas->no_rm_formatted}}</td>
						</tr>
						<tr>
							<td>Nama</td>
							<td>: {{$identitas->name}}</td>
						</tr>
						<tr>
							<td>Tgl Lahir/Umur</td>
							<td>: {{date('d-m-Y', strtotime($identitas->date_of_birth))}}/{{$identitas->age}} Tahun</td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td>
							<td>: {{$identitas->gender == '1' ? 'Laki-laki' : 'Perempuan'}}</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
	<table class="bordered" style="margin-top: 10px;">
		<thead>
			<tr class="centered">
				<th>MRS KE-</th>
				<th>TANGGAL MRS</th>
				<th>TANGGAL KRS</th>
				<th>LAMA DIRAWAT</th>
				<th>KODE DIAGNOSA</th>
				<th>TINDAKAN</th>
				<th>DOKTER</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($kunjungan as $kasus)
			<tr>
				<td class="centered">{{$i++}}</td>
				<td>{{date('d M Y', strtotime($kasus->mrs_at))}}</td>
				<td>{{$kasus->krs_at ? date('d M Y', strtotime($kasus->krs_at)) : '-'}}</td>
				<td>{{$kasus->ranap_los}} Hari</td>
				<td>{{$kasus->diagnosisUtama->icd10->code_icd}}</td>
				<td>
					@foreach($kasus->tindakan_icd9 as $tindakan)
					- {{$tindakan->icd9->code_icd}}<br>
					@endforeach
				</td>
				<td>{{$kasus->dpjp->user->name}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>