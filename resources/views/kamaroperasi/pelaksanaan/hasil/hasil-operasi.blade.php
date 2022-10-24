<div class="row">
	<div class="col-md-6">
		<h4 class="font-w400">Hasil Operasi</h4>
	</div>
	<div class="col-md-6 text-right">
		@if ($transaksi->hasil)
		<a href="{{url()->current()}}/print/hasil" target="_blank">
			<button type="button" class="btn btn-default">
				<i class="fa fa-print"></i> Print
			</button>
		</a>
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-hasil-operasi"><i class="fa fa-pencil"></i> Edit</button>
		@else
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-hasil-operasi"><i class="fa fa-pencil"></i> Buat Hasil Operasi</button>
		@endif
	</div>
</div>
@if ($transaksi->hasil)
<div class="row">
	<div class="col-6">
		<h5 class="font-w400">
			<small class="title-hasil">DIAGNOSIS AWAL</small><br>
			{{ $transaksi->hasil->diagnosis_awal }}<br>
		</h5>
		<h5 class="font-w400">
			<small class="title-hasil">DIAGNOSIS AKHIR</small><br>
			{{ $transaksi->hasil->diagnosis_akhir }}<br>
		</h5>
		<h5 class="font-w400">
			<small class="title-hasil">PERSIAPAN</small><br>
			{{ $transaksi->hasil->persiapan }}<br>
		</h5>
		<h5 class="font-w400">
			<small class="title-hasil">POSISI</small><br>
			{{ $transaksi->hasil->posisi }}<br>
		</h5>
		<h5 class="font-w400">
			<small class="title-hasil">DISINFEKTAN</small><br>
			{{ $transaksi->hasil->disinfektan }}<br>
		</h5>
		<h5 class="font-w400">
			<small class="title-hasil">INCISI</small><br>
			{{ $transaksi->hasil->incisi }}<br>
		</h5>
		<h5 class="font-w400">
			<small class="title-hasil">TEMUAN OPERASI</small><br>
			{{ $transaksi->hasil->temuan_operasi }}<br>
		</h5>
		<h5 class="font-w400">
			<small class="title-hasil">TINDAKAN</small><br>
			{{ $transaksi->hasil->tindakan }}<br>
		</h5>
	</div>

	<div class="col-6">
		<h5 class="font-w400">
			<small class="title-hasil">PENDARAHAN</small><br>
			{{ $transaksi->hasil->pendarahan }}<br>
		</h5>
		<h5 class="font-w400">
			<small class="title-hasil">ADVICE POST OPS</small><br>
			{{ $transaksi->hasil->advice_post }}<br>
		</h5>
		<h5 class="font-w400">
			<small class="title-hasil">PEMERIKSAAN PA</small><br>
			{{ $transaksi->hasil->pemeriksaan_pa }}<br>
		</h5>
		<h5 class="font-w400">
			<small class="title-hasil">JENIS OPERASI</small><br>
			{{ $transaksi->hasil->jenis->nama }}<br>
		</h5>
		<h5 class="font-w400">
			<small class="title-hasil">TANGGAL OPERASI</small><br>
			{{ $transaksi->hasil->tanggal_operasi->format('d F Y') }}<br>
		</h5>
		<h5 class="font-w400">
			<small class="title-hasil">WAKTU MULAI OPERASI</small><br>
			{{\Carbon\Carbon::parse($transaksi->hasil->waktu_mulai)->format('H:i')}}<br>
		</h5>
		<h5 class="font-w400">
			<small class="title-hasil">WAKTU SELESAI OPERASI</small><br>
			{{\Carbon\Carbon::parse($transaksi->hasil->waktu_selesai)->format('H:i')}}<br>
		</h5>
		<h5 class="font-w400">
			<small class="title-hasil">LAMA ANASTESI</small><br>
			{{\Carbon\Carbon::parse($transaksi->hasil->lama_anastesi)->format('H:i')}}<br>
		</h5>
		<h5 class="font-w400">
			<small class="title-hasil">STATUS PASIEN</small><br>
			{{ $transaksi->hasil->status_pasien ?? '-'}}<br>
		</h5>


	</div>
</div>
@else
<p>Belum ada hasil operasi</p>
@endif