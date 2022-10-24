<!DOCTYPE html>
<html>
<head>
	<title>FORM TRANSFER INTERNAL RUMAH SAKIT</title>
	<style type="text/css">
		table{
			font-family: sans-serif;
			width: 100%;
			font-size: 12px;
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
			padding-left: 45px;
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
		img{
			display: inline;
		}
		.imgx{
			margin-top: 3px;
			border: 3px solid red;
			border-radius: 18px;
		}
		.mt-10{
			margin-top: 10px;
		}
		.primeBordered td{
			border: 1px solid black !important;
			padding-left: 5px;
			padding-right: 5px;
		}
		.v-sign{
			font-family: ZapfDingbats, sans-serif;
			text-align: center;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				RM. 09
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
						<td>: {{indonesian_date(date('j M Y', strtotime($kasus->pasien->date_of_birth)))}}</td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>: {{$kasus->pasien->gender == '1' ? 'Laki-laki' : 'Perempuan'}}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table class="bordered">
		<tr>
			<td class="big centered"><b>FORM TRANSFER INTERNAL RUMAH SAKIT</b></td>
		</tr>
	</table>
	<table class="bordered">
		<tr>
			<td width="50%">
				<table class="noBorder" cellpadding="2">
					<tr>
						<td>Tanggal Transfer : {{$item->tanggal_transfer ? indonesian_date(date('j F Y', strtotime($item->tanggal_transfer))) : '-'}}</td>
					</tr>
				</table>
			</td>
			<td width="50%">
				<table class="noBorder" cellpadding="2">
					<tr>
						<td>Alergi Obat : {{$item->alergi_obat}} </td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder" cellpadding="2">
					<tr>
						<td width="32%">Dari Ruang</td>
						<td width="27%">: {{$item->ruangan_asal}}</td>
						<td width="20%"></td>
						<td width="21%"></td>
					</tr>
					<tr>
						<td colspan="4">Keadaan saat pindah jam : {{$item->jam_berangkat_dari_ruangan}}</td>
					</tr>
					<tr>
						<td>Tekanan Darah</td>
						<td>: {{$item->tekanan_darah_1}}</td>
						<td>Nadi</td>
						<td>: {{$item->nadi_1}}</td>
					</tr>
					<tr>
						<td>Suhu</td>
						<td>: {{$item->suhu_1}} °C</td>
						<td>Respirasi</td>
						<td>: {{$item->respirasi_1}}</td>
					</tr>
					<tr>
						<td>GCS</td>
						<td colspan="3">E : {{$item->gcs_e_1}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;V : {{$item->gcs_v_1}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M : {{$item->gcs_m_1}}</td>
					</tr>
					<tr>
						<td>Gelisah</td>
						<td>: <div class="cb @if($item->gelisah_1 == 'Ya') cbx @endif"></div> Ya</td>
						<td colspan="2"><div class="cb @if($item->gelisah_1 == 'Tidak') cbx @endif"></div> Tidak</td>
					</tr>
					<tr>
						<td>Agresif</td>
						<td>: <div class="cb @if($item->agresif_1 == 'Ya') cbx @endif"></div> Ya</td>
						<td colspan="2"><div class="cb @if($item->agresif_1 == 'Tidak') cbx @endif"></div> Tidak</td>
					</tr>
					<tr>
						<td>Fiksasi</td>
						<td>: <div class="cb @if($item->fiksasi_1 == 'Ya') cbx @endif"></div> Ya</td>
						<td colspan="2"><div class="cb @if($item->fiksasi_1 == 'Tidak') cbx @endif"></div> Tidak</td>
					</tr>
					<tr>
						<td>Korban Pasung</td>
						<td>: <div class="cb @if($item->korban_pasung_1 == 'Ya') cbx @endif"></div> Ya</td>
						<td colspan="2"><div class="cb @if($item->korban_pasung_1 == 'Tidak') cbx @endif"></div> Tidak</td>
					</tr>
					<tr>
						<td>Indikasi bunuh diri</td>
						<td>: <div class="cb @if($item->indikasi_bunuh_diri_1 == 'Ya') cbx @endif"></div> Ya</td>
						<td colspan="2"><div class="cb @if($item->indikasi_bunuh_diri_1 == 'Tidak') cbx @endif"></div> Tidak</td>
					</tr>
					<tr>
						<td>Indikasi Jatuh</td>
						<td>: <div class="cb @if($item->indikasi_jatuh_1 == 'Ya') cbx @endif"></div> Ya</td>
						<td colspan="2"><div class="cb @if($item->indikasi_jatuh_1 == 'Tidak') cbx @endif"></div> Tidak</td>
					</tr>
					<tr>
						<td>Tingkat Nyeri</td>
						<td colspan="3">: {{$item->skala_nyeri_1}}</td>
					</tr>
				</table>
				<table class="noBorder mt-10">
					<tr>
						<td class="centered">
							<img src="{{asset('assets/img/nyeri/face(1).png')}}"
							class="@if($item->skala_nyeri_1 == 'Tidak Nyeri') imgx @endif">
							<img src="{{asset('assets/img/nyeri/face(2).png')}}"
							class="@if($item->skala_nyeri_1 == 'Nyeri Ringan') imgx @endif">
							<img src="{{asset('assets/img/nyeri/face(3).png')}}"
							class="@if($item->skala_nyeri_1 == 'Nyeri Mengganggu') imgx @endif">
							<img src="{{asset('assets/img/nyeri/face(4).png')}}"
							class="@if($item->skala_nyeri_1 == 'Nyeri Menyusahkan') imgx @endif">
							<img src="{{asset('assets/img/nyeri/face(5).png')}}"
							class="@if($item->skala_nyeri_1 == 'Nyeri Hebat') imgx @endif">
							<img src="{{asset('assets/img/nyeri/face(6).png')}}"
							class="@if($item->skala_nyeri_1 == 'Nyeri Sangat Hebat') imgx @endif">
						</td>
					</tr>
				</table>
			</td>
			<td>
				<table class="noBorder" cellpadding="2">
					<tr>
						<td width="32%">Ke Ruang</td>
						<td width="27%">: {{$item->ruangan_tujuan}}</td>
						<td width="20%"></td>
						<td width="21%"></td>
					</tr>
					<tr>
						<td colspan="4">Keadaan saat pindah jam : {{$item->jam_tiba_di_ruangan}}</td>
					</tr>
					<tr>
						<td>Tekanan Darah</td>
						<td>: {{$item->tekanan_darah_2}}</td>
						<td>Nadi</td>
						<td>: {{$item->nadi_2}}</td>
					</tr>
					<tr>
						<td>Suhu</td>
						<td>: {{$item->suhu_2}} °C</td>
						<td>Respirasi</td>
						<td>: {{$item->respirasi_2}}</td>
					</tr>
					<tr>
						<td>GCS</td>
						<td colspan="3">E : {{$item->gcs_e_2}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;V : {{$item->gcs_v_2}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M : {{$item->gcs_m_2}}</td>
					</tr>
					<tr>
						<td>Gelisah</td>
						<td>: <div class="cb @if($item->gelisah_2 == 'Ya') cbx @endif"></div> Ya</td>
						<td colspan="2"><div class="cb @if($item->gelisah_2 == 'Tidak') cbx @endif"></div> Tidak</td>
					</tr>
					<tr>
						<td>Agresif</td>
						<td>: <div class="cb @if($item->agresif_2 == 'Ya') cbx @endif"></div> Ya</td>
						<td colspan="2"><div class="cb @if($item->agresif_2 == 'Tidak') cbx @endif"></div> Tidak</td>
					</tr>
					<tr>
						<td>Fiksasi</td>
						<td>: <div class="cb @if($item->fiksasi_2 == 'Ya') cbx @endif"></div> Ya</td>
						<td colspan="2"><div class="cb @if($item->fiksasi_2 == 'Tidak') cbx @endif"></div> Tidak</td>
					</tr>
					<tr>
						<td>Korban Pasung</td>
						<td>: <div class="cb @if($item->korban_pasung_2 == 'Ya') cbx @endif"></div> Ya</td>
						<td colspan="2"><div class="cb @if($item->korban_pasung_2 == 'Tidak') cbx @endif"></div> Tidak</td>
					</tr>
					<tr>
						<td>Indikasi bunuh diri</td>
						<td>: <div class="cb @if($item->indikasi_bunuh_diri_2 == 'Ya') cbx @endif"></div> Ya</td>
						<td colspan="2"><div class="cb @if($item->indikasi_bunuh_diri_2 == 'Tidak') cbx @endif"></div> Tidak</td>
					</tr>
					<tr>
						<td>Indikasi Jatuh</td>
						<td>: <div class="cb @if($item->indikasi_jatuh_2 == 'Ya') cbx @endif"></div> Ya</td>
						<td colspan="2"><div class="cb @if($item->indikasi_jatuh_2 == 'Tidak') cbx @endif"></div> Tidak</td>
					</tr>
					<tr>
						<td>Tingkat Nyeri</td>
						<td colspan="3">: {{$item->skala_nyeri_2}}</td>
					</tr>
				</table>
				<table class="noBorder mt-10">
					<tr>
						<td class="centered">
							<img src="{{asset('assets/img/nyeri/face(1).png')}}"
							class="@if($item->skala_nyeri_2 == 'Tidak Nyeri') imgx @endif">
							<img src="{{asset('assets/img/nyeri/face(2).png')}}"
							class="@if($item->skala_nyeri_2 == 'Nyeri Ringan') imgx @endif">
							<img src="{{asset('assets/img/nyeri/face(3).png')}}"
							class="@if($item->skala_nyeri_2 == 'Nyeri Mengganggu') imgx @endif">
							<img src="{{asset('assets/img/nyeri/face(4).png')}}"
							class="@if($item->skala_nyeri_2 == 'Nyeri Menyusahkan') imgx @endif">
							<img src="{{asset('assets/img/nyeri/face(5).png')}}"
							class="@if($item->skala_nyeri_2 == 'Nyeri Hebat') imgx @endif">
							<img src="{{asset('assets/img/nyeri/face(6).png')}}"
							class="@if($item->skala_nyeri_2 == 'Nyeri Sangat Hebat') imgx @endif">
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="noBorder" cellpadding="3">
					<tr>
						<td colspan="2">Keterangan Khusus :</td>
					</tr>
					<tr>
						<td width="65%">{!! nl2br($item->keterangan_khusus) !!}</td>
						<td width="35%" align="right">
							<img src="{{asset('assets/img/asesmen/body.png')}}" height="150">
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
						<td>Pemeriksaan Penunjang</td>
					</tr>
					<tr>
						<td>
							<table class="primeBordered">
								<tr class="centered">
									<td rowspan="2">Pemeriksaan</td>
									<td rowspan="2">Ya/Tidak</td>
									<td colspan="2">Hasil</td>
									<td rowspan="2">Keterangan</td>
								</tr>
								<tr class="centered">
									<td>Sudah</td>
									<td>Belum</td>
								</tr>
								<tr>
									<td>Radiologi</td>
									<td class="v-sign">
										@if($item->pemeriksaan_radiologi == '1') 4 @endif
									</td>
									<td class="v-sign">
										@if($item->hasil_pemeriksaan_keluar_radiologi == '1') 4 @endif
									</td>
									<td class="v-sign">
										@if($item->pemeriksaan_radiologi == '1' && $item->hasil_pemeriksaan_keluar_radiologi == '') 4 @endif
									</td>
									<td>{{$item->keterangan_radiologi ?? '-'}}</td>
								</tr>
								<tr>
									<td>Laborat</td>
									<td class="v-sign">
										@if($item->pemeriksaan_laborat == '1') 4 @endif
									</td>
									<td class="v-sign">
										@if($item->hasil_pemeriksaan_keluar_laborat == '1') 4 @endif
									</td>
									<td class="v-sign">
										@if($item->pemeriksaan_laborat == '1' && $item->hasil_pemeriksaan_keluar_laborat == '') 4 @endif
									</td>
									<td>{{$item->keterangan_laborat ?? '-'}}</td>
								</tr>
								<tr>
									<td>EKG</td>
									<td class="v-sign">
										@if($item->pemeriksaan_ekg == '1') 4 @endif
									</td>
									<td class="v-sign">
										@if($item->hasil_pemeriksaan_keluar_ekg == '1') 4 @endif
									</td>
									<td class="v-sign">
										@if($item->pemeriksaan_ekg == '1' && $item->hasil_pemeriksaan_keluar_ekg == '') 4 @endif
									</td>
									<td>{{$item->keterangan_ekg ?? '-'}}</td>
								</tr>
								<tr>
									<td>EEG/BM</td>
									<td class="v-sign">
										@if($item->pemeriksaan_eeg_bm == '1') 4 @endif
									</td>
									<td class="v-sign">
										@if($item->hasil_pemeriksaan_keluar_eeg_bm == '1') 4 @endif
									</td>
									<td class="v-sign">
										@if($item->pemeriksaan_eeg_bm == '1' && $item->hasil_pemeriksaan_keluar_eeg_bm == '') 4 @endif
									</td>
									<td>{{$item->keterangan_eeg ?? '-'}}</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
			<td width="50%">
				<table class=" noBorder" cellpadding="3">
					<tr>
						<td>Obat/alat yang akan dibawakan ke</td>
					</tr>
					<tr>
						<td>
							<table class="primeBordered">
								<tr>
									<td>Obat/ alat rekonsiliasi</td>
								</tr>
								<tr>
									<td>{!! nl2br($item->obat_yang_dibawa) !!}</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table class="bordered">
		<tr>
			<td colspan="2" class="centered"><b>TIMBANG TERIMA</b></td>
		</tr>
		<tr>
			<td width="50%">
				<table class="primeBordered mt-10" cellpadding="5">
					<tr>
						<td width="50%">Tanggal / Jam Transfer</td>
						<td width="50%">{{$item->tanggal_transfer ? indonesian_date(date('d-m-Y', strtotime($item->tanggal_transfer))) : '-'}}, {{$item->jam_berangkat_dari_ruangan}}</td>
					</tr>
					<tr>
						<td>Nama Perawat Pengirim</td>
						<td>{{$item->nama_perawat_pengirim}}</td>
					</tr>
					<tr>
						<td colspan="2" class="centered">
							Tanda Tangan<br><br><br>
						</td>
					</tr>
				</table>
				<br>
			</td>
			<td width="50%">
				<table class="primeBordered mt-10" cellpadding="5">
					<tr>
						<td width="50%">Tanggal / Jam Transfer</td>
						<td width="50%">{{$item->tanggal_transfer ? indonesian_date(date('d-m-Y', strtotime($item->tanggal_transfer))) : '-'}}, {{$item->jam_tiba_di_ruangan}}</td>
					</tr>
					<tr>
						<td>Nama Perawat Penerima</td>
						<td>{{$item->nama_perawat_penerima}}</td>
					</tr>
					<tr>
						<td colspan="2" class="centered">
							Tanda Tangan<br><br><br>
						</td>
					</tr>
				</table>
				<br>
			</td>
		</tr>
	</table>
</body>
</html>