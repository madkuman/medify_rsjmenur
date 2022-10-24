@extends('keuangan.layouts.main')

@section('title')
Edit Rekanan - Keuangan
@endsection

@section('css')

<style>
.dataTables_processing {
	background-color: white;
}
</style>
@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Edit Rekanan {{$rekanan->nama}}
			</h3>
		</div>
		<div class="block-content">
			<form method="POST" action="{{ action('Keuangan\Rekanan\PostController@submit') }}">
				{{csrf_field()}}
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Id Rekanan</label>
							<input type="text" class="form-control" value="{{$rekanan->id}}" disabled="true">
							<input type="hidden" class="form-control" value="{{$rekanan->id}}" name="id">
						</div>
						<div class="form-group">
							<label>Nama Rekanan</label>
							<input type="text" class="form-control" value="{{$rekanan->nama}}" name="nama" required="true">
						</div>
						<div class="form-group">
							<label>NPWP</label>
							<input type="text" class="form-control" value="{{$rekanan->npwp}}" name="npwp" required="true">
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label>Jenis Pimpinan</label>
							<input type="text" class="form-control" value="{{$rekanan->jabatan}}" name="jabatan" required="true">
						</div>
						<div class="form-group">
							<label>Nama Direktur</label>
							<input type="text" class="form-control" value="{{$rekanan->direktur}}" name="direktur" required="true">
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input type="text" class="form-control" value="{{$rekanan->alamat}}" name="alamat" required="true">
						</div>
						<div class="form-group">
							<button class="btn btn-success btn-hero pull-right">Simpan</button>
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