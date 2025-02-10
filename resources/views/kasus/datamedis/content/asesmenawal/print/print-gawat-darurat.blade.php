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
			<td style="border: 1px solid black;" width="50%">
				<table>
					<tr>
						<td width="15%" style="text-align: center;">
							<img style="margin-left:5px; margin-top:10px;"src="{{url('')}}/assets/img/pemprov-jatim.png" height="75">
						</td>
						<td width="85%" style="text-align: center; font-size: 10px;">
							<p style="font-size: 10px;">PEMERINTAH PROVINSI JAWA TIMUR <br>
                                DINAS KESEHATAN <br>
                                <b>RUMAH SAKIT JIWA MENUR</b> <br>
                                Jl.Raya Menur No.120,Gubeng,Kertajaya,Surabaya JATIM<br>
                                Telp. (031) 5021635, Laman:rsjmenur.jatimprov.go.id
                            </p>
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
	<table class="bordered" style="border-collapse: separate; margin-bottom: 10px;">
		<tr>
			<td width="32%" class="centered box"><b>ALERGI: </b><br> {{$asesmen['alergi'] ?? '-'}}
			</td>
			<td width="32%" class="centered box"><b>RISIKO: </b><br> {{$asesmen['risiko'] ?? '-'}}
			</td>
			<td width="36%" class="centered box"><b>TANGGAL DAN JAM: </b><br> {{$asesmen['tanggal_datang'] ?? '-'}}, {{$asesmen['jam_datang'] ?? '-'}}
			</td>
		</tr>
	</table>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td class="align-top border-bottom">Kategori pasien</td>
			<td class="align-top border-bottom">: {{$asesmen['kategori_pasien'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>RUJUKAN</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">a. Tanggal rujukan</td>
			<td class="align-top border-bottom">: {{$asesmen['tanggal_rujukan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">b. Nomor rujukan</td>
			<td class="align-top border-bottom">: {{$asesmen['nomor_rujukan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">c. Dokter pengirim</td>
			<td class="align-top border-bottom">: {{$asesmen['dokter_pengirim'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
{{--
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>TRIAGE</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Triage</td>
			<td class="align-top border-bottom">: {{$asesmen['resultisasi'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tanggal selesai pengkajian</td>
			<td class="align-top border-bottom">: {{$asesmen['tanggal_selesai_pengkajian_triage'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Jam selesai pengkajian</td>
			<td class="align-top border-bottom">: {{$asesmen['jam_selesai_pengkajian_triage'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Yang melakukan triage</td>
			<td class="align-top border-bottom">: {{$asesmen['yang_melakukan_triage'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
--}}
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>ASESMEN KEPERAWATAN</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tanggal pengkajian</td>
			<td class="align-top border-bottom">: {{$asesmen['tanggal_pengkajian'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Jam pengkajian</td>
			<td class="align-top border-bottom">: {{$asesmen['jam_pengkajian'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Keluhan utama</td>
			<td class="align-top border-bottom">: {!! nl2br($asesmen['keluhan_utama'] ?? '-') !!}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>STATUS FISIK</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">GCS</td>
			<td class="align-top border-bottom">: {{$asesmen['gcs'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tekanan darah</td>
			<td class="align-top border-bottom">: {{$asesmen['tekanan_darah'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Frekuensi nadi</td>
			<td class="align-top border-bottom">: {{$asesmen['frekuensi_nadi'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Berat badan</td>
			<td class="align-top border-bottom">: {{$asesmen['berat_badan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Suhu</td>
			<td class="align-top border-bottom">: {{$asesmen['suhu'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Pernapasan</td>
			<td class="align-top border-bottom">: {{$asesmen['pernapasan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tinggi badan</td>
			<td class="align-top border-bottom">: {{$asesmen['tinggi_badan'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>STATUS PSIKOLOGIS</b></td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Penampilan</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Rapi</td>
			<td class="align-top border-bottom">: {{$asesmen['rapi'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tidak rapi</td>
			<td class="align-top border-bottom">: {{$asesmen['tidak_rapi'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tidak sesuai</td>
			<td class="align-top border-bottom">: {{$asesmen['tidak_sesuai'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['penampilan_lain_lain'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Pembicaraan</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Keras</td>
			<td class="align-top border-bottom">: {{$asesmen['keras'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Diam</td>
			<td class="align-top border-bottom">: {{$asesmen['diam'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Cepat</td>
			<td class="align-top border-bottom">: {{$asesmen['cepat'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lambat</td>
			<td class="align-top border-bottom">: {{$asesmen['lambat'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Non realistis</td>
			<td class="align-top border-bottom">: {{$asesmen['non_realistis'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['pembicaraan_lain_lain'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Aktivitas Motorik</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lesu</td>
			<td class="align-top border-bottom">: {{$asesmen['lesu'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Gelisah</td>
			<td class="align-top border-bottom">: {{$asesmen['gelisah'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Mondar mandir</td>
			<td class="align-top border-bottom">: {{$asesmen['mondar_mandir'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['aktivitas_motorik_lain_lain'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Alam Perasaan</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Cemas</td>
			<td class="align-top border-bottom">: {{$asesmen['cemas'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Sedih</td>
			<td class="align-top border-bottom">: {{$asesmen['sedih'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Takut</td>
			<td class="align-top border-bottom">: {{$asesmen['takut'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Gembira berlebihan</td>
			<td class="align-top border-bottom">: {{$asesmen['gembira_berlebihan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['alam_perasaan_lain_lain'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Proses pikir</td>
			<td class="align-top border-bottom">: {{$asesmen['proses_pikir'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Persepsi</td>
			<td class="align-top border-bottom">: {{$asesmen['persepsi'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>STATUS SOSIAL</b></td>
		</tr>
		<tr>
			{{--<td class="align-top border-bottom">Yang menemani pasien di rs</td>--}}
			<td class="align-top border-bottom">: {{$asesmen['yang_menemani_pasien_di_rs'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>SPIRITUAL</b></td>
		</tr>
		<tr>
			{{--<td class="align-top border-bottom">Saat ini apakah pasien membutuhkan pelayanan rohani?</td>--}}
			<td class="align-top border-bottom">: {{$asesmen['kebutuhan_pelayanan_rohani_pasien'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>STATUS EKONOMI</b></td>
		</tr>
		<tr>
			{{--<td class="align-top border-bottom">Penanggung jawab biaya perawatan pasien</td>--}}
			<td class="align-top border-bottom">: {{$asesmen['penanggung_jawab_biaya_perawatan_pasien'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>RIWAYAT KESEHATAN</b></td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Pupil</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Normal</td>
			<td class="align-top border-bottom">: {{$asesmen['normal'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Miosis</td>
			<td class="align-top border-bottom">: {{$asesmen['miosis'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Midriasis</td>
			<td class="align-top border-bottom">: {{$asesmen['midriasis'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Isokor</td>
			<td class="align-top border-bottom">: {{$asesmen['isokor'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Anisokor</td>
			<td class="align-top border-bottom">: {{$asesmen['anisokor'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['pupil_lain2'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Neuro Sensori Motorik</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tidak ada keluhan</td>
			<td class="align-top border-bottom">: {{$asesmen['neuro_sensori_motorik_tidak_ada_keluhan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Spasme otot</td>
			<td class="align-top border-bottom">: {{$asesmen['neuro_sensori_motorik_spasme_otot'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Perubahan sensorik</td>
			<td class="align-top border-bottom">: {{$asesmen['neuro_sensori_motorik_perubahan_sensorik'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Perubahan motorik</td>
			<td class="align-top border-bottom">: {{$asesmen['neuro_sensori_motorik_perubahan_motorik'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['neuro_sensori_motorik_lain2'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Kepala Leher</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tidak ada gangguan</td>
			<td class="align-top border-bottom">: {{$asesmen['kepala_leher_tidak_ada_gangguan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Anemis</td>
			<td class="align-top border-bottom">: {{$asesmen['kepala_leher_anemis'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Pernapasan cuping hidung</td>
			<td class="align-top border-bottom">: {{$asesmen['kepala_leher_pernapasan_cuping_hidung'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Benjolan</td>
			<td class="align-top border-bottom">: {{$asesmen['kepala_leher_benjolan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Dispenea</td>
			<td class="align-top border-bottom">: {{$asesmen['kepala_leher_dispenea'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['kepala_leher_lain2'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Thorax</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tidak ada gangguan</td>
			<td class="align-top border-bottom">: {{$asesmen['thorax_tidak_ada_gangguan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Asimetris</td>
			<td class="align-top border-bottom">: {{$asesmen['thorax_asimetris'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Wheezing</td>
			<td class="align-top border-bottom">: {{$asesmen['thorax_wheezing'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Ronchi</td>
			<td class="align-top border-bottom">: {{$asesmen['thorax_ronchi'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Pernapasan cuping hidung</td>
			<td class="align-top border-bottom">: {{$asesmen['thorax_pernapasan_cuping_hidung'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Atelektasis</td>
			<td class="align-top border-bottom">: {{$asesmen['thorax_atelektasis'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['thorax_lain2'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Muskuloskeletal</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tidak ada gangguan</td>
			<td class="align-top border-bottom">: {{$asesmen['muskuloskeletal_tidak_ada_gangguan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Kerusakan jaringan atau luka</td>
			<td class="align-top border-bottom">: {{$asesmen['muskuloskeletal_kerusakan_jaringan_atau_luka'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Fraktur</td>
			<td class="align-top border-bottom">: {{$asesmen['muskuloskeletal_fraktur'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Dislokasi</td>
			<td class="align-top border-bottom">: {{$asesmen['muskuloskeletal_dislokasi'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Luksasio</td>
			<td class="align-top border-bottom">: {{$asesmen['muskuloskeletal_luksasio'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Perubahan bentuk ekstremitas</td>
			<td class="align-top border-bottom">: {{$asesmen['muskuloskeletal_perubahan_bentuk_ekstremitas'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['muskuloskeletal_lain2'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Kulit</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tidak ada gangguan</td>
			<td class="align-top border-bottom">: {{$asesmen['kulit_tidak_ada_gangguan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Luka</td>
			<td class="align-top border-bottom">: {{$asesmen['kulit_luka'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lecet</td>
			<td class="align-top border-bottom">: {{$asesmen['kulit_lecet'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Robek</td>
			<td class="align-top border-bottom">: {{$asesmen['kulit_robek'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Combus</td>
			<td class="align-top border-bottom">: {{$asesmen['kulit_combus'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Ganggren</td>
			<td class="align-top border-bottom">: {{$asesmen['kulit_ganggren'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['kulit_lain2'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Turgor Kulit</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Normal</td>
			<td class="align-top border-bottom">: {{$asesmen['turgor_normal'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Turun</td>
			<td class="align-top border-bottom">: {{$asesmen['turgor_turun'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['turgor_kulit_lain2'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Edema</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tidak ada</td>
			<td class="align-top border-bottom">: {{$asesmen['edema_tidak_ada'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Seluruh</td>
			<td class="align-top border-bottom">: {{$asesmen['edema_seluruh'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Anggota gerak</td>
			<td class="align-top border-bottom">: {{$asesmen['edema_anggota_gerak'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Kelopak mata</td>
			<td class="align-top border-bottom">: {{$asesmen['edema_kelopak_mata'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Perut</td>
			<td class="align-top border-bottom">: {{$asesmen['edema_perut'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['edema_lain2'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Mukosa Mulut</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lembab</td>
			<td class="align-top border-bottom">: {{$asesmen['mukosa_lembab'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Kering</td>
			<td class="align-top border-bottom">: {{$asesmen['mukosa_kering'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['mukosa_mulut_lain2'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Intoksifikasi</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Makanan minuman</td>
			<td class="align-top border-bottom">: {{$asesmen['makanan_minuman'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Zat kimia</td>
			<td class="align-top border-bottom">: {{$asesmen['zat_kimia'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Gigitan hewan</td>
			<td class="align-top border-bottom">: {{$asesmen['gigitan_hewan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Gas</td>
			<td class="align-top border-bottom">: {{$asesmen['gas'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Obat</td>
			<td class="align-top border-bottom">: {{$asesmen['obat'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Eleminasi</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Frekuensi bab</td>
			<td class="align-top border-bottom">: {{$asesmen['frekuensi_bab'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Konsistensi</td>
			<td class="align-top border-bottom">: {{$asesmen['konsistensi'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Warna bab</td>
			<td class="align-top border-bottom">: {{$asesmen['warna_bab'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Frekuensi bak</td>
			<td class="align-top border-bottom">: {{$asesmen['frekuensi_bak'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Warna baK</td>
			<td class="align-top border-bottom">: {{$asesmen['warna_baK'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Riwayat penyakit dahulu</td>
			<td class="align-top border-bottom">: {!! nl2br($asesmen['riwayat_penyakit_dahulu'] ?? '-') !!}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Riwayat penyakit keluarga</td>
			<td class="align-top border-bottom">: {!! nl2br($asesmen['riwayat_penyakit_keluarga'] ?? '-') !!}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Riwayat konsumsi alkohol</td>
			<td class="align-top border-bottom">: {!! nl2br($asesmen['riwayat_konsumsi_alkohol'] ?? '-') !!}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>RIWAYAT ALERGI</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Ada alergi</td>
			<td class="align-top border-bottom">: {{$asesmen['ada_alergi'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tidak ada alergi</td>
			<td class="align-top border-bottom">: {{$asesmen['tidak_ada_alergi'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Alergi tidak diketahui</td>
			<td class="align-top border-bottom">: {{$asesmen['alergi_tidak_diketahui'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Gelang tanda alergi terpasang</td>
			<td class="align-top border-bottom">: {{$asesmen['gelang_tanda_alergi_terpasang'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Alergi terhadap</td>
			<td class="align-top border-bottom">: {{$asesmen['alergi_terhadap'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Reaksi</td>
			<td class="align-top border-bottom">: {{$asesmen['reaksi'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>SKRINING NYERI</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Skala</td>
			<td class="align-top border-bottom">: {{$asesmen['nyeri_scala'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lokasi</td>
			<td class="align-top border-bottom">: {{$asesmen['nyeri_lokasi'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Durasi</td>
			<td class="align-top border-bottom">: {{$asesmen['nyeri_durasi'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Frekuensi</td>
			<td class="align-top border-bottom">: {{$asesmen['nyeri_frekuensi'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Karakteristik</td>
			<td class="align-top border-bottom">: {{$asesmen['nyeri_karakteristik'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>SKRINING RISIKO JATUH</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Pasien tampak tidak seimbang</td>
			<td class="align-top border-bottom">: {{$asesmen['pasien_tampak_tidak_seimbang'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Pasien pegangan pinggiran sesuatu</td>
			<td class="align-top border-bottom">: {{$asesmen['pasien_memegang_pinggiran'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Penilaian resiko jatuh</td>
			<td class="align-top border-bottom">: {{$asesmen['penilaian_resiko_jatuh'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>ASESMEN FUNGSIONAL</b></td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Sensorik Penglihatan</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Normal</td>
			<td class="align-top border-bottom">: {{$asesmen['penglihatan_normal'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Kabur</td>
			<td class="align-top border-bottom">: {{$asesmen['penglihatan_kabur'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Kacamata</td>
			<td class="align-top border-bottom">: {{$asesmen['penglihatan_kacamata'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lensa kontak</td>
			<td class="align-top border-bottom">: {{$asesmen['penglihatan_lensa_kontak'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['sensorik_penglihatan_lain_lain'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Sensorik Penciuman</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Normal</td>
			<td class="align-top border-bottom">: {{$asesmen['penciuman_normal'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tidak normal</td>
			<td class="align-top border-bottom">: {{$asesmen['penciuman_tidak_normal'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['sensorik_penciuman_lain_lain'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Sensorik Pendengaran</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Normal</td>
			<td class="align-top border-bottom">: {{$asesmen['pendengaran_normal'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tuli kanan kiri</td>
			<td class="align-top border-bottom">: {{$asesmen['pendengaran_tuli_kanan_kiri'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Alat bantu dengar kanan/kiri</td>
			<td class="align-top border-bottom">: {{$asesmen['pendengaran_alat_bantu_dengar_kanan_kiri'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['sensorik_pendengaran_lain_lain'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Kognitif</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Orientasi penuh</td>
			<td class="align-top border-bottom">: {{$asesmen['kognitif_orientasi_penuh'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Pelupa</td>
			<td class="align-top border-bottom">: {{$asesmen['kognitif_pelupa'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Bingung</td>
			<td class="align-top border-bottom">: {{$asesmen['kognitif_bingung'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tidak dapat dimengerti</td>
			<td class="align-top border-bottom">: {{$asesmen['kognitif_tidak_dapat_dimengerti'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['kognitif_lain_lain'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Motorik Aktivitas Sehari-hari</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Aktivitas mandiri</td>
			<td class="align-top border-bottom">: {{$asesmen['aktivitas_mandiri'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Aktivitas bantuan minimal</td>
			<td class="align-top border-bottom">: {{$asesmen['aktivitas_bantuan_minimal'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Aktivitas bantuan sebagian</td>
			<td class="align-top border-bottom">: {{$asesmen['aktivitas_bantuan_sebagian'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Aktivitas ketergantungan total</td>
			<td class="align-top border-bottom">: {{$asesmen['aktivitas_ketergantungan_total'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['motorik_aktivitas_seharihari_lain_lain'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Motorik Berjalan</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tidak ada kesulitan</td>
			<td class="align-top border-bottom">: {{$asesmen['berjalan_tidak_ada_kesulitan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Sering jatuh</td>
			<td class="align-top border-bottom">: {{$asesmen['berjalan_sering_jatuh'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Perlu bantuan</td>
			<td class="align-top border-bottom">: {{$asesmen['berjalan_perlu_bantuan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Kelumpuhan</td>
			<td class="align-top border-bottom">: {{$asesmen['berjalan_kelumpuhan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['motorik_berjalan_lain_lain'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>RISIKO NUTRITIONAL</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Gizi 6 bulan terakhir BB turun</td>
			<td class="align-top border-bottom">: {{$asesmen['gizi_enam_bulan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Gizi asupan</td>
			<td class="align-top border-bottom">: {{$asesmen['gizi_asupan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Pasien kondisi khusus</td>
			<td class="align-top border-bottom">: {{$asesmen['pasien_kondisi_khusus'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom"><b>Total Skor</b></td>
			<td class="align-top border-bottom">: 
				<b>{{$asesmen['gizi_asupan_skor'] + $asesmen['gizi_enam_bulan_skor']}}</b>
			</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>PERENCANAAN PULANG PASIEN</b></td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Kebutuhan Discharge Planning Awal</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Tidak ada</td>
			<td class="align-top border-bottom">: {{$asesmen['discharge_planning_tidak_ada'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Usia lanjut 60 tahun lebih</td>
			<td class="align-top border-bottom">: {{$asesmen['discharge_planning_usia_lanjut_60_tahun_lebih'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Hambatan mobilisasi</td>
			<td class="align-top border-bottom">: {{$asesmen['discharge_planning_hambatan_mobilisasi'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Pelayanan medis</td>
			<td class="align-top border-bottom">: {{$asesmen['discharge_planning_pelayanan_medis'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Bergantung untuk aktivitas harian</td>
			<td class="align-top border-bottom">: {{$asesmen['discharge_planning_bergantung_aktivitas'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Kriteria discharge planning lain</td>
			<td class="align-top border-bottom">: {{$asesmen['kriteria_discharge_planning_lain'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>KEPERAWATAN</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Kebutuhan Edukasi</td>
			<td class="align-top border-bottom">: {!! nl2br($asesmen['masalah_keperawatan'] ?? '-') !!}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>DIAGNOSIS KEPERAWATAN</b></td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Jiwa</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Perilaku Kekerasan</td>
			<td class="align-top border-bottom">: {{$asesmen['perilaku_kekerasan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Halusinasi</td>
			<td class="align-top border-bottom">: {{$asesmen['halusinasi'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Waham</td>
			<td class="align-top border-bottom">: {{$asesmen['waham'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Risiko Bunuh Diri</td>
			<td class="align-top border-bottom">: {{$asesmen['risiko_bunuh_diri'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Panik</td>
			<td class="align-top border-bottom">: {{$asesmen['panik'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Putus Dzat</td>
			<td class="align-top border-bottom">: {{$asesmen['putus_dzat'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Over Dosis</td>
			<td class="align-top border-bottom">: {{$asesmen['overdosis'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Kerusakan Komunikasi Verbal</td>
			<td class="align-top border-bottom">: {{$asesmen['kerusakan_komunikasi_verbal'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Defisit Perawatan Diri</td>
			<td class="align-top border-bottom">: {{$asesmen['defisit_perawatan_diri'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Intoleransi Aktivitas</td>
			<td class="align-top border-bottom">: {{$asesmen['intoleransi_aktivitas'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Isolasi Sosial</td>
			<td class="align-top border-bottom">: {{$asesmen['isolasi_sosial'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Diagnosa Keperawatan Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['diagnosa_keperawatan_lainnya'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Non Jiwa</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Bersihan Jalan Nafas Tidak Efektif</td>
			<td class="align-top border-bottom">: {{$asesmen['bersihan_jalan_nafas_tidak_efektif'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Pola Nafas Tidak Efektif</td>
			<td class="align-top border-bottom">: {{$asesmen['pola_nafas_tidak_efektif'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Hipertermia</td>
			<td class="align-top border-bottom">: {{$asesmen['hipertermia'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Defisit Volume Cairan</td>
			<td class="align-top border-bottom">: {{$asesmen['defisit_volume_cairan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Nyeri Akut</td>
			<td class="align-top border-bottom">: {{$asesmen['nyeri_akut'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Kerusakan Integritas Kulit</td>
			<td class="align-top border-bottom">: {{$asesmen['kerusakan_integritas_kulit'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Kelebihan Volume Cairan</td>
			<td class="align-top border-bottom">: {{$asesmen['kelebihan_volume_cairan'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Risiko Infeksi</td>
			<td class="align-top border-bottom">: {{$asesmen['risiko_infeksi'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Perfusi Jaringan Cerebral Tidak Efektif</td>
			<td class="align-top border-bottom">: {{$asesmen['perfusi_jaringan_cerebral_tidak_efektif'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Gangguan Mobilitas Fisik</td>
			<td class="align-top border-bottom">: {{$asesmen['gangguan_mobilitas_fisik'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Diagnosa Keperawatan Non Jiwa Lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['diagnosa_non_jiwa_keperawatan_lainnya'] ?? '-'}}</td>
		</tr>
		<tr class="subdetail">
			<td colspan="2" class="align-top border-bottom"><b>Intensif</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Intensif</td>
			<td class="align-top border-bottom">: {{$asesmen['intensif'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td width="30%"></td>
			<td width="70%"></td>
		</tr>
		<tr class="submenu">
			<td colspan="2" class="align-top border-bottom"><b>PERENCANAAN KEPERAWATAN</b></td>
		</tr>
		<tr>
			<td class="align-top border-bottom">NCP 01</td>
			<td class="align-top border-bottom">: {{$asesmen['ncp_01'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">NCP 02</td>
			<td class="align-top border-bottom">: {{$asesmen['ncp_02'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">NCP 03</td>
			<td class="align-top border-bottom">: {{$asesmen['ncp_03'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">NCP 04</td>
			<td class="align-top border-bottom">: {{$asesmen['ncp_04'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">NCP 05</td>
			<td class="align-top border-bottom">: {{$asesmen['ncp_05'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">NCP 06</td>
			<td class="align-top border-bottom">: {{$asesmen['ncp_06'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">NCP 07</td>
			<td class="align-top border-bottom">: {{$asesmen['ncp_07'] ?? '-'}}</td>
		</tr>
		<tr>
			<td class="align-top border-bottom">Rencana keperawatan lainnya</td>
			<td class="align-top border-bottom">: {{$asesmen['rencana_keperawatan_lainnya'] ?? '-'}}</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="content">
		<tr>
			<td colspan="3" class="submenu"><b>IMPLEMENTASI KEPERAWATAN</b></td>
		</tr>
		<tr>
			<td style="border: 1px solid black" width="15%"><b>TGL/JAM</b></td>
			<td style="border: 1px solid black" width="55%"><b>TINDAKAN</b></td>
			<td style="border: 1px solid black" width="30%"><b>EVALUASI</b></td>
		</tr>
		@php if(isset($asesmen['tindakan_implementasi_keperawatan_array'])) $tindakan = json_decode($asesmen['tindakan_implementasi_keperawatan_array']) @endphp
		@if(isset($tindakan))
		@foreach($tindakan as $tindakans)
		<tr>
			@if($loop->iteration == 1)
			<td style="border: 1px solid black">{{$asesmen['tanggal_jam_implementasi_keperawatan']}}<br>{{$tindakans->jam_implementasi_keperawatan ?? '-'}}</td>
			@else
			<td style="border: 1px solid black">{{$tindakans->jam_implementasi_keperawatan ?? '-'}}</td>
			@endif
			<td style="border: 1px solid black">{{$tindakans->tindakan_implementasi_keperawatan_array ?? '-'}}</td>
			@if($loop->iteration == 1)
			<td style="border: 1px solid black" rowspan="{{count($tindakan)}}">{!! nl2br($asesmen['evaluasi_implementasi_keperawatan'] ?? '-') !!}</td>
			@endif
		</tr>
		@endforeach
		@endif
	</table>
	<br>
	<br><br>
	<table width="100%">
		<tr>
			<td width="60%"></td>
			<td width="40%" class="centered">PERAWAT</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered"><img src="{{$asesmen['creator']['ttd']}} style="max-width" 90px""></td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">{{$asesmen['creator']['name']}}</td>
		</tr>
	</table>
</body>
</html>


