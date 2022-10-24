<!DOCTYPE html>
<html>
<head>
	<title>Formulir Catatan Obat Per Oral</title>
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
			font-size: 15px;
		}
		.va-mid td, .va-mid{
			vertical-align: middle;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				RM 06.K4
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
	<hr style="border-top: 3px double black">
	<table class="big">
		<tr>
			<td class="centered"><b>FORMULIR CATATAN OBAT PER ORAL</b></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="50%">
				<table>
					<tr>
						<td width="30%">No. RM</td>
						<td width="70%">: {{$kasus->pasien->no_rm_formatted}}</td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>: {{$kasus->pasien->name}}</td>
					</tr>
					<tr>
						<td>Tgl Lahir/Umur</td>
						<td>: {{date('d-m-Y', strtotime($kasus->pasien->date_of_birth))}} / {{$kasus->pasien->age}} Tahun</td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>: {{$kasus->pasien->gender == '1' ? 'Laki-laki' : 'Perempuan'}}</td>
					</tr>
				</table>
			</td>
			<td width="50%">
				<table>
					<tr>
						<td width="30%">Ruangan</td>
						<td width="70%">: {{$kasus->lokasi->lokasi->nama}}</td>
					</tr>
					<tr>
						<td>DPJP</td>
						<td>: {{$kasus->dpjp->user->name}}</td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td>: {{date('d M Y', strtotime($kasus->created_at))}}</td>
					</tr>
					<tr>
						<td>Status</td>
						<td>: {{$kasus->pembayaran->perusahaan->nama ?? $kasus->pembayaran}}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<tr class="centered va-mid">
			<td rowspan="2">Indikasi</td>
			<td rowspan="2" colspan="2">Nama Obat</td>
			<td rowspan="3">Jam</td>
			<td colspan="7">Tanggal/Bulan</td>
			<td rowspan="3">Ket</td>
		</tr>
		<tr class="centered va-mid">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr class="centered va-mid">
			<td rowspan="2">Rute</td>
			<td rowspan="2">Dosis</td>
			<td rowspan="2">Pelarut</td>
			<td>Paraf</td>
			<td>Paraf</td>
			<td>Paraf</td>
			<td>Paraf</td>
			<td>Paraf</td>
			<td>Paraf</td>
			<td>Paraf</td>
		</tr>
		<tr class="centered va-mid">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr class="centered va-mid">
			<td colspan="2" rowspan="3">Monitoring</td>
			<td rowspan="3">Jumlah</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr class="centered va-mid">
			<td rowspan="2">Apt</td>
			<td colspan="2" rowspan="2">Dosis Max. 24 Jam</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td><b>Keterangan</b></td>
		</tr>
		<tr>
			<td>Lembar ini juga berfungsi sebagai bukti serah terima obat</td>
		</tr>
	</table>
</body>
</html>