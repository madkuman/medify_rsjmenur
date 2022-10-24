<h4 class="font-w400">Pengaturan</h4>
<div class="row">
	@if(!isset($transaksi->parent_id))
	<div class="col-6">
		<table class="table table-bordered">
			<tr>
				<td>
					<h4 class="text-primary">PERGANTIAN JADWAL OPERASI</h4>
					<p>Atur ulang jadwal operasi. Administrasi kamar operasi akan menjadwalkan ulang.</p>
					<div class="text-right">
						@if ($transaksi->status == 2)
						<button type="button" class="btn btn-default" disabled>Permintaan Telah Dilakukan</button>
						@else
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-ganti-jadwal">Jadwal Ulang</button>
						@endif
					</div>
				</td>
			</tr>
		</table>
	</div>
	@endif
	<div class="col-6">
		<table class="table table-bordered">
			<tr>
				<td>
					<h4 class="text-primary">PERGANTIAN DOKTER</h4>
					<p>Anda dapat mengganti dokter penanggung jawab operasi dengan mudah.</p>
					<div class="text-right">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-ganti-dokter">Ganti Dokter</button>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="col-6">
		<table class="table table-bordered">
			<tr>
				<td>
					<h4 class="text-primary">PERGANTIAN JUDUL</h4>
					<p>Atur ulang judul operasi Anda</p>
					<div class="text-right">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-ganti-judul">Ganti Judul</button>
					</div>
				</td>
			</tr>
		</table>
	</div>
	@if(!isset($transaksi->parent_id))
	<div class="col-6">
		<table class="table table-bordered">
			<tr>
				<td>
					<h4 class="text-primary">PENGATURAN OPERASI JOIN</h4>
					<p>Atur ulang operasi-operasi yang akan dijoin</p>
					<div class="text-right">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-operasi-join">Atur Operasi</button>
					</div>
				</td>
			</tr>
		</table>
	</div>
	@endif
	<div class="col-6">
		<table class="table table-bordered">
			<tr>
				<td>
					<h4 class="text-primary">PEMBATALAN OPERASI</h4>
					<p>Melakukan Pembatalan Untuk Operasi ini</p>
					<div class="text-right">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-batal-operasi">Batalkan Operasi</button>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="col-6">
		<table class="table table-bordered">
			<tr>
				<td>
					<h4 class="text-primary">GANTI DIAGNOSIS</h4>
					<p>Mengganti diagnosis untuk Operasi ini</p>
					<div class="text-right">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-ganti-diagnosis">Ganti Diagnosis</button>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>
