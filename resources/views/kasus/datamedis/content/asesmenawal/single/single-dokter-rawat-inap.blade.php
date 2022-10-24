<div class="row">
	<div class="col-md-6">
		<table width="100%">
			<tr>
				<td width="25%"></td>
				<td width="2%"></td>
				<td width="73%"></td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>ASESMEN MEDIS</b></td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>RIWAYAT PENYAKIT</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Medis keluhan utama</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($item['medis_keluhan_utama'] ?? '-') !!}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Medis riwayat gangguan sekarang</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($item['medis_riwayat_gangguan_sekarang'] ?? '-') !!}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Medis riwayat penyakit sebelumnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($item['medis_riwayat_penyakit_sebelumnya'] ?? '-') !!}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Medis faktor keturunan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['medis_faktor_keturunan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Medis faktor pencetus</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['medis_faktor_pencetus'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Medis faktor organik</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['medis_faktor_organik'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>PEMERIKSAAN FISIK</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Fisik kepala leher</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['fisik_kepala_leher'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Fisik dada</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['fisik_dada'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Fisik jantung</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['fisik_jantung'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Fisik paru</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['fisik_paru'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Fisik perut</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['fisik_perut'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Fisik anggota gerak</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['fisik_anggota_gerak'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Status neurologis</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['status_neurologis'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Status lokalis</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['status_lokalis'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>STATUS PSIKIATRIK</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Psikiatrik kesan umum</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($item['psikiatrik_kesan_umum'] ?? '-') !!}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Psikiatrik mood dan affect</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['psikiatrik_mood_dan_affect'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Psikiatrik kontak</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['psikiatrik_kontak'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Psikiatrik persepsi</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['psikiatrik_persepsi'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Psikiatrik pikiran</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['psikiatrik_pikiran'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Psikiatrik orientasi</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['psikiatrik_orientasi'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Psikiatrik daya ingat</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['psikiatrik_daya_ingat'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Psikiatrik perhatian</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['psikiatrik_perhatian'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Psikiatrik intelegensi</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['psikiatrik_intelegensi'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Psikiatrik pengendalian impuls</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['psikiatrik_pengendalian_impuls'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Psikiatrik tilikan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['psikiatrik_tilikan'] ?? '-'}}</td>
			</tr>
		</table>		
	</div>
	<div class="col-md-6">
		<table width="100%">
			<tr>
				<td width="25%"></td>
				<td width="2%"></td>
				<td width="73%"></td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>PEMERIKSAAN PENUNJANG/TAMBAHAN</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Pemeriksaan penunjang tambahan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($item['pemeriksaan_penunjang_tambahan'] ?? '-') !!}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>DIAGNOSIS</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Aksis 1</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['aksis_1'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">ICD 10</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['icd_10_1'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Aksis 2</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['aksis_2'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">ICD 10</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['icd_10_2'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Aksis 3</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['aksis_3'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">ICD 10</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['icd_10_3'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Aksis 4</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['aksis_4'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Aksis 5</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['aksis_5'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>MASALAH KESEHATAN PASIEN</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Masalah kesehatan pasien</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($item['masalah_kesehatan_pasien'] ?? '-') !!}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>PERENCANAAN (TARGET DAN WAKTU)</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Perencanaan target waktu</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($item['perencanaan_target_waktu'] ?? '-') !!}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>PENATALAKSANAAN</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Penatalaksanaan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($item['penatalaksanaan'] ?? '-') !!}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>PROGNOSIS</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Prognosis</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($item['prognosis'] ?? '-') !!}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>LEMBAR TINDAKAN</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Tindakan jam</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['tindakan_jam'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Tindakan tindakan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['tindakan_tindakan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Icd 9</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['icd_9'] ?? '-'}}</td>
			</tr>
		</table>
	</div>
</div>
