<div class="col-md-12">
	<div class="col-12">
		<table class="table table-bordered table-vcenter" style="width: 100%">
			<thead>
				<tr>
					<th class="text-center">Parameter</th>
					<th class="text-center">Mulai</th>
					<th class="text-center">1/2 Jam</th>
					<th class="text-center">1 Jam</th>
					<th class="text-center">2 Jam</th>
					<th class="text-center">3 Jam</th>
					<th class="text-center">4 Jam</th>
					<th class="text-center">5 Jam</th>
					<th class="text-center">Keterangan</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Waktu</td>
					<td class="text-center">{{$res->waktu_mulai ?? '-'}}</td>
					<td class="text-center">{{$res->waktu_12_jam ?? '-'}}</td>
					<td class="text-center">{{$res->waktu_1_jam ?? '-'}}</td>
					<td class="text-center">{{$res->waktu_2_jam ?? '-'}}</td>
					<td class="text-center">{{$res->waktu_3_jam ?? '-'}}</td>
					<td class="text-center">{{$res->waktu_4_jam ?? '-'}}</td>
					<td class="text-center">{{$res->waktu_5_jam ?? '-'}}</td>
					<td class="text-center">{{$res->waktu_keterangan ?? '-'}}</td>
				</tr>
				<tr>
					<td>Tekanan Darah</td>
					<td class="text-center">{{$res->tekanan_mulai ?? '-'}}</td>
					<td class="text-center">{{$res->tekanan_12_jam ?? '-'}}</td>
					<td class="text-center">{{$res->tekanan_1_jam ?? '-'}}</td>
					<td class="text-center">{{$res->tekanan_2_jam ?? '-'}}</td>
					<td class="text-center">{{$res->tekanan_3_jam ?? '-'}}</td>
					<td class="text-center">{{$res->tekanan_4_jam ?? '-'}}</td>
					<td class="text-center">{{$res->tekanan_5_jam ?? '-'}}</td>
					<td class="text-center">{{$res->tekanan_keterangan ?? '-'}}</td>
				</tr>
				<tr>
					<td>Suhu / Nadi</td>
					<td class="text-center">{{$res->suhu_mulai ?? '-'}}</td>
					<td class="text-center">{{$res->suhu_12_jam ?? '-'}}</td>
					<td class="text-center">{{$res->suhu_1_jam ?? '-'}}</td>
					<td class="text-center">{{$res->suhu_2_jam ?? '-'}}</td>
					<td class="text-center">{{$res->suhu_3_jam ?? '-'}}</td>
					<td class="text-center">{{$res->suhu_4_jam ?? '-'}}</td>
					<td class="text-center">{{$res->suhu_5_jam ?? '-'}}</td>
					<td class="text-center">{{$res->suhu_keterangan ?? '-'}}</td>
				</tr>
				<tr>
					<td>RR</td>
					<td class="text-center">{{$res->rr_mulai ?? '-'}}</td>
					<td class="text-center">{{$res->rr_12_jam ?? '-'}}</td>
					<td class="text-center">{{$res->rr_1_jam ?? '-'}}</td>
					<td class="text-center">{{$res->rr_2_jam ?? '-'}}</td>
					<td class="text-center">{{$res->rr_3_jam ?? '-'}}</td>
					<td class="text-center">{{$res->rr_4_jam ?? '-'}}</td>
					<td class="text-center">{{$res->rr_5_jam ?? '-'}}</td>
					<td class="text-center">{{$res->rr_keterangan ?? '-'}}</td>
				</tr>
				<tr>
					<td>GCS</td>
					<td class="text-center">{{$res->gcs_mulai ?? '-'}}</td>
					<td class="text-center">{{$res->gcs_12_jam ?? '-'}}</td>
					<td class="text-center">{{$res->gcs_1_jam ?? '-'}}</td>
					<td class="text-center">{{$res->gcs_2_jam ?? '-'}}</td>
					<td class="text-center">{{$res->gcs_3_jam ?? '-'}}</td>
					<td class="text-center">{{$res->gcs_4_jam ?? '-'}}</td>
					<td class="text-center">{{$res->gcs_5_jam ?? '-'}}</td>
					<td class="text-center">{{$res->gcs_keterangan ?? '-'}}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Asesmen Observasi</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Obat yang masuk</td>
				<td class="text-center">{{$res->obat ?? '-'}}</td>
			</tr>
			<tr>
				<td>Keluhan lain</td>
				<td class="text-center">{{$res->keluhan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Makan / Minum</td>
				<td class="text-center">{{$res->makan_minum ?? '-'}}</td>
			</tr>
			<tr>
				<td>Vomiting</td>
				<td class="text-center">{{$res->vomiting ?? '-'}}</td>
			</tr>
			<tr>
				<td>Urine</td>
				<td class="text-center">{{$res->urine ?? '-'}}</td>
			</tr>
			<tr>
				<td>Laborat</td>
				<td class="text-center">{{$res->laborat ?? '-'}}</td>
			</tr>
		</tbody>
	</table>
</div>