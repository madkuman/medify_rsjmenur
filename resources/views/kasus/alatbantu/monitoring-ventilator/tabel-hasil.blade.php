<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Ventilator Bundle Prevention Checklist</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Ventilator</td>
				<td class="text-center">{{$res->ventilator}}</td>
			</tr>
			<tr>
				<td>Oral Care 2-3x/day</td>
				<td class="text-center">{{!empty($res->oral_care) ? 'Ya' : 'Tidak'}}</td>
			</tr>
			<tr>
				<td>Head of Bed >= 30&#176;</td>
				<td class="text-center">{{!empty($res->head_of_bed) ? 'Ya' : 'Tidak'}}</td>
			</tr>
			<tr>
				<td>Daily Sedation Vacation (Tanpa Sedasi)</td>
				<td class="text-center">{{!empty($res->daily_sedation) ? 'Ya' : 'Tidak'}}</td>
			</tr>
			<tr>
				<td>Daily Assesment of Readiness to Wean (Process)</td>
				<td class="text-center">{{!empty($res->daily_assesment) ? 'Ya' : 'Tidak'}}</td>
			</tr>
			<tr>
				<td>Daily Spontaneus Breathing Trial / T.Piece</td>
				<td class="text-center">{{!empty($res->daily_spontaneus) ? 'Ya' : 'Tidak'}}</td>
			</tr>
			<tr>
				<td>Peptic Ulcer Drug Profilaksis</td>
				<td class="text-center">{{!empty($res->peptic) ? 'Ya' : 'Tidak'}}</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">VAC - PEEP min & FiO2 min</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Nilai PEEP minimal (angka terendah harian)</td>
				<td class="text-center">{{$res->peep ?? '-'}}</td>
			</tr>
			<tr>
				<td>Nilai FiO2 minimal (angka terendah harian)</td>
				<td class="text-center">{{$res->fio ?? '-'}}</td>
			</tr>
			<tr>
				<td>Nilai PEEP minimal / FiO2 minimal harian selama 2 hari/lebih</td>
				<td class="text-center">{{$res->peep_fio_stabil}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">/VAC</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Temperatur</td>
				<td class="text-center">{{$res->temperatur}}</td>
			</tr>
			<tr>
				<td>Leukosit</td>
				<td class="text-center">{{$res->leukosit}}</td>
			</tr>
			<tr>
				<td>Antibiotik yang diberikan</td>
				<td class="text-center">{{$res->antibiotik ?? '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">VAP</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Sekresi Trachea (Sputum)</td>
				<td class="text-center">{{$res->sekresi}}</td>
			</tr>
			<tr>
				<td>Hasil Pemeriksaan Kultur Sputum</td>
				<td class="text-center">{{$res->kultur_sputum}}</td>
			</tr>
		</tbody>
	</table>
</div>