<!DOCTYPE html>
<html>
<head>
	<title>RINGKASAN PASIEN PULANG (DISCHARGE SUMMARY)</title>
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
						<td width="20%" style="text-align: right;">
							<img src="{{url('')}}/assets/img/pemprov-jatim.png" height="55">
						</td>
						<td width="60%" style="text-align: center; font-size: 12px;">
							<b>
								PEMERINTAH PROVINSI JAWA TIMUR<br>
								RUMAH SAKIT JIWA MENUR<br>
								Jl Menur No.120,<br>
								Telp(031)5021635,5021637<br>
								Surabaya
							</br>
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
						<td>: {{$kasus->pasien->date_of_birth ? indonesian_date(date('j M Y', strtotime($kasus->pasien->date_of_birth))) : '-'}} / {{$kasus->pasien->age ?? '-'}} Tahun</td>
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
				<b style="font-size: 16px;">RINGKASAN PASIEN PULANG (DISCHARGE SUMMARY)</b>
			</td>
		</tr>
	</table>
	<table class="bordered">
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="20%">Ruang Perawatan</td>
						<td width="80%">: {{$kasus->lokasi->lokasi->nama}}</td>
					</tr>
					<tr>
						<td>Tgl MRS</td>
						@php
							$tgl_masuk = $kasus->active_sep->tgl_sep ?? $kasus->mrs_at;
                           	$tgl_masuk = $tgl_masuk ?? $kasus->created_at;
						@endphp
						<td>: {{indonesian_date(date('y-m-d', strtotime($tgl_masuk)))}}</td>
					</tr>
					<tr>
						<td>Tgl KRS</td>
						<td>: {{$kasus->krs_at ? indonesian_date(date('y-m-d', strtotime($kasus->krs_at))) : indonesian_date(date('y-m-d'))}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><b><i>Diisi oleh Dokter</i></b></td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" rowspan="4"><b>1.</b></td>
						<td colspan="2"><b>ANAMNESA</b></td>
					</tr>
					<tr>
						<td width="20%">Keluhan Utama</td>
						<td width="75%">: {{$item->keluhan_utama}}</td>
					</tr>
					<tr>
						<td>Perjalanan Penyakit</td>
						<td>: {{$item->perjalanan_penyakit_pasien}}</td>
					</tr>
					<tr>
						<td>Keluhan Lain</td>
						<td>: {{$item->keluhan_lain}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" rowspan="4"><b>2.</b></td>
						<td colspan="2"><b>RIWAYAT PENYAKIT DAHULU</b></td>
					</tr>
					<tr>
						<td width="30%">Riwayat Penyakit Sebelumnya</td>
						<td width="65%">: {{$item->riwayat_penyakit_sebelumnya}}</td>
					</tr>
					<tr>
						<td>Riwayat Keluarga</td>
						<td>: {{$item->riwayat_keluarga}}</td>
					</tr>
					<tr>
						<td>Lain-lain</td>
						<td>: {{$item->riwayat_penyakit_lain_lain}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" rowspan="6"><b>3.</b></td>
						<td colspan="2"><b>PEMERIKSAAN SAAT MRS</b></td>
					</tr>
					<tr>
						<td width="15%">Fisik</td>
						<td width="80%">: {{$item->fisik}}</td>
					</tr>
					<tr>
						<td>Psikiatrik</td>
						<td>: {{$item->psikiatrik}}</td>
					</tr>
					<tr>
						<td>Laboratorium</td>
						<td>: {{$item->laboratorium}}</td>
					</tr>
					<tr>
						<td>Radiologi</td>
						<td>: {{$item->radiologi}}</td>
					</tr>
					<tr>
						<td>Lain-lain</td>
						<td>: {{$item->pemeriksaan_lain_lain}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" ><b>4.</b></td>
						<td width="35%"><b>INDIKASI MRS/DIAGNOSA MASUK</b></td>
						<td width="60%">: {{$item->indikasi_mrs_diagnosa_masuk}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%"><b>5.</b></td>
						<td colspan="3"><b>DIAGNOSA AKHIR</b></td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td width="25%">Diagnosa Utama</td>
						<td width="70%" colspan="2">: ({{$kasus->diagnosisUtama->icd10->code_icd ?? ''}}) - {{$kasus->diagnosisUtama->icd10->long_desc ?? ''}} </td>
					</tr>
					<tr>
						<td></td>
						<td align="right">Axis 1</td>
						<td width="50%">: {{$item->axis_1}}</td>
						<td width="20%">ICD-10 : {{$item->icd_10_axis_1}} </td>
					</tr>
					<tr>
						<td></td>
						<td align="right">Axis 2</td>
						<td>: {{$item->axis_2}}</td>
						<td>ICD-10 : {{$item->icd_10_axis_2}}</td>
					</tr>
					<tr>
						<td></td>
						<td align="right">Axis 3</td>
						<td>: {{$item->axis_3}}</td>
						<td>ICD-10 : {{$item->icd_10_axis_3}} </td>
					</tr>
					<tr>
						<td></td>
						<td align="right">Axis 4</td>
						<td>: {{$item->axis_4}}</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td align="right">Axis 5</td>
						<td>: {{$item->axis_5}}</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td colspan="3">Diagnosa Sekunder</td>
					</tr>
					@foreach($kasus->diagnosisSekunder as $sekunder)
					<tr>
						<td></td>
						<td></td>
						<td>- {{$sekunder->icd10->long_desc ?? ''}}</td>
						<td>ICD-10 : {{$sekunder->icd10->code_icd ?? ''}}</td>
					</tr>
					@endforeach
					<tr>
						<td></td>
						<td colspan="3">Diagnosa Komplikasi</td>
					</tr>
					@foreach($kasus->diagnosisKomplikasi as $komplikasi)
					<tr>
						<td></td>
						<td></td>
						<td>- {{$komplikasi->icd10->long_desc ?? ''}}</td>
						<td>ICD-10 : {{$komplikasi->icd10->code_icd ?? ''}}</td>
					</tr>
					@endforeach
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" ><b>6.</b></td>
						<td width="95%"><b>MASALAH UTAMA YANG DIHADAPI</b> : <br>{!! nl2br($item->masalah_utama_yang_dihadapi) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" ><b>7.</b></td>
						<td width="95%"><b>KONSULTASI</b> : <br>{!! nl2br($item->konsultasi) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" ><b>8.</b></td>
						<td width="95%"><b>PENGOBATAN MEDIS</b> : <br>
							@if(count($kasus->resep) > 0)
							@foreach($kasus->resep as $resep)
							@foreach($resep->resepDetail as $detail)
							- {{($detail->kategori == 'racikan') ? $detail->racikan : $detail->obat_name}}, {{$detail->jumlah}} {{$detail->type}} <br>
							@endforeach
							@endforeach
							@endif
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" ><b>9.</b></td>
						<td width="95%"><b>TINDAKAN MEDIS OPERATIF/NON OPERATIF</b></td>
					</tr>
				</table>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%"></td>
						<td width="65%">{!! nl2br($item->tindakan_medis_operatif_non_operatif) !!}</td>
						<td width="8%">ICD-9 :</td>
						<td width="22%">
							@if(count($kasus->tindakan_icd9) > 0)
							@foreach($kasus->tindakan_icd9 as $tindakan)
							- {{$tindakan->icd9->code_icd}}<br>
							@endforeach
							@endif
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" rowspan="2"><b>10.</b></td>
						<td width="95%"><b>PERJALANAN PENYAKIT</b></td>
					</tr>
					<tr>
						<td>Selama Perawatan : <br>{!! nl2br($item->perjalanan_penyakit_selama_perawatan) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" ><b>11.</b></td>
						<td width="95%"><b>KEADAAN WAKTU KRS</b> : <br>{!! nl2br($item->keadaan_waktu_krs) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" ><b>12.</b></td>
						<td width="95%"><b>SEBAB MENINGGAL</b> : <br>{!! nl2br($item->sebab_meninggal) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" ><b>13.</b></td>
						<td width="95%"><b>TINDAK LANJUT</b> : <br>{!! nl2br($item->tindak_lanjut) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" ><b>14.</b></td>
						<td width="95%"><b>CATATAN KHUSUS</b> : <br>{!! nl2br($item->catatan_khusus) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder">
					<tr>
						<td width="50%"></td>
						<td width="50%" class="centered">Surabaya, {{$kasus->krs_at ? indonesian_date(date('y-m-d', strtotime($kasus->krs_at))) : indonesian_date(date('y-m-d'))}}</td>
					</tr>
					<tr>
						<td></td>
						<td class="centered">Dokter Penanggung Jawab Pelayanan</td>
					</tr>
					<tr>
						<td colspan="2"><br><br><br></td>
					</tr>
					<tr>
						<td></td>
						<td class="centered">{{$kasus->dpjp->user->name}}</td>
					</tr>
					<tr>
						<td colspan="2"><br></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
