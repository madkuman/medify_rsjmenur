<!DOCTYPE html>
<html>
<head>
	<title>PERMOHONAN KONSULTASI</title>
	<style type="text/css">
		table{
			font-family: sans-serif;
			width: 100%;
			font-size: 12px;
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
		.gap td{
			padding-top: 4px;
			padding-bottom: 4px; 
		}
		.mini-gap td{
			padding-top: 2px;
			padding-bottom: 2px; 
		}
		.ttd{
			color: white;
			font-size: 30px;	
		}
		.margin-minus{
			margin-left: -1px;
			margin-right: -1px;
			margin-bottom: -1px;
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
	</style>
</head>
<body>
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				RM. 23
			</td>
		</tr>
	</table>
	<table class="margin-minus" style="margin-top: 10px; border: 1px solid black;">
		<tr>
			<td width="55%" style="vertical-align: middle;">
				<table>
					<tr>
						<td width="20%" style="text-align: right;">
							<img src="{{url('')}}/assets/img/pemprov-jatim.png" height="55">
						</td>
						<td width="60%" style="text-align: center; font-size: 12px;">
							<b>
								RUMAH SAKIT JIWA MENUR<br>
								LABORATORIUM KLINIK<br>
								Jl Raya Menur No.120 Surabaya
							</b>
						</td>
						<td width="20%" style="text-align: left;">
							<img src="{{url('')}}/assets/img/menur.png" height="55">
						</td>
					</tr>
				</table>
			</td>
			<td width="45%">
				<table class="mini-gap">
					<tr>
						<td>No. RM</td>
						<td>: {{$kasus->pasien->no_rm_formatted}}</td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>: {{$kasus->pasien->name}}</td>
					</tr>
					<tr>
						<td>Tgl Lahir/Umur</td>
						<td>: {{date('j M Y', strtotime($kasus->pasien->date_of_birth))}}</td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>: {{$kasus->pasien->gender == '1' ? 'Laki-laki' : 'Perempuan'}}</td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>: {{$kasus->pasien->address}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center; border-top: 1px solid black; padding: 6px;">
				<b style="font-size: 16px;">PERMOHONAN KONSULTASI</b>
			</td>
		</tr>
	</table>
	<table class="bordered">
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td align="right">Surabaya, {{Carbon\Carbon::now()->format('j F Y')}}</td>
					</tr>
					<tr>
						<td class="tab">Kepada Yth :</td>
					</tr>
					<tr>
						<td class="tab">{{$user->name}}</td>
					</tr>
					<tr>
						<td class="tab">Di Rumah Sakit Jiwa Menur</td>
					</tr>
					<tr>
						<td class="tab">Provinsi Jawa Timur</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td colspan="2">Mohon konsultasi pasien</td>
					</tr>
					<tr>
						<td width="20%" class="tab">No RM</td>
						<td width="80%">: {{$kasus->pasien->no_rm_formatted}}</td>
					</tr>
					<tr>
						<td class="tab">Nama</td>
						<td>: {{$kasus->pasien->name}}</td>
					</tr>
					<tr>
						<td class="tab">Jenis Kelamin</td>
						<td>: {{$kasus->pasien->gender == '1' ? 'Laki-laki' : 'Perempuan'}}</td>
					</tr>
					<tr>
						<td class="tab">Umur</td>
						<td>: {{$kasus->pasien->age}}</td>
					</tr>	
					<tr>
						<td class="tab">Ruang/Poliklinik</td>
						<td>: {{$kasus->lokasi->lokasi->nama}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td class="tab">Diagnosa Utama : {{$kasus->diagnosisUtama->icd10->code_icd}} - {{$kasus->diagnosisUtama->icd10->long_desc}}</td>
					</tr>
					<tr>
						<td class="tab">
							Diagnosa Tambahan/Sekunder
							<div class="ml cb @if(sizeof($kasus->diagnosisTambahan) == 0) cbx @endif"></div>Tidak Ada
							<div class="ml cb  @if(sizeof($kasus->diagnosisTambahan) != 0) cbx @endif"></div>Ada
						</td>
					</tr>
					<tr>
						<td class="indent">
							@foreach($kasus->diagnosisTambahan as $diagnosis)
							{{$diagnosis->icd10->code_icd}} - {{$diagnosis->icd10->long_desc}}<br>
							@endforeach
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td class="tab">Tujuan Konsultasi :</td>
					</tr>
					<tr>
						<td class="indent">{{$kolaborator->message ?? '-'}}<br></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="40%" class="centered">Yang Mengirim,</td>
						<td width="60%"></td>
					</tr>
					<tr>
						<td colspan="2"><br><br></td>
					</tr>
					<tr>
						<td class="centered">{{$kolaborator->creator->name}}</td>
						<td></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table class="bordered">
		<tr>
			<td style="text-align: center; border-top: 1px solid black; padding: 6px;">
				<b style="font-size: 16px;">JAWABAN KONSULTASI</b>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td>Bersama ini kami sampaikan hasil pemeriksaan pasien diatas</td>
					</tr>
					<tr>
						<td class="tab">Pada pemeriksaan ditemukan :</td>
					</tr>
					@if(!empty($cppt))
						<tr>
							<td class="tab">
								<small style="text-decoration: underline;">SUBJECTIVE</small><br>
								{{{ $cppt->subjective }}}
							</td>
						</tr>
						<tr>
							<td class="tab">
								<small style="text-decoration: underline;">OBJECTIVE</small><br>
								{{{ $cppt->objective }}}
							</td>
						</tr>
						<tr>
							<td class="tab">
								<small style="text-decoration: underline;">ASSESSMENT</small><br>
								{{{ $cppt->assessment }}}
							</td>
						</tr>
						<tr>
							<td class="tab">
								<small style="text-decoration: underline;">PLAN</small><br>
								{{{ $cppt->plan }}}
							</td>
						</tr>
						<tr>
							<td class="tab">
								<small style="text-decoration: underline;">INSTRUKSI DOKTER / IMPLEMENTASI PPA</small><br>
								{{ $cppt->ppa }}
							</td>
						</tr>
					@else
					<tr>
						<td><br><br></td>
					</tr>
					@endif
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td class="tab">Diagnosa Utama : {{$kasus->diagnosisUtama->icd10->code_icd}} - {{$kasus->diagnosisUtama->icd10->long_desc}}</td>
					</tr>
					<tr>
						<td class="tab">
							Diagnosa Tambahan/Sekunder
							<div class="ml cb @if(sizeof($kasus->diagnosisTambahan) == 0) cbx @endif"></div>Tidak Ada
							<div class="ml cb  @if(sizeof($kasus->diagnosisTambahan) != 0) cbx @endif"></div>Ada
						</td>
					</tr>
					<tr>
						<td class="indent">
							@foreach($kasus->diagnosisTambahan as $diagnosis)
							{{$diagnosis->icd10->code_icd}} - {{$diagnosis->icd10->long_desc}}<br>
							@endforeach
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td class="tab">Pengobatan yang diberikan :</td>
					</tr>
					<tr>
						<td><br><br></td>
					</tr>
					<tr>
						<td class="tab">
							Saran :
							<div class="ml cb"></div>Rawat Bersama
							<div class="ml cb"></div>Tindakan
							<div class="ml cb"></div>Alih Rawat
							<div class="ml cb"></div>Lain lain..........................................
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="40%" class="centered">Surabaya, {{Carbon\Carbon::now()->format('j F Y')}}</td>
						<td width="60%"></td>
					</tr>
					<tr>
						<td width="40%" class="centered">Yang Menjawab,</td>
						<td width="60%"></td>
					</tr>
					<tr>
						<td colspan="2"><br><br></td>
					</tr>
					<tr>
						<td class="centered">{{$user->name}}</td>
						<td></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>