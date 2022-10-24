<div class="col-12">
	<table class="table table-bordered table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th style="width:40%;" class="text-center">Parameter</th>
				<th style="width:30%;" class="text-center">Pra Kemoterapi</th>
				<th style="width:30%;" class="text-center">Pasca Kemoterapi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Keadaan Umum</td>
				<td class="text-center">{{$res->umum_pra ?? '-'}}</td>
				<td class="text-center">{{$res->umum_pasca ?? '-'}}</td>
			</tr>
			<tr>
				<td>Tekanan Darah</td>
				<td class="text-center">{{$res->tekanan_pra ?? '-'}}</td>
				<td class="text-center">{{$res->tekanan_pasca ?? '-'}}</td>
			</tr>
			<tr>
				<td>Temperatur</td>
				<td class="text-center">{{$res->temperatur_pra ?? '-'}}</td>
				<td class="text-center">{{$res->temperatur_pasca ?? '-'}}</td>
			</tr>
			<tr>
				<td>Nadi</td>
				<td class="text-center">{{$res->nadi_pra ?? '-'}}</td>
				<td class="text-center">{{$res->nadi_pasca ?? '-'}}</td>
			</tr>
			<tr>
				<td>Berat Badan</td>
				<td class="text-center">{{$res->berat_pra ?? '-'}}</td>
				<td class="text-center">{{$res->berat_pasca ?? '-'}}</td>
			</tr>
			<tr>
				<td>Data</td>
				<td class="text-center">{{$res->data_pra ?? '-'}}</td>
				<td class="text-center">{{$res->data_pasca ?? '-'}}</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="col-md-6 col-12">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Pendaftaran</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Waktu Mulai</td>
				<td class="text-center">{{$res->mulai ?? '-'}}</td>
			</tr>
			<tr>
				<td>Waktu Selesai</td>
				<td class="text-center">{{$res->selesai ?? '-'}}</td>
			</tr>
			<tr>
				<td>Lama Kemoterapi</td>
				<td class="text-center">{{$res->lama ?? '-'}}</td>
			</tr>
			<tr>
				<td>Obat Kemoterapi</td>
				<td class="text-center">{{$res->obat ?? '-'}}</td>
			</tr>
			<tr>
				<td>Alergi</td>
				<td class="text-center">{{$res->alergi ?? '-'}}</td>
			</tr>
		</tbody>
	</table>
</div>