<!DOCTYPE html>
<html>
<head>
	<title>Asesmen Pendidikan Pasien dan Keluarga</title>
	<style type="text/css">
		@page{
		}
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
		.noBorder td{
			border: none;
		}
		.big{
			font-size: 16px;
		}
		.centered td, .centered{
			text-align: center;
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
		.va-mid{
			vertical-align: middle;
		}
		.small{
			font-size: 12px;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				RM 27
			</td>
		</tr>
	</table>
	<table class="bordered" style="margin-top: 5px;">
		<tr>
			<td width="55%" class="va-mid">
				<table class="noBorder" cellpadding="3">
					<tr>
						<td width="20%" style="text-align: center;">
							<img src="{{url('')}}/assets/img/pemprov-jatim.png" height="55">
						</td>
						<td width="60%" style="text-align: center; font-size: 10px;">
							<b>
								PEMERINTAH PROVINSI JAWA TIMUR<br>
								RUMAH SAKIT JIWA MENUR<br>
								Jln Menur No.120, Telp(031)5021635,5021637<br>
								S U R A B A Y A
							</b>
						</td>
						<td width="20%" style="text-align: center;">
							<img src="{{url('')}}/assets/img/menur.png" height="55">
						</td>
					</tr>
				</table>
			</td>
			<td width="45%" style="padding-left: 20px;">
				<table class="noBorder" style="font-size: 11px;" cellpadding="3">
					<tr>
						<td>No Rekam Medis</td>
						<td>: {{$kasus->pasien->no_rm}}</td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>: {{$kasus->pasien->name}}</td>
					</tr>
					<tr>
						<td>Tgl Lahir/Umur</td>
						<td>: {{date('d-m-Y', strtotime($kasus->pasien->date_of_birth))}}/{{$kasus->pasien->age}} Tahun</td>
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
			<td class="centered" colspan="2">
				<b class="big">ASESMEN PENDIDIKAN PASIEN DAN KELUARGA</b>
			</td>
		</tr>
		<tr>
			<td width="50%" class="centered"><b>PASIEN</b></td>
			<td width="50%" class="centered"><b>KELUARGA ({{$item->hubungan_dengan_pasien}})</b></td>
		</tr>
	</table>
	<table class="bordered">
		<tr>
			<td width="50%">
				<table class="noBorder">
					<tr>
						<td colspan="4"><u><b>AGAMA</b></u></td>
					</tr>
					<tr>
						<td><div class="cb @if($item->agama_pasien == 'Islam') cbx @endif"></div>Islam</td>
						<td><div class="cb @if($item->agama_pasien == 'Katolik') cbx @endif"></div>Katolik</td>
						<td><div class="cb @if($item->agama_pasien == 'Protestan') cbx @endif"></div>Protestan</td>
						<td><div class="cb @if($item->agama_pasien == 'Budha') cbx @endif"></div>Budha</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->agama_pasien == 'Hindu') cbx @endif"></div>Hindu</td>
						<td><div class="cb @if($item->agama_pasien == 'Konghuchu') cbx @endif"></div>Konghuchu</td>
						<td colspan="2"><div class="cb @if($item->agama_pasien == 'Lain lain') cbx @endif"></div>Lain lain</td>
					</tr>
				</table>
			</td>
			<td width="50%">
				<table class="noBorder">
					<tr>
						<td colspan="4"><u><b>AGAMA</b></u></td>
					</tr>
					<tr>
						<td><div class="cb @if($item->agama_keluarga_pasien == 'Islam') cbx @endif"></div>Islam</td>
						<td><div class="cb @if($item->agama_keluarga_pasien == 'Katolik') cbx @endif"></div>Katolik</td>
						<td><div class="cb @if($item->agama_keluarga_pasien == 'Protestan') cbx @endif"></div>Protestan</td>
						<td><div class="cb @if($item->agama_keluarga_pasien == 'Budha') cbx @endif"></div>Budha</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->agama_keluarga_pasien == 'Hindu') cbx @endif"></div>Hindu</td>
						<td><div class="cb @if($item->agama_keluarga_pasien == 'Konghuchu') cbx @endif"></div>Konghuchu</td>
						<td colspan="2"><div class="cb @if($item->agama_keluarga_pasien == 'Lain lain') cbx @endif"></div>Lain lain</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder">
					<tr>
						<td><u><b>NILAI DAN KEYAKINAN</b></u></td>
					</tr>
					<tr>
						<td>Pantangan yang ada :</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->keyakinan_pasien_pantangan_pemeriksaan_hari_tertentu == '1') cbx @endif"></div>Pemeriksaan pada hari tertentu</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->keyakinan_pasien_pantangan_masuk_keluar_rs_hari_tertentu == '1') cbx @endif"></div>Masuk/Keluar RS pada hari tertentu</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->keyakinan_pasien_hanya_ingin_dilayani_sesama_jenis == '1') cbx @endif"></div>Hanya ingin dilayani sesama jenis</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->keyakinan_pasien_pantangan_nomor_tertentu_yang_dihindari == '1') cbx @endif"></div>Nomor tertentu yang dihindari</td>
					</tr>
					<tr>
						<td>Keterangan : {{$item->keterangan_untuk_nilai_dan_keyakinan_pasien}}</td>
					</tr>
				</table>
			</td>
			<td>
				<table class="noBorder">
					<tr>
						<td><u><b>NILAI DAN KEYAKINAN</b></u></td>
					</tr>
					<tr>
						<td>Pantangan yang ada :</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->keyakinan_keluarga_pantangan_pemeriksaan_hari_tertentu == '1') cbx @endif"></div>Pemeriksaan pada hari tertentu</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->keyakinan_keluarga_pantangan_masuk_keluar_rs_hari_tertentu == '1') cbx @endif"></div>Masuk/Keluar RS pada hari tertentu</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->keyakinan_keluarga_hanya_ingin_dilayani_sesama_jenis == '1') cbx @endif"></div>Hanya ingin dilayani sesama jenis</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->keyakinan_keluarga_pantangan_nomor_tertentu_yang_dihindari == '1') cbx @endif"></div>Nomor tertentu yang dihindari</td>
					</tr>
					<tr>
						<td>Keterangan : {{$item->keterangan_untuk_nilai_dan_keyakinan_keluarga}}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder">
					<tr>
						<td colspan="3"><u><b>PENDIDIKAN</b></u></td>
					</tr>
					<tr>
						<td width="30%"><div class="cb @if($item->pendidikan_pasien_sd == '1') cbx @endif"></div>SD</td>
						<td width="35%"><div class="cb @if($item->pendidikan_pasien_smp == '1') cbx @endif"></div>SMP</td>
						<td width="35%"><div class="cb @if($item->pendidikan_pasien_sma == '1') cbx @endif"></div>SMA</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->pendidikan_pasien_perguruan_tinggi == '1') cbx @endif"></div>PT</td>
						<td><div class="cb @if($item->pendidikan_pasien_tidak_sekolah == '1') cbx @endif"></div>Tidak Sekolah</td>
						<td><div class="cb @if($item->pendidikan_pasien_lain_lain == '1') cbx @endif"></div>Lain lain</td>
					</tr>
				</table>
			</td>
			<td>
				<table class="noBorder">
					<tr>
						<td colspan="3"><u><b>PENDIDIKAN</b></u></td>
					</tr>
					<tr>
						<td width="30%"><div class="cb @if($item->pendidikan_keluarga_sd == '1') cbx @endif"></div>SD</td>
						<td width="35%"><div class="cb @if($item->pendidikan_keluarga_smp == '1') cbx @endif"></div>SMP</td>
						<td width="35%"><div class="cb @if($item->pendidikan_keluarga_sma == '1') cbx @endif"></div>SMA</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->pendidikan_keluarga_perguruan_tinggi == '1') cbx @endif"></div>PT</td>
						<td><div class="cb @if($item->pendidikan_keluarga_tidak_sekolah == '1') cbx @endif"></div>Tidak Sekolah</td>
						<td><div class="cb @if($item->pendidikan_keluarga_lain_lain == '1') cbx @endif"></div>Lain lain</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder">
					<tr>
						<td colspan="3"><u><b>BAHASA YANG DIGUNAKAN</b></u></td>
					</tr>
					<tr>
						<td><div class="cb @if($item->bahasa_yang_digunakan_pasien_indonesia == '1') cbx @endif"></div>Indonesia</td>
						<td><div class="cb @if($item->bahasa_yang_digunakan_pasien_isyarat == '1') cbx @endif"></div>Isyarat</td>
						<td><div class="cb @if($item->bahasa_yang_digunakan_pasien_lain_lain == '1') cbx @endif"></div>Lain lain</td>
					</tr>
				</table>
			</td>
			<td>
				<table class="noBorder">
					<tr>
						<td colspan="3"><u><b>BAHASA YANG DIGUNAKAN</b></u></td>
					</tr>
					<tr>
						<td><div class="cb @if($item->bahasa_keluarga_indonesia == '1') cbx @endif"></div>Indonesia</td>
						<td><div class="cb @if($item->bahasa_keluarga_isyarat == '1') cbx @endif"></div>Isyarat</td>
						<td><div class="cb @if($item->bahasa_keluarga_lain_lain == '1') cbx @endif"></div>Lain lain</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder small">
					<tr>
						<td colspan="3"><u><b>KETERBATASAN FISIK DAN KOGNITIF</b></u></td>
					</tr>
					<tr>
						<td width="34%"><div class="cb @if($item->keterbatasan_pasien_tuli == '1') cbx @endif"></div>Tuli</td>
						<td width="66%"><div class="cb @if($item->keterbatasan_pasien_hidup_dalam_pikirannya_sendiri == '1') cbx @endif"></div>Hidup dalam pikirannya sendiri</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->keterbatasan_pasien_bisu == '1') cbx @endif"></div>Bisu</td>
						<td><div class="cb @if($item->keterbatasan_pasien_tidak_ada_keterbatasan_fisik == '1') cbx @endif"></div>Tidak ada keterbatasan fisik</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->keterbatasan_pasien_kooperatif == '1') cbx @endif"></div>Kooperatif</td>
						<td><div class="cb @if($item->keterbatasan_pasien_tampak_mutualisme_atau_negativistic == '1') cbx @endif"></div>Tampak Mutisme/Negativistic</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->keterbatasan_pasien_perlu_kursi_roda == '1') cbx @endif"></div>Perlu Kursi Roda</td>
						<td><div class="cb @if($item->keterbatasan_pasien_mampu_berdiskusi == '1') cbx @endif"></div>Mampu berdiskusi</td>
					</tr>
				</table>
			</td>
			<td>
				<table class="noBorder small">
					<tr>
						<td colspan="3"><u><b>KETERBATASAN FISIK DAN KOGNITIF</b></u></td>
					</tr>
					<tr>
						<td width="34%"><div class="cb @if($item->keterbatasan_keluarga_tuli == '1') cbx @endif"></div>Tuli</td>
						<td width="66%"><div class="cb @if($item->keterbatasan_keluarga_tidak_ada_keterbatasan_fisik == '1') cbx @endif"></div>Tidak ada keterbatasan fisik</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->keterbatasan_keluarga_bisu == '1') cbx @endif"></div>Bisu</td>
						<td><div class="cb @if($item->keterbatasan_keluarga_mampu_berdiskusi == '1') cbx @endif"></div>Mampu berdiskusi</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->keterbatasan_keluarga_kooperatif == '1') cbx @endif"></div>Kooperatif</td>
						<td><div class="cb @if($item->keterbatasan_keluarga_lain_lain == '1') cbx @endif"></div>Lainnya</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->keterbatasan_keluarga_perlu_kursi_roda == '1') cbx @endif"></div>Perlu Kursi Roda</td>
						<td></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder small">
					<tr>
						<td colspan="3"><u><b>KONDISI EMOSI DAN MOTIVASI</b></u></td>
					</tr>
					<tr>
						<td><div class="cb @if($item->emosi_motivasi_pasien_tenang == '1') cbx @endif"></div>Tenang</td>
						<td><div class="cb @if($item->emosi_motivasi_pasien_labil == '1') cbx @endif"></div>Labil</td>
						<td><div class="cb @if($item->emosi_motivasi_pasien_tampak_acuh == '1') cbx @endif"></div>Tampak acuh</td>
					</tr>
					<tr>
						<td colspan="3"><div class="cb @if($item->emosi_motivasi_pasien_belum_mampu_diajak_komunikasi == '1') cbx @endif"></div>Belum mapu diajak komunikasi</td>
					</tr>
					<tr>
						<td colspan="3"><div class="cb @if($item->emosi_motivasi_pasien_tampak_agresif == '1') cbx @endif"></div>Tampak Agresif</td>
					</tr>
					<tr>
						<td colspan="3"><div class="cb @if($item->emosi_motivasi_pasien_mampu_komunikasi == '1') cbx @endif"></div>Mampu Komunikasi</td>
					</tr>
				</table>
			</td>
			<td>
				<table class="noBorder small">
					<tr>
						<td colspan="3"><u><b>KONDISI EMOSI DAN MOTIVASI</b></u></td>
					</tr>
					<tr>
						<td><div class="cb @if($item->emosi_motivasi_keluarga_tenang == '1') cbx @endif"></div>Tenang</td>
						<td><div class="cb @if($item->emosi_motivasi_keluarga_labil == '1') cbx @endif"></div>Labil</td>
						<td><div class="cb @if($item->emosi_motivasi_keluarga_tampak_acuh == '1') cbx @endif"></div>Tampak acuh</td>
					</tr>
					<tr>
						<td colspan="3"><div class="cb @if($item->emosi_motivasi_keluarga_belum_mampu_diajak_komunikasi == '1') cbx @endif"></div>Belum mapu diajak komunikasi</td>
					</tr>
					<tr>
						<td colspan="3"><div class="cb @if($item->emosi_motivasi_keluarga_mampu_komunikasi == '1') cbx @endif"></div>Mampu Komunikasi</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table class="noBorder">
					<tr>
						<td><u><b>KESEDIAAN MENERIMA INFORMASI</b></u></td>
					</tr>
					<tr>
						<td><div class="cb @if($item->kesediaan_pasien_bersedia_diberi_informasi == '1') cbx @endif"></div>Bersedia diberi informasi</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->kesediaan_pasien_mampu_menerima_informasi == '1') cbx @endif"></div>Mampu menerima informasi</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->kesediaan_pasien_belum_mampu_menerima_informasi == '1') cbx @endif"></div>Belum mapu menerima Informasi</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->kesediaan_pasien_tidak_bersedia_diberi_informasi == '1') cbx @endif"></div>Tidak bersedia diberi informasi</td>
					</tr>
				</table>
			</td>
			<td>
				<table class="noBorder">
					<tr>
						<td><u><b>KESEDIAAN MENERIMA INFORMASI</b></u></td>
					</tr>
					<tr>
						<td><div class="cb @if($item->kesediaan_keluarga_bersedia_diberi_informasi == '1') cbx @endif"></div>Bersedia diberi informasi</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->kesediaan_keluarga_mampu_menerima_informasi == '1') cbx @endif"></div>Mampu menerima informasi</td>
					</tr>
					<tr>
						<td><div class="cb @if($item->kesediaan_keluarga_tidak_bersedia_diberi_informasi == '1') cbx @endif"></div>Tidak bersedia diberi informasi</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table class="bordered">
		<tr>
			<td><b>Berdasarkan asesmen kebutuhan pendidikan pasien dan keluarga, maka mereka membutuhkan edukasi tentang :</b></td>
		</tr>
	</table>
	<table class="bordered">
		<thead>
			<tr>
				<th width="50%">Kebutuhan Edukasi Pasien</th>
				<th width="50%">Kebutuhan Edukasi Keluarga</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<table class="noBorder">
						<tr>
							<td>Rencana Edukasi : {{$item->rencana_edukasi_pasien_tanggal ? date('j F Y', strtotime($item->rencana_edukasi_pasien_tanggal)) : '-'}}</td>
						</tr>
						<tr>
							<td><div class="cb @if($item->agama_pasien == 'Islam') cbx @endif"></div>Penyakit yang diderita</td>
						</tr>
						<tr>
							<td><div class="cb @if($item->agama_pasien == 'Islam') cbx @endif"></div>Teknik rehabilitasi : terapi kerja, latihan asertif</td>
						</tr>
						<tr>
							<td><div class="cb @if($item->agama_pasien == 'Islam') cbx @endif"></div>Tindakan keperawatan (fiksasi, TAK, dll)</td>
						</tr>
						<tr>
							<td><div class="cb @if($item->agama_pasien == 'Islam') cbx @endif"></div>Tindakan medis (ECT konvensional), injeksi, infus, transfusi, dll)</td>
						</tr>
						<tr>
							<td><div class="cb @if($item->agama_pasien == 'Islam') cbx @endif"></div>Pemeriksaan penunjang (Laboratorium, Rontgen, ECG, EEG, BM, Psikotes, dll)</td>
						</tr>
						<tr>
							<td>Masalah Keperawatan : {{$item->masalah_keperawatan ?? '-'}}</td>
						</tr>
					</table>
				</td>
				<td>
					<table class="noBorder">
						<tr>
							<td>Rencana Edukasi : {{$item->rencana_edukasi_keluarga_tanggal ? date('j F Y', strtotime($item->rencana_edukasi_keluarga_tanggal)) : '-'}}</td>
						</tr>
						<tr>
							<td><div class="cb @if($item->agama_pasien == 'Islam') cbx @endif"></div>Obat yang dikonsumsi</td>
						</tr>
						<tr>
							<td><div class="cb @if($item->agama_pasien == 'Islam') cbx @endif"></div>Managemen nyeri</td>
						</tr>
						<tr>
							<td><div class="cb @if($item->agama_pasien == 'Islam') cbx @endif"></div>Diet dan nutrisi</td>
						</tr>
						<tr>
							<td><div class="cb @if($item->agama_pasien == 'Islam') cbx @endif"></div>Cuci tangan</td>
						</tr>
						<tr>
							<td><div class="cb @if($item->agama_pasien == 'Islam') cbx @endif"></div>Informed Consent</td>
						</tr>
						<tr>
							<td><div class="cb @if($item->agama_pasien == 'Islam') cbx @endif"></div>General Consent</td>
						</tr>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	<table class="bordered">
		<tr>
			<td>
				<table class="noBorder">
					<tr>
						<td width="50%" class="centered"></td>
						<td width="50%" class="centered">Surabaya, {{Carbon\Carbon::now()->format('j F Y')}}</td>
					</tr>
					<tr>
						<td width="50%" class="centered">Keluarga/Pasien</td>
						<td width="50%" class="centered">Perawat</td>
					</tr>
					<tr>
						<td colspan="2"><br><br><br></td>
					</tr>
					<tr>
						<td class="centered">(.........................................)</td>
						<td class="centered">{{$item->creator->name}}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<div style="page-break-after: always;"></div>
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				RM 05
			</td>
		</tr>
	</table>
	<table class="bordered" style="margin-top: 10px;">
		<thead>
			<tr>
				<th colspan="7">LEMBAR KOMUNIKASI - INFORMASI & EDUKASI PASIEN DAN KELUARGA (Diisi oleh PPA)</th>
			</tr>
			<tr>
				<th>No</th>
				<th>Kebutuhan & Materi Edukasi/Informasi</th>
				<th>Tgl/Jam & Durasi Edukasi</th>
				<th>Metode</th>
				<th>Nama Edukator Pemberi Informasi</th>
				<th>Verifikasi</th>
				<th>Nama Penerima Informasi</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1; @endphp
			@forelse($item->lembar as $lembar)
			<tr>
				<td class="centered">{{$i++}}</td>
				<td>{!!nl2br($lembar->kebutuhan_materi_edukasi_informasi)!!}</td>
				<td>{{$lembar->tanggal_edukasi ? date('j/m/Y', strtotime($lembar->tanggal_edukasi)) : '-'}}, {{$lembar->jam_edukasi}} (Durasi : {{$lembar->durasi_edukasi}})</td>
				<td>{{$lembar->metode}}</td>
				<td>{{$lembar->nama_edukator_pemberi_informasi}}</td>
				<td>{{$lembar->verifikasi_verfikasi}} </td>
				<td>{{$lembar->nama_penerima_informasi}} ({{$lembar->hubungan_terhadap_pasien}})</td>
			</tr>
			@empty
			<tr>
				<td colspan="7" class="centered"><b><br><br>BELUM ADA MATERI PEMBELAJARAN YANG DILAKUKAN<br><br><br></b></td>
			</tr>
			@endforelse
		</tbody>
	</table>
</body>
</html>