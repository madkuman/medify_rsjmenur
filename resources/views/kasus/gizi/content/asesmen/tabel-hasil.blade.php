<div class="col-md-12">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th style="width:50%">Parameter</th>
				<th class="text-center" style="width: 50%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Resiko malnutrisi berdasarkan hasil skrinning gizi oleh perawat</td>
				<td class="text-center">{{$res->resiko_malnutrisi or '-'}}</td>
			</tr>
			<tr>
				<td>Pasien memiliki kondisi khusus (penyakit kronis dengan komplikasi, anak, lansia, infeksi/trauma berat, sakit kritis)</td>
				<td class="text-center">{{$res->kondisi_khusus or '-'}}</td>
			</tr>
			<tr>
				<td>Alergi : Telur</td>
				<td class="text-center">{{$res->alergi_telur or '-'}}</td>
			</tr>
			<tr>
				<td>Alergi : Susu Sapi &amp; Olahannya</td>
				<td class="text-center">{{$res->alergi_susu or '-'}}</td>
			</tr>
			<tr>
				<td>Alergi : Kacang-kacangan</td>
				<td class="text-center">{{$res->alergi_kacang or '-'}}</td>
			</tr>
			<tr>
				<td>Alergi : Ikan/Udang</td>
				<td class="text-center">{{$res->alergi_ikan or '-'}}</td>
			</tr>
			<tr>
				<td>Alergi : Gluten/Gandum</td>
				<td class="text-center">{{$res->alergi_gluten or '-'}}</td>
			</tr>
			<tr>
				<td>Alergi Lain</td>
				<td class="text-center">{{$res->alergi_lain or '-'}}</td>
			</tr>
			<tr>
				<td>Preskripsi Diet</td>
				<td class="text-center">
					@if(!empty(nl2br($res->preskripsi_diet))){!! nl2br($res->preskripsi_diet)!!} @endif @if(!empty($res->preskripsi_diet_isi)){!! nl2br($res->preskripsi_diet_isi)!!} @else - @endif</td>
			</tr>
			<tr>
				<td>Tindak Lanjut</td>
				<td class="text-center">{{$res->tindak_lanjut or '-'}}</td>
			</tr>
		</tbody>
	</table>
</div>
@if($res->tindak_lanjut == 'Perlu Asuhan Gizi')
<div class="col-md-12">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Asuhan Gizi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>Riwayat Terkait Gizi Dan Makanan</th>
			</tr>
			<tr>
				<td>@if(!empty(nl2br($res->riwayat_gizi))) {!! nl2br($res->riwayat_gizi) !!} @else - @endif</td>
			</tr>
			<tr>
				<th>Data Antropometri</th>
			</tr>
			<tr>
				<td>@if(!empty(nl2br($res->data_antropometri))) {!! nl2br($res->data_antropometri) !!} @else - @endif</td>
			</tr>
			<tr>
				<th>Data Biokimia dan Penunjang Terkait Gizi</th>
			</tr>
			<tr>
				<td>@if(!empty(nl2br($res->data_biokimia))) {!! nl2br($res->data_biokimia) !!} @else - @endif</td>
			</tr>
			<tr>
				<th>Data Fisik - Klinis Terkait Gizi</th>
			</tr>
			<tr>
				<td>@if(!empty(nl2br($res->data_fisik))) {!! nl2br($res->data_fisik) !!} @else - @endif</td>
			</tr>
			<tr>
				<th>Riwayat Personal</th>
			</tr>
			<tr>
				<td>@if(!empty(nl2br($res->riwayat_personal))) {!! nl2br($res->riwayat_personal) !!} @else - @endif</td>
			</tr>
			<tr>
				<th>Diagnosis Gizi</th>
			</tr>
			<tr>
			<td>@if(!empty(nl2br($res->diagnosis_gizi))) {!! nl2br($res->diagnosis_gizi) !!} @else - @endif</td>
			</tr>
			<tr>
				<th>Intervensi Gizi</th>
			</tr>
			<tr>
				<td>@if(!empty(nl2br($res->intervensi))) {!! nl2br($res->intervensi) !!} @else - @endif</td>
			</tr>
			<tr>
				<th>Rencana Monitoring dan Evaluasi</th>
			</tr>
			<tr>
				<td>@if(!empty(nl2br($res->monitoring))) {!! nl2br($res->monitoring) !!} @else - @endif</td>
			</tr>
		</tbody>
	</table>
</div>
@endif