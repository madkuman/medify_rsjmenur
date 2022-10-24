
<div class="row">
	<div class="col-md-6">
		<h4 class="font-w400">Pemakaian Alkes, Matkes, Obat & Implan</h4>
	</div>
	<div class="col-md-6 text-right">
		@if ($pemakaian->count())
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-pemakaian-alat"><i class="fa fa-pencil"></i> Edit Pemakaian</button>
		@if ($transaksi->kasus_id)
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-plafon"><i class="fa fa-pencil"></i> Ganti Plafon</button>
		@endif
		@else
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-pemakaian-alat"><i class="fa fa-pencil"></i> Buat Pemakaian</button>
		@endif
	</div>
</div>
@if ($pemakaian->count())
<div class="row">
	<div class="col-md-6">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>NAMA BARANG</th>
					<th>JUMLAH</th>
					<th>JENIS</th>
				</tr>
			</thead>
			<tbody>
				@php
				$i = 1;
				@endphp
				@foreach ($pemakaian as $item)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{ $item->getItem->nama }}</td>
					<td>{{ $item->jumlah }}</td>
					<td>{{ ucwords($item->jenis) }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@else
<p>Belum ada alat dan obat yang dipakai</p>
@endif