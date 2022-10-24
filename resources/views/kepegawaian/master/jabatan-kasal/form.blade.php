@extends('kepegawaian.layouts.main')

@section('title')
Master Kualifikasi
@endsection

@section('subtitle')
Master Kualifikasi / Tambah Kualifikasi
@endsection

@section('css')

@endsection

@section('content')

<div class="content" style="margin-top:50px;">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				{{$title}}
			</h3>
		</div>
		<div class="block-content">
			<form action="{{url()->current()}}" method="POST">
				{{csrf_field()}}
				<div class="col-md-6">
					<div class="form-group">
						<label>Nama Jabatan Kasal</label>
						<input class="form-control" type="text" placeholder="Masukkan Nama Kualifikasi" name="nama" value="{{$nama ?? ''}}" required="">
					</div>
					<div class="form-group">
						<label>Urutan</label>
						<input class="form-control" type="number" placeholder="Masukkan Urutan Berupa Angka" name="order" value="{{$order ?? ''}}" required="">
						<small>Urutan mempengaruhi hasil printout laporan. Semakin kecil angka semakin tinggi</small>
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