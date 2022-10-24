<div class="row">
	<div class="col-md-6">
		<h4 class="font-w400">Rencana Kegiatan Operasi</h4>
	</div>
	<div class="col-md-6 text-right">
		@if ($transaksi->deskripsi_rencana)
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-rencana-kegiatan"><i class="fa fa-pencil"></i> Edit Rencana Kegiatan</button>
		@else
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-rencana-kegiatan"><i class="fa fa-pencil"></i> Buat Rencana Kegiatan</button>
		@endif
	</div>
</div>
@if ($transaksi->deskripsi_rencana)
{!! $transaksi->deskripsi_rencana !!}
@else
<p>Belum ada rencana kegiatan</p>
@endif
<hr>
<div class="row">
	<div class="col-md-6">
		<h4 class="font-w400">Rencana Alkes, Matkes, Obat & Implan</h4>
	</div>
	<div class="col-md-6 text-right">
		@if ($rencana->count())
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-rencana-alat"><i class="fa fa-pencil"></i> Edit Rencana</button>
		@else
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-rencana-alat"><i class="fa fa-pencil"></i> Buat Rencana</button>
		@endif
	</div>
</div>
@if ($rencana->count())
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
				@foreach ($rencana as $item)
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
<p>Belum ada rencana penggunaan alat & obat</p>
@endif