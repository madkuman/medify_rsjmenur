<!DOCTYPE html>
<html>
<head>
	<title>RESUME NON JIWA</title>
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
							<img src="{{ public_path('assets/img/pemprov-jatim.png') }}" height="55">
						</td>
						<td width="60%" style="text-align: center; font-size: 12px;">
							<b>
								PEMERINTAH PROVINSI JAWA TIMUR<br>
								DINAS KESEHATAN<br>
								RUMAH SAKIT JIWA MENUR<br>
								Jl. Raya Menur No 120 Surabaya, 60282 <br>
								Telp(031)5021635, Laman rsjmenur.jatimprov.go.id </br>
						</td>
						<td width="20%" style="text-align: left;">
							<img src="" height="55">
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
						<td>: {{date('j M Y', strtotime($kasus->pasien->date_of_birth))}} / {{$kasus->pasien->age ?? '-'}} Tahun</td>
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
				<b style="font-size: 16px;">RINGKASAN PASIEN PULANG NON JIWA (DISCHARGE SUMMARY) </b>
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
						<td colspan="2"><b>DIAGNOSA</b></td>
					</tr>
					<tr>
						<td width="20%">Diagnosa Masuk</td>
						<td width="75%">: {{$item->diagnosa_masuk}}</td>
					</tr>
					<tr>
						<td>Diagnosa Utama</td>
						<td>: {{$item->diagnosa_utama}}</td>
					</tr>
					<tr>
						<td>Diagnosa Tambahan</td>
						<td>: {{$item->diagnosa_tambahan}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" ><b>2.</b></td>
						<td width="95%"><b>JENIS TINDAKAN</b> : <br>{!! nl2br($item->jenis_tindakan) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" ><b>3.</b></td>
						<td width="95%"><b>ALASAN DIRAWAT</b> : <br>{!! nl2br($item->alasan_rawat) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" ><b>4.</b></td>
						<td width="95%"><b>RINGKASAN PENYAKIT</b> : <br>{!! nl2br($item->ringkasan) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" rowspan="4"><b>5.</b></td>
						<td colspan="2"><b>PEMERIKSAAN SAAT MRS</b></td>
					</tr>
					<tr>
						<td width="20%">Pemeriksaan_fisik</td>
						<td width="75%">: {{$item->pemeriksaan_fisik}}</td>
					</tr>
					<tr>
						<td>Laboratorium</td>
						<td>: {{$item->lab}}</td>
					</tr>
					<tr>
						<td>Terapi Pasien</td>
						<td>: {{$item->terapi}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" ><b>6.</b></td>
						<td width="95%"><b>HASIL KONSUL</b> : <br>{!! nl2br($item->hasil_konsul) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" ><b>7.</b></td>
						<td width="95%"><b>PERKEMBANGAN</b> : <br>{!! nl2br($item->hasil_konsul) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" ><b>8.</b></td>
						<td width="95%"><b>KEADAAN WAKTU PULANG</b> : <br>{!! nl2br($item->hasil_konsul) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" rowspan="4"><b>9.</b></td>
						<td colspan="2"><b>INFORMASI KONTROL (PASCA MRS)</b></td>
					</tr>
					<tr>
						<td width="20%">Tanggal Kontrol </td>
						<td width="75%">: {{$item->waktu_kontrol}}</td>
					</tr>
					<tr>
						<td>Poli</td>
						<td>: {{$item->poli->name}}</td>
					</tr>
					
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" ><b>10.</b></td>
						<td width="95%"><b>SARAN DAN TINDAK LANJUT</b> : <br>{!! nl2br($item->instruksi) !!}</td>
					</tr>
				</table>
			</td>
		</tr>
		{{--  <tr>
			<td>
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="5%" rowspan="4"><b>2.</b></td>
						<td colspan="2"><b>RINGKASAN</b></td>
					</tr>
					<tr>
						<td width="20%">Jenis Tindakan</td>
						<td width="75%">: {{$item->jenis_tindakan}}</td>
					</tr>
					<tr>
						<td>Alasan Dirawat</td>
						<td>: {{$item->alasan_rawat}}</td>
					</tr>
					<tr>
						<td>Ringkasan Penyakit</td>
						<td>: {{$item->ringkasan}}</td>
					</tr>
				</table>
			</td>
		</tr>	  --}}
		{{--  <tr>
			<td>1.</td>
			<td>Diagnosa Masuk </td>
			<td>:</td>
			<td>{{$item->diagnosa_masuk}}</td>
		</tr>
		<tr>
			<td>2.</td>
			<td>Diagnosa Utama </td>
			<td>:</td>
			<td>{{$item->diagnosa_utama}}</td>
		</tr>
		<tr>
			<td>3.</td>
			<td>Diagnosa Tambahan</td>
			<td>:</td>
			<td>{{$item->diagnosa_tambahan}}</td>
		</tr>
		<tr>
			<td>4.</td>
			<td>Jenis Tindakan</td>
			<td>:</td>
			<td>{{$item->jenis_tindakan}}</td>
		</tr>
		<tr>
			<td>5.</td>
			<td>Alasan Dirawat</td>
			<td>:</td>
			<td>{{$item->alasan_rawat}}</td>
		</tr>
		<tr>
			<td>6.</td>
			<td>Ringkasan Penyakit</td>
			<td>:</td>
			<td>{{$item->ringkasan}}</td>
		</tr>
		<tr>
			<td>7.</td>
			<td>Pemeriksaan_fisik</td>
			<td>:</td>
			<td>{{$item->pemeriksaan_fisik}}</td>
		</tr>
		<tr>
			<td>8.</td>
			<td>Lab</td>
			<td>:</td>
			<td>{{$item->lab}}</td>
		</tr>
		<tr>
			<td>9.</td>
			<td>Terapi Pasien</td>
			<td>:</td>
			<td>{{$item->terapi}}</td>
		</tr>
		<tr>
			<td>10.</td>
			<td>Hasil Konsul</td>
			<td>:</td>
			<td>{{$item->hasil_konsul}}</td>
		</tr>
		<tr>
			<td>11.</td>
			<td>Perkembangan</td>
			<td>:</td>
			<td>{{$item->perkembangan}}</td>
		</tr>
		<tr>
			<td>12.</td>
			<td>Keadaan Waktu Pulang </td>
			<td>:</td>
			<td>{{$item->keadaan_krs}}</td>
		</tr>
		<tr>
			<td>13.</td>
			<td>Waktu kontrol ulang tanggal <br>(Hanya Untuk Satu Poli)</td>
			<td>:</td>
			<td>{{$item->waktu_kontrol}} ; Klinik : {{$item->poli->name ?? '-'}} ; Rumah Sakit : RSJ MENUR SBY ;</td>
		</tr>
			<tr>
				<td>14.</td>
				<td>Instruksi / Saran tindak lanjut</td>
				<td>:</td>
				<td>{{$item->instruksi}}</td>
			</tr>  --}}
	</table>
	<table class="bordered">
		{{--  <tr>
			<td colspan="2">
				<table class="noBorder">
					<tr>
						<td width="50%" class="centered">Mengetahui DPJP</td>
						<td width="50%" class="centered">Perawat</td>
					</tr>
					<tr>
						<td colspan="2"><br><br></td>
					</tr>
					<tr>
						<td class="centered">{{$kasus->dpjp->user->name}}</td>
						<td class="centered">{{$item->creator->name}}</td>
					</tr>
					<tr>
						<td colspan="2"><br></td>
					</tr>
				</table>
			</td>
		</tr>  --}}
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
						<td colspan="2"></td>
					</tr>
					<tr>
						<td></td>
						{{-- <td class="centered"><img src="{{url('')}}/{{$kasus->dpjp->user->ttd}}" style="max-width: 90px"></td> --}}
						<td class="centered"><img src="{{ !empty($item->creator) ? public_path($item->creator->ttd ?? '') : '' }}" style="max-width: 90px"></td>
					</tr>
					<tr>
						<td></td>
						{{--<td class="centered">{{$kasus->dpjp->user->name}}</td>--}}
						<td class="centered">{{$item->creator->name}}</td>
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