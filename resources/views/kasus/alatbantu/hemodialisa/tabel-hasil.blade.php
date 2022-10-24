<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Diagnosis Penyakit Ginjal</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Etiologi</td>
				<td class="text-center">{{$res->etiologi ?? '-'}}</td>
			</tr>
			<tr>
				<td>Penyulit</td>
				<td class="text-center">{{$res->penyulit ?? '-'}}</td>
			</tr>
			<tr>
				<td>Tekanan Darah (Pre Kemoterapi)</td>
				<td class="text-center">{{$res->kemo_td_pre ?? '-'}}</td>
			</tr>
			<tr>
				<td>Penyakit Penyerta</td>
				<td class="text-center">{{$res->penyakit_penyerta ?? '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Anamnesis</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Anamnesis</td>
				<td class="text-center">{{$res->anamnesis ?? '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Pemeriksaan Fisik</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Pemeriksaan Fisik</td>
				<td class="text-center">{{$res->pemeriksaan_fisik ?? '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Laboratorium Penunjang</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>HBs Ag</td>
				<td class="text-center">{{$res->hbs_ag ?? '-'}}</td>
			</tr>
			<tr>
				<td>Anti HCV</td>
				<td class="text-center">{{$res->anti_hcv ?? '-'}}</td>
			</tr>
			<tr>
				<td>Anti HIV</td>
				<td class="text-center">{{$res->anti_hiv ?? '-'}}</td>
			</tr>
			<tr>
				<td>Hemoglobin</td>
				<td class="text-center">{{$res->hemoglobin ?? '-'}}</td>
			</tr>
			<tr>
				<td>Ureum</td>
				<td class="text-center">{{$res->ureum ?? '-'}}</td>
			</tr>
			<tr>
				<td>Kreatinin</td>
				<td class="text-center">{{$res->kreatinin ?? '-'}}</td>
			</tr>
			<tr>
				<td>Asam Urat</td>
				<td class="text-center">{{$res->asam_urat ?? '-'}}</td>
			</tr>
			<tr>
				<td>Kalium</td>
				<td class="text-center">{{$res->kalium ?? '-'}}</td>
			</tr>
			<tr>
				<td>Natrium</td>
				<td class="text-center">{{$res->natrium ?? '-'}}</td>
			</tr>
			<tr>
				<td>Kalsium</td>
				<td class="text-center">{{$res->kalsium ?? '-'}}</td>
			</tr>
			<tr>
				<td>Posfor Anorganik</td>
				<td class="text-center">{{$res->posfor_anorganik ?? '-'}}</td>
			</tr>
			<tr>
				<td>Gula Darah</td>
				<td class="text-center">{{$res->gula_darah ?? '-'}}</td>
			</tr>
			<tr>
				<td>Fe Serum</td>
				<td class="text-center">{{$res->fe_serum ?? '-'}}</td>
			</tr>
			<tr>
				<td>TIBC</td>
				<td class="text-center">{{$res->tibc ?? '-'}}</td>
			</tr>
			<tr>
				<td>Sat Transferin</td>
				<td class="text-center">{{$res->sat_transferin ?? '-'}}</td>
			</tr>
			<tr>
				<td>Lain-lain</td>
				<td class="text-center">{{$res->penunjang_lain2 ?? '-'}}</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Resep Hemodialisis Kronik</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Dijadwalkan</td>
				<td class="text-center">@if(isset($res->dijadwalkan)) @foreach($res->dijadwalkan as $k => $r) {{strtoupper($r)}} @if(isset($res->dijadwalkan[$k+1])),@endif @endforeach @endif</td>
			</tr>
			<tr>
				<td>Jenis Dialisat</td>
				<td class="text-center">{{$res->jenis_dialisat ?? '-'}}</td>
			</tr>
			<tr>
				<td>Akses Sirkulasi</td>
				<td class="text-center">{{$res->akses_sirkulasi ?? '-'}}</td>
			</tr>
			<tr>
				<td>Durasi Td</td>
				<td class="text-center">{{$res->durasi_hd ?? '-'}}</td>
			</tr>
			<tr>
				<td>UF Goal</td>
				<td class="text-center">{{$res->uf_goal ?? '-'}}</td>
			</tr>
			<tr>
				<td>Kecepatan Aliran Darah</td>
				<td class="text-center">{{$res->kecepatan_aliran_darah ?? '-'}}</td>
			</tr>
			<tr>
				<td>Kecepatan Alirah Dialisat</td>
				<td class="text-center">{{$res->kecepatan_aliran_dialisat ?? '-'}}</td>
			</tr>
			<tr>
				<td>Heparinisasi Kontinua</td>
				<td class="text-center">{{$res->heparinisasi_kontinua ?? '-'}}</td>
			</tr>
			<tr>
				<td>Heparinisasi Intermiten</td>
				<td class="text-center">{{$res->heparinisasi_intermiten ?? '-'}}</td>
			</tr>
			<tr>
				<td>Heparinisasi LMWH</td>
				<td class="text-center">{{$res->heparinisasi_lmwh ?? '-'}}</td>
			</tr>
			<tr>
				<td>Program Profiling UF</td>
				<td class="text-center">{{$res->program_profiling_uf ?? '-'}}</td>
			</tr>
			<tr>
				<td>Program Profiling Na</td>
				<td class="text-center">{{$res->program_profiling_na ?? '-'}}</td>
			</tr>
			<tr>
				<td>Suhu</td>
				<td class="text-center">{{$res->suhu ?? '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Terapi</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Terapi</td>
				<td class="text-center">{{$res->terapi ?? '-'}}</td>
			</tr>
		</tbody>
	</table>
</div>