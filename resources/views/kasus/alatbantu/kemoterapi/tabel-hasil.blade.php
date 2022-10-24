<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Keadaan</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Keadaan Umum</td>
				<td class="text-center">{{$res->keadaan_umum ?? '-'}}</td>
			</tr>
			<tr>
				<td>Pemeriksaan Fisik : GCS</td>
				<td class="text-center">{{$res->gcs ?? '-'}}</td>
			</tr>
			<tr>
				<td>Pemeriksaan Fisik : TD</td>
				<td class="text-center">{{$res->td ?? '-'}}</td>
			</tr>
			<tr>
				<td>Pemeriksaan Fisik : N</td>
				<td class="text-center">{{$res->n ?? '-'}}</td>
			</tr>
			<tr>
				<td>Pemeriksaan Fisik : RR</td>
				<td class="text-center">{{$res->rr ?? '-'}}</td>
			</tr>
			<tr>
				<td>Pemeriksaan Fisik : Suhu</td>
				<td class="text-center">{{$res->suhu ?? '-'}}</td>
			</tr>
			<tr>
				<td>Pemeriksaan Regional : Sull</td>
				<td class="text-center">{{!empty($res->sull) ? 'Ya' : 'Tidak'}}</td>
			</tr>
			<tr>
				<td>Pemeriksaan Regional : Cervical</td>
				<td class="text-center">{{!empty($res->cervical) ? 'Ya' : 'Tidak'}}</td>
			</tr>
			<tr>
				<td>Pemeriksaan Regional : Thorax</td>
				<td class="text-center">{{!empty($res->thorax) ? 'Ya' : 'Tidak'}}</td>
			</tr>
			<tr>
				<td>Pemeriksaan Regional : Abdomen</td>
				<td class="text-center">{{!empty($res->abdomen) ? 'Ya' : 'Tidak'}}</td>
			</tr>
			<tr>
				<td>Pemeriksaan Regional : Ekstremitas</td>
				<td class="text-center">{{!empty($res->ekstremitas) ? 'Ya' : 'Tidak'}}</td>
			</tr>
			<tr>
				<td>Pemeriksaan Penunjang : ECG</td>
				<td class="text-center">{{!empty($res->ecg) ? 'Ya' : 'Tidak'}}</td>
			</tr>
			<tr>
				<td>Pemeriksaan Penunjang : Lab</td>
				<td class="text-center">{{!empty($res->lab) ? 'Ya' : 'Tidak'}}</td>
			</tr>
			<tr>
				<td>Pemeriksaan Penunjang : Ro</td>
				<td class="text-center">{{!empty($res->ro) ? 'Ya' : 'Tidak'}}</td>
			</tr>
			<tr>
				<td>Pemeriksaan Penunjang : CT Scan</td>
				<td class="text-center">{{!empty($res->ct_scan) ? 'Ya' : 'Tidak'}}</td>
			</tr>
			<tr>
				<td>Pemeriksaan Penunjang : MRI</td>
				<td class="text-center">{{!empty($res->mri) ? 'Ya' : 'Tidak'}}</td>
			</tr>
			<tr>
				<td>Pemeriksaan Penunjang Lainnya</td>
				<td class="text-center">{{$res->penunjang_lainnya ?? '-'}}</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Asesmen</th>
			</tr>
			<tr>
				<th style="width:70%"></th>
				<th class="text-center" style="width: 30%;"></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="2">Nilai Kriteria Karnovsky</td>
			</tr>
			<tr>
				<td colspan="2" class="text-center"> {{$res->karnovsky ?? '-'}} </td>
			</tr>
			<tr>
				<td colspan="2">Nilai Kriteria ECOG</td>
			</tr>
			<tr>
				<td colspan="2" class="text-center"> {{$res->ecog ?? '-'}} </td>
			</tr>
			<tr>
				<td colspan="2">Diagnosa Medis</td>
			</tr>
			<tr>
				<td colspan="2" class="text-center"> {{$res->diagnosa_medis ?? '-'}} </td>
			</tr>
			<tr>
				<td colspan="2">Terapi (Kemoterapi)</td>
			</tr>
			<tr>
				<td colspan="2" class="text-center"> {{$res->terapi ?? '-'}} </td>
			</tr>
			<tr>
				<td>Penjelasan pada pihak Penderita dan Keluarga (Informed Consent)</td>
				<td class="text-center"> {{$res->penjelasan}} </td>
			</tr>
		</tbody>
	</table>
</div>