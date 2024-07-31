@php $sub_item = json_decode($item->val); @endphp
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
				<td class="align-top border-bottom">{!! nl2br($sub_item->medis_keluhan_utama ?? '-') !!}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Medis riwayat gangguan sekarang</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($sub_item->medis_riwayat_gangguan_sekarang ?? '-') !!}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Medis riwayat penyakit sebelumnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($sub_item->medis_riwayat_penyakit_sebelumnya ?? '-') !!}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Medis faktor keturunan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->medis_faktor_keturunan ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Medis faktor pencetus</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->medis_faktor_pencetus ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Medis faktor organik</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->medis_faktor_organik ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>PEMERIKSAAN FISIK</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Fisik kepala leher</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->fisik_kepala_leher ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Fisik dada</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->fisik_dada ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Fisik jantung</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->fisik_jantung ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Fisik paru</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->fisik_paru ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Fisik perut</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->fisik_perut ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Fisik anggota gerak</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->fisik_anggota_gerak ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Status neurologis</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->status_neurologis ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Status lokalis</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->status_lokalis ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>VITAL SIGN</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Tekanan Darah / TD</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->vital_td_sistol ?? '-'}} / {{$sub_item->vital_td_diastol ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Nadi / N</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->vital_nadi ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Suhu / T</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->vital_suhu ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Frekuensi Nafas / RR</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->vital_frekuensi_nafas ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">O2 (lpm)</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->vital_o2 ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">SpO2</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->vital_spo2 ?? '-'}}</td>
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
				<td class="align-top border-bottom">{!! nl2br($sub_item->pemeriksaan_penunjang_tambahan ?? '-') !!}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>DIAGNOSIS</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Aksis 1</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->aksis_1 ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">ICD 10</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->icd_10_1[0] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Aksis 2</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->aksis_2 ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">ICD 10</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->icd_10_2[0] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Aksis 3</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->aksis_3 ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">ICD 10</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->icd_10_3[0] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Aksis 4</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->aksis_4 ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Aksis 5</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->aksis_5 ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>MASALAH KESEHATAN PASIEN</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Masalah kesehatan pasien</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($sub_item->masalah_kesehatan_pasien ?? '-') !!}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>PERENCANAAN (TARGET DAN WAKTU)</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Perencanaan target waktu</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($sub_item->perencanaan_target_waktu ?? '-') !!}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>PENATALAKSANAAN</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Penatalaksanaan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($sub_item->penatalaksanaan ?? '-') !!}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>PROGNOSIS</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Prognosis</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($sub_item->prognosis ?? '-') !!}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>LEMBAR TINDAKAN</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Tindakan jam</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->tindakan_jam ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Tindakan tindakan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->tindakan_tindakan ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Icd 9</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$sub_item->icd_9 ?? '-'}}</td>
			</tr>
		</table>
	</div>
</div>