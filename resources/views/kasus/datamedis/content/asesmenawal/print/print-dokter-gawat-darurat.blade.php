<!DOCTYPE html>
<html>
<head>
	<title>ASESMEN AWAL GAWAT DARURAT</title>
	<style type="text/css">
		table{
			font-family: DejaVu Sans, sans-serif;
			width: 100%;
			font-size: 13px;
			border-collapse: collapse;
		}
		.content{
			border: 1px solid black;
		}
		.content td{
			padding-left: 5px;
			padding-right: 5px;
		}
		.submenu td{
			border-bottom: 1px solid black;
		}
		.subdetail td{
			padding-top: 10px;
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
		.big{
			text-align: center;
			vertical-align: middle;
			font-size: 16px;
			font-weight: bold;
		}
	</style>
</head>

<body>
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				RM.04
			</td>
		</tr>
	</table>
	<table style="margin-top: -20px;">
		<tr>
			<td width="50%">
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
				</table>
			</td>
			<td width="50%"></td>
		</tr>
	</table>
	<table style="margin-top: 10px; border-collapse: separate;">
		<tr>
			<td width="45%" class="big" style="border: 2px solid black">
				ASESMEN AWAL GAWAT DARURAT
			</td>
			<td width="55%" style="border: 1px solid black">
				<table class="noBorder margin-minus">
					<tr>
						<td>NO.RM</td>
						<td>: {{{$kasus->pasien->no_rm_formatted}}}</td>
					</tr>
					<tr>
						<td>NAMA</td>
						<td>: {{{$kasus->pasien->name}}}</td>
					</tr>
					<tr>
						<td>TGL LAHIR / UMUR</td>
						<td>: {{indonesian_date(date("j F Y", strtotime($kasus->pasien->date_of_birth)))}} / {{{$kasus->pasien->age}}} Tahun</td>
					</tr>
					<tr>
						<td>JENIS KELAMIN</td>
						<td>: @if($kasus->pasien->gender == 1) LAKI-LAKI @else PEREMPUAN @endif</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>ASESMEN MEDIS</b></td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Riwayat Penyakit</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Keluhan utama</td>
			<td class="align-top border-bottom">: {!! nl2br($asesmen['medis_keluhan_utama'] ?? '-') !!}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Riwayat gangguan sekarang</td>
			<td class="align-top border-bottom">: {!! nl2br($asesmen['medis_riwayat_gangguan_sekarang'] ?? '-') !!}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Riwayat penyakit sebelumnya</td>
			<td class="align-top border-bottom">: {!! nl2br($asesmen['medis_riwayat_penyakit_sebelumnya'] ?? '-') !!}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Faktor keturunan</td>
			<td class="align-top border-bottom">: {{$asesmen['medis_faktor_keturunan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Faktor pencetus</td>
			<td class="align-top border-bottom">: {{$asesmen['medis_faktor_pencetus'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Faktor organik</td>
			<td class="align-top border-bottom">: {{$asesmen['medis_faktor_organik'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>PEMERIKSAAN FISIK</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Kepala leher</td>
			<td class="align-top border-bottom">: {{$asesmen['fisik_kepala_leher'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Dada</td>
			<td class="align-top border-bottom">: {{$asesmen['fisik_dada'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Jantung</td>
			<td class="align-top border-bottom">: {{$asesmen['fisik_jantung'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Paru</td>
			<td class="align-top border-bottom">: {{$asesmen['fisik_paru'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Perut</td>
			<td class="align-top border-bottom">: {{$asesmen['fisik_perut'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Anggota gerak</td>
			<td class="align-top border-bottom">: {{$asesmen['fisik_anggota_gerak'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Status neurologis</td>
			<td class="align-top border-bottom">: {{$asesmen['status_neurologis'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Status lokalis</td>
			<td class="align-top border-bottom">: {{$asesmen['status_lokalis'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>STATUS PSIKIATRIK</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Kesan umum</td>
			<td class="align-top border-bottom">: {!! nl2br($asesmen['psikiatrik_kesan_umum'] ?? '-') !!}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Mood dan affect</td>
			<td class="align-top border-bottom">: {{$asesmen['psikiatrik_mood_dan_affect'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Kontak</td>
			<td class="align-top border-bottom">: {{$asesmen['psikiatrik_kontak'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Persepsi</td>
			<td class="align-top border-bottom">: {{$asesmen['psikiatrik_persepsi'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Pikiran</td>
			<td class="align-top border-bottom">: {{$asesmen['psikiatrik_pikiran'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Orientasi</td>
			<td class="align-top border-bottom">: {{$asesmen['psikiatrik_orientasi'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Daya ingat</td>
			<td class="align-top border-bottom">: {{$asesmen['psikiatrik_daya_ingat'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Perhatian</td>
			<td class="align-top border-bottom">: {{$asesmen['psikiatrik_perhatian'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Intelegensi</td>
			<td class="align-top border-bottom">: {{$asesmen['psikiatrik_intelegensi'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Pengendalian impuls</td>
			<td class="align-top border-bottom">: {{$asesmen['psikiatrik_pengendalian_impuls'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tilikan</td>
			<td class="align-top border-bottom">: {{$asesmen['psikiatrik_tilikan'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>PEMERIKSAAN PENUNJANG/TAMBAHAN</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Pemeriksaan penunjang tambahan</td>
			<td class="align-top border-bottom">: {!! nl2br($asesmen['pemeriksaan_penunjang_tambahan'] ?? '-') !!}</td>
		</tr>
	</table>
	<div style="page-break-after: always;"></div>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="40%"></td>
			<td width="10%"></td>
			<td width="20%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="4" class="align-top border-bottom"><b>DIAGNOSIS</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Aksis 1</td>
			<td class="align-top border-bottom">: {{$asesmen['aksis_1'] ?? '-'}}</td>
			<td class="align-top border-bottom">ICD 10</td>
			<td class="align-top border-bottom">: {{$asesmen['icd_10_1'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Aksis 2</td>
			<td class="align-top border-bottom">: {{$asesmen['aksis_2'] ?? '-'}}</td>
			<td class="align-top border-bottom">ICD 10</td>
			<td class="align-top border-bottom">: {{$asesmen['icd_10_2'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Aksis 3</td>
			<td class="align-top border-bottom">: {{$asesmen['aksis_3'] ?? '-'}}</td>
			<td class="align-top border-bottom">ICD 10</td>
			<td class="align-top border-bottom">: {{$asesmen['icd_10_3'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Aksis 4</td>
			<td class="align-top border-bottom" colspan="3">: {{$asesmen['aksis_4'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Aksis 5</td>
			<td class="align-top border-bottom" colspan="3">: {{$asesmen['aksis_5'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>MASALAH KESEHATAN PASIEN</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Masalah kesehatan pasien</td>
			<td class="align-top border-bottom">: {!! nl2br($asesmen['masalah_kesehatan_pasien'] ?? '-') !!}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>PERENCANAAN (TARGET DAN WAKTU)</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Perencanaan target waktu</td>
			<td class="align-top border-bottom">: {!! nl2br($asesmen['perencanaan_target_waktu'] ?? '-') !!}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>PENATALAKSANAAN</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Penatalaksanaan</td>
			<td class="align-top border-bottom">: {!! nl2br($asesmen['penatalaksanaan'] ?? '-') !!}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>PROGNOSIS</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Prognosis</td>
			<td class="align-top border-bottom">: {!! nl2br($asesmen['prognosis'] ?? '-') !!}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>LEMBAR TINDAKAN</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tindakan jam</td>
			<td class="align-top border-bottom">: {{$asesmen['tindakan_jam'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tindakan</td>
			<td class="align-top border-bottom">: {{$asesmen['tindakan_tindakan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">ICD 9</td>
			<td class="align-top border-bottom">: {{$asesmen['icd_9'] ?? '-'}}</td>
		</tr>
	</table>
	<br><br>
	<table width="100%">
		<tr>
			<td width="60%"></td>
			<td width="40%" class="centered">DOKTER</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered"><img src="{{$asesmen['creator']['ttd']}}" style="max-width: 90px"></td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">{{$asesmen['creator']['name']}}</td>
		</tr>
	</table>
</body>
</html>


