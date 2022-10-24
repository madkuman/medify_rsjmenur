@extends('layouts.main-dashboard')

@section('title')
Admin - Daftar Import Baru
@endsection

@section('css')

@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<div class="content" style="margin-top:50px;">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Import Data Baru
			</h3>
		</div>
		<div class="block-content">
			<hr>
			<form method="POST" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="row">
					<div class="col-4">
						<div class="form-group">
							<label>File</label><br>
							<input type="file" name="file[]" multiple><br>
							<small>Multiple</small>
						</div>
						<div class="form-group">
							<label>Jenis Data</label>
							<select class="form-control" name="jenis">
								<option value="tarif">Tarif</option>
								<option value="tarif-kategori">Tarif Kategori</option>
								<option value="dokter-poliklinik">Poli & Jadwal Dokter</option>
								<option value="pembayaran-perusahaan">Pembayaran Perusahaan</option>
								<option value="pasien">Pasien</option>
								<option value="kelas">Kelas</option>
								<option value="kasir">Kasir</option>
								<option value="farmasi-aturan-obat">Farmasi - Aturan Obat</option>
								<option value="farmasi-master-obat">Farmasi - Master Obat</option>
								<option value="farmasi-unit">Farmasi - Unit</option>
								<option value="ok-jenis-operasi">OK - Jenis Operasi</option>
								<option value="ok-spesialis">OK - Spesialis Operasi</option>
								<option value="ok-peran-tim">OK - Peran Tim</option>
								<option value="ok-ruangan">OK - Ruangan</option>
								<option value="labpk-form">Lab PK - Form</option>
								<option value="e-usulan-akun-rekening">E-usulan Akun Rekening</option>
								<option value="e-usulan-barang">E-usulan Barang</option>
							</select>
						</div>
						<div class="form-group">
							<button class="btn btn-primary">Submit</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('js')

@endsection