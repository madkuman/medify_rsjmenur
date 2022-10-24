<div class="col-md-6">
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
				<td>Tanggal Datang ke IGD</td>
				<td class="text-center">{{$res->tgl_kedatangan}}</td>
			</tr>
			<tr>
				<td>Jam</td>
				<td class="text-center">{{$res->jam_kedatangan}}</td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td class="text-center">{{$res->pekerjaan != '0' ? $res->pekerjaan : $res->pekerjaan_lain2}}</td>
			</tr>
			<tr>
				<td>Penghasilan</td>
				<td class="text-center">{{$res->penghasilan}}</td>
			</tr>
			<tr>
				<td>Agama</td>
				<td class="text-center">{{$res->agama != '0' ? $res->agama : $res->agama_lain2}}</td>
			</tr>
			<tr>
				<td>Pendidikan</td>
				<td class="text-center">{{$res->pendidikan != '0' ? $res->pendidikan : $res->pendidikan_lain2}}</td>
			</tr>
			<tr>
				<td>Bahasa</td>
				<td class="text-center">{{$res->bahasa != '0' ? $res->bahasa : $res->bahasa_lain2}}</td>
			</tr>
			<tr>
				<td>Penerjemah</td>
				<td class="text-center">{{$res->penerjemah}}</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Keadaan Pra Hospital</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>GCS</td>
				<td class="text-center">{{$res->gcs ?? '-'}}</td>
			</tr>
			<tr>
				<td>TD</td>
				<td class="text-center">{{$res->td ?? '-'}} mmHG</td>
			</tr>
			<tr>
				<td>N</td>
				<td class="text-center">{{$res->n ?? '-'}} x/menit </td>
			</tr>
			<tr>
				<td>S</td>
				<td class="text-center">{{$res->s ?? '-'}} celcius</td>
			</tr>
			<tr>
				<td>RR</td>
				<td class="text-center">{{$res->rr ?? '-'}} x/menit</td>
			</tr>
			<tr>
				<td>SPO<small>2</small></td>
				<td class="text-center">{{$res->spo2 ?? '-'}} %</td>
			</tr>
			<tr>
				<td>O<small>2</small></td>
				<td class="text-center">{{$res->o2 ?? '-'}} Lpm</td>
			</tr>
			<tr>
				<td>BVM</td>
				<td class="text-center">{{$res->tgl_kejadian != '' ? $res->bvm : '-'}}</td>
			</tr>
			<tr>
				<td>ETT</td>
				<td class="text-center">{{$res->ett ?? '-'}}</td>
			</tr>
			<tr>
				<td>Pipa Oro / Nasopharingeal</td>
				<td class="text-center">{{$res->tgl_kejadian != '' ? $res->pipa_oro : '-'}}</td>
			</tr>
			<tr>
				<td>Tracheostomy</td>
				<td class="text-center">{{$res->tracheostomy ?? '-'}}</td>
			</tr>
			<tr>
				<td>CPR</td>
				<td class="text-center">{{$res->cpr ?? '-'}}</td>
			</tr>
			<tr>
				<td>Infus</td>
				<td class="text-center">{{$res->infus ?? '-'}}</td>
			</tr>
			<tr>
				<td>NGT</td>
				<td class="text-center">{{$res->ngt ?? '-'}}</td>
			</tr>
			<tr>
				<td>Kateter</td>
				<td class="text-center">{{$res->kateter ?? '-'}}</td>
			</tr>
			<tr>
				<td>Bidai</td>
				<td class="text-center">{{$res->tgl_kejadian != '' ? $res->bidai : '-'}}</td>
			</tr>
			<tr>
				<td>Jahit Luka</td>
				<td class="text-center">{{$res->jahit_luka ?? '-'}}</td>
			</tr>
			<tr>
				<td>Data Penunjang</td>
				<td class="text-center">{{$res->data_penunjang ?? '-'}}</td>
			</tr>
			<tr>
				<td>Obat-obatan</td>
				<td class="text-center">{{$res->obat ?? '-'}}</td>
			</tr>
			<tr>
				<td>Alasan / Indikasi Dirujuk</td>
				<td class="text-center">{{$res->alasan_indikasi ?? '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Skrining Nyeri</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Provokatif</td>
				<td class="text-center">{{$res->tgl_kejadian != '' ? $res->provokatif != '0' ? $res->provokatif : $res->provokatif_lain2 : '-'}}</td>
			</tr>
			<tr>
				<td>Quality</td>
				<td class="text-center">{{$res->tgl_kejadian != '' ? $res->quality != '0' ? $res->quality : $res->quality_lain2 : '-'}}</td>
			</tr>
			<tr>
				<td>Region</td>
				<td class="text-center">{{$res->region ?? '-'}}</td>
			</tr>
			<tr>
				<td>Lokasi Menjalar</td>
				<td class="text-center">{{$res->lokasi_menjalar ?? '-'}}</td>
			</tr>
			<tr>
				<td>Skala</td>
				<td class="text-center">{{$res->skala ?? '-'}}</td>
			</tr>
			<tr>
				<td>Time</td>
				<td class="text-center">{{$res->tgl_kejadian != '' ? $res->time : '-'}}</td>
			</tr>
			<tr>
				<td>Keadaan Umum</td>
				<td class="text-center">{{$res->tgl_kejadian != '' ? $res->keadaan_umum : '-'}}</td>
			</tr>
			<tr>
				<td>GCS : E</td>
				<td class="text-center">{{$res->e ?? '-'}}</td>
			</tr>
			<tr>
				<td>GCS : V</td>
				<td class="text-center">{{$res->v ?? '-'}}</td>
			</tr>
			<tr>
				<td>GCS : M</td>
				<td class="text-center">{{$res->m ?? '-'}}</td>
			</tr>
			<tr>
				<td>GCS : Total</td>
				<td class="text-center">{{$res->total ?? '-'}}</td>
			</tr>
			<tr>
				<td>Status Psikologis</td>
				<td class="text-center">{{$res->tgl_kejadian != '' ? $res->status_psikologis != '0' ? $res->status_psikologis : $res->status_psikologis_lain2 : '-'}}</td>
			</tr>
		</tbody>
	</table>
</div>