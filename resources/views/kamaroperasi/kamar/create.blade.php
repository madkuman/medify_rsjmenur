@extends('layouts.main2')

@section('title')
Buat Kamar Baru - Kamar Operasi - Medify
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('kamaroperasi.components.navbar')
		<div class="row">
			<div class="col-md-12">
				<div class="block  text-center pb-100">
					<div class="block-content block-content text-left">
						<h4>Buat Kamar Baru</h4>
						<hr>
					</div>
					<form method="POST" action="{{ url('/kamaroperasi/kamar/new') }}" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="avatar-upload">
							<div class="avatar-edit">
								<input type='file' id="avatar" name="logo" accept=".png, .jpg, .jpeg" />
								<label for="avatar"></label>
							</div>
							<div class="avatar-preview">
								<div id="imagePreview" style="background-image: url('');">
								</div>
							</div>
						</div>
						<div class="form-group row justify-content-center">
							<div class="col-md-6">
								<div class="form-material form-material-lg floating">
									<input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ old('name') }}" required>
									<label for="name">Nama Kamar</label>
								</div>
							</div>
						</div>
						<div class="form-group row justify-content-center">
							<div class="col-md-6">
								<div class="form-material form-material-lg floating">
									<select class="form-control" name="kategori" id="kategori" required>
										<option></option>
										<option {{ old('kategori') == 'Kamar Operasi' ? 'selected' : '' }}>Kamar Operasi</option>
										<option {{ old('kategori') == 'IGD' ? 'selected' : '' }}>IGD</option>
									</select>
									<label for="kategori">Kategori</label>
								</div>
							</div>
						</div>
						<div class="form-group row justify-content-center">
							<div class="col-md-6">
								<div class="form-material form-material-lg floating">
									<select class="form-control" name="farmasi" id="farmasi" required>
										<option></option>
										@foreach ($farmasis as $farmasi)
										<option value="{{ $farmasi->id }}">{{ $farmasi->nama }}</option>
										@endforeach
									</select>
									<label for="kategori">Farmasi</label>
								</div>
							</div>
						</div>
						<div class="form-group row justify-content-center">
							<div class="col-md-6">
								<div class="form-material form-material-lg floating">
									<input type="number" class="form-control form-control-lg" id="ronde" name="ronde" min="1" value="{{ old('ronde') }}" required>
									<label for="ronde">Jumlah Ronde</label>
								</div>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col-md-6">
								<button class="btn btn-primary btn-hero">Simpan</button>
							</div>
						</div>
					</form>


				</div>

			</div>
		</div>
	</div>
</main>
@endsection

@section('js')
<script>
	$("#manajemen_kamar").addClass('active');
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#imagePreview').css('background-image', 'url('+e.target.result +')');
				$('#imagePreview').hide();
				$('#imagePreview').fadeIn(650);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#avatar").change(function() {
		readURL(this);
	});
</script>
@endsection
