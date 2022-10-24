@extends('kepegawaian.layouts.main')

@section('title')
Master Pangkat
@endsection

@section('subtitle')
Master Pangkat / Tambah Pangkat
@endsection

@section('css')

@endsection

@section('content')

<div class="content" style="margin-top:50px;">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Tambah Pangkat
			</h3>
		</div>
		<div class="block-content">
			<form action="{{url()->current()}}" method="POST">
				{{csrf_field()}}
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-form-label">Nama Pangkat</label>
						<input type="text" name="nama" placeholder="Masukkan nama master pangkat" class="form-control" 
						required autocomplete="off" value="{{$nama ?? ''}}">
					</div>
					<div class="form-group">
						<label class="col-form-label">Nama Pendek 1</label>
						<input type="text" name="nama_pendek_1" placeholder="Masukkan nama mendek" class="form-control" 
						required autocomplete="off" value="{{$nama_pendek_1 ?? ''}}">
					</div>
					<div class="form-group">
						<label class="col-form-label">Nama Pendek 2</label>
						<input type="text" name="nama_pendek_2" placeholder="Masukkan nama pendek" class="form-control" 
						required autocomplete="off" value="{{$nama_pendek_2 ?? ''}}">
					</div>
					<div class="form-group">
						<label class="col-form-label">Usia Pensiun</label>
						<input type="number" name="usia" placeholder="Masukkan usia pensiun" class="form-control" 
						required autocomplete="off" value="{{$usia_pensiun ?? ''}}">
					</div>
					<div class="form-group">
						<label class="col-form-label">Strata</label>
						<input type="text" name="strata" placeholder="Masukkan strata pangkat" class="form-control" 
						required autocomplete="off" value="{{$strata ?? ''}}">
					</div>
					<div class="form-group">
						<label class="col-form-label">Urutan Strata</label>
						<input type="number" name="urutan_strata" placeholder="Masukkan urutan strata" class="form-control" 
						required autocomplete="off" value="{{$strata_order ?? ''}}">
					</div>
					<div class="form-group">
						<label class="col-form-label">Kenkatba</label>
						<input type="text" name="kenkatba" placeholder="Masukkan kenkatba" class="form-control" 
						required autocomplete="off" value="{{$kenkatba ?? ''}}">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('js')

@endsection