@extends('kepegawaian.layouts.main')

@section('title')
Master Corporate Grade
@endsection

@section('subtitle')
Master Corporate Grade / Pengaturan Grade
@endsection

@section('css')

@endsection

@section('content')

<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<small><a href="{{url()->previous()}}" class="pull-right">
					<i class="si si-action-undo"></i> Kembali ke halaman sebelumnya</a>
				</small>
				Pengaturan Grade
			</h3>
		</div>
		<div class="block-content">
			<form action="{{url()->current()}}" method="POST">
				{{csrf_field()}}
				<div class="col-md-6 px-0">
					<div class="form-group">
						<label>Nama Grade</label>
						<input class="form-control" type="text" placeholder="Masukkan nama Grade" name="nama_grade" required="">
					</div>
					<div class="form-group">
						<label>Level</label>
						<select class="form-control js-select2">
							<option disabled="">Pilih Level</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
						</select>
					</div>
					<div class="form-group">
						<label>Profesi</label>
						<select class="form-control js-select2">
							<option disabled="">Pilih Profesi</option>
							<option>Dokter</option>
							<option>Perawat</option>
							<option>Hacker</option>
						</select>
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