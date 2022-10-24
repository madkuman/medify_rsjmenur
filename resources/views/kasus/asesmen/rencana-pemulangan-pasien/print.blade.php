<!DOCTYPE html>
<html>
<head>
	<title>RENCANA PEMULANGAN PASIEN (DISCHARGE PLANNING)</title>
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
		.outborder{
			border: 1px solid black;
			margin-top: -1px;
		}
		.outborder td{
			padding-left: 5px;
			padding-right: 5px;
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
				<b style="font-size: 16px;">RENCANA PEMULANGAN PASIEN (DISCHARGE PLANNING)</b>
			</td>
		</tr>
	</table>
	<table class="bordered">
		<tr>
			<td width="50%"><b>MRS Tgl/Jam : </b></td>
			<td width="50%" class="centered"><b>Terapi / obat selama di rumah sakit</b></td>
		</tr>
		<tr>
			<td>
				<table class="noBorder">
					<tr>
						<td width="35%">Ruang</td>
						<td width="65%">: {{$kasus->lokasi->lokasi->nama}}</td>
					</tr>
					<tr>
						<td>Alasan Masuk</td>
						<td>: {{$item->alasan_masuk}}</td>
					</tr>
					<tr>
						<td>Diagnosa Masuk</td>
						<td>: {{$item->diagnosa_masuk}}</td>
					</tr>
					<tr>
						<td colspan="2">Diagnosa Keperawatan : {{$item->diagnosa_keperawatan_saat_mrs}}</td>
					</tr>
					<tr>
						<td colspan="2">Estimasi Perawatan Pasien : {{$item->estimasi_lamanya_perawatan_pasien}} </td>
					</tr>
				</table>
				<table class="noBorder">
					<tr>
						<td width="50%"></td>
						<td width="50%" class="centered">Perawat</td>
					</tr>
					<tr>
						<td colspan="2"><br><br></td>
					</tr>
					<tr>
						<td></td>
						<td class="centered">{{$item->creator->name}}</td>
					</tr>
				</table>
			</td>
			<td style="padding: 0px;">
				<table>
					<thead>
						<tr>
							<th width="10%">No</th>
							<th width="50%">Nama Obat</th>
							<th width="25%">Dosis</th>
							<th width="15%">Sisa</th>
						</tr>
					</thead>
					<tbody>
						@php $i=1; @endphp
						@if(count($kasus->resep) > 0)
						@foreach($kasus->resep as $resep)
						@if($resep->jenis_resep != 'pulang')
						@foreach($resep->resepDetail as $detail)
						<tr>
							<td class="centered">{{$i++}}</td>
							<td>{{($detail->kategori == 'racikan') ? $detail->racikan : $detail->obat_name}}</td>
							<td></td>
							<td></td>
						</tr>
						@endforeach
						@endif
						@endforeach
						@endif
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td width="50%"><b>KRS Tgl/Jam : </b></td>
			<td width="50%" class="centered"><b>Terapi / obat saat keluar rumah sakit</b></td>
		</tr>
		<tr>
			<td>
				<table class="noBorder">
					<tr>
						<td width="35%">Ruang</td>
						<td width="65%">: {{$kasus->lokasi->lokasi->nama}}</td>
					</tr>
					<tr>
						<td>Keadaan KRS</td>
						<td>: {{$item->keadaan_krs}}</td>
					</tr>
					<tr>
						<td>Diagnosa Keluar</td>
						<td>: {{$item->diagnosa_keluar}}</td>
					</tr>
					<tr>
						<td colspan="2">Diagnosa Keperawatan : {{$item->diagnosa_keperawatan_saat_krs}}</td>
					</tr>
					<tr>
						<td>Lama dirawat</td>
						<td>: {{$item->lama_dirawat}}</td>
					</tr>
				</table>
			</td>
			<td style="padding: 0px;">
				<table>
					<thead>
						<tr>
							<th width="10%">No</th>
							<th width="50%">Nama Obat</th>
							<th width="25%">Dosis</th>
							<th width="15%">Sisa</th>
						</tr>
					</thead>
					<tbody>
						@php $i=1; @endphp
						@if(count($kasus->resep) > 0)
						@foreach($kasus->resep as $resep)
						@if($resep->jenis_resep == 'pulang')
						@foreach($resep->resepDetail as $detail)
						<tr>
							<td class="centered">{{$i++}}</td>
							<td>{{($detail->kategori == 'racikan') ? $detail->racikan : $detail->obat_name}}</td>
							<td></td>
							<td></td>
						</tr>
						@endforeach
						@endif
						@endforeach
						@endif
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="noBorder">
					<tr>
						<td colspan="6">Pemeriksaan penunjang yang pernah dilakukan</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->pemeriksaan_penunjang_laboratorium == '1') cbx @endif"></div>Laboratorium</td>
						<td><div class="cb @if($item->pemeriksaan_penunjang_eeg == '1') cbx @endif"></div>EEG</td>
						<td><div class="cb @if($item->pemeriksaan_penunjang_bm == '1') cbx @endif"></div>BM</td>
						<td><div class="cb @if($item->pemeriksaan_penunjang_ekg == '1') cbx @endif"></div>EKG</td>
						<td><div class="cb @if($item->pemeriksaan_penunjang_foto_rontgen == '1') cbx @endif"></div>Foto Rontgen</td>
						<td><div class="cb @if($item->pemeriksaan_penunjang_lainnya == '1') cbx @endif"></div>Lainnya, {{$item->pemeriksaan_penunjang_lain_lain}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="centered"><b>EDUKASI PERAWATAN</b></td>
		</tr>
	</table>
	<table class="outborder margin-minus">
		<tr>
			<td width="2%">1</td>
			<td width="45%">Setelah keluar dari rumah sakit pasien tinggal dengan</td>
			<td width="43%">
				<table class="noBorder">
					<tr>
						<td width="50%"><div class="cb @if($item->pasien_tinggal_dengan_suami_istri == '1') cbx @endif"></div>Suami/Istri</td>
						<td width="50%"><div class="cb @if($item->pasien_tinggal_dengan_sendiri == '1') cbx @endif"></div>Sendiri</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->pasien_tinggal_dengan_orang_tua == '1') cbx @endif"></div>Orangtua</td>
						<td><div class="cb @if($item->pasien_tinggal_dengan_keluarga_lain == '1') cbx @endif"></div>Keluarga Lain, {{$item->pasien_tinggal_dengan_lain_lain}}</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->pasien_tinggal_dengan_anak == '1') cbx @endif"></div>Anak</td>
						<td><div class="cb @if($item->pasien_tinggal_dengan_lainnya == '1') cbx @endif"></div>Lainnya, {{$item->keterangan_lain_lain}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Rencana kegiatan pasien saat pulang</td>
			<td>
				<table class="noBorder">
					<tr>
						<td><div class="cb @if($item->rencana_kegiatan_pasien_saat_pulang_bekerja == '1') cbx @endif"></div>Bekerja, {{$item->keterangan_pekerjaan}}</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->rencana_kegiatan_pasien_saat_pulang_sekolah == '1') cbx @endif"></div>Sekolah, {{$item->keterangan_jenjang_pendidikan}}</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->rencana_kegiatan_pasien_saat_pulang_lainnya == '1') cbx @endif"></div>Lainnya, {{$item->keterangan_kegiatan_lain}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>3</td>
			<td colspan="2">Rencana Kegiatan harian, perlu bantuan dalam hal:</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">
				<table class="noBorder">
					<tr>
						<td><div class="cb @if($item->perlu_bantuan_dalam_hal_minum_obat == '1') cbx @endif"></div>Minum Obat</td>
						<td><div class="cb @if($item->perlu_bantuan_dalam_hal_mandi == '1') cbx @endif"></div>Mandi</td>
						<td><div class="cb @if($item->perlu_bantuan_dalam_hal_makan == '1') cbx @endif"></div>Makan</td>
						<td><div class="cb @if($item->perlu_bantuan_dalam_hal_berhias == '1') cbx @endif"></div>Berhias</td>
						<td><div class="cb @if($item->perlu_bantuan_dalam_hal_toiletting == '1') cbx @endif"></div>Toileting</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>4</td>
			<td colspan="2">Alat Medis yang digunakan saat keluar rumah sakit</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">
				<table class="noBorder">
					<tr>
						<td><div class="cb @if($item->alat_medis_yang_digunakan_saat_keluar_rs == 'Tidak Ada') cbx @endif"></div>Tidak</td>
						<td><div class="cb @if($item->alat_medis_yang_digunakan_saat_keluar_rs == 'Ada') cbx @endif"></div>Ya, {{$item->keterangan_alat_medis_yang_digunakan}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>5</td>
			<td colspan="2">Alat Bantu yang digunakan saat keluar rumah sakit</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">
				<table class="noBorder">
					<tr>
						<td><div class="cb @if($item->alat_bantu_yang_digunakan_saat_keluar_rs == 'Tidak Ada') cbx @endif"></div>Tidak</td>
						<td><div class="cb @if($item->alat_bantu_yang_digunakan_saat_keluar_rs == 'Ada') cbx @endif"></div>Ya, {{$item->keterangan_alat_bantu_yang_digunakan}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>6</td>
			<td>Score risiko jatuh saat KRS : {{$item->skor_resiko_jatuh__saat_krs}}</td>
			<td>Score nyeri saat KRS : {{$item->skor_resiko_nyeri_saat_krs}}</td>
		</tr>
		<tr>
			<td></td>
			<td><i>(Bila Score >= 90, beri liflet)</i></td>
			<td><i>(Bila Score >= 4, beri liflet)</i></td>
		</tr>
		<tr>
			<td>7</td>
			<td colspan="2">Diet Khusus</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">
				<table class="noBorder">
					<tr>
						<td><div class="cb @if($item->diet_khusus == 'Tidak Ada') cbx @endif"></div>Tidak</td>
						<td><div class="cb @if($item->diet_khusus == 'Ada') cbx @endif"></div>Ya, {{$item->keterangan_diet_khusus}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>8</td>
			<td colspan="2">Nasehat lain</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">1. Minum obat teratur sesuai dosis terapi</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">2. Kontrol ke tempat pelayanan kesehatan sebelum obat habis</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">3. Kontrol di Poliklinik Rawat Jalan Rumah Sakit Jiwa Menur pada hari dan jam kerja</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">4. Bila terjadi reaksi / efek samping obat, silakan bawa pasien ke IGD RS Jiwa Menur 24 Jam</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">5. Bila terjadi kekambuhan, silahkan bawa pasien ke IGD RS Jiwa Menur 24 jam (diluar jam kerja)</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">6. Lainnya : {{$item->nasehat}}</td>
		</tr>
	</table>
	<table class="bordered">
		<tr>
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
		</tr>
	</table>
</body>
</html>