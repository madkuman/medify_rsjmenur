<!DOCTYPE html>
<html>
<head>
	<title>RESUME MEDIS</title>
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
		.oneBorder{
			border: 1px solid black;
		}
		.ml-15{
			margin-left: 15px;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				RM. 31
			</td>
		</tr>
	</table>
	<table class="margin-minus" style="margin-top: 10px; border: 1px solid black;">
		<tr>
			<td width="55%" style="vertical-align: middle;">
				<table>
					<tr>
						<td width="18%" style="text-align: right;">
							<img src="{{url('')}}/assets/img/pemprov-jatim.png" height="55">
						</td>
						<td width="62%" style="text-align: center; font-size: 11px;">
							<b>
								PEMERINTAH PROVINSI JAWA TIMUR<br>
								RUMAH SAKIT JIWA MENUR<br>
								Jl Menur No.120, Telp(031) 5021635, 5021637<br>
								Surabaya
							</b>
						</td>
						<td width="20%" style="text-align: left;">
							<img src="{{url('')}}/assets/img/menur.png" height="55">
						</td>
					</tr>
				</table>
			</td>
			<td width="45%">
				<table cellpadding="3">
					<tr>
						<td width="30%">No. RM</td>
						<td width="70%">: {{$kasus->pasien->no_rm_formatted}}</td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>: {{$kasus->pasien->name}}</td>
					</tr>
					<tr>
						<td>Tanggal Lahir</td>
						<td>: {{date('j M Y', strtotime($kasus->pasien->date_of_birth))}}</td>
					</tr>
					<tr>
						<td>Tanggal MRS</td>
						<td>: {{$kasus->mrs_at ? date('j M Y', strtotime($kasus->mrs_at)) : ''}}</td>
					</tr>
					<tr>
						<td>Tanggal KRS</td>
						<td>: {{$kasus->krs_at ? date('j M Y', strtotime($kasus->krs_at)) : 'Belum KRS'}}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table style="margin-top: 5px; margin-bottom: 5px;">
		<tr class="centered">
			<td width="20%" class="oneBorder" style="font-size: 20px; font-weight: bold;">RAHASIA</td>
			<td width="80%"></td>
		</tr>
	</table>
	<table class="bordered">
		<tr class="centered">
			<td style="font-size: 16px;"><b>RESUME MEDIS</b></td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td>Alasan datang/ indikasi dirawat : {{$item->alasan_datang_indikasi_dirawat}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="20%">Diagnosa Masuk</td>
						<td width="80%">: {{$item->diagnosa_masuk}}</td>
					</tr>
					<tr>
						<td>Diagnosa Utama</td>
						<td>: {{$item->diagnosa_utama}}</td>
					</tr>
					<tr>
						<td colspan="2">Diagnosa tambahan/sekunder: 
							<div class="ml-15 cb @if(!$item->diagnosa_tambahan) cbx @endif"></div> Tidak Ada
							<div class="ml-15 cb @if($item->diagnosa_tambahan) cbx @endif"></div> Ada
						</td>
					</tr>
					<tr>
						<td colspan="2" class="indent">{!! nl2br($item->diagnosa_tambahan) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td>Pemeriksaan Fisik</td>
					</tr>
					<tr>
						<td class="indent">{!! nl2br($item->pemeriksaan_fisik) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td>Tindakan/Prosedur (Non Operatif/Operatif) Utama: 
							<div class="ml-15 cb @if(!$item->tindakan_prosedur_utama) cbx @endif"></div> Tidak Ada
							<div class="ml-15 cb @if($item->tindakan_prosedur_utama) cbx @endif"></div> Ada
						</td>
					</tr>
					<tr>
						<td class="indent">{{$item->tindakan_prosedur_utama}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td>Tindakan/Prosedur (Non Operatif/Operatif) Lain: 
							<div class="ml-15 cb @if(!$item->tindakan_prosedur_lain) cbx @endif"></div> Tidak Ada
							<div class="ml-15 cb @if($item->tindakan_prosedur_lain) cbx @endif"></div> Ada
						</td>
					</tr>
					<tr>
						<td class="indent">{!! nl2br($item->tindakan_prosedur_lain) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td>Terapi pengobatan selama di RS</td>
					</tr>
					<tr>
						<td class="indent">{!! nl2br($item->terapi_pengobatan_selama_di_rs) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td>Terapi pengobatan selama setelah pulang</td>
					</tr>
					<tr>
						<td class="indent">{!! nl2br($item->terapi_pengobatan_setelah_pulang) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td>Instruksi tindak lanjut (follow-up)</td>
					</tr>
					<tr>
						<td class="indent">{!! nl2br($item->instruksi_tindak_lanjut_follow_up) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="20%">Lanjutan pengobatan</td>
						<td width="20%"><div class="cb @if($item->lanjutan_pengobatan == 'Poliklinik') cbx @endif"></div>Poliklinik</td>
						<td width="20%"><div class="cb @if($item->lanjutan_pengobatan == 'Puskesmas') cbx @endif"></div>Puskesmas</td>
						<td width="20%"><div class="cb @if($item->lanjutan_pengobatan == 'RS Lain') cbx @endif"></div>RS lain</td>
						<td width="20%"><div class="cb @if($item->lanjutan_pengobatan == 'Lain lain') cbx @endif"></div>Lain2, {{$item->lanjutan_pengobatan_di}}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table class="bordered">
		<tr>
			<td width="50%">
				<table class="noBorder">
					<tr>
						<td width="50%">
							<table class="noBorder" cellpadding="3">
								<tr>
									<td><b><i><u>Keadaan Keluar</u></i></b></td>
								</tr>
								<tr>
									<td><div class="cb @if($item->keadaan_keluar == 'Sembuh') cbx @endif"></div>Sembuh</td>
								</tr>
								<tr>
									<td><div class="cb @if($item->keadaan_keluar == 'Belum sembuh dan perlu perawatan lanjutan') cbx @endif"></div>Belum sembuh, perlu perawatan lanjutan</td>
								</tr>
								<tr>
									<td><div class="cb @if($item->keadaan_keluar == 'Meninggal') cbx @endif"></div>Meninggal</td>
								</tr>
								<tr>
									<td><div class="cb @if($item->keadaan_keluar == 'Rujuk') cbx @endif"></div>Rujuk ke {{$item->rujuk_ke}}</td>
								</tr>
							</table>
						</td>
						<td width="50%">
							<table class="noBorder" cellpadding="3">
								<tr>
									<td><b><i><u>Cara Keluar</u></i></b></td>
								</tr>
								<tr>
									<td><div class="cb @if($item->cara_keluar == 'Atas advis dokter') cbx @endif"></div>Atas advis dokter</td>
								</tr>
								<tr>
									<td><div class="cb @if($item->cara_keluar == 'Atas permintaan keluarga') cbx @endif"></div>Atas permintaan keluarga</td>
								</tr>
								<tr>
									<td><div class="cb @if($item->cara_keluar == 'Melarikan diri') cbx @endif"></div>Melarikan diri</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
			<td width="50%">
				<table class="noBorder" cellpadding="3">
					<tr>
						<td><b><i><u>Catatan Khusus (Alergi dsb)</u></i></b></td>
					</tr>
					<tr>
						<td>Alergi :</td>
					</tr>
					<tr>
						<td>
							<div class="cb @if($item->alergi_tidak_ada_alergi == '1') cbx @endif"></div> Tidak ada
							<div class="ml-15 cb @if($item->alergi_obat_obatan == '1') cbx @endif"></div> Obat2an
							<div class="ml-15 cb @if($item->alergi_makanan == '1') cbx @endif"></div> Makanan
							<div class="ml-15 cb @if($item->alergi_lainnya == '1') cbx @endif"></div> Lain2
						</td>
					</tr>
					<tr>
						<td>{!! nl2br($item->keterangan_alergi) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>