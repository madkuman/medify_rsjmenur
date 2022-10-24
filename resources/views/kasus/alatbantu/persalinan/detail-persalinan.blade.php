
<div class="row">
	<div class="col-md-6">
		<table class="table table-sm table-striped table-vcenter" style="width: 100%">
			<thead>
				<tr>
					<th style="width:70%">Parameter</th>
					<th class="" style="width: 30%;">Kondisi</th>
				</tr>
			</thead>
			<tbody>
				<tr class="table-warning">
					<th colspan="2">Data Umum</th>
				</tr>
				<tr>
					<td>Nama Suami</td>
					<td class="">{{$res->nama_suami or '-'}}</td>
				</tr>
				<tr>
					<td>Maternal</td>
					<td class="">{{$res->maternal or '-'}}</td>
				</tr>
				@php $maternal = $res->maternal ?? '-' @endphp
				@if($maternal == 'Mati')
				<tr>
					<td>Masa Kematian</td>
					<td class="">{{$res->masa_kematian or '-'}}</td>
				</tr>
				@php $masa_kematian = $res->masa_kematian ?? '-' @endphp
				@if($masa_kematian == 'Nifas')
				<tr>
					<td>Nifas</td>
					<td class="">{{$res->kematian_nifas or '-'}}</td>
				</tr>
				@endif
				<tr>
					<td>Usia Kehamilan</td>
					<td class="">{{$res->usia_kehamilan or '-'}}</td>
				</tr>
				<tr>
					<td>Sebab Kematian</td>
					<td class="">{{$res->sebab_kematian or '-'}}</td>
				</tr>
				<tr>
					<td>Keterangan Sebab Kematian</td>
					<td class="">{{$res->keterangan_sebab_kematian or '-'}}</td>
				</tr>
				<tr>
					<td>Waktu Kematian</td>
					<td class="">{{$res->kematian_tanggal or '-'}} {{$res->kematian_jam or '-'}}</td>
				</tr>
				@endif
				<tr>
					<td>GPA</td>
					<td class="">G{{$res->gpa_gravida or '-'}}P{{$res->gpa_para or '-'}}A{{$res->gpa_abortus or '-'}}</td>
				</tr>
				<tr class="table-warning">
					<th colspan="2">Keadaan Ibu Pasca Melahirkan</th>
				</tr>
				<tr>
					<td>Keadaan Umum</td>
					<td class="">{{$res->keadaan_umum or '-'}}</td>
				</tr>
				<tr>
					<td>Nadi</td>
					<td class="">{{$res->umum_nadi or '-'}}</td>
				</tr>
				<tr>
					<td>Tekanan Darah</td>
					<td class="">{{$res->tekanan_darah or '-'}}</td>
				</tr>
				<tr>
					<td>Suhu Badan</td>
					<td class="">{{$res->suhu_badan or '-'}}</td>
				</tr>
				<tr>
					<td>Hb (gr%)</td>
					<td class="">{{$res->hb or '-'}} gr%</td>
				</tr>
				<tr>
					<td>Uterus</td>
					<td class="">{{$res->uterus or '-'}}</td>
				</tr>
				<tr>
					<td>Pendarahan: Kala III (cc)</td>
					<td class="">{{$res->kala_iii or '-'}}</td>
				</tr>
				<tr>
					<td>Pendarahan: Kala IV (cc)</td>
					<td class="">{{$res->kala_iv or '-'}}</td>
				</tr>
				<tr>
					<td>Pendarahan Kala III + IV (cc)</td>
					<td class="">{{$res->kala_iii_iv or '-'}}</td>
				</tr>
				<tr>
					<td>Keadaan Ibu</td>
					<td class="">{{$res->keadaan_ibu or '-'}}</td>
				</tr>
				<tr>
					<td>Anamnesa</td>
					<td class="">{{$res->anamnesa or '-'}}</td>
				</tr>
				<tr>
					<td>Tensi</td>
					<td class="">{{$res->tensi or '-'}}</td>
				</tr>
				<tr>
					<td>Nadi</td>
					<td class="">{{$res->nadi or '-'}}</td>
				</tr>
				<tr>
					<td>Tinggi Fundus Uteri</td>
					<td class="">{{$res->tinggi_fundus_uteri or '-'}}</td>
				</tr>
				<tr>
					<td>Kontradiksi</td>
					<td class="">{{$res->kontradiksi or '-'}}</td>
				</tr>
				<tr>
					<td>Inisiasi Menyusui Dini</td>
					<td>{{$res->inisiasi_menyusui_dini or '-'}}</td>
				</tr>
				@isset($res->inisiasi_menyusui_dini)
				@if($res->inisiasi_menyusui_dini == "Tidak")
				<tr>
					<td>Alasan</td>
					<td>{{$res->alasan_tidak_imd or '-'}}</td>
				</tr>
				@endif
				@endisset

				
			</tbody>
		</table>
	</div>
	<div class="col-md-6">
		<table class="table table-sm table-striped table-vcenter" style="width: 100%">
			<thead>
				<tr>
					<th style="width:70%">Parameter</th>
					<th class="" style="width: 30%;">Kondisi</th>
				</tr>
			</thead>
			<tbody>
				<tr class="table-warning">
					<th colspan="2">Placenta</th>
				</tr>
				<tr>
					<td>Bentuk/Ukuran</td>
					<td class="">{{$res->placenta_bentuk_ukuran or '-'}}</td>
				</tr>
				<tr>
					<td>Perlukaan Jalan Lahir</td>
					<td class="">{{$res->perkiraan_jalan_lahir or '-'}}</td>
				</tr>
				<tr>
					<td>Tali Pusat</td>
					<td class="">{{$res->tali_pusat or '-'}}</td>
				</tr>
				<tr>
					<td>Luka</td>
					<td class="">{{$res->luka_perinium or '-'}}</td>
				</tr>
				<tr>
					<td>Kulit Ketuban</td>
					<td class="">{{$res->kulit_ketuban or '-'}}</td>
				</tr>
				<tr>
					<td>Epitomi</td>
					<td class="">{{$res->epitomi or '-'}}</td>
				</tr>
				<tr>
					<td>Ruptunal Perinei</td>
					<td class="">{{$res->ruptunal_perinei or '-'}}</td>
				</tr>
				<tr class="table-warning">
					<th colspan="2">Ikhtiyar Persalinan</th>
				</tr>
				<tr>
					<td>K.K Pecah</td>
					<td class="">{{$res->tgl_kk_pecah or '-'}}</td>
				</tr>
				<tr>
					<td>Jam K.K Pecah</td>
					<td class="">{{$res->jam_kk_pecah or '-'}}</td>
				</tr>
				<tr>
					<td>Tanggal Lahir</td>
					<td class="">{{$res->lahir_kk_pecah or '-'}}</td>
				</tr>
				<tr>
					<td>Jam Lahir</td>
					<td class="">{{$res->jam_lahir_kk_pecah or '-'}}</td>
				</tr>
				<tr>
					<td>Macam Persalinan</td>
					<td class="">{{$res->macam_persalinan or '-'}}</td>
				</tr>
				@if($res->macam_persalinan == "SC")
				<tr>
					<td>Macam SC</td>
					<td>{{$res->macam_sc or '-'}}</td>
				</tr>
				@if(($res->macam_sc ?? '-') == "Cito")
				<tr>
					<td>Jam Diputuskan SC</td>
					<td>{{$res->jam_diputuskanSC or '-'}}</td>
				</tr>
				<tr>
					<td>Jam Dilaksanakan SC</td>
					<td>{{$res->jam_dilaksanakanSC or '-'}}</td>
				</tr>
				@endif
				@endif				
				<tr>
					<td>Jenis Persalinan</td>
					<td class="">
						@php $value = $res->jenis_persalinan ?? '1' @endphp
						@if($value == 1)Tunggal
						@elseif($value == 6)Kembar Lebih Dari 5
						@else Kembar {{$value}}
						@endif
					</td>
				</tr>
				<tr>
					<td>Indikasi</td>
					<td class="">{{$res->indikasi or '-'}}</td>
				</tr>
				<tr>
					<td>Jam Indikasi</td>
					<td class="">{{$res->jam_indikasi or '-'}}</td>
				</tr>
				<tr>
					<td>Lama Persalinan: Kala I</td>
					<td class="">{{$res->lama_persalinan_kala_i or '-'}}</td>
				</tr>
				<tr>
					<td>Lama Persalinan: Kala II</td>
					<td class="">{{$res->lama_persalinan_kala_ii or '-'}}</td>
				</tr>
				<tr>
					<td>Lama Persalinan: Kala III</td>
					<td class="">{{$res->lama_persalinan_kala_iii or '-'}}</td>
				</tr>
				<tr>
					<td>Lama Persalinan: Kala IV</td>
					<td class="">{{$res->lama_persalinan_kala_iv or '-'}}</td>
				</tr>
				<tr>
					<td>Lama Persalinan: Total</td>
					<td class="">{{$res->lama_persalinan_total or '-'}}</td>
				</tr>
				<tr>
					<td>Lain-lain</td>
					<td class="">{{$res->lain_lain or '-'}}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>