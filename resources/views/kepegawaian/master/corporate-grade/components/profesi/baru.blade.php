@extends('kepegawaian.layouts.main')

@section('title')
Master Corporate Grade
@endsection

@section('subtitle')
Master Corporate Grade / Pengaturan Profesi
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
				Pengaturan Profesi
			</h3>
		</div>
		<div class="block-content">
			<form action="{{url()->current()}}" method="POST">
				{{csrf_field()}}
				<div class="col-md-6 px-0">
					<div class="form-group">
						<label>Nama Profesi</label>
						<input class="form-control" type="text" placeholder="Masukkan Nama Profesi" name="nama_profesi" required="">
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