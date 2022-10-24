<div class="row">
	<div class="col-md-6">
		<h4 class="font-w400">Pengembalian Alkes</h4>
	</div>
	<div class="col-md-6 text-right">
		@if ($pengembalian->count())
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-pengembalian-alat"><i class="fa fa-pencil"></i> Edit Pengembalian</button>
		@else
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-pengembalian-alat"><i class="fa fa-pencil"></i> Buat Pengembalian</button>
		@endif
	</div>
</div>
@if ($pengembalian->count())
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
				@foreach ($pengembalian as $item)
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
<p>Belum ada alat dan obat yang dikembalikan</p>
@endif