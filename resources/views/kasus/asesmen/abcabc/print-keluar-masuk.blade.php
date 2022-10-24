<!DOCTYPE html>
<html>
<head>
	<title>RINGKASAN PASIEN KELUAR MASUK</title>
	<style type="text/css">
		table{
			font-family: sans-serif;
			width: 100%;
			font-size: 13px;
			border-collapse: collapse;
		}
		.bordered td, .bordered th .bordered{
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
		.margin-minus{
			margin-left: -1px;
			margin-right: -1px;
			margin-bottom: -1px;
		}
		.margin-minus td{
			padding-left: 5px;
			padding-right: 5px;
		}
		.noBorder td{
			border: 1px solid white !important;
			vertical-align: top
		}
		.cbx::after{
			content: "4";
			line-height: 0.6;
			z-index: 100;
			font-family: ZapfDingbats, sans-serif;
		}
		.cb{
			border: 1px solid black;
			display: inline-block;
			width: 7px;
			height: 7px;
			margin-right: 5px;
		}
		.tab{
			padding-left: 20px !important;
		}
		.ml{
			margin-left: 40px;
		}
		.indent{
			padding-left: 45px !important;
		}
		.title{
			padding-top: 20px;
			padding-bottom: 20px;
			text-align: center;
		}
		.outer{
			border: 1px solid black;
		}
		.box{
			height: 60px;
		}
		.foto{
			vertical-align: middle;
			text-align: center;
		}
		.big{
			padding-top: 10px;
			padding-bottom: 10px;
			font-size: 17px;
		}
		.ml-15{
			margin-left: 15px;
		}
	</style>
</head>
<body>
	<table style="margin-bottom: 10px;">
		<tr>
			<td width="90%"></td>
			<td width="10%" class="bordered centered">
				RM.20
			</td>
		</tr>
	</table>
	<table class="bordered">
		<tr>
			<td width="77%">
				<table class="noBorder">
					<tr>
						<td width="20%" class="centered">
							<img src="{{url('')}}/assets/img/pemprov-jatim.png" height="55">
						</td>
						<td width="60%" class="centered">
							<b>
								PEMERINTAH PROVINSI JAWA TIMUR<br>
								RUMAH SAKIT JIWA MENUR<br>
								Jln Menur No.120, Telp(031)5021635,5021637<br>
								Surabaya
							</b>
						</td>
						<td width="20%" class="centered">
							<img src="{{url('')}}/assets/img/menur.png" height="55">
						</td>
					</tr>
				</table>
			</td>
			<td width="23%" rowspan="4" class="foto">
				PAS FOTO PASIEN UKURAN 4 x 6
			</td>
		</tr>
		<tr>
			<td class="centered big"><b>RINGKASAN PASIEN MASUK DAN KELUAR</b></td>
		</tr>
		<tr>
			<td><i>Diisi oleh Perekam Medis</i></td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="20%">Nomor RM</td>
						<td width="80%">: </td>
					</tr>
					<tr>
						<td>Nama Pasien</td>
						<td>: </td>
					</tr>
					<tr>
						<td>Tgl Lahir/Umur</td>
						<td>: </td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>: </td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table class="bordered">
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="16%">Dirawat yang ke</td>
						<td width="39%">:</td>
						<td width="15%"></td>
						<td width="30%"></td>
					</tr>
					<tr>
						<td>Ruang</td>
						<td>:</td>
						<td>Kelas</td>
						<td>:</td>
					</tr>
					<tr>
						<td>Pindah Ruang</td>
						<td>: 
							<div class="ml-15 cb cbx"></div>Tidak 
							<div class="ml-15 cb cbx"></div>Ya, ke Melati I Bed II
						</td>
						<td>Pindah Kelas</td>
						<td>: 
							<div class="ml-15 cb cbx"></div>Tidak 
							<div class="ml-15 cb cbx"></div>Ya, ke VVIP
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table class="bordered">
		<tr>
			<td width="50%">
				<table class="noBorder" cellpadding="3">
					<tr>
						<td><b><i><u>Pengirim/Rujukan :</u></i></b></td>
					</tr>
					<tr>
						<td><div class="cb cbx"></div>Puskesmas </td>
					</tr>
					<tr>
						<td><div class="cb cbx"></div>RS </td>
					</tr>
					<tr>
						<td><div class="cb cbx"></div>Lainnya </td>
					</tr>

				</table>
			</td>
			<td width="50%">
				<table class="noBorder" cellpadding="3">
					<tr>
						<td><b><i><u>Kasus Visum :</u></i></b></td>
					</tr>
					<tr>
						<td><div class="cb cbx"></div>Ya </td>
					</tr>
					<tr>
						<td><div class="cb cbx"></div>Tidak </td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td><b>Tanggal masuk :</b></td>
						<td><b>Jam: </b></td>
					</tr>
				</table>
			</td>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td><b>Tanggal keluar :</b></td>
						<td><b>Jam: </b></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="33%"><div class="cb"></div> DPJP</td>
						<td width="67%">:</td>
					</tr>
					<tr>
						<td><div class="cb"></div>Casemanager</td>
						<td>:</td>
					</tr>
				</table>				
			</td>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td>Lama Dirawat : </td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td><b>Diagnosa Masuk</b></td>
					</tr>
					<tr>
						<td></td>
					</tr>
				</table>
			</td>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td><b>Diagnosa Keluar</b></td>
					</tr>
					<tr>
						<td></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td><b>Diagnosa tambahan : </b></td>
					</tr>
					<tr>
						<td></td>
					</tr>
				</table>				
			</td>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td><b>Diagnosa tambahan : </b></td>
					</tr>
					<tr>
						<td></td>
					</tr>
				</table>				
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="noBorder" cellpadding="3">
					<tr>
						<td><b>Tindakan yang telah dilakukan :</b></td>
					</tr>
					<tr>
						<td></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder">
					<tr>
						<td width="50%">
							<table class="noBorder" cellpadding="3">
								<tr>
									<td><b><i><u>Keadaan Keluar</u></i></b></td>
								</tr>
								<tr>
									<td><div class="cb cbx"></div>Sembuh</td>
								</tr>
								<tr>
									<td><div class="cb cbx"></div>Belum sembuh, perlu perawatan lanjutan</td>
								</tr>
								<tr>
									<td><div class="cb cbx"></div>Meninggal</td>
								</tr>
								<tr>
									<td><div class="cb cbx"></div>Rujuk ke</td>
								</tr>
							</table>
						</td>
						<td width="50%">
							<table class="noBorder" cellpadding="3">
								<tr>
									<td><b><i><u>Cara Keluar</u></i></b></td>
								</tr>
								<tr>
									<td><div class="cb cbx"></div>Atas advis dokter</td>
								</tr>
								<tr>
									<td><div class="cb cbx"></div>Atas permintaan keluarga</td>
								</tr>
								<tr>
									<td><div class="cb cbx"></div>Melarikan diri</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td><b><i><u>Catatan Khusus (Alergi dsb)</u></i></b></td>
					</tr>
					<tr>
						<td>Alergi :</td>
					</tr>
					<tr>
						<td>
							<div class="cb cbx"></div> Tidak ada
							<div class="ml-15 cb cbx"></div> Obat2an
							<div class="ml-15 cb cbx"></div> Makanan
							<div class="ml-15 cb cbx"></div> Lain2
						</td>
					</tr>
					<tr>
						<td></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>