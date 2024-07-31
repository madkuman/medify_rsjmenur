<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Formulir Pasien Pemantauan Terapi Obat</title>

   <style>
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
		.va-mid{
			vertical-align: middle;
		}
   </style>
</head>
<body>

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
			<td class="centered"><b>LEMBAR PEMANTAUAN OBAT</b></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td><b>I. PASIEN MASUK RUMAH SAKIT</b></td>
		</tr>
	</table>
	<table>
		<tr>
			<td width="60%">
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
					<tr>
						<td>Alamat</td>
						<td>: {{$kasus->pasien->address ?? '-'}}</td>
					</tr>
					<tr>
						<td>No Telp</td>
						<td>: {{$kasus->pasien->phone ?? '-'}}</td>
					</tr>
				</table>
			</td>
			<td width="40%">
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
					<tr>
						<td>Tinggi Badan</td>
						<td>: {{$kasus->identitas->tinggi_badan ?? '-'}}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

   <br>
	@php
		$res = json_decode($formulir_pasien->val);
	@endphp
   <table>
      <tr>
         <td><b>Keluhan Utama :</b></td>
      </tr>
      <tr>
         <td>{{ $res->medis_keluhan_utama ?? '-' }}</td>
      </tr>
      <tr><td>&nbsp;</td></tr>
      <tr>
         <td><b>Riwayat Penyakit Sekarang :</b></td>
      </tr>
      <tr>
         <td>{{ $res->medis_riwayat_gangguan_sekarang ?? '-' }}</td>
      </tr>
      <tr><td>&nbsp;</td></tr>
      <tr>
         <td><b>Riwayat Penyakit Terdahulu :</b></td>
      </tr>
      <tr>
         <td>{{ $res->medis_riwayat_penyakit_sebelumnya ?? '-' }}</td>
      </tr>
      <tr><td>&nbsp;</td></tr>
      <tr>
         <td><b>Riwayat Keluarga :</b></td>
      </tr>
      <tr>
         <td>{{ $res->medis_faktor_keturunan ?? '-' }}</td>
      </tr>
      <tr><td>&nbsp;</td></tr>
      <tr>
         <td><b>Diagnosa :</b></td>
      </tr>
      <tr>
         <td>{{ $res->diagnosa ?? '' }}</td>
      </tr>
   </table>


	<br>
	<table>
		<tr>
         <td><b>Riwayat Alergi Obat :</b></td>
      </tr>
	</table>
	<table style="text-align: center; vertical-align: middle">
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">No</td>
			<td style="border: 1px solid black; border-collapse: collapse">Obat Yang Menyebabkan Alergi</td>
			<td style="border: 1px solid black; border-collapse: collapse">Ringan</td>
			<td style="border: 1px solid black; border-collapse: collapse">Sedang</td>
			<td style="border: 1px solid black; border-collapse: collapse">Berat</td>
			<td style="border: 1px solid black; border-collapse: collapse">Reaksi Alergi</td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">1</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->alergi_terhadap_obat }}</td>
			<td style="border: 1px solid black; border-collapse: collapse;">@if(!empty($res->alergi_obat_ringan)) ya @else tidak @endif</td>
			<td style="border: 1px solid black; border-collapse: collapse;">@if(!empty($res->alergi_obat_sedang)) ya @else tidak @endif</td>
			<td style="border: 1px solid black; border-collapse: collapse;">@if(!empty($res->alergi_obat_berat)) ya @else tidak @endif</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->reaksi_alergi_obat }}</td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse">&nbsp;</td>
		</tr>
	</table>
	

	<br>
	<table>
		<tr>
         <td><b>Riwayat Penggunaan Obat Sebelum Admisi :</b></td>
      </tr>
	</table>
	<table style="text-align: center; vertical-align: middle">
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">No</td>
			<td style="border: 1px solid black; border-collapse: collapse">Tgl Terakhir Digunakan</td>
			<td style="border: 1px solid black; border-collapse: collapse">Nama Obat</td>
			<td style="border: 1px solid black; border-collapse: collapse">Dosis</td>
			<td style="border: 1px solid black; border-collapse: collapse">Frekuensi</td>
			<td style="border: 1px solid black; border-collapse: collapse">Cara Pemberian</td>
			<td style="border: 1px solid black; border-collapse: collapse">Obat Dilanjutkan Saat Ranap (Ya)</td>
			<td style="border: 1px solid black; border-collapse: collapse">Obat Dilanjutkan Saat Ranap (Tidak)</td>
			<td style="border: 1px solid black; border-collapse: collapse">Perubahan Aturan Pakai</td>
		</tr>
		<tr>
			<td colspan="9" style="text-align: left; border: 1px solid black; border-collapse: collapse">B. DAFTAR OBAT YANG DIGUNAKAN SEBELUM MASUK RUMAH SAKIT</td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">1.</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">{{ $res->tgl_terakhir_sebelum_masuk_rs_1 ?? '' }}</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">{{ $res->nama_obat_sebelum_masuk_rs_1 ?? '' }}</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">{{ $res->dosis_sebelum_masuk_rs_1 ?? '' }}</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">{{ $res->frekuensi_sebelum_masuk_rs_1 ?? '' }}</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">{{ $res->cara_pemberian_sebelum_masuk_rs_1 ?? '' }}</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">@if(!empty($res->obat_dilanjutkan_saat_rawat_inap_ya_sebelum_masuk_rs_1)) ya @else tidak @endif</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">@if(!empty($res->obat_dilanjutkan_saat_rawat_inap_tidak_sebelum_masuk_rs_1)) ya @else tidak @endif</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">{{ $res->aturan_pakai_sebelum_masuk_rs_1 ?? '' }}</td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">2.</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">{{ $res->tgl_terakhir_sebelum_masuk_rs_2 ?? '' }}</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">{{ $res->nama_obat_sebelum_masuk_rs_2 ?? '' }}</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">{{ $res->dosis_sebelum_masuk_rs_2 ?? '' }}</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">{{ $res->frekuensi_sebelum_masuk_rs_2 ?? '' }}</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">{{ $res->cara_pemberian_sebelum_masuk_rs_2 ?? '' }}</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">@if(!empty($res->obat_dilanjutkan_saat_rawat_inap_ya_sebelum_masuk_rs_2)) ya @else tidak @endif</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">@if(!empty($res->obat_dilanjutkan_saat_rawat_inap_tidak_sebelum_masuk_rs_2)) ya @else tidak @endif</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">{{ $res->aturan_pakai_sebelum_masuk_rs_2 ?? '' }}</td>
		</tr>
		<tr>
			<td colspan="9" style="text-align: left; border: 1px solid black; border-collapse: collapse">C. DAFTAR OBAT RUTIN YANG DIGUNAKAN</td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="9" style="text-align: left; border: 1px solid black; border-collapse: collapse">D. DAFTAR OBAT YANG DIRESEPKAN DPJP SAAT RAWAT INAP</td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
			<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle">&nbsp;</td>
		</tr>
	</table>

	<!-- hasil pemeriksaan fisik -->
	<br>
	<table>
		<tr>
         <td><b>Hasil Pemeriksaan Fisik :</b></td>
      </tr>
	</table>
	<table style="text-align: center">
		<thead>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;" width="10%">Nilai Normal</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;" width="20%">Nilai Normal</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;" width="10%">Tgl Jam</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;" width="10%">Tgl Jam</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;" width="10%">Tgl Jam</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;" width="10%">Tgl Jam</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;" width="10%">Tgl Jam</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;" width="10%">Tgl Jam</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">TD</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">120/80</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_td_1 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_td_2 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_td_3 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_td_4 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_td_5 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_td_6 }}</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">Nadi</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">70/80</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_nadi_1 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_nadi_2 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_nadi_3 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_nadi_4 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_nadi_5 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_nadi_6 }}</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">RR</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">16-20</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_rr_1 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_rr_2 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_rr_3 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_rr_4 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_rr_5 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_rr_6 }}</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">T (suhu)</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">36,6-37.2</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_suhu_1 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_suhu_2 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_suhu_3 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_suhu_4 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_suhu_5 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_suhu_6 }}</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">GCS</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">
					&nbsp;
				</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_gcs_1 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_gcs_2 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_gcs_3 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_gcs_4 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_gcs_5 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_gcs_6 }}</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">BB</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">
					&nbsp;
				</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_bb_1 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_bb_2 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_bb_3 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_bb_4 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_bb_5 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_bb_6 }}</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">MAP</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">
					&nbsp;
				</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_map_1 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_map_2 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_map_3 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_map_4 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_map_5 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_map_6 }}</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">Sp02</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">
					&nbsp;
				</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_spo2_1 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_spo2_2 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_spo2_3 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_spo2_4 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_spo2_5 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_spo2_6 }}</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">O2</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">
					&nbsp;
				</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_o2_1 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_o2_2 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_o2_3 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_o2_4 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_o2_5 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_o2_6 }}</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">Skala Nyeri</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">
					&nbsp;
				</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_nyeri_1 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_nyeri_2 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_nyeri_3 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_nyeri_4 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_nyeri_5 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_nyeri_6 }}</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">Cairan Masuk Infus</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">
					&nbsp;
				</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_infus_1 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_infus_2 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_infus_3 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_infus_4 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_infus_5 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_infus_6 }}</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">Cairan Masuk Per OS</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">
					&nbsp;
				</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_per_cairan_1 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_per_cairan_2 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_per_cairan_3 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_per_cairan_4 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_per_cairan_5 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_per_cairan_6 }}</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">Cairan Urine</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">
					&nbsp;
				</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_urine_1 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_urine_2 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_urine_3 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_urine_4 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_urine_5 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_urine_6 }}</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">Cairan Keluar Lain2</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">
					&nbsp;
				</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_lain_1 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_lain_2 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_lain_3 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_lain_4 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_lain_5 }}</td>
				<td style="border: 1px solid black; border-collapse: collapse; vertical-align: middle;">{{ $res->tgl_jam_lain_6 }}</td>
			</tr>
		</tbody>
	</table>
	<!-- end hasil pemeriksaan fisik -->


	<!-- hasil pemeriksaan diagnostik -->
	<br>
	<table>
		<tr>
         <td><b>Hasil Pemeriksaan Diagnostik :</b></td>
      </tr>
	</table>
	<table style="text-align: center">
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">No</td>
			<td style="border: 1px solid black; border-collapse: collapse">Tgl</td>
			<td style="border: 1px solid black; border-collapse: collapse">Pemeriksaan</td>
			<td style="border: 1px solid black; border-collapse: collapse">Hasil</td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">1.</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->tgl_pemeriksaan_diagnostik_1 }}</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->pemeriksaan_diagnostik_1 }}</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->hasil_pemeriksaan_diagnostik_1 }}</td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">2.</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->tgl_pemeriksaan_diagnostik_2 }}</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->pemeriksaan_diagnostik_2 }}</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->hasil_pemeriksaan_diagnostik_2 }}</td>
		</tr>
	</table>

	<!-- hasil pemeriksaan mikrobiologi -->
	<br>
	<table>
		<tr>
         <td><b>Hasil Pemeriksaan Mikrobiologi :</b></td>
      </tr>
	</table>
	<table style="text-align: center">
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">No</td>
			<td style="border: 1px solid black; border-collapse: collapse">Tgl</td>
			<td style="border: 1px solid black; border-collapse: collapse">Pemeriksaan</td>
			<td style="border: 1px solid black; border-collapse: collapse">Hasil</td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">1.</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->tgl_pemeriksaan_mikrobiologi_1 }}</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->pemeriksaan_mikrobiologi_1 }}</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->hasil_pemeriksaan_mikrobiologi_1 }}</td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">2.</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->tgl_pemeriksaan_mikrobiologi_2 }}</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->pemeriksaan_mikrobiologi_2 }}</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->hasil_pemeriksaan_mikrobiologi_2 }}</td>
		</tr>
	</table>

	<!-- hasil pemeriksaan covid -->
	<br>
	<table>
		<tr>
         <td><b>Hasil Pemeriksaan Covid :</b></td>
      </tr>
	</table>
	<table style="text-align: center">
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">No</td>
			<td style="border: 1px solid black; border-collapse: collapse">Tgl</td>
			<td style="border: 1px solid black; border-collapse: collapse">Pemeriksaan</td>
			<td style="border: 1px solid black; border-collapse: collapse">Hasil</td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">1.</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->tgl_pemeriksaan_covid_1 }}</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->pemeriksaan_covid_1 }}</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->hasil_pemeriksaan_covid_1 }}</td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">2.</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->tgl_pemeriksaan_covid_2 }}</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->pemeriksaan_covid_2 }}</td>
			<td style="border: 1px solid black; border-collapse: collapse">{{ $res->hasil_pemeriksaan_covid_2 }}</td>
		</tr>
	</table>


	<!-- hasil pemeriksaan laboratorium -->
	<br>
	<table>
		<tr>
         <td><b>Hasil Pemeriksaan Laboratorium :</b></td>
      </tr>
	</table>
	<table width="100%">
		<thead>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Item</td>
				<td style="border: 1px solid black; border-collapse: collapse">Satuan</td>
				<td style="border: 1px solid black; border-collapse: collapse">Nilai Rujukan</td>
				<td style="border: 1px solid black; border-collapse: collapse">Tgl</td>
				<td style="border: 1px solid black; border-collapse: collapse">Tgl</td>
				<td style="border: 1px solid black; border-collapse: collapse">Tgl</td>
				<td style="border: 1px solid black; border-collapse: collapse">Tgl</td>
				<td style="border: 1px solid black; border-collapse: collapse">Tgl</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="8" style="background-color: silver; border: 1px solid black; border-collapse: collapse">Darah Lengkap</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">WBC (Leukosit)</td>
				<td style="border: 1px solid black; border-collapse: collapse">10^3/uL</td>
				<td style="border: 1px solid black; border-collapse: collapse">3.8-10.8</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->wbc_tgl_1)) {{ date('d-m-Y', strtotime($res->wbc_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->wbc_tgl_2)) {{ date('d-m-Y', strtotime($res->wbc_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->wbc_tgl_3)) {{ date('d-m-Y', strtotime($res->wbc_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->wbc_tgl_4)) {{ date('d-m-Y', strtotime($res->wbc_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->wbc_tgl_5)) {{ date('d-m-Y', strtotime($res->wbc_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">WBC (Leukosit)</td>
				<td style="border: 1px solid black; border-collapse: collapse">10^6/uL</td>
				<td style="border: 1px solid black; border-collapse: collapse">4.4-5.90</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->wbc_l_tgl_1)) {{ date('d-m-Y', strtotime($res->wbc_l_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->wbc_l_tgl_2)) {{ date('d-m-Y', strtotime($res->wbc_l_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->wbc_l_tgl_3)) {{ date('d-m-Y', strtotime($res->wbc_l_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->wbc_l_tgl_4)) {{ date('d-m-Y', strtotime($res->wbc_l_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->wbc_l_tgl_5)) {{ date('d-m-Y', strtotime($res->wbc_l_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">HGB (Hemogoblin)</td>
				<td style="border: 1px solid black; border-collapse: collapse">g/dl</td>
				<td style="border: 1px solid black; border-collapse: collapse">13.2-17.3</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hgb_tgl_1)) {{ date('d-m-Y', strtotime($res->hgb_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hgb_tgl_2)) {{ date('d-m-Y', strtotime($res->hgb_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hgb_tgl_3)) {{ date('d-m-Y', strtotime($res->hgb_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hgb_tgl_4)) {{ date('d-m-Y', strtotime($res->hgb_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hgb_tgl_5)) {{ date('d-m-Y', strtotime($res->hgb_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">HCT (Hematokrit)</td>
				<td style="border: 1px solid black; border-collapse: collapse">%</td>
				<td style="border: 1px solid black; border-collapse: collapse">40-52</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hct_tgl_1)) {{ date('d-m-Y', strtotime($res->hct_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hct_tgl_2)) {{ date('d-m-Y', strtotime($res->hct_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hct_tgl_3)) {{ date('d-m-Y', strtotime($res->hct_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hct_tgl_4)) {{ date('d-m-Y', strtotime($res->hct_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hct_tgl_5)) {{ date('d-m-Y', strtotime($res->hct_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">MCV</td>
				<td style="border: 1px solid black; border-collapse: collapse">fl</td>
				<td style="border: 1px solid black; border-collapse: collapse">80-100</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mcv_tgl_1)) {{ date('d-m-Y', strtotime($res->mcv_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mcv_tgl_2)) {{ date('d-m-Y', strtotime($res->mcv_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mcv_tgl_3)) {{ date('d-m-Y', strtotime($res->mcv_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mcv_tgl_4)) {{ date('d-m-Y', strtotime($res->mcv_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mcv_tgl_5)) {{ date('d-m-Y', strtotime($res->mcv_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">MCH</td>
				<td style="border: 1px solid black; border-collapse: collapse">pg</td>
				<td style="border: 1px solid black; border-collapse: collapse">26-34</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mch_tgl_1)) {{ date('d-m-Y', strtotime($res->mch_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mch_tgl_2)) {{ date('d-m-Y', strtotime($res->mch_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mch_tgl_3)) {{ date('d-m-Y', strtotime($res->mch_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mch_tgl_4)) {{ date('d-m-Y', strtotime($res->mch_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mch_tgl_5)) {{ date('d-m-Y', strtotime($res->mch_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">MCHC</td>
				<td style="border: 1px solid black; border-collapse: collapse">g/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">32-36</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mchc_tgl_1)) {{ date('d-m-Y', strtotime($res->mchc_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mchc_tgl_2)) {{ date('d-m-Y', strtotime($res->mchc_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mchc_tgl_3)) {{ date('d-m-Y', strtotime($res->mchc_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mchc_tgl_4)) {{ date('d-m-Y', strtotime($res->mchc_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mchc_tgl_5)) {{ date('d-m-Y', strtotime($res->mchc_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">PLT (Trombosit)</td>
				<td style="border: 1px solid black; border-collapse: collapse">10^3/uL</td>
				<td style="border: 1px solid black; border-collapse: collapse">150-440</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->plt_tgl_1)) {{ date('d-m-Y', strtotime($res->plt_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->plt_tgl_2)) {{ date('d-m-Y', strtotime($res->plt_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->plt_tgl_3)) {{ date('d-m-Y', strtotime($res->plt_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->plt_tgl_4)) {{ date('d-m-Y', strtotime($res->plt_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->plt_tgl_5)) {{ date('d-m-Y', strtotime($res->plt_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">RDW-SD</td>
				<td style="border: 1px solid black; border-collapse: collapse">%</td>
				<td style="border: 1px solid black; border-collapse: collapse">37-54</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->rdw_tgl_1)) {{ date('d-m-Y', strtotime($res->rdw_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->rdw_tgl_2)) {{ date('d-m-Y', strtotime($res->rdw_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->rdw_tgl_3)) {{ date('d-m-Y', strtotime($res->rdw_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->rdw_tgl_4)) {{ date('d-m-Y', strtotime($res->rdw_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->rdw_tgl_5)) {{ date('d-m-Y', strtotime($res->rdw_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">RDW-CV</td>
				<td style="border: 1px solid black; border-collapse: collapse">%</td>
				<td style="border: 1px solid black; border-collapse: collapse">11.5-14.5</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->rdw_cv_tgl_1)) {{ date('d-m-Y', strtotime($res->rdw_cv_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->rdw_cv_tgl_2)) {{ date('d-m-Y', strtotime($res->rdw_cv_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->rdw_cv_tgl_3)) {{ date('d-m-Y', strtotime($res->rdw_cv_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->rdw_cv_tgl_4)) {{ date('d-m-Y', strtotime($res->rdw_cv_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->rdw_cv_tgl_5)) {{ date('d-m-Y', strtotime($res->rdw_cv_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">PDW</td>
				<td style="border: 1px solid black; border-collapse: collapse">fl</td>
				<td style="border: 1px solid black; border-collapse: collapse">9-17</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->pdw_tgl_1)) {{ date('d-m-Y', strtotime($res->pdw_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->pdw_tgl_2)) {{ date('d-m-Y', strtotime($res->pdw_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->pdw_tgl_3)) {{ date('d-m-Y', strtotime($res->pdw_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->pdw_tgl_4)) {{ date('d-m-Y', strtotime($res->pdw_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->pdw_tgl_5)) {{ date('d-m-Y', strtotime($res->pdw_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">MPV</td>
				<td style="border: 1px solid black; border-collapse: collapse">fl</td>
				<td style="border: 1px solid black; border-collapse: collapse">9-13</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mpv_tgl_1)) {{ date('d-m-Y', strtotime($res->mpv_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mpv_tgl_2)) {{ date('d-m-Y', strtotime($res->mpv_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mpv_tgl_3)) {{ date('d-m-Y', strtotime($res->mpv_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mpv_tgl_4)) {{ date('d-m-Y', strtotime($res->mpv_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mpv_tgl_5)) {{ date('d-m-Y', strtotime($res->mpv_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">P-LCR</td>
				<td style="border: 1px solid black; border-collapse: collapse">%</td>
				<td style="border: 1px solid black; border-collapse: collapse">13-43</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->p_lcr_tgl_1)) {{ date('d-m-Y', strtotime($res->p_lcr_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->p_lcr_tgl_2)) {{ date('d-m-Y', strtotime($res->p_lcr_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->p_lcr_tgl_3)) {{ date('d-m-Y', strtotime($res->p_lcr_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->p_lcr_tgl_4)) {{ date('d-m-Y', strtotime($res->p_lcr_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->p_lcr_tgl_5)) {{ date('d-m-Y', strtotime($res->p_lcr_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">PCR</td>
				<td style="border: 1px solid black; border-collapse: collapse">%</td>
				<td style="border: 1px solid black; border-collapse: collapse">0.17-0.35</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->pcr_tgl_1)) {{ date('d-m-Y', strtotime($res->pcr_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->pcr_tgl_2)) {{ date('d-m-Y', strtotime($res->pcr_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->pcr_tgl_3)) {{ date('d-m-Y', strtotime($res->pcr_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->pcr_tgl_4)) {{ date('d-m-Y', strtotime($res->pcr_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->pcr_tgl_5)) {{ date('d-m-Y', strtotime($res->pcr_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">LED</td>
				<td style="border: 1px solid black; border-collapse: collapse"></td>
				<td style="border: 1px solid black; border-collapse: collapse"></td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->led_tgl_1)) {{ date('d-m-Y', strtotime($res->led_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->led_tgl_2)) {{ date('d-m-Y', strtotime($res->led_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->led_tgl_3)) {{ date('d-m-Y', strtotime($res->led_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->led_tgl_4)) {{ date('d-m-Y', strtotime($res->led_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->led_tgl_5)) {{ date('d-m-Y', strtotime($res->led_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">NEUT#</td>
				<td style="border: 1px solid black; border-collapse: collapse">10^3/uL</td>
				<td style="border: 1px solid black; border-collapse: collapse">2.0-7.7</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->neut_tgl_1)) {{ date('d-m-Y', strtotime($res->neut_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->neut_tgl_2)) {{ date('d-m-Y', strtotime($res->neut_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->neut_tgl_3)) {{ date('d-m-Y', strtotime($res->neut_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->neut_tgl_4)) {{ date('d-m-Y', strtotime($res->neut_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->neut_tgl_5)) {{ date('d-m-Y', strtotime($res->neut_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">LYMPH#</td>
				<td style="border: 1px solid black; border-collapse: collapse">10^3/uL</td>
				<td style="border: 1px solid black; border-collapse: collapse">0.8-4.0</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->lymph_tgl_1)) {{ date('d-m-Y', strtotime($res->lymph_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->lymph_tgl_2)) {{ date('d-m-Y', strtotime($res->lymph_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->lymph_tgl_3)) {{ date('d-m-Y', strtotime($res->lymph_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->lymph_tgl_4)) {{ date('d-m-Y', strtotime($res->lymph_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->lymph_tgl_5)) {{ date('d-m-Y', strtotime($res->lymph_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">MONO#</td>
				<td style="border: 1px solid black; border-collapse: collapse">10^3/uL</td>
				<td style="border: 1px solid black; border-collapse: collapse">0.1-0.80</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mono_tgl_1)) {{ date('d-m-Y', strtotime($res->mono_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mono_tgl_2)) {{ date('d-m-Y', strtotime($res->mono_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mono_tgl_3)) {{ date('d-m-Y', strtotime($res->mono_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mono_tgl_4)) {{ date('d-m-Y', strtotime($res->mono_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->mono_tgl_5)) {{ date('d-m-Y', strtotime($res->mono_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">EO#</td>
				<td style="border: 1px solid black; border-collapse: collapse">10^3/uL</td>
				<td style="border: 1px solid black; border-collapse: collapse">0.0-0.50</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->eo_tgl_1)) {{ date('d-m-Y', strtotime($res->eo_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->eo_tgl_2)) {{ date('d-m-Y', strtotime($res->eo_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->eo_tgl_3)) {{ date('d-m-Y', strtotime($res->eo_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->eo_tgl_4)) {{ date('d-m-Y', strtotime($res->eo_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->eo_tgl_5)) {{ date('d-m-Y', strtotime($res->eo_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">BASO#</td>
				<td style="border: 1px solid black; border-collapse: collapse">10^3/uL</td>
				<td style="border: 1px solid black; border-collapse: collapse">0.0-0.15</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->baso_tgl_1)) {{ date('d-m-Y', strtotime($res->baso_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->baso_tgl_2)) {{ date('d-m-Y', strtotime($res->baso_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->baso_tgl_3)) {{ date('d-m-Y', strtotime($res->baso_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->baso_tgl_4)) {{ date('d-m-Y', strtotime($res->baso_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->baso_tgl_5)) {{ date('d-m-Y', strtotime($res->baso_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">IG#</td>
				<td style="border: 1px solid black; border-collapse: collapse">10^3/uL</td>
				<td style="border: 1px solid black; border-collapse: collapse">0.0-0.02</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->ig_tgl_1)) {{ date('d-m-Y', strtotime($res->ig_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->ig_tgl_2)) {{ date('d-m-Y', strtotime($res->ig_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->ig_tgl_3)) {{ date('d-m-Y', strtotime($res->ig_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->ig_tgl_4)) {{ date('d-m-Y', strtotime($res->ig_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->ig_tgl_5)) {{ date('d-m-Y', strtotime($res->ig_tgl_5)) }} @endif</td>
			</tr>
			<!-- elektrolit -->
			<tr>
				<td colspan="8" style="background-color: silver; border: 1px solid black; border-collapse: collapse">Elektrolit</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Natrium</td>
				<td style="border: 1px solid black; border-collapse: collapse">mmol/L</td>
				<td style="border: 1px solid black; border-collapse: collapse">135-148</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->natrium_tgl_1)) {{ date('d-m-Y', strtotime($res->natrium_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->natrium_tgl_2)) {{ date('d-m-Y', strtotime($res->natrium_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->natrium_tgl_3)) {{ date('d-m-Y', strtotime($res->natrium_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->natrium_tgl_4)) {{ date('d-m-Y', strtotime($res->natrium_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->natrium_tgl_5)) {{ date('d-m-Y', strtotime($res->natrium_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Kalium</td>
				<td style="border: 1px solid black; border-collapse: collapse">mmol/L</td>
				<td style="border: 1px solid black; border-collapse: collapse">3.5-5.1</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->kalium_tgl_1)) {{ date('d-m-Y', strtotime($res->kalium_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->kalium_tgl_2)) {{ date('d-m-Y', strtotime($res->kalium_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->kalium_tgl_3)) {{ date('d-m-Y', strtotime($res->kalium_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->kalium_tgl_4)) {{ date('d-m-Y', strtotime($res->kalium_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->kalium_tgl_5)) {{ date('d-m-Y', strtotime($res->kalium_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Cholrida</td>
				<td style="border: 1px solid black; border-collapse: collapse">mmol/L</td>
				<td style="border: 1px solid black; border-collapse: collapse">98-107</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->chlorida_tgl_1)) {{ date('d-m-Y', strtotime($res->chlorida_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->chlorida_tgl_2)) {{ date('d-m-Y', strtotime($res->chlorida_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->chlorida_tgl_3)) {{ date('d-m-Y', strtotime($res->chlorida_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->chlorida_tgl_4)) {{ date('d-m-Y', strtotime($res->chlorida_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->chlorida_tgl_5)) {{ date('d-m-Y', strtotime($res->chlorida_tgl_5)) }} @endif</td>
			</tr>
			
			<!-- kimia klinik -->
			<tr>
				<td colspan="8" style="background-color: silver; border: 1px solid black; border-collapse: collapse">Kimia Klinik</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Glukosa Puasa</td>
				<td style="border: 1px solid black; border-collapse: collapse">mg/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">70-105</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->glukosa_tgl_1)) {{ date('d-m-Y', strtotime($res->glukosa_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->glukosa_tgl_2)) {{ date('d-m-Y', strtotime($res->glukosa_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->glukosa_tgl_3)) {{ date('d-m-Y', strtotime($res->glukosa_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->glukosa_tgl_4)) {{ date('d-m-Y', strtotime($res->glukosa_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->glukosa_tgl_5)) {{ date('d-m-Y', strtotime($res->glukosa_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Gula sewaktu</td>
				<td style="border: 1px solid black; border-collapse: collapse">mg/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">115</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->gula_tgl_1)) {{ date('d-m-Y', strtotime($res->gula_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->gula_tgl_2)) {{ date('d-m-Y', strtotime($res->gula_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->gula_tgl_3)) {{ date('d-m-Y', strtotime($res->gula_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->gula_tgl_4)) {{ date('d-m-Y', strtotime($res->gula_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->gula_tgl_5)) {{ date('d-m-Y', strtotime($res->gula_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Gula Darah 2JPP</td>
				<td style="border: 1px solid black; border-collapse: collapse">mg/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">70-140</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->gula_darah_tgl_1)) {{ date('d-m-Y', strtotime($res->gula_darah_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->gula_darah_tgl_2)) {{ date('d-m-Y', strtotime($res->gula_darah_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->gula_darah_tgl_3)) {{ date('d-m-Y', strtotime($res->gula_darah_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->gula_darah_tgl_4)) {{ date('d-m-Y', strtotime($res->gula_darah_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->gula_darah_tgl_5)) {{ date('d-m-Y', strtotime($res->gula_darah_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">HbA1C</td>
				<td style="border: 1px solid black; border-collapse: collapse">%</td>
				<td style="border: 1px solid black; border-collapse: collapse">03-jun</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hba1c_tgl_1)) {{ date('d-m-Y', strtotime($res->hba1c_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hba1c_tgl_2)) {{ date('d-m-Y', strtotime($res->hba1c_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hba1c_tgl_3)) {{ date('d-m-Y', strtotime($res->hba1c_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hba1c_tgl_4)) {{ date('d-m-Y', strtotime($res->hba1c_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hba1c_tgl_5)) {{ date('d-m-Y', strtotime($res->hba1c_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Asam Urat</td>
				<td style="border: 1px solid black; border-collapse: collapse">%</td>
				<td style="border: 1px solid black; border-collapse: collapse">L3.4-7</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->asam_urat_l_tgl_1)) {{ date('d-m-Y', strtotime($res->asam_urat_l_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->asam_urat_l_tgl_2)) {{ date('d-m-Y', strtotime($res->asam_urat_l_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->asam_urat_l_tgl_3)) {{ date('d-m-Y', strtotime($res->asam_urat_l_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->asam_urat_l_tgl_4)) {{ date('d-m-Y', strtotime($res->asam_urat_l_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->asam_urat_l_tgl_5)) {{ date('d-m-Y', strtotime($res->asam_urat_l_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Asam Urat</td>
				<td style="border: 1px solid black; border-collapse: collapse">mg/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">P2.4-5.7</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->asam_urat_p_tgl_1)) {{ date('d-m-Y', strtotime($res->asam_urat_p_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->asam_urat_p_tgl_2)) {{ date('d-m-Y', strtotime($res->asam_urat_p_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->asam_urat_p_tgl_3)) {{ date('d-m-Y', strtotime($res->asam_urat_p_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->asam_urat_p_tgl_4)) {{ date('d-m-Y', strtotime($res->asam_urat_p_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->asam_urat_p_tgl_5)) {{ date('d-m-Y', strtotime($res->asam_urat_p_tgl_5)) }} @endif</td>
			</tr>
			<!-- Fugnsi Hati (LFT) -->
			<tr>
				<td colspan="8" style="background-color: silver; border: 1px solid black; border-collapse: collapse">Fungsi Hati (LFT)</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Bilirubin Direk</td>
				<td style="border: 1px solid black; border-collapse: collapse">mg/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">0-0.6</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bilirubin_direk_tgl_1)) {{ date('d-m-Y', strtotime($res->bilirubin_direk_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bilirubin_direk_tgl_2)) {{ date('d-m-Y', strtotime($res->bilirubin_direk_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bilirubin_direk_tgl_3)) {{ date('d-m-Y', strtotime($res->bilirubin_direk_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bilirubin_direk_tgl_4)) {{ date('d-m-Y', strtotime($res->bilirubin_direk_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bilirubin_direk_tgl_5)) {{ date('d-m-Y', strtotime($res->bilirubin_direk_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Bilirubin Indirek</td>
				<td style="border: 1px solid black; border-collapse: collapse">mg/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">0-0.6</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bilirubin_indirek_tgl_1)) {{ date('d-m-Y', strtotime($res->bilirubin_indirek_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bilirubin_indirek_tgl_2)) {{ date('d-m-Y', strtotime($res->bilirubin_indirek_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bilirubin_indirek_tgl_3)) {{ date('d-m-Y', strtotime($res->bilirubin_indirek_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bilirubin_indirek_tgl_4)) {{ date('d-m-Y', strtotime($res->bilirubin_indirek_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bilirubin_indirek_tgl_5)) {{ date('d-m-Y', strtotime($res->bilirubin_indirek_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Bilirubin Total</td>
				<td style="border: 1px solid black; border-collapse: collapse">mg/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">0.3-1</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bilirubin_total_tgl_1)) {{ date('d-m-Y', strtotime($res->bilirubin_total_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bilirubin_total_tgl_2)) {{ date('d-m-Y', strtotime($res->bilirubin_total_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bilirubin_total_tgl_3)) {{ date('d-m-Y', strtotime($res->bilirubin_total_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bilirubin_total_tgl_4)) {{ date('d-m-Y', strtotime($res->bilirubin_total_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bilirubin_total_tgl_5)) {{ date('d-m-Y', strtotime($res->bilirubin_total_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">SGOT</td>
				<td style="border: 1px solid black; border-collapse: collapse">U/L</td>
				<td style="border: 1px solid black; border-collapse: collapse">8-33</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->sgot_tgl_1)) {{ date('d-m-Y', strtotime($res->sgot_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->sgot_tgl_2)) {{ date('d-m-Y', strtotime($res->sgot_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->sgot_tgl_3)) {{ date('d-m-Y', strtotime($res->sgot_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->sgot_tgl_4)) {{ date('d-m-Y', strtotime($res->sgot_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->sgot_tgl_5)) {{ date('d-m-Y', strtotime($res->sgot_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">SGPT</td>
				<td style="border: 1px solid black; border-collapse: collapse">U/L</td>
				<td style="border: 1px solid black; border-collapse: collapse">3-35</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->sgpt_tgl_1)) {{ date('d-m-Y', strtotime($res->sgpt_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->sgpt_tgl_2)) {{ date('d-m-Y', strtotime($res->sgpt_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->sgpt_tgl_3)) {{ date('d-m-Y', strtotime($res->sgpt_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->sgpt_tgl_4)) {{ date('d-m-Y', strtotime($res->sgpt_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->sgpt_tgl_5)) {{ date('d-m-Y', strtotime($res->sgpt_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">BUN</td>
				<td style="border: 1px solid black; border-collapse: collapse">mg/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">17-48</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bun_tgl_1)) {{ date('d-m-Y', strtotime($res->bun_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bun_tgl_2)) {{ date('d-m-Y', strtotime($res->bun_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bun_tgl_3)) {{ date('d-m-Y', strtotime($res->bun_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bun_tgl_4)) {{ date('d-m-Y', strtotime($res->bun_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->bun_tgl_5)) {{ date('d-m-Y', strtotime($res->bun_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Protein Total</td>
				<td style="border: 1px solid black; border-collapse: collapse">g/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">6-8</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->protein_total_tgl_1)) {{ date('d-m-Y', strtotime($res->protein_total_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->protein_total_tgl_2)) {{ date('d-m-Y', strtotime($res->protein_total_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->protein_total_tgl_3)) {{ date('d-m-Y', strtotime($res->protein_total_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->protein_total_tgl_4)) {{ date('d-m-Y', strtotime($res->protein_total_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->protein_total_tgl_5)) {{ date('d-m-Y', strtotime($res->protein_total_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Albumin</td>
				<td style="border: 1px solid black; border-collapse: collapse">g/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">3.8-5.1</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->albumin_tgl_1)) {{ date('d-m-Y', strtotime($res->albumin_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->albumin_tgl_2)) {{ date('d-m-Y', strtotime($res->albumin_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->albumin_tgl_3)) {{ date('d-m-Y', strtotime($res->albumin_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->albumin_tgl_4)) {{ date('d-m-Y', strtotime($res->albumin_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->albumin_tgl_5)) {{ date('d-m-Y', strtotime($res->albumin_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Alkaline Fosfate</td>
				<td style="border: 1px solid black; border-collapse: collapse">U/L</td>
				<td style="border: 1px solid black; border-collapse: collapse">15-69</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->alkaline_tgl_1)) {{ date('d-m-Y', strtotime($res->alkaline_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->alkaline_tgl_2)) {{ date('d-m-Y', strtotime($res->alkaline_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->alkaline_tgl_3)) {{ date('d-m-Y', strtotime($res->alkaline_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->alkaline_tgl_4)) {{ date('d-m-Y', strtotime($res->alkaline_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->alkaline_tgl_5)) {{ date('d-m-Y', strtotime($res->alkaline_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">GGT (Gamma GT)</td>
				<td style="border: 1px solid black; border-collapse: collapse">U/L</td>
				<td style="border: 1px solid black; border-collapse: collapse">5-38</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->gamma_tgl_1)) {{ date('d-m-Y', strtotime($res->gamma_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->gamma_tgl_2)) {{ date('d-m-Y', strtotime($res->gamma_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->gamma_tgl_3)) {{ date('d-m-Y', strtotime($res->gamma_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->gamma_tgl_4)) {{ date('d-m-Y', strtotime($res->gamma_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->gamma_tgl_5)) {{ date('d-m-Y', strtotime($res->gamma_tgl_5)) }} @endif</td>
			</tr>
			<!-- Fugnsi Ginjal -->
			<tr>
				<td colspan="8" style="background-color: silver; border: 1px solid black; border-collapse: collapse">Fungsi Ginjal</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Urea</td>
				<td style="border: 1px solid black; border-collapse: collapse">mg/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">15-45</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->urea_tgl_1)) {{ date('d-m-Y', strtotime($res->urea_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->urea_tgl_2)) {{ date('d-m-Y', strtotime($res->urea_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->urea_tgl_3)) {{ date('d-m-Y', strtotime($res->urea_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->urea_tgl_4)) {{ date('d-m-Y', strtotime($res->urea_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->urea_tgl_5)) {{ date('d-m-Y', strtotime($res->urea_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Creatinin</td>
				<td style="border: 1px solid black; border-collapse: collapse">mg/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">L0.9-5.1</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->creatinin_l_tgl_1)) {{ date('d-m-Y', strtotime($res->creatinin_l_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->creatinin_l_tgl_2)) {{ date('d-m-Y', strtotime($res->creatinin_l_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->creatinin_l_tgl_3)) {{ date('d-m-Y', strtotime($res->creatinin_l_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->creatinin_l_tgl_4)) {{ date('d-m-Y', strtotime($res->creatinin_l_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->creatinin_l_tgl_5)) {{ date('d-m-Y', strtotime($res->creatinin_l_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Creatinin</td>
				<td style="border: 1px solid black; border-collapse: collapse">mg/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">P0.7-1.4</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->creatinin_p_tgl_1)) {{ date('d-m-Y', strtotime($res->creatinin_p_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->creatinin_p_tgl_2)) {{ date('d-m-Y', strtotime($res->creatinin_p_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->creatinin_p_tgl_3)) {{ date('d-m-Y', strtotime($res->creatinin_p_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->creatinin_p_tgl_4)) {{ date('d-m-Y', strtotime($res->creatinin_p_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->creatinin_p_tgl_5)) {{ date('d-m-Y', strtotime($res->creatinin_p_tgl_5)) }} @endif</td>
			</tr>
			<!-- Fugnsi Lipid -->
			<tr>
				<td colspan="8" style="background-color: silver; border: 1px solid black; border-collapse: collapse">Fungsi Lipid</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Kolesterol Total</td>
				<td style="border: 1px solid black; border-collapse: collapse">mg/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">140-200</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->kolesterol_total_tgl_1)) {{ date('d-m-Y', strtotime($res->kolesterol_total_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->kolesterol_total_tgl_2)) {{ date('d-m-Y', strtotime($res->kolesterol_total_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->kolesterol_total_tgl_3)) {{ date('d-m-Y', strtotime($res->kolesterol_total_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->kolesterol_total_tgl_4)) {{ date('d-m-Y', strtotime($res->kolesterol_total_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->kolesterol_total_tgl_5)) {{ date('d-m-Y', strtotime($res->kolesterol_total_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">HDL</td>
				<td style="border: 1px solid black; border-collapse: collapse">mg/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">L => 35</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hdl_l_tgl_1)) {{ date('d-m-Y', strtotime($res->hdl_l_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hdl_l_tgl_2)) {{ date('d-m-Y', strtotime($res->hdl_l_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hdl_l_tgl_3)) {{ date('d-m-Y', strtotime($res->hdl_l_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hdl_l_tgl_4)) {{ date('d-m-Y', strtotime($res->hdl_l_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hdl_l_tgl_5)) {{ date('d-m-Y', strtotime($res->hdl_l_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">HDL</td>
				<td style="border: 1px solid black; border-collapse: collapse">mg/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">P => 45</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hdl_p_tgl_1)) {{ date('d-m-Y', strtotime($res->hdl_p_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hdl_p_tgl_2)) {{ date('d-m-Y', strtotime($res->hdl_p_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hdl_p_tgl_3)) {{ date('d-m-Y', strtotime($res->hdl_p_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hdl_p_tgl_4)) {{ date('d-m-Y', strtotime($res->hdl_p_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->hdl_p_tgl_5)) {{ date('d-m-Y', strtotime($res->hdl_p_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">LDL</td>
				<td style="border: 1px solid black; border-collapse: collapse">mg/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">&lt;190</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->ldl_tgl_1)) {{ date('d-m-Y', strtotime($res->ldl_tgl_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->ldl_tgl_2)) {{ date('d-m-Y', strtotime($res->ldl_tgl_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->ldl_tgl_3)) {{ date('d-m-Y', strtotime($res->ldl_tgl_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->ldl_tgl_4)) {{ date('d-m-Y', strtotime($res->ldl_tgl_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->ldl_tgl_5)) {{ date('d-m-Y', strtotime($res->ldl_tgl_5)) }} @endif</td>
			</tr>
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse">Trigliserida</td>
				<td style="border: 1px solid black; border-collapse: collapse">mg/dL</td>
				<td style="border: 1px solid black; border-collapse: collapse">30-150</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->trigliserida_1)) {{ date('d-m-Y', strtotime($res->trigliserida_1)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->trigliserida_2)) {{ date('d-m-Y', strtotime($res->trigliserida_2)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->trigliserida_3)) {{ date('d-m-Y', strtotime($res->trigliserida_3)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->trigliserida_4)) {{ date('d-m-Y', strtotime($res->trigliserida_4)) }} @endif</td>
				<td style="border: 1px solid black; border-collapse: collapse">@if(!empty($res->trigliserida_5)) {{ date('d-m-Y', strtotime($res->trigliserida_5)) }} @endif</td>
			</tr>
		</tbody>
	</table>
	<!-- end hasil pemeriksaan laboratorium -->

	<!-- hasil pemantauan terapi -->
	<br>
	<table>
		<tr>
         <td><b>Hasil Pemantauan Terapi :</b></td>
      </tr>
	</table>
	<table style="text-align: center">
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse" width="5%">S</td>
			<td style="border: 1px solid black; border-collapse: collapse" width="70%">
				{{ $res->s_1 }}
			</td>
			<td style="border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black; border-collapse: collapse;"></td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">O</td>
			<td style="border: 1px solid black; border-collapse: collapse">
				{{ $res->o_1 }}
			</td>
			<td style="border-left: 1px solid black; border-right: 1px solid black; border-collapse: collapse;"></td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">A</td>
			<td style="border: 1px solid black; border-collapse: collapse">
				{{ $res->a_1 }}
			</td>
			<td style="border-left: 1px solid black; border-right: 1px solid black; border-collapse: collapse;"></td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">P</td>
			<td style="border: 1px solid black; border-collapse: collapse">
				{{ $res->p_1 }}
			</td>
			<td style="border: 1px solid black; border-collapse: collapse">paraf</td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">Tanggal</td>
			<td style="border: 1px solid black; border-collapse: collapse">
				@if(!empty($res->tgl_cppt_1)) {{ date('d-m-Y', strtotime($res->tgl_cppt_1)) }} @endif
			</td>
			<td style="border: 1px solid black; border-collapse: collapse">Nama</td>
		</tr>
		<!-- 2 -->
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse" width="5%">S</td>
			<td style="border: 1px solid black; border-collapse: collapse" width="70%">
				{{ $res->s_2 }}
			</td>
			<td style="border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black; border-collapse: collapse;"></td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">O</td>
			<td style="border: 1px solid black; border-collapse: collapse">
				{{ $res->o_2 }}
			</td>
			<td style="border-left: 1px solid black; border-right: 1px solid black; border-collapse: collapse;"></td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">A</td>
			<td style="border: 1px solid black; border-collapse: collapse">
				{{ $res->a_2 }}
			</td>
			<td style="border-left: 1px solid black; border-right: 1px solid black; border-collapse: collapse;"></td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">P</td>
			<td style="border: 1px solid black; border-collapse: collapse">
				{{ $res->p_2 }}
			</td>
			<td style="border: 1px solid black; border-collapse: collapse">paraf</td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">Tanggal</td>
			<td style="border: 1px solid black; border-collapse: collapse">
				@if(!empty($res->tgl_cppt_2)) {{ date('d-m-Y', strtotime($res->tgl_cppt_2)) }} @endif
			</td>
			<td style="border: 1px solid black; border-collapse: collapse">Nama</td>
		</tr>
		<!-- 3 -->
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse" width="5%">S</td>
			<td style="border: 1px solid black; border-collapse: collapse" width="70%">
				{{ $res->s_3 }}
			</td>
			<td style="border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black; border-collapse: collapse;"></td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">O</td>
			<td style="border: 1px solid black; border-collapse: collapse">
				{{ $res->o_3 }}
			</td>
			<td style="border-left: 1px solid black; border-right: 1px solid black; border-collapse: collapse;"></td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">A</td>
			<td style="border: 1px solid black; border-collapse: collapse">
				{{ $res->a_3 }}
			</td>
			<td style="border-left: 1px solid black; border-right: 1px solid black; border-collapse: collapse;"></td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">P</td>
			<td style="border: 1px solid black; border-collapse: collapse">
				{{ $res->p_3 }}
			</td>
			<td style="border: 1px solid black; border-collapse: collapse">paraf</td>
		</tr>
		<tr>
			<td style="border: 1px solid black; border-collapse: collapse">Tanggal</td>
			<td style="border: 1px solid black; border-collapse: collapse">
				@if(!empty($res->tgl_cppt_3)) {{ date('d-m-Y', strtotime($res->tgl_cppt_3)) }} @endif
			</td>
			<td style="border: 1px solid black; border-collapse: collapse">Nama</td>
		</tr>
	</table>
	<!-- end hasil pemantauan terapi -->



</body>
</html>