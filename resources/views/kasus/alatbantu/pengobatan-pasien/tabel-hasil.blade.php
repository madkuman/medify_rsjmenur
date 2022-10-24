<div class="col-md-8 col-12">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Nama Obat</td>
				<td class="text-center">{{$res->obat ?? "-"}}</td>
			</tr>
			<tr>
				<td>Aturan Pemakaian</td>
				<td class="text-center">{{$res->aturan ?? "-"}}</td>
			</tr>
			<tr>
				<td>Rute</td>
				<td class="text-center">{{$res->rute ?? "-"}}</td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td class="text-center">{{$res->keterangan ?? "-"}}</td>
			</tr>
		</tbody>
	</table>
</div>