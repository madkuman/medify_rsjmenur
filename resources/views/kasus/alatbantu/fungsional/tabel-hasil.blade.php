<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Pengkajian Fungsi Sensorik</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Penglihatan</td>
				<td class="text-center">{{$res->penglihatan}}</td>
			</tr>
			<tr>
				<td>Penciuman</td>
				<td class="text-center">{{$res->penciuman}}</td>
			</tr>
			<tr>
				<td>Pendengaran</td>
				<td class="text-center">{{$res->pendengaran}}</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Pengkajian Fungsi Kognitif</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Kognitif</td>
				<td class="text-center">{{$res->kognitif}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Pengkajian Fungsi Motorik</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Aktivitas Sehari-hari</td>
				<td class="text-center">{{$res->aktivitas}}</td>
			</tr>
			<tr>
				<td>Berjalan</td>
				<td class="text-center">{{$res->berjalan}}</td>
			</tr>
		</tbody>
	</table>
</div>